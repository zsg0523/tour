<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Box;


class CategoryController extends Controller
{
    use ModelForm;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';


    public function index(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('')
            ->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());
                $row->column(6, function (Column $column) {

                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path('/categories'));
                    $form->text('title', __('Title'));
                    $form->select('parent_id', __('Parent id'))->options(Category::selectOptions());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });

    }

    /**
     * [edit 编辑]
     * @param  [type]  $id      [description]
     * @param  Content $content [description]
     * @return [type]           [description]
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('edit')
            ->body($this->form()->edit($id));
    }

    /**
     * [create 创建]
     * @return [type] [description]
     */
    public function create(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('create')
            ->body($this->form());
    }

    /**
     * [treeView 树形结构显示]
     * @return [type] [content]
     */
    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();
            return $tree;
        });
    }
    

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->column('id', __('Id'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('title', __('Title'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('title', __('Title'));
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
        $form = new Form(new Category);

        $form->number('parent_id', __('Parent id'));
        $form->number('order', __('Order'));
        $form->text('title', __('Title'));

        return $form;
    }
}
