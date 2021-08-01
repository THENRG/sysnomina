@extends("layout")

@section("content")

<div class="sysnomina-auth-form d-flex justify-content-center align-items-center py-4">
	<div class="card card-mobile auth-max-width">
		<div class="d-flex flex-column">
			<div class="auth-header d-flex justify-content-center align-items-center">
				<i class="auth-icon bi bi-person-plus"></i>
			</div>
				
			<div class="auth-header-text text-center fw-bold text-primary">Registro de Usuario</div>
		</div>
				
		<div class="auth-content card-body">
			<form method="POST" action="{{ route('auth.signup') }}">
				@csrf

				<div class="input-group mb-3">
			  		<span class="input-group-text" id="basic-addon1"><i class="bi bi-credit-card-2-front-fill"></i></span>
					<input type="text" id="name" name="name" class="form-control form-control-md @error('key') is-invalid @enderror" placeholder="Nombre del Usuario" aria-label="Nombre del Usuario">
				</div>

				<div class="input-group mb-3">
			  		<span class="input-group-text" id="basic-addon1"><i class="bi bi-credit-card-2-front-fill"></i></span>
					<input type="text" id="cedula" name="cedula" class="form-control form-control-md @error('key') is-invalid @enderror" placeholder="Cedula de Identidad" aria-label="Cédula">
				</div>

				<div class="input-group mb-5">
			  		<span class="input-group-text" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
					<input type="password" id="password" name="password" class="form-control form-control-md @error('key') is-invalid @enderror" placeholder="Contraseña" aria-label="Contraseña">
				</div>				

				<div class="input-group mb-3">
					<button type="submit" class="btn btn-success btn-md mx-auto">Crear</button>
				</div>
			</form>
		</div>
		
	</div>
</div>

@endsection
