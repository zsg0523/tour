<?php

namespace App\Admin\Controllers;

use App\Models\Animal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnimalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Animals';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Animal);

        $grid->column('id', __('Id'));
        $grid->column('product_name', __('Product name'))->filter('like');
        $grid->column('image_family', __('Image family'))->filter('like');
        $grid->column('code', __('Code'))->filter('like');
        $grid->column('image_endangeredLevel', __('Image endangeredLevel'));        
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();
        $grid->actions(function (Grid\Displayers\Actions $actions){
            $actions->disableView(false);
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
        $show = new Show(Animal::findOrFail($id));

        $show->field('id', __('Id'));
        
        $show->field('product_name', __('Product name'));
        $show->field('image_family', __('Image family'));
        $show->field('image', __('Image'))->image(env('APP_URL') . '/uploads/', 200, 200);
        $show->field('code', __('Code'));
        $show->field('image_endangeredLevel', __('Image endangeredLevel'));
        
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
        $form = new Form(new Animal);

        $form->text('product_name', __('Product name'));
        $form->text('image_family', __('Image family'));
        $form->image('image', __('Image'))->move('animals/original')->removable();
        $form->text('code', __('Code'));
        $form->text('image_endangeredLevel', __('Image endangeredLevel'));

        return $form;
    }
}
