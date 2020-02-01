<?php

// api key: f13cb70db0f35158d3f963a643484b5e
// Adelaide = city_id 297
// Adelaide lat lon = 34.9285° S, 138.6007° E

include ('callAPI.php');


$get_categories = callAPI('GET', 'https://developers.zomato.com/api/v2.1/categories', false);
$categories_object = json_decode($get_categories); // decode the JSON feed
$valid_categories = array('Dine-out', 'Takeaway', 'Delivery', 'Pubs & Bars');


$get_cuisines = callAPI('GET', 'https://developers.zomato.com/api/v2.1/cuisines?city_id=297', false);
$cuisines_object = json_decode($get_cuisines); // decode the JSON feed
$valid_cuisines = array('Cafe Food', 'Coffee and Tea', 'Pizza', 'Fast Food', 'Asian', 'Bakery', 'Italian', 'Sandwich', 'Chinese', 'Pub Food');

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nouislider.min.css">

    <link rel="stylesheet" href="css/custom.css">

</head>
<body>

    <div class="container">

        <form id="filters">
        <div class="row filters">

            <div class="col-12 col-md-3">

                <div class="filter_block">
                    <p class="filter_heading">Category</p>
                    <?php
                    foreach($categories_object->categories as $category) {
                        if (in_array($category->categories->name, $valid_categories)) { ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="category_<?= $category->categories->id; ?>" id="category_<?= $category->categories->id; ?>" value="">
                                <label class="custom-control-label" for="category_<?= $category->categories->id; ?>"><?= $category->categories->name; ?></label>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>
            <div class="col-12 col-md-6">

                <div class="filter_block">
                    <p class="filter_heading">Cuisine</p>
                    <div class="three_columns">
                        <?php
                        foreach($cuisines_object->cuisines as $cuisine) {
                            if (in_array($cuisine->cuisine->cuisine_name, $valid_cuisines)) { ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="cuisine_<?= $cuisine->cuisine->cuisine_id; ?>" id="cuisine_<?= $cuisine->cuisine->cuisine_id; ?>" value="">
                                    <label class="custom-control-label" for="cuisine_<?= $cuisine->cuisine->cuisine_id; ?>"><?= $cuisine->cuisine->cuisine_name; ?></label>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cuisine_110" value="110">
                            <label class="custom-control-label" for="cuisine_110">Other</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-3">

                <div class="filter_block">
                    <p class="filter_heading">Rating</p>
                    <div id="rating_slider" class="slider"></div>
                    <input type="hidden" id="rating_range" name="rating_range" value="0,5">

                    <p class="filter_heading">Cost</p>
                    <div id="cost_slider" class="slider"></div>
                    <input type="hidden" id="cost_range" name="cost_range" value="0,3">
                </div>

            </div>

        </div>
        </form>

        <div class="row bg-light">
            <div class="col-12 col-md-3 p-md-0">

                <div id="results"></div>

            </div>
            <div class="col-12 col-md-9">

                <div id="selected"></div>

            </div>
        </div>

    </div>

    <div class="loading">
        <div class="loading-container">
            <div class="d-flex  my-2 mx-3">
                <div class="spinner-border m-2" role="status"></div>
                <div class="loading-text m-2 align-self-center">
                    Loading...
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="js/nouislider.min.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>
