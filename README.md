# Mi Proyecto Web

Este es un proyecto web desarrollado en PHP utilizando el patrón MVC y Bootstrap para el diseño responsivo.

## Requisitos previos

- PHP 8.x o superior
- Composer
- MySQL o MariaDB

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

1. Clona el repositorio.
2. Ejecuta `composer install` en la raíz del proyecto para instalar las dependencias.
3. Crea una base de datos y configura los datos de acceso en `app/config/db.php`.
4. Importa el archivo SQL. Tienes 2 uno que es vacios que tiene un usuario administrador y un usuario normal y el con datos que tienen mas datos introducidos.
5. Crea un archivo `.env` en la raíz del proyecto con las siguientes variables:

```
STRIPE_PUBLIC_KEY=clave publica de stripe
STRIPE_SECRET_KEY=clave privada de stripe
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=tu correo de gmail
MAIL_PASSWORD="tu password de aplicacion para conectar con gmail"
MAIL_PORT=587
MAIL_FROM=tu correo de gmail
MAIL_FROM_NAME="el nombre del usuario con el que lo vera el cliente."
```

Para la contraseña de password, necesitas tener la doble autentificacion en esa cuenta de correo y luego accedes a esta
url https://myaccount.google.com/apppasswords le das un nombre y te genera una contraseña  16 caractares.

6. Cuando arranques el servidor, el raiz tiene que ser la carpeta public
7. Usuarios

nombre ==> ju@ju.com    
pass ==> 1     
rango ==> administrador

nombre ==> guaosgame@gmail.com    
pass ==> 1     
rango ==> usuario normal

