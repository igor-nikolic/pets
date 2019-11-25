-- MySQL dump 10.17  Distrib 10.3.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pet
-- ------------------------------------------------------
-- Server version	10.3.13-MariaDB

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
-- Table structure for table `breed`
--

DROP TABLE IF EXISTS `breed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `breed` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `breed`
--

LOCK TABLES `breed` WRITE;
/*!40000 ALTER TABLE `breed` DISABLE KEYS */;
INSERT INTO `breed` VALUES (1,'Affenpinscher'),(2,'African'),(3,'Airedale'),(4,'Akit'),(5,'Appenzeller'),(6,'Basenji'),(7,'Beagle'),(8,'Bluetick'),(9,'Borzoi'),(10,'Bouvier'),(11,'Boxer'),(12,'Brabancon'),(13,'Briard'),(14,'Bulldog'),(15,'Bullterrier'),(16,'Cairn'),(17,'Cattledog'),(18,'Chihuahua'),(19,'Chow'),(20,'Clumber'),(21,'Cockapoo'),(22,'Collie'),(23,'Coonhound'),(24,'Corgi'),(25,'Cotondetulear'),(26,'Dachshund'),(27,'Dalmatian'),(28,'Dane'),(29,'Deerhound'),(30,'Dhole'),(31,'Dingo'),(32,'Doberman'),(33,'Elkhound'),(34,'Entlebucher'),(35,'Eskimo'),(36,'Frise'),(37,'Germanshepard'),(38,'Greyhound'),(39,'Groenendael'),(40,'Hound'),(41,'Husky'),(42,'Keeshond'),(43,'Kelpie'),(44,'Komondor'),(45,'Kuvasz'),(46,'Labrador'),(47,'Leonberg'),(48,'Lhasa'),(49,'Malamute'),(50,'Malinois'),(51,'Maltese'),(52,'Mastiff'),(53,'Mexicanhairless'),(54,'Mix'),(55,'Mountain'),(56,'Newfoundland'),(57,'Otterhound'),(58,'Papillon'),(59,'Pekinese'),(60,'Pembroke'),(61,'Pinscher'),(62,'Pointer'),(63,'Pomeranian'),(64,'Poodle'),(65,'Pug'),(66,'Puggle'),(67,'Pyrenees'),(68,'Redbone'),(69,'Retriever'),(70,'Ridgeback'),(71,'Rottweiler'),(72,'Saluki'),(73,'Samoyed'),(74,'Schipperke'),(75,'Schnauzer'),(76,'Setter'),(77,'Sheepdog'),(78,'Shiba'),(79,'Shihtzu'),(80,'Spaniel'),(81,'Springer'),(82,'Stbernard'),(83,'Terrier'),(84,'Vizsla'),(85,'Weimaraner'),(86,'Whippet'),(87,'Wolfhound');
/*!40000 ALTER TABLE `breed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Pet','This is a project for school subject.','+38132020202','examplemail@mail.com','Example Address 22');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Home','/',NULL),(2,'About','/about',NULL),(3,'Contact/Poll','/contact',NULL),(4,'Search pets','/pets',NULL),(5,'Add a new pet','/pets/create',2),(6,'Admin panel','/admin/home',1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `father_id` int(10) DEFAULT NULL,
  `mother_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `breed_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
INSERT INTO `pet` VALUES (1,'Dog 1','m','2019-03-05',NULL,NULL,2,12),(2,'Dog 2','f','2019-02-25',1,NULL,2,48),(3,'Dog 3','m','2019-03-04',NULL,NULL,2,1),(4,'Dog 4','f','2019-03-01',3,2,2,23),(5,'Dog 5','f','2018-10-16',3,2,2,54),(6,'Dog 6','m','2019-03-05',NULL,NULL,2,2),(7,'Rex Royal','f','1997-02-06',1,2,2,11),(8,'Mike','m','2019-02-24',1,7,2,34),(9,'Example dog','m','2018-09-12',6,4,2,20),(10,'Bill','m','2019-02-24',6,5,2,3),(11,'Flocky','m','2019-03-05',8,4,2,19);
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet_photo`
--

DROP TABLE IF EXISTS `pet_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_photo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pet_id` int(10) NOT NULL,
  `photo_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet_photo`
--

LOCK TABLES `pet_photo` WRITE;
/*!40000 ALTER TABLE `pet_photo` DISABLE KEYS */;
INSERT INTO `pet_photo` VALUES (1,1,1),(2,2,2),(3,2,3),(4,3,4),(5,3,5),(6,4,6),(7,4,7),(8,5,8),(9,5,9),(10,5,10),(11,5,11),(12,6,10),(13,6,11),(14,6,12),(15,6,13),(16,6,14),(17,6,15),(18,6,16),(19,6,17),(20,7,18),(21,7,19),(22,7,20),(23,8,21),(24,9,22),(25,9,23),(26,10,24),(27,10,25),(28,1,26),(29,2,27),(30,3,28),(31,4,29),(32,5,30),(33,6,31),(34,7,32),(35,8,33),(36,9,34),(37,10,35),(38,11,36);
/*!40000 ALTER TABLE `pet_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'15521563490_n02099712_7049.jpg','Otac0'),(2,'15521563660_n02099712_7049.jpg','Majka0'),(3,'15521563661_n02091635_1043.jpg','Majka1'),(4,'15521564170_n02096177_143.jpg','Majka 20'),(5,'15521564171_n02090721_969.jpg','Majka 21'),(6,'15521564330_n02096177_143.jpg','SIn0'),(7,'15521564331_n02091635_1043.jpg','SIn1'),(8,'15521574140_n02091635_452.jpg','awldkawd0'),(9,'15521574141_n02090721_969.jpg','awldkawd1'),(10,'15521583600_stevebaxter_bichon_frise.jpg','Proba0'),(11,'15521583601_n02108551_351.jpg','Proba1'),(12,'15521583602_n02099712_7049.jpg','Proba2'),(13,'15521583603_n02096177_143.jpg','Proba3'),(14,'15521583604_n02091635_1043.jpg','Proba4'),(15,'15521583605_n02091635_452.jpg','Proba5'),(16,'15521583606_n02090721_969.jpg','Proba6'),(17,'15521583607_n02085936_1325.jpg','Proba7'),(18,'15522343230_n02104029_3769.jpg','Primer0'),(19,'15522343231_n02099712_7049.jpg','Primer1'),(20,'15522343232_n02096177_143.jpg','Primer2'),(21,'15522387150_n02108551_351.jpg','Primer2220'),(22,'15522392240_n02108551_351.jpg','Hello0'),(23,'15522392241_n02096177_143.jpg','Hello1'),(24,'15522398350_n02099712_7049.jpg','wadawd0'),(25,'15522398351_n02085936_1325.jpg','wadawd1'),(26,'15523030300_n02085620_1765.jpg','Dog 10'),(27,'15523030470_n02091635_1043.jpg','Dog 20'),(28,'15523030640_n02096177_143.jpg','Dog 30'),(29,'15523030790_n02091635_452.jpg','Dog 40'),(30,'15523030950_n02104029_3769.jpg','Dog 50'),(31,'15523031160_stevebaxter_bichon_frise.jpg','Dog 60'),(32,'15523033680_n02108551_351.jpg','Rex Royal0'),(33,'15523034060_n02091635_1043.jpg','Mike0'),(34,'15523034240_n02096177_143.jpg','Example dog0'),(35,'15523034430_n02091635_1043.jpg','Bill0'),(36,'15523034570_n02096177_143.jpg','Flocky0');
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll`
--

DROP TABLE IF EXISTS `poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vote` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll`
--

LOCK TABLES `poll` WRITE;
/*!40000 ALTER TABLE `poll` DISABLE KEYS */;
INSERT INTO `poll` VALUES (1,'127.0.0.1',3);
/*!40000 ALTER TABLE `poll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'admin'),(2,'user');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `activation_hash` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'Lkawhd','Jhkjghdawkg','nikolic.igor@outlook.com','$2y$10$bwc5ZdBmz6qdzT.ztmsU1..RXqQODD3j5Q5ve0sUB7.e1sKJFFFsK','2019-03-01 15:38:20','2019-03-01 16:38:21',NULL,'2019-03-01 15:38:42','MTU1MTQ1NDcwMHxuaWtvbGljLmlnb3JAb3V0bG9vay5jb20='),(2,2,'Igor','Nikolic','devignik@gmail.com','$2y$10$RGSTzjCBtV00gcAt64bdVub9GgA1Ub0pNq2dbsJJSJJZyP6JAHcj.','2019-03-05 10:40:55','2019-03-05 11:40:55',NULL,'2019-03-05 10:41:14','MTU1MTc4MjQ1NXxkZXZpZ25pa0BnbWFpbC5jb20='),(4,2,'Igor','Nikolic','ignik995@gmail.com','$2y$10$xOB5cWqqTl.gllT/zQfece8fVLBzz90VmYF.bqy8Vki8phj74Bu86','2019-03-05 12:51:00','2019-03-05 13:51:00',NULL,'2019-03-05 12:51:14','MTU1MTc5MDI2MHxpZ25pazk5NUBnbWFpbC5jb20='),(5,1,'Entered By Admin','Entered By Admin','awdawd@gmail.com','$2y$10$nuhMkm5lIAdWasz7y7Y4dOBCD4JIACXWbPef6RHKhfIbZduP3AZ.a','2019-03-12 19:15:06','2019-03-12 20:15:06',NULL,'2019-03-12 19:15:06',NULL),(6,2,'Awdawd','Awdawd','laallaall@gmail.com','$2y$10$VkDrIPtgUIv2/ub/h7dyZO7ID78UJJ6NzzUmb4ev66Xz9qR2G3ICa','2019-03-12 19:17:09','2019-03-12 20:17:09',NULL,'2019-03-12 19:17:09',NULL),(7,1,'Lalal','Lalal','awjdhakjwhd@gmail.com','$2y$10$FIx0exmcHmmXVQzpOJm91euBpXCoXgZA9f1KbUNqIR6skgFuSd8Nu','2019-03-12 19:17:33','2019-03-12 20:17:33',NULL,'2019-03-12 19:17:33',NULL),(8,2,'Ioawdawdi','Awawdj','ignik995959@gmail.com','$2y$10$NZwAbIq5SAFA3CxgE1UGNe4U0umtH.9q5Aga9z61azGkR1neH0jyS','2019-03-12 19:30:40','2019-03-12 20:30:40',NULL,'2019-03-12 19:30:40',NULL),(9,2,'Awdawd','Awdawddwa','ddddddd@gmail.com','$2y$10$/wCh2p7BDAhSmQLZfG3UReaeVM3mfkWt5YT0POhJlTwsos2teR33G','2019-03-12 19:30:54','2019-03-12 20:30:54',NULL,'2019-03-12 19:30:54',NULL),(10,2,'Mirjana','Bobic Mojsilovic','examplemail@gmail.com','$2y$10$oGVO6jMXQ34KlfzGc2GvZOrHrB81K5jQkvWbrDTkTdg33qC6Q8Wf.','2019-03-12 19:31:20','2019-03-12 20:31:20',NULL,'2019-03-12 19:31:20',NULL),(11,2,'Lkawdjlkj','Awdjklawlkdj','iii@gmail.com','$2y$10$GyBtW87R7M7gxYcmTxueQOcYQ0MWBd8ccZdXTnhVdMdzfyVQVwiwC','2019-03-12 19:31:37','2019-03-12 20:31:37',NULL,'2019-03-12 19:31:37',NULL),(12,2,'Awawd','Awwadawd','ppppp@gmail.com','$2y$10$W0Ni.lCKDixxvrKAr8FdL.iHo1jIiLtgagNzsuz3e9l.D3i8UTRya','2019-03-12 19:31:54','2019-03-12 20:31:54',NULL,'2019-03-12 19:31:54',NULL);
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

-- Dump completed on 2019-03-14 15:24:38
