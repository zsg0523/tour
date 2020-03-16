<?php

namespace App\Admin\Controllers;

use App\Models\News;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;


class NewsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'News';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new News);

        $grid->column('id', __('Id'));
        $grid->column('lang', __('Lang'));
        $grid->column('title', __('Title'));
        $grid->column('cover', __('Cover'))->image(env('APP_UTL') . '/uploads', 30, 30);
        $grid->column('introduction', __('Introduction'))->limit(30);
        $grid->column('content', __('Content'))->limit(30);
        // $grid->column('is_push', __('Recommend'))->switch();
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
        $show = new Show(News::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('lang', __('Lang'));
        $show->field('title', __('Title'));
        $show->field('cover', __('Cover'));
        $show->field('introduction', __('Introduction'));
        $show->field('content', __('Content'));
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
        $form = new Form(new News);

        $form->radio('lang')->options(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW'])->default('en');
        $form->text('title', __('Title'));
        $form->image('cover', __('Cover'))->help('不能超过 100M');
        $form->textarea('introduction', __('Introduction'));
        // $form->switch('is_push', __('Recommend'));
        $form->editor('content');

        return $form;
    }
}
