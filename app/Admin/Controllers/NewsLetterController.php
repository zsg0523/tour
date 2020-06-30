<?php

namespace App\Admin\Controllers;

use App\Models\NewsLetter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\SendEmail;
use App\Admin\Actions\Post\BatchSendEmail;

class NewsLetterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'NewsLetter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NewsLetter());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('email', __('Email'))->filter();
        // $grid->column('sent_coupon_at', __('Sent coupon at'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();
        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->add(new SendEmail);
            // $actions->disableDelete();
        });
        $grid->batchActions(function ($batch) {
            $batch->add(new BatchSendEmail());
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
        $show = new Show(NewsLetter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        // $show->field('sent_coupon_at', __('Sent coupon at'));
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
        $form = new Form(new NewsLetter());

        $form->email('email', __('Email'));
        // $form->datetime('sent_coupon_at', __('Sent coupon at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
