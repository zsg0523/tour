<?php

namespace App\Admin\Controllers;

use App\Models\Button;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ButtonController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Button';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Button());

        $grid->column('id', __('Id'));
        $grid->column('banner_id', __('Banner id'));
        $grid->column('link', __('Link'));
        $grid->column('name', __('Name'));
        $grid->column('icon', __('Icon'));
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $grid->column('is_show', __('Is_show'))->switch($states);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Button());

        $form->url('link', __('Link'));
        $form->text('name', __('Name'));
        $form->image('icon', __('Icon'));
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $form->switch('is_show')->states($states)->default(1);

        return $form;
    }
}
