<?php


session_start();

if(!isset($_SESSION['logged_in'])){

    header('location: login.php');
    exit;
 }


if( !empty($_SESSION['cart']) ){

   //let user in

   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];







   //send user to homepage
}else{

   header('location: index.php');

}


?>






<?php include('layouts/header.php'); ?>


<title>Check Out | Pet World</title>
 

      <!--checkout-->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Check Out</h2>
            <hr class="mx-auto">
        </div>

        <!--Form for checkout-->
        <div class="mx-auto container">
              <form action="server/place_order.php" method="POST" id="checkout-form">

              <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

              <p class="text-center" style="color: red;">
              <?php if(isset($_GET['message'])){echo $_GET['message']; } ?>

              <?php if(isset($_GET['message'])){ ?>

                <a href="login.php" class="btn btn-primary">Log In</a>

                <?php } ?>
            
            </p>

               <!--name small-element as only takes 50% width-->
                  <div class="form-group checkout-small-element">
                      <label>Name</label>
                      <input type="text" name="name" id="checkout-name" value="<?php echo $name; ?>" class="form-control" placeholder="Name" required>
                  </div>

                  <!--Email small-element as only takes 50% width-->
                  <div class="form-group checkout-small-element">
                      <label>Email</label>
                      <input type="text" name="email" id="checkout-email" value="<?php echo $email; ?>" class="form-control" placeholder="Email" required>
                  </div>

                  <!--Phone small-element as only takes 50% width-->
                  <div class="form-group checkout-small-element">
                      <label>Phone</label>
                      <input type="tel" name="phone" id="checkout-phone" class="form-control" value="<?php echo $phone; ?>" placeholder="Phone" required>
                  </div>

                  <!--City small element as only takes 50% width-->
                  <div class="form-group checkout-small-element">
                      <label>City</label>
                      <input type="text" name="city" id="checkout-city" class="form-control"  required>
                  </div>

                  <!--address large-element as it takes 100% width-->
                  <div class="form-group checkout-large-element">
                    <label>Address</label>
                    <input type="text" name="address" id="checkout-address" class="form-control"  required>
                </div>

                <!--checkout button-->
                  <div class="form-group checkout-btn-container">
                     <p>Total Amount: ₹<?php echo $_SESSION['total'];?></p>
                      <input type="submit" id="checkout-btn" class="btn" name="place_order" value="Place Order">
                  </div>

              </form>
        </div>


    </section>






<?php include('layouts/footer.php'); ?>