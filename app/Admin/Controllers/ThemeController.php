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
        $grid->column('product_name', __('Product name'))->filter('like');
        // $grid->column('image', __('Image'));
        $grid->column('code', __('Code'))->filter('like');
        $grid->column('background', __('Background'));
        $grid->column('back_button', __('Back button'));
        $grid->column('product_type', __('Product type'));
        $grid->column('product_series_id', __('Product series id'));
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
        $form->image('image', __('Image'));
        $form->text('code', __('Code'));
        $form->text('background', __('Background'));
        $form->text('back_button', __('Back button'));
        $form->text('product_type', __('Product type'))->default('wenno');
        $form->number('product_series_id', __('Product series id'))->default(1);

        return $form;
    }
}
