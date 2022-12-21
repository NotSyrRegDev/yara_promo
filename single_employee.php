<?php  
  $pageTitle = "صفحة موظف حكومي ";
  include 'init.php';

  $employeeId = isset($_GET['empId']) && is_numeric($_GET['empId']) ? intval($_GET['empId']) : 0;

  $selectedEmployee = selectOne("employees" , array(
      'id' => $employeeId
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
                <h1 class="main_headline">Employee Page</h1>

                
                <section class="owner_page_seciton">
                    <div class="grid_owner">
                        <div class="">

                            <div class="owner_info">

                                <div class="owner_card_info">
                                    <img src="../assets/images/icons/avatar.png" alt="" class="avatar_owner">
                                    <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> <span> <strong>Name: </strong> Moaaz Alfifi</span></h3>
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span> <strong>Civil Registery:</strong> 20124412 </span> </h3>

                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span> <strong>Agency Name:</strong> The Produc </span> </h3>
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                                    </div> <span> <strong>Email:</strong> mooaz@gmail.com</span> </h3>
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span><strong>Phone Number:</strong> +9665534334</span> </h3>
                                    <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                                    </div>  <span> <strong>Postion:</strong> +9665534334</span> </h3>
                                    <p class="main_p_small mt-1">
                                        <strong>About:</strong> 
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores ipsa laboriosam .
                                    </p>

                                    <a href="edit_employee.php?empId=<?= $_SESSION['refere'] ?>">
                                    <button class="action_owner">Edit Info</button>
                                    </a>
                                    <?php 
                                      if ($_SESSION['admin'] === 3 ) {  ?>
                                 <button class="action_owner">Activate Employee</button>
                                      <?php }
                                    ?>
                                   
                                </div>
                               

                               

                            </div>

                         

  

                        </div>
                    </div>
                </section>
                <div class="mt-8"></div>
                <?php  
        include $templates . '/search-div.php';
    ?>

                <section class="agencies_section">

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