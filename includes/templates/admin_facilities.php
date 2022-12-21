    
   <?php  
   
   if (isset($_POST['edit_activation'])) {
      $table = "facilities";
      
      $statusActivate = 0;
      if ($_POST['edit_activation'] == "Activate") {
  $statusActivate = 1;
      }
      else {
         $statusActivate = 0;
      }
      $facilityId = $_POST['facility_id'];
      
      $sql = "UPDATE $table SET status = ? WHERE id = ?";
      $dataUpdated = [
         $statusActivate , $facilityId
      ];
      $stat = exectureQuery($sql , $dataUpdated);    
      
    
   }
   if (isset($_POST['edit_acttivity'])) {
      $table = "facilities";

      $statusActivate = 0;
    
      if ($_POST['edit_acttivity'] == "opened" ) {
  $statusActivate = 0;
      }
      else {
         $statusActivate = 1;
      }
    
      $facilityId = $_POST['facility_id'];
   
      $sql = "UPDATE $table SET activity = ? WHERE id = ?";
      $dataUpdated = [
         $statusActivate , $facilityId
      ];
      $stat = exectureQuery($sql , $dataUpdated);    
      
    
   }
   
   ?>

<div class="mt-10"></div>
<h1 class="main_headline">Manage Facilties</h1>


<div class="table-content-table" style="overflow-x:auto;" >
  <table class="w-100">
    
  <tr class="table-thead-tr">
  <th>Image</th>
      <th>Facility Name</th> 
    <th>Facility Number</th> 
    <th>Commercial Register</th> 
    <th>Activity</th> 
    <th>Status</th> 
    <th>Location</th>  
    <th class="th-actions">Actions</th>
  </tr>
    
        <?php  
           $facalities = selectAllWithPagination("facilities");
           foreach($facalities['results'][0] as $fac ) { ?>
          <tr class="table-tbody-tr">
     
     <td>
     <img style="max-height: 4.5rem" src="<?= $fac['image'] ? BASE_URL . '/assets/uploads/' . $fac['image'] : 'https://i.pinimg.com/originals/cc/cb/56/cccb56f73f7a4b44554aaaabc62cffa4.jpg' ?>" alt="facumer"> 
     </td>
   
     <td>
     <?= $fac['facility_name'] ? $fac['facility_name'] : '' ?>
     </td>

     <td>
     <?= $fac['number'] ? $fac['number'] : '' ?>
     </td>
   
   
   
     <td>
     <?= $fac['commercial_register'] ? $fac['commercial_register'] : '' ?>
     </td>

     <td>
     <form action="" method="POST" >
     <?php 
     if ($fac['activity'] == 1) {
        echo '<button type="submit" name="edit_acttivity" value="opened" class="table_btn next_bg">Opened</button>';
     }
  else {
        echo '<button type="submit" name="edit_acttivity" value="closed" class="table_btn prev_bg">Closed</button>';
     }
     ?>
     </td>
     <input type="hidden" name="facility_id" value="<?= $fac['id'] ?>" >
     </form>

     <td>
      <form action="" method="POST" >
     <?php 
     if ($fac['status'] == 0) {
        echo '<button type="submit" name="edit_activation" class="table_btn" value="Activate" >Activate</button>';
     }
  else {
        echo '<button type="submit" name="edit_activation" class="table_btn prev_bg" value="Dectivate" >Dectivate</button>';
     }
     ?>
     <input type="hidden" name="facility_id" value="<?= $fac['id'] ?>" >
     </form>
     </td>
   


     <td>
     <a href="<?= $fac['location_link'] ? $fac['location_link'] : '' ?>">                     
                            <img src="<?= $imgAssets . '/icons/google-maps.png' ?>" alt="" class="card_mid_icon"> 
    </a>
     </td>



    
       <td>
        <a href="edit_agency.php?agencyId=<?= $fac['id'] ?>">
          <button type="button" class="table_btn mr-1">Edit</button>
          </a>
          <a href="edit_agency.php?agencyId=<?= $fac['id'] ?>&del=true">
          <button type="button" class="table_btn prev_bg">Delete</button>
          </a>
       
       </td>
   
     </tr>
        <?php   }
        ?>

    

   
</table>
</div>

<div class="rating_btns">
                    <ul class="d-flex-c f-sv f-wrap">
                <?php  
                if ($_GET['page'] > 1 ) { ?>
   <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
            
            <a class="click_pointer" href="admin.php?manage=facloyees&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $ratings['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="admin.php?manage=facloyees&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
               
            </div>
