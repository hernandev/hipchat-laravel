<?php namespace HeRnandEs\HipchatLaravel;

use HeRnandEs\HipchatLaravel\Exception\NoApiTokenException;
use HeRnandEs\HipchatLaravel\Exception\NoAppNameException;
use HeRnandEs\HipchatLaravel\Exception\RoomNotDefinedException;
use HeRnandEs\HipchatLaravel\Exception\UserNotDefinedException;
use Config;
use HipChat\HipChat as HipChatOriginal;

class HipChat
{
    protected $hc;

    protected $api_token;

    protected $app_name;

    protected $room = null;

    protected $user = null;



    public function __construct()
    {
        if (Config::has('hipchat-laravel::hipchat.api_token')) {
            $this->api_token = Config::get('hipchat-laravel::hipchat.api_token');
        }

        if ($this->api_token) {
            $this->hc = new HipChatOriginal($this->api_token);
        }

        if (Config::has('hipchat-laravel::hipchat.app_name')) {
            $this->app_name = Config::get('hipchat-laravel::hipchat.app_name');

        }

        if (Config::has('hipchat-laravel::hipchat.default_room')) {
            $this->room = Config::get('hipchat-laravel::hipchat.default_room');
        }
    }


    protected function verify()
    {
        if (!$this->api_token) {
            throw new NoApiTokenException;
        }

        if (!$this->app_name) {
            throw new NoAppNameException;
        }
    }

    protected function checkRoom()
    {
        $this->verify();
        if (!$this->room) {
            throw new RoomNotDefinedException;
        }
    }

    protected function checkUser()
    {
        $this->verify();
        if (!$this->user) {
            throw new UserNotDefinedException;
        }
    }

    public function setRoom($room_id)
    {
        $this->room = $room_id;
        $this->verify();
    }

    public function returnRoom()
    {
        return $this->room;
    }

    public function setUser($user_id)
    {
        $this->verify();
        $this->user = $user_id;
    }


    public function sendMessage($message, $color = 'gray', $notify = false)
    {
        $this->checkRoom();
        $this->hc->message_room($this->room, $this->app_name, $message, $notify, $color, 'html');
    }

    public function get_room()
    {
        $this->checkRoom();
        return $this->hc->get_room($this->room);
    }

    public function room_exists()
    {
        $this->checkRoom();
        return $this->hc->room_exists($this->room);
    }

    public function get_rooms()
    {
        $this->verify();
        return $this->hc->get_rooms();
    }

    public function get_rooms_history($date = 'recent')
    {
        $this->checkRoom();
        return $this->hc->get_rooms_history($this->room, $date);
    }

    public function set_room_topic($topic, $from = null)
    {
        $this->checkRoom();
        return $this->hc->set_room_topic($this->room, $topic, $from);
    }

    public function create_room($name, $privacy = null, $topic = null, $guest_access = null)
    {
        $this->checkUser();
        return $this->hc->create_room($name, $this->user, $privacy, $topic, $guest_access);
    }

    public function delete_room()
    {
        $this->checkRoom();
        return $this->hc->delete_room($this->room);
    }

    public function get_user()
    {
        $this->checkUser();
        return $this->hc->get_user($this->user);
    }

    public function get_users()
    {
        $this->verify();
        return $this->hc->get_users();
    }

    public function create_user($email, $name, $mention_name = null,
                                $title = null, $is_group_admin = 0,
                                $password = null, $timezone = null)
    {
        $this->verify();
        return $this->hc->create_user($email, $name, $mention_name, $title, $is_group_admin, $password, $timezone);
    }

    public function update_user($email = null, $name = null,
                                $mention_name = null, $title = null,
                                $is_group_admin = 0, $password = null,
                                $timezone = null)
    {
        $this->checkUser();
        return $this->hc->update_user($this->user, $email, $name, $mention_name, $title, $is_group_admin, $password, $timezone);
    }

    public function delete_user()
    {
        $this->checkUser();
        return $this->hc->delete_user($this->user);
    }

    public function undelete_user()
    {
        $this->checkUser();
        return $this->hc->undelete_user($this->user);
    }



} 