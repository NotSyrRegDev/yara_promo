  
  
    <?php  
   
   if (isset($_POST['edit_activation'])) {
      $table = "controllers";
      $statusActivate = 0;
      if ($_POST['edit_activation'] == "Activate") {
  $statusActivate = 1;
      }
      else {
         $statusActivate = 0;
      }
      $controllerId = $_POST['controller_id'];
      
      $sql = "UPDATE $table SET status = ? WHERE id = ?";

      $dataUpdated = [
         $statusActivate , $controllerId
      ];

      $stat = exectureQuery($sql , $dataUpdated);    

    
   }
   
   ?>


<div class="mt-10"></div>
<h1 class="main_headline">Manage Controllers</h1>


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
           $controllers = selectAllWithPagination("controllers");
           foreach($controllers['results'][0] as $controller ) { ?>
          <tr class="table-tbody-tr">
     
     <td>
     <img style="max-height: 4.5rem" src="<?= $controller['image'] ? BASE_URL . '/assets/uploads/' . $controller['image'] : 'https://cdn-icons-png.flaticon.com/512/147/147142.png' ?>" alt="controllerumer"> 
     </td>
   
     <td>
     <?= $controller['name'] ? $controller['name'] : '' ?>
     </td>
     <td>
     <?= $controller['email'] ? $controller['email'] : '' ?>
     </td>
   
     <td>
     <?= $controller['date'] ? $controller['date'] : '' ?>
     </td>
   
     <td>
     <?= $controller['civil_registry'] ? $controller['civil_registry'] : '' ?>
     </td>
   
     <td>
     <?= $controller['phone_number'] ? $controller['phone_number'] : '' ?>
     </td>

     <td>
     <form action="" method="POST" >
     <?php 
     if ($controller['status'] == 0) {
      echo '<button type="submit" name="edit_activation" class="table_btn" value="Activate" >Activate</button>';
   }
else {
      echo '<button type="submit" name="edit_activation" class="table_btn prev_bg" value="Dectivate" >Dectivate</button>';
   }

     ?>
       <input type="hidden" name="controller_id" value="<?= $controller['id'] ?>" >
     </form>
     </td>
   
       <td>
         
       
       <a href="edit_controller.php?conId=<?= $controller['id'] ?>">
          <button type="button" class="table_btn mr-1">Edit</button>
          </a>

          <a href="edit_controller.php?conId=<?= $controller['id'] ?>&del=true">
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
            
            <a class="click_pointer" href="single_owner.php?entId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $ratings['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="admin.php?entId=<?= $_SESSION['refere'] ?>&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
               
            </div>
