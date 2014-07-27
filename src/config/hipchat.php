<?php

return array(
    /*
    |--------------------------------------------------------------------------
    | HipChat API Token
    |--------------------------------------------------------------------------
    |
    | Required API Token from HipChat
    |
    */
    'api_token' => 'insert_your_api_token',


    /*
    |--------------------------------------------------------------------------
    | HipChat API App Name
    |--------------------------------------------------------------------------
    |
    | Choose a name you want to be displayed on HipChat
    |
    */
    'app_name' => 'Your App Name',


    /*
    |--------------------------------------------------------------------------
    | HipChat Default Room
    |--------------------------------------------------------------------------
    |
    | If Not specified, you will have to always use
    | HipChat::setRoom('roomName');
    | when a room name is required
    |
    */
    'default_room' => null, // this is optional
);