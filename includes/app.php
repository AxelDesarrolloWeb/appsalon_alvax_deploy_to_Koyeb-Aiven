<?php 
use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv -> safeLoad();

// Normalizar variables de entorno para compatibilidad con DOMCloud
if (empty($_ENV['APP_URL']) && !empty($_ENV['SERVER_HOST'])) {
    $_ENV['APP_URL'] = $_ENV['SERVER_HOST'];
}
if (!empty($_ENV['MAIL_HOST']) && empty($_ENV['EMAIL_HOST'])) {
    $_ENV['EMAIL_HOST'] = $_ENV['MAIL_HOST'];
}
if (!empty($_ENV['MAIL_PORT']) && empty($_ENV['EMAIL_PORT'])) {
    $_ENV['EMAIL_PORT'] = $_ENV['MAIL_PORT'];
}
if (!empty($_ENV['MAIL_USER']) && empty($_ENV['EMAIL_USER'])) {
    $_ENV['EMAIL_USER'] = $_ENV['MAIL_USER'];
}
if (!empty($_ENV['MAIL_PASSWORD']) && empty($_ENV['EMAIL_PASS'])) {
    $_ENV['EMAIL_PASS'] = $_ENV['MAIL_PASSWORD'];
}
if (empty($_ENV['DB_PORT'])) {
    $_ENV['DB_PORT'] = '3306';
}

require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
ActiveRecord::setDB(conectarDB());
// Añadir esta línea:
ActiveRecord::setDBCharset('utf8');