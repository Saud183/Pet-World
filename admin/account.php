<?php include('header.php'); ?>

<?php

//check if the admin is logged in
if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

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

      <!-- Display account details of the admin -->
      <div class="container">
          <h5>Id: <?php echo $_SESSION['admin_id'];?> </h5>
          <h5>Name: <?php echo $_SESSION['admin_name'];?> </h5>
          <h5>Email: <?php echo $_SESSION['admin_email'];?> </h5>
      </div>
    </main>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

      
  </body>
</html>