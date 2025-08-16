<?php
require_once __DIR__ . '/../../config/env.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];
session_destroy();

header('Location: ' . BASE_PATH . '/resource/inicioSesion.php');
exit;
?>