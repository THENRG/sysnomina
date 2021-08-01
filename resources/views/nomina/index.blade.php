@extends("layout")

@section("content")

<div class="container">
	@include('layouts.alerts')

	<div class="card card-body card-flat mb-3">
		<div class="row align-items-center">
			<div class="col-md mb-3 mb-md-0">
				<div class="fs-4 fw-bold text-dark text-center text-md-start">Dashboard</div>		
			</div>
		</div>
	</div>

		<div class="card card-body card-flat mb-3">
			<div class="row align-items-center mb-3 border-bottom">
				<div class="col-md mb-3">
					<div class="fs-5 fw-bold text-dark text-center text-md-start">Estadísticas</div>		
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="card mb-3 bg-secondary text-light">
						<div class="card-body d-flex w-100 text-center">
							<i class="target-icon bi bi-people"></i>

							<div class="d-flex flex-column w-100">
								<div class="mt-2 mb-0">Total de Empleados</div>
								<div class="mb-2 fs-3">{{ $empleados }}</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card mb-3 bg-secondary text-light">
						<div class="card-body d-flex w-100 text-center">
							<i class="target-icon bi bi-building"></i>

							<div class="d-flex flex-column w-100">
								<div class="mt-2 mb-0">Total de Unidades</div>
								<div class="mb-2 fs-3">{{ $departamentos }}</div>
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
								<div class="mt-2 mb-0">A Tiempo Hoy</div>
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
								<div class="mt-2 mb-0">Tarde Hoy</div>
								<div class="mb-2 fs-3">{{ $tarde_hoy }}</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm">
					<div class="card mb-3 bg-danger text-light">
						<div class="card-body d-flex w-100 text-center">
							<i class="target-icon bi bi-exclamation-triangle"></i>

							<div class="d-flex flex-column w-100">
								<div class="mt-2 mb-0">Pre Nominas</div>
								<div class="mb-2 fs-3">{{ $rep_prenom }}</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
</div>


@endsection