# Mi Proyecto Web

Este es un proyecto web desarrollado en PHP utilizando el patrón MVC y Bootstrap para el diseño responsivo.

## Estructura del Proyecto

El proyecto tiene la siguiente estructura de archivos:

```
mi-proyecto-web
├── app
|   ├── config
│   │   └── db.php
│   ├── controllers
│   │   └── MainController.php
│   ├── models
│   │   └── MainModel.php
│   └── views
│       └── main.php
|
│           
├── public
│   ├── css
│   │   └── styles.css
│   ├── js
│   │   └── scripts.js
│   ├── img
│   └── index.php
|   └── logout.php
|
├── vendor
|
├── .htaccess
├── composer.json
└── README.md
```


1. Extension recomendable para Visual Studio, "PHP Server"
 
2. Para iniciar el proyecto desde la terminal, poner este comando "php -S localhost:8000 -t public"

3. Acceder desde el navegador con esta url "http://localhost:8000/"

4. Usuarios

nombre ==> ju@ju.com    
pass ==> 1     
rango ==> administrador

nombre ==> aa@aa.com    
pass ==> 1     
rango ==> usuario normal

5. Hay que introducir en un archivo .env creado en la raiz del proyecto con estas variables.

STRIPE_PUBLIC_KEY=clave publica de stripe
STRIPE_SECRET_KEY=clave privada de stripe
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=tu correo de gmail
MAIL_PASSWORD="tu password de aplicacion para conectar con gmail"
MAIL_PORT=587
MAIL_FROM=tu correo de gmail
MAIL_FROM_NAME="el nombre del usuario con el que lo vera el cliente."
