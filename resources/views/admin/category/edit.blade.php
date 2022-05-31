@extends('admin.layout')
@section('content')
<div class="main-title"><h2>@if($id)修改@else添加@endif栏目</h2></div>
<div class="main-section">
  <form method="post" action="/category/save" class="j-form">
    <ul class="form-group form-inline">
      <li>
        <input type="text" class="form-control" name="name" value="<?php echo $data['name'];?>" required>
        <label>栏目名称</label>
      </li>
      <li>
        <input type="number" class="form-control" name="sort" value="<?php echo $data['sort'];?>" required>
        <label>排序值</label>
      </li>
      <li>
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$id}}">
        <input type="submit" value="提交表单" class="btn btn-primary">
        <a href="/admin/category" class="btn btn-default">返回列表</a>
      </li>
    </ul>
  </form>
</div>
<script>
  main.menuActive('category');
  main.ajaxForm('.j-form', function () {
    main.content('/admin/category');  // 提交表单后跳转到列表页
  });
</script>
@endsection