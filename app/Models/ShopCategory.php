<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    protected $fillable = ['name', 'is_directory', 'level', 'path'];

    protected $casts = [
    	'is_directory' => 'boolean',
    ];

    protected static function boot()
    {
    	parent::boot();

    	// 监听 Category 的创建事件,用于初始化 path 和 level 字段值
    	static::creating(function (Category $category){
    		// 如果创建的是一个根类目
    		if (is_null($category->parent_id)) {
    			// 将层级设为0
    			$category->level = 0;
    			// 将 path 设为 -
    			$category->path = '-';
    		} else {
    			// 将层级设为父类目的层级 + 1
    			$category->level = $category->parent->level + 1;
    			// 将 path 值设为父类目的 path 追加父类目 ID 以及最后跟上一个 - 分隔符
    			$category->path = $category->parent->path.$category->parent_id.'-';
    		}
    	});
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function shopProducts()
    {
        return $this->hasMany(ShopProduct::class);
    }


}
