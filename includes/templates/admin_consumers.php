
    
   <?php  
   
   if (isset($_POST['edit_activation'])) {
      $table = "consumers";
      $statusActivate = 0;
      if ($_POST['edit_activation'] == "Activate") {
  $statusActivate = 1;
      }
      else {
         $statusActivate = 0;
      }
      $consumerId = $_POST['consumer_id'];
      
      $sql = "UPDATE $table SET status = ? WHERE id = ?";

      $dataUpdated = [
         $statusActivate , $consumerId
      ];

      $stat = exectureQuery($sql , $dataUpdated);    

    
   }
   
   ?>



<div class="mt-10"></div>
<h1 class="main_headline">Manage Consumers</h1>


<div class="table-content-table" style="overflow-x:auto;" >
  <table class="w-100">
    
  <tr class="table-thead-tr">
  <th>Image</th>
      <th>Name</th> 
    <th>Email</th> 
    <th>Civil Registry</th> 
    <th>Date</th> 
    <th>Phone Number</th>  
    <th>Status</th> 
    <th class="th-actions">Actions</th>
  </tr>
    
        <?php  
           $consumers = selectAllWithPagination("consumers");
           foreach($consumers['results'][0] as $cons ) { ?>
          <tr class="table-tbody-tr">
     
     <td>
     <img style="max-height: 4.5rem" src="<?= $cons['image'] ? BASE_URL . '/assets/uploads/' .  $cons['image'] : 'https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png' ?>" alt="consumer"> 
     </td>
   
     <td>
     <?= $cons['name'] ? $cons['name'] : '' ?>
     </td>
     <td>
     <?= $cons['email'] ? $cons['email'] : '' ?>
     </td>
   
     <td>
     <?= $cons['date'] ? $cons['date'] : '' ?>
     </td>
   
     <td>
     <?= $cons['civil_registry'] ? $cons['civil_registry'] : '' ?>
     </td>
   
     <td>
     <?= $cons['phone_number'] ? $cons['phone_number'] : '' ?>
     </td>

     <td>
     <form action="" method="POST" >
     <?php 
     if ($cons['status'] == 0) {
      echo '<button type="submit" name="edit_activation" class="table_btn" value="Activate" >Activate</button>';
   }
else {
      echo '<button type="submit" name="edit_activation" class="table_btn prev_bg" value="Dectivate" >Dectivate</button>';
   }

     ?>
       <input type="hidden" name="consumer_id" value="<?= $cons['id'] ?>" >
     </form>
     </td>
   
       <td>
       
         <a href="edit_consumer.php?consId=<?= $cons['id'] ?>">
          <button type="button" class="table_btn mr-1">Edit</button>
          </a>

          <a href="edit_consumer.php?consId=<?= $cons['id'] ?>&del=true">
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
            
            <a class="click_pointer" href="admin.php?manage=consumers&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $ratings['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="admin.php?manage=consumers&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
               
            </div>
