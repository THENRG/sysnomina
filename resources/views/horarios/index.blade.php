@extends("layout")

@section("content")

<div class="container">
	@include('layouts.alerts')

	<div class="card card-body card-flat">
		<div class="row align-items-center mb-3 border-bottom">
			<div class="col-md mb-3">
				<div class="fs-4 fw-bold text-dark text-center text-md-start">Horarios</div>
			</div>

			<div class="col-md mb-3">
				<div class="d-grid d-md-block float-md-end">
					<a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#createHorarioModal"><i class="bi bi-plus-lg"></i> Agregar</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 mb-5">
			  	<table class="table datatable">
					<thead>
						<tr>
							<th scope="col">Hora de Entrada</th>
							<th scope="col">Hora de Salida</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@if($horarios) 
							@foreach($horarios as $hrs)
								<tr>
									<td data-label="Hora de Entrada">{{ $hrs->hour_in }}</td>
									<td data-label="Hora de Salida">{{ $hrs->hour_out }}</td>
									<td data-label="Acciones">
										<a class="btn btn-secondary btn-sm" href="#" role="button" data-hr-in="{{ $hrs->hour_in }}" data-hr-out="{{ $hrs->hour_out }}" data-name="{{ $hrs->hour_in }} - {{ $hrs->hour_out }}" data-bs-whatever="{{ $hrs->id }}" data-bs-toggle="modal" data-bs-target="#editHorarioModal"><i class="bi bi-pencil-square"></i> Editar</a>
										<a class="btn btn-danger btn-sm" href="#" role="button" data-name="{{ $hrs->hour_in }} - {{ $hrs->hour_out }}" data-bs-whatever="{{ $hrs->id }}" data-bs-toggle="modal" data-bs-target="#deleteHorarioModal"><i class="bi bi-eraser"></i> Eliminar</a>
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

	<div class="modal fade" id="createHorarioModal" tabindex="-1" aria-labelledby="createHorarioModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="createHorarioModalLabel">Agregar Nuevo Horario</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('horario.create') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end fw-bold">Hora de Entrada</label>
			    <div class="col-sm">
			      	<input type="text" class="form-control" id="hr_in" name="hr_in" required>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end fw-bold">Hora de Salida</label>
			    <div class="col-sm">
			      	<input type="text" class="form-control" id="hr_out" name="hr_out" required>
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
	<div class="modal fade" id="editHorarioModal" tabindex="-1" aria-labelledby="editHorarioModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editHorarioModalLabel">Actualizar Horario</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('horario.edit') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end fw-bold">Hora de Entrada</label>
			    <div class="col-sm">
			      	<input type="text" class="form-control" id="hr_in" name="hr_in" required>
			    </div>
			  </div>

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
	<!-- ELIMINAR HORARIO -->
	<div class="modal fade" id="deleteHorarioModal" tabindex="-1" aria-labelledby="deleteHorarioModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteHorarioModalLabel">Eliminar Horario</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('horario.delete') }}">
	    		@csrf
	    		<p class="text-center">¿Estas seguro de eliminar este horario?</p>
	    		<p class="text-center fs-4"><span class="fw-bold"></span></p>
	    		
	    		<p class="text-center fs-4"><span id="name" class="fw-bold"></span></p>
	    		<input type="text" class="form-control visually-hidden" id="id" name="id" value="" readonly>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cancelar</button>
		        <button type="submit" class="btn btn-danger"><i class="bi bi-eraser"></i> Eliminar</button>
		      </div>			  
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>

@endsection