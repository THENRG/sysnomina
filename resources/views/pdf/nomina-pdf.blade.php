<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>{{ $title }}</title>

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
        .text-end {
        	text-align: right;
        }

        .table {border-collapse:collapse; border: none;}

        .bg-header {
        	background: darkblue;
        	color: white;
        }

        .margin-b {
        	margin-bottom: 1cm;
        }

        .table td, .table th {
        	font-size: 14px;
        }

        .neto {
        	font-weight: bold;
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
						</tbody>
					</table>
			</div>
		</div>

		<h2 class="header-title margin-b">
			DETALLES DE LA NOMINA
		</h2>

		@foreach($content as $employee => $data)  
			<table class="table pdf-table margin-b">
			  <thead class="bg-header">
					    <tr>
							<th scope="col">FICHA</th>
							<th scope="col">EMPLEADO</th>
							<th scope="col">CEDULA</th>
							<th scope="col">JORNADA DIARIA</th>
							<th scope="col">CARGO</th>
					    </tr>
			  </thead>
			  <tbody>
					<tr>
					  	<th scope="row">{{$EmployeeCode[$employee]}}</th>
					  	<td>{{$employee}}</td>
					  	<td class="text-center">{{ $data["cedula"] }}</td>
					  	<td class="text-center">{{ number_format($data["salario"], 2) }}</td>
					  	<td class="text-center">{{ $data["cargo"] }}</td>
					</tr>
					    <tr>
					      <td colspan="5">
					        <table class="table pdf-table">
								<thead class="pdf-border-b">
									<tr>
										<th scope="col">CONCEPTO DE LA CLAUSULA</th>
										<th scope="col">ASIGNACIONES</th>
										<th scope="col">DEDUCCIONES</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data["info"] as $clausula => $value)
										@if ($value[1] > 0)
										<tr>
											<td>{{ $clausula }}</td>
											@if (isset($validate[$clausula]))
												<td class="text-center">{{ number_format($value[1], 2) }}</td>
												<td class="text-center"> </td>
											@else
												<td class="text-center"> </td>
												<td class="text-center">{{ number_format($value[1], 2) }}</td>
											@endif
										</tr>
										@endif
									@endforeach
										<tr>
											<th scope="row" class="pdf-border-y"> </td>
											<td class="text-center pdf-border-y">{{ number_format($data["asignaciones"], 2) }}</td>
											<td class="text-center pdf-border-y">{{ number_format($data["deducciones"], 2) }}</td>
										</tr>
										<tr class="bg-header">
											<th scope="row" class="pdf-border-y"> </td>
											<td class="text-end pdf-border-y neto">PAGO NETO:</td>
											<td class="text-center pdf-border-y neto">{{ number_format($data["neto"], 2) }}</td>
										</tr>
								</tbody>
					        </table>
					      </td>
					    </tr>				
				  </tbody>
				</table>
		@endforeach
	</main>

	<footer>
		<div class="footer-logo">
			<img src="{{asset('images/logo-sysnom3.png')}}" width="90" height="90">
		</div>
	</footer>	
</body>
</html>