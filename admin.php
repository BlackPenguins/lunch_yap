<?php session_start(); ?>
<head>
    <title>Yap! - Admin</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script>
        // On click of any of the edit buttons, copy the data from the table of that row into the modal
        // and update the label in modal to say EDIT
        $(document).on("click", ".edit_category", function () {
            // The ID of the row is stored in data-id attribute
            // This is getting the data-id from this (the button clicked)
            var categoryID = $(this).data('id');

            $( '#modal_category #staticBackdropLabel' ).text( "Edit Category" );
            $( '#modal_category #action_button' ).text( "Edit" );

            // Copy data into fields
            $( '#modal_category #category_name' ).val( $('#category_name_' + categoryID ).text() );
            $( '#modal_category #position' ).val( $('#category_position_' + categoryID ).text() );

            // Tells the form to edit something, not add
            $( '#modal_category #category_id' ).val( categoryID );
        });

        $(document).on("click", ".edit_location", function () {
            // The ID of the row is stored in data-id attribute
            // This is getting the data-id from this (the button clicked)
            var locationID = $(this).data('id');
            var categoryID = $(this).data('categoryid');
            var description = $(this).data('description');
            var punchline = $(this).data('punchline');

            $( '#modal_location #staticBackdropLabel' ).text( "Edit Location" );
            $( '#modal_location #action_button' ).text( "Edit" );

            // Copy data into fields
            $( '#modal_location #location_name' ).val( $('#location_name_' + locationID ).text() );
            $( '#modal_location #category' ).val( categoryID );
            $( '#modal_location #location_distance' ).val( $('#location_distance_' + locationID ).text() );
            $( '#modal_location #location_description' ).val( description );
            $( '#modal_location #location_punchline' ).val( punchline );
            $( '#modal_location #location_abbreviation' ).val( $('#location_abbreviation_' + locationID ).text() );
            $( '#modal_location #location_latitude' ).val( $('#location_latitude_' + locationID ).text() );
            $( '#modal_location #location_longitude' ).val( $('#location_longitude_' + locationID ).text() );
            $( '#modal_location #location_has_vegan' ).prop( 'checked', $('#location_has_vegan_' + locationID ).data( 'bool-value') == 1 );
            $( '#modal_location #location_has_vegetarian' ).prop( 'checked', $('#location_has_vegetarian_' + locationID ).data( 'bool-value') == 1 );
            $( '#modal_location #location_has_gluten_free' ).prop( 'checked', $('#location_has_gluten_free_' + locationID ).data( 'bool-value') == 1 );
            $( '#modal_location #location_has_lactose_free' ).prop( 'checked', $('#location_has_lactose_free_' + locationID ).data( 'bool-value') == 1 );
            $( '#modal_location #location_has_takeout' ).prop( 'checked', $('#location_has_takeout_' + locationID ).data( 'bool-value') == 1 );

             // Tells the form to edit something, not add
             $( '#modal_location #location_id' ).val( locationID );
        });


        // On click of any of the add buttons, clear the inputs of the modal and update the
        // labels in modal to say ADD
         $(document).on("click", ".add_category", function () {
             $( '#modal_category #staticBackdropLabel' ).text( "Add Category" );
             $( '#modal_category #action_button' ).text( "Add" );

             // Clear fields
             $( '#modal_category #category_name' ).val( "" );
             $( '#modal_category #position' ).val( "" );

             // Tells the form to add something, not edit
             $( '#modal_category #category_id' ).val( "ADD" );
        });

         $(document).on("click", ".add_location", function () {
             $( '#modal_location #staticBackdropLabel' ).text( "Add Location" );
             $( '#modal_location #action_button' ).text( "Add" );

             // Clear fields
             $( '#modal_location #location_name' ).val( "" );

             // Tells the form to add something, not edit
             $( '#modal_location #location_id' ).val( "ADD" );
        });

    </script>
</head>

<?php
    include_once "database.php";
    include_once "dao/CategoryDAO.php";
    include_once "dao/LocationDAO.php";


    $categoriesDropdown = "<select id= 'category' name='category_id'>";
    foreach (CategoryDAO::getAll() as $categoryRow ) {
        $categoryID = $categoryRow->CategoryID;
        $name = $categoryRow->Name;
        $categoriesDropdown .= "<option value='$categoryID'>$name</option>";
    }
    $categoriesDropdown .= "</select>";

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
                        <select id="location_distance" name="location_distance">
                            <option value='Very Short'>Very Short</option>
                            <option value='Walking'>Walking</option>
                            <option value='Short'>Short</option>
                            <option value='Long'>Long</option>
                            <option value='Very Long'>Very Long</option>
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
                        <input class="form-check-input" id="location_has_vegan" name="location_has_vegan" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Vegan</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_vegetarian" name="location_has_vegetarian" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Vegetarian</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_gluten_free" name="location_has_gluten_free" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Gluten Free</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_lactose_free" name="location_has_lactose_free" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Lactose Free</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" id="location_has_takeout" name="location_has_takeout" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Takeout</label>
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

<body style='margin: 20px;'>

<?php
    // ADDING NEW COLUMN GUIDE
    // 1) Add to database table
    // 2) Add to ui table
    // 3) Add to modal
    // 4) Add copy js to the modal
    // 5) Add the insert and update in the processor

    // TODO MTM: Password in other files
    // - Users from Sodastock migrated
    // Login Modal
    // Distance Table - so we can sort by distance
    // What's hot?
    // Reviews, Frequency
    // api.php for slack

    $isAdmin = isset( $_SESSION['LoggedIn'] ) && $_SESSION['LoggedIn'] && isset( $_SESSION['IsAdmin'] ) && $_SESSION['IsAdmin'];

    if( $isAdmin ) {
        // HANDLE THE ADD OR EDIT FORMS
        if( isset( $_GET['category'] ) ) {
            $locationID = $_POST['category_id'];
            $locationName = $_POST['category_name'];
            $position = $_POST['position'];

            if( $locationID == "ADD" ) {
                CategoryDAO::create($locationName, $position);
                echo "<h2>Category <b>$locationName</b> created.<h2>";
            } else {
                CategoryDAO::update( $locationID, $locationName, $position );
                echo "<h2>Category <b>$locationName</b> updated.<h2>";
            }
        } else if( isset( $_GET['location'] ) ) {
            $locationID = $_POST['location_id'];
            $locationName = $_POST['location_name'];
            $categoryID = $_POST['category_id'];

            $distance = $_POST['location_distance'];
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

            $clientMenuName = $_FILES['location_menu']['name'];
            if( $clientMenuName != "" ) {
                move_uploaded_file($_FILES['location_menu']['tmp_name'], "menus/$clientMenuName");
            }

            if( $locationID == "ADD" ) {
                LocationDAO::create($locationName, $categoryID, $description, $punchline, $abbreviation, $distance, $latitude, $longitude, $clientMenuName, $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout); // update these
                echo "<h2>Location <b>$locationName</b> created.<h2>";
            } else {
                LocationDAO::update( $locationID, $locationName, $categoryID, $description, $punchline, $abbreviation, $distance, $latitude, $longitude, $clientMenuName, $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout );
                echo "<h2>Location <b>$locationName</b> updated.<h2>";
            }

        }

        // HANDLE SPECIAL DB FUNCTIONS
        if( isset( $_GET['specialAction'] ) ) {
            $specialAction = $_GET['specialAction'];
            echo "<h1>Executing Special Action '${specialAction}'</h1>";

            switch( $specialAction ) {
                case 'create_tables':
                    Database::__createTables();
                    break;
                case 'insert_sample':
                    Database::__insertSampleData();
                    break;
                default:
                    echo "<h3>Unknown action.</h3>";
            }

            echo "<h3>Done</h3>";

        // DRAW THE PAGE
        } else {

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
            echo "<th>Menu</th>";
            echo "<th>Frequency</th>";
            echo "<th>Vegan</th>";
            echo "<th>Vegetarian</th>";
            echo "<th>Gluten-Free</th>";
            echo "<th>Lactose-Free</th>";
            echo "<th>Takeout</th>";
            echo "<th>&nbsp</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
            foreach (LocationDAO::getAll() as $locationRow ) {
                $locationID = $locationRow->LocationID;
                $categoryID = $locationRow->CategoryID;

                drawTextCell( $locationID, "location_name", $locationRow->Name );
                drawTextCell( $locationID, "location_category", $locationRow->CategoryName );
                drawTextCell( $locationID, "location_distance", $locationRow->Distance );
                drawTextCell( $locationID, "location_abbreviation", $locationRow->Abbreviation );
                drawTextCell( $locationID, "location_latitude", $locationRow->Latitude );
                drawTextCell( $locationID, "location_longitude", $locationRow->Longitude );
                drawTextCell( $locationID, "location_menu", $locationRow->MenuFileName );
                drawTextCell( $locationID, "location_frequency", $locationRow->Frequency );
                drawBoolCell( $locationID, "location_has_vegan", $locationRow->HasVegan );
                drawBoolCell( $locationID, "location_has_vegetarian", $locationRow->HasVegetarian );
                drawBoolCell( $locationID, "location_has_gluten_free", $locationRow->HasGlutenFree );
                drawBoolCell( $locationID, "location_has_lactose_free", $locationRow->HasLactoseFree );
                drawBoolCell( $locationID, "location_has_takeout", $locationRow->HasTakeout );

                $description = $locationRow->Description;
                $punchline = $locationRow->Punchline;

                echo "<td><button data-categoryid='$categoryID' data-description='$description' data-punchline='$punchline' data-id='$locationID' type='button' class='edit_location btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#modal_location'>Edit</button></td>";
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
            echo "<th>&nbsp</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
            foreach (CategoryDAO::getAll() as $categoryRow ) {
                $categoryID = $categoryRow->CategoryID;
                $name = $categoryRow->Name;
                $position = $categoryRow->Position;
                echo "<tr>";
                echo "<td id='category_name_$categoryID' >$name</td>";
                echo "<td id='category_position_$categoryID' >$position</td>";
                echo "<td><button data-id='$categoryID' type='button' class='edit_category btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#modal_category'>Edit</button></td>";
                echo "</tr>";
            }
            echo "</tbody>";

            echo "</table>";
            echo "</div>";


        }
    } else {
        // Not admin, redirect them home
        header( "Location: yap.php" );
    }

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

</body>
