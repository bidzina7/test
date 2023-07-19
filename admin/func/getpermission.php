	
<?php
  $id=isset($_POST["id"])?(int)$_POST["id"]:0;
  $permissions=mysqli_query($con,"SELECT t1.* FROM permission AS t1 order by t1.id ASC");
        $pages=mysqli_query($con,"SELECT t1.* FROM permissionpages AS t1 order by t1.id ASC");
        $user=mysqli_query($con,"SELECT t1.* FROM users AS t1  WHERE t1.id='$id' order by t1.id ASC");
        $permeta=mysqli_query($con,"SELECT t1.* FROM permissionMeta AS t1 WHERE t1.uid = '$id' order by t1.id ASC");
		//echo "SELECT t1.* FROM permissionMeta AS t1 WHERE t1.uid = '$id' order by t1.id ASC";
		$rpermissions=mysqli_fetch_assoc($permissions);
		$ruser=mysqli_fetch_assoc($user);
		$rpermeta=mysqli_fetch_assoc($permeta);
		$rpages=mysqli_fetch_assoc($pages);
		
		$ppages=$rpermeta['pages']??"";
		$pper=$rpermeta['permissions']??"";
		$ppagesarr=explode(",",$ppages);
		$pperarr=explode(",",$pper);
		$result=true;
?>
	<div class='prheader py-2 justify-content-between row' >
			          <div class='col-md-6 '>
							   <h5><?=$ruser["firstname"] ?> <?=$ruser["lastname"] ?></h5>
							</div>
					 <div class='col-md-6 '>
                        <div class="btn btn-danger permclose float-right" d="1">
							&times;
						 </div>
					</div>	
			   </div>
			   <div class='prbody' >
			 
		           		<div class="additems card-body itmcontainer" msg="შენახულია" sms='4' t='permissionMeta' d="<?=$rpermeta["id"]??'' ?>" n="<?=1234235456 ?>" journaltype="1"   >
						<div class="d-flex">
							
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
													<input type="checkbox" <?=in_array($page['id'], $ppagesarr)?"checked":"" ?> class="form-control mr-2 addinput" name="pages2" d='<?=$page['id'] ?>' /> 
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
													<input type="checkbox"  <?=in_array($permission['id'], $pperarr)?"checked":"" ?> class="form-control mr-2 addinput" name="permissions2" d='<?=$permission['id'] ?>' /> 
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
						<input type='hidden'  class='form-control addinp UPTS'  ln="" value='<?=$rpermeta["pages"]??"" ?>' name='pages' pname='pages2' />
						<input type='hidden'  class='form-control addinp UPTS'  ln="" tp='int' name='uid' value='<?=$ruser["id"] ?>'/>
						<input type='hidden'  class='form-control addinp UPTS'  ln="" value='<?=$rpermeta["permissions"]??"" ?>' name='permissions' pname='permissions2' />
						
                     <div class="col-12 mt-3 px-0">
						 <div class="btn btn-outline-success ADDITEMS"     t='permissionMeta' d="<?=$rpermeta["id"]??'' ?>" n="<?=1234235456 ?>"  >
							 დამატება
						 </div>
					 </div>
					</div>
						</div>