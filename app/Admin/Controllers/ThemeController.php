<?php

namespace App\Admin\Controllers;

use App\Models\Theme;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;


class ThemeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Themes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Theme);

        $grid->column('id', __('Id'))->sortable();
        $grid->column('product_name', __('Theme'))->filter('like')->copyable();
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        // 主题是否打开，默认true（on），false(off)
        $grid->column('is_show')->switch($states);
        $grid->column('order')->editable()->sortable();
        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
            $actions->disableView();
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
        $show = new Show(Theme::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_name', __('Product name'));
        $show->field('image', __('Image'));
        $show->field('code', __('Code'));
        $show->field('background', __('Background'));
        $show->field('back_button', __('Back button'));
        $show->field('product_type', __('Product type'));
        $show->field('product_series_id', __('Product series id'));
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
        $form = new Form(new Theme);

        $form->text('product_name', __('Product name'));
        $form->text('order', __('Order'))->default(1);
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $form->switch('is_show')->states($states)->default(1);
        return $form;
    }
}
