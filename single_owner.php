<?php  
  $pageTitle = "صفحة مدير المونشئة";
  include 'init.php';

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
  
  if (!isset($_GET['page'])) {
    header("location: " . BASE_URL . "home.php"); 
    exit();  
  }
  
  $ownerId = isset($_GET['ownerId']) && is_numeric($_GET['ownerId']) ? intval($_GET['ownerId']) : 0;

  $selectedOwner = selectOne("facility_owners" , array(
      'id' => $ownerId
  ));

  $selectedAgency = selectOne("facilities" , array(
      'id' => $selectedOwner['agency_refere']
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
    <h1 class="main_headline">Agency Owner Page</h1>

    <section class="owner_page_seciton">
        <div class="grid_owner">
            <div class="g-col-2">

                <div class="owner_info">

                    <div class="owner_card_info">
                        <img src="<?= $selectedOwner['image'] ? $selectedOwner['image'] : '' ?>" alt="" class="avatar_owner">
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> <span> <strong>Name: </strong>  <?= $selectedOwner['name'] ? $selectedOwner['name'] : '' ?> </span></h3>
                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span> <strong>Civil Registery:</strong> <?= $selectedOwner['civil_registry'] ? $selectedOwner['civil_registry'] : '' ?> </span> </h3>

                     
                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                        </div> <span> <strong>Email:</strong>  <?= $selectedOwner['email'] ? $selectedOwner['email'] : '' ?> </span> </h3>
                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small"></div> <span><strong>Phone Number:</strong> +<?= $selectedOwner['phone_number'] ? $selectedOwner['phone_number'] : '' ?></span> </h3>
                        <h3 class="subheadline_info" > <div class="mr-1 box_info_small">

                        </div>  <span> <strong>Postion:</strong> <?= $selectedOwner['postion'] ? $selectedOwner['postion'] : '' ?></span> </h3>
                        <p class="main_p_small mt-1">
                            <strong>About:</strong> 
                            <?= $selectedOwner['about'] ? $selectedOwner['about'] : '' ?>
                        </p>
                    </div>
                   

                   

                </div>

                <div class=" agency_info ">
                    <div class="owner_card_info">
                        <h1 class="info_subheadline">
                            About This Agency
                        </h1>
                      
                        <p class="main_p_small">
                        <?= $selectedAgency['description'] ? $selectedAgency['description'] : '' ?>
                        </p>
                        <div class="mt-1"></div>
                        

                        <div class="d-flex-c f-sp f-wrap">
                            
                            <div class="single_agency_info ">
                                
                                <div class="d-flex-c" >
                                    <div class="mr-1 box_info_small"></div>
                                    <h4 class="subheadline_info"> Facility Number:  <strong>  <?= $selectedAgency['number'] ? $selectedAgency['number'] : '' ?> </strong></h4>
                                </div>
                               
                     </div>
                            
                            <div class="single_agency_info ">
                                
                                <div class="d-flex-c" >
                                    <div class="mr-1 box_info_small"></div>
                                    <h4 class="subheadline_info"> Commerical Register:  <strong>  <?= $selectedAgency['commercial_register'] ? $selectedAgency['commercial_register'] : '' ?> </strong></h4>
                                </div>
                               
                     </div>
                        </div>

                        <div class="d-flex-c f-sp f-wrap">
                            
                            <div class="single_agency_info ">
                                
                                <div class="d-flex-c" >
                                    <div class="mr-1 box_info_small"></div>
                                    <h4 class="subheadline_info"> City:  <strong> <?= $selectedAgency['city'] ? $selectedAgency['city'] : '' ?> </strong></h4>
                                </div>
                               
                     </div>
                            
                            <div class="single_agency_info ">
                                
                                <div class="d-flex-c" >
                                    <div class="mr-1 box_info_small"></div>
                                    <h4 class="subheadline_info"> District :  <strong>  <?= $selectedAgency['district'] ? $selectedAgency['district'] : '' ?> </strong></h4>
                                </div>
                               
                     </div>
                        </div>

                        <div class="d-flex-c f-sp f-wrap">
                            
                            <div class="single_agency_info ">
                                
                                <div class="d-flex-c" >
                                    <div class="mr-1 box_info_small"></div>
                                    <h4 class="subheadline_info"> Street:  <strong>  <?= $selectedAgency['street'] ? $selectedAgency['street'] : '' ?> </strong></h4>
                                </div>
                               
                     </div>
                            
                            <div class="single_agency_info ">
                                
                                <div class="d-flex-c" >
                                    <div class="mr-1 box_info_small"></div>
                                    <h4 class="subheadline_info"> Activty :  <strong> <?= $selectedAgency['activity'] ? $selectedAgency['activity'] : '' ?> </strong></h4>
                                </div>
                               
                     </div>
                        </div>
                   <div class="mt-1"></div>
                   <a href="<?= $selectedAgency['location_link'] ? $selectedAgency['location_link'] : '' ?>">
                         <button class="maps_btn d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/google-maps.png' ?>" alt="" class="card_mid_icon"> 
                            <span>Open In Google Maps</span>
                        </button>
                        </a>


                        
                    </div>
                </div>



            </div>
        </div>
    </section>

    <?php  

     if ($_SESSION['refere'] == $selectedOwner['id'] || $_SESSION['admin'] == 1  ) { ?>  

<div class="mt-5"></div>
    <h1 class="main_headline">Agency Actions</h1>

    <section class="owner_page_seciton">
        <div class="grid_owner_actions">
            <div class="g-col-2">

                <div class="agency_img_owner_div">
                    <img src="<?= $selectedAgency['image'] ? $selectedAgency['image'] : '' ?>" alt="">
                  </div>
              
                <div class="owner_actions flex-col-c">
                       
                         <a href="edit_agency.php?agencyId=<?= $selectedOwner['agency_refere'] ?>" style="width: 100%" >
                                    <button class="action_owner"  >Edit Agency</button>
                          </a>
                    <a href="add_service.php?ownerId=<?= $_SESSION['refere'] ?>" style="width: 100%"  >

                        <button class="action_owner">Add Service</button>
                    </a>
                    
                    <a href="add_offer.php?ownerId=<?= $_SESSION['refere'] ?>" style="width: 100%"  >

                        <button class="action_owner">Add Offer</button>
                    </a>
                    
                    <a href="add_product.php?ownerId=<?= $_SESSION['refere'] ?>" style="width: 100%"  >

                        <button class="action_owner">Add Product</button>
                    </a>
                    
                </div>


            </div>
        </div>
    </section>

    <?php }
    ?>
 

 <div class="mt-6"></div>
    <h1 class="main_headline">What's Happening</h1>
    <section class="owner_watch">
        <div class="container_sections">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'consumer')"> <span>
                     <img class="card_small_icon" src="<?= $imgAssets . '/icons/angle-arrow-down.png' ?>" alt="">
                    </span>
                     Ratings</button>
                <button class="tablinks" onclick="openCity(event, 'note')">
                    <span>
                        <img class="card_small_icon" src="<?= $imgAssets . '/icons/angle-arrow-down.png' ?>" alt="">
                       </span>
                    Note About The Agency</button>

                <button class="tablinks" onclick="openCity(event, 'complaint')">
                    <span>
                        <img class="card_small_icon" src="<?= $imgAssets . '/icons/angle-arrow-down.png' ?>" alt="">
                       </span>
                    Complaint About The Agency</button>

              </div>
        </div>
    </section>

    <div class="mt-3"></div>
    <section class="users_actions_div">

        <section class="tabcontent"  id="consumer"  >
      
            <h1 class="main_subheadline m-3">  <div class="rect_box mr-1"></div>Users Rating</h1>
            <div class="d-flex-c f-sv f-wrap single_rating my-2">

            <?php  

        $ratings = selectAllWithPagination("users_ratings");
            foreach ( $ratings['results'][0] as $ra  ) { ?>
                  <div class="user_action_info ">
                    
                    <div class="d-flex-c flex_user_action" >
                        <img src="<?= $imgAssets . '/icons/avatar_consumer.jpg' ?>" alt="" class="consumer_avatar mr-2">
                        <div>
                            <h4 class="main_info_headline"> <strong>Abd Alaziz</strong> </h4>
                            <p class="main_p" ><?= $ra['body'] ? $ra['body'] : '' ?></p>
                            <div class="d-flex-c star_consumer">
                        <?php  
                            for ($x = 0; $x <= $ra['stars']; $x++) { ?>
                                
                                <img src="<?= $imgAssets . '/icons/star_rate_consumer_solid.png' ?>" alt="" class="card_mid_icon">
                            
                             <?php }
                        ?>
                           </div>

                        </div>
                      
                    </div>

                  
                  </div>
       <?php     }
            ?>
              
                
            </div>
      
          
            <div class="rating_btns">
                    <ul class="d-flex-c f-sv f-wrap">
                <?php  
                if ($_GET['page'] > 1 ) { ?>
   <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
            
            <a class="click_pointer" href="single_owner.php?ownerId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $ratings['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="single_owner.php?ownerId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
               
            </div>
       
          
          </section>

        <section class="tabcontent"  id="note"  >
      
            <div class="single_note my-2">
                <h1 class="main_subheadline m-3">  <div class="rect_box mr-1"></div>Users Notes</h1>
                                
                <?php  
  
$notes = selectAllWithPagination("users_notes");
    foreach ( $notes['results'][0] as $note  ) { ?>

           <div class="user_action_info ">
               
                    <div class="d-flex-c flex_user_action" >
                        <img src="<?= $imgAssets . '/icons/avatar_consumer.jpg' ?>" alt="" class="consumer_avatar mr-2">
                        <div>
                            <h4 class="main_info_headline"> <strong>Abd Alaziz</strong> </h4>
                            <div class="mt-1"></div>
                            <p class="main_p" > <strong>Reason: </strong> <?= $note['reason'] ? $note['reason'] : '' ?>  </p>
                            <div class="mt-1"></div>
                            <p class="main_p"> <strong>More: </strong>  <?= $note['body'] ? $note['body'] : '' ?> </p>

                          

                        </div>
                      
                    </div>

                  
                  </div>
        <?php     }
            ?>


               
                 
            </div>
      
          
          
            <div class="rating_btns">
                
                <div >
                <ul class="d-flex-c f-sv f-wrap">
                <?php  
                if ($_GET['page'] > 1 ) { ?>
   <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
            
            <a class="click_pointer" href="single_owner.php?ownerId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $notes['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="single_owner.php?ownerId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
                </div>
            </div>
       
          
          </section>

        <section class="tabcontent"  id="complaint"  >
      
            <div class="single_note my-2">
                <h1 class="main_subheadline m-3">  <div class="rect_box mr-1"></div>Users Complaints</h1>

                <?php  

$complimants = selectAllWithPagination("users_complimants");
    foreach ( $complimants['results'][0] as $comp  ) { ?>
             <div class="user_action_info ">
                    <div class="d-flex-c flex_user_action" >
                        <img src="<?= $imgAssets . '/icons/avatar_consumer.jpg' ?>" alt="" class="consumer_avatar mr-2">
                        <div>
                            <h4 class="main_info_headline"> <strong>Abd Alaziz</strong> </h4>
                            <div class="mt-1"></div>
                            <p class="main_p" > <strong>Reason: </strong> <?= $comp['reason'] ? $comp['reason'] : '' ?> </p>
                            <div class="mt-1"></div>
                            <p class="main_p"> <strong>More: </strong>  <?= $comp['body'] ? $comp['body'] : '' ?> </p>

                          

                        </div>
                      
                    </div>

                  
                  </div>
        <?php     }
            ?>

               
                 
         
      
          
          
            <div class="paggination_btns">
            <ul class="d-flex-c f-sv f-wrap">
                <?php  
                if ($_GET['page'] > 1 ) { ?>
   <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
            
            <a class="click_pointer" href="single_owner.php?ownerId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $complimants['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="single_owner.php?ownerId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
            </div>
       
          
          </section>


    </section>

 <div class="mt-9"></div>
    <h1 class="main_headline">Watch Agency</h1>
    <section class="owner_watch">
        <div class="container_sections">
            <div class="d-felx-c f-sp f-wrap mt-1">

                <div class="single_camera_item" onclick="showSection('one')" >
                    <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                    <h1 class="main_subheadline">Room 1</h1>
                </div>

                <div class="single_camera_item"  onclick="showSection('two')" >
                    <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                    <h1 class="main_subheadline">Room 2</h1>
                </div>
            </div>
            <div class="d-felx-c f-sp f-wrap mt-1"  >

                <div class="single_camera_item" onclick="showSection('three')"  >
                    <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                    <h1 class="main_subheadline">Room 3</h1>
                </div>

                <div class="single_camera_item"  onclick="showSection('four')" >
                    <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                    <h1 class="main_subheadline">Room 4</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="popup_video_section_2 " id="popup_video" >
    
    
        <iframe width="100%"  id="live_video_frame"  height="100%" src="<?= $imgAssets . '/' ?>" title="ozuTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="mt-1"></div>
        <img src="<?= $imgAssets . '/icons/cancel.png' ?>" alt="" class="close_icon card_big_icon" id="close_popup_video" >
    </section>

    <div class="my-5"></div>



</div>

</div>

<?php
tabs_logic();
?>

<?php
include_camera();
?>