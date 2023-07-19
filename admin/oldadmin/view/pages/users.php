<?php if($r12["users"]==1){ ?>
<?php
$ACP=1;
if(isset($_REQUEST["p"])){
	$ACP=$_REQUEST["p"];
}
$PA=30;
$fr=($ACP-1)*$PA;
?>
<div class="container-fluid">
	<div class="col-md-12 LIS H">
	<table class="table table-bordered table-striped table-condensed">
	<tr>
		<th>COUNT</th>
		<th>Id</th>
		<th>სახელი</th>
		<th>გვარი</th>
		<th>სტატუსი</th>
		

		<th>მობილური</th>

		<th>წაშლა</th>	
	</tr>

	<?php
	$cou=0;
	$q1=mysqli_query($con,"SELECT t1.*, (SELECT title FROM userstatus WHERE id=t1.status) AS ustatus FROM users  AS t1 ORDER BY t1.id ASC LIMIT $PA OFFSET ".$fr."");
    $q3=mysqli_query($con,"SELECT id FROM users");
	$cou=mysqli_num_rows($q3)-($ACP-1)*$PA;
	while($r1=mysqli_fetch_array($q1)){
	?>
	<tr>
		<td><?=$cou?></td>
		<td><?=$r1["Id"]?></td>
		<td><?=$r1["name"]?></td>
		<td><?=$r1["lastname"]?></td>
<?php
     $st=mysqli_query($con, "SELECT * FROM userstatus");

?>		
		<td>
		<select>
		<option>სტატუსი</option>
		<?php
		while($rst=mysqli_fetch_assoc($st))
		{
		?>
		    <option <?=$rst['id']==$r1['status']?"selected":"" ?>>       <?=$rst['title'] ?></option>
		 <?php
		}
		?>	
       </select>		
		</td>
  

		<td><?=$r1["tel"]?></td>

		<td><a class="DGA btn btn-outline-danger"d="<?=$r1["Id"]?>">წაშლა</a></td>
	</tr>
	<?php
	$cou=$cou-1;  
	}
	?>
	</table>
	<ul class="col-md-12 pagination LIS P">
	<?php
	$q3=mysqli_query($con,"SELECT Id FROM users ");
	
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
