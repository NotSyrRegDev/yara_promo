<?php  
  $pageTitle = "تسجيل جديد";
  include 'init.php';
  ?>

  <?php

    $table = '';
if (isset($_POST['signup_user']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    
    if ( isset($_POST['refere_enterpise']) && !empty($_POST['refere_enterpise'])  ) {
        
        $usersTable = "users";
       
        $usersArray = user_grap_values();
         $arrayArgs = facility_grap_values();
      $table = 'facility_owners';
      $facility_table = 'facilities';

  
      singUpUser($usersArray , $usersTable , true , $_POST , $table  , true , $arrayArgs , $facility_table );


    }
    if ( isset($_POST['refere']) && !empty($_POST['refere'])  ) {
        
        if ($_POST['refere'] == 'consumer') {
            $table = 'consumers';
        }

        if ($_POST['refere'] == 'controller') {
            $table = 'controllers';
        }
        
        if ($_POST['refere'] == 'employee') {
            $table = 'employees';
        }

        if ($_POST['refere'] == 'enterpise') {
            $table = 'facility_owners';
        }

        if (!empty($table)) {

            $usersTable = 'users';
            $usersArray = user_grap_values();

            
         
            singUpUser($usersArray , $usersTable , true , $_POST , $table );
    
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
    <?php  
        if (!isset($_GET['postion']) || empty($_GET['postion'])  ) {

            redirect('login.php');
        }
    ?>
        <div class="main_page">

            <div class="container-big">
                <div class="action_form  bg_dark">
                <?php  
        include $templates . '/formErrors.php';
           ?>
           
                        <img src="<?= $imgAssets . "/icons/camera.png" ?>" alt="Camera" class="camera_form small_camera" >
                        <h1 class="focus_headline headline_sub" >Focus</h1>
                       
                      
                        <?php  
                        determine_signup();
                        ?>
                </div>
            </div>
    
        </div>
    </div>
   

 <!--------------END MAIN PAGE---------------->
