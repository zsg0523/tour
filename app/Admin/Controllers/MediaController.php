<?php

namespace App\Admin\Controllers;

use App\Models\Media;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MediaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Media';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Media);

        $grid->column('id', __('Id'));
        $grid->column('media', __('Media'))->display(function($media){
            switch ($this->type) {
                case '1':
                    $media = env('APP_URL') . '/uploads/' . $media;
                    return "<video src=$media controls='controls' width='300' height='180'></video>";
                    break;
                
                default:
                    $media = env('APP_URL') . '/uploads/' . $media;
                    return "<image src=$media width='200' height='200'></image>";
                    break;
            }
        });
        $grid->column('type', __('Type'))->using(['1' => 'video', '2' => 'image'])->label()->filter([1 => 'video', 2 => 'image']);

        $grid->column('location', __('Location'))
             ->using(['10' => 'Home-Sideshow', '20' => 'Home-Video', '30'=> 'Product-Sideshow'])
             ->label()
             ->filter(['10' => 'Home-Sideshow', '20' => 'Home-Video', '30'=> 'Product-Sideshow']);

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
        $show = new Show(Media::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('media', __('media'));
        $show->field('type', __('Type'));
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
        $form = new Form(new Media);

        $form->file('media', __('Media'));
        $file = [
            '1' => 'vedio',
            '2' => 'image'
        ];
        $form->radio('type', __('Type'))->options($file)->default(2);

        $location = [
            '10' => 'Home-Sideshow',
            '20' => 'Home-Video',
            '30' => 'Product-Sideshow'
        ];
        $form->radio('location', __('Location'))->options($location);

        $form->footer(function ($footer) {

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });

        return $form;
    }
}
