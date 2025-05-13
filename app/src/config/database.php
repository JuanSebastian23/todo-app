<?php

require_once 'config.php';

/**
 * Clase Database
 * 
 * Esta clase implementa el patrón de diseño Singleton para manejar una única
 * instancia de conexión a la base de datos durante toda la aplicación.
 * Utiliza PDO para realizar conexiones seguras y consultas preparadas.
 */
class Database {
    /** @var PDO|null Objeto de conexión PDO */
    private $connection = null;

    /** @var Database|null Instancia única de la clase Database */
    private static $instance = null;

    /** @var array Configuración de la base de datos */
    private $config;

    /**
     * Constructor privado para evitar la creación directa de objetos.
     * Inicializa la configuración y establece la conexión.
     */
    private function __construct() {
        $this->config = getDatabaseConfig();
        $this->connect();
    }

    /**
     * Obtiene la instancia única de la clase Database (Singleton).
     * 
     * @return Database Instancia única de la conexión a la base de datos
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Establece la conexión con la base de datos usando PDO.
     * 
     * @throws PDOException Si ocurre un error en la conexión
     */
    private function connect() {
        try {
            $dsn = "mysql:host={$this->config['host']};dbname={$this->config['database']};charset={$this->config['charset']}";
            
            // Configuración de opciones PDO para un mejor manejo de errores y resultados
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de error
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Resultados como array asociativo
                PDO::ATTR_EMULATE_PREPARES => false, // Usa preparación nativa de MySQL
            ];

            $this->connection = new PDO(
                $dsn,
                $this->config['username'],
                $this->config['password'],
                $options
            );

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    /**
     * Obtiene el objeto PDO de la conexión actual.
     * 
     * @return PDO Objeto de conexión PDO
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Ejecuta una consulta SQL con parámetros opcionales.
     * 
     * @param string $sql Consulta SQL a ejecutar
     * @param array $params Parámetros para la consulta preparada
     * @return PDOStatement Resultado de la consulta
     * @throws PDOException Si ocurre un error en la consulta
     * 
     * Ejemplo de uso:
     * $db = Database::getInstance();
     * $resultado = $db->query("SELECT * FROM usuarios WHERE id = ?", [$id]);
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    /**
     * Previene la clonación del objeto (parte del patrón Singleton).
     */
    private function __clone() {}

    /**
     * Previene la deserialización del objeto (parte del patrón Singleton).
     */
    private function __wakeup() {}
}