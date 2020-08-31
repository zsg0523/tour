<?php

namespace App\Admin\Controllers;

use App\Models\ShopProduct;
use App\Models\ShopCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;

class ShopProductsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopProduct';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopProduct);
        $grid = new Grid(new ShopProduct);

        $grid->column('id', __('ID'))->sortable();
    
        $grid->column('status', __('Order'))->sortable()->editable()->help('数字越大排序靠前');

        $grid->column('lang', __('Lang'))->filter(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW']);
        // Laravel-Admin 支持用符号 . 来展示关联关系的字段
        $grid->column('shopCategory.name', 'Category');
        $grid->column('line', 'Line')->using([10=>'Land', 20=> 'Ocean',30=>'Prehistoric'])->filter([10=>'Land', 20=> 'Ocean',30=>'Prehistoric'])->label();
        $grid->column('title', __('Title'));
        $grid->column('price', __('Price'));
        $grid->column('rebate', __('Rebate'));
        $grid->column('sales_price', __('Sales Price'));
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'default'],
        ];
        // 商品是否上架，默认true（on），false(off)
        $grid->column('on_sale', __('On sale'))->switch($states)->help('商品是否上架');
        $grid->column('sales', __('Sales'))->switch($states)->help('促销商品');
        $grid->column('not_before', __('上架时间'))->help('上架时间');
        $grid->column('not_after', __('下架时间'))->help('下架时间');
        $grid->column('created_at', __('Created at'));
        $grid->fixColumns(3, -3);
        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
        });

        $grid->model()->orderBy('created_at', 'desc');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ShopProduct::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('lang', __('Lang'));
        $show->field('title', __('Title'));
        $show->field('price', __('Price'));
        $show->field('image', __('Image'))->image();
        $show->field('rating', __('Rating'));
        $show->field('sold_count', __('Sold count'));
        $show->field('review_count', __('Review count'));
        $show->field('on_sale', __('On sale'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ShopProduct);
        // 语言
        $form->radio('lang')->options(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW'])->default('en');
        // 产品线
        $form->radio('line',__('产品线'))->options(['10'=>'Land', '20'=>'Ocean', '30'=>'Prehistoric'])->default('10');
        $form->text('status',__('排序'))->default(0);
        $form->select('shop_category_id', '类目')->options(function ($id) {
            $category = ShopCategory::find($id);
                if ($category) {
                    return [$category->id => $category->full_name];
                }
        })->ajax('/api/admin/shop-categories')->rules('required');
        //  创建一个输入框
        $form->text('title', __('商品名称'))->rules('required');
        
        // 正价
        $form->text('price', '单价')->rules('required|numeric|min:0.01');
        // 折扣
        $form->text('rebate', '折扣');
        // 折扣价
        $form->text('sales_price', '折后价')->rules('required|numeric|min:0.01');
        // 创建一个选择图片框
        $form->image('image', __('商品图片'))->rules('required|image')->removable();
       
        // 创建一个富文本编辑器
        $form->editor('description', __('描述'))->rules('required');
        $states = [
            'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'default'],
        ];
        $form->switch('on_sale')->states($states)->default(1);
        $form->switch('sales')->states($states)->default(1);
        $form->datetime('not_before', '开始时间');
        $form->datetime('not_after', '结束时间');


        return $form;
    }
}
