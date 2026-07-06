<?php

class Usuario
{
    private $db;

    public function __construct()
    {
        include_once __DIR__ . '/conexion.php';
        $this->db = Conexion::getInstance();
    }

    private function getColumnName(array $options, string $default = ''): string
    {
        foreach ($options as $column) {
            $stmt = $this->db->query("SHOW COLUMNS FROM usuarios LIKE '" . $column . "'");
            if ($stmt && $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $column;
            }
        }
        return $default;
    }

    public function buscarPorUsuario(string $usuario)
    {
        $usuario = htmlspecialchars(trim($usuario), ENT_QUOTES, 'UTF-8');

        $usernameColumn = $this->getColumnName(['usuario', 'nombreusuario'], 'usuario');
        $estadoColumn = $this->getColumnName(['estado'], '');
        $passwordColumn = $this->getColumnName(['pasword', 'password'], 'pasword');

        if ($usernameColumn === '') {
            return false;
        }

        $sql = "SELECT * FROM usuarios WHERE {$usernameColumn} = :usuario";
        if ($estadoColumn !== '') {
            $sql .= " AND {$estadoColumn} = 'Activo'";
        }
        $sql .= " LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return false;
        }

        if (!array_key_exists($passwordColumn, $user)) {
            return false;
        }

        $user['_password_column'] = $passwordColumn;
        return $user;
    }

    public function verificarPassword(string $password, array $user): bool
    {
        $passwordColumn = $user['_password_column'] ?? 'pasword';
        $stored = $user[$passwordColumn] ?? '';

        if ($stored === '') {
            return false;
        }

        if (password_verify($password, $stored)) {
            return true;
        }

        return hash_equals($stored, $password);
    }
}
