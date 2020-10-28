<?php
session_start();
require_once '/var/www/ExpenseTracker/controller/UsersController.php';
require_once '/var/www/ExpenseTracker/service/models.php';
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
switch ($request) {
    case '/':
        require_once __DIR__ . '/login.php';
        break;
        case '/home':
        require_once __DIR__ . '/home.php';
        break;}

if ($method == 'POST') {
    if ($_POST['section'] == "register") {
        if($_POST['password']!=$_POST['password1']){
            $_SESSION['didRegister']='failed';
            header('Location: login.php');
            exit;
        }
        $firstname = check_input($_POST['firstname']);
        $lastname = check_input($_POST['lastname']);
        $email = check_input($_POST['email']);
        $password = check_input($_POST['password']);
        $user = new Users(null, $firstname, $lastname, $email, $password);
        UsersController::createUser($user);
        header('Location: login.php');
    }

    if ($_POST['section'] == "login") {
        $email = check_input($_POST['email']);
        $password = check_input($_POST['password']);
        $user = new Users(null, null, null, $email, $password);
        UsersController::check($user);

    }
    if ($_POST['section'] == "logout") {
        session_destroy();
        header('Location: login.php');

    }

}

