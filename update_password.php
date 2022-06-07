<?php

session_start();

include('server/connection.php');


//when the user clicks on the link sent in the mail
if(isset($_GET['email']) && isset($_GET['reset_token'])){

    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");

    $email = $_GET['email'];
    $reset_token = $_GET['reset_token'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? AND user_reset_token=? AND user_reset_token_expiry=?");
    $stmt->bind_param('sss',$email,$reset_token,$date);

    if($stmt->execute()){

        $stmt->bind_result($user_id,$user_name,$user_email,$user_phone,$user_password,$user_reset_token,$user_reset_token_expiry);
        $stmt->store_result();

        if($stmt->num_rows() == 1){


        }else{

            header('location: forgot_password.php?error=Invalid or Expired Link');

        }



    }else{

        header('location: forgot_password.php?error=Server Down, please try again later');
    }



}else{

    header('location: login.php');

}


if(isset($_POST['update_btn'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    
 //if password is less than 6 characters
 if(strlen($password) < 6){
    header('location: update_password.php?error=Password must be atleast 6 characters');
 
 
    //if the password does not have a number
 }else if(!preg_match("#[0-9]+#",$password)) {
    header('location: update_password.php?error=Password Must Contain At Least 1 Number');
 
    //if the password does not have a capital letter
 }else if(!preg_match("#[A-Z]+#",$password)) {
    header('location: update_password.php?error=Password Must Contain At Least 1 Capital Letter');
       

    //if the password does not have a lowercase letter
 }else if(!preg_match("#[a-z]+#",$password)) {
    header('location: update_password.php?error=Password Must Contain At Least 1 Lowercase Letter');
       


 //if passwords dont match
 }else if($password !== $confirmPassword) {
    header('location: update_password.php?error=Passwords do not match');
 
 //if there is no error
 }else{

    $token = NULL;
    $token_expiry = NULL;

    $stmt = $conn->prepare("UPDATE users SET user_password=?, user_reset_token=?, user_reset_token_expiry=? WHERE user_email=?");

    $stmt->bind_param('ssss',md5($password),$token,$token_expiry,$email);

    if($stmt->execute()){

      header('location: login.php?message=Password has been updated successfully');

    }else{

      header('location: login.php?error=Could not update password');
    }



 }

}



?>



<?php include('layouts/header.php'); ?>

<title>Update Password | Pet World</title>




      <!--Update Password-->
      <section id="forgot-password-page" class="my-5 py-5">
          <div class="container text-center mt-5 pt-5">
              <h2 class="form-weight-bold">Create New Password</h2>
              <hr class="mx-auto">
          </div>

          <!--Update Password Form-->
          <div class="mx-auto container">
                <form action="update_password.php" id="update-password-form" method="POST">

               <p style="color: red;" class="text-center"> <?php if(isset($_GET['error'])) { echo $_GET['error']; }?> </p>

               <p>Create New Password</p>

               <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">

                  <!--Password-->
                  <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control"  required>
                        <div class="form-helperss">Password should be atleast 6 characters long and must contain 1 Uppercase, 1 Lowercase and 1 number</div>
                    </div>

                     <!-- Checkbox to toggle password visibility-->
                    <div class="check">
                        <input class="form-check-input" type="checkbox" value="" onclick="togglePassword()" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                        </div>

                    <!--Confirm Password-->
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                    </div>

                     <!-- Checkbox to toggle password visibility-->
                    <div class="check">
                        <input class="form-check-input" type="checkbox" value="" onclick="toggleConfirmPassword()" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                        </div>

                    
                    

                    <!-- Button-->
                    <div class="form-group">
                        <input type="submit" id="update-btn" class="btn" value="Update" name="update_btn">
                    </div>


                </form>
          </div>


      </section>




<?php include('layouts/footer.php'); ?>