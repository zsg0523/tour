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
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $grid->column('is_show', __('Is_show'))->switch($states);
        $grid->column('lang', __('Lang'))->filter()->label();
        $grid->column('question', __('Question'))->display(function($question){
            return "<span style='color:green'>$question</span>";
        })->filter();
        $grid->column('answer')->label('default');
        $grid->column('true', __('True'))->sortable()->label();
        $grid->column('false', __('False'))->sortable()->label('info');
        $grid->column('total', __('Tatal'))->sortable()->label('success');
        
        $grid->disableActions();
        $grid->disableExport(false);
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
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $form->switch('is_show')->states($states)->default(1);
        $form->text('lang', __('Lang'));
        $form->textarea('question', __('Question'));
        $form->text('answer');
        $form->number('true', __('True'));
        $form->number('false', __('False'));

        return $form;
    }
}
