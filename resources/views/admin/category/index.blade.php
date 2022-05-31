@extends('admin.layout')
@section('content')
<div class="main-title"><h2>栏目管理</h2></div>
  <div class="main-section form-inline">
    <a href="/category/edit" class="btn btn-success">+ 新增</a>
  </div>
  <div class="main-section">
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr><th>栏目名称</th><th>排序值</th><th>操作</th></tr>
      </thead>
      <tbody>
        @if ($category)
        <!-- 输出栏目列表 -->
        @foreach ($category as $value)
        <tr>
          <td><a href="/category/edit?id={{$value->id}}">{{ $value->name }}</a></td>
          <td>{{ $value->sort }}</td>
          <td>
            <a href="/category/edit?id={{ $value->id }}" style="margin-right:5px;">编辑</a>
            <a href="/category/delete?id={{ $value->id }}" class="j-del text-danger">删除</a>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="3" class="text-center">列表为空</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
<script>
  main.menuActive('category');  // 将“栏目”菜单项设为选中
  $('.j-del').click(function() {
    if (confirm('您确定要删除此项？')) {
      main.ajax($(this).attr('href'), function() {
        main.contentRefresh();  // 删除栏目后刷新内容区域
      });
    }
    return false;
  });
</script>
@endsection
