<?php
require_once __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();

define('BASE_PATH', rtrim($_ENV['BASE_PATH'] ?? '', '/'));
