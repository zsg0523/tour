<?php

/**
 * @Author: eden
 * @Date:   2020-03-20 17:31:25
 * @Last Modified by:   eden
 * @Last Modified time: 2020-03-23 14:44:01
 */
namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\OrderItem;

class OrdersExporter extends ExcelExporter implements FromQuery, WithMapping, WithHeadings
{
    protected $fileName = '订单列表.xlsx';


    public function map($order) : array
    {
    	$items = OrderItem::where('order_id', $order->id)->get()->toArray();
    	$order = $order->toArray();
    	
    	return [
    		$order['no'],
    		$order['user']['name'],
    		$order['address']['address'],
    		$order['address']['contact_name'],
    		$order['address']['contact_phone'],
    		$order['total_amount'],
    		$order['payment_method'],
  			$order['paid_at'],
    	];
    }

    public function headings() : array 
    {
    	return [
    		'订单号',
    		'姓名',
    		'收货地址',
    		'收货人',
    		'收货联系电话',
    		'总金额',
    		'支付方式',
    		'支付时间',
    	];
    }


}