<?php
    ini_set('max_execution_time', 3600);

class Database {
    // DB SETUP
    // https://stackoverflow.com/questions/43437490/pdo-construct-server-sent-charset-255-unknown-to-the-client-please-rep
    // Add to ini file in C:\ProgramData\MySQL\MySQL Server 8.0
    // Look in your php.ini' file and uncomment extension=php_pdo_mysql.dll
    // https://websitebeaver.com/php-pdo-vs-mysqli
    // https://dev.mysql.com/doc/mysql-getting-started/en/#mysql-getting-started-connecting

    // create database bookmark_feed;
    // show databases;
    // create user 'USER'@'localhost' IDENTIFIED BY 'PASS';
    // select user from mysql.user;
    // ALTER USER 'USER'@'localhost' IDENTIFIED WITH mysql_native_password BY 'PASS'; (to work with the PDO in PHP)
    // flush privileges;
    // GRANT ALL PRIVILEGES ON database_name.* TO 'USER'@'localhost';  (for user to access database)
    // show grants for 'USER'@'localhost';
    // alter table Content Add Index (UniqueName);

    private static $globalPDO = NULL;

    public static function startTransaction() {
        $pdo = self::connect();
        $pdo->beginTransaction();
    }

    public static function commitTransaction() {
        $pdo = self::connect();
        $pdo->commit();
    }

    public static function connect()
    {
        $host = 'localhost';
        $dbname = 'lunch_yap';
        $username = 'user';
        $password = 'pass';

        if( self::$globalPDO == null ) {
            try {
//                error_log("Connected to $dbname database at $host successfully.");
                self::$globalPDO = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

                // You wont get insert errors without this turned on, they'll just be warnings - which I ignore in PHP
                self::$globalPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $pe) {
                die("Could not connect to the database $dbname:<br><br>" . $pe->getMessage());
            }
        }

        return self::$globalPDO;
    }

    public static function __createTables() {
        $sql = <<<EOSQL
           CREATE TABLE IF NOT EXISTS Category (
                CategoryID              INT AUTO_INCREMENT PRIMARY KEY,
                Name       VARCHAR (30)        DEFAULT NULL,
                Position       INT
            );
EOSQL;
        Database::connect()->exec($sql);

        $sql = <<<EOSQL
           CREATE TABLE IF NOT EXISTS Location (
                LocationID              INT AUTO_INCREMENT PRIMARY KEY,
                Name       VARCHAR (30)        DEFAULT NULL,
                Description       VARCHAR (250)        DEFAULT NULL,
                Punchline       VARCHAR (250)        DEFAULT NULL,
                Abbreviation       VARCHAR (2)        DEFAULT NULL,
                Distance       VARCHAR (10)        DEFAULT NULL,
                Latitude       VARCHAR (15)        DEFAULT NULL,
                Longitude       VARCHAR (15)        DEFAULT NULL,
                MenuFileName       VARCHAR (20)        DEFAULT NULL,
                Frequency       INT DEFAULT 0,
                HasVegan       BOOLEAN,
                HasVegetarian       BOOLEAN,
                HasGlutenFree       BOOLEAN,
                HasLactoseFree       BOOLEAN,
                HasTakeout       BOOLEAN,
                CategoryID            INTEGER,
                CONSTRAINT fk_category FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
            );
EOSQL;
        Database::connect()->exec($sql);
    }

    public static function __insertSampleData() {
        $classicID = CategoryDAO::create( "Classics", 1 );
        $mexicanID = CategoryDAO::create( "Mexican", 2 );
        $pizzaID = CategoryDAO::create( "Pizza", 3 );
        $sandwichID = CategoryDAO::create( "Sandwiches", 4 );
        $dinerID = CategoryDAO::create( "Diners", 5 );
        $fastID = CategoryDAO::create( "Fast Food", 6 );
        $randomID = CategoryDAO::create( "Random", 7 );
        $sitID = CategoryDAO::create( "Sit Down", 8 );
        $rsaID = CategoryDAO::create( "RSA", 9 );
        $closedID = CategoryDAO::create( "Permanently Closed", 10 );

        LocationDAO::create("Amato's Cravings",$classicID,"Not as amazing since the owners sold the business to Amato. Garbage plates and quesadillas are good. Much less food items than before.","Where the soul goes to die.","Cr","Walking","43.154782","-77.617413","", false, false, false, false, false );
        LocationDAO::create("Street Meat",$classicID,"Hotdog, Burger, and Gyro cart on Main Street.","Where the street goes to meet the meat.","Sm","Walking","43.155303","-77.613847","", false, false, false, false, false );
        LocationDAO::create("Dogtown",$classicID,"","Where the dogs at!","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Marty's Meats",$classicID,"","Sandwiches with excellent meat.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Mi Barrio",$mexicanID,"","On par with Selena's.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Neno's",$mexicanID,"","Small seating on Monroe Ave. Does take-out.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Moe's",$mexicanID,"","We're going to Mooooooooe's!!","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Chipotle",$mexicanID,"","Like Mesa Grande with crappier ingredients.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("John's Tex Mex",$mexicanID,"","I want grease with my grease.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Sol Buritto",$mexicanID,"","Is this still a thing?","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Pizza Stop",$pizzaID,"","Best pizza in Rochester.","Pi","Walking","43.157671","-77.614756","", false, false, false, false, false );
        LocationDAO::create("Galleria Pizza",$pizzaID,"","It's got subs and chicken fingers too.","Ga","Walking","43.155980","-77.612026","", false, false, false, false, false );
        LocationDAO::create("Rhino's",$pizzaID,"","Dill. Pickle. Pizza.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Napa Wood Fired Pizza",$pizzaID,"","I feel like spending way too much money today.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Ken's Pizza Corner",$pizzaID,"","On Monroe Ave.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Stromboli's",$pizzaID,"","They do calzones.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Chester's Cab",$pizzaID,"","It's near Marty's.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Pi-Craft",$pizzaID,"","Build your own pizza!","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Dipisa's",$sandwichID,"","Best Subs in Rochester","","Short","","","", false, false, false, false, false );
        LocationDAO::create("T's Time Square",$sandwichID,"","Good paninis.","Ts","Walking","43.154583","-77.612133","", false, false, false, false, false );
        LocationDAO::create("Sapori Cafe",$sandwichID,"","In the powers building.","Sa","Walking","43.155871","-77.613125","", false, false, false, false, false );
        LocationDAO::create("Grill and Greens",$sandwichID,"","Do not recommend.","GG","Walking","43.156319","-77.613624","", false, false, false, false, false );
        LocationDAO::create("Subway",$sandwichID,"","For when you just don't care anymore.","Su","Walking","43.155734","-77.611411","", false, false, false, false, false );
        LocationDAO::create("Founders Cafe",$sandwichID,"","Fancy, pricey sandwiches.","Fo","Walking","43.154749","-77.614238","", false, false, false, false, false );
        LocationDAO::create("Calabresella's on Park",$sandwichID,"","New place on Park","","Short","","","", false, false, false, false, false );
        LocationDAO::create("McCann's",$sandwichID,"","Amazing sandwiches in a butcher shop. Try the ramen on Wednesdays.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Harry G's",$sandwichID,"","On South Ave.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Wegmans",$sandwichID,"","You already go there for everything anyway.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Dibellas",$sandwichID,"","Same recipe as Wegmans.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Panera Bread",$sandwichID,"","They got food.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Mac's Philly",$sandwichID,"","The best cheesesteak. Large menu. Good seating. Nearby. Parking lot. Free WIFI.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Balsam's Bagels",$sandwichID,"","They have bagels.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Busy Bee",$dinerID,"","Super cheap, simple food.","BB","Walking","43.154970","-77.616351","", false, false, false, false, false );
        LocationDAO::create("Jim's on Main",$dinerID,"","Quick service, good food, cash only, free wifi, off-street parking.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Burger King",$fastID,"","WHOPPER!! And the pickles. And the pickles.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Wendy's",$fastID,"","Mmmm frostys.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("McDonalds",$fastID,"","You just don't care anymore.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Arbys",$fastID,"","The curly fries!","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Taco Bell",$fastID,"","When you want regrets in a couple hours.","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Popeye's",$fastID,"","Damn good fried chicken.","","Long","","","", false, false, false, false, false );
        LocationDAO::create("The French Quarter",$randomID,"","Excellent food, terrible service.","FQ","Walking","43.153163","-77.616625","", false, false, false, false, false );
        LocationDAO::create("Nick Tahou's",$randomID,"","It's been down the street from us for 5 years and we've only gone once. What does that tell you?","NT","Walking","43.153883","-77.621353","", false, false, false, false, false );
        LocationDAO::create("Byblos Cafe",$randomID,"","Greek and gyros.","By","Walking","43.155495","-77.612153","", false, false, false, false, false );
        LocationDAO::create("Brooklyn Ramen",$randomID,"","Very simple menu of just excellent ramen.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Sabra Grill",$randomID,"","The last sighting of Aaron.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("The Empanada Shop",$randomID,"","They sell empandas.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Nathan's Soup and Salad",$randomID,"","Need to go to Henrietta now.","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Waffles",$rsaID,"","(Christian's Waffle Maker)","","Very Short","","","", false, false, false, false, false );
        LocationDAO::create("Pizza Quesadillas",$rsaID,"","(Matt's Quesadilla Maker)","","Very Short","","","", false, false, false, false, false );
        LocationDAO::create("Panini",$rsaID,"","(Nick's Panini Press)","","Very Short","","","", false, false, false, false, false );
        LocationDAO::create("SEA Restaurant",$sitID,"","Pho","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Han's Chinese",$sitID,"","RSA's Chinese Place","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Szechuan Opera",$sitID,"","RSA's BETTER Chinese Place","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Salena's",$sitID,"","Must be Friday.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("The Distillery",$sitID,"","A Distillery.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Genesee Brewery",$sitID,"","A great view of the falls.","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Dino BBQ",$sitID,"","We go here too much.","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Plum House",$sitID,"","Sushi to go.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Jeramiah's",$sitID,"","A bar.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Jeramiah's (Buffalo Road)",$sitID,"","Let's go meet Christian!","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Marshall Street",$sitID,"","Bar with sandwiches, burgers, dillas, fried food.","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Chen Garden",$sitID,"","Chinese","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Sinbad",$sitID,"","Mediterranean","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Shiki",$sitID,"","Sushi","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Abyssinia Resturant",$sitID,"","Ethiopian, No silverware, Eat with bread 'Injera', small staff - long wait","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Palmers",$sitID,"","They have a chicken sandwich. We went once.","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Duff's",$sitID,"","The Best Wings in Buffalo","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Soup Spoon",$sitID,"","What is this?","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Taste of Japan",$sitID,"","Unlimited Sushi and unlimited waiting for a check.","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Pita Pit",$sitID,"","Roll your food up into a taco.","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Tully's",$sitID,"","Get the Chicken Finger Dinner. Avoid the Mac Salad.","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Buffalo Wild Wings",$sitID,"","I think there is one left in Greece?","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Bill Grays",$sitID,"","World's Greatest Cheeseburger","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Osaka",$sitID,"","Unlimited Sushi","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Matt's Snack Stock",$classicID,"","Get some soup. Help a local business.","","Very Short","","","", false, false, false, false, false );
        LocationDAO::create("White Castle",$fastID,"","When you don't plan on going back to work at all today.","","Very Long","","","", false, false, false, false, false );
        LocationDAO::create("In-n-Out Burger",$fastID,"","California - Airfare not included.","","Very Long","","","", false, false, false, false, false );
        LocationDAO::create("J & R",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Executive Cafe",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Astoria",$closedID,"","","","Short","","","", false, false, false, false, false );
        LocationDAO::create("DiPisa's Old World Submarines (State Street)",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Great Harvest Bread Co.",$closedID,"","","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Mise en Place",$closedID,"","","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Pizza Hut",$closedID,"","","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Jimmy Johns",$closedID,"","","","Short","","","", false, false, false, false, false );
        LocationDAO::create("Craving's Soul",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Funk n' Waffles",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Mesa Grande",$closedID,"","","","Long","","","", false, false, false, false, false );
        LocationDAO::create("Hot Rosita's",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("El Sauza",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Stock Exchange Deli",$closedID,"","","","Walking","","","", false, false, false, false, false );
        LocationDAO::create("Food Truck - Cascade",$classicID,"","In front of our building.","FOOD TRUCK","Walking","43.154835","-77.619214","", false, false, false, false, false );
        LocationDAO::create("Food Truck - State Street",$classicID,"","On State and Platt","FOOD TRUCK","Walking","43.160213","-77.617961","", false, false, false, false, false );
        LocationDAO::create("Food Truck - BoE",$classicID,"","On Plymouth and Broad","FOOD TRUCK","Walking","43.153902","-77.615184","", false, false, false, false, false );
        LocationDAO::create("Food Truck - Midtown #1",$classicID,"","On Elm Street","FOOD TRUCK","Short","43.155948","-77.605541","", false, false, false, false, false );
        LocationDAO::create("Food Truck - Midtown #2",$classicID,"","On Elm Street","FOOD TRUCK","Short","43.156070","-77.604941","", false, false, false, false, false );
        LocationDAO::create("Food Truck - Midtown #3",$classicID,"","On Elm Street","FOOD TRUCK","Short","43.156195","-77.604399","", false, false, false, false, false );
        LocationDAO::create("Fiorella (Public Market)",$pizzaID,"","Pizza, Paninis, Homemade Spaghetti - pricey but all 6 people served in less than 10 minutes.","","Short","","","", false, false, false, false, false );
    }
}
?>

