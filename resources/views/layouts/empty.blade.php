<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('includes.headempty')
</head>
@php
	$bodyClass = (!empty($boxedLayout)) ? 'boxed-layout ' : '';
	$bodyClass .= (!empty($paceTop)) ? 'pace-top ' : '';
	$bodyClass .= (!empty($bodyExtraClass)) ? $bodyExtraClass . ' ' : '';
@endphp
<body class="{{ $bodyClass }}">
<div id="page-container">

	@yield('content')

    @include('includes.emptypage-js')
</div>
</body>
</html>
