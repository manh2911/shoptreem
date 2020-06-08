<?php

namespace App\Http\Controllers\Client;

use App\Cart;
use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use App\ImageDetailProduct;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'message' => 'Vui lòng đăng nhập',
                    'status' => false
                ]);
            }
            $product = Product::findOrFail($request->productId);
            if ($product->quantity < 1) {
                return response()->json([
                    'message' => 'Sản phẩm đã hết hàng',
                    'status' => false
                ]);
            }

            $user = Auth::user();
            $content[$product->id] = $this->getContent($product);
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart == null) {
                $this->createCart($content, $user->id, $product->id);
            } else {
                $this->updateCart($cart, $content, $user->id, $product->id);
            }

            return response()->json([
                'message' => 'Thêm vào giỏ hàng thành công',
                'status' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => false
            ]);
        }
    }

    public function createCart($content, $userId, $productId) {
        $cart = new Cart();
        $cart->user_id = $userId;
        $cart->content = json_encode($content);
        $cart->total_price = $content[$productId]['subTotalPrice'];
        $cart->save();

        $this->updateQuantityProduct($productId);
    }

    public function updateCart($cart, $content, $userId, $productId, $operator = null) {
        $cartContent = (array)json_decode($cart->content);
        $flagCheckAddNew = true;

        foreach ($cartContent as $item) {
            if ($item->productId == $productId) {
                if (isset($operator) && $operator == ServiceAction::MINUS) {
                    $cartContent[$productId]->quantity -= $content[$productId]['quantity'];
                } else {
                    $cartContent[$productId]->quantity += $content[$productId]['quantity'];
                }
                $cartContent[$productId]->subTotalPrice = $cartContent[$productId]->quantity * $cartContent[$productId]->last_price;
                $flagCheckAddNew = false;
            }
        }
        if ($flagCheckAddNew == true) {
            $cartContent[$productId] = $content[$productId];
        }

        $cart->update([
            'content' => json_encode($cartContent),
        ]);
        $this->updateQuantityProduct($productId, $operator);
        $this->updateTotalPrice($userId);
    }

    public function updateTotalPrice($userId) {
        $cart = Cart::where('user_id', $userId)->first();
        $content = json_decode($cart->content);
        $total_price = 0;
        $total_origin_price = 0;
        foreach ($content as $item) {
            $total_price += $item->subTotalPrice;
            $total_origin_price += $item->origin_price * $item->quantity;
        }

        $total_discount = $total_origin_price - $total_price;



        $cart->update([
            'total_price' => $total_price,
            'total_discount' => $total_discount,
            'total_origin_price' => $total_origin_price,
        ]);
    }

    public function updateQuantityProduct($productId, $operator = null) {
        $product = Product::findOrFail($productId);

        if (isset($operator) && $operator == ServiceAction::MINUS) {
            $newQuantity = $product->quantity + 1;
        } else {
            $newQuantity = $product->quantity - 1;
        }
        $product->update([
            'quantity' => $newQuantity
        ]);

    }

    public function countProductInCart() {
        if (!Auth::check()) {
            return 0;
        } else {
            $user = Auth::user();
            $cartOfUser = Cart::where('user_id', $user->id)->first();

            if ($cartOfUser == null) {
                return 0;
            } else {
                $content = json_decode($cartOfUser->content);

                return count((array)$content);
            }
        }
    }

    public function updateQuantityInCart(Request $request) {
        try {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();
            $product = Product::findOrFail($request->productId);
            if ($request->operator == ServiceAction::MINUS && $request->quantityNow == 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Số lượng tối thiểu bằng 1'
                ]);
            }
            if ($request->operator == ServiceAction::PLUS && $request->quantityNow == $product->quantity) {
                return response()->json([
                    'status' => false,
                    'message' => 'Số lượng tối đa bằng ' . $product->quantity
                ]);
            }
            $content[$product->id] = $this->getContent($product);
            $this->updateCart($cart, $content, $user->id, $request->productId, $request->operator);

            $cartUpdate = Cart::where('user_id', $user->id)->first();
            $contentUpdate = (array)json_decode($cartUpdate->content);
            $quantityUpdate = $contentUpdate[$product->id]->quantity;

            return response()->json([
                'status' => true,
                'message' => 'success',
                'quantityUpdate' => $quantityUpdate,
                'total_origin_price' => $cartUpdate->total_origin_price,
                'total_discount' => $cartUpdate->total_discount,
                'total_price' => $cartUpdate->total_price
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getContent($product) {
        $last_price = $product->origin_price;
        if(isset($product->discount) && $product->discount > 0) {
            $last_price = $last_price - (($last_price / 100) * $product->discount);
        }
        $image = ImageDetailProduct::where('product_id', $product->id)->first();
        $data['productId'] = $product->id;
        $data['name'] = $product->name;
        $data['image'] = $image->image;
        $data['quantity'] = 1;
        $data['origin_price'] = $product->origin_price;
        $data['last_price'] = $last_price;
        $data['subTotalPrice'] = $last_price * 1;

        return $data;
    }

    public function deleteProductInCart(Request $request) {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        $content = (array)json_decode($cart->content);
        unset($content[$request->productId]);
        $cart->update([
            'content' => json_encode($content),
        ]);
        $this->updateTotalPrice($user->id);
        $cartUpdate = Cart::where('user_id', $user->id)->first();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'total_origin_price' => $cartUpdate->total_origin_price,
            'total_discount' => $cartUpdate->total_discount,
            'total_price' => $cartUpdate->total_price
        ]);
    }
}
