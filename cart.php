<?php include('layouts/header.php'); ?>


<?php

session_start();




//check of the person clicked the add to cart button
if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['wishlist'][$product_id]);

    //if user has already added a product to cart
    if(isset($_SESSION['cart'])){

       $products_array_ids = array_column($_SESSION['cart'],"product_id"); // [2,3,4,10,15]

       //if product has already been addedcto cart or not
       if( !in_array($_POST['product_id'], $products_array_ids) ){

            $product_id = $_POST['product_id'];
      
              $product_array = array(
                              'product_id' => $_POST['product_id'],
                              'product_name' =>  $_POST['product_name'],
                              'product_price' => $_POST['product_price'],
                              'product_image' => $_POST['product_image'],
                              'product_quantity' => $_POST['product_quantity']
              );
      
              $_SESSION['cart'][$product_id] = $product_array;


        //product has already been added
       }else{
         
            echo '<script>alert("Product was already to cart");</script>';
           

       }


      //if this is the first product
    }else{
 
       $product_id = $_POST['product_id'];
       $product_name = $_POST['product_name'];
       $product_price = $_POST['product_price'];
       $product_image = $_POST['product_image'];
       $product_quantity = $_POST['product_quantity'];

       $product_array = array(
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_price' => $product_price,
                        'product_image' => $product_image,
                        'product_quantity' => $product_quantity
       );

       $_SESSION['cart'][$product_id] = $product_array;
       // [ 2=>[] , 3=>[], 5=>[]  ]


    }


    //calculate total
    calculateTotalCart();






//remove product from cart
}else if(isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  //calculate total
  calculateTotalCart();



}else if( isset($_POST['edit_quantity']) ){

    //we get id and quantity from the form
   $product_id = $_POST['product_id'];
   $product_quantity = $_POST['product_quantity'];

   //get the product array from the session
   $product_array = $_SESSION['cart'][$product_id];

   //update product quantity
   $product_array['product_quantity'] = $product_quantity;


   //return array back its place
   $_SESSION['cart'][$product_id] = $product_array;


   //calculate total
   calculateTotalCart();

   

}else{
  // header('location: index.php');
}





function calculateTotalCart(){

     $total_price = 0;
     $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){
 
        $product =  $_SESSION['cart'][$key];

        $price =  $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price =  $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
        

    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
    header("Refresh:0");

}





?>



<title>Cart | Pet World</title>




    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Cart</h2>
            <hr>
        </div>

        <!--table to display the cart-->
        <table class="mt-5 pt-5">

           <!--Row to display the table heading-->
            <tr>
                <th>Product</th>
                <th>Add to Wishlist</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

          <?php if(isset($_SESSION['cart'])){ ?>  

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <!--Row to display the cart content-->
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/images/products/<?php echo $value['product_image']; ?>"/>
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>₹</span><?php echo $value['product_price']; ?></small>
                            <br>
                              <!--form for removing the item-->
                            <form method="POST" action="cart.php">
                                 <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                 <input type="submit" name="remove_product" class="remove-btn" value="Remove"/>
                            </form>
                           
                        </div>
                    </div>
                </td>

                

                

                <td>

                

                     <!--create a form with hidden fields and send to wishlist page to store in the wishlist-->
                    <form action="wishlist.php" method="POST">

                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $value['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $value['product_name'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $value['product_price'];?>">

                    

                    <!--Add to wishlist button-->
                    <input type="submit" name="add_to_wishlist" class="btn btn-primary" value="Add"/>

                    </form>

                    

                </td>

                <td>
                    
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                        <input type="number" min="0" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                        <input type="submit" class="edit-btn" value="Edit" name="edit_quantity"/>
                    </form>
                    
                </td>


                <td>
                    
                    <span class="product-price">₹<?php  echo $value['product_quantity'] * $value['product_price']; ?></span>
                </td>
            </tr>

         
            <?php } ?>


            <?php } ?>

         
        </table>


           <!--Table for showing total-->
        <div class="cart-total">
          <table>

            <tr>
              <td>Total</td>
              <?php if(isset($_SESSION['cart'])){?>
                 <td>₹<?php echo $_SESSION['total']; ?></td>
               <?php } ?>  
            </tr>
          </table>
        </div>
    

         <!--The checkout button-->
        <div class="checkout-container">
          <form method="POST" action="checkout.php">
              <input type="hidden" name="name" value="<?php echo $_SESSION['user_name']; ?>">
              <input type="hidden" name="email" value="<?php echo $_SESSION['user_email']; ?>">
              <input type="hidden" name="phone" value="<?php echo $_SESSION['user_phone']; ?>">
             <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
          </form>
        </div>


    </section>








    <?php include('layouts/footer.php'); ?>