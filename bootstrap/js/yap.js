var map = null;

function initializeMap( newMap, initFunction ) {
    map = newMap;
    google.maps.event.addDomListener(window, 'load', initFunction);
}

$( document ).ready( function() {
    $('#wifi_button').click(function () {
        $('#WifiFilter').click();
        applyFilters();
        toggleButton( $('#wifi_button') );
    });

    $('#cash_only_button').click(function () {
        $('#CashOnlyFilter').click();
        applyFilters();
        toggleButton( $('#cash_only_button') );
    });

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
    var isWifi = $('#WifiFilter').prop("checked");
    var isCashOnly = $('#CashOnlyFilter').prop("checked");
    var isVegan = $('#VeganFilter').prop("checked");
    var isVegetarian = $('#VegetarianFilter').prop("checked");
    var isNoGluten = $('#NoGlutenFilter').prop("checked");
    var isNoLactose = $('#NoLactoseFilter').prop("checked");
    var isTakeout = $('#TakeoutFilter').prop("checked");

    var isWalk = $('#WalkFilter').prop("checked");
    var isShort = $('#ShortFilter').prop("checked");
    var isLong = $('#LongFilter').prop("checked");

    if(!isVegan && !isVegetarian && !isNoGluten && !isNoLactose && !isTakeout && !isWalk && !isShort && !isLong && !isWifi && !isCashOnly ) {
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

        if (isWifi) {
            $('.wifi').show();
        }

        if (isCashOnly) {
            $('.cashonly').show();
        }

        if (isWalk) {
            $('.distance_Walking').show();
        }

        if (isShort) {
            $('.distance_ShortDrive').show();
        }

        if (isLong) {
            $('.distance_LongDrive').show();
        }
    }
}

function visitToday() {
    let currentLocationID = $("#current_location_id").val();
    $.post("increase_frequency.php", { locationID: currentLocationID }, function(data){ console.log("Frequency Returned: " + data ); } );
}

function setLocationData( locationID ) {
    $.post("get_location.php", { locationID }, function(data){
        console.log("Location Returned: ", data );

        $("#current_location_id").val( locationID );
        $("#details-name").html( data.name );
        $("#details-type").html( data.foodType );

        if( data.description ) {
            $("#details-description").html(data.description);
        } else {
            $("#details-description").html("No description yet.");
        }

        if( data.deathDate ) {
            $('#details-death-date-container').show();
            $("#details-death-date").html(data.deathDate);
        } else {
            $('#details-death-date-container').hide();
        }

        if( data.distance ) {
            $("#details-distance-container").show();
            $("#details-distance").html(data.distance);
        } else {
            $("#details-distance-container").hide();
        }

        var costString = new Array( parseInt(data.cost) + 1).join( '$' );
        $("#details-cost").html( costString );

        $("#details-frequency").html( data.frequency + "x" );

        $("#details-food-type").html( data.foodType );
        $("#details-menu").html( data.menuFileName );

        if( data.parkingType ) {
            $("#details-parking-container").show();
            $("#details-parking").html(data.parkingType);
        } else {
            $("#details-parking-container").hide();
        }

        if( data.quadrant ) {
            $("#details-quadrant-container").show();
            $("#details-quadrant").html(data.quadrant);
        } else {
            $("#details-quadrant-container").hide();
        }

        if( data.travelTime > 0 ) {
            $("#details-travel-time").html(data.travelTime + " MIN" );
        } else {
            $("#details-travel-time").html( "N/A" );
        }

        if( data.waitTime > 0 ) {
            $("#details-wait-time").html(data.waitTime + " MIN" );
        } else {
            $("#details-wait-time").html( "N/A" );
        }

        var hasSwitch = false;

        if( data.hasVegan == "1" ) {
            $( '#details-vegan' ).css('display', 'inline-block');
            hasSwitch = true;
        } else {
            $( '#details-vegan' ).css('display', 'none');
        }

        if( data.hasVegetarian == "1" ) {
            $( '#details-vegetarian' ).css('display', 'inline-block');
            hasSwitch = true;
        } else {
            $( '#details-vegetarian' ).css('display', 'none');
        }

        if( data.hasGlutenFree == "1" ) {
            $( '#details-gluten-free' ).css('display', 'inline-block');
            hasSwitch = true;
        } else {
            $( '#details-gluten-free' ).css('display', 'none');
        }

        if( data.hasLactoseFree == "1" ) {
            $( '#details-lactose-free' ).css('display', 'inline-block');
            hasSwitch = true;
        } else {
            $( '#details-lactose-free' ).css('display', 'none');
        }

        if( data.hasTakeout == "1" ) {
            $( '#details-takeout' ).css('display', 'inline-block');
            hasSwitch = true;
        } else {
            $( '#details-takeout' ).css('display', 'none');
        }

        if( data.hasWifi == "1" ) {
            $( '#details-wifi' ).css('display', 'inline-block');
            hasSwitch = true;
        } else {
            $( '#details-wifi' ).css('display', 'none');
        }

        if( data.hasCashOnly == "1" ) {
            $( '#details-cash-only' ).css('display', 'inline-block');
            hasSwitch = true;
        } else {
            $( '#details-cash-only' ).css('display', 'none');
        }

        if( hasSwitch ) {
            $( '.details-switch-container' ).show();
        } else {
            $( '.details-switch-container' ).hide();
        }

        if( !data.reviews ) {
            $('.details-review-container').html("No reviews yet.");
        }

        if( data.longitude && data.latitude ) {
            map.panTo({lat: data.latitude, lng: data.longitude});
        }
      }, "json");
}