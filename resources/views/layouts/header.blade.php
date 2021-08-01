<nav class="navbar navbar-light w-100">
  <div class="container-fluid">
      <div class="d-flex">
        <button class="navbar-toggler" type="button" id="sidebarToggleHolder" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fs-3 bi bi-justify"></i>
        </button>
      </div>

      <div class="d-flex">
        <div class="dropdown">
          <a class="btn btn-primary dropdown-toggle" style="min-width: 200px" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            @if (session()->has('userName'))
              {{ session()->get('userName') }}
            @endif
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="{{ route('auth.modulos') }}">Cambiar módulo</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
  </div>
</nav>