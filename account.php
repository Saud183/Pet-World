<?php

session_start();

include('server/connection.php');


//if the user is not logged in
if(!isset($_SESSION['logged_in'])){

  header('location: login.php');
  exit;
}

//when the user clicks on logout
if(isset($_GET['logout']) ){

  if(isset($_SESSION['logged_in'])){

    unset($_SESSION['logged_in']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_phone']);
    unset($_SESSION['user_password']);
    unset($_SESSION['cart']); 
    unset($_SESSION['wishlist']);
    unset($_SESSION['quantity']);

    header('location: login.php');
    exit;

  }
}


//when the user clicks on change password
if(isset($_POST['change_password'])) {


  $currentPassword = $_POST['currentPassword'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  $pass = md5($currentPassword);

  $user_password = $_SESSION['user_password'];

  $user_email = $_SESSION['user_email'];


  //if current password entered is incorrect
  if($user_password !== $pass ){
    header('location: account.php?error=Current Password entered is incorrect');

  //if the password is less than 6 characters
  }else if(strlen($password) < 6){
    header('location: account.php?error=Password must be atleast 6 characters');
 

    //if the password does not have a number
 }else if(!preg_match("#[0-9]+#",$password)) {
      header('location: account.php?error=Password Must Contain At Least 1 Number');
   

      //if the password does not have a capital letter
  }else if(!preg_match("#[A-Z]+#",$password)) {
      header('location: account.php?error=Password Must Contain At Least 1 Capital Letter');
         

      //if the password does not have a lowercase letter
  }else if(!preg_match("#[a-z]+#",$password)) {
      header('location: account.php?error=Password Must Contain At Least 1 Lowercase Letter');  
    
    
    //if the new and confirm password do not match
  }else if($password !== $confirmPassword) {
    header('location: account.php?error=Passwords do not match');

    //if no errors, password is updated
  }else{

    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");

    $stmt->bind_param('ss',md5($password),$user_email);

    if($stmt->execute()){ 

      unset($_SESSION['logged_in']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_phone']);
      unset($_SESSION['user_password']);

      header('location: login.php?message=Password updated successfully');
      exit;
    }else{

      header('location: account.php?error=Could not update password');
    }

  }

}


//script to get orders

if(isset($_SESSION['logged_in']) ){

  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

  $stmt->bind_param('i',$user_id);

  $stmt->execute();

  $orders = $stmt->get_result(); // []
}



if(isset($_POST['cancel_order_btn'])){

    $order_id = $_POST['order_id'];
    $order_status = "cancelled";
    

    //change order status to paid

    $stmt2 = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");

    $stmt2->bind_param('si',$order_status,$order_id); 

    $stmt2->execute();
    header("Refresh:0");

}


?>





<?php include('layouts/header.php'); ?>

<title>Account | Pet World</title>


      <!--Account-->
      <section class="my-5 py-5">
          <!--Dividing page into two columns-->
          <div class="container row mx-auto">

          <?php
          if(isset($_GET['payment_message']) ){ ?>
            <p class="mt-5 text-center" style="color: green;"><?php echo $_GET['payment_message']; ?></p>
          
          <?php } ?>

          <?php
          if(isset($_GET['order_cancelled']) ){ ?>
            <p class="mt-5 text-center" style="color: red;"><?php echo $_GET['order_cancelled']; ?></p>
          
          <?php } ?>


          

              <!--First Column-->
              <!--Contains account info and orders and logout button-->
              <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">


              

              <p class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){echo $_GET['register_success']; } ?></p>

              <p class="text-center" style="color: green;"><?php if(isset($_GET['login_success'])){echo $_GET['login_success']; } ?></p>

              <!-- Contains account info -->
                <h3 class="font-weight-bold">Account Info</h3>  
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name: <span><?php if(isset($_SESSION['user_name'])) { echo $_SESSION['user_name'];} ?></span></p>
                    <p>Email: <span><?php if(isset($_SESSION['user_email'])) { echo $_SESSION['user_email'];}  ?></span></p>
                    <p>Number: <span><?php if(isset($_SESSION['user_phone'])) { echo $_SESSION['user_phone'];}  ?></span></p>

                    <!-- Button for my orders -->
                    <p><a href="#orders" id="orders-btn">My Orders</a></p>

                    <!-- Logout Button -->
                    <a href="account.php?logout=1" name="logout "id="logout-btn"><button class="btn btn-logout">Logout</button></a>
                </div> 
              </div>

              
              <!--Second Column-->
              <!--COntains form to change password-->
              <div class="col-lg-6 col-md-12 col-sm-12">
                  <form action="account.php" id="account-form" method="POST">

                 

                  <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; } ?></p>
                  <p class="text-center" style="color: green;"><?php if(isset($_GET['message'])){echo $_GET['message']; } ?></p>

                      <h3>Change Password</h3>
                      <hr class="mx-auto">

                      <!-- Input for current password -->
                      <div class="form-group">
                          <label>Current Password</label>
                          <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                      </div> 

                      <!-- Checkbox to toggle password visibility-->
                      <div class="check">
                        <input class="form-check-input" type="checkbox" value="" onclick="toggleCurrentPassword()" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                        </div>

                        <!-- Input for new password -->
                      <div class="form-group">
                          <label>New Password</label>
                          <input type="password" class="form-control" id="password"  name="password" required>
                          <div class="form-helper">Password should be atleast 6 characters long and must contain 1 Uppercase, 1 Lowercase and 1 number</div>
                      </div> 

                      <!-- Checkbox to toggle password visibility-->
                      <div class="check">
                        <input class="form-check-input" type="checkbox" value="" onclick="togglePassword()" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                        </div>

                        <!-- Input for confirm new password -->
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword"  name="confirmPassword" required>
                    </div> 

                    <!-- Checkbox to toggle password visibility-->
                    <div class="check">
                        <input class="form-check-input" type="checkbox" value="" onclick="toggleConfirmPassword()" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                        </div>

                        <!-- Submit button for change password -->
                    <div class="form-group">
                        <input type="submit" name="change_password" id="change-pass-btn" value="Change Password" class="btn">
                    </div>
                  </form>
              </div>
          </div>


      </section>



    <!--Orders-->

    <!--Displays orders-->
      <section id="orders" class="orders container my-3 py-5">
        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">My Orders</h2>
            <hr class="mx-auto">
        </div>

        <!--table to display orders-->
        <table class="mt-5 pt-5">
            <!--Row to display the table heading-->
            <tr>
                <th>Order Id</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
                <th><th>
            </tr>

            <!--Row to display the orders-->

          <?php while($row = $orders->fetch_assoc()){ ?>


            <tr>
                <td>
                    <!-- <div class="product-info">
                        <img src="assets/images/food.jpg" alt=""> 
                        <div>
                            <p class="mt-3"><?php echo $row['order_id']; ?></p>
                        </div>
                    </div> -->
                    <span><?php echo $row['order_id']; ?></span>
                </td>

                <td>
                  <span>₹<?php echo $row['order_cost']; ?></span>
                </td>
               
                <td>
                  <span><?php echo $row['order_status']; ?></span>
                </td>
                
                <td>
                    <span><?php echo $row['order_date']; ?></span>
                </td>

                <td>
                  <form method="POST" action="order_details.php">
                    <input type="hidden" name="order_status" value="<?php echo $row['order_status'] ?>">
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                    <input type="submit" name="order_details_btn" class="btn order-details-btn" value="Details">
                  </form>
                </td>

                <td>

                <?php if($row['order_status'] == 'cancelled') {?>
                <form method="POST" action="order_cancel.php">
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                    <input type="hidden" value="<?php echo $row['order_cost']; ?>" name="order_cost">
                    <input type="hidden" value="<?php echo $row['user_id']; ?>" name="user_id">
                    <input type="submit" name="cancel_order_btn" class="btn btn-danger" value="Cancel" disabled>
                  </form>

              <?php } else {?>

                <form method="POST" action="order_cancel.php">
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                    <input type="hidden" value="<?php echo $row['order_cost']; ?>" name="order_cost">
                    <input type="hidden" value="<?php echo $row['user_id']; ?>" name="user_id">
                    <input type="submit" name="cancel_order_btn" class="btn btn-danger" value="Cancel">
                  </form>

              <?php } ?>

              </td>

            </tr>

            <?php } ?>
        </table>
      </section>



<?php include('layouts/footer.php'); ?>