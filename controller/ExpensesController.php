
<?php
require_once '/var/www/ExpenseTracker/service/Expenses.php';
class ExpensesController extends ExpensesService{

    public static function createExpense($expense){
        $message = ExpensesService::createExpense($expense);
        return $message;
    }

    public static function listExpenses($expense){
        $message = ExpensesService::listExpenses($expense);
        return $message;
    }

    public static function deleteExpense($expense){
        $message = ExpensesService::deleteExpense($expense);
        return $message;
    }
    public static function editExpense($expense){
        $message = ExpensesService::editExpense($expense);
        return $message;
    }

    public static function getCategoryGrouped($expense){
        $message = ExpensesService::getCategoryGrouped($expense);
        return $message;
    }
}
