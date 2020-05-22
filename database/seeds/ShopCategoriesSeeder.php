<?php

use Illuminate\Database\Seeder;
use App\Models\ShopCategory;

class ShopCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'     => '系列1',
                'children' => [
                    ['name' => '系列1-1'],
                    ['name' => '系列1-2'],
                    ['name' => '系列1-3'],
                    ['name' => '系列1-4'],
                    ['name' => '系列1-5'],
                    [
                        'name'     => '系列1-6',
                        'children' => [
                            ['name' => '系列1-6-1'],
                            ['name' => '系列1-6-2'],
                        ],
                    ],
                ],
            ],
            [
                'name'     => '系列2',
                'children' => [
                    ['name' => '系列2-1'],
                    ['name' => '系列2-2'],
                    ['name' => '系列2-3'],
                    ['name' => '系列2-4'],
                    ['name' => '系列2-5'],
                    ['name' => '系列2-6'],
                ],
            ],
            [
                'name'     => '系列3',
                'children' => [
                    ['name' => '系列3-1'],
                    ['name' => '系列3-2'],
                    ['name' => '系列3-3'],
                    ['name' => '系列3-4'],
                    ['name' => '系列3-5'],
                    ['name' => '系列3-6'],
                ],
            ],
            [
                'name'     => '系列4',
                'children' => [
                    ['name' => '系列4-1'],
                    ['name' => '系列4-2'],
                    ['name' => '系列4-3'],
                ],
            ],
        ];

        foreach ($categories as $data) {
            $this->createCategory($data);
        }

    }


    protected function createCategory($data, $parent = null)
    {
        // 创建一个新的类目对象
        $category = new ShopCategory(['name' => $data['name']]);
        // 如果有 children 字段则代表这是一个父类目
        $category->is_directory = isset($data['children']);
        // 如果有传入 $parent 参数，代表有父类目
        if (!is_null($parent)) {
            $category->parent()->associate($parent);
        }
        //  保存到数据库
        $category->save();
        // 如果有 children 字段并且 children 字段是一个数组
        if (isset($data['children']) && is_array($data['children'])) {
            // 遍历 children 字段
            foreach ($data['children'] as $child) {
                // 递归调用 createCategory 方法，第二个参数即为刚刚创建的类目
                $this->createCategory($child, $category);
            }
        }
    }


}
