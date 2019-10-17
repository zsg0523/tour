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
    protected $title = 'App\Models\Animal';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Animal);

        $grid->column('id', __('Id'));
        // $grid->column('video_id', __('Video id'));
        // $grid->column('product_series_id', __('Product series id'));
        $grid->column('product_name', __('Product name'));
        $grid->column('image_family', __('Image family'));
        $grid->column('image', __('Image'))->image();
        $grid->column('code', __('Code'));
        $grid->column('image_endangeredLevel', __('Image endangeredLevel'));
        // $grid->column('icon_diet', __('Icon diet'));
        // $grid->column('background', __('Background'));
        // $grid->column('back_button', __('Back button'));
        // $grid->column('sound_animal', __('Sound animal'));
        // $grid->column('background_bar', __('Background bar'));
        // $grid->column('youtube_url', __('Youtube url'));
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
        $show = new Show(Animal::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('video_id', __('Video id'));
        $show->field('product_series_id', __('Product series id'));
        $show->field('product_name', __('Product name'));
        $show->field('image_family', __('Image family'));
        $show->field('image', __('Image'));
        $show->field('code', __('Code'));
        $show->field('image_endangeredLevel', __('Image endangeredLevel'));
        $show->field('icon_diet', __('Icon diet'));
        $show->field('background', __('Background'));
        $show->field('back_button', __('Back button'));
        $show->field('sound_animal', __('Sound animal'));
        $show->field('background_bar', __('Background bar'));
        $show->field('youtube_url', __('Youtube url'));
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

        $form->number('video_id', __('Video id'));
        $form->number('product_series_id', __('Product series id'));
        $form->text('product_name', __('Product name'));
        $form->text('image_family', __('Image family'));
        $form->image('image', __('Image'));
        $form->text('code', __('Code'));
        $form->text('image_endangeredLevel', __('Image endangeredLevel'));
        $form->text('icon_diet', __('Icon diet'));
        $form->text('background', __('Background'));
        $form->text('back_button', __('Back button'));
        $form->text('sound_animal', __('Sound animal'));
        $form->text('background_bar', __('Background bar'));
        $form->text('youtube_url', __('Youtube url'));

        return $form;
    }
}
