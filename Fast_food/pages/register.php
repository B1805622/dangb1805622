<?php
session_start();
include('../admin/includes/config.php');

if (isset($_POST['kt_submit'])) {
    $hoten = $_POST['fname'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $tp = $_POST['id_tp'];
    $qh = $_POST['id_qh'];
    $px = $_POST['id_px'];
    $sql_diachixa = "SELECT * FROM `devvn_xaphuongthitran` WHERE idxa=$px";
    $query_diachixa = mysqli_query($mysqli, $sql_diachixa);
    $row_dcxa = mysqli_fetch_array($query_diachixa);
    $xa = $row_dcxa['Ten_xp'];
    $sql_diachiquan = "SELECT * FROM `devvn_quanhuyen` WHERE idqh=$qh";
    $query_diachiquan = mysqli_query($mysqli, $sql_diachiquan);
    $row_dcquan = mysqli_fetch_array($query_diachiquan);
    $quan = $row_dcquan['Ten_qh'];
    $sql_diachitinh = "SELECT * FROM `devvn_tinhthanhpho` WHERE idtp=$tp";
    $query_diachitinh = mysqli_query($mysqli, $sql_diachitinh);
    $row_dctinh = mysqli_fetch_array($query_diachitinh);
    $tinh = $row_dctinh['Ten_tp'];
    $diachigoc = $diachi . ',' . $xa . ',' . $quan . ',' . $tinh;
    // echo $diachigoc;
    $matkhau = $_POST['pass'];
    $matkhau2 = $_POST['repass'];
    $gioitinh = $_POST['gender'];
    $check = "SELECT * FROM khach_hang WHERE email_kh='$email'";

    // echo'<p>'.$check.'</p>';

    // $password = md5($matkhau, false);
    $sql_dangky =  "INSERT INTO khach_hang(ten_kh,gioi_tinh,dia_chi_kh,sdt_kh,email_kh,password_kh,trang_thai_tk) VALUE ('" . $hoten . "','" . $gioitinh . "','" . $diachigoc . "','" . $sdt . "','" . $email . "','" . $matkhau . "',1)";
    mysqli_query($mysqli, $sql_dangky);
    if ($sql_dangky) {
        echo '<script>alert("Đăng ký thành công")</script>';
        $_SESSION['dangky'] = $hoten;
        $_SESSION['email'] = $email;
        $_SESSION['id_kh'] = mysqli_insert_id($mysqli);
        $_SESSION['message_kh'] = 'Đăng ký thành công';
        header('Location:../index.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/register.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
    <link href="../admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/logoindex.jpg" type="">
    <title>Đăng ký</title>
</head>

<body>

    <div class="container" >
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <!-- <div class="col-xl-6 col-lg-6 col-md-6"> -->
            <div class="card o-hidden border-0 shadow-lg my-5" style="top: -22px;height: auto;">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center" style="margin-top: -27px;">
                                    <h1 class="h4 text-gray-900 mb-4" style=" font-weight: 500;">ĐĂNG KÝ</h1>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" onsubmit="return testsignup()">
                                    <div class="form-row" style="padding-bottom: 4px;">
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Tên&nbsp;khách&nbsp;hàng</label>
                                            <input type="text" id="username" class="form-control" name="fname" placeholder="Họ và tên">
                                            <span id="checkname" style="color: blue;font-size: 95%;"></span>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="inputPassword4">Số&nbsp;điện&nbsp;thoại</label>
                                            <input type="text" class="form-control" name="sdt" id="sdt" placeholder="Số điện thoại">
                                            <span id="checksdt" style="color: blue;font-size: 95%;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Địa chỉ email">
                                    </div>
                                    <span id="checkmail" style="color: blue;font-size: 95%;"></span>
                                    <div class="form-group">
                                        <label for="inputPassword4">Giới&nbsp;tính</label>
                                        <div class="form-group ">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="Nam" checked="checked">
                                                <label class="custom-control-label" for="customRadioInline1">Nam</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="Nữ">
                                                <label class="custom-control-label" for="customRadioInline2">Nữ</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline3" name="gender" class="custom-control-input" value="khác">
                                                <label class="custom-control-label" for="customRadioInline3">Khác</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="inputAddress2">Địa&nbsp;chỉ</label>
                                        <input type="text" class="form-control dc" id="diachi" name="diachi" placeholder="Địa chỉ của bạn">
                                    </div>
                                    <span id="checkdiachi" style="color: blue;font-size: 95%;"></span>
                                    <?php
                                    $sql_thanhpho = "SELECT * FROM devvn_tinhthanhpho where idtp=92 ORDER BY Ten_tp ASC";
                                    $query_thanhpho = mysqli_query($mysqli, $sql_thanhpho);
                                    $row_tp = mysqli_fetch_array($query_thanhpho);
                                    ?>
                                    <div class="form-group" style="margin-bottom: 5px;display: none;" id="tinhtp">
                                        <label for=" inputPassword4">Tỉnh/thành&nbsp;phố</label>
                                        <!-- <input type="text" class="form-control " id="tinhtp" value="<?php echo $row_tp['Ten_tp'] ?>" placeholder="Địa chỉ của bạn" readonly> -->
                                        <select name="id_tp" style="width: 100%" class="form-control city" id="select">
                                            <option selected>Tỉnh thành phố</option>
                                            <?php

                                            ?>
                                            <option value="<?php echo $row_tp['idtp'] ?>"><?php echo $row_tp['Ten_tp'] ?></option>
                                            <?php

                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group qh" style="margin-bottom: 5px;display: none;">
                                        <label>Quận/huyện</label>
                                        <select name="id_qh" style="width: 100%" class="form-control quan" id="select">
                                            <option>Quận/huyện</option>
                                        </select>
                                    </div>

                                    <div class="form-group px" style="margin-bottom: 5px;display: none;">

                                        <label>Phường/xã</label>
                                        <select name="id_px" style="width: 100%" class="form-control xa" id="select">
                                            <option selected>Phường xã</option>
                                        </select>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="inputPassword4">Mật&nbsp;khẩu</label>
                                        <input type="password" class="form-control" name="pass" placeholder="Mật khẩu">
                                    </div>
                                    <span id="checkpass1" style="color: blue;font-size: 95%;" class="check"></span>
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="inputPassword4">Nhập&nbsp;lại&nbsp;mật&nbsp;khẩu</label>
                                        <input type="password" id="password1" class="form-control" name="repass" placeholder="Nhập lại mật khẩu">
                                    </div>
                                    <span id="checkpass2" style="color: blue;font-size: 95%;" class="check"></span>
                                    <div style="padding-left:273px;margin-top: 20px;">
                                        <input type="reset" class="btn btn-primary" value="Làm lại" style="background-color: #222831;border: #222831;">
                                        <input type="submit" id="password2" class="btn btn-primary" name="kt_submit" value="Đăng ký" style="background-color: #222831;border: #222831;">
                                    </div>
                                </form>
                                <div style="padding-top: 30px;padding-left: 129px;">
                                    <h6>Bạn đã có tài khoản ?</h6>
                                    <a href="login.php" style="font-weight: 500;text-decoration: none;color: #222831;">ĐĂNG NHẬP NGAY</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(".dc").change(function() {
            document.getElementById("tinhtp").style.display = 'block';
        })
        $(".city").change(function() {
            var id_tinh = $(".city").val();
            // alert(id_tinh);
            $.ajax({
                url: "main/addcart.php",
                type: "POST",
                data: {
                    id_tinh: id_tinh
                },
                success: function(data) {
                    $(".qh").css("display", "block");
                    $(".quan").html(data);

                }
            })
        })
        $(".quan").change(function() {
            var id_quan = $(".quan").val();
            // alert(id_tinh);
            $.ajax({
                url: "main/addcart.php",
                type: "POST",
                data: {
                    id_quan: id_quan
                },
                success: function(data) {
                    $(".px").css("display", "block");
                    $(".xa").html(data);

                }
            })
        })
    })
    var check = true;

    function testsignup() {
        var name, namedk, email, emaildk, pass, passdk, repass, sdt, diachi;
        name = document.getElementById("username").value;
        namedk = /^[A-Za-z][A-Za-z0-9]{5,14}$/;
        email = document.getElementById("email").value;
        emaildk = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        pass = document.getElementById("password1").value;
        passdk = /^[A-Za-z0-9]{6,15}$/;
        repass = document.getElementById("password2").value;
        sdt = document.getElementById("sdt").value;
        diachi = document.getElementById("diachi").value;
        if (name == '') {
            document.getElementById("checkname").innerHTML = "*Tên đăng nhập trống!";
            check = false;
        } else {
            document.getElementById("checkname").innerHTML = "";
        }

        if (email == '') {
            document.getElementById("checkmail").innerHTML = "*Email trống!";
            document.getElementById("checkmail").classList.add('check');
            check = false;
        } else {
            if (!emaildk.test(email)) {
                document.getElementById("checkmail").innerHTML = "*Sai cú pháp, vui lòng nhập lại";
                document.getElementById("checkmail").classList.add('check');
                check = false;
            } else {
                document.getElementById("checkmail").innerHTML = "";
            }
        };
        if (pass == '') {
            document.getElementById("checkpass1").innerHTML = "*Mật khẩu trống!";
            check = false;
        } else {
            if (!passdk.test(pass)) {
                document.getElementById("checkpass1").innerHTML = " *Sai cú pháp, vui lòng nhập lại";
                document.getElementById("checkpass1").classList.add('check');
                check = false;
            } else {
                document.getElementById("checkpass1").innerHTML = "";
            }
            if (repass == '') {
                document.getElementById("checkpass2").innerHTML = "*Mật khẩu trống";
                check = false;
            } else {
                // if (pass != repass) {
                //     document.getElementById("checkpass2").innerHTML = "*Mật khẩu sai";
                //     check = false;
                // } else {
                if (!passdk.test(pass)) {
                    document.getElementById("checkpass1").innerHTML = " *Sai cú pháp, vui lòng nhập lại";
                    document.getElementById("checkpass2").innerHTML = " *Sai cú pháp, vui lòng nhập lại";
                    document.getElementById("checkpass1").classList.add('check');
                    check = false;
                } else {
                    document.getElementById("checkpass1").innerHTML = "";
                    document.getElementById("checkpass2").innerHTML = "";
                }

            }
            // }
        }
        if (diachi == '') {
            document.getElementById("checkdiachi").innerHTML = "*Địa chỉ trống!";
            check = false;
        } else {
            document.getElementById("checkdiachi").innerHTML = "";
        }
        if (sdt == '') {
            document.getElementById("checksdt").innerHTML = "*Số điện thoại trống!";
            check = false;
        } else {
            document.getElementById("checksdt").innerHTML = "";
        }
        return check;
    }
</script>
<script src="https://kit.fontawesome.com/72a902116d.js" crossorigin="anonymous"></script>

</html>