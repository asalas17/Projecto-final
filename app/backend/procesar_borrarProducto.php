<?php
require_once __DIR__ . '/../../config/env.php';
require_once __DIR__ . '/../../config/db_conn.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_PATH . '/resource/inicio.php');
    exit();
}

$userId = $_SESSION['user_id'] ?? null;
$rol = $_SESSION['user_rol'] ?? '';
if (!$userId) {
    header('Location: ' . BASE_PATH . '/resource/inicioSesion.php');
    exit();
}

$idProducto = isset($_POST['id_producto']) ? (int) $_POST['id_producto'] : 0;
if ($idProducto <= 0) {
    header('Location: ' . BASE_PATH . '/resource/inicio.php');
    exit();
}

if ($rol === 'admin') {
    $stmt = $connection->prepare('DELETE FROM productos WHERE id = ?');
    $stmt->bind_param('i', $idProducto);
} else {
    $stmt = $connection->prepare('DELETE FROM productos WHERE id = ? AND agricultor_id = ?');
    $stmt->bind_param('ii', $idProducto, $userId);
}

$stmt->execute();
$stmt->close();

header('Location: ' . BASE_PATH . '/resource/agriOficiales.php');
exit();
?>