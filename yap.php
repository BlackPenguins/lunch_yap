<?php
    session_start();
    include_once "database.php";
    include_once "dao/CategoryDAO.php";
    include_once "dao/LocationDAO.php";
?>

<head>
    <title>Yap!</title>
    <link rel="shortcut icon" type="image/jpg" href="images/yap_favicon_yellow.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/yap.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

    <div class='header-section'>
        <img class='logo' src='images/yap_logo_yellow.png'/>
        <span class='tagline'>One place to see all places to eat for lunch.</span>


        <span class='filter-container'>

            <input type='checkbox' id='VeganFilter'/>
            <input type='checkbox' id='VegetarianFilter'/>
            <input type='checkbox' id='NoGlutenFilter'/>
            <input type='checkbox' id='NoLactoseFilter'/>
            <input type='checkbox' id='TakeoutFilter'/>

            <img class='filter-button disabled' title='Supports Vegan' id='vegan_button' src='images/vegan_button.png'/>
            <img class='filter-button disabled' title='Supports Vegetarian' id='vegetarian_button' src='images/vegetarian_button.png'/>
            <img class='filter-button disabled' title='Supports Gluten-Free' id='gluten_free_button' src='images/gluten_free_button.png'/>
            <img class='filter-button disabled' title='Supports Lactose-Free' id='lactose_free_button' src='images/lactose_free_button.png'/>
            <img class='filter-button disabled' title='Supports Takeout' id='takeout_button' src='images/takeout_button.png'/>
        </span>

        <span class='filter-container'>
            <input type='checkbox' id='WalkFilter'/>
            <input type='checkbox' id='ShortFilter'/>
            <input type='checkbox' id='LongFilter'/>

            <img class='filter-button disabled' title='Walking Distance' id='walk_button' src='images/walk_button.png'/>
            <img class='filter-button disabled' title='Short Drive Distance' id='short_button' src='images/car_button.png'/>
            <img class='filter-button disabled' title='Long Drive Distance' id='long_button' src='images/bus_button.png'/>
        </span>

    </div>
    <div class='main-section'>
        <!-- SIDEBAR-->
        <div class="location-section">

            <div class="scrollarea d-flex flex-column align-items-stretch flex-shrink-0 bg-white">

                <?php
                    $benchMarkers = "";

                    foreach (CategoryDAO::getAll() as $categoryRow ) {
                        $categoryName = $categoryRow->Name;
                        $categoryID = $categoryRow->CategoryID;

                        echo "<a href='/' class='list-category d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom'>";

                        switch( $categoryName ) {
                            case "Classics":
                                echo "&#11088;&nbsp;";
                                break;

                            case "Mexican":
                                echo "&#127790;&nbsp;";
                                break;

                            case "Pizza":
                                echo "&#127829;&nbsp;";
                                break;

                            case "Sandwiches":
                                echo "&#129386;&nbsp;";
                                break;

                            case "Diners":
                                echo "&#129371;&nbsp;";
                                break;

                            case "Fast Food":
                                echo "&#127839;&nbsp;";
                                break;

                            case "Random":
                                echo "&#127922;&nbsp;";
                                break;

                            case "Sit Down":
                                echo "&#129681;&nbsp;";
                                break;

                            case "RSA":
                                echo "&#127970;&nbsp;";
                                break;

                            case "Permanently Closed":
                                echo "&#9760;&#65039;&nbsp;";
                                break;

                        }
                        echo "<span class='fs-5 fw-semibold'>$categoryName</span>";
                        echo "</a>";

                        echo "<div class='list-group list-group-flush border-bottom scrollarea'>";

                        foreach (LocationDAO::getWithCategoryID( $categoryID ) as $locationRow ) {
                            $name = $locationRow->Name;
                            $punchline = $locationRow->Punchline;
                            $distance = $locationRow->Distance;
                            $abbreviation = $locationRow->Abbreviation;
                            $latitude = $locationRow->Latitude;
                            $longitude = $locationRow->Longitude;

                            $distanceClass = "distance_" . str_replace(" ", "", $distance );
                            $dietaryClasses = "";

                            if( $locationRow->HasVegan ) {
                                $dietaryClasses .= " vegan";
                            }

                            if( $locationRow->HasVegetarian ) {
                                $dietaryClasses .= " vegetarian";
                            }

                            if( $locationRow->HasGlutenFree ) {
                                $dietaryClasses .= " glutenfree";
                            }

                            if( $locationRow->HasLactoseFree ) {
                                $dietaryClasses .= " lactosefree";
                            }

                            if( $locationRow->HasTakeout ) {
                                $dietaryClasses .= " takeout";
                            }

                            echo "<a href='#' class='$distanceClass $dietaryClasses location list-group-item list-group-item-action py-3 lh-tight'>";
                            echo "<div class='d-flex w-100 align-items-center justify-content-between'>";
                            echo "<strong class='mb-1'>$name</strong>";
                            echo "<small>$distance</small>";
                            echo "</div>";
                            echo "<div class='col-10 mb-1 small'>$punchline</div>";
                            echo "</a>";

                            if ( $abbreviation != "" ) {
                                $icon = "";

                                if ( $abbreviation == "FO" ) {
                                    $icon = ", icon: food_truck_logo";
                                } else {
                                    $icon = ", label: '$abbreviation'";
                                }

                                $escapedName = str_replace("'", "\'", $name);

                                if( $latitude == null ) {
                                    $benchMarkers .= "console.error( 'Latitude for $escapedName is missing!');";
                                }

                                if( $longitude == null ) {
                                    $benchMarkers .= "console.error( 'Longitude for $escapedName is missing!');";
                                }

                                if( $latitude != null && $longitude != null ) {
                                    $benchMarkers .= "new google.maps.Marker({ position: {lat: $latitude, lng: $longitude}, map: map, title: '" . $escapedName . "' $icon});\n";
                                }
                            }
                        }

                        echo "</div>";
                    }
                    ?>


            </div>
        </div>

        <div class="content-section">

            <div class='info-section'>
                More information will be here when you click places on the left side. Just need to think what to put here.


<div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
<div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
            </div>
            <div class='map-section'>
                <div id="location-map" style='height: inherit;'></div>
            </div>
        </div>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1bot3pg5kYd2M8I9FmcK29kb7YsF5iBA"></script>

    <script>
        function initialize() {
            var map = new google.maps.Map(document.getElementById('location-map'), {
                zoom: 17,
                center: { lat: 43.155814, lng: -77.615362 }
            });

            var rsa_logo = 'images/rsa_logo.png';
            var shoretel_logo = 'images/shoretel_logo.png';
            var food_truck_logo = 'images/yellow_truck.png';

            <?php echo $benchMarkers; ?>

            new google.maps.Marker({
                position: {lat: 43.155012, lng: -77.619447},
                map: map,
                icon: rsa_logo
            });

            new google.maps.Marker({
                position: {lat: 43.1600687, lng: -77.6171080},
                map: map,
                icon: shoretel_logo
            });

        }

        google.maps.event.addDomListener(window, 'load', initialize);


        $( document ).ready( function() {
            $('#vegan_button').click(function () {
                $('#VeganFilter').click();
                applyFilters();
                toggleButton( $('#vegan_button') );
            });

            $('#vegetarian_button').click(function () {
                $('#VegetarianFilter').click();
                applyFilters();
                toggleButton( $('#vegetarian_button') );
            });

            $('#gluten_free_button').click(function () {
                $('#NoGlutenFilter').click();
                applyFilters();
                toggleButton( $('#gluten_free_button') );
            });

            $('#lactose_free_button').click(function () {
                $('#NoLactoseFilter').click();
                applyFilters();
                toggleButton( $('#lactose_free_button') );
            });

            $('#takeout_button').click(function () {
                $('#TakeoutFilter').click();
                applyFilters();
                toggleButton( $('#takeout_button') );
            });

            $('#walk_button').click(function () {
                $('#WalkFilter').click();
                applyFilters();
                toggleButton( $('#walk_button') );
            });

            $('#short_button').click(function () {
                $('#ShortFilter').click();
                applyFilters();
                toggleButton( $('#short_button') );
            });

            $('#long_button').click(function () {
                $('#LongFilter').click();
                applyFilters();
                toggleButton( $('#long_button') );
            });
        });

        function toggleButton( button ) {
            if( button.hasClass( "enabled" ) ) {
                button.addClass( "disabled" );
                button.removeClass( "enabled" );
            } else {
                button.addClass( "enabled" );
                button.removeClass( "disabled" );
            }
        }
        function applyFilters() {
            var isVegan = $('#VeganFilter').prop("checked");
            var isVegetarian = $('#VegetarianFilter').prop("checked");
            var isNoGluten = $('#NoGlutenFilter').prop("checked");
            var isNoLactose = $('#NoLactoseFilter').prop("checked");
            var isTakeout = $('#TakeoutFilter').prop("checked");

            var isWalk = $('#WalkFilter').prop("checked");
            var isShort = $('#ShortFilter').prop("checked");
            var isLong = $('#LongFilter').prop("checked");

            if(!isVegan && !isVegetarian && !isNoGluten && !isNoLactose && !isTakeout && !isWalk && !isShort && !isLong ) {
                $('.location').show();
            } else {
                $('.location').hide();

                if (isVegan) {
                    $('.vegan').show();
                }

                if (isVegetarian) {
                    $('.vegetarian').show();
                }

                if (isNoGluten) {
                    $('.glutenfree').show();
                }

                if (isNoLactose) {
                    $('.lactosefree').show();
                }

                if (isTakeout) {
                    $('.takeout').show();
                }

                if (isWalk) {
                    $('.distance_Walking').show();
                }

                if (isShort) {
                    $('.distance_Short').show();
                }

                if (isLong) {
                    $('.distance_Long').show();
                }
            }
        }

    </script>
</body>