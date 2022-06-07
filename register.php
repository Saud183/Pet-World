<?php

session_start();

include('server/connection.php');


// if user has already registered then take user to account page
if(isset($_SESSION['logged_in']) ){

   header('location: account.php');
   exit;

}


// when user clicks om register
if(isset($_POST['register']) ){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $password = $_POST['password'];
   $confirmPassword = $_POST['confirmPassword'];


   //check if it is a valid email
   if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
      header('location: register.php?error=Enter a Valid Email');

  }
   //if password is less than 6 characters
   else if(strlen($password) < 6){
      header('location: register.php?error=Password must be atleast 6 characters');
   
   
      //if the password does not have a number
   }else if(!preg_match("#[0-9]+#",$password)) {
      header('location: register.php?error=Password Must Contain At Least 1 Number');
   
      //if the password does not have a capital letter
   }else if(!preg_match("#[A-Z]+#",$password)) {
      header('location: register.php?error=Password Must Contain At Least 1 Capital Letter');
         

      //if the password does not have a lowercase letter
   }else if(!preg_match("#[a-z]+#",$password)) {
      header('location: register.php?error=Password Must Contain At Least 1 Lowercase Letter');
         

   //if password and confirm password do not matvh
   }else if($password !== $confirmPassword) {
    header('location: register.php?error=Passwords do not match');
 

    //if number entered is invalid
    }else if(!preg_match("/^[0-9]{10}+$/", $phone)){
    
    header('location: register.php?error=Enter a valid Phone Number');

   
   
   //if there is no error
    }else{
            //check whether there is a user with this email/number or not
         $stmt1= $conn->prepare("SELECT count(*) FROM users WHERE user_email=? OR user_phone=?");
         $stmt1->bind_param('si',$email,$phone);
         $stmt1->execute();
         $stmt1->bind_result($num_rows);
         $stmt1->store_result();
         $stmt1->fetch();

         //if there is a user with already registered with this email
         if($num_rows != 0){
            header('location: register.php?error=User with this email/number already exists');

            //if no user registered with this email before
         }else{
            //create a new user
            $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_phone,user_password) VALUES (?,?,?,?)");

            $stmt->bind_param('ssis',$name,$email,$phone,md5($password));

            //if account was created successfully
            if($stmt->execute()){

               $user_id = $stmt->insert_id;
               
               $_SESSION['user_id'] = $user_id;
               $_SESSION['user_email'] = $email;
               $_SESSION['user_name'] = $name;
               $_SESSION['user_phone'] = $phone;
               $_SESSION['user_password'] = $password;
               $_SESSION['logged_in'] = true;
               header('location: account.php?register_success=You registered successfully');

               //account could not be created
            }else{
               header('location: register.php?error=Could not create an account at the moment');

            }


         }


         

   }



   
}


?>




<?php include('layouts/header.php'); ?>

<title>Register | Pet World</title>
 

      <!--Register-->
      <section class="my-5 py-5">
          <div class="container text-center pt-3">
              <h2 class="form-weight-bold">Register</h2>
              <hr class="mx-auto">
          </div>

          

          <!--Register Form-->
          <div class="mx-auto container">
                <form action="register.php" id="register-form" method="POST">

                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

                  <!--Name-->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="register-name" class="form-control"  required>
                    </div>

                    <!--Email-->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" id="register-email" class="form-control"  required>
                    </div>

                    <!--Phone-->
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control"  required>
                    </div>

                    <!--Password-->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control"  required>
                        <div class="form-helpers">Password should be atleast 6 characters long and must contain 1 Uppercase, 1 Lowercase and 1 number</div>
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
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"  required>
                    </div>

                     <!-- Checkbox to toggle password visibility-->
                    <div class="check">
                        <input class="form-check-input" type="checkbox" value="" onclick="toggleConfirmPassword()" id="flexCheckDefault1">
                        <label class="form-check-label" for="flexCheckDefault1">
                            Show Password
                        </label>
                        </div>

                    <!--Register Button-->
                    <div class="form-group">
                        <input type="submit"id="register-btn" class="btn" value="Register" name="register">
                    </div>

                    <!--Already have an account-->
                    <div class="form-group">
                        <a href="login.php" id="login-url" class="btn">Already have an account? Login</a>
                    </div>

                </form>
          </div>


      </section>




<?php include('layouts/footer.php'); ?>