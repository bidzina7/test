<?php

/*
$languagename='';
$languageshortname='';
$lngs=mysqli_query($con,"SELECT * FROM languages WHERE active='1' ");
while($rlngs=mysqli_fetch_assoc($lngs))
{
	$languagename.=','.$rlngs['name'];
	$languageshortname.=','.$rlngs['shortname'];
}
if($languagename!=''&&$languageshortname!='')
{
	$languagename=ltrim($languagename,',');
	$languageshortname=ltrim($languageshortname,',');
}
$lnarr=explode(',',$languagename);
$lnshortarr=explode(',',$languageshortname);
function languages($table_name,$table_id,$table_column)
{
	$alias='';
	$inleng ='';
	for($i=0;$i<count($GLOBALS['lnarr']);$i++)
	{
		$alias=$table_column . $GLOBALS['lnshortarr'][$i];
		$inleng .="(SELECT column_value FROM langs WHERE shortname='". $GLOBALS['lnshortarr'][$i] ."' AND table_name='$table_name' AND table_id=$table_id AND table_column='$table_column' ) AS $alias,";
	}
   $inleng=rtrim($inleng,",");
	return $inleng;
}
echo languages('slider','t1.id','name');
*/
?>

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
   
   <div class="col-sm-11 itmcontainer" t='slider'>
   

         	<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
			    <div class='enebi ' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '   >
		
			<input type='text' class='form-control d-none' t='jixvi' rl='name' tp='' d='<?=$c ?>' name='name' ln='<?=$lnshortarr[$z] ?>' placeholder='სათაური <?=$lnshortarr[$z] ?>'>
			<br/> 
			<input type='text' class='form-control  UPTS'  tp='' d='<?=$c ?>' name='description' ln='<?=$lnshortarr[$z] ?>' placeholder='აღწერა <?=$lnshortarr[$z] ?>'>
			<br/>
			</div>
	
      <?php
	   } 
	   ?>
			
   

			<input type='url' class='form-control UPTS' name='url' tp='' ln='' placeholder='ლინკი'>

	<!---ssss --->


   <div class='shimg mt-2'>
            <label for="pdf">სლაიდერის სურათი <small></small>1400px/600px</label>

<div class="input-append row">
					<div class="col-md-9">
						<input id="YDA9767032" class="form-control  UPTS" ln='' name='image'  placeholder="სურათი 1" type="text" />		
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA9767032')"><button class="btn iframe-btn btn-outline-success"><i class="fa fa-upload"></i></button></a>
				</div>

        </div>
		   <div class='shvid d-none'>
            <label for="pdf">ვიდეო</label>

<div class="input-append row">
					<div class="col-md-9">
						<input  id="YDA9767033" class="form-control slvideo"  placeholder="video url" type="text" />
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=3&popup=1&field_id=YDA9767033&relative_url=1')"><button class="btn iframe-btn btn-outline-success"><i class="fa fa-upload"></i></button></a>

				</div>

        </div>

     <br/>
			<a class="btn btn-success ADDITEMS text-white"  norep='name,description' t='slider' pos='1' d='' wr='1' >დამატება</a>
		</div>
<?php
$q1=mysqli_query($con,"SELECT * FROM settings ");
$r1=mysqli_fetch_array($q1);
?>
		<div class="col-2 mt-3">
			<label>სლაიდერის სიჩქარე</label><input class="form-control UPT" t="settings" d="5" n="value" value="<?=$r1["sliderspeed"]??0 ?>" placeholder="1000 for 1000sec"/>
		</div>
 </div>
 <br/>


<div class="row justify-content-center">
	<div class="col-sm-12">
		<div class="row my-2">
			<div class="col-sm-4">
				<h3>სლაიდერი</h3>
			</div>

		</div>
	</div>
	<div class="col-sm-12">
	<?php
	    // $sld=mysqli_query($con,"SELECT t1.*, t2.column_value AS nm FROM slider AS t1 INNER JOIN langs AS t2 ON()  ORDER BY position");
			 
			 
			  $sld=mysqli_query($con,"SELECT t1.*, 
		     ". languages('slider','t1.id','name') ." , ".languages('slider','t1.id','description') ."
		    
		  
			 FROM slider AS t1  ORDER BY position");
			
			 
			 // $sld=mysqli_query($con,"SELECT t1.* FROM slider AS t1  ORDER BY t1.position");
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

		
		<th class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '>აღწერა <?=$lnshortarr[$z] ?></th>
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
	
		<?php
		  if($rsld['video']==0)
		  {
			  ?>
		<th class='chimg'>



				<div>
				   <input type='hidden' value='<?=$rsld["image"]?>' n='image' d='<?=$rsld['id'] ?>' t='slider' id="YDA<?=$i ?>" class='YDA1'/>
			       <img src="<?=$rsld["image"]?>" style="width:70px; border:2px" />
				</div>
				<br/>
				<div>
		      <a style='display:block; padding:0px;' href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&amp;popup=1&amp;field_id=YDA<?=$i?>')">
		         <button class="btn iframe-btn btn-outline-success">არჩევა</button>
			  </a>
			  </div>

		</th>
		<?php
		  }
		  else
		  {
			 ?>
			 <th class='d-none'>



				<div>
				   <video width="100" height="75"
                  src="../media/<?=$rsld['embedurl'] ?>">
                  </video>
				  <br/>
				    <input type='hidden' value='<?=$rsld["embedurl"]?>' n='embedurl' d='<?=$rsld['id'] ?>' t='slider' id="YDA<?=$i ?>" class='YDA1'/>

				</div>
				<br/>

				<div>
		      <a style='display:block; padding:0px;' href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=3&amp;popup=1&amp;field_id=YDA<?=$i?>&amp;relative_url=1')">
		         <button class="btn iframe-btn btn-outline-success">არჩევა</button>
			  </a>
			  </div>
			
		</th>
            <?php			 
		  }
		  ?>
		  
	
	   	<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
		<th class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '  ><input type='text' value='<?=$rsld['name'.$lnshortarr[$z]] ?>' class="form-control UPT"  n='name'  ln='<?=$lnshortarr[$z] ?>' d='<?=$rsld['id'] ?>'  t='slider' /></th>
		<th class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '  ><input type='text' value='<?=$rsld['description'.$lnshortarr[$z]] ?>' ln='<?=$lnshortarr[$z] ?>' n='description' d='<?=$rsld['id'] ?>' t='slider' class="form-control UPT" /></th>
	   <?php
	   }
	   ?>
		<th><input type='text' value='<?=$rsld['url'] ?>' class="form-control UPT" d='<?=$rsld['id'] ?>' n='url' t='slider' /></th>
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
		  $slpo=mysqli_query($con,"SELECT  * FROM slider ORDER BY position");
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
		<th><button class='btn btn-danger DGA' d='<?=$rsld["id"] ?>' n='slider'><i class="fa fa-trash"></i></button></th>
		</tr>
		<?php
		}
		?>
		</tbody>
	 </table>
	 </div>
 </div>
 </div>
	 