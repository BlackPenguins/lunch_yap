<?php
    session_start();
    include "header.php";
    buildHeader( "Admin" );
?>
</head>

<?php
    include_once "database.php";
    include_once "dao/CategoryDAO.php";
    include_once "dao/DistanceDAO.php";
    include_once "dao/LocationDAO.php";

    // HANDLE SPECIAL DB FUNCTIONS
    if (isset($_GET['specialAction'])) {
        $specialAction = $_GET['specialAction'];
        echo "<h1>Executing Special Action '${specialAction}'</h1>";

        switch ($specialAction) {
            case 'create_tables':
                Database::__createTables();
                break;
            case 'insert_sample':
                Database::__insertSampleData();
                break;
            case 'insert_0.2':
                Database::__insert0_2();
                break;
            default:
                echo "<h3>Unknown action.</h3>";
        }

        echo "<h3>Done</h3>";
        die();
    }

    $categoriesDropdown = "<select id= 'category' name='category_id'>";
    foreach (CategoryDAO::getAll() as $categoryRow ) {
        $categoryID = $categoryRow->CategoryID;
        $name = $categoryRow->Name;
        $categoriesDropdown .= "<option value='$categoryID'>$name</option>";
    }
    $categoriesDropdown .= "</select>";

    $distanceDropdown = "<select id= 'distance' name='distance_id'>";
    foreach (DistanceDAO::getAll() as $distanceRow ) {
        $distanceID = $distanceRow->DistanceID;
        $name = $distanceRow->Name;
        $distanceDropdown .= "<option value='$distanceID'>$name</option>";
    }
    $distanceDropdown .= "</select>";

    $quadrantDropdown = "<select id= 'location_quadrant' name='location_quadrant'>" .
        "<option value='Henrietta'>Henrietta</option>" .
        "<option value='Downtown'>Downtown</option>" .
        "<option value='College Town'>College Town</option>" .
        "<option value='Monroe Ave'>Monroe Ave</option>" .
        "<option value='South Wedge'>South Wedge</option>" .
        "<option value='Kitchen'>Kitchen</option>" .
        "</select>";

?>

<!-- Category Modal -->
<div class="modal fade" id="modal_category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  id='addCategory' enctype='multipart/form-data' action='admin.php?category' method='POST'>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                        <input type="text" id="category_name" name="category_name" class="form-control" aria-label="Name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Position</span>
                        <input type="number" id="position" name="position" class="form-control" aria-label="Position" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Icon File Name</span>
                        <input type="text" id="iconFileName" name="iconFileName" class="form-control" aria-label="IconFileName" aria-describedby="basic-addon1">
                    </div>

                    <input type="hidden" id="category_id" name="category_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id='action_button' type="button" onclick="$('#addCategory').submit()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Location Modal -->
<div class="modal fade" id="modal_location" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  id='addLocation' enctype='multipart/form-data' action='admin.php?location' method='POST'>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                        <input type="text" id="location_name" name="location_name" class="form-control" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Category</span>
                        <?php echo $categoriesDropdown ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Distance</span>
                        <?php echo $distanceDropdown ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Cost</span>
                        <select id='cost' name='cost'>
                            <option value='1'>Cheap</option>
                            <option value='2'>Average</option>
                            <option value='3'>Expensive</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Description</span>
                        <textarea rows='3' id="location_description" name="location_description" class="form-control" aria-describedby="basic-addon1"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Punchline</span>
                        <input type="text" id="location_punchline" name="location_punchline" class="form-control" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Abbreviation</span>
                        <input type="text" maxlength='2' id="location_abbreviation" name="location_abbreviation" class="form-control" aria-describedby="basic-addon1">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Travel Time</span>
                                <input type="number" id="location_travel_time" name="location_travel_time" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Wait Time</span>
                                <input type="number" id="location_wait_time" name="location_wait_time" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Death Date</span>
                        <input type="text" id="location_death_date" name="location_death_date" class="form-control" aria-describedby="basic-addon1">
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Food Type</span>
                        <input type="text" id="location_food_type" name="location_food_type" class="form-control" aria-describedby="basic-addon1">
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Parking Type</span>
                        <input type="text" id="location_parking_type" name="location_parking_type" class="form-control" aria-describedby="basic-addon1">
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Quadrant</span>
                        <?php echo $quadrantDropdown ?>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Latitude</span>
                                <input type="text" id="location_latitude" name="location_latitude" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Longitude</span>
                                <input type="text" id="location_longitude" name="location_longitude" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Menu</span>
                        <input type="file" id="location_menu" name="location_menu" class="form-control" id="inputGroupFile01">
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_vegan" name="location_has_vegan" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Vegan</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_vegetarian" name="location_has_vegetarian" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Vegetarian</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_gluten_free" name="location_has_gluten_free" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Gluten Free</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_lactose_free" name="location_has_lactose_free" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Lactose Free</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_takeout" name="location_has_takeout" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Takeout</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_wifi" name="location_has_wifi" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Wi-Fi</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_cash_only" name="location_has_cash_only" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Cash-Only</label>
                    </div>

                    <input type="hidden" id="location_id" name="location_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id='action_button' type="button" onclick="$('#addLocation').submit()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>



<body>

<div style='margin: 50px 20px;'>

<?php
    // ADDING NEW COLUMN GUIDE
    // 1) Add to database table
    // 2) Add to ui table
    // 3) Add to modal
    // 4) Add copy js to the modal
    // 5) Add the insert and update in the processor

    // HANDLE THE ADD OR EDIT FORMS
    if( isset( $_GET['category'] ) ) {
        $locationID = $_POST['category_id'];
        $locationName = $_POST['category_name'];
        $position = $_POST['position'];
        $iconFileName = $_POST['iconFileName'];

        if( $locationID == "ADD" ) {
            CategoryDAO::create($locationName, $position, $iconFileName);
            echo "<h2>Category <b>$locationName</b> created.<h2>";
        } else {
            CategoryDAO::update( $locationID, $locationName, $position, $iconFileName );
            echo "<h2>Category <b>$locationName</b> updated.<h2>";
        }
    } else if( isset( $_GET['location'] ) ) {
        $locationID = $_POST['location_id'];
        $locationName = $_POST['location_name'];
        $categoryID = $_POST['category_id'];
        $distanceID = $_POST['distance_id'];
        $cost = $_POST['cost'];
        $description = $_POST['location_description'];
        $punchline = $_POST['location_punchline'];
        $abbreviation = $_POST['location_abbreviation'];
        $latitude = $_POST['location_latitude'];
        $longitude = $_POST['location_longitude'];
        $hasVegan = isset( $_POST['location_has_vegan'] );
        $hasVegetarian = isset( $_POST['location_has_vegetarian'] );
        $hasGlutenFree = isset( $_POST['location_has_gluten_free'] );
        $hasLactoseFree = isset( $_POST['location_has_lactose_free'] );
        $hasTakeout = isset( $_POST['location_has_takeout'] );

        $deathDate = $_POST['location_death_date'];
        $foodType = $_POST['location_food_type'];
        $travelTime = $_POST['location_travel_time'];
        $hasWifi = isset( $_POST['location_has_wifi'] );
        $hasCashOnly = isset( $_POST['location_has_cash_only'] );
        $parkingType = $_POST['location_parking_type'];
        $waitTime = $_POST['location_wait_time'];
        $quadrant = $_POST['location_quadrant'];

        $clientMenuName = $_FILES['location_menu']['name'];
        if( $clientMenuName != "" ) {
            move_uploaded_file($_FILES['location_menu']['tmp_name'], "menus/$clientMenuName");
        }

        if( $locationID == "ADD" ) {
            LocationDAO::create($locationName, $categoryID, $description, $punchline, $abbreviation, $distanceID, $cost, $latitude, $longitude, $clientMenuName,
                $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout, $deathDate, $foodType, $travelTime, $hasWifi, $hasCashOnly, $parkingType, $waitTime, $quadrant); // update these
            echo "<h2>Location <b>$locationName</b> created.<h2>";
        } else {
            LocationDAO::update( $locationID, $locationName, $categoryID, $description, $punchline, $abbreviation, $distanceID, $cost, $latitude, $longitude, $clientMenuName,
                $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout, $deathDate, $foodType, $travelTime, $hasWifi, $hasCashOnly, $parkingType, $waitTime, $quadrant );
            echo "<h2>Location <b>$locationName</b> updated.<h2>";
        }

    }


    // DRAW THE PAGE

    echo "<div style='display: flex; justify-content: flex-end; margin-top: 15px;'>";
    echo "<button style='margin: 0px 5px;' type='button' class='add_category btn btn-primary' data-bs-toggle='modal' data-bs-target='#modal_category'>Add Category</button></td>";
    echo "<button style='margin: 0px 5px;' type='button' class='add_location btn btn-primary' data-bs-toggle='modal' data-bs-target='#modal_location'>Add Location</button></td>";
    echo "</div>";

    echo "<h1>Locations</h1>";
    echo "<div style='margin: 30px; border: 1px solid #000;' >";
    echo "<table class='table table-striped table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Category</th>";
    echo "<th>Distance</th>";
    echo "<th>Abbreviation</th>";
    echo "<th>Latitude</th>";
    echo "<th>Longitude</th>";
    echo "<th>Quadrant</th>";
    echo "<th>Vegan</th>";
    echo "<th>Vegetarian</th>";
    echo "<th>Gluten-Free</th>";
    echo "<th>Lactose-Free</th>";
    echo "<th>Takeout</th>";
    echo "<th>Wifi</th>";
    echo "<th>Cash-Only</th>";
    echo "<th>&nbsp</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
    foreach (LocationDAO::getAll() as $locationRow ) {
        $locationID = $locationRow->LocationID;
        $categoryID = $locationRow->CategoryID;
        $distanceID = $locationRow->DistanceID;
        $cost = $locationRow->Cost;

        drawTextCell( $locationID, "location_name", $locationRow->Name );
        drawTextCell( $locationID, "location_category", $locationRow->CategoryName );
        drawTextCell( $locationID, "location_distance", $locationRow->DistanceName );
        drawTextCell( $locationID, "location_abbreviation", $locationRow->Abbreviation );
        drawTextCell( $locationID, "location_latitude", $locationRow->Latitude );
        drawTextCell( $locationID, "location_longitude", $locationRow->Longitude );
        drawTextCell( $locationID, "location_quadrant", $locationRow->Quadrant );
        drawBoolCell( $locationID, "location_has_vegan", $locationRow->HasVegan );
        drawBoolCell( $locationID, "location_has_vegetarian", $locationRow->HasVegetarian );
        drawBoolCell( $locationID, "location_has_gluten_free", $locationRow->HasGlutenFree );
        drawBoolCell( $locationID, "location_has_lactose_free", $locationRow->HasLactoseFree );
        drawBoolCell( $locationID, "location_has_takeout", $locationRow->HasTakeout );
        drawBoolCell( $locationID, "location_has_wifi", $locationRow->HasWifi );
        drawBoolCell( $locationID, "location_has_cash_only", $locationRow->HasCashOnly );

        $description = $locationRow->Description;
        $punchline = $locationRow->Punchline;
        $deathDate = $locationRow->DeathDate;
        $foodType = $locationRow->FoodType;
        $travelTime = $locationRow->TravelTime;
        $waitTime = $locationRow->WaitTime;
        $parkingType = $locationRow->ParkingType;
        $quadrant = $locationRow->Quadrant;

        echo "<td><button ";
        // These are not on the page, so we need to embed the data so its copied to the modal
        echo "data-categoryid=\"$categoryID\" ";
        echo "data-distanceid=\"$distanceID\" ";
        echo "data-cost=\"$cost\" ";
        echo "data-description=\"$description\" ";
        echo "data-punchline=\"$punchline\" ";
        echo "data-deathdate=\"$deathDate\" ";
        echo "data-foodtype=\"$foodType\" ";
        echo "data-traveltime=\"$travelTime\" ";
        echo "data-waittime=\"$waitTime\" ";
        echo "data-parkingtype=\"$parkingType\" ";
        echo "data-quadrant=\"$quadrant\" ";
        echo "data-id=\"$locationID\" ";

        echo "type='button' ";
        echo "class='edit_location btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#modal_location'>Edit</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";

    echo "</table>";
    echo "</div>";


    echo "<h1>Categories</h1>";
    echo "<div style='margin: 30px; border: 1px solid #000;' >";
    echo "<table class='table table-striped table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Position</th>";
    echo "<th>Icon File Name</th>";
    echo "<th>&nbsp</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
    foreach (CategoryDAO::getAll() as $categoryRow ) {
        $categoryID = $categoryRow->CategoryID;
        $name = $categoryRow->Name;
        $position = $categoryRow->Position;
        $iconFileName = $categoryRow->IconFileName;
        echo "<tr>";
        echo "<td id='category_name_$categoryID' >$name</td>";
        echo "<td id='category_position_$categoryID' >$position</td>";
        echo "<td id='category_iconFileName_$categoryID' >$iconFileName</td>";
        echo "<td><button data-id='$categoryID' type='button' class='edit_category btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#modal_category'>Edit</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";

    echo "</table>";
    echo "</div>";

    function drawTextCell( $id, $idPrefix, $value ) {
        echo "<td id='${idPrefix}_${id}' >$value</td>";
    }

    function drawBoolCell( $id, $idPrefix, $value ) {
        echo "<td id='${idPrefix}_${id}' data-bool-value='$value'>";

        if( $value == 1 ) {
            echo "<i style='color: #00b336; font-weight:bold; font-size: 1.2em;' class='bi-check-square'></i>";
        } else {
            echo "<i style='color: #b30100; font-weight:bold; font-size: 1.2em;'class='bi-x-square'></i>";
        }

        echo "</td>";
    }
?>
</div>
</body>
