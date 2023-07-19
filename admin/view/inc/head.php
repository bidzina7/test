<?php


//'home/admin/domains/webdoors.ge/public_html/partners/NBR/' 
?>
 <?php
   $adm=mysqli_query($con,"SELECT t1.*,(SELECT name FROM adminTypes WHERE  id=t1.type) AS tpname FROM admins AS t1 WHERE t1.id='$Guid'");
   $radm=mysqli_fetch_assoc($adm);
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=$BASE ?>"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nbr Admin</title>
      
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> 
    <link rel="icon" href="img/.png" size="100%">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="css/style.css?v=1.0.1671203826">
		
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        
</head>
<body lang="en" class="">
<div id='loader' class='row d-none'>
 <div class='loadcont row'>
   <div class="d-flex justify-content-center d-none loadspin pb-4">
     <div class="spinner-border text-success "  style="width: 5rem; height: 5rem; display:block;"  role="status">
       
     </div>
	 
	        
   </div>
   <div class="d-flex justify-content-center loadtext text-success ...">
       გთხოვთ დაელოდოთ...
   </div>
 </div>
 </div> 

	
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	   

       <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	       

	
    <div id="snackbar"></div>
	</body>
</html>