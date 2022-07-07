<?php
class Dbh{

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

        // $this->DB_USERNAME = 'id19139193_aboalaa';
        // $this->DB_NAME = 'id19139193_mahmoudalaa_products';
        // $this->DB_PASSWORD = "N+(WO(XNgW_5DVLI";
        // $this->DB_HOST = "localhost";

        $connect = new mysqli($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);

        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }

        return $connect;
    }

    public function deleteDataFromTable($sku, $tableName)
    {
        $con = mysqli_connect("localhost", "root", "", "example");

        if ($this->connection()->connect_error) {
            echo "Failed to connect to MySQL: " .$this->connection()->connect_error;
        } else {
            $query = "DELETE FROM {$tableName} WHERE sku = '$sku' ";
            $result = $this->connection()->query($con, $query);
            return $result;
        }
    }
}

interface Differenciate{
    public function differences();
}

?>