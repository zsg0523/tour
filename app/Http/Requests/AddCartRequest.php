<?php

namespace App\Http\Requests;

use App\Models\ShopProduct;

class AddCartRequest extends Request
{
    public function rules()
    {
        return [
            'shop_product_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!$product = ShopProduct::find($value)) {
                        return $fail('该商品不存在');
                    }
                    if (!$product->on_sale) {
                        return $fail('该商品未上架');
                    }
                },
            ],
            'amount' => ['required', 'integer', 'min:1'],
        ];
    }

    public function attributes()
    {
        return [
            'amount' => '商品数量'
        ];
    }

    public function messages()
    {
        return [
            'sku_id.required' => '请选择商品'
        ];
    }
}
