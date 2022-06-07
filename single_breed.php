<?php 

//include the connection
include('server/connection.php');

//check the product_id
if(isset($_GET['breed_id'])){

    //store the sent value of the breed_id inside a variable
    $breed_id = $_GET['breed_id'];

    //get the details and bind the data
    $stmt = $conn->prepare("SELECT * FROM breed WHERE breed_id = ?");
    $stmt->bind_param("i",$breed_id);

    $stmt->execute();
    
    $breed = $stmt->get_result(); // []

    //no breed_id id was given
}else{

    //redirect to the home if the breed_id/breed doesnt exist
    header('location: breed.php');
}


?>




<?php include('layouts/header.php'); ?>


   <!--Breed-->
   <section class="single-breed my-5 py-5">
    
   <?php while($row = $breed->fetch_assoc()) { ?>

    <title><?php echo $row['breed_name'];?> | Breed | Pet World</title>

    <img class="breed-image" src="assets/images/breed/<?php echo $row['breed_image']; ?>" alt="">

    <h1 class="breed-name"><?php echo $row['breed_name']; ?></h1>

    <h3 class="origin">Origin: <?php echo $row['breed_origin']; ?></h3>

    <hr class="divider">

    <h2 class="general-info">General Information</h2>

    <div class="general-info-row">
        <div class="general-info-column">

            <h2>Height: </h2>
            <h4>Male: <?php echo $row['breed_male_height_min']; ?> - <?php echo $row['breed_male_height_max']; ?> cm</h4>
            <h4>Female: <?php echo $row['breed_female_height_min']; ?> - <?php echo $row['breed_female_height_max']; ?> cm</h4> 

        </div>
        <div class="general-info-column">

            <h2>Weight: </h2>
            <h4>Male: <?php echo $row['breed_male_weight_min']; ?> - <?php echo $row['breed_male_weight_max']; ?> Kg</h4>
            <h4>Female: <?php echo $row['breed_female_weight_min']; ?> - <?php echo $row['breed_female_weight_max']; ?> Kg</h4>

        </div>

        <div class="general-info-column">

            <h2>Life Expentancy: <?php echo $row['breed_life_expectancy_min']; ?> - <?php echo $row['breed_life_expectancy_max']; ?> Years</h2>
            
        </div>

        <div class="general-info-column">

            <h2>Litter: <?php echo $row['breed_litter_size_min']; ?> - <?php echo $row['breed_litter_size_max']; ?></h2>

            
        </div>

    </div>

    <!-- Accordion to display data -->
    <div class="accordion-body">

        <div class="accordion">
            <div class="content-box active">
                <div class="label">Highlight</div>
                <div class="content">
                    <p><?php echo $row['breed_highlight']; ?></p>
                </div>
            </div>

            <div class="content-box">
                <div class="label">Appearance</div>
                <div class="content">
                    <p><?php echo $row['breed_appearance']; ?></p>
                </div>
            </div>

            <div class="content-box">
                <div class="label">History</div>
                <div class="content">
                    <p><?php echo $row['breed_history']; ?></p>
                </div>
            </div>

            <div class="content-box">
                <div class="label">Health Care</div>
                <div class="content">
                    <p><?php echo $row['breed_health_care']; ?></p>
                </div>
            </div>

            <div class="content-box">
                <div class="label">Living Condition</div>
                <div class="content">
                    <p><?php echo $row['breed_living_condition']; ?></p>
                </div>
            </div>

            <div class="content-box">
                <div class="label">Exercise</div>
                <div class="content">
                    <p><?php echo $row['breed_exercise']; ?></p>
                </div>
            </div>

            <div class="content-box">
                <div class="label">Grooming</div>
                <div class="content">
                    <p><?php echo $row['breed_grooming']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs to display data -->
    <div>

        <h3 class="pros-cons">Pros and Cons of adopting a Labrador: </h3>

        <div class="tabs">

            <input type="radio" id="tabpros" name="tabs" checked="checked">
            <label for="tabpros">Pros</label>
            <div class="tab">
                <p><?php echo $row['breed_pros']; ?></p>
            </div>


            <input type="radio" id="tabcons" name="tabs">
            <label for="tabcons">Cons</label>
            <div class="tab">
                <p><?php echo $row['breed_cons']; ?></p>
            </div>


        </div>
    </div>


    <?php } ?>
    

    


</section>



    <script src="assets/js/app.js"></script>

    <?php include('layouts/footer.php'); ?>

