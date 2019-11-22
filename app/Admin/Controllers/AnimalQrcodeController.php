<?php

namespace App\Admin\Controllers;

use App\Models\AnimalQrcode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnimalQrcodeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Animals Qrcode';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AnimalQrcode);

        $grid->column('id', __('Id'));
        $grid->column('product_name', __('Product name'))->filter()->label()->copyable();
        $grid->column('lang', __('Lang'))->filter()->label('info');
        $grid->column('url', __('Url'))->copyable();
        $grid->column('qrcode', __('Qrcode'))->image();
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableFilter(false);
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('product_name', 'Product Name');
            $filter->equal('lang');
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
        $show = new Show(AnimalQrcode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_name', __('Product name'));
        $show->field('lang', __('Lang'));
        $show->field('url', __('Url'));
        $show->field('qrcode', __('Qrcode'));
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
        $form = new Form(new AnimalQrcode);

        $form->text('product_name', __('Product name'));
        $form->text('lang', __('Lang'));
        $form->url('url', __('Url'));
        $form->text('qrcode', __('Qrcode'));

        return $form;
    }
}
