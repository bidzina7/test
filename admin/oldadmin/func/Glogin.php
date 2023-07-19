<?php  
	
	ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
	include("functions.php");

	date_default_timezone_set("Asia/Tbilisi");
	$a=mysqli_real_escape_string($con,$_POST["a"]);
	$b=mysqli_real_escape_string($con,$_POST["b"]);
	$c=mysqli_real_escape_string($con,$_POST["c"]);

	$pass=encrypt_decrypt("encrypt",$b);
	//echo "SELECT * FROM admins WHERE user='$a' AND password='$pass'";
	$q1=mysqli_query($con,"SELECT * FROM admins WHERE USER='$a' AND password='$pass'");

//echo "SELECT * FROM admins WHERE name='$a' AND password='$pass'";
	$r1=mysqli_fetch_array($q1);
			
		
if(mysqli_num_rows($q1)>0){
	// $q2=mysqli_query($con,"SELECT * FROM sms WHERE tel='".$r1['tel']."' ORDER BY id DESC LIMIT 1 ");
	// $r2=mysqli_fetch_assoc($q2);
// if($r1["sms"]=="1"){
	 // if($c==$r2['code'])
	 // {
	// $_SESSION['GuserID']=$r1["Id"];
	// $_SESSION['Gtimeout']=time()+60*60*24;
	// echo 1; 
	// // echo "-".$_SESSION['GuserID'];
	 // }else{
		 // echo 0;
	 // }
// }else{
	$_SESSION['GuserID']=$r1["Id"];
	$_SESSION['Gtimeout']=time()+60*60*24;
	echo 1; 
	// echo "-".$_SESSION['GuserID'];	
//}

}else{
	 echo 0;	
}
?>