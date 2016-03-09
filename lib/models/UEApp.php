<?php
Class UEApp {

    /**
     * Constructor
     * @param {String} app_key
     * @param {String} app_secret
     */
    public function  __construct($api_key, $api_secret) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }



    /**
     * Creates a UE User
     *
     * @return {UEUser} user the created user
     */
    public function create_user() {
        $options = array(
            "auth" =>  array($this->api_key,$this->api_secret),
        );
        $response =  UERequest::fetch("user/create",$options);
        print_r($response);
        return new UEUser($response->uri);
    }

    /**
     * Deletes a UE User
     *
     * @param {UEUser} user the user to delete
     * @return {Boolean} success/fail
     */
    public function delete_user( $user )  {
        $options = array(
            "auth" =>  array($this->api_key,$this->api_secret),
            "body" => array(
                "uri" => $user->get_uri()
            )
        );
        return UERequest::fetch("user/delete",$options);

    }

    /**
     * Returns a list of users for the current app
     *
     * @return {String[]} array of user uri without password
     */
    public function list_users()  {
        $options = array(
            "auth" =>  array($this->api_key,$this->api_secret),
        );
        $response =  UERequest::fetch("user/list",$options);
        return array_map(function ($user){
            return $user->uri;
        },$response->users);


    }


}
