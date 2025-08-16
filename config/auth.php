<?php
require_once __DIR__ . '/env.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_PATH . '/resource/inicioSesion.php');
    exit;
}
?>