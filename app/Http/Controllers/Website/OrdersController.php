<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\UserAddress;
use App\Services\OrderService;
use App\Exceptions\InvalidRequestException;
use Carbon\Carbon;
use App\Http\Requests\SendReviewRequest;
use App\Events\OrderReviewed;

class OrdersController extends Controller
{
    /** [store 创建订单] */
     public function store(Request $request, OrderService $orderService)
    {
        $user    = $request->user();
        
        // $address = UserAddress::find($request->input('address_id'));

        return $orderService->store($user, $address, $request->input('remark'), $request->input('items'));
    }
}
