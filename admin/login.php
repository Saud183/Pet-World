<?php include('header.php');?>

<?php


include('../server/connection.php');

//check if the user is logged in
if(isset($_SESSION['admin_logged_in'])){

   header('location: dashboard.php');
   exit;
}


//when user clicks on login button
if(isset($_POST['login_btn']) ){

   $email = $_POST['email'];
   $password = md5($_POST['password']);


   $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

   $stmt->bind_param('ss',$email,$password);

   if($stmt->execute()){
      $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
      $stmt->store_result();

      if($stmt->num_rows() == 1){
         $stmt->fetch();

         $_SESSION['admin_id'] = $admin_id;
         $_SESSION['admin_name'] = $admin_name;
         $_SESSION['admin_email'] = $admin_email;
         $_SESSION['admin_logged_in'] = true;

         header('location: dashboard.php?login_success=Logged in successfully');


      }else{
         //error Credentials do not match
         header('location: login.php?error=Could not verify your account');

      }

   }else{
      //error
      header('location: login.php?error=Something went wrong');

   }

}



?>









<div class="container-fluid">
  <div class=""  style="min-height: 1000px">
   

    <main class="col-md-6 mx-auto col-lg-6 px-md-4 text-center">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          
          </div>
     
        </div>
      </div>

    

      <h2>Login</h2>
      <div class="table-responsive">
      


      <!-- Login Form -->
          <div class="mx-auto container">
              <form id="login-form" method="POST" action="login.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

                <!-- Email -->
                <div class="form-group mt-2">
                    <label>Email</label>
                    <input type="email" class="form-control" id="product-name" name="email" required/>
                </div>

                <!-- Password -->
                  <div class="form-group mt-2">
                      <label>Password</label>
                      <input type="password" class="form-control" id="product-desc" name="password" required/>
                  </div>
              


                  <!-- Login Button -->
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="login_btn" value="Login"/>
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
