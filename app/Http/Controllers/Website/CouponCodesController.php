<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\CouponCode;
use Carbon\Carbon;

class CouponCodesController extends Controller
{
    public function show($code)
    {
        // 判断优惠券是否存在
        if (!$record = CouponCode::where('code', $code)->first()) {
            abort(404);
        }

        // 如果优惠券没有启用，则等同于优惠券不存在
        if (!$record->enabled) {
            abort(404);
        }

        if ($record->total - $record->used <= 0) {
            return $this->response->array(['message' => '该优惠券已被兑完', 'status_code' => 403]);
        }

        if ($record->not_before && $record->not_before->gt(Carbon::now())) {
            return $this->response->array(['message' => '该优惠券现在还不能使用', 'status_code' => 403]);
        }

        if ($record->not_after && $record->not_after->lt(Carbon::now())) {
            return $this->response->array(['message' => '该优惠券已过期', 'status_code' => 403]);
        }

        return $record;
    }
}
