<?php  
 $controllers = "includes/controllers";
include $controllers . '/controllers.php';

 ob_start();

 session_start();

 define("ROOT_PATH_MAIN", realpath(dirname(__FILE__)));

 define("BASE_URL", "http://localhost/php_projects/");

 $templates = "includes/templates";
 $languages = "includes/languages";
 $functions = "includes/functions";


 $cssAssets = "assets/css";
 $jsAssets =  "assets/js";
 $imgAssets =  "assets/images";

$errors = array();



//   require_once BASE_URL . '/includes/utility/myPhpUtility.php'; 


 include $functions . '/functions.php';
 include $templates . '/header.php';
 include $templates . '/footer.php';




 

?>