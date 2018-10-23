<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Color Admin | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="../assets/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="../assets/css/default/style.min.css" rel="stylesheet" />
    <link href="../assets/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="../assets/css/default/theme/orange.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

<div class="login-cover">
    <div class="login-cover-image" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
    <div class="login-cover-bg"></div>
</div>
<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> ho<b>CRM</b>
                <small>Отличная CRM для Вас</small>
            </div>
            <div class="icon">
                <i class="fa fa-lock"></i>
            </div>
        </div>
        <!-- end brand -->
        <!-- begin login-content -->
        <div class="login-content">
            <form method="POST" action="{{ route('login') }}"  class="margin-bottom-0" aria-label="{{ __('Login') }}">
                @csrf
                <div class="form-group m-b-20">
                    <input id="email" type="email" placeholder="Email Address" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group m-b-20">
                    <input id="password" type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>

                </div>
                <div class="checkbox checkbox-css m-b-20">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember_checkbox">
                        Запомнить вас?
                    </label>
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-warning btn-block btn-lg">{{ __('Войти') }}</button>
                </div>
                <div class="m-t-20">
                    Еще нет аккаунта? Нажите  <a href="/register">здесь</a> для регистрации<br>
                     <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Забыли пароль?') }}
                    </a>
                </div>
            </form>
        </div>
        <!-- end login-content -->
    </div>
    <!-- end login -->

    <ul class="login-bg-list clearfix">
        <li class="active"><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-17.jpg" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)"></a></li>
        <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-16.jpg" style="background-image: url(../assets/img/login-bg/login-bg-16.jpg)"></a></li>
        <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-15.jpg" style="background-image: url(../assets/img/login-bg/login-bg-15.jpg)"></a></li>
        <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-14.jpg" style="background-image: url(../assets/img/login-bg/login-bg-14.jpg)"></a></li>
        <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-13.jpg" style="background-image: url(../assets/img/login-bg/login-bg-13.jpg)"></a></li>
        <li><a href="javascript:;" data-click="change-bg" data-img="../assets/img/login-bg/login-bg-12.jpg" style="background-image: url(../assets/img/login-bg/login-bg-12.jpg)"></a></li>
    </ul>


</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="../assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../assets/plugins/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<!--[if lt IE 9]>
<script src="../assets/crossbrowserjs/html5shiv.js"></script>
<script src="../assets/crossbrowserjs/respond.min.js"></script>
<script src="../assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/js-cookie/js.cookie.js"></script>
<script src="../assets/js/theme/default.min.js"></script>
<script src="../assets/js/apps.min.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="../assets/js/demo/login-v2.demo.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
        LoginV2.init();
    });
</script>
</body>
</html>

