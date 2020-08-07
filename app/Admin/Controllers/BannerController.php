<?php

namespace App\Admin\Controllers;

use App\Models\{Banner, Button};
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Content;
use App\Admin\Actions\Post\Buttons;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Banner';


    public function buttons($id, Content $content)
    {
        $data = [
            'banner_id' => $id,
        ];

        // 面包屑
        $content->breadcrumb(
            ['text' => 'Banners', 'url' => 'banners'],
            ['text' => $id],
            ['text' => 'Buttons']
        );


        // 渲染自定义表单
        return $content
            ->header('Buttons')
            ->description('')
            ->row(function(Row $row) use ($id , $data) {
                $row->column(12, function ($column) use ($id) {
                    $grid = new Grid(new Button);
                    $grid->resource(admin_base_path('buttons'));
                    $grid->column('id', __('Id'));
                    $grid->column('name', __('Title'));
                    $grid->column('link', __('Link'));
                    // $grid->column('icon', __('Icon'))->image(url('uploads'), 50, 50);
                    $states = [
                        'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
                        'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
                    ];
                    // $grid->column('is_show', __('Is_show'))->switch($states);
                    $grid->column('created_at', __('Created at'));
                    $grid->column('updated_at', __('Updated at'));
                    // 设置数据查询条件
                    $grid->model()->where('banner_id', $id);

                    $grid->disableCreateButton();
                    $grid->actions(function ($actions){
                        $actions->disableView();
                    });

                    $column->row($grid);
                });
            });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'));
        $grid->column('lang',__('Lang'));
        // $grid->column('type', __('Type'));
        $grid->column('tag_line', __('Tag line'));
        $grid->column('image', __('Image'))->image(url('uploads'), 50,50);
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $grid->column('is_show', __('Is_show'))->switch($states);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->add(new Buttons());
        });

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Banner());

        // $form->number('type', __('Type'))->default(1);
        $form->text('tag_line', __('Tag line'));
        $form->radio('lang')->options(['en'=>'en', 'zh-CN'=>'zh-CN', 'zh-TW'=>'zh-TW'])->default('en');
        $form->image('image', __('Image'))->removable();
        $states = [
            'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
        ];
        $form->switch('is_show')->states($states)->default(1);
        // 关联模型Profile的字段
        $form->text('button.link');
        $form->text('button.name')->rules('required|max:10');
        

        return $form;
    }
}
