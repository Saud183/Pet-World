<?php include('header.php'); ?>


<?php

if(isset($_GET['product_id'])){

  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=? ");
  $stmt->bind_param('i',$product_id);
  $stmt->execute();


  $products = $stmt->get_result();

}else if(isset($_POST['edit_button'])){

  $product_id = $_POST['product_id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $breed = $_POST['breed'];
  $weight = $_POST['weight'];
  $category = $_POST['category'];

  $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_breed=?, product_weight=?, product_category=?  WHERE product_id=?");

  $stmt->bind_param('ssisssi',$name,$description,$price,$breed,$weight,$category,$product_id);

  if($stmt->execute()){
    header('location: products.php?edit_success_message=Product has been updated successfully');

  }else{
    header('location: products.php?edit_failure_message=Error occured, try again');

  }

  






}else{
  header('location: products.php');
  exit;
}

?>



<div class="container-fluid">
  <div class="row"  style="min-height: 1000px">
    

        <?php include('sidemenu.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          
          </div>
     
        </div>
      </div>

    

      <h2>Edit Product</h2>
      <div class="table-responsive">
      

      <!-- form to edit product details -->

          <div class="mx-auto container">
              <form id="edit-form" method="POST" action="edit_product.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

                
                  


                  

                <div class="form-group mt-2">

                <?php foreach($products as $product){ ?>

                  <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>"> 




                    <label>Name</label>
                    <input type="text" class="form-control" id="product-name" name="name" value="<?php echo $product['product_name'] ?>" placeholder="Name" required/>
                </div>
                  <div class="form-group mt-2">
                      <label>Description</label> <br>
                      <textarea name="description" id="product-desc" cols="137" rows="10" class="form-control" required><?php echo $product['product_description'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $product['product_description'] ?>" id="product-desc" name="description" placeholder="Description" required/> -->
                  </div>
                  <div class="form-group mt-2">
                    <label>Price</label>
                    <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price'] ?>" name="price" placeholder="Price" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Category</label>
                    <select  class="form-select" required name="category">
                        
                        <option value="Dry Food" <?php if($product['product_category']=='Dry Food'){ echo "selected";}?>>Dry Food</option>
                        <option value="Gravy Food" <?php if($product['product_category']=='Gravy Food'){ echo "selected";}?>>Gravy Food</option>
                        <option value="Veg Food" <?php if($product['product_category']=='Veg Food'){ echo "selected";}?>>Veg Food</option>
                        <option value="Vet Food" <?php if($product['product_category']=='Vet Food'){ echo "selected";}?>>Vet Food</option>
                    </select>
                </div>
                
                  <div class="form-group mt-2">
                      <label>Weight(Kg)</label>
                      <input type="text" class="form-control" value="<?php echo $product['product_weight'] ?>" id="product-weight" name="weight" placeholder="Weight" required/>
                  </div>

              <div class="form-group mt-2">
                    <label>Breed</label>
                    <input type="text" class="form-control" value="<?php echo $product['product_breed'] ?>" id="product-breed" name="breed" placeholder="Breed" required/>
                </div>

                <?php } ?>



                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="edit_button" value="Edit"/>
                </div>
 
              </form>
          </div>
    




      </div>
    </main>
  </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

   
  </body>
</html>
