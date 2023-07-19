<?php if($r12["users"]==0){ ?>
<?php
$ACP=1;
if($_REQUEST["p"]>0){
	$ACP=$_REQUEST["p"];
}
$PA=30;
$fr=($ACP-1)*$PA;
?>
<div class="container-fluid">
	<div class="col-md-12 LIS H">
		<div class="D1" style="width:60px">COUNT</div>
		<div class="D1" style="width:60px">Id</div>
		<div class="D2" style="width:120px">სახელი</div>
		<div class="D3" style="width:180px">გვარი</div>
		<div class="D5" style="width:260px">Email</div>
		<div class="D5" style="width:140px">მობილური</div>
		<div class="D6" style="width:180px">დამატება/წაშლა</div>	
	</div>
	<?php
	$cou=0;
	$q1=mysqli_query($con,"SELECT * FROM users  ORDER BY id DESC LIMIT $PA OFFSET ".$fr."");
	$q3=mysqli_query($con,"SELECT id FROM users ");
	$cou=mysqli_num_rows($q3)-($ACP-1)*$PA;
	while($r1=mysqli_fetch_array($q1)){
	?>
	<div class="col-md-12 LIS">
		<div class="D1" style="width:60px"><?=$cou?></div>
		<div class="D1" style="width:60px"><?=$r1["id"]?></div>
		<div class="D2" style="width:120px"><?=$r1["firstname"]?></div>
		<div class="D3" style="width:180px"><?=$r1["lastname"]?></div>
		<div class="D4" style="width:260px"><?=$r1["email"]?></div>
		<div class="D5" style="width:140px"><?=$r1["tel"]?></div>	
		<div class="D6" style="width:180px"><a class="DGA btn btn-outline-danger" n="users" d="<?=$r1["id"]?>">წაშლა</a></div>
	</div>
	<?php
	$cou=$cou-1;  
	}
	?>
	<ul class="col-md-12 pagination LIS P">
	<?php
	$q3=mysqli_query($con,"SELECT id FROM users");
	for($i=1;$i<=ceil(mysqli_num_rows($q3)/30);$i++){
	?><li>
	<a href="?page=clients&p=<?=$i?>" class="PG <?=($ACP==$i?"ACP":"")?> AMI"><?=$i?></a>
	</li>
	<?php
	}
	?>
	<li class="next"><a href="?page=clients&p=1"><i class="fa fa-angle-right"></i></a></li>
	<li class="last"><a href="?page=clients&p=1">Last</a></li>
	</ul>
</div>
<?php }?>
