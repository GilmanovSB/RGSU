<?php

class Autoloader {
    public $fileExeption = '.php';

    public function getFile($classname){
        $classname = str_replace('app\\', ROOT_DIR, $classname);
        $path = realpath($classname . $this->fileExeption);
        if(file_exists($path)){
            require $path ;
            return true;
        }
        return false;
    }

}
?>