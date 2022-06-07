<?php

//include the connection
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Veg Food' ORDER BY RAND() LIMIT 4");

$stmt->execute();

$veg_products = $stmt->get_result(); // []



?>