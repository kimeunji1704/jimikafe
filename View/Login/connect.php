<?php
$connect = mysqli_connect ('localhost', 'root', '', 'jimikafe') or die ('Không thể kết nối tới database');
if($connect === false){ 
die("ERROR: Could not connect. " . mysqli_connect_error()); 
}
else {
echo 'Kết nối DB thành công!';
}
?>