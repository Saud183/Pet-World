<?php include('header.php'); ?>



<div class="container-fluid mb-5">
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

    

      <h2>Add New Breed</h2>
      <div class="table-responsive">
      

      <!-- Form to add new breed -->

          <div class="mx-auto container">
              <form id="create-form" enctype="multipart/form-data" method="POST" action="create_breed.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                
                <div class="form-group mt-2">
                <label>Name</label>
                    <input type="text" class="form-control" id="breed-name" name="name" required/>
                </div>

                  <div class="form-group mt-2">
                      <label>Origin</label>
                      <input type="text" class="form-control" id="breed-origin" name="origin" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Weight Min(Kg)</label>
                      <input type="text" class="form-control" id="breed_male_weight_min" name="breed_male_weight_min" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Weight Max(Kg)</label>
                      <input type="text" class="form-control" id="breed_male_weight_max" name="breed_male_weight_max" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Weight Min(Kg)</label>
                      <input type="text" class="form-control" id="breed_female_weight_min" name="breed_female_weight_min" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Weight Max(Kg)</label>
                      <input type="text" class="form-control" id="breed_female_weight_max" name="breed_female_weight_max" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Height Min(Cm)</label>
                      <input type="text" class="form-control" id="breed_male_height_min" name="breed_male_height_min" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Male Height Max(Cm)</label>
                      <input type="text" class="form-control" id="breed_male_height_max" name="breed_male_height_max" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Height Min(Cm)</label>
                      <input type="text" class="form-control" id="breed_female_height_min" name="breed_female_height_min" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Female Height Max(Cm)</label>
                      <input type="text" class="form-control" id="breed_female_height_max" name="breed_female_height_max" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Life Expectancy Min(Years)</label>
                      <input type="text" class="form-control" id="breed_life_expectancy_min" name="breed_life_expectancy_min" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Life Expectancy Max(Years)</label>
                      <input type="text" class="form-control" id="breed_life_expectancy_max" name="breed_life_expectancy_max" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Litter Size Min</label>
                      <input type="text" class="form-control" id="breed_litter_size_min" name="breed_litter_size_min" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Litter Size Max</label>
                      <input type="text" class="form-control" id="breed_litter_size_max" name="breed_litter_size_max" required/>
                  </div>

                  <div class="form-group mt-2">
                      <label>Highlight</label> <br>
                      <textarea name="highlight" id="breed-highlight" cols="137" rows="5" class="form-control" required></textarea>

                  </div>

                  <div class="form-group mt-2">
                      <label>Appearance</label> <br>
                      <textarea name="appearance" id="breed-appearance" cols="137" rows="5" class="form-control"></textarea>
    
                  </div>

                  <div class="form-group mt-2">
                      <label>History</label> <br>
                      <textarea name="history" id="breed-history" cols="137" rows="5" class="form-control" required></textarea>
       
                  </div>

                  <div class="form-group mt-2">
                      <label>Health & Care</label> <br>
                      <textarea name="health" id="breed-health-care" cols="137" rows="5" class="form-control" required></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_health_care'] ?>" id="breed-health-care" name="health" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Living Condition</label> <br>
                      <textarea name="living" id="breed-living-condition" cols="137" rows="5" class="form-control" required></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_living_condition'] ?>" id="breed-living-condition" name="living" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Exercise</label> <br>
                      <textarea name="exercise" id="breed-exercise" cols="137" rows="5" class="form-control" required></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_exercise'] ?>" id="breed-exercise" name="exercise" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Grooming</label> <br>
                      <textarea name="grooming" id="breed-grooming" cols="137" rows="5" class="form-control" required></textarea>
                      <!-- <input type="text" class="form-control" value="<?php echo $b['breed_grooming'] ?>" id="breed-grooming" name="grooming" placeholder="Origin" required/> -->
                  </div>

                  <div class="form-group mt-2">
                      <label>Pros</label> <br>
                      <textarea name="pros" id="breed-pros" cols="137" rows="5" class="form-control" required></textarea>

                  </div>

                  <div class="form-group mt-2">
                      <label>Cons</label> <br>
                      <textarea name="cons" id="breed-cons" cols="137" rows="5" class="form-control" required></textarea>
          
                  </div>

                  <div class="form-group mt-2">
                    <label>Image</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Image" required/>
                </div>

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="create_breed" value="Create"/>
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
