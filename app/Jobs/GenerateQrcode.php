<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Handlers\GenerateQrcodeHandler;
use App\Models\{AnimalQrcode, AnimalTranslation};


class GenerateQrcode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $animal_translation;
    protected $logo_path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($animal_translation, $logo_path = null)
    {
        $this->animal_translation = $animal_translation;
        $this->logo_path = $logo_path;
    }

    /**
     * Execute the job.
     * 将动物资料库单只动物链接生成二维码
     * 二维码url写入数据库
     * 
     * @return void
     */
    public function handle()
    {
        // 单只动物链接
        $url = 'https://www.wennoanimal.com/animals/database?product_name=' . $this->animal_translation->animal->product_name . '&lang=' . $this->animal_translation->lang . '&root=0';

        // url 二维码名称
        $url_qrcode_name = $this->animal_translation->animal->product_name . '_' . $this->animal_translation->lang . '.png';

        // url 二维码
        $result = app(GenerateQrcodeHandler::class)->generateQrcode($url, $url_qrcode_name, $this->logo_path); 

        // product 二维码名称
        $product_qrcode_name = $this->animal_translation->animal->product_name . '.png';

        // product 二维码
        $result = app(GenerateQrcodeHandler::class)->generateQrcode($this->animal_translation->animal->product_name, $product_qrcode_name, $this->logo_path);

        // url二维码链接
        $url_qrcode = url('uploads/qrcodes/'. $url_qrcode_name);

        // product 二维码
        $product_qrcode = url('uploads/qrcodes/' . $product_qrcode_name);
        
        // 存储二维码信息
        AnimalQrcode::updateOrCreate(
        [
            'product_name' => $this->animal_translation->animal->product_name,
            'lang' => $this->animal_translation->lang
        ], 
        [
            'product_name' => $this->animal_translation->animal->product_name,
            'product_qrcode' => $product_qrcode,
            'lang' => $this->animal_translation->lang,
            'url' => $url,
            'url_qrcode' => $url_qrcode
        ]);

    }




















}
