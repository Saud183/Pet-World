<?php

include('../server/connection.php');

if(isset($_POST['update_images'])){

    $breed_name = $_POST['breed_name'];
    $breed_id = $_POST['breed_id'];

    $image = $_FILES['image']['tmp_name'];

    $image_name = $breed_name.".jpg";

    move_uploaded_file($image,"../assets/images/breed/".$image_name);

    $stmt = $conn->prepare("UPDATE breed SET breed_image=? WHERE breed_id=?");
    $stmt->bind_param('si',$image_name,$breed_id);

    if($stmt->execute()){
        header('location: breed.php?image_updated=Image updated successfully');
    }else{
        header('location: breed.php?image_failed=Eror occured, try again');
    }
}


?>