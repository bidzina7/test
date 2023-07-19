<?php

	
	 function permissions($x)	{
		// $Userclass=new User($this->con);

        include("db_open.php");	
		$uid=$x;

		//$usrs=mysqli_query($con,"SELECT * FROM users WHERE id='$uid' ");
        		
		$permissions=mysqli_query($con,"SELECT t1.*, 
		                                       (SELECT  GROUP_CONCAT(shortname) FROM permissionpages WHERE FIND_IN_SET(id,t1.pages) ) AS page,  
		                                       (SELECT  GROUP_CONCAT(shortname) FROM permission WHERE FIND_IN_SET(id,t1.permissions) ) AS permission,  
											   (SELECT  custom  FROM users WHERE id=$uid) AS custom,
											   (SELECT concat_ws(' ', firstname,lastname)  FROM users WHERE id=$uid) AS fullname,
											   (SELECT (SELECT typeName FROM userTypes WHERE id=t2.type)   FROM users AS t2 WHERE t2.id=$uid) AS typeName
											    FROM permissionMeta AS t1
											   WHERE (t1.uid=(SELECT id FROM users WHERE custom=1 AND id=$uid)  ) OR (t1.roleid =(SELECT type FROM users WHERE custom!=1 AND id=$uid) ) ORDER BY t1.id ASC")	;															  
		$result=$permissions?mysqli_fetch_all($permissions, MYSQLI_ASSOC):[];
		return $result;
	}
	
     function getpages($Guid,$page)
	{
	

         
          $permissionars=permissions($Guid);
         // var_dump($permissionars[0]['pages']);
          $pages=@explode(',',$permissionars[0]['page']);
          // var_dump($permissionars[0]);
            
          if($permissionars[0]["typeName"]=='superadmin'&&$permissionars[0]["custom"]!=1) 
         {
	      // echo "true";
           return 1;  
         }
		 else
		 {
			
		     if(!in_array($page ,$pages ) )
	        {
              return 0;
            }
            else
			{
			return 1;
			
			}
		 }


//$hist='history';
	}
	
	
	 function getprm($Guid,$name)
	{
	
	     
           $permissionars=permissions($Guid);


          $permissions=@explode(',',$permissionars[0]['permission']);



            
         if($permissionars[0]["typeName"]=='superadmin'&&$permissionars[0]["custom"]!=1) 
         { 
	       return 1;  
		 }
		 else
		 {
		  if(!in_array($name ,$permissions ) )
	        {
              return 0;
            }
            else
			{
			return 1;
			}
		 } 
        
//echo $permissionars[0]["typeName"]; 


//$hist='history';
	}
	
	



?> 