$(document).ready( function () {
    MCDatepicker.create({
        el: '#location_death_date',
        dateFormat: 'YYYY-MM-DD',
        bodyType: 'modal',
    });
});

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
    $( '#modal_category #iconFileName' ).val( $('#category_iconFileName_' + categoryID ).text() );

    // Tells the form to edit something, not add
    $( '#modal_category #category_id' ).val( categoryID );
});

$(document).on("click", ".edit_location", function () {

    // The ID of the row is stored in data-id attribute
    // This is getting the data-id from this (the button clicked)
    var locationID = $(this).data('id');
    var categoryID = $(this).data('categoryid');
    var distanceID = $(this).data('distanceid');
    var description = $(this).data('description');
    var punchline = $(this).data('punchline');
    var deathDate = $(this).data('deathdate');
    var foodType = $(this).data('foodtype');
    var travelTime = $(this).data('traveltime');
    var waitTime = $(this).data('waittime');
    var parkingType = $(this).data('parkingtype');
    var quadrant = $(this).data('quadrant');
    var cost = $(this).data('cost');

    $( '#modal_location #staticBackdropLabel' ).text( "Edit Location" );
    $( '#modal_location #action_button' ).text( "Edit" );

    // Copy data into fields
    $( '#modal_location #location_name' ).val( $('#location_name_' + locationID ).text() );
    $( '#modal_location #category' ).val( categoryID );
    $( '#modal_location #distance' ).val( distanceID );
    $( '#modal_location #cost' ).val( cost );
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
    $( '#modal_location #location_has_wifi' ).prop( 'checked', $('#location_has_wifi_' + locationID ).data( 'bool-value') == 1 );
    $( '#modal_location #location_has_cash_only' ).prop( 'checked', $('#location_has_cash_only_' + locationID ).data( 'bool-value') == 1 );
    $( '#modal_location #location_death_date' ).val( deathDate );
    $( '#modal_location #location_food_type' ).val( foodType );
    $( '#modal_location #location_travel_time' ).val( travelTime );
    $( '#modal_location #location_wait_time' ).val( waitTime );
    $( '#modal_location #location_parking_type' ).val( parkingType );
    $( '#modal_location #location_quadrant' ).val( quadrant );

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
     $( '#modal_category #iconFileName' ).val( "" );

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