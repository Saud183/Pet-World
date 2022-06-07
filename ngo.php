<?php include('layouts/header.php'); ?>


<title>NGO | Pet World</title>
   

   <section class="ngo-list container pt-5 mt-5">

    <div class="ngo-head pt-3"><h3>List of NGOs</h3></div>

    <!--import the grt ngo php page-->
    <?php include('server/get_ngo.php'); ?>

    <!--Loop over the array-->
    <?php while($row= $ngo->fetch_assoc()){ ?>
    
        <div class="ngo">


        <div class="ngo-details">
            <h2><?php echo $row['ngo_name']; ?></h2>
            <h4><?php echo $row['ngo_type']; ?></h4>
            <h5><i class="fas fa-phone-alt"></i> <?php echo $row['ngo_number']; ?></h5>
            <h5><i class="fas fa-map-marker-alt"></i> <?php echo $row['ngo_address']; ?></h5>
            <p><?php echo $row['ngo_description']; ?></p>
        </div>

        <div class="ngo-map">
            <iframe src="<?php echo $row['ngo_map']; ?>" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>



    </div>

    <?php } ?>



   </section>



   <?php include('layouts/footer.php'); ?>