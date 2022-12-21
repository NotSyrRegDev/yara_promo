<?php  
  $pageTitle = "الصفحة الرئيسية";
  include 'init.php';
  ?>

  <style>
     #particles-js {
            background:linear-gradient(rgba(0,0,0,0.8) , rgba(0,0,0,0.4))  , url("<?= $imgAssets . '/background/hero-background.jpg' ?>");
        }
  </style>
  
  <div id="particles-js">
        <div class="particles_content">
        
          <a href="home.php" class="click_pointer" >
          <div class="single_system_div box">
                <img src="<?= $imgAssets . '/icons/camera.png' ?>" alt="" class="image_system">
                <h1 class="headline_system">Focus</h1>
             
            </div>
          </a>
           
          <a href="home.php" class="click_pointer" >
          <div class="single_system_div box">
                <img src="<?= $imgAssets . '/icons/systems.png' ?>" alt="" class="image_system">
                <h1 class="headline_system">Another System</h1>
             
            </div>
        </a>
           
        <a href="home.php" class="click_pointer" >
            <div class="single_system_div box">
                <img src="<?= $imgAssets . '/icons/operational-system.png' ?>" alt="" class="image_system">
                <h1 class="headline_system">Anothr System</h1>
             
            </div>
      </a>

        </div>
    </div>

    <script src="<?= $jsAssets . '/particles.js' ?>"></script>
    <script src="<?= $jsAssets . '/app.js' ?>"></script>
 