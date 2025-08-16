<?php
require_once __DIR__ . '/../../config/env.php';
require_once '../../config/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Obtener la ruta de la imagen para eliminar el archivo físico si existe
    $stmtImg = $connection->prepare('SELECT image_path FROM feria_imagen WHERE feria_id = ?');
    $stmtImg->bind_param('i', $id);
    $stmtImg->execute();
    $stmtImg->bind_result($image_path);
    if ($stmtImg->fetch() && $image_path) {
        $file = __DIR__ . '/../../' . ltrim($image_path, '/');
        if (file_exists($file)) {
            unlink($file);
        }
    }
    $stmtImg->close();

    // Eliminar registros de la tabla feria_imagen
    $stmtDelImg = $connection->prepare('DELETE FROM feria_imagen WHERE feria_id = ?');
    $stmtDelImg->bind_param('i', $id);
    $stmtDelImg->execute();
    $stmtDelImg->close();

    // Eliminar la feria
    $stmtDelFeria = $connection->prepare('DELETE FROM ferias WHERE id = ?');
    $stmtDelFeria->bind_param('i', $id);
    $stmtDelFeria->execute();
    $stmtDelFeria->close();
}

$connection->close();
header('Location: ' . BASE_PATH . '/resource/ferias.php');
exit();
?>