<?php

require_once '/var/www/ExpenseTracker/service/category.php';

class CategoryController{

    public static function createCategory($category){
        $message = CategoryService::createCategory($category);
        return $message;
    }

    public static function listCategory($category){
        $message = CategoryService::listCategory($category);
        return $message;
    }


    public static function editCategory($category){
        $message = CategoryService::editCategory($category);
        return $message;
    }

    public static function deleteCategory($category){
        $message = CategoryService::deleteCategory($category);
        return $message;
    }
}

