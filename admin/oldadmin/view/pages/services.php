<?php
$d=(int)$_GET['d'];
 $srt=mysqli_query($con,"SELECT * FROM servicecategories WHERE id='$d' ");
 $rsrt=mysqli_fetch_assoc($srt);
?>
<div class='container'>
<div class="row">
  <h3><?=$rsrt['name'] ?></h3>
</div>
<div class='row'>
<table class='table table-hover'>
      
  <tr>
		<td>Id</td>
		
		<td>name</td>
		<td>price</td>
		<td>number of merchants</td>
		<td>details</td>
		<td>customprice</td>
		<td>active</td>
		<td>delete</td>
		
		
			
	</tr>	

<?php
   $ser=mysqli_query($con,"SELECT * FROM services WHERE serviceid='$d' ");
   while($rser=mysqli_fetch_assoc($ser))
   {

?>

      
    <tr>
		<td><?=$rser['id'] ?></td>
		<td> <?=$rser['name'] ?></td>
		<td> <?=$rser['price'] ?> ₾</td>
		<td> 12</td>
		<td><a href='?page=servicedetails&d=<?=$rser['id'] ?>'>რედაქტირება</a></td>
		<td><input type='checkbox' class='UPT' t='services' n="customprice" <?=($rser['customprice']!=1?'':'checked') ?>  
		 d='<?=$rser['id'] ?>' >
		 </td><td><input type='checkbox' class='UPT' t='services' n="active" <?=($rser['active']!=1?'':'checked') ?>  d='<?=$rser['id'] ?>' ></td>
		<td><i class='fa fa-trash DGA' n='services' d='<?=$rser['id'] ?>'>&nbsp;</i></td>
		
			
	</tr>	

   
<?php
   }
?>
</table>
</div>
<div class="row  itmcontainer" t='services'>
   <div class='col-md-5'>
      <input type='text' placeholder='servicename' name='name' tp='' ln='' class='form-control UPTS' >
	  <input type='hidden' placeholder='serviceid' name='serviceid' value='<?=$d ?>' tp='int' ln='' class='form-control UPTS' >
   </div>
   <div class='col-md-5'>
      <input type='number' placeholder='price GEL' name='price' tp='double' ln=''  min='0' class='form-control UPTS' >
   </div>
   <div class='col-md-2'>
   <div class='btn btn-default pull-right ADDITEMS' t='services' d='' >+ add service </div>
   </div>
</div>
</div>

