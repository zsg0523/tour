<?php

/**
 * @Author: Eden
 * @Date:   2019-11-08 11:45:56
 * @Last Modified by:   Eden
 * @Last Modified time: 2019-12-16 11:29:31
 */
namespace App\Handlers;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

class GenerateQrcodeHandler
{
	public function generateQrcode($content, $qrcode_name, $folder, $logo_path = null)
	{
		// Create a basic QR code
		$qrCode = new QrCode($content);
		$qrCode->setSize(300);

		// Set advanced options
		$qrCode->setWriterByName('png');
		$qrCode->setMargin(10);
		$qrCode->setEncoding('UTF-8');
		$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
		$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
		$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
		if ($logo_path !== null) {
			$qrCode->setLogoPath($logo_path);
		}
		$qrCode->setLogoSize(100, 100);
		$qrCode->setRoundBlockSize(true);
		$qrCode->setValidateResult(false);
		$qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

		// Directly output the QR code
		// header('Content-Type: '.$qrCode->getContentType());
		// echo $qrCode->writeString();

		// Save it to a file
		$qrCode->writeFile(public_path('uploads/' . $folder . '/').$qrcode_name);

		// Create a response object
		$response = new QrCodeResponse($qrCode);

		return $response;
	}

}


