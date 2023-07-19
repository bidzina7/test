<?php
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
include("../functions/getlang.php");

   $vl=mysqli_real_escape_string($con,$_POST['vl']);
   $ln=mysqli_real_escape_string($con,$_POST['ln']);
   $table=mysqli_real_escape_string($con,$_POST['table']);
   $column=mysqli_real_escape_string($con,$_POST['column']);
   $lst=mysqli_real_escape_string($con,$_POST['lst']);
   $nlang=(int)$_POST["nlang"];
   ?>
   <datalist id="<?=$lst ?>" >
   <?php
if($nlang!=1)
{
?> 

 
	<?php 
     //   echo  "SELECT DISTINCT(columnValue) AS disname FROM langs WHERE  tableColumn='".$column."' AND tableName='".$table."' AND shortname='".$ln."' AND columnValue LIKE '%$vl%'";
                   $cnt=mysqli_query($con, "SELECT DISTINCT(columnValue) AS disname FROM langs WHERE  tableColumn='".$column."' AND tableName='".$table."' AND shortname='".$ln."' AND columnValue LIKE '%$vl%'") ;
                              
            while($rcnt=mysqli_fetch_assoc($cnt))
			{ 
    ?>									
                <option value="<?=$rcnt['disname'] ?>"> <?=$rcnt['disname'] ?> </option>
    <?php
		    }
		
}
else
{
	       $cnt=mysqli_query($con, "SELECT $column  FROM $table WHERE   $column LIKE '%$vl%'") ;
	    while($rcnt=mysqli_fetch_assoc($cnt))
			{ 
    ?>									
                <option value="<?=$rcnt[$column] ?>"> <?=$rcnt[$column] ?> </option>
    <?php
		    }
		
	
}
?>
 </datalist>