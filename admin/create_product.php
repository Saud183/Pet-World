<?php

    include('../server/connection.php');

    if(isset($_POST['create_product'])){

        $product_name = $_POST['name'];
        $product_category = $_POST['category'];
        $product_breed = $_POST['breed'];
        $product_description = $_POST['description'];  
        $product_price = $_POST['price'];       
        $product_weight = $_POST['weight'];

        $image = $_FILES['image']['tmp_name'];
        //$file_name = $_FILES['image']['name'];

        $image_name = $product_category."1.jpg";

        move_uploaded_file($image,"../assets/images/products/".$image_name);

        //create a new entry
        $stmt = $conn->prepare("INSERT INTO products(product_name,product_category,product_breed,product_description,product_image,product_price,product_weight) VALUES (?,?,?,?,?,?,?)");

        $stmt->bind_param('sssssss',$product_name,$product_category,$product_breed,$product_description,$image_name,$product_price,$product_weight);

        if($stmt->execute()){
            header('location: products.php?product_created=Product has been created successfully');
        }else{
            header('location: products.php?product_failed=Error occured, try again');
        }

    }


?>