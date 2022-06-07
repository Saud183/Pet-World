<?php include('layouts/header.php'); ?>

<title>Contact Us | Pet World</title>




      <!--Contact-->
      <section id="contact" class="container my-5 py-5">

        <div class="row">
            <h3 class="text-center mt-5">Contact Us</h3>
            <hr class="w-50" style="margin-left: 25%;">

            <!--Site Info-->
            <div class="col-lg-4 col-md-12 col-sm-12 container mt-3">
                
                <!--address-->
                <p class="contact-info">
                    <i class="far fa-building mx-2"></i>   
                    <span>Mumbai, Maharashtra, India</span> 
                </p>

                <!--Whatsapp-->
                <p class="contact-info">
                    <i class="fab fa-whatsapp mx-2"></i>   
                    <span>+91 99999 88888</span> 
                </p>
  
                <!--Call-->
                <p class="contact-info">
                    <i class="far fa-phone-alt mx-2"></i> 
                    <span>99999 88888</span> 
                </p>
  
                <!--Mail-->
                <p class="contact-info">
                    <i class="far fa-envelope mx-2"></i>
                    <span>info@petworld.com</span> 
                </p>


              <p class="contact-info">
                  We work 24/7 to answer your questions
              </p>

              <br><br>
              <!-- Social Network Accounts -->
              <p class="contact-info">
                  Follow Us
              </p>
              <!-- <hr class="fluid" style="position: absolute; top: 445px; width: 75px;"> -->


              <!-- Social Links -->
              <div class= "mb-4 social-link"> <!-- col-lg-4 col-md-6 col-sm-12 -->
                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://in.pinterest.com/" target="_blank"><i class="fab fa-pinterest"></i></a>
             </div>

            </div>
            

            <!--Contact Form-->
            <div class="form-contact col-lg-8 col-md-12 col-sm-12 mt-3">
                <div class="mx-auto container">
                    <h3>Write To Us</h3>
                    <hr class="fluid" style="position: absolute; top: 235px; height: 2px!important; width: 55%;">
                    <p>Jot us a note and we'll get back to you as quickly as possible. </p>
 
                    <form action="https://formspree.io/f/mzbodnrr" method="POST" id="contact-form" style="margin-top: -20px;">

                    <?php if(isset(($_GET['error']))) { ?>
                        <p class="text-center" style="color: red;"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if(isset(($_GET['mail_success']))) { ?>
                        <p class="text-center" style="color: green;"><?php echo $_GET['mail_success']; ?></p>
                    <?php } ?>

                    <?php if(isset(($_GET['mail_failed']))) { ?>
                        <p class="text-center" style="color: red;"><?php echo $_GET['mail_failed']; ?></p>
                    <?php } ?>


                        <!--Name-->
                        <div class="form-group">
                            <input type="text" name="name" id="contact-name" class="form-control" placeholder="Name" required>
                        </div>
    
                        <!--Email-->
                        <div class="form-group">
                            <input type="text" name="email" id="contact-email" class="form-control" placeholder="Email" required>
                        </div>
    
                        <!--Subject-->
                        <div class="form-group">
                            <input type="text" name="subject" id="contact-subject" class="form-control" placeholder="Subject" required>
                        </div>

                        <!--Message-->
                        <div class="form-group">
                            <textarea name="message" id="contact-message" class="form-control" placeholder="Message" rows="5" required></textarea>

                            <!-- <input type="textbox" name="message" id="contact-message" class="form-control" placeholder="Message" required> -->
                        </div>


                        <!--Submit Button-->
                        <div class="form-group">
                            <input type="submit" id="contact-btn" class="btn" >
                        </div>
    
                    </form>
              </div>
            </div>

        </div>

          
      </section> 

      <!--Map-->
      <section id="map">
        <h3 class="text-center mt-5">Locate Us</h3>
        <hr class="w-50">

        <div class="mt-2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.814955727584!2d72.84314541421192!3d19.027873958429655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7ced0d6cd6319%3A0x9f4d4c14b98869ed!2sD.G.%20Ruparel%20College%20of%20Arts%2C%20Science%20and%20Commerce!5e0!3m2!1sen!2sin!4v1640860205182!5m2!1sen!2sin" width="100%" height="450" style="border: 1px;" allowfullscreen="" loading="lazy"></iframe>   
        </div>  
      </section>


      <?php include('layouts/footer.php'); ?>
