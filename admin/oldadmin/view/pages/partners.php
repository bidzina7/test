
<div class="container-fluid">
<br/>
   <div class="col-sm-10 my-3 p-0">
    <div class='row'>

		<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
	
	<div class='col-sm-2' >

	    <button class='btn <?=$langdefaultarr[$z]=='1'?"btn-success":"btn-danger" ?>  ltab' d='<?=$c ?>' >  <?=$lnarr[$z] ?></button>
	  
	</div>
	   <?php
	   }
	   ?>

	</div>
  </div>

 <div class='row'>
   
   <div class="col-sm-11 itmcontainer" t='partners'>
   

         	<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
			    <div class='enebi ' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '   >
		
			<input type='text' class='form-control UPTS'  rl='name' tp='' d='<?=$c ?>' name='name' ln='<?=$lnshortarr[$z] ?>' placeholder='სათაური <?=$lnshortarr[$z] ?>'>
			<br/> 
		
		
			</div>
	
      <?php
	   } 
	   ?>
			
   

			<input type='link' class='form-control UPTS' name='link' tp='' ln='' placeholder='ლინკი'>

	<!---ssss --->


   <div class='shimg mt-2'>
            <label for="pdf">ბრენდის სურათი <small></small>1400px/600px</label>

<div class="input-append row">
					<div class="col-md-9">
						<input id="YDA9767032" class="form-control  UPTS" ln='' name='img'  placeholder="სურათი 1" type="text" />		
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA9767032')"><button class="btn iframe-btn btn-outline-success"><i class="fa fa-upload"></i></button></a>
				</div>

        </div>
		   <div class='shvid d-none'>
            <label for="pdf">ვიდეო</label>

<div class="input-append row">
					<div class="col-md-9">
						<input  id="YDA9767033" class="form-control slvideo"  placeholder="video link" type="text" />
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=3&popup=1&field_id=YDA9767033&relative_link=1')"><button class="btn iframe-btn btn-outline-success"><i class="fa fa-upload"></i></button></a>

				</div>

        </div>

     <br/>
			<a class="btn btn-success ADDITEMS text-white"  norep='title' t='partners' pos='1' d='' >ბრენდის დამატება</a>
		</div>

 </div>
 <br/>


<div class="row justify-content-center">
	<div class="col-sm-12">
		<div class="row my-2">
			<div class="col-sm-4">
				<h3>ბრენდი</h3>
			</div>

		</div>
	</div>
	<div class="col-sm-12">
	<?php
	    // $sld=mysqli_query($con,"SELECT t1.*, t2.column_value AS nm FROM partners AS t1 INNER JOIN langs AS t2 ON()  ORDER BY position");
			 
			 
			  $sld=mysqli_query($con,"SELECT t1.*, 
		     ". languages('partners','t1.id','name') ." , ".languages('partners','t1.id','description') ."
		    
		  
			 FROM partners AS t1  ORDER BY position");
			
			 
			 // $sld=mysqli_query($con,"SELECT t1.* FROM partners AS t1  ORDER BY t1.position");
		 $slcount=mysqli_num_rows($sld);

	?>
	<table class="table table-sm table-striped table-bordered table-condensed table-hover">
		<thead>
		<tr>
		<?php
		  if($slcount>1)
		  {
		?>
		<th>რაოდ.</th>
		<?php
		  }
		  ?>
	<th>სურათი</th>
		<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
		<th class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '  >სათაური <?=$lnshortarr[$z] ?></th>

		
	
	   <?php
	   }
	   ?>

		<th>ლინკი</th>
		<?php
		  if($slcount>1)
		  {
		?>
		<th>რიგითობა</th>
		<?php
		  }
		  ?>

		<th>წაშლა</th>
		</tr>
		</thead>
		<tbody>
		<?php

		$i=0;
		while($rsld=mysqli_fetch_assoc($sld))
		{
		$i++;
		?>
		<tr>
		<?php
		  if($slcount>1)
		  {
		?>
		<th><?=$i ?></th>
		<?php
		  }
		  ?>
	
		
		<th class='chimg'>



				<div>
				   <input type='hidden' value='<?=$rsld["img"]?>' n='img' d='<?=$rsld['id'] ?>' t='partners' id="YDA<?=$i ?>" class='YDA1'/>
			       <img src="<?=$rsld["img"]?>" style="width:70px; border:2px" />
				</div>
				<br/>
				<div>
		      <a style='display:block; padding:0px;' href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&amp;popup=1&amp;field_id=YDA<?=$i?>&amp;relative_link=1')">
		         <button class="btn iframe-btn btn-outline-success">არჩევა</button>
			  </a>
			  </div>

		</th>
		
		 
		  
	
	   	<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
		<th class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '  ><input type='text' value='<?=$rsld['name'.$lnshortarr[$z]] ?>' class="form-control UPT"  n='name'  ln='<?=$lnshortarr[$z] ?>' d='<?=$rsld['id'] ?>'  t='partners' /></th>
		
	   <?php
	   }
	   ?>
		<th><input type='text' value='<?=$rsld['link'] ?>' class="form-control UPT" d='<?=$rsld['id'] ?>' n='link' t='partners' /></th>
		<?php
		  if($slcount>1)
		  {
		?>
		<th>
		
		   <select class='chslps form-control' d='<?=$rsld['id']?>'>
		   
		    <option>
				 
				    <?=$i ?>
		   </option>
		   <?php
		   $d=0;
		  $slpo=mysqli_query($con,"SELECT  * FROM partners ORDER BY position");
		  while($rslpo=mysqli_fetch_assoc($slpo))
		  { 
	        $d++;
			if($d==$i)
			{
				continue;
			}
			
		?>
		         <option value='<?=$rslpo['position'] ?>' >
				 
				    <?=$d ?>
				 </option>
			<?php
		  }
          ?>		  
		   </select>
          </th>
		  <?php
		  }
		  ?>
		<th><button class='btn btn-danger DGA' d='<?=$rsld["id"] ?>' n='partners'><i class="fa fa-trash"></i></button></th>
		</tr>
		<?php
		}
		?>
		</tbody>
	 </table>
	 </div>
 </div>
 </div>
	 