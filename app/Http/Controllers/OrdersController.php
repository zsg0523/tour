<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrdersController extends Controller
{
    /** [index 订单列表] */
    public function index(Request $request)
    {
        $orders = Order::query()
            // 使用 with 方法预加载，避免N + 1问题
            ->with(['items.shopProduct', 'items.shopProductSku']) 
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('orders.index', ['orders' => $orders]);
    }

    /** [store 创建订单] */
     public function store(OrderRequest $request, OrderService $orderService)
    {
        $user    = $request->user();
        $address = UserAddress::find($request->input('address_id'));

        return $orderService->store($user, $address, $request->input('remark'), $request->input('items'));
    }

    /** [show 订单详情] */
    public function show(Order $order, Request $request)
    {
        $this->authorize('own', $order);
        
        return view('orders.show', ['order' => $order->load(['items.shopProductSku', 'items.shopProduct'])]);
    }



}
