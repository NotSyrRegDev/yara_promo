

            <?php  

$searchedQuery;

if (isset($_POST['search_blog']  ) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchQu =  $_POST['search_query'];
   $searchVar = "facility_name";
   
    if ( isset($_POST['checkbox_1']) ) {
        $searchVar = "facility_name";
    }
    if ( isset($_POST['checkbox_2']) ) {
        $searchVar = "city";
    }
    if ( isset($_POST['checkbox_3']) ) {
        $searchVar = "street";
    }
    if ( isset($_POST['checkbox_4']) ) {
        $searchVar = "number";
    }
     
   
  $searchedQuery = searchDb("facilities" , $searchVar , array() , $searchQu , '5' );
  
}

  if (!empty($searchedQuery)) {
     foreach($searchedQuery as $postQuery) {
        
          ?>
<!--------SIGNLE POST---------->

<a href="single_agency.php?agencyId=<?= $postQuery['id'] ?>">
            <div class="single_card_agency">

        <img class="card_agency_img" src="<?= $postQuery['image'] ? BASE_URL . '/assets/uploads/' . $postQuery['image'] : '' ?>" alt=""  >
            
<div class="card_body_agency">
   <div class="mt-1"></div>
   <div class="d-flex-c f-sp f-wrap">
       <div class="d-flex-c">
                                          
           <img class="card_small_icon" src="<?= $imgAssets . '/icons/verified-user.png' ?>" alt="">
           <h4 class="subheadline_card">   <?= $postQuery['number'] ? $postQuery['number'] : '' ?> </h4> 
       </div>
       <div class="d-flex-c">
                                                                
           <img class="card_small_icon" src="<?= $imgAssets . '/icons/location-pin.png' ?>" alt="">
           <h4 class="subheadline_card"> <?= $postQuery['city'] ? $postQuery['city'] : '' ?> , <?= $postQuery['street'] ? $postQuery['street'] : '' ?> </h4>   
       </div>


   </div>
   <div class="mt-2"></div>
   <h1 class="headline_card"> <?= $postQuery['facility_name'] ? $postQuery['facility_name'] : '' ?> </h1>
   <div class="mt-2"></div>


       <div class="stars_info mt-1">
            <h4 class="subheadline_card">  Consumer Assessment   </h4>
            <div class="d-flex-c ">
            <?php  
                for ($x = 1; $x <= $postQuery['cosumer_assessment']; $x++) { ?>
 <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <?php  }
                ?>
           
          
            </div>

                </div>
                <div class="stars_info mt-1">
            <h4 class="subheadline_card">  Government Assessment   </h4>
            <div class="d-flex-c ">
            <?php  
                for ($x = 1; $x <= $postQuery['gov_assessment']; $x++) { ?>
 <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <?php  }
                ?>
            </div>

                </div>
            
            </div>




           </div>
            </a>
<!--------END SIGNLE POST---------->
    <?php }

} 
// IF THERE IS NO POST QUERY
    else {

        $facilities = selectAll("facilities" , [
            'status' => 1
        ]);
                 
        if (!empty($facilities)) {
           foreach($facilities as $fac) {  ?>
     <a href="single_agency.php?agencyId=<?= $fac['id'] ?>">
   <div class="single_card_agency">

<img class="card_agency_img" src="<?= $fac['image'] ? BASE_URL . '/assets/uploads/' . $fac['image'] : '' ?>" alt=""  >
   
<div class="card_body_agency">
<div class="mt-1"></div>
<div class="d-flex-c f-sp f-wrap">
<div class="d-flex-c">
                                 
  <img class="card_small_icon" src="<?= $imgAssets . '/icons/verified-user.png' ?>" alt="">
  <h4 class="subheadline_card">   <?= $fac['number'] ? $fac['number'] : '' ?> </h4> 
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
   <?php  
                for ($x = 1; $x <= $fac['cosumer_assessment']; $x++) { ?>
 <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <?php  }
                ?>
   </div>

       </div>
       <div class="stars_info mt-1">
   <h4 class="subheadline_card">  Government Assessment   </h4>
   <div class="d-flex-c ">
   <?php  
                for ($x = 1; $x <= $fac['gov_assessment']; $x++) { ?>
 <img src="<?= $imgAssets . '/icons/star.png' ?>" alt="" class="card_small_icon">
              <?php  }
                ?>
   </div>

       </div>
   
   </div>




  </div>
   </a>
        <?php   }
          

 
        }
    }

                
            ?>
          
