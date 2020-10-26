<?php

namespace App\Admin\Controllers;

use App\Models\Media;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;

class ThreeDModelsController extends AdminController
{
    /**
     * Title for current resource
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

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Title'));
        $grid->column('media', __('File'));
        $grid->column('type', __('Type'))->using(['3' => 'obj', '4' => 'jpg', '5' => 'bytes'])->label()->filter(['3' => 'obj', '4' => 'jpg', '5' => 'bytes']);

        $grid->column('location', __('Location'))
             ->using(['10' => 'Home-Sideshow', '20' => 'Home-Video', '30'=> 'Product-Sideshow', '40' => '3D Model'])
             ->label()
             ->filter(['10' => 'Home-Sideshow', '20' => 'Home-Video', '30'=> 'Product-Sideshow', '40' => '3D Model']);

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->model()->wherein('type', [3,4,5]);

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
        $show = new Show(Media::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
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

        $form->hidden('lang')->default('en');

        $form->text('title', __('Title'));

        $form->file('media', __('File'));

        $file = [
            '3' => 'obj',
            '4' => 'jpg',
            '5' => 'bytes'
        ];
        $form->radio('type', __('Type'))->options($file)->default(1);

        $form->hidden('location')->default(40);

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
