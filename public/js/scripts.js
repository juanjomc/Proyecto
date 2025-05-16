// Este archivo contiene el código JavaScript personalizado para la aplicación.

document.addEventListener("DOMContentLoaded", function () {
    const galleryImages = document.querySelectorAll(".gallery-img");
    const modalImage = document.getElementById("galleryModalImage");
    const prevButton = document.getElementById("prevImage");
    const nextButton = document.getElementById("nextImage");

    let currentIndex = 0;

    // Abrir el modal con la imagen seleccionada
    galleryImages.forEach((img, index) => {
        img.addEventListener("click", function () {
            const imageSrc = this.getAttribute("data-bs-image");
            modalImage.setAttribute("src", imageSrc);
            currentIndex = index;
        });
    });

    // Función para mostrar la imagen anterior
    prevButton.addEventListener("click", function () {
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        const prevImageSrc = galleryImages[currentIndex].getAttribute("data-bs-image");
        modalImage.setAttribute("src", prevImageSrc);
    });

    // Función para mostrar la imagen siguiente
    nextButton.addEventListener("click", function () {
        currentIndex = (currentIndex + 1) % galleryImages.length;
        const nextImageSrc = galleryImages[currentIndex].getAttribute("data-bs-image");
        modalImage.setAttribute("src", nextImageSrc);
    });
});

document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Evitar el envío tradicional del formulario

    const formData = new FormData(this); // Capturar los datos del formulario

    fetch('/contact/store', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        const responseDiv = document.getElementById('formResponse');

        if (data.success) {
            responseDiv.innerHTML = '<div class="alert alert-success fade-out">Formulario enviado correctamente.</div>';
            this.reset(); // Limpiar el formulario

            // Mostrar el mensaje
            responseDiv.style.display = 'block';

            // Desaparecer mensaje progresivamente
            setTimeout(() => {
                responseDiv.querySelector('.fade-out').classList.add('hidden');
            }, 4000);

            setTimeout(() => {
                responseDiv.innerHTML = '';
                responseDiv.style.display = 'none';
            }, 6000);
        } else {
            responseDiv.innerHTML = '<div class="alert alert-danger">Hubo un error al enviar el formulario: ' + (data.error || 'Error desconocido') + '</div>';
            responseDiv.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        const responseDiv = document.getElementById('formResponse');
        responseDiv.innerHTML = '<div class="alert alert-danger">Error al procesar la solicitud.</div>';
        responseDiv.style.display = 'block';
    });
});

document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar que el formulario recargue la página

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    console.log('Datos enviados:', { username, password });

    fetch('/login/authenticate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.level === 1) {
                    window.location.href = '/admin/usuarios'; // Redirigir a la página de administrador
                } else if (data.level === 2) {
                    window.location.href = '/user/panel'; // Redirigir a la página de usuario
                }
            } else {
                alert(data.message || 'Error al iniciar sesión.');
            }
        })
        .catch(error => console.error('Error:', error));
});

