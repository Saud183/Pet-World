<?php

//include the connection
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Gravy Food' ORDER BY RAND() LIMIT 4");

$stmt->execute();

$gravy_products = $stmt->get_result(); // []



?>