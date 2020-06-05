<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $product = Product::findOrFail($request->productId);
        $user = Auth::user();

        Cart::add([
            [
                'id' => 2,
                'name' => 2,
                'qty' => 1,
                'price' => 10.00,
                'weight' => 1,
                'options' => ['size' => 'large']
            ],
        ]);
        Cart::store($user->id);
        $items = Cart::content();

        dd($items);
        $idItemInCart = $user->id . strtotime("now");





//        Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    }
}
