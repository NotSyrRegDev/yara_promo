  
      <?php  
   
   if (isset($_POST['edit_activation'])) {
      $table = "facility_owners";
      $statusActivate = 0;
      if ($_POST['edit_activation'] == "Activate") {
  $statusActivate = 1;
      }
      else {
         $statusActivate = 0;
      }
      $controllerId = $_POST['owner_id'];
      
      $sql = "UPDATE $table SET status = ? WHERE id = ?";

      $dataUpdated = [
         $statusActivate , $controllerId
      ];
      

      $stat = exectureQuery($sql , $dataUpdated);    

    
   }
   
   ?>
  
<div class="mt-10"></div>
<h1 class="main_headline">Manage Owners</h1>


<div class="table-content-table" style="overflow-x:auto;" >
  <table class="w-100">
    
  <tr class="table-thead-tr">
  <th>Image</th>
      <th>Name</th> 
    <th>Email</th> 
    <th>Civil Registry</th> 
    <th>Postion</th> 
    <th>Job ID</th> 
    <th>Date</th> 
    <th>Phone Number</th>  
    <th>Status</th> 
    <th>About</th>  
    <th class="th-actions">Actions</th>
  </tr>
    
        <?php  
           $owners = selectAllWithPagination("facility_owners");
           foreach($owners['results'][0] as $owner ) { ?>
          <tr class="table-tbody-tr">
     
     <td>
     <img style="max-height: 4.5rem" src="<?= $owner['image'] ? BASE_URL . '/assets/uploads/' .  $owner['image'] : 'https://cdn1.iconfinder.com/data/icons/human-resources-1-6/128/86-512.png' ?>" alt="ownerumer"> 
     </td>
   
     <td>
     <?= $owner['name'] ? $owner['name'] : '' ?>
     </td>

     <td>
     <?= $owner['email'] ? $owner['email'] : '' ?>
     </td>
   
   
   
     <td>
     <?= $owner['civil_registry'] ? $owner['civil_registry'] : '' ?>
     </td>
   
     <td>
     <?= $owner['postion'] ? $owner['postion'] : '' ?>
     </td>
   
     <td>
     <?= $owner['job_id'] ? $owner['job_id'] : '' ?>
     </td>

     <td>
     <?= $owner['date'] ? $owner['date'] : '' ?>
     </td>
   
     <td>
     <?= $owner['phone_number'] ? $owner['phone_number'] : '' ?>
     </td>

     <td>
     <form action="" method="POST" >
     <?php 
     if ($owner['status'] == 0) {
      echo '<button type="submit" name="edit_activation" class="table_btn" value="Activate" >Activate</button>';
   }
else {
      echo '<button type="submit" name="edit_activation" class="table_btn prev_bg" value="Dectivate" >Dectivate</button>';
   }

     ?>
       <input type="hidden" name="owner_id" value="<?= $owner['id'] ?>" >
     </form>
     </td>
   
     <td>
        <p class="main_p">    
     <?= $owner['about'] ? $owner['about'] : '' ?>
    
   </p>
     </td>

    
       <td>
        <a href="edit_owner.php?ownerId=<?= $owner['id'] ?>">
          <button type="button" class="table_btn mr-1">Edit</button>
          </a>
          <a href="edit_owner.php?ownerId=<?= $owner['id'] ?>&del=true">
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
            
            <a class="click_pointer" href="admin.php?manage=owners&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $ratings['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="admin.php?manage=owners&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
               
            </div>
