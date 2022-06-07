<?php

//include the connection
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Dry Food' ORDER BY RAND() LIMIT 4");

$stmt->execute();

$dry_products = $stmt->get_result(); // []



?>