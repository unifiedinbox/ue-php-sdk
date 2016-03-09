<?php
Class UEUser {


    /*URI: user://e9759590-54ef-4cd3-a01c-cb2241ddd812:1aee1a25-e0c4-4036-a8fd-4d41adc8611b@
     *COMB: key,secret
     ** Constructor
     * @desc The constructor can be in one of two forms; URI form or key,secret form. eg new User(key,secret) or new User(uri)
     * @param {String} uri the user uri string
     * @param {String} key the user key
     * @param {String} secret the user secret
     */
    public function __construct($uri_or_key, $secret){
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
    public function add_connection($connection_name, $service_scheme, $service_access_token) {
    }

    /**
     * List connections for current user
     * @return {Connection>} List of Connection objects representing the user connections
     */
    public function list_connections() {
    }



    /*
     * Removes a connection from a user
     *
     * @param {String} connection_name the connection identifier
     * @return {Boolean} Success/Fail
     */
    public function remove_connection($connection_name) {
    }


    /*
     * Tests a connection to a connector
     *
     * @param {String} serviceUri service uri. eg: facebook://accesstoken@facebook.com
     * @return {Boolean} Success/Fail
     */
    public function test_connection($service_uri) {
    }





}
