
<?php include('layouts/header.php'); 

session_start(); ?>



<title>Home | Pet World</title>

<script>
        if('serviceWorker' in navigator) {
            navigator.serviceWorker.register('sw.js');
        };
</script>


<!-- <button onclick="topFunction()" id="top-btn" class="btn" title="Go to top"> -->
   <i onclick="topFunction()" id="top-btn" class="far fa-caret-circle-up"></i></button>


      <!-- Home -->
      <section id="home">
          <div class="container">
              <h5>NEW PRODUCTS</h5>
              <h1 class="home-text" > <span>Best Products</span> Available</h1>
              <a style="text-decoration: none; color: inherit;" href="shop.php"><button class="text-uppercase">Shop Now</button></a>
          </div>
      </section>

      <!-- Brand -->
      <section id="brand" class="container">
          <div class="row">
              <img src="assets/images/brand3.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12"/>
              <img src="assets/images/brand1.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12"/>
              <img src="assets/images/brand2.png" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12"/>
              <img src="assets/images/brand4.png" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12"/>
          </div>
      </section>
    
      <!-- why section -->
      <section class="why_section layout_padding mt-5">
        <div class="container">
           <div class="heading_container heading_center">
              <h2>
                 Why Shop With Us
              </h2>
           </div>
           <div class="row">
              <div class="col-md-4">
                 <div class="box ">
                    <div class="img-box">
                       <i class="far fa-truck why-shop-with-us"></i>
                    </div>
                    <div class="detail-box">
                       <h5>
                          Fast Delivery
                       </h5>
                       <p>
                          Guaranteed two day delivery from our side
                       </p>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="box ">
                    <div class="img-box">
                       <i class="fab fa-creative-commons-zero why-shop-with-us"></i>
                    </div>
                    <div class="detail-box">
                       <h5>
                          Free Shiping
                       </h5>
                       <p>
                          No minimum order value to avail free shipping
                       </p>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="box ">
                    <div class="img-box">
                       <i class="far fa-badge-check why-shop-with-us"></i>
                    </div>
                    <div class="detail-box">
                       <h5>
                          Best Quality
                       </h5>
                       <p>
                          Best quality products available at decent prices
                       </p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <!-- end why section -->

     <!-- New -->
     <section id="new" class="w-100">
         <div class="row p-0 m-0"> <!-- p-0 m-0 remove padding and margin-->
            <!--One-->
             <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                 <img src="assets/images/products/veg-food5.jpg" alt="" class="img-fluid"/>
                 <div class="details">
                     <h2>Veg Food</h2>
                     <a style="text-decoration: none; color: inherit;" href="shop.php"><button class="text-uppercase">Shop Now</button></a>
                 </div>
             </div>

             <!--Two-->
             <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/images/products/dry-food3.jpg" alt="" class="img-fluid"/>
                <div class="details">
                    <h2>Dry Food</h2>
                    <a style="text-decoration: none; color: inherit;" href="shop.php"><button class="text-uppercase">Shop Now</button></a>
                </div>
            </div>
            

            <!--Three-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/images/products/gravy-food4.jpg" alt="" class="img-fluid"/>
                <div class="details">
                    <h2>Gravy Food</h2>
                    <a style="text-decoration: none; color: inherit;" href="shop.php"><button class="text-uppercase">Shop Now</button></a>
                </div>
            </div>
         </div> 
     </section>


     <!-- Featured -->

     <section id="featured" class="my-5 pb-5">
         <div class="container text-center mt-5 py-5">
             <h3>Featured Products</h3>
             <hr class="mx-auto">
             <p>List of featured products</p>
         </div>


         <!--Adding the product in featured section-->
         <div class="row mx-auto container-fluid">

         
         <!--import the festured product php page-->
         <?php include('server/get_featured_products.php'); ?>

         <!--Loop over the array-->
         <?php while($row= $featured_products->fetch_assoc()){ ?>
             <!--Product One-->
             <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                 <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3"/>
                 <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                 <h4 class="p-price">₹ <?php echo $row['product_price']; ?></h4>
                 <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
             </div>

             <?php } ?>
         </div>
     </section>

     <!--Banner-->
     <section id="banner" class="my-5 py-5">
        <div class="container">
           <h4 class="banner-text">24/7</h4>
           <h1 class="banner-text">Products In <br> Discounted Prices</h1>
           <a style="text-decoration: none; color: inherit;" href="shop.php"><button class="text-uppercase">Shop Now</button></a>
        </div>
     </section>

         <!--Dry Food-->
         <section id="dry-food" class="my-5">
            <div class="container text-center mt-5 py-5">
               <h3>Dry Food</h3>
               <hr class="mx-auto">
               <p>Buy from a range of Dry Foods for your pet</p>
            </div>

            <!--Adding the product in dry food section-->
            <div class="row mx-auto container-fluid">

            <?php include('server/get_dry.php');?>

            <?php while($row=$dry_products->fetch_assoc()) {?>
               <!--Product One-->
               <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                  <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3"/>
                  <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                  <h4 class="p-price">₹ <?php echo $row['product_price']; ?></h4>
                  <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
               </div>

               <?php }?>

            </div>
      </section>


      <!--Gravy Food-->
      <section id="gravy-food" class="my-5">
            <div class="container text-center mt-5 py-5">
               <h3>Gravy Food</h3>
               <hr class="mx-auto">
               <p>Buy from a range of Gravy Foods for your pet</p>
            </div>

            <!--Adding the product in gravy food section-->
            <div class="row mx-auto container-fluid">

            <?php include('server/get_gravy.php');?>

            <?php while($row=$gravy_products->fetch_assoc()) {?>
               <!--Product One-->
               <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                  <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3"/>
                  <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                  <h4 class="p-price">₹ <?php echo $row['product_price']; ?></h4>
                  <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
               </div>

               <?php }?>

            </div>
      </section>


      <!--Veg Food-->
      <section id="veg-food" class="my-5">
            <div class="container text-center mt-5 py-5">
               <h3>Veg Food</h3>
               <hr class="mx-auto">
               <p>Buy from a range of Veg Foods for your pet</p>
            </div>

            <!--Adding the product in veg food section-->
            <div class="row mx-auto container-fluid">

            <?php include('server/get_veg.php');?>

            <?php while($row=$veg_products->fetch_assoc()) {?>
               <!--Product One-->
               <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                  <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3"/>
                  <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                  <h4 class="p-price">₹ <?php echo $row['product_price']; ?></h4>
                  <a href="<?php echo "single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
               </div>

               <?php }?>

            </div>
      </section>



      
      <!--Newsletter-->
      <div class="container-fluid footer-bg block-padding overlay">
         <div class="container">
            <div class="col-lg-5 text-light text-center">
               <h4>Subscribe to our newsletter</h4>
               <p>We send e-mails once a month, we never send Spam!</p>

               <!-- Form -->				
               <div id="mc_embed_signup" >
                  <!-- your form address in the line bellow -->
                  <form action="https://gmail.us20.list-manage.com/subscribe/post?u=603a42f75ec49466f691ba612&amp;id=13e0e4fadf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                     <div id="mc_embed_signup_scroll">
                        <div class="mc-field-group">
                           <div class="input-group">
                              <input class="form-control border2 input-lg required email" type="email" value="" name="EMAIL" placeholder="Your email here" id="mce-EMAIL">
                              <span class="input-group-btn">
                              <button class="btn btn-sm newsletter-button" type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe">Subscribe</button>
                              </span>
                           </div>
                           <!-- Subscription results -->
                           <div id="mce-responses" class="mailchimp">
                              <div class="alert alert-danger response" id="mce-error-response"></div>
                              <div class="alert alert-success response" id="mce-success-response"></div>
                           </div>
                        </div>
                        <!-- /mc-fiel-group -->									
                     </div>
                     <!-- /mc_embed_signup_scroll -->
                  </form>
                  <!-- /form ends -->								
               </div>
               <!-- /mc_embed_signup -->
            </div>
            <!--/ col-lg-->
         </div>
         <!--/ container-->
      </div>

      <script src="https://apps.elfsight.com/p/platform.js" defer></script>
      <div class="elfsight-app-f1e59091-749b-4f15-9679-e849bc221322"></div>


      <?php include('layouts/footer.php'); ?>