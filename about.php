<?php
    session_start();
    include "header.php";
    buildHeader( "About" );
?>

    <div class='main-section'>
        <div id='change_log' class='page_header'><span class='title'>Change Log </span></div>
        <ul class='about_container'>

            <li class='about_entry'><b>Nov 2, 2021 (v1.2)</b>
                <ul style='margin-top:10px;'>
                    <li>Database changes - added category icons, distance, cost, travel time, wait time, death date, food type, parking type, quadrant, has wifi, is cash-only, frequency.</li>
                    <li>Dynamically loading location data and displaying it in information section (above map).</li>
                    <li>Displaying the filter icons and "date of death" in the location list on the left.</li>
                    <li>Map will pan to the location when clicked in the list (Requested by Kristen)</li>
                    <li>Map has clutter hidden like bus routes and points of interest.</li>
                    <li>Added wi-fi and cash only to filters.</li>
                    <li>Changed distance icons - removed the bus.</li>
                    <li>Markers for every single location and when clicked display the full location name in a closeable tooltip.</li>
                    <li>Category icons in the list are now images because unicode was dependent on the client OS.</li>
                    <li>Toned down the colors - less blue.</li>
                    <li>Slightly decreased height of the map to make room for information.</li>
                    <li>Added About and Admin pages.</li>
                    <li>Added calendar widget.</li>
                    <li>Moved JS and CSS into separate files.</li>
                    <li>Reorganized all images.</li>
                </ul>
            </li>
        </ul>


        <div id='change_log' class='page_header'><span class='title'>To-Do List</span></div>
        <ul class='about_container'>
            <li class='about_entry'>
                <ul style='margin-top:10px;'>
                    <li>Reviews, What's Hot, What's Not</li>
                    <li>Cross-authentication and sharing of users from Sodastock</li>
                    <li>API for access in slack with nerdbot</li>
                    <li>Links to menus (MenuURL) or picture of menus (MenuFileName)</li>
                    <li>Login Modal</li>
                    <li>Collapse categories in list</li>
                    <li>Better filtering when multiple filters are selected</li>
                    <li>Create penguinore.com/yap alias</li>
                    <li>Upgrade from Centos 6.9 to latest</li>
                    <li>Upgrade from Centos 6.9 to latest (rebuild the entire server, get SodaStock on GIT first)</li>
                    <li>General notes (same as description?)</li>
                </ul>
            </li>

<!--            // Filter traverse .location, and hide based on data-id="vegan" attributes, if they are there-->
<!--            // general notes (limited menu on mondays burritos, burrito bowls, chip at tex mex, odd hours open)-->
<!--            //-->
        </ul>

        <div id='change_log' class='page_header'><span class='title'>Credits</span></div>
        <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        <div>Icons made by <a href="https://www.flaticon.com/authors/photo3idea-studio" title="photo3idea_studio">photo3idea_studio</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        <div>Icons made by <a href="https://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel perfect</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        <div>Icons made by <a href="https://www.flaticon.com/authors/nikita-golubev" title="Nikita Golubev">Nikita Golubev</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        <div>Icons made by <a href="https://www.flaticon.com/authors/ultimatearm" title="ultimatearm">ultimatearm</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        <div>Icons made by <a href="https://www.flaticon.com/authors/roundicons" title="Roundicons">Roundicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>

    </div>
</body>