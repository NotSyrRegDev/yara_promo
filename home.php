<?php  
  $pageTitle = "نظام يرى";
  include 'init.php';
?>

<?php  

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
    

    <div class="mt-8"></div>
    <h1 class="main_headline">Main Home Page</h1>
   
    <?php  
        include $templates . '/search-div.php';
    ?>

<div class="grid_cards_home ">

            <div class="mt-5"></div>
            <div class="g-col-3">
            <?php  
                 include $templates . '/agencies_search.php';
                ?>      

</div>
</div>
 
</div>
</div>
    <!--------------END MAIN PAGE---------------->

    <script>
        function getSelectItemThat(id) {
    for (var i = 1;i <= 3; i++)
    {
        document.getElementById(i).checked = false;
    }
    document.getElementById(id).checked = true;
}
    </script>