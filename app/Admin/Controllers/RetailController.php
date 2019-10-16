<?php

namespace App\Admin\Controllers;

use App\Models\{Retail, Location};
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;

class RetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Retail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Retail);

        $grid->column('id', __('Id'));
        $grid->column('location_id', __('Region'))->display(function($location_id){
            $location = Location::find($location_id);
            return $location ? $location->location : '';
        })->label();
        $grid->column('name', __('Name'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('business_hours', __('Business Hours'));
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
        $show = new Show(Retail::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('address', __('Address'));
        $grid->field('phone', __('Phone'));
        $grid->field('business_hours', __('Business Hours'));
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
        $form = new Form(new Retail);

        $form->select('location_id', __('Location'))->options('/api/admin/locations');
        $form->text('name', __('Name'));
        $form->text('address', __('Address'));
        $form->mobile('phone', __('Phone'));
        $form->text('business_hours');
        return $form;
    }
}
