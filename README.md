## hernandev/hipchat-laravel

[![Latest Stable Version](https://poser.pugx.org/hernandev/hipchat-laravel/version.svg)](https://packagist.org/packages/hernandev/hipchat-laravel)
[![Total Downloads](https://poser.pugx.org/hernandev/hipchat-laravel/downloads.svg)](https://packagist.org/packages/hernandev/hipchat-laravel)
[![License](https://poser.pugx.org/hernandev/hipchat-laravel/license.svg)](https://packagist.org/packages/hernandev/hipchat-laravel)



This a [HipChat PHP Client](https://github.com/hipchat/hipchat-php) wrapper for Laravel 4 and 5


### Installation

- Include `"hernandev/hipchat-laravel"` inside the `"require"` section of `composer.json` file:

    ```php
        ...
        "require": {
            ...,
            "hernandev/hipchat-laravel": "~2.0"
        }
        ...
    
    ```

- Update composer dependencies by running:

    
    ```
    composer update
    ```

- Insert `'Hernandev\HipchatLaravel\HipchatLaravelServiceProvider',` in your `'providers'` array, inside `app/config/app.php`:

    ```php
    ...
    'providers' => [
        ...
        Hernandev\HipchatLaravel\HipchatLaravelServiceProvider::class,
    ],
    ```
    
    
- Insert `'HipChat' => Hernandev\HipchatLaravel\Facade\HipChat:class,` in your `'aliases'` array, inside `app/config/app.php`:

    ```php
    ...
    'aliases' => [
        ...
        'HipChat'         => Hernandev\HipchatLaravel\Facade\HipChat::class,
    ],
    ```
    
    
- To Publish the configuration files you will need, run:

    ```
    php artisan vendor:publish --tag=laravel
    ```

- Edit `app/config/hipchat.php` file updating it your credentials / configurations:

    ```php
    'api_token' => 'insert_your_api_token',
    'app_name' => 'Your App Name',
    'default_room' => null, // this is optional
    
    ```
    
    


### Usage

**Note**: when 'default_room' is set on config file, there is not need to call ::setRoom('room_name'), use it only if want to work with a room that is not the default one.

- Notify in a Room

    ```php
    HipChat::setRoom('RoomName');
    HipChat::sendMessage('My Message');
    
    // you have two optional parameters, `color` and `notify`
    // the 'red' will set the message color, and the third parameter when `true` notify all users on the room
    
    HipChat::sendMessage('My Message', 'red', true);
    
    
    
    ```
    
- Get a Room Details

    ```php
    HipChat::setRoom('RoomName');
    HipChat::getRoom(); // StdObject
    ```
    
- Verify is a room exists

    ```php
    HipChat::setRoom('RoomName');
    HipChat::roomExists(); // boolean
    ```
    
    
- Get Rooms List

    ```php
    HipChat::getRooms(); // json
    ```
    
    
- Retrieve Message History for a Room

    ```php
    HipChat::setRoom('RoomName');
    return HipChat::getRoomsHistory(); // json
    ```
    
    
- Change Room Topic

    ```php
    HipChat::setRoom('RoomName');
    return HipChat::setRoomTopic('New Topic via API'); // boolean
    ```
    
    
- Get a List of Users

    ```php
    HipChat::getUsers(); // json
    ```
    
- Get an User details

    ```php
    HipChat::setUser('me@me.com'); // you can use id, email or @mention_name
    HipChat::getUser(); // StdObject
    ```
    
- Create an Room

    ```php
    HipChat::setUser('me@me.com'); // you can use id, email or @mention_name
    // see optional fields on code
    HipChat::createRoom('New Room Name'); // boolean
    ```
    
- Get a List of Users

    ```php
    HipChat::getUsers(); // json
    ```
    

- Delete a room

    ```php
    HipChat::setRoom('RoomName');
    HipChat::deleteRoom(); // boolean
    ```

- Create User

    ```php
    // email, first_name last_name, mention_name, title
    HipChat::createUser('me2@me2.com', 'First Last', 'mention', 'title'); // boolean
    ```
    
- Update User Info

    ```php 
     // you can use email, mention name or user_id
    HipChat::setUser('me@me.com');
    
    // same signature as create_user method, pass null the fields you dont want to update
    HipChat::updateUser(null, 'NewFirst New Last'); // boolean
    
    ```


    