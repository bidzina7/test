	<?php
	function requestype($x,$y) 
	{
		
		$key=explode("_",$x);
		$x=(array_key_exists(1,$key)?$key[1]:'');
		switch($x)
		{
			case 'int':
			$val=(int)$y;
			break;
			case 'float':
			$val=(float)$y;
			break;
			case 'double':
			$val=(double)$y;
			break;
			case 'inc':
			$val=(int)++$y;
			break;
			case 'time':
			$val=(int)time();
			break;
			case 'daterange':
			$val=(int)strtotime(trim($y));
			break;
			case 'arr':
			$val=mysqli_real_escape_string($GLOBALS['con'],implode(',',$y));
			break;
			case 'password':
			$val=encrypt_decrypt("encrypt",$y);
			break;
			case 'repass':
			$val=encrypt_decrypt("encrypt",$y);
			break;
			default :
			$val=mysqli_real_escape_string($GLOBALS['con'],$y);
		}
		return $val;
	}
	
	?>