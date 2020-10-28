<?php
require_once '/var/www/ExpenseTracker/configuration/config.php';

class DB {
    private $conn;

    protected function connect() {
        global $config;
        $hn = $config['hostname'];
        $un = $config['username'];
        $pw = $config['password'];
        $db = $config['database'];

        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die("Fatal Error");
        return $conn;
    }

}