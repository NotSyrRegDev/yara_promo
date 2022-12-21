<?php


  // MIDDLE WARES
  function usersOnly($redirect = 'home.php') {
    
    if (empty($_SESSION['id'])) {
        $_SESSION['message'] = "You Need To Login First";
        $_SESSION['type'] = 'error';
        header('location: ' . $BASE_URL . $redirect );

        exit(0);
    }
  }

  function adminOnly($redirect = 'home.php') {



    $checkUserId = $_SESSION['id'];
 
     $condections = array(
       'user_group_id' => 1,
       'user_email' => $_SESSION['email']
     );
    $checkAdmin = checkThingInDb('joinedusers' , 'id' , $condections);
  
    if (!$checkAdmin) {
        $_SESSION['message'] = "You Are Not Authorized To Preform This Action";
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect );

        exit(0);
    }
  }

  function guestsOnly($redirect = 'home.php') {

    if (isset($_SESSION['id']) ) {

        header('location: ' . BASE_URL . $redirect );

        exit(0);
    }
  }

  