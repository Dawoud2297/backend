<?php

class Furniture extends Dbh implements Differenciate
{
    public $name;
    public $sku;
    public $price;
    public $height;
    public $width;
    public $length;


    public function differences()
    {
        $content = json_decode(file_get_contents('php://input',true),true);

        $this->name = $content['name'];
        $this->sku = $content['sku'];
        $this->price = $content['price'];
        $this->height = $content['height'];
        $this->width = $content['width'];
        $this->length = $content['length'];


        $insert = "INSERT INTO furniture(name,sku,price,height,width,length) 
        VALUES('$this->name','$this->sku','$this->price','$this->height','$this->width','$this->length')";
        $sql = "SELECT * FROM furniture WHERE sku='$this->sku'";
        $uniqueSku = $this->connection()->query($sql);

        if( $uniqueSku->num_rows > 0 ){
          $res = ['status'=> 1, 'message'=> "Sku must be unique!"];
          http_response_code(404);
        } elseif ( $this->connection()->query($insert) ) {
          $res = ['status'=> 1, 'message'=> "Record successfully created!"];
        } else {
              $res = ['status'=> 0, 'message'=> "Failed to create recorde!"];
        }
        echo json_encode($res);
    }

    public function getFurnitureData()
    {
        $sql1 = "SELECT * FROM furniture";

        $result = $this->connection()->query($sql1);

        if ( empty($result) ) {
            $sql = "CREATE TABLE furniture (
            name VARCHAR(30) NOT NULL,
            sku VARCHAR(30) UNIQUE NOT NULL,
            price INT(10) UNSIGNED NOT NULL,
            -- dimensions VARCHAR(12) NOT NULL,
            height INT(10) UNSIGNED NOT NULL,
            width INT(10) UNSIGNED NOT NULL,
            length INT(10) UNSIGNED NOT NULL,
            )";
            if ( $this->connection()->query($sql) === true ) {
                echo "Table is created successfully";
            } else {
                echo "Error creating table: " . $this->connection()->error;
            }
        }

        $json_array = array();
        while ( $row = mysqli_fetch_assoc($result) ) {
            $json_array[] = $row;
        }
        return $json_array;
    }

    public function deleteDataFromFurniture()
    {
        if ( isset($_GET['sku']) ) {
            $sku = $_GET['sku'];
            $sqld = "DELETE FROM furniture WHERE sku='$sku'";
            
            if ( $sqld !== null && $this->connection()->query($sqld) === true ) {
                $res = ['status'=> 1, 'message'=> "Record deleted successfully!"];
            } else {
                $res = ['status'=> 0, 'message'=> "Failed to delete record!"];
            }
            return json_encode($res);
        }
    }

    public function postData()
    {
        $req = json_decode(file_get_contents('php://input', true),true);
        $_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists("height",$req) && array_key_exists("width",$req) && array_key_exists("length",$req) && $this->differences();
    }
}

