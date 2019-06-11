<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\AnimalRequest;
use App\Models\Animal;
use App\Transformers\AnimalTransformer;

class AnimalsController extends Controller
{
	/** [index 动物列表] */
    public function index()
    {
    	return $this->response->collection(Animal::all(), new AnimalTransformer());
    }

    /** [show 动物详情] */
    public function show(AnimalRequest $request, Animal $animal)
    {
    	$lang = $request->header('accept-language') ?? 'en';

    	// if ($lang == "") {
    	// 	return $this->response->errorMessage('未选择语言！');
    	// }

    	return $this->response->item($animal, new AnimalTransformer($lang));
    }
}	
