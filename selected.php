<?php

include ('callAPI.php');


// get the restaurant to display
$get_selected = callAPI('GET', "https://developers.zomato.com/api/v2.1/restaurant?res_id=".$_POST['restaurant_id'], false);
$selected_object = json_decode($get_selected); // decode the JSON feed


// handle if API limit is exceeded
if (isset($selected_object->code) && $selected_object->code == "440") {
    echo $selected_object->message;
} else {

    ?>


    <div class="row p-3">

        <div class="col-md-6 p-3 order-md-2">
            <h1 class="h4"><?= $selected_object->name; ?></h1>
            <p class="small"><?= $selected_object->location->address; ?></p>

            <?php
            // the two unicode here are the tick/cross and then the unicode variant selector
            // to tell it to use the text rendering (not emoji rendering) of the character
            // it means there is no image to be loaded from the server which is a great trick
            // to reduce server calls for simple graphics with unicode equivalents
            if ($selected_object->has_table_booking == 1) {
                echo "<p class='small mb-0 d-flex align-items-center'><span class='unicode_icon text-success pr-1'>&#10004;&#xFE0E;</span> Bookings available</p>";
            } else {
                echo "<p class='small mb-0 d-flex align-items-center'><span class='unicode_icon text-danger pr-1'>&#10006;&#xFE0E;</span> No Bookings</p>";
            }

            if ($selected_object->has_online_delivery == 1) {
                echo "<p class='small mb-0 d-flex align-items-center'><span class='unicode_icon text-success pr-1'>&#10004;&#xFE0E;</span> Delivery available</p>";
            } else {
                echo "<p class='small mb-0 d-flex align-items-center'><span class='unicode_icon text-danger pr-1'>&#10006;&#xFE0E;</span> No Delivery</p>";
            }
            ?>

            <p class="result_heading">Cuisines</p>
            <p><?= $selected_object->cuisines; ?></p>

            <p class="result_heading">Phone Number</p>
            <p><?= $selected_object->phone_numbers; ?></p>

            <p class="result_heading">Opening Hours</p>
            <p><?= $selected_object->timings; ?></p>
        </div>

        <div class="col-md-6 p-3 order-md-1">
            <img src="<?= $selected_object->thumb; ?>" class="img-fluid w-100"/>
        </div>

    </div>

    <?php
}