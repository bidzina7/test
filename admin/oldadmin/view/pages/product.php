<?php

$a=mysqli_real_escape_string($con,$_GET["id"]);
$T=time();

if($a!=""){
	$q1=mysqli_query($con,"SELECT * FROM products WHERE id='".$a."' ");
	$r1=mysqli_fetch_array($q1);
}else{

	$ina=mysqli_query($con,"INSERT INTO products SET date='$T' ");

	// $dd=mysqli_query($con, "SELECT id FROM products  ORDER BY id DESC");
	// $rd=mysqli_fetch_array($dd);$a=$rd['id'];
	$a=mysqli_insert_id($con);
	
	?>
	
<script>location.href="?page=product&id=<?=$a?>"</script>
<?php
	}
	
	  $c=1;
	  for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
 $lng=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='products' AND  tableColumn='title' AND tableId='$a' ");
 $lng1=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='products' AND  tableColumn='text' AND tableId='$a' ");
 $lng2=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='products' AND  tableColumn='description' AND tableId='$a' ");
 $lng3=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='products' AND  tableColumn='keywords' AND tableId='$a' ");
 $lng4=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='products' AND  tableColumn='shorttext' AND tableId='$a' ");
   if(mysqli_num_rows($lng)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='products' , tableColumn='title' , tableId='$a'  ");
   }
   
    if(mysqli_num_rows($lng1)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='products' , tableColumn='text' , tableId='$a'  ");
   }
   
    if(mysqli_num_rows($lng2)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='products' , tableColumn='description' , tableId='$a'  ");
   }
    if(mysqli_num_rows($lng3)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='products' , tableColumn='keywords' , tableId='$a'  ");
   }
     if(mysqli_num_rows($lng4)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='products' , tableColumn='shorttext' , tableId='$a'  ");
   }
	   }
	
?>
<div class="container">
          <br/>
   <div class="col-sm-10 mt-3 p-0">
    <div class='row'>

		<?php
	$c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
	
	<div class='col-sm-2' >

	    <button class='btn <?=$langdefaultarr[$z]=='1'?"btn-success":"btn-danger" ?>  ltab' d='<?=$c ?>' >  <?=$lnarr[$z] ?></button>
	  
	</div>
	   <?php
	   }
	   ?>
	</div>
   </div>
                                       
<h3 class="title mt-3 mb-4 p-2">
    <span>
        პროდუქტის რედაქტირება 
    </span>
</h3>
	<div class="col-sm-12 my-3">
		<a href="https://buyzone.ge/ka/product/<?=$r1["slug"]?>/<?=$r1["id"]?>"><button class="btn btn-primary">საიტზე პროდუქტის ნახვა</button></a>
	</div>
<div class="row d-none">
	<div class="col-sm-12 my-3">
	
		<a style="color:#FFF"  class="btn btn-primary svpr" ></a>
	
	</div>
</div>
<?php
$a=mysqli_real_escape_string($con,$_GET["id"]);
$q1=mysqli_query($con,"SELECT  t1.*,  ". languages('products','t1.id','title') ." ,
                                      ".languages('products','t1.id','text') .",
                                      ".languages('products','t1.id','description') .",
                                      ".languages('products','t1.id','shorttext') .",
                                      ".languages('products','t1.id','keywords') ."
									  FROM products  AS t1 WHERE t1.id='".$a."'");
$r1=mysqli_fetch_array($q1);
?>
<div role="tabpanel">
    <!-- Tab panes -->
    <div class="tab-content col-sm-12 itmcontainer" t='products'>

                                <div role="tabpanel" class="tab-pane active" id="georgian">

                              
<?php			   
             $c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
		
           <div class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '>
                       <label for="ge[sarchevi]" class="required">დასახელება <?=$lnshortarr[$z] ?></label>
                       <input class="form-control UPTS" value="<?=$r1["title".$lnshortarr[$z]] ?>" tp='' ln='<?=$lnshortarr[$z] ?>' rows="10"  id="ADLGE" name="title" cols="50">
		               <br>
               </div>		
	  
		<br>
                           
                <div class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '>                 
							 <label for="ge[sarchevi]" class="required">Keywords <?=$lnshortarr[$z] ?></label>
<input class="form-control col-sm-12 INP" value="<?=$r1["keywords".$lnshortarr[$z]] ?>" tp='' ln='<?=$lnshortarr[$z] ?>' rows="10" data-locale="ge"  name="keywords" cols="50">
    </div>
		<br>
   <?php
	   }
	   ?>
     	   
					<label for="ge[sarchevi]" class="required">URL Sluug</label>
<input class="form-control col-sm-12 INP"  tp="" value="<?=$r1["slug"]?>" rows="10" data-locale="ge" id="SLGGE" name="SLGGE" cols="50">
		<br>
                                <label for="ge[sarchevi]" class="required">ბარკოდი</label>
<input class="form-control col-sm-3 INP UPTS" name="BARCODE" tp="" ln="" value="<?=$r1["BARCODE"]?>" rows="10" data-locale="ge"  cols="50">
		<br>
	
                                <label for="ge[sarchevi]" class="required">ფასი</label>
<input class="form-control col-sm-2 INP UPTS" name="PRICE" value="<?=$r1["PRICE"]?>" ln="" tp="double" rows="10" data-locale="ge"  placeholder="0.00" cols="50">
		<br>
                                <label for="ge[sarchevi]" class="required">გასაყიდი ფასი</label>
<input class="form-control col-sm-2 INP UPTS" name="salesprice" value="<?=$r1["salesprice"]?>" ln=""  tp="double" rows="10" data-locale="ge"  placeholder="0.00" cols="50">
		<br>
		<?php			   
             $c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
		<div class='enebi' d='<?=$c ?>'  style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?> '>
                                <label for="ge[sarchevi]" class="required">მოკლე აღწერა <?=$lnshortarr[$z] ?> (SEO DESC 160 letters)</label>
          <textarea class="form-control col-sm-4 UPTS" name="description" ln="<?=$lnshortarr[$z]?>" tp="" rows="10" data-locale="ge" id="SLGGE" placeholder="" cols="50"><?=$r1["description".$lnshortarr[$z]]?></textarea>
        </div>
		<br>
	   <?php
	   }
	   ?>
     		<div class="col-sm-12 p-0 my-2">
			<select class="form-control UPTS" name="category" tp='' ln='' >
			<option <?=$r1["category"]==0?"selected":""?> value='0' >აირჩიეთ კატეგორია</option>
<?php
$q2=mysqli_query($con,"SELECT t1.*, ". languages('categories','t1.id','name') ." FROM categories AS t1 WHERE t1.type IN(SELECT id FROM ctypes WHERE name='products') AND t1.active='1' ORDER BY t1.id DESC");
while($r2=mysqli_fetch_array($q2)){
?>
				<option <?=$r1["category"]==$r2["id"]?"selected":""?> value="<?=$r2["id"]?>"><?=$r2["name".$lngdefname] ?> </option>
<?php
}
?>				
			</select>
		</div>
        <div class="col-sm-12 p-0 my-2">
            <label for="pdf">პროდუქტის მთავარი სურათი</label>

<div class="input-append row">
					<div class="col-md-9">
						<input id="YDA9767032" class="form-control INP UPTS" t="main" tp="" ln="" n="img" name="img" d="1" placeholder="სურათის ლინკი" type="text" value="<?=$r1["img"]?>">		
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA9767032&relative_url=0')"><button class="btn iframe-btn btn-outline-success">Select</button></a>
				</div>
  
        </div>	
        <div class="col-sm-12 p-0 my-2">
            <label for="pdf">პროდუქტის სურათების დამატება</label>

<div class="input-append row">
					<div class="col-md-9">
						<input id="YDA97670323" class="form-control PIMG" placeholder="სურათის ლინკი" type="text" value="">	
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA97670323&relative_url=0')"><button class="btn iframe-btn btn-outline-success">Select</button></a>
					<button class="btn iframe-btn btn-success ADDIMG ml-2" d="<?=$a?>">დამატება</button>
				</div>
  
        </div>	
        <div class="col-sm-12 p-0 my-2">
			<div class="row IMGS">
<?php
$q2=mysqli_query($con,"SELECT * FROM productimgs WHERE productid='".$a."' ORDER BY id DESC ");
while($r2=mysqli_fetch_array($q2)){
?>
<div class="col-sm-2">
	<img src="<?=$r2["img"]?>" class="w-100" />
</div>
<div class="col-sm-2">
	<button class="btn iframe-btn btn-success DGA ml-2" d="<?=$r2["id"]?>" n="productimgs"><i class="fa fa-trash text-light"></i></button>
</div>
<div class="col-sm-8">
</div>
<?php
}
?>
  
			</div>	
        </div>			
        <div class="col-sm-12 pad-no-right pad-no-xs my-2 NOP d-none">
            <label for="pdf">მედია</label>

<div class="input-append row">
					<div class="col-md-9">
						<input id="YDA97670327" class="form-control"  t="main" n="img1" d="1" placeholder="მედია" type="text" value="">		
					</div>
					&nbsp;<a href="javascript:open_popup('responsive_filemanager/filemanager/dialog.php?type=1&popup=1&field_id=YDA97670327&relative_url=0')"><button class="btn iframe-btn btn-outline-success">Select</button></a>
				</div>
  
        </div>		
		 <?php			   
       $c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
        <div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>'>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">ტექსტი <?=$lnshortarr[$z] ?></label>

               <textarea id="ADTENG<?=$z ?>" tiny='1' ln='<?=$lnshortarr[$z] ?>' class='ADTGE UPTS' tp='' name='text' placeholder="ტექსტი <?=$lnshortarr[$z] ?>"><?=$r1["text".$lnshortarr[$z]] ?></textarea>
  
            </div>     
		</div>	
		
	<?php
	   }
	   ?>
              
            </div>

        
 

		<div class='col-sm-6 mt-3'>
		<label>
		    აქტიური
		   <input type='checkbox' <?=$r1['active']=='0'?'checked':'' ?> class='aactv' />
		</label>   
		
	</div>	
    <div class="submit my-4 col-sm-12">
        <button  class="btn btn-success ADDITEMS" slug='title/en' t='products' sitemap='2' pagename='product' d="<?=$a?>" msg="დამახსოვრებულია">დამახსოვრება</button>
    </div>
    

</div>
                    </div>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.17/dist/js/bootstrap-select.min.js"></script>

<script>
$(function(){
	tinymce.init({
		relative_urls: false,
	  selector: "textarea.ADTGE",
	  height:"400",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],

	  toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
	  toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | responsivefilemanager | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
	  toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

	  menubar: false,
	  toolbar_items_size: 'small',

	  style_formats: [{
		title: 'Bold text',
		inline: 'b'
	  }, {
		title: 'Red text',
		inline: 'span',
		styles: {
		  color: '#ff0000'
		}
	  }, {
		title: 'Red header',
		block: 'h1',
		styles: {
		  color: '#ff0000'
		}
	  }, {
		title: 'Example 1',
		inline: 'span',
		classes: 'example1'
	  }, {
		title: 'Example 2',
		inline: 'span',
		classes: 'example2'
	  }, {
		title: 'Table styles'
	  }, {
		title: 'Table row 1',
		selector: 'tr',
		classes: 'tablerow1'
	  }],
		setup : function(ed) {
			  ed.on('change keyup', function(e) {
				   //console.log('the event object ', e);
				   //console.log('the editor object ', ed);
				  // console.log('the content ', ed.getContent());
				  //console.log(ed.getContent());
				  func("updatetable","ptexts",$("#"+ed.id).attr("n"),ed.getContent(),$("#"+ed.id).attr("d"));
			  });
		},
		external_filemanager_path:"/admin/responsive_filemanager/filemanager/",
		filemanager_title:"Responsive Filemanager" ,
		external_plugins: { "filemanager" : "../../responsive_filemanager/filemanager/plugin.min.js"}
	  
	});	
});

</script>
<script src="js/tinymce/tinymce.min.js"></script>
