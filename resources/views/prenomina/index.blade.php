@extends("layout")

@section("content")

<div class="container">
	@include('layouts.alerts')

	<div class="card card-body card-flat mb-3">
		<div class="row align-items-center">
			<div class="col-md mb-3 mb-md-0">
				@if (!isset($current_dpto))
					<div class="fs-4 fw-bold text-dark text-center text-md-start">Dashboard</div>
				@else
					<div class="fs-4 fw-bold text-dark text-center text-md-start">{{$current_dpto->name}}</div>
				@endif			
			</div>
			<div class="col-md mb-3 mb-md-0">
					<div class="dropdown d-grid d-md-flex justify-content-md-center float-md-end">
						<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuSelectDpto" data-bs-toggle="dropdown" aria-expanded="false">
						    Unidad o Departamento
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuSelectDpto">
						  	<li class="input-group p-2">
						        <input type="search" id="search-input-dropdown" class="form-control form-control-sm" placeholder="Buscar" />
						  	</li>

						  	<li><hr class="dropdown-divider"/></li>

							@if($departamentos) 
								@foreach($departamentos as $dpto)
									<li><a class="dropdown-item input-group-dropdown-item" href="{{ route('prenomina.show', ['id' => $dpto->id]) }}"><i class="bi bi-building"></i> {{$dpto->name}}</a></li>
								@endforeach
							@endif
						</ul>
					</div>
				
			</div>
		</div>
	</div>

	@if (!empty($id))
		<div class="card card-body card-flat mb-3">
			<div class="row align-items-center mb-3 border-bottom">
				<div class="col-md mb-3">
					<div class="fs-5 fw-bold text-dark text-center text-md-start">Estadísticas</div>		
				</div>
			</div>

			<div class="row">
				<div class="col-sm">
					<div class="card mb-3 bg-secondary text-light">
						<div class="card-body d-flex w-100 text-center">
							<i class="target-icon bi bi-people"></i>

							<div class="d-flex flex-column w-100">
								<div class="mt-2 mb-0">Empleados</div>
								<div class="mb-2 fs-3">{{ $empleados }}</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm">
					<div class="card mb-3 bg-info text-light">
						<div class="card-body d-flex w-100 text-center">
							<i class="target-icon bi bi-calendar-check"></i>

							<div class="d-flex flex-column w-100">
								<div class="mt-2 mb-0">Asistencias</div>
								<div class="mb-2 fs-3">{{ $asistencias }}</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm">
					<div class="card mb-3 bg-success text-light">
						<div class="card-body d-flex w-100 text-center">
							<i class="target-icon bi bi-clock-history"></i>

							<div class="d-flex flex-column w-100">
								<div class="mt-2 mb-0">A tiempo hoy</div>
								<div class="mb-2 fs-3">{{ $a_tiempo }}</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm">
					<div class="card mb-3 bg-warning text-light">
						<div class="card-body d-flex w-100 text-center">
							<i class="target-icon bi bi-exclamation-triangle"></i>

							<div class="d-flex flex-column w-100">
								<div class="mt-2 mb-0">Tarde hoy</div>
								<div class="mb-2 fs-3">{{ $tarde_hoy }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>

@endsection