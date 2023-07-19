<?php
if(isset($_SESSION["uid"]))
{
 $uid=$_SESSION["uid"];
 $itms=trim($_POST["itm"],",");
 $pid=(int)$_POST["pid"];
 $itmarr=explode(",",$itms);
 $itmid="";
 foreach($itmarr AS $vl)
 {
	$fitm=explode("-",$vl);
	$tablecolumn=$fitm[0];
	$itm=$fitm[1]??"";
	$itmsql=mysqli_query($con,"SELECT t1.* FROM protometa AS t1 WHERE  t1.pid='$pid' AND t1.$tablecolumn='$itm'");
	$ritmsql=mysqli_fetch_assoc($itmsql);
	if(mysqli_num_rows($itmsql)==0)
	{
		$ins=mysqli_query($con,"INSERT INTO protometa SET  pid='$pid' , $tablecolumn='$itm' ");
		echo "INSERT INTO protometa SET  pid='$pid' , $tablecolumn='$itm' ";
	}
	$itmid.=",".$itm;
	
 }
  $itmid=trim($itmid,",");
  $witmid= $itmid!=""?"AND $tablecolumn NOT IN($itmid)":"";		
		mysqli_query($con,"DELETE FROM protometa WHERE  pid='$pid'  $witmid");
		echo "DELETE FROM protometa WHERE  pid='$pid' AND  $tablecolumn NOT IN($itmid) ";
}
//$itmarr=json_decode($itm,true);


?>