<?php
 session_name("Hgn");
session_start();

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$UID="";
$ADMINID="";
$ordid="";
$merchid="";
if(isset($_SESSION["GuserID"]))
{$ADMINID=(int)$_SESSION["GuserID"];}

if(isset($_SESSION['uid']))
	{
$uid=$_SESSION["uid"];



date_default_timezone_set("Asia/Tbilisi");
		include("functions.php");
		include("../db_open.php");
		include("../functions/getlang.php");
		include("../functions/permissions1.php");
mysqli_set_charset($con,"utf8");


$id=isset($_GET["id"])?(int)$_GET["id"]:"";
$lang="ge";  
if(isset($_GET["ln"]))
{
$lang=mysqli_real_escape_string($con,$_GET["ln"]);
}

//include("../lang/".$lang.".php");
$id=(int)$_GET["id"];
$contact=mysqli_query($con,"SELECT t1.*,
                                    ". languages('contact','t1.id','title') .",
                                    ". languages('contact','t1.id','address') ." FROM contact AS t1 ");
$rcontact=mysqli_fetch_assoc($contact);
 $auth=mysqli_query($con,"SELECT authors,purpos,dephead FROM protocol WHERE id='$id'" );
  $rauth=mysqli_fetch_assoc($auth);
  if(mysqli_num_rows($auth)>0)
  {
	$rt=$rauth["authors"]!=''?$rauth["authors"]:0; 
	$rdt=$rauth["dephead"]!=''?$rauth["dephead"]:0; 
	$prp=$rauth["purpos"]!=''?$rauth["purpos"]:0; 
  }
		
	$proto=mysqli_query($con,"SELECT t1.*, (t1.ru+t1.en+t1.ka) AS lngs, ". languages('protocol','t1.id','name') .", ". languages('purposes',$prp ,'name','purpname1','IN') .",". languages('products','t1.product','name','productname') .",". languages('protocol','t1.id','comment') .",
                                             (SELECT firstname FROM users WHERE id=t1.id)	AS firstname,		
                                             (SELECT lastname FROM users WHERE id=t1.id)	AS lastname,
											 (SELECT firstnameen FROM users WHERE id=t1.id)	AS firstnameen,		
                                             (SELECT lastnameen  FROM users WHERE id=t1.id)	AS lastnameen,	
                                             (SELECT firstnameru FROM users WHERE id=t1.id)	AS firstnameru,		
                                             (SELECT lastnameru FROM users WHERE id=t1.id)	AS lastnameru,	
											  ". languages('protocol','t1.id','companyname') ." ,
											  ". languages('protocol','t1.id','location') ." ,
											  ". languages('users','t1.uid','address') ." ,		
											  ". languages('users','t1.labhead','headfirstname') ." ,		
											  ". languages('users','t1.labhead','headlastname') ." ,		
											  ". languages('protocol','t1.id','purpname') ." ,
                                             (SELECT CONCAT(firstname,' ',lastname,' ') FROM users WHERE id = t1.labhead)	AS headname,		
                                             (SELECT CONCAT(firstnameen,' ',lastnameen,' ') FROM users WHERE id = t1.labhead)	AS headnameen,		
                                             (SELECT CONCAT(firstnameru,' ',lastnameru,' ') FROM users WHERE id = t1.labhead)	AS headnameru,		
											 (SELECT CONCAT(firstname,' ',lastname,' ') FROM users WHERE id = t1.dephead)	AS headdep,		
											 (SELECT CONCAT(firstnameen,' ',lastnameen,' ') FROM users WHERE id = t1.dephead)	AS headdepen,		
											 (SELECT CONCAT(firstnameru,' ',lastnameru,' ') FROM users WHERE id = t1.dephead)	AS headdepru,		
                                             (SELECT pid FROM users WHERE id=t1.uid)	AS personalid,
											 (SELECT fields FROM products WHERE id=t1.product)	AS fldid,	
                                             (SELECT childs FROM protomethods WHERE id=t1.method)	AS methchild												 
											 FROM protocol as t1 WHERE t1.id='$id' ");
			$rproto=mysqli_fetch_assoc($proto);
			$fldid=$rproto["fldid"]==""?0:$rproto["fldid"];
			mysqli_num_rows($proto)==0?die("not found! "):"";
			$perc=($rproto["norm"]==1?20 .'%':25 ."%");
			 
            $printdate=(int) strtotime($_GET["daterange"]);
			//$printdate=($printdate<(int)$rproto["date"]?$rproto["date"]:$printdate);
		
			// echo "SELECT ". languages('protofields','t1.fieldid','name','purpname') ." FROM protometa AS t1 WHERE t1.pid IN(SELECT id FROM protocol WHERE id='$id' )  ";
			// echo "SELECT ". languages('protofields','t1.fieldid','name','purpname' ) ." FROM protometa AS t1 WHERE  t1.fieldid IN(SELECT id FROM protofields WHERE parents='') ";
			//echo "SELECT ". languages('protofields','t1.fieldid','name','purpname' ) ." FROM protometa AS t1 WHERE  t1.fieldid IN(SELECT id FROM protofields WHERE parents='') ";
			
 ob_start(); ?>
<html>
<head>
<title>ჰიგიენა</title>
<meta  charset=utf-8" />

<link href="../css/pdf/jquery-ui-1.10.3.custom.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="../css/pdf/print.css" />

<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/jquery.js"></script>
<script src="js/myscripts.js" type="text/javascript"></script>




</head>
<body>

<center>

 
	<!--=========================CONTENT========================-->
    <!--<div class="content_div1" style="padding-bottom:10px;">  -->
		
		<!--<style>@page { size: A4 }</style>-->
		
          	
<div class="laboqmi"  >
  

<?php
						                $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
												$purps=mysqli_query($con,"SELECT ". languages('protofields','t1.fieldid','purpose','purpname' ) ." FROM protometa AS t1 WHERE t1.pid IN(SELECT id FROM protocol WHERE id='$id') AND t1.fieldid IN(SELECT id FROM protofields WHERE parents='') "); 
											$purpname="";
											while($rpurps=mysqli_fetch_assoc($purps))
			                                {
				                              $purpname.=$rpurps["purpname".$lnshortarr[$z]] .",";
			                                }
											$purpname=rtrim($purpname,",");
											$lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";
											
											if($rproto[$lnshortarr[$z]]==1)
											{
												$c++;
										  include_once("../lang/".$lnshortarr[$z].".php");
	                                   ?> 
  <div class="labitms" style="padding-bottom:0px; overflow:hidden;">
    <div class="laboqmi1" > 

       <div style="width:100%">
	          <p style="  float:left; width:80px;"> 
            	<img border="0" src="../images/lgo1.jpg" width="80px"  style="float:left"  >
			  </p>
                   <p width="463px" style="float:left; text-align:center; margin:auto; padding:0px; vertical-align: baseline; height:80px; padding-top:14px;"> <font face="BalavMtavr" size="+4" valign="middle" ><b><?=$rcontact["title".$lnshortarr[$z]] ?></b></font></p>
						<?php
						  if($rproto["accreditation"]==0)
						  {
							  ?>
							 <p style="  float:right; width:80px; margin-top:-6px;"> 
						     <img border="0" src="../images/gac1.png"   style="  width:100%; height:80px; ">
						</p> 
						<?php
						  } 
						  ?>
		</div>			
		
                    <hr style="background:black; height:3px; border:black; margin-top:-5px" size="3" width="90%"/>
					 <font size="+3"><b><?=$w["Addr"] ?>:<?=$rcontact["address".$lnshortarr[$z] ] ?>&nbsp;<?=$w["Mail"] ?>: <a href="mailto:97norma@gmail.com"><?=$rcontact["email"] ?></a>; <?=$w["Tel"] ?>: <?=$rcontact["tel"] ?></b></font>
                    <p align="right"><font size="1"><?=date("d-m-Y",$printdate) ?></font></p>   
 <!-- barkodis dawyeba --> 


<script type="text/javascript" src="js/code39.js"></script>
    <style type="text/css">
  	#barcode {font-weight: normal; font-style: normal; line-height:normal; sans-serif; font-size: 12pt}
    </style>
<!--<div style="position:absolute; top:400px; left:35px; width:250px; height:150px" id="barcode">3259</div> -->

<div class="d-none" style="position: static; float:right; display:none" id="barcode">3259</div> 



 <!-- axali  barkodis damtavreba -->                   
                  <p align="center">  <font size="3"><b><?=$w["testreport"] ?><font face="Times New Roman"> №:</font></b> <?=$rproto["pnumb"] ?> <?=$rproto["editid"]!=0?".".$rproto["editid"]:"" ?></font></p>
                	<font size="2"><i><u><?=$w["titlamount"] ?></u> : </font></i><font face="Sylfaen" size="+1"><b><?=$rproto["name".$lnshortarr[$z]] ?></b></font><br>
					<?php
					     if(getprm($uid,'clients')==1)
						                 {
											 ?>
                    <font size="2"><i><u><?=$w["customer"] ?> </u>:</i></font><font size="+1"><b><i><?=$rproto["companyname".$lnshortarr[$z]] ?> </i></b></font><br>
					<?php
										 }
										    ?>
                    <font size="2"><u> <?=$rproto["methchild"]==1?$w["sampldata"] :$w["apldata"] ?></u>  : </font><font size="+1"><?=$rproto["actitle"] ?><br>
                   
                    <font size="2"><i><u><?=$w["Samplace"] ?></u> : </font></i><font size="+1"><b><?=$rproto["location".$lnshortarr[$z]] ?></b><br>

                    <font size="2"><i><u><?=$w["Startend"] ?> </u>: </i></font><font size="+1"><?=$rproto['creatdate']!=0?date("d.m.Y",$rproto['creatdate']):""  ?>-<?=$rproto['enddate']!=0?date("d.m.Y",$rproto['enddate']):"" ?>
					<br/>
                    <p align="justify"><font size="2"><i><u><?=$w["purpexam"] ?></u>  : </1> </font></i><font size="+1"><b><?=$rproto["purpname".$lnshortarr[$z]] ?> <?=$purpname ?> </b> <br>

					</font>

					</div>

<div class="laboqmi2"> 

<table border="1" width="100%" style="font-size:11px;" >

	<tr align="center" bgcolor="">

		<td width="<?=$perc ?>" align="center"><?=$w['Parameter'] ?></td>

		<td width="<?=$perc ?>" align="center"><?=$w['unit'] ?></td>

		<td width="<?=$perc ?>" align="center"><?=$w['result'] ?></td>

		<td width="<?=$perc ?>" align="center"><?=$w['exam'] ?></td>
		
		<?php
		     if($rproto["norm"]==1)
			 {
		?>
		<td width="<?=$perc ?>" align="center"><?=$w['norm'] ?></td>
			 <?php
			 }
			 ?>
				
		
		

	</tr>           
     <?php
	
		  $fields=mysqli_query($con,"SELECT t1.*, 
									         (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.fieldid AND tableColumn='name' AND shortname='".$lnshortarr[$z]."' ) AS fieldname". $lnshortarr[$z]."
									         FROM protometa AS t1 WHERE t1.pid='$id' AND (t1.fieldid IN(SELECT t2.id FROM protofields AS t2 WHERE (t2.parents=''   AND t2.product LIKE '%".$rproto['product']."%') OR (t2.id IN(SELECT parents FROM protofields WHERE product LIKE '%".$rproto['product']."%') ) ) )");
		     $i=0;						
			 while($rfields=mysqli_fetch_assoc($fields)) 
		 {
			 
			?>  
         <tr>
		 <td colspan="5" align="center" ><?=$rfields['fieldname'.$lnshortarr[$z]] ?></td>
		 </tr>
			<?php
			    $fields1=mysqli_query($con,"SELECT t1.*, 
		                                                          (SELECT unit FROM protofields WHERE id=t1.fieldid) AS unit,
		                                                          (SELECT columnValue FROM langs WHERE tableName='protometa ' AND  tableId=t1.id AND tableColumn='maxval' AND shortname='".$lnshortarr[$z]."' ) AS maxval". $lnshortarr[$z].",
																  (SELECT columnValue FROM langs WHERE tableName='protometa ' AND  tableId=t1.id AND tableColumn='minval' AND shortname='".$lnshortarr[$z]."' ) AS minval". $lnshortarr[$z].",
																  (SELECT columnValue FROM langs WHERE tableName='protometa ' AND  tableId=t1.id AND tableColumn='vl' AND shortname='".$lnshortarr[$z]."' ) AS vl". $lnshortarr[$z].",
																  (SELECT columnValue FROM langs WHERE tableName='protometa ' AND  tableId=t1.id AND tableColumn='exammethod' AND shortname='".$lnshortarr[$z]."' ) AS exammethod". $lnshortarr[$z].",
									                              (SELECT columnValue FROM langs WHERE tableName='protofields' AND  tableId=t1.fieldid AND tableColumn='name' AND shortname='".$lnshortarr[$z]."' ) AS fieldname". $lnshortarr[$z] .",
									                              (SELECT columnValue FROM langs WHERE tableName='units' AND  tableId=t1.unit AND tableColumn='name' AND shortname='".$lnshortarr[$z]."' ) AS unit". $lnshortarr[$z] .",
									                              (SELECT columnValue FROM langs WHERE tableName='examethods' AND  tableId=t1.exam AND tableColumn='name' AND shortname='".$lnshortarr[$z]."' ) AS exam". $lnshortarr[$z] ."
									                               FROM protometa AS t1 WHERE t1.pid='$id' AND t1.fieldid IN(SELECT id FROM protofields WHERE parents='".$rfields['fieldid']."' AND product LIKE '%".$rproto['product']."%' )");
         while($rfields1=mysqli_fetch_assoc($fields1))
		 {
		 ++$i;
		 /* $rfields1['exammethod'.$lnshortarr[$z]] */
		 ?>										 
		 <tr>
		 <td width="<?=$perc ?>">  <?=$rfields1['fieldname'.$lnshortarr[$z]] ?> </td>
		 <td width="<?=$perc ?>"> <?=$rfields1['unit'.$lnshortarr[$z]] ?> </td>
		 <td width="<?=$perc ?>"><?=$rfields1['vl'.$lnshortarr[$z]] ?></td>
		 <td width="<?=$perc ?>"><?=$rfields1['exam'.$lnshortarr[$z]] ?></td>
		 <?php
		     if($rproto["norm"]==1)
			 {
		?>
		 <td width="<?=$perc ?>" align="center"><?=$rfields1["minval".$lnshortarr[$z]]==''||$rfields1["maxval".$lnshortarr[$z]]==''?$rfields1["minval".$lnshortarr[$z]] ." ". $rfields1["maxval".$lnshortarr[$z]]:$rfields1["minval".$lnshortarr[$z]] ." - ". $rfields1["maxval".$lnshortarr[$z]] ?> </td>
		 <?php
			 }
			 ?>
		 </tr>
		    <?php
		 }
		  }
			?>

         </table>

         <div id="shenishvna" style="text-align: left"><div name="dav_parametri" width=100%  style="border:2px solid #BBBBBB; font-size:10px; padding:2px; "><?=$rproto['comment'.$lnshortarr[$z]]?></div>

         </div>

</div>

<br>
<?php
     $tpname=$w["Headlab"];
	 $tpdep=$w["Headdep"];
	 							    $dephead=mysqli_query($con,"SELECT t1.* FROM users AS t1 WHERE  t1.id IN(".$rdt.") AND ( t1.type='7' OR t1.type1='7')  ");
				                      
									    $labhead=mysqli_query($con,"SELECT t1.* FROM users AS t1 WHERE (t1.type='4' OR t1.type1='4' OR t1.type='48' OR t1.type1='48' ) AND t1.id='".$rproto["labhead"]."'");
				                       while($rlabhead=mysqli_fetch_assoc($labhead))
				                      {
										 if ($rlabhead['type']==4)
										 {
											 $tpname=$w["Headlab"];
										 }
										  if ($rlabhead['type']==48)
										 {
											 $tpname=$w["Deputyhead"];
										 }
										
										  if ($rlabhead['type']!=4&&$rlabhead['type']!=48&&$rlabhead['type']!=7&&$rlabhead['type1']==4)
										 {
											 $tpname=$w["Headlab"];
										 }
										   if ($rlabhead['type']!=4&&$rlabhead['type']!=48&&$rlabhead['type']!=7&&$rlabhead['type1']==48)
										 {
											 $tpname=$w["Deputyhead"];
										 }   
										
									  }
?>
<div class="laboqmi2" style="text-align: left"> 
 <div style="width:100%">
  <div style="float:left; width:50%;">
    <p align="left"><font size="+2"><b><u><?=$tpname ?></u> </b></p>    
 </div>
  <div style="float:left; width:50%;">
     <p align="right">  /<?=$rproto['headname'.$lnname] ?>/</font></p>
  </div>
 </div> 
 <?php
   if(mysqli_num_rows($dephead)>0)
   {
 ?>
<div style="width:100%">
  <div style="float:left; width:50%;">
    <p align="left"><font size="+2"><b><u><?=$tpdep ?></u> </b></p>    
 </div>
  <div style="float:left; width:50%;">
      <p align="right">
     		<?php
					                                             
	          while($rdephead=mysqli_fetch_assoc($dephead))
			     {  
				  echo " <br/><i>/" .$rdephead['firstname'.$lnname] . " ".$rdephead['lastname'.$lnname]."/ </i>"; 
	             }
		     ?>
		</p>	 
  </div>
 </div>
<?php

   }
   ?>
 
  <div style="width:100%">
 <!--    <p align="left"><font size="+2"><b><u>ლაბორატორიის ხელმძღვანელი</u> </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/დარეჯან&nbsp;დუღაშვილი/</font></p>-->

<!--  <p align="left"><font size="+2"><b><u>ლაბორატორიის ხელმძღვანელის<br>მოვალეობის შემსრულებელი</u> </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/მანანა გრძელიშვილი/</font></p> -->    
 <?php
      $authors=mysqli_query($con,"SELECT t1.* FROM users AS t1 WHERE t1.id IN(".$rt.") AND t1.type='6' ");
	  if(mysqli_num_rows($authors)>0)
	  {
 ?>
	    <div style="float:left; width:50%;">
                    <p align="left" ><font size="+2"><?=$w["Performer"] ?> : </p>
		</div>			
        <div style="float:left; width:50%;">		
		  <p align="right">
					<?php
					                                             
																  while($rauthors=mysqli_fetch_assoc($authors))
																  {  
					                                              echo " <br/><i>/" .$rauthors['firstname'.$lnname] . " ".$rauthors['lastname'.$lnname]."/ </i>"; 
																  }
																  ?>
			</p> 													  
         </div>        
      
        <?php
	  }
?>	  
     
   <p align="center" style="font-size:9px"><font ><?=$w["endexam"] ?></font></p>
 </div>
</div>
</div>
<?php
    if($c<$rproto["lngs"])
	{
?>

<pagebreak resetpagenum="1" pagenumstyle="2" suppress="" />

<?php

	}
										}
										}
										?>
</div>

</body>
</html>

<?php $html = ob_get_clean(); 
//echo $html;
	//==============================================================
	//==============================================================
	//==============================================================

require_once ("/home/admin/domains/webdoors.ge/public_html/partners/hgn/vendor/autoload.php");
//$mpdf = new \Mpdf\Mpdf(["tempDir" => "/home/admin/domains/pitstopmoto.ge/public_html/tmp"]);
$mpdf = new \Mpdf\Mpdf(["tempDir" => "/home/admin/domains/webdoors.ge/public_html/partners/hgn/tmp"]);
$mpdf->setAutoTopMargin =false;
$mpdf->allow_charset_conversion = true;
$mpdf->charset_in = "utf-8";

	// $mpdf=new mPDF("utf-8"); 

	$mpdf->SetDisplayMode("fullpage");

	// LOAD a stylesheet
//	$stylesheet = file_get_contents("/var/www/lightspeed.ge/merchant/css/mpdfstyleA4.css");
//	$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
    $mpdf->setFooter('{PAGENO}/{nbpg}');
    //$mpdf->setFooter('{PAGENO}/{PAGENO}');
	$mpdf->WriteHTML($html);
    $docname="ოქმი N".$id.".pdf";

	$mpdf->Output($docname,"I");
    header("Content-Type: application/pdf");
    header("Content-Disposition:inline;filename='$docname'");
    readfile("$docname");
exit;
	//==============================================================
	//==============================================================
	//==============================================================*/


		include("home/admin/domains/webdoors.ge/public_html/partners/hgn/db_close.php");
	}
		
		?>