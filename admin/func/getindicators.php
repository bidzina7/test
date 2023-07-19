<?php
$id=(int)$_POST['id'];
$d=(int)$_POST['d'];
$product=mysqli_real_escape_string($con,$_POST['product']);

$fld1=mysqli_query($con,"SELECT t1.*, (SELECT 1  FROM protometa WHERE fieldid=t1.id AND pid='$id') AS chk,
				                          (SELECT columnValue FROM langs WHERE tableName='protofields ' AND  tableId=t1.id AND tableColumn='name' AND shortname='ka' ) AS nameka     FROM protofields AS t1 WHERE t1.parents='".$d."'
										    AND t1.product LIKE '%".$product."%' ");
                  
				         while($rfld1=mysqli_fetch_assoc($fld1))
						 {
				  ?>
                            <li>
                                
                                   <input type='checkbox' class="parchild parcheck" <?=$rfld1["chk"]==1?"checked":"" ?> pid='<?=$id ?>' par="<?=$d ?>" d="<?=$rfld1["id"] ?>"  name="fieldid"/> <?=$rfld1["nameka"] ?> 
                               
                            </li>
                    <?php
						 } 
                     ?>						 
                           