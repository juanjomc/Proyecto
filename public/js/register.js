document.addEventListener("DOMContentLoaded", function () {
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirmPassword");
    const passwordMatchMessage = document.getElementById("passwordMatchMessage");
    const fechaNacimientoField = document.getElementById("fechaNacimiento");
    const ageValidationMessage = document.getElementById("ageValidationMessage");
    const correoField = document.getElementById("correo");
    const emailValidationMessage = document.getElementById("emailValidationMessage");
    const registerButton = document.getElementById("registerButton");

    let isPasswordMatch = false;
    let isAgeValid = false;
    let isEmailValid = false;

    // Función para verificar si las contraseñas coinciden
    function checkPasswords() {
        if (confirmPasswordField.value === "") {
            passwordMatchMessage.textContent = ""; // No mostrar nada si el campo está vacío
            passwordMatchMessage.classList.remove("text-success", "text-danger");
            isPasswordMatch = false;
        } else if (passwordField.value === confirmPasswordField.value) {
            passwordMatchMessage.textContent = "Las contraseñas coinciden.";
            passwordMatchMessage.classList.remove("text-danger");
            passwordMatchMessage.classList.add("text-success");
            isPasswordMatch = true;
        } else {
            passwordMatchMessage.textContent = "Las contraseñas no coinciden.";
            passwordMatchMessage.classList.remove("text-success");
            passwordMatchMessage.classList.add("text-danger");
            isPasswordMatch = false;
        }
        toggleRegisterButton();
    }

    // Función para verificar si el usuario tiene más de 18 años
    function checkAge() {
        const fechaNacimiento = new Date(fechaNacimientoField.value);
        const hoy = new Date();
        const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        const mes = hoy.getMonth() - fechaNacimiento.getMonth();

        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
            isAgeValid = edad - 1 >= 18;
        } else {
            isAgeValid = edad >= 18;
        }

        if (!isAgeValid) {
            ageValidationMessage.textContent = "Debes tener al menos 18 años.";
            ageValidationMessage.classList.add("text-danger");
            ageValidationMessage.classList.remove("text-success");
        } else {
            ageValidationMessage.textContent = "Edad válida.";
            ageValidationMessage.classList.add("text-success");
            ageValidationMessage.classList.remove("text-danger");
        }

        toggleRegisterButton();
    }

    // Función para verificar si el correo ya está registrado
    function checkEmail() {
        const correo = correoField.value.trim();
        if (correo === "") {
            emailValidationMessage.textContent = "";
            emailValidationMessage.classList.remove("text-success", "text-danger");
            isEmailValid = false;
            toggleRegisterButton();
            return;
        }

        fetch(`/check-email?correo=${encodeURIComponent(correo)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    emailValidationMessage.textContent = "Correo no disponible.";
                    emailValidationMessage.classList.add("text-danger");
                    emailValidationMessage.classList.remove("text-success");
                    isEmailValid = false;
                } else {
                    emailValidationMessage.textContent = "Correo disponible.";
                    emailValidationMessage.classList.add("text-success");
                    emailValidationMessage.classList.remove("text-danger");
                    isEmailValid = true;
                }
                toggleRegisterButton();
            })
            .catch(error => {
                console.error("Error al verificar el correo:", error);
                emailValidationMessage.textContent = "Error al verificar el correo.";
                emailValidationMessage.classList.add("text-danger");
                emailValidationMessage.classList.remove("text-success");
                isEmailValid = false;
                toggleRegisterButton();
            });
    }

    // Función para habilitar o deshabilitar el botón "Registrar"
    function toggleRegisterButton() {
        if (isPasswordMatch && isAgeValid && isEmailValid) {
            registerButton.disabled = false;
        } else {
            registerButton.disabled = true;
        }
    }

    // Escuchar el evento "input" en los campos de contraseña, fecha de nacimiento y correo
    passwordField.addEventListener("input", checkPasswords);
    confirmPasswordField.addEventListener("input", checkPasswords);
    fechaNacimientoField.addEventListener("input", checkAge);
    correoField.addEventListener("input", checkEmail);
});

document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Evitar el envío tradicional del formulario

    const formData = new FormData(this); // Capturar los datos del formulario

    fetch('/register/store', { // Ruta para manejar el registro
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
        const responseDiv = document.getElementById('registerResponse');
        if (data.success) {
            responseDiv.innerHTML = '<div class="alert alert-success fade-out">Se ha registrado correctamente.</div>';
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
                window.location.href = '/'; // Redirigir a la página principal
            }, 6000);
        } else {
            responseDiv.innerHTML = '<div class="alert alert-danger">Error: ' + (data.error || 'Error desconocido') + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('registerResponse').innerHTML = '<div class="alert alert-danger">Error al procesar la solicitud.</div>';
    });
});