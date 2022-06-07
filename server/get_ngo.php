<?php

//include the connection
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM ngo");

$stmt->execute();

$ngo = $stmt->get_result(); // []


?>