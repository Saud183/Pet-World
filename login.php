<?php

session_start();

include('server/connection.php');

//check if the user is logged in
if(isset($_SESSION['logged_in'])){

   header('location: account.php');
   exit;
}


//when user clicks on login button
if(isset($_POST['login_btn']) ){

   $email = $_POST['email'];
   $password = md5($_POST['password']);


   $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_phone,user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

   $stmt->bind_param('ss',$email,$password);

   if($stmt->execute()){
      $stmt->bind_result($user_id,$user_name,$user_email,$user_phone,$user_password);
      $stmt->store_result();

      if($stmt->num_rows() == 1){
         $stmt->fetch();

         $_SESSION['user_id'] = $user_id;
         $_SESSION['user_name'] = $user_name;
         $_SESSION['user_email'] = $user_email;
         $_SESSION['user_phone'] = $user_phone;
         $_SESSION['user_password'] = $user_password;
         $_SESSION['logged_in'] = true;

         header('location: account.php?login_success=Logged in successfully');


      }else{
         //error Credentials do not match with in the database
         header('location: login.php?error=Could not verify your account');

      }

   }else{
      //error 
      header('location: login.php?error=Something went wrong');

   }

}



?>



<?php include('layouts/header.php'); ?>

<title>Login | Pet World</title>




      <!--Login-->
      <section id="login-page" class="my-3 py-5">
          <div class="container text-center mt-5 pt-5">
              <h2 class="form-weight-bold">Login</h2>
              <hr class="mx-auto">
          </div>

          <!--Login Form-->
          <div class="mx-auto container">
                <form action="login.php" id="login-form" method="POST">

               <p style="color: red;" class="text-center"> <?php if(isset($_GET['error'])) { echo $_GET['error']; }?> </p>

               <p style="color: green;" class="text-center"> <?php if(isset($_GET['message'])) { echo $_GET['message']; }?> </p>
               

                  <!--Email-->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" id="login-email" class="form-control" p required>
                    </div>

                    <!--Password-->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control"  required>
                    </div>

                     <!-- Checkbox to toggle password visibility-->
                    <div class="check">
                        <input class="form-check-input" type="checkbox" value="" onclick="togglePassword()" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                        </div>

                    <!-- Button for forgot password -->
                    <div class="forgot-password"><a href="forgot_password.php">Forgot Password?</a></div>

                    <!--Login Button-->
                    <div class="form-group">
                        <input type="submit"id="login-btn" class="btn" value="Login" name="login_btn">
                    </div>

                    <!--Dont have an account-->
                    <div class="form-group">
                        <a href="register.php" id="register-url" class="btn">Don't have account? Register</a>
                    </div>

                </form>
          </div>


      </section>




<?php include('layouts/footer.php'); ?>