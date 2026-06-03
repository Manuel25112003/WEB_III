<?php
class Conexion
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=127.0.0.1;dbname=juvenil;charset=utf8",
                "root",
                "2511",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Error de conexión PDO: " . $e->getMessage());
        }
    }

    // Singleton: devuelve siempre la misma instancia
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Conexion();
        }
        return self::$instance->pdo;
    }
}
