@if($isAjax!=1)
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 引入静态资源 -->
   <link rel="stylesheet" href="/static/common/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="/static/common/font-awesome-4.2.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="/static/common/toastr.js/2.1.4/toastr.min.css">
   <link rel="stylesheet" href="/static/admin/css/main.css">
   <script src="/static/common/jquery/1.12.4/jquery.min.js"></script>
   <script src="/static/common/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="/static/common/toastr.js/2.1.4/toastr.min.js"></script>
   <script src="/static/admin/js/main.js"></script>
  <title>内容管理系统</title>
</head>
<body>
  <!-- 顶部导航-->
  <nav class="navbar navbar-default navbar-static-top main-nav"
   role="navigation">
    <div class="navbar-header">
      <!-- Bootstrap在小屏幕上显示的菜单折叠按钮 -->
      <button type="button" class="navbar-toggle" data-toggle="collapse"
       data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand">内容管理系统</div>
    </div>
    <div class="collapse navbar-collapse">
      <div class="main-sidebar">
        <!-- 左侧菜单 -->
        <ul class="nav main-menu">
          <li>
            <a href="/admin/index" data-name="index">
              <i class="fa fa-home fa-fw"></i>首{{$isAjax}}页
            </a>
          </li>
          <li>
            <a href="/admin/category" data-name="category">
              <i class="fa fa-list fa-fw"></i>栏目管理
            </a>
          </li>
          <li>
            <a href="/admin/article" data-name="article">
              <i class="fa fa-file-o fa-fw"></i>文章管理
            </a>
          </li>
        </ul>
      </div>
      <!-- 右上角按钮 -->
      <ul class="nav navbar-right">
        <li>
          <a href="#"><i class="fa fa-user fa-fw"></i>{{$user['name']}}</a>
        </li>
        <li>
          <a href="/admin/logout">
            <i class="fa fa-power-off fa-fw"></i>退出
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="main-container">
    <!-- 内容区域 -->
    <div class="main-content">
@endif
        @yield('content')
@if($isAjax!=1)
    </div>
    <div class="main-loading" style="display:none">
      <div class="dot-carousel"></div>
    </div>
  </div>
</body>
</html>
@endif
