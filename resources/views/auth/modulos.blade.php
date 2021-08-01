@extends("layout")

@section("content")

<div class="sysnomina-auth-form d-flex justify-content-center align-items-center py-4">
	<div class="card card-mobile auth-max-width-md">
		<div class="d-flex flex-column">
			<div class="auth-header d-flex justify-content-center align-items-center">
				<i class="auth-icon bi bi-door-open"></i>
			</div>
				
			<div class="auth-header-text text-center fw-bold text-primary">Módulos</div>
		</div>
		<div class="auth-content card-body">

				<div class="input-group mb-3">
					<a href="{{ route('nomina.index') }}" class="btn btn-primary btn-flat d-flex align-items-center w-100">
						<i class="auth-icon-left me-3 bi bi-door-open-fill"></i>
						<div class="d-flex flex-column">
							<strong class="text-start">Nómina</strong>
							<small class="text-start">Acceso al módulo integral para el manejo de nóminas y empleados</small>
						</div>
					</a>
				</div>
				<div class="input-group mb-5">
					<a href="{{ route('prenomina.index') }}" class="btn btn-primary btn-flat d-flex align-items-center w-100">
						<i class="auth-icon-left me-3 bi bi-door-open-fill"></i>
						<div class="d-flex flex-column">
							<strong class="text-start">Pre Nómina</strong>
							<small class="text-start">Acceso al módulo para el registro de datos por departamento</small>
						</div>
					</a>
				</div>
				<div class="input-group mb-3">
					<a href="{{ route('logout') }}" class="text-primary mx-auto">Iniciar sesión con otra ID</i></a>
				</div>
		</div>
	</div>
</div>

@endsection