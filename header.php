<?php
function buildHeader( $pageName ) {
    $isAdmin = isset( $_SESSION['LoggedIn'] ) && $_SESSION['LoggedIn'] && isset( $_SESSION['IsAdmin'] ) && $_SESSION['IsAdmin'];

    // Not admin, redirect them home
    if( $pageName == "Admin" && !$isAdmin ) {
        header("Location: yap.php");
    }

    echo "<head>";
        echo "<title>Yap! - $pageName</title>";
        echo "<link rel='shortcut icon' type='image/jpg' href='images/yap_favicon.png'/>";
        echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>";
        echo "<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>";
        echo "<link href='bootstrap/css/yap.css' rel='stylesheet'>";
        echo "<script src='bootstrap/js/bootstrap.min.js'></script>";
        echo "<script src='bootstrap/js/jquery.min.js'></script>";
        echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>";
        if( $pageName == "Admin" ) {
            echo "<link rel='stylesheet' href='bootstrap/css/mc-calendar.min.css' />";
            echo "<script src='bootstrap/js/mc-calendar.min.js'></script>";
            echo "<script src='bootstrap/js/admin.js'></script>";
        }
        if( $pageName == "Home" ) {
            echo "<script src='bootstrap/js/yap.js'></script>";
        }
    echo "</head>";
    echo "<body>";

        echo "<div class='header-section'>";
            echo "<img class='logo' src='images/yap_logo.png'/>";
            echo "<span class='tagline'>One place to see all places to eat for lunch.</span>";

                echo "<span class='link-container'>";
                    echo "<a href='yap.php'>Home</a>";
                    echo "<a href='about.php'>About</a>";
                    if( $isAdmin ) {
                        echo "<a href='admin.php'>Admin</a>";
                        if( $pageName == "Home" ) {
                            echo "<a onclick='visitToday()' id='visit_today_button' href='#'>Visit Today</a>";
                            echo "<input type='hidden' id='current_location_id' value='0'/>";
                        }
                    }
                echo "</span>";

                if( $pageName == "Home" ) {
                    echo "<span class='filter-container'>";

                    echo "<input type='checkbox' id='WifiFilter'/>";
                    echo "<input type='checkbox' id='CashOnlyFilter'/>";
                    echo "<input type='checkbox' id='VeganFilter'/>";
                    echo "<input type='checkbox' id='VegetarianFilter'/>";
                    echo "<input type='checkbox' id='NoGlutenFilter'/>";
                    echo "<input type='checkbox' id='NoLactoseFilter'/>";
                    echo "<input type='checkbox' id='TakeoutFilter'/>";

                    echo "<img class='filter-button disabled' title='Supports Wi-Fi' id='wifi_button' src='images/symbols/buttons/wifi_button.png'/>";
                    echo "<img class='filter-button disabled' title='Cash Only' id='cash_only_button' src='images/symbols/buttons/cash_only_button.png'/>";
                    echo "<img class='filter-button disabled' title='Supports Vegan' id='vegan_button' src='images/symbols/buttons/vegan_button.png'/>";
                    echo "<img class='filter-button disabled' title='Supports Vegetarian' id='vegetarian_button' src='images/symbols/buttons/vegetarian_button.png'/>";
                    echo "<img class='filter-button disabled' title='Supports Gluten-Free' id='gluten_free_button' src='images/symbols/buttons/gluten_free_button.png'/>";
                    echo "<img class='filter-button disabled' title='Supports Lactose-Free' id='lactose_free_button' src='images/symbols/buttons/lactose_free_button.png'/>";
                    echo "<img class='filter-button disabled' title='Supports Takeout' id='takeout_button' src='images/symbols/buttons/takeout_button.png'/>";
                    echo "</span>";

                    echo "<span class='filter-container'>";
                    echo "<input type='checkbox' id='WalkFilter'/>";
                    echo "<input type='checkbox' id='ShortFilter'/>";
                    echo "<input type='checkbox' id='LongFilter'/>";

                    echo "<img class='filter-button disabled' title='Walking Distance' id='walk_button' src='images/symbols/buttons/walking_button.png'/>";
                    echo "<img class='filter-button disabled' title='Short Drive Distance' id='short_button' src='images/symbols/buttons/short_drive_button.png'/>";
                    echo "<img class='filter-button disabled' title='Long Drive Distance' id='long_button' src='images/symbols/buttons/long_drive_button.png'/>";
                    echo "</span>";
                }
        echo "</div>";
}