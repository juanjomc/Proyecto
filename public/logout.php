<?php
session_start();
session_destroy();
header('Location: /'); // Redirigir al inicio
exit;