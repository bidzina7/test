<?php

$ACP=1;
$p=$_REQUEST["p"]??1;
if(isset($p)){
	$ACP=$p;
}
$PA=30;
$fr=($ACP-1)*$PA;
$WSE="";
$KEY="";
$slang='';
$ksarch='';
if(isset($_REQUEST["key"])){
	
	$KEY=mysqli_real_escape_string($con,$_REQUEST["key"]??"");
	$ksarch='&key='.$KEY;
	
	   for($z=0;$z<count($lnarr);$z++)
	   {
	      
	      $slang.="t1.id IN (SELECT table_id FROM langs WHERE tableColumn='title'  AND shortname='".$lnshortarr[$z]."' AND tableName='articles' AND columnValue LIKE '%".$KEY."%') OR ";
		
	   }
	   $slang=rtrim($slang,"OR ");
	   //echo $slang;
	
	$WSE="AND $slang";
}

  $search="";
  $search=mysqli_real_escape_string($con,$_GET["search"]??"");
  $wsearch=$search!=""?" WHERE t1.id IN(SELECT tableId FROM langs WHERE tableColumn='name' AND tableName='lessons' AND columnValue LIKE '%$search%')":"";
  $q1=mysqli_query($con,"SELECT t1.*, ". languages('articles','t1.id','title') .", (SELECT t3.columnValue FROM langs as t3 WHERE tableName='categories' AND shortname='ka' AND tableColumn='name' AND t3.tableId=t2.id LIMIT 1) as 'catka', (SELECT t3.columnValue FROM langs as t3 WHERE tableName='categories' AND shortname='en' AND tableColumn='name' AND t3.tableId=t2.id LIMIT 1) as 'caten' FROM articles as t1
  LEFT JOIN categories as t2 ON(t1.category=t2.id) WHERE t1.id>0 AND t1.news=1 $wsearch ORDER BY t1.id DESC LIMIT ".$PA." OFFSET ".$fr."");	
  $q100=mysqli_query($con,"SELECT * FROM articles as t1 WHERE t1.id>0 AND t1.news=1 $WSE  ORDER BY t1.id DESC LIMIT ".$PA." OFFSET ".$fr."");	
	
  if($q100){
	  $cou=mysqli_num_rows($q100)-($ACP-1)*$PA;		
  }
?>
<div class="container-fluid protocols shid">
      <div class="col-12 px-0">
	    <div class="card">
			<div class="card-header">
				<div class="w-100">
					<div class="btn btn-outline-success px-3 cslitms" d='1'>
						 დამატება <i class="fal fa-plus ml-2"></i> 
					</div>
				</div>
			</div>
			
		</div>
	
	

	  
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
					
                            <h5 class="col-md-2">
                                გაკვეთილები
                            </h5>
					    
							<div class="col-lg-4 col-md-8 my-md-0 my-2 search" data-page='clients'>
								<div class="d-flex mx-0 w-100 align-items-center">
									<div class="col-lg-11 col-10 px-0">
										<div id="custom-search" class="top-search-bar">
											<input class="form-control srval" type="text" placeholder="ძებნა.." page="<?=$p3 ?>" ln='<?=$LA ?>'>
											<div class="srch" page="<?=$p3 ?>" ln='<?=$LA ?>'>
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
			<th>N</th>
			<th>id</th>	
			<th>img</th>
			
			<?php			   
             $c=0;
	         for($z=0;$z<count($lnarr);$z++)
	        {
	      $c++;
	       ?>
		   <th class='enebi' d='<?=$c ?>'  style="<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>">title <?=$lnshortarr[$z] ?></th>
			<?php
			}
			?>
			<th>category</th>
			
			<th>tags</th>
			<th>comments_number</th>
			<!-- <th>სლაიდზე</th> -->
			
			<th>აქტიური</th>
			
			<th>რედაქტირება</th>
			<th>წაშლა</th>
		  </tr>
		</thead>
		<tbody>
<?php
if($q1){
while($r1=mysqli_fetch_array($q1)){
	// $sld=mysqli_query($con,"SELECT * FROM slider WHERE pid='".$r1["id"]."'");

	?>
		  <tr>
			<th><?=$cou?></th>
			<th><?=$r1["id"]?></th>	
			<th><img src="<?=$r1["img"]?>" style="width:70px" /></th>
	
			<?php
	        $c=0;
	       for($z=0;$z<count($lnarr);$z++)
	        {
	         $c++;
	        ?>
			<th class='enebi' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>' d='<?=$c ?>'><?=$r1["title" .$lnshortarr[$z]]?></th>
			<?php
			}?>
			<?php
	        $c=0;
	       for($z=0;$z<count($lnarr);$z++)
	        {
	         $c++;
	        ?>	
			<th class='enebi' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>' d='<?=$c ?>'><?=$r1["cat".$lnshortarr[$z]]?></th>
			<?php
			}?>			
			<th><?php /*$r1["tags"] */?></th>
			<th><?php /*$r1["comments_number"] */ ?></th>
			<!-- <td><input type='checkbox'<?=$r1["slider"]=="1"?"checked":""?> class='form-control UPT' n='slider' t='articles' d="<?=$r1["id"]?>" /></td> -->
			
			<th><input type='checkbox'<?=$r1["active"]=="1"?"checked":""?> class='form-control UPT' n='active' t='articles' d="<?=$r1["id"]?>" /></th>
		
			<th><a href="ka/lesson?id=<?=$r1["id"]?>"><button class="btn btn-outline-success">რედაქტირება</button> </a> </th>
			<th><button class="btn btn-outline-danger DGA" d="<?=$r1["id"]?>" n="articles">წაშლა</button></th>
		  </tr>
<?php
$cou=$cou-1;
}
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
			      $pgs=mysqli_query($con,"SELECT t1.id FROM products AS t1 $wsearch");
                  $nmcont=mysqli_num_rows($pgs);			 
		          $nmcont>0? pagination($lmt,$LA,$p3,$pg,$nmcont,$search):"";
			   ?>
            </div>
            					      </div>
					   </div>	 
					   <div class='row my-4 d-none'>
						    
							<div class="w-50 ">
								<span class="export">
			                      <a href='/excel/clients.php?name=protocols'>
				                     <i class="fas fa-file-excel mx-1"></i>
				                       ექსპორტი
			                       </a>	
			                     </span> 
							 </div>
				 
                           
						
					   </div>
                    </div>
                </div>
            </div>

			
</div>
</div>