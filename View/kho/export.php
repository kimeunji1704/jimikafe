<?php
//require('Classes/PHPExcel.php');
require_once('./connect/db_connect.php');

header("Content-Disposition: attachment; filename= 'kho_excel.xlsx'");
header("Content-Type: application/vnd.ms-excel");

function data($str)
{
	$str = preg_replace("/\t/", "\\t", $str);
	$str = preg_replace("/\r?\n/", "\\n", $str);

	if(strstr($str,'"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

//$filename = "Kho_" . date('Y-m-d') . ".xlsx";
$field = array('MaMH', 'Soluong', 'MaNCC', 'NgayNhap', 'GiaNhap');
$exceldata = implode("\t", array_values($field)) . "\n";

$post_list = array();
 $query = "SELECT * from kho  order by MaMH asc";
 $result = mysqli_query($con, $query);
 $MaMH = 1;
 echo $exceldata;
 if (mysqli_num_rows($result) > 0 ) {
 while ($row = mysqli_fetch_assoc($result)) {
 	$post_list[] = array("MaMH" =>$MaMH, "Soluong"=>$row["Soluong"], "MaNCC"=>$row["MaNCC"], "NgayNhap"=>$row["NgayNhap"], "GiaNhap"=>$row["GiaNhap"]);
 	$MaMH++;
 }
}

$title = false;
foreach ($post_list as $post) {
	if($title){
		echo implode("\t", array_keys($post)) . "\n";
		$title = true;
	}
	array_walk($post, 'data');
	echo implode("\t", array_values($post)) . "\n";
}
exit;
?>
