<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 引入静态资源 -->
  <link rel="stylesheet" href="/static/common/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/common/toastr.js/2.1.4/toastr.min.css">
  <link rel="stylesheet" href="/static/admin/css/main.css">
  <script src="/static/common/jquery/1.12.4/jquery.min.js"></script>
  <script src="/static/common/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="/static/common/toastr.js/2.1.4/toastr.min.js"></script>
  <script src="/static/admin/js/main.js"></script>
  <title>登录</title>
</head>
<body class="login">

    <div class="container">
      <form method="post" action="/admin/login" class="j-login">
        <h1>内容管理系统</h1>
        <div class="form-group">
          <input type="text" name="username" class="form-control"
           placeholder="用户名" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control"
           placeholder="密码" required>
        </div>
        <div class="form-group">
          <input type="text" name="captcha" class="form-control"
           placeholder="验证码" required>
        </div>
        <div class="form-group">
          <div class="login-captcha">
            <img src="{{ captcha_src() }}" alt="captcha" title="点击更换">
          </div>
        </div>
    
        <!--暂时先不管{{csrf_field()}}是什么 -->
        {{csrf_field()}}

        <div class="form-group">
          <input type="submit" class="btn btn-lg btn-success" value="登录">
        </div>
      </form>
      <div class="main-loading" style="display:none">
        <div class="dot-carousel"></div>
      </div>
    </div>
    <script>
      main.ajaxForm('.j-login', function() {
        location.href = '/admin/index';
      });
      $('.login-captcha img').click(function () {
    $(this).attr('src', '{{ captcha_src() }}' + Math.random());
  });

    </script>
    
</body>
</html>
