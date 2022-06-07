<?php

session_start();

include('server/connection.php');



?>



<?php include('layouts/header.php'); ?>

<title>Reset Password | Pet World</title>




      <!--Forgot Password-->
      <section id="forgot-password-page" class="my-5 py-5">
          <div class="container text-center mt-5 pt-5">
              <h2 class="form-weight-bold">Forgot Password?</h2>
              <hr class="mx-auto">
          </div>

          <!--forgot password Form-->
          <div class="mx-auto container">
                <form action="server/reset_password.php" id="forgot-password-form" method="POST">

               <p style="color: red;" class="text-center"> <?php if(isset($_GET['error'])) { echo $_GET['error']; }?> </p>

               <p>Enter your Email Address to Reset Password</p>

                  <!--Email-->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" id="forgot-password-email" class="form-control"  required>
                    </div>

                    

                    <!-- Button-->
                    <div class="form-group">
                        <input type="submit" id="send-btn" class="btn" value="Send" name="send_btn">
                    </div>


                </form>
          </div>


      </section>




<?php include('layouts/footer.php'); ?>