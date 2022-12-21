<?php  
  $pageTitle = "صفحة الملف الشخصي";
  include 'init.php';


  $tablePostion = '';

  if ($_SESSION['admin'] === 1 ) { 
    header('location: ' . $BASE_URL . 'home.php' );
  }

  if ($_SESSION['admin'] === 2 ) { 
    $tablePostion = 'consumers';
  }

  if ($_SESSION['admin'] === 3 ) { 
    $tablePostion = 'controllers';
  }

  if ($_SESSION['admin'] === 4 ) { 
    $tablePostion = 'employees';
  }

  if ($_SESSION['admin'] === 5 ) { 
    $tablePostion = 'facility_owners';
  }

  $selectedProfile = selectOne($tablePostion , array(
    'id' => $_SESSION['refere']
));



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
    <h1 class="main_headline">Profile Page : <?= $selectedProfile['name'] ? $selectedProfile['name'] : '' ?> </h1>

    <section class="owner_page_seciton">
        <div class="grid_owner">
            <div class="">

                <div class="owner_info">

                    <div class="owner_card_info">
                        <img src="../assets/images/icons/avatar.png" alt="" class="avatar_owner">
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> <span> <strong>Name: </strong>  <?= $selectedProfile['name'] ? $selectedProfile['name'] : '' ?> </span></h3>

                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span> <strong>Civil Registery:</strong> <?= $selectedProfile['civil_registry'] ? $selectedProfile['civil_registry'] : '' ?> </span> </h3>

                       
                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                        </div> <span> <strong>Email:</strong> <?= $selectedProfile['email'] ? $selectedProfile['email'] : '' ?>  </span> </h3>
                      
                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div>

                        <span><strong>Phone Number:</strong> +<?= $selectedProfile['phone_number'] ? $selectedProfile['phone_number'] : '' ?></span> </h3>
                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                        </div>  <span> <strong>Postion:</strong> <?= $_SESSION['position']  ?></span> </h3>

                        <p class="main_p_small mt-1">
                                        <strong>About:</strong> 
                                        <?= $selectedProfile['about'] ? $selectedProfile['about'] : '' ?>
                                    </p>
                       
                       
                        <?php 

                        if ($_SESSION['admin'] === 3 ) { ?>
                        
                        <a href="edit_controller.php?conId=<?= $_SESSION['refere'] ?>">
                                    <button class="action_owner">Edit Info</button>
                                    </a>

                        <a href="single_controller.php?conId=<?= $_SESSION['refere'] ?>" > 
                            <button class="action_owner">Go To Your Controller Page </button>
                        </a>
                        <?php  }

                        if ($_SESSION['admin'] === 4 ) { ?>
                         <a href="edit_employee.php?empId=<?= $_SESSION['refere'] ?>">
                                    <button class="action_owner">Edit Info</button>
                                    </a>

                        <a href="single_employee.php?empId=<?= $_SESSION['refere'] ?>" > 
                     <button class="action_owner">Go To Your Employee Page </button>
                     </a>

                     <a href="admin.php?manage=consumers&page=1" > 
               <button class="action_owner">Go To Your Admin Page </button>
               </a>
                      <?php  }

                        if ($_SESSION['admin'] === 5 ) { ?>
                           <a href="edit_owner.php?ownerId=<?= $_SESSION['refere'] ?>">
                                    <button class="action_owner">Edit Info</button>
                          </a>
                          
                        <a href="single_owner.php?ownerId=<?= $_SESSION['refere'] ?>&page=1" >
                      <button class="action_owner">Go To Your Owner Page </button>
                      </a>
                      <?php  }

                        if ($_SESSION['admin'] === 1 ) { ?>
                        <a href="admin.php?manage=consumers&page=1" > 
               <button class="action_owner">Go To Your Admin Page </button>
               </a>
                      <?php  }


                        ?>
                       
                    </div>
                   

                   

                </div>

             



            </div>
        </div>
    </section>
    <div class="mt-5"></div>


</div>

</div>