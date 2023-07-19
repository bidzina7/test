<?php
$q="SELECT t1.*, ". languages('terms','t1.id','text')  ." ,  ". languages('terms','t1.id','title')  .", ".languages('terms','t1.id','description').", ".languages('terms','t1.id','keywords'). " FROM terms AS t1 ORDER BY t1.id DESC LIMIT 1";
$result=mysqli_query($con,$q);

$dat=mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0)
{
	
	$c=1;
	  for($z=0;$z<count($lnarr);$z++)
	   {
		 
	   $c++;

$lng=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='terms' AND  tableColumn='text' AND tableId='".$dat['id']."' ");
        if(mysqli_num_rows($lng)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='text' , tableId='".$dat['id']."'   ");
	   //echo "INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='text' , tableId='".$dat['id']."'   ";
   }
	   
	   $lng1=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='terms' AND  tableColumn='title' AND tableId='".$dat['id']."' ");
        if(mysqli_num_rows($lng1)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='title' , tableId='".$dat['id']."'   ");
	   //echo "INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='text' , tableId='".$dat['id']."'   ";
   }
   $lng2=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='terms' AND  tableColumn='description' AND tableId='".$dat['id']."' ");
        if(mysqli_num_rows($lng1)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='description' , tableId='".$dat['id']."'   ");
	   //echo "INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='text' , tableId='".$dat['id']."'   ";
   }
   $lng2=mysqli_query($con, "SELECT id FROM langs WHERE shortname='".$lnshortarr[$z]."' AND tableName='terms' AND  tableColumn='keywords' AND tableId='".$dat['id']."' ");
        if(mysqli_num_rows($lng1)<1)
   {
	   
	  
	   mysqli_query($con,"INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='keywords' , tableId='".$dat['id']."'   ");
	   //echo "INSERT INTO langs SET shortname='".$lnshortarr[$z]."' , tableName='terms' , tableColumn='text' , tableId='".$dat['id']."'   ";
   }
	   }
}
else
{
	mysqli_query($con, "INSERT INTO terms SET tel='0'");
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

    <h3 class="title mt-3">
    <span>
        ჩვენს შესახებ
    </span>
    </h3>


<div class="itmcontainer" t='terms'  d="<?=$dat['id'] ?>">
    <div role="tabpanel">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="georgian">
           


                <br/>
              
						 <?php			   
       $c=0;
	   for($z=0;$z<count($lnarr);$z++)
	   {
	   $c++;
	?>
	    <div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>  '>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">სათაური <?=$lnshortarr[$z] ?></label>

               <input type="text"  ln='<?=$lnshortarr[$z] ?>' class='form-control UPTS' tp='' name='title' placeholder="title <?=$lnshortarr[$z] ?>" value="<?=$dat["title".$lnshortarr[$z]] ?>" />
  
            </div>     
		</div>	
	
        <div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>  '>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">ტექსტი <?=$lnshortarr[$z] ?></label>

               <textarea id="ADTENG<?=$z ?>" tiny='1' ln='<?=$lnshortarr[$z] ?>' class='UPTS tnm' tp='' name='text' placeholder="TEXT <?=$lnshortarr[$z] ?>"><?=$dat["text".$lnshortarr[$z]] ?></textarea>
  
            </div>     
		</div>	
		<div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>  '>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">მოკლე აღწერა <?=$lnshortarr[$z] ?></label>

               <textarea id="ADTENG<?=$z ?>"  ln='<?=$lnshortarr[$z] ?>' class='UPTS' tp='' name='description'  style="width:100%" placeholder="SHORTTEXT <?=$lnshortarr[$z] ?>"><?=$dat["description".$lnshortarr[$z]] ?></textarea>
  
            </div>     
		</div>	
	     <div class='enebi' d='<?=$c ?>' style='<?=$langdefaultarr[$z]=='1'?"":"display:none" ?>  '>
           <div class="col-sm-12 pad-no-right pad-no-xs NOP">
               <label for="pdf">keywords <?=$lnshortarr[$z] ?></label>

               <input type="text" ln='<?=$lnshortarr[$z] ?>' class='UPTS' tp='' name='keywords'  style="width:100%" placeholder="keywords <?=$lnshortarr[$z] ?>" value="<?=$dat["keywords".$lnshortarr[$z]] ?>" />
  
            </div>     
		</div>	
		
	<?php
	   }
   ?>


            </div>
        </div>
        </div>

        <div class="submit my-4">
            <button  class="btn btn-success ADDITEMS" t='terms' d="<?=$dat['id'] ?>">დამახსოვრება</button>
        </div>
       </div>
    </div>
</div>

<script>
    $(function(){
        tinymce.init({
            relative_urls: false,
            selector: ".tnm",
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
            // setup : function(ed) {
            //     ed.on('change keyup', function(e) {
            //         func("updatetable","ptexts",$("#"+ed.id).attr("n"),ed.getContent(),$("#"+ed.id).attr("d"));
            //     });
            // },
            external_filemanager_path:"/admin/responsive_filemanager/filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "../../responsive_filemanager/filemanager/plugin.min.js"}
        });
    });
</script>
<script src="js/tinymce/tinymce.min.js"></script>