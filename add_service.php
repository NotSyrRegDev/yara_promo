<?php  
  $pageTitle = "اضافة خدمات للمنشئة";
  include 'init.php';

  

  $ownerId = isset($_GET['entId']) && is_numeric($_GET['entId']) ? intval($_GET['entId']) : 0;

  if ($_SESSION['refere'] != $ownerId || $_SESSION['admin'] == 1   ) {
    header('location: ' . $BASE_URL . 'home.php' );
}

    $facilityTable = "facilities";
    $agencyId = selectAllOneCol($facilityTable , 'id' , [
        'owner_id' => $_SESSION['refere'] 
    ]); 


?>

    <?php  

    
    if (isset($_POST['add_service'])) {

        $table = "agency_services";
        global $errors;
        $checkArrays = [
            'name' => 'Service Name' , 
            'description' => 'Service Description' ,
            ];
    // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
    $errors = validatePost($_POST , $checkArrays , $table , 'name'  );
   
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
        unset($_POST['add_service']);


        $service_id = create($table, $_POST);

    header("location: " . BASE_URL . "home.php"); 
    exit();    
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
                <h1 class="main_headline">Add A Service</h1>
    

                <div class="owner_info">
                    
                    <form action="" method="POST" enctype="multipart/form-data" >

                    
                    <div class="owner_card_info">
                    <?php  
        include $templates . '/formErrors.php';
           ?>

                        
                        <div class="single_form_add_service">

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Service Name: </strong> </h3>
                               
                                <input type="text" name="name"  class="input_info" value="" >
                        </div>
                        <div class="single_form_add_service">

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Service Description: </strong> </h3>
                               
                                <input type="text" name="description" style="height: 8rem"  class="input_info"  >
                        </div>

                        <div class="single_form_add_service">

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Service Image: </strong> </h3>
                               
                                <input type="file" accept="image/png, image/gif, image/jpeg" name="image"  class="input_info"  >
                        </div>

                        <input type="hidden" name="owner_id" value="<?= $_SESSION['refere'] ?>" >
                        <input type="hidden" name="agency_id" value="<?= $agencyId[0]['id'] ?>" >

                         <input name="add_service" type="submit" class="form_btn" value="Submit" >
                    
                    </div>
                    </form>

                   

                </div>

         
            </section>

                    
</div>
</div>

<?php  
        include $templates . '/allowEdit.php';
           ?>