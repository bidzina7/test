<?php
$ltab=isset($_GET['ltab'])?(int)$_GET["ltab"]:"";
  $search=mysqli_real_escape_string($con,$_GET["search"]??"");
  $wsearch=$search!=""?" WHERE t1.id IN(SELECT tableId FROM langs WHERE tableColumn='name' AND tableName='protofields' AND columnValue LIKE '%$search%')":"";
 // echo "SELECT t1.*, (SELECT columnValue FROM langs WHERE tableName='units ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM units AS t1";
 //echo "SELECT t1.*, (SELECT columnValue FROM langs WHERE tableName='products' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM products AS t1";
$exmeth=(getprm($uid,'exams')==1)?1:0;
   $exms=mysqli_query($con,"SELECT t1.*, 
				                                        (SELECT columnValue FROM langs WHERE tableName='examethods ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM examethods AS t1");
   $prds=mysqli_query($con,"SELECT t1.*,  ". languages('products','t1.id','name') ."  FROM products AS t1 ");													
?>
<div class="container-fluid protocols shid">
      <div class="col-12 px-0">
	    <div class="card">
			<div class="card-header">
				<div class="w-100">
				  <div class="row mx-0">
				  <div class="col-md-6">
					<div class="btn btn-outline-success px-3 cslitms " d='1'>
						მაჩვენებლები <i class="fal fa-plus ml-2"></i> 
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
							ახალი მაჩვენებელი
						</h5>
						<div class="btn btn-outline-danger csclose" d='1'>
							&times;
						</div>
                    </div>
					</div>
					<div class="card-body a itmcontainer" t='protofields' n='1'  >
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
								<span class="border-0 ">საკვლევი პარამეტრები <?=$lnshortarr[$z] ?></span>
						        <input type="text" class="form-control mt-2 UPTS" name='name' tp="" ln='<?=$lnshortarr[$z] ?>' placeholder="მაჩვენებლის დასახელება <?=$lnshortarr[$z] ?>">
							  </div>
					
							  <div class="mb-2">
								<span class="border-0 ">მიზანი <?=$lnshortarr[$z] ?></span>
						        <input type="text" class="form-control mt-2 UPTS" name='purpose' tp="" ln='<?=$lnshortarr[$z] ?>' placeholder="მიზნის დასახელება <?=$lnshortarr[$z] ?>">
							  </div>
						   </div>  
						<?php
						}
                        ?>	
						
                           <div class="mb-2">
								<span class="border-0 ">პროდუქტი/მასალა</span>
								
						        <select class="form-control mt-2 UPTS selectpicker" style="overflow-y:auto" name='product' tp="arr" ln='' data-live-search="true" placeholder="მაჩვენებლები" multiple>
						         
						    <?php
							
				              foreach($prds AS $prd)
				                                 {
				             ?>
				                <option value='<?=$prd['id'] ?>'><?=$prd['nameka'] ?></option>
				            <?php
				             }
				             ?>
						         </select>
						   </div>	
						
							</div>
						<div class="col-6 pl-0">
						
						
						   <div class="mb-2">
                               
								<span class="border-0 ">მაჩვენებლები en</span>
								
						        <select class="form-control mt-2 UPTS" name='parents' tp="parents" ln='' placeholder="პარამეტრის დასახელება">
						           <option value=''>აირჩიეთ მაჩვენებელი</option>
						 <?php
						  $c=0;     
					     
						   $fld1=mysqli_query($con,"SELECT t1.*,  ". languages('protofields','t1.id','name') ."  FROM protofields AS t1 WHERE t1.parents='' ");
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
						   
						
						   	<div class="mb-2">
								<span class="border-0 ">გამოცდის მეთოდი</span>
								
						        <select class="form-control mt-2 UPTS selectpicker" data-live-search="true" name='exam' tp="arr" ln='' placeholder="მაჩვენებლის დასახელება" multiple >
						           <option value=''>გამოცდის მეთოდი</option>
						    <?php
							
				             
				              foreach($exms AS $exm)
				             {
				             ?>
				                <option value='<?=$exm['id'] ?>'><?=$exm['name'.$LA] ?></option>
				            <?php
				             }
				             ?>
						         </select>
						   </div>
					    
						
							
							
						</div>
						
                     <div class="col-12 mt-3 px-0">
						 <div class="btn btn-outline-success ADDITEMS" msg="შენახულია"   t='protofields' wr='1'  pagename='' n='1' d="">
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
                                მაჩვენებლები 
                            </h5>
					    
							<div class="col-lg-4 col-md-8 my-md-0 my-2 search" data-page='clients'>
								<div class="d-flex mx-0 w-100 align-items-center">
									<div class="col-lg-11 col-10 px-0">
										<div id="custom-search" class="top-search-bar">
											<input class="form-control srval" type="text" placeholder="ძებნა.."  page="<?=$p4 ?>" ln='<?=$LA ?>'>
											<div class="srch" page="<?=$p4 ?>" ln='<?=$LA ?>'>
												<i class="fas fa-search"></i>
											</div>
										</div>
									</div>
									<div class="col-lg-1 col-2 text-right">
										<button class='btn btn-warning py-1'><a class='text-white' href='<?=$LA ?>/protocols'/> 
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
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">#</th>
                                        <!-- <th class="border-0">სურათი</th> -->
										
								   <?php
						              $c=0;
	                                  for($z=0;$z<count($lnarr);$z++)
	                                {
	                                 $c++;
						             $lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";
	                                    ?>
						
                                        <th class="border-0 enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>  '>პარამეტრები <?=$lnshortarr[$z] ?></th>
									
																		
                                        <!-- <th class="border-0">ვალი</th> -->
                                         <th class="border-0 enebi d-none" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>  '>მიზნები <?=$lnshortarr[$z] ?></th> 
										 
										<?php
										}
										
                                          ?>										
                                        <th class="border-0">მაჩვენებლები</th> 
                                    
                                        <th class="border-0">მასალა/პროდუქტი</th> 
										
                                       
                                        <th class="border-0">გამოცდის მეთოდი</th>
                                    
                                        
                                        <th class="border-0"> <i class="fa fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
											<?php
					         $lmt=10;
                             $pg=(empty($p5)?1:(int)$p5);
                             $start=($pg-1)*$lmt;		
                       // echo "SELECT t1.*,  ". languages('protofields','t1.id','name') ." , ". languages('protofields','t1.id','purpose') ." FROM protofields AS t1 $wsearch ORDER BY t1.id DESC LIMIT $start, $lmt "	;						 
					    $fld=mysqli_query($con,"SELECT t1.*,  ". languages('protofields','t1.id','name') ." , ". languages('protofields','t1.id','purpose') ." FROM protofields AS t1 $wsearch ORDER BY t1.id DESC LIMIT $start, $lmt ");
				      $i=$start;
					  
						while($rfld=mysqli_fetch_assoc($fld))
						{ 
					     $i++;		
                      				 
					?>
						<div class="row mx-0">							
																	
                                    <tr class=''>
                                        <td><?=$i ?> </td>
                                        <!-- <td>
                                            <div ><img src="img/user.png" alt="user" class="rounded"></div>
                                        </td> -->
											<?php
						                $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
	                                      $c++;
	                                   ?>
                                        <td class="enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>'>
									
										 <input type='text' class="form-control UPT" rl='1' value='<?=$rfld["name".$lnshortarr[$z]] ?>' t='protofields' n='name' ln='<?=$lnshortarr[$z] ?>' d='<?=$rfld['id'] ?>' />   
                                       			         					
										</td> 
										
                                        <td class="enebi d-none" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>'>
									
										 <input type='text' class="form-control UPT" rl='1' value='<?=$rfld["purpose".$lnshortarr[$z]] ?>' t='protofields' n='purpose' ln='<?=$lnshortarr[$z] ?>' d='<?=$rfld['id'] ?>' />   
                                       			         					
										</td> 
										 <?php

										}
                                       $c=0;
						
						     
						             for($z=0;$z<count($lnarr);$z++)
	                                  {
										  $c++;
								  ?>
										  <td class="enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>'>
                                           <select class="form-control UPT" n='parents' t="protofields" d='<?=$rfld['id'] ?>'>
										     <option value=''>მაჩვენებელი <?=$lnshortarr[$z] ?> </option>
											 		<?php
					                                  $fld1=mysqli_query($con,"SELECT t1.*,  ". languages('protofields','t1.id','name') ."  FROM protofields AS t1 WHERE id!='".$rfld['id']."' AND parents='' ");
													  $k=0;
						                              while($rfld1=mysqli_fetch_assoc($fld1))
						                              { 
					                                    $k++;	
														?>
														<option value='<?=$rfld1['id'] ?>' <?=$rfld1['id']== $rfld['parents']?"selected":""?>><?=$rfld1["name".$lnshortarr[$z]] ?></option>
														<?php
													  }														
													 ?> 
											 
										   </select>
										</td>
                                     <?php
									  }
                                    ?>									  
									     <td>
										    <select class="form-control UPT selectpicker" style="z-index:9999; width:100%;" data-live-search="true" n='product' t="protofields"  multiple d='<?=$rfld['id'] ?>'>
										     <option>მასალა/პროდუქტი</option>
											 		<?php
					                                 
													  $k=0;
						                                foreach($prds AS $prd)
				                                         {
												          $infl= explode(',',$rfld["product"]);
					                                    $k++;	
														?>
														<option value='<?=$prd['id'] ?>' < <?=in_array($prd['id'], $infl)?"selected":""?>><?=$prd["nameka"] ?></option>
														<?php
													  }														
													 ?> 
											 
										   </select>
										</td>
									
										<td>
										      <select class="form-control mt-2 UPT selectpicker" data-live-search="true" t='protofields' n='exam' tp="arr" ln='' placeholder="ტიპის დასახელება" multiple d='<?=$rfld['id'] ?>'>
						                         <option value=''>გამოცდის მეთოდი</option>
						                       <?php
				                              
				                                   foreach($exms AS $exm)
				                                 {
													   $xm = explode(',',$rfld["exam"]);
				                                ?>
				                                   <option value='<?=$exm['id'] ?>'  <?=in_array($exm['id'], $xm)?"selected":""?>><?=$exm['name'.$LA] ?></option>
				                              <?php
				                                 }
				                               ?>
						                       </select>
										</td>
                                    
         
                                        <td>
                                            <button class="btn  btn-danger del " t='protofields'  d="<?=$rfld["id"] ?>	" ><i class="fa fa-trash text-white"></i></button>
                                        </td>
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
			      $pgs=mysqli_query($con,"SELECT t1.id FROM protofields  AS t1 $wsearch");
                  $nmcont=mysqli_num_rows($pgs);			 
		          $nmcont>0? pagination($lmt,$LA,$p4,$pg,$nmcont,$search):"";
			   ?>
            </div>
            					      </div>
					   </div>	 
					   <div class='row my-4'>
						    
							<div class="w-50 d-none">
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