<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    /** [downloadPdf pdf文档下载] */
	public function downloadPdf()
	{
		$file = public_path() . "/uploads/download/test.pdf";

		$headers = [
			'Content-Type: application/pdf',
		];
		// 直接 pdf 文件下载
		return response()->download($file, 'test.pdf', $headers);


		// 显示 pdf 不下载
		// return response()->file($file, $headers);
	}
}
