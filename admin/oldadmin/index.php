<?php  
ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL); 
 //phpinfo();
 session_name("folkcenteradmin");
	session_start();
	//phpinfo();
	
	include("../db_open.php");
	
	date_default_timezone_set("Asia/Tbilisi");
	mysqli_set_charset($con,"utf8");
	mb_internal_encoding("UTF-8");
	
	$Guid=$_SESSION['GuserID']??""; 
	
	include("functions/permissions.php");
	//$permission=permissions($Guid,$con);
	//var_dump($permission);
    //$pages= isset($permission[0]['page'])?$permission[0]['page']:"";

	$q1=mysqli_query($con,"SELECT * FROM admins WHERE Id='$Guid'");
	$dir="pages/";
	$gtimeout=$_SESSION['Gtimeout']??0;
if($gtimeout<time()){
	session_unset(); 
	session_destroy(); 
}
if(mysqli_num_rows($q1)>0){

	$PG="allorders";
	if(isset($_GET["page"])){
		$PG=$_GET["page"];
	}
   //$page=getpages($Guid,$PG,$pages,$con);
   //$permissions=getprm($Guid,$con,"");
    include("functions/getlang.php");
	include("view/inc/head.php");
	include("view/pages/".$PG.".php");
	
?>
<?php
	include("view/inc/foot.php");	
}else{
 include("view/pages/Glogin.php");
}
	include("../db_close.php");
?>