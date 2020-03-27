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

        $grid->column('id', __('Id'))->sortable();

        $grid->column('lang', __('Lang'))->filter();

        $grid->column('theme_id', __('Theme_id : Theme'))->display(function($theme_id) {
             $theme = Theme::find($theme_id);
             return $theme ? $theme_id . ' : ' . $theme->product_name : '';
        });
        
        $grid->column('title_page', __('Theme name'))->filter('like')->copyable()->help('对应animals translation里的 theme name');

        $grid->fixColumns(3, -3);

        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
            $actions->disableView();
        });

        $grid->disableFilter(false);

        $grid->filter(function ($filter){
            $filter->expand();
            $filter->where(function ($query) {
                $query->whereHas('theme', function ($query) {
                    $query->where('product_name', 'like', "%{$this->input}%");
                });
            }, 'Theme');
            $filter->like('title_page', 'Theme Name');
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

        $form->select('theme_id', __('Theme'))->options(function ($id){
            $theme = Theme::find($id);

            if ($theme) {
                return [$theme->id => $theme->product_name];
            }
        })->ajax('/api/admin/themes');
        $form->text('lang', __('Lang'))->default('en');
        $form->text('title_page', __('Theme Name'));
        // $form->text('title_fun_fact', __('Title fun fact'));
        // $form->text('fun_fact', __('Fun fact'));

        return $form;
    }
}
