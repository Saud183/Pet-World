<?php include('header.php'); ?>



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

    

      <h2>Add New Product</h2>
      <div class="table-responsive">
      

      <!-- Form to add new product -->

          <div class="mx-auto container">
              <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

                <div class="form-group mt-2">
                    <label>Name</label>
                    <input type="text" class="form-control" id="product-name" name="name"  required/>
                </div>

                <div class="form-group mt-2">
                    <label>Category</label>
                    <select  class="form-select" required name="category">
                        <option value="Dry Food">Dry Food</option>
                        <option value="Gravy Food">Gravy Food</option>
                        <option value="Veg Food">Veg Food</option>
                        <option value="Vet Food">Vet Food</option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Breed</label>
                    <input type="text" class="form-control" id="product-breed" name="breed" required/>
                </div>

                  <div class="form-group mt-2">
                      <label>Description</label> <br>
                      <textarea name="description" id="product-desc" cols="137" rows="7" class="form-control" required></textarea>
                      <!-- <input type="text" class="form-control" id="product-desc" name="description" placeholder="Description" required/> -->
                  </div>

                  <div class="form-group mt-2">
                    <label>Price</label>
                    <input type="text" class="form-control" id="product-price" name="price" required/>
                </div>

                 <div class="form-group mt-2">
                    <label>Weight</label>
                    <input type="text" class="form-control" id="product-weight" name="weight" required/>
                </div>

                <div class="form-group mt-2">
                    <label>Image</label>
                    <input type="file" class="form-control" id="image" name="image" required/>
                </div>

                



                
          

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="create_product" value="Create"/>
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
