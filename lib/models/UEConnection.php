<?php
Class UEConnection {


    /**
     * @param {String}  connection_name the connection identifier
     * @param {String} connection_uri the connection uri
     * @param {UEUser} User the User instance of the user owning the connection
     */
    public __construct($connection_name, $connection_uri, $user) {
    }


    public function refresh_connection()  {
    }

    /**
     * Used for message parts
     * @access private
     * @returns {Number} random id
     */
    public function self.generate_unique_id() {
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
     * @returns {Boolean}
     */
    public function build_message_query($message_options) {
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
     * @param {Array} message_options.message.image image uri
     * @param {Array} message_options.message.link message link
     * @param {Array} message_options.message.link.uri message link uri
     * @param {Array} message_options.message.link.description  message link description
     * @param {Array} message_options.message.link.title  message link title
     *
     * @returns {Promise}
     */
    public function send_message($message_options) {
    }
}
