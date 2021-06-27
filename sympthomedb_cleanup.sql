-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: sympthomedb-do-user-9029621-0.b.db.ondigitalocean.com    Database: sympthomedb
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '10584a82-9610-11eb-ad14-8a54d69867c5:1-63';

--
-- Table structure for table `body_parts`
--

DROP TABLE IF EXISTS `body_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `body_parts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `body_parts`
--

LOCK TABLES `body_parts` WRITE;
/*!40000 ALTER TABLE `body_parts` DISABLE KEYS */;
INSERT INTO `body_parts` VALUES (1,'Throat'),(2,'Stomach'),(3,'Back'),(4,'Ankle');
/*!40000 ALTER TABLE `body_parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disease_categories`
--

DROP TABLE IF EXISTS `disease_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disease_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disease_categories`
--

LOCK TABLES `disease_categories` WRITE;
/*!40000 ALTER TABLE `disease_categories` DISABLE KEYS */;
INSERT INTO `disease_categories` VALUES (1,'Virus','The infectious diseases that can easily be spread from person to person when they get physically close to each other.');
/*!40000 ALTER TABLE `disease_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disease_medicine_log`
--

DROP TABLE IF EXISTS `disease_medicine_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disease_medicine_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `disease_id` int unsigned NOT NULL,
  `medicine_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_disease_medicine_log_disease_id` (`disease_id`),
  KEY `fk_disease_medicine_log_medicine_id` (`medicine_id`),
  CONSTRAINT `fk_disease_medicine_log_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  CONSTRAINT `fk_disease_medicine_log_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disease_medicine_log`
--

LOCK TABLES `disease_medicine_log` WRITE;
/*!40000 ALTER TABLE `disease_medicine_log` DISABLE KEYS */;
INSERT INTO `disease_medicine_log` VALUES (1,1,1),(2,1,2);
/*!40000 ALTER TABLE `disease_medicine_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diseases`
--

DROP TABLE IF EXISTS `diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diseases` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `treatment_description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int unsigned NOT NULL,
  `date_added` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_diseases_disease_category_id` (`category_id`),
  CONSTRAINT `fk_diseases_disease_category_id` FOREIGN KEY (`category_id`) REFERENCES `disease_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diseases`
--

LOCK TABLES `diseases` WRITE;
/*!40000 ALTER TABLE `diseases` DISABLE KEYS */;
INSERT INTO `diseases` VALUES (1,'Covid-19','Dangerous for older population, it can be lethal. Broke out in 2019 causing a global pandemic and putting Earth on lockdown.','Don\'t engage in any social activity for the next 14 days. Stay home and do not interact with people!',1,'0000-00-00 00:00:00'),(3,'Common Flu','Belongs to virus category of diseases, it is easily spread, but not too serious!','Easily treatable with antibiotics. Make sure you treat it on time because it can spread and become more dangerous later on.',1,'0000-00-00 00:00:00'),(21,'JUST VERY BAD DISEASE','VERY BAD DISEASE','You gotta do something about this man!',1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `diseases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicines` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `side_effects` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requires_prescription` tinyint(1) NOT NULL,
  `date_added` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicines`
--

LOCK TABLES `medicines` WRITE;
/*!40000 ALTER TABLE `medicines` DISABLE KEYS */;
INSERT INTO `medicines` VALUES (1,'Pfizer','A vaccine, it is not a cure!','Still not fully tested. Do not take more than prescriped in the instructions.','Unknown.',0,'0000-00-00 00:00:00'),(2,'AstroZeneca','A vaccine','blabla','Unknown.',0,'0000-00-00 00:00:00'),(3,'Xados','A medicine against rash and inflamation','blabla','Sleepiness',1,'0000-00-00 00:00:00'),(4,'Paracetamol','Take only one pill per day maximum','Dangerous for children!!','Sleepiness',0,'0000-00-00 00:00:00'),(5,'Ducray HIDROSIS CONTROL','Medicine that helps with itch and inflamation of skin!','Do not use more than once per day!','-',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `medicines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `symptom_disease_bodypart_log`
--

DROP TABLE IF EXISTS `symptom_disease_bodypart_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `symptom_disease_bodypart_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `symptom_id` int unsigned NOT NULL,
  `disease_id` int unsigned NOT NULL,
  `body_part_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_symptom_disease_log_symptom_id` (`symptom_id`),
  KEY `fk_symptom_disease_log_disease_id` (`disease_id`),
  KEY `fk_bodypart_id_idx` (`body_part_id`),
  CONSTRAINT `fk_bodypart_id` FOREIGN KEY (`body_part_id`) REFERENCES `body_parts` (`id`),
  CONSTRAINT `fk_symptom_disease_log_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  CONSTRAINT `fk_symptom_disease_log_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `symptom_disease_bodypart_log`
--

LOCK TABLES `symptom_disease_bodypart_log` WRITE;
/*!40000 ALTER TABLE `symptom_disease_bodypart_log` DISABLE KEYS */;
INSERT INTO `symptom_disease_bodypart_log` VALUES (1,1,1,1),(3,5,1,1),(4,3,1,NULL),(6,3,3,1);
/*!40000 ALTER TABLE `symptom_disease_bodypart_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `symptoms`
--

DROP TABLE IF EXISTS `symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `symptoms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `symptoms`
--

LOCK TABLES `symptoms` WRITE;
/*!40000 ALTER TABLE `symptoms` DISABLE KEYS */;
INSERT INTO `symptoms` VALUES (1,'Coughing','0000-00-00 00:00:00'),(2,'vommiting','0000-00-00 00:00:00'),(3,'itch','0000-00-00 00:00:00'),(4,'Abdominal Pain','0000-00-00 00:00:00'),(5,'losing taste','0000-00-00 00:00:00'),(6,'Back Pain','0000-00-00 00:00:00'),(7,'Headache','0000-00-00 00:00:00'),(8,'Internal Bleeding','0000-00-00 00:00:00'),(9,'Coughing','0000-00-00 00:00:00'),(10,'Dizziness','0000-00-00 00:00:00'),(11,'Sleepiness','0000-00-00 00:00:00'),(12,'Other examples','0000-00-00 00:00:00'),(14,'Example','0000-00-00 00:00:00'),(15,'Example','2021-04-03 14:35:57');
/*!40000 ALTER TABLE `symptoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_symptom_log`
--

DROP TABLE IF EXISTS `user_symptom_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_symptom_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `symptom_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_symptom_log_symptom_id` (`symptom_id`),
  KEY `fk_user_symptom_log_user_id` (`user_id`),
  CONSTRAINT `fk_user_symptom_log_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`id`),
  CONSTRAINT `fk_user_symptom_log_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_symptom_log`
--

LOCK TABLES `user_symptom_log` WRITE;
/*!40000 ALTER TABLE `user_symptom_log` DISABLE KEYS */;
INSERT INTO `user_symptom_log` VALUES (1,1,1),(2,2,1),(3,3,1);
/*!40000 ALTER TABLE `user_symptom_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2021-03-18 23:29:30',
  `type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NORMAL',
  `status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UNCONFIRMED',
  `token` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adnan','Mujagic',20,'e52b8910d3dd2b91e6981a5b0df632b7','adnanmujagic@outlook.com','2021-03-18 23:29:30','ADMIN','ACTIVE','b90089a76a5f1d23a3874384e6e4526f','2021-04-03 11:18:36'),(10,'verystrongpassword','Mujagic',20,'b5326c66dd788fd341fb46aabb46dc2e','mujagicamar@gmail.com','2021-03-18 23:30:57','NORMAL','ACTIVE','x','0000-00-00 00:00:00'),(11,'Muhamed','Begic',21,'ridiculous','blabla','2021-03-18 23:30:59','NORMAL','ACTIVE','x','0000-00-00 00:00:00'),(23,'Someone','Else',21,'fjdlak','something','2021-03-19 15:37:27','NORMAL','UNCONFIRMED','33255e3b2aebbfb6d8b85973577c5121','0000-00-00 00:00:00'),(50,'Amar','Mujagic',20,'1234','amar.mujagic@stu.ibu.edu.ba','2021-03-28 18:37:42','NORMAL','UNCONFIRMED','c6a479f00c32c0f40c1c024e79369a12','0000-00-00 00:00:00'),(61,'Adnan','Mujagic',20,'7383a1ac3c3c83d59ae8d7ab0af3a661','vladotharealmvp@gmail.com','2021-03-28 21:20:00','NORMAL','ACTIVE','c67a5410a215dcad371bdc038c2ea90d','0000-00-00 00:00:00'),(62,'Check','User',25,'202cb962ac59075b964b07152d234b70','check@gjdjla','2021-04-02 16:32:01','NORMAL','UNCONFIRMED','c7293c862df5737825fb71341ff9696f','2021-04-02 16:32:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-27 14:31:17
