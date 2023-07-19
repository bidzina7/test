<?php
if(isset($_SESSION['uid'])){
  mysqli_query($con,"UPDATE protocol SET archived='1' ");
  echo "შენახულია";
}
?>