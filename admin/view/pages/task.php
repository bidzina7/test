<?php
//$id=mysqli_real_escape_string($con,$_GET["id"]);


$T=time();
/*
if($a!=""){
	$q1=mysqli_query($con,"SELECT * FROM protocol  WHERE id='".$a."' ");
	$r1=mysqli_fetch_array($q1);
}else{

	$ina=mysqli_query($con,"INSERT INTO protocol (date) VALUES ('$T') ");

	$id=mysqli_insert_id($con);
	//$aid=mysqli_insert_id($con);
	$a=$id;
	

	?>
	
<script>location.href="<?=$LA ?>/task?id=<?=$a?>"</script>
<?php
	}
	$proto=mysqli_query($con,"SELECT t1.*, ". languages('protocol','t1.id','name') .",
    (SELECT firstname FROM users WHERE id=t1.uid)	AS firstname,		
    (SELECT lastname FROM users WHERE id=t1.uid)	AS lastname,		
    (SELECT pid FROM users WHERE id=t1.uid)	AS personalid		
	FROM protocol AS t1 WHERE t1.id='$a' ");
	$rproto=mysqli_fetch_assoc($proto);
*/	
?>	

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
					<div class="col-12 card-body  itmcontainer" msg="აღნიშნული მომხმარებელი უკვე არსებობს!" sms='4' norep='pid' t='users' d='<?=$a ?>'>
							  <div class="w-100 my-3 row">
							   <div class="col-md-10">
							
								<input  class="form-control UPTS valid novalid shusr" list="users"  type="text" name='pid' maxlength='11'  data-valid='personalid'  value='' placeholder="პირადი ნომერი">
								<div class="usrcont">
								  
								</div>
								
							  </div>	 
							  <div class="col-md-2">	 
                                 <button class="btn btn-outline-secondary shbutsr" disabled msg="შენახულია"   t='users'   pagename='' d="">დამატება</button>
							  </div>	
                              	<div class="col-md-6 my-3">
									<input class="form-control UPT"  tp='int' value='4' n='type' t='users' type="hidden" >
									<input class="form-control UPT valid novalid cusr chusrs"  n='firstname' t='users' disabled type="text" value='' data-valid placeholder="სახელი">
								  
								</div>
								<div class="col-md-6 my-3">
									
									<input class="form-control UPT valid novalid cusr chusrs"   type="text" n='lastname'  t='users' disabled value='' data-valid placeholder="გვარი">
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
                    <div class="card-body validator itmcontainer"   msg="აღნიშნული მომხმარებელი უკვე არსებობს!" sms='4' norep='pid,tel' t='protocol' n='1' d='' >
						<div class="row ">
							<div class="col-md-12 col-12">
					
					
							
					
							   <?php
						                $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
	                                      $c++;
	                                   ?>
							    <div class="w-100 mb-3">
									<h6 class="mb-2">ოქმის სათაური <?=$lnshortarr[$z] ?></h6>
									<input class="form-control UPTS valid" name='name' data-valid type="text" ln='<?=$lnshortarr[$z] ?>' value='' placeholder="ოქმის სათაური <?=$lnshortarr[$z] ?>">
								</div> 
								
								  <?php
									   }   
								    ?>
									  <?php
						                $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
	                                      $c++;
	                                   ?>
								  <div class="w-100 mb-3">
									<h6 class="mb-2"> ნიმუშის აღების ადგილი <?=$lnshortarr[$z] ?></h6>
									<input class="form-control UPTS valid" name='location' data-valid type="text" ln='<?=$lnshortarr[$z] ?>' value='' placeholder=" ნიმუშის აღების ადგილი <?=$lnshortarr[$z] ?>">
								</div>
								<?php
										}
										?>
								 <input class="form-control UPTS cusrs chusrs" type="hidden" n='uid' name='uid' tp='int'  disabled placeholder="">
								</div>
		
							<div class="col-12 text-left ">
								<div class="btn <?=$rproto['personalid']!=''?"btn-outline-success ADDITEMS":"btn-outline-secondary" ?>  shbtusr1"  disabled msg="შენახულია"   t='protocol'   pagename='' d="" n='1'>
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


