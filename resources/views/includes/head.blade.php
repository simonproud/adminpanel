<meta charset="utf-8" />
<title>hoCRM Systems | @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet" />
<link href="{{asset('/css/app.css')}}" rel="stylesheet" />
<link href="/assets/css/bundle.css" rel="stylesheet" />

<link href="/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
<link href="/assets/plugins/animate/animate.min.css" rel="stylesheet" />
<link href="/assets/css/default/style.min.css" rel="stylesheet" />

<link href="/assets/css/default/style-responsive.min.css" rel="stylesheet" />
<link href="/assets/css/default/theme/orange.css" rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->



<script src="/assets/plugins/pace/pace.min.js"></script>
<script src="/assets/js/theme/default.js"></script>




<script src="/assets/js/apps.min.js"></script>

<!-- ================== END BASE JS ================== -->

@stack('css')
