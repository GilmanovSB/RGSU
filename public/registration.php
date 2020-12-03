<?php
require '../config/main.php';
require SERVICES_DIR . 'Autoloader.php';

spl_autoload_register([new Autoloader(), getFile]);

use app\services\Autorization;

$user = $_POST;

if(!empty($user)){
    if(strlen($user['login']) < 5 && strlen($user['password']) < 5){
        echo "Минимальная длина логина и пороля должна быть 5 символов";
    }else {
    if($user['password'] == $user['pasword_chek']){
        $user = (new Autorization($user['login'], $user['password']))->insert();
        if(!$user){
            exit('Пользователь с таким именем существует');
        }
        header('Location: index.php');
    } else {
        echo 'Пароли не совподают'; 
        
    }}
}

?>

<form action="" method="post">
<input type="text" placeholder="login" name='login'>
<input type="password" placeholder="пароль" name='password'>
<input type="password" placeholder="повторите пароль" name="pasword_chek" >
<input type="submit" value="Зарегистрироваться">
</form>