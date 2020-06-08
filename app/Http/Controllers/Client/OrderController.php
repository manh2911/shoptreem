<?php

namespace App\Http\Controllers\Client;

use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $content = (array)json_decode($cart->content);

        return view('Client.page.order', compact('user', 'cart', 'content'));
    }
}
