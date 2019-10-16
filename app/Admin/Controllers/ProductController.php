<?php

namespace App\Admin\Controllers;

use App\Models\{Product, Category, Attribute};
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use App\Admin\Actions\Post\Replicate;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->column('id', __('Id'));
        $grid->column('category_id', __('Category'))->display(function($category_id){
            $category = Category::find($category_id);
            return $category ? $category->title : '';
        })->filter('like');
        // $grid->column('cover', __('Cover'))->image(env('APP_URL').'/uploads', 30, 30);
        // $grid->column('image', __('Image'))->image(env('APP_URL').'/uploads', 30, 30);
        $grid->column('type', __('Type'))->using([10 => '单品', 20 => '套装'])->label()->filter([10=>'单品', 20=>'套装']);
        $grid->column('attributes')->display(function ($model){
            return array_column($model, 'content');
        })->label();
        $grid->column('name', __('Name'));
        $grid->column('code', __('Code'));
        $grid->column('local', __('Local'));
        $grid->column('case', __('Case'));
        $grid->column('size', __('Size'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->fixColumns(3, -2);
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'));
        $show->field('type', __('Type'));
        $show->field('cover', __('Cover'))->image();
        $show->field('image', __('Image'))->image();
        $show->field('name', __('Name'));
        $show->field('code', __('Code'));
        $show->field('local', __('Local'));
        $show->field('case', __('Case'));
        $show->field('size', __('Size'));
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
        $form = new Form(new Product);

        $form->select('category_id', __('Category'))->options('/api/admin/categories');
        $form->radio('type', __('Type'))->options([10 => '单品', 20=> '套装'])->default(10);
        $form->listbox('attributes')->options(Attribute::all()->pluck('content', 'id'));
        $form->image('cover', __('Cover'));
        $form->image('image', __('Image'));
        $form->text('name', __('Name'));
        $form->text('code', __('Code'));
        $form->text('local', __('Local'));
        $form->text('case', __('Case'));
        $form->text('size', __('Size'));

        return $form;
    }
}
