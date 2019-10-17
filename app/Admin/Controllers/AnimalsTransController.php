<?php

namespace App\Admin\Controllers;

use App\Models\AnimalTranslation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;
use App\Admin\Actions\Post\ImportPost;

class AnimalsTransController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AnimalTranslation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AnimalTranslation);

        $grid->column('id', __('Id'));
        // $grid->column('animal_id', __('Animal id'));
        // $grid->column('sound_id', __('Sound id'));
        $grid->column('lang', __('Lang'))->filter();
        $grid->column('view', __('View'));
        $grid->column('title', __('Title'));
        $grid->column('genus', __('Genus'));
        $grid->column('family', __('Family'));
        $grid->column('habitat', __('Habitat'));
        $grid->column('location', __('Location'));
        $grid->column('title_classification', __('Title classification'));
        $grid->column('classification', __('Classification'));
        $grid->column('title_lifespan', __('Title lifespan'));
        $grid->column('lifespan', __('Lifespan'));
        $grid->column('title_diet', __('Title diet'));
        $grid->column('diet', __('Diet'));
        $grid->column('weight', __('Weight'));
        $grid->column('speed', __('Speed'));
        $grid->column('animal_height', __('Animal height'));
        $grid->column('title_fun_tips', __('Title fun tips'));
        $grid->column('fun_tips', __('Fun tips'));
        $grid->column('endangered_level', __('Endangered level'));
        $grid->column('theme_name', __('Theme name'));
        $grid->column('group_name', __('Group name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
        });
        $grid->disableExport(false);

        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportPost());
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
        $show = new Show(AnimalTranslation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('animal_id', __('Animal id'));
        $show->field('sound_id', __('Sound id'));
        $show->field('lang', __('Lang'));
        $show->field('view', __('View'));
        $show->field('title', __('Title'));
        $show->field('genus', __('Genus'));
        $show->field('family', __('Family'));
        $show->field('habitat', __('Habitat'));
        $show->field('location', __('Location'));
        $show->field('title_classification', __('Title classification'));
        $show->field('classification', __('Classification'));
        $show->field('title_lifespan', __('Title lifespan'));
        $show->field('lifespan', __('Lifespan'));
        $show->field('title_diet', __('Title diet'));
        $show->field('diet', __('Diet'));
        $show->field('weight', __('Weight'));
        $show->field('speed', __('Speed'));
        $show->field('animal_height', __('Animal height'));
        $show->field('title_fun_tips', __('Title fun tips'));
        $show->field('fun_tips', __('Fun tips'));
        $show->field('endangered_level', __('Endangered level'));
        $show->field('theme_name', __('Theme name'));
        $show->field('group_name', __('Group name'));
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
        $form = new Form(new AnimalTranslation);

        $form->number('animal_id', __('Animal id'));
        $form->number('sound_id', __('Sound id'));
        $form->text('lang', __('Lang'));
        $form->number('view', __('View'));
        $form->text('title', __('Title'));
        $form->text('genus', __('Genus'));
        $form->text('family', __('Family'));
        $form->text('habitat', __('Habitat'));
        $form->text('location', __('Location'));
        $form->text('title_classification', __('Title classification'));
        $form->text('classification', __('Classification'));
        $form->text('title_lifespan', __('Title lifespan'));
        $form->text('lifespan', __('Lifespan'));
        $form->text('title_diet', __('Title diet'));
        $form->text('diet', __('Diet'));
        $form->text('weight', __('Weight'));
        $form->text('speed', __('Speed'));
        $form->text('animal_height', __('Animal height'));
        $form->text('title_fun_tips', __('Title fun tips'));
        $form->text('fun_tips', __('Fun tips'));
        $form->text('endangered_level', __('Endangered level'));
        $form->text('theme_name', __('Theme name'));
        $form->text('group_name', __('Group name'));

        return $form;
    }
}
