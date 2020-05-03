/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.28-MariaDB : Database - pipi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pipi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pipi`;

/*Table structure for table `pipi_cajas` */

DROP TABLE IF EXISTS `pipi_cajas`;

CREATE TABLE `pipi_cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `prefix` varchar(45) NOT NULL,
  `seq_num` int(11) NOT NULL,
  `active` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_cajas` */

insert  into `pipi_cajas`(`id`,`name`,`prefix`,`seq_num`,`active`,`created_at`,`updated_at`) values (1,'Credito fiscal','A0100100101',278,'1',NULL,'2018-01-11 02:16:10'),(2,'Gubernamental','G0100100101',175,'1',NULL,'2018-01-11 03:24:10');

/*Table structure for table `pipi_camiones` */

DROP TABLE IF EXISTS `pipi_camiones`;

CREATE TABLE `pipi_camiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chasis` varchar(25) NOT NULL,
  `marca` varchar(25) NOT NULL,
  `modelo` varchar(25) NOT NULL,
  `capacidad` varchar(25) NOT NULL,
  `chofer_id` int(11) DEFAULT NULL,
  `ayudante_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `tipo_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `image_url` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `id_chofer` (`chofer_id`),
  KEY `tipo_id` (`tipo_id`),
  CONSTRAINT `pipi_camiones_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pipi_users` (`id`),
  CONSTRAINT `pipi_camiones_ibfk_4` FOREIGN KEY (`chofer_id`) REFERENCES `pipi_empleados` (`id`),
  CONSTRAINT `pipi_camiones_ibfk_5` FOREIGN KEY (`tipo_id`) REFERENCES `pipi_tipo_camiones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_camiones` */

insert  into `pipi_camiones`(`id`,`chasis`,`marca`,`modelo`,`capacidad`,`chofer_id`,`ayudante_id`,`active`,`tipo_id`,`user_id`,`image_url`,`created_at`,`updated_at`,`deleted_at`) values (3,'NX-555-3','dogde','macd','154',1,NULL,NULL,1,2,NULL,'2018-01-08 23:38:48','2018-01-09 03:38:48',NULL);

/*Table structure for table `pipi_clientes` */

DROP TABLE IF EXISTS `pipi_clientes`;

CREATE TABLE `pipi_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `RNC` varchar(25) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0->inactive;1->active',
  `user_id` int(11) NOT NULL,
  `image_url` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pipi_clientes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pipi_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_clientes` */

insert  into `pipi_clientes`(`id`,`nombre`,`direccion`,`telefono`,`RNC`,`email`,`active`,`user_id`,`image_url`,`created_at`,`updated_at`,`deleted_at`) values (1,'shad','Resp. Jhon F Kennedy #5','(809) 781-0763','77884-2','luis.sotozorrilla@gmail.com',1,2,NULL,'2018-01-11 01:26:40','2018-01-11 01:26:40',NULL);

/*Table structure for table `pipi_empleados` */

DROP TABLE IF EXISTS `pipi_empleados`;

CREATE TABLE `pipi_empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `fecha_nacimiento` varchar(25) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `flota` varchar(25) DEFAULT NULL,
  `salario` int(20) DEFAULT NULL,
  `direccion` text,
  `posicion_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0->inactive;1->inactive',
  `image_url` varchar(200) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `create_by` (`created_by`),
  KEY `posicion_id` (`posicion_id`),
  CONSTRAINT `pipi_empleados_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `pipi_users` (`id`),
  CONSTRAINT `pipi_empleados_ibfk_2` FOREIGN KEY (`posicion_id`) REFERENCES `pipi_posiciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_empleados` */

insert  into `pipi_empleados`(`id`,`nombre`,`apellido`,`fecha_nacimiento`,`cedula`,`email`,`telefono`,`flota`,`salario`,`direccion`,`posicion_id`,`active`,`image_url`,`created_by`,`created_at`,`updated_at`,`deleted_at`) values (1,'Luis','Soto','2018-01-23','444-4444444-4','luis.sotozorrilla@gmail.com','(809) 781-0763',NULL,NULL,'Resp. Jhon F Kennedy #5',1,1,NULL,2,'2018-01-09 03:31:48','2018-01-09 03:31:48',NULL);

/*Table structure for table `pipi_empleados_referencias_laboral` */

DROP TABLE IF EXISTS `pipi_empleados_referencias_laboral`;

CREATE TABLE `pipi_empleados_referencias_laboral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `empleado_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empleado_id` (`empleado_id`),
  CONSTRAINT `pipi_empleados_referencias_laboral_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `pipi_empleados` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_empleados_referencias_laboral` */

insert  into `pipi_empleados_referencias_laboral`(`id`,`descripcion`,`telefono`,`empleado_id`,`created_at`,`updated_at`,`deleted_at`) values (1,'sdsd','(809) 781-0763',1,'2018-01-09 03:31:48','2018-01-09 03:31:48',NULL);

/*Table structure for table `pipi_factura_detalles` */

DROP TABLE IF EXISTS `pipi_factura_detalles`;

CREATE TABLE `pipi_factura_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `viaje_id` int(11) DEFAULT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_factura_detalles` */

/*Table structure for table `pipi_facturas` */

DROP TABLE IF EXISTS `pipi_facturas`;

CREATE TABLE `pipi_facturas` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `NCF` varchar(25) NOT NULL,
  `no_factura` varchar(100) NOT NULL,
  `comentario` tinytext,
  `monto` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_factura_UNIQUE` (`no_factura`),
  UNIQUE KEY `NCF` (`NCF`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pipi_facturas_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `pipi_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_facturas` */

/*Table structure for table `pipi_gastos` */

DROP TABLE IF EXISTS `pipi_gastos`;

CREATE TABLE `pipi_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) NOT NULL,
  `monto` float NOT NULL,
  `camion_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `concepto_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `date` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `camion_id` (`camion_id`),
  KEY `concepto_id` (`concepto_id`),
  CONSTRAINT `pipi_gastos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pipi_users` (`id`),
  CONSTRAINT `pipi_gastos_ibfk_3` FOREIGN KEY (`concepto_id`) REFERENCES `pipi_gastos_conceptos` (`id`),
  CONSTRAINT `pipi_gastos_ibfk_4` FOREIGN KEY (`camion_id`) REFERENCES `pipi_camiones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pipi_gastos` */

/*Table structure for table `pipi_gastos_conceptos` */

DROP TABLE IF EXISTS `pipi_gastos_conceptos`;

CREATE TABLE `pipi_gastos_conceptos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pipi_gastos_conceptos` */

/*Table structure for table `pipi_mercancias` */

DROP TABLE IF EXISTS `pipi_mercancias`;

CREATE TABLE `pipi_mercancias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pipi_mercancias_ibfk_1` (`user_id`),
  CONSTRAINT `pipi_mercancias_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pipi_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pipi_mercancias` */

/*Table structure for table `pipi_posiciones` */

DROP TABLE IF EXISTS `pipi_posiciones`;

CREATE TABLE `pipi_posiciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_posiciones` */

insert  into `pipi_posiciones`(`id`,`descripcion`,`created_at`,`updated_at`,`deleted_at`) values (1,'chofer','2018-01-08 23:31:24','0000-00-00 00:00:00',NULL);

/*Table structure for table `pipi_productos_facturacion` */

DROP TABLE IF EXISTS `pipi_productos_facturacion`;

CREATE TABLE `pipi_productos_facturacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_productos_facturacion` */

insert  into `pipi_productos_facturacion`(`id`,`descripcion`,`created_at`,`updated_at`,`deleted_at`) values (1,'servicio viaje varios','2018-01-11 00:28:15','2018-01-11 00:28:15',NULL),(2,'servicio viaje santiago','2018-01-10 20:28:57','2018-01-11 00:28:57',NULL);

/*Table structure for table `pipi_roles` */

DROP TABLE IF EXISTS `pipi_roles`;

CREATE TABLE `pipi_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_roles` */

insert  into `pipi_roles`(`id`,`description`) values (1,'Super Admin');

/*Table structure for table `pipi_sub_clientes` */

DROP TABLE IF EXISTS `pipi_sub_clientes`;

CREATE TABLE `pipi_sub_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pipi_sub_clientes` */

/*Table structure for table `pipi_ticket_it` */

DROP TABLE IF EXISTS `pipi_ticket_it`;

CREATE TABLE `pipi_ticket_it` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `status` enum('ENVIADO','PROCESO') NOT NULL DEFAULT 'ENVIADO',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pipi_ticket_it_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `pipi_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pipi_ticket_it` */

/*Table structure for table `pipi_tipo_camiones` */

DROP TABLE IF EXISTS `pipi_tipo_camiones`;

CREATE TABLE `pipi_tipo_camiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(90) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_tipo_camiones` */

insert  into `pipi_tipo_camiones`(`id`,`descripcion`,`created_at`,`updated_at`,`deleted_at`) values (1,'uno','2018-01-09 03:29:48','2018-01-09 03:29:48',NULL);

/*Table structure for table `pipi_users` */

DROP TABLE IF EXISTS `pipi_users`;

CREATE TABLE `pipi_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `remember_token` varchar(500) DEFAULT NULL,
  `email` varchar(25) NOT NULL,
  `rol_id` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0->inactive;1->active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `pipi_users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `pipi_roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_users` */

insert  into `pipi_users`(`id`,`name`,`password`,`remember_token`,`email`,`rol_id`,`active`,`created_at`,`updated_at`) values (2,'Luis A Soto','$2y$10$9w290u.V4gfReqJDKGMg8erJm5EXltCEPo3ehvnVYbupICZbys3ba','J13IMWc7BhVngzI9xOJkvdeO1czp7K5gFyVx9tfS78OLzV0N6Owk7clYczoZ','admin@pipi.com',1,1,'2018-01-06 00:32:48','2017-07-15 03:03:17');

/*Table structure for table `pipi_viajes` */

DROP TABLE IF EXISTS `pipi_viajes`;

CREATE TABLE `pipi_viajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto_facturacion` int(11) DEFAULT NULL,
  `concepto` varchar(45) DEFAULT NULL,
  `comentario` text,
  `monto` float NOT NULL,
  `status` enum('WAREHOUSE','TRANSITO','COMPLETADO','FACTURADO') NOT NULL,
  `camion_id` int(11) DEFAULT '0',
  `cliente_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `camion_id` (`camion_id`),
  KEY `id_cliente` (`cliente_id`),
  KEY `id_producto_facturacion` (`id_producto_facturacion`),
  CONSTRAINT `pipi_viajes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `pipi_users` (`id`),
  CONSTRAINT `pipi_viajes_ibfk_3` FOREIGN KEY (`cliente_id`) REFERENCES `pipi_clientes` (`id`),
  CONSTRAINT `pipi_viajes_ibfk_4` FOREIGN KEY (`id_producto_facturacion`) REFERENCES `pipi_productos_facturacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `pipi_viajes` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
