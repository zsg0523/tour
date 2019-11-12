<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\AnimalRequest;
use App\Models\Animal;
use App\Models\Sound;
use App\Transformers\AnimalTransformer;

class AnimalsController extends Controller
{
	public function images(Animal $animal)
	{
		$animals = Animal::all();

		foreach ($animals as $animal) {
			$animal['image'] = 'animals/original/' . $animal['image'];

			$animal->update($animal->toArray());
		}
		
	}
}	
