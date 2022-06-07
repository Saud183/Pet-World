<?php include('header.php'); ?>


<?php

if(isset($_GET['breed_id'])){

  $breed_id = $_GET['breed_id'];

  $stmt = $conn->prepare("SELECT * FROM breed WHERE breed_id=? ");
  $stmt->bind_param('i',$breed_id);
  $stmt->execute();


  $breed = $stmt->get_result();

}else if(isset($_POST['edit_button'])){

  $breed_id = $_POST['breed_id'];
  $name = $_POST['name'];
  $origin = $_POST['origin'];
  $male_w_min = $_POST['breed_male_weight_min'];
  $male_w_max = $_POST['breed_male_weight_max'];
  $female_w_min = $_POST['breed_female_weight_min'];
  $female_w_max = $_POST['breed_female_weight_max'];
  $male_h_min = $_POST['breed_male_height_min'];
  $male_h_max = $_POST['breed_male_height_max'];
  $female_h_min = $_POST['breed_female_height_min'];
  $female_h_max = $_POST['breed_female_height_max'];
  $life_expectancy_min = $_POST['breed_life_expectancy_min'];
  $life_expectancy_max = $_POST['breed_life_expectancy_max'];
  $litter_size_min = $_POST['breed_litter_size_min'];
  $litter_size_max = $_POST['breed_litter_size_max'];
  $highlight = $_POST['highlight'];
  $appearance = $_POST['appearance'];
  $history = $_POST['history'];
  $health = $_POST['health'];
  $living = $_POST['living'];
  $exercise = $_POST['exercise'];
  $grooming = $_POST['grooming'];
  $pros = $_POST['pros'];
  $cons = $_POST['cons'];

  $stmt = $conn->prepare("UPDATE breed SET breed_name=?, breed_origin=?, breed_male_weight_min=?, breed_male_weight_max=?, breed_female_weight_min=?, breed_female_weight_max=?, breed_male_height_min=?, breed_male_height_max=?, breed_female_height_min=?, breed_female_height_max=?, breed_life_expectancy_min=?, breed_life_expectancy_max=?,breed_litter_size_min=?,breed_litter_size_max=?, breed_highlight=?, breed_appearance=?, breed_history=?, breed_health_care=?, breed_living_condition=?, breed_exercise=?, breed_grooming=?, breed_pros=?, breed_cons=?  WHERE breed_id=?");

  $stmt->bind_param('sssssssssssssssssssssssi',$name,$origin,$male_w_min,$male_w_max,$female_w_min,$female_w_max,$male_h_min,$male_h_max,$female_h_min,$female_h_max,$life_expectancy_min,$life_expectancy_max,$litter_size_min,$litter_size_max,$highlight,$appearance,$history,$health,$living,$exercise,$grooming,$pros,$cons,$breed_id);

  if($stmt->execute()){
    header('location: breed.php?edit_success_message=Breed has been updated successfully');

  }else{
    header('location: breed.php?edit_failure_message=Error occured, try again');

  }

  






}else{
  header('location: breed.php');
  exit;
}

?>


<div class="container-fluid mb-3">
  <div class="row"  style="min-height: 1000px">
    

        <?php include('sidemenu.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          
          </div>
     
        </div>
      </div>

    

      <h2>Edit Breed</h2>
      <div class="table-responsive">
      


      <!-- Form to edit breed details -->

          <div class="mx-auto container">
              <form id="edit-form" method="POST" action="edit_breed.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

                
                  


                  

                <div class="form-group mt-2">

                <?php foreach($breed as $b){ ?>

                  <input type="hidden" name="breed_id" value="<?php echo $b['breed_id']; ?>"> 




                    <label>Name</label>
                    <input type="text" class="form-control" id="breed-name" name="name" value="<?php echo $b['breed_name'] ?>" placeholder="Name" required/>
                </div>

                  <div class="form-group mt-2">
                      <label>Origin</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_origin'] ?>" id="breed-origin" name="origin" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Weight Min(Kg)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_male_weight_min'] ?>" id="breed_male_weight_min" name="breed_male_weight_min" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Weight Max(Kg)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_male_weight_max'] ?>" id="breed_male_weight_max" name="breed_male_weight_max" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Weight Min(Kg)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_female_weight_min'] ?>" id="breed_female_weight_min" name="breed_female_weight_min" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Weight Max(Kg)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_female_weight_max'] ?>" id="breed_female_weight_max" name="breed_female_weight_max" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Height Min(Cm)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_male_height_min'] ?>" id="breed_male_height_min" name="breed_male_height_min" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Height Max(Cm)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_male_height_max'] ?>" id="breed_male_height_max" name="breed_male_height_max" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Height Min(Cm)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_female_height_min'] ?>" id="breed_female_height_min" name="breed_female_height_min" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Height Max(Cm)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_female_height_max'] ?>" id="breed_female_height_max" name="breed_female_height_max" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Life Expectancy Min(Years)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_life_expectancy_min'] ?>" id="breed_life_expectancy_min" name="breed_life_expectancy_min" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Life Expectancy Max(Years)</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_life_expectancy_max'] ?>" id="breed_life_expectancy_max" name="breed_life_expectancy_max" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Litter Size Min</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_litter_size_min'] ?>" id="breed_litter_size_min" name="breed_litter_size_min" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Litter Size Max</label>
                      <input type="text" class="form-control" value="<?php echo $b['breed_litter_size_max'] ?>" id="breed_litter_size_max" name="breed_litter_size_max" placeholder="Origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Highlight</label> <br>
                      <textarea name="highlight" id="breed-highlight" cols="137" rows="5" class="form-control" required><?php echo $b['breed_highlight'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_highlight'] ?>" id="breed-highlight" name="highlight" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Appearance</label> <br>
                      <textarea name="appearance" id="breed-appearance" cols="137" rows="5" class="form-control"><?php echo $b['breed_appearance'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_appearance'] ?>" id="breed-appearance" name="appearance" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>History</label> <br>
                      <textarea name="history" id="breed-history" cols="137" rows="5" class="form-control" required><?php echo $b['breed_history'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_history'] ?>" id="breed-history" name="history" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Health & Care</label> <br>
                      <textarea name="health" id="breed-health-care" cols="137" rows="5" class="form-control" required><?php echo $b['breed_health_care']?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_health_care'] ?>" id="breed-health-care" name="health" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Living Condition</label> <br>
                      <textarea name="living" id="breed-living-condition" cols="137" rows="5" class="form-control" required><?php echo $b['breed_living_condition'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_living_condition'] ?>" id="breed-living-condition" name="living" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Exercise</label> <br>
                      <textarea name="exercise" id="breed-exercise" cols="137" rows="5" class="form-control" required><?php echo $b['breed_exercise'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_exercise'] ?>" id="breed-exercise" name="exercise" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Grooming</label> <br>
                      <textarea name="grooming" id="breed-grooming" cols="137" rows="5" class="form-control" required><?php echo $b['breed_grooming'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_grooming'] ?>" id="breed-grooming" name="grooming" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Pros</label> <br>
                      <textarea name="pros" id="breed-pros" cols="137" rows="5" class="form-control" required><?php echo $b['breed_pros'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_pros'] ?>" id="breed-pros" name="pros" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Cons</label> <br>
                      <textarea name="cons" id="breed-cons" cols="137" rows="5" class="form-control" required><?php echo $b['breed_cons'] ?></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_cons'] ?>" id="breed-cons" name="cons" placeholder="Origin" required/> -->
                  </div>

                <?php } ?>



                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="edit_button" value="Edit"/>
                </div>
 
              </form>
          </div>
    




      </div>
    </main>
  </div>
</div>












<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

      
  </body>
</html>