<?php
	$ACP=1;
	if(isset($_REQUEST["p"])&&$_REQUEST["p"]>0){
		$ACP=mysqli_real_escape_string($con,$_REQUEST["p"]);
	}
	$PA=30;
	$fr=($ACP-1)*$PA;
	$key=(isset($_GET["key"])&&$_GET["key"]!=""?"AND (t1.itemname LIKE '%".$_GET["key"]."%' OR t1.id LIKE '%".$_GET["key"]."%' OR t1.details LIKE '%".$_GET["key"]."%' OR t1.invoice LIKE '%".$_GET["key"]."%' OR t1.contragent LIKE '%".$_GET["key"]."%') ":"");
	$status=mysqli_real_escape_string($con,$_REQUEST["status"]??"");
	$WST=($status!=""?" AND FIND_IN_SET(t1.status,'".$status."'):":"");
	$city=mysqli_real_escape_string($con,$_REQUEST["city"]??"");
	$WCI=($city!=""?" AND FIND_IN_SET(t1.city,'".$city."') ":"");
    $region=mysqli_real_escape_string($con,$_REQUEST["region"]??"");
	$WRE=($region!=""?" AND FIND_IN_SET(t1.region,'".$region."') ":"");

?>
<style>
input,textarea,select{
	font-weight: 500 !important;
    color: #000 !important;	
}
</style>
<input type="hidden" class="PAGE" value="allorders"/>
<table id="table-ajax-defer" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th colspan=10 >
					<div class="row">
						<div class="col-sm-6">
							<input class="form-control KEY" placeholder="საძიებო სიტყვა" value="<?=$_GET["key"]??"" ?>"/>
						</div>
						<div class="col-sm-2">
							<button class="btn btn-primary SER">ძებნა</button>&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
						<div class="col-sm-2">
							<button class="btn btn-primary CLN">გასუფთავება</button>
						</div>	
						<div class="col-sm-2">
							<div class="col-md-12"><a href="func/eorders.php" class="btn btn-primary">Excel</a></div>
						</div>	
					</div>	
				</th>
			</tr>
			 <tr>
				<th>&nbsp; </th>
				<th class="d-none"><input class="form-control A barc" n="barcode" placeholder="Barcode" title="Barcode"/> </th>
				<th style='display:block; width:110px;'><input class="form-control A" n="date" placeholder="თარიღი" value=<?=date("d.m.Y") ?> title="თარიღი"/></th>
				<th style="width:130px;">
					<select class="form-control A" n="status" title="სტატუსი">
					<option value="">სტატუსი</option>
<?php
$q1=mysqli_query($con,"SELECT * FROM orderstatus ORDER BY id ASC");
while($r1=mysqli_fetch_array($q1)){
?>
					<option value="<?=$r1["id"]?>"><?=$r1["name"]?></option>
<?php
}
?>				
					</select>				
				</th>	
				<th style="width:80px;"><input class="form-control A" n="invoice" placeholder="ინვოისის ნომერი" title="ინვოისის ნომერი"/></th>	
				<th style="min-width:130px;"><input class="form-control A" n="contragent" placeholder="კონტრაგენტი" title="კონტრაგენტი"/></th>	
				<th style="min-width:130px;"><input class="form-control A" n="details" placeholder="მისამართი, პირადი ნომერი, ტელ, ნომერი" title="მისამართი, პირადი ნომერი, ტელ, ნომერი"/></th>	
				<th style="min-width:130px;">
				<select class="form-control A COMBO CITY" n="city" >
					<option value="">აირჩიეთ ქალაქი</option>
<?php
$q5=mysqli_query($con,"SELECT * FROM city ORDER BY name ASC");
while($r5=mysqli_fetch_array($q5)){
?>	
					<option value="<?=$r5["name"]?>" d="<?=$r5["region"]?>"><?=$r5["name"]?></option>	
<?php
}
?>		
</select>
				</th>	
				<th style="min-width:130px;"><input class="form-control A REGION" disabled n="region" value="" placeholder="რეგიონი"/></th>	
				<th style="">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-12 p-0">
						<input class="form-control A NAM" n="itemname" placeholder="ნივთის დასახელება" title="ნივთის დასახელება"/>
						</div>					
					</div>				
				</div>
					
					<div class="OITEMS col-sm-12"></div>
					<div class="SUG"></div>
				</th>
			<!--	<th><input class="form-control A MOM" n="supplier" placeholder="მომწოდებელი" title="მომწოდებელი"/></th>	
				<th><input class="form-control A TPR" n="takeprice" placeholder="ასაღები ფასი" title="ასაღები ფასი"/></th>	
				<th><input class="form-control A" n="price" placeholder="გასაყიდი ფასი" title="გასაყიდი ფასი"/></th>	
				<th><input class="form-control A" n="profit" placeholder="მოგება" title="მოგება"/></th>	-->
				<th ><input class="form-control A" n="shipping" placeholder="მიტანის ფასი" title="მიტანის ფასი"/></th>	
				<th style="min-width:130px"><input class="form-control A"  type="date" n="deliverydate" placeholder="YYYY-MM-DD" title="მიტანის დრო"/></th>	
				<th style="min-width:120px"><textarea class="form-control A" n="comment" placeholder="შენიშვნა/კომენტარი" title="შენიშვნა/კომენტარი" ></textarea></th>
				<th>
					<select style="width:120px;" n="method" class="form-control A" title="გადახდის მეთოდი">
					<option value="">აირჩიეთ გადახდის მეთოდი</option>
<?php
$q1=mysqli_query($con,"SELECT * FROM methods ORDER BY id ASC");
while($r1=mysqli_fetch_array($q1)){
?>
					<option value="<?=$r1["id"]?>"><?=$r1["name"]?></option>
<?php
}
?>				
					</select>				
				</th>	
				<th class="d-none"><input class="form-control A" n="income" placeholder="თანხის შემოსვლა" title="თანხის შემოსვლა"/></th>	
				<th>
					<select style="width:120px;" n="currier" class="form-control A" title="კურიერი">
					<option value="">აირჩიეთ კურიერი</option>
<?php
$q2=mysqli_query($con,"SELECT * FROM curriers ORDER BY id ASC");
while($r2=mysqli_fetch_array($q2)){
?>
					<option  value="<?=$r2["id"]?>"><?=$r2["name"]?></option>
<?php
}
?>				
					</select>					
				</th>	
				<th class="d-none">
					<select style="width:120px;" n="owner" class="form-control A" title="შეკვეთის მიმღების">
					<option value="">შეკვეთის მიმღები</option>
<?php
// $q1=mysqli_query($con,"SELECT * FROM sellers ORDER BY id ASC");
// while($r1=mysqli_fetch_array($q1)){
 ?>
					// <option value="<?=$r1["id"]?>"><?=$r1["name"]?></option>
 <?php
// }
?>				
					</select>					
				</th>	
				<th>
					<select style="width:120px;" n="place" class="form-control A" title="გადახდის მეთოდი">
					<option value="">აირჩიეთ გაყიდვის ადგილი</option>
<?php
$q1=mysqli_query($con,"SELECT * FROM stores ORDER BY id ASC");
while($r1=mysqli_fetch_array($q1)){
?>
					<option value="<?=$r1["id"]?>"><?=$r1["name"]?></option>
<?php
}
?>				
					</select>					
				</th>		
	
				<th class="d-none"><input class="form-control A" n="fine" placeholder="ჯარიმა" title="ჯარიმა"/></th>	
				<th >
					<select style="width:120px;" class="form-control A" n="payed" title="გადახდის სტატუსი">
					<option value="">აირჩიეთ გადახდის სტატუსი</option>

					<option value="0">გადაუხდელი</option>
					<option value="1">გადახდილი</option>
				
					</select>					
				</th>	
					
				<!--<th><input class="form-control A" placeholder="ჩამოწერა" title="ჩამოწერა"/></th>-->				
				<th><a class="btn btn-primary AOR">დამატება</a></th>								
			</tr>
			<tr>
				<th>oId</th>
			<th class="d-none">Barcode</th>
				<th>თარიღი</th>
				<th>სტატუსი<i class="fa fa-filter FILT CP"></i>
				<div class="FILTER">
					<div class="row">
						<div class="col-sm-12">
							<input type="search" class="form-control FILTKEY" placeholder="ფილტრი"/>
						</div>
						<div class="col-sm-12 mt-2">
							<button class="btn btn-primary FILTBUT2">ფილტრი</button>
						</div>	
						<div class="col-sm-12 mt-2">
							<div class="row">
							<div class="col-sm-12 mt-1"style="border-bottom:solid 1px #ddd"><input class="FALL" type="checkbox" />
								<label class="FLAB">ყველა</label>
									
								</div>							
<?php
$qs1=mysqli_query($con,"SELECT DISTINCT(t1.status),t2.name,t2.id FROM orders as t1
LEFT JOIN orderstatus as t2 ON(t1.status=t2.id)
 ORDER BY t2.name ASC");
while($rs1=mysqli_fetch_array($qs1)){
	$sarr=explode(",",$status);
?>							
								<div class="col-sm-12 mt-1"><input class="FLIST" <?=in_array($rs1["id"],$sarr)?"checked":""?> type="checkbox" n="status" value="<?=$rs1["id"]?>"  />
								<label class="FLAB"><?=$rs1["name"]?></label>
									
								</div>	
<?php
}
?>								
							</div>								
						</div>
					
					</div>				
				</div>
				</th>	
				<th>ინვოისის ნომერი</th>	
				<th>კონტრაგენტი</th>	
				<th>მისამართი, პირადი ნომერი, ტელ, ნომერი</th>	
				<th>ქალაქი<i class="fa fa-filter FILT CP"></i>
				<div class="FILTER">
					<div class="row">
						<div class="col-sm-12">
							<input type="search" class="form-control FILTKEY" placeholder="ფილტრი"/>
						</div>
						<div class="col-sm-12 mt-2">
							<button class="btn btn-primary FILTBUT2">ფილტრი</button>
						</div>		
						<div class="col-sm-12 mt-2">
							<div class="row">
							<div class="col-sm-12 mt-1"style="border-bottom:solid 1px #ddd"><input class="FALL" type="checkbox" />
								<label class="FLAB">ყველა</label>
									
								</div>
<?php
$qs1=mysqli_query($con,"SELECT DISTINCT(t1.city) FROM orders as t1 ORDER BY t1.city ASC");
while($rs1=mysqli_fetch_array($qs1)){
	$sarr=explode(",",$city);
?>							
								<div class="col-sm-12 mt-1"><input class="FLIST" <?=in_array($rs1["city"],$sarr)?"checked":""?> type="checkbox" n="city" value="<?=$rs1["city"]?>"  />
								<label class="FLAB"><?=$rs1["city"]?></label>
									
								</div>	
<?php
}
?>								
							</div>								
						</div>				
					</div>				
				</div></th>	
				<th>რეგიონი<i class="fa fa-filter FILT CP"></i>
				<div class="FILTER">
					<div class="row">
						<div class="col-sm-12">
							<input type="search" class="form-control FILTKEY" placeholder="ფილტრი"/>
						</div>
						<div class="col-sm-12 mt-2">
							<button class="btn btn-primary FILTBUT2">ფილტრი</button>
						</div>	
						<div class="col-sm-12 mt-2">
							<div class="row">
							<div class="col-sm-12 mt-1"style="border-bottom:solid 1px #ddd"><input class="FALL" type="checkbox" />
								<label class="FLAB">ყველა</label>
									
								</div>
<?php
$qs1=mysqli_query($con,"SELECT DISTINCT(t1.region) FROM orders as t1 
ORDER BY t1.region ASC");
while($rs1=mysqli_fetch_array($qs1)){
	$sarr=explode(",",$region);
?>							
								<div class="col-sm-12 mt-1"><input class="FLIST" <?=in_array($rs1["region"],$sarr)?"checked":""?> type="checkbox" n="region" value="<?=$rs1["region"]?>"  />
								<label class="FLAB"><?=$rs1["region"]?></label>
									
								</div>	
<?php
}
?>								
							</div>								
						</div>					
					</div>				
				</div></th>	
				<th><table class="table table-bordered table-condensed mb-0">
				<thead>
					<tr>
						<th style="min-width:130px">Item</th>
						<th>მომწოდებელი</th>
						<th>ასაღები ფასი</th>
						<th>გასაყიდი ფასი</th>
						<th style="min-width:70px">Qnty</th>
						<th><button class="btn btn-danger "  ><i class="fa fa-trash"></i></button></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				
				</table></th>
				<!--<th>მომწოდებელი</th>	
				<th>ასაღები ფასი</th>	
				<th>გასაყიდი ფასი</th>	
				<th>მოგება</th>	-->
				<th>მიტანის ფასი</th>	
				<th>მიტანის თარიღი</th>	
				<th>შენიშვნა/კომენტარი</th>	
				<th>გადახდის ტიპი</th>	
				<th class="d-none">თანხის შემოსვლა</th>	
				<th>კურიერი</th>	
				<th class="d-none">შეკვეთის მიმღები</th>	
				<th>გაყიდვის ადგილი</th>	
		
				<th class="d-none">ჯარიმა</th>		
				<th>გადახდის სტატუსი</th>		
								
				<th></th>								
			</tr>
		</thead>
		<tbody>
<?php
$q1=mysqli_query($con,"SELECT t1.*,(SELECT name FROM sellers WHERE id=t1.owner) as 'own' FROM orders as t1 
LEFT JOIN city as t3 ON(t3.region=t3.id)
 WHERE t1.id>0 AND (( t1.userid<>'') OR (t1.userid='')) $key $WST $WCI $WRE ORDER BY t1.id DESC LIMIT $PA OFFSET $fr");



while($r1=mysqli_fetch_array($q1)){
?>
			<tr>
				<th><?=$r1['id'] ?> </th>
				<th class="d-none">
				<?php 
				   echo $r1['barcode'];
				
				?>
				
				</th>
				<th><input class="form-control B" w="<?=$r1["id"]?>" d="date" placeholder="თარიღი" value="<?=$r1["date"]?>" title="თარიღი"/></th>
				<th>
					<select style="width:120px;" class="form-control B" w="<?=$r1["id"]?>" d="status" title="სტატუსი">
					<option value="">სტატუსი</option>
<?php
$q2=mysqli_query($con,"SELECT * FROM orderstatus ORDER BY id ASC");
while($r2=mysqli_fetch_array($q2)){
?>
					<option <?=$r1["status"]==$r2["id"]?"selected":""?> value="<?=$r2["id"]?>"><?=$r2["name"]?></option>
<?php
}
?>				
					</select>					
				</th>	
				<th><small><?=$r1["invoice"]?></small><br><a href="/admin/func/invoiceorder.php?invoice=<?=$r1["invoice"]?>" target="_blank">invoice</a></th>	
				<th><textarea  class="form-control B" w="<?=$r1["id"]?>" d="contragent" placeholder="კონტრაგენტი" title="კონტრაგენტი"><?=$r1["contragent"]?></textarea></th>						
				<th><textarea class="form-control B" w="<?=$r1["id"]?>" d="details" placeholder="მისამართი, პირადი ნომერი, ტელ, ნომერი"  title="მისამართი, პირადი ნომერი, ტელ, ნომერი"><?=$r1["details"]?></textarea></th>	
				<th><textarea class="form-control B" w="<?=$r1["id"]?>" d="city" placeholder="ქალაქი"  title="ქალაქი"><?=$r1["city"]?></textarea></th>	
				<th><textarea class="form-control B" w="<?=$r1["id"]?>" d="region" placeholder="რეგიონი"  title="ქალაქი"><?=$r1["region"]?></textarea></th>	
				<th><table class="table table-bordered table-condensed mb-0">

				<tbody class="BOO" oid="<?=$r1["id"]?>">
<?php
if($r1["itemname"]!=""){
?>
	<textarea class="form-control B" w="<?=$r1["id"]?>" d="itemname" placeholder="ნივთის დასახელება" title="ნივთის დასახელება"/><?=$r1["itemname"]?> - <?=$r1['barcode'] ?></textarea>
<?php	
}
			
$q2=mysqli_query($con,"SELECT * FROM orderproducts as t1

WHERE t1.orderid='".$r1["id"]."'");
while($r2=mysqli_fetch_array($q2)){
?>
					<tr>
						<th style="min-width:130px"><textarea style="height:37px" class="form-control UPT" w="<?=$r2["id"]?>" d="item" placeholder="მომწოდებელი" title="პროდუქტი"><?=$r2["item"]?></textarea></th>
						<th style="min-width:100px"><input class="form-control UPT" w="<?=$r2["id"]?>" t="orderproducts" n="supplier" d="<?=$r2["id"]?>" placeholder="მომწოდებელი" value="<?=$r2["supplier"]?>" title="მომწოდებელი"/></th>
						<th><input class="form-control UPT" w="<?=$r2["takeprice"]?>" t="orderproducts" d="<?=$r2["id"]?>" n="takeprice" placeholder="ასაღები ფასი" value="<?=$r2["takeprice"]?>" title="ასაღები ფასი"/></th>
						<th><input class="form-control UPT" w="<?=$r2["salesprice"]?>" t="orderproducts" d="<?=$r2["id"]?>" n="salesprice" placeholder="გასაყიდი ფასი" value="<?=$r2["salesprice"]?>" t="orderproducts" d="<?=$r2["id"]?>" title="გასაყიდი ფასი"/></th>
						<th><input class="form-control UPT" type="number" min="1" w="<?=$r2["quantity"]?>" d="<?=$r2["id"]?>"  t="orderproducts" n="quantity" placeholder="გასაყიდი ფასი" value="<?=$r2["quantity"]?>" title="Qnty"/></th>
						<th><button class="btn btn-danger DEL " t="orderproducts" d="<?=$r2["id"]?>" ><i class="fa fa-trash"></i></button></th>
					</tr>
<?php
}
?>						
				
				</tbody>	
				</table>
					<div class="col-sm-12 p-0">
						<input class="form-control A NAM1" oid="<?=$r1["id"]?>" n="itemname" placeholder="ნივთის დასახელება" title="ნივთის დასახელება"/>
						<div class="SUG1" oid="<?=$r1["id"]?>"></div>
					</div>	
<button class="btn btn-primary d-none"><i class="fa fa-plus"></i></button>				
				</th>
			<!--	<th><input class="form-control B" w="<?=$r1["id"]?>" d="supplier" placeholder="მომწოდებელი" value="<?=$r1["supplier"]?>" title="მომწოდებელი"/></th>	
				<th><input class="form-control B" w="<?=$r1["id"]?>" d="takeprice" placeholder="ასაღები ფასი" value="<?=$r1["takeprice"]?>" title="ასაღები ფასი"/></th>	
				<th>
				<input class="form-control B" w="<?=$r1["id"]?>" d="price" placeholder="გასაყიდი ფასი" value="<?=$r1["sale"]=="1"?$r1["saleprice"]:$r1["price"]?>" title="გასაყიდი ფასი"/>
				
				</th>	
				<th><input class="form-control B" w="<?=$r1["id"]?>" disabled d="profit" placeholder="მოგება" value="<?=$r1["profit"]?>" title="მოგება"/></th>	-->
				<th><input class="form-control B" w="<?=$r1["id"]?>"d="shipping" placeholder="მიტანის ფასი" value="<?=$r1["shipping"]?>" title="მიტანის ფასი"/></th>
				<th><input class="form-control B" type="date" w="<?=$r1["id"]?>"d="deliverydate" placeholder="DD/MM/YYYY" value="<?=$r1["deliverydate"]?>" title="მიტანის დრო"/></th>		
				<th><textarea class="form-control B" w="<?=$r1["id"]?>" d="comment" placeholder="შენიშვნა/კომენტარი" title="შენიშვნა/კომენტარი"><?=$r1["comment"]?></textarea></th>					
				<th>
					<select style="width:120px;" class="form-control B" w="<?=$r1["id"]?>" d="method"  title="გადახდის მეთოდი">
					<option value="">აირჩიეთ გადახდის მეთოდი</option>
<?php
$q2=mysqli_query($con,"SELECT * FROM methods ORDER BY id ASC");
while($r2=mysqli_fetch_array($q2)){
?>
					<option <?=$r1["method"]==$r2["id"]?"selected":""?> value="<?=$r2["id"]?>"><?=$r2["name"]?></option>
<?php
}
?>				
					</select>					
				</th>	
				<th class="d-none"><input class="form-control B" w="<?=$r1["id"]?>" d="income" placeholder="თანხის შემოსვლა" value="<?=$r1["income"]?>" title="თანხის შემოსვლა"/></th>	
				<th>
					<select style="width:120px;" class="form-control B" w="<?=$r1["id"]?>" d="currier"  title="კურიერი">
					<option value="">აირჩიეთ კურიერი</option>
<?php
$q2=mysqli_query($con,"SELECT * FROM curriers ORDER BY id ASC");
while($r2=mysqli_fetch_array($q2)){
?>
					<option <?=$r1["currier"]==$r2["id"]?"selected":""?> value="<?=$r2["id"]?>"><?=$r2["name"]?></option>
<?php
}
?>				
					</select>					
				</th>	
				<th class="d-none"><input class="form-control B" w="<?=$r1["id"]?>" d="owner" placeholder="შეკვეთის მიმღები" value="<?=$r1["own"]!=""?$r1["own"]:$r1["owner"]?>" title="შეკვეთის მიმღები"/></th>	
				<th>
					<select style="width:120px;" class="form-control B" w="<?=$r1["id"]?>" d="place" title="გადახდის მეთოდი">
					<option value="">აირჩიეთ გაყიდვის ადგილი</option>
<?php
$q4=mysqli_query($con,"SELECT * FROM stores ORDER BY id ASC");
while($r4=mysqli_fetch_array($q4)){
?>
					<option <?=$r4["id"]==$r1["place"]?"selected":""?> value="<?=$r4["id"]?>"><?=$r4["name"]?></option>
<?php
}
?>				
					</select>					
				</th>	

				<th class="d-none"><input class="form-control B" w="<?=$r1["id"]?>"d="fine" placeholder="ჯარიმა" value="<?=$r1["fine"]?>" title="ჯარიმა"/></th>								
				<th class="<?=$r1["payed"]=="1"?"bg-success":"bg-danger"?>">
					<select style="width:120px;" class="form-control B REL" w="<?=$r1["id"]?>" d="payed" title="გადახდის სტატუსი">
					<option value="">აირჩიეთ გადახდის სტატუსი</option>

					<option <?=$r1["payed"]=="0"?"selected":""?> value="0">გადაუხდელი</option>
					<option <?=$r1["payed"]=="1"?"selected":""?> value="1">გადახდილი</option>
				
					</select>					
				</th>								
				<th>
<?php
//if($r12["orderdelete"]==1){
?>
					<a class="btn btn-primary DELO" t="orders" d="<?=$r1["id"]?>">წაშლა</a>
<?php
//}
?>
				</th>								
			</tr>
<?php
}
?>
		</tbody>
		<tfoot>
			<!--<tr>
				<th>თარიღი</th>
				<th>სტატუსი</th>	
				<th>ინვოისის ნომერი</th>	
				<th>კონტრაგენტი</th>	
				<th>მისამართი, პირადი ნომერი, ტელ, ნომერი</th>	
				<th>ნივთის დასახელება</th>
				<th>მომწოდებელი</th>	
				<th>ასაღები ფასი</th>	
				<th>გასაყიდი ფასი</th>	
				<th>მოგება</th>	
				<th>გადახდის ტიპი</th>	
				<th>თანხის შემოსვლა</th>	
				<th>კურიერი</th>	
				<th>შეკვეთის მიმღები</th>	
				<th>გაყიდვის ადგილი</th>	
				<th>შენიშვნა/კომენტარი</th>	
				<th>ჯარიმა</th>	
				<th>ჩამოწერა</th>																	
				<th></th>																	
			</tr>-->
		</tfoot>
</table>
<?php
$q3=mysqli_query($con,"SELECT * FROM orders as t1 WHERE t1.id>0 $key $WST $WCI $WRE");
?>
	<div class="col-md-12 MID NOP text-center">
	<a href="?page=allorders&p=1&region=<?=$region?>&status=<?=$status?>&city=<?=$city?>&cid=<?=$cid!=""?$cid:""?>" class="PG USR">«</a>
	<a href="?page=allorders&p=<?=$ACP!=1?($ACP-1):$ACP?>&region=<?=$region?>&status=<?=$status?>&city=<?=$city?>&cid=<?=$cid!=""?$cid:""?>" class="PG USR">‹</a>
	<?php
	for($i=1;$i<=ceil(mysqli_num_rows($q3)/$PA);$i++){
		if(($ACP-5)<=$i&&($ACP+5)>=$i){
	?>
	<a href="?page=allorders&p=<?=$i?>&region=<?=$region?>&status=<?=$status?>&city=<?=$city?>&cid=<?=$cid!=""?$cid:""?>" class="PG <?=($ACP==$i?"ACP":"")?> USR"><?=$i?></a>
	<?php }
	}
	?>
	<a href="?page=allorders&status=<?=$status?>&region=<?=$region?>&city=<?=$city?>&p=<?=$ACP!=ceil(mysqli_num_rows($q3)/$PA)?($ACP+1):$ACP?>&cid=<?=$cid!=""?$cid:""?>" class="PG USR">›</a>
	<a href="?page=allorders&status=<?=$status?>&region=<?=$region?>&city=<?=$city?>&p=<?=ceil(mysqli_num_rows($q3)/$PA);?>&cid=<?=$cid!=""?$cid:""?>" class="PG USR">» <?=ceil(mysqli_num_rows($q3)/$PA);?></a>
	</div>
	<br>&nbsp;
	<br>&nbsp;