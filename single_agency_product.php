<?php  
  $pageTitle = "صفحة منتج المنشئة";
  include 'init.php';

  
  $productId = isset($_GET['productId']) && is_numeric($_GET['productId']) ? intval($_GET['productId']) : 0;

  $selectedProduct = selectOne("agency_products" , array(
      'id' => $productId
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
    <h1 class="main_headline"> Product: <?= $selectedProduct['name'] ? $selectedProduct['name'] : '' ?>  </h1>

    
<section class="info_section my-5">
    <div class="mt-10"></div>
  

    <div class="grid_single_agency mt-5">
        <div class="g-col-2">

            <div class="single_agency_info mt-3">
               
            <h1 class="main_headline"> <?= $selectedProduct['name'] ? $selectedProduct['name'] : '' ?>  </h1>
            <p class="main_p"> <?= $selectedProduct['description'] ? $selectedProduct['description'] : '' ?>  </p>
                
            </div>

            <div class="single_agency_image">
                <img src="<?= !empty($selectedProduct['image']) ?  BASE_URL . '/assets/uploads/' . $selectedProduct['image'] : 'https://previews.123rf.com/images/wisaanu99/wisaanu991711/wisaanu99171100022/89060121-worker-warehouse-checking-boxes-with-tablet-product-on-stock-vector-illustration.jpg' ?>" alt="" class="single_agency_img">
            </div>

        </div>

        <div class="mt-5"></div>

        <div>
        <a href="single_agency_edit.php?info=products&productId=<?= $selectedProduct['id'] ? $selectedProduct['id'] : '' ?>">
<button class="form_btn"  style="width: 100%" >Edit</button>
</a>
            <div class="mt-1"></div>

            <a href="single_agency_edit.php?info=products&productId=<?= $selectedProduct['id'] ? $selectedProduct['id'] : '' ?>&del=true">
<button class="form_btn prev_bg"  style="width: 100%" >Delete</button>
</a>
        </div>


    </div>
</section>

 

</section>

</div>