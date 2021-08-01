@extends("layout")

@section("content")

	<div class="container">
		@include('layouts.alerts')

		<div class="card card-body card-flat">
			<div class="row align-items-center mb-3 border-bottom">
				<div class="col-md mb-3">
					<div class="fs-4 fw-bold text-dark text-center text-md-start">Asignaciones</div>
				</div>

				<div class="col-md mb-3">
					<div class="d-grid d-md-block float-md-end">
						<a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#createAsignacionModal"><i class="bi bi-plus-lg"></i> Nuevo</a>
					</div>

				</div>
			</div>

			<div class="col-md-12 mb-5">
				<table class="table datatable">
					<thead>
				    <tr>
						<th scope="col">Descripcion</th>
						<th scope="col">Acciones</th>
					</tr>
					</thead>
					<tbody>
						@if($asignaciones) 
							@foreach($asignaciones as $concepto)
							   <tr>
							      	<td data-label="Descripcion">{{ $concepto->name }}</td>
									<td data-label="Acciones">
										<a class="btn btn-secondary btn-sm" href="#" role="button" data-name="{{ $concepto->name }}" data-bs-whatever="{{ $concepto->id }}" data-bs-toggle="modal" data-bs-target="#editAsignacionModal"><i class="bi bi-pencil-square"></i> Editar</a>
										<a class="btn btn-danger btn-sm" href="#" role="button" data-name="{{ $concepto->name }}" data-bs-whatever="{{ $concepto->id }}" data-bs-toggle="modal" data-bs-target="#deleteAsignacionModal"><i class="bi bi-eraser"></i> Eliminar</a>
									</td>
							    </tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="createAsignacionModal" tabindex="-1" aria-labelledby="createAsignacionModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="createAsignacionModal">Agregar Nueva Asignación</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('asignacion.create') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-3 col-form-label fw-bold text-center text-md-end">Descripcion</label>
			    <div class="col-sm">
			      <input type="text" class="form-control" id="name" name="name" required>
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
	<!-- EDITAR ASIGNACION -->
	<div class="modal fade" id="editAsignacionModal" tabindex="-1" aria-labelledby="editAsignacionModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editAsignacionModal">Actualizar Asignación</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('asignacion.edit') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-3 col-form-label fw-bold text-center text-md-end">Descripcion</label>
			    <div class="col-sm">
			    	<input type="text" class="form-control selected-name" id="name" name="name" value="" required>
	    			<input type="text" class="form-control selected-id visually-hidden" id="id" name="id" value="" readonly>
			    </div>
			  </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cancelar</button>
		        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Actualizar</button>
		      </div>			  
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- ELIMINAR ASIGNACION -->
	<div class="modal fade" id="deleteAsignacionModal" tabindex="-1" aria-labelledby="deleteAsignacionModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteAsignacionModalTitle">Eliminar Asignación</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('asignacion.delete') }}">
	    		@csrf
	    		<p class="text-center">¿Estas seguro de eliminar esta asignación?</p>
	    		<p class="text-center fs-4"><span class="selected-name fw-bold"></span></p>
	    		<input type="text" class="form-control selected-id visually-hidden" id="name" name="name" value="" readonly>
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