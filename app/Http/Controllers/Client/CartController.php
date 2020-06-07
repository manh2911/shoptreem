<?php

namespace App\Http\Controllers\Client;

use App\Cart;
use App\Http\Controllers\Controller;
use App\ImageDetailProduct;
use App\Product;
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
            $last_price = $product->origin_price;
            if(isset($product->discount) && $product->discount > 0) {
                $last_price = $last_price - (($last_price / 100) * $product->discount);
            }
            $image = ImageDetailProduct::where('product_id', $product->id)->first();
            $content = [];
            $data['productId'] = $product->id;
            $data['name'] = $product->name;
            $data['image'] = $image->image;
            $data['quantity'] = 1;
            $data['origin_price'] = $product->origin_price;
            $data['last_price'] = $last_price;
            $data['subTotalPrice'] = $last_price * 1;
            $content[$product->id] = $data;

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
    }

    public function updateCart($cart, $content, $userId, $productId) {
        $cartContent = (array)json_decode($cart->content);

        foreach ($cartContent as &$item) {
            if ($item->productId == $productId) {
                $item->quantity += $content[$productId]['quantity'];
                $item->subTotalPrice = $item->quantity * $item->last_price;
            } else {
                $cartContent[$productId] = $content[$productId];
            }
        }
        $cart->update([
            'content' => json_encode($cartContent),
        ]);

        $this->updateTotalPrice($userId);
    }

    public function updateTotalPrice($userId) {
        $cart = Cart::where('user_id', $userId)->first();
        $content = json_decode($cart->content);
        $total_price = 0;
        foreach ($content as $item) {
            $total_price += $item->subTotalPrice;
        }

        $cart->update([
            'total_price' => $total_price,
        ]);
    }
}
