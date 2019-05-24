<?php

namespace App\Http\Controllers\Api;

use App\Models\BookContent;
use Illuminate\Http\Request;
use App\Transformers\BookContentTransformer;

class BookContentsController extends Controller
{
    public function index()
    {
    	return $this->response->collection(BookContent::all(), new BookContentTransformer());
    }


    public function show(BookContent $content)
    {
    	return $this->response->item($content, new BookContentTransformer());
    }
}
