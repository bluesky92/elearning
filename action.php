<?php
@session_start();

// System
define( 'TTH_SYSTEM', true );

require_once(str_replace( DIRECTORY_SEPARATOR, '/', dirname( __file__ ) ) . '/define.php');
require_once(ROOT_DIR . DS ."lang" . DS . TTH_LANGUAGE . ".lang");
include_once(_F_FUNCTIONS . DS . "Function.php");
try {
	$db =  new ActiveRecord(TTH_DB_HOST, TTH_DB_USER, TTH_DB_PASS, TTH_DB_NAME);
}
catch(DatabaseConnException $e) {
	echo $e->getMessage();
}
include_once(_F_INCLUDES . DS . "_tth_constants.php");

$url = isset($_REQUEST['url']) ? (string) $_REQUEST['url'] : '-no-';
$url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
$account["id"] = empty($_SESSION["personnel"]) ? 0 : intval($_SESSION["personnel"]);
if (file_exists(_F_ACTIONS . DS . $url .".php" )) {
	include (_F_ACTIONS . DS . $url .".php" );
}
else die();
/*
$url1 =  isset($_POST['url']) ? $_POST['url'] : 'notfound';
if (file_exists(_F_ACTIONS . DS . $url1 .".php" )) {
        //$corePrivilegeSlug = array();
        //$corePrivilegeSlug = corePrivilegeSlug();
		include (_F_ACTIONS . DS . $url1 .".php" );
	}
	else die();

*/

