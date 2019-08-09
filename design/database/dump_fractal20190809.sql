-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: fractal
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.19.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `ciudad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ciudad_id`),
  KEY `provincia_id_idx` (`provincia_id`),
  CONSTRAINT `provincia_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`provincia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Distrito Nacional',5),(2,'Azua de Compostela',1),(3,'Estebanía',1),(4,'Guayabal',1),(5,'Las Charcas',1),(6,'Las Yayas de Viajama',1),(7,'Padre Las Casas',1),(8,'Peralta',1),(9,'Pueblo Viejo',1),(10,'Sabana Yegua',1),(11,'Tábara Arriba',1),(12,'Neiba',2),(13,'Galván',2),(14,'Los Ríos',2),(15,'Tamayo',2),(16,'Villa Jaragua',2),(17,'Barahona',3),(18,'Cabral',3),(19,'El Peñón',3),(20,'Enriquillo',3),(21,'Fundación',3),(22,'Jaquimeyes',3),(23,'La Ciénaga',3),(24,'Las Salinas',3),(25,'Paraíso',3),(26,'Polo',3),(27,'Vicente Noble',3),(28,'Dajabón',4),(29,'El Pino',4),(30,'Loma de Cabrera',4),(31,'Partido',4),(32,'Restauración',4),(33,'San Francisco de Macorís',6),(34,'Arenoso',6),(35,'Castillo',6),(36,'Eugenio María de Hostos',6),(37,'Las Guáranas',6),(38,'Pimentel',6),(39,'Villa Riva',6),(40,'El Seibo',8),(41,'Miches',8),(42,'Comendador',7),(43,'Bánica',7),(44,'El Llano',7),(45,'Hondo Valle',7),(46,'Juan Santiago',7),(47,'Pedro Santana',7),(48,'Moca',9),(49,'Cayetano Germosén',9),(50,'Gaspar Hernández',9),(51,'Jamao al Norte',9),(52,'Hato Mayor del Rey',10),(53,'El Valle',10),(54,'Sabana de la Mar',10),(55,'Salcedo',11),(56,'Tenares',11),(57,'Villa Tapia',11),(58,'Jimaní',12),(59,'Cristóbal',12),(60,'Duvergé',12),(61,'La Descubierta',12),(62,'Mella',12),(63,'Postrer Río',12),(64,'Higüey',13),(65,'San Rafael del Yuma',13),(66,'La Romana',14),(67,'Guaymate',14),(68,'Villa Hermosa',14),(69,'La Concepción de La Vega',15),(70,'Constanza',15),(71,'Jarabacoa',15),(72,'Jima Abajo',15),(73,'Nagua',16),(74,'Cabrera',16),(75,'El Factor',16),(76,'Río San Juan',16),(77,'Bonao',17),(78,'Maimón',17),(79,'Piedra Blanca',17),(80,'Montecristi',18),(81,'Castañuela',18),(82,'Guayubín',18),(83,'Las Matas de Santa Cruz',18),(84,'Pepillo Salcedo',18),(85,'Villa Vásquez',18),(86,'Monte Plata',19),(87,'Bayaguana',19),(88,'Peralvillo',19),(89,'Sabana Grande de Boyá',19),(90,'Yamasá',19),(91,'Pedernales',20),(92,'Oviedo',20),(93,'Baní',21),(94,'Nizao',21),(95,'Puerto Plata',22),(96,'Altamira',22),(97,'Guananico',22),(98,'Imbert',22),(99,'Los Hidalgos',22),(100,'Luperón',22),(101,'Sosúa',22),(102,'Villa Isabela',22),(103,'Villa Montellano',22),(104,'Samaná',23),(105,'Las Terrenas',23),(106,'Sánchez',23),(107,'San Cristóbal',25),(108,'Bajos de Haina',25),(109,'Cambita Garabito',25),(110,'Los Cacaos',25),(111,'Sabana Grande de Palenque',25),(112,'San Gregorio de Nigua',25),(113,'Villa Altagracia',25),(114,'Yaguate',25),(115,'San José de Ocoa',26),(116,'Rancho Arriba',26),(117,'Sabana Larga',26),(118,'San Juan de la Maguana',27),(119,'Bohechío',27),(120,'El Cercado',27),(121,'Juan de Herrera',27),(122,'Las Matas de Farfán',27),(123,'Vallejuelo',27),(124,'San Pedro de Macorís',28),(125,'Consuelo',28),(126,'Guayacanes',28),(127,'Quisqueya',28),(128,'Ramón Santana',28),(129,'San José de Los Llanos',28),(130,'Cotuí',24),(131,'Cevicos',24),(132,'Fantino',24),(133,'La Mata',24),(134,'Santiago',29),(135,'Bisonó',29),(136,'Jánico',29),(137,'Licey al Medio',29),(138,'Puñal',29),(139,'Sabana Iglesia',29),(140,'San José de las Matas',29),(141,'Tamboril',29),(142,'Villa González',29),(143,'San Ignacio de Sabaneta',30),(144,'Los Almácigos',30),(145,'Monción',30),(146,'Santo Domingo Este',31),(147,'Boca Chica',31),(148,'Los Alcarrizos',31),(149,'Pedro Brand',31),(150,'San Antonio de Guerra',31),(151,'Santo Domingo Norte',31),(152,'Santo Domingo Oeste',31),(153,'Mao',32),(154,'Esperanza',32),(155,'Laguna Salada',32);
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `telefono` int(11) NOT NULL,
  `cantidad_compras` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `telefono` (`telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `valor` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_factura`
--

DROP TABLE IF EXISTS `detalles_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_factura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float(11,2) DEFAULT NULL,
  `factura_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_factura_id` (`factura_id`),
  CONSTRAINT `detalles_factura_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_factura`
--

LOCK TABLES `detalles_factura` WRITE;
/*!40000 ALTER TABLE `detalles_factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalles_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `sector_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones`
--

LOCK TABLES `direcciones` WRITE;
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
INSERT INTO `direcciones` VALUES (1,1,1,1),(3,1,2,2),(4,1,2,2),(5,1,2,2),(6,1,2,2),(7,1,2,2),(8,1,2,2),(9,1,1,1),(10,1,1,1),(11,1,2,2),(12,NULL,NULL,NULL),(13,NULL,NULL,NULL),(14,NULL,NULL,NULL),(15,NULL,NULL,NULL),(16,NULL,NULL,NULL),(17,NULL,NULL,NULL),(18,NULL,NULL,NULL),(19,NULL,NULL,NULL),(20,NULL,NULL,NULL),(21,NULL,NULL,NULL),(22,NULL,NULL,NULL),(23,NULL,NULL,NULL),(24,NULL,NULL,NULL),(25,NULL,NULL,NULL),(26,NULL,NULL,NULL),(27,NULL,NULL,NULL),(28,NULL,NULL,NULL),(29,NULL,NULL,NULL),(30,NULL,NULL,NULL),(31,NULL,NULL,NULL),(32,NULL,NULL,NULL),(33,NULL,NULL,NULL),(34,NULL,NULL,NULL),(35,NULL,NULL,NULL),(36,NULL,NULL,NULL),(37,1,2,2),(38,NULL,NULL,NULL),(39,NULL,NULL,NULL),(40,NULL,NULL,NULL),(41,NULL,NULL,NULL),(42,NULL,NULL,NULL),(43,NULL,NULL,NULL),(44,NULL,NULL,NULL),(45,NULL,NULL,NULL),(46,NULL,NULL,NULL),(47,NULL,NULL,NULL),(48,NULL,NULL,NULL),(49,NULL,NULL,NULL),(50,NULL,NULL,NULL),(51,NULL,NULL,NULL),(52,NULL,NULL,NULL),(53,NULL,NULL,NULL),(54,NULL,NULL,NULL),(55,NULL,NULL,NULL),(56,NULL,NULL,NULL),(57,NULL,NULL,NULL),(58,NULL,NULL,NULL),(59,NULL,NULL,NULL),(60,NULL,NULL,NULL),(61,NULL,NULL,NULL),(62,NULL,NULL,NULL),(63,NULL,NULL,NULL),(64,NULL,NULL,NULL),(65,NULL,NULL,NULL),(66,NULL,NULL,NULL),(67,NULL,NULL,NULL),(68,NULL,NULL,NULL);
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (72,'123@gmail.com');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `vendedor_id` int(11) DEFAULT NULL,
  `comprador_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `precio_total` float(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `fk_vendedor_id` (`vendedor_id`),
  KEY `fk_comprador_id` (`comprador_id`),
  KEY `fk_modificado_por` (`modificado_por`),
  CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`vendedor_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`comprador_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `precio` float(11,2) NOT NULL DEFAULT '0.00',
  `existencia` int(11) DEFAULT NULL,
  `impuesto` float(11,2) NOT NULL,
  `precio_total` float(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincias` (
  `provincia_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`provincia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (1,'Azua'),(2,'Bahoruco'),(3,'Barahona'),(4,'Dajabón'),(5,'Distrito Nacional'),(6,'Duarte'),(7,'Elías Piña'),(8,'El Seibo'),(9,'Espaillat'),(10,'Hato Mayor'),(11,'Hermanas Mirabal'),(12,'Independencia'),(13,'La Altagracia'),(14,'La Romana'),(15,'La Vega'),(16,'María Trinidad Sánchez'),(17,'Monseñor Nouel'),(18,'Monte Cristi'),(19,'Monte Plata'),(20,'Pedernales'),(21,'Peravia'),(22,'Puerto Plata'),(23,'Samaná'),(24,'Sánchez Ramírez'),(25,'San Cristóbal'),(26,'San José de Ocoa'),(27,'San Juan'),(28,'San Pedro de Macorís'),(29,'Santiago'),(30,'Santiago Rodríguez'),(31,'Santo Domingo'),(32,'Valverde');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(20) NOT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'visitor',1),(2,'user',20);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sectores`
--

DROP TABLE IF EXISTS `sectores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sectores` (
  `sector_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sector_id`),
  KEY `ciudad_id_idx` (`ciudad_id`),
  CONSTRAINT `ciudad_id` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`ciudad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sectores`
--

LOCK TABLES `sectores` WRITE;
/*!40000 ALTER TABLE `sectores` DISABLE KEYS */;
INSERT INTO `sectores` VALUES (1,'Barreras',2),(2,'Barro Arriba',2),(3,'Clavellina',2),(4,'Emma Balaguer Viuda Vallejo',2),(5,'Las Barías-La Estancia',2),(6,'Las Lomas',2),(7,'Los Jovillos',2),(8,'Puerto Viejo',2),(9,'Hatillo',5),(10,'Palmar de Ocoa',5),(11,'Villarpando',6),(12,'Hato Nuevo-Cortés',6),(13,'La Siembra',7),(14,'Las Lagunas',7),(15,'Los Fríos',7),(16,'El Rosario',9),(17,'Proyecto 4',10),(18,'Ganadero',10),(19,'Proyecto 2-C',10),(20,'Amiama Gómez',11),(21,'Los Toros',11),(22,'Tábara Abajo',11),(23,'El Palmar',12),(24,'El Salado',13),(25,'Las Clavellinas',14),(26,'Cabeza de Toro',15),(27,'Mena',15),(28,'Monserrat',15),(29,'Santa Bárbara-El 6',15),(30,'Santana',15),(31,'Uvilla',15),(32,'El Cachón',17),(33,'La Guázara',17),(34,'Villa Central',17),(35,'Arroyo Dulce',20),(36,'Pescadería',21),(37,'Palo Alto',22),(38,'Bahoruco',23),(39,'Los Patos',25),(40,'Canoa',27),(41,'Fondo Negro',27),(42,'Quita Coraza',27),(43,'Cañongo',28),(44,'Manuel Bueno',4),(45,'Capotillo',30),(46,'Santiago de la Cruz',30),(47,'Cenoví',33),(48,'Jaya',33),(49,'La Peña',33),(50,'Presidente Don Antonio Guzmán Fernández',33),(51,'Aguacate',34),(52,'Las Coles',34),(53,'Sabana Grande',36),(54,'Agua Santa del Yuna',39),(55,'Barraquito',39),(56,'Cristo Rey de Guaraguao',39),(57,'Las Táranas',39),(58,'Pedro Sánchez',40),(59,'San Francisco-Vicentillo',40),(60,'Santa Lucía',41),(61,'El Cedro',41),(62,'La Gina',41),(63,'Guayabo',42),(64,'Sabana Larga',42),(65,'Sabana Cruz',43),(66,'Sabana Higüero',43),(67,'Guanito',44),(68,'Rancho de la Guardia',45),(69,'Río Limpio',47),(70,'Canca La Reina',48),(71,'El Higüerito',48),(72,'José Contreras',48),(73,'Juan López',48),(74,'La Ortega',48),(75,'Las Lagunas',48),(76,'Monte de la Jagua',48),(77,'San Víctor',48),(78,'Joba Arriba',50),(79,'Veragua',50),(80,'Villa Magante',50),(81,'Guayabo Dulce',52),(82,'Mata Palacio',52),(83,'Yerba Buena',52),(84,'Elupina Cordero de Las Cañitas',54),(85,'Jamao Afuera',55),(86,'Blanco',56),(87,'Boca de Cachón',58),(88,'El Limón',58),(89,'Batey 8',59),(90,'Vengan a Ver',60),(91,'La Colonia',62),(92,'Guayabal',63),(93,'La Otra Banda',64),(94,'Lagunas de Nisibón',64),(95,'Verón-Punta Cana',64),(96,'Bayahibe',65),(97,'Boca de Yuma',65),(98,'Caleta',66),(99,'Cumayasa',68),(100,'El Ranchito',69),(101,'Río Verde Arriba',69),(102,'La Sabina',70),(103,'Tireo',70),(104,'Buena Vista',70),(105,'Manabao',71),(106,'Rincón',72),(107,'Arroyo al Medio',73),(108,'Las Gordas',73),(109,'San José de Matanzas',73),(110,'Arroyo Salado',74),(111,'La Entrada',74),(112,'El Pozo',75),(113,'Arroyo Toro-Masipedro',77),(114,'La Salvia-Los Quemados',77),(115,'Jayaco',77),(116,'Juma Bejucal',77),(117,'Sabana del Puerto',77),(118,'Juan Adrián',79),(119,'Villa Sonador',79),(120,'Palo Verde',81),(121,'Cana Chapetón',82),(122,'Hatillo Palma',82),(123,'Villa Elisa',82),(124,'Boyá',86),(125,'Chirino',86),(126,'Don Juan',86),(127,'Gonzalo',89),(128,'Majagual',89),(129,'Los Botados',90),(130,'José Francisco Peña Gómez',91),(131,'Juancho',91),(132,'Catalina',93),(133,'El Carretón',93),(134,'El Limonal',93),(135,'Las Barías',93),(136,'Matanzas',93),(137,'Paya',93),(138,'Sabana Buey',93),(139,'Villa Fundación',93),(140,'Villa Sombrero',93),(141,'Pizarrete',94),(142,'Santana',94),(143,'Maimón',86),(144,'Yásica Arriba',86),(145,'Río Grande',96),(146,'Navas',99),(147,'Belloso',100),(148,'Estrecho',100),(149,'La Isabela',100),(150,'Cabarete',101),(151,'Sabaneta de Yásica',101),(152,'Estero Hondo',102),(153,'Gualete',102),(154,'La Jaiba',102),(155,'Arroyo Barril',104),(156,'El Limón',104),(157,'Las Galeras',104),(158,'Hato Damas',107),(159,'El Carril',108),(160,'Cambita El Pueblecito',109),(161,'La Cuchilla',113),(162,'Medina',113),(163,'San José del Puerto',113),(164,'El Naranjal',115),(165,'El Pinar',115),(166,'La Ciénaga',115),(167,'Nizao-Las Auyamas',115),(168,'El Rosario',118),(169,'Guanito',118),(170,'Hato del Padre',118),(171,'Hato Nuevo',118),(172,'La Jagua',118),(173,'Las Charcas de María Nova',118),(174,'Pedro Corto',118),(175,'Sabana Alta',118),(176,'Sabaneta',118),(177,'Arroyo Cano',119),(178,'Yaque',119),(179,'Batista',120),(180,'Derrumbadero',120),(181,'Jínova',121),(182,'Carrera de Yegua',122),(183,'Matayaya',122),(184,'Jorjillo',123),(185,'El Puerto',129),(186,'Gautier',129),(187,'Caballero',130),(188,'Comedero Arriba',130),(189,'Quita Sueño',130),(190,'La Cueva',131),(191,'Platanal',131),(192,'Angelina',133),(193,'La Bija',133),(194,'Hernando Alonzo',133),(195,'Baitoa',134),(196,'Hato del Yaque',134),(197,'La Canela',134),(198,'Pedro García',134),(199,'San Francisco de Jacagua',134),(200,'El Caimito',136),(201,'Juncalito',136),(202,'Las Palomas',137),(203,'Canabacoa',137),(204,'Guayabal',137),(205,'El Rubio',140),(206,'La Cuesta',140),(207,'Las Placetas',140),(208,'Canca La Piedra',141),(209,'El Limón',142),(210,'Palmar Arriba',142),(211,'San Luis',146),(212,'La Caleta',147),(213,'Palmarejo-Villa Linda',148),(214,'Pantoja',148),(215,'La Cuaba',149),(216,'La Guáyiga',149),(217,'Hato Viejo',150),(218,'La Victoria',151),(219,'Ámina',153),(220,'Guatapanal',153),(221,'Jaibón (Pueblo Nuevo)',153),(222,'Boca de Mao',154),(223,'Jicomé',154),(224,'Maizal',154),(225,'Paradero',154),(226,'Cruce de Guayacanes',155),(227,'Jaibón',155),(228,'La Caya',155);
/*!40000 ALTER TABLE `sectores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificado` datetime DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `role_id` int(11) DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_email_idx` (`email_id`),
  KEY `fk_role_id_idx` (`role_id`),
  CONSTRAINT `fk_email_id` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Enger','Jimenez','M','EJ21','123',NULL,'2019-07-03 10:45:00','2019-07-03 10:45:30',1,2),(3,'Juan','Francisco','M','FM12','321',NULL,'2019-07-03 11:25:00','2019-07-03 10:25:30',0,2),(4,'Jose','Alcantara','M','JOA22','$2y$10$I0xafoYebMEGQoxz0ROPzu5NrM4qv2VusWf7wcvmJmYRB/oG6GOXS',NULL,'2018-07-02 00:00:00',NULL,1,1),(6,'Pepe','Agallas','M','PEA123','$2y$10$ERAYvLoYr1yEDzpqm0urM.uLyAhR3Kvi17wGolKJB3M3GV8wEkLFy',NULL,'2019-07-19 12:00:40',NULL,1,1),(7,'Geronimo','Rodriguez','M','GRR12','$2y$10$UrbSOY9j/W2ZCLERABoojOymo2WBu/IhaENUGewuDXLp8rvLf5Gju',NULL,'2019-07-22 12:25:11',NULL,1,1),(31,'Danell','Torres','F','danell.ts','$2y$10$ozgfukn74xWc7ENsQN18HeQO1QMIEWeqnToJ1Hk1ZZlRt.z9JPgnO',NULL,'2019-07-24 15:29:34',NULL,1,1),(33,'Enger','Jimenez','M','EJR21','$2y$10$Xw8aXEhK0w9D3iK5O7Gw2eU6jb.X3IBCJQf/bTSm4eOW5lzrw.50y',NULL,'2019-07-25 08:40:58',NULL,1,1),(46,'John','Doe','M','JohnDoe01','$2y$10$joY6J3WbQv16oja0z8Gug.A.mNLpsCL7cIT8Mb4GmQ8.bfE0WCYZi',72,'2019-07-25 12:20:43',NULL,1,1),(47,'John','Doe','M','JohnDoe02','$2y$10$pT9KQY6H0vMoBlLR2MKM1Ou6zfPh0oNvBbt1JRrWZZc9Oqy2TAPNm',72,'2019-07-25 12:20:55',NULL,1,1),(48,'John','Doe','M','JohnDoe03','$2y$10$cdFJ0JLDRDxFnBoVUYm.8.qBRgA3C71FgbJCl1uXMaweXGCYE8hn2',72,'2019-07-25 12:21:30',NULL,1,1),(49,'John','Doe','F','JohnDoe04','$2y$10$52KelJPduObh5oGrkgxvR.5/NQILUt.7jviURq8X8c7BpTvykhe86',72,'2019-07-25 12:21:53',NULL,1,1),(50,'123','123','M','3211231','$2y$10$8oU7iBJE5PdYg5nQyGwagO8SgeBVCuinr2vLTMCIC3PxafJFfzk5m',NULL,'2019-07-30 11:31:39',NULL,1,2),(55,'123','123','M','3213123','$2y$10$MBoEZecaXEeQcp4pSC874uYX9BqAsoGolCeY5fd5iunuGDFP0ihIC',NULL,'2019-08-02 07:32:29',NULL,1,2),(56,'123321','123321','M','1312124','$2y$10$7L7olTkX93rhvteuGuxi6.OezonxHnRu/hIa6iRZc6nJoE8A9Kfda',NULL,'2019-08-02 07:39:18',NULL,1,2),(57,'ab','ba','M','3211232','$2y$10$aN2XdlJPRmW1Gh7qHJVIJOtpiFYGi3DPen1dZzKVUGwIPlIuWfKhm',NULL,'2019-08-02 07:46:34',NULL,1,2),(58,'ba','ab','M','321ab','$2y$10$W09ZA.P53xXcxtZNHYkNwOlL/c1kE5Ja35i.nNE2otPSh/1GOX8ee',NULL,'2019-08-02 07:47:31',NULL,1,2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_direcciones`
--

DROP TABLE IF EXISTS `usuarios_direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `direccion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id` (`usuario_id`),
  KEY `fk_direccion_id` (`direccion_id`),
  CONSTRAINT `usuarios_direcciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `usuarios_direcciones_ibfk_2` FOREIGN KEY (`direccion_id`) REFERENCES `direcciones` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_direcciones`
--

LOCK TABLES `usuarios_direcciones` WRITE;
/*!40000 ALTER TABLE `usuarios_direcciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_direcciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-09 16:58:54
