<?php 

//include the connection
include('server/connection.php');

//check the product_id
if(isset($_GET['vet_id'])){

    //store the sent value of the vet_id inside a variable
    $vet_id = $_GET['vet_id'];

    //get the details and bind the data
    $stmt = $conn->prepare("SELECT * FROM vet WHERE vet_id = ?");
    $stmt->bind_param("i",$vet_id);

    $stmt->execute();
    
    $vet = $stmt->get_result(); // []

    //no vet_id id was given
}else{

    //redirect to the home if the vet_id/vet doesnt exist
    header('location: vet.php');
}


?>

<?php include('layouts/header.php'); ?>

<title>Vet | Pet World</title>


   <section class="single-vet-background pt-5 mt-5">

   <?php while($row = $vet->fetch_assoc()) { ?>

    <h3 class="heading container pt-4">Vets/<?php echo $row['vet_name']; ?></h3>

    <div class="vet-profile container">

        <div class="vet-image">

            <img src="assets/images/vet/<?php echo $row['vet_image']; ?>" alt="">
        </div>

        <div class="vet-basic-info">

            <h2><?php echo $row['vet_name']; ?></h2>
            <h5><?php echo $row['vet_experience']; ?> Years of Experience</h5>
            <h5>₹<?php echo $row['vet_consult_fee']; ?> Consultation Fee at Clinic</h5>
            <h4><?php echo $row['vet_degree']; ?></h4>
            

            <h4><?php echo $row['vet_address']; ?> ~ <?php echo $row['vet_clinic_name']; ?></h4>
            
            <p><?php echo $row['vet_description']; ?></p>

        </div>


    </div>

    <!--Details-->
      <!--Details about vet-->
      <section id="boxes" class="row mx-auto container my-3 py-3">

        <!--Address-->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="box">
            <img src="assets/images/building.png" alt="">
            <h4><?php echo $row['vet_address']; ?></h4>
        </div>
        </div>

        <!--Whatsapp-->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="box">
            <img src="assets/images/whatsapp.png" alt="">
            <h4>+91 <?php echo $row['vet_number']; ?></h4>
        </div>

        </div>

        <!--Phone-->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="box">
            <img src="assets/images/phone.png" alt="">
            <h4><?php echo $row['vet_number']; ?></h4>
        </div>
          
        </div>

        <!--Email-->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="box">
            <img src="assets/images/email.png" alt="">
            <h4><?php echo $row['vet_email']; ?></h4>
        </div>
        </div>

      </section>


      <!-- Whereabout and Services offered -->
    <section class="vet-detailing">

        <div class="vet-overview">

            <h4 class="overview">Whereabouts and Overview</h4>
            <p><?php echo $row['vet_whereabout']; ?></p>

            <h4 class="services">Services Offered</h4>
            <p><?php echo $row['vet_services']; ?></p>



        </div>

        

        


    
            
        
    </section>



    <!-- Map for the address -->
    <section class="vet-map">
        <iframe src="<?php echo $row['vet_map']; ?>" width="98%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>
    

    <!-- FAQ section -->
<section class="faqs">

    <div class="faqs-div mt-4">
        
        <h4 class="">Frequently Asked Questions</h4>

        <h5>What are the various mode of payment accepted here?</h5>
        <p><?php echo $row['vet_faq1']; ?></p>

        <h5>Which is the nearest landmark?</h5>
        <p><?php echo $row['vet_faq2']; ?></p>

    </div>

</section>
    

<?php } ?>

</section>


<?php include('layouts/footer.php'); ?>