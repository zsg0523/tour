<?php

namespace App\Admin\Controllers;

use App\Models\{ThemesTranslation, Theme};
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;

class ThemesTransController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ThemesTranslation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ThemesTranslation);

        $grid->column('id', __('Id'));
        $grid->column('theme_id', __('Theme'))->display(function($theme_id) {
             $theme = Theme::find($theme_id);
             return $theme ? $theme->product_name : '';
        });
        $grid->column('lang', __('Lang'));
        $grid->column('title_page', __('Title page'));
        $grid->column('q1', __('Q1'));
        $grid->column('a1', __('A1'));
        $grid->column('q2', __('Q2'));
        $grid->column('a2', __('A2'));
        $grid->column('q3', __('Q3'));
        $grid->column('a3', __('A3'));
        $grid->column('q4', __('Q4'));
        $grid->column('a4', __('A4'));
        $grid->column('q5', __('Q5'));
        $grid->column('a5', __('A5'));
        $grid->column('q6', __('Q6'));
        $grid->column('a6', __('A6'));
        $grid->column('title_fun_fact', __('Title fun fact'));
        $grid->column('fun_fact', __('Fun fact'));
        $grid->fixColumns(1, -1);
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
        $show = new Show(ThemesTranslation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('theme_id', __('Theme id'));
        $show->field('lang', __('Lang'));
        $show->field('title_page', __('Title page'));
        $show->field('q1', __('Q1'));
        $show->field('a1', __('A1'));
        $show->field('q2', __('Q2'));
        $show->field('a2', __('A2'));
        $show->field('q3', __('Q3'));
        $show->field('a3', __('A3'));
        $show->field('q4', __('Q4'));
        $show->field('a4', __('A4'));
        $show->field('q5', __('Q5'));
        $show->field('a5', __('A5'));
        $show->field('q6', __('Q6'));
        $show->field('a6', __('A6'));
        $show->field('title_fun_fact', __('Title fun fact'));
        $show->field('fun_fact', __('Fun fact'));
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
        $form = new Form(new ThemesTranslation);

        $form->number('theme_id', __('Theme id'));
        $form->text('lang', __('Lang'));
        $form->text('title_page', __('Title page'));
        $form->text('q1', __('Q1'));
        $form->text('a1', __('A1'));
        $form->text('q2', __('Q2'));
        $form->text('a2', __('A2'));
        $form->text('q3', __('Q3'));
        $form->text('a3', __('A3'));
        $form->text('q4', __('Q4'));
        $form->text('a4', __('A4'));
        $form->text('q5', __('Q5'));
        $form->text('a5', __('A5'));
        $form->text('q6', __('Q6'));
        $form->text('a6', __('A6'));
        $form->text('title_fun_fact', __('Title fun fact'));
        $form->text('fun_fact', __('Fun fact'));

        return $form;
    }
}
