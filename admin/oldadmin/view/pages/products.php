<?php
$ACP=1;
$WSE="";
$KEY="";
if(isset($_REQUEST["p"])&&$_REQUEST["p"]>0){
	$ACP=$_REQUEST["p"];
}
$PA=30;
$fr=($ACP-1)*$PA;
$STATUS=mysqli_real_escape_string($con,$_REQUEST["status"]??"");
$fromprice=mysqli_real_escape_string($con,$_REQUEST["fromprice"]??"");
$toprice=mysqli_real_escape_string($con,$_REQUEST["toprice"]??"");
$fromsalesprice=mysqli_real_escape_string($con,$_REQUEST["fromsalesprice"]??"");
$tosalesprice=mysqli_real_escape_string($con,$_REQUEST["tosalesprice"]??"");
if(isset($_REQUEST["key"])&&$_REQUEST["key"]!=""){
	$KEY=mysqli_real_escape_string($con,$_REQUEST["key"]);
	$WSE=" AND (t1.BARCODE LIKE '%".$KEY."%' OR t1.ITEM LIKE '%".$KEY."%' OR t1.titlege LIKE '%".$KEY."%' OR FIND_IN_SET('".$KEY."',t1.keywords) )";
}
	$WPR=($fromprice!=""?" AND (t1.PRICE>".$fromprice." AND t1.PRICE<".$toprice.") ":"");
	$WSP=($fromsalesprice!=""?" AND (t1.salesprice>".$fromsalesprice." AND t1.salesprice<".$tosalesprice.") ":"");

$q1=mysqli_query($con,"SELECT t1.*,". languages('products','t1.id','title') .", t2.name as 'cat' FROM products as t1 
LEFT JOIN categories as t2 ON(t1.category=t2.id)
WHERE t1.id>0 $WSE $WPR $WSP ORDER BY t1.id DESC LIMIT ".$PA." OFFSET ".$fr.""); 
$q100=mysqli_query($con,"SELECT t1.* FROM products as t1 WHERE t1.id>0  $WSE $WPR $WSP ORDER BY t1.id DESC ");	
$cou=mysqli_num_rows($q100)-($ACP-1)*$PA;
?>

<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-sm-12">
		<div class="row my-2">
			<div class="col-sm-3">
				<input class="form-control SERKEY3" placeholder="Search" value="<?=$KEY?>"/>
			</div>
			<div class="col-sm-1">
				<button class="btn btn-outline-success SER3">Search</button>
			</div>
			<div class="col-sm-3">
				<a href="?page=product"><button class="btn btn-primary">პროდუქტის დამატება</button></a>
			</div>
			<div class="col-sm-5 d-none">
				<select class="form-control UTY">
					<option <?=$UTYPE==""?"selected":""?> value="">ყველა მომხმარებელი</option>
					<option <?=$UTYPE=="1"?"selected":""?> value="1">ფიზიკური პირი</option>
					<option <?=$UTYPE=="2"?"selected":""?> value="2">იურიდიული პირი</option>
				</select>
			</div>
			<div class="col-sm-3 d-flex justify-content-end">
				
			</div>
		</div>
	</div>
<link href="js/lightbox/css/lightbox.min.css" rel="stylesheet">
<script src="js/lightbox/js/lightbox.min.js"></script>

   <div class="col-sm-12 my-3 p-0 row">


		<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
	
	<div class='col-sm-1' >

	    <button class='btn <?=$langdefaultarr[$z]=='1'?"btn-success":"btn-danger" ?> ltab' d='<?=$c ?>' >  <?=$lnarr[$z] ?></button>
	  
	</div>
	   <?php
	   }
	   ?>

   </div>
	<div class="col-sm-12">
	<table class="table table-sm table-striped table-bordered table-condensed table-hover">
		<thead>
		  <tr>
			<th>Image</th>
			<th>Count</th>
			<th>id</th>
			<?php			   
             $c=0;
	         for($z=0;$z<count($lnarr);$z++)
	        {
	      $c++;
	       ?>
		   <th class='enebi' d='<?=$c ?>'  style="<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>">დასახელება <?=$lnshortarr[$z] ?></th>
			<?php
			}
			?>
			<th>საქონლის კოდი</th>
			<th>რაოდენობა</th>
			<th>ფასი <i class="fa fa-filter FILT CP"></i>
				<div class="FILTER">
					<div class="row">
						<div class="col-sm-12">
							ფილტრი
						</div>
						<div class="col-sm-12 mt-3">
							<div class="row">
								<div class="col-sm-6 pr-2">
									<input class="form-control FROM1" n="fromprice" value="<?=$fromprice?>" placeholder="დან" />
								</div>	
								<div class="col-sm-6 pl-2">
									<input class="form-control TO1" n="toprice" value="<?=$toprice?>" placeholder="მდე" />
								</div>									
							</div>								
						</div>
						<div class="col-sm-12 mt-3">
							<button class="btn btn-primary FILTBUT">ფილტრი</button>
						</div>						
					</div>				
				</div>			
			</th>
			<th>ფასი ჯამურად</th>
			<th>გასაყიდი ფასი <i class="fa fa-filter FILT CP"></i>
				<div class="FILTER">
					<div class="row">
						<div class="col-sm-12">
							ფილტრი
						</div>
						<div class="col-sm-12 mt-3">
							<div class="row">
								<div class="col-sm-6 pr-2">
									<input class="form-control FROM1" n="fromsalesprice" value="<?=$fromsalesprice?>" placeholder="დან" />
								</div>	
								<div class="col-sm-6 pl-2">
									<input class="form-control TO1" n="tosalesprice" value="<?=$tosalesprice?>" placeholder="მდე" />
								</div>									
							</div>								
						</div>
						<div class="col-sm-12 mt-3">
							<button class="btn btn-primary FILTBUT">ფილტრი</button>
						</div>						
					</div>				
				</div>	
			</th>
			<th>აქტიური</th>
			<th style="200px">კატეგორია</th>
			<th>ფილიალი</th>
			<th>პოზიცია</th>
			<th><i class="fa fa-edit"></i></th>
			<th><i class="fa fa-eye"></i></th>		
			<th>წაშლა</th>
			<th>Select All&nbsp;<br><input class="SELALL" type="checkbox"/> </th>
		  </tr>
		</thead>
		<tbody>
<?php
while($r1=mysqli_fetch_array($q1)){
	$q2=mysqli_query($con,"SELECT t1.id,t1.quantity,(SELECT name FROM stores as t2 WHERE t1.storeid=t2.id) as 'store'  FROM qbystore as t1 where t1.itemid='".$r1["id"]."'");

	$rows=mysqli_fetch_all($q2,MYSQLI_ASSOC);
	$msg="";
	$qua=0;
foreach($rows as $ro){
	$msg=$msg.'<div class="row"><div class="col-sm-7">'.$ro["store"].'</div><div class="col-sm-5"><input type="number" class="form-control UPT" d="'.$ro["id"].'" n="quantity" t="qbystore" value="'.$ro["quantity"].'"/></div></div><br>';
	$qua=$qua+intval($ro["quantity"]);
}	
	if($r1["img"]!=""){
		$img=$r1["img"];
	}else{
		 // $img="/admin/uploads/products/".str_replace(" ","-",substr($r1["ITEM"],0,6)).".jpg";
		 // $img2="/home/admin/domains/chvenebi.ge/public_html/admin/uploads/products/".str_replace(" ","-",substr($r1["ITEM"],0,6)).".jpg";
		 $img2="";
		if(!file_exists($img2)){
			$img="/admin/img/noimage.png";
		}
	}
?>
		  <tr>
			<th>	<a class="example-image-link" href="<?=$img?>" data-title="<?=$r1["ITEM"]?> - ფასი:<?=number_format($r1["PRICE"],2)?>" data-lightbox="example-1"><img style="width:61px" class="GIM" src="<?=$img?>" alt="image-1" /></a></th>
			<th><?=$cou?></th>
			<th><?=$r1["id"]?></th>
			<?php
	        $c=0;
	       for($z=0;$z<count($lnarr);$z++)
	        {
	         $c++;
	        ?>
			<th class='enebi' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>' d='<?=$c ?>'><?=$r1["title" .$lnshortarr[$z]]?></th>
			<?php
			}?>
			<th><?=$r1["BARCODE"]?></th>
			<th><input class="form-control UPT" type="number" d="<?=$r1["id"]?>" n="QUANTITY" t="products" value="<?=$r1["QUANTITY"]?>"/></th>
			<th><?=$r1["PRICE"] ?> ₾</th>
			<th> ₾</th>
			<th><input class="form-control UPT" d="<?=$r1["id"]?>" n="salesprice" t="products" value='<?=$r1["salesprice"] ?>' /> ₾</th>
			<th><input class="form-control UPT2" d="<?=$r1["id"]?>" <?=$r1["active"]==1?"checked":""?> type="checkbox" n="active" t="products" /></th>
			<th style="">			
			
			<select class="form-control UPT3 selectpicker" data-live-search="true"  multiple  n="category" t="products" d="<?=$r1["id"]?>" >
				<option>აირჩიეთ კატეგორია</option>
<?php
$q2=mysqli_query($con,"SELECT t1.*, ". languages('categories','t1.id','name') ." FROM categories AS t1 WHERE t1.type='2' ORDER BY t1.position  ASC");
while($r2=mysqli_fetch_array($q2)){
		$catebi = explode(',',$r1["category"]);
			   
             $c=0;
	         for($z=0;$z<count($lnarr);$z++)
	        {
	      $c++;
	   
?>
				<option  class='enebi' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>' <?=in_array($r2["id"], $catebi)?"selected":""?> value="<?=$r2["id"]?>"><?=$r2["name".$lnshortarr[$z]]?></option>
<?php
			}
}
?>
			</select>	</th>
			<th style="width:200px"><small><?=$msg?></small></th>
			<th style="width:50px"><input class="form-control UPT text-center" d="<?=$r1["id"]?>" n="position" t="products" value='<?=$r1["position"] ?>'/></th>
			<th><a class="btn btn-primary" href="?page=product&id=<?=$r1["id"]?>"><i class="fa fa-edit"></i></a></th>
			<th><a class="btn btn-primary" target="_blank" href="/en/product/<?=$r1["id"]?>"><i class="fa fa-eye"></i></a></th>
			<th><button class="btn btn-outline-primary DGA" d="<?=$r1["id"]?>" n="products"><i class="fa fa-trash text-danger"></i></button></th>
			<th><input class="SUS" type="checkbox" d="<?=$r1["id"]?>"/></th>
		  </tr>
<?php
$cou=$cou-1;
}
?>
		</tbody>
	</table>
	</div>
<?php
$q3=mysqli_query($con,"SELECT * FROM products as t1 WHERE t1.id>0 $WSE $WPR $WSP");
?>
	<div class="col-md-12 MID">
	<a href="?page=products&key=<?=$KEY?>&p=1&cid=<?=$cid!=""?$cid:""?>" class="PG USR">«</a>
	<a href="?page=products&key=<?=$KEY?>&p=<?=$ACP!=1?($ACP-1):$ACP?>&cid=<?=$cid!=""?$cid:""?>" class="PG USR">‹</a>
	<?php
	for($i=1;$i<=ceil(mysqli_num_rows($q3)/$PA);$i++){
		if(($ACP-5)<=$i&&($ACP+5)>=$i){
	?>
	<a href="?page=products&key=<?=$KEY?>&p=<?=$i?>&cid=<?=$cid!=""?$cid:""?>" class="PG <?=($ACP==$i?"ACP":"")?> USR"><?=$i?></a>
	<?php }
	}
	?>
	<a href="?page=products&key=<?=$KEY?>&p=<?=$ACP!=ceil(mysqli_num_rows($q3)/$PA)?($ACP+1):$ACP?>&cid=<?=$cid!=""?$cid:""?>" class="PG USR">›</a>
	<a href="?page=products&key=<?=$KEY?>&p=<?=ceil(mysqli_num_rows($q3)/$PA);?>&cid=<?=$cid!=""?$cid:""?>" class="PG USR">» <?=ceil(mysqli_num_rows($q3)/$PA);?></a>
	</div>
</div>
</div>
<br>