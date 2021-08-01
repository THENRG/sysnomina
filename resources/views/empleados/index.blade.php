@extends("layout")

@section("content")

	<div class="container">
		@include('layouts.alerts')
		
		<div class="card card-body card-flat">
			<div class="row align-items-center mb-3 border-bottom">
				<div class="col-md mb-3">
					<div class="fs-4 fw-bold text-dark text-center text-md-start">Empleados</div>
				</div>

				<div class="col-md mb-3">
					<div class="d-grid d-md-block float-md-end">
						<a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#createEmployeeModal"><i class="bi bi-person-plus"></i>  Agregar</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 mb-5">
				  	<table class="table datatable">
						    <thead>
								<tr>
									<th scope="col">Cédula</th>
									<th scope="col">Nombre</th>
									<th scope="col">Cargo</th>
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
											<td data-label="Acciones">
												<a class="btn btn-secondary btn-sm" href="#" role="button" data-array="{{ json_encode($empleado) }}" data-name="{{ $empleado->name }}" data-bs-whatever="{{ $empleado->id }}" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi bi-pencil-square"></i> Editar</a>
												<a class="btn btn-danger btn-sm" href="#" role="button" data-array="{{ json_encode($empleado) }}" data-name="{{ $empleado->name }}" data-bs-whatever="{{ $empleado->id }}" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal"><i class="bi bi-eraser"></i> Eliminar</a>
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

	<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="createEmployeeModal">Agregar Nuevo Empleado</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
		    	<form method="POST" action="{{ route('empleado.create') }}" id="formEmployee">
		    		@csrf
				  <div class="mb-3 row">
				    <label for="cedula" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Cedula</label>
				    <div class="col-sm">
				      <input type="number" min="0" class="form-control" id="cedula" name="cedula" required>
				    </div>
				  </div>   		    		
				  <div class="mb-3 row">
				    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Nombre</label>
				    <div class="col-sm">
				      <input type="text" class="form-control" id="name" name="name" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="email" class="col-sm-5 col-form-label fw-bold text-center text-md-end">E-Mail</label>
				    <div class="col-sm">
				      <input type="email" class="form-control" id="email" name="email" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="direccion" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Direccion</label>
				    <div class="col-sm">
				    	<textarea class="form-control" id="direccion" name="direccion" required></textarea>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="contacto" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Contacto</label>
				    <div class="col-sm">
				      <input type="number" min="0" class="form-control" id="contacto" name="contacto" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="fecha_nacimiento" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Fecha/Nacimiento</label>
				    <div class="col-sm">
				      <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="genero" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Sexo</label>
				    <div class="col-sm">
						<select class="form-select" aria-label="Generos" id="genero" name="genero" required>
						  <option selected disabled>- No seleccionado -</option>
						  <option value="Hombre">Hombre</option>
						  <option value="Mujer">Mujer</option>
						</select>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="rif" class="col-sm-5 col-form-label fw-bold text-center text-md-end">RIF</label>
				    <div class="col-sm">
				      <input type="number" min="0" class="form-control" id="rif" name="rif" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="profesion" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Profesion</label>
				    <div class="col-sm">
						<input type="text" class="form-control" id="profesion" name="profesion" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="dpto" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Departamento</label>
				    <div class="col-sm">
						<select class="form-select" aria-label="Dptos" id="dpto" name="dpto" required>
						  	<option selected disabled>- No seleccionado -</option>
							@if($departamentos) 
								@foreach($departamentos as $dpto)
								   <option value="{{ $dpto->name }}">{{ $dpto->name }}</option>
								@endforeach
							@endif
						</select>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="cargo" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Cargo</label>
				    <div class="col-sm">
						<select class="form-select" aria-label="Cargos" id="cargo" name="cargo" required>
						  	<option selected disabled>- No seleccionado -</option>
							@if($cargos) 
								@foreach($cargos as $cargo)
								   <option value="{{ $cargo->name }}">{{ $cargo->name }}</option>
								@endforeach
							@endif
						</select>
				    </div>
				  </div>
				  	<div class="mb-3 row">
				    	<label for="horario" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Horario</label>
				    	<div class="col-sm">
							<select class="form-select" aria-label="Horarios" id="horario" name="horario" required>
						  		<option selected disabled>- No seleccionado -</option>
								@if($horarios) 
									@foreach($horarios as $horario)
									   <option value="{{ $horario->hour_in }} - {{ $horario->hour_out }}">{{ $horario->hour_in }} - {{ $horario->hour_out }}</option>
									@endforeach
								@endif
							</select>
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

	<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editEmployeeModal">Actualizar Empleado</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
		    	<form method="POST" action="{{ route('empleado.edit') }}" id="formEmployee">
		    		@csrf
				  <div class="mb-3 row">
				    <label for="name" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Nombre</label>
				    <div class="col-sm">
				      <input type="text" class="form-control" id="name" name="name" required>
				    </div>
				  </div>         
				  <div class="mb-3 row">
				    <label for="cedula" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Cedula</label>
				    <div class="col-sm">
				      <input type="number" min="0" class="form-control" id="cedula" name="cedula" required>
				    </div>
				  </div>    
				  <div class="mb-3 row">
				    <label for="email" class="col-sm-5 col-form-label fw-bold text-center text-md-end">E-Mail</label>
				    <div class="col-sm">
				      <input type="email" class="form-control" id="email" name="email" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="direccion" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Direccion</label>
				    <div class="col-sm">
				    	<textarea class="form-control" id="direccion" name="direccion" required></textarea>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="contacto" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Contacto</label>
				    <div class="col-sm">
				      <input type="number" min="0" class="form-control" id="contacto" name="contacto" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="fecha_nacimiento" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Fecha/Nacimiento</label>
				    <div class="col-sm">
				      <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="genero" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Sexo</label>
				    <div class="col-sm">
						<select class="form-select" aria-label="Generos" id="genero" name="genero" required>
						  <option selected disabled>- No seleccionado -</option>
						  <option value="Hombre">Hombre</option>
						  <option value="Mujer">Mujer</option>
						</select>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="rif" class="col-sm-5 col-form-label fw-bold text-center text-md-end">RIF</label>
				    <div class="col-sm">
				      <input type="number" min="0" class="form-control" id="rif" name="rif" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="profesion" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Profesion</label>
				    <div class="col-sm">
						<input type="text" class="form-control" id="profesion" name="profesion" required>
				    </div>
				  </div>
				  <div class="mb-3 row">
				    <label for="dpto" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Departamento</label>
				    <div class="col-sm">
						<select class="form-select" aria-label="Dptos" id="dpto" name="dpto" required>
						  	<option selected disabled>- No seleccionado -</option>
							@if($departamentos) 
								@foreach($departamentos as $dpto)
								   <option value="{{ $dpto->name }}">{{ $dpto->name }}</option>
								@endforeach
							@endif
						</select>
				    </div>
				  </div>

				  	<div class="mb-3 row">
				    	<label for="cargo" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Cargo</label>
				    	<div class="col-sm">
							<select class="form-select" aria-label="Cargos" id="cargo" name="cargo" required>
						  		<option selected disabled>- No seleccionado -</option>
								@if($cargos) 
									@foreach($cargos as $cargo)
									   <option value="{{ $cargo->name }}">{{ $cargo->name }}</option>
									@endforeach
								@endif
							</select>
				    	</div>
				  	</div>

				  	<div class="mb-3 row">
				    	<label for="horario" class="col-sm-5 col-form-label fw-bold text-center text-md-end">Horario</label>
				    	<div class="col-sm">
							<select class="form-select" aria-label="Horarios" id="horario" name="horario" required>
						  		<option selected disabled>- No seleccionado -</option>
								@if($horarios) 
									@foreach($horarios as $horario)
									   <option value="{{ $horario->hour_in }} - {{ $horario->hour_out }}">{{ $horario->hour_in }} - {{ $horario->hour_out }}</option>
									@endforeach
								@endif
							</select>
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

	<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteEmployeeModalLabel">Eliminar Empleado</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	    	<form method="POST" action="{{ route('empleado.delete') }}">
	    		@csrf
	    		<div class="text-center mb-4">¿Estas seguro de eliminar a este empleado?</div>
	    		<div id="name" class="text-center fs-4 fw-bold mb-4"></div>
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