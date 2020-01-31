<?php

include ('callAPI.php');


// get the restaurant to display
$get_selected = callAPI('GET', "https://developers.zomato.com/api/v2.1/restaurant?res_id=".$_POST['restaurant_id'], false);
$selected_object = json_decode($get_selected); // decode the JSON feed


echo "<img src='".$selected_object->thumb ."' /><br />";
echo $selected_object->name ."<br />";
echo $selected_object->location->address ."<br />";

echo $selected_object->has_online_delivery ."<br />";
echo $selected_object->has_table_booking ."<br />";

echo $selected_object->cuisines ."<br />";
echo $selected_object->timings ."<br />";
echo $selected_object->phone_numbers ."<br />";


?>




