# ue-php-sdk 
> A UnificationEngine client SDK for PHP

## Installation Using Composer/Packagist

```sh
$ composer require unificationengine/ue-php-sdk
```

## Usage

```php
use UnificationEngine\Models\UEApp;
$app = new UEApp("APP_KEY","APP_SECRET");
```

#### Creating User
```php
use UnificationEngine\Models\UEApp;
use UnificationEngine\Models\UEUser;
//Creating a new user
$user = $app.create_user();

//Using existing user using key and secret
$user = new UEUser("USER_KEY","USER_SECRET");

//Using existing user using it's uri
$user = new UEUser("user://USER_KEY:USER_SECRET@");


```

#### Listing Users
```php
$users = $app.list_users();
```
note: listed users does not have the user_secret listed for security reasons. So, you cant use a user from the list unless you have saved it's key somewhere

#### Deleting User
```php
$user = $app.create_user();
$app.delete_user($user) //true
```

#### Adding a connection to a user
```php
$connection = $user.add_connection("myconnectionname", "facebook", "facebook_access_token");
//connection is an instance of UEConnection
```

- `connection_name` must be unique per connection.
- `access_token` has to be valid and working from the provider side


#### Listing User connections
```php
$connections = $user.list_connections()
// connections is an array of UEConnection objects
```
#### Removing a User Connection
```php
$user.remove_connection($connection_name) //true | false
```

#### Testing a connection
```php
//return true if working, false otherwise
$user.test_connection($service_url) //eg: facebook://accesstoken@facebook.com
```

### Sending a message using a connection
```php


$app  = new UEApp("APP_KEY","APP_SECRET");

//Create a new user
$user = $app->create_user();


//Or use an existing user
$user = new UEUser("USER_KEY","USER_SECRET");


//Add a connection. (throws an error if the connection is not added)
$connection = $user->add_connection("FB","facebook","FACEBOOK_ACCESS_TOKEN");
//                                    |       |
// Connection Name  ------------------+       |
// Connector Scheme  -------------------------+



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

print_r($uris);
