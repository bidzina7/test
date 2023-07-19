<!doctype html>
<html xmlns="https://www.w3.org/2012/xhtml" lang="ka">
	<head>
		<meta name="google-site-verification" content="<meta name="google-site-verification" content="g4DimXsv0vBSkzQSl3i7eQDlsgdo3u4cuCWgVdBTY7c" />
		<link rel="icon"type="image/x-icon"href=""/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		 <meta http-equiv="Access-Control-Allow-Origin" content="*"/>
		<title>Nbr.ge სამართავი პანელი</title>   
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-language" content="ka">
		<meta name="Author" content="Bidzina Tabidze">
		<meta property="og:title" content="nbr" />
		<meta property="og:description" content="" />
		<meta name="keywords" content=""/>
		<meta name="description" content="ონლაინ ბიზნეს შეფასება 24/7" />
		<meta name="author" content="" /> 
		<meta name="copyright" content="&copy;2016 Nbr.ge" />
		<meta name="robots" content="all" />
		<meta name="revisit-after" content="1 days" />
		<link rel="canonical" href=""/>
		<meta property="og:image" content="https://Nbr.ge/img/unnamed.jpg" />
		<meta property="og:type" content="website" />
		<meta property="fb:app_id" content="248744675578367" />
		<meta property="og:url" content="https://Nbr.ge/" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/style.css?v=7774"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

	</head>
	<body>

	
<nav class="navbar p-0 navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand pl-3" href="/admin/">Nbr</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
         <li class="nav-item dropdown L border-left">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          მაღაზია
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<?php  if(getpages($Guid,'products')==1){ ?><a class="dropdown-item" href="?page=products">Dashboard</a><?php }?>
<?php  if(getpages($Guid,'categories')==1){ ?><a class="dropdown-item" href="?page=categories">users</a><?php }?>
<?php  if(getpages($Guid,'categories')==1){ ?><a class="dropdown-item" href="?page=brands">გაყიდვები</a><?php }?>
<?php  if(getpages($Guid,'categories')==1){ ?><a class="dropdown-item" href="?page=filters">გაკვეთილები</a><?php }?>
<?php  if(getpages($Guid,'categories')==1){ ?><a class="dropdown-item" href="?page=clients">კურსები</a><?php }?>

        </div>
      </li>
   
 
   

	  


	  <?php  if(getpages($Guid,'users')==1){ ?><li class="L L4 nav-link <?=($PG=="users"?"active":"")?>"><a href="?page=users">users</a></li><?php }?>
<?php  if(getpages($Guid,'brands')==1){ ?><li class="L L4 nav-link <?=($PG=="partners"?"active":"")?>"><a href="?page=lessons">გაკვეთილები</a></li><?php }?>
<?php if(getpages($Guid,'users')==1){ ?><li class="L L4 nav-link <?=($PG=="categories"?"active":"")?>"><a href="?page=courses">კურსები</a></li><?php }?>
<?php if(getpages($Guid,'allorders')==1){ ?><li class="L L4 nav-link <?=($PG=="allorders"?"active":"")?>"><a  href="?page=allorders">ტესტები</a></li><?php }?>
<?php if(getpages($Guid,'allorders')==1){ ?><li class="L L4 nav-link <?=($PG=="posts"?"active":"")?>"><a  href="?page=posts">Blog Posts</a></li><?php }?>
   
<?php  if(getpages($Guid,'posts')==1){ ?><li class="L L4 nav-link <?=($PG=="newses"?"active":"")?>"><a href="?page=newses">ნიუსები</a></li><?php }?>

<?php  if(getpages($Guid,'brands')==1){ ?><li class="L L4 nav-link <?=($PG=="partners"?"active":"")?>"><a href="?page=partners">partners</a></li><?php }?>
<?php if(getpages($Guid,'users')==1){ ?><li class="L L4 nav-link <?=($PG=="categories"?"active":"")?>"><a href="?page=categories">testimonials</a></li><?php }?>
<li class="L L4 nav-link <?=($PG=="slider"?"active":"")?>" ><a href="?page=slider">შესახებ</a></li>
<li class="L L4 nav-link <?=($PG=="slider"?"active":"")?>" ><a href="?page=slider">FAQ</a></li>

<?php if(getpages($Guid,'users')==1){ ?><li class="L L4 nav-link <?=($PG=="admins"?"active":"")?>"><a href="?page=admins">ადმინები</a></li><?php }?>
<li class="nav-item dropdown L">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Seo
        </a>
		  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<?php if(getpages($Guid,'settings')==1){ ?> <a class="dropdown-item"  href="?page=seohome">seohome</a><?php }?>
<?php  if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=seocontact">seocontact</a><?php }?>
<?php  if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=seocart">seocart</a><?php }?>
<?php  if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=seocheckout">seocheckout</a><?php }?>
<?php  if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=seosignin">seosignin</a><?php }?>
<?php  if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=seoregisterindividual">seoregisterindividual</a><?php }?>

</div>
</li>






<li class="nav-item dropdown L">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         პარამეტრები
        </a>
		  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<?php if(getpages($Guid,'settings')==1){ ?> <a class="dropdown-item"  href="?page=terms">terms</a><?php }?>
<?php if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=languages">ენები</a><?php }?>
<?php if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=aboutus">ჩვენს შესახებ</a><?php }?>
<?php if(getpages($Guid,'settings')==1){ ?> <a  class="dropdown-item"  href="?page=contuct">კონტაკტები</a><?php }?>

</div>
</li>
    </ul>
    <a href="" class="form-inline my-2 my-lg-0">
       <button class="btn btn-outline-success my-2 my-sm-0 d-none" type="submit">CP</button>
    </a>	
    &nbsp;&nbsp;&nbsp;<button class="btn btn-default my-2 my-sm-0 LGT" ><i class="fa fa-sign-out"></i></button>	
  </div>
</nav>	


