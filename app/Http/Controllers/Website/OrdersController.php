<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use App\Services\OrderService;
use App\Transformers\OrderTransformer;
use App\Exceptions\CouponCodeUnavailableException;
use App\Models\CouponCode;

class OrdersController extends Controller
{
	/** [index 当前会员订单列表] */
	public function index(Request $request, Order $order)
	{
		return $this->response->collection($this->user()->orders, new OrderTransformer());
	}
    /** [show 订单详情] */
	public function show(Order $order)
	{
		return $this->response->item($order, new OrderTransformer());
	}

    /** [store 创建订单] */
    public function store(Request $request, OrderService $orderService)
    {

        $user = $request->user();
        
        $address = UserAddress::find($request->input('address_id'));

        $coupon = null;

        if (! $address) {
            abort(403, '收货地址不存在');
        }

        // 如果用户提交了优惠码
        if ($code = $request->coupon_code) {
            $coupon = CouponCode::where('code', $code)->first();
            if (! $coupon) {
                throw new CouponCodeUnavailableException("优惠券不存在");
                
            }
        }
        
        return $orderService->store($user, $address, $request->input('remark'), json_decode($request->input('items'), true), $coupon);
    }

    /** [storeAsGuest 游客创建订单] */
    public function storeAsGuest(Request $request, OrderService $orderService)
    {
        // 验证是否有效邮箱
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
        ]);
    	// 游客账号
    	$user = User::find(1);
    	// 收货地址信息
    	$address = json_decode($request->input('address'), true);
    	// 商品信息
    	$items = json_decode($request->input('items'), true);

    	return $orderService->storeByGuest($user, $address, $request->input('remark'), $items, $request->input('email'));
    }
}
