<?php if( getprm($Guid,$con,"admins")==1){ 
$ACP=1;
if(isset($_REQUEST["p"])){
	$ACP=$_REQUEST["p"];
}
$PA=30;
$fr=($ACP-1)*$PA;
// echo getcwd();
include("func/functions.php");
?>
<div class="container-fluid">
	<div class="col-md-12 LIS H">
		<div class="D1" style="width:60px">რაოდ.</div>
		<div class="D1" style="width:60px">Id</div>
		<div class="D2" style="width:120px">სახელი</div>
		<div class="D3" style="width:180px">გვარი</div>
		<div class="D4" style="width:180px">ზედმეტსახელი</div>
		<div class="D5" style="width:130px">პაროლი</div>
		<div class="D5" style="width:140px">მობილური</div>
		<div class="D5" style="width:120px">უფლებები</div>
		<div class="D5" style="width:80px">SMS</div>
		<div class="D6" style="width:150px">დამატება</div>	
	</div>
	<div class="col-md-12 LIS H itmcontainer" t="admins" norep="name,tel" conf='' message='ადმინი უკვე არსებობს!' >
		<div class="D1" style="width:60px"></div>
		<div class="D1" style="width:60px"></div>
		<div class="D2" style="width:120px"><input type='text' placeholder="სახელი" name='firstname' ln='' tp='' class="form-control UPTS"/></div>
		<div class="D3" style="width:180px"><input placeholder="გვარი"  name='lastname' ln='' tp='' class="form-control UPTS"/></div>
		<div class="D4" style="width:180px"><input placeholder="ზედმეტსახელი"  name='name' ln='' tp='' class="form-control UPTS"/></div>
		<div class="D5" style="width:140px"><input type="პაროლი" name='password' ln='' tp='password' placeholder="Password" class="form-control UPTS"/></div>
		<div class="D5" style="width:140px"><input placeholder="მობილური"  name='tel' ln='' tp='' class="form-control UPTS"/></div>
		<div class="D5" style="width:180px"></div>
		<div class="D6" style="width:180px"><input value="დამატება" type="button"  t='admins' d=''  class="ADDITEMS btn btn-outline-success"/></div>	
	</div>
	<?php
	$cou=0;
	$q1=mysqli_query($con,"SELECT * FROM admins WHERE name<>'ADMIN' ORDER BY Id DESC LIMIT $PA OFFSET ".$fr."");
	$q3=mysqli_query($con,"SELECT Id FROM admins WHERE name<>'ADMIN'");
	$cou=mysqli_num_rows($q3)-($ACP-1)*$PA;
	while($r1=mysqli_fetch_array($q1)){
	?>
	<div class="col-md-12 LIS">
		<div class="D1" style="width:60px"><?=$cou?></div>
		<div class="D1" style="width:60px"><?=$r1["Id"]?></div>
		<div class="D2" style="width:120px"><?=$r1["name"]?></div>
		<div class="D3" style="width:180px"><?=$r1["lastname"]?></div>
		<div class="D4" style="width:140px"><?=$r1["name"] ?></div>
		<div class="D5" style="width:120px"><input onfocus="$(this).attr('type','')" onblur="$(this).attr('type','password')" type="password" placeholder="Password" value="<?=encrypt_decrypt("decrypt",$r1["password"])?>" class="form-control ADP UPT" d="<?=$r1["Id"]?>" n="pass" t="admins"/></div>
		<div class="D5 pl-5" style="width:140px"><?=$r1["tel"]?></div>
		<div class="D5 pl-5" style="width:180px"><?php if(getprm($Guid,$con,"permissions")==1){ ?><a class="PRM" d="<?=$r1["Id"]?>" style="cursor:pointer;">უფლებები</a><?php }?></div>	

		<div class="D6" style="width:180px"><a class="ADC btn btn-danger"d="<?=$r1["Id"]?>"><i class="fa fa-trash text-white"></i></a></div>
	</div>
	<?php
	$cou=$cou-1;  
	}
	?>
	<ul class="col-md-12 pagination LIS P">
	<?php
	$q3=mysqli_query($con,"SELECT Id FROM admins WHERE name<>'ADMIN'");
	for($i=1;$i<=ceil(mysqli_num_rows($q3)/30);$i++){
	?><li>
	<a href="?page=admins&p=<?=$i?>" class="PG <?=($ACP==$i?"ACP":"")?> AMI"><?=$i?></a>
	</li>
	<?php
	}
	?>
	<li class="next"><a href="?page=admins&p=1"><i class="fa fa-angle-right"></i></a></li>
	<li class="last"><a href="?page=admins&p=1">Last</a></li>
	</ul>
</div>
<?php }?>
