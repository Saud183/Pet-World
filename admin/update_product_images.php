<?php

include('../server/connection.php');

if(isset($_POST['update_images'])){

    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];

    $image = $_FILES['image']['tmp_name'];

    $image_name = $product_category."1.jpg";

    move_uploaded_file($image,"../assets/images/products/".$image_name);

    $stmt = $conn->prepare("UPDATE products SET product_image=? WHERE product_id=?");
    $stmt->bind_param('si',$image_name,$product_id);

    if($stmt->execute()){
        header('location: products.php?image_updated=Image updated successfully');
    }else{
        header('location: products.php?image_failed=Eror occured, try again');
    }
}


?>