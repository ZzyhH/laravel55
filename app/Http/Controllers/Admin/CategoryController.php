<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;


class CategoryController extends Controller
{
    public function CategoryController()
    {
        $category = Category::orderBy('sort', 'ASC')->get();
        return view('admin/category/index', compact('category'));
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $data = Category::where('id', $id)->first()->toArray();
            if (!$data) {
                return '栏目不存在！';
            }
        } else {
            $data = ['name' => '', 'sort' => '0'];
        }
        return view('admin/category/edit', compact('id', 'data'));
    }



    public function save(Request $request)
{
    $id = $request->post('id');
    $data = [
        'name' => request()->post('name', ''),
        'sort' => request()->post('sort', 0)
    ];        
    if ($id) {
        Category::where('id', $id)->update($data);
        return response()->json(['code' => 1, 'msg' => '修改完成']);            
    } else {
        $category = new Category();
        $category->name = request()->post('name', '');
        $category->sort = request()->post('sort', 0);
        $category->save();
        return response()->json(['code' => 1, 'msg' => '添加完成']);            
    }
}
public function delete(Request $request)
{
    $id = $request->get('id');        
    if (Category::where('id', $id)->delete()) {
        Article::where('cid', $id)->update(['cid' => 0]);
        return response()->json(['code' => 1, 'msg' => '删除完成']);            
    }
    return response()->json(['code' => 0, 'msg' => '删除失败']);        
}

}