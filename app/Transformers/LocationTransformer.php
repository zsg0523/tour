<?php

/**
 * @Author: Eden
 * @Date:   2019-10-16 11:52:41
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-10-16 12:28:21
 */
namespace App\Transformers;

use App\Models\Location;
use League\Fractal\TransformerAbstract;

class LocationTransformer extends TransformerAbstract
{

	protected $availableIncludes = ['retails'];

	public function transform(Location $location)
	{
		return [
			'id' => $location->id,
			'lang' => $location->lang,
			'location' => $location->location,
			'created_at' => $location->created_at->toDateTimeString(),
			'updated_at' => $location->updated_at->toDateTimeString()
		];
	}

	public function includeRetails(Location $location)
	{
		if ($location->retails) {
			return $this->collection($location->retails, new RetailTransformer());	
		}
		
	}

}