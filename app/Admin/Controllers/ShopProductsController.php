<?php

namespace App\Admin\Controllers;

use App\Models\ShopProduct;
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

        $grid->column('id', __('ID'))->sortable();
        $grid->column('lang', __('Lang'))->filter(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW']);
        $grid->column('title', __('Title'));
        // $grid->column('description', __('Description'));
        $grid->column('image', __('Image'))->image(env('APP_URL').'/uploads', 30, 30);
        $grid->column('on_sale', __('On sale'))->display(function ($value){
            return $value ? 'Yes' : 'No';
        });
        $grid->column('price', __('Price'));
        $grid->column('rating', __('Rating'));
        $grid->column('sold_count', __('Sold count'));
        $grid->column('review_count', __('Review count'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->fixColumns(3, -3);
        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
        });

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
        $show->field('description', __('Description'))->homepage()->link();
        $show->field('image', __('Image'))->image();
        $show->field('on_sale', __('On sale'));
        $show->field('rating', __('Rating'));
        $show->field('sold_count', __('Sold count'));
        $show->field('review_count', __('Review count'));
        $show->field('price', __('Price'));
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

        $form->tab('SKU INFO', function ($form) {
            // 直接添加一对多的关联模型
            $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form) {
                $form->text('title', 'SKU 名称')->rules('required');
                $form->text('description', 'SKU 描述')->rules('required');
                $form->text('price', '单价')->rules('required|numeric|min:0.01');
                $form->text('stock', '剩余库存')->rules('required|integer|min:0');
            });
        })->tab('BASIC INFO', function($form) {
            $form->radio('lang')->options(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW'])->default('en');
            //  创建一个输入框
            $form->text('title', __('商品名称'))->rules('required');
            // 创建一个选择图片框
            $form->image('image', __('商品图片'))->rules('required|image');
           
            // 创建一个富文本编辑器
            $form->editor('description', __('描述'));
            // 创建一组单选按钮
            $form->radio('on_sale', __('是否上架'))->options(['1' => '是', '0'=> '否'])->default('0');
        });

        // 定义事件回调，当模型即将保存时出发这个回调
        $form->saving(function (Form $form){
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?:0;
        });


        return $form;
    }
}
