<?php include('layouts/header.php'); ?>

<?php

session_start();

if(isset($_POST['add_to_wishlist'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalCart();
    

    //if user has already added a product to wishist
    if(isset($_SESSION['wishlist'])){

       $products_array_ids = array_column($_SESSION['wishlist'],"product_id"); // [2,3,4,10,15]
       //if product has already been added to wishlist or not
       if( !in_array($_POST['product_id'], $products_array_ids) ){

            $product_id = $_POST['product_id'];
      
              $product_array = array(
                              'product_id' => $_POST['product_id'],
                              'product_name' =>  $_POST['product_name'],
                              'product_price' => $_POST['product_price'],
                              'product_image' => $_POST['product_image'],
              );
      
              $_SESSION['wishlist'][$product_id] = $product_array;


        //product has already been added
       }else{
         
            echo '<script>alert("Product was already to wishlist");</script>';
           

       }


      //if this is the first product
    }else{
 
       $product_id = $_POST['product_id'];
       $product_name = $_POST['product_name'];
       $product_price = $_POST['product_price'];
       $product_image = $_POST['product_image'];


       $product_array = array(
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_price' => $product_price,
                        'product_image' => $product_image,
       );

       $_SESSION['wishlist'][$product_id] = $product_array;
       // [ 2=>[] , 3=>[], 5=>[]  ]


    }






//remove product from wishlist
}else if(isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['wishlist'][$product_id]);




}else{
  // header('location: index.php');
}


function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;

    if(isset($_SESSION['cart'])){

   foreach($_SESSION['cart'] as $key => $value){

       $product =  $_SESSION['cart'][$key];

       $price =  $product['product_price'];
       $quantity = $product['product_quantity'];

       $total_price =  $total_price + ($price * $quantity);
       $total_quantity = $total_quantity + $quantity;
       

   }
}

   $_SESSION['total'] = $total_price;
   $_SESSION['quantity'] = $total_quantity;

}

?>

   <title>Wishlist | Pet World</title>



    <!--wishlist-->
    <section class="wishlist container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Wishlist</h2>
            <hr>
        </div>

        <!--table to display the wishlist-->
        <table class="mt-5 pt-5">

            <!--Row to display the table heading-->
            <tr>
                <th>Product</th>
                <th>Add To Cart</th>
                <th>Remove</th>
            </tr>

            <?php if(isset($_SESSION['wishlist'])){ ?>  

            <?php foreach($_SESSION['wishlist'] as $key => $value){ ?>

            
            <!--Row to display the wishlist content-->
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/images/products/<?php echo $value['product_image']; ?>" alt="">
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>₹</span><?php echo $value['product_price']; ?></small>
                        </div>
                    </div>
                    
                    
                </td>

                <td>
                    <!--create a form with hidden fields and send to cart page to store in the cart-->
                    <form action="cart.php" method="POST">

                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $value['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $value['product_name'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $value['product_price'];?>">

                    <!--Quantity-->
                    <input type="hidden" value="1" name="product_quantity"/>

                    <!--Add to cart button-->
                    <input type="submit" name="add_to_cart" class="btn btn-primary" value="Add"/>


                    
                  

                    </form>

                   
                </td>

                <!--create a form to remove an item from the wishlist-->
                <td>
                    <form method="POST" action="wishlist.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];    ?>"/>
                        <input type="submit" name="remove_product" class="btn btn-danger" value="Remove"/>
                    </form>
      
                </td>

            </tr>


            <?php } ?>


            <?php } ?>
            
        
        </table>

    
        </section>

<?php include('layouts/footer.php'); ?>
