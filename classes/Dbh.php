<?php

interface Differenciate
{
    public function differences();
}

class Dbh
{

    private $DB_NAME;
    private $DB_USERNAME;
    private $DB_PASSWORD;
    private $DB_HOST;

    protected function connection()
    {
        $this->DB_USERNAME = 'mahmoud';
        $this->DB_NAME = 'products';
        $this->DB_PASSWORD = "#1q2w3e4r5t#";
        $this->DB_HOST = 'localhost';

        $connect = new mysqli($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);

        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }

        return $connect;
    }
}