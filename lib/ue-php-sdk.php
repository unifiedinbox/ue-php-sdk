<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/config/Constants.php";
require __DIR__ . "/utils/UERequest.php";
require __DIR__ . "/models/UEApp.php";
require __DIR__ . "/models/UEUser.php";
require __DIR__ . "/models/UEConnection.php";



$app  = new UEApp("APP_KEY","APP_SECRET");

//Create a new user
$user = $app->create_user();


//Or use an existing user
$user = new UEUser("USER_KEY","USER_SECRET");


//Add a connection. (throws an error if the connection is not added)
$connection = $user->add_connection("FB","facebook","FACEBOOK_ACCESS_TOKEN");


//Message Options
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



//Send the message and get their uris
$uris = $connection->send_message($options);
