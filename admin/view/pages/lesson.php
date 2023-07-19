<?php
$a=mysqli_real_escape_string($con,$_GET["id"]??"");
$T=time();
echo $a ."--";	
if(isset($_GET["id"])){
	echo "ixvi";
	$q1=mysqli_query($con,"SELECT * FROM articles WHERE id='".$a."' AND news=1");
	$r1=mysqli_fetch_array($q1);

}else{
	echo "INSERT INTO articles (date,authorid,news) VALUES ('$T','$Guid',1) ";
	$ina=mysqli_query($con,"INSERT INTO articles (date,authorid,news) VALUES ('$T','$Guid',1) ");
    $ind=mysqli_insert_id($con);
	$dd=mysqli_query($con, "SELECT id FROM articles WHERE news=1 ORDER BY id DESC");
	$rd=mysqli_fetch_array($dd);
	$aid=mysqli_insert_id($con);
	
	if($ina)
	{
		$a=$ind;
	
	 echo $a;
	?>
	
<script>
location.href="ka/lesson/id=<?=$a?>"
</script>
<?php
	}
}
      $c=0;
	  for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
     
 $lng=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='articles' AND  tableColumn='title' AND tableId='$a' ");
 $lng1=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='articles' AND  tableColumn='text' AND tableId='$a' ");
 $lng2=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='articles' AND  tableColumn='description' AND tableId='$a' ");
 $lng3=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='articles' AND  tableColumn='keywords' AND tableId='$a' ");
 $lng4=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='articles' AND  tableColumn='shorttext' AND tableId='$a' ");
   if(mysqli_num_rows($lng)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='articles' , tableColumn='title' , tableId='$a'  ");
   }
   
    if(mysqli_num_rows($lng1)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='articles' , tableColumn='text' , tableId='$a'  ");
   }
   
    if(mysqli_num_rows($lng2)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='articles' , tableColumn='description' , tableId='$a'  ");
   }
    if(mysqli_num_rows($lng3)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='articles' , tableColumn='keywords' , tableId='$a'  ");
   }
     if(mysqli_num_rows($lng4)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='articles' , tableColumn='shorttext' , tableId='$a'  ");
   }
	   }


?>	
			<div class="container-fluid protocols shid">
       <div class="col-12 px-0">
	   	   
			<div class="col-12 px-0 my-3 " id='scrcont'>
				<div class="card">
                    <div class="card-header ">
                        <div class="row mx-0 justify-content-between">
                            <h5>
                               რედაქტირება:  </h5> 
                           
							<div>
								<?php
	                              $c=0;
	                             for($z=0;$z<count($lnarr);$z++)
	                             {
	                              $c++;
	                             ?>
                            <div class="btn <?=($ltab==''&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"btn-success":"btn-danger" ?> ltab" d="<?=$c ?>" url="ka/<?=$p ?>/?id=<?=$id ?>&ltab=" style="border-radius:50%; width:45px; height:45px; ">
									<a class="text-white" style=" vertical-align: middle; text-align:center" ><b><?=$lnshortarr[$z] ?></b></a>
								</div>  
							<?php
								 }
								 ?>
							</div>	
                     </div>
                    </div>
				    <div class="card-body">
					  
				

<div class="row">
	<div class="col-sm-12 my-3 d-none">
	
		<a style="color:#FFF"  class="btn btn-primary svpr" >გადახედვა</a>
	
	</div>
</div>
<?php

 $a=mysqli_real_escape_string($con,$_GET["id"]??"");
 $q1=mysqli_query($con,"SELECT t1.*,  ". languages('articles','t1.id','title') ." ,
                                      ".languages('articles','t1.id','text') .",
                                      ".languages('articles','t1.id','description') .",
                                      ".languages('articles','t1.id','shorttext') .",
                                      ".languages('articles','t1.id','keywords') ."
									  FROM articles  AS t1 WHERE t1.id='".$a."'");
 $r1=mysqli_fetch_array($q1);
?>
<div role="tabpanel">
    <!-- Tab panes -->

   
 

	
    <div class="tab-content  itmcontainer" t='articles'>

        <div role="tabpanel" class="tab-pane active" id="georgian">
              	
<?php			   
             $c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
		

		
           <div class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '>
                       <label for="ge[sarchevi]" class="required">დასახელება <?=$lnshortarr[$z] ?></label>
                       <input class="form-control UPTS" value="<?=$r1["title".$lnshortarr[$z]] ?>" tp='' ln='<?=$lnshortarr[$z] ?>' rows="10"  id="ADLGE" name="title" cols="50">
		               <br>
               </div>		
	   <?php
	   }
	   ?>
	   
	       <div class="row nonTranslatedInput pad-no-sm">
        
        <div class="col-sm-12 pad-no-right pad-no-xs my-2">
            <label for="pdf">სიახლის სურათი</label> <small>800px/800px</small>

<div class="input-append row">
					<div class="col-md-9">
						<input id="YDA9767032" class="form-control UPT" t="articles" n="img" d="<?=$a ?>" placeholder="სურათი 1" type="text" value="<?=$r1["img"]?>">		
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA9767032&relative_url=0')"><button class="btn iframe-btn btn-outline-success">არჩევა</button></a>
				</div>
  
        </div>
		<br>&nbsp;




    

    </div>
				   
<input class="form-control UPTS d-none" value="<?=$r1["slug"] ?>" rows="10" data-locale="ge" tp='' ln='' id="SLGGE" name="slug" cols="50" placeholder='slug' />
		<br>
		

   <?php
     $c=0;
         for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
        <div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>  '>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">მოკლეტექსტი <?=$lnshortarr[$z] ?></label>

               <textarea id="ADTENG<?=$z ?>"  ln='<?=$lnshortarr[$z] ?>' style="width:100%;" class='UPTS ' tp='' name='shorttext' placeholder="აღწერა <?=$lnshortarr[$z] ?>"><?=$r1["shorttext".$lnshortarr[$z]] ?></textarea>
  
            </div>     
		</div>	
	<?php
	   }
   		?>			
		
		<br/>
		
		 <?php			   
       $c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
        <div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>'>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">ტექსტი <?=$lnshortarr[$z] ?></label>

               <textarea id="ADTENG<?=$z ?>" tiny='1' ln='<?=$lnshortarr[$z] ?>' class='UPTS tnmc' tp='' name='text' placeholder="ტექსტი <?=$lnshortarr[$z] ?>"><?=$r1["text".$lnshortarr[$z]] ?></textarea>
  
            </div>     
		</div>	
		
	<?php
	   }
	   ?>
	   <br/>
	   <h1>სეო</h1>
	   <?php
     $c=0;
         for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
        <div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>  '>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">აღწერა <?=$lnshortarr[$z] ?></label>

               <textarea id="ADTENG<?=$z ?>"  ln='<?=$lnshortarr[$z] ?>' style="width:100%;" class='UPTS ' tp='' name='description' placeholder="აღწერა <?=$lnshortarr[$z] ?>"><?=$r1["description".$lnshortarr[$z]] ?></textarea>
  
            </div>     
		</div>	
	<?php
	   }
   					
             
	   $c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
		

		
           <div class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '>
                       <label for="ge[sarchevi]" class="required">keywords <?=$lnshortarr[$z] ?></label>
                       <input class="form-control UPTS" value="<?=$r1["keywords".$lnshortarr[$z]] ?>" tp='' ln='<?=$lnshortarr[$z] ?>' rows="10"  id="ADLGE" name="keywords" cols="50">
		               <br>
           </div>		
			   
			   
			   
	   <?php
	   }
	   ?>	   
            </div>

        
   

	<div class="row">
		<div class="col-sm-2">
			<label for="ACA">აირჩიეთ ავტორი</label>
		</div>
		<div class="col-sm-4">
			<select class="form-control UPTS" name="authorid" tp='' ln='' >
			<option <?=$r1["category"]==0?"selected":""?> value='0' >აირჩიეთ ავტორი</option>
<?php
$q2=mysqli_query($con,"SELECT t1.* FROM admins AS t1 ORDER BY t1.Id DESC");
while($r2=mysqli_fetch_array($q2)){
?>
				<option <?=$r1["authorid"]==$r2["Id"]?"selected":""?> value="<?=$r2["Id"]?>"><?=$r2["firstname"] ?> <?=$r2["lastname"] ?> </option>
<?php
}
?>				
			</select>
		</div>
		
		
		
		
		
	
	</div>	

<br/>





	<div class="row">
		<div class="col-sm-2">
			<label for="ACA">აირჩიეთ კატეგორია</label>
		</div>
		<div class="col-sm-4">
			<select class="form-control UPTS" name="category" tp='' ln='' >
			<option <?=$r1["category"]==0?"selected":""?> value='0' >აირჩიეთ კატეგორია</option>
<?php
$q2=mysqli_query($con,"SELECT t1.*, ". languages('categories','t1.id','name') ." FROM categories AS t1 WHERE t1.type IN(SELECT id FROM ctypes WHERE name='news') AND t1.active='1'  ORDER BY t1.id DESC");
while($r2=mysqli_fetch_array($q2)){
?>
				<option <?=$r1["category"]==$r2["id"]?"selected":""?> value="<?=$r2["id"]?>"><?=$r2["name".$lngdefname] ?> </option>
<?php
}
?>				
			</select>
		</div>
		<div class='col-sm-6'>
		<label>
		    აქტიური
		   <input type='checkbox' class='UPTS' name='active' tp='int' ln='' <?=$r1['active']=='1'?'checked':'' ?> class='aactv' />
		</label>   
		
	
	
		</div>
	</div>	
	
	
	
    <div class="submit my-4">
        <button  class="btn btn-success ADDITEMS" slug='1' t='articles' d="<?=$a?>">დამახსოვრება</button>
    </div>
    
    </div><!---qart--->

</div>
						</div>
                     <div class="card-footer  py-3">
					 <div class="row">
					  
					    <span class="text-left col-md-9">
						
						 
						   
						<div class=" my-3 itmcontainer" msg="ოქმის დასრულება" sms='4' t='protocol'  n="x" d='<?=$id ?>' conf='1'>
						 <div class="row">
						  <div class="col-md-3">
						     <input  class="form-control UPT" t="protocol" n='creatdate' tp='datepick' type='text'   ln=""  value="<?=$rproto["creatdate"]>0?date("d-m-Y",$rproto["creatdate"]):"" ?>"  d='<?=$rproto["id"] ?>' />
						   </div>
						   <div class="col-md-3">
						     <input type="text" class="form-control UPT" t="protocol" n='enddate' tp='datepick' value="<?=$rproto["enddate"]>0?date("d-m-Y",$rproto["enddate"]):"" ?>" ln=""  d='<?=$rproto["id"] ?>' /> 
						   </div>
						  <div class="col-md-6">
						   <input class="form-control UPTS" maxlength='12' name='complete'   ln="" tp='int' type="hidden" value='1' /> 
						 
						      
			                <div  class='btn  <?=$protoed==1?'btn-outline-success ADDITEMS':'btn-secondary' ?>' t='protocol' n='x' d='<?=$id?>' conf='1' msg="ოქმის დასრულება" >
			            	  დასრულება
							</div> 
							</div> 
							</div> 
			             </div>	
			            	
			            </span>
                        <span class=" text-right col-md-3">
						
						
						    <div class="row">
							 <div class="col-md-7">
							 <input type="text" data-page='func/protocolpdf.php/' class="form-control ADDTR UPT"  t="protocol" n='printdate'  type='text'   ln="" name='daterange' tp='datepick' value="<?=date("d-m-Y",$rproto["printdate"])?>" d='<?=$rproto["id"] ?>' />
							 </div>
							 <div class="col-md-5">
							 <div  class='btn btn-outline-success shpdf'>
				               <i class="fas fa-file-pdf mx-1"></i>
				               იხილეთ PDF
							 </div>
			                </div>           
			             </div>    
					  </span>
                    </div>
                    </div>
                </div>
			</div>
			<?php
			  if(getprm($Guid,'protomake')==1) 
			 {
			?>	
		  <div class="card">
			<div class="card-header">
				<div class="row mx-0 justify-content-between">
					<h5>
						მაჩვენებლები: 
					</h5>
					 <div >
					   <div class="btn btn-success" onClick="window.location.reload()")>
					      გადატვირთვა
					   </div>
					</div>
				</div>
			</div>
			<div class="card-body">
		
			</div>
			
			
			<div class="col-lg-12 col-12 px-lg-0 ">
            <div class="filter-cont mb-lg-0 mb-4">
              
                <div class="filter-body d-lg-block ">
                 
                    <div class="w-100 row my-3">
							<?php
							 // echo "SELECT t1.*, (SELECT 1  FROM protometa WHERE fieldid=t1.id AND pid='$id') AS chk,
				                          // (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM protofields AS t1  WHERE
										  // t1.parents='' AND t1.id IN(".$rproto["fldid"].") ";
				  $fld=mysqli_query($con,"SELECT t1.*, (SELECT 1  FROM protometa WHERE fieldid=t1.id AND pid='$id') AS chk,
				                          (SELECT columnValue FROM langs WHERE tableName='protofields' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."  FROM protofields AS t1  WHERE
										  t1.parents='' AND t1.product LIKE '%".$rproto['product']."%' OR t1.id IN(SELECT parents FROM protofields WHERE product LIKE '%".$rproto['product']."%' )");
                  $fldnum=mysqli_num_rows($fld);		
	              $flcol=ceil($fldnum/2);
                //  echo $fldnum	."--". $flcol;	
				  $i=0;
				  ?>
				   <div class="col-md-6">
				  <?php
				  
				while($rfld=mysqli_fetch_assoc($fld))
				   {
					   ++$i; 
					   if(($flcol-$i)==-1&&$flcol>1)
					   {
						   ?>
						   </div>
						   <div class="col-md-6">
						   <?php
					   }
					
				?>
                <div class="filter-item ">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <h4>
                               <input type='checkbox'  name="fieldid"  <?=$rfld["chk"]==1?"checked":"" ?> pid='<?=$id ?>' class="parper parcheck" d='<?=$rfld["id"] ?>' /><?=$rfld["name".$LA] ?> 
                            </h4>
                            <img src="images/icons/plus.svg" class="slcnt"  d='<?=$rfld["id"] ?>' alt="" product='<?=$rproto['product'] ?>' id='<?=$id ?>'>
                    </div> 
						
                        <div class="collapsed-cat mt-3" d='<?=$rfld["id"] ?>'>
                        <ul>
						<?php
						$fld1=mysqli_query($con,"SELECT t1.*, (SELECT 1  FROM protometa WHERE fieldid=t1.id AND pid='$id') AS chk,
				                          (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM protofields AS t1 WHERE t1.parents='".$rfld["id"]."'
										    AND t1.product LIKE '%".$rproto['product']."%' ");
                  
				         while($rfld1=mysqli_fetch_assoc($fld1))
						 {
				  ?>
                            <li>
                                
                                   <input type='checkbox' class="parchild parcheck" <?=$rfld1["chk"]==1?"checked":"" ?> pid='<?=$id ?>' par="<?=$rfld["id"] ?>" d="<?=$rfld1["id"] ?>"  name="fieldid"/> <?=$rfld1["name".$LA] ?> 
                               
                            </li>
                    <?php
						 } 
                     ?>						 
                           
                        </ul>
                    </div>   
                    </div>
                <?php
				   } 
				   ?>
                </div>
                 
                    </div>
           
                    <hr>
             

                </div>
            </div>
        </div>
			
		</div>
			
			<?php
			 }
			 ?>
			</div>
			</div>
			<script>
    
	$(".filter-cont").click(function(){
     //   $(this).toggleClass("open");
    });
    $(".slcnt").click(function(){
		var d=$(this).attr("d");
        $(this).toggleClass("open");
        if($(this).hasClass("open")){
            $(".collapsed-cat[d='"+d+"']").show("fast");
            $(this).attr('src',"images/icons/minus.svg");
        }else{
            $(this).attr('src',"images/icons/plus.svg");
            $(".collapsed-cat[d='"+d+"']").hide("fast");
        }
    });
   
</script>