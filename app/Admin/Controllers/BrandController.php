<?php

namespace App\Admin\Controllers;

use App\Models\Brand;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;

class BrandController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Brand';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Brand);

        $grid->column('id', __('Id'));
        $grid->column('lang', __('Lang'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'))->width(500);
        $grid->column('image', __('Image'))->image(env('APP_URL').'/uploads', 100, 100);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
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
        $show = new Show(Brand::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('lang', __('Lang'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('image', __('Image'))->image();
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
        $form = new Form(new Brand);
        $form->radio('lang')->options(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW'])->default('en');
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->image('image', __('Image'));

        return $form;
    }
}
