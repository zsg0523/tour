<?php

namespace App\Admin\Controllers;

use App\Models\{AnimalTranslation, Animal, Sound};
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

        $grid->column('id', __('Id'))->filter()->sortable();
        $grid->column('lang', __('Lang'))->filter();
        $grid->column('animal_id', __('Product Name'))->display(function ($animal_id){
            $animal = Animal::find($animal_id);
            return $animal ? $animal->product_name : '';
        })->copyable();
        $grid->column('title', __('Title'))->filter('like');
        $grid->column('genus', __('Scientific Name'))->filter('like')->style('font-style:italic');
        $grid->column('family', __('Family'))->filter('like');
        $grid->column('habitat', __('Habitat'))->filter('like');
        $grid->column('location', __('Location'))->filter('like');
        $grid->column('title_classification', __('Title classification'))->filter('like');
        $grid->column('classification', __('Classification'))->filter('like');
        $grid->column('title_lifespan', __('Title lifespan'))->filter('like');
        $grid->column('lifespan', __('Lifespan'))->filter('like');
        $grid->column('title_diet', __('Title diet'));
        $grid->column('diet', __('Diet'));
        $grid->column('weight', __('Weight'));
        $grid->column('speed', __('Top Speed'));
        $grid->column('animal_height', __('Size'));
        $grid->column('title_fun_tips', __('Title fun tips'));
        $grid->column('fun_tips', __('Fun Facts'))->display(function($fun_tips){
            return str_limit($fun_tips, 10, '...');
        });
        $grid->column('endangered_level', __('Endangered level'));
        $grid->column('theme_name', __('Theme name'))->editable()->filter('like');
        $grid->column('group_name', __('Group name'))->filter('like');
        $grid->column('about', __('About'))->display(function($about){
            return str_limit($about, 10, '...');
        });
        $grid->column('more_details', __('More Details'))->display(function($more_details){
            return str_limit($more_details, 10, '...');
        });
        $grid->column('view', __('View'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();
        $grid->column('created_at', __('Created at'))->sortable();

        // 默认为每页20条
        $grid->paginate(15);
        $grid->fixColumns(3, -3);
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
        // $show->field('sound_id', __('Sound id'));
        $show->field('lang', __('Lang'));
        $show->field('view', __('View'));
        $show->field('title', __('Title'));
        $show->field('genus', __('Scientific Name'));
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
        $show->field('speed', __('Top Speed'));
        $show->field('animal_height', __('Size'));
        $show->field('title_fun_tips', __('Title fun tips'));
        $show->field('fun_tips', __('Fun Facts'));
        $show->field('endangered_level', __('Endangered level'));
        $show->field('theme_name', __('Theme name'));
        $show->field('group_name', __('Group name'));
        $show->field('about', __('About'));
        $show->field('more_details', __('More Details'));
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

        $form->select('animal_id', __('Product Name'))->options(function ($id){
            $animal = Animal::find($id);

            if ($animal) {
                return [$animal->id => $animal->product_name];
            }
        })->ajax('/api/admin/animals');
        $form->text('lang', __('Lang'))->default('en');
        $form->text('title', __('Title'));
        $form->text('genus', __('Scientific Name'));
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
        $form->text('speed', __('Top Speed'));
        $form->text('animal_height', __('Size'));
        $form->text('title_fun_tips', __('Title fun tips'));
        $form->text('fun_tips', __('Fun Facts'));
        $form->text('endangered_level', __('Endangered level'));
        $form->text('theme_name', __('Theme name'));
        $form->text('group_name', __('Group name'));
        $form->textarea('about', __('About'));
        $form->textarea('more_details', __('More Details'));

        return $form;
    }
}
