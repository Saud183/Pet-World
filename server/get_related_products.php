<?php



//include the connection
include('connection.php');



$stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 4");


$stmt->execute();

$related_products = $stmt->get_result(); // []


?>