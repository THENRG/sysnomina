@extends("layout")

@section("content")

<div class="container">
	@include('layouts.alerts')

	<div class="card card-body card-flat">
		<div class="row align-items-center mb-3 border-bottom">
			<div class="col-md mb-3">
				<div class="fs-4 fw-bold text-dark text-center text-md-start">Registrar Pre-Nomina</div>
			</div>

			<form id="preNominaFormHeader" method="POST" action="{{ route('prenomina.open', ['id' => $id]) }}" class="col-md-auto mb-3">
				@csrf
				<div class="row">
					<div class="col-md mb-3 mb-md-0">
						<div class="input-group">

							@if (session()->has('from_to')) 
								<input type="text" class="form-control" name="daterange" value="{{ session()->get('from_to') }}">
							@else
								<input type="text" class="form-control" name="daterange" value=" ">
							@endif

							<span class="input-group-text bg-secondary text-light"><i class="bi bi-calendar3-range"></i></span>
						</div>
					</div>
					<div class="col-md-auto mb-md-0">
						<div class="d-grid gap-3 d-md-block float-md-end">
							<a class="btn btn-success @if (!session()->has('from_to')) disabled @endif" href="{{ route('prenomina.process', ['id' => $id]) }}" role="button" data-bs-toggle="modal" data-bs-target="# s"><i class="bi bi-upload"></i> Procesar</a>
						</div>
					</div>
				</div>
			</form>	
		</div>



		<div class="row">
			@if (session()->has('from_to')) 

			<div class="col-md-12">
				<table class="table datatable">
					    <thead>
							<tr>
								<th scope="col">Cédula</th>
								<th scope="col">Empleado</th>
								<th scope="col">Cargo</th>
								<th scope="col">Estado</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>
				    	<tbody>
							@if($empleados) 
								@foreach($empleados as $empleado)
								   <tr>
								      	<td data-label="Cédula">{{ $empleado->cedula }}</td>
								      	<td data-label="Empleado">{{ $empleado->name }}</td>
								      	<td data-label="Cargo">{{ $empleado->cargo }}</td>

								      	@if (isset($prenominas[$empleado->id]))
											<td data-label="Estado">
												<span class="badge bg-success rounded-pill">Registrado</span>
											</td>
											<td data-label="Acciones">
												<a class="btn btn-info btn-sm" href="#" role="button" data-array="{{ json_encode($prenominas[$empleado->id]) }}" employee-id="{{ $empleado->id }}" daterange="{{ session()->get('from_to') }}" data-bs-toggle="modal" data-bs-target="#applyConceptosModal"><i class="bi bi-pencil-square"></i> Detalles</a>
											</td>
										@else
											<td data-label="Estado">
												<span class="badge bg-warning rounded-pill">Pendiente</span>
											</td>
											<td data-label="Acciones">
												<a class="btn btn-info btn-sm" href="#" role="button" employee-id="{{ $empleado->id }}" daterange="{{ session()->get('from_to') }}" data-bs-toggle="modal" data-bs-target="#applyConceptosModal"><i class="bi bi-pencil-square"></i> Detalles</a>
											</td>
										@endif
								    </tr>
								@endforeach
							@endif
				    	</tbody>
				</table>
			</div>
			
			@endif
		</div>
	</div>
</div>

	<div class="modal fade" id="applyConceptosModal" tabindex="-1" aria-labelledby="applyConceptosModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="applyConceptosModalLabel">Detalles</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form id="applyConceptosModalForm" method="POST" action="{{ route('prenomina.store', ['id' => $id]) }}">
	    		@csrf

				<table class="table">
					<thead>
				    <tr>
						<th scope="col">Asignaciones</th>
						<th scope="col">Cantidad</th>
					</tr>
					</thead>
					<tbody>
							@if($asignaciones) 
								@foreach($asignaciones as $asignacion)
									<tr>
										<td data-label="Asignación">{{ $asignacion->name }}</td>
										<td data-label="Cantidad">
											<input type="number" min="0" id="A:{{ $asignacion->id }}" name="{{ str_replace(' ', '_', $asignacion->name) }}" style="width: 80px;" class="form-control form-control-sm text-center ms-auto ms-md-0"  aria-label="{{ $asignacion->name }}" required="">
										</td>
									</tr>
								@endforeach
							@endif
					</tbody>
				</table>

				<table class="table">
					<thead>
				    <tr>
						<th scope="col">Deducciones</th>
						<th scope="col">Cantidad</th>
					</tr>
					</thead>
					<tbody>
							@if($deducciones) 
								@foreach($deducciones as $deduccion)
									<tr>
										<td data-label="Deducción">{{ $deduccion->name }}</td>
										<td data-label="Cantidad">
											<input type="number" min="0" id="D:{{ $deduccion->id }}" name="{{ str_replace(' ', '_', $deduccion->name) }}" style="width: 80px;" class="form-control form-control-sm text-center ms-auto ms-md-0"  aria-label="{{ $deduccion->name }}" required>
										</td>
									</tr>
								@endforeach
							@endif
					</tbody>
				</table>

	    		<input type="text" class="form-control visually-hidden" id="id" name="id" value="" readonly>

		      <div class="modal-footer border-0">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cancelar</button>
		        <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Cargar</button>
		      </div>			  
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>

@endsection