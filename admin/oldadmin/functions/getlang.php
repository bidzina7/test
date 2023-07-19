<?php
$languagename='';
$languageshortname='';
$langdefault='';
$lngdefname='';
$lngs=mysqli_query($con,"SELECT * FROM languages WHERE active='1' ");
while($rlngs=mysqli_fetch_assoc($lngs))
{
	$languagename.=','.$rlngs['name'];
	$languageshortname.=','.$rlngs['shortname'];
	$langdefault.=','.$rlngs['main'];
	if($rlngs['main']==1)
	{
		$lngdefname=$rlngs['shortname'];
	}
}
if($languagename!=''&&$languageshortname!='')
{
	$languagename=ltrim($languagename,',');
	$languageshortname=ltrim($languageshortname,',');
	$langdefault=ltrim($langdefault,',');
}
$lnarr=explode(',',$languagename);
$lnshortarr=explode(',',$languageshortname);
// echo $langdefault;
$langdefaultarr=explode(',',$langdefault);
function languages($table_name,$table_id,$table_column,$alias='',$in='',$multicol='')
{
	//$alias='';
	$inleng ='';
	
	$IN=$in!='IN'?" tableId = $table_id":" tableId IN($table_id) ";
	$columnvalue=$in!='IN'?"columnValue":"GROUP_CONCAT(columnValue)";
    $tablecol="";
    $colval="";
	if($multicol!='')
	{
		$colarr=explode(",",$table_column);
		$i=0;
		while($i<count($colarr))
		{
		$colval .=" tableColumn='".$colarr[$i] ."' OR ";
		$i++;
		}
	//	echo $i;
		$colval=(rtrim($colval ,"OR "));
		$tablecol="($colval )";
	//	$columnvalue="GROUP_CONCAT(columnValue GROUP BY tableId  SEPARATOR ';')"; 
	}
	else
	{
		 $tablecol=" tableColumn='$table_column'";
	}
	for($i=0;$i<count($GLOBALS['lnarr']);$i++)
	{
		
		$lnalias=$alias==''?$table_column . $GLOBALS['lnshortarr'][$i]:$alias.$GLOBALS['lnshortarr'][$i];
		$inleng .="(SELECT $columnvalue FROM langs WHERE shortname='". $GLOBALS['lnshortarr'][$i] ."' AND tableName='$table_name' AND $tablecol  AND $IN  LIMIT 1) AS $lnalias,";
		//echo $inleng;
	}
   $inleng=rtrim($inleng,",");
	return $inleng;
}
?>