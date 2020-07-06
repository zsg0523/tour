<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShopProduct;
use Carbon\Carbon;


class ProductSalesOn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:sales-on';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '上架促销商品';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ShopProduct::query()
                // 已经上架的商品
                ->where('on_sale', '1')
                ->get()
                ->each(function (ShopProduct $shopProduct) {
                    if ($shopProduct->not_before <= Carbon::now() && $shopProduct->not_after >= Carbon::now()) {
                        // 上架促销产品
                        $shopProduct->update(['sales' => 1]);
                    } else {
                        // 下架促销产品
                        $shopProduct->update(['sales' => 0]);
                    }
                            
                });
    }

}
