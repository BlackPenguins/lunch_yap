-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: lunch_yap
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `advice`
--

DROP TABLE IF EXISTS `advice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advice` (
  `AdviceID` int NOT NULL AUTO_INCREMENT,
  `LocationID` int DEFAULT NULL,
  `Name` varchar(60) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `IsHot` tinyint(1) DEFAULT NULL,
  `Advisor` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`AdviceID`),
  KEY `fk_location` (`LocationID`),
  CONSTRAINT `fk_location` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advice`
--

LOCK TABLES `advice` WRITE;
/*!40000 ALTER TABLE `advice` DISABLE KEYS */;
/*!40000 ALTER TABLE `advice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `CategoryID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Position` int DEFAULT NULL,
  `IconFileName` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (31,'Classics',1,'classics.png'),(32,'Mexican',2,'taco.png'),(33,'Pizza',3,'pizza.png'),(34,'Sandwiches',4,'sandwich.png'),(35,'Diners',5,'egg.png'),(36,'Fast Food',6,'fries.png'),(37,'Random',7,'dice.png'),(38,'Sit Down',8,'dining.png'),(39,'RSA',9,'rsa_logo.png'),(40,'Permanently Closed',10,'grave.png');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distance`
--

DROP TABLE IF EXISTS `distance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distance` (
  `DistanceID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `IconFileName` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Position` int DEFAULT NULL,
  PRIMARY KEY (`DistanceID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distance`
--

LOCK TABLES `distance` WRITE;
/*!40000 ALTER TABLE `distance` DISABLE KEYS */;
INSERT INTO `distance` VALUES (1,'Very Short',NULL,1),(2,'Walking','walk.png',2),(3,'Short Drive','bike.png',3),(4,'Long Drive','car.png',4),(5,'Very Long',NULL,5);
/*!40000 ALTER TABLE `distance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequency`
--

DROP TABLE IF EXISTS `frequency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `frequency` (
  `LocationID` int DEFAULT NULL,
  `datevisited` date DEFAULT NULL,
  KEY `fk_locationFrequency` (`LocationID`),
  CONSTRAINT `fk_locationFrequency` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequency`
--

LOCK TABLES `frequency` WRITE;
/*!40000 ALTER TABLE `frequency` DISABLE KEYS */;
INSERT INTO `frequency` VALUES (NULL,'2021-11-02'),(9,'2021-11-02'),(9,'2021-11-02'),(9,'2021-11-02'),(8,'2021-11-02'),(8,'2021-11-02'),(8,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(81,'2021-11-02'),(7,'2021-11-02'),(7,'2021-11-02'),(10,'2022-05-22'),(44,'2022-02-19'),(44,'2022-04-01'),(22,'2021-07-01'),(22,'2021-07-01'),(22,'2021-07-01'),(22,'2021-07-01'),(41,'2022-05-22'),(NULL,'2022-05-26'),(NULL,'2022-05-26'),(9,'2022-05-26'),(9,'2022-05-26'),(9,'2022-05-26'),(94,'2022-05-26'),(95,'2022-05-26'),(95,'2022-05-26'),(9,'2023-04-16'),(44,'2023-04-22'),(9,'2023-05-06'),(39,'2023-05-09'),(39,'2023-05-09'),(39,'2023-05-09'),(54,'2023-05-09');
/*!40000 ALTER TABLE `frequency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `LocationID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Punchline` varchar(250) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Abbreviation` varchar(2) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Distance` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `MenuFileName` varchar(40) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Frequency` int DEFAULT NULL,
  `HasVegan` tinyint(1) DEFAULT NULL,
  `HasVegetarian` tinyint(1) DEFAULT NULL,
  `HasGlutenFree` tinyint(1) DEFAULT NULL,
  `HasLactoseFree` tinyint(1) DEFAULT NULL,
  `HasTakeout` tinyint(1) DEFAULT NULL,
  `CategoryID` int DEFAULT NULL,
  `DistanceID` int DEFAULT NULL,
  `DeathDate` date DEFAULT NULL,
  `FoodType` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `TravelTime` int DEFAULT NULL,
  `HasWifi` tinyint(1) DEFAULT NULL,
  `HasCashOnly` tinyint(1) DEFAULT NULL,
  `ParkingType` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `WaitTime` int DEFAULT NULL,
  `Quadrant` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cost` int DEFAULT '1',
  `IsPlan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`LocationID`),
  KEY `fk_category` (`CategoryID`),
  KEY `fk_DistanceID` (`DistanceID`),
  CONSTRAINT `fk_category` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  CONSTRAINT `fk_DistanceID` FOREIGN KEY (`DistanceID`) REFERENCES `distance` (`DistanceID`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (7,'Amato\'s Cravings','Not as amazing since the owners sold the business to Amato. Garbage plates and quesadillas are good. Much less food items than before.','Where the soul goes to die.','Cr','Walking','43.154782','-77.617413','',NULL,1,1,1,1,1,31,2,'2023-04-14','Crap Food',2,1,1,'Street',67,'Downtown',1,1),(8,'Street Meat','Hotdog, Burger, and Gyro cart on Main Street.','Where the street goes to meet the meat.','Sm','Walking','43.155303','-77.613847','',NULL,0,0,0,1,1,31,2,'2021-10-23','Stand',0,0,0,'',0,'Downtown',2,1),(9,'Dogtown','They got dogs. Crappy bread. Still.','Where the dogs at!','Dt','Short','','','',NULL,0,0,0,0,0,31,3,'2023-04-05','Hotdogs',45,0,0,'Parking Lot',15,'Monroe Ave',3,1),(10,'Marty\'s Meats','','Sandwiches with excellent meat.','','Short','','','',NULL,1,0,1,0,1,31,3,NULL,'',0,0,1,'',0,'',1,1),(11,'Mi Barrio','','On par with Selena\'s.','','Short','','','',NULL,0,0,0,0,0,32,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(12,'Neno\'s','','Small seating on Monroe Ave. Does take-out.','','Short','','','',NULL,0,0,0,0,0,32,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(13,'Moe\'s','','We\'re going to Mooooooooe\'s!!','','Short','','','',NULL,0,0,0,0,0,32,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(14,'Chipotle','','Like Mesa Grande with crappier ingredients.','','Short','','','',NULL,0,0,0,0,0,32,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(15,'John\'s Tex Mex','','I want grease with my grease.','','Short','','','',NULL,0,0,0,0,0,32,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(16,'Sol Buritto','','Is this still a thing?','','Short','','','',NULL,0,0,0,0,0,32,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(17,'Pizza Stop','','Best pizza in Rochester.','Pi','Walking','43.157671','-77.614756','',NULL,0,0,0,0,0,33,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(18,'Galleria Pizza','','It\'s got subs and chicken fingers too.','Ga','Walking','43.155980','-77.612026','',NULL,0,0,0,0,0,33,2,NULL,'',0,0,0,'',0,'',1,1),(19,'Rhino\'s','','Dill. Pickle. Pizza.','','Short','','','',NULL,0,0,0,0,0,33,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(20,'Napa Wood Fired Pizza','','I feel like spending way too much money today.','','Short','','','',NULL,0,0,0,0,0,33,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(21,'Ken\'s Pizza Corner','','On Monroe Ave.','','Short','','','',NULL,0,0,0,0,0,33,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(22,'Stromboli\'s','','They do calzones.','','Short','','','',NULL,0,0,0,0,0,33,3,NULL,NULL,0,NULL,NULL,NULL,0,'Henrietta',1,1),(23,'Chester\'s Cab','','It\'s near Marty\'s.','','Short','','','',NULL,0,0,0,0,0,33,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(24,'Pi-Craft','','Build your own pizza!','','Long','','','',NULL,0,0,0,0,0,33,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(25,'Dipisa\'s','','Best Subs in Rochester','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(26,'T\'s Time Square','','Good paninis.','Ts','Walking','43.154583','-77.612133','',NULL,0,0,0,0,0,34,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(27,'Sapori Cafe','','In the powers building.','Sa','Walking','43.155871','-77.613125','',NULL,0,0,0,0,0,34,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(28,'Grill and Greens','','Do not recommend.','GG','Walking','43.156319','-77.613624','',NULL,0,0,0,0,0,34,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(29,'Subway','','For when you just don\'t care anymore.','Su','Walking','43.155734','-77.611411','',NULL,0,0,0,0,0,34,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(30,'Founders Cafe','','Fancy, pricey sandwiches.','Fo','Walking','43.154749','-77.614238','',NULL,0,0,0,0,0,34,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(31,'Calabresella\'s on Park','','New place on Park','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(32,'McCann\'s','','Amazing sandwiches in a butcher shop. Try the ramen on Wednesdays.','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(33,'Harry G\'s','','On South Ave.','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(34,'Wegmans','','You already go there for everything anyway.','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(35,'Dibellas','','Same recipe as Wegmans.','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,'Henrietta',1,NULL),(36,'Panera Bread','','They got food.','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(37,'Mac\'s Philly','','The best cheesesteak. Large menu. Good seating. Nearby. Parking lot. Free WIFI.','','Short','','','',NULL,0,0,0,0,0,34,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(38,'Balsam\'s Bagels8990','','They have bagels.','','Short','','','',NULL,0,0,0,0,0,34,3,'2023-04-05',NULL,0,0,0,NULL,0,NULL,2,0),(39,'Busy Bee','','Super cheap, simple food.','BB','Walking','43.154970','-77.616351','',NULL,0,0,0,0,0,35,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,1),(40,'Jim\'s on Main','','Quick service, good food, cash only, free wifi, off-street parking.','','Short','','','',NULL,0,0,0,0,0,35,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(41,'Burger King','','WHOPPER!! And the pickles. And the pickles.','','Short','','','',NULL,0,0,0,0,0,36,3,NULL,NULL,0,0,0,NULL,0,'Henrietta',1,1),(42,'Wendy\'s','','Mmmm frostys.','','Short','','','',NULL,0,0,0,0,0,36,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(43,'McDonalds','','You just don\'t care anymore.','','Short','','','',NULL,0,0,0,0,0,36,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(44,'Arbys','','The curly fries!','','Short','','','',NULL,0,0,0,0,0,36,3,NULL,NULL,0,0,0,NULL,0,'Henrietta',1,1),(45,'Taco Bell','','When you want regrets in a couple hours.','','Long','','','',NULL,0,0,0,0,0,36,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(46,'Popeye\'s','','Damn good fried chicken.','','Long','','','',NULL,0,0,0,0,0,36,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(47,'The French Quarter','','Excellent food, terrible service.','FQ','Walking','43.153163','-77.616625','',NULL,0,0,0,0,0,37,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(48,'Nick Tahou\'s','','It\'s been down the street from us for 5 years and we\'ve only gone once. What does that tell you?','NT','Walking','43.153883','-77.621353','',NULL,0,0,0,0,0,37,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(49,'Byblos Cafe','','Greek and gyros.','By','Walking','43.155495','-77.612153','',NULL,0,0,0,0,0,37,2,NULL,NULL,0,0,0,NULL,0,NULL,1,1),(50,'dfhdfgh','333ghj','333','33','Short','33','44','33',NULL,1,1,1,1,1,32,5,'2023-04-06','types',9,1,1,'lots',67,'quad',3,0),(51,'Sabra Grill','','The last sighting of Aaron.','','Short','','','',NULL,0,0,0,0,0,37,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(52,'The Empanada Shop','','They sell empandas.','','Short','','','',NULL,0,0,0,0,0,37,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(53,'Nathan\'s Soup and Salad','','Need to go to Henrietta now.','','Long','','','',NULL,0,0,0,0,0,37,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(54,'Waffles','','I couldn\'t fix.','ab','Very Short','','','',NULL,0,0,0,0,0,39,1,'2021-10-18','food type',1,1,0,'park',1,NULL,3,1),(55,'Pizza Quesadillas','','(Matt\'s Quesadilla Maker)','','Very Short','','','',NULL,0,0,0,0,0,39,1,'2021-11-16','',0,0,0,'',0,'',2,1),(56,'Panini','','(Nick\'s Panini Press)','','Very Short','','','',NULL,0,0,0,0,0,39,1,NULL,'',0,0,0,'',0,'South Wedge',1,NULL),(57,'SEA Restaurant','','Pho','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(58,'Han\'s Chinese','','RSA\'s Chinese Place','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(59,'Szechuan Opera','','RSA\'s BETTER Chinese Place','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(60,'Salena\'s','','Must be Friday.','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(61,'The Distillery','','A Distillery.','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(62,'Genesee Brewery','','A great view of the falls.','','Walking','','','',NULL,0,0,0,0,0,38,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(63,'Dino BBQ','','We go here too much.','','Walking','','','',NULL,0,0,0,0,0,38,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(64,'Plum House','','Sushi to go.','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(65,'Jeramiah\'s','','A bar.','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(66,'Jeramiah\'s (Buffalo Road)','','Let\'s go meet Christian!','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(67,'Marshall Street','','Bar with sandwiches, burgers, dillas, fried food.','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(68,'Chen Garden','','Chinese','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(69,'Sinbad','','Mediterranean','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(70,'Shiki','','Sushi','','Short','','','',NULL,0,0,0,0,0,38,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(71,'Abyssinia Resturant Move','This is something. 67','Ethiopian, No silverware, Eat with bread \'Injera\', small staff - long wait','Ab','Short','73.00','-46.00','menu.jpg',NULL,0,0,0,0,0,38,3,'2012-12-21','Greek',15,0,0,'Steet',24,'Henny',1,0),(72,'Palmers','','They have a chicken sandwich. We went once.','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,'Henrietta',1,NULL),(73,'Duff\'s','','The Best Wings in Buffalo','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(74,'Soup Spoon','','What is this?','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(75,'Taste of Japan','','Unlimited Sushi and unlimited waiting for a check.','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,'Henrietta',1,NULL),(76,'Pita Pit','','Roll your food up into a taco.','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(77,'Tully\'s','','Get the Chicken Finger Dinner. Avoid the Mac Salad.','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(78,'Buffalo Wild Wings','','I think there is one left in Greece?','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(79,'Bill Grays','','World\'s Greatest Cheeseburger','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(80,'Osaka','','Unlimited Sushi','','Long','','','',NULL,0,0,0,0,0,38,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(81,'Matt\'s Snack Stock','','Get some soup. Help a local business.','','Very Short','','','',NULL,1,0,1,0,0,31,1,NULL,'',0,1,0,'',0,'',1,1),(82,'White Castle','','When you don\'t plan on going back to work at all today.','','Very Long','','','',NULL,0,0,0,0,0,36,5,NULL,NULL,0,NULL,NULL,NULL,0,'Henrietta',1,NULL),(83,'In-n-Out Burger','','California - Airfare not included.','','Very Long','','','',NULL,0,0,0,0,0,36,5,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(84,'J & R','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(85,'Executive Cafe','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(86,'Astoria6790','','','','Short','','','',NULL,0,0,0,0,0,40,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(87,'DiPisa\'s Old World Submarines ','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(88,'Great Harvest Bread Co.','','','','Short','','','',NULL,0,0,0,0,0,40,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(89,'Mise en Place','','','','Short','','','',NULL,0,0,0,0,0,40,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(90,'Pizza Hut','','','','Short','','','',NULL,0,0,0,0,0,40,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(91,'Jimmy Johns','','','','Short','','','',NULL,0,0,0,0,0,40,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(92,'Craving\'s Soul','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(93,'Funk n\' Waffles','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(94,'Mesa Grande','','','','Long','','','',NULL,0,0,0,0,0,40,4,NULL,NULL,0,NULL,NULL,NULL,0,'Henrietta',1,NULL),(95,'Hot Rosita\'s','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,0,0,NULL,0,NULL,1,1),(96,'El Sauza','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(97,'Stock Exchange Deli','','','','Walking','','','',NULL,0,0,0,0,0,40,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(98,'Food Truck - Cascade','','In front of our building.','FO','Walking','43.154835','-77.619214','',NULL,0,0,0,0,0,31,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(99,'Food Truck - State Street','','On State and Platt','FO','Walking','43.160213','-77.617961','',NULL,0,0,0,0,0,31,2,NULL,NULL,0,0,0,NULL,0,NULL,1,1),(100,'Food Truck - BoE','','On Plymouth and Broad','FO','Walking','43.153902','-77.615184','',NULL,0,0,0,0,0,31,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(101,'Food Truck - Midtown #1','','On Elm Street','FO','Short','43.155948','-77.605541','',NULL,0,0,0,0,0,31,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(102,'Food Truck - Midtown #2','','On Elm Street','FO','Short','43.156070','-77.604941','',NULL,0,0,0,0,0,31,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(103,'Food Truck - Midtown #3','','On Elm Street','FO','Short','43.156195','-77.604399','',NULL,0,0,0,0,0,31,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(104,'Fiorella (Public Market)','','Pizza, Paninis, Homemade Spaghetti - pricey but all 6 people served in less than 10 minutes.','','Short','','','',NULL,1,1,0,0,0,33,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(146,'Catcher','Added through YapBot by BlackPenguins',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,38,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Henrietta',1,1),(147,'Rye Butter\'s Book','Added through YapBot by BlackPenguins',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,38,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Henrietta',1,1),(148,'A New Guy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,31,1,NULL,NULL,0,0,0,NULL,0,NULL,1,0),(149,'Classsss','Added through YapBot by Nothing3','','',NULL,'','','',NULL,0,0,0,0,0,38,4,NULL,'',0,0,0,'',0,'Henrietta',0,1);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `ReviewID` int NOT NULL AUTO_INCREMENT,
  `LocationID` int NOT NULL,
  `Likes` varchar(500) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Dislikes` varchar(500) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Rating` tinyint DEFAULT NULL,
  `Notes` varchar(2000) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  PRIMARY KEY (`ReviewID`),
  KEY `LocationID` (`LocationID`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,49,'Ice Cream','Brussel Sprouts',8,'This place is...ight.',12),(2,49,'Ice Cream 2','Brussel Sprouts 2',2,'This place is...ight. 2',7),(3,8,'Alright','Mud Pies8',3,'It\'s on the street!9',12),(4,8,'Hotdogs','Bugs',4,'Yummy!',7),(5,7,'ghfjhjkghjk','ghfjf',1,'gfhj',12),(6,7,'ghjk','hjgk',NULL,'ghjk',0),(7,9,'fhgj','fghj',9,'fghj',12),(8,10,'yuii','jghk',7,'ghjk',12);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-25 20:50:35
