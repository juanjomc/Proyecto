-- MySQL dump 10.13  Distrib 9.0.1, for macos14.7 (x86_64)
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (1,'juanjo','aa@aa.com','666666666','2025-04-03','2025-04-16','prueba',0,'2025-04-01 01:43:29','::1'),(2,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-03 23:44:40','::1'),(3,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-03 23:47:34','::1'),(4,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-03 23:54:00','::1'),(5,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:07:34','::1'),(6,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:12:22','::1'),(7,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:12:41','::1'),(8,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',0,'2025-04-04 00:12:43','::1'),(9,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:21:29','::1'),(10,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:23:44','::1'),(11,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:24:19','::1'),(12,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:24:46','::1'),(13,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-04-04 00:25:07','::1'),(14,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:13:20','127.0.0.1'),(15,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:14:39','127.0.0.1'),(16,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:15:39','127.0.0.1'),(17,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:16:10','127.0.0.1'),(18,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:24:47','127.0.0.1'),(19,'Juanjo','aa@aa.com','666777888','2023-10-01','2023-12-12','',1,'2025-05-12 09:35:25','127.0.0.1');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opciones`
--

LOCK TABLES `opciones` WRITE;
/*!40000 ALTER TABLE `opciones` DISABLE KEYS */;
INSERT INTO `opciones` VALUES (2,'limpieza','40'),(7,'laboralbes','60'),(8,'sabado','90'),(9,'domingo','80'),(10,'mv_whatsapp','665864218'),(11,'mensaje_whatsapp','Hola buenas, estaria interesado en su apartamento. Me llamo: Seriamos: Fecha de entrada: Fecha de salida:');
/*!40000 ALTER TABLE `opciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` int NOT NULL,
  `entrada` datetime NOT NULL,
  `Salida` datetime NOT NULL,
  `usuario` int NOT NULL,
  `Total` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarifas`
--

DROP TABLE IF EXISTS `tarifas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarifas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Domingo` decimal(10,2) NOT NULL DEFAULT '70.00',
  `Lunes` decimal(10,2) NOT NULL DEFAULT '70.00',
  `Martes` decimal(10,2) NOT NULL DEFAULT '70.00',
  `Miercoles` decimal(10,2) NOT NULL DEFAULT '70.00',
  `Jueves` decimal(10,2) NOT NULL DEFAULT '70.00',
  `Viernes` decimal(10,2) NOT NULL DEFAULT '90.00',
  `Sabado` decimal(10,2) NOT NULL DEFAULT '90.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarifas`
--

LOCK TABLES `tarifas` WRITE;
/*!40000 ALTER TABLE `tarifas` DISABLE KEYS */;
INSERT INTO `tarifas` VALUES (1,70.00,70.00,70.00,70.00,70.00,90.00,90.00);
/*!40000 ALTER TABLE `tarifas` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Juanjo','Admin','ju@ju.com','$2a$12$qmUp4SaCGP6.fyR1/41dmer/MYh/ULmB.Hv5Kdav5p0Dit4clhZGa','1990-01-01',1,'2025-04-06 21:45:19'),(2,'aa','p','aa@aaa.com','$2a$12$qmUp4SaCGP6.fyR1/41dmer/MYh/ULmB.Hv5Kdav5p0Dit4clhZGa','2000-02-20',2,'2025-05-14 23:41:00'),(3,'uu','uu','aa@aaaa.com','$2y$10$sz6CMKZ99ofeLlb9pNqmO.peSnKnO7gwyDSxPi7M4qsSK2Sm7cFB2','2000-02-20',2,'2025-05-14 23:44:56'),(4,'aa','aa','aa@aa.com','$2y$10$o7ThiPhxWm2Z5wpwXcSchOiRXJBtak7Bh4oTF1BMe5z8syOa0/N4i','2000-02-20',2,'2025-05-14 23:49:06'),(5,'aa','a','aa@aa.coma','$2y$10$I3C5ZTPYpUTuZVvJnzCUDefiqnYc3PksMoOP2J0snxIxnVK0h.WZS','2000-02-20',2,'2025-05-14 23:52:01'),(6,'q','w','aa@aa.con','$2y$10$duuQPi./JjtLUeN4g2CZI.Ypr0AWHec2Fx4jTeJ4sCmaOE8DRSDgq','2000-02-20',2,'2025-05-14 23:52:27'),(7,'a','a','aa@aal.com','$2y$10$Syoq6HJSWk/4rOUiUB/bP.qvYadlM7YzQsyb5gQAU/BOyB8dlYqz.','2000-02-20',2,'2025-05-14 23:54:17'),(8,'aaa@aa.es','a','aa@aa.es','$2y$10$ucIFSZKsu3auKkPSmoNRPur/umJKAreawtOwNfXOYY9l6ihb.ZGri','2000-02-20',2,'2025-05-14 23:55:36'),(9,'12','12','12@12.om','$2y$10$a.3atZOSmq3TUi4MVTQ89.BpGKMdh.nLcwxNj82WzmlzXU3uk5dFC','2000-02-12',2,'2025-05-15 23:41:38');
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

-- Dump completed on 2025-05-16  4:25:25
