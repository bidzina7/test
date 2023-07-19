<?php
if(isset($_SESSION['GuserID'])){
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
include("functions.php");
include("../functions/requestype.php");
include("../functions/addlang.php");
include("../functions/sitemap.php");
include("../functions/geotoeng.php");
//echo 1;
$uid=(int)$_SESSION['GuserID'];
	$jsn=$_POST["a"]; 
	$jsnlang=$_POST["b"]; 
	$table=mysqli_real_escape_string($con,$_POST["c"]);
	$isitems='';
	$id=(int)$_POST["d"];
	$slug=mysqli_real_escape_string($con,$_POST["e"]);
	$slugarr="";
	$slugcol="";
	$sluglang="";
	$wr=$_POST["wr"];
	$sitemap=(int)$_POST["sitemap"];
	$pos=(int)$_POST["pos"];
	$addrem=(int)$_POST["addrem"];
	$pagename=mysqli_real_escape_string($con,$_POST["pagename"]);
	if($slug!="")
	{
	$slugarr=explode("/",$slug);
	$slugcol=$slugarr[0];
	$sluglang=$slugarr[1];
	}
	//echo $slugcol ."--".$sluglang;
	
	
	$jsnarr=json_decode($jsn,true);
	$jsnchildtable=$_POST["jsnchildtable"];
	$jsnchilditems=$_POST["jsnchilditems"];
	$msg=$_POST["msg"];
	$childtables=json_decode($jsnchildtable,true);
	 $childitems=json_decode($jsnchilditems,true);
	$addarr='';
	$wrepeat="";
	 $addchildarr='';
     $repass=[];
	 $repeat=0;

	$norepeat=mysqli_real_escape_string($con,$_POST["norepeat"]??"");
	$message=mysqli_real_escape_string($con,$_POST["message"]??"");
	$nrepeatarr=explode(",",$norepeat);
    $journaltype=(int)$_POST["journaltype"];
    $tex=mysqli_real_escape_string($con,$_POST["tex"]??"");
	if( $journaltype!=0)
	{
		//echo "INSERT INTO journal SET opertype=' $journaltype', uid='$uid', opertype='$journaltype' ";
		mysqli_query($con,"INSERT INTO journal SET  uid='$uid', text='$tex' ,opertype='$journaltype' ");
	}
	 
	foreach($jsnarr AS $key => $val )
	{ 
		
		$val=requestype($key,$val);
		$key1=explode("_",$key);
		$key=$key1[0];
	   //	$addarr.="$key='".$val."',";
		$wrepeat.=in_array($key ,$nrepeatarr)?$key."='".$val."' OR ":"";
		
		$repeat=1;
		$ktype=array_key_exists(1,$key1)? $key1[1]:'';
		if($ktype=='repass')
		{
			//echo 'ai';
            $repass[]=$val;
			
		}
			else
		{
			//$key=($key=='undefined')?"":$key;
			($ktype=='password'?$repass[]=$val:"");
			if($key=='password'&&encrypt_decrypt("decrypt",$val)=='')
			{
	   	 
			}
			else
			{
				if($key!="undefined")
				{
			  $addarr.=(is_int($val)&&$val==0?"$key=NULL ,":"$key='".$val."',");
				} 
			}
		}
		
		
	}
	//var_dump($repass);
	$password=(array_key_exists(0,$repass)?$repass[0]:'');
    $repassword=(array_key_exists(1,$repass)?$repass[1]:'');
	$password1=encrypt_decrypt("decrypt",$password); 
    $repassword1=encrypt_decrypt("decrypt",$repassword);
	//echo $password1 ."- ".$repassword1;
	if($password1==$repassword1)
	{
    if($wrepeat!="")
	{
		$wrepeat=rtrim($wrepeat,"OR ");
	}
     $addarr=rtrim($addarr,",");
	 //echo $jsnlang;
	$isrow=0;
	
	//echo $id ."--";
	if($id!=0)
	{
	$isitems=mysqli_query($con,"SELECT * FROM $table WHERE id='$id' ");
	$isrow=mysqli_num_rows($isitems);
	
	}
	if($isrow>0) //თუ აღნიშნული პროდუქტი არსებობს დააბდეითოს
	{
		$risitems=mysqli_fetch_assoc($isitems);
		 $nrow=0;
		if($wrepeat!='')
		  {
		   $nrep=mysqli_query($con,"select id FROM $table WHERE id!=$id AND ($wrepeat) ");
  
		   $nrow=mysqli_num_rows($nrep);
		     //echo $wrepeat  ."--";
		   
		  }
		
		 if($nrow==0)
			{
			if($addarr!="")
			{
				//echo "UPDATE $table SET $addarr WHERE id='$id' ";
		$tms=mysqli_query($con,"UPDATE $table SET $addarr WHERE id='$id' ");
			}
		//echo "UPDATE $table SET $addarr WHERE id='$id' ";
		//echo $jsnlang;
		$jsnarrlang=json_decode($jsnlang,true);
	    //echo "---".count($jsnarrlang);
	    if(count($jsnarrlang)>0)
	    {
			
				foreach($jsnarrlang AS $key => $val ) //ენები
             	{
						$shrt=explode("-",$key);
						$key=explode("_",$key);
		                $key=$key[0];
						$val=$val=requestype($key,$val);
						// if($shrt[1]=='ka'&&$shrt[0]=='title')
						// {
							// $val1=geotoeng($val);
							// $key1='slug';
							// $tms=mysqli_query($con,"UPDATE $table SET $key1='$val1' WHERE id='$id' ");
							
						// }
						if($shrt[1]==$sluglang&&$shrt[0]==$slugcol&&$slug!="")
						{ 
							$val1=geotoeng($val);
							$key1='slug';
							
							$tms=mysqli_query($con,"UPDATE $table SET $key1='$val1' WHERE id='$id' ");
							//echo "UPDATE $table SET $key1='$val1' WHERE id='$id' ";
						}
					    $itmlang=mysqli_query($con,"SELECT * FROM langs WHERE tableId='$id' AND shortname='".$shrt[1]."' AND tableName='$table' AND tableColumn='".$shrt[0]."'  ");
						//echo "SELECT * FROM langs WHERE tableId='$id' AND shortname='".$shrt[1]."' AND tableName='$table' AND tableColumn='".$shrt[0]."' AND columnValue='$val'  ";
						if(mysqli_num_rows($itmlang)>0)
						{
							mysqli_query($con,"UPDATE langs SET  columnValue='$val' WHERE  tableId='$id' AND shortname='".$shrt[1]."' AND tableName='$table' AND tableColumn='". $shrt[0] ."'  ");
						  // echo "UPDATE langs SET  columnValue='$val' WHERE  tableId='$id' AND shortname='".$shrt[1]."' AND tableName='$table' AND tableColumn='". $shrt[0] ."'  ";
						}
						else
						{
							
							
							mysqli_query($con,"INSERT INTO langs SET   tableId='$id' , shortname='".$shrt[1]."' , tableName='$table' , tableColumn='".$shrt[0]."', columnValue='$val' ");
						}
					 
				}
		}
		
		
			if(count($childtables)>0) // თუ არსებობს სხვა თეიბლები მაშინ სრულდება ეს
			{
				
				
				
					for($i=0;$i<count($childtables);$i++) 
				{
					$childar=explode("--",$childtables[$i]);
					//echo $childtables[$i];
					$childtable=$childar[0];
					$rel=$childar[1];
					$rel=explode(",",$childar[1]);
					$wrel=(isset($rel[1]))?"id='".$risitems[$rel[0]]."'":"  $rel[0]='".$id."'"; 
					//$wrel= "$rel='".$id."'"; 
				
					foreach($childitems AS $key => $val )
	               {
					    $val=requestype($key,$val);
		                $key=explode("_",$key);
		                $key=explode("^",$key[0]);
						$key1=$key[0];
						$key2=$key[1];
						if($key2==$childtable)
						{
						//echo $key2;
					    
					     $addchildarr.=(is_int($val)&&$val==0?"$key1=NULL ,":"$key1='".$val."',");
						}
					
				   }
				  // echo $addchildarr;
				        $waddchildarr =($addrem==1)?str_replace(","," AND ",$addchildarr):"";
                        //$waddchildarr =rtrim($waddchildarr," AND "):"";						
						
				  	    $addchildarr =rtrim($addchildarr,",");
				  	    
						$chtable=explode("/",$childtable);
						$chtable=$chtable[0];
						//echo $chtable;
					   // echo "SELECT * FROM $chtable WHERE   $wrel";
					    $chshow=mysqli_query($con, "SELECT * FROM $chtable WHERE  $wrel");
						$chnum=mysqli_num_rows($chshow);
						//echo "SELECT * FROM $chtable WHERE $rel='$id'";
						if($chnum>0 &&$rel!='')  //შვილი თეიბლში კონტენტს ააფდეითებს თუ არ არსებობს დაამატებს
						{
						$addchild=mysqli_query($con,"update $chtable SET $addchildarr  WHERE $wrel ");
						// echo "update $chtable SET $addchildarr  WHERE $wrel ";
						}
						else
						{
						    $addchildarr.=$rel!=""?",".$wrel:"";
							$addchild=mysqli_query($con,"insert INTO  $chtable SET  $addchildarr");  
							
						}
						//echo "INSERT INTO ". $chtable ." SET ". $addchildarr ;
						$addchildarr='';
						if($addchild)
						{
							
						}
				}
				
				
			}
			if($sitemap==1||$sitemap==2)
		   {
			 
             sitemap($pagename,$table,$id, "https://hgn.ge",$con,$sitemap);
		   }
		       echo $msg .($wr!=""?'--'."reload":"");
		
			}
			else
			{
				echo " მომხმარებელი ასეთი მონაცემებით უკვე არსებობს! ";
			}
	}
	else // თუ პროდუქტი არ არსებობს და ამავედროს request id ტოლია 0 ის სრულდება ეს(ახალი კონტენტის დამატება)
	{
		  $nrow=0;
		 // echo $wrepeat . "--/--" ;
		  if($wrepeat!='')
		  {
		   $nrep=mysqli_query($con,"select * FROM $table WHERE  $wrepeat ");

		   $nrow=mysqli_num_rows($nrep);
		     //echo $wrepeat  ."--";
		   
		  }
		  
		    if($nrow==0)
			{
		
		
		
if($pos==1)
{
	
	
   $alsld=mysqli_query($con,"SELECT * FROM $table ORDER BY position DESC");
	if(mysqli_num_rows($alsld)>0)
	{
	$ralsld=mysqli_fetch_assoc($alsld);
	$pos=++$ralsld['position'];
	
	}
	$addarr!=""?$addarr.=", position='$pos'":$addarr.=" position='$pos'";
}
		$tms=mysqli_query($con,"INSERT INTO $table SET $addarr");
		echo "INSERT INTO $table SET $addarr";
	
	
	$tmsid=(int)mysqli_insert_id($con);
	$jsnarrlang=json_decode($jsnlang,true);
	
	if(count($jsnarrlang)>0)
	{
         
		 addlang($table,$jsnarrlang,$tmsid,$slug,$con);
	} 


     			if(count($childtables)>0) // თუ არსებობს სხვა თეიბლები მაშინ სრულდება ეს
			{
				for($i=0;$i<count($childtables);$i++) 
				{ //echo var_dump($childtables);
					$childar=explode("--",$childtables[$i]);
					$childtable=$childar[0];
					$rel=$childar[1];
					explode('/',$rel);
				     echo ' '.$rel ;
					foreach($childitems AS $key => $val )
	               {
					  // echo ' '.$key;
					    $val=requestype($key,$val);
		                $key=explode("_",$key);
		                $key=explode("^",$key[0]);
						$key1=$key[0];
						$key2=$key[1];
						
						if($key2==$childtable)
						{
						//echo $key2;
					   //  echo "(" . $key2 ."---" . $childtable .")";
					     $addchildarr.=(is_int($val)&&$val==0?"$key1=NULL ,":"$key1='".$val."',");
						}
					
				   }
				   
				  	    $addchildarr.=$rel!=""?$rel."=".$tmsid:"";
						$chtable=explode("/",$childtable);
						$chtable=$chtable[0];
						//echo count($childtables);
						//echo  $addchildarr;
						$addchild=mysqli_query($con," INSERT INTO $chtable SET $addchildarr");
						echo " INSERT INTO $chtable SET $addchildarr";
						$addchildarr='';
				}
			}
        if($sitemap==1||$sitemap==2)
		{
          sitemap($pagename,$table,$tmsid,"https://buyzone.ge",$con,$sitemap);
		}
	echo $msg .($wr!=""?'--'."reload":"");
			}
		else	
	   {
		 //echo $message;
	    	 echo " მომხმარებელი ასეთი მონაცემებით უკვე არსებობს! ";
	   }		
	}
}
else{
	echo "გთხვთ სწორად შეიყვანოთ პაროლი";
}
}

?>
