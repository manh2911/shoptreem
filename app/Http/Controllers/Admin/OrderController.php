<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();


        return view('Admin.managerOrder.order', compact('orders'));
    }

    public function changeStatus(Request $request) {
        try {
            $order = Order::findOrFail($request->orderId);
            $order->update([
                'status' => $request->status
            ]);

            return response()->json([
                'status' => true,
                'message' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => true,
                'message' => 'fails',
                'error' => $e->getMessage()
            ]);
        }

    }
}
