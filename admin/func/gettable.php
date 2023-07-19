<option value=''>აირჩიეთ პროდუქტი/მასალა</option>
<?php
   $prd=mysqli_query($con,"SELECT t1.*, 
				                        (SELECT columnValue FROM langs WHERE tableName='products ' AND  tableId=t1.id AND tableColumn='name' AND shortname='ka' ) AS nameka   FROM products AS t1");
				                       while($rprd=mysqli_fetch_assoc($prd))
				                     {
				                    ?>
				                          <option  newval='<?=$rprd['nameka'] ?>' value='<?=$rprd['id'] ?>'  value='<?=$rprd['id'] ?>' ><?=$rprd['nameka'] ?></option>
				                   <?php
				                     } 
                                    

?>