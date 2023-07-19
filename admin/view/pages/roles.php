   <?php
   $id=isset($_GET["id"])?(int)$_GET['id']:"";
   $search=mysqli_real_escape_string($con,$_GET["search"]??"");
   $wsearch="";
   if($search!="")
   { 
    $wsearch="AND  CONCAT_WS(' ',t1.firstname,t1.lastname)  LIKE '%$search%'";
   }
 //  echo "SELECT t1.* FROM permissionMeta AS t1 WHERE t1.uid = '$id' order by t1.id ASC";
   $permeta=mysqli_query($con,"SELECT t1.* FROM permissionMeta AS t1 WHERE t1.roleid = '$id' order by t1.id ASC");

   $roles=mysqli_query($con,"SELECT * FROM userTypes");
   $roll=mysqli_query($con,"SELECT * FROM userTypes WHERE id='$id'");
   $rroll=mysqli_fetch_assoc($roll);
   $pages=mysqli_query($con,"SELECT t1.* FROM permissionpages AS t1 order by t1.id ASC");
   $permissions=mysqli_query($con,"SELECT t1.* FROM permission AS t1 order by t1.id ASC");
   $lmt=10;	
   $admins=mysqli_query($con,"SELECT t1.*, (SELECT typeName FROM userTypes WHERE id=t1.type) AS usertype FROM  users AS t1 WHERE  t1.type!=0 $wsearch order by t1.id ASC ");
   $nmadmin=mysqli_query($con,  "SELECT t1.* FROM users  AS t1  AND t1.type!=0  $wsearch orderby t1.id ASC  ");
   $rpermissions=mysqli_fetch_assoc($permissions);
		$radmins=mysqli_fetch_assoc($admins);
		$rpermeta=mysqli_fetch_assoc($permeta);
		$rpages=mysqli_fetch_assoc($pages);
		
		$ppages=$rpermeta['pages']??"";
		$pper=$rpermeta['permissions']??"";
		$ppagesarr=explode(",",$ppages);
		$pperarr=explode(",",$pper);
   ?>
   <div class="container-fluid roles shid">
	<div class="col-12 px-0">
		<div class="card">
			<div class="card-header">
				<div class="w-100">
					<div class="btn btn-outline-success px-3 cslitms" d='1'>
						ახალი როლი <i class="fal fa-plus ml-2"></i> 
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="d-flex">
				   <?php
				   
				       foreach($roles AS $role)
					   {
				   ?>
					<div class="btn btn-outline-primary px-4 mr-2 role-item">
						<?php
						   if($role["main"]!=1)
						   {
						?>
						<div class="role-del DEL" t='userTypes'  d="<?=$role["id"] ?>"></div>
						<?php
						   }
						   ?>
				      <a href='<?=$LA?>/<?=$p4 ?>?id=<?=$role["id"] ?>'>
						<?=$role["name"] ?>
					
						   </a>
					</div>
				 <?php
						  
					   }
					 ?>
				 					
				</div>
			</div>
		</div>
			 <div class="card mt-3 slitms d-none" d='1' >
                    <div class="card-header">	
					<div class="row mx-0 justify-content-between">
						<h5>
							ახალი როლი
						</h5>
						<div class="btn btn-outline-danger csclose" d='1'>
							&times;
						</div>
                    </div>
					</div>
					<div class="card-body  itmcontainer" msg="შენახულია" sms='4' t='userTypes' d="" n="<?=1 ?>"  >
						<div class="d-flex">
							<div class="col-6 pl-0">
								<span class="border-0 ">როლის დასახელება</span>
						<input type="text" class="form-control mt-2 UPTS" name='typeName' placeholder="როლის დასახელება">
							</div>
							<div class="col-6 pr-0 row">
							    <div class='col-md-6'>
								   <span class="border-0 ">გვერდები</span>
							     <div class="dropdown show mt-2">
											
											<div class=" w-100" aria-labelledby="dropdownMenuButton">
												
										 <?php
				                            foreach($pages AS $page)
					                         {
				                            ?>
												<div class=" align-items-center d-flex" href="#">
													<input type="checkbox" class="form-control mr-2 addinput" name="pages1" d='<?=$page['id'] ?>' /> 
													<label for="page1">
														<?=$page['name'] ?>
													</label>
												</div>
											<?php
											 }
											 
											 ?>
																									 
											
											</div>
								  </div>
								</div>
								 <div class='col-md-6'>
								   <span class="border-0 ">უფლებები</span>
								  	     <div class="dropdown show mt-2">
											
											<div class=" w-100" aria-labelledby="dropdownMenuButton">
												<?php
				                            foreach($permissions AS $permission)
					                         {
				                            ?>
												<div class=" align-items-center d-flex" href="#">
													<input type="checkbox" class="form-control mr-2 addinput" name="permissions1" d='<?=$permission['id'] ?>' /> 
													<label for="permission">
														<?=$permission['name'] ?>
													</label>
												</div>
											<?php
											 }
											 
											 ?>								   
											</div>
								      </div>  
								   
								 </div> 
							</div>
						</div>
						<input type='hidden'  class='form-control addinp UPTS'  rl='roleid' t='permissionMeta/1'  name='pages' pname='pages1' />
						<input type='hidden'  class='form-control addinp UPTS'  rl='roleid' t='permissionMeta/1'  name='permissions' pname='permissions1' />
					
                     <div class="col-12 mt-3 px-0">
						 <div class="btn btn-outline-success ADDITEMS"     t='userTypes' d="" n='<?=1 ?>'>
							 დამატება
						 </div>
					 </div>
					</div>
				</div>
		  <div class="card mt-3">
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
                            <h5 class="col-md-2">
                                როლები
                            </h5>
							<div class="col-lg-4 col-md-8 my-md-0 my-2 search" data-page='roles'>
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
										<button class='btn btn-warning py-1'><a class='text-white' href='/<?=$p4 ?>'/> 
										<i class="fas fa-recycle"></i>
										</a></button>
									</div>
								</div>
                            </div>
<!-- 							
                             <div class="col-md-4 px-0 search" data-page='roles'>
                                <div id="custom-search" class="top-search-bar">
                                    <input class="form-control srval" type="text" placeholder="ძებნა..">
                                    <div class="srch">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-2 px-4" >
							   <p class='btn btn-success'><a class='text-white' href='/roles'/> გასუფთავება</a></p>
							</div> -->
                    </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">#</th>
                                        <th class="border-0">ადმინი</th>
                                        <th class="border-0">როლი</th>
										<th class="border-0 d-none">custom</th>
                                        <th class="border-0 d-none"><i class="fa fa-edit"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
							<?php
								   foreach($admins AS $num=>$radmin)
									{
										$num++;
								 ?>
                                    <tr>
                                        <td><?=1+$num ?></td>
                                        <td><?=$radmin['firstname'] ?> <?=$radmin['lastname'] ?>  <br>
											<?=$radmin['pid'] ?> 
										</td>
                                        <td>
                                           <select class='form-control UPT' n='type' t='users' tp='int' d='<?=$radmin['id'] ?>'  <?=$radmin['custom']==1?"disabled":"" ?>>
										      <option>როლის არჩევა</option>
											   <?php
				                                foreach($roles AS $role)
					                           {
				                               ?>
										      <option value='<?=$role['id'] ?>' <?=$role['id']==$radmin['type']?"selected":"" ?> ><?=$role["name"] ?></option>
										       <?php
											   }
											   ?>
										   </select>
                                        </td>
                                        <td class='d-none'>
                                            <input type='checkbox' class='UPT ' tp='int' n='custom' rld='1' tp='int' t='users' <?=$radmin['custom']==1?"checked":"" ?> d='<?=$radmin['id'] ?>' >
                                        </td>
										<td class="d-none">
                                            <a class=" text-white btn  <?=$radmin['custom']==1?" btn-primary shperm":"btn-secondary" ?>" d='<?=$radmin['id'] ?>' ><i class="fa fa-edit  "></i></a>
                                        </td>
                                    </tr>
                              <?php
							  
									}
									?>
                               
                          
                           
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
					
					
					
				
					
					
                    <div class="card-footer row">
					     <div class="w-50 text-right">
						  					    </div>
                        <div class="w-50 text-right">
                                <a class="btn btn-outline-success" href="admins">
                                   ახალი ადმინი <i class="fal fa-plus"></i> 
                                </a>
                        </div>
                    </div>
                </div>
				
				
							<div class="col-12 px-0 my-3  <?=$id!=""?"":"d-none" ?>">
				<div class="card">
                    <div class="card-header ">
                        <div class="row mx-0 justify-content-between">
                            <h5>
                               არჩეული როლი
                            </h5>
                            <div class="btn btn-outline-danger">
									წაშლა
								</div>
                    </div>
                    </div>

                  	<div class="card-body itmcontainer" msg="შენახულია" sms='4'  t='userTypes' d="<?=$rpermeta["id"]??'' ?>" n="1" d='<?=$id ?>'  >
						<div class="d-flex">
							<div class="col-6 pl-0">
								<span class="border-0 ">როლის დასახელება <?=$id ?></span>
						<input type="text" class="form-control mt-2 UPTS" name='typeName' placeholder="როლის დასახელება" value="<?=$rroll["typeName"]??"" ?>" <?=$rroll["main"]==1?"disabled":"" ?> />
							</div>
							<div class="col-6 pr-0 row">
							    <div class='col-md-6'>
								   <span class="border-0 ">გვერდები</span>
							     <div class="dropdown show mt-2">
											
											<div class=" w-100" aria-labelledby="dropdownMenuButton">
											<?php
				                            foreach($pages AS $page)
					                         {
				                            ?>
												<div class=" align-items-center d-flex" href="#">
													<input type="checkbox"  <?=in_array($page['id'], $ppagesarr)?"checked":"" ?> <?=$rroll["main"]==1?"disabled":"" ?>  class="form-control mr-2 addinput" name="pages3" d='<?=$page['id'] ?>' /> 
													<label for="page1">
														<?=$page['name'] ?>
													</label>
												</div>
											<?php
											 }
											 
											 ?>
											 
											
											</div>
								  </div>
								</div>
								 <div class='col-md-6'>
								   <span class="border-0 ">permissions</span>
								  	     <div class="dropdown show mt-2">
											
											<div class=" w-100" aria-labelledby="dropdownMenuButton">
											<?php
				                            foreach($permissions AS $permission)
					                         {
				                            ?>
												<div class=" align-items-center d-flex" href="#">
													<input type="checkbox" <?=in_array($permission['id'], $pperarr)?"checked":"" ?> <?=$rroll["main"]==1?"disabled":"" ?>  class="form-control mr-2 addinput" name="permissions3" d='<?=$permission['id'] ?>' /> 
													<label for="permission">
														<?=$permission['name'] ?>
													</label>
												</div>
											<?php
											 }
											 
											 ?>
											 
											
											</div>
								      </div>  
								   
								 </div> 
							</div>
						</div>
						<input type='hidden'  class='form-control addinp UPTS'  rl='roleid' t='permissionMeta/1' value="<?=$rpermeta["pages"]??"" ?>" name='pages' pname='pages3' />
						<input type='hidden'  class='form-control addinp UPTS'  rl='roleid' t='permissionMeta/1'  name='permissions' value='<?=$rpermeta["permissions"]??"" ?>' pname='permissions3' />
						<input type='hidden'  class='form-control  UPTS' tp='int' rl='roleid' t='permissionMeta/1'  name='warehouseid'  />
						<input type='hidden'  class='form-control  UPTS' tp='int' rl='roleid' t='permissionMeta/1'  name='amountid'  />
                     <div class="col-12 mt-3 px-0">
						 <div class="btn btn-outline-success <?=$id==0?'':'ADDITEMS' ?>" t='userTypes' d="<?=$id ?>" n="1"  msg="შენახულია">
							 დამატება
						 </div>
					 </div>
					</div>











                    <!-- <div class="card-footer">
                        
                    </div> -->
                </div>
			</div>
				
				
				
				
				
			
	</div>
	
	
	<div class="prconf w-100 fixed-top d-none row" id='permissions'>
	      
		   
		  <div class='prcontent' id='permissioncont' >
		    
			   
			 
			 
		  </div>
	   
	</div>
	
	
</div>

    