<?php
require_once __DIR__ . '/../config/env.php';
session_start();
session_unset();
session_destroy();
header('Location: ' . BASE_PATH . '/resource/inicio.php');
exit;
?>
