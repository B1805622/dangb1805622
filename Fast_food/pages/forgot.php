<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../js/sweetalert.min.js"></script>
    <title>Đăng nhập</title>
    <link href="../admin/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

</head>


<?php
session_start();
include('../admin/includes/config.php');
include('../mail/sendmail.php');
if (isset($_POST['quenpass'])) {
    $email = $_POST['email'];
    $sql1 = "SELECT * FROM khach_hang WHERE email_kh=  '" . $email . "'";
    $qurey = mysqli_query($mysqli, $sql1);
    $row1 = mysqli_fetch_array($qurey);
    $ten_kh = $row1['ten_kh'];
    $pass = $row1['password_kh'];
    $email1 = $row1['email_kh'];
    if ($sql1) {
        $tieude = "Cấp lại mật khẩu";
        $noidung = "<h4>Chào: <span style='color:blue'>" . $ten_kh . "</span>,</h4>";
        $noidung .= "<p>Bạn đã yêu cầu cấp lại mật khẩu truy cập website đặt thức ăn nhanh <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a></p>";
        $noidung .= "<h2><span style='color:black'>" . $pass . "</span></h2>";
        $noidung .= "<p>Mọi thắc mắc xin liên hệ website tại <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a>, Hoặc liên hệ SĐT: 0973751311. Xin cảm ơn quý khách.</p>";
        $maildathang = $email1;
        $mail = new Mailerxacnhan();
        $mail->xacnhandon($tieude, $noidung, $maildathang);
    }
    $_SESSION['message_duyet_pass'] = 'Mật khẩu đã được gửi đến email.';
    header("Location:login.php");
}
?>


<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">QUÊN MẬT KHẨU</h1>
                                </div>
                                <br>
                                <form class="user" action="" method="POST" autocomplete="off" onsubmit="return testsignin()">
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <input type="text" name="email" id="email" class="form-control form-control-user" placeholder="Vui lòng nhập Email..." onchange="kiemtratrung(this.value)">
                                    </div>
                                    <div class=" form-group" style="margin-bottom: 0.5rem;">
                                        <span id="checkname" style="color: red;font-size: 95%;"></span>
                                    </div>
                                    <br>
                                    <!-- <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Đăng nhập</button> -->
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="quenpass" value="Quên mật khẩu" />
                                    </div>
                                    <br><br><br>
                                    <div style="text-align: center;">
                                        <h6>Bạn chưa có tài khoản ?</h6>
                                        <a href="register.php" style="font-weight: 500;text-decoration: none">ĐĂNG KÝ NGAY</a>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var check = true;

    function kiemtratrung(str) {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("checkname").innerHTML = this.responseText;
                if (xmlhttp.responseText == "*Email hợp lệ.") {
                    check = true;
                } else {
                    check = false;
                }
            }
        }
        xmlhttp.open("GET", "kiemtratrung.php?d1=" + str, true);
        xmlhttp.send();
    }
</script>

</html>

<?php
if (isset($_SESSION['dangnhap1']) && $_SESSION['id_kh'] != '') {
?>
    <script>
        swal({
            title: "<?php echo $_SESSION['dangnhap1']; ?>",
            // text: "You clicked the button!"
            icon: "<?php echo $_SESSION['id_kh']; ?>",
            button: "Thoát!",
        });
    </script>
<?php
    unset($_SESSION['status']);
}

?>