<?php

/**
 * @Author: eden
 * @Date:   2020-05-21 10:18:06
 * @Last Modified by:   eden
 * @Last Modified time: 2020-07-28 09:45:35
 */
namespace App\Services;

use App\Models\ShopCategory;

class CategoryService
{

	public function getCategoryTree($lang, $parentId = null, $allCategories = null)
    {
        if (is_null($allCategories)) {
            // 从数据库中一次性取出所有类目
            $allCategories = ShopCategory::where('lang', $lang)->get();
        }

        // dd($allCategories);
        return $allCategories
            // 从所有类目中挑选出父类目 ID 为 $parentId 的类目
            ->where('parent_id', $parentId)
            // 遍历这些类目，并用返回值构建一个新的集合
            ->map(function (ShopCategory $category) use ($allCategories) {
                $data = ['id' => $category->id, 'lang' => $category->lang, 'name' => $category->name];
                // 如果当前类目不是父类目，则直接返回
                if (!$category->is_directory) {
                    return $data;
                }
                // 否则递归调用本方法，将返回值放入 children 字段中
                $data['children'] = $this->getCategoryTree($lang, $category->id, $allCategories);

                return $data;
            });
    }



}