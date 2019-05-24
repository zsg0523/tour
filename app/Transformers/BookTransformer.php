<?php

/**
 * @Author: Eden
 * @Date:   2019-05-24 11:10:31
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-05-24 12:32:51
 */
namespace App\Transformers;

use App\Models\Book;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['contents'];

    public function transform(Book $book)
    {
        return [
            'id' => $book->id,
            'name' => $book->name,
            'introduction' => $book->introduction,
            'cover' => $book->cover,
            'map' => $book->map,
            'view' => $book->view,
            'is_release' => $book->is_release ? '发布' : '未发布',
            'created_at' => (string) $book->created_at,
            'updated_at' => (string) $book->updated_at,
        ];
    }


    public function includeContents(Book $book)
    {
    	if($book->contents){
			return $this->collection($book->contents, new BookContentTransformer());
		}
    }
}