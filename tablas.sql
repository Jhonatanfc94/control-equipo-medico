CREATE TABLE usuarios(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE equipos_medicos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    equipo VARCHAR(50) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    referencia VARCHAR(20),
    no_serie VARCHAR(50) NOT NULL,
    no_bien VARCHAR(50),
    hospital VARCHAR(50),
    tipo VARCHAR(50) NOT NULL,
    servicio VARCHAR(50),
    estado VARCHAR(50) NOT NULL,
    frecuencia_mant VARCHAR(50), 
    comentario VARCHAR(255),
    garantia VARCHAR(50),
    linea VARCHAR(50) NOT NULL,
    depto VARCHAR (50) NOT NULL
);

CREATE TABLE hospitales(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    hospital  VARCHAR(50) NOT NULL,
    servicio  VARCHAR(50) NOT NULL,
    nivel  VARCHAR(50),
    jefe  VARCHAR(50),
    horario  VARCHAR(50) NOT NULL
);

CREATE TABLE repuestos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    equipo  VARCHAR(50) NOT NULL,
    marca  VARCHAR(50) NOT NULL,
    modelo  VARCHAR(50) NOT NULL,
    repuesto  VARCHAR(50) NOT NULL,
    no_parte  VARCHAR(50),
    precio VARCHAR(20)
);

CREATE TABLE mantenimiento(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tiposervicio VARCHAR(50) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    linea VARCHAR(50) NOT NULL,
    tipofalla VARCHAR(50) NOT NULL,
    servicio VARCHAR(50),
    hospital VARCHAR(50) NOT NULL,
    depto VARCHAR(50) NOT NULL, 
    zona VARCHAR(50),
    equipo VARCHAR(50) NOT NULL,
    modelo VARCHAR(50),
    no_serie VARCHAR(50) NOT NULL,
    no_bien VARCHAR(50),
    visita VARCHAR(255) NOT NULL,
    repuestos VARCHAR(255),
    calibracion VARCHAR(50),
    estado VARCHAR(50) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME,    
    terminado VARCHAR(50),
    tecnico VARCHAR(50),
    horasop REAL,
    reporte REAL
);

CREATE TABLE cronograma(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    no_serie VARCHAR(50) NOT NULL,
    mes_planificado VARCHAR(255) NOT NULL,
    anio VARCHAR(50) NOT NULL,
    descripcion VARCHAR(50),
    realizado VARCHAR(50)
);

CREATE TABLE lineas(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    linea VARCHAR(50) NOT NULL
);

CREATE TABLE tipos_equipos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipos VARCHAR(50) NOT NULL
);

INSERT INTO  `usuarios` (username, password) VALUES ('Jhona', 'pass');
INSERT INTO `usuarios` (username, password) VALUES ('Oscar', 'pass');

INSERT INTO `lineas` (linea)VALUES ('CARDINAL');
INSERT INTO `lineas` (linea)VALUES ('INTEGRA');
INSERT INTO `lineas` (linea)VALUES ('NEURO');
INSERT INTO `lineas` (linea)VALUES ('PMR');
INSERT INTO `lineas` (linea)VALUES ('PRESVAC');
INSERT INTO `lineas` (linea)VALUES ('QUIRURGICO');
INSERT INTO `lineas` (linea)VALUES ('STERIS');
INSERT INTO `lineas` (linea)VALUES ('TERUMO');
INSERT INTO `lineas` (linea)VALUES ('VICTUS');
INSERT INTO `lineas` (linea)VALUES ('ZIMMER');

INSERT INTO `tipos_equipos` (tipos) VALUES ('AGITADOR DE PLAQUETAS');
INSERT INTO `tipos_equipos` (tipos) VALUES ('BOMBA DE ALIMENTACION');
INSERT INTO `tipos_equipos` (tipos) VALUES ('BOMBA DE INFUSION');
INSERT INTO `tipos_equipos` (tipos) VALUES ('BOMBA EXTRACORPOREA');
INSERT INTO `tipos_equipos` (tipos) VALUES ('CABEZAL DE CAMARA');
INSERT INTO `tipos_equipos` (tipos) VALUES ('CAMARA');
INSERT INTO `tipos_equipos` (tipos) VALUES ('CAMARA REFRIGERADA');
INSERT INTO `tipos_equipos` (tipos) VALUES ('DERMATOMO');
INSERT INTO `tipos_equipos` (tipos) VALUES ('ELECTROCAUTERIO');
INSERT INTO `tipos_equipos` (tipos) VALUES ('FUENTE DE LUZ');
INSERT INTO `tipos_equipos` (tipos) VALUES ('INSUFLADOR');
INSERT INTO `tipos_equipos` (tipos) VALUES ('INYECTOR');
INSERT INTO `tipos_equipos` (tipos) VALUES ('MONITOR BIS');
INSERT INTO `tipos_equipos` (tipos) VALUES ('MONITOR DE VIDEO');
INSERT INTO `tipos_equipos` (tipos) VALUES ('MONITOR INVOS');
INSERT INTO `tipos_equipos` (tipos) VALUES ('NEBULIZADOR');
INSERT INTO `tipos_equipos` (tipos) VALUES ('TORNIQUETE');
INSERT INTO `tipos_equipos` (tipos) VALUES ('TORRE DE VIDEO');
INSERT INTO `tipos_equipos` (tipos) VALUES ('VENTILADOR');

DROP table `tipos_equipos`
DROP TABLE `mantenimiento`
