<?php

namespace App\Http\Controllers;

use App\Category;

use App\Article;

use Session;

use Cache;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        $new = Article::where('show', 1)->orderBy('id', 'DESC')->limit(5)->get(['id', 'title']);
        $hot = Article::where('show', 1)->orderBy('views', 'DESC')->limit(10)->get(['id', 'title']);
        view()->share('new', $new);
        view()->share('hot', $hot);
    }

    protected function checkCount()
    {
        //查询当前访问量         
        $counter = Cache::rememberForever('counter', function () {
            return 0;
        });
        $flag = Session::get('counter', false);
        if (!$flag) {
            Session::put('counter', true);
            $counter++;
            Cache::forever('counter', $counter);
        }
        return $counter;
    }

    public function index()
    {
        $id = (int)request()->get('id', 0);
        if ($id) {
            $where['cid'] = $id;
            $categoryname = Category::where('id', $id)->value('name');
        }
        $where['show'] = 1;
        $article = Article::where($where)->orderBy('id', 'DESC')->paginate(2, ['id', 'title', 'author', 'image', 'created_at']);
        $category = Category::orderBy('id', 'ASC')->get();
        $title = $id ? $categoryname : '首页';
        $counter = $this->checkCount();
        return view('index/index', compact('id', 'category', 'categoryname', 'article', 'title', 'counter'));
    }
}
