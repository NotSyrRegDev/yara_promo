    
 
   <?php  
   
   if (isset($_POST['edit_activation'])) {
      $table = "employees";
      $statusActivate = 0;
      if ($_POST['edit_activation'] == "Activate") {
  $statusActivate = 1;
      }
      else {
         $statusActivate = 0;
      }
      $employId = $_POST['employ_id'];
      
      $sql = "UPDATE $table SET status = ? WHERE id = ?";

      $dataUpdated = [
         $statusActivate , $employId
      ];

      $stat = exectureQuery($sql , $dataUpdated);    

    
   }
   
   ?>

<div class="mt-10"></div>
<h1 class="main_headline">Manage Employess</h1>


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
           $employess = selectAllWithPagination("employees");
           foreach($employess['results'][0] as $emp ) { ?>
          <tr class="table-tbody-tr">
     
     <td>
     <img style="max-height: 4.5rem" src="<?= $emp['image'] ? BASE_URL . '/assets/uploads/' . $emp['image'] : 'https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/man5-512.png' ?>" alt="empumer"> 
     </td>
   
     <td>
     <?= $emp['name'] ? $emp['name'] : '' ?>
     </td>

     <td>
     <?= $emp['email'] ? $emp['email'] : '' ?>
     </td>
   
   
   
     <td>
     <?= $emp['civil_registry'] ? $emp['civil_registry'] : '' ?>
     </td>
   
     <td>
     <?= $emp['postion'] ? $emp['postion'] : '' ?>
     </td>
   
     <td>
     <?= $emp['job_id'] ? $emp['job_id'] : '' ?>
     </td>

     <td>
     <?= $emp['date'] ? $emp['date'] : '' ?>
     </td>
   
     <td>
     <?= $emp['phone_number'] ? $emp['phone_number'] : '' ?>
     </td>

     <td>
     <form action="" method="POST" >
     <?php 
     if ($emp['status'] == 0) {
      echo '<button type="submit" name="edit_activation" class="table_btn" value="Activate" >Activate</button>';
   }
else {
      echo '<button type="submit" name="edit_activation" class="table_btn prev_bg" value="Dectivate" >Dectivate</button>';
   }

     ?>
       <input type="hidden" name="employ_id" value="<?= $emp['id'] ?>" >
     </form>
     </td>
   
     <td>
        <p class="main_p">    
     <?= $emp['about'] ? $emp['about'] : '' ?>
    
   </p>
     </td>

    
       <td>
        <a href="edit_employee.php?empId=<?= $emp['id'] ?>">
          <button type="button" class="table_btn mr-1">Edit</button>
          </a>
          <a href="edit_employee.php?empId=<?= $emp['id'] ?>&del=true">
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
            
            <a class="click_pointer" href="admin.php?manage=employees&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button class="action_pagg_btn prev_bg" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $ratings['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="admin.php?manage=employees&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button class="action_pagg_btn next_bg" >Next</button>
        </a>
        </li>
        </ul>
               
            </div>
