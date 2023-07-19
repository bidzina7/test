<?php
$ACP=1;
if(isset($_REQUEST["p"])){
	$ACP=$_REQUEST["p"];
}

$ltab=isset($_GET['ltab'])?(int)$_GET["ltab"]:"";
  $search=mysqli_real_escape_string($con,$_GET["search"]??"");
  $wsearch=$search!=""?" WHERE t1.id IN(SELECT tableId FROM langs WHERE tableColumn='name' AND tableName='categories' AND columnValue LIKE '%$search%')":"";
$WSE='';
$active=isset($_REQUEST["active"])&&$_REQUEST["active"]!=''?(int)$_REQUEST["active"]:'';
$category=isset($_REQUEST["category"])?(int)$_REQUEST["category"]:0;
$type=isset($_REQUEST["type"])?(int)$_REQUEST["type"]:0;
$qcat="";


if($category!=''&&$category!=0)
{
	$qcat="AND (t1.id='$category' OR (t1.pid='$category' OR t1.pid='$category' )) ";
	$WSE.=$qcat;
}
if($type!=''&&$type!=0)
{
	
	$qtype=" AND t1.type='$type' ";
	$WSE.=$qtype;
}
if($active!='')
{
	
	$qactive=" AND t1.active='$active' ";
	$WSE.=$qactive;
}
$PA=30;
$fr=($ACP-1)*$PA;
	// $noblg='';
				// $blg=mysqli_query($con,"SELECT id FROM categories WHERE type='4'");
				// if(mysqli_num_rows($blg)>0)
				// {
					// $noblg=" AND name <> 'blog'";
					// //$noblg1=" WHERE name <> 'blog'";
				// }
$q3=mysqli_query($con,"SELECT * FROM ctypes ");
$ctypes=mysqli_fetch_all($q3,MYSQLI_ASSOC);

?>
   
   <div class="container-fluid protocols shid">

	  <div class="col-12 px-0">
                     <div class="card">
			<div class="card-header">
				<div class="w-100">
				  <div class="row mx-0">
				  <div class="col-md-6">
					<div class="btn btn-outline-success px-3 cslitms " d='1'>
						კურსები <i class="fal fa-plus ml-2"></i> 
					 </div>
				   </div>
				   <div class="col-md-6">
					<div class="float-right ">
								<?php
	                              $c=0;
	                             for($z=0;$z<count($lnarr);$z++)
	                             {
	                              $c++;
	                             ?>
                            <div class="btn <?=($ltab==''&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"btn-success":"btn-danger" ?> ltab" d="<?=$c ?>" url="ka/<?=$p ?>?ltab=" style="border-radius:50%; width:45px; height:45px; ">
									<a class="text-white" style=" vertical-align: middle; text-align:center" ><b><?=$lnshortarr[$z] ?></b></a>
								</div>  
							<?php
								 }
								 ?>
						</div>	
					 </div>		
					</div>		
				</div>
			</div>
		
		</div>
		<div class="card  tab-content  mt-3 slitms" d='1'>
                    <div class="card-header">	
					<div class="row mx-0 justify-content-between">
						<h5>
							კურსები
						</h5>
						<div class="btn btn-outline-danger csclose" d='1'>
							&times;
						</div>
                    </div>
					</div>
					<div class="card-body a itmcontainer" t='categories' n='1'  >
						<div class="d-flex flex-wrap">
							<div class="col-6 pl-0">
							
						<?php
						  $c=0;
	                    for($z=0;$z<count($lnarr);$z++)
	                    {
	                      $c++;
						  $lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";
	                     ?>
						  <div class='enebi' d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>  '>	   
							  <div class="mb-2">
								<span class="border-0 ">კურსის დასახელება <?=$lnshortarr[$z] ?></span>
						        <input type="text" class="form-control mt-2 UPTS" name='name' tp="" ln='<?=$lnshortarr[$z] ?>' placeholder="დასახელება <?=$lnshortarr[$z] ?>">
								<input type="hidden" class="form-control mt-2 UPTS" name='type' tp="int" ln='' value='2'">
							  </div>
					
						
						   </div>  
						<?php
						}
                        ?>	
						
                      
						
							</div>
						<div class="col-6 pl-0">
						
						
						   <div class="mb-2">
                               
								<span class="border-0 ">მთავარი კურსი en</span>
								
						        <select class="form-control mt-2 UPTS" name='pid' tp="parents" ln='' placeholder="კურსის დასახელება">
						           <option value=''>აირჩიეთ კურსები</option>
						 <?php
						  $c=0;     
					     
						   $fld1=mysqli_query($con,"SELECT t1.*,  ". languages('categories','t1.id','name') ."  FROM categories AS t1 WHERE t1.pid is NULL OR t1.pid='0' ORDER BY id DESC");
	                       $c++;
						 
	                        for($z=0;$z<count($lnarr);$z++)
	                       {
							     $lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:""; 
						     while($rfld1=mysqli_fetch_assoc($fld1))
				               {
								 ?>
				                <option class='enebi' d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>  ' value='<?=$rfld1['id'] ?>'><?=$rfld1['name'.$lnshortarr[$z]] ?></option>
				              <?php
							   }
						}
						?>
						         </select>
						    </div>
						   
						
						
						
							
							
						</div>
						
                     <div class="col-12 mt-3 px-0">
						 <div class="btn btn-outline-success ADDITEMS" msg="შენახულია"   t='categories' wr='1'  pagename='' n='1' d="">
							 დამატება
						 </div>
					 </div>
					 </div>
					</div>
				</div>
	
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
                            <h5 class="col-md-2">
                                კურსები
                            </h5>
					        
							<div class="col-lg-4 col-md-4 my-md-0 my-2 search" data-page='<?=$p3 ?>'>
								<div class="d-flex mx-0 w-100 align-items-center">
									<div class="col-lg-11 col-10 px-0">
										<div id="custom-search" class="top-search-bar">
											<input class="form-control srval" type="text" placeholder="ძებნა.."  page="<?=$p3 ?>" ln='<?=$LA ?>' /> 
											<div class="srch srch" page="<?=$p3 ?>" ln='<?=$LA ?>'>
												<i class="fas fa-search"></i>
											</div>
										</div>
									</div>
									<div class="col-lg-1 col-2 text-right">
										<button class='btn btn-warning py-1'><a class='text-white' href='<?=$LA ?>/<?=$p3 ?>'/> 
										<i class="fas fa-recycle"></i>
										</a></button>
									</div>
								</div>
                            </div>
							
				
                            <!-- <div class="col-md-5 px-0 search" data-page='clients'>
                                <div id="custom-search" class="top-search-bar">
                                    <input class="form-control srval"  type="text" placeholder="ძებნა..">
                                    <div class="srch" >
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
								<div class="col-md-2 px-0" >
							   <button class='btn btn-success'><a class='text-white' href='/clients'/> გასუფთავება</a></button>
							</div> -->
                    </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
							
		<thead>
			<tr>
              
					<?php			   
                   $c=0;
	               for($z=0;$z<count($lnarr);$z++)
	              {
	               $c++;
	              ?>
				  <th d='<?=$c ?>' class='enebi' style="width:200px;  <?=$langdefaultarr[$z]=='1'?"":"display:none" ?> ">კურსი <?=$lnshortarr[$z] ?></th>
				  <?php
				  }
				  ?>
				<th style="width:120px" class="d-none">Slug</th>
				<th class="">მშობელი კურსი
				  <select class="form-control CATE" onchange="location.href='?page=courses&category='+$('.CATE').val()+'&type='+$('.tp').val()+'&active='+$('.ACTIVE').val();" >
				   <option value='0'>ყველა კურსი </option>
						<?php
                  $ct=mysqli_query($con,"SELECT t1.*, ". languages('categories','t1.id','name') ." FROM categories AS t1 WHERE  (t1.pid=0 OR  t1.id IN (SELECT pid FROM categories)) ORDER BY t1.id DESC");
				  while($rct=mysqli_fetch_assoc($ct))
				  {
		?>		   
				   <option <?=$category==$rct['id']?"selected":"" ?> value='<?=$rct['id'] ?>' ><?=$rct["name".$lngdefname] ?></option>
				   
		 <?php
				  }
         ?>				  
				</select>
				</th>
					<?php			   
                   $c=0;
	               for($z=0;$z<count($lnarr);$z++)
	              {
	               $c++;
	              ?>
				<th d='<?=$c ?>' style="<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> " class='enebi' >keywords <?=$lnshortarr[$z] ?></th>
				<th d='<?=$c ?>' style="width:200px;  <?=$langdefaultarr[$z]=='1'?"":"display:none" ?> " class='enebi'> description <?=$lnshortarr[$z] ?></th>
				<?php
				  }
				  ?>
				<th>ტიპი
				  <select class='form-control tp'  onchange="location.href='?page=courses&category='+$('.CATE').val()+'&type='+$('.tp').val()+'&active='+$('.ACTIVE').val();" >
				   <option value='0'>ყველა ტიპი</option>
				   
		        <?php
                  $tp=mysqli_query($con,"SELECT * FROM ctypes ORDER BY id DESC");
				  while($rtp=mysqli_fetch_assoc($tp))
				  {
		      ?>			  
				   <option <?=$type==$rtp['id']?"selected":"" ?> value='<?=$rtp['id'] ?>' ><?=$rtp["name"] ?></option>
		       <?php
				  }
		         ?>		   
				</select>
				</th>
				<th>პოზ.</th>
				<th style="width:120px">სურათი</th>
				<th style="width:120px">ბანერი</th>
				<th><i class="fa fa-filter"></i></th>
				<th>აქტიური
					      <select class='form-control ACTIVE'  onchange="location.href='?page=courses&category='+$('.CATE').val()+'&type='+$('.tp').val()+'&active='+$('.ACTIVE').val();" >
				   <option value=''>ყველა</option>
				   
		<?php
                
		?>			  
				   <option <?=$active==0?"selected":"" ?> value='0' >არააქტიური</option>
				   <option <?=$active==1?"selected":"" ?> value='1' >აქტიური</option>
		<?php
				  
		?>		   
				</select>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php
  $lmt=10;
  $pg=(empty($p4)?1:(int)$p4);
  $start=($pg-1)*$lmt;	
$q2=mysqli_query($con,"SELECT t1.*, ". languages('categories','t1.pid','name','parent') .", (SELECT name FROM ctypes WHERE id=t1.type)  AS ctype, 
   ". languages('categories','t1.id','name') .",
   ". languages('categories','t1.id','description') .",

   ". languages('categories','t1.id','keywords') ."

 FROM categories AS t1 WHERE t1.id<>0 $WSE ORDER BY t1.id DESC LIMIT ".$PA." OFFSET ".$fr."");
 


//line 166 query moved here
			while($r2=mysqli_fetch_array($q2)){
$stm=mysqli_prepare($con,"SELECT t1.*, ". languages('categories','t1.id','name') ." FROM categories AS t1 WHERE t1.type=(SELECT id FROM ctypes WHERE name=?) AND t1.id!=?  ORDER BY t1.name ASC ");

	
				
			$a=mysqli_query($con,"SELECT * FROM langs WHERE tableId='".$r2['id']."' and tableName='categories' AND shortname='en' ");
			
				if(mysqli_num_rows($a)<1)
				{
					 $ra=mysqli_fetch_assoc($a);
				mysqli_query($con,"INSERT INTO langs SET tableId='".$r2['id']."', tableName='categories', shortname='ka', tableColumn='description' ");
				 mysqli_query($con,"INSERT INTO langs SET tableId='".$r2['id']."', tableName='categories', shortname='en', tableColumn='description' ");
				mysqli_query($con,"INSERT INTO langs SET tableId='".$r2['id']."', tableName='categories', shortname='ka', tableColumn='keywords' ");
				 mysqli_query($con,"INSERT INTO langs SET tableId='".$r2['id']."', tableName='categories', shortname='en', tableColumn='keywords' ");
			
				mysqli_query($con,"INSERT INTO langs SET tableId='".$r2['id']."', tableName='categories', shortname='ka', tableColumn='name' ");
				 mysqli_query($con,"INSERT INTO langs SET tableId='".$r2['id']."', tableName='categories', shortname='en', tableColumn='name' ");
				}
			
			
?>

			<tr>


				<?php			   
                   $c=0;
	               for($z=0;$z<count($lnarr);$z++)
	              {
	               $c++;
	              ?>
		   <th class='enebi' d='<?=$c ?>'  style="width:200px;  <?=$langdefaultarr[$z]=='1'?"":"display:none" ?> "><input class="form-control UPT"  d="<?=$r2["id"]?>" t="categories" n="name"  <?=$lnshortarr[$z]=="en"?"slug='1'":"" ?> ln='<?=$lnshortarr[$z] ?>' value="<?=$r2["name".$lnshortarr[$z]]?> "/></th>
			     <?php
			     }
				 $j=0;
			     ?>

				<th class="d-none"><input style="width:120px"  class="form-control UPT" d="<?=$r2["id"]?>" t="categories" n="slug" value="<?=$r2["slug"]?>"/></th>
				<th style="width:150px" class="">

				<select class="form-control UPT3"   <?=$r2['type']==4?"disabled":""?>   d="<?=$r2["id"]?>" t="categories" n="pid">
				<option value="0">აირჩიეთ კურსი </option>
<?php
//$q3=mysqli_query($con,"SELECT t1.*, ". languages('categories','t1.id','name') ." FROM categories AS t1 WHERE t1.type=(SELECT id FROM ctypes WHERE name='".$r2['ctype']."') AND t1.id!='".$r2['id']."'  ORDER BY t1.name ASC");
            mysqli_stmt_bind_param($stm,"si",$r2['ctype'],$r2['id']);
            mysqli_stmt_execute($stm);
            $result=mysqli_stmt_get_result($stm);
			while($r3=mysqli_fetch_array($result)){
				$catebi = explode(',',$r2["pid"]);
				if($r3["type"]!=1 && $r3['pid']==0|| $r3['pid']===null )
				{
?>		
				<option <?=in_array($r3["id"], $catebi)?"selected":""?> value="<?=$r3["id"]?>"><?=$r3["name".$lngdefname]?></option>
<?php
				}
				if($r3["type"]==1)
				{
					?>
				<option <?=in_array($r3["id"], $catebi)?"selected":""?> value="<?=$r3["id"]?>"><?=$r3["name".$lngdefname]?></option>	
					<?php
				}
					
	}
	
?>		
</select>
<?php
		
?>
				</th>
					<?php			   
                   $c=0;
	               for($z=0;$z<count($lnarr);$z++)
	              {
	               $c++;
	              ?>
				<th class="enebi" style="<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>" d='<?=$c ?>'><textarea class="form-control UPT  " placeholder="keyword1,keyword2,keyword3 (max 20 სიტყვა)" title="keyword1,keyword2,keyword3 (max 20 სიტყვა)" d="<?=$r2["id"]?>"type="text" t="categories" n="keywords" ln='<?=$lnshortarr[$z] ?>' ><?=$r2["keywords".$lnshortarr[$z]]?></textarea></th>			
				<th class="enebi" style="<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>" d='<?=$c ?>'><textarea class="form-control UPT " placeholder="აღწერა (max 160 სიმბოლო)" title="აღწერა (max 160 სიმბოლო)" d="<?=$r2["id"]?>"type="text" t="categories" n="description"  ln='<?=$lnshortarr[$z] ?>' ><?=$r2["description".$lnshortarr[$z]]?></textarea></th>	
              <?php
				  }
            ?>				  
				<th><select style="width:90px" class="form-control UPT3" t="categories" n="type" d="<?=$r2["id"]?>">
					<option   value="0">აირჩიეთ ტიპი </option>
			<?php 
			foreach($ctypes as $r3){
		?>
					<option <?=$r2["ctype"]==$r3["name"]?"selected":""?>  value="<?=$r3['id'] ?>"><?=$r3['name']?> </option>
					
				<?php
				
			}
			?>
			
			
				</select></th>			
				<th><input style="width:50px" class="form-control UPT" d="<?=$r2["id"]?>" type="number" t="categories" n="position" value="<?=$r2["position"]?>"/></th>			
				<th>
					<div class="input-append row pr-2">
						<div class="col-md-9 pr-0">
							<input id="YDA9767032<?=$r2["id"]?>" class="form-control UPT" d="<?=$r2["id"]?>" t="categories" n="img" value="<?=$r2["img"]?>" placeholder="სურათის ლინკი" type="text" value="<?=$r1["img"]?>">		
						</div>
						<div class="col-md-3 pl-1"><a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA9767032<?=$r2["id"]?>&relative_url=0')"><button class="btn iframe-btn btn-outline-success px-1 py-0"><i class="fa fa fa-upload"></i></button></a>
						</div>
						<small class="ml-3">30px/30px</small>
					</div>				
				</th>			
				<th>
					<div class="input-append row pr-2">
						<div class="col-md-9 pr-0">
							<input id="YDA97670323<?=$r2["id"]?>" class="form-control UPT" d="<?=$r2["id"]?>" t="categories" n="banner" value="<?=$r2["banner"]?>" placeholder="სურათის ლინკი" type="text" value="<?=$r1["banner"]?>">		
						</div>
						<div class="col-md-3 pl-1"><a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA97670323<?=$r2["id"]?>&relative_url=0')"><button class="btn iframe-btn btn-outline-success px-1 py-0"><i class="fa fa fa-upload"></i></button></a>
						</div>
						<small class="ml-3">900px/250px</small>
					</div>				
				</th>				
				<th ><div class="btn btn-primary FIL px-1 py-0" d="<?=$r2["id"]?>"><i class="fa fa-filter"></i></div></th>
				<th><input class="form-control UPT2" d="<?=$r2["id"]?>"type="checkbox" t="categories" n="active" <?=$r2["active"]=="1"?"checked":""?>/></th> 				
				<th><div class="btn btn-danger DEL px-1 py-0" t="categories" d="<?=$r2["id"]?>"><i class="fa text-white fa-trash"></i></div></th>
			</tr>
<?php
	}
?>
		</tbody>
                            </table>
                        </div>
						
						
                    </div>
                    <div class="card-footer  ">
					  <div class='row'>	
				        <div class="w-100 text-right">
						                 <div class="w-100 text-center mt-4">
                <?php
		     $pgs=mysqli_query($con,"SELECT * FROM categories as t1 WHERE t1.id>0 $wsearch "); 
             $nmcont=mysqli_num_rows($pgs);			 
		     $nmcont>0? pagination($lmt,$LA,$p3,$pg,$nmcont,$search):"";
		   ?>
            </div>
            					      </div> 
					   </div>	 
					  <div class='row my-4'>
						    
							<div class="w-50">
								<span class="export d-none">
			                      <a href='/excel/clients.php?name=protocols'>
				                     <i class="fas fa-file-excel mx-1"></i>
				                       ექსპორტი
			                       </a>	
			                     </span>
							 </div>
				 
                             <div class="w-50 text-right">
                                <a  href='<?=$LA ?>/task' class="btn btn-outline-success " d='2' id="shproto">
                                  ახალი დავალება <i class="fal fa-plus"></i> 
                                </a>
                              </div>
						
					   </div>
                   
					   
					   
                    </div>
                </div>
            </div>

			
</div>
</div>