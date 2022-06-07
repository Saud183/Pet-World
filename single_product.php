<?php 

//include the connection
include('server/connection.php');

//check the product_id
if(isset($_GET['product_id'])){

    //store the sent value of the product_id inside a variable
    $product_id = $_GET['product_id'];

    //get the details and bind the data
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);

    $stmt->execute();
    
    $product = $stmt->get_result(); // []

    //no product id was given
}else{

    //redirect to the home if the product_id/product doesnt exist
    header('location: index.php');
}


?>



<?php include('layouts/header.php'); ?>

<title>Product | Pet World</title>



      
      <!--Single Product-->

      <!--Image of the product-->
      <section class="single-product my-5 pt-5 container">
        <div class="row mt-5">

        <?php while($row = $product->fetch_assoc()) { ?>

            

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="image-fluid w-100 pb-1" src="assets/images/products/<?php echo $row['product_image']; ?>" alt="" id="mainImg" height="450px"> <!--image-fluid to make it responsive, width to 100% and padding-bottom-->


                
            </div>
            

            <!--Information Regarding the product-->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h6 id="single-head">Shop/<?php echo $row['product_category'];?></h6>

                <!--Name of the product-->
                <h3 class="py-2"><?php echo $row['product_name'];?></h3>

                <!--Price of the product-->
                <h2>₹ <?php echo $row['product_price'];?></h2>


                <!--create a form with hidden fields and send to cart page to store in the cart-->
                <form action="cart.php" method="POST">

                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>">
                    
                    <!--Quantity-->
                    <input type="number" value="1" name="product_quantity" min="0"/>

                    <!--Add to cart button-->
                    <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>

                </form>
                

            <!--create a form with hidden fields and send to cart page to store in the wishlist-->
            <form action="wishlist.php" method="POST">

                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>">

                <button class="add-to-wishlist-btn" name="add_to_wishlist" type="submit">Add to Wishlist</button>

            </form>

                

                <!--Weight of the product-->
                <h4 class="mt-3">Weight: <?php echo $row['product_weight'];?> Kg</h4>

                <!--Suitable for breed-->
                <h4 class="mt-3">Breed: <span ><?php echo $row['product_breed'];?></span></h4>

                <!--Product description-->
                <h4 class="mt-3">Details</h4>
                <span><?php echo $row['product_description'];?></span>
            </div>


            <?php } ?>

        </div>
    </section>



    <!--Related Products-->
    <section id="related-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Products</h3>
            <hr class="mx-auto">
        </div>

        <!--Adding the product in related section-->
        <div class="row mx-auto container-fluid">

        <!--import the festured product php page-->
        <?php include('server/get_related_products.php'); ?>

        <!--Loop over the array-->
        <?php while($row= $related_products->fetch_assoc()){ ?>
            
            <!--Product One-->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3"/>
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">₹<?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
            </div>

            <?php } ?>

            
        </div>
    </section>



    <!-- <script>

        // js to change the small image in click
        var mainImg = document.getElementById("mainImg");
        var smallImg = document.getElementsByClassName("small-img");

        for(let i=0; i<5; i++){
                smallImg[i].onclick = function() {
                mainImg.src = smallImg[i].src;
            }
        }


    </script> -->


<?php include('layouts/footer.php'); ?>