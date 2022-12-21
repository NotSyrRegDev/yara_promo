


    <!--------------LOADING---------------->

    <div class="loading_page">
        <div class="center_div">
            <div>

                <img src="<?= "assets/images" . "/icons/camera.png" ?>" alt="Camera" class="camera_form" >
                <h1 class="focus_headline" >Focus</h1>
                <div class="bar"></div>
            </div>
           
        </div>
    </div>

    <!--------------END LOADING---------------->

    
    <script>

       

function hideLoading() {
    let loadingRef = document.querySelector('.loading_page');

    let appRef = document.querySelector('#focus_app');
    let headerRef = document.querySelector('.focus_app_header');

    loadingRef.style.display = 'none';
    appRef.style.display = 'initial';
    headerRef.style.display = 'initial';
}

setTimeout(() => {
hideLoading();
}, 800);
</script>