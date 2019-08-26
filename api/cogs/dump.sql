-- MySQL dump 10.13  Distrib 5.5.24, for Win64 (x86)
--
-- Host: localhost    Database: qms
-- ------------------------------------------------------
-- Server version	5.5.24

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientId` int(11) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `description` longtext,
  `uploads` longtext,
  `createdOn` datetime DEFAULT NULL,
  `statusCode` int(11) DEFAULT '1',
  `statusName` varchar(250) DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,3,'2019-08-09 00:00:00','Try me','[{\"physicalUrl\":\"/home2/emglnkmy/public_html/resource/repo/100/80a6a874ff1928cf51c25daba4615ed5.png\",\"hyperLinkUrl\":\"http://resource.calista.co.ke/repo/100/80a6a874ff1928cf51c25daba4615ed5.png\"}]','2019-08-23 16:58:35',1,'Active'),(2,3,'2019-08-31 00:00:00','Try coding','[{\"physicalUrl\":\"/home2/emglnkmy/public_html/resource/repo/100/20747aa50bd5be781f504c221e6354f8.png\",\"hyperLinkUrl\":\"http://resource.calista.co.ke/repo/100/20747aa50bd5be781f504c221e6354f8.png\"}]','2019-08-23 17:09:23',1,'Active'),(3,3,'2019-08-31 00:00:00','Malibu','[{\"physicalUrl\":\"/home2/emglnkmy/public_html/resource/repo/100/42359906ce5253daa5cd80a65cdb921a.png\",\"hyperLinkUrl\":\"http://resource.calista.co.ke/repo/100/42359906ce5253daa5cd80a65cdb921a.png\"}]','2019-08-23 17:12:19',1,'Active');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `token` longtext,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `roleId` int(11) DEFAULT NULL,
  `avatar` longtext,
  `createdOn` datetime DEFAULT NULL,
  `timeStamp` datetime DEFAULT NULL,
  `statusCode` int(11) DEFAULT '1',
  `statusName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'66348','9245a8aa72658ccbe705f1f7e191a65d807e0a8120190822153528','Jane','Doe','','jane@gmail.com','2bfc2c6cbf32a5a7a139f5b8922fbb7b',2,'https://www.provenwinners.com/sites/provenwinners.com/files/imagecache/500x500/ifa_upload/tuff_stuff_red_hydrangea_proven_winners.jpg',NULL,NULL,1,NULL),(2,'25835','ac78edb3a9ce0a61b0ca61843382301a7f5b870a20190822153804','John','Doe','0714406984','john@gmail.com','2bfc2c6cbf32a5a7a139f5b8922fbb7b',2,'https://www.provenwinners.com/sites/provenwinners.com/files/imagecache/500x500/ifa_upload/tuff_stuff_red_hydrangea_proven_winners.jpg',NULL,NULL,1,NULL),(3,'37855','d0625953311fc9b43fff03f1b3caa77656f67f2e20190822163735','Tevin','Munene','07068282554','tevin@gmail.com','2bfc2c6cbf32a5a7a139f5b8922fbb7b',2,'https://www.provenwinners.com/sites/provenwinners.com/files/imagecache/500x500/ifa_upload/tuff_stuff_red_hydrangea_proven_winners.jpg',NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `token` longtext,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `roleId` int(11) DEFAULT NULL,
  `avatar` longtext,
  `createdOn` datetime DEFAULT NULL,
  `timeStamp` datetime DEFAULT NULL,
  `statusCode` int(11) DEFAULT '1',
  `statusName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2','23','Beatrice','Kirunda','25470000000','admin@gmail.com','2bfc2c6cbf32a5a7a139f5b8922fbb7b',1,'https://www.provenwinners.com/sites/provenwinners.com/files/imagecache/500x500/ifa_upload/tuff_stuff_red_hydrangea_proven_winners.jpg','2019-07-15 14:44:06',NULL,NULL,'Active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientId` int(11) DEFAULT NULL,
  `appointmentId` int(11) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `diagnosis` longtext,
  `prescriptions` longtext,
  `createdOn` datetime DEFAULT NULL,
  `statusCode` int(11) DEFAULT '0',
  `statusName` varchar(100) DEFAULT 'Done',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visits`
--

LOCK TABLES `visits` WRITE;
/*!40000 ALTER TABLE `visits` DISABLE KEYS */;
INSERT INTO `visits` VALUES (1,3,1,2,'d','d','2019-08-27 17:31:31',0,'Done');
/*!40000 ALTER TABLE `visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitsreports`
--

DROP TABLE IF EXISTS `visitsreports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitsreports` (
  `id` int(11) NOT NULL DEFAULT '0',
  `patientId` int(11) DEFAULT NULL,
  `visitId` int(11) DEFAULT NULL,
  `diagnosis` longtext,
  `prescription` longtext,
  `createdOn` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitsreports`
--

LOCK TABLES `visitsreports` WRITE;
/*!40000 ALTER TABLE `visitsreports` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitsreports` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-23 18:37:58
