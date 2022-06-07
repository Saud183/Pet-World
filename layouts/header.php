<!-- <?php

session_start();

//include('..server/connection.php');

?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
 
    <!-- <title>Home</title> -->

    <meta name="theme-color" content="#b5cce7" /> 
    <link rel="manifest" href="manifest.json">

    <!--Favicon-->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- fontawesome css-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Link CSS -->
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/about.css"/>
    <link rel="stylesheet" href="assets/css/account.css"/>
    <link rel="stylesheet" href="assets/css/breed.css"/>
    <link rel="stylesheet" href="assets/css/wishlist.css"/>
    <link rel="stylesheet" href="assets/css/cart.css"/>
    <link rel="stylesheet" href="assets/css/checkout.css"/>
    <link rel="stylesheet" href="assets/css/contact.css"/>
    <link rel="stylesheet" href="assets/css/index.css"/>
    <link rel="stylesheet" href="assets/css/login.css"/>
    <link rel="stylesheet" href="assets/css/ngo.css"/>
    <link rel="stylesheet" href="assets/css/register.css"/>
    <link rel="stylesheet" href="assets/css/shop.css"/>
    <link rel="stylesheet" href="assets/css/single_breed.css"/>
    <link rel="stylesheet" href="assets/css/single_product.css"/>
    <link rel="stylesheet" href="assets/css/single_vet.css"/>
    <link rel="stylesheet" href="assets/css/vet.css"/>
    <link rel="stylesheet" href="assets/css/forgot_password.css"/>
    <link rel="stylesheet" href="assets/css/update_password.css"/>
    <link rel="stylesheet" href="assets/css/order_cancel.css"/>

    
    


</head>
<body>


    <!--Navigation Bar-->
   <nav>
      <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <label onclick="window.location.href='index.php';" class="logo">Pet World</label>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="breed.php">Breed?</a></li>
                <li><a href="vet.php">Vet</a></li>
                <li><a href="ngo.php">Ngo</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                
                
                
                

    
                <li>
                    <a href="wishlist.php"><i class="fas fa-heart"></i></a>
                    
                    <a href="cart.php">
                        <i class="fas fa-shopping-cart">
                            <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) {?>
                                <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                            <?php }?>
                        </i>
                    </a>
                    
                    <a href="account.php"><i class="fas fa-user"></i></a>
                </li>
    
            </ul>
   </nav>