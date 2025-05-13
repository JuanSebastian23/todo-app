<?php

// Definir el entorno (development o production)
define('ENVIRONMENT', 'development');

// Configuración de la base de datos según el entorno
$db_config = [];

switch(ENVIRONMENT) {
    case 'development':
        $db_config = [
            'host' => 'localhost',
            'database' => 'todo_app',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'port' => '3306'
        ];
        break;
        
    case 'production':
        $db_config = [
            'host' => 'your_production_host',
            'database' => 'your_production_database',
            'username' => 'your_production_username',
            'password' => 'your_production_password',
            'charset' => 'utf8mb4',
            'port' => '3306'
        ];
        break;
        
    default:
        die('El entorno ' . ENVIRONMENT . ' no está configurado.');
}

// Función para obtener la configuración de la base de datos
function getDatabaseConfig() {
    global $db_config;
    return $db_config;
}