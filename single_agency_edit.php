<?php  
  $pageTitle = "تعديل اشياء المنشئة  ";
  include 'init.php';



//   if ($_SESSION['refere'] != $consumerId && $_SESSION['admin'] != 1   ) {
//     header('location: ' . $BASE_URL . 'home.php' );
// }

if ($_GET['info'] != "services" && $_GET['info'] != "products" && $_GET['info']  != "offers"   )
  {
      header('location: ' . BASE_URL . 'home.php' );
      exit(0);
  }

  $selectedItem;

  switch ( $_GET['info'] ) {

    case 'services':
        
        $selectedServiceId = isset($_GET['serviceId']) && is_numeric($_GET['serviceId']) ? intval($_GET['serviceId']) : 0;
        $selectedStuff = selectOne("agency_services" , [
            'id' => $selectedServiceId 
        ] );
        $selectedItem = "Service";
        break;

    case 'products':

        $selectedProductId = isset($_GET['productId']) && is_numeric($_GET['productId']) ? intval($_GET['productId']) : 0;
        $selectedStuff = selectOne("agency_products" , [
            'id' => $selectedProductId 
        ] );
        $selectedItem = "Product";
        break;

    case 'offers':

        $selectedOfferId = isset($_GET['offerId']) && is_numeric($_GET['offerId']) ? intval($_GET['offerId']) : 0;
        $selectedStuff = selectOne("agency_offers" , [
            'id' => $selectedOfferId 
        ] );
        $selectedItem = "Offer";
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



<section class="info_section">
                <div class="mt-10"></div>
                <?php  

                if ($selectedItem == "Service" ) {
                    include $templates . '/edit_service.php';
                }

                if ($selectedItem == "Offer" ) {
                    include $templates . '/edit_offer.php';
                }

                if ($selectedItem == "Product" ) {
                    include $templates . '/edit_product.php';
                }
                ?>
                

               

                    
                </section>
</div>

<?php  
        include $templates . '/allowEdit.php';
           ?>