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
        return UERequest::fetch("user/create",$options);
    }

    /**
     * Deletes a UE User
     *
     * @param {UEUser} user the user to delete
     * @return {Boolean} success/fail
     */
    public function delete_user( $user )  {
    }

    /**
     * Returns a list of users for the current app
     *
     * @return {String[]} array of user uri without password
     */
    public function list_users()  {
    }


}
