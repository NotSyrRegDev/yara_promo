<?php  
  $pageTitle = "صفحة عرض المنشئة";
  include 'init.php';

  
  $offerId = isset($_GET['offerId']) && is_numeric($_GET['offerId']) ? intval($_GET['offerId']) : 0;

  $selectedOffer = selectOne("agency_offers" , array(
      'id' => $offerId
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
    <h1 class="main_headline"> Service: <?= $selectedOffer['name'] ? $selectedOffer['name'] : '' ?>  </h1>

    
<section class="info_section my-5">
    <div class="mt-10"></div>
  

    <div class="grid_single_agency mt-5">
        <div class="g-col-2">

            <div class="single_agency_info mt-3">
               
            <h1 class="main_headline"> <?= $selectedOffer['name'] ? $selectedOffer['name'] : '' ?>  </h1>
            <p class="main_p"> <?= $selectedOffer['description'] ? $selectedOffer['description'] : '' ?>  </p>
                
            </div>

            <div class="single_agency_image">
                <img src="<?= !empty($selectedOffer['image']) ?  BASE_URL . '/assets/uploads/' . $selectedOffer['image'] : 'https://png.pngtree.com/element_our/png/20181102/super-sale-and-special-offer-banner-design-png_227619.jpg' ?>" alt="" class="single_agency_img">
            </div>

        </div>
        <div class="mt-5"></div>

        <div >

        <a href="single_agency_edit.php?info=offers&offerId=<?= $selectedOffer['id'] ? $selectedOffer['id'] : '' ?>">
    <button class="form_btn"  style="width: 100%" >Edit</button>
    </a>
  <div class="mt-1"></div>
        <a href="single_agency_edit.php?info=offers&offerId=<?= $selectedOffer['id'] ? $selectedOffer['id'] : '' ?>&del=true">
    <button class="form_btn prev_bg"  style="width: 100%" >Delete</button>
    </a>

        </div>
       

    </div>
</section>

 

</section>

</div>