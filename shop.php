
<?php

# onclick="window.location.href='single_product.html';"

//include the connection
include('server/connection.php');


//use the search section
if(isset($_POST['search'])){

   //1.determine page nu,ber
   if(isset($_GET['page_no']) && $_GET['page_no'] != ""){

      // if user has already entered page and selected a page
      $page_no = $_GET['page_no'];
   }else{

      // if user jyst entered the page then default page is 1
      $page_no = 1;
   }


   $category = $_POST['category'];
   $price = $_POST['price'];


   //2.return count the number of products
   $stmt1 = $conn->prepare("SELECT count(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
   $stmt1->bind_param('si',$category,$price);
   $stmt1->execute();
   $stmt1->bind_result($total_records);
   $stmt1->store_result();
   $stmt1->fetch();


   //3.Products to display per page
   $total_records_per_page = 20;

   $offset = ($page_no - 1) * $total_records_per_page;

   $previous_page = $page_no - 1;
   $next_page = $page_no + 1;

   $adjacent = "2";

   $total_no_of_pages = ceil($total_records/$total_records_per_page);

   //4. get all products

   $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
   $stmt2->bind_param('si',$category,$price);
   $stmt2->execute();
   $products = $stmt2->get_result(); //[ ]
   


   //return the user all products
}else{
   

   //1.determine page nu,ber
   if(isset($_GET['page_no']) && $_GET['page_no'] != ""){

      // if user has already entered page and selected a page
      $page_no = $_GET['page_no'];
   }else{

      // if user jyst entered the page then default page is 1
      $page_no = 1;
   }


   //2.return count the number of products
   $stmt1 = $conn->prepare("SELECT count(*) As total_records FROM products");
   $stmt1->execute();
   $stmt1->bind_result($total_records);
   $stmt1->store_result();
   $stmt1->fetch();


   //3.Products to display per page
   $total_records_per_page = 20;

   $offset = ($page_no - 1) * $total_records_per_page;

   $previous_page = $page_no - 1;
   $next_page = $page_no + 1;

   //$adjacent = "2";

   $total_no_of_pages = ceil($total_records/$total_records_per_page);


   //4. get all products

   $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
   $stmt2->execute();
   $products = $stmt2->get_result();

}




?>





<?php include('layouts/header.php'); ?>

<title>Shop | Pet World</title>


   <!--Search -->

   <section id="search" class="my-5 py-5 ms-2">

      <div class="container mt-5 py-5">
         <p>Search Products</p>
         <hr>
      </div>

      <form action="shop.php" method="POST">


         <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">

               <p>Category</p>

               <div class="form-check">
                  <input type="radio" class="form-check-input" value="Dry Food" name="category" id="category-one" <?php if(isset($category) && $category=='Dry Food'){echo 'checked';} ?> >
                  <label for="flexRadioDefault1" class="form-check-label">
                     Dry Food
                  </label>
               </div>

               <div class="form-check">
                  <input type="radio" class="form-check-input" value="Gravy Food" name="category" id="category-two" <?php if(isset($category) && $category=='Gravy Food'){echo 'checked';}?> >
                  <label for="flexRadioDefault2" class="form-check-label">
                     Gravy Food
                  </label>
               </div>

               <div class="form-check">
                  <input type="radio" class="form-check-input" value="Veg Food" name="category" id="category-two" <?php if(isset($category) && $category=='Veg Food'){echo 'checked';} ?> >
                  <label for="flexRadioDefault2" class="form-check-label">
                     Veg Food
                  </label>
               </div>

               <div class="form-check">
                  <input type="radio" class="form-check-input" value="Vet Food" name="category" id="category-two" <?php if(isset($category) && $category=='Vet Food'){echo 'checked';} ?> >
                  <label for="flexRadioDefault2" class="form-check-label">
                     Vet Food
                  </label>
               </div>
            </div>
         </div>

         <div class="row mx-auto container mt-5">

            <div class="col-lg-12 col-md-12 col-sm-12">

               <p>Price</p>
               <input type="range" name="price" value="<?php if(isset($price)){echo $price;}else{echo "3000";} ?>" class="form-range w-50" id="customRange2" min="1" max="9999">

               <div class="w-50">
                  <span style="float: left;">1</span>
                  <span style="float: right;">9999</span>
               </div>
            </div>
         </div>

         <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
         </div>

      </form>
   </section>





   <!-- Products -->

   <section id="shop" class="my-5 py-5">
      <div class="container mt-5 py-5">
         <h3>Our Products</h3>
         <hr>
         <p>Here you can check our products.</p>
      </div>

      <!--Adding the product in shop-->
      <div class="row mx-auto container">
         

      <?php while($row = $products->fetch_assoc()){ ?>

         <!--Product-->
         <div
            class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3" />
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">₹<?php echo $row['product_price']; ?></h4>
            <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Buy Now</a>
         </div>

         <?php } ?>
      
         

         <!--pagination-->
      <div aria-label="Page navigation example" class="mx-auto">
        <ul class="pagination mt-5 mx-auto">
          
          <li class="page-item <?php if($page_no<=1){echo 'disabled';}?> ">
               <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{ echo "?page_no=".($page_no-1);} ?>">Previous</a>
          </li>


          <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
          <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

          <?php if( $page_no >=3) {?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no;?></a></li>
          <?php } ?>



          <li class="page-item <?php if($page_no >=  $total_no_of_pages){echo 'disabled';}?>">
                 <a class="page-link" href="<?php if($page_no >= $total_no_of_pages ){echo '#';} else{ echo "?page_no=".($page_no+1);}?>">Next</a></li>
         </ul>
      </div>

   </div>

   </section>




<?php include('layouts/footer.php'); ?>