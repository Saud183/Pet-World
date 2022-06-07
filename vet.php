<?php include('layouts/header.php'); ?>


<title>Vet | Pet World</title>

   <section class="vet-background my-5 py-5">

    <div class="container pt-3"><h3>Doctors and Clinics</h3></div>

    <div class="vet-list" id="vet-list">

    <!--import the vet detail php page-->
    <?php include('server/get_vet_details.php'); ?>

    <!--Loop over the array-->
    <?php while($row= $vet->fetch_assoc()){ ?>

        <div class="vet">

            
            <img src="assets/images/vet/<?php echo $row['vet_image']; ?>" alt="">

            <div class="vet-details">

                <h2><?php echo $row['vet_name']; ?></h2>
                <h4><?php echo $row['vet_profession']; ?></h4>
                <span><?php echo $row['vet_experience']; ?> Years of experience</span>
                <p><i class="fas fa-thumbs-up"></i> &nbsp;&nbsp; Verified</p>

                <h5><?php echo $row['vet_address']; ?> ~ <span><?php echo $row['vet_clinic_name']; ?></span></h5>

                <p>₹<?php echo $row['vet_consult_fee']; ?> Consultation Fee at Clinic</p>

                <a href="<?php echo "single_vet.php?vet_id=".$row['vet_id'];?>"><button class="view-profile-btn">View Profile</button></a>


            </div>

            

            
    
        </div>
        <?php } ?>



        
    </div>




</section>




<?php include('layouts/footer.php'); ?>
