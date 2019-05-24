<?php

/**
 * @Author: Eden
 * @Date:   2019-05-24 12:10:58
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-05-24 12:16:53
 */
namespace App\Transformers;

use App\Models\BookContent;
use League\Fractal\TransformerAbstract;

class BookContentTransformer extends TransformerAbstract
{
    public function transform(BookContent $book_content)
    {
        return [
            'id' => $book_content->id,
            'sort' => $book_content->sort,
            'image' => $book_content->image,
            'file' => $book_content->file,
            'created_at' => (string) $book_content->created_at,
            'updated_at' => (string) $book_content->updated_at,
        ];
    }
}