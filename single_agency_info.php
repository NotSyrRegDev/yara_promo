<?php  
  $pageTitle = "صفحة معلومات المنشئة";
  include 'init.php';

  $agencyId = isset($_GET['agencyId']) && is_numeric($_GET['agencyId']) ? intval($_GET['agencyId']) : 0;

  if ($agencyId == 0 ) {
    header('location: ' . BASE_URL . 'home.php' );
    exit(0);
  }
  
  if (!isset($_GET['info'])) {
    header('location: ' . BASE_URL . 'home.php' );
    exit(0);
  }

  if ($_GET['info'] != "services" && $_GET['info'] != "products" && $_GET['info']  != "offers"   )
  {
      header('location: ' . BASE_URL . 'home.php' );
      exit(0);
  }

  $selectedStuff;
  $selectedItem;
  $selectedItemId ;

  switch ( $_GET['info'] ) {

    case 'services':
        $selectedStuff = selectAll("agency_services" , [
            'agency_id' => $agencyId 
        ] );
        $selectedItem = "Services";
        break;

    case 'products':
        $selectedStuff = selectAll("agency_products" , [
            'agency_id' => $agencyId 
        ] );
        $selectedItem = "Products";
        break;

    case 'offers':
        $selectedStuff = selectAll("agency_offers", [
            'agency_id' => $agencyId 
        ] );
        $selectedItem = "Offers";
        break;

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

  
<section class="services_section my-5">
    <div class="mt-10"></div>
    <h1 class="main_headline">Agency <?= $selectedItem ?> </h1>

    <div class="mt-5"></div>

    <div class="d-grid grid_agency_services">

    <div class="g-col-2">

    <?php  
           
            
            foreach ($selectedStuff as $stuff)
            { ?>

            <?php  
            if ($selectedItem == "Services") { ?>
               <a href="single_agency_service.php?serviceId=<?= $stuff['id'] ?>" class="click_pointer" >
           <?php }
            
            if ($selectedItem == "Products") { ?>
                <a href="single_agency_product.php?productId=<?= $stuff['id'] ?>" class="click_pointer" >
               
          <?php  }
            
            if ($selectedItem == "Offers") { ?>
               <a href="single_agency_offer.php?offerId=<?= $stuff['id'] ?>" class="click_pointer" >
            <?php }
            ?>

            <div class="single_card_service">

        <img class="card_agency_img" src="<?= !empty($stuff['image']) ?  BASE_URL . '/assets/uploads/' . $stuff['image'] : 'https://static.vecteezy.com/system/resources/previews/002/147/279/original/young-man-and-woman-with-headphones-microphone-and-computer-customer-service-support-or-call-center-concept-free-vector.jpg' ?>" alt=""  >
            
<div class="card_body_agency">
   <div class="mt-1"></div>
   <h1 class="main_subheadline"> <?= $stuff['name'] ? $stuff['name'] : '' ?> </h1>
       
      
            </div>
           </div>

            </a>

         <?php   }
        ?>
    </div>
      
   
       
      
    </div>


</section>


</div>