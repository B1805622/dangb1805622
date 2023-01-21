<!-- Begin Page Content -->
<style>
  rect {
    fill: #f8f9fc;
  }
</style>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4  mb-0 text-gray-800">THỐNG KÊ</h4>
  </div>
  <!-- Content Row -->
  <div id="piechart_3d"></div>

  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng danh thu</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $sql_thongke = "SELECT *FROM thongke";
                $query_thongke = mysqli_query($mysqli, $sql_thongke);
                $tongtien = 0;
                while ($row_tk = mysqli_fetch_array($query_thongke)) {
                ?>
                <?php

                  $thanhtien = $row_tk['doanhthu'];
                  $tongtien += $thanhtien;
                  // $data[] = $row1;
                }
                echo number_format($tongtien,  0, ',', '.') . 'đ';
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2" style="border-left: .25rem solid #E14D2A!important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: #E14D2A !important;">Khách hàng</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $sql_sl_kh = "SELECT DISTINCT* FROM khach_hang";
                $query_soluong_kh = mysqli_query($mysqli, $sql_sl_kh);
                if ($total_kh = mysqli_num_rows($query_soluong_kh)) {
                  echo $total_kh;
                } else {
                  echo '<h4>Tổng: 0 </h4>';
                }
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" style="border-left: .25rem solid #F7A4A4!important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #F7A4A4 !important;">Số lượng món ăn</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $sql_soluong_sp = "SELECT * FROM mon_an where trang_thai=1";
                $query_soluong = mysqli_query($mysqli, $sql_soluong_sp);
                if ($total = mysqli_num_rows($query_soluong)) {
                  echo  $total;
                } else {
                  echo  '<h4>Tổng: 0 </h4>';
                }
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: .25rem solid #80489C!important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style=" color: #80489C !important;">Tổng đơn hàng</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php
                    $sql_soluong_donhang = "SELECT * FROM gio_hang";
                    $query_soluong_donhang = mysqli_query($mysqli, $sql_soluong_donhang);
                    if ($total_donhang = mysqli_num_rows($query_soluong_donhang)) {
                      echo  "$total_donhang";
                    } else {
                      echo  '0';
                    }
                    ?>
                  </div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar" role="progressbar" style="width: 50%; background-color: #80489C !important;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->



    <!-- Earnings (Monthly) Card Example -->


    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Phản hồi từ khách hàng</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $sql_sl_binhluan = "SELECT DISTINCT* FROM binh_luan_danh_gia";
                $query_soluong_bl = mysqli_query($mysqli, $sql_sl_binhluan);
                if ($total = mysqli_num_rows($query_soluong_bl)) {
                  echo $total;
                } else {
                  echo '<h4>Tổng: 0 </h4>';
                }
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng mã khuyến mãi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $sql_soluong_km = "SELECT * FROM khuyen_mai ";
                $query_soluong_km = mysqli_query($mysqli, $sql_soluong_km);
                if ($total1 = mysqli_num_rows($query_soluong_km)) {
                  echo  $total1;
                } else {
                  echo  '<h4>Tổng: 0 </h4>';
                }
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-light fa-2x fa-tag text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng đơn hàng thành công</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php
                    $sql_soluong_donhang = "SELECT * FROM gio_hang where trang_thai=6";
                    $query_soluong_donhang = mysqli_query($mysqli, $sql_soluong_donhang);
                    if ($total_donhang = mysqli_num_rows($query_soluong_donhang)) {
                      echo  "$total_donhang";
                    } else {
                      echo  '0';
                    }
                    ?>
                  </div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: .25rem solid #5837D0!important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #5837D0 !important;">Tổng đơn hàng bị hủy</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php
                    $sql_soluong_donhang = "SELECT * FROM gio_hang where trang_thai=4";
                    $query_soluong_donhang = mysqli_query($mysqli, $sql_soluong_donhang);
                    if ($total_donhang = mysqli_num_rows($query_soluong_donhang)) {
                      echo  "$total_donhang";
                    } else {
                      echo  '0';
                    }
                    ?>
                  </div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar" role="progressbar" style="width: 50%;background-color: #5837D0 !important;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-800">THỐNG KÊ NGÀY HIỆN TẠI</h1>
  </div>
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Danh thu hôm nay</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php
                    include('config.php');
                    require('../carbon/autoload.php');

                    use Carbon\Carbon;
                    use Carbon\CarbonInterval;

                    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
                    $today = date('Y-m-d 00:00:00');
                    // echo $now;
                    $sql_thongkengay = "SELECT *FROM thongke where ngay_dat= '" . $today . "'";
                    $query_thongkengay = mysqli_query($mysqli, $sql_thongkengay);
                    $row_tk_ngay = mysqli_fetch_array($query_thongkengay);
                    if (isset($row_tk_ngay['ngay_dat'])) {
                      echo number_format($row_tk_ngay['doanhthu'],  0, ',', '.') . 'đ';
                    } else {
                      echo "0đ";
                    }
                    ?>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đơn hàng mới</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php
                    $sql_soluong_donhang_moi = "SELECT * FROM gio_hang where trang_thai=1";
                    $query_soluong_donhang_moi = mysqli_query($mysqli,  $sql_soluong_donhang_moi);
                    if ($total_donhang_moi = mysqli_num_rows($query_soluong_donhang_moi)) {
                      echo  "$total_donhang_moi";
                    } else {
                      echo  '0';
                    }
                    ?>
                  </div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" style="background-color: #ff1a1a !important;width: 50%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Khuyến mãi đang áp dụng</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $sql_soluong_km = "SELECT * FROM khuyen_mai where trang_thai_km=1";
                $query_soluong_km = mysqli_query($mysqli, $sql_soluong_km);
                if ($total1 = mysqli_num_rows($query_soluong_km)) {
                  echo  $total1;
                } else {
                  echo  '<h4>Tổng: 0 </h4>';
                }
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-light fa-2x fa-tag text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="h4 mb-0 text-gray-800">BIỂU ĐỒ</h1>

  </div>
  <style type="text/css">
    .statistic_select {
      margin: 0;
      padding-bottom: 15px;
    }

    /* 
    .select-date {
      width: 120px;
      height: 30px;
    } */

    #text-date {
      color: #666;
      font-weight: bold;
    }

    #chart {
      height: 400px;
    }
  </style>

  <!-- Content Row -->
  <div class="statistic">
    <div class="statistic_grid">
      <p class="statistic_select">
        <select class="custom-select select-date" id="idloai" style=" width: 241px;">
          <option value="7ngay">Chọn thời gian thống kê</option>
          <option value="7ngay">7 ngày qua</option>
          <option value="28ngay">28 ngày qua</option>
          <option value="90ngay">90 ngày qua</option>
          <option value="365ngay">365 ngày qua</option>
        </select>
      </p>
      <p class="statistic_title">Thống kê đơn hàng <span id="text-date"></span></p>
      <div id="chart" style="height: 250px;"></div>
    </div>
  </div>



</div>

<?php
include('config.php');
$sql = "SELECT loai_mon_an.id_loai_mon_an,loai_mon_an.ten_loai_mon_an, COUNT(mon_an.id_loai_mon_an) AS 'number_cate' FROM `mon_an`INNER JOIN loai_mon_an ON mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an GROUP BY mon_an.id_loai_mon_an";
$result = mysqli_query($mysqli, $sql);
$data = [];
while ($row_loai = mysqli_fetch_array($result)) {
  $data[] = $row_loai;
}

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {
    packages: ["corechart"]
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['ten_loai_mon_an', 'number_cate'],
      <?php
      foreach ($data as $key) {
        echo "['" . $key['ten_loai_mon_an'] . "'," . $key['number_cate'] . "],";
      }
      ?>
    ]);

    var options = {
      title: 'Biểu đồ thống kê món ăn theo loại món ăn',
      is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    thongke();
    var char = new Morris.Area({
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors: ['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors: ['#020ae3', 'red'],
      element: 'chart',

      xkey: 'date',

      ykeys: ['date', 'order', 'sales', 'quantity'],

      labels: ['Đơn hàng', 'Số lượng bán', 'Doanh thu', 'Số lượng']
    });
    $('.select-date').change(function() {
      var thoigian = $(this).val();
      if (thoigian == '7ngay') {
        var text = '7 ngày qua';
      } else if (thoigian == '28ngay') {
        var text = '28 ngày qua';
      } else if (thoigian == '90ngay') {
        var text = '90 ngày qua';
      } else {
        var text = '365 ngày qua';
      }

      $.ajax({
        url: "includes/thongke.php",
        method: "POST",
        dataType: "JSON",
        data: {
          thoigian: thoigian
        },
        success: function(data) {
          char.setData(data);
          $('#text-date').text(text);
        }
      });
    })

    function thongke() {
      var text = '365 ngày qua';
      $('#text-date').text(text);
      $.ajax({
        url: "includes/thongke.php",
        method: "POST",
        dataType: "JSON",
        success: function(data) {
          char.setData(data);
          $('#text-date').text(text);
        }
      });
    }
  });
</script>
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Dang Food 2022</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->


</body>