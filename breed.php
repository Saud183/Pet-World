<?php include('layouts/header.php'); ?>

<title>Breed | Pet World</title>


   <section id="breed" class="container my-5 py-5">
      
   
    <!-- Search bar to search for a breed -->
      <div class="search-bar"> 

          <form>
              <i class="fas fa-search"></i>
              <input type="text" id="search-item" placeholder="Search" onkeyup="search()">
          </form>
      </div>

      <div class="breed-list" id="breed-list">

          

            <!--import the get breed php page-->
            <?php include('server/get_breed.php'); ?>


            <!--Loop over the array-->
            <?php while($row= $breed->fetch_assoc()){ ?>

                <div class="breed">

              <img src="assets/images/breed/<?php echo $row['breed_image']; ?>" alt="">

              <div class="breed-details">

                  <h1><?php echo $row['breed_name']; ?></h1>

                  <h2>Origin: <?php echo $row['breed_origin']; ?></h2>

                  <h4>Life Expectancy: <?php echo $row['breed_life_expectancy_min']; ?> - <?php echo $row['breed_life_expectancy_max']; ?> Years</h4>

                  <p><strong>Breed Highlight: </strong><?php echo $row['breed_highlight']; ?></p>

                  <a href="<?php echo "single_breed.php?breed_id=".$row['breed_id'];?>"><button class="learn-more-btn">Learn More</button></a>
                  
              </div>

              </div>

              <?php } ?>
              
         

        
      </div>
      

  </section>





   <script src="assets/js/app.js"></script>

   <?php include('layouts/footer.php'); ?>
