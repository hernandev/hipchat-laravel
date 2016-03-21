<?php

namespace Hernandev\HipchatLaravel;

use Hernandev\HipchatLaravel\Exception\NoApiTokenException;
use Hernandev\HipchatLaravel\Exception\NoAppNameException;
use Hernandev\HipchatLaravel\Exception\RoomNotDefinedException;
use Hernandev\HipchatLaravel\Exception\UserNotDefinedException;
use HipChat\HipChat as HipChatClient;

class HipChat
{
    /**
     * @var HipChatClient
     */
    protected $hipchat;

    /**
     * @var string
     */
    protected $server = null;

    /**
     * @var string
     */
    protected $api_token;

    /**
     * @var string
     */
    protected $app_name;

    /**
     * @var string|null
     */
    protected $room = null;

    /**
     * @var string|null
     */
    protected $user = null;

    /**
     * HipChat constructor.
     */
    public function __construct()
    {
        $this->api_token = config('hipchat-laravel::hipchat.api_token', null);
        $this->app_name = config('hipchat-laravel::hipchat.app_name', null);
        $this->room = config('hipchat-laravel::hipchat.default_room', null);
        $this->server = config('hipchat-laravel::hipchat.server', null);

        if ($this->server) {
            $this->hipchat = new HipChatClient($this->api_token, $this->server);
        } else {
            $this->hipchat = new HipChatClient($this->api_token);
        }
    }

    protected function verify()
    {
        if (!$this->api_token) {
            throw new NoApiTokenException();
        }

        if (!$this->app_name) {
            throw new NoAppNameException();
        }
    }

    protected function checkRoom()
    {
        $this->verify();
        if (!$this->room) {
            throw new RoomNotDefinedException();
        }
    }

    protected function checkUser()
    {
        $this->verify();
        if (!$this->user) {
            throw new UserNotDefinedException();
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
        $this->hipchat->message_room($this->room, $this->app_name, $message, $notify, $color, 'html');
    }

    public function getRoom()
    {
        $this->checkRoom();

        return $this->hipchat->get_room($this->room);
    }

    public function roomExists()
    {
        $this->checkRoom();

        return $this->hipchat->room_exists($this->room);
    }

    public function getRooms()
    {
        $this->verify();

        return $this->hipchat->get_rooms();
    }

    public function getRoomsHistory($date = 'recent')
    {
        $this->checkRoom();

        return $this->hipchat->get_rooms_history($this->room, $date);
    }

    public function setRoomTopic($topic, $from = null)
    {
        $this->checkRoom();

        return $this->hipchat->set_room_topic($this->room, $topic, $from);
    }

    public function createRoom($name, $privacy = null, $topic = null, $guest_access = null)
    {
        $this->checkUser();

        return $this->hipchat->create_room($name, $this->user, $privacy, $topic, $guest_access);
    }

    public function deleteRoom()
    {
        $this->checkRoom();

        return $this->hipchat->delete_room($this->room);
    }

    public function getUser()
    {
        $this->checkUser();

        return $this->hipchat->get_user($this->user);
    }

    public function getUsers()
    {
        $this->verify();

        return $this->hipchat->get_users();
    }

    public function createUser($email, $name, $mention_name = null,
                                $title = null, $is_group_admin = 0,
                                $password = null, $timezone = null)
    {
        $this->verify();

        return $this->hipchat->create_user($email, $name, $mention_name, $title, $is_group_admin, $password, $timezone);
    }

    public function updateUser($email = null, $name = null,
                                $mention_name = null, $title = null,
                                $is_group_admin = 0, $password = null,
                                $timezone = null)
    {
        $this->checkUser();

        return $this->hipchat->update_user($this->user, $email, $name, $mention_name, $title, $is_group_admin, $password, $timezone);
    }

    public function deleteUser()
    {
        $this->checkUser();

        return $this->hipchat->delete_user($this->user);
    }

    public function undeleteUser()
    {
        $this->checkUser();

        return $this->hipchat->undelete_user($this->user);
    }
}
