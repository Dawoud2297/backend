<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

spl_autoload_register(function ($class){
    $path = 'classes/' . $class . '.php';
    include $path;
});

// instantiate classes

$database = new Dbh();
$getDvd = new Dvd();
$getBook = new Book();
$getFur = new Furniture();

// Get All Products

$fatherArray = array($getDvd->getDvdData(),$getBook->getBookData(),$getFur->getFurnitureData());
echo json_encode($fatherArray);

// post product

$getDvd->postData();
$getFur->postData();
$getBook->postData();

// delete product

$getDvd->deleteDataFromDvd();
$getBook->deleteDataFromBook();
$getFur->deleteDataFromFurniture();