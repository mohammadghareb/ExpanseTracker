<?php

class Users
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;

    public function __construct($id = null, $first_name = null, $last_name = null, $email, $password = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;}
}

class Expenses
{
    public $id;
    public $users_id;
    public $category;
    public $amount;
    public $buyingdate;

    public function __construct($id = null, $users_id = null, $category = null, $amount = null, $buyingdate = null)
    {
        $this->id = $id;
        $this->users_id = $users_id;
        $this->category = $category;
        $this->amount = $amount;
        $this->buyingdate = $buyingdate;}
}

class Category
{
    public $id;
    public $users_id;
    public $category;
    public function __construct($id = null, $users_id=null, $category = null)
    {
        $this->id = $id;
        $this->users_id = $users_id;
        $this->category = $category;
    }
}
