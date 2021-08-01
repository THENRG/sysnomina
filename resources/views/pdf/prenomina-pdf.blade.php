<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>{{ $title }}</title>

<!--
@include("pdf.bootstrap")
-->
	<style type="text/css" id="sns_styles">

       @page {
            margin: 0cm 0cm;
            font-family: "sans-serif;";
        }

        body {
            margin: 2cm 2cm 2cm;
        }

        .header-container {
			top: 0;
			left: 0;
			bottom: 0;
			width: 100%;
			height: 2cm;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            color: white;
        }

		.pdf-table {
			width: 100%;
		}

        .pdf-border-y {
        	border-top: 1px solid black;
        	border-bottom: 1px solid black;
        }
        .pdf-border-b {
        	border-bottom: 1px solid black;
        }

        .logo-lasagrada {
        	position: fixed;
        	left: 2cm;
        	top: 5cm;
        	width: 100%;
        }

        .content {
        	position: fixed;
        	top: 9cm;
        	width: calc(100% - 4cm);
        	left: 2cm;
        }

        header {
            position: fixed;
            left: 0;
            width: 100%;
            height: 2cm;
            background: dark;
            color: white;
        }

        .footer-logo {
        	margin-left: auto;
        	margin-right: auto;
        	width: 100px;
        }

        .header-title {
        	text-align: center;
        	color: black;
        	width: 100%;
        }

        .top-container {
        	position: relative;
        	top: 0;
        	width: 100%;
        	height: 100px;
        }

        .top-logo {
        	position: absolute;
        }

        .top-details {
        	position: absolute;
        	z-index: 99;
        	right: 0;
        }
        .text-center {
        	text-align: center;
        }

        .table td, .table th {
        	border: 1px solid black;
        }

        .table {border-collapse:collapse; border: none;}

        .bg-header {
        	background: darkblue;
        	color: white;
        }

        .margin-b {
        	margin-bottom: 1cm;
        }
	</style>


</head>

<body>
	<main>
		<div class="top-container margin-b">
			<div class="top-logo">
				<img src="{{asset('images/logo-lasagrada.png')}}" width="280" height="70">
			</div>
			<div class="top-details">
					<table style="width: 50%;">
						<tbody>
							<tr>
								<td>PERIODO: DESDE</td>
								<td class="text-center pdf-border-b">{{$from}}</td>
								<td class="text-center">HASTA</td>
								<td class="text-center pdf-border-b">{{$to}}</td>
							</tr>
							<tr>
								<td>DESCRIPCION:</td>
								<td class="pdf-border-b" colspan="3">{{$title}}</td>
							</tr>							
							<tr>
								<td>UNIDAD O DPTO:</ditdv>
								<td class="pdf-border-b" colspan="3">{{$DPTO}}</td>
							</tr>
						</tbody>
					</table>
			</div>
		</div>

		<h2 class="header-title margin-b">
			DETALLES DE LA PRE-NOMINA
		</h2>

		<table class="table table-bordered pdf-table margin-b">
				  <thead class="bg-header">
				    <tr>
						<th scope="col">FICHA</th>
						<th scope="col">EMPLEADO</th>
						@foreach($Names as $concept)
							<th scope="col">{{$IDs[$concept]}}</th>
						@endforeach
				    </tr>
				  </thead>
				  <tbody>
					  @foreach($content as $employee => $data)
					  <tr>
					  	<th scope="row">{{$EmployeeCode[$employee]}}</th>
					  	<td>{{$employee}}</td>
							@foreach($data as $concept => $result)
								<td class="text-center">{{$result}}</td>
							@endforeach
					  </tr>
					  @endforeach
				  </tbody>
		</table>

		<table class="pdf-table margin-b">
			<tbody>
			    <tr>
					<td class="text-center">ELABORADO POR</td>
					<td class="text-center">APROBADO POR</td>
			    </tr>
			    <tr>
					<td class="text-center">{{$responsable}}</td>
					<td class="text-center">Recursos Humanos</td>
			    </tr>
			    <tr>
					<td class="text-center">___________________________</td>
					<td class="text-center">___________________________</td>
			    </tr>
			</tbody>
		</table>

		<small>CAUSAS: 
			@foreach($Names as $concept)
				{{$IDs[$concept]}}. {{$concept}}  
			@endforeach
		</small>

	</main>

	<footer>
		<div class="footer-logo">
			<img src="{{asset('images/logo-sysnom3.png')}}" width="90" height="90">
		</div>
	</footer>	
</body>
</html>