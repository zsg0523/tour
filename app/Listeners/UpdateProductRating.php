<?php

namespace App\Listeners;

use DB;
use App\Models\OrderItem;
use App\Events\OrderReviewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProductRating implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OrderReviewed  $event
     * @return void
     */
    public function handle(OrderReviewed $event)
    {
        // 通过 with 方法提前加载数据，避免 N + 1 性能问题
        $items = $event->getOrder()->items()->with(['shopProduct'])->get();
        foreach ($items as $item) {
            $result = OrderItem::query()
                ->where('shop_product_id', $item->shop_product_id)
                ->whereNotNull('reviewed_at')
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('paid_at');
                })
                ->first([
                    DB::raw('count(*) as review_count'),
                    DB::raw('avg(rating) as rating')
                ]);
            // 更新商品的评分和评价数
            $item->shopProduct->update([
                'rating'       => $result->rating,
                'review_count' => $result->review_count,
            ]);
        }
    }
}