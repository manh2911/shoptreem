<?php

namespace App\Http\Controllers\Client;

use App\Cart;
use App\Helper\ServiceAction;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::connection(env('DB_DATABASE'));
    }

    public function index() {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $content = $cart == null ? [] : (array)json_decode($cart->content);

        return view('Client.page.order', compact('user', 'cart', 'content'));
    }

    public function postOrder(Request $request) {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $content = (array)json_decode($cart->content);

        try {
            $this->db->beginTransaction();

            $orderId = $this->createOrder($cart, $request, $user);
            $this->createOrderItem($content, $orderId);
            CartController::deleteCart($user->id);

            $this->db->commit();

            return response()->json([
                'status' => true,
                'message' => 'Đặt hàng thành công'
            ]);
        } catch (\Exception $e) {
            $this->db->rollback();

            return response()->json([
                'status' => false,
                'message' => 'Đã có lỗi xảy ra',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function createOrder($cart, $request, $user) {
        $order =  new Order();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->delivery_time = $request->delivery_time;
        $order->total_price = $cart->total_price;
        $order->total_origin_price = $cart->total_origin_price;
        $order->total_discount = $cart->total_discount;
        $order->status = ServiceAction::ORDER_IN_PROCESS;
        $order->user_id = $user->id;
        $order->save();

        return $order->id;
    }

    public function createOrderItem($content, $orderId) {
        $array_item = [];
        foreach ($content as $item) {
            $record_item['order_id'] = $orderId;
            $record_item['product_id'] = $item->productId;
            $record_item['quantity'] = $item->quantity;
            $record_item['origin_price'] = $item->origin_price;
            $record_item['last_price'] = $item->last_price;
            $record_item['discount_price'] = $item->origin_price - $item->last_price;
            $discount = ($item->origin_price - $item->last_price) * 100 / $item->origin_price;
            $record_item['discount'] = round($discount, 0);

            $array_item[] = $record_item;
        }

        OrderItem::insert($array_item);
    }
}
