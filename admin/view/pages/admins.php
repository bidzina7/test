<?php
   $search=mysqli_real_escape_string($con,$_GET["search"]??"");
   $wsearch="";
   if($search!="")
   { 
      $wsearch="AND  CONCAT_WS(' ',t1.firstname,t1.lastname)  LIKE '%$search%'";
   }
   $id=isset($_GET["id"])?(int)$_GET["id"]:"";  
   $where="";
   if(getprm($uid,'clients')==0)
   {
	   $where=" AND t1.id='$uid' ";
   }
    $addadmins=(getprm($uid,'addadmins')==1)?1:0;
    $deladmins=(getprm($uid,'deladmins')==1)?1:0;
    $editadmins=(getprm($uid,'editadmins')==1)?1:0;
?>
<div class="container-fluid clients shid">
	  <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
                            <h5 class="col-md-3 pl-md-2 pl-0">
                                ადმინები   
                            </h5>
                            <div class="col-lg-4 col-md-8 my-md-0 search" data-page="admins">
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
									<button class="btn btn-warning py-1"><a class="text-white" href="/admins"> 
									<i class="fas fa-recycle"></i>
									</a></button>
								</div>
							</div>
                            </div>
					
                    </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">#</th>
                                        <th class="border-0">ადმინი</th>
                                        <th class="border-0">დამ.თარიღი</th>
                                        <th class="border-0">სტატუსი</th>
										
                                        <th class="border-0"><i class="fa fa-edit"></i></th>
										<?php
										
										  if($deladmins==1)
										  {
										?>
                                        <th class="border-0"> <i class="fa fa-trash"></i></th>
										<?php
										  }
										  ?>
                                    </tr>
                                </thead>
                                <tbody>
								  <?php
						            $lmt=10;
                                    $pg=(empty($p5)?1:(int)$p5);
                                    $start=($pg-1)*$lmt;
											
                                    $adm=mysqli_query($con,"SELECT t1.*, (SELECT name FROM userTypes WHERE id=t1.type) AS tpname FROM users AS t1 WHERE t1.type!=0 $wsearch  $where LIMIT $start, $lmt");
									$i=0;
									while($radm=mysqli_fetch_assoc($adm))
									{
										$i++;
                                  ?>					
                                        <tr class="<?=$radm['id']==$id&&$editadmins==1?"active":"" ?>">
                                        <td><?=$i ?></td>
                                        <td><?=$radm["firstname"] ?> <?=$radm["lastname"] ?>  <br>
											<?=$radm["username"] ?> 
										</td>                               
										<td><?=$radm["datacreated"] ?></td>                                     
                                    
                                  
										<td>
                                           <?=$radm["tpname"] ?>    
                                        </td>
										
                                        <td>
                                            <a class="btn <?=$editadmins==0&&$radm["id"]!=$uid?"btn-secondary":"btn-primary" ?>" <?=$editadmins==0&&$radm["id"]!=$uid?'':'href="'.$LA.'/admins/?id='.$radm["id"] .'#scrcont"' ?>><i class="fa fa-edit"></i></a>
                                        </td>
										<?php
										 
										  if($deladmins==1)
										  {
										?>
                                        <td>
                                            <button class="btn btn-danger del" t="users" d="<?=$radm['id'] ?>"><i class="fa fa-trash text-white"></i></button>
                                        </td>
										<?php
										  }
										  ?>
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
						        <?php
		                  $pgs=mysqli_query($con,"SELECT t1.id FROM users AS t1 WHERE t1.id!=0 AND t1.type!=0 $wsearch $where ");
                          $nmcont=mysqli_num_rows($pgs);			 
		                  $nmcont>0? pagination($lmt,$LA,$p4,$pg,$nmcont,$search):"";
		                ?>
						
						  					    </div>	
						<?php
						   if($addadmins==1)
						   {
                        ?>						
                        <div class="w-50 text-right">
                                <a class="btn  btn-outline-success cslitms btn-white" d='1'>
                                   ახალი ადმინი <i class="fal fa-plus"></i> 
                                </a>
                        </div>
						<?php
						   }
						   ?>
                    </div>
                </div>
            </div>
			
			<div class="col-12 px-0 my-3 <?=$id!=""&&($editadmins==1||$id==$uid)?"":"d-none" ?>" id="scrcont">
			<?php
			 if($id!="")
			 {
				 //echo "SELECT * FROM users WHERE id='$id'";
			   $adm1=mysqli_query($con,"SELECT t1.*  FROM users AS t1 WHERE t1.id='$id'");
									$radm1=mysqli_fetch_assoc($adm1);
								
			?>
				<div class="card">
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
                            <h5>
                               არჩეული ადმინი 
                            </h5>
                                  <div class="btn btn-outline-danger">
									<a href="<?=$LA ?>/admins">× </a>
								</div>
                        </div>
                    </div>
                    <div class="card-body validator itmcontainer" msg="აღნიშნული მომხმარებელი უკვე არსებობს!" sms='4' norep='username' t='users' d='<?=$id ?>' n='1' journaltype="1">
					 <form autocomplete="off">
						<div class="d-flex">
							<div class="col-6">
															
                                <div class="w-100">
									<h6 class="mb-2">username</h6>
									<input tp="" class="form-control UPTS journal  chinput valid novalid" data-valid="numb" name="username" jname="მისამართი" oldname="" autocomplete="off"  value="<?=$radm1["username"] ?>" placeholder="username" />
									  
								</div>
							<?php
						      $c=0;
	                          for($z=0;$z<count($lnarr);$z++)
	                          {
	                           $c++;
							   $lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";
	                           ?>
								<div class="w-100 my-3">
									<h6 class="mb-2">სახელი <?=$lnshortarr[$z] ?></h6>
									<input class="form-control UPTS valid journal" jname="სახელი" oldname="" data-valid="" type="text" name="firstname<?=$lnname ?>" value="<?=$radm1["firstname".$lnname] ?>" tp="" placeholder="სახელი">
								</div>
								<div class="w-100 my-3">
									<h6 class="mb-2">გვარი <?=$lnshortarr[$z] ?></h6>
									<input class="form-control UPTS valid journal"  jname="გვარი" oldname="" data-valid="" type="text" name="lastname<?=$lnname ?>" value="<?=$radm1["lastname".$lnname] ?>" tp="" placeholder="გვარი">
								</div>
							<?php
							  }
                             ?>							  
							
								
								
								</div>
							
								<div class="col-6">	
								<div class="w-100 ">
									<h6 class="mb-2">როლის არჩევა</h6>
									<select name="type" tp="int" class="form-control UPTS journal opt " jname="როლი" oldname="">
									       <?php
										      $ustp=mysqli_query($con,"SELECT * FROM userTypes ");
											  while($rustp=mysqli_fetch_assoc($ustp))
											  {
										   ?>
									            <option value="<?=$rustp['id'] ?>"  <?=($rustp['id']==$radm1['type'])?"selected":"" ?> newval="სუპერადმინი" <br=""><?=$rustp['name'] ?></option>
											<?php
											  }
											  ?>
													
									</select>
								</div>
		                      
                            														
								
                                <div class="w-100 my-3">
                                    <h6 class="mb-2">პაროლის ცვლილება</h6>
									<input class="form-control mb-2 UPTS valid password" data-valid="password" type="password" tp="password" name="password" placeholder="ახალი პაროლი " readonly onfocus="this.removeAttribute('readonly');">
									<input class="form-control UPTS valid retype" data-valid="repassword" type="password" tp="repass" name="repeat" placeholder="გაიმეორეთ პაროლი" readonly onfocus="this.removeAttribute('readonly');">
                                </div>
								<div class="w-100 my-3">
									<h6 class="mb-2">რეგისტრაციის თარიღი</h6>
																	</div>	
								</div>
							</div>
							<div class="col-12 text-left ">
								<div class="btn btn-outline-success  ADDITEMS"   t='users'   pagename='' d="<?=$id ?>" n='1'>
									დამახსოვრება
								</div>
							</div>
						  </form>	
						</div>
                </div>
				<?php
			 }
			 ?>
			</div>
			<div class="col-12 px-0 my-3 ">
				<div class="card slitms"  d='1' style=""> 
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
                            <h5>
                               ახალი ადმინი
                            </h5>
                            <div class="btn btn-outline-danger csclose" d='1'>
                                ×
                            </div>
                        </div>
                    </div>
                    <div class="card-body validator itmcontainer" msg="აღნიშნული მომხმარებელი უკვე არსებობს!" sms='4' norep='username' t='users' d='' n='2'>
					  <form autocomplete="off">
						<div class="d-flex">
							<div class="col-6">
							  <div class="w-100">
									<h6 class="mb-2">username</h6>
									<input tp="" class="form-control UPTS journal  chinput valid novalid" data-valid="numb" name="username" jname="მისამართი" oldname="" autocomplete="off"  placeholder="username" />
									  
								</div>
							<?php
						      $c=0;
	                          for($z=0;$z<count($lnarr);$z++)
	                          {
							   $lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";  
	                           $c++;
	                         ?>
								<div class="w-100">
									<h6 class="mb-2">სახელი <?=$lnshortarr[$z] ?></h6>
									<input class="form-control UPTS valid name novalid"   data-valid="" name="firstname<?=$lnname ?>" type="text" placeholder="სახელი">
									<input class="form-control UPTS lastname" name="active" type="hidden" value="1" tp="int">
								</div>
								<div class="w-100">
									<h6 class="mb-2">გვარი <?=$lnshortarr[$z] ?></h6>
									<input class="form-control UPTS valid novalid"  data-valid="" name="lastname<?=$lnname ?>" type="text" placeholder="გვარი">
								</div>
							<?php
							  }
							?>	
						
								
								
								</div>
							
								<div class="col-6">	
                                    
								<div class="w-100 ">
									<h6 class="mb-2">როლის არჩევა</h6>
									<select name="type" tp="int" class="form-control UPTS">
									 								<?php
										      $ustp=mysqli_query($con,"SELECT * FROM userTypes ");
											  while($rustp=mysqli_fetch_assoc($ustp))
											  {
										   ?>
									            <option value="<?=$rustp['id'] ?>" newval="სუპერადმინი" <br=""><?=$rustp['name'] ?></option>
									
											<?php
											  }
											  ?>
									
																				
									</select>
								</div>	
									
								                                 <div class="w-100 my-3">
                                    <h6 class="mb-2">პაროლი</h6>
									<input class="form-control mb-2 UPTS valid novalid password" data-valid="password" type="password" tp="password" name="password" placeholder="პაროლი" readonly onfocus="this.removeAttribute('readonly');">
									<input class="form-control UPTS valid novalid retype" data-valid="retype" type="password" tp="repass" name="repeat" placeholder="გაიმეორეთ პაროლი" readonly onfocus="this.removeAttribute('readonly');">
                                </div>
								<!-- <div class="w-100 my-3">
									<h6 class="mb-2">რეგისტრაციის თარიღი</h6>
									02.02.2022
								</div>	 -->
								</div>
							</div>
							<div class="col-12 text-left ">
								<div class="btn btn-outline-success ADDITEMS"   t='users'   pagename='' d="" n='2' wr='1'>
									დამატება
								</div>
							</div>
							</form>
						</div>
                </div>
			</div>
		
</div>