<?php  
  $pageTitle = "تعديل مدير مونشئة  ";
  include 'init.php';

  

  $ownerId = isset($_GET['ownerId']) && is_numeric($_GET['ownerId']) ? intval($_GET['ownerId']) : 0;

  if ($_SESSION['refere'] != $ownerId && $_SESSION['admin'] != 1 && $_SESSION['admin'] != 4   ) {
    header('location: ' . $BASE_URL . 'home.php' );
}

  $selectedOwner = selectOne("facility_owners" , array(
      'id' => $ownerId
  ));

  if (isset($_GET['del'] ) && isset($_POST['delete_owner'])  && $_SERVER['REQUEST_METHOD'] == 'POST'  ) {

    $tablename = "facility_owners";
    $tableTwo = "users";

    $delete_id = deleteFromDb($tablename , $employeeId  , 'id');
   
    $delete_user = deleteFromDb($tableTwo , $employeeId  , 'refere_id');

    if ($delete_user) {
        header('location: ' . $BASE_URL . 'home.php' );
    }
    
  }

?>

<?php  

$table = "facility_owners";

if (isset($_POST['edit_owner']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    global $errors;
    $checkArrays = [
      'name' => 'Owner Name' , 
      'email' => 'Owner Email' ,
        'civil_registry' => 'Owner Civil Registry',
        'phone_number' => 'Owner Phone Number',
        'postion' => 'Owner Postion ',
        'date' => 'Owner Date',
        'password' => 'Owner Password' ,
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

       $sql = "UPDATE users SET image  = ? WHERE id = ?";

       $dataUpdated = [
        $_POST['image'] , $_SESSION['id']
       ];
   
       $stat = exectureQuery($sql , $dataUpdated);    
    } 
   
}  else {
    unset($_POST['image']);
}


 if (count($errors) == 0) {
  
    global $conn;

    $ownerId = $_POST['id']; 
    
    $ownerId = is_numeric($ownerId) ? intval($ownerId) : 0 ; 
  
    if ($ownerId > 0) {
    
        unset($_POST['edit_owner']);

       
      unset($_POST['id']);

      if (isset($_POST['password'])) {

        $arrayArgs = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' =>  sha1($_POST['password']),
        ];

        $user_id = update("users", $ownerId , $arrayArgs , 'refere_id');
       
   
        unset($_POST['password']);
      }
    
       
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
                            echo 'Delete Owner Page';
                        }
                        else {
                            echo 'Edit Owner Page';
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
                    <img src="<?= $selectedOwner['image'] ? BASE_URL . '/assets/uploads/' . $selectedOwner['image'] : 'https://cdn1.iconfinder.com/data/icons/human-resources-1-6/128/86-512.png' ?>" alt="" class="avatar_owner">
                    <div class="input_contain_div">
                                <input type="file" name="image"  class=""  >
                               
                        </div>
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Name: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="name" readonly  class="input_info" value="<?= $selectedOwner['name'] ? $selectedOwner['name'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Civil Registery: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="number" name="civil_registry" readonly class="input_info" value="<?= $selectedOwner['civil_registry'] ? $selectedOwner['civil_registry'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            
                       
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Email: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="email" readonly class="input_info" value="<?= $selectedOwner['email'] ? $selectedOwner['email'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>User Password: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="password" name="password" readonly class="input_info" value="" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Phone Number: </strong> </h3>
                                <div class="input_contain_div">
                                    
                                <input type="number" name="phone_number" readonly class="input_info" value="<?= $selectedOwner['phone_number'] ? $selectedOwner['phone_number'] : '' ?>" >

                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Postion: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="postion" readonly class="input_info" value="<?= $selectedOwner['postion'] ? $selectedOwner['postion'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">

                                            </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Date: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="date" name="date" readonly class="input_info" value="<?= $selectedOwner['date'] ? $selectedOwner['date'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>About: </strong> </h3>
                                <div class="input_contain_div">
                                <textarea name="about" type="text" readonly class="input_info" style="min-height: 15rem;"   > 
                                <?= $selectedOwner['about'] ? $selectedOwner['about'] : '' ?>
                             </textarea>
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                       
                      <input type="hidden" name="id" value="<?= $selectedOwner['id'] ? $selectedOwner['id'] : '' ?>"  >
                                    
                      <?php  
                        if (isset($_GET['del'] )  ) {
                            echo ' <input name="delete_owner" type="submit" class="form_btn prev_bg" style="cursor: pointer; " value="Delete" ></button>';
                        }
                        else {
                            echo ' <input name="edit_owner" type="submit" class="form_btn" style="cursor: pointer; " value="Submit" ></button>';
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