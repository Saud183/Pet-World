
<?php include('header.php');?>

<?php

//check whether the admin is logged in
  if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;

  }


?>


<?php

//pagination
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

$adjacent = "2";

$total_no_of_pages = ceil($total_records/$total_records_per_page);


//4. get all products

$stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();




?>



<div class="container-fluid">
  <div class="row" style="min-height: 1000px">
    

  <?php include('sidemenu.php');?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          
          </div>
     
        </div>
      </div>

    

      <h2>Products</h2>

      <?php if(isset(($_GET['edit_success_message']))) { ?>
      <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>
      <?php } ?>

      <?php if(isset(($_GET['edit_failure_message']))) { ?>
      <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></p>
      <?php } ?>
    
      <?php if(isset(($_GET['deleted_successfully']))) { ?>
      <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully']; ?></p>
      <?php } ?>

      <?php if(isset(($_GET['deleted_failure']))) { ?>
      <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure']; ?></p>
      <?php } ?>

      <?php if(isset(($_GET['product_created']))) { ?>
      <p class="text-center" style="color: green;"><?php echo $_GET['product_created']; ?></p>
      <?php } ?>

      <?php if(isset(($_GET['product_failed']))) { ?>
      <p class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></p>
      <?php } ?>

      <?php if(isset(($_GET['image_updated']))) { ?>
      <p class="text-center" style="color: green;"><?php echo $_GET['image_updated']; ?></p>
      <?php } ?>

      <?php if(isset(($_GET['image_failed']))) { ?>
      <p class="text-center" style="color: red;"><?php echo $_GET['image_failed']; ?></p>
      <?php } ?>

      <!-- Table to display products -->


      <div class="table-responsive">
        <table class="table table-striped table-sm">

        <!-- Table Heading -->
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Category</th>
              <th scope="col">Edit Image</th>
              <th scope="col">Edit Details</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <!-- Table Body -->
          <tbody>

          <?php foreach($products as $product) { ?>

            <!-- Row to display product details -->

            <tr>
              <td><?php echo $product['product_id']; ?></td>
              <td><img src="<?php echo "../assets/images/products/".($product['product_image']); ?>" alt="" style="width: 70px; height: 70px"></td>
              <td><?php echo $product['product_name']; ?></td>
              <td><?php echo "₹".$product['product_price']; ?></td>
              <td><?php echo $product['product_category']; ?></td>

              <td><a class="btn btn-warning" href="<?php echo "edit_product_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name']; ?>">Edit</a></td>

              <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>

              <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id'];?>">Delete</a></td>
            </tr>
            
            <?php } ?>

          </tbody>
        </table>


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
    </main>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

     
  </body>
</html>
