<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/config/Constants.php";
require __DIR__ . "/utils/UERequest.php";
require __DIR__ . "/models/UEApp.php";
require __DIR__ . "/models/UEUser.php";
require __DIR__ . "/models/UEConnection.php";


$app = new UEApp("2206779c2acc42e2824c62026001ac25", "65c9ab904a3354738a4442e798f27387");

$user = new UEUser("505f393b-5197-44ea-8b5e-a07d870bb1bd","b3b551ee-9a73-4a57-8136-c9cd4fb36af4");

print_r($user->list_connections());
