@extends("layout")

@section("content")

<div class="container">
	@include('layouts.alerts')
	
	<div class="card card-body card-flat">
		<div class="row align-items-center mb-3 border-bottom">
			<div class="col-md mb-3">
				<div class="fs-4 fw-bold text-dark text-center text-md-start">Cargar Nómina</div>
			</div>

			<form id="nominaFormHeader" method="POST" action="{{ route('nomina.open') }}" class="col-md-auto mb-3">
				@csrf
				<div class="row">
					<div class="col-md mb-3 mb-md-0">
						<div class="input-group">

							@if (session()->has('from_to')) 
								<input type="text" class="form-control" name="daterange_nom" value="{{ session()->get('from_to') }}">
							@else
								<input type="text" class="form-control" name="daterange_nom" value=" ">
							@endif

							<span class="input-group-text bg-secondary text-light"><i class="bi bi-calendar3-range"></i></span>
						</div>
					</div>
					<div class="col-md-auto mb-md-0">
						<div class="d-grid gap-3 d-md-block float-md-end">
							<a class="btn btn-success @if (!session()->has('from_to')) disabled @endif" href="{{ route('nomina.process') }}" role="button" data-bs-toggle="modal" data-bs-target="# s"><i class="bi bi-upload"></i> Procesar</a>
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
								<th scope="col">Asignaciones</th>
								<th scope="col">Deducciones</th>
								<th scope="col">Saldo Acum.</th>
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

								      	@if (isset($nominas[$empleado->id]))
									      	@if (isset($nominas[$empleado->id]->neto))
									      		<td data-label="Asignaciones">{{ $nominas[$empleado->id]->total_asignaciones }}</td>
									      		<td data-label="Deducciones">{{ $nominas[$empleado->id]->total_deducciones }}</td>
									      		<td data-label="Saldo Acumulado">{{ $nominas[$empleado->id]->neto }}</td>

												<td data-label="Estado">
													<span class="badge bg-success rounded-pill">Registrado</span>
												</td>
											@else
									      		<td data-label="Asignaciones">0</td>
									      		<td data-label="Deducciones">0</td>
									      		<td data-label="Saldo Acumulado">0</td>

												<td data-label="Estado">
													<span class="badge bg-danger rounded-pill">Sin monto</span>
												</td>

											@endif

											<td data-label="Acciones">
												<a class="btn btn-info btn-sm" href="#" role="button" employeeName="{{$empleado->name}}" employeeSalary="{{ number_format($salarios[$empleado->name], 2) }}" data-array="{{ json_encode($nominas[$empleado->id]) }}" employee-id="{{ $empleado->id }}" daterange="{{ session()->get('from_to') }}" data-bs-toggle="modal" data-bs-target="#applyNominaConceptosModal"><i class="bi bi-pencil-square"></i> Detalles</a>
											</td>
										@else
								      		<td data-label="Asignaciones">0</td>
								      		<td data-label="Deducciones">0</td>
								      		<td data-label="Saldo Acumulado">0</td>

											<td data-label="Estado">
												<span class="badge bg-warning rounded-pill">Pendiente</span>
											</td>
											<td data-label="Acciones">
												<a class="btn btn-info btn-sm" href="#" role="button" employeeName="{{$empleado->name}}" employeeSalary="{{ number_format($salarios[$empleado->name], 2) }}" employee-id="{{ $empleado->id }}" daterange="{{ session()->get('from_to') }}" data-bs-toggle="modal" data-bs-target="#applyNominaConceptosModal"><i class="bi bi-pencil-square"></i> Detalles</a>
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

	<div class="modal fade" id="applyNominaConceptosModal" tabindex="-1" aria-labelledby="applyNominaConceptosModal" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="applyNominaConceptosModalLabel">Detalles</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
				<table class="table">
					<thead class="table-dark">
				    <tr>
						<th scope="col"style="width: 50%;">Empleado</th>
						<th scope="col"style="width: 50%;">Salario Diario</th>
					</tr>
					</thead>
					<tbody>
					    <tr>
							<td data-label="Empleado">
								<input type="text" class="form-control" id="nominaEmployeeName" value="" readonly>
							</td>
							<td data-label="Salario Diario">
								<input type="text" class="form-control" id="nominaEmployeeSalario" value="" readonly>
							</td>
						</tr>
						<tr>
							<td colspan="3">
						    	<form id="applyConceptosModalForm" method="POST" action="{{ route('nomina.store') }}">
						    		@csrf

									<table class="table">
										<thead>
									    <tr>
											<th scope="col">Asignaciones</th>
											<th scope="col">Cantidad</th>
											<th scope="col">Monto</th>
										</tr>
										</thead>
										<tbody>
												@if($asignaciones) 
													@foreach($asignaciones as $asignacion)
														<tr>
															<td data-label="Asignación">{{ $asignacion->name }}</td>
															<td data-label="Cantidad">
																<input type="number" min="0" id="A:{{ $asignacion->id }}" name="{{ str_replace(' ', '_', $asignacion->name) }}" style="width: 80px;" class="form-control form-control-sm text-center ms-auto ms-md-0" aria-label="{{ $asignacion->name }}" required>
															</td>
															<td data-label="number">
																<input type="number" min="0" id="A:{{ $asignacion->id }}:amount" name="{{ str_replace(' ', '_', $asignacion->name) }}:amount" style="width: 80px;" class="form-control form-control-sm text-center ms-auto ms-md-0" aria-label="{{ $asignacion->name }}" required>
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
											<th scope="col">Monto</th>
										</tr>
										</thead>
										<tbody>
												@if($deducciones) 
													@foreach($deducciones as $deduccion)
														<tr>
															<td data-label="Deducción">{{ $deduccion->name }}</td>
															<td data-label="Cantidad">
																<input type="number" min="0" id="D:{{ $deduccion->id }}" name="{{ str_replace(' ', '_', $deduccion->name) }}" style="width: 80px;" class="form-control form-control-sm text-center ms-auto ms-md-0" aria-label="{{ $deduccion->name }}" required>
															</td>
															<td data-label="Monto">
																<input type="number" min="0" id="D:{{ $deduccion->id }}:amount" name="{{ str_replace(' ', '_', $deduccion->name) }}:amount" style="width: 80px;" class="form-control form-control-sm text-center ms-auto ms-md-0" aria-label="{{ $deduccion->name }}" required>
															</td>
														</tr>
													@endforeach
												@endif
										</tbody>
									</table>

						    		<input type="text" class="form-control visually-hidden" id="from_to" name="from_to" value="" readonly>
						    		<input type="text" class="form-control visually-hidden" id="id" name="id" value="" readonly>

							      <div class="modal-footer border-0">
							        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cancelar</button>
							        <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Cargar</button>
							      </div>			  
						    	</form>
							</td>
						</tr>
					</tbody>
				</table>
	      </div>
	    </div>
	  </div>
	</div>


@endsection