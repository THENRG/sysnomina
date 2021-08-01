@extends("layout")

@section("content")

	<div class="container">
		@include('layouts.alerts')
		
		<div class="card card-body card-flat">
			<div class="row align-items-center mb-3 border-bottom">
				<div class="col-md mb-3">
					<div class="fs-4 fw-bold text-dark text-center text-md-start">Cargos</div>
				</div>

				<div class="col-md mb-3">
					<div class="d-grid d-md-block float-md-end">
						<a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#createCargoModal"><i class="bi bi-plus-lg"></i> Agregar</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 mb-5">
					<table class="table datatable">
						<thead>
							<tr>
								<th scope="col">Tipo de Cargo</th>
								<th scope="col">Salario Mensual</th>
								<th scope="col">Acciones</th>
						    </tr>
						</thead>
						<tbody>
							@if($cargos) 
								@foreach($cargos as $cargo)
								   <tr>
								      	<td data-label="Tipo de Cargo">{{ $cargo->name }}</td>
								      	<td data-label="Salario Mensual">{{ number_format($cargo->salary, 2) }}</td>
										<td data-label="Acciones">
											<a class="btn btn-secondary btn-sm" href="#" role="button" data-array="{{ json_encode($cargo) }}" data-name="{{ $cargo->name }}" data-bs-whatever="{{ $cargo->id }}" data-bs-toggle="modal" data-bs-target="#editCargoModal"><i class="bi bi-pencil-square"></i> Editar</a>
											<a class="btn btn-danger btn-sm" href="#" role="button" data-array="{{ json_encode($cargo) }}" data-name="{{ $cargo->name }}" data-bs-whatever="{{ $cargo->id }}" data-bs-toggle="modal" data-bs-target="#deleteCargoModal"><i class="bi bi-eraser"></i> Eliminar</a>
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

	<div class="modal fade" id="createCargoModal" tabindex="-1" aria-labelledby="createCargoModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="createCargoModalLabel">Agregar Tipo de Cargo</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('cargo.create') }}">
	    		@csrf
			  <div class="mb-3 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Nombre del Cargo</label>
			    <div class="col-sm">
			      <input type="text" class="form-control" id="name" name="name" required>
			    </div>
			  </div>
			  <div class="mb-3 row">
			    <label for="salary" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Salario Mensual</label>
			    <div class="col-sm">
			      <input type="number" min="0" class="form-control" id="salary" name="salary" required>
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

	<div class="modal fade" id="editCargoModal" tabindex="-1" aria-labelledby="editCargoModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editCargoModalLabel">Actualizar Cargo</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('cargo.edit') }}">
	    		@csrf
			  <div class="mb-4 row">
			    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Nombre del Cargo</label>
			    <div class="col-sm">
			    	<input type="text" class="form-control selected-name" id="name" name="name" value="" required>
	    			<input type="text" class="form-control selected-id visually-hidden" id="id" name="id" value="" readonly>
			    </div>
			  </div>
			  <div class="mb-4 row">
			    <label for="salary" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Salario Mensual</label>
			    <div class="col-sm">
			    	<input type="number" min="0" class="form-control selected-name" id="salary" name="salary" value="" required>
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
	
	<div class="modal fade" id="deleteCargoModal" tabindex="-1" aria-labelledby="deleteCargoModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteCargoModalLabel">Eliminar Cargo</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('cargo.delete') }}">
	    		@csrf
	    		<div class="text-center mb-4">¿Estas seguro de eliminar este cargo?</div>
	    		<div id="name" class="fs-4 text-center fw-bold mb-4"></div>
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