<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Transformers\BookTransformer;
use App\Http\Requests\Api\BookRequest;

class BooksController extends Controller
{	
	/** [index 电子书列表] */
	public function index()
	{
		return $this->response->collection(Book::all(), new BookTransformer());
	}


	/** [index 电子书详情] */
    public function show(Book $book)
    {
    	return $this->response->item($book, new BookTransformer());
    }
}
