-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sympthomedb
-- ------------------------------------------------------
-- Server version	8.0.19

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
INSERT INTO `disease_categories` VALUES (1,'virus','The infectious diseases that can easily be spread from person to person when they get physically close to each other.'),(2,'Sexual Disease','Diseases transmitted sexually');
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
  UNIQUE KEY `uq_disease_id_medicine_id` (`disease_id`,`medicine_id`),
  KEY `fk_disease_medicine_log_disease_id` (`disease_id`),
  KEY `fk_disease_medicine_log_medicine_id` (`medicine_id`),
  CONSTRAINT `fk_disease_medicine_log_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  CONSTRAINT `fk_disease_medicine_log_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disease_medicine_log`
--

LOCK TABLES `disease_medicine_log` WRITE;
/*!40000 ALTER TABLE `disease_medicine_log` DISABLE KEYS */;
INSERT INTO `disease_medicine_log` VALUES (1,1,1),(2,1,2),(5,21,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diseases`
--

LOCK TABLES `diseases` WRITE;
/*!40000 ALTER TABLE `diseases` DISABLE KEYS */;
INSERT INTO `diseases` VALUES (1,'Covid-19','Dangerous for older population, it can be lethal. Broke out in 2019 causing a global pandemic and putting Earth on lockdown.','Don\'t engage in any social activity for the next 14 days. Stay home and do not interact with people! UPDATED',1,'0000-00-00 00:00:00'),(3,'Common Flu','Belongs to virus category of diseases, it is easily spread, but not too serious!','Easily treatable with antibiotics. Make sure you treat it on time because it can spread and become more dangerous later on.',1,'0000-00-00 00:00:00'),(5,'Adnan Mujagic','fdafa','fdasfdasfdas',2,'0000-00-00 00:00:00'),(21,'JUST VERY cute disease','VERY BAD DISEASE UPDATED','You gotta do something about this man!',2,'0000-00-00 00:00:00'),(23,'Not scary','Hello','Something actually readable!',1,'2021-05-15 09:00:14'),(24,'HARD REload','Hard Disease','fldjalkfj',1,'2021-05-15 09:16:50'),(25,'Not Too Bad','not serious','just drink lemonade',1,'2021-05-15 09:42:09'),(26,'just work pls','yes ','no',1,'2021-05-15 09:48:35'),(27,'working ?','jusus christ it\'s jason borne','you just gotta do something idk bro',1,'2021-05-15 17:59:19'),(28,'Newest Disease','fda somethign new','fdafda',1,'2021-05-21 09:58:53'),(29,'New Newest Disease','fdafdsa','fdasfdasfdas',1,'2021-05-21 10:04:03'),(30,'fjkhdasjfals','flkjdaslkfajslfajsj','flkjasklfjdsalkjfaslj',1,'2021-06-12 15:28:43'),(31,'Interstellar Disease','Disease description','fkldjsalfkasd',2,'2021-06-12 15:36:48'),(32,'kjhfdashkj','flkjdslak','flkdsfklasdlk',1,'2021-06-13 18:36:06'),(33,'H1z1','Bad BAD virus','something cool idk what i am typing but im typing fast',1,'2021-06-13 18:36:39');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicines`
--

LOCK TABLES `medicines` WRITE;
/*!40000 ALTER TABLE `medicines` DISABLE KEYS */;
INSERT INTO `medicines` VALUES (1,'Pfizer','A vaccine, it is not a cure!','Still not fully tested. Do not take more than prescriped in the instructions.','Unknown. Check in soon for updates!',0,'0000-00-00 00:00:00'),(2,'AstroZeneca','A vaccine','blabla','Unknown. Check in soon for updates!',0,'0000-00-00 00:00:00'),(3,'Xados','A medicine against rash and inflamation','blabla','Sleepiness',1,'0000-00-00 00:00:00'),(4,'Paracetamol','Take only one pill per day maximum','Dangerous for children!!','Sleepiness',0,'0000-00-00 00:00:00'),(5,'Ducray HIDROSIS CONTROL','Medicine that helps with itch and inflamation of skin!','Do not use more than once per day!','-',0,'0000-00-00 00:00:00'),(9,'fdsafdsa','fdsafdas','fdsafdasfasd','fdsafdsafdasfdasfdas',1,'2021-06-12 16:50:51'),(10,'Anti depressants','Hello','flkjdaslkjfalkj','Feeling numb',1,'2021-06-12 17:16:42'),(11,'B-Complex','Somethign','jfkldsjlfsaj','fkjdslkf',1,'2021-06-13 18:51:03');
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
  UNIQUE KEY `uq_symptom_id_disease_id` (`symptom_id`,`disease_id`),
  UNIQUE KEY `uq_symptom_disease_bodypart_ids` (`symptom_id`,`disease_id`,`body_part_id`),
  KEY `fk_symptom_disease_log_symptom_id` (`symptom_id`),
  KEY `fk_symptom_disease_log_disease_id` (`disease_id`),
  KEY `fk_bodypart_id_idx` (`body_part_id`),
  CONSTRAINT `fk_bodypart_id` FOREIGN KEY (`body_part_id`) REFERENCES `body_parts` (`id`),
  CONSTRAINT `fk_symptom_disease_log_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  CONSTRAINT `fk_symptom_disease_log_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `symptom_disease_bodypart_log`
--

LOCK TABLES `symptom_disease_bodypart_log` WRITE;
/*!40000 ALTER TABLE `symptom_disease_bodypart_log` DISABLE KEYS */;
INSERT INTO `symptom_disease_bodypart_log` VALUES (1,1,1,1),(12,1,21,NULL),(21,1,25,NULL),(4,3,1,NULL),(6,3,3,1),(3,5,1,1),(16,5,21,NULL),(18,6,21,1);
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
INSERT INTO `symptoms` VALUES (1,'Coughing','0000-00-00 00:00:00'),(2,'vommiting','0000-00-00 00:00:00'),(3,'itch','0000-00-00 00:00:00'),(4,'Abdominal Pain','0000-00-00 00:00:00'),(5,'losing taste','0000-00-00 00:00:00'),(6,'Back Pain','0000-00-00 00:00:00'),(7,'Headache','0000-00-00 00:00:00'),(8,'Internal Bleeding','0000-00-00 00:00:00'),(9,'Coughing','0000-00-00 00:00:00'),(10,'Dizziness','0000-00-00 00:00:00'),(11,'Sleepiness','0000-00-00 00:00:00'),(12,'Other examples','0000-00-00 00:00:00'),(14,'Example','0000-00-00 00:00:00'),(15,'Example','2021-04-03 12:35:57');
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
  `status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_id_symptom_id` (`symptom_id`,`user_id`),
  KEY `fk_user_symptom_log_symptom_id` (`symptom_id`),
  KEY `fk_user_symptom_log_user_id` (`user_id`),
  CONSTRAINT `fk_user_symptom_log_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`id`),
  CONSTRAINT `fk_user_symptom_log_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_symptom_log`
--

LOCK TABLES `user_symptom_log` WRITE;
/*!40000 ALTER TABLE `user_symptom_log` DISABLE KEYS */;
INSERT INTO `user_symptom_log` VALUES (27,1,1,'ACTIVE'),(28,2,1,'ACTIVE'),(29,3,1,'DELETED'),(30,10,1,'DELETED'),(31,9,1,'DELETED'),(32,4,1,'DELETED'),(33,1,10,'ACTIVE'),(34,2,10,'ACTIVE'),(35,3,65,'DELETED'),(42,6,1,'DELETED'),(43,5,1,'DELETED'),(44,7,1,'DELETED'),(45,8,1,'DELETED'),(46,11,1,'DELETED'),(47,12,1,'DELETED'),(48,14,1,'DELETED'),(49,15,1,'DELETED'),(50,1,65,'DELETED'),(51,2,65,'DELETED');
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
  `created_at` timestamp NOT NULL DEFAULT '2021-03-18 22:29:30',
  `type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NORMAL',
  `status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UNCONFIRMED',
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adnan','Mujagic',20,'202cb962ac59075b964b07152d234b70','adnanmujagic@outlook.com','2021-03-18 22:29:30','ADMIN','ACTIVE','321d07dc9167a86be28687f85d33229a','2021-05-19 08:49:17'),(10,'verystrongpassword','Mujagic',20,'b5326c66dd788fd341fb46aabb46dc2e','mujagicamar@gmail.com','2021-03-18 22:30:57','NORMAL','ACTIVE','x','0000-00-00 00:00:00'),(65,'Random','User',25,'e52b8910d3dd2b91e6981a5b0df632b7','vladotharealmvp@gmail.com','2021-04-06 18:57:28','NORMAL','ACTIVE','53c77ed1b8dbf6ad404693d002294f13','2021-06-13 19:15:26'),(66,'Unrandom','Korisnik',25,'202cb962ac59075b964b07152d234b70','myemail@gmail.com','2021-05-06 13:41:57','NORMAL','UNCONFIRMED','eae1dcd15cce66a3579f25433b59bae4','2021-05-06 13:41:57'),(88,'Adnan','Mujagic',20,'202cb962ac59075b964b07152d234b70','adnanmujagic@xdxd.com','2021-05-09 12:20:03','NORMAL','UNCONFIRMED','74b135ac7ef0ef64a86c5e5ffc772efd','2021-05-09 12:20:03'),(89,'Adnan','Mujagic',20,'202cb962ac59075b964b07152d234b70','xd@gmail.com','2021-05-09 12:20:42','NORMAL','UNCONFIRMED','66a6d943cba7b83dfde26838a508a939','2021-05-09 12:20:42'),(90,'Adnan','Mujagic',20,'202cb962ac59075b964b07152d234b70','blabla@gmail.com','2021-05-09 12:38:07','NORMAL','UNCONFIRMED','df3a7fc8216fe29f8e4a88fe4e18778c','2021-05-09 12:38:07'),(96,'amar','Mujagic',20,'202cb962ac59075b964b07152d234b70','adnanmujagic@fff.com','2021-05-19 08:07:06','NORMAL','UNCONFIRMED','b562f19177d2927d221195354727970f','2021-05-19 08:07:06'),(103,'Amar','Mujagic',20,'202cb962ac59075b964b07152d234b70','adnanmujagicf@gmail.com','2021-05-19 08:42:41','NORMAL','UNCONFIRMED','a1513e2b0ec5fb581753c9f988a610da','2021-05-19 08:42:41'),(105,'Amar','Mujagic',20,'202cb962ac59075b964b07152d234b70','adnanmujagic@gmail.com','2021-05-19 08:43:25','NORMAL','UNCONFIRMED','c2900203a497ad04759e52939a00e6ba','2021-05-19 08:43:25'),(107,'jlfdlaksjlsd','lkfjdlskafjsadl',30,'eb61eead90e3b899c6bcbe27ac581660','jflkdasjlfa@gmail.com','2021-06-12 15:12:27','NORMAL','UNCONFIRMED','4b806dbe5c3057060a2792118c89bc7e','2021-06-12 15:12:27'),(108,'Rejhan','fldsalkfd',21,'827ccb0eea8a706c4c34a16891f84e7b','rejhan@outlook.com','2021-06-13 19:14:31','NORMAL','UNCONFIRMED','5f1634daf5089e2f3990fd9cafe44f83','2021-06-13 19:14:31'),(110,'jlfkdsjl','fljdsljfasdlj',321,'438691adc09dbdad2382abdeb5df8fc7','fkldsklfsa@gmail.com','2021-06-14 20:11:38','NORMAL','UNCONFIRMED','4a277a7036821028f4f1f968a2df2caa','2021-06-14 20:11:38'),(111,'someone','intelligent',32,'47bce5c74f589f4867dbd57e9ca9f808','fkl@gmail.com','2021-06-14 20:12:42','NORMAL','UNCONFIRMED','f0d6e650510a6f1c9ab467875555c340','2021-06-14 20:12:42');
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

-- Dump completed on 2021-06-28 16:50:19
