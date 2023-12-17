
<?php
function tinhSoNgayCong($ngayBatDau, $ngayKetThuc) {
  $ngayBatDau = new DateTime($ngayBatDau);
  $ngayKetThuc = new DateTime($ngayKetThuc);

  $ngayCong = 0;
  while ($ngayBatDau <= $ngayKetThuc) {
    $weekday = $ngayBatDau->format('w');

    if ($weekday != 0 && $weekday != 6) { // Không tính ngày nghỉ cuối tuần (Thứ 7 và Chủ nhật)
      $ngayCong++;
    }

    $ngayBatDau->modify('+1 day');
  }

  return $ngayCong;
}

$ngayBatDau = '2023-01-01';
$ngayKetThuc = '2023-12-31';

$soNgayCong = tinhSoNgayCong($ngayBatDau, $ngayKetThuc);
echo "Tổng số ngày công trong năm: " . $soNgayCong;
?>
