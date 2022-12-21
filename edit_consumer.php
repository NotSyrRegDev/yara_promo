<?php  
  $pageTitle = "تعديل موظف حكومي ";
  include 'init.php';


  

  $consumerId = isset($_GET['consId']) && is_numeric($_GET['consId']) ? intval($_GET['consId']) : 0;
  if ($_SESSION['refere'] != $consumerId && $_SESSION['admin'] != 1 && $_SESSION['admin'] != 4  ) {
    header('location: ' . $BASE_URL . 'home.php' );
}

  $selectedConsumer = selectOne("consumers" , array(
    'id' => $consumerId
));

  if (isset($_GET['del'] ) && isset($_POST['delete_consumer'])  && $_SERVER['REQUEST_METHOD'] == 'POST'  ) {

    $tablename = "consumers";
    $tableTwo = "users";

    $delete_id = deleteFromDb($tablename , $consumerId  , 'id');
   
    $delete_user = deleteFromDb($tableTwo , $consumerId  , 'refere_id');

    if ($delete_user) {
        header('location: ' . $BASE_URL . 'home.php' );
    }
    
  }

    
 



?>

<?php  

$table = "consumers";

if (isset($_POST['edit_consumer']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    global $errors;
    $checkArrays = [
      'name' => 'Consumer Name' , 
      'email' => 'Consumer Email' ,
        'civil_registry' => 'Consumer Civil Registry',
        'phone_number' => 'Consumer Phone Number',

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

    $consumerId = $_POST['id']; 
    
    $consumerId = is_numeric($consumerId) ? intval($consumerId) : 0 ; 
  
    if ($consumerId > 0) {
    
        unset($_POST['edit_consumer']);

       
      unset($_POST['id']);
      if (isset($_POST['password'])) {

        $arrayArgs = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' =>  sha1($_POST['password']),
        ];

        $user_id = update("users", $consumerId , $arrayArgs , 'refere_id');
       
   
        unset($_POST['password']);
      }

       
        $post_id = update($table, $consumerId , $_POST , 'id');
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
                            echo 'Delete Consumer Page';
                        }
                        else {
                            echo 'Edit Consumer Page';
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

                    <img src="<?= $selectedConsumer['image'] ? BASE_URL . '/assets/uploads/' . $selectedConsumer['image'] : 'https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png'
                     ?>" alt="" class="avatar_owner">
                    <div class="input_contain_div">
                                <input type="file" name="image"  class=""  >
                               
                        </div>
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Name: </strong> </h3>
                                <div class="input_contain_div">
                                <input name="name" type="text" readonly  class="input_info" value="<?= $selectedConsumer['name'] ? $selectedConsumer['name'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Civil Registery: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="civil_registry" readonly class="input_info" value="<?= $selectedConsumer['civil_registry'] ? $selectedConsumer['civil_registry'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                            
                       
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Email: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="email" readonly class="input_info" value="<?= $selectedConsumer['email'] ? $selectedConsumer['email'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Phone Number: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="phone_number" readonly class="input_info" value="+<?= $selectedConsumer['phone_number'] ? $selectedConsumer['phone_number'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Date: </strong> </h3>
                                <div class="input_contain_div">
                                <input type="text" name="date" readonly class="input_info" value="<?= $selectedConsumer['date'] ? $selectedConsumer['date'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>About: </strong> </h3>
                                <div class="input_contain_div">
                                <textarea type="text" name="about" readonly class="input_info" style="min-height: 15rem;"   ><?= $selectedConsumer['about'] ? $selectedConsumer['about'] : '' ?> </textarea>
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                        <input type="hidden" name="id" value="<?= $selectedConsumer['id'] ? $selectedConsumer['id'] : '' ?>"  >

                        <?php  
                        if (isset($_GET['del'] )  ) {
                            echo ' <input name="delete_consumer" type="submit" class="form_btn prev_bg" style="cursor: pointer; " value="Delete" ></button>';
                        }
                        else {
                            echo ' <input name="edit_consumer" type="submit" class="form_btn" style="cursor: pointer; " value="Submit" ></button>';
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