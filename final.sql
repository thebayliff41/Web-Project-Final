-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for debian-linux-gnueabihf (armv8l)
--
-- Host: localhost    Database: final
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `deck_cards`
--

DROP TABLE IF EXISTS `deck_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deck_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deck_id` int(11) NOT NULL,
  `card1_id` varchar(50) DEFAULT NULL,
  `card2_id` varchar(50) DEFAULT NULL,
  `card3_id` varchar(50) DEFAULT NULL,
  `card4_id` varchar(50) DEFAULT NULL,
  `card5_id` varchar(50) DEFAULT NULL,
  `card6_id` varchar(50) DEFAULT NULL,
  `card7_id` varchar(50) DEFAULT NULL,
  `card8_id` varchar(50) DEFAULT NULL,
  `card9_id` varchar(50) DEFAULT NULL,
  `card10_id` varchar(50) DEFAULT NULL,
  `card11_id` varchar(50) DEFAULT NULL,
  `card12_id` varchar(50) DEFAULT NULL,
  `card13_id` varchar(50) DEFAULT NULL,
  `card14_id` varchar(50) DEFAULT NULL,
  `card15_id` varchar(50) DEFAULT NULL,
  `card16_id` varchar(50) DEFAULT NULL,
  `card17_id` varchar(50) DEFAULT NULL,
  `card18_id` varchar(50) DEFAULT NULL,
  `card19_id` varchar(50) DEFAULT NULL,
  `card20_id` varchar(50) DEFAULT NULL,
  `card21_id` varchar(50) DEFAULT NULL,
  `card22_id` varchar(50) DEFAULT NULL,
  `card23_id` varchar(50) DEFAULT NULL,
  `card24_id` varchar(50) DEFAULT NULL,
  `card25_id` varchar(50) DEFAULT NULL,
  `card26_id` varchar(50) DEFAULT NULL,
  `card27_id` varchar(50) DEFAULT NULL,
  `card28_id` varchar(50) DEFAULT NULL,
  `card29_id` varchar(50) DEFAULT NULL,
  `card30_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deck_cards`
--

LOCK TABLES `deck_cards` WRITE;
/*!40000 ALTER TABLE `deck_cards` DISABLE KEYS */;
INSERT INTO `deck_cards` VALUES (1,1,NULL,NULL,'EX1_572',NULL,'KAR_006','OG_156',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,5,'NEW1_021','NEW1_021','EX1_011',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,6,'CS2_084','OG_156','OG_061','GIL_607t','ICC_233','ICC_233','NEW1_021','NEW1_021','ICC_083','ICC_083','EX1_320','EX1_320','EX1_310','EX1_310','EX1_567','EX1_567','OG_200','OG_200','AT_020','AT_020','OG_318','OG_318','OG_255','OG_255','OG_239','OG_239','BRM_022','BRM_022','GIL_816','GIL_816');
/*!40000 ALTER TABLE `deck_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `decks`
--

DROP TABLE IF EXISTS `decks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `decks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  `format` enum('Standard','Wild') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_key` (`user_id`),
  CONSTRAINT `id_key` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `decks`
--

LOCK TABLES `decks` WRITE;
/*!40000 ALTER TABLE `decks` DISABLE KEYS */;
INSERT INTO `decks` VALUES (1,1,NULL,NULL),(3,3,'ROGUE','Standard'),(4,2,'DRUID','Wild'),(5,5,'DRUID','Standard'),(6,8,'HUNTER','Standard');
/*!40000 ALTER TABLE `decks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `password` blob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique` (`id`,`user_name`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Bailey','Nelson','thebayliff','$2y$10$F3l56ZncRqiRKmkBmMYTT.3Pm4ej.vnjBLnfbs2HwbjpFf6d5KVQ6'),(2,'Matt','Moon','yogjog','$2y$10$9zidvu0KXhMX18bMg0zpJeFRK6Bg/O6p4gw17Mt1kkRdx7/kHEb5G'),(3,'Bob','Builder','whoopity','$2y$10$Ju/COhdGBuEdH75l4SCXKefsiYZIBB3v1Fne8EAxGlaeYZyEJOjKW'),(4,'m','m','doggo','$2y$10$dn/HrfoppcRFFoYHVpjA5uB9yRntRunwgw6FSNDfWsWx7c5mReAa6'),(5,'Arpinar','Professor','Arpinar','$2y$10$JD2saR3TjynboiWPhZpRqOZSSWRW8EYxPS3VSWP5G1ntBr6mSzFCG'),(6,'b','b','blargh','$2y$10$/8URveME31WVJr3VQpZBG.HZgoWV7aQC7N13vx7DLoSNZhSCaInIe'),(7,'a','a','trust','$2y$10$hsA9wCVf8827/yIkc.1MTuUcHHHSBzmTsZ78vq.b7jWUxaUJbcs8m'),(8,'Matthew','Mooney','Moondog96','$2y$10$EN06Is3mryIoOMDFPAiu/.6qg1UIprf.g4Vc/ZNommetS7TLIhbwG');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-07 10:39:24
