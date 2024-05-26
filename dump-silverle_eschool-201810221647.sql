-- MySQL dump 10.15  Distrib 10.0.17-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: silverle_eschool
-- ------------------------------------------------------
-- Server version	10.0.17-MariaDB

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
-- Table structure for table `app_modules`
--

DROP TABLE IF EXISTS `app_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `controllers` text,
  `sort_order` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_modules`
--

LOCK TABLES `app_modules` WRITE;
/*!40000 ALTER TABLE `app_modules` DISABLE KEYS */;
INSERT INTO `app_modules` VALUES (1,'User Management','Active','Multi-type users with differnet roles on the selected modules. User friendly and easy to use.','admin,campus',1),(2,'Student Management','Active','A complete student management System. Personal Details, Academic Details, Guardian information, Dues and Payments.','student',2),(3,'Employee Management','Active','Employees management system. Employees personal details, academic details, Complete log of Current and Old employees Salaries','employee',3),(4,'Attendace','Active','Complete Attendance Register, very simple and easy to manage. For old attendance just navigate to through the calender date.','attendance,eattendance',4),(5,'Classes & Fee','Active','Complete Fee details of every Student. Custom types of Fee can be created per class, Complete log of Fee with details.','classes',5),(6,'Inventory Controle','Active','A generic system that can maintain the record of Inventory issued to students, such as Stationary or Uniforms.','inventory',6),(7,'Expenses','Active','Custom Type of expenses can be created. Complete log of expenses like, Building rent, employees salaries, Study trip etc.','expense',7),(8,'Profit Calculator','Active','Calculates the profit from the whole money transactions related to Student dues clearnce, School expenses.','profit',8),(9,'Reports','Active','Reports with configureable header and footer, with your custom logo and other format setting.','report',9),(10,'Free Custom Website','Active','You can create your free web site with in 5 mins. Latest and Responsive web templates, with free web hosting','website',10),(11,'Certificates','Active','Configureable Certificates, You can design certificates as per your requirements for employees and Students.','certificate',11),(12,'Notifications','Active','Notifications','notification',12);
/*!40000 ALTER TABLE `app_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_packages`
--

DROP TABLE IF EXISTS `app_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_packages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoice_due_period` int(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `duration_months` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_packages_price` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country` varchar(5) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `app_package_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_packages_price_fk1` (`app_package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_packages_price`
--

LOCK TABLES `app_packages_price` WRITE;
/*!40000 ALTER TABLE `app_packages_price` DISABLE KEYS */;
INSERT INTO `app_packages_price` VALUES (1,'PK','PKR',0,1),(2,'PK','PKR',3000,2),(3,'PK','PKR',15000,3),(4,'PK','PKR',30000,4),(5,'Other','USD',0,1),(6,'Other','USD',30,2),(7,'Other','USD',150,3),(8,'Other','USD',300,4);
/*!40000 ALTER TABLE `app_packages_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,'2015-02-22','P',1,'2015-02-22 04:44:30',7,NULL),(2,'2015-02-22','L',1,'2015-02-22 04:44:30',8,NULL),(3,'2015-02-22','A',1,'2015-02-22 04:44:30',9,NULL),(4,'2015-02-22','P',1,'2015-02-22 04:44:30',10,NULL),(5,'2015-02-22','A',1,'2015-02-22 04:44:30',31,NULL),(6,'2015-02-17','P',1,'2015-02-24 05:30:17',7,NULL),(7,'2015-02-17','P',1,'2015-02-24 05:30:17',8,NULL),(8,'2015-02-17','P',1,'2015-02-24 05:30:17',9,NULL),(9,'2015-02-17','P',1,'2015-02-24 05:30:17',10,NULL),(10,'2015-02-17','P',1,'2015-02-24 05:30:17',31,NULL),(11,'2015-02-25','P',1,'2015-02-24 05:30:30',3,NULL),(12,'2015-02-25','P',1,'2015-02-24 05:30:30',5,NULL),(13,'2015-04-13','P',15,'2015-04-13 01:33:20',37,NULL),(14,'2015-05-10','P',50,'2015-05-10 17:17:12',271,NULL),(15,'2015-07-28','L',15,'2015-08-27 06:28:25',37,NULL),(16,'2015-09-02','L',49,'2015-09-02 13:19:39',270,NULL),(17,'2015-09-03','A',49,'2015-09-02 13:19:47',270,NULL),(18,'2015-09-04','P',49,'2015-09-02 13:19:55',270,NULL),(19,'2015-10-27','L',60,'2015-10-27 04:08:17',275,NULL),(20,'2015-10-29','A',60,'2015-10-28 22:36:34',275,NULL),(21,'2015-11-01','P',1,'2015-10-31 17:01:54',7,NULL),(22,'2015-11-01','P',1,'2015-10-31 17:01:54',8,NULL),(23,'2015-11-01','P',1,'2015-10-31 17:01:54',9,NULL),(24,'2015-11-01','P',1,'2015-10-31 17:01:54',10,NULL),(25,'2015-11-01','P',1,'2015-10-31 17:01:54',31,NULL),(31,'2015-11-01','P',1,'2015-10-31 17:10:09',NULL,22),(32,'2015-11-01','P',1,'2015-10-31 17:10:09',NULL,18),(33,'2015-11-01','P',1,'2015-10-31 17:10:09',NULL,21),(34,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,20),(35,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,19),(36,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,5),(37,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,3),(38,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,2),(39,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,28),(40,'2015-11-01','L',1,'2015-10-31 17:10:09',NULL,6),(41,'2015-10-22','L',1,'2015-11-16 12:20:28',7,NULL),(42,'2015-10-22','L',1,'2015-11-16 12:20:28',8,NULL),(43,'2015-10-22','P',1,'2015-11-16 12:20:28',9,NULL),(44,'2015-10-22','A',1,'2015-11-16 12:20:28',10,NULL),(45,'2015-10-22','L',1,'2015-11-16 12:20:28',31,NULL),(46,'2016-01-27','L',62,'2016-01-28 14:10:30',276,NULL),(47,'2016-06-28','P',49,'2016-06-28 15:34:54',60,NULL),(48,'2016-06-28','P',49,'2016-06-28 15:34:54',61,NULL),(49,'2016-06-28','P',49,'2016-06-28 15:34:54',62,NULL),(50,'2016-06-28','P',49,'2016-06-28 15:34:54',63,NULL),(51,'2016-06-28','P',49,'2016-06-28 15:34:54',64,NULL),(52,'2016-06-28','L',49,'2016-06-28 15:34:54',69,NULL),(53,'2016-06-28','P',49,'2016-06-28 15:34:54',70,NULL),(54,'2016-06-28','P',49,'2016-06-28 15:34:54',71,NULL),(55,'2016-06-28','P',49,'2016-06-28 15:34:54',72,NULL),(56,'2016-06-28','A',49,'2016-06-28 15:34:54',73,NULL),(57,'2016-06-28','P',49,'2016-06-28 15:34:54',74,NULL),(58,'2016-06-28','A',49,'2016-06-28 15:34:54',75,NULL),(59,'2016-06-29','P',49,'2016-06-28 15:35:49',NULL,30),(60,'2016-06-29','L',49,'2016-06-28 15:35:49',NULL,33),(61,'2016-06-28','0',49,'2016-06-28 15:36:24',NULL,30),(62,'2018-02-06','A',5,'2018-02-06 06:19:18',16,NULL),(63,'2018-02-06','A',5,'2018-02-06 06:19:18',265,NULL);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus_modules`
--

DROP TABLE IF EXISTS `campus_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campus_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `campus_id` int(10) DEFAULT NULL,
  `module_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_campus_module_campus` (`campus_id`),
  KEY `FK_campus_module_module` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=443 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_modules`
--

LOCK TABLES `campus_modules` WRITE;
/*!40000 ALTER TABLE `campus_modules` DISABLE KEYS */;
INSERT INTO `campus_modules` VALUES (3,1,3),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,2,1),(12,2,2),(13,2,3),(14,2,4),(15,2,5),(16,2,6),(17,2,7),(18,2,8),(19,2,9),(20,2,10),(21,8,1),(22,8,2),(23,8,3),(24,8,4),(25,8,5),(26,8,6),(27,8,7),(28,8,8),(29,8,9),(30,8,10),(31,16,1),(32,16,2),(33,16,3),(34,16,4),(35,16,5),(36,16,6),(37,16,7),(38,16,8),(39,16,9),(40,16,10),(51,20,1),(52,20,2),(53,20,3),(54,20,4),(55,20,5),(56,20,6),(57,20,7),(58,20,8),(59,20,9),(60,20,10),(61,21,1),(62,21,2),(63,21,3),(64,21,4),(65,21,5),(66,21,6),(67,21,7),(68,21,8),(69,21,9),(70,21,10),(71,22,1),(72,22,2),(73,22,3),(74,22,4),(75,22,5),(76,22,6),(77,22,7),(78,22,8),(79,22,9),(80,22,10),(101,25,1),(102,25,2),(103,25,3),(104,25,4),(105,25,5),(106,25,6),(107,25,7),(108,25,8),(109,25,9),(110,25,10),(111,26,1),(112,26,2),(113,26,3),(114,26,4),(115,26,5),(116,26,6),(117,26,7),(118,26,8),(119,26,9),(120,26,10),(121,27,1),(122,27,2),(123,27,3),(124,27,4),(125,27,5),(126,27,6),(127,27,7),(128,27,8),(129,27,9),(130,27,10),(131,28,1),(132,28,2),(133,28,3),(134,28,4),(135,28,5),(136,28,6),(137,28,7),(138,28,8),(139,28,9),(140,28,10),(141,29,1),(142,29,2),(143,29,3),(144,29,4),(145,29,5),(146,29,6),(147,29,7),(148,29,8),(149,29,9),(150,29,10),(181,33,1),(182,33,2),(183,33,3),(184,33,4),(185,33,5),(186,33,6),(187,33,7),(188,33,8),(189,33,9),(190,33,10),(191,34,1),(192,34,2),(193,34,3),(194,34,4),(195,34,5),(196,34,6),(197,34,7),(198,34,8),(199,34,9),(200,34,10),(221,38,1),(222,38,2),(223,38,3),(224,38,4),(225,38,5),(226,38,6),(227,38,7),(228,38,8),(229,38,9),(230,38,10),(253,41,1),(254,41,2),(255,41,3),(256,41,4),(257,41,5),(258,41,6),(259,41,7),(260,41,8),(261,41,9),(263,1,1),(264,1,2),(265,1,4),(266,1,5),(267,42,1),(268,42,2),(269,42,3),(270,42,4),(271,42,5),(272,42,6),(273,42,7),(274,42,8),(275,42,9),(276,42,10),(277,43,1),(278,43,2),(279,43,3),(280,43,4),(281,43,5),(282,43,6),(283,43,7),(284,43,8),(285,43,9),(286,43,10),(287,44,1),(288,44,2),(289,44,3),(290,44,4),(291,44,5),(292,44,6),(293,44,7),(294,44,8),(295,44,9),(296,44,10),(297,45,1),(298,45,2),(299,45,3),(300,45,4),(301,45,5),(302,45,6),(303,45,7),(304,45,8),(305,45,9),(306,45,10),(307,46,1),(308,46,2),(309,46,3),(310,46,4),(311,46,5),(312,46,6),(313,46,7),(314,46,8),(315,46,9),(316,46,10),(317,47,1),(318,47,2),(319,47,3),(320,47,4),(321,47,5),(322,47,6),(323,47,7),(324,47,8),(325,47,9),(326,47,10),(337,49,1),(338,49,2),(339,49,3),(340,49,4),(341,49,5),(342,49,6),(343,49,7),(344,49,8),(345,49,9),(346,49,10),(347,41,10),(348,50,1),(349,50,2),(350,50,3),(351,50,4),(352,50,5),(353,50,6),(354,50,7),(355,50,8),(356,50,9),(357,50,10),(358,51,1),(359,51,2),(360,51,3),(361,51,4),(362,51,5),(363,51,6),(364,51,7),(365,51,8),(366,51,9),(367,51,10),(368,52,1),(369,52,2),(370,52,3),(371,52,4),(372,52,5),(373,52,6),(374,52,7),(375,52,8),(376,52,9),(377,52,10),(378,53,1),(379,53,2),(380,53,3),(381,53,4),(382,53,5),(383,53,6),(384,53,7),(385,53,8),(386,53,9),(387,53,10),(388,54,1),(389,54,2),(390,54,3),(391,54,4),(392,54,5),(393,54,6),(394,54,7),(395,54,8),(396,54,9),(397,54,10),(402,1,11),(403,2,11),(404,8,11),(405,16,11),(406,20,11),(407,21,11),(408,22,11),(409,25,11),(410,26,11),(411,27,11),(412,28,11),(413,29,11),(414,33,11),(415,34,11),(416,38,11),(441,41,11),(418,42,11),(419,43,11),(420,44,11),(421,45,11),(422,46,11),(423,47,11),(424,49,11),(425,50,11),(426,51,11),(427,52,11),(428,53,11),(429,54,11),(430,55,1),(431,55,2),(432,55,3),(433,55,4),(434,55,5),(435,55,6),(436,55,7),(437,55,8),(438,55,9),(439,55,10),(440,55,11),(442,55,12);
/*!40000 ALTER TABLE `campus_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus_packages`
--

DROP TABLE IF EXISTS `campus_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus_packages`
--

LOCK TABLES `campus_packages` WRITE;
/*!40000 ALTER TABLE `campus_packages` DISABLE KEYS */;
INSERT INTO `campus_packages` VALUES (1,1,1,'2014-10-04 12:49:33','2015-04-12 19:21:46','Active','Inactivated by system, with the selection of package at : 2015-04-12 19:21:46',1),(2,1,2,'2015-04-12 00:00:00','2015-06-19 07:03:50','In Active','Inactivated by system, with the selection of package at : 2015-06-19 07:03:50',1),(3,1,3,'2015-06-19 00:00:00',NULL,'Active','done on request',1),(4,21,1,'2015-09-02 00:00:00',NULL,'Active','',1),(5,16,1,'2015-09-02 00:00:00',NULL,'Active','',1),(6,22,1,'2015-09-02 00:00:00',NULL,'Active','',1),(7,5,1,'2015-09-02 00:00:00',NULL,'Active','',1),(8,20,1,'2015-09-02 00:00:00',NULL,'Active','',1),(10,49,2,'2015-09-02 00:00:00','2015-09-02 15:27:42','In Active','Inactivated by system, with the selection of package at : 2015-09-02 15:27:42',1),(11,49,1,'2015-09-02 00:00:00','2015-09-02 15:36:28','In Active','Inactivated by system, with the selection of package at : 2015-09-02 15:36:28',1),(12,49,2,'2015-09-02 00:00:00',NULL,'Active','asdfasdf',1),(13,41,3,'2015-10-28 00:00:00','2016-06-28 19:18:44','In Active','Inactivated by system, with the selection of package at : 2016-06-28 19:18:44',1),(14,41,1,'2016-06-28 00:00:00',NULL,'Active','',1),(15,55,4,'2018-03-12 00:00:00',NULL,'Active','fff',1);
/*!40000 ALTER TABLE `campus_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campuses`
--

DROP TABLE IF EXISTS `campuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campuses`
--

LOCK TABLES `campuses` WRITE;
/*!40000 ALTER TABLE `campuses` DISABLE KEYS */;
INSERT INTO `campuses` VALUES (1,'Abbottabad Campus','http://e-karobar.com/uploads/users/OO/profile-pic.jpg',1,NULL,1),(2,'Mansehra Campus',NULL,1,NULL,4),(5,'s4',NULL,5,NULL,5),(8,'The Quest Public School',NULL,5,NULL,21),(16,'aligarh model public school ',NULL,13,NULL,29),(20,'The Quest Public School',NULL,17,NULL,33),(21,'Al Rahber School Meelum','http://e-karobar.com/uploads/campuses/OH/campus-logo.jpg',18,NULL,34),(22,'Hazara Public School',NULL,19,NULL,35),(25,'GHSS Jamrud',NULL,22,NULL,39),(26,'Testing',NULL,23,NULL,40),(27,'Qasim Hall',NULL,24,NULL,41),(28,'Vision Islamic Public school ',NULL,25,NULL,42),(29,'Local Education Board',NULL,26,NULL,43),(33,'The TIME School and College Oghi',NULL,28,NULL,47),(34,'Edu Edge',NULL,29,NULL,50),(38,'The  Atcoms Oghi',NULL,33,NULL,62),(41,'E-karobar School',NULL,36,NULL,68),(42,'Merill ABD',NULL,37,NULL,70),(43,'Haripur Ali Akbar High School',NULL,38,NULL,72),(44,'Western link Education',NULL,39,NULL,74),(45,'FG high school',NULL,40,NULL,84),(46,'Nazia',NULL,41,NULL,86),(47,'Micro Education System',NULL,42,NULL,88),(49,'test',NULL,44,NULL,92),(50,'ICOPS',NULL,45,NULL,94),(51,'Jinnah Muslim College',NULL,46,NULL,96),(52,'Westernlink MTS',NULL,47,NULL,98),(54,'mytest',NULL,49,NULL,103),(55,'Ali Fida',NULL,50,NULL,105);
/*!40000 ALTER TABLE `campuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `page_size` varchar(20) DEFAULT NULL,
  `margins` varchar(20) DEFAULT NULL,
  `linked_with` int(5) DEFAULT NULL COMMENT '1=student, 2=employee',
  `contents` text,
  `campus_id` int(10) DEFAULT NULL,
  `background_image` varchar(250) DEFAULT NULL,
  `watermark` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
INSERT INTO `certificates` VALUES (1,'Employee Certificate','Description updated','500,700',NULL,2,'<p style=\"text-align:center\"><span style=\"font-size:11px\">&nbsp; &nbsp;</span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-family:comic sans ms,cursive\"><span style=\"font-size:28px\">Bellevue Community College</span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:36px\"><em><span style=\"font-family:comic sans ms,cursive\">&nbsp;</span><u><span style=\"font-family:comic sans ms,cursive\">Continuing Education</span></u></em></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-family:comic,cursive\"><span style=\"font-size:24px\">Bellevue, Washington<img alt=\"\" src=\"{@em_picture@}\" style=\"float:right; height:100px; width:80px\" /></span></span></p>\r\n\r\n<p style=\"text-align:center\"><strong><span style=\"font-family:times new roman,times,serif\"><em><span style=\"font-size:36px\">Certificate of Completion</span></em></span></strong></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><em><span style=\"font-family:times new roman,times,serif\">This is to certify that</span></em></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:tahoma,geneva,sans-serif\"><u><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{@em_first_name@}&nbsp;{@em_last_name@}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></u></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:times new roman,times,serif\"><em>has satisfactorily completed a course entitled&nbsp;</em></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:tahoma,geneva,sans-serif\"><u><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;World Wide Web Authoring &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></u></span></span></p>\r\n\r\n<p style=\"text-align:center\"><em><span style=\"font-family:verdana,geneva,sans-serif\"><u><strong>&nbsp; &nbsp;<span style=\"font-size:18px\"> &nbsp; &nbsp; Fall &nbsp; &nbsp; &nbsp;</span></strong></u></span></em><span style=\"font-size:18px\"><span style=\"font-family:courier new,courier,monospace\"> quarter&nbsp;</span><u><strong><span style=\"font-family:verdana,geneva,sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;1997 &nbsp; &nbsp;&nbsp;</span></strong></u></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></p>\r\n\r\n<p><span style=\"font-size:14px\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dean of Continuing Education &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Instructor</span></p>\r\n',1,'http://localhost/e-karobar/uploads/campuses/ss/certificates/certificate-background.png','http://localhost/e-karobar/uploads/campuses/ss/certificates/certificate-watermark.jpg'),(2,'Student Certificate','School Leaving Certificate',NULL,NULL,1,'<p style=\"text-align:center\"><span style=\"font-size:11px\">&nbsp; &nbsp;</span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-family:comic sans ms,cursive\"><span style=\"font-size:28px\">Bellevue Community College</span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:36px\"><em><span style=\"font-family:comic sans ms,cursive\">&nbsp;</span><u><span style=\"font-family:comic sans ms,cursive\">Continuing Education</span></u></em></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-family:comic,cursive\"><span style=\"font-size:24px\">Bellevue, Washington<img alt=\"\" src=\"{@st_picture@}\" style=\"float:right; height:100px; width:80px\" /></span></span></p>\r\n\r\n<p style=\"text-align:center\"><strong><span style=\"font-family:times new roman,times,serif\"><em><span style=\"font-size:36px\">Certificate of Completion</span></em></span></strong></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><em><span style=\"font-family:times new roman,times,serif\">This is to certify that</span></em></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:tahoma,geneva,sans-serif\"><u><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{@st_first_name@}&nbsp;{@st_last_name@} &nbsp;S/O{@st_father_name@} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></u></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:times new roman,times,serif\"><em>has satisfactorily completed a course entitled&nbsp;</em></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:tahoma,geneva,sans-serif\"><u><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;World Wide Web Authoring &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></u></span></span></p>\r\n\r\n<p style=\"text-align:center\"><em><span style=\"font-family:verdana,geneva,sans-serif\"><u><strong>&nbsp; &nbsp;<span style=\"font-size:18px\"> &nbsp; &nbsp; Fall &nbsp; &nbsp; &nbsp;</span></strong></u></span></em><span style=\"font-size:18px\"><span style=\"font-family:courier new,courier,monospace\"> quarter&nbsp;</span><u><strong><span style=\"font-family:verdana,geneva,sans-serif\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;1997 &nbsp; &nbsp;&nbsp;</span></strong></u></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></p>\r\n\r\n<p><span style=\"font-size:14px\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dean of Continuing Education &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Instructor</span></p>\r\n',1,NULL,NULL),(3,'School leaving','school leaving desc',NULL,NULL,1,'<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style=\"font-style: italic; text-align: center;\"><span style=\"font-size:18px\">{@st_first_name@} is going to leave the school</span></h2>\r\n\r\n<h2 style=\"font-style:italic;\">&nbsp;</h2>\r\n',41,'http://localhost/e-karobar/uploads/campuses/vj/certificates/certificate-background.png',NULL);
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_fee`
--

DROP TABLE IF EXISTS `class_fee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_fee` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `fee_type_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_fee_type_1` (`fee_type_id`),
  KEY `FK_class_1` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=407 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_fee`
--

LOCK TABLES `class_fee` WRITE;
/*!40000 ALTER TABLE `class_fee` DISABLE KEYS */;
INSERT INTO `class_fee` VALUES (1,1500,1,1),(2,2000,2,1),(3,2200,3,1),(6,2500,4,1),(7,2800,5,1),(8,3000,6,1),(9,3200,7,1),(10,3500,8,1),(13,2000,1,3),(14,1200,10,4),(15,1500,11,4),(16,2000,12,4),(18,2500,15,7),(19,10000,15,8),(20,2000,21,32),(21,1500,21,31),(27,1500,33,57),(28,1000,34,57),(29,1200,35,57),(30,1200,36,57),(31,1300,37,57),(32,1300,38,57),(33,1400,39,57),(34,1400,40,57),(35,1600,41,57),(406,99999,42,106),(37,350,43,47),(38,350,44,47),(39,500,43,48),(40,500,50,60),(41,800,51,60),(42,1000,52,60),(43,1200,53,60),(44,1400,54,60),(45,1600,55,60),(46,1800,56,60),(47,2000,57,60),(48,2200,58,60),(49,2400,59,60),(66,1000,71,84),(67,1000,72,84),(68,1000,73,84),(69,1000,74,84),(70,1000,75,84),(71,1000,71,85),(72,1000,72,85),(73,1000,73,85),(74,1000,74,85),(75,1000,75,85),(76,1000,71,86),(77,1000,72,86),(78,1000,73,86),(79,1000,74,86),(80,1000,75,86),(81,1000,76,87),(82,1000,77,87),(83,1000,78,87),(84,1000,79,87),(85,1000,80,87),(86,1000,76,88),(87,1000,77,88),(88,1000,78,88),(89,1000,79,88),(90,1000,80,88),(91,1000,76,89),(92,1000,77,89),(93,1000,78,89),(94,1000,79,89),(95,1000,80,89),(111,100,1,93),(127,1000,91,97),(128,1000,92,97),(129,1000,93,97),(130,1000,94,97),(131,1000,95,97),(132,1000,91,98),(133,1000,92,98),(134,1000,93,98),(135,1000,94,98),(136,1000,95,98),(137,1000,91,99),(138,1000,92,99),(139,1000,93,99),(140,1000,94,99),(141,1000,95,99),(172,1000,106,106),(173,5000,107,106),(174,50000,108,106),(175,1000,109,106),(176,1000,110,106),(177,1000,106,107),(178,1000,107,107),(179,8000,108,107),(180,1000,109,107),(181,1000,110,107),(182,1000,106,108),(183,1000,107,108),(184,1000,108,108),(185,1000,109,108),(186,1000,110,108),(187,200,106,109),(189,1000,112,110),(190,1000,113,110),(191,1000,114,110),(192,1000,115,110),(193,1000,116,110),(194,1000,112,111),(195,1000,113,111),(196,1000,114,111),(197,1000,115,111),(198,1000,116,111),(199,1000,112,112),(200,1000,113,112),(201,1000,114,112),(202,1000,115,112),(203,1000,116,112),(204,500,117,113),(205,500,118,113),(206,1000,119,113),(207,1000,120,113),(208,500,121,113),(209,60,117,114),(210,80,118,114),(211,1000,119,114),(212,1000,120,114),(213,1000,121,114),(214,225,117,115),(215,250,118,115),(216,1000,119,115),(217,1000,120,115),(218,1000,121,115),(219,350,122,116),(220,350,123,116),(221,350,124,116),(222,350,125,116),(223,350,126,116),(224,1000,122,117),(225,1000,123,117),(226,1000,124,117),(227,1000,125,117),(228,1000,126,117),(229,1000,122,118),(230,1000,123,118),(231,1000,124,118),(232,1000,125,118),(233,1000,126,118),(234,1000,127,119),(235,1000,128,119),(236,1000,129,119),(237,1000,130,119),(238,1000,131,119),(239,1000,127,120),(240,1000,128,120),(241,1000,129,120),(242,1000,130,120),(243,1000,131,120),(244,1000,127,121),(245,1000,128,121),(246,1000,129,121),(247,1000,130,121),(248,1000,131,121),(249,1000,132,122),(250,1000,133,122),(251,1000,134,122),(252,1000,135,122),(253,1000,136,122),(254,1000,132,123),(255,1000,133,123),(256,1000,134,123),(257,1000,135,123),(258,1000,136,123),(259,1000,132,124),(260,1000,133,124),(261,1000,134,124),(262,1000,135,124),(263,1000,136,124),(264,1000,137,125),(265,1000,138,125),(266,1000,139,125),(267,1000,140,125),(268,1000,141,125),(269,1000,137,126),(270,1000,138,126),(271,1000,139,126),(272,1000,140,126),(273,1000,141,126),(274,1000,137,127),(275,1000,138,127),(276,1000,139,127),(277,1000,140,127),(278,1000,141,127),(294,1000,147,131),(295,1000,148,131),(296,1000,149,131),(297,1000,150,131),(298,1000,151,131),(299,1000,147,132),(300,1000,148,132),(301,1000,149,132),(302,1000,150,132),(303,1000,151,132),(304,1000,147,133),(305,1000,148,133),(306,1000,149,133),(307,1000,150,133),(308,1000,151,133),(309,1000,152,135),(310,1000,153,135),(311,1000,154,135),(312,1000,155,135),(313,1000,156,135),(314,1000,152,136),(315,1000,153,136),(316,1000,154,136),(317,1000,155,136),(318,1000,156,136),(319,1000,152,137),(320,1000,153,137),(321,1000,154,137),(322,1000,155,137),(323,1000,156,137),(324,3000,152,138),(325,1000,157,139),(326,1000,158,139),(327,1000,159,139),(328,1000,160,139),(329,1000,161,139),(330,1000,157,140),(331,1000,158,140),(332,1000,159,140),(333,1000,160,140),(334,1000,161,140),(335,1000,157,141),(336,1000,158,141),(337,1000,159,141),(338,1000,160,141),(339,1000,161,141),(340,0,162,142),(341,0,163,142),(342,0,164,142),(343,0,165,142),(344,0,166,142),(345,350,162,143),(346,350,163,143),(347,350,164,143),(348,4,165,143),(349,350,166,143),(350,4,162,144),(351,4,163,144),(352,4,164,144),(353,4,165,144),(354,4,166,144),(357,1000,167,146),(358,1000,168,146),(359,1000,169,146),(360,1000,170,146),(361,1000,171,146),(362,1000,167,147),(363,1000,168,147),(364,1000,169,147),(365,1000,170,147),(366,1000,171,147),(367,1000,167,148),(368,1000,168,148),(369,1000,169,148),(370,1000,170,148),(371,1000,171,148),(372,2000,33,58),(373,500,33,149),(374,1000,33,150),(375,1000,174,153),(376,1000,174,154),(377,1000,174,155),(378,1000,175,153),(379,1000,175,154),(380,1000,175,155),(381,1000,176,153),(382,1000,176,154),(383,1000,176,155),(384,1000,177,153),(385,1000,177,154),(386,1000,177,155),(387,1000,178,153),(388,1000,178,154),(389,1000,178,155),(390,1000,179,156),(391,1000,180,156),(392,1000,181,156),(393,1000,182,156),(394,1000,183,156),(395,1000,179,157),(396,1000,180,157),(397,1000,181,157),(398,1000,182,157),(399,1000,183,157),(400,1000,179,158),(401,1000,180,158),(402,1000,181,158),(403,1000,182,158),(404,1000,183,158),(405,2147483647,106,106);
/*!40000 ALTER TABLE `class_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_class_campus` (`campus_id`),
  KEY `UK_class_campus` (`name`,`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=185 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (45,'1st',16),(46,'2nd',16),(47,'3rd',16),(48,'4th',16),(49,'5th',16),(40,'6th',21),(41,'7th',21),(42,'Prep',41),(17,'c1',5),(15,'C2',5),(59,'Class 10th',22),(21,'Class 1st',8),(50,'Class 1st',22),(22,'Class 2nd',8),(51,'Class 2nd',22),(23,'Class 3rd',8),(52,'Class 3rd',22),(24,'Class 4th',8),(53,'Class 4th',22),(25,'Class 5th',8),(54,'Class 5th',22),(26,'Class 6th',8),(55,'Class 6th',22),(27,'Class 7th',8),(56,'Class 7th',22),(57,'Class 8th',22),(58,'Class 9th',22),(1,'Class-1',1),(71,'Class-1',33),(76,'Class-1',34),(91,'Class-1',38),(106,'Class-1',41),(112,'Class-1',42),(127,'Class-1',45),(132,'Class-1',46),(137,'Class-1',47),(147,'Class-1',49),(157,'Class-1',51),(121,'Class-10',43),(2,'Class-2',1),(72,'Class-2',33),(77,'Class-2',34),(92,'Class-2',38),(107,'Class-2',41),(113,'Class-2',42),(128,'Class-2',45),(133,'Class-2',46),(138,'Class-2',47),(148,'Class-2',49),(153,'Class-2',50),(158,'Class-2',51),(3,'Class-3',1),(73,'Class-3',33),(78,'Class-3',34),(93,'Class-3',38),(108,'Class-3',41),(114,'Class-3',42),(129,'Class-3',45),(134,'Class-3',46),(139,'Class-3',47),(149,'Class-3',49),(154,'Class-3',50),(159,'Class-3',51),(4,'Class-4',1),(74,'Class-4',33),(79,'Class-4',34),(94,'Class-4',38),(109,'Class-4',41),(115,'Class-4',42),(130,'Class-4',45),(135,'Class-4',46),(140,'Class-4',47),(150,'Class-4',49),(155,'Class-4',50),(160,'Class-4',51),(5,'Class-5',1),(75,'Class-5',33),(80,'Class-5',34),(95,'Class-5',38),(110,'Class-5',41),(116,'Class-5',42),(131,'Class-5',45),(136,'Class-5',46),(141,'Class-5',47),(151,'Class-5',49),(156,'Class-5',50),(161,'Class-5',51),(6,'Class-6',1),(117,'Class-6',43),(7,'Class-7',1),(118,'Class-7',43),(8,'Class-8',1),(119,'Class-8',43),(9,'class-9',1),(120,'Class-9',43),(10,'class1',2),(11,'class2',2),(12,'class3',2),(122,'CRECHE',44),(39,'Fifth',21),(38,'Fourth',21),(125,'KG-1',44),(126,'KG-2',44),(123,'LO.NU',44),(152,'my-Class-1',50),(19,'Nursery',8),(43,'Nursery',16),(33,'Nursery',21),(35,'One',21),(18,'Play Group',8),(20,'Prep',8),(44,'Prep',16),(34,'Prep',21),(37,'Third',21),(36,'Two',21),(124,'UP.NU',44),(162,'LO.NU',52),(163,'UP.NU',52),(164,'KG-1',52),(165,'KG-2',52),(166,'KG-3',52),(173,'10th ',21),(172,'9th',21),(174,'Class-1',54),(175,'Class-2',54),(176,'Class-3',54),(177,'Class-4',54),(178,'Class-5',54),(179,'Class-1',55),(180,'Class-2',55),(181,'Class-3',55),(182,'Class-4',55),(183,'Class-5',55),(184,'new class',41);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_details`
--

LOCK TABLES `contact_details` WRITE;
/*!40000 ALTER TABLE `contact_details` DISABLE KEYS */;
INSERT INTO `contact_details` VALUES (1,'12345622222','12345625233333','123456555555','Abbottabad','KPK','Pakistan','123456','Abbottabad','alifida86@gmail.com','',''),(2,'12345625233333','12345625233333','12345625233333','Islamabad','Fedhral','Pakistan','123456','Islamabad','admin@e-karobar.com',NULL,NULL),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'e-karobar@gmail.com',NULL,NULL),(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'s3@gmail.com',NULL,NULL),(5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'s4@gmail.com',NULL,NULL),(6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bbb@bbb.com',NULL,NULL),(7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bbbbb@bb.com',NULL,NULL),(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qqq@qqq.vcom',NULL,NULL),(9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qqq@qqq.vcom',NULL,NULL),(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aaa@sss.hyy',NULL,NULL),(11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aaa@sss.hyy',NULL,NULL),(12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'asdf@asdf.com',NULL,NULL),(13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dfasdf@asdf.com',NULL,NULL),(14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'asdf@asdf.com',NULL,NULL),(15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'dfasdf@asdf.com',NULL,NULL),(16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'asdf@asdf.com',NULL,NULL),(17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ntew@email.com',NULL,NULL),(18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aaaa@aaa.com',NULL,NULL),(19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bashir.khan@ufone.blackberry.com',NULL,NULL),(20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bashir.khan@ufone.com.pk',NULL,NULL),(21,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bashir.khan@ufone.blackberrry.com',NULL,NULL),(22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali@ali.com',NULL,NULL),(24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ii@ii.com',NULL,NULL),(25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'oo@oo.oo',NULL,NULL),(26,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali@ali.comm',NULL,NULL),(27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'trail@trail.trail',NULL,NULL),(28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'tt@tt.com',NULL,NULL),(29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zahidkhan958@gmail.com',NULL,NULL),(30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'abc@gmail.com',NULL,NULL),(31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'oghi@oghi.com',NULL,NULL),(32,'03332366360','','','Abbottabad','Pakistan',NULL,'7500','Jamia Masjid Bilal town, AbbottABAD','bashir.khan@ufone.blackberry.com','',''),(33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alamgirkha@gmail.com',NULL,NULL),(34,'0995351255','','','Haripur','KPK',NULL,'22620','KPK','alrahberschool14@gmail.com','','www.alrehberschool.com'),(35,'03345708175','','','Mansehra','KPK',NULL,'21300','Mansehra','rabi.pts@gmail.com','',''),(36,'09923332366360','','','Abbottabad','Pakistan',NULL,'35410','Kakoul Road Abbottabad',NULL,'',''),(37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'amjadkarym@gmail.com',NULL,NULL),(38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(39,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'gshah188@yahoo.com',NULL,NULL),(40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'visiosoft@yahoo.com',NULL,NULL),(41,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jawad.ali84@hotmail.com',NULL,NULL),(42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'vision@yahoo.com',NULL,NULL),(43,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'salmanrozik@gmail.com',NULL,NULL),(44,'777777788888','','','88888','88888',NULL,'8880','888888888888888888','hgfhgfh@fngkfd.bbbfg','',''),(45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida@ali.com',NULL,NULL),(46,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida@ali2.com',NULL,NULL),(47,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'iqbalalvi741@gmail.com',NULL,NULL),(48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali@ali33.com',NULL,NULL),(49,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'info@e-karobar.com',NULL,NULL),(50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bilalbahadar@gmail.com',NULL,NULL),(51,'+92-345-9485678','+92-345-9635275','','Oghi','KPK',NULL,'21400','Takia Chowk Tariq Road Oghi',NULL,'',''),(58,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'info@e-karobar.com',NULL,NULL),(59,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'info@e-karobar.com',NULL,NULL),(60,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@e-karobar.com',NULL,NULL),(61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@e-karobar.com',NULL,NULL),(62,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jahanatcoms@gmail.com',NULL,NULL),(63,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'jahanatcoms@gmail.com',NULL,NULL),(64,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@e-karobar.com',NULL,NULL),(65,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@e-karobar.com',NULL,NULL),(66,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@e-karobar.com',NULL,NULL),(67,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@e-karobar.com',NULL,NULL),(68,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@e-karobar.com',NULL,NULL),(69,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demo@e-karobar.com',NULL,NULL),(70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'merill@hk.net',NULL,NULL),(71,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'merill@hk.net',NULL,NULL),(72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aahighschool@gmail.com',NULL,NULL),(73,'01712202145','01815456072','','Feni','Bangladesh',NULL,'39133913','Purba Shilua, Chhagalnaiya, Feni','aahighschool@gmail.com','','haahs.comillaboard.gov.bd'),(74,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'westernlinkedu@gmail.com',NULL,NULL),(75,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'westernlinkedu@gmail.com',NULL,NULL),(76,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(77,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(78,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(79,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alifida.86@gmail.com',NULL,NULL),(80,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(81,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(82,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(83,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ali.fida@pral.com.pk',NULL,NULL),(84,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'naziamalik1992@gmail.com',NULL,NULL),(85,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'naziamalik1992@gmail.com',NULL,NULL),(86,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nazia_malik900@yahoo.com',NULL,NULL),(87,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nazia_malik900@yahoo.com',NULL,NULL),(88,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'microesys@gmail.com',NULL,NULL),(89,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'microesys@gmail.com',NULL,NULL),(90,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(91,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(92,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(93,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@test.com',NULL,NULL),(94,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ismat.kakakhel@gmail.com',NULL,NULL),(95,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ismat.kakakhel@gmail.com',NULL,NULL),(96,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mnawazakhtar@gmail.com',NULL,NULL),(97,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mnawazakhtar@gmail.com',NULL,NULL),(98,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mark_mulier@hotmail.com',NULL,NULL),(99,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mark_mulier@hotmail.com',NULL,NULL),(100,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'alrahberschool14@gmail.com',NULL,NULL),(101,'03155686341','','','Haripur','kpk',NULL,'24620','Dhindha Haripur','alrahberschool14@gmail.com','',''),(102,'092995351255','','','Meelum Haripur','Pakistan',NULL,'24620','Meelum',NULL,'',''),(103,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'my@test.com',NULL,NULL),(104,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'my@test.com',NULL,NULL),(105,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'email@emaiol.com',NULL,NULL),(106,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'email@emaiol.com',NULL,NULL);
/*!40000 ALTER TABLE `contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countires_ip`
--

DROP TABLE IF EXISTS `countires_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countires_ip` (
  `start_ip` char(15) NOT NULL,
  `end_ip` char(15) NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `cc` char(2) NOT NULL,
  `cn` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_attachments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email_id` int(10) DEFAULT NULL,
  `attachment_path` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_email_attachments_1_idx` (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email_id` int(10) DEFAULT NULL,
  `email_type_id` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT '' COMMENT 'Unread,Trash, Important',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_users`
--

LOCK TABLES `email_users` WRITE;
/*!40000 ALTER TABLE `email_users` DISABLE KEYS */;
INSERT INTO `email_users` VALUES (11,10,2,'','2015-02-24 13:32:39',NULL,NULL,5,5,5),(12,17,2,'','2015-02-16 12:33:46',NULL,NULL,24,NULL,24),(13,17,1,'Unread','2015-02-16 12:33:46',NULL,NULL,24,NULL,NULL),(18,20,2,'','2015-04-21 04:53:28',NULL,0,33,34,33),(19,20,1,'Unread','2015-04-21 04:53:28',NULL,NULL,33,34,34),(23,22,1,'Unread','2015-04-22 07:20:02',NULL,NULL,NULL,NULL,NULL),(27,24,1,'Unread','2015-04-22 07:29:12',NULL,NULL,NULL,NULL,NULL),(33,27,1,'Trash','2015-04-22 07:56:37',NULL,NULL,NULL,5,5),(35,28,1,'Trash','2015-04-22 07:57:08',NULL,NULL,NULL,5,5),(39,30,1,'','2015-04-22 07:57:48',NULL,NULL,NULL,5,5),(40,31,2,'','2015-04-22 09:34:04',NULL,NULL,1,5,1),(41,31,1,'Trash','2015-04-22 09:56:46',NULL,NULL,NULL,5,5),(46,37,2,'','2015-04-22 11:24:44',NULL,0,38,42,38),(47,37,1,'Unread','2015-04-22 11:24:44',NULL,NULL,38,42,42),(48,38,2,'','2015-06-19 07:02:03',NULL,NULL,5,1,5),(50,39,2,'','2015-06-19 07:05:29',NULL,NULL,1,5,1),(51,39,1,'','2015-06-19 07:05:43',NULL,NULL,1,5,5),(54,42,2,'','2015-06-19 10:10:22',NULL,NULL,53,5,53),(55,42,1,'','2015-06-19 10:10:38',NULL,NULL,53,5,5),(56,43,2,'','2015-06-24 11:31:33',NULL,NULL,38,1,38),(62,46,2,'','2015-07-07 12:57:54',NULL,NULL,50,1,50),(64,47,2,'','2015-07-07 12:58:27',NULL,NULL,50,1,50),(66,48,2,'','2015-07-07 13:01:41',NULL,NULL,50,1,50),(67,49,2,'','2015-08-12 13:07:38',NULL,NULL,56,1,56),(68,49,1,'','2015-08-12 13:14:39',NULL,NULL,56,1,1),(69,50,2,'','2015-08-12 13:07:43',NULL,NULL,56,1,56),(70,50,1,'','2015-08-12 13:13:11',NULL,NULL,56,1,1),(71,51,2,'','2015-08-13 06:51:44',NULL,NULL,1,1,1),(72,51,1,'Trash','2015-08-13 06:52:56',NULL,NULL,1,1,1),(73,52,2,'','2015-08-13 06:56:12',NULL,NULL,1,1,1),(74,52,1,'Trash','2015-08-13 06:56:32',NULL,NULL,1,1,1),(75,53,2,'','2015-08-13 07:01:27',70,NULL,1,56,1),(76,53,1,'Unread','2015-08-13 07:01:27',70,NULL,1,56,56),(77,54,2,'','2015-08-17 06:46:42',NULL,NULL,1,1,1),(78,54,1,'Trash','2015-08-17 07:52:31',NULL,NULL,1,1,1),(79,55,2,'','2015-08-17 06:59:46',NULL,NULL,1,1,1),(80,55,1,'Trash','2015-08-17 07:52:23',NULL,NULL,1,1,1),(81,56,2,'','2015-08-17 07:51:46',NULL,NULL,1,1,1),(82,56,1,'Trash','2015-08-17 07:52:12',NULL,NULL,1,1,1),(83,57,2,'','2015-08-29 00:04:07',NULL,NULL,57,49,57),(84,57,1,'Trash','2015-09-02 18:40:11',NULL,NULL,57,49,49),(85,58,2,'','2015-08-29 07:35:56',NULL,NULL,15,15,15),(86,58,1,'','2015-08-29 07:36:24',NULL,NULL,15,15,15),(89,60,2,'','2015-09-02 15:24:56',NULL,NULL,59,1,59),(90,60,1,'','2015-09-02 15:26:12',NULL,NULL,59,1,1),(91,61,2,'','2015-09-02 15:25:42',NULL,NULL,1,1,1),(92,61,1,'','2015-09-02 15:26:02',NULL,NULL,1,1,1),(93,62,2,'','2015-09-02 15:41:50',NULL,NULL,59,1,59),(94,62,1,'Trash','2015-09-02 17:58:07',NULL,NULL,59,1,1),(95,63,2,'','2015-09-02 15:44:23',NULL,NULL,59,1,59),(96,63,1,'','2015-09-02 15:45:05',NULL,NULL,59,1,1),(97,64,2,'','2015-09-21 04:55:10',NULL,NULL,5,1,5),(98,64,1,'','2015-09-21 04:56:16',NULL,NULL,5,1,1),(99,65,2,'','2015-10-28 07:32:33',NULL,NULL,49,1,49),(100,65,1,'','2015-10-28 07:33:55',NULL,NULL,49,1,1),(101,66,2,'Trash','2016-01-28 22:24:14',NULL,NULL,62,1,62),(102,66,1,'','2016-01-29 04:21:52',NULL,NULL,62,1,1),(103,67,2,'','2016-01-29 04:23:44',102,NULL,1,62,1),(104,67,1,'','2016-01-29 07:20:48',102,NULL,1,62,62),(105,68,2,'','2016-02-18 04:56:06',NULL,NULL,64,1,64),(106,68,1,'','2016-02-18 05:13:31',NULL,NULL,64,1,1),(107,69,2,'','2016-02-18 05:50:57',NULL,NULL,64,1,64),(108,69,1,'','2016-04-04 06:27:58',NULL,NULL,64,1,1),(109,70,2,'','2016-06-28 19:12:29',NULL,NULL,49,67,49),(110,70,1,'','2018-02-20 12:15:21',NULL,NULL,49,67,67);
/*!40000 ALTER TABLE `email_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(150) DEFAULT NULL,
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,'Message from Public User','comments from public site'),(2,'Message from Public User','public commnts'),(3,'Message from Public User','ssssssssss'),(4,'Message from Public User','ssssssssss'),(5,'Message from Public User','tttttta sdf sadf sadf sadf '),(6,'Message from Public User','tttttta sdf sadf sadf sadf '),(7,'Message from Public User','tttttta sdf sadf sadf sadf '),(8,'Message from Public User','tttttta sdf sadf sadf sadf '),(9,'Message from Public User','comments.a sdfa sdf sadf '),(10,'Message from Public User','public meessage to my own account'),(11,'Message from Public User','sdfddf'),(12,'Message from Public User','wwerwerwe rwer wer '),(13,'Message from Public User','yy@yyu.com\nasdfasfd asfd asfd '),(14,'Message from Public User','yy@yyu.com\nasdfasfd asfd asfd again'),(15,'Message from Public User','assdf'),(16,'Message from Public User','Abbottabad\nAbbottabad\nKPK\nPrimary Phone: 12345622222\nSecondary Phone: 12'),(17,'Message from Public User','Penatibus mi, class cursus vestibulum. Tincidunt torquent, mus pede dictum neque bibendum sapien praesent mattis commodo cras metus mollis cum.'),(18,'test','Note3'),(19,'test2','Note test again'),(20,'jjjjjjjjjjjjjjjj','jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj'),(21,'Message from Public User',''),(22,'Message from Public User',''),(23,'Message from Public User','Test commetns on 22 april 2015'),(24,'Message from Public User',''),(25,'Message from Public User',''),(26,'Message from Public User','test message on April 22, 2015\n\nFeAmanaALLAH'),(27,'Message from Public User',''),(28,'Message from Public User','new test message 22 april 2015\nagain\nsent'),(29,'Re: Message from Public User','thanks man'),(30,'Message from Public User','Again and again '),(31,'Message from Public User','Contact Information\n\nAbbottabad Campus	\nAbbottabad\nAbbottabad\nKPK'),(32,'Message from Public User','asfd asf asfd '),(33,'Message from Public User','asfd asdf asd'),(34,'Message from Public User','asdf asdf sa'),(35,'Message from Public User','asfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssssasfasdsssssssssssssssss asfasdsssssssssssssssss'),(36,'Message from Public User','asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss asfasdsssssssssssssssss '),(37,'test email from edu edge','Hi,<br>this is just test<br><br>'),(38,'Package Change Request','Hi E-karobar Admin!<br/><br/> Following user has requested to to change the Package. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Ali Fida School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/ss/s3\'>Abbottabad Campus</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>need biannually ....</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali<br/>Admin<br/>Ali Fida School<br/>Abbottabad Campus<br/>alifida86@gmail.com'),(39,'Re: Package Change Request','Hi,&nbsp;<br>You package has been modified to BiAnnually.<br>thanks<br><br>'),(40,'',''),(41,'',''),(42,'Message from Public User','comments from live'),(43,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>Please activiate my account</b>			</td>		</tr></table><br/><br/>Regards<br/>Edu Edge<br/>Admin<br/>Edu Edge<br/>Edu Edge<br/>bilalbahadar@gmail.com'),(46,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Merill ABD</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vm/s3\'>Merill ABD</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>Merill ABD<br/>Admin<br/>Merill ABD<br/>Merill ABD<br/>merill@hk.net'),(47,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Merill ABD</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vm/s3\'>Merill ABD</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>Merill ABD<br/>Admin<br/>Merill ABD<br/>Merill ABD<br/>merill@hk.net'),(48,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Merill ABD</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vm/s3\'>Merill ABD</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>234234234234 234 234 234 234 </b>			</td>		</tr></table><br/><br/>Regards<br/>Merill ABD<br/>Admin<br/>Merill ABD<br/>Merill ABD<br/>merill@hk.net'),(49,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Micro Education System</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://www.e-karobar.com/appadmin/campusDetail/v4/s3\'>Micro Education System</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Micro Education System<br/>Admin<br/>Micro Education System<br/>Micro Education System<br/>microesys@gmail.com'),(50,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Micro Education System</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://www.e-karobar.com/appadmin/campusDetail/v4/s3\'>Micro Education System</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Micro Education System<br/>Admin<br/>Micro Education System<br/>Micro Education System<br/>microesys@gmail.com'),(51,'test email','Hi,<br><br>Hope you are doing well.<br>You have requested for your account activation and chosen the Annual package.<br>Please clear your payment for Annual package.&nbsp;<br>you can get the details from our main site .i.e&nbsp;<a href=\"http://e-karobar.com/welcome/pricing\" target=\"\" rel=\"\">http://e-karobar.com/welcome/pricing</a><br>please also go through our payment methods. i.e.&nbsp;<u><a href=\"http://e-karobar.com/welcome/payments\" target=\"\" rel=\"\">http://e-karobar.com/welcome/payments</a></u><br><br>Regards&nbsp;<br>Admin&nbsp;<br>e-karobar.com<br><br>'),(52,'test test','Hi,<br><br>Hope you are doing well.<br>You have requested for your account activation and chosen the Annual package.<br>Please clear your payment for Annual package.&nbsp;<br><a href=\"http://e-karobar.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\"><u><i>Click here to get our pricing Details</i></u></a><br><a href=\"http://e-karobar.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\"><u><i>Click here to get our Payment Methods&nbsp;</i></u></a>'),(53,'Re: Activate Account Request.','Hi,<br><br>Hope you are doing well.<br><br>You have requested for your account activation with&nbsp;<b>Annual Package</b>.<br>Please clear your payment<b>.&nbsp;</b><br><u><i><br><a href=\"http://e-karobar.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\">C</a><a href=\"http://e-karobar.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\">lick here to get our pricing details</a></i></u><a href=\"http://e-karobar.com/welcome/pricing\" target=\"_blank\" rel=\"nofollow\">&nbsp;</a><br><u><i><a href=\"http://e-karobar.com/welcome/payments\" target=\"_blank\" rel=\"nofollow\">Click here to get our payment methods</a></i></u>&nbsp;<br><br>Please pay at earliest get your account activated.<br><br><br>Regards<br>E-karobar.'),(54,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>Test monthly package by ali fida</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>Edu Edge<br/>Edu Edge<br/>admin@e-karobar.com'),(55,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>test</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>Edu Edge<br/>Edu Edge<br/>admin@e-karobar.com'),(56,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Edu Edge</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/s7/s3\'>Edu Edge</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Annually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>ann test</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>Edu Edge<br/>Edu Edge<br/>admin@e-karobar.com'),(57,'Message from Public User','asdf'),(58,'complain about students','your son are absent 3 to 4 days in &nbsp;a week<br><br>'),(59,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/v9/s3\'>test</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>activate my account \ntest</b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(60,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vd/s3\'>test</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Biannually</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(61,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vd/s3\'>test</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>asdfasdf</b>			</td>		</tr></table><br/><br/>Regards<br/>Ali Fida<br/>Application Admin<br/>test<br/>test<br/>admin@e-karobar.com'),(62,'Invoice Clearance Request','Hi E-karobar Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vd\'>test</a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>3</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-09-02</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Standard Chartered Bank</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(63,'Invoice Clearance Request','Hi E-karobar Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>test</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vd\'>test</a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>3</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-09-02</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Standard Chartered Bank</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>paid please activate my account.\n\nthanks</b>			</td>		</tr></table><br/><br/>Regards<br/>test<br/>Admin<br/>test<br/>test<br/>test@test.com'),(64,'Invoice Clearance Request','Hi E-karobar Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Ali Fida School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/ss\'>Abbottabad Campus</a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>1</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-09-21</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Easy Paisa</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b>Invoice paid </b>			</td>		</tr></table><br/><br/>Regards<br/>Ali<br/>Admin<br/>Ali Fida School<br/>Abbottabad Campus<br/>alifida86@gmail.com'),(65,'Invoice Clearance Request','Hi E-karobar Admin!<br/><br/>Following user has requested Invoice Clearance. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>E-karobar School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vj\'>E-karobar School</a></b>			</td>		</tr>		<tr>			<td>				Invoice No.:  			</td>			<td>				<b>2</b>			</td>		</tr>		<tr>			<td>				Paid Date:  			</td>			<td>				<b>2015-10-01</b>			</td>		</tr>		<tr>			<td>				Paid Through:  			</td>			<td>				<b>Standard Chartered Bank</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>E-karobar School<br/>Admin<br/>E-karobar School<br/>E-karobar School<br/>demo@e-karobar.com'),(66,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Westernlink MTS</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vk/s3\'>Westernlink MTS</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Westernlink MTS<br/>Admin<br/>Westernlink MTS<br/>Westernlink MTS<br/>mark_mulier@hotmail.com'),(67,'Re: Activate Account Request.','Hi Mark!\n\nThanks for using our school management system.\nWe have recieved the account activation request for your account. Please select a package from:\nhttp://e-karobar.com/welcome/pricing\n\nAlso have a look at our payment methods:\nhttp://e-karobar.com/welcome/payments\n\n\nPlease pay for your desired package and your account will be activated in 1 hour.\nIf you are having any issues regarding payments or package selection, please feel free to contact us any time.\n\nThanks\n\nRegards\nAdmin E-karobar'),(68,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b>Al Rahber School</b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/vx/s3\'>Al Rahber School</a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Al Rahber Public Schools<br/>Admin<br/>Al Rahber School<br/>Al Rahber School<br/>alrahberschool14@gmail.com'),(69,'Activate Account Request.','Hi E-karobar Admin!<br/><br/> Following user has requested to Activate the Account. <br/><br/><b>Details</b> <br/><table>		<tr>			<td>				School Name:  			</td>			<td>				<b></b>			</td>		</tr>		<tr>			<td>				Campus Name:  			</td>			<td>				<b><a href=\'http://e-karobar.com/appadmin/campusDetail/s3/s3\'></a></b>			</td>		</tr>		<tr>			<td>				Current Package:  			</td>			<td>				<b>NOT SET</b>			</td>		</tr>		<tr>			<td>				New Package:  			</td>			<td>				<b>Monthly</b>			</td>		</tr>		<tr>			<td>				Comments:  			</td>			<td>				<b></b>			</td>		</tr></table><br/><br/>Regards<br/>Al Rahber Public Schools<br/><br/><br/><br/>alrahberschool14@gmail.com'),(70,'test','sfdsfsdfsdf');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_salaries`
--

DROP TABLE IF EXISTS `employee_salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_salaries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) NOT NULL,
  `month` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `comments` text,
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_employee_salaries_employees` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_salaries`
--

LOCK TABLES `employee_salaries` WRITE;
/*!40000 ALTER TABLE `employee_salaries` DISABLE KEYS */;
INSERT INTO `employee_salaries` VALUES (1,2,'2014-11-01',2333,'Paid','2014-11-11','Nov 2014 salaries issued ',1,'2014-11-11 01:30:44',3),(2,3,'2014-11-01',2333,'Paid','2014-11-11','Nov 2014 salaries issued ',1,'2014-11-11 01:30:44',3),(3,5,'2014-11-01',2333,'Paid','2014-11-11','Nov 2014 salaries issued ',1,'2014-11-11 01:30:44',3),(4,2,'2014-12-01',2333,'Reverted','2014-11-11','salry issued will be returned',1,'2014-11-11 01:31:54',4),(5,3,'2014-12-01',2333,'Reverted','2014-11-14','',1,'2014-11-14 16:30:20',18),(6,5,'2014-12-01',2333,'Reverted','2014-11-14','',1,'2014-11-14 16:30:20',18),(7,2,'2014-03-01',2333,'Reverted','2014-11-16','ffff',1,'2014-11-16 09:51:05',24),(8,3,'2014-03-01',2333,'Reverted','2014-11-16','ffff',1,'2014-11-16 09:51:05',24),(9,5,'2014-03-01',2333,'Reverted','2014-11-16','ffff',1,'2014-11-16 09:51:05',24),(10,6,'2014-03-01',7897.98,'Reverted','2014-11-20','',1,'2014-11-20 17:17:53',37),(11,6,'2014-12-01',7897.98,'Paid','2014-11-20','hhhhhh',1,'2014-11-20 17:18:51',39),(12,3,'2015-08-01',2333,'Paid','2014-11-20','qqqqqqq',1,'2014-11-20 17:28:23',40),(13,5,'2015-08-01',2333,'Paid','2014-11-20','qqqqqqq',1,'2014-11-20 17:28:23',40),(14,7,'2014-11-01',5000,'Paid','2014-11-26','salary issued\r\n',4,'2014-11-26 05:35:40',42),(15,8,'2014-06-01',1500,'Paid','2014-11-26','fffff',7,'2014-11-26 14:34:41',53),(16,9,'2014-12-01',5000,'Paid','2014-12-02','salary issued',7,'2014-12-02 11:11:02',59),(17,12,'2014-02-01',3500,'Paid','2014-12-09','',7,'2014-12-09 01:46:13',68),(18,30,'2015-08-01',15000,'Paid','2015-09-02','Paid via bank',49,'2015-09-02 13:18:46',85),(19,31,'2016-01-01',1000,'Paid','2016-01-28','salary',62,'2016-01-28 16:14:24',91),(20,30,'2016-06-01',15000,'Paid','2016-06-28','has been transfered through bank',49,'2016-06-28 15:31:44',103),(21,33,'2016-06-01',100000,'Paid','2016-06-28','has been transfered through bank',49,'2016-06-28 15:31:44',103),(22,2,'2018-03-01',2333,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(23,3,'2018-03-01',2333,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(24,5,'2018-03-01',2333,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(25,6,'2018-03-01',7897.98,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(26,19,'2018-03-01',7000,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(27,20,'2018-03-01',7000,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(28,21,'2018-03-01',7000,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(29,28,'2018-03-01',500000,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(30,18,'2018-03-01',7000,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107),(31,22,'2018-03-01',2333,'Paid','2018-02-06','asdfasd',5,'2018-02-06 06:17:06',107);
/*!40000 ALTER TABLE `employee_salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_types`
--

DROP TABLE IF EXISTS `employee_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employee_type_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_types`
--

LOCK TABLES `employee_types` WRITE;
/*!40000 ALTER TABLE `employee_types` DISABLE KEYS */;
INSERT INTO `employee_types` VALUES (1,'Teacher',1),(2,'Support Staff',1),(3,'Managment',1),(4,'teachers',2),(5,'Teacher',5),(6,'Teacher1',5),(7,'vice principal',8),(8,'principal',8),(9,'Teacher / Chief proctor',8),(10,'Teacher',8),(11,'MD',8),(12,'Watch man / Peon',8),(13,'watchman /night',8),(16,'Non Technical',21),(17,'Technical',21),(18,'teacher',16),(22,'Teachers',33),(23,'Support Staff',33),(24,'Teachers',34),(25,'Support Staff',34),(30,'Teachers',38),(31,'Support Staff',38),(36,'Teachers',41),(37,'Support Staff',41),(38,'Teachers',42),(39,'Support Staff',42),(40,'Teachers',43),(41,'Support Staff',43),(42,'Teachers',44),(43,'Support Staff',44),(44,'Teachers',45),(45,'Support Staff',45),(46,'Teachers',46),(47,'Support Staff',46),(48,'Teachers',47),(49,'Support Staff',47),(52,'Teachers',49),(53,'Support Staff',49),(54,'Teachers',50),(55,'Support Staff',50),(56,'Management',50),(57,'Teachers',51),(58,'Support Staff',51),(59,'Teachers',52),(60,'Support Staff',52),(63,'Teachers',54),(64,'Support Staff',54),(65,'Teachers',55),(66,'Support Staff',55),(67,'Admininstraation',41),(68,'custom',41);
/*!40000 ALTER TABLE `employee_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (2,'Teacher2','Khan2','13212311',NULL,NULL,'address',2333,'MSc','2014-10-10','2014-10-10',1,'Active',1,NULL),(3,'Teacher','Khan','13212311',NULL,NULL,'address',2333,'BSc','2014-10-10','2014-10-10',1,'Active',1,NULL),(4,'FFFFF','FFFF','234234234',NULL,NULL,'address',2,'GTT','2014-11-02','0000-00-00',2,'In Active',1,NULL),(5,'New','Teacher','13504-5696582-7',NULL,NULL,'ISB',2333,'MSc','2014-11-18',NULL,1,'Active',1,NULL),(6,'www','','13547-8965877-7',NULL,NULL,'address',7897.98,'','2014-11-04',NULL,1,'Active',1,NULL),(7,'ttt','tttt','13547-8965877-7',NULL,NULL,'address',5000,'MSc','2014-11-26',NULL,4,'Active',2,NULL),(8,'rrrr','rrr','13547-8965877-7',NULL,'ali@ali.coms','ISB',1500,'BSc','2014-11-26',NULL,5,'Active',5,NULL),(9,'ZOYA','JAVED','13504-2222624-5',NULL,'bashir_anis@yahoo.com','bilal town, ',18000,'Graduation + B. ed','2011-05-02','2014-12-02',67,'Active',41,'http://www.e-karobar.com/uploads/campuses/OX/employees/Ojemp-pic.png'),(10,'Halima','Munsif','14523-3654987-8',NULL,'haleema.munsif@gmail.com','Bilal town,  street No. 1',18000,'M.com','2013-11-07','2014-12-02',67,'Active',41,NULL),(11,'saima','quest','45632-4569875-8',NULL,'saima.classtwo@yahoo.com','thanda chooha',18000,'Graduation ','2014-11-11','2014-12-02',67,'Active',41,NULL),(12,'Asma ','nazra','78965-4563214-8',NULL,'asma.nazra@gmail.com','hassan town',18000,'darse e nizami (Aalima)','2013-09-18','2014-12-02',67,'Active',41,NULL),(13,'IQBAL','MUHAMMAD','12365-8956478-2',NULL,'iqbal.quest@yahoo.com','at school site',18000,'M.phil education, M.sc Maths','2011-02-10','2014-12-02',67,'Active',41,NULL),(18,'ggg','gggg','13547-8965877-7',NULL,'ggg4@ggg.com','address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'http://e-karobar.com/uploads/campuses/OO/students/OQemp-pic.png'),(19,'ggg','gggg','13547-8965877-7',NULL,NULL,'address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'http://e-karobar.com/uploads/campuses/OO/students/Odemp-pic.png'),(20,'ggg','gggg','13547-8965877-7',NULL,NULL,'address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'http://e-karobar.com/uploads/campuses/OO/students/ODemp-pic.png'),(21,'ggg','gggg','13547-8965877-7',NULL,NULL,'address',7000,'BSc','2014-12-01',NULL,3,'Active',1,'http://e-karobar.com/uploads/campuses/OO/students/OHemp-pic.png'),(22,'eee','eee','13547-8965877-7',NULL,'s3@gmail.com','Abbottabad32333',2333,'BSc','2014-12-01',NULL,2,'Active',1,'http://e-karobar.com/uploads/campuses/OO/employees/OPemp-pic.png'),(25,'Sohrab','Khan','13302-0976998-1',NULL,'ksohrab76@yahoo.com','Haripur',18000,'BSc','2014-02-01',NULL,67,'Active',41,'http://e-karobar.com/uploads/campuses/OH/students/Ogemp-pic.jpg'),(26,'Hassam','Akram','13302-7950857-7',NULL,'hassamakram999@hotmail.com','Vill Tolokar Haripur',18000,'BS (Agriculture)','2014-09-01',NULL,67,'Active',41,'http://e-karobar.com/uploads/campuses/OH/students/Okemp-pic.jpg'),(27,'Faisal','Ur Rehman','13302-9975161-9',NULL,'faisalrehman025@gmail.com','Village, Alam Tehsil & District Haripur',18000,'B.Com Result Awaited','2014-12-13',NULL,67,'Active',41,'http://e-karobar.com/uploads/campuses/OH/students/OWemp-pic.jpg'),(28,'UserEmail','test','13504-9856547-1',NULL,NULL,'address',500000,'BSCS','2015-01-25',NULL,1,'Active',1,NULL),(29,'Abdul','Waheed','13504-9874258-9',NULL,NULL,'Address',10000,'BSc','2015-02-24',NULL,18,'Active',16,NULL),(30,'Abc','khan','12345-6589898-7',NULL,'eamil@email.com','address',15000,'MSc','2015-06-01',NULL,36,'Active',41,NULL),(31,'doris','boo','11111-1111111-1',NULL,'doris@westernlinl.nl','amersfoort',1000,'7','2016-01-28',NULL,60,'Active',52,NULL),(32,'f','','13504-6852145-7',NULL,'ali@e-karobar.com','add',1000,'msc','2016-03-11',NULL,63,'Active',54,NULL),(33,'Mr','Sing','11232145678',NULL,'mrsing@email.com','addr',100000,'Masters','2016-06-27',NULL,67,'Active',41,NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_type`
--

DROP TABLE IF EXISTS `expense_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_expense_type_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_type`
--

LOCK TABLES `expense_type` WRITE;
/*!40000 ALTER TABLE `expense_type` DISABLE KEYS */;
INSERT INTO `expense_type` VALUES (1,'Building rent',1),(2,'Party Expense',1),(3,'Study Trip',1),(4,'Building rent',5),(5,'school rent',8),(6,'Gas Bill',8),(7,'Electricity Bill',8),(8,'Printer Purchased',8),(9,'Computer Cables',8),(17,'Building Rent',33),(18,'Electricity Bill',33),(19,'Telephone Bill',33),(20,'Study Trip',33),(21,'Building Rent',34),(22,'Electricity Bill',34),(23,'Telephone Bill',34),(24,'Study Trip',34),(33,'Building Rent',38),(34,'Electricity Bill',38),(35,'Telephone Bill',38),(36,'Study Trip',38),(45,'Building Rent',41),(46,'Electricity Bill',41),(47,'Telephone Bill',41),(48,'Study Trip',41),(49,'Building Rent',42),(50,'Electricity Bill',42),(51,'Telephone Bill',42),(52,'Study Trip',42),(53,'Building Rent',43),(54,'Electricity Bill',43),(55,'Telephone Bill',43),(56,'Study Trip',43),(57,'Building Rent',44),(58,'Electricity Bill',44),(59,'Telephone Bill',44),(60,'Study Trip',44),(61,'Building Rent',45),(62,'Electricity Bill',45),(63,'Telephone Bill',45),(64,'Study Trip',45),(65,'Building Rent',46),(66,'Electricity Bill',46),(67,'Telephone Bill',46),(68,'Study Trip',46),(69,'Building Rent',47),(70,'Electricity Bill',47),(71,'Telephone Bill',47),(72,'Study Trip',47),(77,'Building Rent',49),(78,'Electricity Bill',49),(79,'Telephone Bill',49),(80,'Study Trip',49),(81,'Building Rent',50),(82,'Electricity Bill',50),(83,'Telephone Bill',50),(84,'Study Trip',50),(85,'Building Rent',51),(86,'Electricity Bill',51),(87,'Telephone Bill',51),(88,'Study Trip',51),(94,'Water Bill',52),(90,'Electricity Bill',52),(91,'Telephone Bill',52),(92,'Study Trip',52),(93,'Cleaning',52),(95,'Building Rent',53),(96,'Electricity Bill',53),(97,'Telephone Bill',53),(98,'Study Trip',53),(99,'Building Rent',54),(100,'Electricity Bill',54),(101,'Telephone Bill',54),(102,'Study Trip',54),(103,'Building Rent',55),(104,'Electricity Bill',55),(105,'Telephone Bill',55),(106,'Study Trip',55),(107,'Sports week',41);
/*!40000 ALTER TABLE `expense_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,0) DEFAULT NULL,
  `description` text,
  `expense_type_id` int(10) DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `comments` text,
  `status` varchar(20) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Expense_type` (`expense_type_id`),
  KEY `FK_Expense_transac` (`transaction_id`),
  KEY `FK_expense_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,45000,'Building rend paid',1,'2014-11-14','Building rent paid','Reverted','2014-11-20 20:41:42',1,15,1),(2,23332,'SSSssss',3,'2014-11-26','sdsdfsdf','Reverted','2014-11-20 20:41:42',1,21,1),(3,2222,'2222',1,'2014-11-17','2222','Reverted','2014-11-20 20:41:43',1,26,1),(4,3333,'3333',3,'2014-11-25','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Active','2014-11-20 20:41:43',5,28,1),(5,234,' aaa',2,'2014-02-03','asdfa','Reverted','2014-11-20 21:30:45',1,34,1),(6,1000,'desc',4,'2014-11-20','','Active','2014-11-26 20:11:29',7,58,5),(7,15000,'December 2014',5,'2014-12-31','paid online through account No. 1545 UBL','Active','2014-12-02 17:13:20',7,63,8),(8,200,'Paid',6,'2014-12-31','Paid by Khan bashir','Active','2014-12-02 17:14:15',7,64,8),(9,2500,'Paid',7,'2014-12-31','paid by Khan Bashir','Active','2014-12-02 17:14:54',7,65,8),(10,5000,'HP 1100',8,'2014-12-10','Jointly purchased by Bashir and Iqbal sb','Active','2014-12-02 17:15:43',7,66,8),(11,100,'Power Cable for computer',9,'2014-12-10','Purchased by Bashir Khan','Active','2014-12-02 17:16:23',7,67,8);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fee_types`
--

DROP TABLE IF EXISTS `fee_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fee_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `can_delete` varchar(20) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  `internal_key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_campus_feetype` (`type`,`campus_id`) USING BTREE,
  KEY `FK_feetype_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fee_types`
--

LOCK TABLES `fee_types` WRITE;
/*!40000 ALTER TABLE `fee_types` DISABLE KEYS */;
INSERT INTO `fee_types` VALUES (1,'Monthly Tution Fee','No',1,'tution.fee'),(2,'Admission Fee','No',1,'admission.fee'),(3,'Examination Fee','No',1,NULL),(4,'monthly',NULL,2,NULL),(5,'examination',NULL,2,NULL),(7,'Monthly Tution Fee',NULL,5,'tution.fee'),(8,'fff',NULL,5,NULL),(9,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(10,'Admission Fee',NULL,NULL,'admission.fee'),(11,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(12,'Admission Fee',NULL,NULL,'admission.fee'),(13,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(14,'Admission Fee',NULL,NULL,'admission.fee'),(15,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(16,'Admission Fee',NULL,NULL,'admission.fee'),(17,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(18,'Admission Fee',NULL,NULL,'admission.fee'),(19,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(20,'Admission Fee',NULL,NULL,'admission.fee'),(21,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(22,'Admission Fee',NULL,NULL,'admission.fee'),(23,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(24,'Admission Fee',NULL,NULL,'admission.fee'),(25,'Monthly Tution Fee',NULL,NULL,'tution.fee'),(26,'Admission Fee',NULL,NULL,'admission.fee'),(31,'Monthly Tution Fee',NULL,8,'tution.fee'),(32,'Admission Fee',NULL,8,'admission.fee'),(47,'Monthly Tution Fee',NULL,16,'tution.fee'),(48,'Admission Fee',NULL,16,'admission.fee'),(55,'Monthly Tution Fee',NULL,20,'tution.fee'),(56,'Admission Fee',NULL,20,'admission.fee'),(57,'month fee ',NULL,21,'tution.fee'),(58,'Annual Fund',NULL,21,'admission.fee'),(59,'Paper Fee',NULL,21,NULL),(60,'Monthly Tution Fee',NULL,22,'tution.fee'),(61,'Admission Fee',NULL,22,'admission.fee'),(66,'Monthly Tution Fee',NULL,25,'tution.fee'),(67,'Admission Fee',NULL,25,'admission.fee'),(68,'Monthly Tution Fee',NULL,26,'tution.fee'),(69,'Admission Fee',NULL,26,'admission.fee'),(70,'Monthly Tution Fee',NULL,27,'tution.fee'),(71,'Admission Fee',NULL,27,'admission.fee'),(72,'Monthly Tution Fee',NULL,28,'tution.fee'),(73,'Admission Fee',NULL,28,'admission.fee'),(74,'Monthly Tution Fee',NULL,29,'tution.fee'),(75,'Admission Fee',NULL,29,'admission.fee'),(78,'Admission Fee','Yes',NULL,'admission.fee'),(79,'Monthly Tuition Fee','Yes',NULL,'tution.fee'),(80,'Examination Fee','Yes',NULL,'examination.fee'),(84,'Admission Fee','Yes',33,'admission.fee'),(85,'Monthly Tuition Fee','Yes',33,'tution.fee'),(86,'Examination Fee','Yes',33,'examination.fee'),(87,'Admission Fee','Yes',34,'admission.fee'),(88,'Monthly Tuition Fee','Yes',34,'tution.fee'),(89,'Examination Fee','Yes',34,'examination.fee'),(93,'Ghunda tax',NULL,1,NULL),(97,'Admission Fee','Yes',38,'admission.fee'),(98,'Monthly Tuition Fee','Yes',38,'tution.fee'),(99,'Examination Fee','Yes',38,'examination.fee'),(106,'Admission Fee','Yes',41,'admission.fee'),(107,'Monthly Tuition Fee','Yes',41,'tution.fee'),(108,'Examination Fee','Yes',41,'examination.fee'),(109,'Library Fee',NULL,41,NULL),(110,'Admission Fee','Yes',42,'admission.fee'),(111,'Monthly Tuition Fee','Yes',42,'tution.fee'),(112,'Examination Fee','Yes',42,'examination.fee'),(113,'Admission Fee','Yes',43,'admission.fee'),(114,'Monthly Tuition Fee','Yes',43,'tution.fee'),(115,'Examination Fee','Yes',43,'examination.fee'),(116,'Admission Fee','Yes',44,'admission.fee'),(117,'Monthly Tuition Fee','Yes',44,'tution.fee'),(118,'Examination Fee','Yes',44,'examination.fee'),(119,'Admission Fee','Yes',45,'admission.fee'),(120,'Monthly Tuition Fee','Yes',45,'tution.fee'),(121,'Examination Fee','Yes',45,'examination.fee'),(122,'Admission Fee','Yes',46,'admission.fee'),(123,'Monthly Tuition Fee','Yes',46,'tution.fee'),(124,'Examination Fee','Yes',46,'examination.fee'),(125,'Admission Fee','Yes',47,'admission.fee'),(126,'Monthly Tuition Fee','Yes',47,'tution.fee'),(127,'Examination Fee','Yes',47,'examination.fee'),(131,'Admission Fee','Yes',49,'admission.fee'),(132,'Monthly Tuition Fee','Yes',49,'tution.fee'),(133,'Examination Fee','Yes',49,'examination.fee'),(159,'My New Fee Type',NULL,41,NULL),(135,'Admission Fee','Yes',50,'admission.fee'),(136,'Monthly Tuition Fee','Yes',50,'tution.fee'),(137,'Examination Fee','Yes',50,'examination.fee'),(138,'ComputerFee',NULL,50,NULL),(139,'Admission Fee','Yes',51,'admission.fee'),(140,'Monthly Tuition Fee','Yes',51,'tution.fee'),(141,'Examination Fee','Yes',51,'examination.fee'),(142,'Admission Fee','Yes',52,'admission.fee'),(143,'Term Tuition Fee','Yes',52,'tution.fee'),(144,'Food Fee Day','Yes',52,'examination.fee'),(145,'Transport fee',NULL,52,NULL),(146,'Admission Fee','Yes',53,'admission.fee'),(147,'Monthly Tuition Fee','Yes',53,'tution.fee'),(148,'Examination Fee','Yes',53,'examination.fee'),(149,'Lab/Card/File',NULL,21,NULL),(150,'Computer Fee',NULL,21,NULL),(151,'Book/Note Book',NULL,21,NULL),(152,'sports ',NULL,21,NULL),(153,'Admission Fee','Yes',54,'admission.fee'),(154,'Monthly Tuition Fee','Yes',54,'tution.fee'),(155,'Examination Fee','Yes',54,'examination.fee'),(156,'Admission Fee','Yes',55,'admission.fee'),(157,'Monthly Tuition Fee','Yes',55,'tution.fee'),(158,'Examination Fee','Yes',55,'examination.fee');
/*!40000 ALTER TABLE `fee_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardians`
--

DROP TABLE IF EXISTS `guardians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardians`
--

LOCK TABLES `guardians` WRITE;
/*!40000 ALTER TABLE `guardians` DISABLE KEYS */;
INSERT INTO `guardians` VALUES (1,'Ali Fida','Male','SSE22','1111111111','111','03009113800','islamabad11\r\n','ali@ali.com','13504-2659893-1'),(4,'ff222','Female','ff2','ff22','ff2','fff22','ff22','ff2','ff22'),(5,'gg','Male','ggg','2323','2323','23323','2323','2323','43443'),(6,'nnnnnnnnn','Male','','','','03225998544','','','15478-9852478-9'),(7,'gggg','Male','ssssssss','0300121','243','03009113800','address','ali@ali.com','13504-6507404-1'),(8,'sss father','Male','SSs','sss','sss','93200455852','ssss','sss@sss.com','13504-6507404-1'),(9,'uuuuu','Male','uuuu','','','03009113800','','ali@ali.com','13504-6598987-1'),(10,'Bashir Ahmed Khan','Male','Advocate','545454545','1212212','03332366360','Bilal Town, Hashimi Colony, Stree # 5','bashir.khan@ufone.blackberry.com','13504-2222624-5'),(11,'Bashir Ahmed Khan','Male','Advocate','89898989','0121111','03332366360','Bilal Town, Hashmi Colony, Street No. 5','bashir_anis@yahoo.com','13504-2222624-5'),(12,'Bashir Ahmed Khan','Male','Advocate','021354','0121111','03332366360','bilal town','bashir.khan@ufone.blackberry.com','13504-2222624-5'),(13,'Ejaz Khan','Male','Agriculture','','','03005396276','Vill Alam Distt & Teh Haripur','adfadf@yahoo.com','13302-1746610-9'),(14,'Ali Khan','Male','Govt Officer','','','00923009999999','Ali Khan Office address.','ali@khan.com','03504-6586823-1'),(15,'Ali Khan','Male','Govt Officer','','','00923556558666','asdf ','ali@khan.com','03504-6586823-1'),(16,'Ahmad Bilal','Male','Govt Officer','00923556558666','00923556558666','00923556558666','House address','ahmad@bilal.com','03504-6586823-1');
/*!40000 ALTER TABLE `guardians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `campus_package_id` int(10) DEFAULT NULL,
  `invoice_no` varchar(20) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT '0',
  `payable_amount` decimal(10,0) DEFAULT '0',
  `discount` decimal(10,0) DEFAULT '0',
  `arrears` decimal(10,0) DEFAULT '0',
  `total_payable_amount` decimal(10,0) DEFAULT '0',
  `paid_amount` decimal(10,0) DEFAULT '0',
  `invoice_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `campus_id` int(10) DEFAULT NULL,
  `payment_method` int(10) DEFAULT NULL,
  `invoice_expiry_date` date DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_campus_package_invoice` (`campus_package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1052 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (4,3,'1',0,10000,0,0,10000,10000,'2015-09-21','Paid','2015-09-21','2015-09-21',1,'2015-09-20 23:53:13','2015-10-20 11:49:20',1,2,'2016-03-21','PKR'),(5,13,'2',0,10000,0,0,10000,10000,'2015-10-28','Expired','2015-10-28',NULL,1,'2015-10-28 02:30:44','2015-10-28 07:30:44',41,1,'2016-04-28','PKR'),(1034,4,'3',0,0,0,0,0,0,'2015-11-16','Expired','2016-12-31',NULL,1,'2015-11-16 08:00:37','2015-11-16 08:00:37',21,0,'2016-12-31','USD'),(1035,3,'4',0,100,0,0,100,0,'2016-03-21','Expired','2016-03-21',NULL,1,'2016-03-11 13:45:23','2016-03-11 17:45:23',1,0,'2016-09-21','USD'),(1036,5,'5',0,0,0,0,0,0,'2016-04-13','Expired','2016-04-13',NULL,0,'2016-04-13 01:28:16','2016-04-13 04:28:16',16,NULL,'2016-10-13','USD'),(1037,13,'6',0,100,0,0,100,0,'2016-04-28','Expired','2016-04-28','2016-06-28',1,'2016-06-28 14:14:13','2016-06-28 17:14:13',41,1,'2016-10-28','USD'),(1038,4,'7',0,0,0,0,0,0,'2016-05-16','Expired','2017-03-16',NULL,0,'2017-03-16 05:36:46','2017-03-16 09:36:46',21,NULL,'2017-07-01','USD'),(1039,4,'8',0,0,0,0,0,0,'2016-11-16','Expired','2017-09-16',NULL,0,'2018-02-06 03:32:10','2018-02-06 07:32:10',21,NULL,'2018-01-01','USD'),(1040,4,'9',0,0,0,0,0,0,'2017-05-16','Paid','2018-02-06',NULL,1,'2018-02-06 03:32:10','2018-02-06 07:32:10',21,0,'2018-07-01','USD'),(1041,1,'10',0,0,0,0,0,0,'2016-09-21','Expired','2016-09-21',NULL,0,'2018-02-06 06:09:26','2018-02-06 10:09:26',1,NULL,'2017-03-21','USD'),(1042,1,'10',0,0,0,0,0,0,'2017-03-21','Expired','2017-03-21',NULL,0,'2018-02-06 06:09:26','2018-02-06 10:09:26',1,NULL,'2017-09-21','USD'),(1043,1,'10',0,0,0,0,0,0,'2017-09-21','Paid','2017-09-21',NULL,1,'2018-02-06 06:09:26','2018-02-06 10:09:26',1,1,'2018-03-21','USD'),(1044,14,'10',0,0,0,0,0,0,'2016-10-28','Expired','2016-10-28',NULL,0,'2018-02-07 02:31:21','2018-02-07 06:31:21',41,NULL,'2017-04-28','USD'),(1045,14,'10',0,0,0,0,0,0,'2017-04-28','Expired','2017-04-28',NULL,0,'2018-02-07 02:31:21','2018-02-07 06:31:21',41,NULL,'2017-10-28','USD'),(1046,14,'10',0,0,0,0,0,0,'2017-10-28','Paid','2017-10-28',NULL,1,'2018-02-07 02:31:21','2018-02-07 06:31:21',41,0,'2018-04-28','USD'),(1047,15,'10',0,300,0,0,300,0,'2018-03-12','Paid','2018-03-12',NULL,1,'2018-03-12 14:14:28','2018-03-12 18:14:28',55,0,'2019-03-12','USD'),(1048,5,'10',0,0,0,0,0,0,'2016-10-13','Expired','2016-10-13',NULL,0,'2018-03-13 15:23:20','2018-03-13 19:23:20',16,NULL,'2017-04-13','USD'),(1049,5,'10',0,0,0,0,0,0,'2017-04-13','Expired','2017-04-13',NULL,0,'2018-03-13 15:23:20','2018-03-13 19:23:20',16,NULL,'2017-10-13','USD'),(1050,5,'10',0,0,0,0,0,0,'2017-10-13','Paid','2017-10-13',NULL,1,'2018-03-13 15:23:20','2018-03-13 19:23:20',16,1,'2018-04-13','USD'),(1051,1,'10',0,0,0,0,0,0,'2018-03-21','Due','2018-03-21',NULL,0,'2018-03-13 15:32:34','2018-03-13 19:32:34',1,NULL,'2018-09-21','USD');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_types`
--

DROP TABLE IF EXISTS `item_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_itemtype_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_types`
--

LOCK TABLES `item_types` WRITE;
/*!40000 ALTER TABLE `item_types` DISABLE KEYS */;
INSERT INTO `item_types` VALUES (1,'Note Book',1),(2,'English Book - 1',1),(3,'English Book - 2',1),(4,'notebooks',2),(5,'books',2),(6,'book',5),(7,'note book',5),(8,'chairs',8),(9,'board markers',8),(10,'book',8),(11,'printer',8),(14,'Books',21),(15,'Note Book',21),(16,'Cards',21),(17,'Tution Fee',21),(18,'Note Books',NULL),(19,'Books',NULL),(22,'Note Books',33),(23,'Books',33),(24,'Note Books',34),(25,'Books',34),(30,'Note Books',38),(31,'Books',38),(36,'Note Books',41),(37,'Books',41),(38,'Note Books',42),(39,'Books',42),(40,'Note Books',43),(41,'Books',43),(42,'Note Books',44),(43,'Books',44),(44,'Note Books',45),(45,'Books',45),(46,'Note Books',46),(47,'Books',46),(48,'Note Books',47),(49,'Books',47),(52,'Note Books',49),(53,'Books',49),(54,'Note Books',50),(55,'Books',50),(56,'Note Books',51),(57,'Books',51),(58,'Note Books',52),(59,'Books',52),(60,'Note Books',53),(61,'Books',53),(62,'Note Books',54),(63,'Books',54),(64,'Note Books',55),(65,'Books',55),(66,'Pen',41);
/*!40000 ALTER TABLE `item_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` text,
  `item_type_id` int(10) NOT NULL,
  `amount` int(10) DEFAULT NULL,
  `available_amount` int(10) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `purchase_price` double DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_items_item_types1` (`item_type_id`),
  KEY `fk_campus_item` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Item Description 1',1,200,143,80,70,1),(2,'Item Description 2',2,200,174,500,450,1),(3,'n1',4,200,165,50,70,2),(4,'book1',5,20,18,500,520,2),(5,'dec',6,100,94,500,450,5),(6,'desc',7,100,87,170,200,5),(7,'purchased',8,2,23,1500,1200,8),(8,'writing tools',9,3,0,360,300,8),(9,'writing tools',9,3,0,360,300,8),(10,'abdulrehman',10,3,1,500,450,8),(13,'Nursery',14,100,0,900,800,21),(14,'test inveotry',14,200,199,100,80,21),(15,'15 num',22,50,50,50,45,33),(16,'English Narrow line',36,100,80,120,100,41),(17,'narrow line',54,100,98,200,150,50);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `money_transactions`
--

DROP TABLE IF EXISTS `money_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `money_transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` bigint(20) DEFAULT NULL,
  `transaction_type_id` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `profit_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL COMMENT 'user[id]',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transaction_type` (`transaction_type_id`),
  KEY `FK_profit` (`profit_id`),
  KEY `fk_money_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `money_transactions`
--

LOCK TABLES `money_transactions` WRITE;
/*!40000 ALTER TABLE `money_transactions` DISABLE KEYS */;
INSERT INTO `money_transactions` VALUES (1,80,1,NULL,1,'2014-11-11 01:28:39',1,'2014-11-26 05:18:16',1,1),(2,160,1,NULL,1,'2014-11-11 01:28:54',1,'2014-11-26 05:18:16',1,1),(3,6999,3,NULL,1,'2014-11-11 01:30:44',1,'2014-11-26 05:18:16',1,1),(4,2333,3,'Reverted',1,'2014-11-11 01:31:40',1,'2014-11-26 05:18:16',1,1),(5,2333,5,NULL,1,'2014-11-11 01:31:54',1,'2014-11-26 05:18:16',1,1),(6,160,1,NULL,1,'2014-11-11 02:41:12',1,'2014-11-26 05:18:16',1,1),(7,2000,1,'Reverted',1,'2014-11-11 08:59:18',1,'2014-11-26 05:18:16',1,1),(12,2000,5,NULL,1,'2014-11-11 09:50:53',1,'2014-11-26 05:18:16',1,1),(13,9000,1,'Reverted',1,'2014-11-12 01:49:43',1,'2014-11-26 05:18:16',1,1),(14,12000,1,'Reverted',1,'2014-11-13 06:35:55',1,'2014-11-26 05:18:16',1,1),(15,45000,2,'Reverted',1,'2014-11-14 12:58:32',1,'2014-11-26 05:18:16',1,1),(16,12000,5,NULL,1,'2014-11-14 13:50:07',1,'2014-11-26 05:18:16',1,1),(17,45000,5,NULL,1,'2014-11-14 13:51:08',1,'2014-11-26 05:18:16',1,1),(18,4666,3,'Reverted',1,'2014-11-14 15:10:02',1,'2014-11-26 05:18:16',1,1),(19,4666,5,NULL,1,'2014-11-14 16:30:20',1,'2014-11-26 05:18:16',1,1),(20,9000,5,NULL,1,'2014-11-14 16:31:01',1,'2014-11-26 05:18:16',1,1),(21,23332,2,'Reverted',1,'2014-11-14 16:31:47',1,'2014-11-26 05:18:16',1,1),(22,23332,5,NULL,1,'2014-11-14 16:33:00',1,'2014-11-26 05:18:16',1,1),(23,160,1,NULL,1,'2014-11-16 09:27:28',1,'2014-11-26 05:18:16',1,1),(24,6999,3,'Reverted',1,'2014-11-16 09:41:21',1,'2014-11-26 05:18:16',1,1),(25,6999,5,NULL,1,'2014-11-16 09:51:05',1,'2014-11-26 05:18:16',1,1),(26,2222,2,'Reverted',1,'2014-11-16 10:03:54',1,'2014-11-26 05:18:16',1,1),(27,2222,5,NULL,1,'2014-11-16 10:04:31',1,'2014-11-26 05:18:16',1,1),(28,3333,2,NULL,1,'2014-11-16 10:07:51',1,'2014-11-26 05:18:16',1,1),(31,0,2,NULL,1,'2014-11-16 10:23:43',1,'2014-11-26 05:18:16',1,1),(32,0,2,NULL,1,'2014-11-16 10:24:33',1,'2014-11-26 05:18:16',1,1),(33,0,2,NULL,1,'2014-11-16 10:26:32',1,'2014-11-26 05:18:16',1,1),(34,234,2,'Reverted',1,'2014-11-18 14:24:16',1,'2014-11-26 05:18:16',1,1),(35,234,5,NULL,1,'2014-11-18 14:24:59',1,'2014-11-26 05:18:16',1,1),(36,6000,1,'Reverted',1,'2014-11-20 12:11:36',1,'2014-11-26 05:18:16',1,1),(37,7898,3,'Reverted',1,'2014-11-20 17:13:53',1,'2014-11-26 05:18:16',1,1),(38,7898,5,NULL,1,'2014-11-20 17:17:53',1,'2014-11-26 05:18:16',1,1),(39,7898,3,NULL,1,'2014-11-20 17:18:51',1,'2014-11-26 05:18:16',1,1),(40,4666,3,NULL,1,'2014-11-20 17:28:23',1,'2014-11-26 05:18:16',1,1),(41,6000,5,NULL,1,'2014-11-26 01:17:28',1,'2014-11-26 05:18:16',1,1),(42,5000,3,NULL,NULL,'2014-11-26 05:35:40',4,'2014-11-26 09:35:40',4,2),(43,500,1,NULL,NULL,'2014-11-26 05:39:15',4,'2014-11-26 09:39:15',4,2),(44,4500,1,NULL,NULL,'2014-11-26 05:40:43',4,'2014-11-26 09:40:43',4,2),(45,3150,1,NULL,NULL,'2014-11-26 05:41:13',4,'2014-11-26 09:41:13',4,2),(53,1500,3,NULL,2,'2014-11-26 14:34:41',7,'2014-11-26 20:12:27',7,5),(54,1500,1,NULL,2,'2014-11-26 14:42:48',7,'2014-11-26 20:12:27',7,5),(55,8200,1,NULL,2,'2014-11-26 16:09:22',7,'2014-11-26 20:12:27',7,5),(56,5510,1,NULL,2,'2014-11-26 16:10:18',7,'2014-11-26 20:12:27',7,5),(57,5000,1,NULL,2,'2014-11-26 16:10:44',7,'2014-11-26 20:12:27',7,5),(58,1000,2,NULL,2,'2014-11-26 16:11:29',7,'2014-11-26 20:12:27',7,5),(59,5000,3,NULL,3,'2014-12-02 11:11:02',7,'2014-12-02 17:20:13',7,8),(60,0,3,NULL,3,'2014-12-02 11:11:07',7,'2014-12-02 17:20:13',7,8),(61,0,3,NULL,3,'2014-12-02 11:11:22',7,'2014-12-02 17:20:13',7,8),(62,3000,1,NULL,3,'2014-12-02 11:51:20',7,'2014-12-02 17:20:13',7,8),(63,15000,2,NULL,3,'2014-12-02 12:13:19',7,'2014-12-02 17:20:13',7,8),(64,200,2,NULL,3,'2014-12-02 12:14:05',7,'2014-12-02 17:20:13',7,8),(65,2500,2,NULL,3,'2014-12-02 12:14:54',7,'2014-12-02 17:20:13',7,8),(66,5000,2,NULL,3,'2014-12-02 12:15:43',7,'2014-12-02 17:20:13',7,8),(67,100,2,NULL,3,'2014-12-02 12:16:23',7,'2014-12-02 17:20:13',7,8),(68,3500,3,NULL,4,'2014-12-09 01:46:13',7,'2014-12-09 06:47:34',7,8),(77,160,1,NULL,7,'2014-12-29 00:39:32',1,'2015-01-15 15:43:10',1,1),(78,80,1,NULL,9,'2015-01-15 10:50:43',1,'2015-03-29 20:24:27',1,1),(79,2080,1,NULL,9,'2015-02-14 02:45:23',1,'2015-03-29 20:24:27',1,1),(80,80,1,NULL,16,'2015-04-14 23:48:46',1,'2018-02-06 10:24:01',1,1),(81,20000,3,NULL,10,'2015-04-24 07:06:08',49,'2015-09-02 18:29:14',49,41),(82,80,1,NULL,16,'2015-07-25 14:34:17',1,'2018-02-06 10:24:01',1,1),(83,360,1,NULL,10,'2015-09-02 13:10:36',49,'2015-09-02 18:29:14',49,41),(84,600,1,NULL,10,'2015-09-02 13:12:14',49,'2015-09-02 18:29:14',49,41),(85,15000,3,NULL,10,'2015-09-02 13:18:46',49,'2015-09-02 18:29:14',49,41),(86,66000,1,NULL,10,'2015-09-02 13:24:18',49,'2015-09-02 18:29:14',49,41),(87,5000,2,NULL,10,'2015-09-02 13:26:34',49,'2015-09-02 18:29:14',49,41),(88,1000,1,'Reverted',12,'2015-10-27 03:57:51',60,'2015-10-27 09:17:57',60,50),(89,1000,5,NULL,12,'2015-10-27 03:59:44',60,'2015-10-27 09:17:57',60,50),(90,400,1,NULL,12,'2015-10-27 04:17:30',60,'2015-10-27 09:17:57',60,50),(91,1000,3,NULL,13,'2016-01-28 16:14:24',62,'2016-01-30 19:45:41',62,52),(92,1000,1,NULL,13,'2016-01-28 20:58:37',62,'2016-01-30 19:45:41',62,52),(93,2050,1,NULL,13,'2016-01-30 18:57:13',62,'2016-01-30 19:45:41',62,52),(94,60,1,NULL,14,'2016-01-30 19:47:30',62,'2016-01-30 20:22:31',62,52),(95,1050,1,NULL,14,'2016-01-30 20:15:00',62,'2016-01-30 20:22:31',62,52),(96,2060,1,'Reverted',14,'2016-01-30 20:15:21',62,'2016-01-30 20:22:31',62,52),(97,2060,5,NULL,14,'2016-01-30 20:16:24',62,'2016-01-30 20:22:31',62,52),(98,354,1,NULL,NULL,'2016-02-01 21:17:10',62,'2016-02-01 21:17:10',62,52),(99,1200,1,NULL,NULL,'2016-02-21 07:00:58',20,'2016-02-21 07:00:58',20,21),(100,1500,1,NULL,NULL,'2016-02-21 07:06:13',20,'2016-02-21 07:06:13',20,21),(101,2000,1,NULL,16,'2016-04-07 07:46:38',1,'2018-02-06 10:24:01',1,1),(102,240,1,NULL,15,'2016-06-28 15:19:06',49,'2016-06-28 18:51:46',49,41),(103,115000,3,NULL,15,'2016-06-28 15:31:44',49,'2016-06-28 18:51:46',49,41),(104,100,2,NULL,15,'2016-06-28 15:46:35',49,'2016-06-28 18:51:46',49,41),(105,6500,1,NULL,16,'2016-07-26 20:39:56',1,'2018-02-06 10:24:01',1,1),(106,4000,1,NULL,16,'2018-02-06 06:13:14',5,'2018-02-06 10:24:01',5,1),(107,545230,3,NULL,16,'2018-02-06 06:17:06',5,'2018-02-06 10:24:01',5,1);
/*!40000 ALTER TABLE `money_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(150) DEFAULT NULL,
  `body` text NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `campus_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `profit_amount` decimal(10,0) DEFAULT NULL,
  `balance_amount` decimal(10,0) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `profit_date` date DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profit_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profit`
--

LOCK TABLES `profit` WRITE;
/*!40000 ALTER TABLE `profit` DISABLE KEYS */;
INSERT INTO `profit` VALUES (1,-22836,-22416,NULL,NULL,'2014-11-26',1,'2014-11-26 05:18:16',1),(2,12410,17710,NULL,NULL,'2014-11-26',7,'2014-11-26 20:12:27',5),(3,-27200,-24800,NULL,NULL,'2014-12-02',7,'2014-12-02 17:20:12',8),(4,-3500,-3500,NULL,NULL,'2014-12-09',7,'2014-12-09 06:47:34',8),(7,20,160,NULL,NULL,'2015-01-15',1,'2015-01-15 15:43:10',1),(9,2020,2160,NULL,NULL,'2015-03-29',1,'2015-03-29 20:24:27',1),(16,-536980,-534730,NULL,NULL,'2018-02-06',5,'2018-02-06 10:24:01',1),(12,100,400,NULL,NULL,'2015-10-27',60,'2015-10-27 09:17:57',50),(13,1000,1000,NULL,NULL,'2016-01-30',62,'2016-01-30 19:45:41',52);
/*!40000 ALTER TABLE `profit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relation_types`
--

DROP TABLE IF EXISTS `relation_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relation_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `relation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_relation` (`relation`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_configurations`
--

LOCK TABLES `report_configurations` WRITE;
/*!40000 ALTER TABLE `report_configurations` DISABLE KEYS */;
INSERT INTO `report_configurations` VALUES (1,'http://e-karobar.com/uploads/campuses/OH/tmp/gurZjgKjtLNgEOYnA3z9-report-logo-thumb.jpg',10,'Student Details','Studens',21),(2,'http://e-karobar.com/uploads/campuses/vj/tmp/g2Kbeb7GIy8Dhufx0WV1-report-logo-thumb.jpg',20,'Myschool Name','Street 1 DHA Islamabad',41),(3,NULL,50,'Westernlink MTS','Report',52),(4,'http://localhost/e-karobar/uploads/campuses/ss/tmp/EuzDNQrIxQDvHtJIDcQz-report-logo-thumb.png',20,'My School','Enter to learn',1);
/*!40000 ALTER TABLE `report_configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reverted_transactions`
--

DROP TABLE IF EXISTS `reverted_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reverted_transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) DEFAULT NULL,
  `reverted_transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `sub_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(100) DEFAULT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `details` text,
  `contact_detail_id` int(10) DEFAULT NULL,
  `created_at_backup` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_school_contact_detail` (`contact_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'Ali Fida School','123',NULL,'0',1,'2014-12-10 10:21:40','2014-12-10 10:21:40','2015-07-07 18:53:18','Licenced',1),(5,'The Quest Public School','AM-191',NULL,NULL,21,'2014-12-10 10:21:40','2014-12-10 10:21:40','2015-07-07 18:53:18','Licenced',1),(13,'aligarh model public school ','ali32101',NULL,NULL,29,'2014-12-11 00:03:56','2014-12-11 00:03:56','2015-07-07 18:53:21','Licenced',1),(17,'The Quest Public School','A-191',NULL,NULL,33,'2014-12-10 10:21:40','2014-12-10 10:21:40','2015-07-07 18:53:27','Licenced',1),(18,'Al Rahber School Meelum','23301',NULL,'Main Campus',34,'2014-12-31 19:00:00','2014-12-31 19:00:00','2016-02-21 06:30:18','Licenced',1),(19,'Hazara Public School','123456',NULL,'',35,'2014-12-27 07:14:16','2014-12-27 07:14:16','2015-07-07 18:53:29','Licenced',1),(22,'GHSS Jamrud','gshah188',NULL,NULL,39,'2015-04-17 07:31:04','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(23,'Testing','123456',NULL,NULL,40,'2015-04-17 12:26:14','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(24,'Qasim Hall','Rwp_06_654',NULL,NULL,41,'2015-04-18 04:19:38','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(25,'Vision Islamic Public school ','9211',NULL,NULL,42,'2015-04-18 08:21:20','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(26,'Local Education Board','',NULL,NULL,43,'2015-04-18 12:11:38','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(28,'The TIME School and College Oghi','abc',NULL,NULL,47,'2015-04-21 14:46:15','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(29,'Edu Edge','007',NULL,NULL,50,'2015-06-17 02:35:58','2015-08-15 02:35:58','2015-08-17 06:58:46','Trail',NULL),(33,'The  Atcoms Oghi','3456',NULL,NULL,62,'2015-04-24 04:58:47','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(36,'E-karobar School','silver-001',NULL,NULL,68,'2015-04-24 06:49:24','2015-04-24 06:49:24','2015-07-07 18:53:35','Licenced',1),(37,'Merill ABD','999999999',NULL,NULL,70,'2015-05-10 16:56:58','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(38,'Haripur Ali Akbar High School','106465',NULL,NULL,72,'2015-05-31 19:35:33','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(39,'Western link Education','none',NULL,NULL,74,'2015-06-03 14:59:27','2015-07-02 20:00:00','2015-07-07 19:01:31','Trail',NULL),(40,'FG high school','042',NULL,NULL,84,NULL,'2015-08-10 11:13:31','2015-08-10 16:13:31','Trail',NULL),(41,'Nazia','21',NULL,NULL,86,NULL,'2015-08-10 11:21:43','2015-08-10 16:21:43','Trail',NULL),(42,'Micro Education System','17140',NULL,NULL,88,NULL,'2015-08-12 08:07:05','2015-08-12 13:07:05','Trail',NULL),(44,'test','test',NULL,NULL,92,NULL,'2015-09-02 10:24:38','2015-09-02 15:27:11','Licenced',NULL),(45,'ICOPS','1093',NULL,NULL,94,NULL,'2015-10-27 03:35:25','2015-10-27 08:35:25','Trail',NULL),(46,'Jinnah Muslim College','123456',NULL,NULL,96,NULL,'2015-10-28 01:17:29','2015-10-28 06:17:29','Trail',NULL),(47,'Westernlink MTS','1234',NULL,NULL,98,NULL,'2016-01-28 13:40:58','2016-01-28 13:40:58','Trail',NULL),(49,'mytest','123',NULL,NULL,103,NULL,'2016-03-11 13:30:25','2016-03-11 17:30:25','Trail',NULL),(50,'Ali Fida','214557',NULL,NULL,105,NULL,'2016-06-28 14:03:11','2016-06-28 17:03:11','Licenced',NULL);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_fee`
--

DROP TABLE IF EXISTS `student_fee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_fee` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fee_type_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `fee_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` varchar(10) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `paid_by` varchar(200) DEFAULT NULL,
  `comments` text,
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_feetype_student_date` (`fee_type_id`,`student_id`,`fee_date`),
  KEY `fk_student_fee_fee_types1` (`fee_type_id`),
  KEY `fk_student_fee_students1` (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_fee`
--

LOCK TABLES `student_fee` WRITE;
/*!40000 ALTER TABLE `student_fee` DISABLE KEYS */;
INSERT INTO `student_fee` VALUES (95,107,59,'2016-06-01',1000,'Due',NULL,NULL,NULL,NULL),(96,107,418,'2016-06-01',1000,'Due',NULL,NULL,NULL,NULL),(97,1,3,'2016-03-01',2000,'Paid','2016-07-27','1 - Ali Fida - Father','paid',105),(98,1,5,'2016-03-01',2000,'Due',NULL,NULL,NULL,NULL),(99,1,9,'2016-03-01',2000,'Paid','2018-02-06','Student','',106),(100,1,417,'2016-03-01',2000,'Due',NULL,NULL,NULL,NULL),(101,1,10,'2016-03-01',2000,'Due',NULL,NULL,NULL,NULL),(102,1,31,'2016-03-01',2000,'Due',NULL,NULL,NULL,NULL),(103,1,7,'2016-03-01',2000,'Due',NULL,NULL,NULL,NULL),(104,1,8,'2016-03-01',2000,'Due',NULL,NULL,NULL,NULL),(105,1,3,'2016-04-01',2000,'Paid','2016-07-27','1 - Ali Fida - Father','paid',105),(106,1,5,'2016-04-01',2000,'Due',NULL,NULL,NULL,NULL),(107,1,9,'2016-04-01',2000,'Paid','2018-02-06','Student','',106),(108,1,417,'2016-04-01',2000,'Due',NULL,NULL,NULL,NULL),(109,1,10,'2016-04-01',2000,'Due',NULL,NULL,NULL,NULL),(110,1,31,'2016-04-01',2000,'Due',NULL,NULL,NULL,NULL),(111,1,7,'2016-04-01',2000,'Due',NULL,NULL,NULL,NULL),(112,1,8,'2016-04-01',2000,'Due',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `student_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_items`
--

DROP TABLE IF EXISTS `student_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `comments` text,
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_items_students1` (`student_id`),
  KEY `fk_student_items_items1` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_items`
--

LOCK TABLES `student_items` WRITE;
/*!40000 ALTER TABLE `student_items` DISABLE KEYS */;
INSERT INTO `student_items` VALUES (31,418,16,'Paid',240,'2016-06-28',2,'2016-06-28','Student','',102),(32,59,18,'Due',200,'2016-06-28',2,NULL,NULL,NULL,NULL),(33,60,16,'Due',1200,'2016-06-28',10,NULL,NULL,NULL,NULL),(34,3,2,'Paid',2500,'2016-07-27',5,'2016-07-27','1 - Ali Fida - Father','paid',105),(35,419,14,'Due',100,'2018-02-06',1,NULL,NULL,NULL,NULL),(36,5,2,'Due',10500,'2018-02-06',21,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `student_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`),
  KEY `fk_students_classes1` (`class_id`),
  KEY `fk_campus_student` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=420 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (3,'Ahmad','Ali','Ali Fida','Male','123','23','1999-01-13','Islamabad',3,'Active','2014-01-01',NULL,1,NULL,'http://localhost/e-karobar/uploads/campuses/ss/students/systu-pic.jpg'),(5,'test kid','cccc','ccccc','Male','123','3','2010-12-24','222222',3,'Active','2014-01-01','2014-10-16',1,NULL,NULL),(7,'tttt','tttttttttts','ttttttts','Male','','23','2014-10-20','tttttttt',3,'Active','2014-01-01','2014-10-16',1,NULL,NULL),(8,'tttt','tttttttttts','ttttttts','Male','','123','2014-06-17','1111111111',3,'Active','2014-10-06',NULL,1,NULL,NULL),(9,'ddd','dddd','dddd','Male','','111','2008-12-29','dddd',2,'Active','2014-10-15',NULL,1,NULL,NULL),(10,'ff','ffff','fff','0','','2','2014-11-11','',2,'Active','0000-00-00',NULL,1,NULL,NULL),(13,'aa','aa','Aa','Male','345345','aa','2014-11-18','aaa',5,'Active','2014-11-26',NULL,1,NULL,'http://localhost/e-karobar/uploads/campuses/ss/students/sdstu-pic.jpg'),(14,'bbb','bbb','bb','Male','','bb','2014-11-18','bbb',5,'Active','2014-11-18',NULL,1,NULL,NULL),(15,'vvv','vvv','vvv','Male','','vvv','2014-11-21','vvv',6,'Active','2014-11-19',NULL,1,NULL,NULL),(16,'aaa','aa','Aaa','Male','','3','2014-10-27','asdf',3,'Active','2014-11-05',NULL,1,NULL,NULL),(18,'zzzz','zzzzz','zzzzz','Male','','123','2014-11-21','zzzzzzzzzzz',4,'Active','2014-11-18',NULL,1,NULL,NULL),(19,'fname','lname','father name','Male','','23','2014-11-26','address',10,'Active','2014-11-19',NULL,2,NULL,NULL),(20,'First ','aa','father name','Male','','2','2014-11-20','f',11,'Active','2014-11-06',NULL,2,NULL,NULL),(22,'sss','sss','ssss','Male','','12','2014-11-26','sssssss',15,'Active','2014-11-26',NULL,5,NULL,NULL),(23,'ssssssss','sss','sss','Male','','222','2014-11-05','sssss',15,'Active','2014-11-27',NULL,5,NULL,NULL),(24,'ttt','tt','ttt','Male','','ttt','2014-11-25','tttt',15,'Active','2014-11-24',NULL,5,NULL,NULL),(25,'ttt','ttt','ttt','Male','','ttt','2014-10-28','tttttt',15,'Active','2014-11-19',NULL,5,NULL,NULL),(26,'Abdulrehman','Khan','Bashir Ahmed Khan','Male','','01','2008-08-19','Bilal Town, Hashimi Colony',21,'Active','2013-01-01',NULL,8,NULL,'http://www.e-karobar.com/uploads/campuses/Od/students/ORstu-pic.png'),(27,'Talal','Khan','Alamgir Khan','Male','','01','2004-12-15','Bilal town, Hashmi Colony, Street No. 5',25,'Active','2006-03-14',NULL,8,NULL,NULL),(28,'Sadia','Faryal','Alamgir Khan','Male','','01','2009-10-13','Bilal Town, malir Halt, Karachi no. 23',20,'Active','2011-01-12',NULL,8,NULL,NULL),(29,'Azam ','Khan','Alamgir Khan','Male','','02','2005-06-16','Bilal Town, Muhallah Sehr wardia, Abbottabad',25,'Active','2005-06-15',NULL,8,NULL,NULL),(31,'fff','fff','f','Male','','23','2014-12-02','fsadf',2,'Active','2014-12-24',NULL,1,NULL,NULL),(34,'Aziz Ahmad','Khan','Ejaz Khan','Male','','1','2001-12-30','Vill Alam Haripur',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(35,'Abbas','Khan','Mohammad Younas Khan','Male','280','2','2001-04-22','Vill Jora Pind Haripur',42,'In Active','2012-04-10','2016-03-02',41,NULL,NULL),(36,'Hanzala',' Hafeez','Hafeez Ur Rehman','Male','','3','2001-01-09','Vill Dhindha',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(37,'Amna ','Waqar','Waqar Ahmad','Female','','01','2010-12-24','Malookra',43,'Active','2014-12-09',NULL,16,NULL,NULL),(38,'Aziz Ullah  ','Khan','Abdul Hameed Khan','Male','','04','2003-03-21','Dhendha, Haripur',42,'In Active','2014-04-10','2016-03-04',41,NULL,NULL),(39,'Basharat',' Khan','Ali Khan ','Male','','05','2000-05-21','Jora Pind, Haripur',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(40,'Anis','Raza','Nisar Ahmad','Male','','06','2003-04-12','Meelam, Haripur',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(41,'Shafeeq Ur','Rehman','Abdul Qayyum','Male','','07','2001-12-31','Darband, Haripur',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(42,'Fatima ','Safeer','Muhammad Safeer','Female','','08','2000-11-03','Dhendah, Haripur',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(43,'Rimsha ','Shoukat','Shoukat','Female','','09','2001-04-04','Meelam, Haripur',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(44,'Rubab','Aziz','Aziz Ur Rehman','Female','','10','2001-04-04','Meelam, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(45,'Maryam','bibi','Chanzeb','Female','','11','2001-07-23','Meelam, Haripur',42,'In Active','2012-04-10','2016-03-04',41,NULL,NULL),(46,'Ubaid','Ullah','Maqsood Khan','Male','','01','2002-11-20','Meelam, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(47,'Syed Mussadiq','Hussain','Syed Mazhar Hussain Shah','Male','','02','2015-06-22','Jora Pind, Haripur',42,'In Active','2013-03-10','2016-03-04',41,NULL,NULL),(48,'Hamza','Nisar','Nisar Ahmad','Male','','03','2002-04-09','Meelam, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(49,'Haris ','Ali','Qadeer Ahsin','Male','','04','2001-08-01','Meelam, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(50,'Muhammad ','Sami','Muhammad Javed Akhtar','Male','','05','2003-11-01','Meelam, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(51,'Awais ','Abid','Abid Sultan','Male','','05','2003-03-26','Dheendah, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(52,'Noman ','Rasheed','Abdul Rasheed','Male','','06','2003-04-11','Dheendah, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(53,'Arsh','Azeem','Muhammad Saleem','Male','','08','2002-05-07','Alam, Haripur',42,'In Active','2014-04-10','2016-03-04',41,NULL,NULL),(54,'Usman','Yousaf','Muhammad Yousaf','Male','','09','2009-09-10','Meelam, Haripur',42,'In Active','2014-04-10','2016-03-04',41,NULL,NULL),(55,'Areeba','Safeer','Muhammad Safeer','Female','','10','2002-10-29','Dhendah, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(56,'Um','-e-aimen','Tariq Mehmood','Female','','11','2003-03-11','Dhendah, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(57,'Hifsa','Ali','Wazir Ali','Female','','12','2002-04-10','Meelam,  Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(58,'Rania','bibi','Afsar Khan','Female','','13','2001-12-29','Darbanda, Haripur',42,'In Active','2013-04-10','2016-03-04',41,NULL,NULL),(59,'Saad Amin','Khan','Arshad Amin  Khan','Male','','01','2003-09-22','Dhendah, Haripur',106,'Active','2014-04-10',NULL,41,NULL,NULL),(60,'Arslan','Nawaz','Akhtar Nawaz','Male','','02','2003-02-06','Dhendah, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(61,'Ahsan','Khan','Arshad Khan','Male','','03','2003-09-17','Jora Pind, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(62,'Omer','Habib','Habib Ur Rehman','Male','','04','2002-06-13','Dhendah, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(63,'Zeeshan','Ahmad','Aziz Ur Rehman','Male','','05','2003-10-08','Meelam, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(64,'Safi Ullah',' Khan','Masood Khan','Male','','06','2004-05-20','Meelam, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(65,'Sadaqat ','Ali','Abdul Waheed','Male','','07','2003-09-12','Dhendah, Haripur',42,'Active','2014-04-10',NULL,41,NULL,NULL),(66,'Razi','Khan','Aurangzeb Khan','Male','','08','2002-01-15','Meelum, Haripur\n',109,'Active','2014-04-10',NULL,41,NULL,NULL),(67,'Furqan','Haider','Khurshid Ahmed','Male','','09','2002-01-23','Dehindah, Haripur',109,'Active','2014-04-10',NULL,41,NULL,NULL),(68,'Ali Raza ','Shah','Syed Munawar Hussain Shah','Male','','10','2004-05-12','Meelum,Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(69,'Abdul','Ahad','Muhammad Saddique','Male','1172','11','2002-10-31','Dehindah, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(70,'Saif','Ullah','Jahanger','Male','','12','2002-07-08','Meelum, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(71,'Danish ','Fareed','Ghulam Fareed','Male','','13','2015-01-12','Dhendah, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(72,'Muhammad','Usman','Abdul Hameed ','Male','','14','2015-01-12','Alam, Haripur',107,'Active','2015-01-12',NULL,41,NULL,NULL),(73,'Hamza','Khan','Aurangzeb','Male','','15','2015-01-12','Dhendah, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(74,'Kinza ','Khan','Fareed Khan','Female','','15','2003-09-17','Dhendah, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(75,'Lubna ','Javed','Javed Afsar','Female','','16','2003-07-03','Dhendah, Haripur',107,'Active','2014-04-10',NULL,41,NULL,NULL),(76,'Ayesha','Siddiqa','Abudllah Khan','Female','','16','2003-07-23','Dhendah, Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(77,'Aleesha','Kazmi','Syed Nazakat Hussain Shah','Female','','19','2003-03-21','Dhendah, Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(78,'Bushra','bibi','Phul Hussain Shah','Female','','20','2002-07-30','Dhendah, Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(79,'Areej','Fatima','Muhammad Tayyab','Female','','21','2003-08-10','Meelam, Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(80,'Alishba','bibi','Aziz Ur Rehman','Female','','22','2003-10-10','Meelam,Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(81,'Rimsha','Naeem','Naeem Akhtar','Female','','22','2003-09-05','Meelam, Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(82,'Areeba','Riaz','Riaz Ahmad','Female','','23','2004-05-10','Dhendah, Haripur',108,'Active','2014-04-10',NULL,41,NULL,NULL),(83,'Sumahia','Siddique','Muhammad Saddique','Female','','01','2004-03-11','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(84,'BIBI','Zainab','Chan Muhammad','Female','','02','2005-01-06','Meelam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(85,'Aneesa','Gul','Sherzada Khan','Female','','03','2005-10-01','Meelam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(86,'Awais ','Khan','Muhammad Younis Khan','Male','','04','2004-01-25','Jora, Pind',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(87,'Faizan ','Siddique','Muhammad Saddique','Male','','05','2004-04-13','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(88,'Qasim','Yousaf','Muhammad Yousaf','Male','','06','2003-11-02','Dhendah, Haripur',42,'In Active','2015-01-12','2016-03-05',41,NULL,NULL),(89,'Areeza','Sehar','Safder Nawa','Female','','07','2004-04-18','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(90,'Malaika','bibi','Abdul Qayyum','Female','','08','2004-12-03','Darbanda,Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(91,'Aqsa ','Ali','Wazir Ali','Female','','10','2004-04-21','Meelam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(92,'Sheryar','Khan','Islam Bahadar Khan','Male','','11','2004-02-02','Meelam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(93,'Abdullah','Qadeer','Abdul Qadeer','Male','946','12','2004-10-27','Dheendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(94,'Syeda Ifra','bibi','Syed Abdul Ghalib ','Female','','13','2004-04-05','Dhendah, Haripur',42,'In Active','2015-01-12','2016-03-05',41,NULL,NULL),(95,'Irsa','Abid','Abid Hussain','Female','','14','2004-01-01','Jora Pind, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(96,'Tahira','bibi','Syed Ikhlaq Hussain Shah','Female','','15','2005-02-01','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(97,'Waheed Ur','Rehman','Muhammad Arshad','Male','','16','2004-07-01','Meelam, Haripur',108,'Active','2008-04-07',NULL,41,NULL,NULL),(98,'Sami Ullah','Khan','Firdos Khan','Male','','17','2004-05-16','Jora, Pind Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(99,'Muhammad','Tayyab','Shoaraiz','Male','','18','2004-06-23','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(100,'Saba','Shaheen','Muhammad Ismail','Female','','20','2003-10-02','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(101,'Shazia ','bibi','Abdul Jalil','Female','','21','2003-11-28',' Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(102,'Ahmed','Mustafa','Muhammad Afsar','Male','','22','2015-01-13','Doyaan, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(103,'Bilal ','Ahmed','Ajaz Khan','Male','','23','2004-01-21','Alam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(104,'Aisha ','Zaman','Muhammad Zaman','Female','','24','2004-02-10','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(105,'Danish','Bashir','Bashir Ahmed','Male','','25','2003-10-18','Jora Pind, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(106,'Sumahia','Hafeez','Hafeez Ur Rehman','Female','','26','2003-08-14','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(107,'Muneeba','Hafeez','Hafeez Ur Rehman','Female','','27','2003-08-14','Dhendah, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(108,'Muhammad','Abdullah','Ijaz Ahmed','Male','','28','2015-01-12','Meelam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(109,'Maryam','Nisar','Nisar Ahmad','Female','','29','2015-01-12','Meelam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(110,'Muhammad ','Daud ','Ghulam Mustafa','Male','','30','2015-01-13','Kemp No-16, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(111,'Noor','Rehman','Habib Jang','Male','','31','2015-01-13','Alam, Haripur',42,'In Active','2008-04-07','2016-03-05',41,NULL,NULL),(112,'Fiza','Javed','Javed Afsar','Female','','01','2005-09-10','Dhindah, Haripur',42,'In Active','2011-04-15','2016-03-05',41,NULL,NULL),(113,'Aisma','Sultan','Sakhi Sultan','Female','','02','2005-03-24','Meelam, Haripur',42,'In Active','2009-04-10','2016-03-04',41,NULL,NULL),(114,'Naila','Habib','Habib Ur Rehman','Female','','03','2004-12-25','Dhindah, Haripur',108,'Active','2009-04-05',NULL,41,NULL,NULL),(115,'Syeda Noor','Fatima','Syed Nazakat Hussain Shah','Female','','04','2007-02-20','Jora Pind, Haripur',108,'Active','2009-04-10',NULL,41,NULL,NULL),(116,'Syeda Um','-e-Habiba','Syed Tanveer Ahmed Shah','Female','','05','2005-01-02','Dhindah, Haripur',109,'Active','2009-04-10',NULL,41,NULL,NULL),(117,'Aisha ','Jahangir','Jahangir','Female','','06','2004-12-13','Meelam, Haripur',42,'In Active','2009-04-10','2016-03-05',41,NULL,NULL),(118,'Fiza','bibi','Chan Hussain Shah','Female','','07','2006-08-20','Dhindah, Haripur',42,'In Active','2009-04-10','2016-03-05',41,NULL,NULL),(119,'Aisha','Qadeer','Abdul Qadeer','Female','','08','2005-05-08','Dhindah, Haripur',42,'In Active','2009-04-10','2016-03-05',41,NULL,NULL),(120,'Laiba',' Noor','Shamraiz','Female','','09','2006-03-01','Meelam, Haripur',42,'In Active','2009-04-10','2016-03-05',41,NULL,NULL),(121,'Ashir','Pervaiz','Pervaiz Ahmed','Male','','10','2015-01-13','Alam, Haripur',42,'In Active','2011-04-17','2016-03-05',41,NULL,NULL),(122,'Shah','zaib','Khalid Naeem','Male','','11','2015-01-12','Dhindah, Haripur',109,'Active','2009-04-10',NULL,41,NULL,NULL),(123,'Bilal','Ahmed','Shafiq Ur Rehman','Male','','12','2003-03-06','Meelam, Haripur',42,'In Active','2009-04-10','2016-03-05',41,NULL,NULL),(124,'Sheryar','Khan','Muhammad Ilyas','Male','','13','2004-12-15','Dhindah, Haripur',109,'Active','2012-04-10',NULL,41,NULL,NULL),(125,'Usman','Dilnawaz','Dil Nawaz','Male','','14','2003-06-01','Meelam, Haripur',42,'In Active','2011-04-17','2016-03-05',41,NULL,NULL),(126,'Misbah ',' Waheed','Abdul Waheed','Female','','15','2005-12-01','Dhindah, Haripur',42,'In Active','2010-04-11','2016-03-05',41,NULL,NULL),(127,'Umm','-e-Ammara','Tariq Mehmood','Female','','16','2005-12-25','Dhindah, Haripur',109,'Active','2011-04-17',NULL,41,NULL,NULL),(128,'Nayyab ','Fatima','Abdul Haseeb Khan','Female','','17','2006-04-17','Dhindah, Haripur',109,'Active','2011-04-17',NULL,41,NULL,NULL),(129,'Omama','Javed','Muhammad Javed','Female','','18','2004-07-15','Dhindah, Haripur',109,'Active','2011-04-17',NULL,41,NULL,NULL),(130,'Mahnoor','Afsar','M Afsar Khan','Female','','19','2005-09-10','Dhindah, Haripur',42,'In Active','2011-04-17','2016-03-05',41,NULL,NULL),(131,'Areesha ','Asif','Asif Khan','Female','1142','20','2003-03-15','Dhindah',42,'In Active','2011-04-10','2016-03-05',41,NULL,NULL),(132,'Momina ','Eman','Muhammad Javed','Female','835','21','2004-03-03','Dhinda',109,'Active','2008-04-05',NULL,41,NULL,NULL),(133,'Abdul','Baseer','Syed Ibrar Ahmad Shah','Male','1146','22','2005-03-06','Dhindah',42,'In Active','2014-05-05','2016-03-05',41,NULL,NULL),(134,'Huzaifa','Saeed','Saeed Akhtar','Male','906','23','2005-10-10','Dhindah',42,'In Active','2014-05-05','2016-03-05',41,NULL,NULL),(135,'Mudassar','Mustafa','Ghulam Mustafa','Male','920','24','2004-09-30','Dhindah',109,'Active','2014-05-05',NULL,41,NULL,NULL),(136,'Abdul','Ghani','Muhammad Saleem','Male','950','25','2004-05-08','Dhindah',42,'In Active','2014-05-05','2016-03-05',41,NULL,NULL),(137,'Ruman ','Ali','Zahoor Elahi','Male','901','26','2004-12-12','Meelum',109,'Active','2014-05-05',NULL,41,NULL,NULL),(138,'Hammad ','Asif','Asif Khan','Male','1143','27','2003-10-24','Dhindah',42,'In Active','2014-05-05','2016-03-05',41,NULL,NULL),(139,'Sarmad','Iqbal','Zahid Iqbal Khan','Male','910','28','2005-03-26','Dhindah',109,'Active','2014-05-05',NULL,41,NULL,NULL),(140,'Mobeen','Yousaf','Muhammad Yousaf','Male','862','29','2006-01-27','Meelam',42,'In Active','2014-05-05','2016-03-05',41,NULL,NULL),(141,'Arslan','Akhtar','Akhtar Nawaz','Male','1144','30','2005-12-30','Dhindah',42,'In Active','2014-05-05','2016-03-05',41,NULL,NULL),(142,'Muhammad ','Hassan','Muhammad Younis','Male','1026','31','2004-08-25','Dhindah',109,'Active','2014-05-05',NULL,41,NULL,NULL),(143,'BiBi','Khudija','Chan Muhammad','Female','1125','1','2007-07-15','Meelam, Haripur',109,'Active','2012-04-10',NULL,41,NULL,NULL),(144,'Shamama','-e-maryam','Baber Ghafoor alvi','Female','1057','2','2008-01-17','Haripur',109,'Active','2012-04-10',NULL,41,NULL,NULL),(145,'Abdul','Rehman','Sajjad ahmed','Male','1048','03','2007-09-17','Darbanda',109,'Active','2012-04-10',NULL,41,NULL,NULL),(146,'Fatima','Zaman','Muhammad Zaman','Female','1056','4','2015-01-13','Dhindah, Haripur',109,'Active','2012-04-10',NULL,41,NULL,NULL),(147,'Liza','bibi','Muhammad Ramzan','Female','1016','5','2007-09-10','Meelam, Haripur',109,'Active','2012-04-10',NULL,41,NULL,NULL),(148,'Noor ','Fatima','Syed Abdul Ghalib Shah','Female','nil','6','2015-01-28','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(149,'Iftikhar ','Alam','Sher Alam','Male','1036','7','2008-01-09','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(150,'Abdullah','Anjum','Safdar Nawaz','Male','nil','8','2015-01-13','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(151,'Zeeshan','ali','Saif ur Rehman','Male','1119','9','2007-10-24','Alam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(152,'Abdul ','Basit','Muhammad Ilyas','Male','nil','10','2015-01-13','Camp, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(153,'Samiullah','Qazi','Saeed Qazi','Male','1189','11','2006-04-06','Meelam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(154,'Asher ','Niaz','Niaz Ahmad','Male','1049','12','2006-10-01','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(155,'Zain','Ali Tariq','Muhammad Tariq','Male','1031','13','2007-04-18','Meelam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(156,'Haider Ali','Khan','Noor ul Amin','Male','1067','15','2007-04-02','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(157,'Irsa','bibi','Ismail Khan','Female','1156','15','2007-01-10','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(158,'Alishba','bibi','Syed Rafaqat Shah','Female','1033','1033','2007-11-06','Jora Pind, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(159,'Laraib',' Ijaz','Muhammad Ijaz Khan','Female','1065','17','2008-07-15','Meelam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(160,'Abdul','Mohiz','Muhammad Asif','Male','1137','18','2015-01-13','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(161,'Safi ','Ulllah','Asmat Ullah','Male','1175','19','2005-01-01','Camp, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(162,'Hajira','bibi','Jamshed','Female','1074','20','2007-09-26','Alam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(163,'Abdul Manan','Shah','Syed Rasool Shah','Male','1130','21','2007-01-27','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(164,'Danish','Shah','Syed Akhtar shah','Male','1136','22','2007-04-10','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(165,'Sumra ','bibi','Sabir Shah','Female','1015','23','2006-12-11','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(166,'Manail ','bibi','Pervaiz Akhtar','Female','1126','1','2007-09-14','Jora Pind, Haripur',110,'Active','2012-04-17',NULL,41,NULL,NULL),(167,'Wali','Ullah','Abdul Ha bib Khan','Male','1052','02','2015-01-13','Dhindah, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(168,'Haroon','K han','Qasim Khan','Male','1127','03','2007-09-01','Alam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(169,'Wasif','Khan','Ijaz Khan','Male','1063','04','2007-03-02','Alam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(170,'Mehraj','Khan','Abdul Rehman','Male','1060','05','2006-12-09','Camp, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(171,'Muzammal','Pervaiz','Pervaiz Akhtar','Male','1167','6','2007-01-20','Dhindah, Haripur',110,'Active','2011-04-17',NULL,41,NULL,NULL),(172,'Zia ','Ullah','Sherzada','Male','1124','08','2007-03-16','Meelam, Haripur',110,'Active','2012-04-10',NULL,41,NULL,NULL),(173,'Husnain ','Azmat','Azmat Khan','Male','1068','09','2007-07-27','Meelam, HAripur',110,'Active','2011-04-17',NULL,41,NULL,NULL),(174,'Laiba','Sultan','Sakhi Sultan','Female','1040','10','2006-09-29','Meelam, Haripur',110,'Active','2012-05-17',NULL,41,NULL,NULL),(175,'Kamil','Shahazad','Ziafat Shahzad','Male','1235666','1','2014-02-24','',50,'Active','2014-09-17',NULL,22,NULL,NULL),(176,'Abu Bakar','Naeem','Muhammad Naeem','Male','556469895','2','2013-04-09','',50,'Active','2014-03-18',NULL,22,NULL,NULL),(177,'Husnain','Khan','Nisar','Male','899746565','5','2013-05-20','',50,'Active','2015-02-01',NULL,22,NULL,NULL),(178,'Saif','-ur-Rehman','Mumtaz','Male','1000','1','2006-01-14','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(179,'Abdullah ','Khan','Chanzeb Khan','Male','919','2','2006-08-21','Meelam, Haripur',42,'In Active','2010-04-12','2016-03-05',41,NULL,NULL),(180,'Muqadas','bibi','Syed Manzoor Hussain Shah','Female','963','03','2006-07-09','Jora Pind, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(181,'Habib ','Ahsan','Qadir Ahsan','Male','966','04','2005-11-02','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(182,'Abrish ','Noor','Islam Bahadar Khan','Female','988','05','2006-03-02','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(183,'Maryam','Nawaz','Haq Nawaz','Female','1003','06','2005-06-22','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(184,'Usama','Pervaiz','Muhammad Pervaiz','Male','989','07','2007-03-16','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(185,'Manail ','Javed','Muhammad Javed','Female','992','08','2007-02-24','Meelam, Haripur ',110,'Active','2010-04-12',NULL,41,NULL,NULL),(186,'Nouman','Shehzad','Abdul Rahman','Male','1151','10','2015-01-13','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(187,'Irsa','bibi','Abdul Jalil','Female','1156','11','2015-02-07','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(188,'Aysha','bibi','Khanzada Khan','Female','979','12','2006-02-24','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(189,'Mudassar','Khan','Muhammd Siddique Khan','Male','960','13','2006-05-05','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(190,'Aneesa','bibi','Sherdil Khan','Female','1008','14','2009-11-19','Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(191,'Momina ','Qadir','Abdul Qadir','Female','993','15','2007-01-23','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(192,'Abdul','Majid','Abid Hussain','Male','962','16','2005-12-12','Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(193,'Hasan ','Ali','Wazir Ali','Male','1035','1035','2015-01-13','Dhindah, Haripur ',110,'Active','2010-04-12',NULL,41,NULL,NULL),(194,'Muhammd ','Osama','Muhammd Rafique','Male','997','19','2005-06-30','Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(195,'Muhammad ','Sameer','Sudheer Iqbal','Male','1150','20','2007-06-30','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(196,'Muhammad','Huzaifa','Ssaeed Ur Rehman','Male','1028','22','2015-01-13','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(197,'Fatima','Saeed','Saeed Akhtar','Female','965','23','2006-12-20','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(198,'Fahad ','Pervaiz','Pervaiz Akhtar','Male','1069','25','2006-12-16','Jora Pind',110,'Active','2010-04-12',NULL,41,NULL,NULL),(199,'Malaika','Noor','Ajmal Hussain Shah','Female','1019','26','2008-05-19','JoraPind, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(200,'Irsa','bibi','Farid Khan','Female','972','27','2009-06-23','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(201,'Musfira','Siddique','Abdullah Khan','Female','1002','28','2006-10-18','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(202,'Abdullah','bin Masood','Masood ur Rehman','Male','959','29','2006-02-26','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(203,'Saif','ur Rehman','Raza Mehmood Khan','Male','1001','30','2006-10-12','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(204,'Mehr','Ali Kazmi','Nazakat Shah','Male','996','31','2006-06-17','Dhindah, HAripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(205,'Saad','Mehmood','Abdul Hameed','Male','954','32','2006-06-05','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(206,'Hamza ','Shah','Syed Phul Hussain Shah','Male','964','32','2006-11-17','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(207,'Yasir','Mehmood','Arshid Mehmood','Male','1160','33','2003-08-14','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(208,'Asad','Ullah Khan','Zahid Iqbal Khan','Male','911','34','2006-04-19','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(209,'Ikram','Ull Haq','Nizakat Sussain','Male','1059','35','2005-05-22','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(210,'Usman','Ali','Ikhlaq Hussain Shah','Male','975','36','2006-02-25','Meelam, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(211,'Muhammad ','Junaid','Mohammad Javed','Male','1158','36','2003-03-21','Dhindah, HAripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(212,'Sana','Siddique','Muhammad Siddique','Female','1157','37','2002-10-31','Dhindah, HAripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(213,'Sawaira','bibi','Abdul Qayyum','Female','968','37','2006-06-28','Dhindah, Haripur',110,'Active','2010-04-12',NULL,41,NULL,NULL),(214,'Usman ','Ghani','Riasat Khan','Male','918','38','2005-01-29','Jora Pind, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(215,'Zohaib','Abbas','Abbas Qazi','Male','1147','39','2005-11-05','Meelam, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(216,'Abdul ','Samad','Tanveer Shah','Male','976','40','2006-08-21','Dhindah, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(217,'Azka','Riasat','Muhammad Riasat','Female','969','40','2005-11-09','Dhindah, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(218,'Aisha','Riaz','Riaz Ahmed','Female','970','41','2006-12-12','Darbanda, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(219,'Aamir','Ahmed','Ahmed Shah','Male','999','42','2006-08-15','Meelam, Haripur',42,'In Active','2010-04-12','2016-03-02',41,NULL,NULL),(220,'Abdullah','Zeeshan','Zeeshan Ali','Male','967','43','2006-06-17','Dhindah, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(221,'Mishal','bibi','Sadaqat','Female','1148','43','2006-08-07','Meelam, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(222,'Usman','Ali Shah','Ikhlaq Hussain Shah','Male','1018','44','2007-02-20','Dhindah, Haripur',42,'Active','2010-04-12',NULL,41,NULL,NULL),(223,'Anish','bibi','Abdul Hafeez Khan','Female','0','1','2008-08-27','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(224,'Abdhullah','Ijaz','Ijaz ur Rehman','Male','0','02','2009-07-21','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(225,'Afia ','Habib','Habib Ur Rehman','Female','1240','03','2009-01-29','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(226,'Abdullah ','Khan','Muhammad Isma Khan','Male','1194','04','2008-11-13','Dhindah, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(227,'Bakhtawar','Khan','Asghar Khan','Female','1195','05','2009-02-21','Darbanda, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(228,'Esha','Khan','Iqbal Khan','Female','1235','06','2009-03-06','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(229,'Hammad','Ali','Aurangzeb Khan','Male','1230','07','2009-08-22','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(230,'Habib','Ullah Zeeshan','Zeeshan Ali','Male','1227','08','2009-11-28','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(231,'Hamza','Saeed','Saeed Akhtar','Male','1225','09','2009-06-20','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(232,'Laiba ','Rani','Mazhar Iqbal','Female','1264','10','2015-01-13','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(233,'Misbah','Khan','Shah Nawaz','Female','1236','11','2009-05-24','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(234,'Mudassar','Iqbal','Muhammad Iqbal','Male','1229','12','2009-07-23','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(235,'Faisal','Shah','Syed Qaisar Shah','Male','1222','13','2009-02-17','Jora Pind, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(236,'Naseer','Ahmed','Ahmed Shah','Male','1232','14','2008-04-10','Alam, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(237,'Ramla','bibi','Syed Rasool Shah','Female','1248','15','2009-01-28','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(238,'Sami',' Ullah','Khanzada Khan','Male','1219','16','2009-01-21','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(239,'Tayyaba','Rani','Abdul Jaleel','Female','1191','17','2009-02-07','Dhindah, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(240,'Hussain ','Rehmani','Naveed Akhtar Rehmani','Male','1252','00','2009-11-19','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(241,'Saim','Ali','Tahir Mehmood','Male','1266','01','2011-01-15','Darbanda, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(242,'Tayyab','Mustafa','Ghulam Mustafa','Male','1165','02','2008-08-28','Dhinda, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(243,'Talha','Niaz','Niaz Ahmed','Male','1263','03','2010-07-13','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(244,'Yashfa','Rehman','Babu Mumtaz','Female','1217','30','2009-06-20','Dhindah, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(245,'Zakia','bibi','Muhammad Khan','Female','1233','31','2008-08-02','Alam, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(246,'Syed Ibrar','Shah','Syed Akhtar Hussain Shah','Male','1255','32','2009-07-08','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(247,'Sibgha ','Shahzadi','Abdul Hameed','Female','1220','33','2009-10-23','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(248,'Hifza','Khalid','Khalid','Female','1224','34','2008-05-12','Dhindah, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(249,'Haseen','Ullah','Sher Zaman','Male','1262','35','2006-01-01','Camp, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(250,'Syeda','Eshal bibi','Syed Abdul Ghalib Shah','Female','1216','36','2009-03-08','Darband, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(251,'Muhammad ','Ibrahim Khan','Abdul Raheem Khan','Male','1234','37','2008-10-12','Meelam, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(252,'Laiba','Noor','Qazi Siraj Ul Haq','Female','1165','38','2010-02-16','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(253,'Muhammad Saad Khan ','Tareen','Sher Dil Khan','Male','1243','40','2010-03-25','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(254,'Safa ','Rani','Aurangzeb Khan','Female','1231','37','2009-08-12','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(255,'Hassam','Ali','Kamran','Male','1247','37','2009-04-30','Meelam, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(256,'Khalid','Khan','Zalmy','Male','1223','38','2009-09-20','Camp, Haripur ',42,'Active','2014-04-14',NULL,41,NULL,NULL),(257,'Mudassar','Iqbal','Muhammad Iqbal','Male','1228 ','40','2009-07-23','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(258,'Areeba','bibi','Muhammad Saeed','Female','1218','41','2009-03-21','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(259,'Mohammad','Khan','Riasat Khan','Male','1196','42','2009-01-23','Camp, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(260,'Amir','Ijaz','Muhammad Ijaz','Male','1173','42','2010-01-08','Alam, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(261,'Mubashir ','Hassan','Naveed Khan','Male','1215','01','2010-06-05','Dhindah, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(262,'Ibrar','Ijaz','Ijaz Khan','Male','1213','02','2010-09-23','Dhindah, Haripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(263,'Aqsa','Mehal bibi','Azhar Khan','Female','1193','03','2009-12-06','Dhindah, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(264,'Abdul ','Bari','Amir Zaman','Male','1250','04','2009-11-27','Dhindah, HAripur',42,'Active','2014-04-14',NULL,41,NULL,NULL),(265,'Fname','lname','father name','0','123456','23','2015-02-23','23',3,'Active','2015-02-24',NULL,1,NULL,NULL),(266,'assa','asas','asdd','0','1235666','1','2015-01-28','',51,'Active','2015-01-28',NULL,22,NULL,NULL),(267,'xxxc','eweq','erf','0','1235666','2','2015-02-01','',51,'Active','2015-01-28',NULL,22,NULL,NULL),(268,'rtt','bv','gh','0','34555555','3','2015-02-08','',51,'Active','2015-01-25',NULL,22,NULL,NULL),(270,'Muhammad','Ali','Ahmad Bilal','Male','SL-001','01','2002-03-01','House No. 1, Street, 2, Sector, Islamabad',42,'Active','2015-04-24',NULL,41,NULL,NULL),(271,'Test','test','test','0','999888','9','2013-04-04','',112,'Active','2015-05-06',NULL,42,NULL,NULL),(272,'Naznin','Naher','Abdul Momin Mozumder','Female','001','1','2002-01-02','Purba Shilua, Chhagalnaiya, Feni',119,'Active','1999-01-02',NULL,43,NULL,NULL),(273,'ABOAGYE ','GABRIELLE','ABOAGYE ','Female','1','A','2012-12-12','',122,'Active','2015-06-08',NULL,44,NULL,NULL),(274,'Danish','Javed','Javed Ahmed','Male','1','1','2015-07-26','CB12',132,'Active','2015-08-06',NULL,46,NULL,NULL),(275,'Ahmad','khan','fathername','Male','123354','1','2015-10-27','address',153,'Active','2015-10-01',NULL,50,NULL,NULL),(276,'jan','jansen','John','Male','0001','A','2015-11-02','',163,'In Active','2016-02-01','2016-01-30',52,NULL,'http://e-karobar.com/uploads/campuses/vk/students/l6stu-pic.jpg'),(277,'esther','mulier','mark','Female','0002','A','2010-04-14','',162,'In Active','2016-01-28','2016-01-30',52,NULL,NULL),(278,'randaal','mul','mark','Male','0003','1','2010-01-01','',162,'In Active','2015-12-01','2016-01-30',52,NULL,NULL),(279,'ABOAGYE','G YAA KONAKU.G','name','Female','1','A','2016-01-01','',163,'Active','2016-01-31',NULL,52,NULL,NULL),(280,'ADUAMAH',' N. O. LESLYN','name','Female','2','A','2016-01-01','',163,'Active','2016-01-31',NULL,52,NULL,NULL),(281,'AGYEMAN',' Y. O. ADWOA  .B.','name','Male','3','A','2016-01-01','',163,'Active','2016-01-31',NULL,52,NULL,NULL),(282,'NYARKO DUAH','KENEDY','name','0','4','A','2016-01-01','',163,'Active','2016-01-31',NULL,52,NULL,NULL),(283,'KU WARE','N.BILLIAN','name','0','5','A','2016-01-01','',163,'Active','2016-01-31',NULL,52,NULL,NULL),(284,'SARFO OSEI ODURO','PRINCE','name','0','6','A','2016-01-01','',164,'Active','2016-01-31',NULL,52,NULL,NULL),(285,'AFRIYIE B NANA',' AKUA','name','Female','7','A','2016-01-01','',165,'Active','2016-01-31',NULL,52,NULL,NULL),(286,'Mohavia ','Saif','saifullah','0','1','1','2009-01-31','meelum',167,'Active','2016-01-31',NULL,53,NULL,NULL),(287,'Bibi','zanab','Chan Muhammad','Female','354','1','2005-06-01','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(288,'Irsa','Abid','Abid Hussain','Female','355','2','2004-01-01','New jora pinda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(289,'Aneesa','Bibi','Sherzada','Male','356','3','2005-10-01','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(290,'Sumahia','Siddiq','Muhammad Siddiq','Female','357','4','2004-03-11','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(291,'Maryam','Nisar','Nisar Ahmed','Female','355','5','2009-09-20','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(292,'Aqsa','Ali','Wazeer Ali','Female','358','6','2004-04-21','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(293,'Muneeba','Hafeez','Hafeez ur rehman','0','359','7','2005-08-14','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(294,'Sumahia','Hafeez','Hafeez ur rehman','Female','360','8','2005-08-14','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(295,'Syeda','Tahira','Syed akhlaq hussain shah','Female','361','9','2005-02-01','Daheenda',42,'Active','2015-04-04',NULL,41,NULL,NULL),(296,'Syeda irfa','Bibi','Syed abdul ghalib shah','Female','362','10','2004-04-05','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(297,'Malaika','Bibi','Abdul qayyum','Female','363','11','2004-12-03','Darbanda',42,'Active','2016-04-11',NULL,41,NULL,NULL),(298,'Areeza','Sehr','Safdar nawaz','Female','364','12','2004-09-18','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(299,'Aisha','Zaman','Muhammad zaman','Female','365','13','2004-02-10','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(300,'Nabila','naz','Haqnawaz','Female','366','14','2004-09-09','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(301,'Muhammad','Abdullah','ijaz mehmood','Male','367','15','2005-04-06','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(302,'Sheryar','khan','Islam bahadur khan','Male','368','16','2004-02-02','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(303,'Muhammad','Faizan','Muhammad Siddiq','Male','369','17','2004-04-13','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(304,'Bilal ahmed','khan','Ijaz khan','Male','370','18','2004-01-21','Alam',42,'Active','2015-04-11',NULL,41,NULL,NULL),(305,'Abdullah','qadeen','abdul qadeer','Male','371','19','2004-10-27','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(306,'Awais','khan','Muhammad yonus khan','Male','372','20','2004-01-25','New jora pind',42,'Active','2015-04-11',NULL,41,NULL,NULL),(307,'sami ullah','khan','firdoos khan','Male','373','21','2015-05-16','New jora pind',42,'Active','2015-04-11',NULL,41,NULL,NULL),(308,'Muhammad','Tayyab','Sharez','Male','374','374','2004-06-23','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(309,'Muhammad','Hanif','Naseer ahmed','Male','375','375','2003-10-17','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(310,'Ahmed','Mustafa','Muhammad Afsar','Male','376','24','2005-06-03','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(311,'Areeba','safeer','Muhammad safeer','Female','304','1','2002-10-29','Daheenda',42,'Active','2013-10-04',NULL,41,NULL,NULL),(312,'Um e','Amin','Tariq mehmood','Female','305','2','2003-04-11','Daheenda',42,'Active','2013-04-10',NULL,41,NULL,NULL),(313,'Nuhman','Rasheed','Abdul rashid','Male','321','3','2003-04-11','Daheenda',42,'Active','2013-04-10',NULL,41,NULL,NULL),(314,'Muhammad','sami','Muhammad javed akhter','Male','318','4','2003-11-01','Meelun',42,'Active','2013-04-10',NULL,41,NULL,NULL),(315,'Hamza','nasir','Nisar Ahmed','Male','303','5','2002-04-09','Meelum',42,'Active','2013-04-10',NULL,41,NULL,NULL),(316,'Syed musadiq hussain','shah','Syed mazhar hussain shah','Male','302','6','2002-06-22','Chohar colony',42,'Active','2013-04-10',NULL,41,NULL,NULL),(317,'Saad amin','khan','Arshad anmin khan','Male','323','1','2003-09-22','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(318,'Muhammad aRSLAN','nawaz','Akhter nawaz','Male','324','2','2003-02-06','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(319,'Abdul ahad','sidique','Muhammad sdique','Male','331','3','2002-10-31','Daheenda',42,'Active','2014-10-10',NULL,41,NULL,NULL),(320,'Saif ullha','Jahngeer','Jahngeer','Male','342','4','2002-07-08','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(321,'Muhammad','Usman','Abdul Hameed','Male','346','5','2004-06-17','Dpiya aabi',42,'Active','2014-04-10',NULL,41,NULL,NULL),(322,'Danish','Fareed','Ghulam Fareed','Male','345','6','2004-05-05','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(323,'Malik Furqan','Haider','Malik Khurshid ahmed awan','Male','343','7','2002-01-23','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(324,'Hamza','khan','Aurangzeb khan','Male','344','8','2002-12-14','Daheenda',42,'Active','2014-04-14',NULL,41,NULL,NULL),(325,'Safi Ullah','Khan','Masood khan','Male','328','9','2004-05-20','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(326,'Sadaqat','Ali','Abdul Waheed','Male','329','329','2003-09-12','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(327,'Umer','Habib','Habib ur rehman','Male','326','11','2002-06-03','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(328,'Haris','Azmat','Azmat khan','Male','353','12','2002-11-24','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(329,'Razi','Khan','Aurangzeb khan','Male','330','13','2002-11-15','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(330,'Osama','Azmat','Azmat khan','Male','352','14','2002-11-24','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(331,'Zeeshan','a','Aziz ur rehman','Male','327','15','2003-10-18','Meelum',42,'Active','2015-04-11',NULL,41,NULL,NULL),(332,'Abdul',' Basit','Rabnawaz','Male','351','16','2003-01-18','Daheenda',42,'Active','2015-04-11',NULL,41,NULL,NULL),(333,'Syed Ali Raza','shah','syed Munawar Hussain Shah','Male','341','17','2004-05-02','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(334,'Lubna','Javed','Javed Afsar','Female','333','18','2003-07-03','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(335,'Kinza','Khan','Fareed Khan','Female','332','19','2003-09-17','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(336,'Aleesha','Kazmi','Syed Nazaqat Hussain Shah','Female','335','20','2003-03-21','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(337,'Bushra','Bibi','Phool Hussain Shah','Female','336','336','2002-07-30','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(338,'Areeba','Riaz','Riaz Ahmed','Female','338','22','2004-05-10','Darbanda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(339,'Rimsha','a','Naeem Akhter','Female','339','23','2003-09-05','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(340,'Alishba','khan','Aziz ur rehman','Female','340','24','2003-10-10','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(341,'Areej','Fatima','Muhammad Tayyab','Female','337','25','2003-08-10','Meelum',42,'Active','2014-04-10',NULL,41,NULL,NULL),(342,'Fiza',' Javed','Javed afsar khan','Female','1027','1','2005-09-10','Daheenda',42,'Active','2011-04-15',NULL,41,NULL,NULL),(343,'Misbah','a','Abdul Waheed','Female','924','2','2005-12-01','Daheenda',42,'Active','2009-04-07',NULL,41,NULL,NULL),(344,'Momina','Eman','Muhammad Javed','Female','835','3','2004-03-03','Meelum',42,'Active','2008-04-05',NULL,41,NULL,NULL),(345,'Syeda Noor Fatima','Bibi','Syed Nazaqat','Female','935','4','2007-02-20','New jora pind',42,'Active','2009-04-10',NULL,41,NULL,NULL),(346,'Naila','Habib','Habib ur rehman','Female','899','5','2004-12-25','Daheenda',42,'Active','2009-04-05',NULL,41,NULL,NULL),(347,'Syeda um e','Habiba','Syed tanvir hussain shah','Female','914','6','2005-01-02','Daheenda',42,'Active','2009-04-05',NULL,41,NULL,NULL),(348,'UM E','AMMARAH','TARIQ MEHMOOD','Female','927','7','2005-12-25','Daheenda',42,'Active','2009-04-07',NULL,41,NULL,NULL),(349,'LAIBA','NOOR','SHAMREZ','Female','922','8','2006-03-01','Meelum',42,'Active','2009-04-07',NULL,41,NULL,NULL),(350,'AISHA','QADEER','ABDUL QADEER','Female','913','9','2005-08-08','Daheenda',42,'Active','2009-04-05',NULL,41,NULL,NULL),(351,'MAHNOOR','AFSAR','MUHAMMAD AFSAR KHAN','Female','905','10','2005-09-10','Darbanda',42,'Active','2009-05-04',NULL,41,NULL,NULL),(352,'AREESHA','ASIF','ASIF KHAN','Female','1142','11','2003-03-15','Daheenda',42,'Active','2013-04-05',NULL,41,NULL,NULL),(353,'SYEDA MUQADDAS','BIBI','SYED MAZHAR HUSSAIN SHAH','Female','963','12','2006-07-09','New jora pind',42,'Active','2010-04-01',NULL,41,NULL,NULL),(354,'FIZA','BIBI','CHAN HUSSAIN SHAH','Female','923','13','2006-08-20','Darbanda',42,'Active','2009-04-07',NULL,41,NULL,NULL),(355,'AYESHA','JAHANGIR','JAHANGIR','Female','949','14','2004-12-13','Meelum',42,'Active','2009-05-15',NULL,41,NULL,NULL),(356,'NAYAB','FATIMA','ABDUL HASEEB KHAN','Female','1025','15','2006-04-17','Daheenda',42,'Active','2011-04-15',NULL,41,NULL,NULL),(357,'UMAMA','BIBI','MUHAMMAD JAVED','Female','904','16','2004-07-18','Daheenda',42,'Active','2009-04-05',NULL,41,NULL,NULL),(358,'SARMAD','IQBAL','ZAHID IQBAL KHAN','Male','910','17','2005-03-26','Daheenda',42,'Active','2009-04-05',NULL,41,NULL,NULL),(359,'HAMMAD','ASIF','ASIF KHAN','Male','1143','18','2003-10-29','Daheenda',42,'Active','2013-05-05',NULL,41,NULL,NULL),(360,'RUMAN','ALI','ZAHOOR ELAHI','Male','901','19','2004-12-17','Meelum',42,'Active','2009-04-05',NULL,41,NULL,NULL),(361,'MUHAMMAD','USMAN','DILNAWAZ','Male','900','20','2003-06-01','Meelum',42,'In Active','2009-04-05','2016-03-05',41,NULL,NULL),(362,'ARSLAN','AKHTAR','AKHTAR NAWAZ','Male','1144','21','2005-12-30','Daheenda',42,'Active','2013-05-05',NULL,41,NULL,NULL),(363,'MUHAMMAD MUBEEN','YOUSAF','MUHAMMAD YOUSAF','Male','862','22','2006-01-27','Meelum',42,'Active','2008-04-06',NULL,41,NULL,NULL),(364,'ABDUL','GHANI','MUHAMMAD SALEEM','Male','950','24','2004-05-08','Daheenda',42,'Active','2010-04-05',NULL,41,NULL,NULL),(365,'ASHIR','PERVEZ','PERVEZ AKHTAR','Male','1020','25','2003-10-28','Aalum',42,'Active','2011-04-15',NULL,41,NULL,NULL),(366,'BILAL','AHMED','SHAFIQ UR REHMAN','Male','926','26','2005-06-06','Meelum',42,'Active','2009-04-07',NULL,41,NULL,NULL),(367,'MUDASSAR','MUSTAFA','GHULAM MUSTAFA','Male','920','27','2004-09-30','Daheenda',42,'Active','2009-04-07',NULL,41,NULL,NULL),(368,'HAZAIFA','SAEED','SAEED AKHTAR','Male','906','28','2005-10-10','Meelum',42,'Active','2009-04-05',NULL,41,NULL,NULL),(369,'SYAD ABDUL BASEER AHMED','SHERAZI','SYED IBRAR AHMED SHAH','Male','1253','29','2005-03-06','Daheenda',42,'Active','2014-04-24',NULL,41,NULL,NULL),(370,'MUDASIR','KHAN','MUHAMMAD SIDDIQUE','Male','960','1','2006-05-05','Daheenda',42,'Active','2010-04-07',NULL,41,NULL,NULL),(371,'NOHMAN','SHEHZAD','ABDUL REHMAN','Male','1022','2','2006-06-05','Daheenda',42,'Active','2011-04-15',NULL,41,NULL,NULL),(372,'SAIF UR','REHMAN','BABU MUMTAZ','Male','1000','3','2006-01-14','Daheenda',42,'Active','2010-04-12',NULL,41,NULL,NULL),(373,'HASSAN','ALI','WAZEER ALI','Male','1035','4','2007-12-21','Meelum',42,'In Active','2011-04-15','2016-03-05',41,NULL,NULL),(374,'ABDULLAH','A','CHAN ZEB KHAN','Male','919','5','2006-08-21','Meelum',42,'In Active','2009-04-07','2016-03-05',41,NULL,NULL),(375,'AMEER HAMZA','SHAH','SYED PHOOL HUSSAIN SHAH','Male','964','6','2006-11-17','Darbanda',42,'Active','2010-04-07',NULL,41,NULL,NULL),(376,'MUHAMMAD','OSAMA','MUHAMMAD RAFIQUE','Male','997','7','2005-12-13','New jora pind',42,'Active','2010-04-12',NULL,41,NULL,NULL),(377,'ABDUL','MAJID','ABID HUSSAIN','Male','962','8','2005-12-12','New jora pind',42,'Active','2010-04-07',NULL,41,NULL,NULL),(378,'ANEESA','BIBI','SHER DIL KHAN','Female','1008','9','2006-11-19','Daheenda',42,'Active','2010-04-13',NULL,41,NULL,NULL),(379,'ABRISH ISLAM','BIBI','ISLAM BAHADUR KHAN','Female','988','10','2006-03-02','Meelum',42,'Active','2010-04-12',NULL,41,NULL,NULL),(380,'AISHA','BIBI','KHANZADA KHAN','Female','979','11','2006-02-24','Daheenda',42,'Active','2010-04-09',NULL,41,NULL,NULL),(381,'MARYAM','NAWAZ','HAQ NAWAZ','Female','1003','12','2005-06-22','Meelum',42,'Active','2010-04-13',NULL,41,NULL,NULL),(382,'UMAMA','PERVEZ','MUHAMMAD PERVEZ','Female','989','13','2007-03-16','Meelum',42,'Active','2010-04-12',NULL,41,NULL,NULL),(383,'ZAIN','ALI','PERVEZ AKHTAR','Male','1149','14','2007-03-06','Daheenda',42,'Active','2012-05-15',NULL,41,NULL,NULL),(384,'FAHAD','ALI','PERVEZ AKHTER','Male','1064','15','2005-11-16','Alum',42,'Active','2011-04-17',NULL,41,NULL,NULL),(385,'AMINA','BIBI','SUDHEER IQBAL','Female','980','16','2006-06-01','Daheenda',42,'Active','2010-04-09',NULL,41,NULL,NULL),(386,'HABIB','AHSAN','QADEER AHSAN','Male','966','17','2005-11-02','Meelum',42,'Active','2010-04-01',NULL,41,NULL,NULL),(387,'MOMINA','QADEER','ABDUL QADEER','Female','993','18','2006-01-22','Daheenda',42,'Active','2010-04-12',NULL,41,NULL,NULL),(388,'ISRA','JALIL','ABDUL JALIL','Female','925','19','2005-11-10','Daheenda',42,'Active','2009-04-07',NULL,41,NULL,NULL),(389,'FATIMA','SAAED','SAEED AKHTAR','0','956','20','2006-12-20','Meelum',42,'Active','2010-04-07',NULL,41,NULL,NULL),(390,'MANAIL JAVED','AKHTAR','JAVED AKHTAR','Female','992','21','2007-02-24','Meelum',42,'Active','2010-04-12',NULL,41,NULL,NULL),(391,'HASSAN ALI','SHAH','BINYAMEEN SHAH','Male','1071','22','2006-12-19','Darbanda',42,'In Active','2012-04-05','2016-03-05',41,NULL,NULL),(392,'MUSFIRA','SIDDIQUE','ABDULLAH KHAN','Female','1002','23','2006-10-18','Daheenda',42,'In Active','2010-04-13','2016-03-05',41,NULL,NULL),(393,'IQRA','BIBI','FAREED KHAN','Female','972','24','2006-03-23','Daheenda',42,'Active','2010-04-09',NULL,41,NULL,NULL),(394,'SYEDA MALAIKA','NOOR','SYED NAZAKAT HUSSAIN SHAH','Female','1019','25','2008-05-19','New jora pind',42,'Active','2011-04-15',NULL,41,NULL,NULL),(395,'SYEDA ALEESHA','BIBI','SHAH MUHAMMAD HUSSAIN SHAH','Female','981','26','2006-06-15','New jora pind',42,'Active','2010-04-12',NULL,41,NULL,NULL),(396,'AZKA','RIYASAT','MUHAMMAD RIYASAT','Female','969','27','2005-11-09','Daheenda',42,'Active','2010-04-09',NULL,41,NULL,NULL),(397,'SAWERA','BIBI','ABDUL QAYYUM','Female','968','28','2006-06-28','Darbanda',42,'Active','2010-04-07',NULL,41,NULL,NULL),(398,'AREESHA','RIAZ','RIAZ AHMAD','Female','970','29','2006-12-12','Darbanda',42,'Active','2010-04-09',NULL,41,NULL,NULL),(399,'SAIF UR REHMAN','KHAN','RAZA MUHAMMAD KHAN','Male','1001','30','2006-10-12','Daheenda',42,'In Active','2010-04-12','2016-03-05',41,NULL,NULL),(400,'USMAN','GHANI','RIASAT KHAN','Male','973','31','2005-01-29','New jora pind',42,'Active','2010-04-09',NULL,41,NULL,NULL),(401,'ASAD ULLAH','KHAN','ZAHID IQBAL KHAN','Male','911','32','2006-04-19','Daheenda',42,'Active','2009-04-05',NULL,41,NULL,NULL),(402,'USNAN','ALI','ZAHOOR ELAHI','Male','975','33','2006-02-25','Meelum',42,'Active','2010-04-09',NULL,41,NULL,NULL),(403,'ABDULLAH BIN','MASHOOD','MASHOOD UR REHMAN','Male','959','34','2006-02-26','Meelum',42,'Active','2010-04-07',NULL,41,NULL,NULL),(404,'SYED USMAN ALI','SHAH','AKHLAQ HUSSAIN SHAH','Male','1018','35','2007-02-20','Daheenda',42,'In Active','2011-04-05','2016-03-05',41,NULL,NULL),(405,'AISHA','SIDDIQUA','ABDULLAH KHAN','Female','334','26','2003-07-23','Daheenda',42,'Active','2014-04-10',NULL,41,NULL,NULL),(406,'SWERA','BIBI','ABDUL QAYYUM','Female','968','28','2006-06-28','Darbanda',42,'Active','2010-04-07',NULL,41,NULL,NULL),(407,'SAIF','KHAN','RAZA MUHAMMAD KHAN','Male','1001','30','2006-10-12','Daheenda',42,'Active','2010-04-12',NULL,41,NULL,NULL),(408,'USMAN','ALI','ZAHOOR ALI','Male','975','33','2006-02-25','Meelum',42,'Active','2010-04-09',NULL,41,NULL,NULL),(409,'SYED USMAN ALI','SHAH','AKHLAQ HUSSAIN SHAH','Male','1018','35','2007-02-20','Daheenda',42,'Active','2011-04-15',NULL,41,NULL,NULL),(410,'SAAD','MEHMOOD','ABDUL HAMEED','Male','954','36','2006-10-05','Daheenda',42,'Active','2010-04-05',NULL,41,NULL,NULL),(411,'SYED ABDUL SAMAD','SHAH','SYED TANVIR AHMED SHAH','Male','976','37','2006-08-31','Daheenda',42,'Active','2010-04-09',NULL,41,NULL,NULL),(412,'AKRAM UL','HAQ','NAZAKAT HUSSAIN','Male','1059','38','2005-05-22','Daheenda',42,'Active','2011-04-17',NULL,41,NULL,NULL),(413,'ASAD ULLAH','KHAN','FIRDOOS KHAN','Male','965','39','2006-01-03','New jora pind',42,'Active','2010-04-07',NULL,41,NULL,NULL),(414,'ABDULLAH','ZEESHAN','ZEESHAN ALI','Male','967','40','2006-06-17','Daheenda',42,'Active','2010-04-07',NULL,41,NULL,NULL),(415,'MEER ALI','KAZMI','SAQIB SHAH','Male','996','41','2007-11-17','Daheenda',42,'Active','2010-04-12',NULL,41,NULL,NULL),(416,'AMIR','AHMED','AHMED SHAH','Male','999','42','2006-08-15','Meelum',42,'Active','2010-04-12',NULL,41,NULL,NULL),(417,'f','fffffff','ffffffffff','Female','ffffffffffff','3','2016-03-29','ffffffff',2,'Active','2016-04-27',NULL,1,NULL,NULL),(418,'Test','Teset','father','Male','123','210','2016-02-02','',106,'Active','2016-06-28',NULL,41,NULL,NULL),(419,'test','test','test','0','123','1','2018-02-06','',35,'Active','2018-02-06',NULL,21,NULL,NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_discounts`
--

DROP TABLE IF EXISTS `students_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_discounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orignal_amount` bigint(20) DEFAULT NULL,
  `discount_amount` bigint(20) DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_Stu_discount_Transec_ID` (`transaction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_guardians`
--

LOCK TABLES `students_guardians` WRITE;
/*!40000 ALTER TABLE `students_guardians` DISABLE KEYS */;
INSERT INTO `students_guardians` VALUES (9,3,1,2),(10,10,5,2),(11,20,7,2),(13,22,9,2),(15,270,16,2);
/*!40000 ALTER TABLE `students_guardians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_payments`
--

DROP TABLE IF EXISTS `students_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` bigint(20) DEFAULT NULL,
  `student_id` int(10) DEFAULT NULL,
  `paid_by` varchar(200) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `created_at` time DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(200) DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_payemnts` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_payments`
--

LOCK TABLES `students_payments` WRITE;
/*!40000 ALTER TABLE `students_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `students_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `internal_key` varchar(100) DEFAULT NULL,
  `can_delete` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_transaction_type_inter_key` (`internal_key`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_campus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `campus_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campususer_user` (`user_id`),
  KEY `fk_campususer_campus` (`campus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_campus`
--

LOCK TABLES `user_campus` WRITE;
/*!40000 ALTER TABLE `user_campus` DISABLE KEYS */;
INSERT INTO `user_campus` VALUES (2,5,1),(3,5,2),(6,7,8),(14,15,16),(18,19,20),(19,20,21),(20,21,22),(21,22,21),(27,28,25),(28,29,26),(29,30,27),(30,31,28),(31,32,29),(33,35,33),(34,38,34),(37,47,38),(39,49,41),(40,50,42),(41,51,43),(42,52,44),(43,54,45),(44,55,46),(45,56,47),(47,59,49),(48,60,50),(49,61,51),(50,62,52),(51,63,52),(53,65,54),(54,66,55),(57,68,41),(56,67,41),(58,1,55);
/*!40000 ALTER TABLE `user_campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_campus_modules`
--

DROP TABLE IF EXISTS `user_campus_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_campus_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_campus_id` int(10) DEFAULT NULL,
  `campus_module_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usercampusroles_usercampus` (`user_campus_id`),
  KEY `fk_usercampusrole_role` (`campus_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=748 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_campus_modules`
--

LOCK TABLES `user_campus_modules` WRITE;
/*!40000 ALTER TABLE `user_campus_modules` DISABLE KEYS */;
INSERT INTO `user_campus_modules` VALUES (686,2,266),(685,2,265),(684,2,264),(683,2,263),(682,2,10),(681,2,9),(11,3,11),(12,3,12),(13,3,13),(14,3,14),(15,3,15),(16,3,16),(17,3,17),(18,3,18),(19,3,19),(20,3,20),(21,6,21),(22,6,22),(23,6,23),(24,6,24),(25,6,25),(26,6,26),(27,6,27),(28,6,28),(29,6,29),(30,6,30),(31,14,31),(32,14,32),(33,14,33),(34,14,34),(35,14,35),(36,14,36),(37,14,37),(38,14,38),(39,14,39),(40,14,40),(51,18,51),(52,18,52),(53,18,53),(54,18,54),(55,18,55),(56,18,56),(57,18,57),(58,18,58),(59,18,59),(60,18,60),(61,19,61),(62,19,62),(63,19,63),(64,19,64),(65,19,65),(66,19,66),(67,19,67),(68,19,68),(69,19,69),(70,19,70),(71,20,71),(72,20,72),(73,20,73),(74,20,74),(75,20,75),(76,20,76),(77,20,77),(78,20,78),(79,20,79),(80,20,80),(81,21,62),(82,21,64),(83,21,69),(137,27,101),(138,27,102),(139,27,103),(140,27,104),(141,27,105),(142,27,106),(143,27,107),(144,27,108),(145,27,109),(146,27,110),(147,28,111),(148,28,112),(149,28,113),(150,28,114),(151,28,115),(152,28,116),(153,28,117),(154,28,118),(155,28,119),(156,28,120),(157,29,121),(158,29,122),(159,29,123),(160,29,124),(161,29,125),(162,29,126),(163,29,127),(164,29,128),(165,29,129),(166,29,130),(167,30,131),(168,30,132),(169,30,133),(170,30,134),(171,30,135),(172,30,136),(173,30,137),(174,30,138),(175,30,139),(176,30,140),(177,31,141),(178,31,142),(179,31,143),(180,31,144),(181,31,145),(182,31,146),(183,31,147),(184,31,148),(185,31,149),(186,31,150),(207,33,181),(208,33,182),(209,33,183),(210,33,184),(211,33,185),(212,33,186),(213,33,187),(214,33,188),(215,33,189),(216,33,190),(217,34,191),(218,34,192),(219,34,193),(220,34,194),(221,34,195),(222,34,196),(223,34,197),(224,34,198),(225,34,199),(226,34,200),(449,37,221),(450,37,222),(451,37,223),(452,37,224),(453,37,225),(454,37,226),(455,37,227),(456,37,228),(457,37,229),(458,37,230),(680,2,8),(679,2,7),(678,2,6),(677,2,3),(523,40,267),(524,40,268),(525,40,269),(526,40,270),(527,40,271),(528,40,272),(529,40,273),(530,40,274),(531,40,275),(532,40,276),(533,41,277),(534,41,278),(535,41,279),(536,41,280),(537,41,281),(538,41,282),(539,41,283),(540,41,284),(541,41,285),(542,41,286),(543,42,287),(544,42,288),(545,42,289),(546,42,290),(547,42,291),(548,42,292),(549,42,293),(550,42,294),(551,42,295),(552,42,296),(553,43,297),(554,43,298),(555,43,299),(556,43,300),(557,43,301),(558,43,302),(559,43,303),(560,43,304),(561,43,305),(562,43,306),(563,44,307),(564,44,308),(565,44,309),(566,44,310),(567,44,311),(568,44,312),(569,44,313),(570,44,314),(571,44,315),(572,44,316),(573,45,317),(574,45,318),(575,45,319),(576,45,320),(577,45,321),(578,45,322),(579,45,323),(580,45,324),(581,45,325),(582,45,326),(593,47,337),(594,47,338),(595,47,339),(596,47,340),(597,47,341),(598,47,342),(599,47,343),(600,47,344),(601,47,345),(602,47,346),(718,39,347),(717,39,261),(716,39,260),(715,39,259),(714,39,258),(713,39,257),(712,39,256),(711,39,255),(710,39,254),(709,39,253),(622,48,348),(623,48,349),(624,48,350),(625,48,351),(626,48,352),(627,48,353),(628,48,354),(629,48,355),(630,48,356),(631,48,357),(632,49,358),(633,49,359),(634,49,360),(635,49,361),(636,49,362),(637,49,363),(638,49,364),(639,49,365),(640,49,366),(641,49,367),(642,50,368),(643,50,369),(644,50,370),(645,50,371),(646,50,372),(647,50,373),(648,50,374),(649,50,375),(650,50,376),(651,50,377),(652,51,369),(653,51,371),(654,51,372),(655,51,373),(656,51,374),(657,52,378),(658,52,379),(659,52,380),(660,52,381),(661,52,382),(662,52,383),(663,52,384),(664,52,385),(665,52,386),(666,52,387),(667,53,388),(668,53,389),(669,53,390),(670,53,391),(671,53,392),(672,53,393),(673,53,394),(674,53,395),(675,53,396),(676,53,397),(687,2,398),(688,54,430),(689,54,431),(690,54,432),(691,54,433),(692,54,434),(693,54,435),(694,54,436),(695,54,437),(696,54,438),(697,54,439),(698,54,440),(719,39,441),(720,55,253),(721,55,254),(722,55,255),(730,57,254),(729,56,258),(728,56,256),(727,56,255),(731,57,255),(732,57,256),(733,57,257),(734,57,259),(735,57,441),(736,58,430),(737,58,431),(738,58,432),(739,58,433),(740,58,434),(741,58,435),(742,58,436),(743,58,437),(744,58,438),(745,58,439),(746,58,440),(747,58,442);
/*!40000 ALTER TABLE `user_campus_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_campus_roles`
--

DROP TABLE IF EXISTS `user_campus_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_campus_roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_campus_id` int(10) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usercampusroles_usercampus` (`user_campus_id`),
  KEY `fk_usercampusrole_role` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `internal_key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@e-karobar.com','123','Ali Fida','Active','http://e-karobar.com/uploads/users/OO/profile-pic.jpg',1,7),(5,'alifida86@gmail.com','123','Ali','Active','http://e-karobar.com/uploads/users/OO/profile-pic.jpg',2,1),(7,'bashir.khan@ufone.blackberry.com','123','The Quest Public School','Active',NULL,NULL,1),(13,'trail@trail.trail','123','trail','Active',NULL,NULL,1),(15,'zahidkhan958@gmail.com','123','aligarh model public school ','Active',NULL,NULL,1),(19,'alamgirkha@gmail.com','123','The Quest Public School','Active',NULL,NULL,1),(20,'alrahberschool14@gmail.com','123','Al Rahber Public School','Active',NULL,NULL,1),(21,'rabi.pts@gmail.com','123','aps','Active',NULL,NULL,1),(22,'ksohrab76@yahoo.com','123','Sohrab Khan','Active','http://e-karobar.com/uploads/campuses/OH/students/Ogemp-pic.jpg',NULL,3),(24,'awk_299@yahoo.com','123',NULL,NULL,NULL,NULL,6),(26,'amjadkarym@gmail.com','123','pral','Active',NULL,NULL,1),(28,'gshah188@yahoo.com','123','GHSS Jamrud','Active',NULL,NULL,1),(29,'visiosoft@yahoo.com','123','Testing','Active',NULL,NULL,1),(30,'jawad.ali84@hotmail.com','123','Qasim Hall','Active',NULL,NULL,1),(31,'vision@yahoo.com','123','Vision Islamic Public school ','Active',NULL,NULL,1),(32,'salmanrozik@gmail.com','123','Local Education Board','Active',NULL,NULL,1),(33,'hgfhgfh@fngkfd.bbbfg','123','ghgfhfg','Active',NULL,NULL,1),(34,'jjjjjjjjjjjjjj','123',NULL,NULL,NULL,NULL,6),(35,'iqbalalvi741@gmail.com','123','The TIME School and College Oghi','Active',NULL,NULL,1),(38,'bilalbahadar@gmail.com','123','Edu Edge','Active',NULL,NULL,1),(42,'bilalbahadar@hotmail.com','123',NULL,NULL,NULL,NULL,6),(47,'jahanatcoms@gmail.com','123','The  Atcoms Oghi','Active',NULL,63,1),(49,'demo@e-karobar.com','123','E-karobar School','Active',NULL,69,1),(50,'merill@hk.net','123','Merill ABD','Active',NULL,71,1),(51,'aahighschool@gmail.com','123','Haripur Ali Akbar High School','Active','http://e-karobar.com/uploads/users/vg/profile-pic.jpg',73,1),(52,'westernlinkedu@gmail.com','123','Western link Education','Active',NULL,75,1),(53,'email@email.com','123',NULL,NULL,NULL,NULL,6),(54,'naziamalik1992@gmail.com','123','FG high school','Active',NULL,85,1),(55,'nazia_malik900@yahoo.com','123','Nazia','Active',NULL,87,1),(56,'microesys@gmail.com','123','Micro Education System','Active',NULL,89,1),(57,'asfd','123',NULL,NULL,NULL,NULL,6),(59,'test@test.com','123','test','Active',NULL,93,1),(60,'ismat.kakakhel@gmail.com','123','ICOPS','Active',NULL,95,1),(61,'mnawazakhtar@gmail.com','123','Jinnah Muslim College','Active',NULL,97,1),(62,'mark_mulier@hotmail.com','123','Westernlink MTS','Active',NULL,99,1),(63,'doris@westernlinl.nl','123','doris boo','Active',NULL,NULL,3),(65,'my@test.com','123','mytest','Active',NULL,104,1),(66,'email@emaiol.com','123456','Ali Fida','Active',NULL,106,1),(67,'mrsing@email.com','Ux7gkF','Mr Sing','Active',NULL,NULL,3),(68,'eamil@email.com','123','Abc khan','Active',NULL,NULL,3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_page_layouts`
--

DROP TABLE IF EXISTS `web_page_layouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_page_layouts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `layout` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_page_layouts`
--

LOCK TABLES `web_page_layouts` WRITE;
/*!40000 ALTER TABLE `web_page_layouts` DISABLE KEYS */;
INSERT INTO `web_page_layouts` VALUES (1,'1 Column (100%)'),(2,'2 Columns (7:3)'),(3,'2 Columns (1:1)'),(4,'3 Columns (3:1:1)'),(5,'3 Columns (1:1:1)');
/*!40000 ALTER TABLE `web_page_layouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_page_post_categories`
--

DROP TABLE IF EXISTS `web_page_post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_page_post_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `layout_column` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_page_post_categories`
--

LOCK TABLES `web_page_post_categories` WRITE;
/*!40000 ALTER TABLE `web_page_post_categories` DISABLE KEYS */;
INSERT INTO `web_page_post_categories` VALUES (9,'col_1',1,1,10,1,1),(10,'col_1',2,1,10,1,1),(11,'col_1',3,4,10,1,1);
/*!40000 ALTER TABLE `web_page_post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_pages`
--

DROP TABLE IF EXISTS `web_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) DEFAULT NULL,
  `menu_title` varchar(100) DEFAULT NULL,
  `slider_id` int(10) DEFAULT NULL,
  `html` text,
  `status` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `website_id` int(10) DEFAULT NULL,
  `layout` varchar(100) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `page_url` varchar(300) DEFAULT NULL,
  `is_welcome_page` varchar(10) DEFAULT NULL,
  `config` text,
  `is_default_footer` varchar(10) DEFAULT NULL,
  `footer_page_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_Page_URL` (`website_id`,`page_url`),
  KEY `FK_website_page` (`website_id`),
  KEY `FK_Footer_page` (`footer_page_id`),
  CONSTRAINT `FK_Footer_page` FOREIGN KEY (`footer_page_id`) REFERENCES `web_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_pages`
--

LOCK TABLES `web_pages` WRITE;
/*!40000 ALTER TABLE `web_pages` DISABLE KEYS */;
INSERT INTO `web_pages` VALUES (1,'Home','Home',NULL,'<p>Sagittis aliquam massa platea. Leo id augue interdum erat, curabitur litora tempus. Eros ad Morbi fusce est. Lacinia pulvinar Dictumst. Euismod id penatibus convallis hymenaeos non mauris fusce augue sodales. Convallis scelerisque. Pede suscipit eleifend nullam nam aliquet, orci.</p>\r\n\r\n<p>Aenean consectetuer platea natoque nisi iaculis malesuada. Platea felis parturient tempor nascetur fermentum libero sodales dictumst, mauris vivamus netus id litora. Cum accumsan tincidunt mattis.</p>\r\n\r\n<p>Nec hac dictumst imperdiet potenti tortor. Hendrerit. Viverra netus natoque morbi vestibulum bibendum consequat dui luctus blandit justo aenean, praesent porta blandit fusce semper laoreet semper.</p>\r\n\r\n<p>Sagittis aliquam massa platea. Leo id augue interdum erat, curabitur litora tempus. Eros ad Morbi fusce est. Lacinia pulvinar Dictumst. Euismod id penatibus convallis hymenaeos non mauris fusce augue sodales. Convallis scelerisque. Pede suscipit eleifend nullam nam aliquet, orci.</p>\r\n\r\n<p>Aenean consectetuer platea natoque nisi iaculis malesuada. Platea felis parturient tempor nascetur fermentum libero sodales dictumst, mauris vivamus netus id litora. Cum accumsan tincidunt mattis.</p>\r\n\r\n<p>Nec hac dictumst imperdiet potenti tortor. Hendrerit. Viverra netus natoque morbi vestibulum bibendum consequat dui luctus blandit justo aenean, praesent porta blandit fusce semper laoreet semper.</p>\r\n\r\n<p>Sagittis aliquam massa platea. Leo id augue interdum erat, curabitur litora tempus. Eros ad Morbi fusce est. Lacinia pulvinar Dictumst. Euismod id penatibus convallis hymenaeos non mauris fusce augue sodales. Convallis scelerisque. Pede suscipit eleifend nullam nam aliquet, orci.</p>\r\n\r\n<p>Aenean consectetuer platea natoque nisi iaculis malesuada. Platea felis parturient tempor nascetur fermentum libero sodales dictumst, mauris vivamus netus id litora. Cum accumsan tincidunt mattis.</p>\r\n\r\n<p>Nec hac dictumst imperdiet potenti tortor. Hendrerit. Viverra netus natoque morbi vestibulum bibendum consequat dui luctus blandit justo aenean, praesent porta blandit fusce semper laoreet semper.</p>\r\n\r\n<p>Sagittis aliquam massa platea. Leo id augue interdum erat, curabitur litora tempus. Eros ad Morbi fusce est. Lacinia pulvinar Dictumst. Euismod id penatibus convallis hymenaeos non mauris fusce augue sodales. Convallis scelerisque. Pede suscipit eleifend nullam nam aliquet, orci.</p>\r\n\r\n<p>Aenean consectetuer platea natoque nisi iaculis malesuada. Platea felis parturient tempor nascetur fermentum libero sodales dictumst, mauris vivamus netus id litora. Cum accumsan tincidunt mattis.</p>\r\n\r\n<p>Nec hac dictumst imperdiet potenti tortor. Hendrerit. Viverra netus natoque morbi vestibulum bibendum consequat dui luctus blandit justo aenean, praesent porta blandit fusce semper laoreet semper.</p>\r\n\r\n<p>Sagittis aliquam massa platea. Leo id augue interdum erat, curabitur litora tempus. Eros ad Morbi fusce est. Lacinia pulvinar Dictumst. Euismod id penatibus convallis hymenaeos non mauris fusce augue sodales. Convallis scelerisque. Pede suscipit eleifend nullam nam aliquet, orci.</p>\r\n\r\n<p>Aenean consectetuer platea natoque nisi iaculis malesuada. Platea felis parturient tempor nascetur fermentum libero sodales dictumst, mauris vivamus netus id litora. Cum accumsan tincidunt mattis.</p>\r\n\r\n<p>Nec hac dictumst imperdiet potenti tortor. Hendrerit. Viverra netus natoque morbi vestibulum bibendum consequat dui luctus blandit justo aenean, praesent porta blandit fusce semper laoreet semper.</p>\r\n\r\n<p>Sagittis aliquam massa platea. Leo id augue interdum erat, curabitur litora tempus. Eros ad Morbi fusce est. Lacinia pulvinar Dictumst. Euismod id penatibus convallis hymenaeos non mauris fusce augue sodales. Convallis scelerisque. Pede suscipit eleifend nullam nam aliquet, orci.</p>\r\n\r\n<p>Aenean consectetuer platea natoque nisi iaculis malesuada. Platea felis parturient tempor nascetur fermentum libero sodales dictumst, mauris vivamus netus id litora. Cum accumsan tincidunt mattis.</p>\r\n\r\n<p>Nec hac dictumst imperdiet potenti tortor. Hendrerit. Viverra netus natoque morbi vestibulum bibendum consequat dui luctus blandit justo aenean, praesent porta blandit fusce semper laoreet semper.</p>\r\n','Published','2017-03-23 11:48:28',10,'1 Column (100%)',1,'index','on',NULL,'0',2),(2,'Footer','Footer',NULL,'','Published','2017-04-20 04:42:56',10,'3 Columns (1:1:1)',1,'footer','0',NULL,'on',NULL),(3,'Pricing','Pricing',6,'<p>Test</p>\r\n','Published','2018-03-13 16:12:18',10,'3 Columns (1:1:1)',1,'pricing','0',NULL,'0',NULL);
/*!40000 ALTER TABLE `web_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_post_categories`
--

DROP TABLE IF EXISTS `web_post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_post_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_post_categories`
--

LOCK TABLES `web_post_categories` WRITE;
/*!40000 ALTER TABLE `web_post_categories` DISABLE KEYS */;
INSERT INTO `web_post_categories` VALUES (1,'Category 1','Desc',NULL,10,NULL,NULL,NULL);
/*!40000 ALTER TABLE `web_post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_post_post_categories`
--

DROP TABLE IF EXISTS `web_post_post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_post_post_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_p_post_category` (`post_id`),
  KEY `FK_post_c_post_category` (`category_id`),
  CONSTRAINT `FK_post_c_post_category` FOREIGN KEY (`category_id`) REFERENCES `web_post_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_p_post_category` FOREIGN KEY (`post_id`) REFERENCES `web_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_post_post_categories`
--

LOCK TABLES `web_post_post_categories` WRITE;
/*!40000 ALTER TABLE `web_post_post_categories` DISABLE KEYS */;
INSERT INTO `web_post_post_categories` VALUES (2,1,1);
/*!40000 ALTER TABLE `web_post_post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_posts`
--

DROP TABLE IF EXISTS `web_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `html` text,
  `thumbnail_path` text,
  `website_id` int(10) NOT NULL,
  `slug` text,
  `url` text,
  `status` text,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish_at` date DEFAULT NULL,
  `expire_at` date DEFAULT NULL,
  `footer_page_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_web_widgets_websites1_idx` (`website_id`),
  KEY `fk_post_footer_page_id` (`footer_page_id`),
  CONSTRAINT `fk_post_footer_page_id` FOREIGN KEY (`footer_page_id`) REFERENCES `web_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_posts`
--

LOCK TABLES `web_posts` WRITE;
/*!40000 ALTER TABLE `web_posts` DISABLE KEYS */;
INSERT INTO `web_posts` VALUES (1,'Post 1','<p>Malesuada integer faucibus, vitae viverra pharetra. Commodo dignissim taciti magnis lectus a potenti dictum elit mollis suspendisse faucibus convallis amet taciti. Commodo aliquet diam ridiculus montes ut phasellus.</p>\r\n\r\n<p>Morbi arcu ut. Tortor. Malesuada placerat fames. Ac natoque augue vivamus aliquam egestas at eu per aliquam id lorem scelerisque at, facilisis interdum facilisis dignissim nisi cum eleifend bibendum. Massa vivamus hac enim hendrerit.</p>\r\n\r\n<p>Hymenaeos. Primis aliquet iaculis justo ornare pede blandit ullamcorper. Nulla purus mauris torquent faucibus primis metus integer amet rutrum facilisi dictum conubia id quisque mus fames facilisis leo.</p>\r\n','',10,'post-1',NULL,'Published','2018-03-28 10:34:06','2018-01-01','2050-01-01',NULL);
/*!40000 ALTER TABLE `web_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_slider`
--

DROP TABLE IF EXISTS `web_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_slider` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `config` text,
  `website_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_slider`
--

LOCK TABLES `web_slider` WRITE;
/*!40000 ALTER TABLE `web_slider` DISABLE KEYS */;
INSERT INTO `web_slider` VALUES (9,'Home Slider','',10);
/*!40000 ALTER TABLE `web_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_templates`
--

DROP TABLE IF EXISTS `web_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `thumbnail_path` varchar(250) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_templates`
--

LOCK TABLES `web_templates` WRITE;
/*!40000 ALTER TABLE `web_templates` DISABLE KEYS */;
INSERT INTO `web_templates` VALUES (1,'Big Orange','webtemplates/big-orange','webtemplates/big-orange/thumb.png','Active'),(2,'Clean White','webtemplates/clean-white','webtemplates/clean/theme-white/thumb.png','Active'),(3,'Clean Black','webtemplates/clean-black','webtemplates/clean/theme-black/thumb.png','In Active');
/*!40000 ALTER TABLE `web_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_files`
--

DROP TABLE IF EXISTS `website_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file_path` text,
  `website_id` int(10) DEFAULT NULL,
  `name` text,
  PRIMARY KEY (`id`),
  KEY `FK_website_image` (`website_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_menu`
--

LOCK TABLES `website_menu` WRITE;
/*!40000 ALTER TABLE `website_menu` DISABLE KEYS */;
INSERT INTO `website_menu` VALUES (40,'Research','javascript:void(0);',3,NULL,10,0,'static',NULL,NULL,NULL),(41,'Research Publications','javascript:void(0);',3,NULL,10,40,'static',NULL,NULL,NULL),(42,'Digital Library','http://www.digitallibrary.edu.pk/bachak.html',3,NULL,10,40,'static',NULL,NULL,NULL),(43,'INSAP Info','http://inasp.info/training-resources/e-resources/dashboard/institution/details/2190/',3,NULL,10,40,'static',NULL,NULL,NULL),(46,'Mail','http://bkuc.edu.pk:2095/',7,NULL,10,0,'static',NULL,NULL,NULL),(47,'News','http://localhost/bkuc/site/pc/news/99/4/1',5,NULL,10,45,'static',NULL,NULL,NULL),(49,'Jobs','http://localhost/bkuc/job/get',5,NULL,10,45,'static',NULL,NULL,NULL),(50,'Home','index',1,NULL,10,0,'page',NULL,1,NULL),(51,'Fee Structure','http://www.bkuc.edu.pk/public/pdf/fee%20structure%20for%20session%202015-%202016.pdf',4,NULL,10,44,'static',NULL,NULL,NULL);
/*!40000 ALTER TABLE `website_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websites`
--

DROP TABLE IF EXISTS `websites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websites`
--

LOCK TABLES `websites` WRITE;
/*!40000 ALTER TABLE `websites` DISABLE KEYS */;
INSERT INTO `websites` VALUES (10,'','','localhost/e-karobar',1,41,'#fffddd','#ffffff','#000000','#dddfff','#fff','http://localhost/e-karobar/public/images/e-karobar-lg.png'),(25,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL),(26,NULL,NULL,NULL,NULL,34,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `websites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'silverle_eschool'
--
/*!50003 DROP PROCEDURE IF EXISTS `new_registration_data` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `new_registration_data`(IN `campus_id` int)
BEGIN
	#Routine body goes here...
INSERT INTO `item_types` (`name`,`campus_id`) 
	VALUES 
		('Note Books',campus_id),
		('Books',campus_id)
;
INSERT INTO `fee_types` (`type`,`can_delete`,`campus_id`,`internal_key`) 
	VALUES 
	('Admission Fee', 'Yes', campus_id, 'admission.fee'),
	('Monthly Tuition Fee', 'Yes', campus_id, 'tution.fee'),
	('Examination Fee', 'Yes', campus_id, 'examination.fee')
;
INSERT INTO `classes` (`name`,`campus_id`) 
	VALUES 
	('Class-1', campus_id),
	('Class-2', campus_id),
	('Class-3', campus_id),
	('Class-4', campus_id),
	('Class-5', campus_id)
;
INSERT INTO class_fee (class_id, fee_type_id, amount)
SELECT classes.id as class_id, fee_types.id as fee_type_id, '1000' amount FROM classes, fee_types 
where classes.campus_id = campus_id
and fee_types.campus_id = campus_id;
INSERT INTO `expense_type` (`type`,`campus_id`) 
	VALUES 
	('Building Rent', campus_id),
	('Electricity Bill', campus_id),
	('Telephone Bill', campus_id),
	('Study Trip', campus_id)
;
INSERT INTO `employee_types` (`type`,`campus_id`) 
	VALUES 
	('Teachers', campus_id),
	('Support Staff', campus_id)
;
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

-- Dump completed on 2018-10-22 16:47:07
