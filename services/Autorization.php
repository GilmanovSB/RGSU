<?php

namespace app\services;

use app\engine\Record;

class Autorization extends Record{

    public $login;
    public $password;

    public function __construct($login = null, $password = null)
    {
        parent::__construct();
        $this->login = $login;
        $this->password = $password;
    }

    public function verifyUser(){
        $hash = $this->getOne(['login' => $this->login]);
        if(password_verify($this->password, $hash->password)){
            header("Refresh: 0");
            return $_SESSION['user'] = ['login' => $this->login, 'password' => $hash->password];
        } else {
            echo 'Не верный логин или пароль';
        }
    }

    public function getTable()
    {
        return 'user';
    }

    public function getData()
    {
        $data['login'] = $this->login;
        $data['password'] =  password_hash($this->password, PASSWORD_DEFAULT);
        return $data;
    }

}


