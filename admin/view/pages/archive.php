   <?php
   $ltab=isset($_GET['ltab'])?(int)$_GET["ltab"]:"";
   $year=isset($_GET['year'])?(int)$_GET['year']:"";
   $search=mysqli_real_escape_string($con,$_GET["search"]??"");
   $wsearch="";
   $archive=(getprm($uid,'archive')==1)?1:0;
   if($search!="")
   {
	   $wsearch=" AND (t1.pnumb LIKE '%$search%' OR t1.uid IN((SELECT id FROM users WHERE pid LIKE '%$search%' OR concat(firstname,' ',lastname) LIKE '%$search%' OR tel LIKE '%$search%' OR companyname LIKE '%$search%'))
	                                              OR t1.id IN (SELECT tableId FROM langs WHERE tableName='protocol' AND tableColumn='name' AND shortname='".$LA."' AND columnValue LIKE '%$search%' )
												  OR t1.id IN (SELECT t2.pid FROM protometa AS t2 WHERE t2.fieldid IN (SELECT tableId FROM langs WHERE tableName='protofields' AND tableColumn='name' AND shortname='".$LA."' AND columnValue LIKE '%$search%') )
												  ) ";
   }
      function status($x,$y)
	  {
		  
		  switch($x)
		  {  
		  case 1:
		  return $y==1?' <div class="circle-status  normal " title="ხელმოწერილი"></div>':' <div class="circle-status  pending " title="დასრულებული"></div>';
		
		  default:
		  return ' <div class="circle-status  notrust " title="მიმდინარე"></div>';
	    }
	  }
   
   ?>
   
   <div class="container-fluid protocols shid">

	  <div class="col-12 px-0">

	  
                <div class="card">
                    <div class="card-header">
                        <div class="row mx-0 justify-content-between">
                            <h5 class="col-md-2">
                                არქივი <?=$year ?>
                            </h5>
					      
							<div class="col-lg-4 col-md-8 my-md-0 my-2 search" data-page='<?=$p4 ?>'>
								<div class="d-flex mx-0 w-100 align-items-center">
									<div class="col-lg-11 col-10 px-0">
										<div id="custom-search" class="top-search-bar">
											<input class="form-control srval" type="text" placeholder="ძებნა.."  page="<?=$p4 ?>" year="<?=$year ?>" ln='<?=$LA ?>' /> 
											<div class="srch srch" page="<?=$p4 ?>" ln='<?=$LA ?>' year="<?=$year ?>" >
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
						   <div class="col-md-6">
					         <div class="float-right">
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
					   <?php
					      if($year!=""||$search!="")
						  {
							  
					   ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                       
                                        <th class="border-0">N</th>
                                        <!-- <th class="border-0">სურათი</th> -->
									<?php
										    if(getprm($uid,'clients')==1)
						                  {
										?>
                                        <th class="border-0">კლიენტი</th>
										<?php
										  }
										  ?>
                                      	<?php
						   $c=0;				     
		                   for($z=0;$z<count($lnarr);$z++)
	                        {
							$c++;
						  //$lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";
	                     ?>
						 
                                        <th class="border-0 enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>'>სათაური <?=$lnshortarr[$z] ?></th>
						 <?php
							}
                             ?>			
                                        <th class="border-0">თანხა</th>
                                        <th class="border-0">დამ.თარიღი</th>
                                        <th class="border-0">მისამართი</th>
                                        <th class="border-0">ტელეფონი</th>                                        
                                        <th class="border-0">სტატუსი</th>
                                        <th class="border-0">დადასტურება</th>
                                        <th class="border-0"><i class="fa fa-edit"></i></th>
										
                                    </tr>
                                </thead>
                                <tbody>
											<?php
											$lmt=10;

                        $pg=(empty($p5)?1:(int)$p5);
                        $start=($pg-1)*$lmt;
               
					    $proto=mysqli_query($con, "SELECT t1.*, ". languages('protocol','t1.id','name') .",
						                          (SELECT concat(firstname,' ', lastname,'<br/>', pid) FROM users WHERE id=t1.uid) AS username,
						                          (SELECT sum((SELECT price FROM protofields WHERE id=t2.fieldid )) FROM protometa AS t2 WHERE t2.pid=t1.id ) AS protoprice,
						                          (SELECT tel  FROM users WHERE id=t1.uid) AS tel
												  FROM protocol AS t1 WHERE t1.id!=0 AND t1.archived=1 AND from_unixtime(enddate, '%Y')=$year $wsearch ORDER BY t1.id DESC LIMIT $start, $lmt") ;
												  $i=$start;
						while($rproto=mysqli_fetch_assoc($proto))
						{ 
					      $i++;							
					?>
						<div class="row mx-0">							
																	
                                    <tr class='<?=$rproto['seen']==0?"notseen":"" ?>' >
                                        <td><?=$rproto["pnumb"] ?> <?=$rproto["editid"]!=0?".".$rproto["editid"]:"" ?></td>
                                        <!-- <td>
                                            <div ><img src="img/user.png" alt="user" class="rounded"></div>
                                        </td> -->
										<?php
										    if(getprm($uid,'clients')==1)
						                  {
										?>
                                        <td>
										   <?=$rproto["username"] ?>							
										</td> 
										  <?php
										  }
						                $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
	                                      $c++;
	                                   ?>
                                        <td class="enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>'> <?=$rproto["name".$lnshortarr[$z]] ?></td>
									   <?php
										}
										?>
                                          <td class="">
											 <?=$rproto["price"]??0 ?>₾
											<br>
											
										</td>
										<td><?=date("Y-m-d H:i:s",$rproto["date"] ) ?> </td>
                                        <td>
                                        </td>
                                        <td>
                                          <?=$rproto["tel"] ?>
                                        </td>
										
										
                                        <td>
                                            <?=status($rproto["complete"],$rproto["confirm"]) ?>
                                        </td> 
										<td>
                                          <input type='checkbox' <?=$rproto["confirm"]==1?'checked':'' ?> <?=$rproto["complete"]!=1?"disabled":"" ?> class='UPT' d='<?=$rproto["id"] ?>' rld='1' n='confirm' t='protocol' />
                                        </td> 
                                        <td>
                                            <a class="btn btn-primary" href='func/protocolpdf.php/?id=<?=$rproto["id"] ?>'> pdf
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
		     $pgs=mysqli_query($con,"SELECT t1.id FROM protocol AS t1 WHERE t1.id!=0 AND t1.archived=1 $wsearch ");
             $nmcont=mysqli_num_rows($pgs);			 
		     $nmcont>0? pagination($lmt,$LA,$p4,$pg,$nmcont,$search):"";
		   ?>
            </div>
            					      </div> 
					   </div>	
					  <?php
					     if($archive==1)
						 {
					 ?>	 
					   <div class='row my-4'>
						    
							<div class="w-50">
								<span class="export ">
			                       <div class="col-md-2">
                                        <p class='btn btn-success archive'> დაარქივება</p>
                                    </div>
			                     </span>
							 </div>
				 
                           
						
					   </div>
					  <?php
						 }
                         ?>						 
                    </div>
					<?php
						  }
						  
						  else
							 { ?>
						 
						  <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                       
                                        <th class="border-0">N</th>
                                  
                                  
                                        <th class="border-0">წელი</th>
                                        <th class="border-0">სულ რაოდენობა</th>
                                        <th class="border-0">სულ თანხა</th>                                        
                                     
                                       
                                        <th class="border-0"><i class="fa fa-edit"></i></th>
									
                                    </tr>
                                </thead>
                                <tbody>
						<?php		
                          			// $lmt=10;

                        // $pg=(empty($p5)?1:(int)$p5);
                        // $start=($pg-1)*$lmt;
               
                       // echo " (SELECT sum((SELECT price FROM protofields WHERE parents = t2.fieldid)) FROM protometa AS t2   WHERE t2.pid IN(SELECT t3.id from protocol AS t3 WHERE from_unixtime(t3.enddate, '%Y')=from_unixtime(t1.enddate, '%Y'))) AS sumprice,";
						$arch=mysqli_query($con, "SELECT t1.*, ". languages('protocol','t1.id','name') .",
						                         
												  (SELECT sum(t2.price)  FROM protofields AS t2   WHERE t2.id IN(SELECT t3.fieldid FROM protometa AS t3 WHERE t3.pid IN(SELECT id FROM protocol WHERE archived=1 AND from_unixtime(enddate, '%Y')=from_unixtime(t1.enddate, '%Y')) )) AS sumprice,
						                          (SELECT sum(price) FROM protocol   WHERE archived=1 AND from_unixtime(enddate, '%Y')=from_unixtime(t1.enddate, '%Y')) AS sumamount,
						                          (SELECT sum(1) FROM protocol   WHERE archived=1 AND from_unixtime(enddate, '%Y')=from_unixtime(t1.enddate, '%Y')) AS sumcount,
						                         
						                          (SELECT sum((SELECT price FROM protofields WHERE id=t2.fieldid )) FROM protometa AS t2 WHERE t2.pid=t1.id ) AS protoprice,
						                          (SELECT tel  FROM users WHERE id=t1.uid) AS tel
												  FROM protocol AS t1 WHERE t1.id!=0 AND t1.archived=1 GROUP BY from_unixtime(t1.enddate, '%Y') ORDER BY t1.id DESC ") ;
												  //$i=$start;
						while($rarch=mysqli_fetch_assoc($arch))
						{ 
					      $i++;							
					?>
					<tr>
							<td><?=$i ?></td>	
							<td><?=date("Y",$rarch["enddate"]) ?></td>	
							<td><?=$rarch['sumcount'] ?></td>	
							<td><?=$rarch['sumamount'] ?>₾</td>	
							<td><a href="<?=$LA?>/<?=$p ?>?year=<?=date("Y",$rarch["enddate"]) ?>">არქივი</a> </td>	
						</tr>	
						<?php
						} 
						?>
						</tbody>
								</table>
								   <div class="card-footer  ">
					  <div class='row'>	
				        <div class="w-100 text-right">
						                 <div class="w-100 text-center mt-4">
                <?php
		     // $pgs=mysqli_query($con,"SELECT t1.id FROM protocol AS t1 WHERE t1.id!=0 $wsearch ");
             // $nmcont=mysqli_num_rows($pgs);			 
		     // $nmcont>0? pagination($lmt,$LA,$p4,$pg,$nmcont,$search):"";
		   ?>
            </div>
            					      </div> 
					   </div>
                      <?php
					    if($archive==1)
						{
					  ?>	 					   
					   <div class='row my-4'>
						    
							<div class="w-50">
								<span class="export ">
			                       <div class="col-md-2">
                                        <p class='btn btn-success archive'> დაარქივება</p>
                                    </div>
			                     </span>
							 </div>
				 
                           
						
					   </div>
					 <?php
						}
                      ?>						
                    </div>
					 </div>
						 <?php
						 }
						  ?>
               
				
            </div>

			
</div>
</div>