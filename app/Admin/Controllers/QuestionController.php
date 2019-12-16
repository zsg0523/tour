<?php

namespace App\Admin\Controllers;

use App\Models\Question;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QuestionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Question';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Question);

        $grid->column('id', __('Id'));
        $grid->column('code', __('Code'))->filter();
        $grid->column('lang', __('Lang'))->filter()->label();
        $grid->column('question', __('Question'))->display(function($question){
            return "<span style='color:green'>$question</span>";
        })->filter();
        $grid->column('true', __('True'))->sortable()->label();
        $grid->column('false', __('False'))->sortable()->label('info');
        
        $grid->disableActions();

        $grid->disableCreateButton();
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
        $show = new Show(Question::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('code', __('Code'));
        $show->field('lang', __('Lang'));
        $show->field('question', __('Question'));
        $show->field('true', __('True'));
        $show->field('false', __('False'));
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
        $form = new Form(new Question);

        $form->number('code', __('Code'));
        $form->text('lang', __('Lang'));
        $form->textarea('question', __('Question'));
        $form->number('true', __('True'));
        $form->number('false', __('False'));

        return $form;
    }
}
