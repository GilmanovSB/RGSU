<?php
session_start();
require '../config/main.php';
require SERVICES_DIR . 'Autoloader.php';

spl_autoload_register([new Autoloader(), getFile]);


use app\services\Autorization;

if(!isset($_SESSION['user'])){
    if(!empty($_POST)){
        (new Autorization($_POST['login'],$_POST['password']))->verifyUser();
    }
    require ROOT_DIR . 'login.php';
}else{
    require ROOT_DIR . 'import.php';
    }



?>




