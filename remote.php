<?php  
  $pageTitle = "صفحة عمليات المراقبة";
  include 'init.php';

   if ($_SESSION['admin'] != 4 && $_SESSION['admin'] != 1  ) {  
    header('location: ' . $BASE_URL . 'home.php' );
   }
?>

<?php  
        include $templates . '/swiper-header.php';
    ?>

<?php
include_loading();
?>



<?php  



  

?>
    
    <!--------------MAIN PAGE---------------->
    <div id="focus_app">

    <?php  
        include $templates . '/navbar.php';
    ?>

    <div class="main_page container-sm">
    
    <div class="mt-10"></div>

    <section class="camera_section">

    <h1 class="main_headline">Remote Control Page</h1>


</section>


   
    </div>


    <div class="mt-8"></div>
    

      <section  >
                <div class="container-sm">
                   
      <!--------------Egeincies Action------------------>
                   
                     <div class="our-works__div over-hidden ">
                   
                         <div class="projectSwiper">
                             <div class="swiper-wrapper">

                             <?php  
                              $facilities = selectAll("facilities" , [] , true , 10 , true , 'RAND ()' );

                             
                              foreach($facilities as $fac) {  ?>
                             
                                <div class="swiper-slide">
                                <a href="remote.php?facility_num=<?= $fac["id"] ?>">
                              <div class="single_card_agency" onclick='showSection("<?= $fac["id"] ?>")' >
                           
                              <img class="card_agency_img" src="<?= $fac['image'] ? BASE_URL . '/assets/uploads/' . $fac['image'] : '' ?>" alt=""  >
                              
                           <div class="card_body_agency">
                           <div class="mt-1"></div>
                           <div class="d-flex-c f-sp f-wrap">
                           <div class="d-flex-c">
                                                            
                             <img class="card_small_icon" src="<?= $imgAssets . '/icons/verified-user.png' ?>" alt="">
                             <h4 class="subheadline_card">   <?= $fac['commercial_register'] ? $fac['commercial_register'] : '' ?> </h4> 
                           </div>
                           <div class="d-flex-c">
                                                                                  
                             <img class="card_small_icon" src="<?= $imgAssets . '/icons/location-pin.png' ?>" alt="">
                             <h4 class="subheadline_card"> <?= $fac['city'] ? $fac['city'] : '' ?> , <?= $fac['street'] ? $fac['street'] : '' ?> </h4>   
                           </div>
                           
                           
                           </div>
                           <div class="mt-2"></div>
                           <h1 class="headline_card"> <?= $fac['facility_name'] ? $fac['facility_name'] : '' ?> </h1>
                           <div class="mt-2"></div>
                           
                           
                           <div class="stars_info mt-1">
                              <h4 class="subheadline_card">  Consumer Assessment   </h4>
                              <div class="d-flex-c ">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              </div>
                           
                                  </div>
                                  <div class="stars_info mt-1">
                              <h4 class="subheadline_card">  Government Assessment   </h4>
                              <div class="d-flex-c ">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
                              </div>
                           
                                  </div>
                              
                              </div>
                           
                           
                           
                           
                             </div>
                             </a>
                              </div>
                             
                                   <?php   }

                             ?>

                             
                                
                     
                         
            <div class="swiper-pagination"></div>
                        <div class="swiper-scrollbar"></div>

                         </div>
                     </div>

                        <!--------------END Egencies Section----------------->
                  
                </div>
            </section>

            <div class="mt-5"></div>


              <!------------  POPUP CAMERA SECTION-------------->
              <?php  
               $selectedAgency = selectAllMultiCol("facilities" , [
                "camera_one_link" , "camera_two_link" , "camera_three_link" , "camera_four_link"
              ] , array(
                'id' => isset($_GET['facility_num']) ? $_GET['facility_num'] : 2 ,
            ));
              ?>
      <section class="popup_video_section" style="<?= isset($_GET['facility_num']) ? 'visibility: visible' : 'visibility: hidden' ?>"  id="popup_video" >
    
    
    <iframe width="100%"  id="live_video_frame"  height="100%" src="<?= $selectedAgency[0]['camera_one_link'] ?>" title="ozuTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div class="mt-1"></div>
    <img src="<?= $imgAssets . '/icons/cancel.png' ?>" alt="" class="close_icon card_big_icon" id="close_popup_video" >
    <div class="arrows_slide">

      <img src="<?= $imgAssets . '/icons/left_arrow.png' ?>" alt="" class="left_arrow_popup_video card_big_icon" onclick="decrementPostion()" >

      <img src="<?= $imgAssets . '/icons/right-arrow.png' ?>" alt="" class="right_arrow_popup_video card_big_icon" onclick="incrementPostion()" >
    </div>

</section>
      <!------------ END POPUP CAMERA SECTION-------------->
      
            <div class="mt-5"></div>
          
             <!------------ Family Care-------------->
  <section class="family_care mt-6">



<div class="family_care_div mt-4">
    <img src="<?=  $imgAssets . '/background/camera-section.jpg' ?>" alt="">

    <div class="boxing_white">
       
            <center>
            <div class="red_box_content">
                <div class="animation_box"></div>
                <img src="<?=  $imgAssets . '/icons/play.png' ?>" alt="" id="play_remote_video" >
            </div>
            </center>
           
     
    </div>
</div>



</section>
<div class="popup_videoplayer" id="videoplayer_area" >
<div style="max-width: px">
    <center>
       
    </center>
    </div>
</div>


<!------------END Family Care-------------->


      <!------------ SELECT REJOIN-------------->
      <div class="mt-8"></div>
      <section class="rejoin_Section">

       <div class="container-mid">
                
       <div class="d-flex-c f-sp f-wrap remote_section">
              <h1 class="main_headline">Choose Locaiton</h1>

           <div>
        <form method="POST" >
   
        <div class="d-flex-c">

        <select name="city_selected" class="btn_form_action mr-1" >
       
       <?php  
        $table = "facilities";
        $citiesAvaliable = selectAllOneCol($table , "city" );
       
       foreach($citiesAvaliable as $city) { ?>
           <option value="<?= $city['city'] ?>" class="input_option_value"><?= $city['city'] ?></option>
    <?php   }
        ?>   
         
       </select>

        <input type="submit" class="table_btn" name="choose_city" >
        </div>
     
    
       </form>
                                    
       </div>

       </div>

       <div class="grid_cards_home">
        <div class="mt-6"></div>
        <div class="g-col-3">
            <?php  
             $facilities = selectAll("facilities" , [
              'city' => isset($_POST['city_selected']) ? $_POST['city_selected'] : 'jazan'
             ]);
             foreach($facilities as $fac) {  ?>
                <a href="single_agency.php?agencyId=<?= $fac['id'] ?>">
              <div class="single_card_agency">
           
              <img class="card_agency_img" src="<?= $fac['image'] ? BASE_URL . '/assets/uploads/' . $fac['image'] : '' ?>" alt=""  >
              
           <div class="card_body_agency">
           <div class="mt-1"></div>
           <div class="d-flex-c f-sp f-wrap">
           <div class="d-flex-c">
                                            
             <img class="card_small_icon" src="<?= $imgAssets . '/icons/verified-user.png' ?>" alt="">
             <h4 class="subheadline_card">   <?= $fac['commercial_register'] ? $fac['commercial_register'] : '' ?> </h4> 
           </div>
           <div class="d-flex-c">
                                                                  
             <img class="card_small_icon" src="<?= $imgAssets . '/icons/location-pin.png' ?>" alt="">
             <h4 class="subheadline_card"> <?= $fac['city'] ? $fac['city'] : '' ?> , <?= $fac['street'] ? $fac['street'] : '' ?> </h4>   
           </div>
           
           
           </div>
           <div class="mt-2"></div>
           <h1 class="headline_card"> <?= $fac['facility_name'] ? $fac['facility_name'] : '' ?> </h1>
           <div class="mt-2"></div>
           
           
           <div class="stars_info mt-1">
              <h4 class="subheadline_card">  Consumer Assessment   </h4>
              <div class="d-flex-c ">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              </div>
           
                  </div>
                  <div class="stars_info mt-1">
              <h4 class="subheadline_card">  Government Assessment   </h4>
              <div class="d-flex-c ">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              </div>
           
                  </div>
              
              </div>
           
           
           
           
             </div>
              </a>
                   <?php   }
            ?>
        </div>
       </div>
         </div>

      </section>
      <!------------ END SELECT REJOIN-------------->


    

      <!------------  POPUP CONTROL SECTION-------------->
      <?php  
              
               $agencyRemote =  $facilities = selectAll("facilities" , [] , true , 1 , true , 'RAND ()' );
              
             
              
              ?>
      <section class="popup_remote_section" id="popup_remote" >
    
    
      <iframe width="100%" height="100%"  src="<?= $agencyRemote[0]['camera_one_link'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="live_remote_frame" ></iframe>
    <div class="mt-1"></div>
    <img src="<?= $imgAssets . '/icons/cancel.png' ?>" alt="" class="close_icon card_big_icon" id="close_remote_video" >


</section>
      <!------------ END POPUP CAMERA SECTION-------------->




    </div>
    <!--------------END MAIN PAGE---------------->


    <script>
      let postion = 1;
  let closeIcon = document.getElementById('close_popup_video');
        let popupDiv = document.getElementById('popup_video');
        let iframeDiv = document.getElementById('live_video_frame');

        function incrementPostion()
        {
      
          postion++;
          if (postion > 4) {
            postion = 0;
          } 
          showSection();
        }
        function decrementPostion()
        {

         
          if (postion <= 1 ) {
            postion = 2;
          } 
          postion--;
          showSection();
 
        }

        function showSection(  ) {

            
            if (postion == 1) {             
              iframeDiv.src = "<?= $selectedAgency[0]['camera_one_link'] ?>";
            }

            if (postion == 2) {
                iframeDiv.src = "<?= $selectedAgency[0]['camera_two_link'] ?>";
            }
            if (postion == 3 ) {
                iframeDiv.src = "<?= $selectedAgency[0]['camera_three_link'] ?>";
            }
            if (postion == 4 ) {
                iframeDiv.src = "<?= $selectedAgency[0]['camera_four_link'] ?>";
            }
                   
        }

        closeIcon.addEventListener('click' , () => {
            popupDiv.classList.toggle('active');
            iframeDiv.src = "";
        });

    </script>


    <script>
          var swiper = new Swiper(".projectSwiper", {
                          slidesPerView: 3,
                          spaceBetween: 30,
                          loop: true,
                          pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                          },
                        
                          scrollbar: {
                            el: '.swiper-scrollbar',
                        },
                          breakpoints: {
                        // when window width is >= 320px
                        
                        // when window width is >= 480px
                        900: {
                        slidesPerView: 3,
                        spaceBetween: 30
                        },
                        400: {
                        slidesPerView: 1,
                        spaceBetween: 20
                        },
                        600: {
                        slidesPerView: 2,
                        spaceBetween: 20
                        },
                        
                    }
                        });
    </script>



<script>
  let closeRemoteIcon = document.getElementById('close_remote_video');
  let playRemoteIcon = document.getElementById('play_remote_video');
        let remoteDiv = document.getElementById('popup_remote');
        let iframeRemoteDiv = document.getElementById('live_remote_frame');


        playRemoteIcon.addEventListener('click' , () => {
         
          remoteDiv.classList.toggle('active');
         
     
        });

        closeRemoteIcon.addEventListener('click' , () => {
          remoteDiv.classList.toggle('active');
            iframeRemoteDiv.src = "";
        })
       
        setInterval(() => {
        
          var intRandomIndex = Math.floor(Math.random() * 3);
           
                  
           if (intRandomIndex == 0) {
             iframeRemoteDiv.src = "<?php echo $agencyRemote[0]['camera_one_link'] ?>";
           }
           if (intRandomIndex == 1) {
             iframeRemoteDiv.src = "<?php echo $agencyRemote[0]['camera_two_link'] ?>";
           }
           if (intRandomIndex == 2) {
             iframeRemoteDiv.src = "<?php echo $agencyRemote[0]['camera_three_link'] ?>";
           }
           if (intRandomIndex == 3) {
             iframeRemoteDiv.src = "<?php echo $agencyRemote[0]['camera_four_link'] ?>";
           }
    
        }, 15000);
      

    </script>