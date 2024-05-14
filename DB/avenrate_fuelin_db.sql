-- MySQL dump 10.19  Distrib 10.3.38-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: avenrate_fuelin_db
-- ------------------------------------------------------
-- Server version	10.3.38-MariaDB-cll-lve

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
-- Table structure for table `consumer_details`
--

DROP TABLE IF EXISTS `consumer_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer_details` (
  `consumer_nic` varchar(12) NOT NULL,
  `consumer_name` varchar(100) NOT NULL,
  `consumer_address` varchar(250) DEFAULT NULL,
  `consumer_phone` varchar(10) NOT NULL,
  `consumer_email` varchar(50) NOT NULL,
  PRIMARY KEY (`consumer_nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer_details`
--

LOCK TABLES `consumer_details` WRITE;
/*!40000 ALTER TABLE `consumer_details` DISABLE KEYS */;
INSERT INTO `consumer_details` (`consumer_nic`, `consumer_name`, `consumer_address`, `consumer_phone`, `consumer_email`) VALUES ('123','test','test','456','pulasthi10@gmail.com'),('189','799',NULL,'127','956h@ghj.ll'),('785','test1','','478','test1@rty.cc');
/*!40000 ALTER TABLE `consumer_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumer_login`
--

DROP TABLE IF EXISTS `consumer_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer_login` (
  `consumer_nic` varchar(12) NOT NULL,
  `password` varchar(100) NOT NULL,
  `otp` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`consumer_nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer_login`
--

LOCK TABLES `consumer_login` WRITE;
/*!40000 ALTER TABLE `consumer_login` DISABLE KEYS */;
INSERT INTO `consumer_login` (`consumer_nic`, `password`, `otp`) VALUES ('123','123',''),('189','189',NULL),('785','785',NULL);
/*!40000 ALTER TABLE `consumer_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumer_token`
--

DROP TABLE IF EXISTS `consumer_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer_token` (
  `token_id` varchar(50) NOT NULL,
  `consumer_nic` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `vehicle_number` varchar(10) NOT NULL,
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer_token`
--

LOCK TABLES `consumer_token` WRITE;
/*!40000 ALTER TABLE `consumer_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumer_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumer_token_pay`
--

DROP TABLE IF EXISTS `consumer_token_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer_token_pay` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) NOT NULL,
  `token_id` varchar(50) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer_token_pay`
--

LOCK TABLES `consumer_token_pay` WRITE;
/*!40000 ALTER TABLE `consumer_token_pay` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumer_token_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumer_vehicle`
--

DROP TABLE IF EXISTS `consumer_vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer_vehicle` (
  `vehicle_number` varchar(10) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `consumer_nic` varchar(12) NOT NULL,
  PRIMARY KEY (`vehicle_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer_vehicle`
--

LOCK TABLES `consumer_vehicle` WRITE;
/*!40000 ALTER TABLE `consumer_vehicle` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumer_vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribution`
--

DROP TABLE IF EXISTS `distribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribution` (
  `distribution_id` int(11) NOT NULL AUTO_INCREMENT,
  `station_id` int(11) NOT NULL,
  `liters` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`distribution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribution`
--

LOCK TABLES `distribution` WRITE;
/*!40000 ALTER TABLE `distribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `distribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_stations`
--

DROP TABLE IF EXISTS `fuel_stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_stations` (
  `station_id` int(11) NOT NULL AUTO_INCREMENT,
  `station_name` varchar(100) NOT NULL,
  `town_id` int(11) NOT NULL,
  `station_address` varchar(250) NOT NULL,
  PRIMARY KEY (`station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_stations`
--

LOCK TABLES `fuel_stations` WRITE;
/*!40000 ALTER TABLE `fuel_stations` DISABLE KEYS */;
INSERT INTO `fuel_stations` (`station_id`, `station_name`, `town_id`, `station_address`) VALUES (1,'st123',2,'test'),(2,'St56',2,'test');
/*!40000 ALTER TABLE `fuel_stations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_details`
--

DROP TABLE IF EXISTS `staff_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_details` (
  `staff_nic` varchar(12) NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `staff_address` varchar(250) NOT NULL,
  `staff_phone` varchar(10) NOT NULL,
  `staff_email` varchar(50) NOT NULL,
  PRIMARY KEY (`staff_nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_details`
--

LOCK TABLES `staff_details` WRITE;
/*!40000 ALTER TABLE `staff_details` DISABLE KEYS */;
INSERT INTO `staff_details` (`staff_nic`, `staff_name`, `staff_address`, `staff_phone`, `staff_email`) VALUES ('456','abc','abc','111','pulasthi9597@gmail.com'),('789123','staff 01','','','st1@gmail.com'),('899','staff 556','','','test111@gmail.com');
/*!40000 ALTER TABLE `staff_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_login`
--

DROP TABLE IF EXISTS `staff_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_login` (
  `staff_nic` int(12) NOT NULL,
  `password` int(100) NOT NULL,
  `station_id` int(11) NOT NULL,
  PRIMARY KEY (`staff_nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_login`
--

LOCK TABLES `staff_login` WRITE;
/*!40000 ALTER TABLE `staff_login` DISABLE KEYS */;
INSERT INTO `staff_login` (`staff_nic`, `password`, `station_id`) VALUES (456,123,0),(789,123,1),(899,123,1);
/*!40000 ALTER TABLE `staff_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `towns`
--

DROP TABLE IF EXISTS `towns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `towns` (
  `town_id` int(11) NOT NULL AUTO_INCREMENT,
  `town_name` varchar(100) NOT NULL,
  PRIMARY KEY (`town_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `towns`
--

LOCK TABLES `towns` WRITE;
/*!40000 ALTER TABLE `towns` DISABLE KEYS */;
INSERT INTO `towns` (`town_id`, `town_name`) VALUES (1,'Kurunegala'),(2,'Alawwa'),(3,'Colombo 10'),(4,'Test'),(5,'Narammala'),(6,'Kuliyapitiya');
/*!40000 ALTER TABLE `towns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login_type`
--

DROP TABLE IF EXISTS `user_login_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login_type` (
  `user_nic` varchar(12) NOT NULL,
  `user_type` int(1) NOT NULL,
  PRIMARY KEY (`user_nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login_type`
--

LOCK TABLES `user_login_type` WRITE;
/*!40000 ALTER TABLE `user_login_type` DISABLE KEYS */;
INSERT INTO `user_login_type` (`user_nic`, `user_type`) VALUES ('123',0),('456',1),('789',2),('899',2);
/*!40000 ALTER TABLE `user_login_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_type`
--

DROP TABLE IF EXISTS `vehicle_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_type` (
  `vehicle_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`vehicle_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_type`
--

LOCK TABLES `vehicle_type` WRITE;
/*!40000 ALTER TABLE `vehicle_type` DISABLE KEYS */;
INSERT INTO `vehicle_type` (`vehicle_type_id`, `vehicle_type_name`) VALUES (1,'Bus'),(2,'Car');
/*!40000 ALTER TABLE `vehicle_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_type_quota`
--

DROP TABLE IF EXISTS `vehicle_type_quota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_type_quota` (
  `vehicle_quota_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_type_id` int(11) NOT NULL,
  `liters` int(11) NOT NULL,
  PRIMARY KEY (`vehicle_quota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_type_quota`
--

LOCK TABLES `vehicle_type_quota` WRITE;
/*!40000 ALTER TABLE `vehicle_type_quota` DISABLE KEYS */;
INSERT INTO `vehicle_type_quota` (`vehicle_quota_id`, `vehicle_type_id`, `liters`) VALUES (1,1,50),(2,2,25);
/*!40000 ALTER TABLE `vehicle_type_quota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'avenrate_fuelin_db'
--

--
-- Dumping routines for database 'avenrate_fuelin_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-03 15:30:20
