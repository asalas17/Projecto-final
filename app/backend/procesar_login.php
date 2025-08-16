<?php
// procesar_login.php
session_start();

require_once __DIR__ . '/../../config/env.php';
// 1. Carga la conexión (archivo en config/)
require_once __DIR__ . '/../../config/db_conn.php';

// 2. Sólo aceptamos POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ' . BASE_PATH . '/resource/inicioSesion.php');
  exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$errors = [];

// 3. Validar formato de correo
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = 'Formato de correo inválido.';
}

// 4. Si no hay errores de formato, buscamos al usuario
if (empty($errors)) {
  $stmt = $connection->prepare("
        SELECT id, nombre, password, rol
          FROM usuarios
         WHERE email = ?
    ");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    // 5. Verificamos la contraseña
    if (password_verify($password, $row['password'])) {
      // 6. Éxito: guardamos datos en sesión y redirigimos al dashboard
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['nombre'];
      $_SESSION['user_rol'] = $row['rol'];
      $_SESSION['is_admin'] = ($row['rol'] === 'admin');
      header('Location: ' . BASE_PATH . '/resource/inicio.php');
      exit;
    } else {
      $errors[] = 'Contraseña incorrecta.';
    }
  } else {
    $errors[] = 'No existe ninguna cuenta con ese correo.';
  }

  $stmt->close();
}

// 7. Si hay errores, volvemos al login enviando el mensaje por GET
//    La ruta debe ser relativa a este script (app/backend → resource/)
$errorParam = http_build_query(['error' => $errors[0]]);
header('Location: ' . BASE_PATH . "/resource/inicioSesion.php?{$errorParam}");
exit;
