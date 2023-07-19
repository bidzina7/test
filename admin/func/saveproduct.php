<?php
if(isset($_SESSION['GuserID'])){
	$productid=mysqli_real_escape_string($con,$_POST["productid"]);
	$ITEM=mysqli_real_escape_string($con,$_POST["ITEM"]);
	$BARCODE=mysqli_real_escape_string($con,$_POST["BARCODE"]);
	$PRICE=mysqli_real_escape_string($con,$_POST["PRICE"]);
	$salesprice=mysqli_real_escape_string($con,$_POST["salesprice"]);
	$img=mysqli_real_escape_string($con,$_POST["img"]);
	$DESCRIPTION=mysqli_real_escape_string($con,$_POST["DESCRIPTION"]);
	$smalldesc=mysqli_real_escape_string($con,$_POST["smalldesc"]);
	$category=mysqli_real_escape_string($con,$_POST["category"]??"");
	$keywords=mysqli_real_escape_string($con,$_POST["keywords"]);
	$titlege=mysqli_real_escape_string($con,$_POST["titlege"]);
	$slug=mysqli_real_escape_string($con,$_POST["slug"]);
	if($slug==""){
		$slug=geotoeng($ITEM);		
	}
	// echo $slug;
	$q1=mysqli_query($con,"SELECT slug FROM products WHERE id='".$productid."'");
	$r1=mysqli_fetch_array($q1);
	if($r1["slug"]==""){
	////sitemap
	$content = file_get_contents("/home/admin/domains/chqara.com/public_html/sitemap.xml");
	$sitemap = simplexml_load_string($content);
	$myNewUri = $sitemap->addChild("url");
	$myNewUri->addChild("loc", "https://chqara.com/ka/product/".$productid."/".$slug);
	// $myNewUri->addChild("lastmod", date("DATE_W3C"));
	$myNewUri->addChild("changefreq", "daily");
	$myNewUri->addChild("priority", "0.51");
	$sitemap->asXml("/home/admin/domains/chqara.com/public_html/sitemap.xml");
	////	
	}	

	mysqli_query($con,"UPDATE products SET ITEM='".$ITEM."',titlege='".$titlege."',BARCODE='".$BARCODE."',PRICE='".$PRICE."',salesprice='".$salesprice."',img='".$img."',DESCRIPTION='".$DESCRIPTION."',smalldesc='".$smalldesc."',category='".$category."',keywords='".$keywords."',titlege='".$titlege."',slug='".$slug."' WHERE id='".$productid."' ");

	
	include("imagewatermarks.php");	
	echo 1;
}
function geotoeng($word){
	$alpha = array("ა"=>'a',"ბ"=>'b',"ც"=>'c',"დ"=>'d',"ე"=>'e',"ფ"=>'f',"გ"=>'g',"ჰ"=>'h',"ი"=>'i','j',"კ"=>'k',"ლ"=>'l',"მ"=>'m',"ნ"=>'n',"ო"=>'o',"პ"=>'p',"ქ"=>'q',"რ"=>'r',"ს"=>'s',"თ"=>'t',"უ"=>'u',"ვ"=>'v','w','x',"ყ"=>'y',"ზ"=>'z',"ჟ"=>"zh","ტ"=>"t","ხ"=>"kh","შ"=>"sh","ღ"=>"gh","ჯ"=>"j","ძ"=>"dz","წ"=>"ts","ჭ"=>"ch","ჩ"=>"ch","a"=>"a","b"=>"b","c"=>"c","d"=>"d","e"=>"e","f"=>"f","g"=>"g","h"=>"h","i"=>"i","j"=>"j","k"=>"k","l"=>"l","m"=>"m","n"=>"n","o"=>"o","p"=>"p","q"=>"q","r"=>"r","s"=>"s","t"=>"t","u"=>"u","v"=>"v","w"=>"w","x"=>"x","y"=>"y","z"=>"z","-"=>"-","0"=>"0","1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9");
	$word=str_replace(" ","-",$word);
	$word = preg_split('//u', $word);
	foreach($word as $key=>$value){
		if(array_key_exists(strtolower($value),$alpha)){
			$newF[$key]=$alpha[strtolower($value)];
		}
	}
	$newW=implode("",$newF);
	return $newW;	
}
?>