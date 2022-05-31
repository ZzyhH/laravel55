<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $server_info = [
            'server_version' => request()->server('SERVER_SOFTWARE'),
            'mysql_version' => $this->getMySQLVer(),
            'upload_max_filesize' => ini_get('file_uploads') ? ini_get('upload_max_filesize') : '已禁用',
            'max_execution_time' => ini_get('max_execution_time') . '秒',
            'server_time' => date('Y-m-d H:i:s', time())
        ];
        return view('admin/index', $server_info);
    }
    protected function getMySQLVer()
    {
        $v = "version()";
        $res = DB::select("select version()")[0]->$v;
        return $res ? $res : '未知';
    }
}
