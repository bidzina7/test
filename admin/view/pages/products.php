<?php
  $search="";
  $search=mysqli_real_escape_string($con,$_GET["search"]??"");
  $wsearch=$search!=""?" WHERE t1.id IN(SELECT tableId FROM langs WHERE tableColumn='name' AND tableName='products' AND columnValue LIKE '%$search%')":"";
?>
<div class="container-fluid protocols shid">
      <div class="col-12 px-0">
	    <div class="card">
			<div class="card-header">
				<div class="w-100">
					<div class="btn btn-outline-success px-3 cslitms" d='1'>
						მასალები/პროდუქტები <i class="fal fa-plus ml-2"></i> 
					</div>
				</div>
			</div>
			
		</div>
			 <div class="card  tab-content  mt-3 slitms" d='1'>
                    <div class="card-header">	
					<div class="row mx-0 justify-content-between">
						<h5>
							ახალი მასალა/პროდუქტი
						</h5>
						<div class="btn btn-outline-danger csclose" d='1'>
							&times;
						</div>
                    </div>
					</div>
					<div class="card-body a itmcontainer" t='products' n='1' >
						<div class="d-flex flex-wrap">
							<div class="col-12 pl-0">
							
						<?php
						  $c=0;
	                    for($z=0;$z<count($lnarr);$z++)
	                    {
	                      $c++;
	                     ?>
							  <div class="mb-2">
								<span class="border-0 ">მასალა/პროდუქტის დასახელება <?=$lnshortarr[$z] ?></span>
						        <input type="text" class="form-control mt-2 UPTS" name='name' tp="" ln='<?=$lnshortarr[$z] ?>' placeholder="მასალა/პროდუქტის დასახელება">
							  </div>
						<?php
						}
                        ?>	

                    	
						   
							</div>
				
						
                     <div class="col-12 mt-3 px-0">
						 <div class="btn btn-outline-success ADDITEMS" msg="შენახულია"   t='products'  wr='1' pagename='' n='1' d="" pos='1'>
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
                                მასალები/პროდუქტები 
                            </h5>
					    
							<div class="col-lg-4 col-md-8 my-md-0 my-2 search" data-page='clients'>
								<div class="d-flex mx-0 w-100 align-items-center">
									<div class="col-lg-11 col-10 px-0">
										<div id="custom-search" class="top-search-bar">
											<input class="form-control srval" type="text" placeholder="ძებნა.." page="<?=$p4 ?>" ln='<?=$LA ?>'>
											<div class="srch" page="<?=$p4 ?>" ln='<?=$LA ?>'>
												<i class="fas fa-search"></i>
											</div>
										</div>
									</div>
									<div class="col-lg-1 col-2 text-right">
										<button class='btn btn-warning py-1'><a class='text-white' href='<?=$LA ?>/<?=$p4 ?>'/> 
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
	                                   ?>
                                        <th class="border-0">მასალა/პროდუქტი <?=$lnshortarr[$z] ?></th>
									   <?php
										}
                                        ?>										
                                        <!-- <th class="border-0">ვალი</th> -->
                                    
                                        
                                        <th class="border-0"> <i class="fa fa-trash"></i></th>
										
                                    </tr>
                                </thead>
                                <tbody>
											<?php
					         $lmt=10;
                             $pg=(empty($p5)?1:(int)$p5);
                             $start=($pg-1)*$lmt;											
					    $fld=mysqli_query($con,"SELECT t1.*,  ". languages('products','t1.id','name') ."  FROM products AS t1 $wsearch LIMIT $start, $lmt ");
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
                                        <td>
									
										 <input type='text' class="form-control UPT" rl='1' value='<?=$rfld["name".$lnshortarr[$z]] ?>' t='products' n='name' ln='<?=$lnshortarr[$z] ?>' d='<?=$rfld['id'] ?>' />   
                                       			         					
										</td> 
										 <?php

										}
                                        ?>		
										
                                       
                                        <td>
                                            <button class="btn  btn-danger del " t='products'  d="<?=$rfld["id"] ?>	" ><i class="fa fa-trash text-white"></i></button>
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
			      $pgs=mysqli_query($con,"SELECT t1.id FROM products AS t1 $wsearch");
                  $nmcont=mysqli_num_rows($pgs);			 
		          $nmcont>0? pagination($lmt,$LA,$p4,$pg,$nmcont,$search):"";
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