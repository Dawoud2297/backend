<?php
class Dbh{

    private $DB_NAME;
    private $DB_USERNAME;
    private $DB_PASSWORD;
    private $DB_HOST;

    protected function connection()
    {
        // $this->DB_USERNAME = 'mahmoud';
        // $this->DB_NAME = 'products';
        // $this->DB_PASSWORD = "#1q2w3e4r5t#";
        // $this->DB_HOST = 'localhost';

        // $this->DB_USERNAME = 'id19139193_aboalaa';
        // $this->DB_NAME = 'id19139193_mahmoudalaa_products';
        // $this->DB_PASSWORD = "N+(WO(XNgW_5DVLI";
        // $this->DB_HOST = "localhost";


        //Get Heroku ClearDB connection information
        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db = substr($cleardb_url["path"],1);
        $active_group = 'default';
        $query_builder = TRUE;
        // Connect to DB
        $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

        // $connect = new mysqli($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
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