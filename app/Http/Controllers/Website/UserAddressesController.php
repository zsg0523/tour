<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Transformers\UserAddressTransformer;

class UserAddressesController extends Controller
{
	/** 收获地址列表 */
    public function index()
    {
    	return $this->response->collection($this->user()->addresses, new UserAddressTransformer());
    }

    /** [store 新建收获地址] */
   	public function store(Request $request, UserAddress $address)
   	{
   		$address->fill($request->all());
   		$address->user_id = $this->user()->id;
   		$address->save();

   		return $this->response->item($address, new UserAddressTransformer());
   	}


   	/** [update 修改收货地址] */
   	public function update(Request $request, UserAddress $address)
   	{
   		$address->update($request->all());

   		return $this->response->item($address, new UserAddressTransformer());
   	}


   	/** 删除收获地址 */
   	public function destroy(UserAddress $address)
   	{
   		$address->delete();

   		return $this->response->noContent();
   	}
}
