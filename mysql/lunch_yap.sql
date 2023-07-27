-- MySQL dump 10.19  Distrib 10.3.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: lunch_yap
-- ------------------------------------------------------
-- Server version	10.3.34-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `Advice`
--

DROP TABLE IF EXISTS `Advice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Advice` (
  `AdviceID` int(11) NOT NULL AUTO_INCREMENT,
  `LocationID` int(11) DEFAULT NULL,
  `Name` varchar(60) DEFAULT NULL,
  `IsHot` tinyint(1) DEFAULT NULL,
  `Advisor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`AdviceID`),
  KEY `fk_locationAdvice` (`LocationID`),
  CONSTRAINT `fk_locationAdvice` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Advice`
--

LOCK TABLES `Advice` WRITE;
/*!40000 ALTER TABLE `Advice` DISABLE KEYS */;
/*!40000 ALTER TABLE `Advice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) DEFAULT NULL,
  `Position` int(11) DEFAULT NULL,
  `IconFileName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (1,'Classics',1,'classics.png'),(2,'Mexican',2,'taco.png'),(3,'Pizza',3,'pizza.png'),(4,'Sandwiches',4,'sandwich.png'),(5,'Diners',5,'egg.png'),(6,'Fast Food',6,'fries.png'),(7,'Random',7,'dice.png'),(8,'Sit Down',8,'dining.png'),(9,'RSA',9,'rsa_logo.png'),(10,'Permanently Closed',10,'grave.png');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Distance`
--

DROP TABLE IF EXISTS `Distance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Distance` (
  `DistanceID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) DEFAULT NULL,
  `IconFileName` varchar(30) DEFAULT NULL,
  `Position` int(11) DEFAULT NULL,
  PRIMARY KEY (`DistanceID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Distance`
--

LOCK TABLES `Distance` WRITE;
/*!40000 ALTER TABLE `Distance` DISABLE KEYS */;
INSERT INTO `Distance` VALUES (1,'Very Short',NULL,1),(2,'Walking','walking.png',2),(3,'Short Drive','short_drive.png',3),(4,'Long Drive','long_drive.png',4),(5,'Very Long',NULL,5);
/*!40000 ALTER TABLE `Distance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequency`
--

DROP TABLE IF EXISTS `frequency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequency` (
  `LocationID` int(11) DEFAULT NULL,
  `DateVisited` date DEFAULT NULL,
  KEY `fk_locationFrequency` (`LocationID`),
  CONSTRAINT `fk_locationFrequency` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequency`
--

LOCK TABLES `frequency` WRITE;
/*!40000 ALTER TABLE `frequency` DISABLE KEYS */;
INSERT INTO `frequency` VALUES (101,'2021-10-06'),(103,'2021-09-29'),(104,'2021-11-03'),(105,'2021-11-11'),(106,'2021-11-17'),(9,'2021-11-19'),(108,'2022-04-27'),(71,'2022-05-05'),(74,'2022-04-08'),(109,'2022-03-30'),(116,'2022-05-11'),(110,'2022-05-20'),(3,'2022-05-27'),(112,'2022-05-27'),(66,'2022-06-02'),(124,'2022-06-08'),(26,'2022-06-15'),(118,'2022-07-13'),(130,'2022-07-21'),(120,'2022-07-27'),(131,'2022-08-02'),(132,'2022-08-02'),(47,'2022-08-10'),(123,'2022-08-17'),(135,'2022-08-17'),(133,'2022-08-24'),(115,'2022-09-01'),(134,'2022-09-20'),(117,'2022-09-29'),(132,'2022-09-29'),(125,'2022-10-06'),(18,'2022-10-06'),(135,'2022-10-06'),(107,'2022-10-26'),(114,'2022-11-01'),(128,'2022-11-04'),(113,'2022-11-16'),(140,'2022-11-30'),(102,'2023-02-08'),(145,'2023-03-01'),(137,'2023-03-08'),(70,'2023-03-24'),(57,'2023-04-08'),(109,'2023-04-14'),(134,'2023-04-27'),(136,'2023-05-05'),(119,'2023-05-10'),(138,'2023-05-10'),(141,'2023-05-24'),(151,'2023-06-02'),(152,'2023-06-08'),(53,'2023-06-15'),(154,'2023-06-15');
/*!40000 ALTER TABLE `frequency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `LocationID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) DEFAULT NULL,
  `Description` varchar(600) DEFAULT NULL,
  `Punchline` varchar(250) DEFAULT NULL,
  `Abbreviation` varchar(2) DEFAULT NULL,
  `Distance` varchar(10) DEFAULT NULL,
  `Latitude` varchar(25) DEFAULT NULL,
  `Longitude` varchar(25) DEFAULT NULL,
  `MenuFileName` varchar(20) DEFAULT NULL,
  `Frequency` int(11) DEFAULT 0,
  `HasVegan` tinyint(1) DEFAULT NULL,
  `HasVegetarian` tinyint(1) DEFAULT NULL,
  `HasGlutenFree` tinyint(1) DEFAULT NULL,
  `HasLactoseFree` tinyint(1) DEFAULT NULL,
  `HasTakeout` tinyint(1) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `DistanceID` int(11) DEFAULT NULL,
  `DeathDate` date DEFAULT NULL,
  `FoodType` varchar(50) DEFAULT NULL,
  `TravelTime` int(11) DEFAULT 0,
  `HasWifi` tinyint(1) DEFAULT NULL,
  `HasCashOnly` tinyint(1) DEFAULT NULL,
  `ParkingType` varchar(50) DEFAULT NULL,
  `WaitTime` int(11) DEFAULT 0,
  `Quadrant` varchar(50) DEFAULT NULL,
  `Cost` int(11) DEFAULT 1,
  `IsPlan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`LocationID`),
  KEY `fk_category` (`CategoryID`),
  CONSTRAINT `fk_category` FOREIGN KEY (`CategoryID`) REFERENCES `Category` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,'Amato\'s Cravings','Not as amazing since the owners sold the business to Amato. Garbage plates and quesadillas are good. Much less food items than before. They claimed Cuomo was the cause of their loss of business and then they rage quit Facebook.','Where the soul goes to die.','Cr','Walking','','','',0,0,0,0,0,0,10,2,'2020-09-29','',0,0,0,'',0,'',1,0),(2,'Street Meat','','Hotdog, Burger, and Gyro cart on Main Street.','Sm','Walking','43.155303','-77.613847','',0,0,0,0,0,0,1,2,NULL,'',10,0,0,'',5,'Downtown',2,NULL),(3,'Dogtown','','Hotdog joint on Monroe Ave','D','Short','43.14385884741773','-77.58976251801292','',0,1,1,0,0,1,1,3,NULL,'',8,0,0,'',10,'Monroe Ave',1,NULL),(4,'Marty\'s Meats','','Sandwiches with excellent meat.','M','Short','43.14780937925543','-77.57692849510853','',0,0,0,0,0,1,10,3,'2023-03-15','',0,0,0,'',0,'',1,0),(5,'Mi Barrio','The food was great but they apparently didn\'t want money because they were never open at predictable times - like lunch or dinner. Those weird hours of the day.','On par with Selena','','Short','','','',0,0,0,0,0,0,10,3,'2019-11-13','',0,0,0,'',0,'',1,NULL),(6,'Neno\'s','','Small seating on Monroe Ave. Does take-out.','N','Short','43.14481794460385','-77.59037708076481','',0,0,0,0,0,1,2,3,NULL,'',0,0,0,'',0,'Monroe Ave',1,NULL),(7,'Moe\'s','','We\'re going to Mooooooooe\'s!!','M','Short','43.12279536368253','-77.61876568333312','',0,0,0,0,0,0,2,3,NULL,'',0,0,0,'Lot',0,'College Town',1,NULL),(8,'Chipotle','','A different kind of Moe\'s without chips.','C','Short','43.123444194701364','-77.61780798990061','',0,0,0,0,0,0,2,3,NULL,'',0,0,0,'Lot',0,'College Town',1,NULL),(9,'John\'s Tex Mex','They have a limited menu on Mondays.','They\'ve expanded into a larger location with a bar.','J','Short','43.1476389780292','-77.60572854870863','',0,0,0,0,0,0,2,3,NULL,'Tacos, Burritos',0,0,0,'Lot',0,'South Wedge',1,NULL),(10,'Sol Buritto','','Is this still a thing?','','Short','','','',0,0,0,0,0,0,10,3,'2023-03-15','',0,0,0,'',0,'',1,0),(11,'Pizza Stop','','Best pizza in Rochester.','Pi','Walking','43.157671','-77.614756','',0,0,0,0,0,1,3,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(12,'Galleria Pizza','','It\'s got subs and chicken fingers too.','Ga','Walking','43.155980','-77.612026','',0,0,0,0,0,0,3,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(13,'Rhino\'s','','Dill. Pickle. Pizza.','','Short','','','',0,0,0,0,0,1,3,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(14,'Napa Wood Fired Pizza','','I feel like spending way too much money today.','','Short','','','',0,0,0,0,0,0,3,3,NULL,'',0,0,0,'',0,'',1,1),(15,'Ken\'s Pizza Corner','','On Monroe Ave.','','Short','','','',0,0,0,0,0,0,3,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(16,'Stromboli\'s','','They do calzones.','','Short','','','',0,0,0,0,0,0,3,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(17,'Chester\'s Cab','','It\'s near Marty\'s.','','Short','','','',0,0,0,0,0,0,3,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(18,'Pi-Craft','','Build your own pizza!','','Long','','','',0,0,0,0,0,0,3,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(19,'Dipisa\'s','The son of the owner of Pino\'s Deli in Greece.','Best Subs in Rochester','','Short','','','',0,0,0,0,0,1,4,3,NULL,'',0,0,0,'',0,'',1,1),(20,'T\'s Time Square','','Good paninis.','Ts','Walking','43.154583','-77.612133','',0,0,0,0,0,0,4,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(21,'Sapori Cafe','\"Reopening since the pandemic started has been a tough road for us to navigate due to the sudden drop in occupancy in our building as well as the surrounding buildings. This has unfortunately caused us a significant loss of revenue and has made it tough to sustain our operations. We had a great 7 years run which was driven by all of our loyal customers! We just wanted to express our appreciation to all who have supported us over the years! The entire Sapori family will truly miss seeing everyone and wish you all the best!\"','In the powers building.','Sa','Walking','43.155871','-77.613125','',0,0,0,0,0,0,10,2,'2020-10-13','',0,0,0,'',0,'',1,NULL),(22,'Grill and Greens','','Do not recommend.','GG','Walking','','','',0,0,0,0,0,0,10,2,'2023-01-17','',0,0,0,'',0,'',1,0),(23,'Subway (Main St)','','For when you just don\'t care anymore.','Su','Walking','','','',0,0,0,0,0,0,10,2,'2023-01-17','',0,0,0,'',0,'',1,0),(24,'Founders Cafe','','Fancy, pricey sandwiches. Try the Thanksgiving Sandwich.','Fo','Walking','43.154749','-77.614238','',0,0,0,0,0,0,4,2,NULL,'Sandwiches',0,0,0,'Meters',0,'Downtown',2,1),(25,'Calabresella\'s on Park','','They took the place of Great Harvest. Good subs.','','Short','','','',0,0,0,0,0,0,4,3,NULL,'',0,0,0,'',0,'',1,1),(26,'McCann\'s','','Amazing sandwiches in a butcher shop. Try the ramen on Wednesdays.','','Short','','','',0,0,0,0,0,1,10,3,'2022-08-01','',0,0,0,'',0,'',1,0),(27,'Harry G\'s','','On South Ave.','','Short','','','',0,0,0,0,0,0,10,3,'2021-05-04','',0,0,0,'',0,'',1,NULL),(28,'Wegmans','','You already go there for everything anyway.','','Short','','','',0,0,0,0,0,0,4,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(29,'Dibellas','','Same recipe as Wegmans.','','Short','','','',0,0,0,0,0,0,4,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(30,'Panera Bread','','They got food.','','Short','','','',0,0,0,0,0,0,4,3,NULL,'',0,0,0,'',0,'Henrietta',1,1),(31,'Mac\'s Philly','','The best cheesesteak. Large menu. Good seating. Nearby. Parking lot. Free WIFI.','','Short','','','',0,0,0,0,0,0,4,3,NULL,'',0,1,0,'',0,'',1,1),(32,'Balsam\'s Bagels','','They have bagels.','','Short','','','',0,0,0,0,0,0,4,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(33,'Busy Bee','','Super cheap, simple food. Seriously, no idea how they keep it this cheap.','BB','Walking','43.154970','-77.616351','',0,0,0,0,0,0,10,2,'2023-06-09','',0,0,0,'',0,'',1,0),(34,'Jim\'s on Main','','Quick service, good food, cash only, free wifi, off-street parking.','J','Short','43.16046259514881','-77.59134487116421','',0,0,0,0,0,0,5,3,NULL,'Breakfast, Sandwiches',0,1,1,'Lot',0,'Downtown',1,NULL),(35,'Burger King','','WHOPPER!!','','Short','','','',0,0,0,0,0,0,6,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(36,'Wendy\'s','','Mmmm frostys.','','Short','','','',0,0,0,0,0,0,6,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(37,'McDonalds','','You just don\'t care anymore.','','Short','','','',0,0,0,0,0,0,6,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(38,'Arbys','','The curly fries!','','Short','','','',0,0,0,0,0,0,6,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(39,'Taco Bell','','When you want regrets in a couple hours.','','Long','','','',0,0,0,0,0,0,6,4,NULL,'',0,0,0,'',0,'Kitchen',1,0),(40,'Popeye\'s','','Really good fried chicken. Better than KFC.','','Long','','','',0,0,0,0,0,0,6,4,NULL,'',0,0,0,'',0,'Kitchen',1,0),(41,'The French Quarter','','Excellent food, terrible service.','FQ','Walking','43.153163','-77.616625','',0,0,0,0,0,0,7,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(42,'Nick Tahou\'s','','It\'s been down the street from us for 5 years and we\'ve only gone once. What does that tell you?','NT','Walking','43.153883','-77.621353','',0,0,0,0,0,0,7,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(43,'Byblos Cafe','','Greek and gyros.','By','Walking','','','',0,0,0,0,0,0,10,2,'2023-01-17','',0,0,0,'',0,'',1,0),(44,'Roc City Ramen','','Very simple menu of just excellent ramen over in Cornhill. The Alexander location closed.','','Short','','','',0,0,0,0,0,0,7,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(45,'Sabra Grill','They moved to catering only.','The last sighting of Aaron.','','Short','','','',0,0,0,0,0,0,10,3,'2020-12-24','',0,0,0,'',0,'',1,NULL),(46,'The Empanada Shop','','','','Short','','','',0,0,0,0,0,0,10,3,NULL,'',0,0,0,'',0,'',1,NULL),(47,'Nathan\'s Soup and Salad','','Need to go to Henrietta now.','','Long','','','',0,0,0,0,0,0,7,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(48,'Waffles','The waffle maker left with Christian.\r\n\r\nhttp://penguinore.net/lunch/christians_last_day.jpg','(Christian)','','Very Short','','','',0,0,0,0,0,0,10,1,'2019-07-19','',0,0,0,'',0,'',1,NULL),(49,'Pizza Quesadillas','','(Matt\'s Quesadilla Maker)','','Very Short','','','',0,0,0,0,0,0,9,1,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(50,'Panini','','(Nick\'s Panini Press)','','Very Short','','','',0,0,0,0,0,0,10,1,NULL,'',0,0,0,'',0,'',1,0),(51,'SEA Restaurant','','Pho','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(52,'Han\'s Chinese','','RSA\'s Chinese Place','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(53,'Szechuan Opera','','RSA\'s BETTER Chinese Place','','Short','','','',0,0,0,0,0,0,8,3,NULL,'',0,0,0,'',0,'',1,1),(54,'Salena\'s','','Must be Friday.','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(55,'The Distillery','','A Distillery.','','Short','','','',0,0,0,0,0,0,8,3,NULL,'',0,0,0,'',0,'',1,0),(56,'Genesee Brewery','','A great view of the falls.','','Walking','','','',0,0,0,0,0,0,8,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(57,'Dino BBQ','','We go here too much.','','Walking','','','',0,0,0,0,0,0,8,2,NULL,'',0,0,0,'',0,'',1,1),(58,'Plum House','','Sushi to go.','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(59,'Jeramiah\'s','','A bar with wings.','','Short','','','',0,0,0,0,0,0,8,3,NULL,'',0,0,0,'',0,'',1,NULL),(60,'Jeramiah\'s (Buffalo Road)','','Let\'s go meet Christian!','','Long','','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Kitchen',1,0),(61,'Marshall Street','','Bar with sandwiches, burgers, dillas, fried food.','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(62,'Chen Garden','','Chinese','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(63,'Sinbad','','Mediterranean','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(64,'Shiki','','Best Sushi in Rochester!','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(65,'Abyssinia Resturant','','Ethiopian, No silverware, Eat with bread \'Injera\', small staff - long wait','','Short','','','',0,0,0,0,0,0,8,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(66,'Palmers','','They have a chicken sandwich. We went once in 2013.','','Long','','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(67,'Duff\'s','\"Unfortunately, because of the state mandates, limited capacity, and lack of business, this location is forced to close. \"','The Best Wings in Buffalo','','Long','','','',0,0,0,0,0,0,10,4,'2020-12-27','',0,0,0,'',0,'',1,NULL),(68,'Soup Spoon','','What is this?','','Long','','','',0,0,0,0,0,0,8,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(69,'Taste of Japan','','Unlimited Sushi and unlimited waiting for a check.','','Long','','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(70,'Pita Pit','','Roll your food up into a taco.','','Long','','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(71,'Tully\'s','','Get the Chicken Finger Dinner. Avoid the Mac Salad.','','Long','','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(72,'Buffalo Wild Wings','','I think there is one left in Greece?','','Long','','','',0,0,0,0,0,0,8,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(73,'Bill Grays','','World\'s Greatest Cheeseburger','','Long','','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(74,'Osaka','','Unlimited Sushi','','Long','','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(75,'Matt\'s Snack Stock','','Get some soup. Help a local business.','','Very Short','43.154962442974565','-77.6193920110726','',0,1,1,1,1,1,1,1,NULL,'Variety',1,1,0,'Your Desk',1,'Kitchen',1,NULL),(76,'White Castle','','When you don\'t plan on going back to work at all today.','','Very Long','','','',0,0,0,0,0,0,6,5,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(77,'In-n-Out Burger','','California - Airfare not included.','','Very Long','','','',0,0,0,0,0,0,6,5,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(78,'J & R','','Was a great sandwich place.','','Walking','','','',0,0,0,0,0,0,10,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(79,'Executive Cafe','','Was J & R and also was a great sandwich place.','','Walking','','','',0,0,0,0,0,0,10,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(80,'Astoria','','','','Short','','','',0,0,0,0,0,0,10,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(81,'DiPisa\'s Old World Submarines ','','On State Street. Court Street was always better.','','Walking','','','',0,0,0,0,0,0,10,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(82,'Great Harvest Bread Co.','','They had great food but the most complicated menu in the world. Probably no one knew how to buy anything.','','Short','','','',0,0,0,0,0,0,10,3,'2018-08-07','',0,0,0,'',0,'',1,NULL),(83,'Mise en Place','','','','Short','','','',0,0,0,0,0,0,10,3,'2017-12-31','',0,0,0,'',0,'',1,NULL),(84,'Pizza Hut','','','','Short','','','',0,0,0,0,0,0,10,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(85,'Jimmy Johns','','','','Short','','','',0,0,0,0,0,0,10,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(86,'Craving\'s Soul','','Died when the previous owners sold the business.','','Walking','','','',0,0,0,0,0,0,10,2,'2018-08-03','',0,0,0,'',0,'',1,NULL),(87,'Funk n\' Waffles','\"We love Rochester,” he said. \"We did well. It just wasn’t enough for that space.” Gold is closing on Water Street as he hunts for a Rochester location that is smaller and has more foot traffic. ','','','Walking','','','',0,0,0,0,0,0,10,2,'2018-11-11','',0,0,0,'',0,'',1,NULL),(88,'Mesa Grande','','','','Long','','','',0,0,0,0,0,0,10,4,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(89,'Hot Rosita\'s','','','','Walking','','','',0,0,0,0,0,0,10,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(90,'El Sauza','Closed because of vandalism.','','','Walking','','','',0,0,0,0,0,0,10,2,'2019-07-23','',0,0,0,'',0,'',1,NULL),(91,'Stock Exchange Deli','','It was like getting lunch at High School.','','Walking','','','',0,0,0,0,0,0,10,2,'2019-07-31','',0,0,0,'',0,'',1,NULL),(92,'Food Truck - Cascade','','In front of our building.','FO','Walking','43.154835','-77.619214','',0,0,0,0,0,0,1,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(93,'Food Truck - State Street','','On State and Platt','FO','Walking','43.160213','-77.617961','',0,0,0,0,0,0,1,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(94,'Food Truck - BoE','','On Plymouth and Broad','FO','Walking','43.153902','-77.615184','',0,0,0,0,0,0,1,2,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(95,'Food Truck - Midtown #1','','On Elm Street','FO','Short','43.155948','-77.605541','',0,0,0,0,0,0,1,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(96,'Food Truck - Midtown #2','','On Elm Street','FO','Short','43.156070','-77.604941','',0,0,0,0,0,0,1,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(97,'Food Truck - Midtown #3','','On Elm Street','FO','Short','43.156195','-77.604399','',0,0,0,0,0,0,1,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(98,'Fiorella (Public Market)','','Pizza, Paninis, Homemade Spaghetti - pricey but all 6 people served in less than 10 minutes.','','Short','','','',0,0,0,0,0,0,3,3,NULL,'',0,0,0,'',10,'',3,NULL),(99,'Cedar Restaurant','','Greek place with good Gyros. Monroe Ave near Dogtown.','','Short','','','',0,0,0,0,0,1,7,3,NULL,NULL,0,NULL,NULL,NULL,0,NULL,1,NULL),(100,'La Casa','','Parking lot on the side near Clinton Ave.','L','Short','43.146354968614396','-77.60312634208753','',0,0,0,0,0,0,2,3,NULL,'',0,0,0,'Lot',0,'South Wedge',1,NULL),(101,'Mission BBQ','','All types of BBQ. Quick food. Six different sauces at each table.','M','Long','43.08652293612958','-77.62419325570855','',0,0,0,0,0,0,8,4,NULL,'BBQ',0,0,0,'Lot',1,'Henrietta',1,1),(102,'Youngs Korean','Arrived at 1:30p. The wanted a reservation for their empty parking lot? No one was inside. They shooed us away. They don\'t like money.','Are they open today?','K',NULL,'43.09122800328306','-77.61874108280767','',0,0,0,0,0,0,8,4,NULL,'Korean',15,0,0,'Lot',0,'Henrietta',1,1),(103,'Fireside Grill','','Far south.','F',NULL,'43.04422970928886','-77.62110810674989','',0,0,0,0,0,0,8,4,NULL,'Sandwiches, Grill',0,0,0,'Lot',0,'Henrietta',1,1),(104,'Sodam','Bulgogi is a safe choice. The Kalbi is the same as the Korean BBQ at McCann\'s. Pan-jeon is like a scallion pancake.','Korean Food. Mini sample plates. Friendly staff.','S',NULL,'43.08876547056764','-77.6159147268092','',0,0,0,0,0,0,8,4,NULL,'Korean',0,0,0,'Lot',15,'Henrietta',3,1),(105,'Grilled Cheese Factory','In the mall. Good sized sandwiches. Comes with chips. Similar to Cheesed and Confused truck.','All kinds of melts.','G',NULL,'43.084166139644566','-77.63393300662152','',0,0,0,0,0,0,4,4,NULL,'Sandwiches',15,0,0,'Lot',10,'Henrietta',2,1),(106,'Firehouse Subs','Pros: Good bread, delicious.\r\nCons: Long wait, limited seating, not good for groups.','Delicious small sandwiches','F',NULL,'43.09505830634283','-77.6321210302833','',0,0,0,0,0,1,4,4,NULL,'Subs',15,0,0,'Lot',20,'Henrietta',3,1),(107,'Fire Crust','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(108,'Sunny\'s Diner','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(109,'Dumpling House','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(110,'110 Grill','Tester','','',NULL,NULL,NULL,'',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(112,'Juicy Seafood','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',3,1),(113,'Mesquite Grill','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(114,'MicGinny\'s on the River','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(115,'Amiel\'s','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(116,'Mamma G\'s','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(117,'Rachel\'s Mediterranean Grill','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(118,'Peppermints','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(119,'Chopsticks Chinese Restaurant','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(120,'Core Life Eatery','','','',NULL,'','','',0,0,0,0,0,0,1,3,NULL,'',0,0,0,'',0,'Henrietta',1,0),(121,'The Cheesecake Factory','','','',NULL,'','','',0,0,0,0,0,0,1,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(123,'Smashburger','','','',NULL,'','','',0,0,0,0,0,0,4,5,NULL,'',0,0,0,'Lot',0,'Henrietta',1,1),(124,'Naan-Tastic','','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(125,'Kebab House','','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',1,1),(128,'Distillery','Added through YapBot by keyboard34','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(130,'Taisho Bistro','Added through YapBot by Xenobladefan','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(131,'Patty Shack','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(132,'Yolickity','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(133,'Fox\'s Deli','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(134,'Jay\'s Diner','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(135,'Crumbl','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(136,'Umai Revolving Sushi','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(137,'Original Steve\'s Diner','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(138,'Cerame\'s Italian Villa','Added through YapBot by keyboard34','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(139,'The Old Farm Cafe and Dining Experience','Added through YapBot by keyboard34','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',NULL,1),(140,'Mecate','Added through YapBot by keyboard34','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(141,'Tony Pepperoni','Added through YapBot by keyboard34','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(142,'Delmonico\'s','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(143,'Salsarita\'s','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(144,'Blaze Pizza','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',NULL,1),(145,'Schaller\'s','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(146,'Salvatore\'s','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(147,'Peach Blossom','','','Pb',NULL,'43.15569526929338','-77.61210228577521','',0,0,0,0,0,1,2,2,NULL,'',9,0,0,'',20,'Downtown',2,0),(148,'Shake Shack (Eventually)','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(149,'Nita Burrita','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',NULL,1),(150,'Pizza Wizard','Added through YapBot by Gamerkd','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',NULL,1),(151,'Furoshiki, Furoshiki, Furoshiki','','','',NULL,'','','',0,0,0,0,0,0,1,1,NULL,'',0,0,0,'',0,'Monroe Ave',1,1),(152,'Good Smoke BBQ','Added through YapBot by BlackPenguins','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(153,'Bobs Diner','Added through YapBot by Nerfan','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1),(154,'Stever\'s','Added through YapBot by blackpenguins','','',NULL,'','','',0,0,0,0,0,0,8,4,NULL,'',0,0,0,'',0,'Henrietta',0,1);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-26 23:20:26
