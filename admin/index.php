<?php
//phpinfo();
 session_name("nbradmin");
session_start();
header('Access-Control-Allow-Origin: *');
header("cache-control: no-cache, max-age=0, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*header("X-Frame-Options: deny");
header("X-XSS-Protection: 1; mode=block");

header("X-Content-Type-Options: nosniff");*/
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
} 
// Create connection


	include("../db_open.php");	
 mysqli_set_charset($con,"utf8");
// mysqli_query($con,"SET profiling = 1;");
// $query="SELECT * FROM users";
// $result = mysqli_query($con,$query);
// $query="SELECT * FROM admins";
// $result = mysqli_query($con,$query);
// $exec_time_result=mysqli_query($con,"SELECT query_id, SUM(duration),min(seq) seq,state,count(*) numb_ops,round(sum(duration),5) sum_dur, round(avg(duration),5) avg_dur,round(sum(cpu_user),5) sum_cpu, round(avg(cpu_user),5) avg_cpu  FROM information_schema.profiling GROUP BY query_id ORDER BY query_id DESC ");

// while($exec_time_row = mysqli_fetch_array($exec_time_result)){
	// var_dump($exec_time_row);
// }

 // echo "<p>Query executed in ".$exec_time_row[1].' seconds';
if(!isset($_COOKIE["lang"]))
{
	setcookie('lang', 'ka', time()+7200, '/');
}
$lang= mysqli_real_escape_string($con,$_COOKIE["lang"]??"");

$Guid=$_SESSION['GuserID']??"";
// var_dump($_POST);
$BASE= "https://nbr.webdoors.ge/admin/";
//echo $BASE;
$url = $_SERVER['REQUEST_URI']??"";
//$path = $_SERVER['REDIRECT_URL']??"";
$url=str_replace("/?","?",$url);
$url=str_replace("?","/?",$url);
$parts = explode('/',$url);
array_shift($parts);
$i=1;
foreach($parts as $part){
	$p="p".$i;
	$$p=mysqli_real_escape_string($con,$part);
	if(strpos($$p,"?")===0){
		$$p="";
	}
	$i++;
}


if (in_array($p1,["ka"])) {
	$lang = ($p1 == "ka"?"ge":$p1);
}
	$LA= ($lang == "ge"?"ka":$lang);
if ($LA == "") {
	$LA = "ka";
}
if ($LA == "ka") {
	$LN = "ge";
}
if($lang==""&&$p1!='ka'){
	$lang="ka";
}

setcookie('lang', $lang, time()+7200, '/');

 //$p1==""&&$p1!="ka"?header('Location:'. $BASE .$LA ."/"):"";



if(empty($p3)||$p3==""){
	$p="login";
}else{
	$p=$p3;
}
$L=$LA;
$LN=$lang;
if($url=="/"){
	$url="/".$L;
};

if(substr($url,-1)!="/"){
	$url=$url."/";
} 


if(!in_array($p1,["ka", "in",$LA])){
	//header("location: /$LA/");
	$LA='ka';
}

// if($p2=='hosting'&&$_SERVER['REMOTE_ADDR']!='46.49.60.19')
// {
	// $p='home'; 
// }
$ltb=$LA=="ka"?"":$LA;
require_once("functions/permissions.php");	
require_once("pages.php");	 
 include("functions/pagination.php");
include("functions/getlang.php");
include("lang/".$L.".php");
include("view/inc/head.php");
$Guid!=''?include("view/inc/header.php"):"";
include("view/pages/".$p.".php");
include("view/inc/foot.php");
	include("db_close.php");	
?>
