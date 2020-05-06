<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{Animal, AnimalTranslation, ThemesTranslation};
use App\Jobs\GenerateQrcode;

class GenerateAnimalsQrcode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qrcode:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '批量生成动物资料库单只动物资料的二维码';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('获取动物资料库数据');

        // 动物资料（翻译后的）
        $animal_translations = AnimalTranslation::all();
        
        // 二维码 icon 图片链接
        $logo_path = public_path().'/white.png';
        
        $this->info('开始推送队列，进行生成二维码');

        // 推送任务队列
        foreach ($animal_translations as $animal_translation) {

            $this->info($animal_translation->animal->product_name . '_' . $animal_translation->lang . '.png');

            $theme_translation = ThemesTranslation::where('title_page', $animal_translation->theme_name)->first();

            $theme_id = $theme_translation ? $theme_translation->theme_id : null;
            
            dispatch(new GenerateQrcode($animal_translation, $theme_id, $logo_path));
        }

        $this->info('推送完毕，总共生成' . count($animal_translations) . '张二维码！');
    }

















}
