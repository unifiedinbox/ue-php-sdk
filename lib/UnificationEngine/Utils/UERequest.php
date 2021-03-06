<?php

namespace UnificationEngine\Utils;

use UnificationEngine\Config\Constants as Constants;

class UERequest {
    
    /**
     * Fetches a resource from UE
     *
     * @paramm {String} $resource the resource to fetch eg. user/list,connection/add
     * @param {Object} $request_options the request options. Basically the authentication and post body
     * @returns {string|array} associative array if possible, otherwise plain string
     */
    static function fetch($resource, $request_options) {
        $auth = $request_options["auth"];
        $body = array_key_exists("body",$request_options)? json_encode($request_options["body"]) : "{}";
        $options = array(
            "auth" => $auth,
			'timeout' => 300
        );
        $url = Constants::base_url() . $resource;
        $headers = array();
        $response = \Requests::post($url, $headers,$body, $options);
        $json_decoded_response =  json_decode($response->body);
        if(empty($json_decoded_response))
            return $response->body;
        return $json_decoded_response;
    }
}


