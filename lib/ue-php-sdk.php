<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/config/Constants.php";
require __DIR__ . "/utils/UERequest.php";

$options = array(
    "auth" => array("2206779c2acc42e2824c62026001ac25", "65c9ab904a3354738a4442e798f27387")
);

print_r(UERequest::fetch("user/list",$options));
