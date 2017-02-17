<?php
require_once 'includes/head.php';
require_once 'unirest-php/src/Unirest.php';

// These code snippets use an open-source library. http://unirest.io/php
$response = Unirest\Request::get("https://trailapi-trailapi.p.mashape.com/?lat=35.645021&limit=500&lon=-105.367126&radius=2000&q[activities_activity_type_name_eq]=hiking",
    array(
        "X-Mashape-Key" => "xDVKljpz16mshktrjDpCiB8N2gXJp1KnwKOjsnmeVbZSi0900R",
        "Accept" => "text/plain"
    )
);
echo '<pre>';
var_dump($response->body->places);
echo '</pre>';
$places = $response->body->places;
$activity_names = array();
foreach($places as $place) :
    $activities = $place->activities;

    if($activities) :

        foreach($activities as $activity) :

            $name = $activity->activity_type_name;
            if(!in_array($name, $activity_names)) :
            array_push($activity_names, $activity->activity_type_name);
            endif;

        endforeach;

    endif;



endforeach;

echo '<pre>';
var_dump($activity_names);
echo '</pre>';