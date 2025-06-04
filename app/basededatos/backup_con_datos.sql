-- MySQL dump 10.13  Distrib 8.0.35, for macos13 (x86_64)
--
-- Host: localhost    Database: proyecto
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contactos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `mensaje` text,
  `leido` tinyint NOT NULL DEFAULT '1',
  `fecha_hora` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (4,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-03 23:54:00','::1'),(5,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:07:34','::1'),(6,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:12:22','::1'),(7,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:12:41','::1'),(8,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:12:43','::1'),(9,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:21:29','::1'),(11,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:24:19','::1'),(12,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:24:46','::1'),(13,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:25:07','::1'),(14,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:13:20','127.0.0.1'),(15,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:14:39','127.0.0.1'),(16,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:15:39','127.0.0.1'),(17,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:16:10','127.0.0.1'),(18,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:24:47','127.0.0.1'),(19,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:35:25','127.0.0.1'),(20,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','Prueba',1,'2025-06-02 17:41:29','127.0.0.1'),(21,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','asdf',1,'2025-06-02 18:09:24','127.0.0.1'),(22,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','asf',1,'2025-06-02 18:10:37','127.0.0.1'),(23,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','asdf',1,'2025-06-02 18:11:50','127.0.0.1'),(24,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','asdf',1,'2025-06-02 18:26:16','127.0.0.1');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_reserva`
--

DROP TABLE IF EXISTS `detalles_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalles_reserva` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_reserva` int NOT NULL,
  `fecha` date NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` enum('bloqueado','reservado') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detalles_reserva_ibfk_1` (`id_reserva`),
  CONSTRAINT `detalles_reserva_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_reserva`
--

LOCK TABLES `detalles_reserva` WRITE;
/*!40000 ALTER TABLE `detalles_reserva` DISABLE KEYS */;
INSERT INTO `detalles_reserva` VALUES (1,14,'2025-05-27',60.00,'reservado'),(2,14,'2025-05-28',60.00,'reservado'),(3,14,'2025-05-29',60.00,'reservado'),(4,14,'2025-05-30',90.00,'reservado'),(5,14,'2025-05-31',0.00,'reservado'),(6,15,'2025-05-26',60.00,'reservado'),(7,15,'2025-05-27',60.00,'reservado'),(8,15,'2025-05-28',60.00,'reservado'),(9,15,'2025-05-29',0.00,'reservado'),(10,16,'2025-05-27',60.00,'reservado'),(11,16,'2025-05-28',60.00,'reservado'),(12,16,'2025-05-29',60.00,'reservado'),(13,16,'2025-05-30',0.00,'reservado'),(14,17,'2025-06-02',60.00,'reservado'),(15,17,'2025-06-03',60.00,'reservado'),(16,17,'2025-06-04',60.00,'reservado'),(17,17,'2025-06-05',0.00,'reservado'),(18,18,'2025-06-16',60.00,'reservado'),(19,18,'2025-06-17',60.00,'reservado'),(20,18,'2025-06-18',60.00,'reservado'),(21,18,'2025-06-19',0.00,'reservado'),(22,19,'2025-06-26',60.00,'reservado'),(23,19,'2025-06-27',90.00,'reservado'),(24,19,'2025-06-28',80.00,'reservado'),(25,19,'2025-06-29',60.00,'reservado'),(26,20,'2025-05-30',90.00,'reservado'),(27,21,'2025-06-18',60.00,'reservado'),(28,21,'2025-06-19',60.00,'reservado'),(29,21,'2025-06-20',90.00,'reservado'),(30,21,'2025-06-21',80.00,'reservado'),(31,22,'2025-06-09',60.00,'reservado'),(32,22,'2025-06-10',60.00,'reservado'),(33,22,'2025-06-11',60.00,'reservado'),(34,22,'2025-06-12',60.00,'reservado'),(35,22,'2025-06-13',90.00,'reservado'),(36,22,'2025-06-14',80.00,'reservado'),(37,22,'2025-06-15',60.00,'reservado'),(38,22,'2025-06-16',60.00,'reservado'),(39,22,'2025-06-17',60.00,'reservado'),(40,22,'2025-06-18',60.00,'reservado'),(41,22,'2025-06-19',60.00,'reservado'),(42,22,'2025-06-20',90.00,'reservado'),(43,23,'2025-07-17',60.00,'reservado'),(44,23,'2025-07-18',90.00,'reservado'),(45,23,'2025-07-19',80.00,'reservado'),(46,24,'2025-06-17',60.00,'reservado'),(47,24,'2025-06-18',60.00,'reservado'),(48,24,'2025-06-19',60.00,'reservado'),(49,24,'2025-06-20',90.00,'reservado'),(50,25,'2025-08-18',60.00,'reservado'),(51,25,'2025-08-19',60.00,'reservado'),(52,25,'2025-08-20',60.00,'reservado'),(53,25,'2025-08-21',60.00,'reservado'),(54,25,'2025-08-22',90.00,'reservado'),(55,25,'2025-08-23',80.00,'reservado'),(56,25,'2025-08-24',60.00,'reservado'),(57,25,'2025-08-25',60.00,'reservado'),(58,25,'2025-08-26',60.00,'reservado'),(59,25,'2025-08-27',60.00,'reservado'),(60,25,'2025-08-28',60.00,'reservado'),(61,25,'2025-08-29',90.00,'reservado'),(62,25,'2025-08-30',80.00,'reservado'),(63,26,'2025-05-30',90.00,'reservado'),(64,26,'2025-05-31',80.00,'reservado'),(65,26,'2025-06-01',60.00,'reservado'),(66,26,'2025-06-02',60.00,'reservado'),(67,26,'2025-06-03',60.00,'reservado'),(68,26,'2025-06-04',60.00,'reservado'),(69,26,'2025-06-05',60.00,'reservado'),(70,26,'2025-06-06',90.00,'reservado'),(71,26,'2025-06-07',80.00,'reservado'),(72,26,'2025-06-08',60.00,'reservado'),(73,26,'2025-06-09',60.00,'reservado'),(74,26,'2025-06-10',60.00,'reservado'),(75,26,'2025-06-11',60.00,'reservado'),(76,26,'2025-06-12',60.00,'reservado'),(77,26,'2025-06-13',90.00,'reservado'),(78,26,'2025-06-14',80.00,'reservado'),(79,26,'2025-06-15',60.00,'reservado'),(80,26,'2025-06-16',60.00,'reservado'),(81,26,'2025-06-17',60.00,'reservado'),(82,26,'2025-06-18',60.00,'reservado'),(83,26,'2025-06-19',60.00,'reservado'),(84,26,'2025-06-20',90.00,'reservado'),(85,27,'2025-06-19',60.00,'reservado'),(86,27,'2025-06-20',90.00,'reservado'),(87,27,'2025-06-21',80.00,'reservado'),(88,27,'2025-06-22',60.00,'reservado'),(89,27,'2025-06-23',60.00,'reservado'),(90,27,'2025-06-24',60.00,'reservado'),(91,27,'2025-06-25',60.00,'reservado'),(92,27,'2025-06-26',60.00,'reservado'),(93,27,'2025-06-27',90.00,'reservado'),(94,28,'2025-05-31',80.00,'reservado'),(95,28,'2025-06-01',60.00,'reservado'),(96,28,'2025-06-02',60.00,'reservado'),(97,28,'2025-06-03',60.00,'reservado'),(98,28,'2025-06-04',60.00,'reservado'),(99,28,'2025-06-05',60.00,'reservado'),(100,28,'2025-06-06',90.00,'reservado'),(101,28,'2025-06-07',80.00,'reservado'),(102,28,'2025-06-08',60.00,'reservado'),(103,28,'2025-06-09',60.00,'reservado'),(104,28,'2025-06-10',60.00,'reservado'),(105,28,'2025-06-11',60.00,'reservado'),(106,28,'2025-06-12',60.00,'reservado'),(107,28,'2025-06-13',90.00,'reservado'),(108,28,'2025-06-14',80.00,'reservado'),(109,29,'2025-07-08',60.00,'reservado'),(110,29,'2025-07-09',60.00,'reservado'),(111,29,'2025-07-10',60.00,'reservado'),(112,29,'2025-07-11',90.00,'reservado'),(113,29,'2025-07-12',80.00,'reservado'),(114,30,'2025-07-14',60.00,'reservado'),(115,30,'2025-07-15',60.00,'reservado'),(116,30,'2025-07-16',60.00,'reservado'),(117,30,'2025-07-17',60.00,'reservado'),(118,30,'2025-07-18',90.00,'reservado'),(119,30,'2025-07-19',80.00,'reservado'),(120,31,'2025-08-12',60.00,'reservado'),(121,31,'2025-08-13',60.00,'reservado'),(122,31,'2025-08-14',60.00,'reservado'),(123,31,'2025-08-15',90.00,'reservado'),(124,31,'2025-08-16',80.00,'reservado'),(125,32,'2025-07-22',60.00,'reservado'),(126,32,'2025-07-23',60.00,'reservado'),(127,32,'2025-07-24',60.00,'reservado'),(128,32,'2025-07-25',90.00,'reservado'),(129,32,'2025-07-26',80.00,'reservado'),(130,33,'2025-08-12',60.00,'reservado'),(131,33,'2025-08-13',60.00,'reservado'),(132,33,'2025-08-14',60.00,'reservado'),(133,33,'2025-08-15',90.00,'reservado'),(134,33,'2025-08-16',80.00,'reservado'),(135,34,'2025-08-13',60.00,'reservado'),(136,34,'2025-08-14',60.00,'reservado'),(137,34,'2025-08-15',90.00,'reservado'),(138,34,'2025-08-16',80.00,'reservado'),(139,34,'2025-08-17',60.00,'reservado'),(140,34,'2025-08-18',60.00,'reservado'),(141,34,'2025-08-19',60.00,'reservado'),(142,34,'2025-08-20',60.00,'reservado'),(143,34,'2025-08-21',60.00,'reservado'),(144,34,'2025-08-22',90.00,'reservado'),(145,34,'2025-08-23',80.00,'reservado'),(146,34,'2025-08-24',60.00,'reservado'),(147,34,'2025-08-25',60.00,'reservado'),(148,34,'2025-08-26',60.00,'reservado'),(149,34,'2025-08-27',60.00,'reservado'),(150,34,'2025-08-28',60.00,'reservado');
/*!40000 ALTER TABLE `detalles_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opciones`
--

DROP TABLE IF EXISTS `opciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `opcion` varchar(45) NOT NULL,
  `valor` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opciones`
--

LOCK TABLES `opciones` WRITE;
/*!40000 ALTER TABLE `opciones` DISABLE KEYS */;
INSERT INTO `opciones` VALUES (2,'limpieza','40'),(7,'laborables','60'),(8,'sabados','90'),(9,'domingos','80'),(10,'mv_whatsapp','675952960'),(11,'mensaje_whatsapp','Hola buenas, estaria interesado en su apartamento. Me llamo: Seriamos: Fecha de entrada: Fecha de salida:'),(12,'email_notificaciones','juanjocm@gmail.com');
/*!40000 ALTER TABLE `opciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entrada` datetime NOT NULL,
  `salida` datetime NOT NULL,
  `id_usuario` int NOT NULL,
  `total` int NOT NULL,
  `limpieza` int NOT NULL,
  `estado` enum('pagado','pendiente') NOT NULL,
  `fecha_reserva` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (14,'2025-05-27 00:00:00','2025-05-31 00:00:00',4,370,40,'pagado','2025-05-26 23:52:31'),(15,'2025-05-26 00:00:00','2025-05-29 00:00:00',4,280,40,'pagado','2025-05-26 23:53:33'),(16,'2025-05-27 00:00:00','2025-05-30 00:00:00',4,220,40,'pagado','2025-05-27 00:25:49'),(17,'2025-06-02 00:00:00','2025-06-05 00:00:00',4,220,40,'pagado','2025-05-29 02:43:48'),(18,'2025-06-16 00:00:00','2025-06-19 00:00:00',4,220,40,'pagado','2025-05-29 02:48:10'),(19,'2025-06-26 00:00:00','2025-06-30 00:00:00',4,330,40,'pagado','2025-05-29 02:51:39'),(20,'2025-05-30 00:00:00','2025-05-31 00:00:00',4,130,40,'pagado','2025-05-30 02:07:19'),(21,'2025-06-18 00:00:00','2025-06-22 00:00:00',4,330,40,'pagado','2025-05-30 02:11:32'),(22,'2025-06-09 00:00:00','2025-06-21 00:00:00',4,840,40,'pagado','2025-05-30 02:18:43'),(23,'2025-07-17 00:00:00','2025-07-20 00:00:00',4,270,40,'pagado','2025-05-30 02:34:43'),(24,'2025-06-17 00:00:00','2025-06-21 00:00:00',4,310,40,'pagado','2025-05-30 02:41:21'),(25,'2025-08-18 00:00:00','2025-08-31 00:00:00',4,920,40,'pagado','2025-05-30 02:44:32'),(26,'2025-05-30 00:00:00','2025-06-21 00:00:00',4,1540,40,'pagado','2025-05-30 02:56:23'),(27,'2025-06-19 00:00:00','2025-06-28 00:00:00',4,660,40,'pagado','2025-05-30 02:59:10'),(28,'2025-05-31 00:00:00','2025-06-15 00:00:00',4,1060,40,'pagado','2025-05-30 03:13:16'),(29,'2025-07-08 00:00:00','2025-07-13 00:00:00',4,390,40,'pagado','2025-06-02 20:22:10'),(30,'2025-07-14 00:00:00','2025-07-20 00:00:00',4,450,40,'pagado','2025-06-02 20:24:56'),(31,'2025-08-12 00:00:00','2025-08-17 00:00:00',4,390,40,'pagado','2025-06-02 20:28:20'),(32,'2025-07-22 00:00:00','2025-07-27 00:00:00',4,390,40,'pagado','2025-06-02 20:35:13'),(33,'2025-08-12 00:00:00','2025-08-17 00:00:00',4,390,40,'pagado','2025-06-02 20:42:49'),(34,'2025-08-13 00:00:00','2025-08-29 00:00:00',4,1100,40,'pagado','2025-06-02 20:45:01');
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `level` int DEFAULT '2',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Juanjo','Admin','ju@ju.com','$2y$10$tU7BXHnzSv7hAaAKN49kVuffNq/pTeu3o/5Gw3K6OkAhB5fmhuzfu','1990-01-01',1,'2025-04-06 21:45:19'),(2,'aa','p','aa@aaa.com','$2a$12$qmUp4SaCGP6.fyR1/41dmer/MYh/ULmB.Hv5Kdav5p0Dit4clhZGa','2000-02-20',2,'2025-05-14 23:41:00'),(3,'uu','uu','aa@aaaa.com','$2y$10$sz6CMKZ99ofeLlb9pNqmO.peSnKnO7gwyDSxPi7M4qsSK2Sm7cFB2','2000-02-20',2,'2025-05-14 23:44:56'),(4,'aa','aa','guaosgame@gmail.com','$2y$10$SdL9p/HrLTdM.y0UktgKaePcHbgDEssxt6WU/WyJUJNaZJIoWJyKq','2000-02-20',2,'2025-05-14 23:49:06'),(5,'aa','a','aa@aa.coma','$2y$10$I3C5ZTPYpUTuZVvJnzCUDefiqnYc3PksMoOP2J0snxIxnVK0h.WZS','2000-02-20',2,'2025-05-14 23:52:01'),(6,'q','w','aa@aa.con','$2y$10$duuQPi./JjtLUeN4g2CZI.Ypr0AWHec2Fx4jTeJ4sCmaOE8DRSDgq','2000-02-20',2,'2025-05-14 23:52:27'),(7,'a','a','aa@aal.com','$2y$10$Syoq6HJSWk/4rOUiUB/bP.qvYadlM7YzQsyb5gQAU/BOyB8dlYqz.','2000-02-20',2,'2025-05-14 23:54:17'),(8,'aaa@aa.es','a','aa@aa.es','$2y$10$ucIFSZKsu3auKkPSmoNRPur/umJKAreawtOwNfXOYY9l6ihb.ZGri','2000-02-20',2,'2025-05-14 23:55:36'),(9,'12','12','12@12.om','$2y$10$a.3atZOSmq3TUi4MVTQ89.BpGKMdh.nLcwxNj82WzmlzXU3uk5dFC','2000-02-12',2,'2025-05-15 23:41:38'),(10,'77','77','aa@aa.ep','$2y$10$BcZ5o/eXYQwnI6sX7jaL.ejx6AoVguewxhznDQ9rczmHkyWpplEKC','2000-02-20',2,'2025-05-17 19:36:16'),(11,'pepe','p','pp@pp.com','$2y$10$0O9906DdwSijQCm.s.UHpONz/czkE0xBoUvcpq5ns7YpUJ3058ar6','2000-02-20',2,'2025-05-19 19:35:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-03 23:44:55
