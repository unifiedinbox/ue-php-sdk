<?php
Class UEConnection {


    /**
     * @param {String}  connection_name the connection identifier
     * @param {String} connection_uri the connection uri
     * @param {UEUser} User the User instance of the user owning the connection
     */
    public function  __construct($connection_name, $connection_uri, $user) {
        $this->name = $connection_name;
        $this->uri = $connection_uri;
        $this->user = $user;

    }


    public function refresh_connection()  {
    }

    /**
     * Used for message parts. Wrapper in this function for easier tweaking later
     * @access private
     * @returns {Number} random id
     */
    private function generate_unique_id() {
        return uniqid();
    }


    private function array_to_object($array) {
        $obj = new stdClass;
        foreach($array as $k => $v) {
            if(strlen($k)) {
                if(is_array($v)) {
                    $obj->{$k} = $this->array_to_object($v); //RECURSION
                } else {
                    $obj->{$k} = $v;
                }
            }
        }
        return $obj;
    } 
    /**
     * Builds the API message parameter from passed options
     *
     * @access private
     * @param {Object} message_options options for message
     * @param {Array} message_options.receivers channels receiving the message
     * @param {String} message_options.receivers.name channel name (Me | Page)
     * @param {String} message_options.receivers.id in case of Page, this is the page id
     * @param {String} message_options.message.subject message subject
     * @param {Array} message_options.message.body message body
     * @param {Array} message_options.message.image image uri
     * @param {Array} message_options.message.link message link
     * @param {Array} message_options.message.link.uri message link uri
     * @param {Array} message_options.message.link.description  message link description
     * @param {Array} message_options.message.link.title  message link title
     * @returns {Object} message params object
     */
    private function build_message_query($message_options) {
        if(!$message_options["receivers"] || !$message_options["message"])
            throw new Exception("Message must have a message and areceiver");

        $default_content_type = "binary";
        $params = $message_options; //Clone for immutability
        $queryObject = array();
        $queryObject["receivers"] = array();

        //Formulate Receivers
        for($i=0; $i< count($params["receivers"]); $i++) {
            $receiver = $params["receivers"][$i];

            $receiver["Connector"] = $this->name;
            $receiver["address"] = ($receiver["name"] == "page")? $receiver["id"]: "";
            array_push($queryObject["receivers"], $receiver);
        }

        //Formulate Message Parts
        $queryObject["parts"] = array();

        if($params["message"]["body"]){
            array_push($queryObject["parts"] , array(
                "id"=> $this->generate_unique_id(),
                "contentType"=> $default_content_type,
                "type"=> "body",
                "data"=> $params["message"]["body"],
            ));
        };

        //Image Part
        if($params["message"]["image"]){
            array_push($queryObject["parts"],array(
                "id"=> $this->generate_unique_id(),
                "contentType"=> $default_content_type,
                "type"=> "image_link",
                "data"=> $params["message"]["image"]
            ));
        }


        //Link Part
        if($params["message"]["link"]) {
            if($params["message"]["link"]["uri"]){
                array_push($queryObject["parts"], array(
                    "id"=> $this->generate_unique_id(),
                    "contentType"=> $default_content_type,
                    "type"=> "link",
                    "data"=> $params["message"]["link"]["uri"]

                ));
            }

            if($params["message"]["link"]["description"]){
                array_push($queryObject["parts"],array(
                    "id"=> $this->generate_unique_id(),
                    "contentType"=> $default_content_type,
                    "type"=> "link_description",
                    "data"=> $params["message"]["link"]["description"]
                ));
            }

            if($params["message"]["link"]["title"]){
                array_push($queryObject["parts"],array(
                    "id"=> $this->generate_unique_id(),
                    "contentType"=> $default_content_type,
                    "type"=> "link_title",
                    "data"=> $params["message"]["link"]["title"]
                ));
            }

        }

        //Subject
        if($params["message"]["subject"]) {
            $queryObject["subject"] = $params["message"]["subject"];
        }


        return $queryObject;


    }



    /**
     * Sends a message to service using a connector. A message can have multiple parts each with a different type.
     * eg: One can send a message with 2 parts (image_link, body) to send a message with an image and text
     *
     * @param {Object} message_options options for message
     * @param {Array} message_options.receivers channels receiving the message
     * @param {String} message_options.receivers.name channel name (Me | Page)
     * @param {String} message_options.receivers.id in case of Page, this is the page id
     * @param {String} message_options.message.subject message subject
     * @param {Array} message_options.message.body message body
     * @param {Array} message_options.messag+e.image image uri
     * @param {Array} message_options.message.link message link
     * @param {Array} message_options.message.link.uri message link uri
     * @param {Array} message_options.message.link.description  message link description
     * @param {Array} message_options.message.link.title  message link title
     *
     * @returns {Promise}
     */
    public function send_message($message_options) {
        $options = array(
            "auth" => array($this->user->user_key,$this->user->user_secret),
            "body" => array(
                "message" => $this->build_message_query($message_options)
            )
        );
        $response = UERequest::fetch("message/send", $options);
        return $response->URIs;

    }
}
