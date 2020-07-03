<?php

use Illuminate\Database\Seeder;
use App\Models\ShopProduct;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 创建30个商品
        $products = factory(\App\Models\ShopProduct::class, 30)->create();

        // foreach ($products as $product) {
        // 	// 创建 3 个sku, 并且每个 sku 的 'shop_product_id' 字段都为当前循环商品id
        // 	$skus = factory(\App\Models\ShopProductSku::class, 3)->create(['shop_product_id'=>$product->id]);
        // 	// 找出最低价格的sku,设置为商品的价格
        // 	$product->update(['price' => $skus->min('price')]);
        // }


        // 单独处理第一个商品及SKU的数据
        $product = ShopProduct::find(1);
        $product->price = 1;
        $product->title = 'test商品';
        // 处理sku价格
        // foreach ($product->skus as $sku) {
        //     $sku->price = 1;
        //     $sku->save();
        // }
        $product->save();
    }
}
