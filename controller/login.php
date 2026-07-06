<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Si el usuario ya inició sesión, redirigimos directamente a main.php
// (Asumiendo que login.php y main.php están en la misma carpeta)
if (isset($_SESSION['usuario'])) {
    header('Location: main.php');
    exit;
}

require_once __DIR__ . '/../model/usuarioClase.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($usuario === '' || $password === '') {
        $error = 'Por favor ingresa usuario y contraseña.';
    } else {
        $usuarioModel = new Usuario();
        $user = $usuarioModel->buscarPorUsuario($usuario);

        if ($user && $usuarioModel->verificarPassword($password, $user)) {
            $_SESSION['usuario'] = $user['usuario'] ?? ($user['nombreusuario'] ?? '');
            $_SESSION['nivel'] = $user['nivel'] ?? null;
            
            // Redirección simple y efectiva
            header('Location: ../main.php'); 
            exit;
        }

        $error = 'Usuario o contraseña incorrectos. Intenta de nuevo.';
    }
}

include __DIR__ . '/../view/login.php';