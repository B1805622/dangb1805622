<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="js/sb-admin-2.min.js"></script> -->
<?php
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = '1';
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 5) - 5;
}
$id_ql = $_SESSION['id_ql'];
$sql_lietke_kh = "SELECT * FROM quan_ly where id_ql='" . $id_ql . "'";
$query_lietke_kh = mysqli_query($mysqli, $sql_lietke_kh);
$row = mysqli_fetch_array($query_lietke_kh);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_edit'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_edit']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message_edit']);
    }
    ?>
    <div id="demo" style="display:none;" class="alert alert-danger">
        <a href="#" class="close" onclick="an()" aria-label="close">&times;</a>
        <strong>Kh??ng th??? x??a</strong>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thay ?????i m???t kh???u
            </h6>
        </div>
        <div class="searchresult">
            <div class="card-body">
                <form method="POST" action="includes/taikhoan/xuly.php?idql=<?php echo $id_ql ?>" enctype="multipart/form-data" autocomplete="off" onsubmit="return testsignup()">
                    <div class="form-group">
                        <label for="inputAddress">M???t kh???u hi???n t???i</label>
                        <div class="input-group">
                            <input type="password" name="pass" id="password" class="form-control" aria-describedby="basic-addon2" value="<?php echo $row['password_ql'] ?>">
                            <div class="input-group-append">
                                <span onclick="myfunctionpass2()" class="input-group-text" id="basic-addon2"><i class="fa fa-eye"></i></span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">M???t kh???u m???i</label>
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
                        <label for="inputAddress">Nh???p l???i m???t kh???u</label>
                        <div class="input-group">
                            <input type="password" id="password2" class="form-control" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="myfunctionpass1()" id="basic-addon2"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>
                        <small class="form-text text-muted" id="checkpass2">
                        </small>
                    </div>
                    <input type="submit" name="update_ql" class="btn btn-primary" value="C???p nh???t">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var x = true;

    function myfunctionpass() {
        if (x) {
            document.getElementById('password1').type = "text";
            x = false;
        } else {
            document.getElementById('password1').type = "password";
            x = true;
        }
    }

    function myfunctionpass2() {
        if (x) {
            document.getElementById('password').type = "text";
            x = false;
        } else {
            document.getElementById('password').type = "password";
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
            document.getElementById("checkpass1").innerHTML = "*M???t kh???u tr???ng, vui l??ng nh???p m???t kh???u";
            check = false;
        } else {
            if (!passdk.test(pass)) {
                document.getElementById("checkpass1").innerHTML = "M???t kh???u c???a b???n ph???i d??i 6-15 k?? t???, ch???a c??c ch??? c??i v?? s???, ?????ng th???i kh??ng ???????c ch???a d???u c??ch, k?? t??? ?????c bi???t ho???c bi???u t?????ng c???m x??c.";
                document.getElementById("checkpass1").classList.add('check');
                check = false;
            } else {
                document.getElementById("checkpass1").innerHTML = "";
            }
            if (repass == '') {
                document.getElementById("checkpass2").innerHTML = "*M???t kh???u tr???ng, vui l??ng nh???p m???t kh???u";
                check = false;
            } else {
                if (pass != repass) {
                    document.getElementById("checkpass2").innerHTML = "*M???t kh???u sai, vui l??ng ki???m tra l???i";
                    check = false;
                } else {
                    if (!passdk.test(pass)) {
                        document.getElementById("checkpass1").innerHTML = "M???t kh???u c???a b???n ph???i d??i 6-15 k?? t???, ch???a c??c ch??? c??i v?? s???, ?????ng th???i kh??ng ???????c ch???a d???u c??ch, k?? t??? ?????c bi???t ho???c bi???u t?????ng c???m x??c.";
                        document.getElementById("checkpass2").innerHTML = "M???t kh???u c???a b???n ph???i d??i 6-15 k?? t???, ch???a c??c ch??? c??i v?? s???, ?????ng th???i kh??ng ???????c ch???a d???u c??ch, k?? t??? ?????c bi???t ho???c bi???u t?????ng c???m x??c.";
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