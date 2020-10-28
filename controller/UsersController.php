<?php
require_once '/var/www/ExpenseTracker/service/Users.php';
class UsersController extends UsersService{
    public static function createUser($user){
        $message = parent::createUser($user);
        $_SESSION['didRegister']=$message;
        header('Location: login.php');
        
    }
    public static function check($user){
        $message = parent::check($user);
        if($message=='Wrong'){
            $_SESSION['wrong']='wrong';
            header('Location: login.php');
        }
        else{
        $message = parent::check($user);
        $_SESSION['id']=$message->id;
        $_SESSION['firstname']=$message->first_name;
        $_SESSION['lastname']=$message->last_name;
        $_SESSION['email']=$message->email;
        header('Location: home.php');}
        
    }
}