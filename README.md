# ue-php-sdk 
> A UnificationEngine client SDK for Ruby/Rails

## Installation

```sh
$ gem install ue-php-sdk
```

## Usage

```php
app = UEApp.new("APP_KEY","APP_SECRET");
```

#### Creating User
```php
#Creating a new user
user = app.create_user

#Using existing user using key and secret
user = UEUser.new "USER_KEY","USER_SECRET"

#Using existing user using it's uri
user = UEUser.new "user://USER_KEY:USER_SECRET@"


```

#### Listing Users
```php
users = app.list_users
#users is an array of User objects
```

#### Deleting User
```php
user = app.create_user
app.delete_user(user) #true
```

#### Adding a connection to a user
```php
connection = user.add_connection "myconnectionname", "facebook", "facebook_access_token"
#connection is an instance of UEConnection
```

- `connection_name` must be unique per connection.
- `access_token` has to be valid and working from the provider side


#### Listing User connections
```php
connections = user.list_connections
# connections is an array of UEConnection objects
```
#### Removing a User Connection
```php
user.remove_connection(connection_name) #true | false
```

#### Testing a connection
```php
#return true if working, false otherwise
user.test_connection(service_url) #eg: facebook://accesstoken@facebook.com
```

### Sending a message using a connection
```php
require 'ue-php-sdk'

app = UEApp.new("UE_APP_ID","UE_APP_SECRET")

options = {
    receivers:[
        {
            name:"Page",
            id:"283031198486599"
        },
        {
            name: "Me"
        }
    ],
    message:{
        subject:"test",
        body: "ABC",
        image:"http://politibits.blogs.tuscaloosanews.com/files/2010/07/sanford_big_dummy_navy_shirt.jpg",
        link:{
            uri: "http://google.com",
            description: "link desc",
            title:"link title"
        }
    }
}



#Create a new user
user = app.create_user


facebook_connection = user.add_connection "fb", "facebook","FACEBOOK_ACCESS_TOKEN"
#                                          |         |
# Connection Name  ------------------------+         |
# Connector Scheme  ---------------------------------+




facebook_connection.send_message options


```
``````` ````````````
