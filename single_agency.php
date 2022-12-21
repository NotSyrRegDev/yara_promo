<?php  
  $pageTitle = "نظام يرى";
  include 'init.php';

  $agencyId = isset($_GET['agencyId']) && is_numeric($_GET['agencyId']) ? intval($_GET['agencyId']) : 0;

  $selectedAgency = selectOne("facilities" , array(
      'id' => $agencyId
  ));



?>

<?php  

  
if (isset($_POST['add_rating'])) {

    $table = "users_ratings";
    global $errors;
    $checkArrays = [
        'stars' => 'Stars Rating' , 
        'body' => 'Rating Describtion' ,

        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , $table , ''  );
    
   if ($_POST['stars'] == 0) {
   
    array_push($errors , 'You Must Specify The Stars Rating');
   }

   if ($selectedAgency['cosumer_assessment'] > 5) {
  
    array_push($errors , 'Maxiumum Value Reached');
   }

if (count($errors) == 0) {
    $tableTwo = "facilities";
    global $conn;
    unset($_POST['add_rating']);

    $rateScore;

    if ($_POST['stars'] == 1) {
        $rateScore = 0.1;
    }

    if ($_POST['stars'] == 2) {
        $rateScore = 0.2;
    }

    if ($_POST['stars'] == 3) {
        $rateScore = 0.3;
    }

    if ($_POST['stars'] == 4) {
        $rateScore = 0.4;
    }

    if ($_POST['stars'] == 5) {
        $rateScore = 0.5;
    }
  
   
   

    $sql = "UPDATE $tableTwo SET cosumer_assessment  = cosumer_assessment + ? WHERE id = ?";

    $dataUpdated = [
       $rateScore , $agencyId
    ];

    $stat = exectureQuery($sql , $dataUpdated);    


    $post_id = create($table, $_POST);

   header("location: " . BASE_URL . "home.php"); 
   exit();    
} 
}

?>

<?php  

  
if (isset($_POST['add_note'])) {

    $table = "users_notes";
    global $errors;
    $checkArrays = [
        'reason' => 'Note Reason' , 
        'body' => 'Note Body' ,

        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , $table , ''  );


if (count($errors) == 0) {
    global $conn;
    unset($_POST['add_note']);


    $post_id = create($table, $_POST);

   header("location: " . BASE_URL . "home.php"); 
   exit();    
} 
}

?>

<?php  

  
if (isset($_POST['add_complaint'])) {

    $table = "users_complimants";
    global $errors;
    $checkArrays = [
        'reason' => 'Note Reason' , 
        'body' => 'Note Body' ,

        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , $table , ''  );


if (count($errors) == 0) {
    global $conn;
    unset($_POST['add_complaint']);


    $post_id = create($table, $_POST);

   header("location: " . BASE_URL . "home.php"); 
   exit();    
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
    <h1 class="main_headline">Agency: <?= $selectedAgency['facility_name'] ? $selectedAgency['facility_name'] : '' ?> </h1>

    <div class="grid_single_agency mt-5">
        <div class="g-col-2">

            <div class="single_agency_info mt-3">
                <h1 class="main_subheadline">
                    About This Agency
                </h1>
                <div class="mt-1"></div>
                <p class="main_p">
                <?= $selectedAgency['description'] ? $selectedAgency['description'] : '' ?>
                </p>
                <div class="mt-1"></div>
                

                <div class=" d-flex-c f-sp f-wrap">

                    <div class="single_agency_info ">
                        
                        <div class="d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/eleven.png' ?>" alt="" class="card_mid_icon ">
                            <h4 class="main_info_headline">Facility Number</h4>
                        </div>
                        <div>
                           <span class="span_headline"> <?= $selectedAgency['number'] ? $selectedAgency['number'] : '' ?> </span>
                        </div>
                            
                       
                    </div>

                    <div class="single_agency_info ">
                        
                        <div class="d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/cashier.png' ?>" alt="" class="card_mid_icon ">
                            <h4 class="main_info_headline">Commerical Register</h4>
                        </div>
                        <div>
                           <span class="span_headline"> <?= $selectedAgency['commercial_register'] ? $selectedAgency['commercial_register'] : '' ?> </span>
                        </div>
                            
                       
                    </div>

                </div>

                <div class="d-flex-c f-sp f-wrap">

                    <div class="single_agency_info ">
                        
                        <div class="d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/owner.png' ?>" alt="" class="card_mid_icon ">
                            <h4 class="main_info_headline">Owner Name</h4>
                        </div>
                       
                        <a href="single_owner.php">
                        <div  >
                           <span class="span_headline"> <?= $selectedAgency['owner_name'] ? $selectedAgency['owner_name'] : '' ?>  </span>
                        </div>
                        </a>
                       
                            
                       
                    </div>

                    <div class="single_agency_info ">
                        
                        <div class="d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/city.png' ?>" alt="" class="card_mid_icon ">
                            <h4 class="main_info_headline">City</h4>
                        </div>
                        <div>
                           <span class="span_headline"> <?= $selectedAgency['city'] ? $selectedAgency['city'] : '' ?> </span>
                        </div>
                            
                       
                    </div>

                </div>

                <div class="d-flex-c f-sp f-wrap">

                    <div class="single_agency_info ">
                        
                        <div class="d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/map.png' ?>" alt="" class="card_mid_icon ">
                            <h4 class="main_info_headline">District</h4>
                        </div>
                        <div  >
                           <span class="span_headline"> <?= $selectedAgency['district'] ? $selectedAgency['district'] : '' ?> </span>
                        </div>
                            
                       
                    </div>

                    <div class="single_agency_info ">
                        
                        <div class="d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/road.png' ?>" alt="" class="card_mid_icon ">
                            <h4 class="main_info_headline">Street</h4>
                        </div>
                        <div>
                           <span class="span_headline"> <?= $selectedAgency['street'] ? $selectedAgency['street'] : '' ?> </span>
                        </div>
                            
                       
                    </div>

                </div>

                <div class="d-flex-c f-sp f-wrap">

                    <div class="single_agency_info ">
                        
                        <div class="d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/status.png' ?>" alt="" class="card_mid_icon ">
                            <h4 class="main_info_headline">Actvity</h4>
                        </div>

                        <div  >
                            <span class="span_headline"><?= $selectedAgency['activity'] ? $selectedAgency['activity'] : '' ?>  <?php $selectedAgency['activity'] == 'opened' ? '✅' : '❌' ?> </span>
                         </div>
                            
                       
                    </div>

                    <div class="single_agency_info ">
                        
                       
                        <div>
                        
                        <a href="<?= $selectedAgency['location'] ? $selectedAgency['location'] : '' ?>" target="_blank" >
                         <button class="maps_btn d-flex-c" >
                            <img src="<?= $imgAssets . '/icons/google-maps.png' ?>" alt="" class="card_mid_icon"> 
                            <span>Open In Google Maps</span>
                        </button>
                        </a>
                        </div>
                            
                       
                    </div>

                </div>

                
            </div>

            <div class="single_agency_image">
                <img src="<?= $selectedAgency['image'] ? $selectedAgency['image'] : '' ?>" alt="" class="single_agency_img">
            </div>

        </div>
    </div>
</section>

<?php  
$agencyServices = selectAll("agency_services" , [
    'agency_id' => $agencyId 
] , true , 4 );

if (!empty($agencyServices)) { ?>

    
<section class="services_section">
    <div class="mt-5"></div>
    <h1 class="main_headline">Agency Services </h1>

    <div class="mt-5"></div>

    <div class="d-grid grid_agency_services">

    <div class="g-col-2">

    <?php  
            
            
            foreach ($agencyServices as $service)
            { ?>

<a href="single_agency_service.php?serviceId=<?= $service['id'] ?>" class="click_pointer" >
            <div class="single_card_service">

        <img class="card_agency_img" src="<?= !empty($service['image']) ?  BASE_URL . '/assets/uploads/' . $service['image'] : 'https://static.vecteezy.com/system/resources/previews/002/147/279/original/young-man-and-woman-with-headphones-microphone-and-computer-customer-service-support-or-call-center-concept-free-vector.jpg' ?>" alt=""  >
            
<div class="card_body_agency">
   <div class="mt-1"></div>
   <h1 class="main_subheadline"> <?= $service['name'] ? $service['name'] : '' ?> </h1>
       
      
            </div>
           </div>
            </a>
         <?php   }
        ?>
    </div>
      
    <div class="my-4"></div>
        <div class="text-center " >
            <a href="single_agency_info.php?info=services&agencyId=<?= $agencyId ?>">

                <button class="form_btn"  style="width: 100%" >View More</button>
            </a>
        </div>
      
    </div>


</section>

<?php }

?>


<?php  
     $agencyProducts = selectAll("agency_products" , [
        'agency_id' => $agencyId 
    ] , true , 4 );

    if (!empty($agencyProducts)) { ?>

        
<section class="products_section">
    <div class="mt-5"></div>
    <h1 class="main_headline">Agency Products </h1>

    <div class="mt-5"></div>

    <div class="g-grid grid_agency_services">
        <div class="g-col-2">

        <?php  
           
            
            foreach ($agencyProducts as $product )
            { ?>

        <a href="single_agency_product.php?productId=<?= $product['id'] ?>" class="click_pointer" >
            <div class="single_card_service">

        <img class="card_agency_img" src="<?= !empty($product['image']) ?  BASE_URL . '/assets/uploads/' . $product['image'] : 'https://previews.123rf.com/images/wisaanu99/wisaanu991711/wisaanu99171100022/89060121-worker-warehouse-checking-boxes-with-tablet-product-on-stock-vector-illustration.jpg' ?>" alt=""  >
            
<div class="card_body_agency">
   <div class="mt-1"></div>
   <h1 class="main_subheadline"> <?= $product['name'] ? $product['name'] : '' ?> </h1>
     
      
            </div>
           </div>
            </a>
         <?php   }
        ?>

        </div>
        <div class="my-4"></div>
        <div class="text-center " >
        <a href="single_agency_info.php?info=products&agencyId=<?= $agencyId ?>">

        <button class="form_btn"  style="width: 100%" >View More</button>
        </a>
        </div>
    </div>
 


</section>
  <?php  }
?>


<?php 
 $agencyOffers = selectAll("agency_offers" , [
    'agency_id' => $agencyId 
] , true , 4 );

    if (!empty($agencyOffers)) { ?>

        
<section class="offers_section">
    <div class="mt-5"></div>
    <h1 class="main_headline">Agency Offers </h1>

    <div class="mt-5"></div>

    <div class="g-grid grid_agency_services">
        <div class="g-col-2">

        <?php  
           
            
            foreach ($agencyOffers as $offer )
            { ?>

        <a href="single_agency_offer.php?offerId=<?= $offer['id'] ?>" class="click_pointer" >
            <div class="single_card_service">

        <img class="card_agency_img" src="<?= !empty($offer['image']) ?  BASE_URL . '/assets/uploads/' . $offer['image'] : 'https://png.pngtree.com/element_our/png/20181102/super-sale-and-special-offer-banner-design-png_227619.jpg'	 ?>" alt=""  >
            
<div class="card_body_agency">
   <div class="mt-1"></div>
   <h1 class="main_subheadline"> <?= $offer['name'] ? $offer['name'] : '' ?> </h1>
       
      
            </div>
           </div>
            </a>
         <?php   }
        ?>
        
        </div>

        <div class="my-4"></div>
        <div class="text-center " >
        <a href="single_agency_info.php?info=offers&agencyId=<?= $agencyId ?>">

<button class="form_btn"  style="width: 100%" >View More</button>
</a>
        </div>
  
    </div>


</section>

   <?php }

?>



<section class="camera_section">
    <div class="mt-5"></div>
    <h1 class="main_headline">Watch Agency</h1>

    <div class="mt-5"></div>

    <div class="container_sections">
        <div class="d-felx-c f-sp f-wrap mt-1">

            <div class="single_camera_item" onclick="showSection('one')" >
                <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                <h1 class="main_subheadline"> <?= $selectedAgency['camera_one_title'] ? $selectedAgency['camera_one_title'] : 'Room 1' ?> </h1>
            </div>

            <div class="single_camera_item"  onclick="showSection('two')" >
                <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                <h1 class="main_subheadline">
                <?= $selectedAgency['camera_two_title'] ? $selectedAgency['camera_two_title'] : 'Room 2' ?>
                </h1>
            </div>
        </div>
        <div class="d-felx-c f-sp f-wrap mt-1"  >

            <div class="single_camera_item" onclick="showSection('three')"  >
                <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                <h1 class="main_subheadline">
                <?= $selectedAgency['camera_three_title'] ? $selectedAgency['camera_three_title'] : 'Room 3' ?>
                </h1>
            </div>

            <div class="single_camera_item"  onclick="showSection('four')" >
                <img src="<?= $imgAssets . '/icons/cctv.png' ?>" alt="">
                <h1 class="main_subheadline">
                <?= $selectedAgency['camera_four_title'] ? $selectedAgency['camera_four_title'] : 'Room 4' ?>
                </h1>
            </div>
        </div>
    </div>


</section>

<section class="forms_action">
    
        <div class="mt-9"></div>
        <h1 class="main_headline">Rating Agency</h1>

        


        <div class="container_sections">
           
            <div class="my-2"></div>
            <?php  
        include $templates . '/formErrors.php';
    ?>
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'consumer')"> <span>
                     <img class="card_small_icon" src="<?= $imgAssets . '/icons/angle-arrow-down.png' ?>" alt="">
                    </span>
                     Consumer Evaluation</button>
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
                <button class="tablinks" onclick="openCity(event, 'location')">
                    <span>
                        <img class="card_small_icon" src="<?= $imgAssets . '/icons/angle-arrow-down.png' ?>" alt="">
                       </span> 
                    Agency Location
                </button>
              </div>

            <div class="my-5"></div>
        

          <section class="setion_form consumer_evaulation tabcontent" id="consumer"  >
            <form action="" method="POST" >

       
            <h1 class="main_subheadline">  <div class="rect_box mr-1"></div>Consumer Evaluation</h1>
            
            <div class="mx-3 mt-1 d-flex-c star_consumer">
           
               
                <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"   onclick="stars_rating( event , 1)"  >
                <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating( event , 2)"  >
                <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating( event , 3)"  >
                <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating( event , 4)"    >
                <img src="<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>" alt="" class="card_mid_icon star_icon" ondblclick="reset_rating()"  onclick="stars_rating(  event, 5)"  >

                <input type="hidden"  name="stars" id="stars_value" value="0"  >
            </div>
            <input type="text" name="body"  placeholder="Tell Us More" class="input_form">

            <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>"  >

            <div class="mt-1"></div>

            <input name="add_rating" type="submit" class="form_btn" value="Submit" >
            </form>
          </section>

            <div class="my-5"></div>
          <section class="setion_form consumer_evaulation tabcontent " id="note" >
            <h1 class="main_subheadline">  <div class="rect_box mr-1"></div>Note About The Agency</h1>
            <form action="" method="post" >
                <input type="text" name="reason" placeholder="Reason About The Note" class="input_form">
                <textarea name="body"  class="textarea_form" placeholder="Tell Us More"></textarea>

                <div class="mt-1"></div>
                <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>"  >
                <input name="add_note" type="submit" class="form_btn" value="Submit" >
            </form>
           
          </section>

            <div class="my-5"></div>
          <section class="setion_form consumer_evaulation tabcontent " id="complaint" >
            <h1 class="main_subheadline">  <div class="rect_box mr-1"></div>Complaint About The Agency</h1>
            <form action="" method="POST" >
                <input type="text" name="reason" placeholder="Reason About The Complaint" class="input_form">
                <textarea name="body"  class="textarea_form" placeholder="Tell Us More" ></textarea>

                <div class="mt-1"></div>
                <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>"  >
                <input name="add_complaint" type="submit" class="form_btn" value="Submit" >
            </form>
           
          </section>

            <div class="my-5"></div>
          <section class="setion_form consumer_evaulation tabcontent " id="location" >
            <h1 class="main_subheadline">  <div class="rect_box mr-1"></div>Agency Location</h1>
            <div class="mt-1"></div>
            <iframe src="<?= $selectedAgency['location_link'] ? $selectedAgency['location_link'] : '' ?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
           
          </section>
         
        </div>
</section>

<section class="popup_video_section_2"  id="popup_video" >
    
    
    <iframe width="100%"  id="live_video_frame"  height="100%" src="" title="ozuTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div class="mt-1"></div>
    <img src="<?= $imgAssets . '/icons/cancel.png' ?>" alt="" class="close_icon card_big_icon" id="close_popup_video" >
</section>


</div>


</div>

<script>
        let stars_icons = document.querySelectorAll('.star_icon');
      
      

    function stars_rating(  event , number ) {

      
       document.getElementById('stars_value').value = number;
        for (let i = 0; i < number; i++  ) {
         
            stars_icons[i].src = "<?= $imgAssets . '/icons/star_rate_consumer_solid.png' ?>";
        }
        event.target.src = "<?= $imgAssets . '/icons/star_rate_consumer_solid.png' ?>";
        
    }

    function reset_rating() {
        document.getElementById('stars_value').value = 0;
            for (let i = 0; i < stars_icons.length; i++  ) {
         
         stars_icons[i].src = "<?= $imgAssets . '/icons/star_rate_consumer_flat.png' ?>";
     }
        }

   

</script>

<?php
tabs_logic();
?>

<script>
  let closeIcon = document.getElementById('close_popup_video');
        let popupDiv = document.getElementById('popup_video');
        let iframeDiv = document.getElementById('live_video_frame');

        function showSection( param ) {
            popupDiv.classList.toggle('active');
            if (param == "one") {
                iframeDiv.src = "<?php echo $selectedAgency['camera_one_link']; ?>";
            }
            if (param == "two") {
                iframeDiv.src = "<?php echo $selectedAgency['camera_two_link']; ?>";
            }
            if (param == "three") {
                iframeDiv.src = "<?php echo $selectedAgency['camera_three_link']; ?>";
            }
            if (param == "four") {
                iframeDiv.src = "<?php echo $selectedAgency['camera_four_link']; ?>";
            }
      
          
        }

        closeIcon.addEventListener('click' , () => {
            popupDiv.classList.toggle('active');
            iframeDiv.src = "";
        })

    </script>