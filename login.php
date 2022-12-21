<?php  
  $pageTitle = "تسجيل الدخول";
  include 'init.php';

  guestsOnly();
 
  if (isset($_POST['login_user']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
      $checkConds = array(
        'email' => 'User Email',
        'password' => 'User Password'
      );
    signInUser($_POST , $checkConds , 'users' , 'email');
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
            
        <div class="main_page">
        <div class="mt-6"></div>
            <div class="container-big">
                <div class="action_form ">
                <?php  
        include $templates . '/formErrors.php';
           ?>
                        <img src="<?= $imgAssets . '/icons/camera.png' ?>" alt="Camera" class="camera_form" >
                        <h1 class="focus_headline" >Focus</h1>
                      
                        <form action="" method="POST" >
                   
                        <input type="text" name="email" placeholder="Email"  class="input_form">
    
                        <input type="password" name="password" placeholder="Password"  class="input_form">

                        <input name="login_user" type="submit" class="btn_form_action" value="Log In" ></button>
                       
                        
                        <a href="signup.php?postion=signup" class="click_pointer" >
                            <div class="btn_new_action">Create new account ?</div>
                        </a>
                       
                    
                        </form>
                </div>
            </div>
    
        </div>
    </div>
   

 <!--------------END MAIN PAGE---------------->

    
