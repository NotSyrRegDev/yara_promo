<?php


function is_user_logged_in_web() {
    if (isset($_SESSION['id'])) {
        return true;
    }
    return false;
}


function getTitle() {
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo "Default";
    }
}

function include_loading()
{
    include 'includes/templates' . '/loading.php';
}

function include_camera()
{
    include 'includes/templates' . '/camera_focus.php';
}

function tabs_logic()
{
    include 'includes/templates' . '/tabs_logic.php';
}

function redirect($redirect = '/index.php') {
    header('location: ' . BASE_URL . $redirect );

    exit(0);
}


function user_grap_values()
{
 
    $usersArray = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => sha1($_POST['password']),
        'refere' => $_POST['refere'],
        'refere_id' => 0,
        'user_group_id' => 0,
    ];
    if ($_POST['refere'] == 'consumer') {
       $usersArray['user_group_id'] = 2;
    }

    if ($_POST['refere'] == 'controller') {
        $usersArray['user_group_id'] = 3;
    }
    
    if ($_POST['refere'] == 'employee') {
        $usersArray['user_group_id'] = 4;
    }

    if ($_POST['refere'] == 'enterpise') {
        $usersArray['user_group_id'] = 5;
    }
    

   
    if (isset($_POST['refere_enterpise'])) {
        unset($_POST['refere_enterpise']);
    }
    unset($_POST['refere_id']);
    unset($_POST['signup_user']);

    return $usersArray;
}

function facility_grap_values()
{
    $arrayArgs = [
        'facility_name' => $_POST['facility_name'],
        'commercial_register' => $_POST['commercial_register'],
        'number' => $_POST['number'],
        'activity' => $_POST['activity'],
        'city' => $_POST['city'],
        'district' => $_POST['district'],
        'street' => $_POST['street'],
        'owner_id' => 0,
      ];
      unset($_POST['facility_name']);
      unset($_POST['commercial_register']);
      unset($_POST['number']);
      unset($_POST['location']);
      unset($_POST['activity']);
      unset($_POST['city']);
      unset($_POST['district']);
      unset($_POST['street']);
      return $arrayArgs;
}


function determine_signup(  )
{

    $postion = $_GET['postion'];
    
    switch($postion) {

        case $postion == "consumer":
            include 'includes/templates' . '/consumer.php';
            break;

        case $postion == "controller":
            include 'includes/templates' . '/controller.php';
            break;

        case $postion == "enterpise":
            include 'includes/templates' . '/enterpise.php';
            break;

        case $postion == "employee":
            include 'includes/templates' . '/employee.php';
            break;

        case $postion == "signup":
            include 'includes/templates' . '/singform.php';
            break;
        

        default:
        include 'includes/templates' . '/singform.php';


    }


}