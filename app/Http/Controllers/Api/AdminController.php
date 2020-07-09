<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{Category, Location, Animal, AnimalTranslation, Theme, ThemesTranslation, Question, ShopCategory};
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Handlers\GenerateQrcodeHandler;
use App\Jobs\GenerateQrcode;
use DB;

class AdminController extends Controller
{
    /** [getCategories 分类列表] */
    public function getCategories(Request $request)
    {
        $q = $request->get('q');

        return Category::where('title', 'like', "%$q%")->get(['id', 'title as text']);
    }

    public function getShopCategories(Request $request)
    {

        // 用户输入的值通过 q 参数获取
        $search = $request->input('q');

        $result = ShopCategory::query()
            ->where('name', 'like', '%'.$search.'%')
            ->paginate();

        // 把查询出来的结果重新组装成 Laravel-Admin 需要的格式
        $result->setCollection($result->getCollection()->map(function (ShopCategory $category) {
            return ['id' => $category->id, 'text' => $category->full_name];
        }));
        
        return $result;
    }

    /** [getAnswers 获取答案列表] */
    public function getAnswers(Request $request)
    {
        $q = $request->get('q');
        // 去重处理
        $data =  DB::table('questions')->where('lang', $q)->select('answer')->distinct()->get();
       
        foreach ($data->toArray() as $key => $value) {
            $mata[$key]['id'] = $value->answer;
            $mata[$key]['text'] = $value->answer;
        }

        return $mata;
    }


    /** [getLocations] */
    public function getLocations(Request $request)
    {
        $q = $request->get('q');

        return Location::where('location', 'like', "%$q%")->get(['id', 'location as text']);
    }

    /** [getAnimals] */
    public function getAnimals(Request $request)
    {
        $q = $request->get('q');

        return Animal::where('product_name', 'like', "%$q%")->paginate(null, ['id', 'product_name as text']);
    }

    /** [getThemes 获取主题内容] */
    public function getThemes(Request $request)
    {
        $q = $request->get('q');

        return Theme::where('product_name', 'like', "%$q%")->paginate(null, ['id', 'product_name as text']);
    }

    /** [generateQrcode 生成二维码] */
    public function generateQrcode(Request $request, GenerateQrcodeHandler $qrcode)
    {
        // 动物资料（翻译后的）
        $animal_translation = AnimalTranslation::where('lang', $request->lang)->where('animal_id', $request->animal_id)->first();
       
        $theme_translation = ThemesTranslation::where('title_page', $animal_translation->theme_name)->first();

        // 二维码 icon 图片链接
        $logo_path = public_path().'/white.png';
        
        // 推送任务队列
        dispatch(new GenerateQrcode($animal_translation, $theme_translation->theme_id,  $logo_path));
    }

    /**
     * [upImage 后端富文本编辑器上传图片接口]
     * @param  Request            $request  [description]
     * @param  ImageUploadHandler $uploader [实例]
     * @return [type]                       [description]
     */
    public function upImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'errno'   => 1,
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'admin', 1, 1024);
            // 图片保存成功的话
            if ($result) {
                $data['data'][] = $result['path'];
                $data['errno']   = 0;
            }
        }
 
        return $data;
    }






}
