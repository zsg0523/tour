<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /** [getCategories 分类列表] */
    public function getCategories(Request $request)
    {
        $q = $request->get('q');

        return Category::where('title', 'like', "%$q%")->get(['id', 'title as text']);
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
