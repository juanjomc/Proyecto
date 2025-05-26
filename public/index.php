<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$request = $_SERVER['REQUEST_URI'];

$request = explode('?', $request)[0]; // Eliminar la query string para poder comprobar el correo en el formulario de registro


//Ruteo

switch ($request) {
    case 'index.php':
        
    case '/':
        //Pagina de inicio
        require '../app/controllers/MainController.php';
        $controller = new MainController();
        $controller->index();
        break;

    case '/contact/store':
        //Introduce los datos del formulario de contacto en la base de datos
        require '../app/controllers/ContactController.php';
        $controller = new ContactController();
        $controller->store();
        break;

    case '/admin/panel':
        //Panel de administracion
        require '../app/views/dashboard_admin.php';
        break;
    
    case '/admin/contactos':
        //Lista de contactos
        require '../app/controllers/ContactController.php';
        $controller = new ContactController();
        $contactos = $controller->listarContactos();
        require '../app/views/admin/contactos_admin.php'; // Vista para mostrar los contactos
        break;

    case '/admin/contactos/acciones':
        require '../app/controllers/ContactController.php';
        $controller = new ContactController();
        $controller->acciones();
        break;

    case '/admin/utilidades/basedatos':
        require '../app/views/admin/basedatos_admin.php'; // Cargar la página de Base de Datos
        break;

    case '/admin/utilidades/basedatos/backup':
        require '../app/controllers/admin/BasedatosController.php';
        $controller = new BackupController();
        $controller->generateBackup(); // Ejecutar el método generateBackup
        break;
    
    case '/admin/utilidades/basedatos/restore':
        require '../app/controllers/admin/BasedatosController.php';
        $controller = new BackupController();
        $controller->restoreBackup(); // Ejecutar el método restoreBackup
        break;

    case '/admin/usuarios':
        //Lista de usuarios
        require '../app/controllers/admin/UsuariosController.php';
        $controller = new UsuariosController();
        $usuarios = $controller->index();
        break;

    case '/admin/utilidades/opciones':
        //Lista de opciones
        require '../app/controllers/admin/OpcionesController.php';
        $controller = new OpcionesController();
        $opciones = $controller->index();
        break;

    case '/admin/opciones/update':
        //Actualizar opciones
        require '../app/controllers/admin/OpcionesController.php';
        $controller = new OpcionesController();
        $controller->update();
        break;
        
    case '/admin/utilidades/pass':
        //Actualizar opciones
        require '../app/controllers/admin/OpcionesController.php';
        $controller = new OpcionesController();
        $controller->cambiarPassword();
    break;

    case '/user/panel':
        //Panel de usuario
        require '../app/controllers/UserController.php';
        $controller = new UserController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update();
        } else {
            $controller->showForm();
        }
    break;

    case '/login/authenticate':
        require '../app/controllers/LoginController.php';
        $controller = new LoginController();
        $controller->authenticate();
        break;

    case '/registro':
        require '../app/controllers/UserController.php';
        $controller = new RegisterController();
        $controller->showForm();
        break;
    
    case '/register/store':
        require '../app/controllers/UserController.php';
        $controller = new RegisterController();
        $controller->store();
        break;

    case '/check-email':
        require '../app/controllers/UserController.php';
        $controller = new RegisterController();
        $controller->checkEmail();
        break;

    case '/reservar':
        require '../app/controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->showForm();
        break;

    case '/menu':
        require '../app/views/menu.php';
        // $controller = new ReservaController();
        // $controller->showForm();
        break;
    
    case '/test':
        require '../app/views/testdb.php';
        // $controller = new ReservaController();
        // $controller->showForm();
        break;
    case '/reservas/store':
        require '../app/controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->store();
        break;
        
    // case 'reservas/obtener':
    //     require '../app/controllers/ReservaController.php';
    //     $controller = new ReservaController();
    //     $controller->obtenerReservas();
    //     break;
    case '/tarifas/obtener':
        require '../app/controllers/TarifasController.php';
        $controller = new TarifasController();
        $controller->obtenerTarifas();
        break;

    // case 'login/authenticate':
    //     require '../app/controllers/LoginController.php';
    //     $controller = new LoginController();
    //     $controller->authenticate();
    //     break;
    

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}

?>