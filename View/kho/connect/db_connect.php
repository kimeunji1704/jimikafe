<?php 
$con = mysqli_connect('localhost','root','', 'webshops');
//$mysqli -> set_charset('utf8');
if(mysqli_connect_errno())
{
	echo 'ConnectFailed: '.mysqli_connect_error();
	//exit;
}
?>