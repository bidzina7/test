<?php
include("functions.php");
$username=mysqli_real_escape_string($con,$_POST["username"]);
$password=mysqli_real_escape_string($con,$_POST["password"]);
$password=encrypt_decrypt("encrypt",$password);
//echo $password;
if($username!=""){
	//echo "SELECT id FROM admins WHERE username='".$username."' AND password='".$password."' AND type!=0 AND password!=''";
	$q1=mysqli_query($con,"SELECT id FROM admins WHERE username='".$username."' AND password='".$password."' AND type!=0 AND password!=''");
	if(mysqli_num_rows($q1)>0){
		$r1=mysqli_fetch_array($q1);
		$_SESSION['GuserID']=$r1["id"]; 
		$_SESSION["timeout"]=time()+60*60*24*7;
		echo 1;		
	}else{
		echo "username ან პაროლი არასწორია";
	} 

}else{
		echo "მიუთითეთ ელფოსტა";	
}

?>