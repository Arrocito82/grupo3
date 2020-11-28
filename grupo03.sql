DROP DATABASE IF EXISTS `grupo03`;
CREATE DATABASE `grupo03` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci */;
USE `grupo03`;

#
# Source for table libro
#

DROP TABLE IF EXISTS `libro`;
CREATE TABLE `libro` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) COLLATE latin1_spanish_ci NOT NULL,
  `titulo` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `autor` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `editorial` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9819 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

#
# Dumping data for table libro
#

INSERT INTO `libro` VALUES (1,'10010010010','La odisea','Homero','Almadraba');
INSERT INTO `libro` VALUES (2,'10110111011','La iliada','Homero','Murcia');
INSERT INTO `libro` VALUES (3,'10210210210','Cuentos de barro','Salarrue',' La Montaña');
INSERT INTO `libro` VALUES (4,'10110111011','La iliada','Homero','Murcia');
INSERT INTO `libro` VALUES (5,'52136956566','The Hunger Games','Suzanne Collins','Scholastic Corporation');
INSERT INTO `libro` VALUES (6,'00034543411','Star Wars Episode I: The Phantom Menace','Terry Brooks','Del Rey');

			

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `nivel` int(2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO `usuarios` VALUES (1,'Admin','admin','Ing.Balmore Ortiz',2);
INSERT INTO `usuarios` VALUES (2,'Registrador1','registrador1','Juan Perdomo',1);
INSERT INTO `usuarios` VALUES (3,'Mantenimiento','mantenimiento','Simon Sandoval',2);
INSERT INTO `usuarios` VALUES (4,'Registrador2','registrador2','Alejandra Platero',1);