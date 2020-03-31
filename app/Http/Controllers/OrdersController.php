<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Exceptions\InvalidRequestException;
use Carbon\Carbon;
use App\Http\Requests\SendReviewRequest;
use App\Events\OrderReviewed;

class OrdersController extends Controller
{
    /** [index 订单列表] */
    public function index(Request $request)
    {
        $orders = Order::query()
            // 使用 with 方法预加载，避免N + 1问 题
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
        $order_array = $order->toArray();
        $address_info = $order_array['address'];
        
        return view('orders.show', ['order' => $order->load(['items.shopProductSku', 'items.shopProduct']), 'address_info' => $address_info]);
    }

    public function received(Order $order, Request $request)
    {
        // 判断订单的发货状态是否为已发货
        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            throw new InvalidRequestException('发货状态不正确');
        }

        // 更新发货状态为已收到
        $order->update(['ship_status' => Order::SHIP_STATUS_RECEIVED]);

        // 返回原页面
        return $order;
    }

    /** [review 订单评价] */
    public function review(Order $order)
    {
        // 校验权限
        $this->authorize('own', $order);

        // 判断订单是否已经支付
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付，不可评价');
        }

        // 使用load 方法加载数据，避免n+1问题
        return view('orders.review', ['order' => $order->load(['items.shopProductSku', 'items.shopProduct'])]);

    }

    /** [sendReview 提交评价] */
    public function sendReview(Order $order, SendReviewRequest $request)
    {
        // 校验权限
        $this->authorize('own', $order);
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付，不可评价');
        }

        // 判断是否已经评价
        if ($order->reviewed) {
            throw new InvalidRequestException('该订单已评价，不可重复提交');
        }

        $reviews = $request->input('reviews');

        \DB::transaction(function () use ($reviews, $order) {
            // 遍历用户提交的数据
            foreach ($reviews as $review) {
                $orderItem = $order->items()->find($review['id']);
                // 保存评分和评价
                $orderItem->update([
                    'rating'      => $review['rating'],
                    'review'      => $review['review'],
                    'reviewed_at' => Carbon::now(),
                ]);
            }
            // 将订单标记为已评价
            $order->update(['reviewed' => true]);
            
            // 触发更新商品评分和统计评论数量事件
            event(new OrderReviewed($order));
        });

        return redirect()->back();

    }













}
