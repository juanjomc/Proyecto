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
INSERT INTO `contactos` VALUES (22,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','asf',1,'2025-06-02 18:10:37','127.0.0.1'),(23,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','asdf',1,'2025-06-02 18:11:50','127.0.0.1'),(24,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','asdf',1,'2025-06-02 18:26:16','127.0.0.1');
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
  CONSTRAINT `detalles_reserva_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_reserva`
--

LOCK TABLES `detalles_reserva` WRITE;
/*!40000 ALTER TABLE `detalles_reserva` DISABLE KEYS */;
INSERT INTO `detalles_reserva` VALUES (120,31,'2025-08-12',60.00,'reservado'),(121,31,'2025-08-13',60.00,'reservado'),(122,31,'2025-08-14',60.00,'reservado'),(123,31,'2025-08-15',90.00,'reservado'),(124,31,'2025-08-16',80.00,'reservado'),(125,32,'2025-07-22',60.00,'reservado'),(126,32,'2025-07-23',60.00,'reservado'),(127,32,'2025-07-24',60.00,'reservado'),(128,32,'2025-07-25',90.00,'reservado'),(129,32,'2025-07-26',80.00,'reservado'),(130,33,'2025-08-12',60.00,'reservado'),(131,33,'2025-08-13',60.00,'reservado'),(132,33,'2025-08-14',60.00,'reservado'),(133,33,'2025-08-15',90.00,'reservado'),(134,33,'2025-08-16',80.00,'reservado'),(135,34,'2025-08-13',60.00,'reservado'),(136,34,'2025-08-14',60.00,'reservado'),(137,34,'2025-08-15',90.00,'reservado'),(138,34,'2025-08-16',80.00,'reservado'),(139,34,'2025-08-17',60.00,'reservado'),(140,34,'2025-08-18',60.00,'reservado'),(141,34,'2025-08-19',60.00,'reservado'),(142,34,'2025-08-20',60.00,'reservado'),(143,34,'2025-08-21',60.00,'reservado'),(144,34,'2025-08-22',90.00,'reservado'),(145,34,'2025-08-23',80.00,'reservado'),(146,34,'2025-08-24',60.00,'reservado'),(147,34,'2025-08-25',60.00,'reservado'),(148,34,'2025-08-26',60.00,'reservado'),(149,34,'2025-08-27',60.00,'reservado'),(150,34,'2025-08-28',60.00,'reservado');
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
INSERT INTO `reservas` VALUES (31,'2025-08-12 00:00:00','2025-08-17 00:00:00',4,390,40,'pagado','2025-06-02 20:28:20'),(32,'2025-07-22 00:00:00','2025-07-27 00:00:00',4,390,40,'pagado','2025-06-02 20:35:13'),(33,'2025-08-12 00:00:00','2025-08-17 00:00:00',4,390,40,'pagado','2025-06-02 20:42:49'),(34,'2025-08-13 00:00:00','2025-08-29 00:00:00',4,1100,40,'pagado','2025-06-02 20:45:01');
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
INSERT INTO `users` VALUES (1,'Juanjo','Admin','ju@ju.com','$2y$10$tU7BXHnzSv7hAaAKN49kVuffNq/pTeu3o/5Gw3K6OkAhB5fmhuzfu','1990-01-01',1,'2025-04-06 21:45:19'),(4,'aa','aa','guaosgame@gmail.com','$2y$10$SdL9p/HrLTdM.y0UktgKaePcHbgDEssxt6WU/WyJUJNaZJIoWJyKq','2000-02-20',2,'2025-05-14 23:49:06');
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

-- Dump completed on 2025-06-04 20:24:36
