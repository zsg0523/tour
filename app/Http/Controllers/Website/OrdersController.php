<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use App\Services\OrderService;
use App\Exceptions\InvalidRequestException;
use Carbon\Carbon;
use App\Http\Requests\SendReviewRequest;
use App\Events\OrderReviewed;
use App\Models\ShopProductSku;
use App\Jobs\CloseOrder;

class OrdersController extends Controller
{
    /** [store 创建订单] */
    public function store(Request $request, OrderService $orderService)
    {
        $user = $request->user();
        
        $address = UserAddress::find($request->input('address_id'));

        return $orderService->store($user, $address, $request->input('remark'), json_decode($request->input('items'), true));
    }

    /** [storeAsGuest 游客创建订单] */
    public function storeAsGuest(Request $request, OrderService $orderService)
    {
    	// 游客账号
    	$user = User::find(58);
    	// 收货地址信息
    	$address = json_decode($request->input('address'), true);
    	// 商品信息
    	$items = json_decode($request->input('items'), true);

    	return $orderService->storeByGuest($user, $address, $request->input('remark'), $items);
    }
}
