<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" href="{{asset('css/app2.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-formhelpers.min.css')}}">
	<link rel="stylesheet" href="{{asset('fonts/bootstrap-icons.css')}}">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

	<title>Sistema de Control de Nomina y Empleados</title>
</head>

<body>
	<div id="sysnomina-app">
		@if (session()->has('modulo'))
			<div class="div-navleft bg-primary">


			    <div class="d-flex w-100 align-items-center">
				    <button class="navbar-toggler text-white navbar-toggler-mobile ms-2 position-absolute" type="button" id="sidebarToggleHolder" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fs-3 bi bi-justify text-white"></i>
				    </button>
					<div class="div-logo w-100">
						<img src="{{ asset('images/logo-sysnomina.png') }}" width="200" height="21">
					</div>				    
			    </div>

				
				<div class="div-nav">
					@include('layouts.navleft')
				</div>
			</div>
		@endif

		<div class="div-wrapper">
			@if (session()->has('modulo'))
				<div class="div-header">
					@include('layouts.header')
				</div>
			@endif
			<div class="div-content">
				@yield('content')
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/app2.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/sidebar.js')}}"></script>
</body>
</html>
