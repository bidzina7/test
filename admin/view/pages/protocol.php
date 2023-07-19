<?php
ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
   $id=isset($_GET['id'])?(int)$_GET["id"]:"";
   $ltab=isset($_GET['ltab'])?(int)$_GET["ltab"]:"";
   
   $T=time();
if($id!=""){

		//echo $pnumb;
		
	$q1=mysqli_query($con,"SELECT * FROM protocol  WHERE id='".$id."' ");
	$r1=mysqli_fetch_array($q1);

		if($p4=='protocol'&&$r1['seen']==0)
		{
			mysqli_query($con,"UPDATE protocol SET seen=1  WHERE id='$id' ");
			?>
			<script>location.href="<?=$LA ?>/<?=$p4 ?>?id=<?=$id ?>"</script>
			<?php
		}
	
}else{
    $mxp=mysqli_query($con,"SELECT max(pnumb) AS pnm FROM protocol  ");
	$rmxp=mysqli_fetch_assoc($mxp);
    $pnumb = ++$rmxp["pnm"];
	$ina=mysqli_query($con,"INSERT INTO protocol (date,pnumb,printdate) VALUES ('$T',$pnumb,'$T') ");
	$a=mysqli_insert_id($con);
	$inj=mysqli_query($con,"INSERT INTO journal SET uid='$uid', text='ახალი ოქმი N ".$pnumb ."' , opertype='2' ");

	//$aid=mysqli_insert_id($con);
	$id=$a;
	
	?>
	
<script>location.href="<?=$LA ?>/<?=$p4 ?>?id=<?=$id ?>"</script>
<?php
}
	$proto=mysqli_query($con,"SELECT t1.*, ". languages('protocol','t1.id','name') .", 
	                                          ". languages('protocol','t1.id','companyname') .",
	                                          ". languages('protocol','t1.id','location') .",
	                                          ". languages('protocol','t1.id','comment') .",
											 ". languages('protocol','t1.id','purpname') ." ,
											 ". languages('users','t1.uid','address') ." ,
                                             ". languages('products','t1.product','name','productname') ." ,
                                             (SELECT pid FROM users WHERE id=t1.uid)	AS personalid,	
                                             (SELECT concat(firstname, ' ',lastname ) FROM users WHERE id=t1.labhead)	AS headname,											 
                                             (SELECT concat(firstname, ' ',lastname ) FROM users WHERE id=t1.dephead)	AS headdep,											 
                                             (SELECT firstname FROM users WHERE id=t1.uid)	AS firstname,		
                                             (SELECT lastname FROM users WHERE id=t1.uid)	AS lastname,
											 (SELECT firstnameen FROM users WHERE id=t1.uid)	AS firstnameen,		
                                             (SELECT lastnameen  FROM users WHERE id=t1.uid)	AS lastnameen,	
                                             (SELECT firstnameru FROM users WHERE id=t1.uid)	AS firstnameru,		
                                             (SELECT lastnameru FROM users WHERE id=t1.uid)	AS lastnameru,											 
                                             (SELECT fields FROM products WHERE id=t1.product)	AS fldid,		
                                             (SELECT childs FROM protomethods WHERE id=t1.method)	AS methchild,	
                                             (SELECT nameka FROM protomethods WHERE id=t1.method)	AS pmethod		
											 FROM protocol as t1 WHERE t1.id='$id' AND t1.archived!=1 ");
			$rproto=mysqli_fetch_assoc($proto);
			$fldid=$rproto["fldid"]==""?0:$rproto["fldid"];
		
			mysqli_num_rows($proto)==0?die("not found! "):"";
			$protoed=(getprm($uid,'protoedit')==1)?1:0;
			$protomake=(getprm($uid,'protomake')==1)?1:0;
			$edcomm=(getprm($uid,'comments')==1)?1:0;
			$ltime=($rproto['confirm']==1&&$rusr['type']==1)?$T-$rproto['confirmdate']:"";
			$idchange=$ltime!=''&&$ltime>21600?1:0;
			$protoed=$ltime>21600?$idchange:$protoed;		
            $saat=$rproto['confirm']==1?(21600-$ltime)/3600:0;
			$saati=floor($saat);	
			  $tsuti=floor(($saat-$saati)*60);
            // $tsuti=($saat-floor($saat))*60;		
			$un=mysqli_query($con,"SELECT t1.id,  ". languages('units','t1.id','name') ."  FROM units AS t1 ORDER BY t1.position");	
			$run=mysqli_fetch_all($un,MYSQLI_ASSOC);
?>			
			<div class="container-fluid protocols shid">
       <div class="col-12 px-0">
	   	   
			<div class="col-12 px-0 my-3 " id='scrcont'>
				<div class="card">
                    <div class="card-header ">
                        <div class="row mx-0 justify-content-between">
                            <h5>
                               ოქმი: N <?=$rproto["pnumb"] ?> <?=$rproto["editid"]!=0?".".$rproto["editid"]:"" ?>  </h5> <h6><?=$rproto['confirm']==1&&(21600-$ltime)>0?"ოქმის დახურვამდე დარჩა ". $saati ."სთ " .$tsuti." წთ ":"" ?></h6>
                           
							<div>
								<?php
	                              $c=0;
	                             for($z=0;$z<count($lnarr);$z++)
	                             {
	                              $c++;
	                             ?>
                            <div class="btn <?=($ltab==''&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"btn-success":"btn-danger" ?> ltab" d="<?=$c ?>" url="ka/<?=$p ?>/?id=<?=$id ?>&ltab=" style="border-radius:50%; width:45px; height:45px; ">
									<a class="text-white" style=" vertical-align: middle; text-align:center" ><b><?=$lnshortarr[$z] ?></b></a>
								</div>  
							<?php
								 }
								 ?>
							</div>	
                     </div>
                    </div>
				    <div class="card-body">
					  <?php
					  //echo getpages($uid,'clients');
					      if(getprm($uid,'clients')==1)
						  {
					  ?>
					   <div class="row-mx-0 d-none"> 
					      <div class="col-12 itmcontainer" msg="აღნიშნული მომხმარებელი უკვე არსებობს!" sms='4' norep='pid' t='users' n='c' d='<?=$id ?>'>
					          <h4 class="mb-2">დამკვეთი:</h4>
							  <div class="w-100 my-3 row">
							   <div class="col-md-10">      
								<input  class="form-control UPTS valid novalid shusr" list="users"  type="text" name='pid' maxlength='11'  data-valid='personalid'  value='<?=$rproto["personalid"] ?>' placeholder="პირადი ნომერი" <?=$protoed==1?'':'disabled' ?> >
								<div class="usrcont">
								  
								</div>
								
							  </div>	 
							  <div class="col-md-2">	 
                                 <button class="btn btn-outline-secondary shbutsr" disabled msg="შენახულია"   t='users'   pagename='' n='c' d="<?=$id ?>">დამატება</button>
							  </div>	
							    <?php
						                $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
	                                      $c++;
										  $lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";
	                                   ?>
                            
						
							   <div class="col-md-6 my-3">
							     <h6 class="mb-2">კომპანიის სახელი <?=$lnshortarr[$z] ?>: </h6>
								 <input class="form-control UPT cusr chusrs" type="text" n='companyname'   t='users' ln="<?=$lnshortarr[$z] ?>" <?=$rproto["uid"]==0||$protoed!=1?"disabled":"" ?> value='<?=$rproto["companyname".$lnshortarr[$z]] ?>' placeholder="კომპანიის სახელი <?=$lnshortarr[$z] ?>">
					
							   </div>	
							   
								<div class="col-md-6 my-3">
									<h6 class="mb-2">მისამართი <?=$lnshortarr[$z] ?>: </h6>
									<input class="form-control UPT cusr chusrs" type="text" n='address' t='users' ln="<?=$lnshortarr[$z] ?>" <?=$rproto["uid"]==0||$protoed!=1?"disabled":"" ?>  value='<?=$rproto["address".$lnshortarr[$z]] ?>' placeholder="მისამართი <?=$lnshortarr[$z] ?>">
								</div>	
								<?php
										}
										?>	 
							 </div>
						</div>
					  </div>
							<?php
						  }
							?> 
				
						<div class="row mx-0">
						    <div class="col-md-12 my-3">
						       <h5 class="mb-2 w-100">ოქმის რედაქტირება:</h5>
							</div>
							<div class="col-lg-5 col-5 validator  itmcontainer" t='protocol' n='a' msg="აღნიშნული მონაცემებით მომხმარებელი უკვე არსებობს!" norep='pid,tel,pnumb' d='<?=$rproto['id'] ?>' >
							    <div class="w-100 mb-3" > 
								   <h6 class="mb-2">ოქმის N </h6>
								   <input class="form-control UPTB journal valid"  t='protocol'  jrnl='1' pagename='' n='pnumb' d="<?=$rproto["id"] ?>"  jname='ოქმის ნომერი: ' oldname='<?=$rproto['pnumb'] ?>' data-valid type="text"  <?=$protomake==1?'':'disabled' ?> tp="int" value='<?=$rproto['pnumb'] ?>' placeholder="ოქმის N" norep='1' rld='1'/>
								</div>
								 <div class="w-100 mb-3" > 
								   <h6 class="mb-2">ნიმუშის მოწოდების მეთოდი</h6>
								    <select class="form-control mt-2 UPT opt methper" t='protocol'  pagename=''  jrnl='1' n='method' d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> მოწოდების მეთოდი' oldname='<?=$rproto["pmethod"] ?>' <?=$protomake==1?'':'disabled' ?> rld="1">
						                 <option value=''>აირჩიეთ მოწოდების მეთოდი</option>
						               <?php
				                       $pmth=mysqli_query($con,"SELECT t1.* FROM protomethods AS t1");
				                          while($rpmth=mysqli_fetch_assoc($pmth))
				                         {
				                        ?>
				                          <option newval='<?=$rpmth['nameka'] ?>' chld='<?=$rpmth['childs'] ?>' value='<?=$rpmth['id'] ?>'  <?=$rpmth['id']==$rproto['method']?"selected":"" ?> ><?=$rpmth['name'.$LA] ?></option>
				                       <?php
				                         }
				                       ?>
						              </select>
								</div>
							        <?php
									   if(getprm($uid,'clients')==1)
						                 {
					  
						                $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
	                                      $c++;
										  $lnname=$lnshortarr[$z]!='ka'?$lnshortarr[$z]:"";
	                                   ?>
                            
						       <div class='enebi' d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>  '>	   
							      <div class="w-100 my-3">
							        <h6 class="mb-2">კომპანიის სახელი <?=$lnshortarr[$z] ?>: </h6>
								    <input class="form-control UPTB cusr shget" num='1' list="company" jrnl='1' type="text" t='protocol' n='companyname' d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> კომპანიის სახელი <?=$lnshortarr[$z] ?>' ln="<?=$lnshortarr[$z] ?>"  value='<?=$rproto["companyname".$lnshortarr[$z]] ?>'  placeholder="კომპანიის სახელი <?=$lnshortarr[$z] ?>">
					                <div class="shcont" num='1'>
								        
								     </div>
							      </div>	
							    </div>
								
								<?php
										}
										 }
										?>
							
							      <div class="w-100 my-3 ">
									 <h6 class="mb-2"> <?=$rproto['methchild']==1?"ნიმუშის აღების აქტის N (თარიღი)":"მომართვის ნომერი  (თარიღი)"?> </h6>
									 <input class="form-control UPTB journal valid shget" nlang='1' num='2' t='protocol'  jrnl='1'  list='actitle' pagename='' n='actitle' d="<?=$rproto["id"] ?>"  jname='ოქმი N <?=$rproto["pnumb"] ?> მომართვის ნომერი N(თარიღი)' oldname='<?=$rproto['actitle'] ?>' data-valid type="text" ln='' <?=$protomake==1?'':'disabled' ?> tp="" value='<?=$rproto['actitle'] ?>' placeholder="მომართვის ნომერი N(თარიღი)">
                                      <div class="shcont" num='2'>
								        
								      </div>										
								</div>
								
							<?php
								      
								   $c=0;
	                                    for($z=0;$z<count($lnarr);$z++)
	                                    {
	                                      $c++;
	                                   ?> 
								  <div class='enebi' d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none" ?>  '>	   
							       <div class="w-100 my-3">
									   <h6 class="mb-2">ნიმუშის დასახელება (რაოდენობა) <?=$lnshortarr[$z] ?></h6>
									   <input class="form-control UPTB journal valid shget" num='3' jrnl='1' list='name' t='protocol'   name='' n='name' d="<?=$rproto["id"] ?>"  jname='ოქმი N <?=$rproto["pnumb"] ?> ოქმის სათაური:<?=$lnshortarr[$z] ?>' oldname='<?=$rproto['name'.$lnshortarr[$z]] ?>' data-valid type="text" ln='<?=$lnshortarr[$z] ?>' <?=$protomake==1?'':'disabled' ?> tp="" value='<?=$rproto['name'.$lnshortarr[$z]] ?>' placeholder="ოქმის სათაური <?=$lnshortarr[$z] ?>">
                                       <div class="shcont" num='3'>
								        
								       </div>								  
								  </div>
								
								
						
							 <div class="w-100 my-3">
				                   <h6 class="mb-2">გამოცდის მიზანი <?=$lnshortarr[$z] ?></h6>
						           <input type="text" class="form-control UPTB shget"  num='4' jrnl='1' list='purpname' t='protocol'   name='' n='purpname' d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> გამოცდის მიზანი <?=$lnshortarr[$z] ?>' oldname='<?=$rproto['purpname'.$lnshortarr[$z]] ?>' data-valid type="text" ln='<?=$lnshortarr[$z] ?>' tp=""  placeholder="გამოცდის მიზანი <?=$lnshortarr[$z] ?>" <?=$protomake==1?'':'disabled' ?> value='<?=$rproto['purpname'.$lnshortarr[$z]] ?>' />
						            <div class="shcont" num='4'> 
								        
								     </div>
							</div>
							</div>
							<?php
									}
								   ?>
						    <div class="w-100 my-3">
								<h6 class="mb-2">პროდუქტი/მასალა</h6>
								
						          <select class="form-control mt-2 UPTB opt" t='protocol' jrnl='1' n='product' tp="int" ln='' d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> პროდუქტი/მასალა' oldname='<?=$rproto["productnameka"] ?>' <?=$protomake==1?'':'disabled' ?> rld='1' >
						           <option value=''>აირჩიეთ პროდუქტი/მასალა</option>
						              <?php
				                       $prd=mysqli_query($con,"SELECT t1.id, 
				                        (SELECT columnValue FROM langs WHERE tableName='products ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."  FROM products AS t1");
				                       while($rprd=mysqli_fetch_assoc($prd))
				                     {
				                    ?>
				                          <option  newval='<?=$rprd['nameka'] ?>' value='<?=$rprd['id'] ?>'  value='<?=$rprd['id'] ?>' <?=$rprd['id']==$rproto['product']?"selected":"" ?>><?=$rprd['name'.$LA] ?></option>
				                   <?php
				                     } 
				                    ?>
						         </select>
								 
						    </div>  
							  <?php
						        $c=0;
	                            for($z=0;$z<count($lnarr);$z++)
	                            {
	                              $c++;
								  
	                            ?> 
								<div class='enebi' d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none"  ?>  '>
							       <div class="w-100 <?=$c==1?"mb-3":"my-3" ?> ">
									   <h6 class="mb-2">ნიმუშის აღების ადგილი <?=$lnshortarr[$z] ?></h6>
									   <input class="form-control UPTB valid shget" num='5' list='location' jrnl='1' t='protocol' n='location'  d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> ნიმუშის აღების ადგილი <?=$lnshortarr[$z] ?>' data-valid type="text" ln='<?=$lnshortarr[$z] ?>' tp="" value='<?=$rproto['location'.$lnshortarr[$z]] ?>' placeholder="ნიმუშის აღების ადგილი <?=$lnshortarr[$z] ?>" <?=$protomake==1?'':'disabled' ?> >
								       <div class="shcont" num='5'>
								        
								       </div>
								   </div>
								</div>
								<?php
							    }
								?>
								  
							 <input class="form-control UPT cusrs chusrs" t="protocol" type="hidden" n='uid' name='uid' tp='int'  d="<?=$rproto["id"] ?>" value='<?=$rproto['uid'] ?>' disabled placeholder="">
						         <?php
						        $c=0;
	                            for($z=0;$z<count($lnarr);$z++)
	                            {
	                              $c++;
	                            ?> 
								 <div class='enebi' d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none"  ?>  '>
							       <div class="w-100 <?=$c==1?"mb-3":"my-3" ?> ">
									 <h6 class="mb-2">შენიშვნა <?=$lnshortarr[$z] ?></h6>
									 <input class="form-control UPTB valid shget" num='6' list="comment" jrnl='1' t='protocol'  n='comment'   d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> შენიშვნა <?=$lnshortarr[$z] ?>' data-valid type="text" ln='<?=$lnshortarr[$z] ?>' tp=""  placeholder="შენიშვნა <?=$lnshortarr[$z] ?>" <?=$edcomm==1?'':'disabled' ?> value='<?=$rproto['comment'.$lnshortarr[$z]] ?>' />
									 <div class="shcont" num='6'> 
								        
								     </div>
								    </div>
								 </div>	
								<?php
							    }
								?>
								<div class="w-100 my-3">			
									 <h6 class="mb-2">აირჩიეთ ლაბორატორიის ხელმძღვანელი </h6"> 
			                        <select class="form-control UPT opt" t='protocol' jrnl='1' n='labhead'   ln=''  d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> ლაბორატორიის ხელმძღვანელი' oldname='<?=$rproto['headname'] ?>'  <?=$protomake==1?'':'disabled' ?> rld='1'  >
									 <option value=""> </option>
								      <?php
									  
																
									  $tpname="";
									    $labhead=mysqli_query($con,"SELECT t1.* FROM users AS t1 WHERE t1.type='4' OR t1.type1='4' OR t1.type='48' OR t1.type1='48' ");
				                       while($rlabhead=mysqli_fetch_assoc($labhead))
				                      {
										 if ($rlabhead['type']==4)
										 {
											 $tpname="ლაბორატორიის ხელმძღვანელი";
										 }
										  if ($rlabhead['type']==48)
										 {
											 $tpname="ლაბორატორიის ხელმძღვანელის მოვალეობის შემსრულებელი";
										 }
										  if ($rlabhead['type']==7)
										 {
											 $tpname="განყოფილების უფროსი";
										 }
										  if ($rlabhead['type']!=4&&$rlabhead['type']!=48&&$rlabhead['type']!=7&&$rlabhead['type1']==4)
										 {
											 $tpname="ლაბორატორიის ხელმძღვანელი";
										 }
										   if ($rlabhead['type']!=4&&$rlabhead['type']!=48&&$rlabhead['type']!=7&&$rlabhead['type1']==48)
										 {
											 $tpname="ლაბორატორიის ხელმძღვანელის მოვალეობის შემსრულებელი";
										 }  
										 if ($rlabhead['type']!=4&&$rlabhead['type']!=48&&$rlabhead['type']!=48&&$rlabhead['type1']==7)
										 {
											 $tpname="განყოფილების უფროსი";
										 }
										 ?>
			     	                   <option newval="<?=$rlabhead["firstname"] ?> <?=$rlabhead["lastname"] ?>" <?=$rlabhead['id']==$rproto['labhead']?"selected":"" ?> value="<?=$rlabhead["id"] ?>"><?=$rlabhead["firstname"] ?> <?=$rlabhead["lastname"] ?> <?=$tpname ?> </option>
									  <?php
									  }
									   $athrs='';  
									   
									   $authors=mysqli_query($con,"SELECT t1.*,  ". languages('users','t1.id','firstname') ." ,  ". languages('users','t1.id','lastname') ."  FROM users AS t1 WHERE t1.id IN(".$rproto["authors"].")");
																  while($rauthors=mysqli_fetch_assoc($authors))
																  {  
					                                              $athrs.=  $rauthors['firstname'] . " ".$rauthors['lastname']. ','; 
																  }
																  $athrs=rtrim($athrs ,",");
																  
									  ?>
                                     </select>
								  </div>
								 <div class="w-100 my-3">
								    			
									 <h6 class="mb-2">აირჩიეთ განყოფილების უფროსი </h6"> 
			                        <select class="form-control UPT opt selectpicker" t='protocol' jrnl='1' n='dephead'   ln=''  d="<?=$rproto["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?> განყოფილების უფროსი' oldname='<?=$rproto['headdep'] ?>'  <?=$protomake==1?'':'disabled' ?> rld='0' data-live-search="true"   multiple >
								
								      <?php
									  
																
									  $tpname="";
									    $dephead=mysqli_query($con,"SELECT t1.* FROM users AS t1 WHERE  t1.type='7' OR t1.type1='7'");
				                       while($rdephead=mysqli_fetch_assoc($dephead))
				                      {
										$lst = explode(',',$rproto["dephead"]);
										  if($rdephead['type']==7)
										 {
											 $tpname="განყოფილების უფროსი";
										 }

										 if ($rdephead['type']!=4&&$rdephead['type']!=48&&$rdephead['type']!=48&&$rdephead['type1']==7)
										 {
											 $tpname="განყოფილების უფროსი";
										 }
										 ?>
			     	                   <option newval="<?=$rdephead["firstname"] ?> <?=$rdephead["lastname"] ?>"<?=in_array($rdephead["id"], $lst)?"selected":""?> value="<?=$rdephead["id"] ?>"><?=$rdephead["firstname"] ?> <?=$rdephead["lastname"] ?></option>
									  <?php
									  }
							  
									  ?>
                                     </select>
								   </div>
								
					
							     <div class="w-100 my-3">
									 <h6 class="mb-2">აირჩიეთ შემსრულებლები </h6"> 
			                        <select class="form-control UPT selectpicker opt" t='protocol' jrnl='1' n='authors'   d="<?=$rproto["id"] ?>"   ln='' jname='ოქმი N <?=$rproto["pnumb"] ?> შემსრულებლები' oldname='<?=$athrs ?>'  <?=$protomake==1||$protoed==1?'':'disabled' ?> data-live-search="true"   multiple  >
								      <?php
									   $lst = explode(',',$rproto["authors"]);
									  
									   $lab=mysqli_query($con,"SELECT t1.*   FROM users AS t1 WHERE t1.type='6' ");
				                       while($rlab=mysqli_fetch_assoc($lab))
				                      { 
										 ?>
			     	                   <option newval="<?=$rlab["firstname"] ?> <?=$rlab["lastname"] ?>" <?=in_array($rlab["id"], $lst)?"selected":""?> value="<?=$rlab["id"] ?>"><?=$rlab["firstname"] ?> <?=$rlab["lastname"] ?></option>
									  <?php
									  }
									  ?>
                                     </select>
								   </div>
								    <div class='w-100 mb-3 row mx-0'> 
									<div class="w-100">
								      <h6 class="mb-2">ენები: </h6>
									</div>
									  <div class="">
									    <b>ka</b>
								      <input class="form-control UPT valid" t='protocol' n='ka'  d='<?=$rproto["id"] ?>' data-valid type="checkbox"  <?=$protomake==1?'':'disabled' ?> tp="int" <?=$rproto['ka']==1?"checked":"" ?> placeholder="ოქმის N" />
									 </div>
									 <div class="ml-3">
									  <b>en</b>
            						 <input class="form-control UPT valid" t='protocol' n='en'  d='<?=$rproto["id"] ?>'  data-valid type="checkbox"  <?=$protomake==1?'':'disabled' ?> tp="int" <?=$rproto['en']==1?"checked":"" ?> placeholder="ოქმის N" />
									</div>
									<div class="ml-3">
									   <b>ru</b>
								      <input class="form-control UPT valid" t='protocol' n='ru'  d='<?=$rproto["id"] ?>' data-valid type="checkbox"  <?=$protomake==1?'':'disabled' ?> tp="int" <?=$rproto['ru']==1?"checked":"" ?> placeholder="ოქმის N" />
								    </div>
									 
								  
                                  </div>
								  <div class='row mx-0'>
							        <div class="w-50 mb-3" > 
								      <h6 class="mb-2">არააკრედიტირებული </h6>
								      <input class="form-control UPT valid" t='protocol' n='accreditation'  d='<?=$rproto["id"] ?>'  name='accreditation' data-valid type="checkbox"  <?=$protomake==1?'':'disabled' ?> tp="int" <?=$rproto['accreditation']==1?"checked":"" ?> placeholder="ოქმის N" />
								    </div>	 
								    <div class="w-50 mb-3" > 
								      <h6 class="mb-2">ნორმა </h6>
								      <input class="form-control UPT valid" t='protocol' n='norm'  d='<?=$rproto["id"] ?>'  name='norm' data-valid type="checkbox"  <?=$protomake==1?'':'disabled' ?> tp="int" <?=$rproto['norm']==1?"checked":"" ?> placeholder="ოქმის N" />
								    </div>
                                  </div>								  					
								</div>
								<div class="col-lg-7 col-7">
								    <div class="w-100 my-2">
									    <h6 class="mb-2">მაჩვენებლები:</h6>
								    </div>	
								    <?php
									// echo "SELECT t1.*, 
									                              // (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.fieldid AND tableColumn='name' AND shortname='$LA' ) AS fieldname". $LA ."
									                                // FROM protometa AS t1 WHERE t1.pid='$id'";
										// echo "SELECT t1.*, 
									                              // (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.fieldid AND tableColumn='name' AND shortname='$LA' ) AS fieldname". $LA ."
									                                // FROM protometa AS t1 WHERE t1.pid='$id' AND (t1.fieldid IN(SELECT t2.id FROM protofields AS t2 WHERE t2.parents='' AND t2.id IN(".$rproto["fldid"].") OR t1.id IN(SELECT parents FROM protofields WHERE id IN(".$fldid.") ) ))";							
									   $fields=mysqli_query($con,"SELECT t1.*, 
									                              (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.fieldid AND tableColumn='name' AND shortname='$LA' ) AS fieldname". $LA ."
									                                FROM protometa AS t1 WHERE t1.pid='$id' AND (t1.fieldid IN(SELECT t2.id FROM protofields AS t2 WHERE (t2.parents='' AND t2.product LIKE '%". $rproto['product'] ."%' ) OR (t2.id IN(SELECT parents FROM protofields WHERE product LIKE  '%". $rproto['product'] ."%' ) )))");
											$i=0;						
									   while($rfields=mysqli_fetch_assoc($fields))
									   {
										  
										   ?>
										    <div class="w-100 my-2">
									         <h5 class="mb-2"><b><?=$rfields["fieldname".$LA] ?>:</b></h5> 
											</div> 
											<?php
											
											/* echo "SELECT t1.*, 
											                    
											(SELECT exam FROM protofields WHERE id=t1.fieldid) AS fieldexam,
											" . languages('protometa','t1.id','maxval') ." ,
											" . languages('protometa','t1.id','minval') ." ,
											" . languages('protometa','t1.id','vl') ." ,
											" . languages('protometa','t1.id','exammethod') ." ,
											" . languages('units','t1.unit','name','uname') ." ,
											" . languages('examethods','t1.exam','name','exname') ." ,
											(SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.fieldid AND tableColumn='name' AND shortname='$LA' ) AS fieldname". $LA ."
											 FROM protometa AS t1 WHERE t1.pid='$id' AND t1.fieldid IN(SELECT id FROM protofields WHERE parents='".$rfields["fieldid"]."'  
											  AND product LIKE '%".$rproto['product']."%' ) "; */
											   $fields1=mysqli_query($con,"SELECT t1.*, 
											                    
											                      (SELECT exam FROM protofields WHERE id=t1.fieldid) AS fieldexam,
																  " . languages('protometa','t1.id','maxval') ." ,
																  " . languages('protometa','t1.id','minval') ." ,
																  " . languages('protometa','t1.id','vl') ." ,
																  " . languages('protometa','t1.id','exammethod') ." ,
																  " . languages('units','t1.unit','name','uname') ." ,
																  " . languages('examethods','t1.exam','name','exname') ." ,
									                              (SELECT columnValue FROM langs WHERE tableName='protofields' AND  tableId=t1.fieldid AND tableColumn='name' AND shortname='$LA' ) AS fieldname". $LA ."
									                               FROM protometa AS t1 WHERE t1.pid='$id' AND t1.fieldid IN(SELECT id FROM protofields WHERE parents='".$rfields['fieldid']."' AND product LIKE '%".$rproto['product']."%' )");
																	
											   while($rfields1=mysqli_fetch_assoc($fields1))
									         {
										         ++$i;
												
					                                  // $unit=mysqli_query($con,"SELECT t1.*,  ". languages('units','t1.id','name') ."  FROM units AS t1 WHERE id='".$rfields1['unit']."' ");
													  // $k=0;
						                              // $runit=mysqli_fetch_assoc($unit)??"";
						                              $fieldexam=$rfields1["fieldexam"]==""?0:$rfields1["fieldexam"];
					                                  	
													
														
													
											?>
										   <div class="w-100 my-3 row itmcontainer" msg="შენახულია" sms='4' t='protometa' d='<?=$rfields1["id"] ?>' n="<?=$i ?>" >
										      <div class="col-12">
									         <h6 class="mb-2"><?=$rfields1["fieldname".$LA] ?> <?=!empty($rfields1["uname".$LA])?"<sup>(".$rfields1["uname".$LA].")</sup>":"" ?></h6> 
											</div> 
											  <?php
						        $c=0;
	                            for($z=0;$z<count($lnarr);$z++)
	                            {
	                              $c++;
								  
	                            ?> 
							
										   <div class="col-2 enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none"  ?>' >
										   
											   <input class="form-control UPTS journal" jname='ოქმი N <?=$rproto["pnumb"] ?>: <?=$rfields1["fieldname".$LA] ?>: <?=$rfields1["fieldname".$LA] ?> :მიღებული შედეგი <?=$lnshortarr[$z] ?>' oldname='<?=$rfields1['vl'.$lnshortarr[$z]] ?>'  name='vl'  ln="<?=$lnshortarr[$z] ?>" tp="" type="text" value='<?=$rfields1['vl'.$lnshortarr[$z]] ?>' placeholder="მიღებული შედეგი <?=$lnshortarr[$z] ?>" <?=$protoed==1?'':'disabled' ?>/>   
										   </div>
							     <?php
								}
                                ?>								
											  <div class="col-2">
											      
												  <select class="form-control  UPTS journal opt" jname='ოქმი N <?=$rproto["pnumb"] ?>: <?=$rfields1["fieldname".$LA] ?>: გაზომვის ერთეული' oldname='<?=$rfields1['unameka'] ?>' list="unit" name="unit" tp="int"  ln="" data-live-search="true"  <?=$protoed==1?'':'disabled' ?>>
											       
													<?php
													  //  $un=mysqli_query($con,"SELECT t1.*,  ". languages('units','t1.id','name') ."  FROM units AS t1 ORDER BY t1.position");
														foreach($run AS $rrun)
													    {
															?>
															 <option newval="<?=$rrun["nameka"] ?> " value="<?=$rrun["id"] ?>" <?=$rrun["id"]==$rfields1["unit"]?"selected":"" ?>><?=$rrun["nameka"] ?> </option> 
															<?php
														} 
													?>
											      </select>
												</datalist>
											   </div>
											   
											    <div class="col-2">
											     <?php
												// echo $rfields1['exam'] . ' '. $rfields1['id'];
												
												     $xmeth=mysqli_query($con,"SELECT t1.*,  ". languages('examethods','t1.id','name') ."  FROM examethods AS t1 WHERE t1.id IN(". $fieldexam .")");	 
												 ?>
												  
												 <select class="form-control UPTS journal opt" name='exam' ln='' tp='int' jname='ოქმი N <?=$rproto["pnumb"] ?>:<?=$rfields1["fieldname".$LA] ?>: გამოცდის მეთოდი' oldname='<?=$rfields1['exnameka'] ?>' <?=$protoed==1?'':'disabled' ?>>
												   <option>აირჩიეთ გამოცდის მეთოდი</option>
												  <?php
												    while($rxmeth=mysqli_fetch_assoc($xmeth))
													{
														?>
														<option nevwal='<?=$rxmeth['name'.$LA] ?>' value='<?=$rxmeth['id'] ?>' <?=$rxmeth['id']==$rfields1['exam']?'selected':'' ?>><?=$rxmeth['name'.$LA]?></option>
														<?php
													}
												  ?>
												 </select>
											  </div> 	
											   		  <?php
						                                $c=0;
	                                                    for($z=0;$z<count($lnarr);$z++)
	                                                   {
	                                                    $c++;
								  
	                                                ?> 
													
													
										
											  <div class="col-3  enebi d-none" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none"  ?>'>
											     <?php
												// echo $rfields1['exam'] . ' '. $rfields1['id'];
												
												     //$xmeth=mysqli_query($con,"SELECT t1.*,  ". languages('examethods','t1.id','name') ."  FROM examethods AS t1 WHERE t1.id IN(". $fieldexam .")");	 
												 ?>
												  <input class="form-control UPTS journal shget" num='method<?=$rfields1["id"] ?>' t='protometa' n='exammethod' list="exammethod<?=$rfields1["id"] ?>" jname='ოქმი N <?=$rproto["pnumb"] ?>: <?=$rfields1["fieldname".$LA] ?>: <?=$rfields1["fieldname".$LA] ?> :გამოცდის მეთოდი <?=$lnshortarr[$z] ?>" oldname='<?=$rfields1['exammethod'.$lnshortarr[$z]] ?>'  name='exammethod'  ln="<?=$lnshortarr[$z] ?>" tp="" type="text" value='<?=$rfields1['exammethod'.$lnshortarr[$z]] ?>' placeholder="გამოცდის მეთოდი <?=$lnshortarr[$z] ?>" <?=$protoed==1?'':'disabled' ?>/>   
												 <div class="shcont" num='method<?=$rfields1["id"] ?>'>  
								        
								                </div>
											 </div> 
											 <?php
													   }
											     $c=0;
	                                             for($z=0;$z<count($lnarr);$z++)
	                                              {
	                                             $c++;
	                                          ?> 
							
										     <div class="col-2 enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none"  ?>' >
											    
											    <input class="form-control UPTS journal" jname='ოქმი N <?=$rproto["pnumb"] ?> : <?=$rfields1["fieldname".$LA] ?> : მინიმალური მნიშვნელობა <?=$lnshortarr[$z] ?> ' oldname='<?=$rfields1["minval".$lnshortarr[$z]] ?>'  name='minval'   ln="<?=$lnshortarr[$z] ?>" tp='' type="text" value='<?=$rfields1["minval".$lnshortarr[$z]] ?>' placeholder="მინიმალური" <?=$protoed==1?'':'disabled' ?>/> 
											 </div> 
											 <div class="col-2 enebi" d='<?=$c ?>' style='<?=($ltab==""&&$langdefaultarr[$z]=='1')||($ltab!=''&&$ltab==$c)?"":"display:none"  ?>' >
                                               										 
											   <input class="form-control UPTS journal" jname='ოქმი N <?=$rproto["pnumb"] ?> : <?=$rfields1["fieldname".$LA] ?>: მაქსიმალური მნიშვნელობა <?=$lnshortarr[$z] ?> ' oldname='<?=$rfields1["maxval".$lnshortarr[$z]] ?>'  name='maxval' ln="<?=$lnshortarr[$z] ?>" tp='' type="text" value='<?=$rfields1["maxval".$lnshortarr[$z]] ?>' placeholder="მაქსიმალური" <?=$protoed==1?'':'disabled' ?> /> 
											 </div>
											  <?php
												  }
											      if($idchange==1)
												  {
											   ?>
											   <input class="form-control UPTS "  name='editid' t="protocol/1"  rl="pid,-1" ln="" tp='inc' type="hidden" value='<?=$rproto['editid'] ?>' /> 
											   <?php
												  }
												  ?>
											   <input class="form-control UPTS " maxlength='12' name='date'  ln="" tp='time' type="hidden" value='1'/> 
											   <input class="form-control UPTS "  name='editdate' t="protocol/1"  rl="pid,-1" ln="" tp='time' type="hidden" value=''/> 
											 <div class="col-1">
											   <div class="btn  <?=$protoed==1?'btn-outline-success ADDITEMS':'btn-secondary' ?>"   t='protometa' journaltype="1"  pagename='' n="<?=$i ?>" d="<?=$rfields1["id"] ?>" msg="შენახულია">
									              დამახს...
								               </div> 
											 </div>  
										   </div>	 
										   <?php
									   }
									   }
									
									?>
								
									<div class="w-100 my-3 d-none">
									<h6 class="mb-2">სტატუსი</h6>
									
									<div class="form-check p-0">
									<input class="UPTS" disabled name='trustType'   type="checkbox" id="sando" >
									<label class="" for="sando">მიმდინარე</label>
									</div>
								</div>	
									
								</div>
								
								
							</div>
							
						
						</div>
                     <div class="card-footer  py-3">
					 <div class="row">
					  
					    <span class="text-left col-md-9">
						
						 
						   
						<div class=" my-3 itmcontainer" msg="ოქმის დასრულება" sms='4' t='protocol'  n="x" d='<?=$id ?>' conf='1'>
						 <div class="row">
						  <div class="col-md-3">
						     <input  class="form-control UPT" t="protocol" n='creatdate' tp='datepick' type='text'   ln=""  value="<?=$rproto["creatdate"]>0?date("d-m-Y",$rproto["creatdate"]):"" ?>"  d='<?=$rproto["id"] ?>' />
						   </div>
						   <div class="col-md-3">
						     <input type="text" class="form-control UPT" t="protocol" n='enddate' tp='datepick' value="<?=$rproto["enddate"]>0?date("d-m-Y",$rproto["enddate"]):"" ?>" ln=""  d='<?=$rproto["id"] ?>' /> 
						   </div>
						  <div class="col-md-6">
						   <input class="form-control UPTS" maxlength='12' name='complete'   ln="" tp='int' type="hidden" value='1' /> 
						 
						      
			                <div  class='btn  <?=$protoed==1?'btn-outline-success ADDITEMS':'btn-secondary' ?>' t='protocol' n='x' d='<?=$id?>' conf='1' msg="ოქმის დასრულება" >
			            	  დასრულება
							</div> 
							</div> 
							</div> 
			             </div>	
			            	
			            </span>
                        <span class=" text-right col-md-3">
						
						
						    <div class="row">
							 <div class="col-md-7">
							 <input type="text" data-page='func/protocolpdf.php/' class="form-control ADDTR UPT"  t="protocol" n='printdate'  type='text'   ln="" name='daterange' tp='datepick' value="<?=date("d-m-Y",$rproto["printdate"])?>" d='<?=$rproto["id"] ?>' />
							 </div>
							 <div class="col-md-5">
							 <div  class='btn btn-outline-success shpdf'>
				               <i class="fas fa-file-pdf mx-1"></i>
				               იხილეთ PDF
							 </div>
			                </div>           
			             </div>    
					  </span>
                    </div>
                    </div>
                </div>
			</div>
			<?php
			  if(getprm($uid,'protomake')==1) 
			 {
			?>	
		  <div class="card">
			<div class="card-header">
				<div class="row mx-0 justify-content-between">
					<h5>
						მაჩვენებლები: 
					</h5>
					 <div >
					   <div class="btn btn-success" onClick="window.location.reload()")>
					      გადატვირთვა
					   </div>
					</div>
				</div>
			</div>
			<div class="card-body">
		
			</div>
			
			
			<div class="col-lg-12 col-12 px-lg-0 ">
            <div class="filter-cont mb-lg-0 mb-4">
              
                <div class="filter-body d-lg-block ">
                 
                    <div class="w-100 row my-3">
							<?php
							 // echo "SELECT t1.*, (SELECT 1  FROM protometa WHERE fieldid=t1.id AND pid='$id') AS chk,
				                          // (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM protofields AS t1  WHERE
										  // t1.parents='' AND t1.id IN(".$rproto["fldid"].") ";
				  $fld=mysqli_query($con,"SELECT t1.*, (SELECT 1  FROM protometa WHERE fieldid=t1.id AND pid='$id') AS chk,
				                          (SELECT columnValue FROM langs WHERE tableName='protofields' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."  FROM protofields AS t1  WHERE
										  t1.parents='' AND t1.product LIKE '%".$rproto['product']."%' OR t1.id IN(SELECT parents FROM protofields WHERE product LIKE '%".$rproto['product']."%' )");
                  $fldnum=mysqli_num_rows($fld);		
	              $flcol=ceil($fldnum/2);
                //  echo $fldnum	."--". $flcol;	
				  $i=0;
				  ?>
				   <div class="col-md-6">
				  <?php
				  
				while($rfld=mysqli_fetch_assoc($fld))
				   {
					   ++$i; 
					   if(($flcol-$i)==-1&&$flcol>1)
					   {
						   ?>
						   </div>
						   <div class="col-md-6">
						   <?php
					   }
					
				?>
                <div class="filter-item ">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <h4>
                               <input type='checkbox'  name="fieldid"  <?=$rfld["chk"]==1?"checked":"" ?> pid='<?=$id ?>' class="parper parcheck" d='<?=$rfld["id"] ?>' /><?=$rfld["name".$LA] ?> 
                            </h4>
                            <img src="images/icons/plus.svg" class="slcnt"  d='<?=$rfld["id"] ?>' alt="" product='<?=$rproto['product'] ?>' id='<?=$id ?>'>
                    </div> 
						
                        <div class="collapsed-cat mt-3" d='<?=$rfld["id"] ?>'>
                        <ul>
						<?php
						$fld1=mysqli_query($con,"SELECT t1.*, (SELECT 1  FROM protometa WHERE fieldid=t1.id AND pid='$id') AS chk,
				                          (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.id AND tableColumn='name' AND shortname='$LA' ) AS name". $LA ."     FROM protofields AS t1 WHERE t1.parents='".$rfld["id"]."'
										    AND t1.product LIKE '%".$rproto['product']."%' ");
                  
				         while($rfld1=mysqli_fetch_assoc($fld1))
						 {
				  ?>
                            <li>
                                
                                   <input type='checkbox' class="parchild parcheck" <?=$rfld1["chk"]==1?"checked":"" ?> pid='<?=$id ?>' par="<?=$rfld["id"] ?>" d="<?=$rfld1["id"] ?>"  name="fieldid"/> <?=$rfld1["name".$LA] ?> 
                               
                            </li>
                    <?php
						 } 
                     ?>						 
                           
                        </ul>
                    </div>   
                    </div>
                <?php
				   } 
				   ?>
                </div>
                 
                    </div>
           
                    <hr>
             

                </div>
            </div>
        </div>
			
		</div>
			
			<?php
			 }
			 ?>
			</div>
			</div>
			<script>
    
	$(".filter-cont").click(function(){
     //   $(this).toggleClass("open");
    });
    $(".slcnt").click(function(){
		var d=$(this).attr("d");
        $(this).toggleClass("open");
        if($(this).hasClass("open")){
            $(".collapsed-cat[d='"+d+"']").show("fast");
            $(this).attr('src',"images/icons/minus.svg");
        }else{
            $(this).attr('src',"images/icons/plus.svg");
            $(".collapsed-cat[d='"+d+"']").hide("fast");
        }
    });
   
</script>