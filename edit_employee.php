<?php  
  $pageTitle = "تعديل موظف حكومي ";
  include 'init.php';

  $employeeId = isset($_GET['empId']) && is_numeric($_GET['empId']) ? intval($_GET['empId']) : 0;
  
  if ($_SESSION['refere'] != $employeeId && $_SESSION['admin'] != 1 && $_SESSION['admin'] != 4   ) {
    header('location: ' . $BASE_URL . 'home.php' );
}


 
  $selectedEmployee = selectOne("employees" , array(
    'id' => $employeeId
));

  if (isset($_GET['del'] ) && isset($_POST['delete_employee'])  && $_SERVER['REQUEST_METHOD'] == 'POST'  ) {

    $tablename = "employees";
    $tableTwo = "users";

    $delete_id = deleteFromDb($tablename , $employeeId  , 'id');
   
    $delete_user = deleteFromDb($tableTwo , $employeeId  , 'refere_id');

    if ($delete_user) {
        header('location: ' . $BASE_URL . 'home.php' );
    }
    
  }

    
  


?>

<?php  

$table = "employees";

if (isset($_POST['edit_employee']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    global $errors;
    $checkArrays = [
      'name' => 'Employee Name' , 
      'email' => 'Employee Email' ,
        'civil_registry' => 'Employee Civil Registry',
        'phone_number' => 'Employee Phone Number',
        'postion' => 'Employee Postion ',

      ];
// OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
 $errors = validatePost($_POST , $checkArrays , $table , 'email' );
    
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

    $employId = $_POST['id']; 
    
    $employId = is_numeric($employId) ? intval($employId) : 0 ; 
  
    if ($employId > 0) {
    
        unset($_POST['edit_employee']);

       
      unset($_POST['id']);
       
        $post_id = update($table, $employId , $_POST , 'id');
        header("Refresh: 0");

        exit(); 
    } else {

        header("location: " . BASE_URL . "home.php" ); 
        exit(); 
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
                            echo 'Delete Employee Page';
                        }
                        else {
                            echo 'Edit Employee Page';
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

                    <img src="<?= $selectedEmployee['image'] ? BASE_URL . '/assets/uploads/' . $selectedEmployee['image'] : 'https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/man5-512.png' ?>" alt="" class="avatar_owner">
                    <div class="input_contain_div">
                                <input type="file" name="image"  class=""  >
                               
                        </div>
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Name: </strong> </h3>
                                <div class="input_contain_div">
                                <input name="name" type="text" readonly  class="input_info" value="<?= $selectedEmployee['name'] ? $selectedEmployee['name'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Civil Registery: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="civil_registry" readonly class="input_info" value="<?= $selectedEmployee['civil_registry'] ? $selectedEmployee['civil_registry'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            
                       
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Email: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="email" readonly class="input_info" value="<?= $selectedEmployee['email'] ? $selectedEmployee['email'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Phone Number: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="phone_number" readonly class="input_info" value="+<?= $selectedEmployee['phone_number'] ? $selectedEmployee['phone_number'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Postion: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="postion" readonly class="input_info" value="<?= $selectedEmployee['postion'] ? $selectedEmployee['postion'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>About: </strong> </h3>
                                <div class="input_contain_div">
                                <textarea type="text" name="about" readonly class="input_info" style="min-height: 15rem;"   > <?= $selectedEmployee['about'] ? $selectedEmployee['about'] : '' ?> </textarea>
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                        <input type="hidden" name="id" value="<?= $selectedEmployee['id'] ? $selectedEmployee['id'] : '' ?>"  >

                        <?php  
                        if (isset($_GET['del'] )  ) {
                            echo ' <input name="delete_employee" type="submit" class="form_btn prev_bg" style="cursor: pointer; " value="Delete" ></button>';
                        }
                        else {
                            echo ' <input name="edit_employee" type="submit" class="form_btn" style="cursor: pointer; " value="Submit" ></button>';
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