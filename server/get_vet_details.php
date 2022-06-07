<?php

//include the connection
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM vet");

$stmt->execute();

$vet = $stmt->get_result(); // []



?>