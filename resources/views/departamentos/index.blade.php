@extends("layout")

@section("content")

	<div class="container">
		@include('layouts.alerts')
		
		<div class="card card-body card-flat">
			<div class="row align-items-center mb-3 border-bottom">
				<div class="col-md mb-3">
					<div class="fs-4 fw-bold text-dark text-center text-md-start">Departamentos</div>
				</div>

				<div class="col-md mb-3">
					<div class="d-grid d-md-block float-md-end">
						<a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#createDptoModal"><i class="bi bi-plus-lg"></i> Agregar</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 mb-5">
				  	<table class="table datatable">
						    <thead>
								<tr>
									<th scope="col">Unidad</th>
									<th scope="col">Empleados</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
					    	<tbody>
								@if($departamentos) 
									@foreach($departamentos as $dpto)
									   <tr>
									      	<td data-label="Unidad">{{ $dpto->name }}</td>
									      	<td data-label="Empleados">{{ $dpto_employees[$dpto->name] }}</td>
											<td data-label="Acciones">
												<a class="btn btn-secondary btn-sm" href="#" role="button" data-name="{{ $dpto->name }}" data-bs-whatever="{{ $dpto->id }}" data-bs-toggle="modal" data-bs-target="#editDptoModal"><i class="bi bi-pencil-square"></i> Editar</a>
												<a class="btn btn-danger btn-sm" href="#" role="button" data-name="{{ $dpto->name }}" data-bs-whatever="{{ $dpto->id }}" data-bs-toggle="modal" data-bs-target="#deleteDptoModal"><i class="bi bi-eraser"></i> Eliminar</a>
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

	<div class="modal fade" id="createDptoModal" tabindex="-1" aria-labelledby="createDptoModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="createDptoModal">Agregar Nueva Unidad</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('departamento.create') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Nombre del Área</label>
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

	<div class="modal fade" id="editDptoModal" tabindex="-1" aria-labelledby="editDptoModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editDptoModal">Actualizar Unidad</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('departamento.edit') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end fw-bold text-center text-md-end">Nombre del Área</label>
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

	<div class="modal fade" id="deleteDptoModal" tabindex="-1" aria-labelledby="deleteDptoModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteDptoModallabel">Eliminar Departamento</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('departamento.delete') }}">
	    		@csrf
	    		<p class="text-center">¿Estas seguro de eliminar esta unidad?</p>
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