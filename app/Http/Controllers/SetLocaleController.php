<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SetLocaleController extends Controller
{
    /** [downloadPdf pdf文档下载] */
	public function downloadPdf()
	{
		// 实例化 HTTP 客户端
        $http = new Client;

		$response = $http->get('"http://47.75.178.168/download"');
		// $file = public_path() . "/uploads/download/test.pdf";
		// $file = file_get_contents("http://47.75.178.168/download");

		$headers = [
			'Content-Type: application/pdf',
		];
		
		// 直接 pdf 文件下载
		return response()->download($response);


		// 显示 pdf 不下载
		// return response()->file($file, $headers);
	}
}
