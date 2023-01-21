<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Dang Food ADMIN</title>
  <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon" />
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" style="z-index: 2;">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
      unset($_SESSION['dangnhap']);
      unset($_SESSION['id_ql']);
      header('Location:./login.php');
    }
    ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Fast Food</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <?php
      include('includes/menu.php');
      include('includes/scripts.php');
      ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">


          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>


            <ul class="navbar-nav ml-auto">

              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              </li>

              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->

                  <?php

                  include("config.php");
                  date_default_timezone_set('Asia/Ho_Chi_Minh');
                  $sql_donhangmoi_sl = "SELECT DISTINCT* FROM gio_hang where trang_thai=1 ";
                  $query_donhang_sl = mysqli_query($mysqli, $sql_donhangmoi_sl);
                  if ($total_dh_sl = mysqli_num_rows($query_donhang_sl)) {
                    echo ' <span class="badge badge-danger badge-counter">';
                    echo $total_dh_sl;
                    echo '</span>';
                  } else {
                  }
                  ?>


                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Thông báo
                  </h6>

                  <?php

                  include("config.php");
                  date_default_timezone_set('Asia/Ho_Chi_Minh');
                  $sql_donhangmoi = "SELECT DISTINCT* FROM gio_hang where trang_thai=1 ORDER BY gio_hang.thoi_gian_add DESC";
                  $query_donhang = mysqli_query($mysqli, $sql_donhangmoi);
                  // if ($total_dh = mysqli_num_rows($query_donhang)) {
                  // //   echo   '<span class="badge badge-danger badge-counter">';
                  // //   echo $total_dh;
                  // //   echo '</span>';
                  // // } else {
                  // //   echo  '<h4>Tổng: 0 </h4>';
                  // }
                  while ($row_gh = mysqli_fetch_array($query_donhang)) {
                  ?>
                    <?php
                    if ($row_gh['trang_thai'] == 1) {
                    ?>
                      <a class="dropdown-item d-flex align-items-center" href="index.php?action=donhang&query=danhsach">
                        <div class="mr-3">
                          <div class="icon-circle bg-primary" style=" background-color: red !important;">
                            <i class="fas fa-file-alt text-white"></i>

                          </div>
                        </div>
                        <div>
                          <div class="small text-gray-500">
                            <?php
                            $timedat = date_create($row_gh['thoi_gian_add']);

                            echo date_format($timedat, "H:i:s d-m-Y");
                            ?>

                          </div>
                          <span class="font-weight-bold">Một đơn hàng mới vừa được đặt!</span>
                        </div>
                      </a>
                    <?php
                    } else {
                    ?>
                  <?php
                    }
                  }
                  ?>


                  <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 7, 2019</div>
                      $290.29 has been deposited into your account!
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 2, 2019</div>
                      Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                  </a> -->
                  <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Messages -->
                  <?php

                  include("config.php");

                  $sql_sl_binhluan = "SELECT * FROM binh_luan_danh_gia  WHERE trang_thai_bl=1  ORDER BY id_binh_luan  DESC LIMIT 5";
                  $query_soluong_bl = mysqli_query($mysqli, $sql_sl_binhluan);
                  if ($total = mysqli_num_rows($query_soluong_bl)) {
                    echo   '<span class="badge badge-danger badge-counter">';
                    echo $total;
                    echo "+";
                    echo '</span>';
                  } else {
                    echo   '<span class="badge badge-danger badge-counter">';
                    echo '</span>';
                  }
                  ?>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                    Phản hồi
                  </h6>
                  <?php
                  include("config.php");
                  require('../carbon/autoload.php');

                  use Carbon\Carbon;
                  use Carbon\CarbonInterval;

                  $now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
                  $sql_lietke_binhluan = "SELECT DISTINCT* FROM binh_luan_danh_gia AS bldg, khach_hang AS kh, mon_an AS m
                  WHERE  m.id_mon_an=bldg.id_mon_an AND kh.id_kh=bldg.id_kh  ORDER BY bldg.id_binh_luan DESC limit 5";
                  $query_lietke_binhluan = mysqli_query($mysqli, $sql_lietke_binhluan);

                  while ($row = mysqli_fetch_array($query_lietke_binhluan)) {
                  ?>
                    <?php
                    $sql_timbl = "SELECT * FROM binh_luan_danh_gia AS bldg, tra_loi_binh_luan AS rep
                  WHERE rep.id_binh_luan=bldg.id_binh_luan and bldg.id_binh_luan= '" . $row['id_binh_luan'] . "'  ";
                    $query_timbl = mysqli_query($mysqli, $sql_timbl);
                    $rowtim = mysqli_fetch_array($query_timbl);
                    if ($rowtim['tra_loi'] = '') {
                    ?>
                    <?php
                    } else {
                    ?>
                      <a class="dropdown-item d-flex align-items-center" href="index.php?action=binhluan&query=danhsach">
                        <div class="mr-3 dropdown-list-image ">
                          <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                          <div class="text-truncate"><?php echo $row['noi_dung'] ?></div>
                          <div class="small text-gray-500"><?php echo $row['ten_kh'] ?>
                            <?php
                            $first_date = strtotime($now);
                            $second_date = strtotime($row['thoi_gian']);
                            $datediff = abs($first_date - $second_date);
                            $dt = floor($datediff / (60 * 60));
                            if ($dt >= 60) {
                              $dt1 = floor($dt / (24));
                              echo $dt1;
                              echo " ngày trước.";
                            } elseif ($dt < 60) {
                              echo  $dt;
                              echo " giờ trước.";
                            }

                            ?></div>
                        </div>
                      </a>
                    <?php
                    }
                    ?>

                  <?php }
                  ?>
                  <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <div class="status-indicator"></div>
                    </div>
                    <div>
                      <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                      <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                      <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                      <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                      <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                      <div class="small text-gray-500">Chicken the Dog · 2w</div>
                    </div>
                  </a> -->
                  <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>
              <!--  -->
              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    John Nguyen
                  </span>

                  <img class="img-profile rounded-circle" src="img/admin.png">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="index.php?action=taikhoan&query=thongtin">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Thông tin
                  </a>
                  <a class="dropdown-item" href="index.php?action=taikhoan&query=matkhau">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đổi mật khẩu
                  </a>
                  <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đăng xuất
                  </a>
                </div>
              </li>

            </ul>

          </nav>
          <!-- End of Topbar -->


          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" style="z-index: 1;" href="#page-top">
            <i class="fas fa-angle-up"></i>
          </a>


          <!-- Logout Modal-->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Đăng xuất ?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>

                  <form action="" method="POST">
                    <a href="index.php?dangxuat=1" class="btn btn-primary">Đăng xuất</a>
                  </form>


                </div>
              </div>
            </div>
          </div>