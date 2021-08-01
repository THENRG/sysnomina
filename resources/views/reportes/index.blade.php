@extends("layout")

@section("content")

<div class="container">
	@include('layouts.alerts')

		<div class="card card-body card-flat">
			<div class="row align-items-center mb-3 border-bottom">
				<div class="col-md mb-3">
					<div class="fs-4 fw-bold text-dark text-center text-md-start">Reportes</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 mb-5">
				  	<table class="table datatable">
						    <thead>
								<tr>
									<th scope="col">Fecha de emision</th>
									<th scope="col">Descripcion</th>
									<th scope="col">Elaborado por</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
					    	<tbody>
								@if($reportes) 
									@foreach($reportes as $reporte)
									   <tr>
									      	<td data-label="Fecha">{{ $reporte->dates }}</td>
									      	<td data-label="Descripcion">{{ $reporte->description }}</td>
									      	<td data-label="Elaborado por">{{ $reporte->responsable }}</td>
											<td data-label="Acciones"> 
												@if ($reporte->type == "prenomina") 
													<form method="POST" action="{{ route('prenominaview.pdf', ['id' => $reporte->id]) }}">
														@csrf
			        									<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Ver PDF</button>
													</form>
												@else
												<form method="POST" action="{{ route('nominaview.pdf', ['id' => $reporte->id]) }}">
														@csrf
			        									<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Ver PDF</button>
													</form>
												@endif
											</td>
									    </tr>
									@endforeach
								@endif
					    	</tbody>
					</table>
				</div>
			</div>
		</div>
</div>


@endsection