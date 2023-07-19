<?php
 
 function pagination($limit,$ln,$page,$numb,$count,$src="")
 {
	 $srcln="";
	 $pages=ceil($count/$limit);
	 if($src!="")
	 {
		 $srcln="?search=".$src;
	 }
	 ?>
	 
	    <div class="pagination">
                <a href="<?=$ln ?>/<?=$page?>/1<?=$srcln ?>"><i class="fas fa-angle-double-left"></i></a>
                <a href="<?=$ln ?>/<?=$page?>/<?=$numb<=1?1:$numb-1 ?><?=$srcln ?>"><i class="fas fa-angle-left"></i></a>
				
				<?php
				  
			       if($pages>7&&$numb>7)
			       {
					   ?>
					     <a href='<?=$ln ?>/<?=$page ?>/1<?=$srcln ?>' >
                            <?=1 ?>
                          </a>
						  <span style="background:none; color:black;">...</span>
					   <?php
				   }				
				  for($i=max(1, $numb - 6); $i <= min($numb + 6, $pages);$i++)
				  {
				
				?>
                <a <?=$i!=$numb?"href='".$ln."/".$page."/".$i.$srcln."'":""?> class="<?=$i==$numb?"active":""?>">
                    <?=$i ?>
                </a>
                  <?php
				  
				  }
				  if($numb<$pages)
			     {
				  
				   if($pages>6&&$numb<=($pages-7))
			    {
				?>
				<span style="background:none; color:black;">...</span>
				<a href='<?=$ln ?>/<?=$page ?>/<?=$pages ?><?=$srcln ?>' >
                            <?=$pages ?>
                  </a>
	            <?php
			     }
				 
			  }			  
				  ?>
                    <a href="<?=$ln ?>/<?=$page?>/<?=$numb<$pages?$numb+1:$pages ?><?=$srcln ?>"> <i class="fas fa-angle-right"></i></a>
                <a href="<?=$ln ?>/<?=$page?>/<?=$pages ?><?=$srcln ?>"><i class="fas fa-angle-double-right"></i></a>
            </div>
	 <?php
 }


?>