<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{Question, GameUser};
use App\Handlers\GenerateQrcodeHandler;

class QuestionsController extends Controller
{
    public function store(Request $request)
    {
    	$data = json_decode($request->data, true);
    	// 更新题库数据
    	$true_count = 0;
    	foreach ($data['questions'] as $question) {
    		switch ($question['answer']) {
    			case '1':
    				$true_count++;
    				Question::where('code', $question['code'])->where('lang', $data['lang'])->increment('true');
    				break;
    			
    			case '0':
    				Question::where('code', $question['code'])->where('lang', $data['lang'])->increment('false');
    				break;
    		}
    	}

    	$user_count = GameUser::where('answer','>', $true_count)->count();

    	// 玩家排名
    	$rank = $user_count + 1;

    	// 创建用户数据
    	$user = GameUser::create(['answer' => $true_count, 'url' => $rank ]);

    	// 二维码内容
    	$url = url('result?rank=' . $rank);

    	// 生成二维码
    	$qrcode = app(GenerateQrcodeHandler::class)->generateQrcode($url, $user->id . '.png', 'rank');

    	return $this->response->array(['qrcode' => url('uploads/rank/' . $user->id . '.png'), 'url' => $url]);
    }

}
