<?php include('header.php'); ?>

<?php

if(isset($_GET['breed_id'])){
  
  $breed_id = $_GET['breed_id'];
  $breed_name = $_GET['breed_name'];
  

}else{
  header('location: breed.php');
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

    

      <h2>Update Image</h2>
      <div class="table-responsive">
      


      <!-- fprm to edit breed image -->
      <!-- Form to edit the image -->
          <div class="mx-auto container">
              <form id="edit-image-form"  enctype="multipart/form-data" method="POST" action="update_breed_images.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
            
                <input type="hidden" name="breed_id" value="<?php echo $breed_id;?> ">
                <input type="hidden" name="breed_name" value="<?php echo $breed_name;?> ">


                <div class="form-group mt-2">
                    <label>Image</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Image" required/>
                </div>
          

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="update_images" value="Update"/>
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
