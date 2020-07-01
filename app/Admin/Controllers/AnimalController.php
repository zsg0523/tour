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
        $animals = Animal::all();
        foreach ($animals as $animal) {
            $animal->update(['cover' => '']);
        }
        $grid->column('id', __('Id'))->sortable()->filter();
        $grid->column('product_name', __('Product name'))->copyable()->filter();
        $grid->column('code', __('Code'))->filter('like')->copyable();
        $grid->column('cover', __('Cover'))->image(env('APP_URL') . '/uploads/', 150, 75);
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
        $show->field('cover', __('Cover'))->image(env('APP_URL') . '/uploads/', 150, 75);
        $show->field('image', __('Image'))->image(env('APP_URL') . '/uploads/', 150, 75);
        $show->field('code', __('Code'));
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

        $form->hidden('product_series_id')->default(1);
        $form->text('product_name', __('Product name'));
        $form->image('cover', __('Cover'))->removable();
        $form->image('image', __('Image'))
             ->removable()
             ->thumbnail('thumbnail', $width = 300, $height = 150)->move('animals/original');
        $form->text('code', __('Code'));

        return $form;
    }
}
