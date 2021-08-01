<nav class="navbar navbar-dark">
      	<ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
	          	@if (session()->get('modulo') == "nomina")
				  	<li class="nav-item">
				    	<a class="nav-link" href="{{ route('nomina.index') }}">
				    		<i class="bi bi-graph-up"></i> 
				    		<span>Dashboard</span>
				    	</a>
				  	</li>
				@elseif (session()->get('modulo') == "prenomina")
					@if (session()->has('dpto'))
					  	<li class="nav-item">
					    	<a class="nav-link" href="{{ route('prenomina.show', ['id' => session()->get('dpto')]) }}">
					    		<i class="bi bi-graph-up"></i> 
					    		<span>Dashboard</span>
					    	</a>
					  	</li>
					@else
					  	<li class="nav-item">
					    	<a class="nav-link" href="{{ route('prenomina.index') }}">
					    		<i class="bi bi-graph-up"></i> 
					    		<span>Dashboard</span>
					    	</a>
					  	</li>
					@endif 
				@endif  

	          	@if (session()->get('modulo') == "nomina")
				  	<li class="nav-item">
				    	<a class="nav-link" href="{{ route('asistencias.index') }}"><i class="bi bi-calendar-check"></i><span>Asistencias</span></a>
				  	</li>

				  	<li class="nav-item">
				    	<a class="nav-link" href="{{ route('reportes.index') }}"><i class="bi bi-file-earmark"></i><span>Reportes</span></a>
				  	</li>
				@elseif (session()->get('modulo') == "prenomina")
					@if (session()->has('dpto')) 
				  	<li class="nav-item">
				    	<a class="nav-link" href="{{ route('asistencias.index') }}"><i class="bi bi-calendar-check"></i><span>Asistencias</span></a>
				  	</li>

				  	<li class="nav-item">
				    	<a class="nav-link" href="{{ route('reportes.index') }}"><i class="bi bi-file-earmark"></i><span>Reportes</span></a>
				  	</li>
					@endif 
				@endif  

	        <li class="dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="bi bi-gear"></i><span>Procesos</span>
	          </a>
	          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
	          	@if (session()->get('modulo') == "nomina")
				  <li class="nav-item">
				    	<a class="dropdown-item text-white" href="{{ route('nomina.load') }}">Cargar Nomina</a>
				  </li>
				@elseif (session()->get('modulo') == "prenomina")
					@if (session()->has('dpto')) 
					  <li class="nav-item">
					    <a class="dropdown-item text-white" href="{{ route('prenomina.load', ['id' => session()->get('dpto')]) }}">Registrar Pre Nomina</a>
					  </li>
					@endif 
				@endif  
	          </ul>
	        </li>

		@if (session()->get('modulo') == "nomina")
		  	<li class="nav-item">
		    	<a class="nav-link" href="{{ route('empleados.index') }}"><i class="bi bi-people"></i><span>Empleados</span></a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="{{ route('cargos.index') }}"><i class="bi bi-bar-chart-line"></i><span>Cargos</span></a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="{{ route('departamentos.index') }}"><i class="bi bi-building"></i><span>Departamentos</span></a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="{{ route('asignaciones.index') }}"><i class="bi bi-journal-plus"></i><span>Asignaciones</span></a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="{{ route('deducciones.index') }}"><i class="bi bi-journal-minus"></i><span>Deducciones</span></a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="{{ route('horarios.index') }}"><i class="bi bi-calendar3"></i><span>Horarios</span></a>
		  	</li>
		@endif
    </ul>
</nav>