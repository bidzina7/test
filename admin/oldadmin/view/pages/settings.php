<div class="container-fluid">
<div class="row">
<?php
$q1=mysqli_query($con, "SELECT t1.*,  ". languages('contactus','t1.id','address') .", ". languages('contactus','t1.id','aboutus') ." FROM contactus AS t1  ");

$t=time();
if(mysqli_num_rows($q1)<1)
{
	
	mysqli_query($con,"INSERT INTO contactus SET hours='$t' ");
}

$r1=mysqli_fetch_array($q1);

   $c=1;
	  for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
 $lng=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND table_name='contactus' AND  table_column='address' AND table_id='".$r1['id']."' ");

   if(mysqli_num_rows($lng)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , table_name='contactus' , table_column='address' , table_id='".$r1['id']."'   ");
   }
 $lng=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND table_name='contactus' AND  table_column='aboutus' AND table_id='".$r1['id']."' ");

   if(mysqli_num_rows($lng)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , table_name='contactus' , table_column='aboutus' , table_id='".$r1['id']."'   ");
   }
   
  
   
	   }



?>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			ელფოსტა
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="email" d="1" t="contactus" value="<?=$r1["email"]?>"/>
		</div>
	</div>
</div>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			ტელეფონი
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="tel" d="1" t="contactus" value="<?=$r1["tel"]?>"/>
		</div>
	</div>
</div>


	<?php
		$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>	
	<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			მისამართი <?=$lnshortarr[$z] ?>
		</div>
	
		<div class="col-sm-6">
			<input class="form-control UPT" n="address" d="<?=$r1['id'] ?>" ln='<?=$lnshortarr[$z] ?>'  t="contactus" value="<?=$r1["address".$lnshortarr[$z]]?>"/>
		</div>

	 </div>
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
	<div class="col-md-12 py-2 border-bottom d-none">
	<div class="row">
		<div class="col-sm-2">
			ჩვენს შესახებ მოკლედ <?=$lnshortarr[$z] ?>
		</div>
	
		<div class="col-sm-6">
			<input class="form-control UPT" n="aboutus" d="<?=$r1['id'] ?>" ln='<?=$lnshortarr[$z] ?>'  t="contactus" value="<?=$r1["aboutus".$lnshortarr[$z]]?>"/>
		</div>

	 </div>
	</div>
		<?php
	   }
	   ?>	

<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			Facebook გვერდის მისამართი
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="facebook" d="1" t="contactus" value="<?=$r1["facebook"]?>"/>
		</div>
	</div>
</div>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			Instagram გვერდის მისამართი
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="instagram" d="1" t="contactus" value="<?=$r1["instagram"]?>"/>
		</div>
	</div>
</div>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			Youtube გვერდის მისამართი
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="youtube" d="1" t="contactus" value="<?=$r1["youtube"]?>"/>
		</div>
	</div>
</div>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			Fina Api-ს ip მისამართი
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="finaip" d="1" t="contactus" value="<?=$r1["finaip"]?>"/>
		</div>
	</div>
</div>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			Fina Api-ს port მისამართი
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="finaport" d="1" t="contactus" value="<?=$r1["finaport"]?>"/>
		</div>
	</div>
</div>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			Fina Api-ს მომხმარებელი(username)
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="finauser" d="1" t="contactus" value="<?=$r1["finauser"]?>"/>
		</div>
	</div>
</div>
<div class="col-md-12 py-2 border-bottom">
	<div class="row">
		<div class="col-sm-2">
			Fina Api-ს პაროლი (password)
		</div>
		<div class="col-sm-6">
			<input class="form-control UPT" n="finapass" d="1" t="contactus" value="<?=$r1["finapass"]?>"/>
		</div>
	</div>
</div>



	</div>
	</div>