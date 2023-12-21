<?php
  session_start();
  if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
  }else{
    ;
  }
  $conn = mysqli_connect("localhost","root","", "jimikafe");
  if(!$conn){
    die("Kết nối thất bại: " .mysqli_connect_errno());
  }
  $name="";
  $conn = mysqli_connect("localhost","root","", "jimikafe");
  if($conn == false){
    die("Kết nối thất bại: " .mysqli_connect_errno());
  }else{
    $query = "SELECT employees.name  
              FROM employees
              JOIN accounts ON accounts.employee_id = employees.id
              WHERE username = '".$_SESSION['username']."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
      while ($row = mysqli_fetch_assoc($result)){
        $name = $row["name"];
      }
    }else{
      echo"Không có dữ liệu!";
    }
  }
  mysqli_close(($conn));
?>
<header class="header-desktop">
          <div style="top:-20%" class="section__content section__content--p30">
            <div class="container-fluid">
              <div class="header-wrap" style="display: flex; justify-content: flex-end;">
                <div class="header-button">
                  <div class="account-wrap">
                    <div class="account-item clearfix js-item-menu">
                      <div class="content" style="height: 50px;">
                        <a class="js-acc-btn" name ="name" href="#">
                          <?php echo isset ($_POST['name']) ? $_POST['name']:$name ?>
                        </a>
                      </div>
                      <div class="account-dropdown js-dropdown">
                        <!--<div class="info clearfix">
                          <div class="content">
                            <h5 class="name">
                              <a href="#">User</a>
                            </h5>
                          </div>
                        </div>-->
                        <div class="account-dropdown__body">
                          <div class="account-dropdown__item">
                            <a href="../TTCN/indexTTCN.php">
                              <i class="fas fa-user"></i>Thông tin tài khoản
                            </a>
                          </div>
                          <div class="account-dropdown__item">
                            <a href="../Doimatkhau/indexDoiMatKhau.php">
                              <i class="fas fa-cogs"></i>Đổi mật khẩu
                            </a>
                          </div>
                        </div>
                        <div class="account-dropdown__footer">
                          <a href="..\Login\logout.php">
                            <i class="fas fa-power-off"></i>Đăng xuất
                          </a>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-lF5COB2I63edk8r1cWm3oVBY3ynGVLlSMwzKh+VLOI4uCYMP6p6AR2Sxr51TA5vX" crossorigin="anonymous">