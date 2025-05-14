<?php
// Variable global para el entorno
global $isLocal;

// Detectar si estamos en entorno local o producción
$isLocal = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;

// Código de depuración temporal
echo "REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "<br>";
echo "isLocal: " . ($isLocal ? 'true' : 'false') . "<br>";

// Definir la URL base según el entorno y quitar barra final
$baseUrl = $isLocal ? '/todo-app' : 'https://juansedev.com/todo-app';
$baseUrl = rtrim($baseUrl, '/');
define('BASE_URL', $baseUrl);

// Definir la ruta raíz del proyecto
define('ROOT_PATH', dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);

// Rutas principales de la aplicación
define('APP_PATH', ROOT_PATH . 'app' . DIRECTORY_SEPARATOR);
define('MODEL_PATH', APP_PATH . 'model' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', APP_PATH . 'view' . DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', APP_PATH . 'controller' . DIRECTORY_SEPARATOR);
define('CONFIG_PATH', APP_PATH . 'config' . DIRECTORY_SEPARATOR);

// Rutas de acceso a datos
define('DAO_PATH', ROOT_PATH . 'dao' . DIRECTORY_SEPARATOR);
define('IMP_PATH', DAO_PATH . 'imp' . DIRECTORY_SEPARATOR);

// Rutas de assets
define('ASSETS_PATH', ROOT_PATH . 'assets' . DIRECTORY_SEPARATOR);
define('CSS_PATH', ASSETS_PATH . 'css' . DIRECTORY_SEPARATOR);
define('JS_PATH', ASSETS_PATH . 'js' . DIRECTORY_SEPARATOR);
define('IMG_PATH', ASSETS_PATH . 'images' . DIRECTORY_SEPARATOR);

// Rutas de vendor y otros recursos
define('VENDOR_PATH', ROOT_PATH . 'vendor' . DIRECTORY_SEPARATOR);
define('TEMP_PATH', ROOT_PATH . 'temp' . DIRECTORY_SEPARATOR);
define('LOG_PATH', ROOT_PATH . 'logs' . DIRECTORY_SEPARATOR);

// URLs para assets
define('ASSETS_URL', BASE_URL . '/assets');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMG_URL', ASSETS_URL . '/images');

// Configuración de errores según el entorno
if ($isLocal) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', LOG_PATH . 'local_errors.log');
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', LOG_PATH . 'production_errors.log');
}

// Función helper para generar URLs absolutas
function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

// Función helper para assets
function asset($path = '') {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

// Función helper para verificar si estamos en producción
function isProduction() {
    global $isLocal;
    return !$isLocal;
}

// Función helper para verificar si estamos en local
function isLocal() {
    global $isLocal;
    return $isLocal;
}






?>