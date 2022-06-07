<?php session_start();

    include('../server/connection.php');

?>



<?php

//check whetrher the admin is logged in
  if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;

  }


  //delete the breed entry

  if(isset($_GET['breed_id'])){

    $breed_id = $_GET['breed_id'];

    $stmt = $conn->prepare("DELETE FROM breed WHERE breed_id=?");
    $stmt->bind_param('i',$breed_id);
    
    if($stmt->execute()){

    header('location: breed.php?deleted_successfully=Breed has been deleted successfully');

    }else{

        header('location: breed.php?deleted_failure=Could not delete product');
    }
  }


?>