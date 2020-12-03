<?php

namespace app\traits;

trait Singleton {
    protected function __construct(){}
    protected function __clone(){}
    protected function __wakeup(){}

    static $instance = null;

    static function getInstanse(){
        if(is_null(static::$instance)){
            static::$instance = new static();
        }
        return static::$instance;
    }

}