-- Crear la tabla de usuarios para el sistema
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int unsigned NOT NULL AUTO_INCREMENT,
  `id_empleado` int unsigned DEFAULT NULL,
  `usuario` varchar(35) DEFAULT NULL,
  `pasword` varchar(65) DEFAULT NULL,
  `nivel` int DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Ejemplo de usuario con contraseña cifrada (password: 1234)
-- INSERT INTO usuarios (id_empleado, usuario, pasword, nivel, estado) VALUES (NULL, 'admin', '$2y$10$7s9uJ1kTfJYVK4vlh3rfg.z4oJx8A1YZ59aYkJYsXuOX6eqruZj3e', 1, 'Activo');
