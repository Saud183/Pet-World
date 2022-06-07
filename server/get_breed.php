<?php

//include the connection
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM breed");

$stmt->execute();

$breed = $stmt->get_result(); // []


?>