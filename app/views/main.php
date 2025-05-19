<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto Web</title>
    <!-- Bootstrap CSS desde CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/styles.css"> <!--CSS personalizado -->
</head>
<body>
    <!-- Barra de navegación -->
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
                <?php endif; ?>                <li class="nav-item"><a class="nav-link" href="/reservar">Reservar</a></li>
                <li class="nav-item"><a class="nav-link" href="#contactar">Contactar</a></li>
                <li class="nav-item"><a class="nav-link" href="#apartamento">Apartamento</a></li>
                <li class="nav-item"><a class="nav-link" href="#donde">Dónde Estamos</a></li>
                <li class="nav-item"><a class="nav-link" href="#destacar">A Destacar</a></li>
                <li class="nav-item"><a class="nav-link" href="#galeria">Galería</a></li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Sección con imagen y texto -->
    <div class="position-relative"> <!-- Agregar margen superior -->
    <img src="/img/Dormitorio 1.jpg" class="img-fluid w-100" alt="cama de matrimonio de la habitacion">
    <div class="position-absolute top-50 start-50 translate-middle bg-light p-4 text-center dialog-box rounded shadow">
        <h1 class="mb-3">Bienvenido a <strong>Malaga</strong></h1>
        <p class="mb-4 dialg-box">Tu apartamento para pasar unos días en <strong>Malaga</strong></p>
        <div>
            <a href="#contactar" class="btn btn-custom-left btn-lg me-2">Contactar</a>
            <a href="#donde" class="btn btn-custom-right btn-lg">Dónde Estamos</a>
        </div>
    </div>
    </div>
    
    <section id="contactar" class="container mt-5">
    <div class="container mt-5">
    <h2 class="text-center mb-4">Contactar</h2>
    <form id="contactForm" method="POST" class="p-4 rounded shadow bg-light">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Introduce tu nombre" value="Juanjo" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu email" value="aa@aa.com" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Introduce tu teléfono" value="666777888" required>
    </div>
    <div class="mb-3">
        <label for="checkin" class="form-label">Fecha de entrada</label>
        <input type="date" class="form-control" id="checkin" name="checkin" value="2023-10-01" required>
    </div>
    <div class="mb-3">
        <label for="checkout" class="form-label">Fecha de salida</label>
        <input type="date" class="form-control" id="checkout" name="checkout" value="2023-12-12" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Mensaje</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Escribe tu mensaje aquí..."></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
    </div>
</form>
<!-- Contenedor para mostrar el mensaje -->
<div id="formResponse" class="mt-3"></div>
</div>
    </section>
    <section id="apartamento" class="container mt-5">
<div class="container mt-5">
    <h1 class="mb-3 text-center">Apartamento en Malaga</h1>

    <div class="row align-items-center">
        
        <!-- Imagen a la izquierda -->
        <div class="col-md-6">
            <img src="/img/Salon 9.jpg" class="img-fluid rounded shadow" alt="Descripción de la imagen">
        </div>
        <!-- Texto a la derecha -->
        <div class="col-md-6">
            <p class="mb-4 dialg-box">Situado a excasos metros de la estacion de autobuses y tren, ambas <strong> conexion directa al aeropuerto.</strong> Parada de metro y autobus cercana, para moverte por el centro de Malaga y asi, olvidarte del coche.</p>
            <p class="mb-4 dialg-box"><strong> Piso de 60m recientemente reformado,</strong> ubicado en un <strong>barrio tranquilo.</strong> Totalmente exterior, con una cocina totalmente equipada (lavadora, horno, etc), dormitorio con ventilador de techo, cama de matrimonio, salon-comedor con sofacama, smart tv, aire acondicionado (frio/calor), mesa de comedor con 4 sillas y escritorio de trabajo y baño con plato de ducha, toallas, gel y secador de pelo.</p>
            <p>Barrio céntrico, ideal para <strong>visitar Malaga y huir del bullicio del centro de la ciudad.</strong> Cerca tenemos varios supermercados y centros comerciales, farmacia, bares, restaurantes, panadería, asador, gimnasio, heladería, etc.</p>
            <ul>
                <li>Wifi gratis</li>
                <li>Smart TV</li>
                <li>Aire acondicionado</li>
                <li>Calefacción</li>
                <li>Lavadora</li>
                <li>Secador de pelo</li>
                <li>HBO incluido</li>
                <li>No se admiten mascotas</li>
                <li>Prohibido fumar</li>
                <li>Prohibido hacer ruido desde las <strong> 21:00 </strong> hasta las <strong> 9:00</strong>, para el descanso de los vecinos</li>
            </ul>
        </div>
    </div>
</div>
    </section>
    <section id="donde" class="container mt-5">  
<div class="container mt-5">
    <h1 class="text-center mb-4">Dónde Estamos</h1>
    <div class="row align-items-center">
        <!-- Mapa de Google Maps a la izquierda -->
        <div class="col-md-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3198.128763120977!2d-4.424149922351532!3d36.719468672270324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72f795b1a4f35f%3A0xf3d44789b8b0e006!2sC.%20Marqu%C3%A9s%20de%20Larios%2C%20Distrito%20Centro%2C%20M%C3%A1laga!5e0!3m2!1ses!2ses!4v1743370852286!5m2!1ses!2ses" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
        <!-- Dirección a la derecha -->
        <div class="col-md-4">
            <h3 class="mb-3">Nuestra Dirección</h3>
            <p>Calle Larios, 123</p>
            <p>29001 Málaga, España</p>
        </div>
    </div>
</div>
    </section>
    <section id="destacar" class="container mt-5">
<div class="container mt-5">
    <h1 class="text-center mb-4">A Destacar</h1>
    <div class="row align-items-center mb-4">
        <!-- Imagen más grande -->
        <div class="col-md-5">
            <img src="/img/Exteriores 4.jpg" class="img-fluid rounded shadow" alt="Descripción de la imagen">
        </div>
        <!-- Texto más pequeño -->
        <div class="col-md-7">
            <h2>Disfruta de Malaga</h2>
            <p>En pleno centro de Malaga.</p>
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <!-- Imagen más grande -->
        <div class="col-md-5">
            <img src="/img/Exteriores 2.jpg" class="img-fluid rounded shadow" alt="Descripción de la imagen">
        </div>
        <!-- Texto más pequeño -->
        <div class="col-md-7">
            <h2>Cerca de Vialia</h2>
            <p>A 5 minutos de la estacion de tren y autobus.</p>
        </div>
    </div>
    <div class="row align-items-center">
        <!-- Imagen más grande -->
        <div class="col-md-5">
            <img src="/img/Salon 4.jpg" class="img-fluid rounded shadow" alt="Descripción de la imagen">
        </div>
        <!-- Texto más pequeño -->
        <div class="col-md-7">
            <h2>Ideal para teletrabajar</h2>
            <p>Equipado para cuando tengas que teletrabajar, con conexion de fibra optica.</p>
        </div>
    </div>
</div>
    </section>
<section id="galeria" class="container mt-5">
<div class="container mt-5">
    <h1 class="text-center mb-4">Galería</h1>
    <!-- Fila 1 -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-2">
            <img src="/img/Bath 1.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 1" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Bath 1.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Bath 2.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 2" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Bath 2.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Bath 3.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 3" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Bath 3.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Cocina 1.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 4" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Cocina 1.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Cocina 2.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 5" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Cocina 2.jpg">
        </div>
    </div>
    <!-- Fila 2 -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-2">
            <img src="/img/Cocina 4.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 6" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Cocina 4.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Cocina 5.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 7" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Cocina 5.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Dormitorio 1.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 8" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Dormitorio 1.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Dormitorio 2.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 9" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Dormitorio 2.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Dormitorio 3.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 10" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Dormitorio 3.jpg">
        </div>
    </div>
    <!-- Fila 3 -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-2">
            <img src="/img/Dormitorio 4.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 11" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Dormitorio 4.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Salon 1.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 12" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Salon 1.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Salon 7.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 13" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Salon 7.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Salon 8.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 14" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Salon 8.jpg">
        </div>
        <div class="col-md-2">
            <img src="/img/Salon 12.jpg" class="img-fluid rounded shadow gallery-img" alt="Imagen 15" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="/img/Salon 12.jpg">
        </div>
    </div>
</div>

</section>
<!-- Modal para la galería -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body position-relative">
                <!-- Flecha izquierda -->
                <button class="btn btn-dark position-absolute top-50 start-0 translate-middle-y" id="prevImage" style="z-index: 1050;">
                    &#8249;
                </button>
                <!-- Imagen ampliada -->
                <img src="" class="img-fluid" id="galleryModalImage" alt="Imagen ampliada">
                <!-- Flecha derecha -->
                <button class="btn btn-dark position-absolute top-50 end-0 translate-middle-y" id="nextImage" style="z-index: 1050;">
                    &#8250;
                </button>
            </div>
        </div>
    </div>
</div>


    <main class="container mt-5">
        
    </main>
    
    <?php require __DIR__ . '/footer.php'; ?>
    
<!-- Modal para Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog"> <!-- El estilo del ancho y la posición está en style.css -->
        <div class="modal-content"> <!-- Fondo blanco y padding definidos en style.css -->
            <div class="modal-header text-center">
                <h5 class="modal-title w-100" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" class="text-center">
                    <div class="mb-3">
                        <label for="username" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="text-center d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary me-2">Iniciar Sesión</button>
                        <a href="/registro" class="btn btn-primary">Registrarse</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
    <script src="/js/scripts.js"></script> 
</body>
</html>
