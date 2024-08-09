<?php
@session_start();

// System
define( 'TTH_SYSTEM', true );
$_SESSION["language"] = (!empty($_SESSION["lang_admin"]) && isset($_SESSION["lang_admin"])) ? $_SESSION["lang_admin"] : 'vi';
require_once(str_replace( DIRECTORY_SEPARATOR, '/', dirname( __file__ ) ) . '/define.php');
require_once(ROOT_DIR . DS ."lang" . DS . TTH_LANGUAGE . ".lang");
//include_once(_F_FUNCTIONS . DS . "Function.php");
//include_once(_A_FUNCTIONS . DS . "Function.php");
//require_once('..' . DIRECTORY_SEPARATOR . 'define.php');
//include_once(_A_FUNCTIONS . DS . "Function.php");
spl_autoload_register(function($classname) {
    $paths = [
        _F_CLASSES . DS . $classname . ".class.php",
        _F_CLASSES . DS . $classname . ".php",
        _F_CLASSES . DS . "class." . $classname . ".php",
        _F_CLASSES . DS . str_replace('_', DS, $classname) . ".php",
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            include($path);
            return;
        }
    }
});

//include_once(_F_INCLUDES . DS . "_tth_constants.php");

//require_once(ROOT_DIR . DS . ADMIN_DIR . DS . '_check_login.php');
//if($login_true) {
	//include_once(_A_FUNCTIONS . DS . "ContentManager.php");
	//include_once(_A_FUNCTIONS . DS . "CoreDashboard.php");

	$url =  isset($_POST['url']) ? $_POST['url'] : 'notfound';

	if (file_exists(_F_ACTIONS . DS . $url .".php" )) {
        //$corePrivilegeSlug = array();
        //$corePrivilegeSlug = corePrivilegeSlug();
		include (_F_ACTIONS . DS . $url .".php" );
	}
	else die();

//}
//else echo "<script>window.location.href = '".ADMIN_DIR."';</script>";
?>
