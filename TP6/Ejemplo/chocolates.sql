# MySQL-Front 3.2  (Build 14.8)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='SYSTEM' */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: localhost    Database: chocolates
# ------------------------------------------------------
# Server version 5.0.41-community-nt

DROP DATABASE IF EXISTS `chocolates`;
CREATE DATABASE `chocolates` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `chocolates`;

#
# Table structure for table productos
#

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL auto_increment,
  `descripcion` varchar(250) default NULL,
  `precio` int(3) NOT NULL default '0',
  PRIMARY KEY  (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table productos
#

INSERT INTO `productos` VALUES (1,'Chocolate LINDT Hello - Sabores varios',30);
INSERT INTO `productos` VALUES (2,'Chocolate LINDT Lindor - Pack 200 gramos',50);
INSERT INTO `productos` VALUES (3,'Chocolate GODIVA - Bombones en pack de 250 gramos',120);
INSERT INTO `productos` VALUES (4,'Chocolate LEONIDAS - Caja de 500 gramos',100);

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
