<!-- <link rel="stylesheet" href="https://kfcvietnam.com.vn/templates/css/bootstrap.min.css" /> -->
<!-- <link href="https://kfcvietnam.com.vn/templates/css/main.css?v=2524" rel="stylesheet"/> -->
<link href="https://kfcvietnam.com.vn/templates/css/responsive.css?v=7062" rel="stylesheet" />
<link href="https://kfcvietnam.com.vn/templates/css/style.css?v=9697" rel="stylesheet" />
<link href="https://kfcvietnam.com.vn/templates/css/mobile.css?v=2190" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<style>
    .headermain {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 2;
    }

    .header_section {
        padding: 0px 0;
    }

    .nav-link {
        font-size: 20px;
         font-weight: 550;
        font-weight: bold;
        color: white;
    }
</style>
<!-- <script>
    function Redirect() {
        window.location = "index.php?quanly=giohang";
    }

    function Redirect1() {
        window.location = "index.php?quanly=loai";
    }

    function Redirect2() {
        window.location = "index.php?quanly=khuyenmai";
    }
</script> -->


<?php
// include('../admin/includes/config.php');
$user = (isset($_SESSION['dangnhap1'])) ? $_SESSION['dangnhap1'] : [];
// $user1 = (isset($_SESSION['dangky'])) ? $_SESSION['dangky'] : [];

if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangnhap1'], $_SESSION['dangky'], $_SESSION['id_kh']);
    header('Location:index.php');
}
?>
<div class="headermain">
    <div class="header_section">
        <div class="container" style="max-width: 80%;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">

                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Navbar brand -->
                        <a class="navbar-brand mt-2 mt-lg-0" style="font-size: 2.25rem;color: white;" href="index.php">
                            <!-- <img src="images/nobg_food.png" height="40" alt="MDB Logo" loading="lazy" /> -->
                            Dang Foods
                        </a>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        </ul>
                    </div>
                    <div class="d-flex align-items-center">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="index.php?quanly=loai">THỰC ĐƠN</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link"></span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link"></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="index.php?quanly=khuyenmai">KHUYẾN MÃI</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link"></span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link"></span>
                            </li>
                            <?php if (isset($user['email_kh'])) { ?>
                                <?php
                                $select_rows = mysqli_query($mysqli, "SELECT * FROM gio_hang") or die('query failed');
                                $row_count = mysqli_num_rows($select_rows);
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" style="color: white;" href="index.php?quanly=giohang">GIỎ HÀNG</a>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link"></span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link"></span>
                                </li>
                                <div class="dropdown show nav-link">
                                    <a href="#" style="color:white;font-weight: bold;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo mb_strtoupper($user['ten_kh']) ?>

                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="index.php?quanly=thongtin">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Thông tin cá nhân
                                        </a>
                                        <a class="dropdown-item" href="index.php?quanly=matkhau">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Đổi mật khẩu
                                        </a>
                                        <a class="dropdown-item" href="index.php?quanly=lichsu">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Lịch sử đặt món
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="index.php?dangxuat=1">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Đăng xuất
                                        </a>
                                    </div>
                                </div>
                            <?php } elseif (isset($_SESSION['dangky']) && isset($_SESSION['id_kh'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" style="color: white;" href="index.php?quanly=giohang">GIỎ HÀNG</a>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link"></span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link"></span>
                                </li>
                                <div class="dropdown show nav-link">
                                    <a href="#" style="color:white;font-weight: bold;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo mb_strtoupper($_SESSION['dangky']) ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="index.php?quanly=thongtin">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Thông tin cá nhân
                                        </a>
                                        <a class="dropdown-item" href="index.php?quanly=matkhau">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Đổi mật khẩu
                                        </a>
                                        <a class="dropdown-item" href="index.php?quanly=lichsu">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Lịch sử đặt món
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="index.php?dangxuat=1">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Đăng xuất
                                        </a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" style="color: white;" href="index.php?quanly=giohang">GIỎ HÀNG</a>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link"></span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link"></span>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" style="color: white;" href="pages/login.php ">ĐĂNG NHẬP</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>