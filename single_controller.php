<?php  
  $pageTitle = "صفحة مراقب ميداني";
  include 'init.php';

  
  $controllerId = isset($_GET['conId']) && is_numeric($_GET['conId']) ? intval($_GET['conId']) : 0;

  $selectedController = selectOne("controllers" , array(
      'id' => $controllerId
  ));


?>

<?php  

  $employies = selectAll('employees');

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
                <h1 class="main_headline">Controller Page : <?= $selectedController['name'] ? $selectedController['name'] : '' ?> </h1>

                
                <section class="owner_page_seciton">
                    <div class="grid_owner">
                        <div class="">

                            <div class="owner_info">

                                <div class="owner_card_info">
                                    <img src="<?= $selectedController['image'] ? $selectedController['image'] : '' ?>" alt="" class="avatar_owner">
                                    <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> <span> <strong>Name: </strong> <?= $selectedController['name'] ? $selectedController['name'] : '' ?> </span></h3>
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span> <strong>Civil Registery:</strong> <?= $selectedController['civil_registry'] ? $selectedController['civil_registry'] : '' ?> </span> </h3>

                                   
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                                    </div> <span> <strong>Email:</strong> <?= $selectedController['email'] ? $selectedController['email'] : '' ?> </span> </h3>
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span><strong>Phone Number:</strong> +<?= $selectedController['phone_number'] ? $selectedController['phone_number'] : '' ?></span> </h3>
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                                    </div>  <span> <strong>Postion:</strong> Controller </span> </h3>
                                    <p class="main_p_small mt-1">
                                        <strong>About:</strong> 
                                        <?= $selectedController['about'] ? $selectedController['about'] : '' ?>
                                    </p>
                                   
                                    <a href="edit_controller.php?conId=<?= $_SESSION['refere'] ?>">
                                    <button class="action_owner">Edit Info</button>
                                    </a>
                                </div>
                               

                               

                            </div>

                         

  

                        </div>
                    </div>
                </section>
                <div class="mt-8"></div>

                
            <section class="employies_section">

            <div class="mt-10"></div>

            <h1 class="main_headline"> Employees </h1>

            <div class="grid_employies mt-5">

            <div class="g-col-3">
            <?php  

            foreach ( $employies as $emp )
            { ?>
                  <a href="single_employee.php?empId=<?php echo $emp['id'] ?>" class="click_pointer" >
                <div class="owner_info">
              
            <div class="owner_card_info">
            <img src="   <?= $emp['image'] ? $emp['image'] : '' ?>" alt="" class="avatar_owner">
            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> <span> <strong>Name: </strong>  <?= $emp['name'] ? $emp['name'] : '' ?> </span></h3>
            <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span> <strong>Civil Registery:</strong> <?= $emp['civil_registry'] ? $emp['civil_registry'] : '' ?> </span> </h3>

           
            <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

            </div> <span> <strong>Email:</strong>  <?= $emp['email'] ? $emp['email'] : '' ?> </span> </h3>
            <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span><strong>Phone Number:</strong> +<?= $emp['phone_number'] ? $emp['phone_number'] : '' ?>  </span> </h3>
            <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

            </div>  <span> <strong>Postion:</strong> <?= $emp['postion'] ? $emp['postion'] : '' ?> </span> </h3>
            <p class="main_p_small mt-1">
                <strong>About:</strong> 
                <?= $emp['about'] ? $emp['about'] : '' ?>
            </p>
            </div>
            
            </div>
            </a>
           <?php }

            ?>



            </div>

        </div>

        </section>

        <div class="mt-8"></div>

           
                <section class="agencies_section">

                <?php  
        include $templates . '/search-div.php';
    ?>
    
                <div class="grid_cards_home ">
            <div class="mt-5"></div>
            <div class="g-col-3">
                <?php  
                 include $templates . '/agencies_search.php';
                ?>

                
            </div>
            </div>
                    
                </section>
</div>