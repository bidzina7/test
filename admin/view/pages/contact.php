<?php
  $search="";
 // echo "SELECT t1.*, (SELECT columnValue FROM langs WHERE tableName='units ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM units AS t1";
 $contact=mysqli_query($con,"SELECT t1.*,
                                    ". languages('contact','t1.id','title') .",
                                    ". languages('contact','t1.id','address') ."
                                     FROM contact AS t1");
 $rcontact=mysqli_fetch_assoc($contact);
?>
<div class="container-fluid protocols shid">
      <div class="col-12 px-0">
	  
			 <div class="card  tab-content  mt-3 " d='1'>
                    <div class="card-header">	
					<div class="row mx-0 justify-content-between">
						<h5>
							რეკვიზიტები
						</h5>
						
                    </div>
					</div>
					<div class="card-body"  >
					   <?php
						$c=0;
	                    for($z=0;$z<count($lnarr);$z++)
	                    {
	                      $c++;
	                   ?>
					    <div class="w-100 my-3">
						<h6 class="mb-2">title <?=$lnshortarr[$z] ?></h6>
				        <input type="text" class="form-control UPT" t='contact' n='title'  value='<?=$rcontact["title".$lnshortarr[$z]]??"" ?>' d='<?=$rcontact['id'] ?>' ln='<?=$lnshortarr[$z] ?>' />
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
					  
						
					    <div class="w-100 my-3">
						<h6 class="mb-2">მისამართი <?=$lnshortarr[$z] ?></h6>
				        <input type="text" class="form-control UPT" t='contact' n='address'  value='<?=$rcontact["address".$lnshortarr[$z]]??"" ?>' d='<?=$rcontact['id'] ?>' ln='<?=$lnshortarr[$z] ?>' />
						</div>
					   <?php
						}
					   ?>
					  <div class="w-100 my-3">
					   <h6 class="mb-2">email</h6>
				        <input type="text" class="form-control UPT" t='contact' n='email' value='<?=$rcontact['email'] ?>' d='<?=$rcontact['id'] ?>' />
					  </div>	
					  <div class="w-100 my-3">
						<h6 class="mb-2">ტელეფონი</h6>
				        <input type="text" class="form-control UPT" t='contact' n='tel' value='<?=$rcontact['tel'] ?>' d='<?=$rcontact['id'] ?>' />
					  </div>	
					  
					
					</div>
				</div>
	

	  
               
			
</div>
</div>