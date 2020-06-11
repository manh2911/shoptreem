<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use App\ImageDetailProduct;
use App\Order;
use App\OrderItem;
use App\Product;
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
            if ($request->status == ServiceAction::ORDER_CANCEL) {
                $this->updateQuantityProductWhenCancelOrder($order);
            }

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

    public function updateQuantityProductWhenCancelOrder($order){
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        foreach ($orderItems as $item) {
            $product = Product::find($item->product_id);
            $product->update([
                'quantity' => $product->quantity + $item->quantity
            ]);
        }
    }

    public function showDetail(Request $request) {
        try {
            $items = OrderItem::where('order_id', $request->orderId)->get()->toArray();
            $nameProducts = [];
            $imageProducts = [];
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                $nameProducts[] = $product->name;
                $image = ImageDetailProduct::where('product_id', $product->id)->first();
                $imageProducts[] = $image->image;
            }

            $order = Order::find($request->orderId)->toArray();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'items' => $items,
                'order' => $order,
                'nameProducts' => $nameProducts,
                'imageProducts' => $imageProducts,
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
