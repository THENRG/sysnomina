@if (session()->has('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<h4 class="alert-heading">¡Proceso Exitoso!</h4>
		<p>{{session()->get('success')}}</p>

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif

@if (session()->has('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<h4 class="alert-heading">¡Error!</h4>
		<p>{{session()->get('error')}}</p>

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif

@if (session()->has('info'))
	<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<h4 class="alert-heading">¡Información!</h4>
		<p>{{session()->get('info')}}</p>

		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
@endif