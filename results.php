<?php

include ('callAPI.php');


$city_filter = "https://developers.zomato.com/api/v2.1/search?entity_id=297&entity_type=city";
$category_filter = "";
$cuisines_filter = "";
$sort_filter = "&sort=rating&order=desc";

// loop through the returned post values and create filter url
foreach($_POST as $key => $value) {
    if (strpos($key, "category") !== FALSE) {
        if ($category_filter !=""){
            $category_filter .= "%2C";
            $category_filter .=  substr($key, strpos($key, "_") + 1);
        } else {
            $category_filter =  "&category=" . substr($key, strpos($key, "_") + 1);
        }
    }
    if (strpos($key, "cuisine") !== FALSE) {
        if ($cuisines_filter !=""){
            $cuisines_filter .= "%2C";
            $cuisines_filter .=  substr($key, strpos($key, "_") + 1);
        } else {
            $cuisines_filter =  "&cuisines=" . substr($key, strpos($key, "_") + 1);
        }
    }
}

$filter_url = $city_filter."&count=20".$category_filter.$cuisines_filter.$sort_filter;

// get the first 20 restaurants to display when filtering
$get_result = callAPI('GET', $filter_url, false);
$result_object = json_decode($get_result); // decode the JSON feed



foreach($result_object->restaurants as $restaurant) { ?>
    <p><a href="" onclick="updateSelected(<?=$restaurant->restaurant->id;?>)"><?=$restaurant->restaurant->name;?></a></p>
<?php
}


?>