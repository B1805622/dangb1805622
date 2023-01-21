<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon" />
  <title> Dang Food ADMIN</title>
  <!-- <script src="../js/sweetalert.min.js"></script> -->
  <!-- Custom fonts for this template-->
  <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    .check {
      color: red;
    }
  </style>
</head>

</html>

<?php
session_start();
include('includes/config.php');
include('includes/scripts.php');
if (isset($_POST['login_btn'])) {

  $taikhoan = mysqli_real_escape_string($mysqli, $_POST['username']);
  $matkhau = mysqli_real_escape_string($mysqli, $_POST['password']);
  //$matkhau = md5($_POST['password']);
  $sql = "SELECT * FROM quan_ly WHERE username_ql='" . $taikhoan . "' AND password_ql='" . $matkhau . "' LIMIT 1 ";
  $row = mysqli_query($mysqli, $sql);
  $count = mysqli_num_rows($row);

  if ($count > 0) {
    $row_data = mysqli_fetch_array($row);
    $_SESSION['dangnhap'] = $row_data;
    
    $_SESSION['id_ql'] = $row_data['id_ql'];

    header("Location:index.php");
    $d = date('Y-m-d');
    $_SESSION['message1'] = 'Đăng nhập thành công';
  } else {
    // echo '<script language="javascript">';
    // echo 'alert("Username hoặc mật khẩu không đúng, vui lòng nhập lại")';
    // echo '</script>';
    $_SESSION['dangnhap'] = "Đăng nhập thất bại";
    $_SESSION['id_ql'] = "Thất bại";
    header("Location:login.php");
  }
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
                  <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                </div>
                <form class="user" action="" autocomplete="off" method="POST" onsubmit="return testsignin()">
                  <div class="form-group">
                    <input type="text" name="username" id="fname" class="form-control form-control-user" placeholder="Tên đăng nhập...">
                  </div>
                  <div class="form-group">
                    <span id="checkname"></span>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="passw" class="form-control form-control-user" placeholder="Mật khẩu">
                  </div>
                  <div class="form-group">
                    <span id="checkpass1"></span>
                  </div>
                  <!-- <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Đăng nhập</button> -->

                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="login_btn" value="Đăng nhập" />
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
<!-- <script type="text/javascript">
  function testsignin() {
    var check = true;
    var name = document.getElementById("fname").value;
    var namedk = /^[A-Za-z][A-Za-z0-9]{5,14}$/;
    var pass = document.getElementById("passw").value;
    var passdk = /^[A-Za-z0-9]{6,15}$/;
    if (name == '') {
      document.getElementById("checkname").innerHTML = "*Tên đăng nhập trống, vui lòng nhập tên đăng nhập";
      document.getElementById("checkname").classList.add('check');
      check = false;
    } else {
      if (!namedk.test(name)) {
        document.getElementById("checkname").innerHTML = "*Sai cú pháp, vui lòng nhập lại";
        document.getElementById("checkname").classList.add('check');
        check = false;
      } else {
        document.getElementById("checkname").innerHTML = "";
      }
    };

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
</script> -->
<?php
// include('includes/scripts.php');
?>
<?php
if (isset($_SESSION['dangnhap']) && $_SESSION['id_ql'] != '') {
?>
  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    toastr["error"]("Có lổi xảy ra, vui lòng đăng nhập lại.", "Thất bại!")

    // swal({
    //   title: "<?php echo $_SESSION['dangnhap']; ?>",
    //   // text: "You clicked the button!"
    //   icon: "<?php echo $_SESSION['id_ql']; ?>",
    //   button: "Thoát!",
    // });
  </script>
<?php
  // unset($_SESSION['status']);
}
?>