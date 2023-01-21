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
    <link href="../css/css-message.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../images/logoindex.jpg" type="">

</head>

</html>
<?php
session_start();
include('../admin/includes/config.php');

if (isset($_POST['login_btn_kh'])) {
    $email = $_POST['email'];
    $matkhau = $_POST['password'];
    $sql1 = "SELECT * FROM khach_hang WHERE email_kh='" . $email . "' AND password_kh='" . $matkhau . "' LIMIT 1 ";
    $row1 = mysqli_query($mysqli, $sql1);
    $count = mysqli_num_rows($row1);

    if ($count > 0) {
        $row_data = mysqli_fetch_array($row1);
        $_SESSION['dangnhap1'] = $row_data;
        $_SESSION['id_kh'] = $row_data['id_kh'];
        $_SESSION['email'] = $row_data['email_kh'];
        $_SESSION['message_kh'] = 'Đăng nhập thành công';
        header("Location:../index.php");
    } else {
        $_SESSION['dangnhap1'] = "Đăng nhập thất bại";
        $_SESSION['id_kh'] = "error";
        header("Location:login.php");
    }
}
?>
<?php
if (isset($_SESSION['message_duyet_pass'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['message_duyet_pass']; ?></strong>
                <p class="toast1__msg"></p>
            </div>

            <div class="toast1__close " class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            let toRemove = document.querySelector("#toast1");
            toRemove.remove();
        }
    </script>
<?php
    unset($_SESSION['message_duyet_pass']);
}
?>

</html>
<div class="container" style="max-width: 80%;">
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
                                    <h1 class="h4 text-gray-900 mb-4" style=" font-weight: 500;">ĐĂNG NHẬP</h1>
                                </div>
                                <br>
                                <form class="user" action="" method="POST" onsubmit="return testsignin()">
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <input type="text" name="email" id="email" class="form-control form-control-user" placeholder="Vui lòng nhập Email...">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <span id="checkname" style="color: blue;font-size: 95%;"></span>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <input type="password" id="passw" name="password" class="form-control form-control-user" placeholder="Vui lòng nhập mật khẩu...">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <span id="checkpass1" style="color: blue;font-size: 95%;"></span>
                                    </div>
                                    <!-- <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Đăng nhập</button> -->
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <span><a href="forgot.php" style="padding-left: 265px;text-decoration: none;color:#222831">Bạn quên mật khẩu ?</a> </span>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0.5rem;">
                                        <input type="submit" style="background-color: #222831;border: #222831;" class="btn btn-primary btn-user btn-block" name="login_btn_kh" value="Đăng nhập" />
                                    </div>
                                    <br><br><br>
                                    <div style="text-align: center;">
                                        <h6>Bạn chưa có tài khoản ?</h6>
                                        <a href="register.php" style="font-weight: 500;text-decoration: none;color:#222831">ĐĂNG KÝ NGAY</a>
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

    function testsignin() {

        var name = document.getElementById("email").value;
        var pass = document.getElementById("passw").value;
        var passdk = /^[A-Za-z0-9]{6,15}$/;
        if (name == '') {
            document.getElementById("checkname").innerHTML = "*Tên đăng nhập trống, vui lòng nhập tên đăng nhập";
            document.getElementById("checkname").classList.add('check');
            check = false;
        } else {

            document.getElementById("checkname").innerHTML = "";

        }

        if (pass == '') {

            document.getElementById("checkpass1").innerHTML = "*Mật khẩu trống, vui lòng nhập mật khẩu";
            document.getElementById("checkpass1").classList.add('check');
            check = false;
        } else {

            document.getElementById("checkpass1").innerHTML = "";
            if (!passdk.test(pass)) {
                document.getElementById("checkpass1").innerHTML = "*Sai cú pháp, vui lòng nhập lại";
                document.getElementById("checkpass1").classList.add('check');
                check = false;
            } else {
                document.getElementById("checkname").innerHTML = "";
            }
        }

        return check;
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