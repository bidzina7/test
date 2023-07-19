<!DOCTYPE html>
<html>
<head>
<charset='utf-8'>
</head>
<body>
<form method='get'>
<input type='text' name='a'>
<input type='submit' name='b'>
</form>
<?php
if (isset($_GET['b']))
{
	echo $_GET['a'];
	
}
?>
</body>
</html>