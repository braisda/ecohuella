DROP DATABASE IF EXISTS carbonoTest;
CREATE DATABASE IF NOT EXISTS `carbonoTest` DEFAULT CHARACTER SET latin1;

CREATE USER IF NOT EXISTS 'new_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON * . * TO 'new_user'@'localhost';
FLUSH PRIVILEGES;

USE `carbonoTest`;
DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(48) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `descripcion_rol` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `borrado_logico` int NOT NULL DEFAULT '0',
  PRIMARY KEY(id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `dni` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos_usuario` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `fecha_nac` date NOT NULL,
  `borrado_logico` int NOT NULL DEFAULT '0',
  PRIMARY KEY(dni),
  FOREIGN KEY(id_rol) REFERENCES rol(id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `logattributeexception`;

CREATE TABLE `logattributeexception` (
  `usuario` varchar(29) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `funcionalidad` varchar(48) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `accion` varchar(48) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `codigo` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `mensaje` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `tiempo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `logexcepcionaccion`;

CREATE TABLE `logexcepcionaccion` (
  `usuario` varchar(29) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `funcionalidad` varchar(48) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `accion` varchar(48) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `codigo` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `mensaje` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `tiempo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `funcionalidad`;

CREATE TABLE `funcionalidad` (
  `id_funcionalidad` int NOT NULL AUTO_INCREMENT,
  `nombre_funcionalidad` varchar(48) NOT NULL,
  `descripcion_funcionalidad` varchar(200) NOT NULL,
  PRIMARY KEY(id_funcionalidad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `accion`;

CREATE TABLE `accion` (
  `id_accion` int NOT NULL AUTO_INCREMENT,
  `nombre_accion` varchar(48) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `descripcion_accion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY(id_accion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `accion_funcionalidad`;

CREATE TABLE `accion_funcionalidad` (
  `id_accion` int NOT NULL,
  `id_funcionalidad` int NOT NULL,
  PRIMARY KEY(id_accion, id_funcionalidad),
  FOREIGN KEY(id_accion) REFERENCES accion(id_accion),
  FOREIGN KEY(id_funcionalidad) REFERENCES funcionalidad(id_funcionalidad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `rol_accion_funcionalidad`;

CREATE TABLE `rol_accion_funcionalidad` (
  `id_rol` int NOT NULL,
  `id_accion` int NOT NULL,
  `id_funcionalidad` int NOT NULL,
  PRIMARY KEY(id_rol, id_accion, id_funcionalidad),
  FOREIGN KEY(id_rol) REFERENCES rol(id_rol),
  FOREIGN KEY(id_accion) REFERENCES accion(id_accion),
  FOREIGN KEY(id_funcionalidad) REFERENCES funcionalidad(id_funcionalidad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `id_categoria_padre` int,
  `dni_usuario_creacion` varchar(60) NOT NULL,
  `dni_usuario_modificacion` varchar(60),
  `borrado_logico` int NOT NULL DEFAULT '0',
  PRIMARY KEY(id_categoria),
  FOREIGN KEY(id_categoria_padre) REFERENCES categoria(id_categoria),
  FOREIGN KEY(dni_usuario_creacion) REFERENCES usuario(dni),
  FOREIGN KEY(dni_usuario_modificacion) REFERENCES usuario(dni)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `proceso` (
  `id_proceso` int NOT NULL AUTO_INCREMENT,
  `version` int NOT NULL DEFAULT '1',
  `nombre` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `formula` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  `activo` int NOT NULL DEFAULT '0',
  `id_categoria` int  NOT NULL,
  `dni_usuario_creacion` varchar(60) NOT NULL,
  `dni_usuario_modificacion` varchar(60),
  `borrado_logico` int NOT NULL DEFAULT '0',
  PRIMARY KEY(id_proceso, version),
  FOREIGN KEY(id_categoria) REFERENCES categoria(id_categoria),
  FOREIGN KEY(dni_usuario_creacion) REFERENCES usuario(dni),
  FOREIGN KEY(dni_usuario_modificacion) REFERENCES usuario(dni)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `notificacion` (
  `id_notificacion` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `cuerpo` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `fecha` date NOT NULL,
  `leida` int NOT NULL,
  `dni_usuario_remitente` varchar(60) NOT NULL,
  `dni_usuario_destinatario` varchar(60) NOT NULL,
  PRIMARY KEY(id_notificacion),
  FOREIGN KEY(dni_usuario_remitente) REFERENCES usuario(dni),
  FOREIGN KEY(dni_usuario_destinatario) REFERENCES usuario(dni)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `parametro` (
  `id_parametro` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `unidad` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dni_usuario_creacion` varchar(60) NOT NULL,
  `dni_usuario_modificacion` varchar(60) NOT NULL,
  `id_proceso` int NOT NULL,
  `version` int NOT NULL,
  PRIMARY KEY(id_parametro),
  FOREIGN KEY(dni_usuario_creacion) REFERENCES usuario(dni),
  FOREIGN KEY(dni_usuario_modificacion) REFERENCES usuario(dni),
  FOREIGN KEY(id_proceso, version) REFERENCES proceso(id_proceso, version)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `proceso_usuario_ejecucion` (
  `id_proceso` int NOT NULL,
  `version` int NOT NULL,
  `dni_usuario_ejecucion` varchar(60) NOT NULL,
  PRIMARY KEY(id_proceso, version, dni_usuario_ejecucion),
  FOREIGN KEY(id_proceso, version) REFERENCES proceso(id_proceso, version),
  FOREIGN KEY(dni_usuario_ejecucion) REFERENCES usuario(dni)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `proceso_usuario_ejecucion_parametro` (
  `id_proceso` int NOT NULL,
  `version` int NOT NULL,
  `dni_usuario_ejecucion` varchar(60) NOT NULL,
  `id_parametro` int NOT NULL,
  `fecha_ejecucion` date NOT NULL,
  `valor_parametro` decimal(9,2) NOT NULL,
  PRIMARY KEY(id_proceso, version, dni_usuario_ejecucion, id_parametro),
  FOREIGN KEY(id_proceso, version,dni_usuario_ejecucion) REFERENCES proceso_usuario_ejecucion(id_proceso, version, dni_usuario_ejecucion),
  FOREIGN KEY(id_parametro) REFERENCES parametro(id_parametro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `rol` (`id_rol`, `nombre_rol`, `descripcion_rol`, `borrado_logico`) VALUES
(1, 'administrador', 'Rol de administrador que tiene acceso a todas las funcionalidades del sistema', 0),
(2, 'moderador', 'Usuario que es un moderador', 0),
(3, 'formulador', 'Usuario que es un formulador', 0),
(4, 'basico', 'Usuario que es un usuario basico', 0);

/* pass = admin */
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('12345678Z', 'admin', 'admin admin', 'admin@admin.es', '21232f297a57a5a743894a0e4a801fc3', '1', 'admin', '666555444', '1975-01-09');
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('83090506Q', 'admin2', 'admin2 admin2', 'admin2@admin.es', '21232f297a57a5a743894a0e4a801fc3', '1', 'admin2', '666555444', '1990-04-06');
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('14488423X', 'moderador', 'moderador moderador', 'moderador@moderador.es', '21232f297a57a5a743894a0e4a801fc3', '2', 'moderador', '666555444', '1969-04-09');
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('58914513J', 'moderador2', 'moderador2 moderador2', 'moderador2@moderador.es', '21232f297a57a5a743894a0e4a801fc3', '2', 'moderador2', '666555444', '1976-02-12');
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('62167251E', 'formulador', 'formulador formulador', 'formulador@formulador.es', '21232f297a57a5a743894a0e4a801fc3', '3', 'formulador', '666555444', '2000-07-08');
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('96082852F', 'formulador2', 'formulador2 formulador2', 'formulador2@formulador.es', '21232f297a57a5a743894a0e4a801fc3', '3', 'formulador2', '666555444', '1999-10-09');
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('11111111H', 'basico', 'basico basico', 'basico@basico.es', '21232f297a57a5a743894a0e4a801fc3', '4', 'basico', '666555444', '1980-04-29');
INSERT INTO `usuario` (`dni`, `nombre`, `apellidos_usuario`, `email`, `password`, `id_rol`, `direccion`, `telefono`, `fecha_nac`)
VALUES ('84296317Y', 'basico2', 'basico2 basico2', 'basico2@basico.es', '21232f297a57a5a743894a0e4a801fc3', '4', 'basico2', '666555444', '1981-09-02');

INSERT INTO `accion` (`id_accion`, `nombre_accion`, `descripcion_accion`) VALUES
(1, 'add', 'Insertar un elemento en base de datos'),
(2, 'delete', 'Borrado de un elemento en base de datos'),
(3, 'edit', 'Editar un elemento en base de datos'),
(4, 'search', 'Buscar un elemento en base de datos'),
(5, 'reactivate', 'Reactivar un elemento borrado de forma lógica'),
(6, 'searchBy', 'Ver toda la información para una tupla'),
(7, 'listar', 'Listado de las tuplas de una entidad'),
(8, 'getPasswordEmail', 'Recuperar contrasena'),
(9, 'editPass', 'Editar contrasena'),
(10, 'finalDelete', 'Eliminar permanentemente.'),
(11, 'explore', 'Explorar procesos.');

INSERT INTO `funcionalidad` (`id_funcionalidad`, `nombre_funcionalidad`, `descripcion_funcionalidad`) VALUES
(1, 'user', 'Gestión de usuarios'),
(2, 'logExcepcionAccion', 'Log de excepcion de acciones'),
(3, 'logExcepcionAtributo', 'Log de excepcion de atributo'),
(4, 'actionFunctionality', 'Gestión de acciones-funcionalidades'),
(5, 'auth', 'Autorizacion'),
(6, 'roleActionFunctionality', 'Gestión de rol-acción-funcionalidad'),
(7, 'category', 'Gestión de categorías'),
(8, 'process', 'Gestión de procesos'),
(9, 'notification', 'Gestión de notificaciones'),
(10, 'parameter', 'Gestión de parámetros'),
(11, 'processUserExecution', 'Gestión de ejecución de proceso'),
(12, 'processUserExecutionParameter', 'Gestión de ejecución de proceso con parámetro');

INSERT INTO `accion_funcionalidad` (`id_accion`, `id_funcionalidad`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 1),
(2, 7),
(2, 8),
(3, 1),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(4, 1),
(4, 4),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(5, 1),
(6, 1),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(8, 5),
(9, 1),
(10, 1),
(10, 7),
(10, 8),
(10, 9),
(10, 10),
(10, 11),
(10, 12),
(11, 8);

INSERT INTO `rol_accion_funcionalidad` (`id_rol`, `id_accion`, `id_funcionalidad`) VALUES
(1, 1, 1),
(1, 1, 4),
(1, 1, 6),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 4, 4),
(1, 4, 6),
(1, 4, 9),
(1, 5, 5),
(1, 6, 1),
(1, 6, 9),
(1, 8, 5),
(1, 9, 1),
(1, 10, 1),
(1, 10, 9),
(2, 1, 7),
(2, 1, 9),
(2, 2, 7),
(2, 3, 1),
(2, 3, 7),
(2, 3, 8),
(2, 3, 9),
(2, 3, 10),
(2, 4, 1),
(2, 4, 7),
(2, 4, 8),
(2, 4, 9),
(2, 4, 10),
(2, 4, 12),
(2, 6, 1),
(2, 6, 7),
(2, 6, 8),
(2, 6, 9),
(2, 6, 10),
(2, 8, 5),
(2, 9, 1),
(2, 10, 7),
(2, 10, 9),
(3, 1, 8),
(3, 1, 9),
(3, 1, 10),
(3, 3, 1),
(3, 3, 8),
(3, 3, 9),
(3, 3, 10),
(3, 4, 1),
(3, 4, 7),
(3, 4, 8),
(3, 4, 9),
(3, 4, 10),
(3, 6, 1),
(3, 6, 8),
(3, 6, 9),
(3, 6, 10),
(3, 8, 5),
(3, 9, 1),
(3, 10, 8),
(3, 10, 9),
(3, 10, 10),
(4, 1, 11),
(4, 1, 12),
(4, 3, 1),
(4, 3, 9),
(4, 3, 11),
(4, 3, 12),
(4, 4, 1),
(4, 4, 7),
(4, 4, 8),
(4, 4, 9),
(4, 4, 10),
(4, 4, 11),
(4, 4, 12),
(4, 6, 1),
(4, 6, 8),
(4, 6, 9),
(4, 6, 11),
(4, 6, 12),
(4, 8, 5),
(4, 9, 1),
(4, 10, 9),
(4, 10, 11),
(4, 10, 12),
(4, 11, 8);

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `id_categoria_padre`, `dni_usuario_creacion`, `dni_usuario_modificacion`, `borrado_logico`) VALUES
(1, 'Raíz', 'Categoría base', null, '14488423X', '14488423X', 0),
(2, 'Transporte', 'Categoría relacionada con viajes', 1, '14488423X', '14488423X', 0),
(3, 'Transporte aéreo', 'Categoría relacionada con viajes aéreos', 2, '14488423X', '58914513J', 0),
(4, 'Transporte terrestre', 'Categoría relacionada con viajes por carretera', 2, '14488423X', '14488423X', 0),
(5, 'Transporte terrestre gasolina', 'Categoría relacionada con viajes por carretera con vehículos de gasolina', 4, '14488423X', '14488423X', 0),
(6, 'Transporte marítimo', 'Categoría relacionada con viajes por mar', 2, '14488423X', '14488423X', 0),
(7, 'Vivienda', 'Categoría relacionada con vivienda', 1, '14488423X', '14488423X', 0),
(8, 'Vivienda Electricidad', 'Categoría relacionada con el consumo eléctrico de la vivienda', 7, '14488423X', '14488423X', 0),
(9, 'Vivienda Gas Natural', 'Categoría relacionada con el consumo de gas natural de la vivienda', 7, '14488423X', '14488423X', 0);

INSERT INTO `proceso` (`id_proceso`, `version`, `nombre`, `descripcion`, `formula`, `fecha_creacion`, `fecha_modificacion`, `activo`, `id_categoria`, `dni_usuario_creacion`, `dni_usuario_modificacion`, `borrado_logico`) VALUES
(1, 1, 'Proceso transporte', 'Proceso para transporte genérico', '#_1_#*10', '2023-01-09', '2023-01-09', 1, 2, '62167251E', '62167251E', 0),
(2, 1, 'Proceso transporte aéreo', 'Proceso para transporte aéreo', '#_2_#*10+5', '2023-01-09', '2023-04-12', 1, 3, '62167251E', '96082852F', 0),
(3, 1, 'Proceso transporte terestre', 'Proceso para transporte terrestre', '#_3_#*10+2', '2023-01-10', '2023-01-10', 1, 4, '62167251E', '62167251E', 0),
(4, 1, 'Proceso transporte terrestre gasolina 95', 'Proceso para transporte terrestre de gasolina 95', '#_4_#*10+1', '2023-03-19', '2023-03-19', 1, 5, '62167251E', '62167251E', 0),
(5, 1, 'Proceso transporte terrestre gasolina 98', 'Proceso para transporte terrestre de gasolina 98', '#_5_#*10+1', '2023-03-19', '2023-03-19', 1, 5, '62167251E', '62167251E', 0),
(6, 1, 'Proceso transporte terrestre gasolina E5', 'Proceso para transporte terrestre de gasolina E5', '#_6_#*10+1', '2023-03-19', '2023-03-19', 0, 5, '62167251E', '62167251E', 0),
(7, 1, 'Proceso transporte terrestre gasolina E10', 'Proceso para transporte terrestre de gasolina E10', '#_7_#*10+1', '2023-03-19', '2023-03-19', 0, 5, '62167251E', '62167251E', 0),
(8, 1, 'Proceso vivienda', 'Proceso para vivienda genérico', '#_8_#*15', '2023-05-20', '2023-05-21', 1, 7, '62167251E', '62167251E', 0);

INSERT INTO `notificacion` (`id_notificacion`, `titulo`, `cuerpo`, `fecha`, `leida`, `dni_usuario_remitente`, `dni_usuario_destinatario`) VALUES
(1, 'Nueva categoría disponible', 'Se ha creado una nueva categoría llamada Vivienda Electricidad', '2023-04-09', 0, '14488423X', '14488423X'),
(2, 'Nueva categoría disponible', 'Se ha creado una nueva categoría llamada Vivienda Gas Natural', '2023-04-09', 0, '14488423X', '14488423X'),
(3, 'Nuevo proceso disponible', 'Se ha creado un nuevo proceso para la categoría Transporte llamado Proceso transporte', '2023-04-09', 0, '62167251E', '14488423X');

INSERT INTO `parametro` (`id_parametro`, `nombre`, `descripcion`, `unidad`, `dni_usuario_creacion`, `dni_usuario_modificacion`, `id_proceso`, `version`) VALUES
(1, 'numeroViajes', 'Numero de viajes realizados', '', '62167251E', '62167251E', 1, 1),
(2, 'numeroViajes', 'Numero de viajes realizados en avión', '', '62167251E', '96082852F', 2, 1),
(3, 'numeroViajes', 'Numero de viajes realizados por carretera', '', '62167251E', '62167251E', 3, 1),
(4, 'numeroViajes', 'Numero de viajes realizados por carretera con vehículos de gasolina 95', '', '62167251E', '62167251E', 4, 1),
(5, 'numeroViajes', 'Numero de viajes realizados por carretera con vehículos de gasolina 98', '', '62167251E', '62167251E', 5, 1),
(6, 'numeroViajes', 'Numero de viajes realizados por carretera con vehículos de gasolina E5', '', '62167251E', '62167251E', 6, 1),
(7, 'numeroViajes', 'Numero de viajes realizados por carretera con vehículos de gasolina E10', '', '62167251E', '62167251E', 7, 1),
(8, 'numeroHabitaciones', 'Numero de habitaciones de la vivienda', '', '62167251E', '62167251E', 8, 1);

INSERT INTO `proceso_usuario_ejecucion` (`id_proceso`, `version`, `dni_usuario_ejecucion`) VALUES
('4', '1', '11111111H');

INSERT INTO `proceso_usuario_ejecucion_parametro` (`id_proceso`, `version`, `dni_usuario_ejecucion`, `id_parametro`, `fecha_ejecucion`, `valor_parametro`) VALUES
('4', '1', '11111111H', '4', '2023-08-13', '7');