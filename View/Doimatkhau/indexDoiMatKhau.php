<?php
session_start();
if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
}
else{
    
}
    include_once('..\admin\Header.php');
    include_once('..\admin\Sidebar.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>JIMI KAFE</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css\cssCreate.css">
    <link href="css/font-face.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all"/>
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all"/>
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all"  />
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all" />
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all" />
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all" />
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all" />
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all" />
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all" />
    <link href="css/theme.css" rel="stylesheet" media="all" />
    <meta name="robots" content="index, nofollow" />
</head>
<style>
    .textfiel {
            border: 1px solid #d7e1eb;
            padding-left: 2px;
            width: 294px;
            height: 32px;
            margin-bottom: 20px;
            margin-left: 30px;
        }
    .message{
        color: red;
        margin-left: 450px;
    }
    .content{
            margin-top: 77px;
            margin-left: 300px;
        }
</style>
<body>
    <div class="content" >
        <form method="post">
            <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;">
                <h3 style="color: #000000; display: inline-block; font-size: 35px;">Đổi mật khẩu</h3>
            </div>
            <div class = input-text;>
                <label for="password">Mật khẩu hiện tại:</label>
                <input type="password" name="currentPassword" class="textfiel" id="currentPassword">
            </div>
            <div class = input-text;>
                <label for="newPassword">Mật khẩu mới:</label>
                <input type="password" name="newPassword" class="textfiel" id="newPassword">
            </div>
            <div class = input-text;>
                <label for="confirmPassword">Xác nhận mật khẩu:</label>
                <input type="password" name="confirmPassword" class="textfiel" id="confirmPassword">
            </div>
            <div class = input-text;>
                <button type="submit" name="submit" class="btn btn-outline-success" style = "margin-left: 350px;
            margin-top: 10px; ">Đổi mật khẩu</button>
        </form>
    </div>
    <?php     
        function UpdateData(){
                $conn=mysqli_connect("localhost","root","","jimikafe");
                if($conn==false){
                    die("Connect fail:". mysqli_connect_error($conn));
                }
                else{
                    $currentPassword1 = $_POST["currentPassword"];
                    $newPassword1 = $_POST["newPassword"];
                    $queryCheck = "SELECT password from accounts where username = '".$_SESSION['username']."' and password = '".$currentPassword1."' ";
                    $resultCheck = mysqli_query($conn,$queryCheck);
                    if(mysqli_num_rows($resultCheck)>0){
                        $query = "UPDATE accounts 
                        SET password ='".$newPassword1."'    
                        WHERE username= '".$_SESSION['username']."'";
                        $result = mysqli_query($conn,$query);
                        if($result==true){
                            echo "<script> 
                            alert('Đổi mật khẩu thành công, vui lòng đăng nhập lại!');
                            window.open('../Login/login.php','_self');
                          </script>";
                        }
                        else{
                            echo "Lỗi ghi dữ liệu" . mysqli_error($conn);
                        }
                    }
                    else{
                        echo '<h class="message"">Mật khẩu hiện tại chưa chính xác. Yêu cầu nhập lại!</h>';
                    }
                    }
                }

                if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit'])){
                    $currentPassword = $_POST["currentPassword"];
                    $newPassword = $_POST["newPassword"];
                    $confirmPassword = $_POST["confirmPassword"];
                    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                        echo '<h class="message"> Vui lòng điền đầy đủ thông tin </h>';
                      } else if ($newPassword != $confirmPassword) {
                        echo '<h class="message"">Mật khẩu xác nhận chưa đúng</h>';
                      } else {
                              UpdateData();}
                }
            ?>
</body>
</html>