<?php  
  $pageTitle = "صفحة خدمة المنشئة";
  include 'init.php';

  
  $serviceId = isset($_GET['serviceId']) && is_numeric($_GET['serviceId']) ? intval($_GET['serviceId']) : 0;

  $selectedService = selectOne("agency_services" , array(
      'id' => $serviceId
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
    <h1 class="main_headline"> Service: <?= $selectedService['name'] ? $selectedService['name'] : '' ?>  </h1>

    
<section class="info_section my-5">
    <div class="mt-10"></div>
  

    <div class="grid_single_agency mt-5">
        <div class="g-col-2">

            <div class="single_agency_info mt-3">
               
            <h1 class="main_headline"> <?= $selectedService['name'] ? $selectedService['name'] : '' ?>  </h1>
            <p class="main_p"> <?= $selectedService['description'] ? $selectedService['description'] : '' ?>  </p>
                
            </div>

            <div class="single_agency_image">
                <img src="<?= !empty($selectedService['image']) ?  BASE_URL . '/assets/uploads/' . $selectedService['image'] : 'https://static.vecteezy.com/system/resources/previews/002/147/279/original/young-man-and-woman-with-headphones-microphone-and-computer-customer-service-support-or-call-center-concept-free-vector.jpg' ?>" alt="" class="single_agency_img">
            </div>

        </div>
        <div class="mt-5"></div>

        <div >

        <a href="single_agency_edit.php?info=services&serviceId=<?= $selectedService['id'] ? $selectedService['id'] : '' ?>">
<button class="form_btn"  style="width: 100%" >Edit</button>
</a>
  <div class="mt-1"></div>
        <a href="single_agency_edit.php?info=services&serviceId=<?= $selectedService['id'] ? $selectedService['id'] : '' ?>&del=true">
<button class="form_btn prev_bg"  style="width: 100%" >Delete</button>
</a>
        </div>

    </div>
</section>

 

</section>

</div>