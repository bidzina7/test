<?php
$search="";
$search=mysqli_real_escape_string($con,$_GET["search"]??"");
$lmt=10;
$pg=(empty($p5)?1:(int)$p5);
 $start=($pg-1)*$lmt;
 $wsearch="";
   if($search!="")
   {
	    $wsearch= "AND t1.text LIKE '%$search%' ";
   }	   
   // $journals=mysqli_query($con,"SELECT t1.*, 
                                // (SELECT name FROM opertypes WHERE id=t1.opertype ) AS opername, 
								// ". languages('users','t1.uid','firstname') .", ". languages('users','t1.uid','lastname') ."
								// FROM journal AS t1 order by t1.id DESC LIMIT $start, $lmt");			
   $journals=mysqli_query($con,"SELECT t1.*, (select concat(firstname,' ',lastname)  FROM users WHERE id=t1.uid) AS username,
                                (SELECT name FROM opertypes WHERE id=t1.opertype ) AS opername
								
								FROM journal AS t1 WHERE  t1.id!=0 $wsearch order by t1.id DESC LIMIT $start, $lmt");								
?>

<div class="container-fluid history shid">
<div class="col-12 px-0">
	<div class="card">
		<div class="card-header">
			<div class="row mx-0 justify-content-between">
				<h5 class="col-lg-4 col-md-4 col-6">
					ჟურნალი
				</h5>
			

				<div class="col-lg-4 col-md-8 my-md-0 my-2 search" data-page='<?=$P1 ?>'>
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
										<button class='btn btn-warning py-1'><a class='text-white' href='/<?=$P1 ?>'/> 
										<i class="fas fa-recycle"></i>
										</a></button>
									</div>
								</div>
                            </div>
				<!-- <div class="col-md-4 px-0 search" t="<?=$daterange ?>" data-page='<?=$P1 ?>'>
					<div id="custom-search" class="top-search-bar">
						<input class="form-control srval" type="text" placeholder="ძებნა..">
						<div class="srch"> 
							<i class="fas fa-search"></i>
						</div>
					</div>
				</div>
					<div class="col-md-2 px-4" >
							   <p class='btn btn-success'><a class='text-white' href='/<?=$P1 ?>'/> გასუფთავება</a></p>
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
							<th class="border-0">ადმინი</th>
							<th class="border-0 filtr">შეცვლილი პარამეტრები</th>
							<th class="border-0 filtr">ოპერაცია</th>
							<th class="border-0 filtr">თარიღი</th>
							
						</tr>
					</thead>
					<tbody>
					<?php
					     foreach($journals AS $num=>$journal)
						 {
							  if(getprm($uid,$journal["perm"])==1||$journal["perm"]=="") 
							 {	
						
							 $num++;
							
					?>
						<tr>
							<td><?=$start+$num ?></td>
							<!-- <td>
								<div ><img src="img/user.png" alt="user" class="rounded"></div>
							</td> -->
							<td>
									
									<?=$journal["username"] ?> <?=$journal["perm"] ?>
							</td>
							<td><?=$journal['text'] ?> 
							
								
							</td>
							<td>
							
							
							<?=$journal["opername"] ?>
							
							</td>
							<td>
							  <?=$journal['date'] ?> 
							</td>
							
						</tr>
				
						<?php
						 }
						 }
						 ?>
						<!-- <tr>
							<td colspan="9"><a href="#" class="btn btn-outline-light float-right">View Details</a></td>
						</tr> -->

					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer text-right">
		 <div class="w-50 text-right">
			<div class="w-100 text-center mt-4">
                <?php
		     $pgs=mysqli_query($con,"SELECT t1.id FROM journal AS t1 WHERE  t1.id!=0 $wsearch ");
             $nmcont=mysqli_num_rows($pgs);			 
		     $nmcont>0? pagination($lmt,$LA,$p4,$pg,$nmcont,$search):"";
		   ?>
            </div>
          </div>
			<div class="w-100 text-center mt-4">
			  &nbsp; 
            </div>			
						  
		 </div>	
			
		</div>
	</div>
</div>

