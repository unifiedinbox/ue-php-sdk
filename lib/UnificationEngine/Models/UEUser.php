<?php


namespace UnificationEngine\Models;

use UnificationEngine\Utils\UERequest;

Class UEUser {


    /*URI: user://e9759590-54ef-4cd3-a01c-cb2241ddd812:1aee1a25-e0c4-4036-a8fd-4d41adc8611b@
     *COMB: key,secret
     ** Constructor
     * @desc The constructor can be in one of two forms; URI form or key,secret form. eg new User(key,secret) or new User(uri)
     * @param {String} uri the user uri string
     * @param {String} key the user key
     * @param {String} secret the user secret
     */
    public function __construct($uri_or_key, $secret=null){
        if($secret) {
            //key,secret provided
            $this->user_key = $uri_or_key;
            $this->user_secret = $secret;
            $this->uri = "user://" . $this->user_key . ":" . $this->user_secret . "@";
        }
        else {
            //uri provided
            $matches = array();
            $matched = preg_match("/user:\/\/(.+):(.+)@/",$uri_or_key, $matches);

            if(!$matched) {
                throw new \Exception("Can't initialize user. Please pass key,secret or user uri");
            }

            $this->user_key = $matches[1];
            $this->user_secret = $matches[2];
            $this->uri = $uri_or_key;

        }
    }


    /*
     * Getters
     */
    public function get_uri() {
        return $this->uri;
    }


    /***
     * Adds a connection to the current user
     *
     * @param {String} connection_name the connection identifier. Unique per connection
     * @param {String} service_scheme a string representing a connector service (service scheme)
     * @param {String} service_access_token service access token acquired from the provider (fb token, twitter token..etc)
     *
     * @return {UEConnection} connection the created connection
     */
    public function add_connection($connection_name, $service_scheme, $service_access_token, $optional_params='') {
        $uri = "${service_scheme}://${service_access_token}@${service_scheme}.com";

		if ($optional_params) {
			$params = '';
			foreach ($optional_params as $key => $value) {

				$params = $params . $key . '=' . $optional_params[$key] . '&';
			}
			
			$params = rtrim($params, "&");

			$uri = $uri . '/?' . $params;
		}

        $options = array(
            "auth" => array($this->user_key, $this->user_secret),
            "body" => array(
                "uri" =>  $uri,
                "name" =>  $connection_name
            )
        );

        $response = UERequest::fetch("connection/add", $options);
        if($response->status == 200)
            return new UEConnection($connection_name,$uri,$this);
        $error_msg = $response->info;
        throw new \Exception($error_msg);
    }

    /**
     * List connections for current user
     * @return {Connection>} List of Connection objects representing the user connections
     */
    public function list_connections() {
        $options = array(
            "auth" => array($this->user_key, $this->user_secret)
        );

        $response =  UERequest::fetch("connection/list", $options);
        $connections = $response->connections;
        $connection_objects = array();
        foreach($connections as $key => $value) {

            $connection = new UEConnection($key,$value->uri,$this);
            array_push($connection_objects, $connection);
        }
        return $connection_objects;
    }



    /*
     * Removes a connection from a user
     *
     * @param {String} connection_name the connection identifier
     * @return {Boolean} Success/Fail
     */
    public function remove_connection($connection_name) {

        $options = array(
            "auth" => array($this->user_key,$this->user_secret),
            "body" => array(
                "name" => $connection_name
            )
        );

        $response = UERequest::fetch("connection/remove", $options);

        return ($response->status == 200);


    }


    /*
     * Tests a connection to a connector
     *
     * @param {String} serviceUri service uri. eg: facebook://accesstoken@facebook.com
     * @return {Boolean} Success/Fail
     */
    public function test_connection($service_uri) {
        $options = array(
            "auth" => array($this->user_key,$this->user_secret),
            "body" => array(
                "uri" => $service_uri 
            )
        );

        $response = UERequest::fetch("connection/test", $options);

        return ($response->Status->_empty_->status == 200);



    }





}
