 <!-- Barra de navegación -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/img/logo/Logo.png" style="max-height: 120px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/admin/usuarios">Gestión de Usuarios</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="utilidadesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Utilidades
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="utilidadesDropdown">
                            <li><a class="dropdown-item" href="/admin/utilidades/basedatos">Base de Datos</a></li>
                            <li><a class="dropdown-item" href="/admin/utilidades/opciones">Opciones</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/admin/contactos">Formulario de Contactos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>