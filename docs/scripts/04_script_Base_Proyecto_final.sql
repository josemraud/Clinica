

use proyecto_final;

CREATE TABLE `tipo_productos` (
  `cod_tipo` bigint(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
INSERT INTO `proyecto_final`.`tipo_productos`
(`cod_tipo`,
`descripcion`)
VALUES
(1,
'Consultas');

CREATE TABLE `productos` (
  `cod_producto` bigint(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cod_tipo` bigint(10) DEFAULT NULL,
  `prodimg` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_producto`),
  KEY `cod_producto_key` (`cod_tipo`),
  CONSTRAINT `cod_producto_key` FOREIGN KEY (`cod_tipo`) REFERENCES `tipo_productos` (`cod_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
INSERT INTO `proyecto_final`.`productos`
(`cod_producto`,`descripcion`,`precio`,`cod_tipo`,`prodimg`)
VALUES
(1,'Citología',620,1,'citologia.jpg'),
(2,'Histerectomía',700,1,'histerec3.jpg'),
(3,'Enfermedades de la mujer',600,1,'enfermedadeswoman.jpg'),
(4,'Parto Natural',650,1,'partonatural.jpeg'),
(5,'Cesárea',650,1,'cesarea.jpg'),
(6,'Levantamiento de vejiga',750,1,'levantamiento.jpg'),
(7,'Control Prenatal',600,1,'controlprena.jpg'),
(8,'Ultrasonido',500,1,'ultrasonido.jpg');

CREATE TABLE `ordenes` (
  `cod_orden` bigint(10) NOT NULL AUTO_INCREMENT,
  `fecha_orden` datetime NOT NULL,
  PRIMARY KEY (`cod_orden`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `ordenes_detalle` (
  `cod_detalle` bigint(10) NOT NULL AUTO_INCREMENT,
  `cod_orden` bigint(10) NOT NULL,
  `cod_producto` bigint(10) NOT NULL,
  `fecha` date NOT NULL,
  `total_pagar` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_detalle`),
  KEY `detalle_orden_key` (`cod_orden`),
  KEY `detalle_producto_key` (`cod_producto`),
  CONSTRAINT `detalle_orden_key` FOREIGN KEY (`cod_orden`) REFERENCES `ordenes` (`cod_orden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `detalle_producto_key` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

use proyecto_final;
select * from ordenes;
select * from ordenes_detalle;