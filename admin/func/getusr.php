<?php
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
include("../functions/getlang.php");

   $vl=mysqli_real_escape_string($con,$_POST['vl']);
// echo "SELECT t1.*,  ". languages('users','t1.uid','firstname') ." ,
											  // ". languages('users','t1.uid','lastname') ." ,
											  // ". languages('users','t1.uid','companyname') ." ,
											  // ". languages('users','t1.uid','address') ."  FROM users AS t1 WHERE t1.pid!='' AND t1.pid LIKE '%$vl%'  LIMIT 10 ";
?> 

 <datalist id="users">
	<?php 
	
        $usr=mysqli_query($con, "SELECT t1.*,   (SELECT firstname FROM users WHERE id=t1.id)	AS firstname,		
                                             (SELECT lastname FROM users WHERE id=t1.id)	AS lastname,
											 (SELECT firstnameen FROM users WHERE id=t1.id)	AS firstnameen,		
                                             (SELECT lastnameen  FROM users WHERE id=t1.id)	AS lastnameen,	
                                             (SELECT firstnameru FROM users WHERE id=t1.id)	AS firstnameru,		
                                             (SELECT lastnameru FROM users WHERE id=t1.id)	AS lastnameru,
											  ". languages('users','t1.id','companyname') ." ,
											  ". languages('users','t1.id','address') ."  FROM users AS t1 WHERE t1.pid!='' AND t1.pid LIKE '%$vl%' AND t1.type=0");
            while($rusr=mysqli_fetch_assoc($usr))
			{ 
    ?>									
                <option value="<?=$rusr['pid'] ?>"> <?=$rusr['firstname'] ?> <?=$rusr['lastname'] ?></option>
    <?php
		    }
			$usr1=$usr=mysqli_query($con, "SELECT t1.*,   (SELECT firstname FROM users WHERE id=t1.id)	AS firstname,		
                                             (SELECT lastname FROM users WHERE id=t1.id)	AS lastname,
											 (SELECT firstnameen FROM users WHERE id=t1.id)	AS firstnameen,		
                                             (SELECT lastnameen  FROM users WHERE id=t1.id)	AS lastnameen,	
                                             (SELECT firstnameru FROM users WHERE id=t1.id)	AS firstnameru,		
                                             (SELECT lastnameru FROM users WHERE id=t1.id)	AS lastnameru,
											  ". languages('users','t1.id','companyname') ." ,
											  ". languages('users','t1.id','address') ."  FROM users AS t1 WHERE t1.pid!='' AND t1.pid = '$vl' AND t1.type=0");
			$rusr1=mysqli_fetch_assoc($usr1);
echo " ---".$rusr1['id'] ." ---".$rusr1['firstname'] ." ---".$rusr1['firstnameen'] ." ---".$rusr1['firstnameru'].' ---' .$rusr1['lastname'] .' ---' .$rusr1['lastnameen'].' ---' .$rusr1['lastnameru'].' ---' .$rusr1['companynameka'].' ---' .$rusr1['companynameen'].' ---'.$rusr1['companynameru'].' ---' .$rusr1['addresska'].' ---' .$rusr1['addressen'].' ---'.$rusr1['addressru'].' ---'.$rusr1['tel'] .' ---';
	?>
	
    </datalist>