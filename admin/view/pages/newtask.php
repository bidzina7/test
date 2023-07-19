	 <div class="container-fluid protocols shid">
       <div class="col-12 px-0">
	<div class="col-12 px-0 my-3  " id="protocont" d='2'>
				<div class="card">
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
                            <h5>
                               ახალი დავალება 
                            </h5>
                            <div class="btn btn-outline-danger csclose" d='2'>
									&times;
								</div>
                    </div>
                    </div>
					<div class="col-12 itmcontainer" msg="აღნიშნული მომხმარებელი უკვე არსებობს!" sms='4' norep='pid' t='users' d=''>
							  <div class="w-100 my-3 row">
							   <div class="col-md-10">
							
								<input  class="form-control UPTS valid novalid shusr" list="users"  type="text" name='pid' maxlength='11'  data-valid='personalid'  placeholder="პირადი ნომერი">
								<div class="usrcont">
								  
								</div>
								
							  </div>	 
							  <div class="col-md-2">	 
                                 <button class="btn btn-outline-secondary shbutsr" disabled msg="შენახულია"   t='users'   pagename='' d="">დამატება</button>
							  </div>	
                              	<div class="col-md-6 my-3">
									<input class="form-control UPT"  tp='int' value='4' n='type' t='users' type="hidden" >
									<input class="form-control UPT valid novalid cusr chusrs"  n='firstname' t='users' disabled type="text" data-valid placeholder="სახელი">
								  
								</div>
								<div class="col-md-6 my-3">
									
									<input class="form-control UPT valid novalid cusr chusrs"   type="text" n='lastname'  t='users' disabled  data-valid placeholder="გვარი">
								</div>
						
							   <div class="col-md-6 my-3">
								 <input class="form-control UPT cusr chusrs" type="text" n='companyname'   t='users' disabled placeholder="კომპანიის სახელი">
					
							   </div>	
							   
								<div class="col-md-6 my-3">
									
									<input class="form-control UPT cusr chusrs" type="text" n='address' disabled t='users' disabled placeholder="მისამართი">
								</div>	
								<div class="col-md-6 my-3">
									
									<input class="form-control UPT  valid novalid cusr chusrs" maxlength='12' type="text" n='tel' t='users' disabled data-valid='tel'  placeholder="ტელეფონი">
								</div>	
							  
							 </div>	   
					</div>
                    <div class="card-body validator itmcontainer"   msg="აღნიშნული მომხმარებელი უკვე არსებობს!" sms='4' norep='pid,tel' t='protocol' d='' >
						<div class="row mx-0">
							<div class="col-md-6 col-12">
					
					
							
					
							    <div class="w-100 my-3">
									
									<input class="form-control UPTS valid novalid"  name='name'  ln='' type="text" data-valid placeholder="ოქმის დასახელება">
									<input class="form-control UPTS valid novalid chusrs"  name='uid' n='uid' ln='' type="hidden" data-valid placeholder="ოქმის დასახელება">
								  
								</div>
								
							  	
						   
								
								
								</div>
								<div class="col-lg-3 col-6">
								       <div class=" mt-2">
											
											<div class=" w-100 col-12">
											      <?php
												  $i=0;
												       $fld2=mysqli_query($con,"SELECT t1.*, 
				                          (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM protofields AS t1");
													   while($rfld2=mysqli_fetch_assoc($fld2))
													   {
												  $i++;
												  ?>
											    <div class=" align-items-center d-flex flex-row mb-3" href="#">
													<input type="checkbox" value='<?=$rfld2['id'] ?>' class="form-control mr-2 uptsmaker"  t='protometa/<?=$i ?>' rl='pid' ln='' name="fieldid"  /> 
												 
													<label for="page1">
														<?=$rfld2["name".$LA] ?>	
													</label>
												</div>
										
												<?php
													   }
                                                    ?>													   
											
											</div>
							
								</div>
							
							</div>
							<div class="col-12 text-left ">
								<div class="btn btn-outline-secondary shbtusr1" disabled msg="შენახულია"   t='protocol'   pagename='' d="">
									დამატება
								</div>
							</div>
						</div>
                    <!-- <div class="card-footer">
                        
                    </div> -->
                </div>
			</div>
</div>       </div>
</div>       


