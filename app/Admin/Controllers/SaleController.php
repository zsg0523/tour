<?php

namespace App\Admin\Controllers;

use App\Models\Sale;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SaleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sales';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Sale());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('lang', __('Lang'));
        $grid->column('background', __('Background'))->image(env('APP_URL') . '/uploads/' , 150, 75);
        $grid->column('color', __('Color'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        // 主题是否打开，默认true（on），false(off)
        $grid->column('is_show')->switch($states);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Sale::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('background', __('Background'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('is_show', __('Is show'));
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
        $form = new Form(new Sale());
        $form->radio('lang')->options(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW'])->default('en');
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->image('background', __('Background'));
        $form->color('color', __('Color'));
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $form->switch('is_show')->states($states)->default(0);

        return $form;
    }
}
