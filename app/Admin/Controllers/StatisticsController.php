<?php

/**
 * @Author: eden
 * @Date:   2020-04-22 16:33:12
 * @Last Modified by:   eden
 * @Last Modified time: 2020-04-29 17:40:44
 */
namespace App\Admin\Controllers;

use App\Models\{AnimalTranslation, Animal, User, Order, Question};
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
                ->header('')
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

                        // 所有语言的总浏览量(按月)
                        $langs = DB::table('animals_translations')
                            ->select(DB::raw('sum(view) as sum'), 'lang')
                            ->groupBy('lang')
                            ->get()
                            ->toArray();
                        // 问答游戏的命中率
                        $questions = DB::table('questions')
                                ->select(DB::raw('sum(trues) as true_total'), DB::raw('sum(falses) as false_total'), DB::raw('sum(total) as total'), 'lang')
                                ->groupBy('lang')
                                ->get()
                                ->toArray();

                        // 问题的命中率,从低到高排序,抽取前10道
                        $trues = DB::table('questions')
                                ->select(DB::raw(DB::raw('CAST(round(sum(trues)/sum(total) * 100, 1) AS CHAR) as true_total')), 'code')
                                ->orderBy('true_total', 'asc')
                                ->take(10)
                                ->groupBy('code')
                                ->get();

                        foreach ($trues->toArray() as $key => $value) {
                                $maps[$key]['percent'] = $value->true_total;
                                $maps[$key]['question'] = Question::where('code', $value->code)->first()->question;
                            }    
                        
                        // 动物资料库-所有动物的浏览量
                        $doughnut_bar = view('admin.chart.animals_view_bar', compact('sums'));
                        // 动物资料库-所有语言的浏览量
                        $doughnut_lang_bar = view('admin.chart.animals_lang_bar', compact('langs'));
                        // 问答游戏-正确与否数量
                        $doughnut_questions_bar = view('admin.chart.questions_lang_bar', compact('questions'));
                        // 问答游戏-命中率
                        $doughnut_percent_bar = view('admin.chart.questions_percent_bar', compact('maps'));

                        $column->row(function ($row) use ($doughnut_bar, $doughnut_lang_bar, $doughnut_questions_bar, $doughnut_percent_bar) {
                            // 信息展示块插件
                            $userBox = new InfoBox('Users', 'users', 'aqua', '/admin/users', User::all()->count());
                            $orderBox = new InfoBox('Orders', 'tint', 'blue', '/admin/orders', Order::all()->count());
                            $animalBox = new InfoBox('Animals', 'cloud', 'yellow', '/admin/animals', Animal::all()->count());
                            $row->column(12, function ($column) use ($userBox, $orderBox, $animalBox) {
                                $column->row(function($row) use ($userBox, $orderBox, $animalBox) {
                                    $row->column(4, new Box('商城-用户总数', $userBox));
                                    $row->column(4, new Box('商城-订单总数', $orderBox));
                                    $row->column(4, new Box('动物资料库-动物总数', $animalBox));
                                });
                            });

                            $row->column(12, new Box('动物资料库-动物浏览量-排名前十动物', $doughnut_bar));
                            // $row->column(12, new Box('动物浏览量', $doughnut_line));
                            // $row->column(12, new Box('动物浏览量', $doughnut_pie));
                            $row->column(12, new Box('动物资料库-动物浏览量-按语言筛选', $doughnut_lang_bar));
                            $row->column(12, new Box('问答游戏-命中数量-按语言筛选', $doughnut_questions_bar));
                            $row->column(12, new Box('问答游戏-命中率-按题目', $doughnut_percent_bar));
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
