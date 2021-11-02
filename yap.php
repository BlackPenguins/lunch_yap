<?php
    session_start();
    include_once "database.php";
    include_once "header.php";
    include_once "dao/CategoryDAO.php";
    include_once "dao/DistanceDAO.php";
    include_once "dao/LocationDAO.php";

    buildHeader( "Home" );
?>
    <div class='main-section'>
        <!-- SIDEBAR-->
        <div class="location-section">

            <div class="scrollarea d-flex flex-column align-items-stretch flex-shrink-0 bg-white">

                <?php
                    $locationMarkers = "";

                    foreach (CategoryDAO::getAll() as $categoryRow ) {
                        $categoryName = $categoryRow->Name;
                        $categoryID = $categoryRow->CategoryID;
                        $categoryIconFileName = $categoryRow->IconFileName;

                        echo "<span class='list-category d-flex align-items-center flex-shrink-0 p-3 text-decoration-none border-bottom'>";

                        if( $categoryIconFileName != "" ) {
                            echo "<img style='margin-right: 10px;' src='images/category_icons/$categoryIconFileName'/>";
                        }

                        echo "<span class='fs-5 fw-semibold'>$categoryName</span>";
                        echo "</span>";

                        echo "<div class='list-group list-group-flush border-bottom scrollarea'>";

                        foreach (LocationDAO::getWithCategoryID( $categoryID ) as $locationRow ) {
                            $name = $locationRow->Name;
                            $locationID = $locationRow->LocationID;
                            $punchline = $locationRow->Punchline;
                            $distance = $locationRow->DistanceName;
                            $abbreviation = $locationRow->Abbreviation;
                            $latitude = $locationRow->Latitude;
                            $longitude = $locationRow->Longitude;
                            $deathDate = $locationRow->DeathDate;

                            $distanceClass = "distance_" . str_replace(" ", "", $distance );
                            $switchClasses = "";
                            $switchSymbols = "";

                            if( $locationRow->HasVegan ) {
                                $switchClasses .= " vegan";
                                $switchSymbols .= " <img src='images/symbols/vegan.png'/>";
                            }

                            if( $locationRow->HasVegetarian ) {
                                $switchClasses .= " vegetarian";
                                $switchSymbols .= " <img src='images/symbols/vegetarian.png'/>";
                            }

                            if( $locationRow->HasGlutenFree ) {
                                $switchClasses .= " glutenfree";
                                $switchSymbols .= " <img src='images/symbols/gluten_free.png'/>";
                            }

                            if( $locationRow->HasLactoseFree ) {
                                $switchClasses .= " lactosefree";
                                $switchSymbols .= " <img src='images/symbols/lactose_free.png'/>";
                            }

                            if( $locationRow->HasTakeout ) {
                                $switchClasses .= " takeout";
                                $switchSymbols .= " <img src='images/symbols/takeout.png'/>";
                            }

                            if( $locationRow->HasWifi ) {
                                $switchClasses .= " wifi";
                                $switchSymbols .= " <img src='images/symbols/wifi.png'/>";
                            }

                            if( $locationRow->HasCashOnly ) {
                                $switchClasses .= " cashonly";
                                $switchSymbols .= " <img src='images/symbols/cash_only.png'/>";
                            }

                            echo "<span onclick='setLocationData($locationID)' class='$distanceClass $switchClasses location list-group-item  py-3 lh-tight'>";
                            echo "<div class='d-flex w-100 align-items-center justify-content-between'>";
                            echo "<strong class='mb-1'>$name</strong>";
                            echo "<small>$distance</small>";
                            echo "</div>";
                            echo "<div class='col-10 mb-1 small'>$punchline</div>";
                            if( $deathDate ) {
                                $date = DateTime::createFromFormat('Y-m-d', $deathDate);
                                $deathDateFormatted = $date->format( "m/d/Y" );
                                echo "<div class=' list-death-date col-10 mb-1 small'>Date of Death: $deathDateFormatted</div>";
                            }
                            if( $switchSymbols ) {
                                echo "<div id='list-switch-container'>";
                                echo $switchSymbols;
                                echo "</div>";
                            }
                            echo "</span>";

                            if ( $abbreviation != "" ) {
                                $icon = "";

                                if ( $abbreviation == "FO" ) {
                                    $icon = ", icon: food_truck_logo";
                                } else {
                                    $icon = ", label: '$abbreviation'";
                                }

                                $escapedName = str_replace("'", "&#39;", $name);

                                if( $latitude == null ) {
                                    $locationMarkers .= "console.error( 'Latitude for $escapedName is missing!');";
                                }

                                if( $longitude == null ) {
                                    $locationMarkers .= "console.error( 'Longitude for $escapedName is missing!');";
                                }

                                if( $latitude != null && $longitude != null ) {
                                    $locationMarkers .= <<<MARKER
                                        {
                                            const infoWindow = new google.maps.InfoWindow(
                                                { 
                                                    content: "<span style='font-weight: bold;'>$escapedName</span>"
                                                }
                                            );
                                            
                                            const marker = new google.maps.Marker(
                                                { 
                                                    position: {lat: $latitude, lng: $longitude},
                                                    map: map,
                                                    title: '$escapedName'
                                                    $icon
                                                }
                                            );
                                            marker.addListener( 'click', () => {
                                                infoWindow.open( {
                                                    anchor: marker,
                                                    map: map,
                                                    shouldFocus: false,
                                                });
                                            });
                                        }
MARKER;
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
                <div class="row row-no-gutter">
                    <div class="details-column col-5">
                        <div class='details-name-container'>
                            <span id='details-name'></span>
                            <span id='details-cost' style='float: right'></span>
                        </div>
                        <div>
                            <span id='details-type' class='details-type'></span>
                            <a id='details-menu' href='#'>MENU</a>
                        </div>
                        <div id='details-description' class='details-description'></div>
                        <div class='details-switch-container'>
                            <img id='details-wifi' src='images/symbols/wifi.png'/>
                            <img id='details-cash-only' src='images/symbols/cash_only.png'/>
                            <img id='details-vegan' src='images/symbols/vegan.png'/>
                            <img id='details-vegetarian' src='images/symbols/vegetarian.png'/>
                            <img id='details-gluten-free' src='images/symbols/gluten_free.png'/>
                            <img id='details-lactose-free' src='images/symbols/lactose_free.png'/>
                            <img id='details-takeout' src='images/symbols/takeout.png'/>
                        </div>
                    </div>
                    <div class="details-column col-3">
                        <div class='row row-no-gutter'>
                            <div class="col-6">
                                <span class='details-time-container'><span id='details-travel-time'>N/A</span></span>
                                <div class='details-time-label'></div>
                            </div>
                            <div class="col-6">
                                <span class='details-time-container'><span id='details-wait-time'>N/A</span></span>
                                <div class='details-time-label'></div>
                            </div>
                        </div>
                        <div id='details-types-container'>
                            <div id='details-distance-container'>
                                <span class='details-label'>Distance:</span>
                                <span id='details-distance'></span>
                            </div>
                            <div id='details-quadrant-container'>
                                <span class='details-label'>Quadrant:</span>
                                <span id='details-quadrant'></span>
                            </div>
                            <div id='details-parking-container'>
                                <span class='details-label'>Parking:</span>
                                <span id='details-parking'></span>
                            </div>
                        </div>
                        <div id='details-death-date-container'>
                            Date of Death:
<!--                            <img src='images/category_icons/grave.png'/>-->
                            <span id='details-death-date' class='details-death-date'></span>
                        </div>
                        <span id='details-frequency' class='details-frequency'></span>
                    </div>
                    <div class="details-column col-4">
                        <div class='details-review-container'>
                            <div class='details-review-name'>NAME &bigstar; &bigstar; &bigstar;</div>
                            <div class='details-review-data'>Likes, Dislikes</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='map-section'>
                <div id="location-map" style='height: inherit;'></div>
            </div>
        </div>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1bot3pg5kYd2M8I9FmcK29kb7YsF5iBA"></script>

    <script>
        var map = null;

        function initialize() {
            map = new google.maps.Map(document.getElementById('location-map'), {
                zoom: 17,
                center: { lat: 43.155814, lng: -77.615362 },
                // Hide clutter on the map - points of interest, bus routes
                styles: [
                    {
                        "featureType": "poi",
                        "stylers": [
                            { "visibility": "off" }
                        ]
                    },
                    {
                        "featureType": "transit.station.bus",
                        "stylers": [
                            { "visibility": "off" }
                        ]
                    },
                ]
            });

            var rsa_logo = 'images/rsa_logo.png';
            var mitel_logo = 'images/mitel_logo.png';
            var food_truck_logo = 'images/yellow_truck.png';

            <?php echo $locationMarkers; ?>

            new google.maps.Marker({
                position: {lat: 43.155012, lng: -77.619447},
                map: map,
                icon: rsa_logo
            });

            new google.maps.Marker({
                position: {lat: 43.1600687, lng: -77.6171080},
                map: map,
                icon: mitel_logo
            });
        }

        initializeMap( map, initialize );
    </script>
</body>