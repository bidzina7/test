<?php
  header("Content-type: text/xml");
?>
<?='<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->


<url>
  <loc>https://new.supta.ge</loc>
  <lastmod>2022-11-09T23:18:27+00:00</lastmod>
  <priority>1.00</priority>
</url>
<?php

   include("db_open.php");
   
   $sitemap=mysqli_query($con,"SELECT * FROM sitemap");
   while($rsitemap=mysqli_fetch_assoc($sitemap))
   {
	   ?>
	   <url>
	   <loc> <?=$rsitemap["name"] ?> </loc>
	   <lastmod><?=date("Y-m-d",$rsitemap["date"]) . ' '.date('H:i:s',$rsitemap["date"]) ?></lastmod>
	   <priority>1.00</priority>
	   </url>
	   <?php
   }


?>
</urlset>