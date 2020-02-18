<?php 
session_start();?>
<?php
if(isset($_SESSION['u_id']))
{
	$val = $_SESSION['u_id'];
?>

<!DOCTYPE html>
<html>
<head>
<style>

	
	body .qr_code {
		width: 250px;
		height: 250px;
		margin-top: 100px;	
	}
	
</style>
</head>
<body><center>
<img class="qr_code" src="<?php echo "http://api.qrserver.com/v1/create-qr-code/?size=100x100&data=".$val.""; ?> ">
</center>
</body>
</html>

<?php
}
?>