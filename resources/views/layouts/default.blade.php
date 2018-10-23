<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('includes.head')


</head>
<body class="">
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}', userId:'{{Auth::user()->id}}', userEmail: '{{Auth::user()->email}}' };
</script>
	<div id="page-container" class="page-container page-sidebar-fixed page-header-fixed ">

		<div class="page-cover"></div>
			@include('includes.header')



			@include('includes.sidebar')

			<div id="content" class="content ">
			<!-- begin breadcrumb -->
				<ol class="breadcrumb pull-right">
					<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
					<li class="breadcrumb-item active">Dashboard v2</li>
				</ol>
				<!-- end breadcrumb -->
				<!-- begin page-header -->
				<h1 class="page-header">Welcome<small>Великие творения начинаются с малого...</small></h1>
				<!-- end page-header -->
				@if (session('status'))
                    <?php $data = unserialize(session('status')); ?>
				<div class="alert alert-{{$data['status_code']}} fade show">
					<span class="close" data-dismiss="alert">×</span>
					{{$data['status_text']}}
				</div>
				@endif
				@yield('content')
			</div>

		@include('includes.component.scroll-top-btn')

	</div>
<script src="{{ asset('js/bundle.js') }}"></script>


</body>
</html>
