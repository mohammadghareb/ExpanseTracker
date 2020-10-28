<?php
session_start();

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
require_once '/var/www/ExpenseTracker/controller/ExpensesController.php';
require_once '/var/www/ExpenseTracker/controller/CategoryController.php';
require_once '/var/www/ExpenseTracker/service/models.php';
header("Content-Type: application/json; charset=UTF-8");
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){
// if($_POST['section']=='logout'){
//     session_destroy();
//     header('Location: login.php');
    
// }
if($_POST['section']=='listexpenses'){
    
    $expense = new Expenses(null, $_SESSION['id']);
    $message = ExpensesController::listExpenses($expense);
    if(!$message){
        echo json_encode(['data'=>[]]);
    }
    
    else{
        
        echo json_encode(['data'=>$message]);}
    
}
if($_POST['section']=='addexpense'){
    $expense = new Expenses(null, $_SESSION['id'], check_input($_POST['category']), check_input($_POST['amount']), check_input($_POST['buyingdate']));
    $message = ExpensesController::createExpense($expense);
    echo json_encode(['data'=>$message]);
}

if($_POST['section']=='categorylist'){
    $category = new Category(null, $_SESSION['id']);
    $message = CategoryController::listCategory($category);
    if(!$message){
        echo json_encode(['data'=>'no data']);
    }
    else{
    echo json_encode($message);}
}


if($_POST['section']=='categorygroup'){
    $expense = new Expenses(null,$_SESSION['id'] );
    $message = ExpensesController::getCategoryGrouped($expense);
    if(!$message){
        echo json_encode(['data'=>'']);
    }
    else{
    echo json_encode($message);}
}

if($_POST['section']=='editexpense'){
    $expense = new Expenses(check_input($_POST['id']), $_SESSION['id'], check_input($_POST['category']), check_input($_POST['amount']), check_input($_POST['buyingdate']));
    $message = ExpensesController::editExpense($expense);
    echo json_encode(['data'=>$message]);
}

if($_POST['section']=='addcategory'){
    $category = new Category(null,$_SESSION['id'], check_input($_POST['category']));
    $message = CategoryController::createCategory($category);
    echo json_encode(['data'=>$message]);
}


if($_POST['section']=='deleteexpense'){
    $expense = new Expenses(check_input($_POST['id']), $_SESSION['id']);
    $message = ExpensesController::deleteExpense($expense);
    echo json_encode(['data'=>$message]);
}
}