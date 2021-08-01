@extends("layout")

@section("content")

<div class="container">
	@include('layouts.alerts')

	<div class="card card-body card-flat">
		<div class="row align-items-center mb-3 border-bottom">
			<div class="col-md mb-3">
				<div class="fs-4 fw-bold text-dark text-center text-md-start">Asistencias</div>
			</div>

			<div class="col-md mb-3">
				<div class="d-grid d-md-block float-md-end">
					<a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addAsistenciaModal"><i class="bi bi-plus-lg"></i> Agregar</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 mb-5">
			  	<table class="table datatable">
					<thead>
						<tr>
							<th scope="col">Fecha</th>
							<th scope="col">Cédula</th>
							<th scope="col">Empleado</th>
							<th scope="col">Hr. Entrada</th>
							<th scope="col">Hr. Salida</th>
							<th scope="col">Estado</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@if($asistencias) 
							@foreach($asistencias as $asistencia)
								<tr>
									<td data-label="Fecha">{{ $asistencia->date }}</td>
									<td data-label="Cédula">{{ $asistencia->cedula }}</td>
									<td data-label="Empleado">{{ $asistencia->employee }}</td>
									<td data-label="Hr. Entrada">{{ $asistencia->hour_in }}</td>
									<td data-label="Hr. Salida">{{ $asistencia->hour_out }}</td>
									<td data-label="Estado">
										@if ($asistencia->status == "a tiempo")
											<span class="badge bg-secondary">{{ $asistencia->status }}</span>
										@elseif ($asistencia->status == "tarde")
											<span class="badge bg-danger">{{ $asistencia->status }}</span>
										@endif
									</td>
									<td data-label="Acciones">
										<a class="btn btn-danger btn-sm" href="#" role="button" data-hr-in="{{ $asistencia->hour_in }}" data-hr-out="{{ $asistencia->hour_out }}" data-name="{{ $asistencia->hour_in }} - {{ $asistencia->hour_out }}" data-bs-whatever="{{ $asistencia->id }}" data-bs-toggle="modal" data-bs-target="#editAsistenciaModal"><i class="bi bi-door-open"></i> Salida</a>

										<!--
										<a class="btn btn-secondary btn-sm" href="#" role="button" data-hr-in="{{ $asistencia->hour_in }}" data-hr-out="{{ $asistencia->hour_out }}" data-name="{{ $asistencia->hour_in }} - {{ $asistencia->hour_out }}" data-bs-whatever="{{ $asistencia->id }}" data-bs-toggle="modal" data-bs-target="#editHorarioModal"><i class="bi bi-pencil-square"></i> Editar</a>
										<a class="btn btn-danger btn-sm" href="#" role="button" data-name="{{ $asistencia->hour_in }} - {{ $asistencia->hour_out }}" data-bs-whatever="{{ $asistencia->id }}" data-bs-toggle="modal" data-bs-target="#deleteHorarioModal"><i class="bi bi-eraser"></i> Eliminar</a>
										-->
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

	<div class="modal fade" id="addAsistenciaModal" tabindex="-1" aria-labelledby="addAsistenciaModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="addAsistenciaModalLabel">Agregar Asistencia de Hoy</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('asistencia.create') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end fw-bold">Cedula del Empleado</label>
			    <div class="col-sm">
			      	<input type="number" min="0" class="form-control" id="employee" name="employee" required>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end fw-bold">Hora de Entrada</label>
			    <div class="col-sm">
			      	<input type="text" class="form-control" id="hr_in" name="hr_in" required>
			    </div>
			  </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cancelar</button>
		        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
		      </div>			  
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- EDITAR HORARIO -->
	<div class="modal fade" id="editAsistenciaModal" tabindex="-1" aria-labelledby="editAsistenciaModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editAsistenciaModalLabel">Agregar Salida de Hoy</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('asistencia.edit') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end fw-bold">Hora de Salida</label>
			    <div class="col-sm">
			      	<input type="text" class="form-control" id="hr_out" name="hr_out" required>
			    </div>
			  </div>

	    		<input type="text" class="form-control visually-hidden" id="id" name="id" value="" readonly>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cancelar</button>
		        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Actualizar</button>
		      </div>			  
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>
@endsection