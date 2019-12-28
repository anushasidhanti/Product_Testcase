<?php

class DatabaseAccessHandler {


    private $dbServerName = 'localhost';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $dbName = 'saitow_testcase';    

    public function __construct() {
        $this->dbServerName = 'localhost';
        $this->dbUsername = 'root';
        $this->dbPassword = '';
        $this->dbName = 'saitow_testcase';
    }

    public function connect() {

        $conn = new mysqli($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName);
        return $conn;

    }

    public function f1() {

        echo 'DatabaseAccessHandler echoing';
    }
}