    
    
<?php 
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 2) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 1050; position: relative;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/img/logo/Logo.png" style="max-height: 120px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($_SESSION['user']['level'] == 1): ?>
                        <!-- Usuario administrador -->
                        <li class="nav-item"><a class="nav-link" href="/admin/panel">Panel de Administrador</a></li>
                    <?php else: ?>
                        <!-- Usuario normal -->
                        <li class="nav-item"><a class="nav-link" href="/user/panel">Mi Perfil</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Usuario no logueado -->
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="/reservar">Reservar</a></li>
                <li class="nav-item"><a class="nav-link" href="/#contactar">Contactar</a></li>
                <li class="nav-item"><a class="nav-link" href="/#apartamento">Apartamento</a></li>
                <li class="nav-item"><a class="nav-link" href="/#donde">Dónde Estamos</a></li>
                <li class="nav-item"><a class="nav-link" href="/#destacar">A Destacar</a></li>
                <li class="nav-item"><a class="nav-link" href="/#galeria">Galería</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php 

}
elseif ( $_SESSION['user']['level'] == 1) { ?>
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
<?php }
elseif ( $_SESSION['user']['level'] == 2) { 
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="/img/logo/Logo.png" style="max-height: 120px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/reservar">Reservar</a></li>
                <li class="nav-item"><a class="nav-link" href="/#contactar">Contactar</a></li>
                <li class="nav-item"><a class="nav-link" href="/user/panel">Mi Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="/user/reservas">Mis Reservas</a></li>
                <li class="nav-item"><a class="nav-link" href="/logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php }?>