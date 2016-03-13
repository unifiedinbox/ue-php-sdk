<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/config/Constants.php";
require __DIR__ . "/utils/UERequest.php";
require __DIR__ . "/models/UEApp.php";
require __DIR__ . "/models/UEUser.php";
require __DIR__ . "/models/UEConnection.php";



$app  = new UEApp("b56063451547432d99111c91fd5d968b","695590bcf875546bf85c6358d3512ef8");
// $user = $app->create_user();
$user = new UEUser("9cd4e7b4-cf4f-473b-b012-b67879eecf73","5543e74a-0cbd-4dd0-8e93-93dad7492572");

// $response = $user->add_connection("f2b","facebook","CAACEdEose0cBANGOi4BMu0wcQpfSrkBz4wqPjvJSMJ2IJt4ZCeZCVcoVhrTZCAm8YkwA3DnlfmjGCBepgSOq496BYDgIsMg0CUFywZCZAZBCwgJaEXsHC2VFGWZAyMWhV6sbkRIatuS2nOZA5Ds0K3VPYVqyqW5QX90LnUtoZBFaEcM2KjubcxDruRkEYtyRdhHC7ASRePZCP0RQZDZD");

$connection = $user->add_connection("f4b","facebook","CAACEdEose0cBAAtNPsEhyosSpuALsAN8CoV1eOQPCuoilauTWZBwZAl5E8fPq1I1xcL4ZAdgbqdERZAeN7dmuTmDZCJCscMoko5UfgYdBc6uBnnxBZBUadriOE3EOHnnahqUuD9sxRLZAaxMKFl74V8EAaWDDyOs9lZAEBsHi0FOZAzjZBZAbgM3lmfGocVK14BDjlqvLTZArPKoZCQZDZD");
//





$options = array(
    "receivers" => array(
        array(
            "name"=>"Page",
            "id"=>"283031198486599"
        ),
        array(
            "name"=> "Me"
        )
    ),
    "message"=>array(
        "subject"=>"test",
        "body"=> "ABC",
        "image"=>"http://politibits.blogs.tuscaloosanews.com/files/2010/07/sanford_big_dummy_navy_shirt.jpg",
        "link"=>array(
            "uri"=> "http://google.com",
            "description"=> "link desc",
            "title"=>"link title"
        )
    )
);

$res = $connection->send_message($options);
print_r($res);
    // print_r($response);
