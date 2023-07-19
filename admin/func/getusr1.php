<?php
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
include("../functions/getlang.php");
	// echo  "SELECT t1.*,   ". languages('protocol','t1.id','companyname') ."	
                                            
											   // FROM protocol AS t1"; 
   $vl=mysqli_real_escape_string($con,$_POST['vl']);
// echo "SELECT t1.*,  ". languages('users','t1.uid','firstname') ." ,
											  // ". languages('users','t1.uid','lastname') ." ,
											  // ". languages('users','t1.uid','companyname') ." ,
											  // ". languages('users','t1.uid','address') ."  FROM users AS t1 WHERE t1.pid!='' AND t1.pid LIKE '%$vl%'  LIMIT 10 ";
?> 

 <datalist id="company" >
	<?php 
// echo "SELECT t1.*, SELECT DISTINCT((columnValue) AS a FROM langs WHERE tableId=t1.id AND tableColumn='companyname' AND tableName='protocol' AND shortname='ka') AS disname 	
                   $usr=mysqli_query($con, "SELECT DISTINCT(columnValue) AS disname FROM langs WHERE  tableColumn='companyname' AND tableName='protocol' AND shortname='ka' AND columnValue LIKE '%$vl%'") ;
                                 // FROM protocol AS t1";
        // $usr=mysqli_query($con, "SELECT t1.*, (SELECT DISTINCT(columnValue) AS a FROM langs WHERE tableId=t1.id AND tableColumn='companyname' AND tableName='protocol' AND shortname='ka') AS disname, ". languages('protocol','t1.id','companyname') ."	
                                 // FROM protocol AS t1 WHERE t1.id IN (SELECT tableId FROM langs WHERE shortname='ka' AND tableName='protocol' AND tableColumn='companyname' AND columnValue LIKE '%$vl%' )");
            while($rusr=mysqli_fetch_assoc($usr))
			{ 
    ?>									
                <option value="<?=$rusr['disname'] ?>"> <?=$rusr['disname'] ?> </option>
    <?php
		    }
			 $usr1=$usr=mysqli_query($con, "SELECT t1.*,   
											  " . languages('users','t1.id','companyname') ."  FROM protocol AS t1 WHERE t1.id IN(SELECT tableId FROM langs WHERE tableName='protocol' AND tableColumn='address' AND columnValue='$vl')");
			 $rusr1=mysqli_fetch_assoc($usr1);
 echo " ---".$rusr1['id'] ." ---".$rusr1['companynameka'] ." ---".$rusr1['companynameen'] ." ---".$rusr1['companynameru'];
	?>
	
    </datalist>