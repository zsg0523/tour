<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{Question, GameUser};
use App\Handlers\GenerateQrcodeHandler;
use App\Services\QuestionService;
use App\Transformers\QuestionTransformer;

class QuestionsController extends Controller
{

    /** [__construct 自动注入服务] */
    public function __construct(QuestionService $questionService)
    {   
        $this->questionService = $questionService;
    }

    /** [index 题目列表] */
    public function index(Request $request)
    {
        $lang = $request->lang ?? 'en';
        // 随机获取十条题目
        $questions = Question::where('lang', $lang)->where('is_show', 1)->inRandomOrder()->take(10)->get();

        return $this->response->collection($questions, new QuestionTransformer());
    }

    /** [show 题目详情] */
    public function show(Question $question)
    {
        return $this->response->item($question, new QuestionTransformer());
    }

    /** [answer] */
    public function answer(Question $question, Request $request)
    {
        $answer = $request->answer;

        if ($question->answer !== $answer) {
            abort(422, '回答错误');
        }

        return response()->json([
            'message' => '回答正确',
            'status_code' => 201,
        ]);
    }

    /** [store 计算答题结果] */
    public function store(Request $request)
    {
    	$data = json_decode($request->data, true);
        
    	// 更新题库数据
    	$true_count = 0;
    	foreach ($data['questions'] as $question) {
    		switch ($question['answer']) {
    			case '1':
    				$true_count++;
    				$question = $this->questionService->getQuestionByCode($question['code'], $data['lang']);
                    $map = [
                        'true' => $question->true + 1,
                        'total' => $question->true + 1 + $question->false,
                    ];
                    $updateQuestion = $this->questionService->updateById($question->id, $map);
    				break;
    			case '0':
    				$question = $this->questionService->getQuestionByCode($question['code'], $data['lang']);
                    $map = [
                        'false' => $question->false + 1,
                        'total' => $question->true + $question->false + 1,
                    ];
                    $updateQuestion = $this->questionService->updateById($question->id, $map);
    				break;
    		}
    	}

    	$user_count = GameUser::where('answer','>', $true_count)->count();
        $users = GameUser::all()->count();
    	// 玩家排名
    	$rank = $user_count + 1;

    	// 创建用户数据
    	$user = GameUser::create(['answer' => $true_count, 'url' => $rank ]);

    	// 二维码内容
    	$url = url('result?rank=' . $rank . '/' . $users . '&lang=' . $data['lang']);

    	// 生成二维码
    	$qrcode = app(GenerateQrcodeHandler::class)->generateQrcode($url, $user->id . '.png', 'rank');

    	return $this->response->array(['qrcode' => url('uploads/rank/' . $user->id . '.png'), 'url' => $url]);
    }

    /** [total 更新题目答案总数] */
    public function total()
    {
        $question_ids = $this->questionService->getAllIds();

        foreach ($question_ids as $id) {

            $question = $this->questionService->getQuestionById($id);
           
            $total =$this->questionService->getTotal($question->true, $question->false);

            $result = $this->questionService->updateById($id, ['total' => $total]);

        }

    }

    

















}
