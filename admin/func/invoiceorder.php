<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
date_default_timezone_set("Asia/Tbilisi");
		include("/home/admin/domains/buyzone.ge/public_html/db_open.php");
mysqli_set_charset($con,"utf8");
$invoice=mysqli_real_escape_string($con,$_GET["invoice"]);
$mid=substr($invoice,6,2);

$q2=mysqli_query($con,"SELECT * FROM aboutmerchant as t1 ");
$r2=mysqli_fetch_array($q2);	
$q3=mysqli_query($con,"SELECT * FROM orders as t1 WHERE invoice='$invoice'");
$r3=mysqli_fetch_array($q3);	
$q4=mysqli_query($con,"SELECT * FROM users as t1 WHERE id='".$r3["userid"]."'");
$r4=mysqli_fetch_array($q4);	
	$html = '
	<div style="display:inline-block;"><h1>შპს ჩვენები</h1><img style="width:100px" src="/img/logo.png" /><br><br><br><br>
	Address: წერეთლის 97<br>
	Telephone: +995599339099<br>
	Website: https://chvenebi.ge<br>
	Email: info@chvenebi.ge<br>
	Companyid: 404596148
	</div>

	<div style="position:absolute;right:70px;top:200px;width:200px;"><strong>Sold To:</strong><br>';
if($r3["contragent"]){
	$html .= 'Name: '.$r3["contragent"].'<br>
	Details: '.$r3["details"].'<br>';
}else{
	$html .= '

	Personal Id: '.$r4["personalid"].'<br>';
	
	$html .= 'Email: '.$r4["email"].'<br>
	Address: '.$r4["address"].'<br>
	Tel: '.$r4["tel"].'';	
}

	
	$html .= '</div>
	<br>
	<div style="position:absolute;right:70px;top:70px;">Invoice No. <strong>'.$invoice.'</strong></div>
		<br><br>
		<br><br>
	<table width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
		<thead>
			<tr>

				<th>Product #</th>
				<th>Product</th>
				<th>Barcode</th>				
				<th>Option</th>
				<th>Quantity</th>
				<th>Price</th>

			</tr>
		</thead>
		<tbody>
		';


	$q1=mysqli_query($con,"SELECT t1.* FROM orderproducts as t1
	WHERE t1.orderid='".$r3["id"]."' ");
	$rows=mysqli_fetch_all($q1,MYSQLI_ASSOC);
	$uid="1";
$total=0;
	foreach($rows as $r1){
		$total=$total+($r1["salesprice"]*$r1["quantity"]);
		$html=$html.'<tr>
<td>'.$r1["productid"].'</td>
<td>'.$r1["item"].'</td>
<td>'.$r1["barcode"].'</td>
<td></td>
<td>'.$r1["quantity"].'</td>
<td>'.number_format($r1["salesprice"],2).' GEL</td>
		</tr>';
			
	}

		

	
		
		$html=$html.'</tbody>
	</table><br>
		<br>
		<br>
		<br>
		<br>
	<div style="float:left;top:300px;width:250px">
	<strong>საბანკო რეკვიზიტები</strong><br>
	BANK: JSC TBC Bank<br>
	IBAN: GE12TB7565836080100009
	</div>
	<div style="float:right;top:300px;width:200px">
	Transportation: '.(number_format($r3["shipping"],2)).' '.($r3['shiptype']==0?' GEL':' %').' <br>
	<strong>Total</strong>: '.(number_format($r3["shipping"]+$total,2)).' GEL <br>
		<br>
		<br>
		<br>
		<br>
		<strong>თარიღი</strong>: '.$r3["date"].'
	<style>
		td{
			text-align:center;
		}
		table {
			border: 0.1mm solid #000000;
		}
		td,tr,th {
			border: 0.1mm solid #000000;
		}
	</style>
	';	




	//==============================================================
	//==============================================================
	//==============================================================

require_once '/home/admin/domains/webdoors.ge/public_html/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['tempDir' => '/home/admin/domains/webdoors.ge/public_html/partners/wishlist/tmp']);
$mpdf->allow_charset_conversion = true;
$mpdf->charset_in = 'utf-8';
	// $mpdf=new mPDF('utf-8'); 

	$mpdf->SetDisplayMode('fullpage');

	// LOAD a stylesheet
	$stylesheet = file_get_contents('/var/www/lightspeed.ge/merchant/css/mpdfstyleA4.css');
	$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

	$mpdf->WriteHTML($html);

	$mpdf->Output();

	exit;
	//==============================================================
	//==============================================================
	//==============================================================*/

		include("/home/admin/domains/buyzone.ge/db_close.php");
?>