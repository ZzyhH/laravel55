<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use DB;


class ArticleController extends Controller
{
    //
    public function index()
    {
        $article = Article::orderBy('id', 'DESC')->paginate(2, ['id', 'title', 'author', 'show', 'views', 'created_at']);
        return view('admin/article/index', compact('article'));
    }

    //编辑文章
    public function edit()
    {
        $id = request()->get('id');
        if ($id) {
            $data = Article::where('id', $id)->first()->toArray();
        } else {
            $data = ['cid' => 0, 'title' => '', 'author' => '', 'show' => 1, 'content' => '', 'image' => ''];
        }
        $category = Category::orderBy('sort', 'ASC')->get();
        return view('admin/article/edit', compact('id', 'data', 'category'));
    }

    //保存新增或编辑的文章
    public function save()
    {
        $id = request()->post('id', 0);
        $data = [
            'cid' => request()->post('cid', 0),
            'title' => request()->post('title', ''),
            'author' => request()->post('author', ''),
            'show' => request()->post('show', '0'),
            'content' => request()->post('content', ''),
        ];
        // 调用clean()函数进行HTML过滤（在后面的步骤中实现）
        $data['content'] = clean($data['content']);
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            if ($image->isValid()) {
                $name = md5(microtime(true)) . '.' . $image->extension();
                $image->move('uploads/images/' . date('Y-m/d'), $name);
                $data['image'] = date('Y-m/d') . '/' . $name;
            }
        }
        if ($id) {
            Article::where('id', $id)->update($data);
            return response()->json(['code' => 1, 'msg' => '修改完成']);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            DB::table('cms_article')->insert($data);
            return response()->json(['code' => 1, 'msg' => '添加完成']);
        }
    }

    //删除文章
    public function delete()
    {
        $id = request()->get('id');
        if (Article::where('id', $id)->delete()) {
            return response()->json(['code' => 1, 'msg' => '删除完成']);
        }
        return response()->json(['code' => 0, 'msg' => '删除失败']);
    }
}
