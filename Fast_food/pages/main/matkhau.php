<link href="css/css-message.css" rel="stylesheet" />
<?php
include("message.php");
$id_kh = $_SESSION['id_kh'];
// echo $id_kh;
$sql_lietke_donhang = "SELECT DISTINCT* FROM  khach_hang AS kh 
WHERE kh.id_kh=$id_kh";
$query_lietke_don_hang = mysqli_query($mysqli, $sql_lietke_donhang);
$row = mysqli_fetch_array($query_lietke_don_hang);
?>
<style>
    .dropdown-item1 {
        font-size: 17px;
        font-weight: 550;
    }
</style>

<section class="h-100 " style="padding-top: 34px;">
    <div class="py-5 h-100" style="padding-bottom:0.7rem !important;padding: 0px 130px">
        <div class="card">
            <div class="row" style="padding: 5px;">
                <div class="col-sm-3">
                    <div class="card" style="padding: 17px;">
                        <div class="">
                            <div class="dropdown-menu1">
                                <a class="dropdown-item1" href="index.php?quanly=thongtin">Thông tin cá nhân</a><br>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding: 17px;">
                        <div class="">
                            <div class="dropdown-menu1">
                                <a class="dropdown-item1" href="index.php?quanly=matkhau">Đổi mật khẩu</a><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">THAY ĐỔI MẬT KHẨU</h5>
                            <form method="POST" action="pages/main/addcart.php?idkh=<?php echo $row['id_kh'] ?>" enctype="multipart/form-data" autocomplete="off" onsubmit="return testsignup()">
                                <div class="form-group">
                                    <label for="inputAddress">Mật khẩu hiện tại</label>
                                    <div class="input-group">
                                        <input type="password" name="pass" id="password" class="form-control" aria-describedby="basic-addon2" value="<?php echo $row['password_kh'] ?>">
                                        <div class="input-group-append">
                                            <span onclick="myfunctionpass2()" class="input-group-text" id="basic-addon2"><i class="fa fa-eye"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Mật khẩu mới</label>
                                    <div class="input-group">
                                        <input type="password" name="pass1" id="password1" class="form-control" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span onclick="myfunctionpass()" class="input-group-text" id="basic-addon2"><i class="fa fa-eye"></i></span>
                                        </div>

                                    </div>
                                    <small class="form-text text-muted" id="checkpass1">
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Nhập lại mật khẩu</label>
                                    <div class="input-group">
                                        <input type="password" id="password2" class="form-control" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="myfunctionpass1()" id="basic-addon2"><i class="fa fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted" id="checkpass2">
                                    </small>
                                </div>
                                <input type="submit" name="update_kh_pass" class="btn btn-primary"  value="Cập nhật">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
<script>
    var x = true;

    function myfunctionpass2() {
        if (x) {
            document.getElementById('password').type = "text";
            x = false;
        } else {
            document.getElementById('password').type = "password";
            x = true;
        }
    }

    function myfunctionpass() {
        if (x) {
            document.getElementById('password1').type = "text";
            x = false;
        } else {
            document.getElementById('password1').type = "password";
            x = true;
        }
    }

    function myfunctionpass1() {
        if (x) {
            document.getElementById('password2').type = "text";
            x = false;
        } else {
            document.getElementById('password2').type = "password";
            x = true;
        }
    }


    function testsignup() {
        var check = true;
        var pass, passdk, repass;
        pass = document.getElementById("password1").value;
        passdk = /^[A-Za-z0-9]{6,15}$/;
        repass = document.getElementById("password2").value;
        if (pass == '') {
            document.getElementById("checkpass1").innerHTML = "*Mật khẩu trống, vui lòng nhập mật khẩu";
            check = false;
        } else {
            if (!passdk.test(pass)) {
                document.getElementById("checkpass1").innerHTML = "Mật khẩu của bạn phải dài 6-15 ký tự, chứa các chữ cái và số, đồng thời không được chứa dấu cách, ký tự đặc biệt hoặc biểu tượng cảm xúc.";
                document.getElementById("checkpass1").classList.add('check');
                check = false;
            } else {
                document.getElementById("checkpass1").innerHTML = "";
            }
            if (repass == '') {
                document.getElementById("checkpass2").innerHTML = "*Mật khẩu trống, vui lòng nhập mật khẩu";
                check = false;
            } else {
                if (pass != repass) {
                    document.getElementById("checkpass2").innerHTML = "*Mật khẩu sai, vui lòng kiểm tra lại";
                    check = false;
                } else {
                    if (!passdk.test(pass)) {
                        document.getElementById("checkpass1").innerHTML = "Mật khẩu của bạn phải dài 6-15 ký tự, chứa các chữ cái và số, đồng thời không được chứa dấu cách, ký tự đặc biệt hoặc biểu tượng cảm xúc.";
                        document.getElementById("checkpass2").innerHTML = "Mật khẩu của bạn phải dài 6-15 ký tự, chứa các chữ cái và số, đồng thời không được chứa dấu cách, ký tự đặc biệt hoặc biểu tượng cảm xúc.";
                        document.getElementById("checkpass1").classList.add('check');
                        check = false;
                    } else {
                        document.getElementById("checkpass1").innerHTML = "";
                        document.getElementById("checkpass2").innerHTML = "";
                    }

                }
            }
        }
        return check;
    }
</script>