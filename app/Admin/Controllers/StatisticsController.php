<?php

/**
 * @Author: eden
 * @Date:   2020-04-22 16:33:12
 * @Last Modified by:   eden
 * @Last Modified time: 2020-04-27 10:40:35
 */
namespace App\Admin\Controllers;

use App\Models\{AnimalTranslation, Animal};
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use DB;

class StatisticsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Statistics';

    public function index(Content $content)
    {
        return $content
                ->header('Animals Views')
                ->description()
                ->row(function (Row $row){
                    $row->column(12, function ($column){
                    	// 所有动物中浏览量前十的动物
                        $sums = DB::table('animals_translations')
                            ->leftJoin('animals', 'animals.id', '=', 'animals_translations.animal_id')
                            ->select(DB::raw('sum(view) as sum'), 'animals.product_name')
                            ->orderBy('sum', 'desc')
                            ->groupBy('animal_id')
                            ->take(10)
                            ->get()
                            ->toArray();

                        $doughnut_bar = view('admin.chart.animals_view_bar', compact('sums'));

                        $doughnut_line = view('admin.chart.animals_view_line', compact('sums'));

						$doughnut_pie = view('admin.chart.animals_view_pie', compact('sums'));

                        $column->row(function ($row) use ($doughnut_bar, $doughnut_line, $doughnut_pie) {
                            $row->column(4, new Box('动物点击率(树状图)', $doughnut_bar));
                            $row->column(4, new Box('动物点击率(折线图)', $doughnut_line));
                            $row->column(4, new Box('动物点击率(饼状图)', $doughnut_pie));

                            // 盒子插件
                            // $box = new Box();
                            // $box->solid();
                            // $box->removable();
                            // $box->style('primary');
                            // $box->collapsable();
                            // $row->column(12, $box);

                            // 折叠插件
                            // $collapse = new Collapse();
                            // $collapse->add('Bar', 'xxxxx');
                            // $row->column(12, $collapse);

                            // 表单插件
                            // $form = new Form();

                            // $form->action('example');

                            // $form->email('email')->default('qwe@aweq.com');
                            // $form->password('password');
                            // $form->text('name', '输入框');
                            // $form->url('url');
                            // $form->color('color');
                            // $form->map('lat', 'lng');
                            // $form->date('date');
                            // $form->json('val');
                            // $form->dateRange('created_at', 'updated_at');

                            // $row->column(12, new Box('表单', $form));

                            // 信息展示块插件
                            // $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/users', '1024');
                            // $row->column(12, function ($column) use ($infoBox) {
                            //     $column->row(function($row) use ($infoBox) {
                            //         $row->column(4, new Box('信息', $infoBox));
                            //         $row->column(8, new Box('信息', $infoBox));
                            //     });
                            // });

                            // 表格插件
                            // $headers = ['Id', 'Email', 'Name', 'Company'];
                            // $rows = [
                            //     [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica'],
                            //     [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar'],
                            //     [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC'],
                            //     [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
                            //     [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.'],
                            // ];

                            // $row->column(12, new Box('表格', new Table($headers, $rows)));

                            // Tab组件
                            // $tab =  new Tab();
                            // $tab->add('Pie', $doughnut_pie);
                            // $tab->add('Text', 'blablablabla....');
                            // $tab->add('table', new Table($headers, $rows));
                            // $row->column(12, $tab);
                        });
                    });

                    
                });
    }

    
}
