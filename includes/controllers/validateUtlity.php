<?php

 
function validatePost($post , $checkedConds = [] , $tablename , $checkFor = '' ) {
    $errors = array();
    $i = 0;
    foreach($checkedConds as $key => $value) {
       if (empty($post[$key])) {
         array_push($errors , "Field $value Required");
       }
    }


    // // IF THERE IS NO ERRORS

    // CHECHK IF EMAIL ALREADY EXIST
    //selectOne($tablename , [$checkFor => $post[$checkFor] ])
    $existingPost = true;
    if (!empty($checkFor)) {

      $existingPost = selectOne($tablename, [$checkFor => $post[$checkFor]]);
    }
    if ($existingPost) {

      // CHECKING IS USER TRYING TO UPDATE OR CREATE NEW POST
      // CHECING ALSO IF THE POST IN THE DATABASE IS NOT THE POST TRYING TO UPDATE
      if ( isset($post['update-post']) &&  $existingPost['id'] != $post['id'] ) {
        array_push($errors , 'Post with that title is already exist');
      }

      if (isset($post['add-post'])) {
        array_push($errors , 'Post with that title is already exist');
      }
    
    }

    return $errors;
  } 

  function validateUser($user) {
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    if ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'Password do not match');
    }

    // $existingUser = selectOne('users', ['email' => $user['email']]);
    // if ($existingUser) {
    //     array_push($errors, 'Email already exists');
    // }

    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser) {
        if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {
            array_push($errors, 'Email already exists');
        }

        if (isset($user['create-admin'])) {
            array_push($errors, 'Email already exists');
        }
    }

    return $errors;
  }

   // FUNCTION FOR VALIDATING USER LOGIN
  function validateLogin($user) {
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    return $errors;
  }

  function checkPasswordForUser($confirmVal , $passCol , $tablename , $whereCol ) {
    $email = $_SESSION['userLoggedIn'];
    $pws = $_POST["$confirmVal"];
    $query = mysqli_query($connection , "SELECT $passCol FROM $tablename WHERE $whereCol = '$email'");
    $record = mysqli_fetch_array($query);
    $hashPwd = md5($pws);
    $pwdFromDb = $record["$passCol"];
 
    if ($pwdFromDb == $hashPwd) {
    return true;
  } else {
    return false;
  }

  }

  
  function loginUser($user)
{
   

    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['user_pic'] = $user['image'];
    $_SESSION['admin'] = $user['user_group_id'];
    $_SESSION['refere'] = $user['refere_id'];
    $_SESSION['position'] = $user['refere'];

    header('location: ' . BASE_URL . 'home.php');
    // if ($_SESSION['admin']) {
    //     header('location: ' . BASE_URL . '/admin/index.php'); 
    // } else {
    //     header('location: ' . BASE_URL . '/index.php');
    // }
    exit();
}

function signInUser($user , $checkedConds , $tablename , $checkFor) {
  unset($_POST['login_user']);
  global $errors;
  $errors = validatePost($user , $checkedConds , $tablename , $checkFor );


  if (count($errors) == 0) {
    $selectdUser = selectOne($tablename , [$checkFor => $user[$checkFor] ] );
   
    if ($selectdUser === null) {
    
      array_push($errors , "No Such Email");
    
    }
  

    if ($selectdUser && sha1($user['password']) == $selectdUser['password']  ) {
  
      loginUser($selectdUser);
    } else {
     
      array_push($errors , "Wrong Credentials");
     
    }
  }
}

function logoutUser($destroySessions , $redirect = 'home.php') {

  foreach($destroySessions as $key => $value) {
    unset($_SESSION[$value]);
  }

  session_destroy();
  header('location: ' . BASE_URL . "$redirect");
   
}

function singUpUser($signupUser = [] , $table , $twoOptions = false , $arrayArgs = [] , $tableTwo = '' , $thirdOptions = false , $arrayThird = [] , $tableThree = '' ) {

  if (isset($_POST['sign_as_double'])) {
    unset($_POST['sign_as_double']);
  }


  global $errors;

  $checkArrays = [];

  if ( $_POST['refere'] == 'consumer' ) {
    $checkArrays = [
      'name' => 'User Name' ,
      'email' => 'User Email' ,
      'password' => 'User Password',
      'civil_registry' => 'Civil Registry',
      'date' => 'Date',
      'phone_number' => 'Phone Number',
      ];
  }

  if ( $_POST['refere'] == 'controller' ) {
    $checkArrays = [
      'name' => 'User Name' ,
      'email' => 'User Email' ,
      'password' => 'User Password',
      'civil_registry' => 'Civil Registry',
      'job_id' => 'Date',
      'phone_number' => 'Phone Number',
      ];
  }

  if ( $_POST['refere'] == 'employee' ) {
    $checkArrays = [
      'name' => 'User Name' ,
      'email' => 'User Email' ,
      'password' => 'User Password',
      'date' => 'Date',
      'civil_registry' => 'Civil Registry',
      'job_id' => 'Job Id',
      'phone_number' => 'Phone Number',
      'postion' => 'Postion',
      ];
  }

  if ( $_POST['refere'] == 'enterpise' ) {

  
    $checkArrays = [
      'name' => 'User Name' ,
      'email' => 'User Email' ,
      'password' => 'User Password',
      'date' => 'Date',
      'civil_registry' => 'Civil Registry',
      'job_id' => 'Job Id',
      'phone_number' => 'Phone Number',
      'postion' => 'Postion',
      // 'facility_name' => 'Facility Name',
      // 'number' => 'Facility Number',
      // 'commercial_register' => 'Facility Commercial Register',
      // 'activity' => 'Facility Activity',
      // 'city' => 'Facility City',
      // 'district' => 'Facility District',
      // 'street' => 'Facility Street',
      ];
  }


      unset($_POST['refere']);
       // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
 
$errors = validatePost($_POST , $checkArrays , $table , 'email');
unset($_POST['password']);

if (count($errors) == 0) {

  if ($twoOptions) {

    // FACILITY OWNERS
    $refered_id = create($tableTwo , $_POST);

    $signupUser['refere_id'] = $refered_id;

    // CREATEING IN USERS TABLE
    $user_id = create($table , $signupUser);

    $user = selectOne($table, ['id' => $user_id]);

    if ($thirdOptions) {
      $arrayThird ['owner_id'] = $refered_id;
      $arrayThird ['owner_name'] = $user['name'];
      $facility_id = create( $tableThree , $arrayThird  );



      $sql = "UPDATE $tableTwo SET agency_refere  = ? WHERE id = ?";

      $dataUpdated = [
         $facility_id , $refered_id
      ];
  
      $stat = exectureQuery($sql , $dataUpdated);    

    }
    loginUser($user);
  }
  
  

}

}