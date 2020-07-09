<?php

namespace App\Admin\Controllers;

use App\Models\ShopCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ShopCategoriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品类目';

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form(true)->edit($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopCategory());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('名称'));
        // $grid->column('is_directory', __('是否目录'))->display(function ($value) {
        //     return $value ? '是' : '否';
        // });
        // $grid->column('level', __('层级'));
        // $grid->column('path', __('类目路径'));
        $grid->actions(function ($actions) {
            // 不展示 Laravel-Admin 默认的查看按钮
            $actions->disableView();
        });

        return $grid;
    }

    protected function form($isEditing = false)
    {
        $form = new Form(new ShopCategory);

        $form->text('name', '类目名称')->rules('required');

        // 如果是编辑的情况
        // if ($isEditing) {
        //     // 不允许用户修改『是否目录』和『父类目』字段的值
        //     // 用 display() 方法来展示值，with() 方法接受一个匿名函数，会把字段值传给匿名函数并把返回值展示出来
        //     $form->display('is_directory', '是否目录')->with(function ($value) {
        //         return $value ? '是' :'否';
        //     });
        //     // 支持用符号 . 来展示关联关系的字段
        //     $form->display('parent.name', '父类目');
        // } else {
        //     // 定义一个名为『是否目录』的单选框
        //     $form->radio('is_directory', '是否目录')
        //         ->options(['1' => '是', '0' => '否'])
        //         ->default('0')
        //         ->rules('required');

        //     // 定义一个名为父类目的下拉框
        //     $form->select('parent_id', '父类目')->ajax('/api/admin/shop-categories');
        // }

        return $form;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    // protected function detail($id)
    // {
    //     $show = new Show(ShopCategory::findOrFail($id));

    //     $show->field('id', __('Id'));
    //     $show->field('name', __('Name'));
    //     $show->field('parent_id', __('Parent id'));
    //     $show->field('is_directory', __('Is directory'));
    //     $show->field('level', __('Level'));
    //     $show->field('path', __('Path'));
    //     $show->field('created_at', __('Created at'));
    //     $show->field('updated_at', __('Updated at'));

    //     return $show;
    // }

}
