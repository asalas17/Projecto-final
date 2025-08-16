<?php
require_once __DIR__ . '/../../config/db_conn.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../resource/inicio.php');
    exit();
}

$agricultor_id = $_SESSION['user_id'] ?? null;
if (!$agricultor_id) {
    header('Location: ../../resource/inicioSesion.php');
    exit();
}

$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 0;
$stock = isset($_POST['stock']) ? (int) $_POST['stock'] : 0;
$fecha_publicacion = isset($_POST['fecha_publicacion']) ? date('Y-m-d H:i:s', strtotime($_POST['fecha_publicacion'])) : date('Y-m-d H:i:s');
$imagen_url = $_POST['imagen_url'] ?? null;

if (!empty($_FILES['image_file']['name'])) {
    $uploadDir = __DIR__ . '/../../resource/uploads';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $filename = time() . '_' . basename($_FILES['image_file']['name']);
    $destination = $uploadDir . '/' . $filename;
    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $destination)) {
        $imagen_url = 'resource/uploads/' . $filename;
    }
}

$stmt = $connection->prepare("INSERT INTO productos (agricultor_id, nombre, descripcion, precio, stock, fecha_publicacion, imagen_url, fechaCreacion, fechaActualizado) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
$stmt->bind_param('issdiss', $agricultor_id, $nombre, $descripcion, $precio, $stock, $fecha_publicacion, $imagen_url);
$stmt->execute();
$stmt->close();

header('Location: ../../resource/perfil.php');
exit();
?>