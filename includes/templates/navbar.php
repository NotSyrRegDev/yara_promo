<?php
$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
?>

<?php  

if (isset($_POST['logout'])) {
    $sessionDestory = array(
    'id' => 'id',
    'name' => 'username',
    'email' => 'email',
    'user_pic' => 'picture',
    'admin' => 'admin',
    );
    logoutUser($sessionDestory );
  }

?>
<div class="focus_app_header">
        <div class="right_div">
          
               
                <a href="home.php" class="click_pointer" >
                <div class="d-flex-c">
                <h1 class="yara_logo_headline">يرى</h1>
                    <img src="<?= $imgAssets . "/icons/camera.png" ?>" alt="Logo" class="mx-1 yara_logo" >
                    </div>
                </a>
         
            
        </div>
        <div class="left_div d-flex-c ">
        
        <div>
        <a href="<?= $previous ?>" class="click_pointer" >
            <img src="<?= $imgAssets . "/icons/left-arrow.png" ?>" alt="Left Arrow"   >
        </a>
        </div>

        <?php

        if (is_user_logged_in_web()) { ?>

<form method="POST" style="cursor:pointer;" >
                   
                   <button type="submit" name="logout" class="nav_btn ">Logout</button>
                   
                   </form>

                   <?php 
                    if ($_SESSION['admin'] === 1 ) {   ?>
                <a href="admin.php?manage=consumers&page=1" class="click_pointer" >
            <div class="nav_avatar_user d-flex-c f-wrap">
                
                <img src="<?= $_SESSION['user_pic'] ? BASE_URL . '/assets/uploads/' . $_SESSION['user_pic'] : $imgAssets . '/icons/avatar_consumer.jpg' ?>" alt="Consumer"  >
                      
                <p class="span_headline"  id="user_register_name"  > <?= $_SESSION['name'] ? $_SESSION['name'] : ''  ?> </h4>
                </div>
            </a>
                 <?php   }  
                    else { ?>
            <a href="profile.php" class="click_pointer" >
            <div class="nav_avatar_user d-flex-c f-wrap">
                <img src="<?= $_SESSION['user_pic'] ? BASE_URL . '/assets/uploads/' . $_SESSION['user_pic'] : $imgAssets . '/icons/avatar_consumer.jpg' ?>" alt="Consumer"  >
                <p class="span_headline" name="user_register_name" > <?= $_SESSION['name'] ? $_SESSION['name'] : ''  ?> </h4>
                </div>
            </a>
                   <?php }
                   ?>
           
      

      <?php  }

        else { ?>

        <div>
            <a href="login.php" class="click_pointer" >

                <button class="nav_btn">Login</button>
            </a>
        </div>
       <?php }
        ?>

       

    
       

        </div>
</div>