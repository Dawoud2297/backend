<?php

class Book extends Dbh implements Differenciate
{
  
  public $name;
  public $sku;
  public $price;
  public $weight;

  public function differences()
  {
      $content = json_decode(file_get_contents('php://input',true),true);

      $this->name = $content['name'];
      $this->sku = $content['sku'];
      $this->price = $content['price'];
      $this->weight = $content['weight'];

      $insert = "INSERT INTO book(name,sku,price,weight) VALUES('$this->name','$this->sku','$this->price','$this->weight')";

      if ($this->connection()->query($insert)) {
          $res = ['status'=> 1, 'message'=> "Record successfully created!"];
      } else {
          $res = ['status'=> 0, 'message'=> "Failed to create record!"];
      }
      echo json_encode($res);
  }

  public function getBookData()
  {
    $sql = "SELECT * FROM book";

    $result = $this->connection()->query($sql);

    if (empty($result)) {
      $sql = "CREATE TABLE book (
        name VARCHAR(30) NOT NULL,
        sku VARCHAR(30) UNIQUE NOT NULL,
        price INT(10) UNSIGNED NOT NULL,
        weight INT(6) UNSIGNED NOT NULL
        )";

        if ($this->connection()->query($sql) === TRUE) {
            echo "Table is created successfully";
        } else {
          echo "Error creating table: " . $this->connection()->error;
        }
    }

    $json_array = array();

    while ($row = mysqli_fetch_assoc($result)) {
      $json_array[] = $row;
    }
      return $json_array;
  } 

  public function deleteDataFromBook()
  {
    if (isset($_GET['sku'])) {
      $sku = $_GET['sku'];
      $sqld = "DELETE FROM book WHERE sku='$sku'";

      if ($sqld !== null && $this->connection()->query($sqld) === true) {
        $res = ['status'=> 1, 'message'=> "Record deleted successfully!"];
      } else {
        $res = ['status'=> 0, 'message'=> "Failed to delete recorde!"];
      }
      return json_encode($res);
    }
  }
  public function postData()
  {
      http_response_code(200);
      $req = json_decode(file_get_contents('php://input', true),true);  
      $_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists("weight",$req) && $this->differences();
  }
}
