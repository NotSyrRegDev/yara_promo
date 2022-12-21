<?php  
  $pageTitle = "تعديل المنشئة  ";
  include 'init.php';

  

  $agencyId = isset($_GET['agencyId']) && is_numeric($_GET['agencyId']) ? intval($_GET['agencyId']) : 0;

  $selectedAgency = selectOne("facilities" , array(
    'id' => $agencyId
));

    if ($_SESSION['refere'] != $selectedAgency['owner_id'] && $_SESSION['admin'] != 1 && $_SESSION['admin'] != 4  ) {
        header('location: ' . $BASE_URL . 'home.php' );
    }

    if (isset($_GET['del'] ) && isset($_POST['delete_employee'])  && $_SERVER['REQUEST_METHOD'] == 'POST'  ) {

        $tablename = "facilities";
        $tableTwo = "users";
    
        $delete_id = deleteFromDb($tablename , $agencyId  , 'id');
       
        
    
        if ($delete_id) {
            header('location: ' . $BASE_URL . 'home.php' );
        }
        
      }
?>


<?php  

$table = "facilities";

if (isset($_POST['edit_agency']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    global $errors;
    $checkArrays = [
      'facility_name' => 'Facility Name' , 
      'number' => 'Facility Number' ,
        'commercial_register' => 'Facility Civil Registry',
        // 'activity' => 'Facility Activity',
        'city' => 'Facility City',
        'district' => 'Facility District',
        'street' => 'Facility Street',

      ];
// OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST

if (isset($_POST['activity'])) {
    if ($_POST['activity'] == 'opened') {
        $_POST['activity'] = 1;
    }
    else if ($_POST['activity'] == 'closed') {
        $_POST['activity'] = 0;
    }
    else {
        array_push($errors , "Not Valid Activity");
    }
}

 $errors = validatePost($_POST , $checkArrays , $table , 'number' );




   if (!empty($_FILES['image']['name'])) {
  
    $uploadFile_type = $_FILES['image']['type'];
    $allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');

    if (!in_array($uploadFile_type,$allowedTypes)) {
      array_push($errors , "File Type Is Not Allowed");
       }

    if( count($errors) == 0 ) {
      $image_name = time() . '_' . $_FILES['image']['name'];
   
      $destination = ROOT_PATH_MAIN . "/assets/uploads/" . $image_name;
       
      $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    }
     
    if ($result) {
   
       $_POST['image'] = $image_name;
    } 
   
}  else {
    unset($_POST['image']);
}



 if (count($errors) == 0) {
  
    global $conn;

    $ownerId = $_POST['id']; 
    
    $ownerId = is_numeric($ownerId) ? intval($ownerId) : 0 ; 
  
    if ($ownerId > 0) {

        if (isset($_POST['stars'] )  || !empty($_POST['stars'])  )
        {
            $rateScore = $_POST['stars'];

        $sql = "UPDATE $table SET gov_assessment = ? WHERE id = ?";
    
        $dataUpdated = [
           $rateScore , $agencyId
        ];
    
        $stat = exectureQuery($sql , $dataUpdated);  
        unset($_POST['stars']);
        }
          
       
        unset($_POST['edit_agency']);
      
      
       
      unset($_POST['id']);

    
       
        $post_id = update($table, $ownerId , $_POST , 'id');
        header("Refresh: 0");

        exit(); 
    } else {

        // header("location: " . BASE_URL . "home.php" ); 
        // exit(); 
    }
   
} 

   }



?>

<?php
include_loading();
?>

    
    <!--------------MAIN PAGE---------------->
    <div id="focus_app">

    <?php  
        include $templates . '/navbar.php';
    ?>

<div class="main_page container-mid">



<section class="info_section">
                <div class="mt-10"></div>
                <h1 class="main_headline">
                <?php  
                        if (isset($_GET['del'] ) && $_GET['del'] == true  ) {
                            echo 'Delete Agency Page';
                        }
                        else {
                            echo 'Edit Agency Page';
                        }
                        ?>    
                </h1>

                <section class="info_section">
                <div class="mt-5"></div>
              
    
                <form action="" method="POST" enctype="multipart/form-data" >
                <div class="owner_info">

                    <div class="owner_card_info">
                    <?php  
        include $templates . '/formErrors.php';
           ?>
                    <img src="<?= $selectedAgency['image'] ? BASE_URL . '/assets/uploads/' . $selectedAgency['image'] : 'https://i.pinimg.com/originals/cc/cb/56/cccb56f73f7a4b44554aaaabc62cffa4.jpg' ?>" alt="" class="avatar_owner">
                    <div class="input_contain_div">
                                <input type="file" name="image"  class=""  >
                               
                        </div>

                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Facility Name: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="facility_name" readonly  class="input_info" value="<?= $selectedAgency['facility_name'] ? $selectedAgency['facility_name'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

 

                           
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Facility Number: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="number" name="number" readonly class="input_info" value="<?= $selectedAgency['number'] ? $selectedAgency['number'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Commercial Register: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="number" name="commercial_register" readonly class="input_info" value="<?= $selectedAgency['commercial_register'] ? $selectedAgency['commercial_register'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Activity: </strong> </h3>
                                <div class="input_contain_div">
                                    <select name="activity" class="input_info"  >

                                    <option value="opened" class="input_option_value"> Opened </option>

                                    <option value="closed" class="input_option_value"> Closed </option>

                                    </select>
                                
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Location: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" readonly class="input_info" name="location" value="<?= $selectedAgency['location'] ? $selectedAgency['location'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Location Link: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" readonly class="input_info" name="location_link" value="<?= $selectedAgency['location_link'] ? $selectedAgency['location_link'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>City: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="city" readonly class="input_info" value="<?= $selectedAgency['city'] ? $selectedAgency['city'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>District: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" readonly name="district" class="input_info" value="<?= $selectedAgency['district'] ? $selectedAgency['district'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Street: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" readonly name="street" class="input_info" value="<?= $selectedAgency['street'] ? $selectedAgency['street'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Owner Name: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" readonly name="owner_name" class="input_info" value="<?= $selectedAgency['owner_name'] ? $selectedAgency['owner_name'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        <?php if ($_SESSION['admin'] === 4 || $_SESSION['admin'] === 1  ) {  ?>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Goverment Assessment: </strong> </h3>
                                <div class="mx-3 mt-1 d-flex-c star_consumer">
           
               
           <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"   onclick="stars_rating( event , 1)"  >
           <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating( event , 2)"  >
           <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating( event , 3)"  >
           <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating( event , 4)"    >
           <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating(  event, 5)"  >

           <input type="hidden"  name="stars" id="stars_value" value="0"  >
       </div>
                        <?php } ?>

                        <div class="d-flex-c f-sp f-wrap">

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera One Title: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" type="text" name="camera_one_title" readonly class="input_info" value="<?= $selectedAgency['camera_one_title'] ? $selectedAgency['camera_one_title'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera One Link: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" type="text" name="camera_one_link" readonly class="input_info" value="<?= $selectedAgency['camera_one_link'] ? $selectedAgency['camera_one_link'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>
                       

                        </div>

                        <div class="d-flex-c f-sp f-wrap">

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera Two Title: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" name="camera_two_title" type="text" readonly class="input_info" value="<?= $selectedAgency['camera_two_title'] ? $selectedAgency['camera_two_title'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera Two Link: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" name="camera_two_link" type="text" readonly class="input_info" value="<?= $selectedAgency['camera_two_link'] ? $selectedAgency['camera_two_link'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>
                       

                        </div>

                        <div class="d-flex-c f-sp f-wrap">

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera Three Title: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" name="camera_three_title" type="text" readonly class="input_info" value="<?= $selectedAgency['camera_three_title'] ? $selectedAgency['camera_three_title'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera Three Link: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" name="camera_three_link" type="text" readonly class="input_info" value="<?= $selectedAgency['camera_three_link'] ? $selectedAgency['camera_three_link'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>
                       

                        </div>

                        <div class="d-flex-c f-sp f-wrap">

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera Four Title: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" name="camera_four_title" type="text" readonly class="input_info" value="<?= $selectedAgency['camera_four_title'] ? $selectedAgency['camera_four_title'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>

                        <div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Camera Four Link: </strong> </h3>
                                <div class="input_contain_div">
                                <input style="width: 380px" name="camera_four_link" type="text" readonly class="input_info" value="<?= $selectedAgency['camera_four_link'] ? $selectedAgency['camera_four_link'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        </div>
                       

                        </div>

                            

                            
                       
                          
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Description: </strong> </h3>
                                <div class="input_contain_div">
                                <textarea type="text" name="description" readonly class="input_info" style="min-height: 15rem;"   > <?= $selectedAgency['description'] ? $selectedAgency['description'] : '' ?> </textarea>
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                        <input type="hidden" name="id" value="<?= $selectedAgency['id'] ? $selectedAgency['id'] : '' ?>"  >
                       
                        <?php  
                        if (isset($_GET['del'] )  ) {
                            echo ' <input name="delete_agency" type="submit" class="form_btn prev_bg" style="cursor: pointer; " value="Delete" ></button>';
                        }
                        else {
                            echo ' <input name="edit_agency" type="submit" class="form_btn" style="cursor: pointer; " value="Submit" ></button>';
                        }
                        ?>
                   
                    </div>
                   

                    </form>

                </div>

         
        </section>

                    
                </section>
</div>


<?php  
        include $templates . '/allowEdit.php';
           ?>

<script>
        let stars_icons = document.querySelectorAll('.star_icon');
      
      

    function stars_rating(  event , number ) {

      
       document.getElementById('stars_value').value = number;
        for (let i = 0; i < number; i++  ) {
         
            stars_icons[i].src = "<?= $imgAssets . '/icons/star_rate_consumer_solid.png' ?>";
        }
        event.target.src = "<?= $imgAssets . '/icons/star_rate_consumer_solid.png' ?>";
        
    }

    function reset_rating() {
        document.getElementById('stars_value').value = 0;
            for (let i = 0; i < stars_icons.length; i++  ) {
         
         stars_icons[i].src = "<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>";
     }
        }

   

</script>