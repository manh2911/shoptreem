<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart() {
        $carts = Cart::content();
        if (isset($carts)) {
            dd($carts);

        } else {
            dd(1);
        }
//        Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    }
}
