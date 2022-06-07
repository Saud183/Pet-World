<?php

    include('../server/connection.php');

    if(isset($_POST['create_breed'])){

        
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

        $image = $_FILES['image']['tmp_name'];
        //$file_name = $_FILES['image']['name'];

        $image_name = $name."1.jpg";

        move_uploaded_file($image,"../assets/images/breed/".$image_name);

        //create a new entry
        $stmt = $conn->prepare("INSERT INTO breed(breed_name,breed_image,breed_origin,breed_male_weight_min,breed_male_weight_max, breed_female_weight_min,breed_female_weight_max,breed_male_height_min,breed_male_height_max,breed_female_height_min,breed_female_height_max,breed_life_expectancy_min,breed_life_expectancy_max,breed_litter_size_min,breed_litter_size_max,breed_highlight,breed_appearance,breed_history,breed_health_care, breed_living_condition,breed_exercise,breed_grooming,breed_pros,breed_cons) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param('ssssssssssssssssssssssss',$name,$image_name,$origin,$male_w_min,$male_w_max,$female_w_min,$female_w_max,$male_h_min,$male_h_max,$female_h_min,$female_h_max,$life_expectancy_min,$life_expectancy_max,$litter_size_min,$litter_size_max,$highlight,$appearance,$history,$health,$living,$exercise,$grooming,$pros,$cons);

        if($stmt->execute()){
            header('location: breed.php?breed_created=Breed has been added successfully');
        }else{
            header('location: breed.php?breed_failed=Error occured, try again');
        }

    }


?>