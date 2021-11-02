<?php
    session_start();
    include_once "database.php";
    include_once "dao/FrequencyDAO.php";

    $locationID = $_POST['locationID'];
    $isAdmin = isset( $_SESSION['LoggedIn'] ) && $_SESSION['LoggedIn'] && isset( $_SESSION['IsAdmin'] ) && $_SESSION['IsAdmin'];

    if( $isAdmin && $locationID != 0 ) {
        echo FrequencyDAO::insert($locationID);
    } else {
        echo "Unauthorized or location is zero.";
    }
?>