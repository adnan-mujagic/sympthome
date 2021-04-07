/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 8.0.19 : Database - sympthomedb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sympthomedb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sympthomedb`;

/*Table structure for table `body_parts` */

DROP TABLE IF EXISTS `body_parts`;

CREATE TABLE `body_parts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `body_parts` */

insert  into `body_parts`(`id`,`name`) values 
(1,'Throat'),
(2,'Stomach'),
(3,'Back'),
(4,'Ankle');

/*Table structure for table `disease_categories` */

DROP TABLE IF EXISTS `disease_categories`;

CREATE TABLE `disease_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `disease_categories` */

insert  into `disease_categories`(`id`,`name`,`description`) values 
(1,'virus','The infectious diseases that can easily be spread from person to person when they get physically close to each other.'),
(2,'Sexual Disease','Diseases transmitted sexually');

/*Table structure for table `disease_medicine_log` */

DROP TABLE IF EXISTS `disease_medicine_log`;

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

/*Data for the table `disease_medicine_log` */

insert  into `disease_medicine_log`(`id`,`disease_id`,`medicine_id`) values 
(1,1,1),
(2,1,2);

/*Table structure for table `diseases` */

DROP TABLE IF EXISTS `diseases`;

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

/*Data for the table `diseases` */

insert  into `diseases`(`id`,`name`,`description`,`treatment_description`,`category_id`,`date_added`) values 
(1,'Covid-19','Dangerous for older population, it can be lethal. Broke out in 2019 causing a global pandemic and putting Earth on lockdown.','Don\'t engage in any social activity for the next 14 days. Stay home and do not interact with people!',1,'0000-00-00 00:00:00'),
(3,'Common Flu','Belongs to virus category of diseases, it is easily spread, but not too serious!','Easily treatable with antibiotics. Make sure you treat it on time because it can spread and become more dangerous later on.',1,'0000-00-00 00:00:00'),
(5,'Chlamydia','Is a sexually trasmitted disease','Easily treatable with antibiotics.',2,'0000-00-00 00:00:00'),
(21,'JUST VERY BAD DISEASE','VERY BAD DISEASE','You gotta do something about this man!',2,'0000-00-00 00:00:00');

/*Table structure for table `medicines` */

DROP TABLE IF EXISTS `medicines`;

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

/*Data for the table `medicines` */

insert  into `medicines`(`id`,`name`,`instruction`,`warning`,`side_effects`,`requires_prescription`,`date_added`) values 
(1,'Pfizer','A vaccine, it is not a cure!','Still not fully tested. Do not take more than prescriped in the instructions.','Unknown.',0,'0000-00-00 00:00:00'),
(2,'AstroZeneca','A vaccine','blabla','Unknown.',0,'0000-00-00 00:00:00'),
(3,'Xados','A medicine against rash and inflamation','blabla','Sleepiness',1,'0000-00-00 00:00:00'),
(4,'Paracetamol','Take only one pill per day maximum','Dangerous for children!!','Sleepiness',0,'0000-00-00 00:00:00'),
(5,'Ducray HIDROSIS CONTROL','Medicine that helps with itch and inflamation of skin!','Do not use more than once per day!','-',0,'0000-00-00 00:00:00');

/*Table structure for table `symptom_disease_bodypart_log` */

DROP TABLE IF EXISTS `symptom_disease_bodypart_log`;

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

/*Data for the table `symptom_disease_bodypart_log` */

insert  into `symptom_disease_bodypart_log`(`id`,`symptom_id`,`disease_id`,`body_part_id`) values 
(1,1,1,1),
(3,5,1,1),
(4,3,1,NULL),
(6,3,3,1);

/*Table structure for table `symptoms` */

DROP TABLE IF EXISTS `symptoms`;

CREATE TABLE `symptoms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `symptoms` */

insert  into `symptoms`(`id`,`name`,`date_added`) values 
(1,'Coughing','0000-00-00 00:00:00'),
(2,'vommiting','0000-00-00 00:00:00'),
(3,'itch','0000-00-00 00:00:00'),
(4,'Abdominal Pain','0000-00-00 00:00:00'),
(5,'losing taste','0000-00-00 00:00:00'),
(6,'Back Pain','0000-00-00 00:00:00'),
(7,'Headache','0000-00-00 00:00:00'),
(8,'Internal Bleeding','0000-00-00 00:00:00'),
(9,'Coughing','0000-00-00 00:00:00'),
(10,'Dizziness','0000-00-00 00:00:00'),
(11,'Sleepiness','0000-00-00 00:00:00'),
(12,'Other examples','0000-00-00 00:00:00'),
(14,'Example','0000-00-00 00:00:00'),
(15,'Example','2021-04-03 14:35:57');

/*Table structure for table `user_symptom_log` */

DROP TABLE IF EXISTS `user_symptom_log`;

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

/*Data for the table `user_symptom_log` */

insert  into `user_symptom_log`(`id`,`symptom_id`,`user_id`) values 
(1,1,1),
(2,2,1),
(3,3,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2021-03-18 23:29:30',
  `type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NORMAL',
  `status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UNCONFIRMED',
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`age`,`password`,`email`,`created_at`,`type`,`status`,`token`,`token_created_at`) values 
(1,'Adnan','Mujagic',20,'e52b8910d3dd2b91e6981a5b0df632b7','adnanmujagic@outlook.com','2021-03-18 23:29:30','ADMIN','ACTIVE','b90089a76a5f1d23a3874384e6e4526f','2021-04-03 11:18:36'),
(10,'verystrongpassword','Mujagic',20,'b5326c66dd788fd341fb46aabb46dc2e','mujagicamar@gmail.com','2021-03-18 23:30:57','NORMAL','ACTIVE','x','0000-00-00 00:00:00'),
(11,'Muhamed','Begic',21,'ridiculous','blabla','2021-03-18 23:30:59','NORMAL','ACTIVE','x','0000-00-00 00:00:00'),
(23,'Someone','Else',21,'fjdlak','something','2021-03-19 15:37:27','NORMAL','UNCONFIRMED','33255e3b2aebbfb6d8b85973577c5121','0000-00-00 00:00:00'),
(49,'Abdullah','Kenjar',20,'1234','abdullah.kenjar@stu.ibu.edu.ba','2021-03-28 18:36:57','NORMAL','UNCONFIRMED','cd769fd57efabe5b3e3155ac788f51a8','0000-00-00 00:00:00'),
(50,'Amar','Mujagic',20,'1234','amar.mujagic@stu.ibu.edu.ba','2021-03-28 18:37:42','NORMAL','UNCONFIRMED','c6a479f00c32c0f40c1c024e79369a12','0000-00-00 00:00:00'),
(51,'Ajla','Smajic',21,'1234','ajla.smajic@stu.ibu.edu.ba','2021-03-28 18:39:04','NORMAL','ACTIVE','cd87b7ebbc0272a20b2d6903917fe70d','0000-00-00 00:00:00'),
(52,'Muhamed','Begic',21,'1234','muhamed.begic@stu.ibu.edu.ba','2021-03-28 18:39:26','NORMAL','ACTIVE','b6ee6558154a4b358ba5e7c9b1b02ac0','0000-00-00 00:00:00'),
(53,'Mirela','Hadzic',21,'1234','mirela.hadzic@stu.ibu.edu.ba','2021-03-28 19:08:00','NORMAL','ACTIVE','2fdbb5ecb764e4388afdee98d229dab5','0000-00-00 00:00:00'),
(61,'Adnan','Mujagic',20,'7383a1ac3c3c83d59ae8d7ab0af3a661','vladotharealmvp@gmail.com','2021-03-28 21:20:00','NORMAL','ACTIVE','c67a5410a215dcad371bdc038c2ea90d','0000-00-00 00:00:00'),
(62,'Check','User',25,'202cb962ac59075b964b07152d234b70','check@gjdjla','2021-04-02 16:32:01','NORMAL','UNCONFIRMED','c7293c862df5737825fb71341ff9696f','2021-04-02 16:32:01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
