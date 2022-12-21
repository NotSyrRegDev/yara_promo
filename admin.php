<?php  
  $pageTitle = "ادمن يرى";
  include 'init.php';

  if ($_SESSION['admin'] != 4 && $_SESSION['admin'] != 1  ) {  
    header('location: ' . $BASE_URL . 'home.php' );
   }
?>

<?php
include_loading();
?>



<?php  


if(isset($_GET['page'])) {
    if (!(intval($_GET['page']))) {
        header("location: " . BASE_URL . "home.php"); 
        exit();  
    }
  
    if ($_GET['page'] == 0) {
        header("location: " . BASE_URL . "home.php"); 
        exit();  
    }
  }
  
  if (!isset($_GET['page']) || !isset($_GET['manage'])  ) {
    header("location: " . BASE_URL . "home.php"); 
    exit();  
  }

    

?>
    
    <!--------------MAIN PAGE---------------->
    <div id="focus_app">

    <?php  
        include $templates . '/navbar.php';
    ?>

    <div class="main_page container-sm">
    
    <div class="mt-10"></div>

    <h1 class="main_headline">Remote Area</h1>
    <a href="remote.php">
    <button class="form_btn"  style="width: 100%" >Visit Remote Area</button>
    </a>

<div class="mt-5"></div>

    <section class="camera_section">

    <h1 class="main_headline">Admin Area</h1>

    <div class="mt-5"></div>

    <div class="container_sections">
        <div class="d-felx-c f-sp f-wrap mt-1">


       
            <div class="single_camera_item"  >
            <a href="admin.php?manage=consumers&page=<?= $_GET['page'] ?>">
                <img src="<?= $imgAssets . '/icons/admin.png' ?>" alt="">
                <h1 class="main_subheadline"> Consumers </h1>
                </a>
            </div>
          

            <div class="single_camera_item"   >
            <a href="admin.php?manage=controllers&page=<?= $_GET['page'] ?>">
                <img src="<?= $imgAssets . '/icons/admin.png' ?>" alt="">
                <h1 class="main_subheadline"> Controllers </h1>
                </a>
            </div>
        </div>
        <div class="d-felx-c f-sp f-wrap mt-1"  >

            <div class="single_camera_item"   >
            <a href="admin.php?manage=employees&page=<?= $_GET['page'] ?>">
                <img src="<?= $imgAssets . '/icons/admin.png' ?>" alt="">
                <h1 class="main_subheadline"> Employees </h1>
            </a>
            </div>

            <div class="single_camera_item"   >
            <a href="admin.php?manage=owners&page=<?= $_GET['page'] ?>">
                <img src="<?= $imgAssets . '/icons/admin.png' ?>" alt="">
                <h1 class="main_subheadline"> Facility Owners </h1>
            </a>
            </div>

            <div class="single_camera_item"   >
            <a href="admin.php?manage=facilities&page=<?= $_GET['page'] ?>">
                <img src="<?= $imgAssets . '/icons/admin.png' ?>" alt="">
                <h1 class="main_subheadline"> Facilities </h1>
            </a>
            </div>
        </div>
    </div>


</section>


    <section class="controlling_section">
        <?php  
        switch ($_GET['manage']) {
            
            case 'consumers':
                include $templates . '/admin_consumers.php';
                break;

            case 'controllers':
                include $templates . '/admin_controllers.php';
                break;

            case 'employees':
                include $templates . '/admin_employees.php';
                break;

            case 'owners':
                include $templates . '/admin_owners.php';
                break;

            case 'facilities':
                include $templates . '/admin_facilities.php';
                break;

            default:
                include $templates . '/admin_consumers.php';
                break;
        }
        ?>
    


    </section>

    </div>

    </div>
    <!--------------END MAIN PAGE---------------->