
        <?php  

$productId = isset($_GET['productId']) && is_numeric($_GET['productId']) ? intval($_GET['productId']) : 0;

if (isset($_GET['del'] ) && isset($_POST['delete_product'])  && $_SERVER['REQUEST_METHOD'] == 'POST'  ) {

$tablename = "agency_products";
$delete_id = deleteFromDb($tablename , $productId  , 'id');

if ($delete_id) {
  header('location: ' . $BASE_URL . 'home.php' );
}

}

?>
<?php  


// EDIT
$table = "agency_products";

if (isset($_POST['edit_product']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

global $errors;

$checkArrays = [
'name' => 'Product Name' , 
'description' => 'Product Description' ,
'price' => 'Product Description' ,
'category' => 'Product Description' ,
];

// OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
$errors = validatePost($_POST , $checkArrays , $table , 'name' );




if (!empty($_FILES['image']['name'])) {

$uploadFile_type = $_FILES['image']['type'];
$allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');

if (!in_array($uploadFile_type,$allowedTypes)) {
array_push($errors , "File Type Is Not Allowed");
 }

if( count($errors) == 0 ) {
$image_name = time() . '_' . $_FILES['image']['name'];

$destination = ROOT_PATH_MAIN . "/assets/uploads/" . $image_name;
 
$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
}

if ($result) {

 $_POST['image'] = $image_name;
} 

}  else {
unset($_POST['image']);
}

if (count($errors) == 0) {

global $conn;

$productId = $_POST['id']; 

$productId = is_numeric($productId) ? intval($productId) : 0 ; 

if ($productId > 0) {

  unset($_POST['edit_product']);

 
unset($_POST['id']);


 
  $post_id = update($table, $productId , $_POST , 'id');
  header("Refresh: 0");

  exit(); 
} else {

  header("location: " . BASE_URL . "home.php" ); 
  exit(); 
}

} 

}



?>

    <h1 class="main_headline">
               Edit <?= $selectedStuff['name'] ?> Product
                </h1>

                <section class="info_section">
                <div class="mt-5"></div>
              
    
                <form action="" method="POST" enctype="multipart/form-data" >

               
                <div class="owner_info">

                    <div class="owner_card_info">

                    <?php  
        include $templates . '/formErrors.php';
           ?>

                    <img src="<?= $selectedStuff['image'] ? BASE_URL . '/assets/uploads/' . $selectedStuff['image'] : 'https://png.pngtree.com/element_our/png/20181102/super-sale-and-special-offer-banner-design-png_227619.jpg'
                     ?>" alt="" class="avatar_owner">
                    <div class="input_contain_div">
                                <input type="file" name="image"  class=""  >
                               
                        </div>
                        
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Product Name: </strong> </h3>
                                <div class="input_contain_div">
                                <input name="name" type="text" readonly  class="input_info" value="<?= $selectedStuff['name'] ? $selectedStuff['name'] : '' ?>" >
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                        <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Product Price: </strong> </h3>
                                <div class="input_contain_div">
                                <input name="price" type="number" readonly  class="input_info" value="<?= $selectedStuff['price'] ? $selectedStuff['price'] : '' ?>" >
                               
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Product Category: </strong> </h3>
                                <div class="input_contain_div">
                                <input name="category" type="text" readonly  class="input_info" value="<?= $selectedStuff['category'] ? $selectedStuff['category'] : '' ?>" >
                               
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                           
                            <h3 class="subheadline_info"  > <div class="mr-1 box_info_small"></div> 
                                <strong>Product Describtion: </strong> </h3>
                                <div class="input_contain_div">
                                <textarea type="text" name="description" readonly class="input_info" style="min-height: 15rem;"   ><?= $selectedStuff['description'] ? $selectedStuff['description'] : '' ?> </textarea>
                                <img src="<?= $imgAssets . '/icons/edit.png' ?>" class="card_mid_icon edit_input_icon"  alt="">
                        </div>

                           
                        <input type="hidden" name="id" value="<?= $selectedStuff['id'] ? $selectedStuff['id'] : '' ?>"  >

                        <?php  
                        if (isset($_GET['del'] )  ) {
                            echo ' <input name="delete_product" type="submit" class="form_btn prev_bg" style="cursor: pointer; " value="Delete" ></button>';
                        }
                        else {
                            echo ' <input name="edit_product" type="submit" class="form_btn" style="cursor: pointer; " value="Submit" ></button>';
                        }
                        ?>
                       
                       
                   
                    </div>
                   

                   
                    </form>
                </div>
              
         
        </section>