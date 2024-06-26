-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: asaanschool.com    Database: asaanschool_master
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.37-MariaDB

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
-- Table structure for table `app_modules`
--

DROP TABLE IF EXISTS `app_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `controllers` text DEFAULT NULL,
  `sort_order` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_modules`
--

LOCK TABLES `app_modules` WRITE;
/*!40000 ALTER TABLE `app_modules` DISABLE KEYS */;
INSERT INTO `app_modules` VALUES (1,'User Management','Active','Multi-type users with differnet roles on the selected modules. User friendly and easy to use.','admin,campus',1),(2,'Student Management','Active','A complete student management System. Personal Details, Academic Details, Guardian information, Dues and Payments.','student',2),(3,'Employee Management','Active','Employees management system. Employees personal details, academic details, Complete log of Current and Old employees Salaries','employee',3),(4,'Attendace','Active','Complete Attendance Register, very simple and easy to manage. For old attendance just navigate to through the calender date.','attendance',4),(5,'Classes & Fee','Active','Complete Fee details of every Student. Custom types of Fee can be created per class, Complete log of Fee with details.','classes,subject,timetable',5),(6,'Inventory Controle','Active','A generic system that can maintain the record of Inventory issued to students, such as Stationary or Uniforms.','inventory',6),(7,'Expenses','Active','Custom Type of expenses can be created. Complete log of expenses like, Building rent, employees salaries, Study trip etc.','expense',7),(8,'Profit Calculator','Active','Calculates the profit from the whole money transactions related to Student dues clearnce, School expenses.','profit',8),(9,'Reports','Active','Reports with configureable header and footer, with your custom logo and other format setting.','report',9),(10,'Free Custom Website','Active','You can create your free web site with in 5 mins. Latest and Responsive web templates, with free web hosting','website',10),(11,'Certificates','Active','Configurable Certificates, You can design certificates as per your requirements for employees and Students.','certificate',11),(12,'Notifications','Active','Notifications','notification',12);
/*!40000 ALTER TABLE `app_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_packages`
--

DROP TABLE IF EXISTS `app_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_packages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoice_due_period` int(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `duration_months` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_packages`
--

LOCK TABLES `app_packages` WRITE;
/*!40000 ALTER TABLE `app_packages` DISABLE KEYS */;
INSERT INTO `app_packages` VALUES (1,'Free','Free',10,'Active',6),(2,'Monthly','Monthly',5,'Active',1),(3,'Biannually','Biannually',10,'Active',6),(4,'Annually','Annually',15,'Active',12);
/*!40000 ALTER TABLE `app_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_packages_price`
--

DROP TABLE IF EXISTS `app_packages_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_packages_price` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country` varchar(5) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `app_package_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_packages_price_fk1` (`app_package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_packages_price`
--

LOCK TABLES `app_packages_price` WRITE;
/*!40000 ALTER TABLE `app_packages_price` DISABLE KEYS */;
INSERT INTO `app_packages_price` VALUES (1,'PK','PKR',0,1),(2,'PK','PKR',2000,2),(3,'PK','PKR',10000,3),(4,'PK','PKR',20000,4),(5,'Other','USD',0,1),(6,'Other','USD',20,2),(7,'Other','USD',100,3),(8,'Other','USD',200,4);
/*!40000 ALTER TABLE `app_packages_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `attendance` varchar(2) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` int(10) DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_date_student_attendance` (`date`,`student_id`) USING BTREE,
  KEY `fk_attendance_students_idx` (`student_id`),
  KEY `fk_attendance_employee` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,'2015-02-22','P',1,'2015-02-22 04:44:30',7,NULL),(2,'2015-02-22','L',1,'2015-02-22 04:44:30',8,NULL),(3,'2015-02-22','A',1,'2015-02-22 04:44:30',9,NULL),(4,'2015-02-22','P',1,'2015-02-22 04:44:30',10,NULL),(5,'2015-02-22','A',1,'2015-02-22 04:44:30',31,NULL),(6,'2015-02-17','P',1,'2015-02-24 05:30:17',7,NULL),(7,'2015-02-17','P',1,'2015-02-24 05:30:17',8,NULL),(8,'2015-02-17','P',1,'2015-02-24 05:30:17',9,NULL),(9,'2015-02-17','P',1,'2015-02-24 05:30:17',10,NULL),(10,'2015-02-17','P',1,'2015-02-24 05:30:17',31,NULL),(11,'2015-02-25','P',1,'2015-02-24 05:30:30',3,NULL),(12,'2015-02-25','P',1,'2015-02-24 05:30:30',5,NULL),(13,'2015-04-13','P',15,'2015-04-13 01:33:20',37,NULL),(14,'2015-05-10','P',50,'2015-05-10 17:17:12',271,NULL),(15,'2015-07-28','L',15,'2015-08-27 06:28:25',37,NULL),(16,'2015-09-02','L',49,'2015-09-02 13:19:39',270,NULL),(17,'2015-09-03','A',49,'2015-09-02 13:19:47',270,NULL),(18,'2015-09-04','P',49,'2015-09-02 13:19:55',270,NULL),(19,'2015-10-27','L',60,'2015-10-27 04:08:17',275,NULL),(20,'2015-10-29','A',60,'2015-10-28 22:36:34',275,NULL),(21,'2015-11-01','P',1,'2015-10-31 17:01:54',7,NULL),(22,'2015-11-01','P',1,'2015-10-31 17:01:54',8,NULL),(23,'2015-11-01','P',1,'2015-10-31 17:01:54',9,NULL),(24,'2015-11-01','P',1,'2015-10-31 17:01:54',10,NULL),(25,'2015-11-01','P',1,'2015-10-31 17:01:54',31,NULL),(31,'2015-11-01','P',1,'2015-10-31 17:10:09',NULL,22),(32,'2015-11-01','P',1,'2015-10-31 17:10:09',NULL,18),(33,'2015-11-01','P',1,'2015-10-31 17:10:09',NULL,21),(34,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,20),(35,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,19),(36,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,5),(37,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,3),(38,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,2),(39,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,28),(40,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,6),(41,'2015-10-22','L',1,'2015-11-16 12:20:28',7,NULL),(42,'2015-10-22','L',1,'2015-11-16 12:20:28',8,NULL),(43,'2015-10-22','P',1,'2015-11-16 12:20:28',9,NULL),(44,'2015-10-22','A',1,'2015-11-16 12:20:28',10,NULL),(45,'2015-10-22','L',1,'2015-11-16 12:20:28',31,NULL),(46,'2016-01-27','L',62,'2016-01-28 14:10:30',276,NULL),(47,'2016-04-26','0',65,'2016-04-25 16:33:08',-36,NULL),(48,'2016-04-27','0',65,'2016-04-25 16:33:43',-36,NULL);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus_modules`
--

DROP TABLE IF EXISTS `campus_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campus_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `campus_id` int(10) DEFAULT NULL,
  `module_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_campus_module_campus` (`campus_id`),
  KEY `FK_campus_module_module` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=594 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_modules`
--

LOCK TABLES `campus_modules` WRITE;
/*!40000 ALTER TABLE `campus_modules` DISABLE KEYS */;
INSERT INTO `campus_modules` VALUES (3,1,3),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,2,1),(12,2,2),(13,2,3),(14,2,4),(15,2,5),(16,2,6),(17,2,7),(18,2,8),(19,2,9),(20,2,10),(21,8,1),(22,8,2),(23,8,3),(24,8,4),(25,8,5),(26,8,6),(27,8,7),(28,8,8),(29,8,9),(30,8,10),(31,16,1),(32,16,2),(33,16,3),(34,16,4),(35,16,5),(36,16,6),(37,16,7),(38,16,8),(39,16,9),(40,16,10),(51,20,1),(52,20,2),(53,20,3),(54,20,4),(55,20,5),(56,20,6),(57,20,7),(58,20,8),(59,20,9),(60,20,10),(61,21,1),(62,21,2),(63,21,3),(64,21,4),(65,21,5),(66,21,6),(67,21,7),(68,21,8),(69,21,9),(70,21,10),(71,22,1),(72,22,2),(73,22,3),(74,22,4),(75,22,5),(76,22,6),(77,22,7),(78,22,8),(79,22,9),(80,22,10),(101,25,1),(102,25,2),(103,25,3),(104,25,4),(105,25,5),(106,25,6),(107,25,7),(108,25,8),(109,25,9),(110,25,10),(111,26,1),(112,26,2),(113,26,3),(114,26,4),(115,26,5),(116,26,6),(117,26,7),(118,26,8),(119,26,9),(120,26,10),(121,27,1),(122,27,2),(123,27,3),(124,27,4),(125,27,5),(126,27,6),(127,27,7),(128,27,8),(129,27,9),(130,27,10),(131,28,1),(132,28,2),(133,28,3),(134,28,4),(135,28,5),(136,28,6),(137,28,7),(138,28,8),(139,28,9),(140,28,10),(141,29,1),(142,29,2),(143,29,3),(144,29,4),(145,29,5),(146,29,6),(147,29,7),(148,29,8),(149,29,9),(150,29,10),(181,33,1),(182,33,2),(183,33,3),(184,33,4),(185,33,5),(186,33,6),(187,33,7),(188,33,8),(189,33,9),(190,33,10),(191,34,1),(192,34,2),(193,34,3),(194,34,4),(195,34,5),(196,34,6),(197,34,7),(198,34,8),(199,34,9),(200,34,10),(221,38,1),(222,38,2),(223,38,3),(224,38,4),(225,38,5),(226,38,6),(227,38,7),(228,38,8),(229,38,9),(230,38,10),(253,41,1),(254,41,2),(255,41,3),(256,41,4),(257,41,5),(258,41,6),(259,41,7),(260,41,8),(261,41,9),(263,1,1),(264,1,2),(265,1,4),(266,1,5),(267,42,1),(268,42,2),(269,42,3),(270,42,4),(271,42,5),(272,42,6),(273,42,7),(274,42,8),(275,42,9),(276,42,10),(277,43,1),(278,43,2),(279,43,3),(280,43,4),(281,43,5),(282,43,6),(283,43,7),(284,43,8),(285,43,9),(286,43,10),(287,44,1),(288,44,2),(289,44,3),(290,44,4),(291,44,5),(292,44,6),(293,44,7),(294,44,8),(295,44,9),(296,44,10),(297,45,1),(298,45,2),(299,45,3),(300,45,4),(301,45,5),(302,45,6),(303,45,7),(304,45,8),(305,45,9),(306,45,10),(307,46,1),(308,46,2),(309,46,3),(310,46,4),(311,46,5),(312,46,6),(313,46,7),(314,46,8),(315,46,9),(316,46,10),(317,47,1),(318,47,2),(319,47,3),(320,47,4),(321,47,5),(322,47,6),(323,47,7),(324,47,8),(325,47,9),(326,47,10),(337,49,1),(338,49,2),(339,49,3),(340,49,4),(341,49,5),(342,49,6),(343,49,7),(344,49,8),(345,49,9),(346,49,10),(347,41,10),(348,50,1),(349,50,2),(350,50,3),(351,50,4),(352,50,5),(353,50,6),(354,50,7),(355,50,8),(356,50,9),(357,50,10),(358,51,1),(359,51,2),(360,51,3),(361,51,4),(362,51,5),(363,51,6),(364,51,7),(365,51,8),(366,51,9),(367,51,10),(368,52,1),(369,52,2),(370,52,3),(371,52,4),(372,52,5),(373,52,6),(374,52,7),(375,52,8),(376,52,9),(377,52,10),(378,53,1),(379,53,2),(380,53,3),(381,53,4),(382,53,5),(383,53,6),(384,53,7),(385,53,8),(386,53,9),(387,53,10),(388,54,1),(389,54,2),(390,54,3),(391,54,4),(392,54,5),(393,54,6),(394,54,7),(395,54,8),(396,54,9),(397,54,10),(480,54,11),(479,53,11),(478,52,11),(477,51,11),(476,50,11),(475,49,11),(474,47,11),(473,46,11),(472,45,11),(471,44,11),(470,43,11),(469,42,11),(468,41,11),(467,38,11),(466,34,11),(465,33,11),(464,29,11),(463,28,11),(462,27,11),(461,26,11),(460,25,11),(459,22,11),(458,21,11),(457,20,11),(456,16,11),(455,8,11),(454,2,11),(453,1,11),(481,55,1),(482,55,2),(483,55,3),(484,55,4),(485,55,5),(486,55,6),(487,55,7),(488,55,8),(489,55,9),(490,55,10),(491,55,11),(492,56,1),(493,56,2),(494,56,3),(495,56,4),(496,56,5),(497,56,6),(498,56,7),(499,56,8),(500,56,9),(501,56,10),(502,56,11),(503,57,1),(504,57,2),(505,57,3),(506,57,4),(507,57,5),(508,57,6),(509,57,7),(510,57,8),(511,57,9),(512,57,10),(513,57,11),(514,1,12),(515,2,12),(516,8,12),(517,16,12),(518,20,12),(519,21,12),(520,22,12),(521,25,12),(522,26,12),(523,27,12),(524,28,12),(525,29,12),(526,33,12),(527,34,12),(528,38,12),(529,41,12),(530,42,12),(531,43,12),(532,44,12),(533,45,12),(534,46,12),(535,47,12),(536,49,12),(537,50,12),(538,51,12),(539,52,12),(540,53,12),(541,54,12),(542,55,12),(543,56,12),(544,57,12),(545,58,1),(546,58,2),(547,58,3),(548,58,4),(549,58,5),(550,58,6),(551,58,7),(552,58,8),(553,58,9),(554,58,10),(555,58,11),(556,58,12),(557,59,1),(558,59,2),(559,59,3),(560,59,4),(561,59,5),(562,59,6),(563,59,7),(564,59,8),(565,59,9),(566,59,10),(567,59,11),(568,59,12),(569,60,1),(570,60,2),(571,60,3),(572,60,4),(573,60,5),(574,60,6),(575,60,7),(576,60,8),(577,60,9),(578,60,10),(579,60,11),(580,60,12),(581,61,1),(582,61,2),(583,61,3),(584,61,4),(593,61,5),(586,61,6),(587,61,7),(588,61,8),(589,61,9),(590,61,10),(591,61,11),(592,61,12);
/*!40000 ALTER TABLE `campus_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus_packages`
--

DROP TABLE IF EXISTS `campus_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campus_packages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `campus_id` int(10) DEFAULT NULL,
  `package_id` int(10) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_campus_campus_package` (`campus_id`),
  KEY `FK_package_campus_package` (`package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_packages`
--

LOCK TABLES `campus_packages` WRITE;
/*!40000 ALTER TABLE `campus_packages` DISABLE KEYS */;
INSERT INTO `campus_packages` VALUES (1,1,1,'2014-10-04 12:49:33','2015-04-12 19:21:46','In Active','Inactivated by system, with the selection of package at : 2015-04-12 19:21:46',1),(2,1,2,'2015-04-12 00:00:00','2015-06-19 07:03:50','In Active','Inactivated by system, with the selection of package at : 2015-06-19 07:03:50',1),(3,1,3,'2015-06-19 00:00:00',NULL,'Active','done on request',1),(4,21,1,'2015-09-02 00:00:00',NULL,'Active','',1),(5,16,1,'2015-09-02 00:00:00',NULL,'Active','',1),(6,22,1,'2015-09-02 00:00:00',NULL,'Active','',1),(7,5,1,'2015-09-02 00:00:00',NULL,'Active','',1),(8,20,1,'2015-09-02 00:00:00',NULL,'Active','',1),(10,49,2,'2015-09-02 00:00:00','2015-09-02 15:27:42','In Active','Inactivated by system, with the selection of package at : 2015-09-02 15:27:42',1),(11,49,1,'2015-09-02 00:00:00','2015-09-02 15:36:28','In Active','Inactivated by system, with the selection of package at : 2015-09-02 15:36:28',1),(12,49,2,'2015-09-02 00:00:00',NULL,'Active','asdfasdf',1),(13,41,3,'2015-10-28 00:00:00',NULL,'Active','',1),(14,58,1,'2018-07-13 00:00:00',NULL,'Active','',1),(15,2,1,'2019-02-12 00:00:00',NULL,'Active','',1);
/*!40000 ALTER TABLE `campus_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campuses`
--

DROP TABLE IF EXISTS `campuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `campuses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `campus_name` varchar(100) DEFAULT NULL,
  `campus_logo` varchar(250) DEFAULT NULL,
  `school_id` int(10) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `contact_detail_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_campus_contact_detail` (`contact_detail_id`),
  KEY `FK_school_campus` (`school_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campuses`
--

LOCK TABLES `campuses` WRITE;
/*!40000 ALTER TABLE `campuses` DISABLE KEYS */;
INSERT INTO `campuses` VALUES (1,'Abbottabad Campus','https://asaanschool.com/uploads/users/OO/profile-pic.jpg',1,NULL,1),(2,'Mansehra Campus',NULL,1,NULL,4),(5,'s4',NULL,5,NULL,5),(8,'The Quest Public School',NULL,5,NULL,21),(16,'aligarh model public school ',NULL,13,NULL,29),(20,'The Quest Public School',NULL,17,NULL,33),(21,'Al Rahber School Meelum','https://asaanschool.com/uploads/campuses/OH/campus-logo.jpg',18,NULL,34),(22,'Hazara Public School',NULL,19,NULL,35),(25,'GHSS Jamrud',NULL,22,NULL,39),(26,'Testing',NULL,23,NULL,40),(27,'Qasim Hall',NULL,24,NULL,41),(28,'Vision Islamic Public school ',NULL,25,NULL,42),(29,'Local Education Board',NULL,26,NULL,43),(33,'The TIME School and College Oghi',NULL,28,NULL,47),(34,'Edu Edge',NULL,29,NULL,50),(38,'The  Atcoms Oghi',NULL,33,NULL,62),(41,'Asaan School  School',NULL,36,NULL,68),(42,'Merill ABD',NULL,37,NULL,70),(43,'Haripur Ali Akbar High School',NULL,38,NULL,72),(44,'Western link Education',NULL,39,NULL,74),(45,'FG high school',NULL,40,NULL,84),(46,'Nazia',NULL,41,NULL,86),(47,'Micro Education System',NULL,42,NULL,88),(49,'test',NULL,44,NULL,92),(50,'ICOPS',NULL,45,NULL,94),(51,'Jinnah Muslim College',NULL,46,NULL,96),(52,'Westernlink MTS',NULL,47,NULL,98),(54,'testschool123',NULL,49,NULL,103),(55,'ABNZ',NULL,50,NULL,105),(56,'western-link',NULL,51,NULL,107),(57,'FitnyTech',NULL,52,NULL,109),(58,'The Leader School','https://asaanschool.com/uploads/campuses/vf/campus-logo.jpg',53,NULL,111),(59,'Test E karobar',NULL,54,NULL,113),(60,'test23',NULL,55,NULL,115),(61,'school24',NULL,56,NULL,117);
/*!40000 ALTER TABLE `campuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `page_size` varchar(20) DEFAULT NULL,
  `margins` varchar(20) DEFAULT NULL,
  `linked_with` int(5) DEFAULT NULL COMMENT '1=student, 2=employee',
  `contents` text DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  `background_image` varchar(250) DEFAULT NULL,
  `watermark` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
INSERT INTO `certificates` VALUES (3,'Ali','school leaving certificate',NULL,NULL,0,'<p>It is certified that Mr. Ali has passed 8th class successfully. We wish hhim best in his future.</p>\n\n<p>&nbsp;</p>\n\n<p>truly,</p>\n\n<p>&nbsp;</p>\n\n<p><em><strong>Mumtaz</strong></em></p>\n',21,'https://asaanschool.com/uploads/campuses/sh/certificates/certificate-background.jpg',NULL);
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_fee`
--

DROP TABLE IF EXISTS `class_fee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_fee` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `fee_type_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_fee_type_1` (`fee_type_id`),
  KEY `FK_class_1` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=483 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_fee`
--

LOCK TABLES `class_fee` WRITE;
/*!40000 ALTER TABLE `class_fee` DISABLE KEYS */;
INSERT INTO `class_fee` VALUES (1,1500,1,1),(2,2000,2,1),(3,2200,3,1),(6,2500,4,1),(7,2800,5,1),(8,3000,6,1),(9,3200,7,1),(10,3500,8,1),(13,2000,1,3),(14,1200,10,4),(15,1500,11,4),(16,2000,12,4),(18,2500,15,7),(19,10000,15,8),(20,2000,21,32),(21,1500,21,31),(27,1500,33,57),(28,1000,34,57),(29,1200,35,57),(30,1200,36,57),(31,1300,37,57),(32,1300,38,57),(33,1400,39,57),(34,1400,40,57),(35,1600,41,57),(36,1600,42,57),(37,350,43,47),(38,350,44,47),(39,500,43,48),(40,500,50,60),(41,800,51,60),(42,1000,52,60),(43,1200,53,60),(44,1400,54,60),(45,1600,55,60),(46,1800,56,60),(47,2000,57,60),(48,2200,58,60),(49,2400,59,60),(66,1000,71,84),(67,1000,72,84),(68,1000,73,84),(69,1000,74,84),(70,1000,75,84),(71,1000,71,85),(72,1000,72,85),(73,1000,73,85),(74,1000,74,85),(75,1000,75,85),(76,1000,71,86),(77,1000,72,86),(78,1000,73,86),(79,1000,74,86),(80,1000,75,86),(81,1000,76,87),(82,1000,77,87),(83,1000,78,87),(84,1000,79,87),(85,1000,80,87),(86,1000,76,88),(87,1000,77,88),(88,1000,78,88),(89,1000,79,88),(90,1000,80,88),(91,1000,76,89),(92,1000,77,89),(93,1000,78,89),(94,1000,79,89),(95,1000,80,89),(111,100,1,93),(127,1000,91,97),(128,1000,92,97),(129,1000,93,97),(130,1000,94,97),(131,1000,95,97),(132,1000,91,98),(133,1000,92,98),(134,1000,93,98),(135,1000,94,98),(136,1000,95,98),(137,1000,91,99),(138,1000,92,99),(139,1000,93,99),(140,1000,94,99),(141,1000,95,99),(172,1000,106,106),(173,5000,107,106),(174,50000,108,106),(175,1000,109,106),(176,1000,110,106),(177,1000,106,107),(178,1000,107,107),(179,8000,108,107),(180,1000,109,107),(181,1000,110,107),(182,1000,106,108),(183,1000,107,108),(184,1000,108,108),(185,1000,109,108),(186,1000,110,108),(187,200,106,109),(189,1000,112,110),(190,1000,113,110),(191,1000,114,110),(192,1000,115,110),(193,1000,116,110),(194,1000,112,111),(195,1000,113,111),(196,1000,114,111),(197,1000,115,111),(198,1000,116,111),(199,1000,112,112),(200,1000,113,112),(201,1000,114,112),(202,1000,115,112),(203,1000,116,112),(204,500,117,113),(205,500,118,113),(206,1000,119,113),(207,1000,120,113),(208,500,121,113),(209,60,117,114),(210,80,118,114),(211,1000,119,114),(212,1000,120,114),(213,1000,121,114),(214,225,117,115),(215,250,118,115),(216,1000,119,115),(217,1000,120,115),(218,1000,121,115),(219,350,122,116),(220,350,123,116),(221,350,124,116),(222,350,125,116),(223,350,126,116),(224,1000,122,117),(225,1000,123,117),(226,1000,124,117),(227,1000,125,117),(228,1000,126,117),(229,1000,122,118),(230,1000,123,118),(231,1000,124,118),(232,1000,125,118),(233,1000,126,118),(234,1000,127,119),(235,1000,128,119),(236,1000,129,119),(237,1000,130,119),(238,1000,131,119),(239,1000,127,120),(240,1000,128,120),(241,1000,129,120),(242,1000,130,120),(243,1000,131,120),(244,1000,127,121),(245,1000,128,121),(246,1000,129,121),(247,1000,130,121),(248,1000,131,121),(249,1000,132,122),(250,1000,133,122),(251,1000,134,122),(252,1000,135,122),(253,1000,136,122),(254,1000,132,123),(255,1000,133,123),(256,1000,134,123),(257,1000,135,123),(258,1000,136,123),(259,1000,132,124),(260,1000,133,124),(261,1000,134,124),(262,1000,135,124),(263,1000,136,124),(264,1000,137,125),(265,1000,138,125),(266,1000,139,125),(267,1000,140,125),(268,1000,141,125),(269,1000,137,126),(270,1000,138,126),(271,1000,139,126),(272,1000,140,126),(273,1000,141,126),(274,1000,137,127),(275,1000,138,127),(276,1000,139,127),(277,1000,140,127),(278,1000,141,127),(294,1000,147,131),(295,1000,148,131),(296,1000,149,131),(297,1000,150,131),(298,1000,151,131),(299,1000,147,132),(300,1000,148,132),(301,1000,149,132),(302,1000,150,132),(303,1000,151,132),(304,1000,147,133),(305,1000,148,133),(306,1000,149,133),(307,1000,150,133),(308,1000,151,133),(309,1000,152,135),(310,1000,153,135),(311,1000,154,135),(312,1000,155,135),(313,1000,156,135),(314,1000,152,136),(315,1000,153,136),(316,1000,154,136),(317,1000,155,136),(318,1000,156,136),(319,1000,152,137),(320,1000,153,137),(321,1000,154,137),(322,1000,155,137),(323,1000,156,137),(324,3000,152,138),(325,1000,157,139),(326,1000,158,139),(327,1000,159,139),(328,1000,160,139),(329,1000,161,139),(330,1000,157,140),(331,1000,158,140),(332,1000,159,140),(333,1000,160,140),(334,1000,161,140),(335,1000,157,141),(336,1000,158,141),(337,1000,159,141),(338,1000,160,141),(339,1000,161,141),(340,0,162,142),(341,0,163,142),(342,0,164,142),(343,0,165,142),(344,0,166,142),(345,350,162,143),(346,350,163,143),(347,350,164,143),(348,4,165,143),(349,350,166,143),(350,4,162,144),(351,4,163,144),(352,4,164,144),(353,4,165,144),(354,4,166,144),(357,1000,167,146),(358,1000,168,146),(359,1000,169,146),(360,1000,170,146),(361,1000,171,146),(362,1000,167,147),(363,1000,168,147),(364,1000,169,147),(365,1000,170,147),(366,1000,171,147),(367,1000,167,148),(368,1000,168,148),(369,1000,169,148),(370,1000,170,148),(371,1000,171,148),(372,2000,33,58),(373,500,33,149),(374,1000,33,150),(375,1000,176,153),(376,1000,175,153),(377,1000,174,153),(378,1000,177,153),(379,1000,178,153),(380,1000,176,154),(381,1000,175,154),(382,1000,174,154),(383,1000,177,154),(384,1000,178,154),(385,1000,176,155),(386,1000,175,155),(387,1000,174,155),(388,1000,177,155),(389,1000,178,155),(390,1000,179,156),(391,1000,180,156),(392,1000,181,156),(393,1000,182,156),(394,1000,183,156),(395,1000,179,157),(396,1000,180,157),(397,1000,181,157),(398,1000,182,157),(399,1000,183,157),(400,1000,179,158),(401,1000,180,158),(402,1000,181,158),(403,1000,182,158),(404,1000,183,158),(405,1000,184,159),(406,1000,185,159),(407,1000,186,159),(408,1000,187,159),(409,1000,188,159),(410,1000,184,160),(411,1000,185,160),(412,1000,186,160),(413,1000,187,160),(414,1000,188,160),(415,1000,184,161),(416,1000,185,161),(417,1000,186,161),(418,1000,187,161),(419,1000,188,161),(420,1200,184,161),(421,100000,184,161),(422,1000,189,162),(423,1000,190,162),(424,1000,191,162),(425,1000,192,162),(426,1000,193,162),(427,1000,189,163),(428,1000,190,163),(429,1000,191,163),(430,1000,192,163),(431,1000,193,163),(432,1000,189,164),(433,1000,190,164),(434,1000,191,164),(435,1000,192,164),(436,1000,193,164),(437,1000,195,165),(438,1000,195,166),(439,1000,195,167),(440,1000,196,165),(441,1000,196,166),(442,1000,196,167),(443,1000,197,165),(444,1000,197,166),(445,1000,197,167),(446,1000,198,165),(447,1000,198,166),(448,1000,198,167),(449,1000,199,165),(450,1000,199,166),(451,1000,199,167),(452,700,200,166),(453,500,200,165),(454,500,201,165),(455,700,201,166),(456,500,202,165),(457,700,202,166),(458,1000,203,165),(459,1100,203,166),(460,1000,204,165),(461,1100,204,166),(462,1000,205,169),(463,1000,205,170),(464,1000,205,171),(465,1000,206,169),(466,1000,206,170),(467,1000,206,171),(468,1000,207,169),(469,1000,207,170),(470,1000,207,171),(471,1000,208,169),(472,1000,208,170),(473,1000,208,171),(474,1000,209,169),(475,1000,209,170),(476,1000,209,171),(477,1000,210,172),(478,1000,211,172),(479,1000,212,172),(480,800,210,173),(481,800,211,173),(482,800,212,173);
/*!40000 ALTER TABLE `class_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_class_campus` (`campus_id`),
  KEY `UK_class_campus` (`name`,`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (45,'1st',16),(46,'2nd',16),(47,'3rd',16),(48,'4th',16),(49,'5th',16),(40,'6th',21),(41,'7th',21),(42,'8th',21),(17,'c1',5),(15,'C2',5),(59,'Class 10th',22),(21,'Class 1st',8),(50,'Class 1st',22),(22,'Class 2nd',8),(51,'Class 2nd',22),(23,'Class 3rd',8),(52,'Class 3rd',22),(24,'Class 4th',8),(53,'Class 4th',22),(25,'Class 5th',8),(54,'Class 5th',22),(26,'Class 6th',8),(55,'Class 6th',22),(27,'Class 7th',8),(56,'Class 7th',22),(57,'Class 8th',22),(58,'Class 9th',22),(1,'Class-1',1),(71,'Class-1',33),(76,'Class-1',34),(91,'Class-1',38),(106,'Class-1',41),(112,'Class-1',42),(127,'Class-1',45),(132,'Class-1',46),(137,'Class-1',47),(147,'Class-1',49),(157,'Class-1',51),(121,'Class-10',43),(2,'Class-2',1),(72,'Class-2',33),(77,'Class-2',34),(92,'Class-2',38),(107,'Class-2',41),(113,'Class-2',42),(128,'Class-2',45),(133,'Class-2',46),(138,'Class-2',47),(148,'Class-2',49),(153,'Class-2',50),(158,'Class-2',51),(3,'Class-3',1),(73,'Class-3',33),(78,'Class-3',34),(93,'Class-3',38),(108,'Class-3',41),(114,'Class-3',42),(129,'Class-3',45),(134,'Class-3',46),(139,'Class-3',47),(149,'Class-3',49),(154,'Class-3',50),(159,'Class-3',51),(4,'Class-4',1),(74,'Class-4',33),(79,'Class-4',34),(94,'Class-4',38),(109,'Class-4',41),(115,'Class-4',42),(130,'Class-4',45),(135,'Class-4',46),(140,'Class-4',47),(150,'Class-4',49),(155,'Class-4',50),(160,'Class-4',51),(5,'Class-5',1),(75,'Class-5',33),(80,'Class-5',34),(95,'Class-5',38),(110,'Class-5',41),(116,'Class-5',42),(131,'Class-5',45),(136,'Class-5',46),(141,'Class-5',47),(151,'Class-5',49),(156,'Class-5',50),(161,'Class-5',51),(6,'Class-6',1),(117,'Class-6',43),(7,'Class-7',1),(118,'Class-7',43),(8,'Class-8',1),(119,'Class-8',43),(9,'class-9',1),(120,'Class-9',43),(10,'class1',2),(11,'class2',2),(12,'class3',2),(122,'CRECHE',44),(39,'Fifth',21),(38,'Fourth',21),(125,'KG-1',44),(126,'KG-2',44),(123,'LO.NU',44),(152,'my-Class-1',50),(19,'Nursery',8),(43,'Nursery',16),(33,'Nursery',21),(35,'One',21),(18,'Play Group',8),(20,'Prep',8),(44,'Prep',16),(34,'Prep',21),(37,'Third',21),(36,'Two',21),(124,'UP.NU',44),(162,'LO.NU',52),(163,'UP.NU',52),(164,'KG-1',52),(165,'KG-2',52),(166,'KG-3',52),(176,'Class-3',54),(175,'Class-2',54),(174,'Class-1',54),(173,'10th ',21),(172,'9th',21),(177,'Class-4',54),(178,'Class-5',54),(179,'Class-1',55),(180,'Class-2',55),(181,'Class-3',55),(182,'Class-4',55),(183,'Class-5',55),(184,'Class-1',56),(185,'Class-2',56),(186,'Class-3',56),(187,'Class-4',56),(188,'Class-5',56),(189,'Class-1',57),(190,'Class-2',57),(191,'Class-3',57),(192,'Class-4',57),(193,'Class-5',57),(194,'test',41),(195,'Class-1',58),(196,'Class-2',58),(197,'Class-3',58),(198,'Class-4',58),(199,'Class-5',58),(200,'Play Group',58),(201,'Nursary',58),(202,'Prep',58),(203,'Class-6',58),(204,'Class-7',58),(205,'Class-1',60),(206,'Class-2',60),(207,'Class-3',60),(208,'Class-4',60),(209,'Class-5',60),(210,'Class 1',61),(211,'Class 2',61),(212,'Class 3',61);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configurations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(200) DEFAULT NULL,
  `key` varchar(100) NOT NULL DEFAULT '',
  `value` varchar(200) DEFAULT NULL,
  `can_delete` varchar(1) DEFAULT NULL COMMENT '[Yes-Y],\r\n[No-N]',
  `scope` varchar(1) DEFAULT NULL COMMENT 'Application-A\r\nSession-S\r\nRequest-R\r\n',
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uni_key_conf` (`key`),
  KEY `FK_configuration_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` VALUES (1,'Admission Fee Alert Date','admission.fee.due.date','25-02','N','R',NULL),(2,'Tution Fee Alert Date','tution.fee.due.date','22','N','R',NULL);
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_details`
--

DROP TABLE IF EXISTS `contact_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `primary_phone` varchar(100) DEFAULT NULL,
  `secondary_phone` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `primary_email` varchar(100) DEFAULT NULL,
  `secondary_email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_details`
--

LOCK TABLES `contact_details` WRITE;
/*!40000 ALTER TABLE `contact_details` DISABLE KEYS */;
INSERT INTO `contact_details` VALUES (1,'12345622222','12345625233333','123456555555','Abbottabad','KPK','Pakistan','123456','Abbottabad','alifida86@gmail.com','',''),(2,'12345625233333','12345625233333','12345625233333','Islamabad','Fedhral','Pakistan','123456','Islamabad','admin@asaanschool.com',NULL,NULL),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'silverlean@gmail.com',NULL,NULL),(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'s3@gmail.com',NULL,NULL),(5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'s4@gmail.com',NULL,NULL),(6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bbb@bbb.com',NULL,NULL),(7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bbbbb@bb.com',NULL,NULL),(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qqq@qqq.vcom',NULL,NULL),(9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qqq@qqq.vcom',NULL,NULL),(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aaa@sss.hyy',NULL,NULL),(11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aaa@sss.hyy',NULL,NULL),(12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'asdf@asdf.com',NULL,NULL),(13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dfasdf@asdf.com',NULL,NULL),(14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'asdf@asdf.com',NULL,NULL),(15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dfasdf@asdf.com',NULL,NULL),(16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'asdf@asdf.com',NULL,NULL),(17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ntew@email.com',NULL,NULL),(18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aaaa@aaa.com',NULL,NULL),(19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bashir.khan@ufone.blackberry.com',NULL,NULL),(20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bashir.khan@ufone.com.pk',NULL,NULL),(21,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bashir.khan@ufone.blackberrry.com',NULL,NULL),(22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali@ali.com',NULL,NULL),(24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ii@ii.com',NULL,NULL),(25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'oo@oo.oo',NULL,NULL),(26,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali@ali.comm',NULL,NULL),(27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'trail@trail.trail',NULL,NULL),(28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'tt@tt.com',NULL,NULL),(29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zahidkhan958@gmail.com',NULL,NULL),(30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'abc@gmail.com',NULL,NULL),(31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'oghi@oghi.com',NULL,NULL),(32,'03332366360','','','Abbottabad','Pakistan',NULL,'7500','Jamia Masjid Bilal town, AbbottABAD','bashir.khan@ufone.blackberry.com','',''),(33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alamgirkha@gmail.com',NULL,NULL),(34,'0995351255','','','Haripur','KPK',NULL,'22620','KPK','alrahberschool14@gmail.com','','www.alrehberschool.com'),(35,'03345708175','','','Mansehra','KPK',NULL,'21300','Mansehra','rabi.pts@gmail.com','',''),(36,'09923332366360','','','Abbottabad','Pakistan',NULL,'35410','Kakoul Road Abbottabad',NULL,'',''),(37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'amjadkarym@gmail.com',NULL,NULL),(38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(39,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'gshah188@yahoo.com',NULL,NULL),(40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'visiosoft@yahoo.com',NULL,NULL),(41,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jawad.ali84@hotmail.com',NULL,NULL),(42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'vision@yahoo.com',NULL,NULL),(43,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'salmanrozik@gmail.com',NULL,NULL),(44,'777777788888','','','88888','88888',NULL,'8880','888888888888888888','hgfhgfh@fngkfd.bbbfg','',''),(45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida@ali.com',NULL,NULL),(46,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida@ali2.com',NULL,NULL),(47,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'iqbalalvi741@gmail.com',NULL,NULL),(48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali@ali33.com',NULL,NULL),(49,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'info@asaanschool.com',NULL,NULL),(50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bilalbahadar@gmail.com',NULL,NULL),(51,'+92-345-9485678','+92-345-9635275','','Oghi','KPK',NULL,'21400','Takia Chowk Tariq Road Oghi',NULL,'',''),(58,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'info@asaanschool.com',NULL,NULL),(59,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'info@asaanschool.com',NULL,NULL),(60,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@asaanschool.com',NULL,NULL),(61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@asaanschool.com',NULL,NULL),(62,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jahanatcoms@gmail.com',NULL,NULL),(63,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jahanatcoms@gmail.com',NULL,NULL),(64,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@asaanschool.com',NULL,NULL),(65,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@asaanschool.com',NULL,NULL),(66,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@asaanschool.com',NULL,NULL),(67,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@asaanschool.com',NULL,NULL),(68,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@asaanschool.com',NULL,NULL),(69,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@asaanschool.com',NULL,NULL),(70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'merill@hk.net',NULL,NULL),(71,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'merill@hk.net',NULL,NULL),(72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aahighschool@gmail.com',NULL,NULL),(73,'01712202145','01815456072','','Feni','Bangladesh',NULL,'39133913','Purba Shilua, Chhagalnaiya, Feni','aahighschool@gmail.com','','haahs.comillaboard.gov.bd'),(74,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'westernlinkedu@gmail.com',NULL,NULL),(75,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'westernlinkedu@gmail.com',NULL,NULL),(76,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(77,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(78,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(79,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(80,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(81,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(82,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(83,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(84,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'naziamalik1992@gmail.com',NULL,NULL),(85,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'naziamalik1992@gmail.com',NULL,NULL),(86,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nazia_malik900@yahoo.com',NULL,NULL),(87,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nazia_malik900@yahoo.com',NULL,NULL),(88,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'microesys@gmail.com',NULL,NULL),(89,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'microesys@gmail.com',NULL,NULL),(90,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(91,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(92,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(93,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(94,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ismat.kakakhel@gmail.com',NULL,NULL),(95,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ismat.kakakhel@gmail.com',NULL,NULL),(96,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mnawazakhtar@gmail.com',NULL,NULL),(97,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mnawazakhtar@gmail.com',NULL,NULL),(98,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mark_mulier@hotmail.com',NULL,NULL),(99,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mark_mulier@hotmail.com',NULL,NULL),(100,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alrahberschool14@gmail.com',NULL,NULL),(101,'03155686341','','','Haripur','kpk',NULL,'24620','Dhindha Haripur','alrahberschool14@gmail.com','',''),(102,'092995351255','','','Meelum Haripur','Pakistan',NULL,'24620','Meelum',NULL,'',''),(103,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jarshed@gmail.com',NULL,NULL),(104,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jarshed@gmail.com',NULL,NULL),(105,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'a0291847365b@gmail.com',NULL,NULL),(106,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'a0291847365b@gmail.com',NULL,NULL),(107,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'teraelectronics@gmail.com',NULL,NULL),(108,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'teraelectronics@gmail.com',NULL,NULL),(109,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ramandeep2390@gmail.com',NULL,NULL),(110,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ramandeep2390@gmail.com',NULL,NULL),(111,'0995320532','923215217733','','Allooli','Haripur',NULL,'42620','New Gol Masjid, Gorraki Mera, Alooli','libra.waheed@gmail.com','libra.waheed@gmail.com',''),(112,'0995320532','923215217733','','Allooli','KPK',NULL,'46000','Haripur KPK','theleadersschoolharipur@gmail.com','',''),(113,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'al.ifida86@gmail.com',NULL,NULL),(114,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'al.ifida86@gmail.com',NULL,NULL),(115,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida86@gmail.com',NULL,NULL),(116,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida86@gmail.com',NULL,NULL),(117,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'admin@school24.com',NULL,NULL),(118,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'admin@school24.com',NULL,NULL);
/*!40000 ALTER TABLE `contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countires_ip`
--

DROP TABLE IF EXISTS `countires_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countires_ip` (
  `start_ip` char(15) NOT NULL,
  `end_ip` char(15) NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `cc` char(2) NOT NULL,
  `cn` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countires_ip`
--

LOCK TABLES `countires_ip` WRITE;
/*!40000 ALTER TABLE `countires_ip` DISABLE KEYS */;
INSERT INTO `countires_ip` VALUES ('5.189.202.0','5.189.202.127',96324096,96324223,'PK','Pakistan'),('14.192.128.0','14.192.159.255',247496704,247504895,'PK','Pakistan'),('27.54.120.0','27.54.123.255',456554496,456555519,'PK','Pakistan'),('27.96.92.0','27.96.95.255',459299840,459300863,'PK','Pakistan'),('27.255.0.0','27.255.63.255',469696512,469712895,'PK','Pakistan'),('31.220.30.32','31.220.30.63',534519328,534519359,'PK','Pakistan'),('31.220.30.96','31.220.30.127',534519392,534519423,'PK','Pakistan'),('39.32.0.0','39.63.255.255',656408576,658505727,'PK','Pakistan'),('42.83.84.0','42.83.87.255',710104064,710105087,'PK','Pakistan'),('42.201.128.0','42.201.255.255',717848576,717881343,'PK','Pakistan'),('43.224.236.0','43.224.239.255',736160768,736161791,'PK','Pakistan'),('43.225.96.0','43.225.99.255',736190464,736191487,'PK','Pakistan'),('43.228.156.128','43.228.156.255',736402560,736402687,'PK','Pakistan'),('43.228.159.128','43.228.159.255',736403328,736403455,'PK','Pakistan'),('43.230.92.0','43.230.95.255',736517120,736518143,'PK','Pakistan'),('43.231.60.0','43.231.63.255',736574464,736575487,'PK','Pakistan'),('43.242.100.0','43.242.103.255',737305600,737306623,'PK','Pakistan'),('43.242.176.0','43.242.179.255',737325056,737326079,'PK','Pakistan'),('43.245.8.0','43.245.11.255',737478656,737479679,'PK','Pakistan'),('43.245.128.0','43.245.131.255',737509376,737510399,'PK','Pakistan'),('43.245.204.0','43.245.207.255',737528832,737529855,'PK','Pakistan'),('43.246.220.0','43.246.227.255',737598464,737600511,'PK','Pakistan'),('43.247.120.0','43.247.123.255',737638400,737639423,'PK','Pakistan'),('43.248.12.0','43.248.15.255',737676288,737677311,'PK','Pakistan'),('43.250.84.0','43.250.87.255',737825792,737826815,'PK','Pakistan'),('43.254.12.0','43.254.15.255',738069504,738070527,'PK','Pakistan'),('45.62.40.0','45.62.40.255',759048192,759048447,'PK','Pakistan'),('45.62.53.0','45.62.53.255',759051520,759051775,'PK','Pakistan'),('45.62.62.0','45.62.62.255',759053824,759054079,'PK','Pakistan'),('45.64.24.0','45.64.27.255',759175168,759176191,'PK','Pakistan'),('45.64.180.0','45.64.183.255',759215104,759216127,'PK','Pakistan'),('45.113.124.0','45.113.127.255',762412032,762413055,'PK','Pakistan'),('45.114.120.0','45.114.127.255',762476544,762478591,'PK','Pakistan'),('45.114.132.0','45.114.135.255',762479616,762480639,'PK','Pakistan'),('45.115.49.0','45.115.49.255',762523904,762524159,'PK','Pakistan'),('45.115.84.0','45.115.87.255',762532864,762533887,'PK','Pakistan'),('45.116.232.0','45.116.235.255',762636288,762637311,'PK','Pakistan'),('45.117.88.0','45.117.91.255',762664960,762665983,'PK','Pakistan'),('45.117.104.0','45.117.107.255',762669056,762670079,'PK','Pakistan'),('46.36.202.56','46.36.202.56',774163000,774163000,'PK','Pakistan'),('57.92.240.0','57.92.255.255',962392064,962396159,'PK','Pakistan'),('58.27.128.0','58.27.255.255',974880768,974913535,'PK','Pakistan'),('58.65.128.0','58.65.223.255',977371136,977395711,'PK','Pakistan'),('58.84.28.0','58.84.31.255',978590720,978591743,'PK','Pakistan'),('58.181.96.0','58.181.127.255',984965120,984973311,'PK','Pakistan'),('59.103.0.0','59.103.255.255',996605952,996671487,'PK','Pakistan'),('61.5.128.0','61.5.159.255',1023770624,1023778815,'PK','Pakistan'),('63.70.24.0','63.70.27.255',1061558272,1061559295,'PK','Pakistan'),('63.114.37.0','63.114.37.255',1064445184,1064445439,'PK','Pakistan'),('64.86.121.0','64.86.122.255',1079408896,1079409407,'PK','Pakistan'),('64.86.131.0','64.86.131.255',1079411456,1079411711,'PK','Pakistan'),('65.175.69.0','65.175.69.255',1102005504,1102005759,'PK','Pakistan'),('65.175.76.0','65.175.76.255',1102007296,1102007551,'PK','Pakistan'),('65.175.89.0','65.175.89.255',1102010624,1102010879,'PK','Pakistan'),('80.77.8.0','80.77.11.255',1347225600,1347226623,'PK','Pakistan'),('80.78.17.184','80.78.17.184',1347293624,1347293624,'PK','Pakistan'),('101.50.64.0','101.50.127.255',1697792000,1697808383,'PK','Pakistan'),('103.4.92.0','103.4.95.255',1728338944,1728339967,'PK','Pakistan'),('103.5.136.0','103.5.139.255',1728415744,1728416767,'PK','Pakistan'),('103.7.60.0','103.7.63.255',1728527360,1728528383,'PK','Pakistan'),('103.7.76.0','103.7.79.255',1728531456,1728532479,'PK','Pakistan'),('103.8.14.0','103.8.15.255',1728581120,1728581631,'PK','Pakistan'),('103.8.112.0','103.8.115.255',1728606208,1728607231,'PK','Pakistan'),('103.8.214.0','103.8.214.255',1728632320,1728632575,'PK','Pakistan'),('103.8.231.0','103.8.231.255',1728636672,1728636927,'PK','Pakistan'),('103.9.23.0','103.9.23.255',1728648960,1728649215,'PK','Pakistan'),('103.9.182.0','103.9.182.255',1728689664,1728689919,'PK','Pakistan'),('103.11.60.0','103.11.63.255',1728789504,1728790527,'PK','Pakistan'),('103.11.68.0','103.11.71.255',1728791552,1728792575,'PK','Pakistan'),('103.12.40.0','103.12.43.255',1728849920,1728850943,'PK','Pakistan'),('103.12.58.0','103.12.58.255',1728854528,1728854783,'PK','Pakistan'),('103.12.120.0','103.12.123.255',1728870400,1728871423,'PK','Pakistan'),('103.13.1.0','103.13.1.255',1728905472,1728905727,'PK','Pakistan'),('103.14.231.0','103.14.231.255',1729029888,1729030143,'PK','Pakistan'),('103.17.200.0','103.17.203.255',1729218560,1729219583,'PK','Pakistan'),('103.18.8.0','103.18.15.255',1729234944,1729236991,'PK','Pakistan'),('103.18.20.0','103.18.23.255',1729238016,1729239039,'PK','Pakistan'),('103.18.116.0','103.18.116.255',1729262592,1729262847,'PK','Pakistan'),('103.18.243.0','103.18.243.255',1729295104,1729295359,'PK','Pakistan'),('103.20.0.0','103.20.3.255',1729363968,1729364991,'PK','Pakistan'),('103.20.132.0','103.20.135.255',1729397760,1729398783,'PK','Pakistan'),('103.24.96.0','103.24.99.255',1729650688,1729651711,'PK','Pakistan'),('103.25.136.0','103.25.139.255',1729726464,1729727487,'PK','Pakistan'),('103.26.80.0','103.26.87.255',1729777664,1729779711,'PK','Pakistan'),('103.26.184.0','103.26.187.255',1729804288,1729805311,'PK','Pakistan'),('103.27.20.0','103.27.23.255',1729827840,1729828863,'PK','Pakistan'),('103.28.150.0','103.28.155.255',1729926656,1729928191,'PK','Pakistan'),('103.29.163.0','103.29.163.255',1729995520,1729995775,'PK','Pakistan'),('103.31.80.0','103.31.83.255',1730105344,1730106367,'PK','Pakistan'),('103.31.92.0','103.31.95.255',1730108416,1730109439,'PK','Pakistan'),('103.31.100.0','103.31.107.255',1730110464,1730112511,'PK','Pakistan'),('103.35.208.0','103.35.215.255',1730400256,1730402303,'PK','Pakistan'),('103.39.80.0','103.39.83.255',1730629632,1730630655,'PK','Pakistan'),('103.44.223.0','103.44.223.255',1730993920,1730994175,'PK','Pakistan'),('103.48.24.0','103.48.25.255',1731205120,1731205631,'PK','Pakistan'),('103.49.69.0','103.49.69.255',1731282176,1731282431,'PK','Pakistan'),('103.49.136.0','103.49.139.255',1731299328,1731300351,'PK','Pakistan'),('103.50.156.0','103.50.159.255',1731369984,1731371007,'PK','Pakistan'),('103.51.220.0','103.51.220.255',1731451904,1731452159,'PK','Pakistan'),('103.53.44.0','103.53.47.255',1731537920,1731538943,'PK','Pakistan');
/*!40000 ALTER TABLE `countires_ip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_attachments`
--

DROP TABLE IF EXISTS `email_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_attachments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email_id` int(10) DEFAULT NULL,
  `attachment_path` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_email_attachments_1_idx` (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_attachments`
--

LOCK TABLES `email_attachments` WRITE;
/*!40000 ALTER TABLE `email_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_types`
--

DROP TABLE IF EXISTS `email_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_types`
--

LOCK TABLES `email_types` WRITE;
/*!40000 ALTER TABLE `email_types` DISABLE KEYS */;
INSERT INTO `email_types` VALUES (1,'Inbox'),(2,'Sent'),(3,'Draft'),(4,'Notification');
/*!40000 ALTER TABLE `email_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_users`
--

DROP TABLE IF EXISTS `email_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email_id` int(10) DEFAULT NULL,
  `email_type_id` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT '' COMMENT 'Unread,Trash, Important',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reference_email_user_id` int(10) DEFAULT NULL COMMENT '	',
  `delivery_status` int(2) DEFAULT NULL,
  `user_from_id` int(10) DEFAULT NULL,
  `user_to_id` int(10) DEFAULT NULL,
  `owner_user` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_email_email_type_idx` (`email_type_id`),
  KEY `fk_email_email_id` (`email_id`),
  KEY `fk_email_user_from` (`user_from_id`),
  KEY `fk_email_user_to_idx` (`user_to_id`),
  KEY `fk_reference_email_user_id` (`reference_email_user_id`),
  KEY `fk_owner_user_user` (`owner_user`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_users`
--

LOCK TABLES `email_users` WRITE;
/*!40000 ALTER TABLE `email_users` DISABLE KEYS */;
INSERT INTO `email_users` VALUES (11,10,2,'','2015-02-24 13:32:39',NULL,NULL,5,5,5),(12,17,2,'','2015-02-16 12:33:46',NULL,NULL,24,NULL,24),(13,17,1,'Unread','2015-02-16 12:33:46',NULL,NULL,24,NULL,NULL),(18,20,2,'','2015-04-21 04:53:28',NULL,0,33,34,33),(19,20,1,'Unread','2015-04-21 04:53:28',NULL,NULL,33,34,34),(23,22,1,'Unread','2015-04-22 07:20:02',NULL,NULL,NULL,NULL,NULL),(27,24,1,'Unread','2015-04-22 07:29:12',NULL,NULL,NULL,NULL,NULL),(33,27,1,'Trash','2015-04-22 07:56:37',NULL,NULL,NULL,5,5),(35,28,1,'Trash','2015-04-22 07:57:08',NULL,NULL,NULL,5,5),(39,30,1,'','2015-04-22 07:57:48',NULL,NULL,NULL,5,5),(40,31,2,'','2015-04-22 09:34:04',NULL,NULL,1,5,1),(41,31,1,'Trash','2015-04-22 09:56:46',NULL,NULL,NULL,5,5),(46,37,2,'','2015-04-22 11:24:44',NULL,0,38,42,38),(47,37,1,'Unread','2015-04-22 11:24:44',NULL,NULL,38,42,42),(48,38,2,'','2015-06-19 07:02:03',NULL,NULL,5,1,5),(50,39,2,'','2015-06-19 07:05:29',NULL,NULL,1,5,1),(51,39,1,'','2015-06-19 07:05:43',NULL,NULL,1,5,5),(54,42,2,'','2015-06-19 10:10:22',NULL,NULL,53,5,53),(55,42,1,'','2015-06-19 10:10:38',NULL,NULL,53,5,5),(56,43,2,'','2015-06-24 11:31:33',NULL,NULL,38,1,38),(62,46,2,'','2015-07-07 12:57:54',NULL,NULL,50,1,50),(64,47,2,'','2015-07-07 12:58:27',NULL,NULL,50,1,50),(66,48,2,'','2015-07-07 13:01:41',NULL,NULL,50,1,50),(67,49,2,'','2015-08-12 13:07:38',NULL,NULL,56,1,56),(68,49,1,'','2015-08-12 13:14:39',NULL,NULL,56,1,1),(69,50,2,'','2015-08-12 13:07:43',NULL,NULL,56,1,56),(70,50,1,'','2015-08-12 13:13:11',NULL,NULL,56,1,1),(71,51,2,'','2015-08-13 06:51:44',NULL,NULL,1,1,1),(72,51,1,'Trash','2015-08-13 06:52:56',NULL,NULL,1,1,1),(73,52,2,'','2015-08-13 06:56:12',NULL,NULL,1,1,1),(74,52,1,'Trash','2015-08-13 06:56:32',NULL,NULL,1,1,1),(75,53,2,'','2015-08-13 07:01:27',70,NULL,1,56,1),(76,53,1,'Unread','2015-08-13 07:01:27',70,NULL,1,56,56),(77,54,2,'','2015-08-17 06:46:42',NULL,NULL,1,1,1),(78,54,1,'Trash','2015-08-17 07:52:31',NULL,NULL,1,1,1),(79,55,2,'','2015-08-17 06:59:46',NULL,NULL,1,1,1),(80,55,1,'Trash','2015-08-17 07:52:23',NULL,NULL,1,1,1),(81,56,2,'','2015-08-17 07:51:46',NULL,NULL,1,1,1),(82,56,1,'Trash','2015-08-17 07:52:12',NULL,NULL,1,1,1),(83,57,2,'','2015-08-29 00:04:07',NULL,NULL,57,49,57),(84,57,1,'Trash','2015-09-02 18:40:11',NULL,NULL,57,49,49),(85,58,2,'','2015-08-29 07:35:56',NULL,NULL,15,15,15),(86,58,1,'','2015-08-29 07:36:24',NULL,NULL,15,15,15),(89,60,2,'','2015-09-02 15:24:56',NULL,NULL,59,1,59),(90,60,1,'','2015-09-02 15:26:12',NULL,NULL,59,1,1),(91,61,2,'','2015-09-02 15:25:42',NULL,NULL,1,1,1),(92,61,1,'','2015-09-02 15:26:02',NULL,NULL,1,1,1),(93,62,2,'','2015-09-02 15:41:50',NULL,NULL,59,1,59),(94,62,1,'Trash','2015-09-02 17:58:07',NULL,NULL,59,1,1),(95,63,2,'','2015-09-02 15:44:23',NULL,NULL,59,1,59),(96,63,1,'','2015-09-02 15:45:05',NULL,NULL,59,1,1),(97,64,2,'','2015-09-21 04:55:10',NULL,NULL,5,1,5),(98,64,1,'','2015-09-21 04:56:16',NULL,NULL,5,1,1),(99,65,2,'','2015-10-28 07:32:33',NULL,NULL,49,1,49),(100,65,1,'','2015-10-28 07:33:55',NULL,NULL,49,1,1),(101,66,2,'Trash','2016-01-28 22:24:14',NULL,NULL,62,1,62),(102,66,1,'','2016-01-29 04:21:52',NULL,NULL,62,1,1),(103,67,2,'','2016-01-29 04:23:44',102,NULL,1,62,1),(104,67,1,'','2016-01-29 07:20:48',102,NULL,1,62,62),(105,68,2,'','2016-02-18 04:56:06',NULL,NULL,64,1,64),(106,68,1,'','2016-02-18 05:13:31',NULL,NULL,64,1,1),(107,69,2,'','2016-02-18 05:50:57',NULL,NULL,64,1,64),(108,69,1,'','2016-03-14 10:00:17',NULL,NULL,64,1,1),(109,70,2,'','2016-06-01 13:38:46',NULL,NULL,66,1,66),(110,70,1,'','2016-06-02 05:10:12',NULL,NULL,66,1,1),(111,71,2,'','2016-06-01 13:39:08',NULL,NULL,66,1,66),(112,71,1,'','2016-06-02 05:10:33',NULL,NULL,66,1,1),(113,72,2,'','2016-06-02 05:14:07',112,NULL,1,66,1),(114,72,1,'Unread','2016-06-02 05:14:07',112,NULL,1,66,66),(115,73,2,'','2016-06-02 13:18:43',NULL,NULL,66,1,66),(116,73,1,'','2016-06-07 04:35:46',NULL,NULL,66,1,1),(117,74,2,'','2018-07-13 05:56:36',NULL,NULL,70,1,70),(118,74,1,'','2018-07-13 05:57:24',NULL,NULL,70,1,1),(119,75,2,'','2018-07-13 05:59:24',NULL,NULL,1,1,1),(120,75,1,'','2018-08-21 18:55:27',NULL,NULL,1,1,1),(121,76,2,'','2018-07-13 07:45:48',NULL,0,70,71,70),(122,76,1,'Unread','2018-07-13 07:45:48',NULL,NULL,70,71,71),(123,77,2,'','2024-05-25 17:30:53',NULL,0,75,76,75),(124,77,1,'Unread','2024-05-25 17:30:53',NULL,NULL,75,76,76),(125,78,2,'','2024-05-26 05:49:04',NULL,NULL,1,76,1),(126,78,1,'Unread','2024-05-26 05:49:04',NULL,NULL,1,76,76);
/*!40000 ALTER TABLE `email_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(150) DEFAULT NULL,
  `body` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,'Message from Public User','comments from public site'),(2,'Message from Public User','public commnts'),(3,'Message from Public User','ssssssssss'),(4,'Message from Public User','ssssssssss'),(5,'Message from Public User','tttttta sdf sadf sadf sadf '),(6,'Message from Public User','tttttta sdf sadf sadf sadf '),(7,'Message from Public User','tttttta sdf sadf sadf sadf '),(8,'Message from Public User','tttttta sdf sadf sadf sadf '),(9,'Message from Public User','comments.a sdfa sdf sadf '),(10,'Message from Public User','public meessage to my own account'),(11,'Message from Public User','sdfddf'),(12,'Message from Public User','wwerwerwe rwer wer '),(13,'Message from Public User','yy@yyu.com\nasdfasfd asfd asfd '),(14,'Message from Public User','yy@yyu.com\nasdfasfd asfd asfd again'),(15,'Message from Public User','assdf'),(16,'Message from Public User','Abbottabad\nAbbottabad\nKPK\nPrimary Phone: 12345622222\nSecondary Phone: 12'),(17,'Message from Public User','Penatibus mi, class cursus vestibulum. Tincidunt torquent, mus pede dictum neque bibendum sapien praesent mattis commodo cras metus mollis cum.'),(18,'test','Note3'),(19,'test2','Note test again'),(20,'jjjjjjjjjjjjjjjj','jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj'),(21,'Message from Public User',''),(22,'Message from Public User',''),(23,'Message from Public User','Test commetns on 22 april 2015'),(24,'Message from Public User',''),(25,'Message from Public User',''),(26,'Message from Public User','test message on April 22, 2015\n\nFeAmanaALLAH'),(27,'Message from Public User',''),(28,'Message from Public User','new test message 22 april 2015\nagain\nsent'),(29,'Re: Message from Public User','thanks man'),(30,'Message from Public User','Again and again '),(31,'Message from Public User','Contact Information\n\nAbbottabad Campus	\nAbbottabad\nAbbottabad\nKPK'),(32,'Message from Public User','asfd asf asfd '),(33,'Message from Public User','asfd asdf asd'),(34,'Message from Public User','asdf asdf sa'),(35,'Message from Public User','asfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssss'),(36,'Message from Public User','asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss '),(37,'test email from edu edge','Hi,<br>this is just test<br><br>'),(38,'Package Change Request','Hi Asaan School Admin!<br/><br/> Following user has requested to to change the Package. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Ali Fida School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/ss/s3\'>Abbottabad Campus</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>need biannually ....</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali<br/>Admin<br/>Ali Fida School<br/>Abbottabad Campus<br/>alifida86@gmail.com'),(39,'Re: Package Change Request','Hi,&nbsp;<br>You package has been modified to BiAnnually.<br>thanks<br><br>'),(40,'',''),(41,'',''),(42,'Message from Public User','comments from live'),(43,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>Please activiate my account</b>			</td>		</tr></table><br/><br/>Regards<br/>Edu Edge<br/>Admin<br/>Edu Edge<br/>Edu Edge<br/>bilalbahadar@gmail.com'),(46,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Merill ABD</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vm/s3\'>Merill ABD</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>Merill ABD<br/>Admin<br/>Merill ABD<br/>Merill ABD<br/>merill@hk.net'),(47,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Merill ABD</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vm/s3\'>Merill ABD</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>Merill ABD<br/>Admin<br/>Merill ABD<br/>Merill ABD<br/>merill@hk.net'),(48,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Merill ABD</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vm/s3\'>Merill ABD</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>234234234234 234 234 234 234 </b>			</td>		</tr></table><br/><br/>Regards<br/>Merill ABD<br/>Admin<br/>Merill ABD<br/>Merill ABD<br/>merill@hk.net'),(49,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Micro Education System</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://www.asaanschool.com/appadmin/campusDetail/v4/s3\'>Micro Education System</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Micro Education System<br/>Admin<br/>Micro Education System<br/>Micro Education System<br/>microesys@gmail.com'),(50,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Micro Education System</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://www.asaanschool.com/appadmin/campusDetail/v4/s3\'>Micro Education System</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Micro Education System<br/>Admin<br/>Micro Education System<br/>Micro Education System<br/>microesys@gmail.com'),(51,'test email','Hi,<br><br>Hope you are doing well.<br>You have requested for your account activation and chosen the Annual package.<br>Please clear your payment for Annual package.&nbsp;<br>you can get the details from our main site .i.e&nbsp;<a href=\"https://asaanschool.com/welcome/pricing\" target=\"\" rel=\"\">https://asaanschool.com/welcome/pricing</a><br>please also go through our payment methods. i.e.&nbsp;<u><a href=\"https://asaanschool.com/welcome/payments\" target=\"\" rel=\"\">https://asaanschool.com/welcome/payments</a></u><br><br>Regards&nbsp;<br>Admin&nbsp;<br>asaanschool.com<br><br>'),(52,'test test','Hi,<br><br>Hope you are doing well.<br>You have requested for your account activation and chosen the Annual package.<br>Please clear your payment for Annual package.&nbsp;<br><a href=\"https://asaanschool.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\"><u><i>Click here to get our pricing Details</i></u></a><br><a href=\"https://asaanschool.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\"><u><i>Click here to get our Payment Methods&nbsp;</i></u></a>'),(53,'Re: Activate Account Request.','Hi,<br><br>Hope you are doing well.<br><br>You have requested for your account activation with&nbsp;<b>Annual Package</b>.<br>Please clear your payment<b>.&nbsp;</b><br><u><i><br><a href=\"https://asaanschool.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\">C</a><a href=\"https://asaanschool.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\">lick here to get our pricing details</a></i></u><a href=\"https://asaanschool.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\">&nbsp;</a><br><u><i><a href=\"https://asaanschool.com/welcome/payments\" target=\"_blank\" rel=\"nofollow\">Click here to get our payment methods</a></i></u>&nbsp;<br><br>Please pay at earliest get your account activated.<br><br><br>Regards<br>Asaan School .'),(54,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>Test monthly package by ali fida</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>Edu Edge<br/>Edu Edge<br/>admin@asaanschool.com'),(55,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>test</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>Edu Edge<br/>Edu Edge<br/>admin@asaanschool.com'),(56,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>ann test</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>Edu Edge<br/>Edu Edge<br/>admin@asaanschool.com'),(57,'Message from Public User','asdf'),(58,'complain about students','your son are absent 3 to 4 days in &nbsp;a week<br><br>'),(59,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/v9/s3\'>test</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>activate my account \ntest</b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(60,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vd/s3\'>test</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(61,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vd/s3\'>test</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>test<br/>test<br/>admin@asaanschool.com'),(62,'Invoice Clearance Request','Hi Asaan School Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vd\'>test</a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>3</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-09-02</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Standard Chartered Bank</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(63,'Invoice Clearance Request','Hi Asaan School Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vd\'>test</a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>3</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-09-02</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Standard Chartered Bank</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>paid please activate my account.\n\nthanks</b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(64,'Invoice Clearance Request','Hi Asaan School Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Ali Fida School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/ss\'>Abbottabad Campus</a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>1</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-09-21</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Easy Paisa</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>Invoice paid </b>			</td>		</tr></table><br/><br/>Regards<br/>Ali<br/>Admin<br/>Ali Fida School<br/>Abbottabad Campus<br/>alifida86@gmail.com'),(65,'Invoice Clearance Request','Hi Asaan School Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Asaan School </b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vj\'>Asaan School </a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>2</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-10-01</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Standard Chartered Bank</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Asaan School <br/>Admin<br/>Asaan School <br/>Asaan School <br/>demo@asaanschool.com'),(66,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Westernlink MTS</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vk/s3\'>Westernlink MTS</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Westernlink MTS<br/>Admin<br/>Westernlink MTS<br/>Westernlink MTS<br/>mark_mulier@hotmail.com'),(67,'Re: Activate Account Request.','Hi Mark!\n\nThanks for using our school management system.\nWe have recieved the account activation request for your account. Please select a package from:\nhttps://asaanschool.com/welcome/pricing\n\nAlso have a look at our payment methods:\nhttps://asaanschool.com/welcome/payments\n\n\nPlease pay for your desired package and your account will be activated in 1 hour.\nIf you are having any issues regarding payments or package selection, please feel free to contact us any time.\n\nThanks\n\nRegards\nAdmin Asaan School '),(68,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Al Rahber School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vx/s3\'>Al Rahber School</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Al Rahber Public Schools<br/>Admin<br/>Al Rahber School<br/>Al Rahber School<br/>alrahberschool14@gmail.com'),(69,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b></b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/s3/s3\'></a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Al Rahber Public Schools<br/><br/><br/><br/>alrahberschool14@gmail.com'),(70,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>ABNZ</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/v5/s3\'>ABNZ</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>ABNZ<br/>Admin<br/>ABNZ<br/>ABNZ<br/>a0291847365b@gmail.com'),(71,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>ABNZ</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/v5/s3\'>ABNZ</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>ABNZ<br/>Admin<br/>ABNZ<br/>ABNZ<br/>a0291847365b@gmail.com'),(72,'Re: Activate Account Request.','Hi,&nbsp;<br><br>We have received your request to activate your account. Please pay the desired package charges. so that we can activate your account.&nbsp;<br><br>Our Payment methods:&nbsp;<br><a target=\"_blank\" rel=\"nofollow\" href=\"https://asaanschool.com/welcome/payments\">https://asaanschool.com/welcome/payments</a><br><br>Please feel free ask for any further assistance.<br><br>Regards<br><br>Admin<br>Asaan School  Inc.<br>email: admin@asaanschool.com;&nbsp;<br>silverlean@gmail.com'),(73,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>ABNZ</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/v5/s3\'>ABNZ</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>Wow!</b>			</td>		</tr></table><br/><br/>Regards<br/>ABNZ<br/>Admin<br/>ABNZ<br/>ABNZ<br/>a0291847365b@gmail.com'),(74,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>The Leader School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vf/s3\'>The Leader School</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>The Leader School<br/>Admin<br/>The Leader School<br/>The Leader School<br/>theleadersschoolharipur@gmail.com'),(75,'Activate Account Request.','Hi Asaan School Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>The Leader School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vf/s3\'>The Leader School</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>Free</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>The Leader School<br/>The Leader School<br/>admin@asaanschool.com'),(76,'libra.waheed@gmail.com','test'),(77,'Activate Account Request.','Hi Asaanschool Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>school24</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vc/\'>school24</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>school24<br/>Admin<br/>school24<br/>school24<br/>admin@school24.com'),(78,'Activate Account Request.','Hi Asaanschool Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>school24</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'https://asaanschool.com/appadmin/campusDetail/vc/\'>school24</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>school24<br/>school24<br/>admin@asaanschool.com');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_salaries`
--

DROP TABLE IF EXISTS `employee_salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_salaries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) NOT NULL,
  `month` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_employee_salaries_employees` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_salaries`
--

LOCK TABLES `employee_salaries` WRITE;
/*!40000 ALTER TABLE `employee_salaries` DISABLE KEYS */;
INSERT INTO `employee_salaries` VALUES (1,2,'2014-11-01',2333,'Paid','2014-11-11','Nov 2014 salaries issued ',1,'2014-11-11 01:30:44',3),(2,3,'2014-11-01',2333,'Paid','2014-11-11','Nov 2014 salaries issued ',1,'2014-11-11 01:30:44',3),(3,5,'2014-11-01',2333,'Paid','2014-11-11','Nov 2014 salaries issued ',1,'2014-11-11 01:30:44',3),(4,2,'2014-12-01',2333,'Reverted','2014-11-11','salry issued will be returned',1,'2014-11-11 01:31:54',4),(5,3,'2014-12-01',2333,'Reverted','2014-11-14','',1,'2014-11-14 16:30:20',18),(6,5,'2014-12-01',2333,'Reverted','2014-11-14','',1,'2014-11-14 16:30:20',18),(7,2,'2014-03-01',2333,'Reverted','2014-11-16','ffff',1,'2014-11-16 09:51:05',24),(8,3,'2014-03-01',2333,'Reverted','2014-11-16','ffff',1,'2014-11-16 09:51:05',24),(9,5,'2014-03-01',2333,'Reverted','2014-11-16','ffff',1,'2014-11-16 09:51:05',24),(10,6,'2014-03-01',7897.98,'Reverted','2014-11-20','',1,'2014-11-20 17:17:53',37),(11,6,'2014-12-01',7897.98,'Paid','2014-11-20','hhhhhh',1,'2014-11-20 17:18:51',39),(12,3,'2015-08-01',2333,'Paid','2014-11-20','qqqqqqq',1,'2014-11-20 17:28:23',40),(13,5,'2015-08-01',2333,'Paid','2014-11-20','qqqqqqq',1,'2014-11-20 17:28:23',40),(14,7,'2014-11-01',5000,'Paid','2014-11-26','salary issued\r\n',4,'2014-11-26 05:35:40',42),(15,8,'2014-06-01',1500,'Paid','2014-11-26','fffff',7,'2014-11-26 14:34:41',53),(16,9,'2014-12-01',5000,'Paid','2014-12-02','salary issued',7,'2014-12-02 11:11:02',59),(17,12,'2014-02-01',3500,'Paid','2014-12-09','',7,'2014-12-09 01:46:13',68),(18,30,'2015-08-01',15000,'Paid','2015-09-02','Paid via bank',49,'2015-09-02 13:18:46',85),(19,31,'2016-01-01',1000,'Paid','2016-01-28','salary',62,'2016-01-28 16:14:24',91),(20,37,'2018-05-01',18000,'Paid','2018-07-13','May 2018',70,'2018-07-13 09:22:48',101),(21,39,'2018-05-01',10000,'Paid','2018-07-13','May 2018',70,'2018-07-13 09:22:48',101),(22,38,'2018-05-01',10000,'Paid','2018-07-13','May 2018',70,'2018-07-13 09:22:48',101),(23,34,'2018-05-01',15000,'Paid','2018-07-13','May 2018',70,'2018-07-13 09:22:48',101);
/*!40000 ALTER TABLE `employee_salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_types`
--

DROP TABLE IF EXISTS `employee_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employee_type_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_types`
--

LOCK TABLES `employee_types` WRITE;
/*!40000 ALTER TABLE `employee_types` DISABLE KEYS */;
INSERT INTO `employee_types` VALUES (1,'Teacher',1),(2,'Support Staff',1),(3,'Managment',1),(4,'teachers',2),(5,'Teacher',5),(6,'Teacher1',5),(7,'vice principal',8),(8,'principal',8),(9,'Teacher / Chief proctor',8),(10,'Teacher',8),(11,'MD',8),(12,'Watch man / Peon',8),(13,'watchman /night',8),(16,'Non Technical',21),(17,'Technical',21),(18,'teacher',16),(22,'Teachers',33),(23,'Support Staff',33),(24,'Teachers',34),(25,'Support Staff',34),(30,'Teachers',38),(31,'Support Staff',38),(36,'Teachers',41),(37,'Support Staff',41),(38,'Teachers',42),(39,'Support Staff',42),(40,'Teachers',43),(41,'Support Staff',43),(42,'Teachers',44),(43,'Support Staff',44),(44,'Teachers',45),(45,'Support Staff',45),(46,'Teachers',46),(47,'Support Staff',46),(48,'Teachers',47),(49,'Support Staff',47),(52,'Teachers',49),(53,'Support Staff',49),(54,'Teachers',50),(55,'Support Staff',50),(56,'Management',50),(57,'Teachers',51),(58,'Support Staff',51),(59,'Teachers',52),(60,'Support Staff',52),(64,'Support Staff',54),(63,'Teachers',54),(65,'Teachers',55),(66,'Support Staff',55),(67,'Teachers',56),(68,'Support Staff',56),(69,'Teachers',57),(70,'Support Staff',57),(71,'Teachers',58),(72,'Support Staff',58),(73,'Principal',58),(74,'Coordinator',58),(75,'Teachers',60),(76,'Support Staff',60);
/*!40000 ALTER TABLE `employee_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `employee_no` varchar(50) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `qualification` varchar(45) DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `date_of_resigning` date DEFAULT NULL,
  `employee_type_id` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  `employee_picture` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNI_EMAIL_CAMPUS` (`campus_id`,`email`) COMMENT 'employee email once per campus',
  KEY `FK_emp_type` (`employee_type_id`),
  KEY `FK_employee_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (2,'Teacher2','Khan2','13212311',NULL,NULL,'address',2333,'MSc','2014-10-10','2014-10-10',1,'Active',1,NULL),(3,'Teacher','Khan','13212311',NULL,NULL,'address',2333,'BSc','2014-10-10','2014-10-10',1,'Active',1,NULL),(4,'FFFFF','FFFF','234234234',NULL,NULL,'address',2,'GTT','2014-11-02','0000-00-00',2,'In Active',1,NULL),(5,'New','Teacher','13504-5696582-7',NULL,NULL,'ISB',2333,'MSc','2014-11-18',NULL,1,'Active',1,NULL),(6,'www','','13547-8965877-7',NULL,NULL,'address',7897.98,'','2014-11-04',NULL,1,'Active',1,NULL),(7,'ttt','tttt','13547-8965877-7',NULL,NULL,'address',5000,'MSc','2014-11-26',NULL,4,'Active',2,NULL),(8,'rrrr','rrr','13547-8965877-7',NULL,'ali@ali.coms','ISB',1500,'BSc','2014-11-26',NULL,5,'Active',5,NULL),(9,'ZOYA','JAVED','13504-2222624-5',NULL,'bashir_anis@yahoo.com','bilal town, ',5000,'Graduation + B. ed','2011-05-02','2014-12-02',8,'Active',8,'http://www.asaanschool.com/uploads/campuses/OX/employees/Ojemp-pic.png'),(10,'Halima','Munsif','14523-3654987-8',NULL,'haleema.munsif@gmail.com','Bilal town,  street No. 1',4500,'M.com','2013-11-07','2014-12-02',7,'Active',8,NULL),(11,'saima','quest','45632-4569875-8',NULL,'saima.classtwo@yahoo.com','thanda chooha',3000,'Graduation ','2014-11-11','2014-12-02',10,'Active',8,NULL),(12,'Asma ','nazra','78965-4563214-8',NULL,'asma.nazra@gmail.com','hassan town',3500,'darse e nizami (Aalima)','2013-09-18','2014-12-02',10,'Active',8,NULL),(13,'IQBAL','MUHAMMAD','12365-8956478-2',NULL,'iqbal.quest@yahoo.com','at school site',0,'M.phil education, M.sc Maths','2011-02-10','2014-12-02',11,'Active',8,NULL),(18,'ggg','gggg','13547-8965877-7',NULL,'ggg4@ggg.com','address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'https://asaanschool.com/uploads/campuses/OO/students/OQemp-pic.png'),(19,'ggg','gggg','13547-8965877-7',NULL,NULL,'address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'https://asaanschool.com/uploads/campuses/OO/students/Odemp-pic.png'),(20,'ggg','gggg','13547-8965877-7',NULL,NULL,'address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'https://asaanschool.com/uploads/campuses/OO/students/ODemp-pic.png'),(21,'ggg','gggg','13547-8965877-7',NULL,NULL,'address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'https://asaanschool.com/uploads/campuses/OO/students/OHemp-pic.png'),(22,'eee','eee','13547-8965877-7',NULL,'s3@gmail.com','Abbottabad32333',2333,'BSc','2014-12-01',NULL,2,'Active',1,'https://asaanschool.com/uploads/campuses/OO/employees/OPemp-pic.png'),(25,'Sohrab','Khan','13302-0976998-1',NULL,'ksohrab76@yahoo.com','Haripur',8000,'BSc','2014-02-01',NULL,17,'Active',21,'https://asaanschool.com/uploads/campuses/OH/students/Ogemp-pic.jpg'),(26,'Hassam','Akram','13302-7950857-7',NULL,'hassamakram999@hotmail.com','Vill Tolokar Haripur',8000,'BS (Agriculture)','2014-09-01',NULL,16,'Active',21,'https://asaanschool.com/uploads/campuses/OH/students/Okemp-pic.jpg'),(27,'Faisal','Ur Rehman','13302-9975161-9',NULL,'faisalrehman025@gmail.com','Village, Alam Tehsil & District Haripur',6000,'B.Com Result Awaited','2014-12-13',NULL,17,'Active',21,'https://asaanschool.com/uploads/campuses/OH/students/OWemp-pic.jpg'),(28,'UserEmail','test','13504-9856547-1',NULL,NULL,'address',500000,'BSCS','2015-01-25',NULL,1,'Active',1,NULL),(29,'Abdul','Waheed','13504-9874258-9',NULL,NULL,'Address',10000,'BSc','2015-02-24',NULL,18,'Active',16,NULL),(30,'Abc','khan','12345-6589898-7',NULL,'eamil@email.com','address',15000,'MSc','2015-06-01',NULL,36,'Active',41,NULL),(31,'doris','boo','11111-1111111-1',NULL,'doris@westernlinl.nl','amersfoort',1000,'7','2016-01-28',NULL,60,'Active',52,NULL),(33,'Gurasoa','ik012018ar','81293-7192361-5',NULL,'ainhoabarriola75@gmail.com','Gurasoa',1.2841928984718965e17,'LH4 Gurasoa','2016-06-01',NULL,66,'Active',55,NULL),(34,'Muhammad','Afzal','1330217465465',NULL,'theleadersschool@gmail.com','Haripur',15000,'Chemical Engineer','2018-03-01',NULL,72,'Active',58,NULL),(35,'tyty','123','131232131',NULL,'imran.fida2647@gmail.com','Peshawar KPK, Peshawar KPK',12,'12','2018-07-08',NULL,72,'In Active',58,NULL),(36,'emp ','emp','12312',NULL,'email@ee.haripur.com','addre',1213,'A','2018-07-10',NULL,71,'In Active',58,NULL),(37,'Qurat ul Ain','Ainnie','1111111',NULL,'aadf@gmail.com','Haripur',18000,'MBA','2018-05-01',NULL,71,'Active',58,NULL),(38,'Muhammad','Sawar','111111',NULL,'test@gmail.com','Allooli',10000,'BA','2018-03-01',NULL,71,'Active',58,NULL),(39,'Zahida','Bibi','11111',NULL,'as@gmail.com','Gorraki Mera, Alooli',10000,'MA','2018-03-01',NULL,71,'Active',58,NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_type`
--

DROP TABLE IF EXISTS `expense_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_expense_type_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_type`
--

LOCK TABLES `expense_type` WRITE;
/*!40000 ALTER TABLE `expense_type` DISABLE KEYS */;
INSERT INTO `expense_type` VALUES (1,'Building rent',1),(2,'Party Expense',1),(3,'Study Trip',1),(4,'Building rent',5),(5,'school rent',8),(6,'Gas Bill',8),(7,'Electricity Bill',8),(8,'Printer Purchased',8),(9,'Computer Cables',8),(17,'Building Rent',33),(18,'Electricity Bill',33),(19,'Telephone Bill',33),(20,'Study Trip',33),(21,'Building Rent',34),(22,'Electricity Bill',34),(23,'Telephone Bill',34),(24,'Study Trip',34),(33,'Building Rent',38),(34,'Electricity Bill',38),(35,'Telephone Bill',38),(36,'Study Trip',38),(45,'Building Rent',41),(46,'Electricity Bill',41),(47,'Telephone Bill',41),(48,'Study Trip',41),(49,'Building Rent',42),(50,'Electricity Bill',42),(51,'Telephone Bill',42),(52,'Study Trip',42),(53,'Building Rent',43),(54,'Electricity Bill',43),(55,'Telephone Bill',43),(56,'Study Trip',43),(57,'Building Rent',44),(58,'Electricity Bill',44),(59,'Telephone Bill',44),(60,'Study Trip',44),(61,'Building Rent',45),(62,'Electricity Bill',45),(63,'Telephone Bill',45),(64,'Study Trip',45),(65,'Building Rent',46),(66,'Electricity Bill',46),(67,'Telephone Bill',46),(68,'Study Trip',46),(69,'Building Rent',47),(70,'Electricity Bill',47),(71,'Telephone Bill',47),(72,'Study Trip',47),(77,'Building Rent',49),(78,'Electricity Bill',49),(79,'Telephone Bill',49),(80,'Study Trip',49),(81,'Building Rent',50),(82,'Electricity Bill',50),(83,'Telephone Bill',50),(84,'Study Trip',50),(85,'Building Rent',51),(86,'Electricity Bill',51),(87,'Telephone Bill',51),(88,'Study Trip',51),(94,'Water Bill',52),(90,'Electricity Bill',52),(91,'Telephone Bill',52),(92,'Study Trip',52),(93,'Cleaning',52),(95,'Building Rent',53),(96,'Electricity Bill',53),(97,'Telephone Bill',53),(98,'Study Trip',53),(99,'Building Rent',54),(100,'Electricity Bill',54),(101,'Telephone Bill',54),(102,'Study Trip',54),(103,'Stationery',54),(104,'Building Rent',55),(105,'Electricity Bill',55),(106,'Telephone Bill',55),(107,'Study Trip',55),(108,'Building Rent',56),(109,'Electricity Bill',56),(110,'Telephone Bill',56),(111,'Study Trip',56),(112,'Building Rent',57),(113,'Electricity Bill',57),(114,'Telephone Bill',57),(115,'Study Trip',57),(116,'Building Rent',58),(117,'Electricity Bill',58),(118,'Telephone Bill',58),(119,'Study Trip',58),(120,'Building Rent',60),(121,'Electricity Bill',60),(122,'Telephone Bill',60),(123,'Study Trip',60);
/*!40000 ALTER TABLE `expense_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,0) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `expense_type_id` int(10) DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Expense_type` (`expense_type_id`),
  KEY `FK_Expense_transac` (`transaction_id`),
  KEY `FK_expense_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,45000,'Building rend paid',1,'2014-11-14','Building rent paid','Reverted','2014-11-20 20:41:42',1,15,1),(2,23332,'SSSssss',3,'2014-11-26','sdsdfsdf','Reverted','2014-11-20 20:41:42',1,21,1),(3,2222,'2222',1,'2014-11-17','2222','Reverted','2014-11-20 20:41:43',1,26,1),(4,3333,'3333',3,'2014-11-25','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Active','2014-11-20 20:41:43',1,28,1),(5,234,' aaa',2,'2014-02-03','asdfa','Reverted','2014-11-20 21:30:45',1,34,1),(6,1000,'desc',4,'2014-11-20','','Active','2014-11-26 20:11:29',7,58,5),(7,15000,'December 2014',5,'2014-12-31','paid online through account No. 1545 UBL','Active','2014-12-02 17:13:20',7,63,8),(8,200,'Paid',6,'2014-12-31','Paid by Khan bashir','Active','2014-12-02 17:14:15',7,64,8),(9,2500,'Paid',7,'2014-12-31','paid by Khan Bashir','Active','2014-12-02 17:14:54',7,65,8),(10,5000,'HP 1100',8,'2014-12-10','Jointly purchased by Bashir and Iqbal sb','Active','2014-12-02 17:15:43',7,66,8),(11,100,'Power Cable for computer',9,'2014-12-10','Purchased by Bashir Khan','Active','2014-12-02 17:16:23',7,67,8),(12,5000,'Paid through bank',45,'2015-09-01','','In Active','2015-09-02 18:29:14',49,87,41);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fee_types`
--

DROP TABLE IF EXISTS `fee_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fee_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `can_delete` varchar(20) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  `internal_key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_campus_feetype` (`type`,`campus_id`) USING BTREE,
  KEY `FK_feetype_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fee_types`
--

LOCK TABLES `fee_types` WRITE;
/*!40000 ALTER TABLE `fee_types` DISABLE KEYS */;
INSERT INTO `fee_types` VALUES (1,'Monthly Tution Fee','No',1,'tution.fee'),(2,'Admission Fee','No',1,'admission.fee'),(3,'Examination Fee','No',1,NULL),(4,'monthly',NULL,2,NULL),(5,'examination',NULL,2,NULL),(7,'Monthly Tution Fee',NULL,5,'tution.fee'),(8,'fff',NULL,5,NULL),(9,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(10,'Admission Fee',NULL,NULL,'admission.fee'),(11,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(12,'Admission Fee',NULL,NULL,'admission.fee'),(13,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(14,'Admission Fee',NULL,NULL,'admission.fee'),(15,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(16,'Admission Fee',NULL,NULL,'admission.fee'),(17,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(18,'Admission Fee',NULL,NULL,'admission.fee'),(19,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(20,'Admission Fee',NULL,NULL,'admission.fee'),(21,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(22,'Admission Fee',NULL,NULL,'admission.fee'),(23,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(24,'Admission Fee',NULL,NULL,'admission.fee'),(25,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(26,'Admission Fee',NULL,NULL,'admission.fee'),(31,'Monthly Tution Fee',NULL,8,'tution.fee'),(32,'Admission Fee',NULL,8,'admission.fee'),(47,'Monthly Tution Fee',NULL,16,'tution.fee'),(48,'Admission Fee',NULL,16,'admission.fee'),(55,'Monthly Tution Fee',NULL,20,'tution.fee'),(56,'Admission Fee',NULL,20,'admission.fee'),(57,'month fee ',NULL,21,'tution.fee'),(58,'Annual Fund',NULL,21,'admission.fee'),(59,'Paper Fee',NULL,21,NULL),(60,'Monthly Tution Fee',NULL,22,'tution.fee'),(61,'Admission Fee',NULL,22,'admission.fee'),(66,'Monthly Tution Fee',NULL,25,'tution.fee'),(67,'Admission Fee',NULL,25,'admission.fee'),(68,'Monthly Tution Fee',NULL,26,'tution.fee'),(69,'Admission Fee',NULL,26,'admission.fee'),(70,'Monthly Tution Fee',NULL,27,'tution.fee'),(71,'Admission Fee',NULL,27,'admission.fee'),(72,'Monthly Tution Fee',NULL,28,'tution.fee'),(73,'Admission Fee',NULL,28,'admission.fee'),(74,'Monthly Tution Fee',NULL,29,'tution.fee'),(75,'Admission Fee',NULL,29,'admission.fee'),(78,'Admission Fee','Yes',NULL,'admission.fee'),(79,'Monthly Tuition Fee','Yes',NULL,'tution.fee'),(80,'Examination Fee','Yes',NULL,'examination.fee'),(84,'Admission Fee','Yes',33,'admission.fee'),(85,'Monthly Tuition Fee','Yes',33,'tution.fee'),(86,'Examination Fee','Yes',33,'examination.fee'),(87,'Admission Fee','Yes',34,'admission.fee'),(88,'Monthly Tuition Fee','Yes',34,'tution.fee'),(89,'Examination Fee','Yes',34,'examination.fee'),(93,'Ghunda tax',NULL,1,NULL),(97,'Admission Fee','Yes',38,'admission.fee'),(98,'Monthly Tuition Fee','Yes',38,'tution.fee'),(99,'Examination Fee','Yes',38,'examination.fee'),(106,'Admission Fee','Yes',41,'admission.fee'),(107,'Monthly Tuition Fee','Yes',41,'tution.fee'),(108,'Examination Fee','Yes',41,'examination.fee'),(109,'Library Fee',NULL,41,NULL),(110,'Admission Fee','Yes',42,'admission.fee'),(111,'Monthly Tuition Fee','Yes',42,'tution.fee'),(112,'Examination Fee','Yes',42,'examination.fee'),(113,'Admission Fee','Yes',43,'admission.fee'),(114,'Monthly Tuition Fee','Yes',43,'tution.fee'),(115,'Examination Fee','Yes',43,'examination.fee'),(116,'Admission Fee','Yes',44,'admission.fee'),(117,'Monthly Tuition Fee','Yes',44,'tution.fee'),(118,'Examination Fee','Yes',44,'examination.fee'),(119,'Admission Fee','Yes',45,'admission.fee'),(120,'Monthly Tuition Fee','Yes',45,'tution.fee'),(121,'Examination Fee','Yes',45,'examination.fee'),(122,'Admission Fee','Yes',46,'admission.fee'),(123,'Monthly Tuition Fee','Yes',46,'tution.fee'),(124,'Examination Fee','Yes',46,'examination.fee'),(125,'Admission Fee','Yes',47,'admission.fee'),(126,'Monthly Tuition Fee','Yes',47,'tution.fee'),(127,'Examination Fee','Yes',47,'examination.fee'),(131,'Admission Fee','Yes',49,'admission.fee'),(132,'Monthly Tuition Fee','Yes',49,'tution.fee'),(133,'Examination Fee','Yes',49,'examination.fee'),(134,'Ghunda tax',NULL,41,NULL),(135,'Admission Fee','Yes',50,'admission.fee'),(136,'Monthly Tuition Fee','Yes',50,'tution.fee'),(137,'Examination Fee','Yes',50,'examination.fee'),(138,'ComputerFee',NULL,50,NULL),(139,'Admission Fee','Yes',51,'admission.fee'),(140,'Monthly Tuition Fee','Yes',51,'tution.fee'),(141,'Examination Fee','Yes',51,'examination.fee'),(142,'Admission Fee','Yes',52,'admission.fee'),(143,'Term Tuition Fee','Yes',52,'tution.fee'),(144,'Food Fee Day','Yes',52,'examination.fee'),(145,'Transport fee',NULL,52,NULL),(146,'Admission Fee','Yes',53,'admission.fee'),(147,'Monthly Tuition Fee','Yes',53,'tution.fee'),(148,'Examination Fee','Yes',53,'examination.fee'),(149,'Lab/Card/File',NULL,21,NULL),(150,'Computer Fee',NULL,21,NULL),(151,'Book/Note Book',NULL,21,NULL),(152,'sports ',NULL,21,NULL),(153,'Admission Fee','Yes',54,'admission.fee'),(154,'Monthly Tuition Fee','Yes',54,'tution.fee'),(155,'Examination Fee','Yes',54,'examination.fee'),(156,'Admission Fee','Yes',55,'admission.fee'),(157,'Monthly Tuition Fee','Yes',55,'tution.fee'),(158,'Examination Fee','Yes',55,'examination.fee'),(159,'Admission Fee','Yes',56,'admission.fee'),(160,'Monthly Tuition Fee','Yes',56,'tution.fee'),(161,'Examination Fee','Yes',56,'examination.fee'),(162,'Admission Fee','Yes',57,'admission.fee'),(163,'Monthly Tuition Fee','Yes',57,'tution.fee'),(164,'Examination Fee','Yes',57,'examination.fee'),(165,'Admission Fee','Yes',58,'admission.fee'),(166,'Monthly Tuition Fee','Yes',58,'tution.fee'),(167,'Examination Fee','Yes',58,'examination.fee'),(168,'Books',NULL,58,NULL),(169,'Admission Fee','Yes',60,'admission.fee'),(170,'Monthly Tuition Fee','Yes',60,'tution.fee'),(171,'Examination Fee','Yes',60,'examination.fee'),(172,'Admission Fee',NULL,61,NULL),(173,'Tuition Fee',NULL,61,NULL);
/*!40000 ALTER TABLE `fee_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardians`
--

DROP TABLE IF EXISTS `guardians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guardians` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `occupation` varchar(45) DEFAULT NULL,
  `work_phone` varchar(45) DEFAULT NULL,
  `home_phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardians`
--

LOCK TABLES `guardians` WRITE;
/*!40000 ALTER TABLE `guardians` DISABLE KEYS */;
/*!40000 ALTER TABLE `guardians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `campus_package_id` int(10) DEFAULT NULL,
  `invoice_no` varchar(20) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT 0,
  `payable_amount` decimal(10,0) DEFAULT 0,
  `discount` decimal(10,0) DEFAULT 0,
  `arrears` decimal(10,0) DEFAULT 0,
  `total_payable_amount` decimal(10,0) DEFAULT 0,
  `paid_amount` decimal(10,0) DEFAULT 0,
  `invoice_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `campus_id` int(10) DEFAULT NULL,
  `payment_method` int(10) DEFAULT NULL,
  `invoice_expiry_date` date DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_campus_package_invoice` (`campus_package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1088 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (4,3,'1',0,10000,0,0,10000,10000,'2015-09-21','Expired','2015-09-21','2015-09-21',1,'2015-09-20 23:53:13','2015-10-20 11:49:20',1,2,'2016-03-21','PKR'),(5,13,'2',0,10000,0,0,10000,10000,'2015-10-28','Expired','2015-10-28',NULL,1,'2015-10-28 02:30:44','2015-10-28 07:30:44',41,1,'2016-04-28','PKR'),(1036,5,'5',0,0,0,0,0,0,'2016-05-02','Due','2016-05-02',NULL,0,'2016-05-02 12:19:57','2016-05-02 12:19:57',16,NULL,'2016-11-02','USD'),(1035,3,'4',0,100,0,0,100,0,'2016-03-21','Expired','2016-03-21',NULL,0,'2016-05-02 12:19:38','2016-05-02 12:19:38',1,NULL,'2016-09-21','USD'),(1034,4,'3',0,0,0,0,0,0,'2015-11-16','Expired','2016-12-31',NULL,1,'2015-11-16 08:00:37','2015-11-16 08:00:37',21,0,'2016-12-31','USD'),(1037,4,'6',0,0,0,0,0,0,'2016-05-16','Expired','2017-01-23',NULL,0,'2017-01-23 06:07:35','2017-01-23 11:07:35',21,NULL,'2017-07-01','USD'),(1038,4,'7',0,0,0,0,0,0,'2016-11-16','Expired','2017-07-23',NULL,0,'2018-02-13 12:37:46','2018-02-13 17:37:46',21,NULL,'2018-01-01','USD'),(1039,4,'8',0,0,0,0,0,0,'2017-05-16','Expired','2018-01-23',NULL,0,'2018-02-13 12:37:46','2018-02-13 17:37:46',21,NULL,'2018-07-01','USD'),(1040,3,'9',0,100,0,0,100,0,'2016-09-21','Expired','2016-09-21',NULL,0,'2018-02-17 02:07:48','2018-02-17 07:07:48',1,NULL,'2017-03-21','USD'),(1041,3,'10',0,100,0,0,100,0,'2017-03-21','Expired','2017-03-21',NULL,0,'2018-02-17 02:07:48','2018-02-17 07:07:48',1,NULL,'2017-09-21','USD'),(1042,3,'10',0,100,0,0,100,0,'2017-09-21','Expired','2017-09-21',NULL,0,'2018-02-17 02:07:48','2018-02-17 07:07:48',1,NULL,'2018-03-21','USD'),(1043,6,'10',0,0,0,0,0,0,'2018-02-17','Paid','2018-02-17',NULL,1,'2018-02-17 02:08:47','2018-02-17 07:08:47',22,1,'2018-08-17','USD'),(1044,13,'10',0,100,0,0,100,0,'2016-04-28','Expired','2016-04-28',NULL,0,'2018-02-17 02:14:53','2018-02-17 07:14:53',41,NULL,'2016-10-28','USD'),(1045,13,'10',0,100,0,0,100,0,'2016-10-28','Expired','2016-10-28',NULL,0,'2018-02-17 02:14:53','2018-02-17 07:14:53',41,NULL,'2017-04-28','USD'),(1046,13,'10',0,100,0,0,100,0,'2017-04-28','Expired','2017-04-28',NULL,0,'2018-02-17 02:14:53','2018-02-17 07:14:53',41,NULL,'2017-10-28','USD'),(1047,13,'10',0,100,0,0,100,0,'2017-10-28','Paid','2017-10-28',NULL,1,'2018-02-17 02:14:53','2018-02-17 07:14:53',41,1,'2018-04-28','USD'),(1048,13,'10',0,100,0,0,100,0,'2018-04-28','Paid','2018-04-28',NULL,1,'2018-04-18 01:04:38','2018-04-18 06:04:38',41,0,'2018-10-28','USD'),(1049,3,'10',0,100,0,0,100,0,'2018-03-21','Expired','2018-03-21',NULL,1,'2018-04-18 01:30:52','2018-04-18 06:30:52',1,0,'2018-09-21','USD'),(1050,14,'10',0,0,0,0,0,0,'2018-07-13','Expired','2018-07-13',NULL,1,'2018-07-13 04:58:56','2018-07-13 05:58:56',58,0,'2019-01-13','USD'),(1051,3,'10',0,100,0,0,100,0,'2018-09-21','Expired','2018-09-21',NULL,1,'2018-10-04 05:31:40','2018-10-04 06:31:40',1,1,'2019-03-21','USD'),(1052,13,'10',0,100,0,0,100,100,'2018-10-28','Expired','2018-10-28',NULL,1,'2018-10-25 13:40:48','2018-10-25 14:40:48',41,2,'2019-04-28','USD'),(1053,14,'10',0,0,0,0,0,0,'2019-01-13','Paid','2019-01-13',NULL,1,'2019-01-17 08:35:19','2019-01-17 08:35:19',58,0,'2019-07-13','USD'),(1054,15,'10',0,0,0,0,0,0,'2019-02-12','Expired','2019-02-12',NULL,1,'2019-02-12 08:42:16','2019-02-12 08:42:16',2,2,'2019-08-12','USD'),(1055,3,'10',0,100,0,0,100,0,'2019-03-21','Expired','2019-03-21',NULL,0,'2021-09-11 06:20:58','2021-09-11 07:20:58',1,NULL,'2019-09-21','USD'),(1056,3,'10',0,100,0,0,100,0,'2019-09-21','Expired','2019-09-21',NULL,0,'2021-09-11 06:20:58','2021-09-11 07:20:58',1,NULL,'2020-03-21','USD'),(1057,3,'10',0,100,0,0,100,0,'2020-03-21','Expired','2020-03-21',NULL,0,'2021-09-11 06:20:58','2021-09-11 07:20:58',1,NULL,'2020-09-21','USD'),(1058,3,'10',0,100,0,0,100,0,'2020-09-21','Expired','2020-09-21',NULL,0,'2021-09-11 06:20:58','2021-09-11 07:20:58',1,NULL,'2021-03-21','USD'),(1059,3,'10',0,100,0,0,100,0,'2021-03-21','Due','2021-03-21',NULL,1,'2021-09-11 06:20:58','2021-09-11 07:20:58',1,0,'2021-09-21','USD'),(1060,15,'10',0,0,0,0,0,0,'2019-08-12','Expired','2019-08-12',NULL,0,'2021-09-11 06:21:18','2021-09-11 07:21:18',2,NULL,'2020-02-12','USD'),(1061,15,'10',0,0,0,0,0,0,'2020-02-12','Expired','2020-02-12',NULL,0,'2021-09-11 06:21:18','2021-09-11 07:21:18',2,NULL,'2020-08-12','USD'),(1062,15,'10',0,0,0,0,0,0,'2020-08-12','Expired','2020-08-12',NULL,0,'2021-09-11 06:21:18','2021-09-11 07:21:18',2,NULL,'2021-02-12','USD'),(1063,15,'10',0,0,0,0,0,0,'2021-02-12','Expired','2021-02-12',NULL,0,'2021-09-11 06:21:18','2021-09-11 07:21:18',2,NULL,'2021-08-12','USD'),(1064,15,'10',0,0,0,0,0,0,'2021-08-12','Due','2021-08-12',NULL,0,'2021-09-11 06:21:18','2021-09-11 07:21:18',2,NULL,'2022-02-12','USD'),(1065,4,'10',0,0,0,0,0,0,'2017-11-16','Expired','2018-07-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2019-01-01','USD'),(1066,4,'10',0,0,0,0,0,0,'2018-05-16','Expired','2019-01-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2019-07-01','USD'),(1067,4,'10',0,0,0,0,0,0,'2018-11-16','Expired','2019-07-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2020-01-01','USD'),(1068,4,'10',0,0,0,0,0,0,'2019-05-16','Expired','2020-01-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2020-07-01','USD'),(1069,4,'10',0,0,0,0,0,0,'2019-11-16','Expired','2020-07-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2021-01-01','USD'),(1070,4,'10',0,0,0,0,0,0,'2020-05-16','Expired','2021-01-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2021-07-01','USD'),(1071,4,'10',0,0,0,0,0,0,'2020-11-16','Expired','2021-07-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2022-01-01','USD'),(1072,4,'10',0,0,0,0,0,0,'2021-05-16','Expired','2022-01-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2022-07-01','USD'),(1073,4,'10',0,0,0,0,0,0,'2021-11-16','Expired','2022-07-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2023-01-01','USD'),(1074,4,'10',0,0,0,0,0,0,'2022-05-16','Expired','2023-01-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2023-07-01','USD'),(1075,4,'10',0,0,0,0,0,0,'2022-11-16','Expired','2023-07-23',NULL,0,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,NULL,'2024-01-01','USD'),(1076,4,'10',0,0,0,0,0,0,'2023-05-16','Paid','2024-01-23',NULL,1,'2024-05-25 14:27:17','2024-05-25 17:27:17',21,0,'2024-07-01','USD'),(1077,13,'10',0,100,0,0,100,0,'2019-04-28','Expired','2019-04-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2019-10-28','USD'),(1078,13,'10',0,100,0,0,100,0,'2019-10-28','Expired','2019-10-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2020-04-28','USD'),(1079,13,'10',0,100,0,0,100,0,'2020-04-28','Expired','2020-04-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2020-10-28','USD'),(1080,13,'10',0,100,0,0,100,0,'2020-10-28','Expired','2020-10-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2021-04-28','USD'),(1081,13,'10',0,100,0,0,100,0,'2021-04-28','Expired','2021-04-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2021-10-28','USD'),(1082,13,'10',0,100,0,0,100,0,'2021-10-28','Expired','2021-10-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2022-04-28','USD'),(1083,13,'10',0,100,0,0,100,0,'2022-04-28','Expired','2022-04-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2022-10-28','USD'),(1084,13,'10',0,100,0,0,100,0,'2022-10-28','Expired','2022-10-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2023-04-28','USD'),(1085,13,'10',0,100,0,0,100,0,'2023-04-28','Expired','2023-04-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2023-10-28','USD'),(1086,13,'10',0,100,0,0,100,0,'2023-10-28','Expired','2023-10-28',NULL,0,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,NULL,'2024-04-28','USD'),(1087,13,'10',0,100,0,0,100,0,'2024-04-28','Paid','2024-04-28',NULL,1,'2024-05-25 14:28:21','2024-05-25 17:28:21',41,0,'2024-10-28','USD');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_types`
--

DROP TABLE IF EXISTS `item_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_itemtype_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_types`
--

LOCK TABLES `item_types` WRITE;
/*!40000 ALTER TABLE `item_types` DISABLE KEYS */;
INSERT INTO `item_types` VALUES (1,'Note Book',1),(2,'English Book - 1',1),(3,'English Book - 2',1),(4,'notebooks',2),(5,'books',2),(6,'book',5),(7,'note book',5),(8,'chairs',8),(9,'board markers',8),(10,'book',8),(11,'printer',8),(14,'Books',21),(15,'Note Book',21),(16,'Cards',21),(17,'Tution Fee',21),(18,'Note Books',NULL),(19,'Books',NULL),(22,'Note Books',33),(23,'Books',33),(24,'Note Books',34),(25,'Books',34),(30,'Note Books',38),(31,'Books',38),(36,'Note Books',41),(37,'Books',41),(38,'Note Books',42),(39,'Books',42),(40,'Note Books',43),(41,'Books',43),(42,'Note Books',44),(43,'Books',44),(44,'Note Books',45),(45,'Books',45),(46,'Note Books',46),(47,'Books',46),(48,'Note Books',47),(49,'Books',47),(52,'Note Books',49),(53,'Books',49),(54,'Note Books',50),(55,'Books',50),(56,'Note Books',51),(57,'Books',51),(58,'Note Books',52),(59,'Books',52),(60,'Note Books',53),(61,'Books',53),(62,'Note Books',54),(63,'Books',54),(64,'Note Books',55),(65,'Books',55),(66,'Note Books',56),(67,'Books',56),(68,'Note Books',57),(69,'Books',57),(70,'Note Books',58),(71,'Books',58),(72,'Note Books',60),(73,'Books',60);
/*!40000 ALTER TABLE `item_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` text DEFAULT NULL,
  `item_type_id` int(10) NOT NULL,
  `amount` int(10) DEFAULT NULL,
  `available_amount` int(10) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `purchase_price` double DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_items_item_types1` (`item_type_id`),
  KEY `fk_campus_item` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Item Description 1',1,200,143,80,70,1),(2,'Item Description 2',2,200,200,500,450,1),(3,'n1',4,200,165,50,70,2),(4,'book1',5,20,18,500,520,2),(5,'dec',6,100,94,500,450,5),(6,'desc',7,100,87,170,200,5),(7,'purchased',8,2,23,1500,1200,8),(8,'writing tools',9,3,0,360,300,8),(9,'writing tools',9,3,0,360,300,8),(10,'abdulrehman',10,3,1,500,450,8),(13,'Nursery',14,100,0,900,800,21),(14,'test inveotry',14,200,200,100,80,21),(15,'15 num',22,50,50,50,45,33),(16,'English Narrow line',36,100,92,120,100,41),(17,'narrow line',54,100,98,200,150,50),(18,'Class 1',71,1,50,125,115,58);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `money_transactions`
--

DROP TABLE IF EXISTS `money_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `money_transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` bigint(20) DEFAULT NULL,
  `transaction_type_id` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `profit_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL COMMENT 'user[id]',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transaction_type` (`transaction_type_id`),
  KEY `FK_profit` (`profit_id`),
  KEY `fk_money_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `money_transactions`
--

LOCK TABLES `money_transactions` WRITE;
/*!40000 ALTER TABLE `money_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `money_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(150) DEFAULT NULL,
  `body` text NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `campus_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (3,'dssss','sssssss','2017-01-01','2019-01-02','Published',1),(4,'s','sssssssssss','2018-03-30','2018-04-30','Published',1);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profit`
--

DROP TABLE IF EXISTS `profit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `profit_amount` decimal(10,0) DEFAULT NULL,
  `balance_amount` decimal(10,0) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `profit_date` date DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profit_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profit`
--

LOCK TABLES `profit` WRITE;
/*!40000 ALTER TABLE `profit` DISABLE KEYS */;
INSERT INTO `profit` VALUES (1,-22836,-22416,NULL,NULL,'2014-11-26',1,'2014-11-26 05:18:16',1),(2,12410,17710,NULL,NULL,'2014-11-26',7,'2014-11-26 20:12:27',5),(3,-27200,-24800,NULL,NULL,'2014-12-02',7,'2014-12-02 17:20:12',8),(4,-3500,-3500,NULL,NULL,'2014-12-09',7,'2014-12-09 06:47:34',8),(7,20,160,NULL,NULL,'2015-01-15',1,'2015-01-15 15:43:10',1),(9,2020,2160,NULL,NULL,'2015-03-29',1,'2015-03-29 20:24:27',1),(10,26160,26960,NULL,NULL,'2015-09-02',49,'2015-09-02 18:29:14',41),(12,100,400,NULL,NULL,'2015-10-27',60,'2015-10-27 09:17:57',50),(13,1000,1000,NULL,NULL,'2016-01-30',62,'2016-01-30 19:45:41',52);
/*!40000 ALTER TABLE `profit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relation_types`
--

DROP TABLE IF EXISTS `relation_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relation_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `relation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_relation` (`relation`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relation_types`
--

LOCK TABLES `relation_types` WRITE;
/*!40000 ALTER TABLE `relation_types` DISABLE KEYS */;
INSERT INTO `relation_types` VALUES (6,'Brother'),(5,'Cousin'),(2,'Father'),(3,'Mother'),(1,'Sister'),(4,'Uncle');
/*!40000 ALTER TABLE `relation_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_configurations`
--

DROP TABLE IF EXISTS `report_configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_configurations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `logo` varchar(250) DEFAULT NULL,
  `logo_width` int(2) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `header_string` varchar(250) DEFAULT NULL,
  `campus_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campus_id` (`campus_id`),
  KEY `fk_report_configuration_campuses1_idx` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_configurations`
--

LOCK TABLES `report_configurations` WRITE;
/*!40000 ALTER TABLE `report_configurations` DISABLE KEYS */;
INSERT INTO `report_configurations` VALUES (1,'https://asaanschool.com/uploads/campuses/OH/tmp/gurZjgKjtLNgEOYnA3z9-report-logo-thumb.jpg',10,'Student Details','Studens',21),(2,'https://asaanschool.com/uploads/campuses/vj/tmp/g2Kbeb7GIy8Dhufx0WV1-report-logo-thumb.jpg',20,'Myschool Name','Street 1 DHA Islamabad',41),(3,NULL,50,'Westernlink MTS','Report',52),(4,'https://asaanschool.com/uploads/campuses/ss/tmp/36eBx84qCKsQT89nAjyN-report-logo-thumb.png',30,'Title','header string',1);
/*!40000 ALTER TABLE `report_configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reverted_transactions`
--

DROP TABLE IF EXISTS `reverted_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reverted_transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) DEFAULT NULL,
  `reverted_transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reverted_transactions`
--

LOCK TABLES `reverted_transactions` WRITE;
/*!40000 ALTER TABLE `reverted_transactions` DISABLE KEYS */;
INSERT INTO `reverted_transactions` VALUES (1,4,5),(6,7,12),(7,14,16),(8,15,17),(9,18,19),(10,13,20),(11,21,22),(12,24,25),(13,26,27),(14,34,35),(15,37,38),(16,36,41),(17,51,52),(18,75,76),(19,88,89),(20,96,97);
/*!40000 ALTER TABLE `reverted_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `sub_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schools` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(100) DEFAULT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `contact_detail_id` int(10) DEFAULT NULL,
  `created_at_backup` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_school_contact_detail` (`contact_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'Ali Fida School','123',NULL,'0',1,'2014-12-10 10:21:40','2014-12-10 10:21:40','2015-07-07 18:53:18','Licenced',1),(5,'The Quest Public School','AM-191',NULL,NULL,21,'2014-12-10 10:21:40','2014-12-10 10:21:40','2015-07-07 18:53:18','Licenced',1),(13,'aligarh model public school ','ali32101',NULL,NULL,29,'2014-12-11 00:03:56','2014-12-11 00:03:56','2015-07-07 18:53:21','Licenced',1),(17,'The Quest Public School','A-191',NULL,NULL,33,'2014-12-10 10:21:40','2014-12-10 10:21:40','2015-07-07 18:53:27','Licenced',1),(18,'Al Rahber School Meelum','23301',NULL,'Main Campus',34,'2014-12-31 19:00:00','2014-12-31 19:00:00','2016-02-21 06:30:18','Licenced',1),(19,'Hazara Public School','123456',NULL,'',35,'2014-12-27 07:14:16','2014-12-27 07:14:16','2015-07-07 18:53:29','Licenced',1),(22,'GHSS Jamrud','gshah188',NULL,NULL,39,'2015-04-17 07:31:04','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(23,'Testing','123456',NULL,NULL,40,'2015-04-17 12:26:14','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(24,'Qasim Hall','Rwp_06_654',NULL,NULL,41,'2015-04-18 04:19:38','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(25,'Vision Islamic Public school ','9211',NULL,NULL,42,'2015-04-18 08:21:20','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(26,'Local Education Board','',NULL,NULL,43,'2015-04-18 12:11:38','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(28,'The TIME School and College Oghi','abc',NULL,NULL,47,'2015-04-21 14:46:15','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(29,'Edu Edge','007',NULL,NULL,50,'2015-06-17 02:35:58','2015-08-15 02:35:58','2015-08-17 06:58:46','Trail',NULL),(33,'The  Atcoms Oghi','3456',NULL,NULL,62,'2015-04-24 04:58:47','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(36,'Asaan School ','silver-001',NULL,NULL,68,'2015-04-24 06:49:24','2015-04-24 06:49:24','2015-07-07 18:53:35','Licenced',1),(37,'Merill ABD','999999999',NULL,NULL,70,'2015-05-10 16:56:58','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(38,'Haripur Ali Akbar High School','106465',NULL,NULL,72,'2015-05-31 19:35:33','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(39,'Western link Education','none',NULL,NULL,74,'2015-06-03 14:59:27','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(40,'FG high school','042',NULL,NULL,84,NULL,'2015-08-10 11:13:31','2015-08-10 16:13:31','Trail',NULL),(41,'Nazia','21',NULL,NULL,86,NULL,'2015-08-10 11:21:43','2015-08-10 16:21:43','Trail',NULL),(42,'Micro Education System','17140',NULL,NULL,88,NULL,'2015-08-12 08:07:05','2015-08-12 13:07:05','Trail',NULL),(44,'test','test',NULL,NULL,92,NULL,'2015-09-02 10:24:38','2015-09-02 15:27:11','Licenced',NULL),(45,'ICOPS','1093',NULL,NULL,94,NULL,'2015-10-27 03:35:25','2015-10-27 08:35:25','Trail',NULL),(46,'Jinnah Muslim College','123456',NULL,NULL,96,NULL,'2015-10-28 01:17:29','2015-10-28 06:17:29','Trail',NULL),(47,'Westernlink MTS','1234',NULL,NULL,98,NULL,'2016-01-28 13:40:58','2016-01-28 13:40:58','Trail',NULL),(49,'testschool123','123456789',NULL,NULL,103,NULL,'2016-04-25 16:30:26','2016-04-25 16:30:26','Trail',NULL),(50,'ABNZ','-',NULL,NULL,105,NULL,'2016-06-01 13:36:38','2016-06-01 13:36:38','Trail',NULL),(51,'western-link','123',NULL,NULL,107,NULL,'2016-06-01 21:37:14','2016-06-01 21:37:14','Trail',NULL),(52,'FitnyTech','9412',NULL,NULL,109,NULL,'2016-06-28 19:25:03','2016-06-28 19:25:03','Trail',NULL),(53,'The Leader School','1986',NULL,'',111,NULL,'2018-07-13 04:04:55','2018-07-13 13:13:16','Licenced',NULL),(54,'Test E karobar','testekarobar',NULL,NULL,113,NULL,'2021-09-11 06:31:31','2021-09-11 07:31:31','Trial',NULL),(55,'test23','test23',NULL,NULL,115,NULL,'2021-09-11 07:11:20','2021-09-11 08:11:20','Trial',NULL),(56,'school24','school24',NULL,NULL,117,NULL,'2024-05-25 14:30:36','2024-05-25 17:30:36','Trial',NULL);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_fee`
--

DROP TABLE IF EXISTS `student_fee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_fee` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fee_type_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `fee_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` varchar(10) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `paid_by` varchar(200) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_feetype_student_date` (`fee_type_id`,`student_id`,`fee_date`),
  KEY `fk_student_fee_fee_types1` (`fee_type_id`),
  KEY `fk_student_fee_students1` (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_fee`
--

LOCK TABLES `student_fee` WRITE;
/*!40000 ALTER TABLE `student_fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_items`
--

DROP TABLE IF EXISTS `student_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `payment_status` varchar(45) DEFAULT NULL,
  `due_money` double(10,0) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `issued_amount` int(10) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `paid_by` varchar(200) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_items_students1` (`student_id`),
  KEY `fk_student_items_items1` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_items`
--

LOCK TABLES `student_items` WRITE;
/*!40000 ALTER TABLE `student_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `father_name` varchar(45) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `reg_no` varchar(30) DEFAULT NULL,
  `roll_no` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `class_id` int(10) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `unroll_date` date DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `student_picture` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_classes1` (`class_id`),
  KEY `fk_campus_student` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=593 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (592,'Ahmad','ali','Ali','Male','123','1','2024-05-02','',210,'Active','2024-05-01',NULL,61,NULL,NULL,'');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_discounts`
--

DROP TABLE IF EXISTS `students_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students_discounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orignal_amount` bigint(20) DEFAULT NULL,
  `discount_amount` bigint(20) DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_Stu_discount_Transec_ID` (`transaction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_discounts`
--

LOCK TABLES `students_discounts` WRITE;
/*!40000 ALTER TABLE `students_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `students_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_guardians`
--

DROP TABLE IF EXISTS `students_guardians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students_guardians` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) NOT NULL,
  `guardian_id` int(10) NOT NULL,
  `relation_type_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uni_student_guardian` (`student_id`,`guardian_id`),
  KEY `fk_students_guardians_students1` (`student_id`),
  KEY `fk_students_guardians_guardians1` (`guardian_id`),
  KEY `fk_students_guardians_relation_types1` (`relation_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_guardians`
--

LOCK TABLES `students_guardians` WRITE;
/*!40000 ALTER TABLE `students_guardians` DISABLE KEYS */;
INSERT INTO `students_guardians` VALUES (10,10,5,2),(11,20,7,2),(13,22,9,2),(15,270,16,2),(17,419,17,4);
/*!40000 ALTER TABLE `students_guardians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_payments`
--

DROP TABLE IF EXISTS `students_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students_payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` bigint(20) DEFAULT NULL,
  `student_id` int(10) DEFAULT NULL,
  `paid_by` varchar(200) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `created_at` time DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` varchar(200) DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_payemnts` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_payments`
--

LOCK TABLES `students_payments` WRITE;
/*!40000 ALTER TABLE `students_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `students_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'English','Engslish',210);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tables`
--

DROP TABLE IF EXISTS `time_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `time_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `week_day` varchar(15) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tables`
--

LOCK TABLES `time_tables` WRITE;
/*!40000 ALTER TABLE `time_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `internal_key` varchar(100) DEFAULT NULL,
  `can_delete` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_transaction_type_inter_key` (`internal_key`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_types`
--

LOCK TABLES `transaction_types` WRITE;
/*!40000 ALTER TABLE `transaction_types` DISABLE KEYS */;
INSERT INTO `transaction_types` VALUES (1,'Students Dues Clearance','student.dues.clearance','No'),(2,'Other Expense','other.expenses','No'),(3,'Employee Salaries Paid','employee.salaries','No'),(5,'Revert Transaction','revert.transaction','No');
/*!40000 ALTER TABLE `transaction_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_campus`
--

DROP TABLE IF EXISTS `user_campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_campus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campususer_user` (`user_id`),
  KEY `fk_campususer_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_campus`
--

LOCK TABLES `user_campus` WRITE;
/*!40000 ALTER TABLE `user_campus` DISABLE KEYS */;
INSERT INTO `user_campus` VALUES (2,5,1),(3,5,2),(6,7,8),(14,15,16),(18,19,20),(19,20,21),(20,21,22),(21,22,21),(27,28,25),(28,29,26),(29,30,27),(30,31,28),(31,32,29),(33,35,33),(34,38,34),(37,47,38),(39,49,41),(40,50,42),(41,51,43),(42,52,44),(43,54,45),(44,55,46),(45,56,47),(47,59,49),(48,60,50),(49,61,51),(50,62,52),(51,63,52),(53,65,54),(54,66,55),(55,67,56),(56,68,57),(57,69,1),(58,70,58),(59,72,58),(60,73,59),(61,74,60),(62,75,61);
/*!40000 ALTER TABLE `user_campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_campus_modules`
--

DROP TABLE IF EXISTS `user_campus_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_campus_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_campus_id` int(10) DEFAULT NULL,
  `campus_module_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usercampusroles_usercampus` (`user_campus_id`),
  KEY `fk_usercampusrole_role` (`campus_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=799 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_campus_modules`
--

LOCK TABLES `user_campus_modules` WRITE;
/*!40000 ALTER TABLE `user_campus_modules` DISABLE KEYS */;
INSERT INTO `user_campus_modules` VALUES (3,2,3),(6,2,6),(7,2,7),(8,2,8),(9,2,9),(10,2,10),(11,3,11),(12,3,12),(13,3,13),(14,3,14),(15,3,15),(16,3,16),(17,3,17),(18,3,18),(19,3,19),(20,3,20),(21,6,21),(22,6,22),(23,6,23),(24,6,24),(25,6,25),(26,6,26),(27,6,27),(28,6,28),(29,6,29),(30,6,30),(31,14,31),(32,14,32),(33,14,33),(34,14,34),(35,14,35),(36,14,36),(37,14,37),(38,14,38),(39,14,39),(40,14,40),(51,18,51),(52,18,52),(53,18,53),(54,18,54),(55,18,55),(56,18,56),(57,18,57),(58,18,58),(59,18,59),(60,18,60),(686,19,70),(685,19,69),(684,19,68),(683,19,67),(682,19,66),(681,19,65),(680,19,64),(679,19,63),(678,19,62),(677,19,61),(71,20,71),(72,20,72),(73,20,73),(74,20,74),(75,20,75),(76,20,76),(77,20,77),(78,20,78),(79,20,79),(80,20,80),(81,21,62),(82,21,64),(83,21,69),(137,27,101),(138,27,102),(139,27,103),(140,27,104),(141,27,105),(142,27,106),(143,27,107),(144,27,108),(145,27,109),(146,27,110),(147,28,111),(148,28,112),(149,28,113),(150,28,114),(151,28,115),(152,28,116),(153,28,117),(154,28,118),(155,28,119),(156,28,120),(157,29,121),(158,29,122),(159,29,123),(160,29,124),(161,29,125),(162,29,126),(163,29,127),(164,29,128),(165,29,129),(166,29,130),(167,30,131),(168,30,132),(169,30,133),(170,30,134),(171,30,135),(172,30,136),(173,30,137),(174,30,138),(175,30,139),(176,30,140),(177,31,141),(178,31,142),(179,31,143),(180,31,144),(181,31,145),(182,31,146),(183,31,147),(184,31,148),(185,31,149),(186,31,150),(207,33,181),(208,33,182),(209,33,183),(210,33,184),(211,33,185),(212,33,186),(213,33,187),(214,33,188),(215,33,189),(216,33,190),(217,34,191),(218,34,192),(219,34,193),(220,34,194),(221,34,195),(222,34,196),(223,34,197),(224,34,198),(225,34,199),(226,34,200),(449,37,221),(450,37,222),(451,37,223),(452,37,224),(453,37,225),(454,37,226),(455,37,227),(456,37,228),(457,37,229),(458,37,230),(505,2,263),(506,2,264),(507,2,265),(508,2,266),(523,40,267),(524,40,268),(525,40,269),(526,40,270),(527,40,271),(528,40,272),(529,40,273),(530,40,274),(531,40,275),(532,40,276),(533,41,277),(534,41,278),(535,41,279),(536,41,280),(537,41,281),(538,41,282),(539,41,283),(540,41,284),(541,41,285),(542,41,286),(543,42,287),(544,42,288),(545,42,289),(546,42,290),(547,42,291),(548,42,292),(549,42,293),(550,42,294),(551,42,295),(552,42,296),(553,43,297),(554,43,298),(555,43,299),(556,43,300),(557,43,301),(558,43,302),(559,43,303),(560,43,304),(561,43,305),(562,43,306),(563,44,307),(564,44,308),(565,44,309),(566,44,310),(567,44,311),(568,44,312),(569,44,313),(570,44,314),(571,44,315),(572,44,316),(573,45,317),(574,45,318),(575,45,319),(576,45,320),(577,45,321),(578,45,322),(579,45,323),(580,45,324),(581,45,325),(582,45,326),(593,47,337),(594,47,338),(595,47,339),(596,47,340),(597,47,341),(598,47,342),(599,47,343),(600,47,344),(601,47,345),(602,47,346),(612,39,253),(613,39,254),(614,39,255),(615,39,256),(616,39,257),(617,39,258),(618,39,259),(619,39,260),(620,39,261),(621,39,347),(622,48,348),(623,48,349),(624,48,350),(625,48,351),(626,48,352),(627,48,353),(628,48,354),(629,48,355),(630,48,356),(631,48,357),(632,49,358),(633,49,359),(634,49,360),(635,49,361),(636,49,362),(637,49,363),(638,49,364),(639,49,365),(640,49,366),(641,49,367),(642,50,368),(643,50,369),(644,50,370),(645,50,371),(646,50,372),(647,50,373),(648,50,374),(649,50,375),(650,50,376),(651,50,377),(652,51,369),(653,51,371),(654,51,372),(655,51,373),(656,51,374),(657,52,378),(658,52,379),(659,52,380),(660,52,381),(661,52,382),(662,52,383),(663,52,384),(664,52,385),(665,52,386),(666,52,387),(667,53,388),(668,53,389),(669,53,390),(670,53,391),(671,53,392),(672,53,393),(673,53,394),(674,53,395),(675,53,396),(676,53,397),(687,19,458),(688,54,481),(689,54,482),(690,54,483),(691,54,484),(692,54,485),(693,54,486),(694,54,487),(695,54,488),(696,54,489),(697,54,490),(698,54,491),(699,55,492),(700,55,493),(701,55,494),(702,55,495),(703,55,496),(704,55,497),(705,55,498),(706,55,499),(707,55,500),(708,55,501),(709,55,502),(710,56,503),(711,56,504),(712,56,505),(713,56,506),(714,56,507),(715,56,508),(716,56,509),(717,56,510),(718,56,511),(719,56,512),(720,56,513),(721,57,3),(722,57,265),(723,58,545),(724,58,546),(725,58,547),(726,58,548),(727,58,549),(728,58,550),(729,58,551),(730,58,552),(731,58,553),(732,58,554),(733,58,555),(734,58,556),(735,59,546),(736,59,548),(737,59,553),(738,60,557),(739,60,558),(740,60,559),(741,60,560),(742,60,561),(743,60,562),(744,60,563),(745,60,564),(746,60,565),(747,60,566),(748,60,567),(749,60,568),(750,61,569),(751,61,570),(752,61,571),(753,61,572),(754,61,573),(755,61,574),(756,61,575),(757,61,576),(758,61,577),(759,61,578),(760,61,579),(761,61,580),(762,62,581),(763,62,582),(764,62,583),(765,62,584),(797,61,593),(767,62,586),(768,62,587),(769,62,588),(770,62,589),(771,62,590),(772,62,591),(773,62,592),(795,63,591),(794,63,590),(793,63,589),(792,63,588),(791,63,587),(790,63,586),(798,62,593),(788,63,584),(787,63,583),(786,63,582),(785,63,581),(796,63,592);
/*!40000 ALTER TABLE `user_campus_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_campus_roles`
--

DROP TABLE IF EXISTS `user_campus_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_campus_roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_campus_id` int(10) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usercampusroles_usercampus` (`user_campus_id`),
  KEY `fk_usercampusrole_role` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_campus_roles`
--

LOCK TABLES `user_campus_roles` WRITE;
/*!40000 ALTER TABLE `user_campus_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_campus_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `internal_key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'Admin','admin'),(2,'User','user'),(3,'Employee','employee'),(4,'Guardian','guardian'),(5,'Student','student'),(6,'Guest','guest'),(7,'Application Admin','application_admin'),(8,'School Admin','school_admin');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL COMMENT 'email as loginId',
  `password` varchar(100) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'active, inactive',
  `profile_picture` varchar(250) DEFAULT NULL,
  `contact_detail_id` int(10) DEFAULT NULL,
  `user_type_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_users_user_types1_idx` (`user_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@asaanschool.com','123','Ali Fida','Active','https://asaanschool.com/uploads/users/OO/profile-pic.jpg',1,7),(5,'alifida86@gmail.com','123','Ali','Active','https://asaanschool.com/uploads/users/OO/profile-pic.jpg',2,1),(7,'bashir.khan@ufone.blackberry.com','ABDULREHMAN','The Quest Public School','Active',NULL,NULL,1),(13,'trail@trail.trail','123','trail','Active',NULL,NULL,1),(15,'zahidkhan958@gmail.com','zahid321013','aligarh model public school ','Active',NULL,NULL,1),(19,'alamgirkha@gmail.com','alamgirkhanjee','The Quest Public School','Active',NULL,NULL,1),(20,'alrahberschool14@gmail.com','123456','Al Rahber Public School','Active',NULL,NULL,1),(21,'rabi.pts@gmail.com','123456','aps','Active',NULL,NULL,1),(22,'ksohrab76@yahoo.com','WEvJhh','Sohrab Khan','Active','https://asaanschool.com/uploads/campuses/OH/students/Ogemp-pic.jpg',NULL,3),(24,'awk_299@yahoo.com',NULL,NULL,NULL,NULL,NULL,6),(26,'amjadkarym@gmail.com','nothing123','pral','Active',NULL,NULL,1),(28,'gshah188@yahoo.com','ilovepakistan187GS','GHSS Jamrud','Active',NULL,NULL,1),(29,'visiosoft@yahoo.com','abc123','Testing','Active',NULL,NULL,1),(30,'jawad.ali84@hotmail.com','jawad_786','Qasim Hall','Active',NULL,NULL,1),(31,'vision@yahoo.com','qwert','Vision Islamic Public school ','Active',NULL,NULL,1),(32,'salmanrozik@gmail.com','namlas','Local Education Board','Active',NULL,NULL,1),(33,'hgfhgfh@fngkfd.bbbfg','123','ghgfhfg','Active',NULL,NULL,1),(34,'jjjjjjjjjjjjjj',NULL,NULL,NULL,NULL,NULL,6),(35,'iqbalalvi741@gmail.com','alvi5727987','The TIME School and College Oghi','Active',NULL,NULL,1),(38,'bilalbahadar@gmail.com','12345','Edu Edge','Active',NULL,NULL,1),(42,'bilalbahadar@hotmail.com',NULL,NULL,NULL,NULL,NULL,6),(47,'jahanatcoms@gmail.com','jahankhanarbora','The  Atcoms Oghi','Active',NULL,63,1),(49,'demo@asaanschool.com','123','Asaan School ','Active',NULL,69,1),(50,'merill@hk.net','dobadoba','Merill ABD','Active',NULL,71,1),(51,'aahighschool@gmail.com','s1y2r3u4s5','Haripur Ali Akbar High School','Active','https://asaanschool.com/uploads/users/vg/profile-pic.jpg',73,1),(52,'westernlinkedu@gmail.com','tevin333','Western link Education','Active',NULL,75,1),(53,'email@email.com',NULL,NULL,NULL,NULL,NULL,6),(54,'naziamalik1992@gmail.com','university123','FG high school','Active',NULL,85,1),(55,'nazia_malik900@yahoo.com','university123','Nazia','Active',NULL,87,1),(56,'microesys@gmail.com','Kalajadoo@123','Micro Education System','Active',NULL,89,1),(57,'asfd',NULL,NULL,NULL,NULL,NULL,6),(59,'test@test.com','123','test','Active',NULL,93,1),(60,'ismat.kakakhel@gmail.com','123456','ICOPS','Active',NULL,95,1),(61,'mnawazakhtar@gmail.com','123456','Jinnah Muslim College','Active',NULL,97,1),(62,'mark_mulier@hotmail.com','tevin333@','Westernlink MTS','Active',NULL,99,1),(63,'doris@westernlinl.nl','B0zOge','doris boo','Active',NULL,NULL,3),(65,'jarshed@gmail.com','test123','testschool123','Active',NULL,104,1),(66,'a0291847365b@gmail.com','ioarkaxi1135','ABNZ','Active',NULL,106,1),(67,'teraelectronics@gmail.com','tevin333','western-link','Active',NULL,108,1),(68,'ramandeep2390@gmail.com','qwerty123','FitnyTech','Active',NULL,110,1),(69,'teacher@khan.com','123','Teacher2 Khan2','Active',NULL,NULL,3),(70,'theleadersschoolharipur@gmail.com','Leaders@123','The Leader School','Active','https://asaanschool.com/uploads/users/v7/profile-pic.jpg',112,1),(71,'libra.waheed@gmail.com',NULL,NULL,NULL,NULL,NULL,6),(72,'theleadersschool@gmail.com','xtY4wo','Muhammad Afzal','Active',NULL,NULL,3),(73,'al.ifida86@gmail.com','window','Test E karobar','Active',NULL,114,1),(74,'ali.fida86@gmail.com','window','test23','Active',NULL,116,1),(75,'admin@school24.com','123','school24','Active',NULL,118,1),(76,'asaanschool@gmail.com',NULL,NULL,NULL,NULL,NULL,6);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_page_layouts`
--

DROP TABLE IF EXISTS `web_page_layouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_page_layouts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `layout` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_page_layouts`
--

LOCK TABLES `web_page_layouts` WRITE;
/*!40000 ALTER TABLE `web_page_layouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_page_layouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_page_post_categories`
--

DROP TABLE IF EXISTS `web_page_post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_page_post_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `layout_column` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sort_order` int(10) DEFAULT NULL,
  `post_template` int(10) DEFAULT NULL,
  `top_records` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `page_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_page_post_cat_1` (`category_id`),
  KEY `FK_page_post_cat_` (`page_id`),
  CONSTRAINT `FK_page_post_cat_` FOREIGN KEY (`page_id`) REFERENCES `web_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_page_post_cat_1` FOREIGN KEY (`category_id`) REFERENCES `web_post_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_page_post_categories`
--

LOCK TABLES `web_page_post_categories` WRITE;
/*!40000 ALTER TABLE `web_page_post_categories` DISABLE KEYS */;
INSERT INTO `web_page_post_categories` VALUES (32,'col_1',1,11,10,6,5),(46,'col_1',1,11,50,5,6);
/*!40000 ALTER TABLE `web_page_post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_pages`
--

DROP TABLE IF EXISTS `web_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) DEFAULT NULL,
  `menu_title` varchar(100) DEFAULT NULL,
  `slider_id` int(10) DEFAULT NULL,
  `html` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `website_id` int(10) DEFAULT NULL,
  `layout` varchar(100) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `page_url` varchar(300) DEFAULT NULL,
  `is_welcome_page` varchar(10) DEFAULT NULL,
  `config` text DEFAULT NULL,
  `is_default_footer` varchar(10) DEFAULT NULL,
  `footer_page_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_Page_URL` (`website_id`,`page_url`),
  KEY `FK_website_page` (`website_id`),
  KEY `FK_Footer_page` (`footer_page_id`),
  CONSTRAINT `FK_Footer_page` FOREIGN KEY (`footer_page_id`) REFERENCES `web_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_pages`
--

LOCK TABLES `web_pages` WRITE;
/*!40000 ALTER TABLE `web_pages` DISABLE KEYS */;
INSERT INTO `web_pages` VALUES (4,'Footer','Footer',NULL,'','Published','2018-03-28 12:14:32',10,'3 Columns (1:1:1)',1,'footer','0',NULL,'on',NULL),(5,' ','Home',10,'<p>A team of professionals providing the customers with the cutting end technology solutions. To k now more about us, lets click the SERVICES we provide.</p>\n\n<p>Web applications ( building innovative and interactive solutions ) some examples of the work</p>\n\n<p>Our designs define us.</p>\n\n<p>Assuring Quality by hunting bugs. Judge us by the quality not the quantity.</p>\n','Published','2018-03-28 12:16:11',10,'1 Column (100%)',1,'index','on',NULL,'0',NULL),(6,'Portfolio','Portfolio',NULL,'<p>&nbsp;&nbsp;</p>\n','Published','2019-02-07 17:31:32',10,'1 Column (100%)',1,'portfolio','0',NULL,'0',NULL);
/*!40000 ALTER TABLE `web_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_post_categories`
--

DROP TABLE IF EXISTS `web_post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_post_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `display_in_menu` varchar(10) DEFAULT NULL,
  `website_id` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `template` int(10) DEFAULT NULL,
  `footer_page_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cat_parent` (`parent_id`),
  KEY `FK_post_cat_footer_page` (`footer_page_id`),
  CONSTRAINT `FK_cat_parent` FOREIGN KEY (`parent_id`) REFERENCES `web_post_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_post_cat_footer_page` FOREIGN KEY (`footer_page_id`) REFERENCES `web_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_post_categories`
--

LOCK TABLES `web_post_categories` WRITE;
/*!40000 ALTER TABLE `web_post_categories` DISABLE KEYS */;
INSERT INTO `web_post_categories` VALUES (2,'Services','Services Description',NULL,10,NULL,NULL,NULL),(3,'UI/UX design','UI/UX design',NULL,10,2,NULL,NULL),(4,'QA','Quality Assurance',NULL,10,2,NULL,NULL),(5,'Portfolio','Portfolio',NULL,10,NULL,NULL,NULL),(6,'Home page services','',NULL,10,NULL,NULL,NULL),(7,'Web Applications','Web Applications',NULL,10,2,NULL,NULL);
/*!40000 ALTER TABLE `web_post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_post_post_categories`
--

DROP TABLE IF EXISTS `web_post_post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_post_post_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_p_post_category` (`post_id`),
  KEY `FK_post_c_post_category` (`category_id`),
  CONSTRAINT `FK_post_c_post_category` FOREIGN KEY (`category_id`) REFERENCES `web_post_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_p_post_category` FOREIGN KEY (`post_id`) REFERENCES `web_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_post_post_categories`
--

LOCK TABLES `web_post_post_categories` WRITE;
/*!40000 ALTER TABLE `web_post_post_categories` DISABLE KEYS */;
INSERT INTO `web_post_post_categories` VALUES (47,3,4),(48,3,6),(51,2,3),(52,2,6),(55,4,6),(56,4,7),(70,11,5),(72,7,5),(74,10,5),(76,8,5),(78,13,5),(80,9,5),(82,12,5),(84,6,5),(86,5,5);
/*!40000 ALTER TABLE `web_post_post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_posts`
--

DROP TABLE IF EXISTS `web_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `html` text DEFAULT NULL,
  `thumbnail_path` text DEFAULT NULL,
  `website_id` int(10) NOT NULL,
  `slug` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `publish_at` date DEFAULT NULL,
  `expire_at` date DEFAULT NULL,
  `footer_page_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_web_widgets_websites1_idx` (`website_id`),
  KEY `fk_post_footer_page_id` (`footer_page_id`),
  CONSTRAINT `fk_post_footer_page_id` FOREIGN KEY (`footer_page_id`) REFERENCES `web_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_posts`
--

LOCK TABLES `web_posts` WRITE;
/*!40000 ALTER TABLE `web_posts` DISABLE KEYS */;
INSERT INTO `web_posts` VALUES (2,'UI/UX Design','<p><strong>Simple and intuitive designs for better User experience</strong></p>\n\n<p>combining the creativity with quality and excellence is the key essence. Providing customers with high end User interface and experience stands us apart from the rest of the competitors.</p>\n\n<p>Trends are constantly evolving, and we can help you keep up. We stay ahead of new trends to bring you attractive web design, whether your existing site just needs a facelift, or you need to build from scratch a functional, mobile-responsive site that fits your brand.</p>\n\n<p>We Design keeping our customer in mind. Modern web design is more involved than creating an attractive website. Consideration of user experience, search engine optimization, ease of use, and technical details are just a few elements that are involved in developing a website that is designed to perform in today&rsquo;s competitive marketplace. Your goals are important to us, and we work with you to create the perfect design for every need.</p>\n\n<p>Here we have to give some good design themes.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/svpost.png',10,'ux-ui-design',NULL,'Published','2018-04-25 07:09:28','2018-01-01','2050-01-01',NULL),(3,'QA','<p><strong>Assuring quality at every phase to satisfy the customer needs.</strong></p>\n\n<p>We take no shortcuts. Quality is our substance. An end to end testing and quality cycles for a customer satisfaction. Right from the start till the closure, we measure quality at every level.</p>\n\n<p>Avoid future challenges by ensuring you are working with great software from the very start. Our qualified Quality Assurance and software testing team can help you be sure that the software that your business runs on works smoothly and as expected &mdash; always.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/sypost.png',10,'qa',NULL,'Published','2018-04-25 07:09:14','2018-01-01','2050-01-01',NULL),(4,'Web Applications','<p>Helping to build the brands from scratch with cost effective and secure solutions. Provding strategic solutions to move certain business activities online and create easy to manage functionality which will streamline business processes and enhance customer satisfaction. Delivering Web Applications across a wide range of technology platforms to ensure successful implementation of your business strategies and enable you to manage business with ease.</p>\n\n<p>We have established a host of effective services to facilitate the growth of your business. Including WordPress websites and ecommerce solutions focused on usability and responsive design, creative branding solutions that inject personality into your business, and custom programming for ideas that you need help bringing to fruition.</p>\n\n<p>Now here we have to put three circles or cubes indication each with ( 1. Design 2. Develop 3. Test 4.Deploy)</p>\n','https://asaanschool.com/uploads/campuses/vj/website/srpost.jpg',10,'web-applications',NULL,'Published','2018-04-25 07:09:56','2018-01-01','2050-01-01',NULL),(5,'Student management','<p>A complete student management System. Personal Details, Academic Details, Guardian information, Dues and Payments.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/sjpost.png',10,'sms',NULL,'Published','2019-02-07 17:56:27','2019-01-01','2050-01-01',NULL),(6,'Stationary & Uniform','<p>A generic system that can maintain the record of Inventory issued to students, such as Stationary or Uniforms.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/smpost.png',10,'stationary-uniform',NULL,'Published','2019-02-07 17:55:46','2019-01-01','2050-01-01',NULL),(7,'Employee management','<p>Employees management system. Employees personal details, academic details, Complete log of Current and Old employees Salaries</p>\n','https://asaanschool.com/uploads/campuses/vj/website/supost.png',10,'employee-management',NULL,'Published','2019-02-07 17:53:13','2019-01-01','2050-01-01',NULL),(8,'Fee management','<p>Complete Fee details of every Student. Custom types of Fee can be created per class, Complete log of Fee with details.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/slpost.png',10,'fee-management',NULL,'Published','2019-02-07 17:53:48','2019-01-01','2050-01-01',NULL),(9,'Profit','<p>Calculates the profit from the whole money transactions related to Student dues clearnce, School expenses.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/stpost.png',10,'profit',NULL,'Published','2019-02-07 17:54:21','2019-01-01','2050-01-01',NULL),(10,'Expenses','<p>Custom Type of expenses can be created. Complete log of expenses like, Building rent, employees salaries, Study trip etc.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/swpost.png',10,'expenses',NULL,'Published','2019-02-07 17:53:29','2019-01-01','2050-01-01',NULL),(11,'Attendance Register','<p>Daily Attendance Register where any authorized user can take attendance and can go through the old attendance simply by selecting the Date.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/s4post.png',10,'attendance-register',NULL,'Published','2019-02-07 17:52:47','2019-01-01','2050-01-01',NULL),(12,'User Management','<p>A complete User Management System, where new user can be created by Admin or any other authorized person, with rights over the campus selected modules.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/s9post.png',10,'user-management',NULL,'Published','2019-02-07 17:55:02','2019-01-01','2050-01-01',NULL),(13,'Free Website','<p>The most attractive feature, without any extra charges, totally free with maintenance &amp; support. Responsive template and user friendly interface.</p>\n','https://asaanschool.com/uploads/campuses/vj/website/sdpost.jpg',10,'free-website',NULL,'Published','2019-02-07 17:54:03','2019-01-01','2050-01-01',NULL);
/*!40000 ALTER TABLE `web_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_slider`
--

DROP TABLE IF EXISTS `web_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_slider` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `config` text DEFAULT NULL,
  `website_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_slider`
--

LOCK TABLES `web_slider` WRITE;
/*!40000 ALTER TABLE `web_slider` DISABLE KEYS */;
INSERT INTO `web_slider` VALUES (10,'Home Slider','[{\"title\":\"Scalable and interactive Web applications\",\"text\":\"Canvassing the needs of customer with colors of Technology\",\"thumbnail\":\"http:\\/\\/asaanschool.com\\/uploads\\/campuses\\/vj\\/website\\/slide_1_6276c779c1d2abb017a311a5637c5311.png\"},{\"title\":\"Responsive websites\",\"text\":\"We design Responsive web design which makes web pages render well on a variety of devices and window or screen sizes. \",\"thumbnail\":\"http:\\/\\/asaanschool.com\\/uploads\\/campuses\\/vj\\/website\\/slide_3_739ce79be696784dcc91a84f390b08ad.png\"},{\"title\":\"Visual communication and problem-solving\",\"text\":\"we create and combine symbols, images and text to form visual representations of ideas and messages.\",\"thumbnail\":\"http:\\/\\/asaanschool.com\\/uploads\\/campuses\\/vj\\/website\\/slide_4_6a923d2798dc162db827be721d7fc9fa.png\"}]',10);
/*!40000 ALTER TABLE `web_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_templates`
--

DROP TABLE IF EXISTS `web_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `thumbnail_path` varchar(250) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_templates`
--

LOCK TABLES `web_templates` WRITE;
/*!40000 ALTER TABLE `web_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_files`
--

DROP TABLE IF EXISTS `website_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `website_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file_path` text DEFAULT NULL,
  `website_id` int(10) DEFAULT NULL,
  `name` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_website_image` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_files`
--

LOCK TABLES `website_files` WRITE;
/*!40000 ALTER TABLE `website_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `website_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_menu`
--

DROP TABLE IF EXISTS `website_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `website_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `target_url` varchar(200) NOT NULL,
  `sort_order` int(3) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `website_id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `web_post_cat_id` int(10) DEFAULT NULL,
  `web_page_id` int(10) DEFAULT NULL,
  `for_user_type` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_web_menu_items_website_menus1_idx` (`website_id`),
  KEY `fk_web_menu_items_web_menu_items1_idx` (`parent_id`),
  KEY `FK_menu_post_cat` (`web_post_cat_id`),
  KEY `FK_menu_page` (`web_page_id`),
  CONSTRAINT `FK_menu_page` FOREIGN KEY (`web_page_id`) REFERENCES `web_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_menu_post_cat` FOREIGN KEY (`web_post_cat_id`) REFERENCES `web_post_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_menu`
--

LOCK TABLES `website_menu` WRITE;
/*!40000 ALTER TABLE `website_menu` DISABLE KEYS */;
INSERT INTO `website_menu` VALUES (47,'News','https://asaanschool.com/bkuc/site/pc/news/99/4/1',5,NULL,10,45,'static',NULL,NULL,NULL),(49,'Jobs','https://asaanschool.com/bkuc/job/get',5,NULL,10,45,'static',NULL,NULL,NULL),(53,'Home','index',1,NULL,10,0,'page',NULL,5,NULL),(56,'Services','services/sv',2,NULL,10,0,'postCat',2,NULL,NULL),(58,'Portfolio','portfolio',3,NULL,10,0,'page',NULL,6,NULL);
/*!40000 ALTER TABLE `website_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websites`
--

DROP TABLE IF EXISTS `websites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `websites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(200) DEFAULT NULL,
  `tag_line` varchar(200) DEFAULT NULL,
  `domain` varchar(250) DEFAULT NULL,
  `web_template_id` int(10) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  `theme_color` varchar(20) DEFAULT NULL,
  `background_color` varchar(20) DEFAULT NULL,
  `text_color` varchar(20) DEFAULT NULL,
  `menu_background_color` varchar(20) DEFAULT NULL,
  `menu_text_color` varchar(20) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_website_campus` (`campus_id`) USING BTREE,
  KEY `fk_web_template_website` (`web_template_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websites`
--

LOCK TABLES `websites` WRITE;
/*!40000 ALTER TABLE `websites` DISABLE KEYS */;
INSERT INTO `websites` VALUES (10,'','','asaanschool.com',1,41,'#fffddd','#ffffff','#000000','#dddfff','#fff','https://asaanschool.com/public/images/silverlean-lg.png');
/*!40000 ALTER TABLE `websites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'asaanschool_master'
--
/*!50003 DROP PROCEDURE IF EXISTS `new_registration_data` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`asaanschool_root`@`206.84.152.106` PROCEDURE `new_registration_data`(IN campus_id INT)
BEGIN
    INSERT INTO `item_types` (`name`,`campus_id`) 
    VALUES 
        ('Note Books', campus_id),
        ('Books', campus_id);

    INSERT INTO `fee_types` (`type`,`can_delete`,`campus_id`,`internal_key`) 
    VALUES 
        ('Admission Fee', 'Yes', campus_id, 'admission.fee'),
        ('Monthly Tuition Fee', 'Yes', campus_id, 'tution.fee'),
        ('Examination Fee', 'Yes', campus_id, 'examination.fee');

    INSERT INTO `classes` (`name`,`campus_id`) 
    VALUES 
        ('Class-1', campus_id),
        ('Class-2', campus_id),
        ('Class-3', campus_id),
        ('Class-4', campus_id),
        ('Class-5', campus_id);

    INSERT INTO class_fee (class_id, fee_type_id, amount)
    SELECT classes.id as class_id, fee_types.id as fee_type_id, 1000 AS amount 
    FROM classes, fee_types 
    WHERE classes.campus_id = campus_id
    AND fee_types.campus_id = campus_id;

    INSERT INTO `expense_type` (`type`,`campus_id`) 
    VALUES 
        ('Building Rent', campus_id),
        ('Electricity Bill', campus_id),
        ('Telephone Bill', campus_id),
        ('Study Trip', campus_id);

    INSERT INTO `employee_types` (`type`,`campus_id`) 
    VALUES 
        ('Teachers', campus_id),
        ('Support Staff', campus_id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-26 23:29:57
