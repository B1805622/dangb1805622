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
        $begin = ($page * 10) - 10;
    }

    $sql_lietke_binhluan = "SELECT DISTINCT* FROM binh_luan_danh_gia AS bldg, khach_hang AS kh, mon_an AS m
WHERE m.id_mon_an=bldg.id_mon_an AND kh.id_kh=bldg.id_kh and bldg.baocao!=2  ORDER BY bldg.id_binh_luan DESC limit  $begin,10";
    $query_lietke_binhluan = mysqli_query($mysqli, $sql_lietke_binhluan);

    ?>

  <div class="container-fluid">
      <!-- DataTales Example -->
      <?php
        if (isset($_SESSION['message_duyet'])) {
        ?>
          <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?= $_SESSION['message_duyet']; ?>!</strong>
          </div>

      <?php
            unset($_SESSION['message_duyet']);
        }
        ?>
      <?php
        if (isset($_SESSION['message_gh'])) {
        ?>
          <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?= $_SESSION['message_gh']; ?>!</strong>
          </div>

      <?php
            unset($_SESSION['message_gh']);
        }
        ?>
      <?php
        if (isset($_SESSION['message_xoa'])) {
        ?>
          <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?= $_SESSION['message_xoa']; ?>!</strong>
          </div>

      <?php
            unset($_SESSION['message_xoa']);
        }
        ?>
      <div id="demo" style="display:none;" class="alert alert-danger">
          <a href="#" class="close" onclick="an()" aria-label="close">&times;</a>
          <strong>Không thể xóa</strong>
      </div>
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh sách các bình luận
                  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Thêm loại món ăn
                </button> -->
              </h6>
          </div>

          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                      <li class="nav-item">
                          <a class="nav-link" href="">Tất cả </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link timreport" onclick="Show()">Đã được báo cáo</a>
                      </li>
                  </ul>

              </div>
          </nav>
          <script>
              $(document).ready(function() {
                  const btn = document.querySelectorAll(".timreport")
                  // console.log(btn);
                  btn.forEach(function(btn, index) {
                      // console.log(btn, index);
                      btn.addEventListener("click", function(event) {
                          var btnItem = event.target;
                          // btnItem.onclick =function(){

                          // console.log(btnItem)
                          var product = btnItem.parentElement
                          var report = product.querySelector("a").innerText
                          // console.log(id_trang_thai)
                          if (report == "Đã được báo cáo") {
                              id_report = 1;
                          }
                          $.ajax({
                              url: "includes/binhluan/xoa.php",
                              type: "POST",
                              data: {
                                  id_report: id_report
                              },

                              success: function(data) {
                                  $(".hienloai").html(data);
                              }

                          })

                      })
                  })
              });
          </script>
          <div class="hienloai">

          </div>
          <script>
              function Show() {
                  document.getElementById('all1').style.display = "none";
                  document.getElementById('all2').style.display = "none";
                  document.getElementById('changecolor').style.color = "#000000";
              }
          </script>
          <div class="card-body" id="all1">
              <div class="table-responsive">

                  <table id="datatableid" class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>STT</th>
                              <th>Tên khách hàng</th>
                              <th>Món ăn</th>
                              <th>Nội dung bình luận</th>
                              <th>Trả lời</th>
                              <th>Thao tác</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($query_lietke_binhluan)) {

                                $i++;
                            ?>
                              <tr>
                                  <td> <?php echo $i ?></td>
                                  <td><?php echo $row['ten_kh'] ?></td>
                                  <td><?php echo $row['ten_mon_an'] ?></td>
                                  <td><?php echo $row['noi_dung'] ?></td>
                                  <td><?php
                                        $sql = "SELECT *FROM tra_loi_binh_luan where id_binh_luan='" . $row['id_binh_luan'] . "'";
                                        $query = mysqli_query($mysqli, $sql);
                                        $row_tl = mysqli_fetch_array($query);
                                        if (isset($row_tl['id_binh_luan'])) {
                                            echo $row_tl['tra_loi'];
                                        } else {
                                            echo " ";
                                        }
                                        ?></td>
                                  <!-- <td><?php
                                            if ($row['baocao'] == 1) {
                                                echo '<span style="color:red">Report</span>';
                                            }
                                            ?></td> -->
                                  <td>
                                      <?php
                                        if (!isset($row_tl['tra_loi'])) {
                                        ?>
                                          <a class="btn" data-toggle="modal" style="padding: 0px;" data-target="#onmodalupdate" onclick="getdata(id_bl=<?php echo $row['id_binh_luan'] ?>)"><button type="button" class="btn btn-outline-primary btn-sm">Trả lời</button></a>
                                          <div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Phản hồi bình luận
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="sualoai">

                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <?php
                                        } else {
                                        }
                                        ?>

                                      <!-- <a href="../../Fast_food/index.php?quanly=monan&IdMon=<?php echo $row['id_mon_an'] ?>"></a> -->
                                      <a href="../../Fast_food/index.php?quanly=monan&IdMon=<?php echo $row['id_mon_an'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                      <a href="includes/binhluan/xoa.php?code=<?php echo $row['id_binh_luan'] ?>"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></a>
                                  </td>
                              </tr>
                          <?php
                            }
                            ?>
                      </tbody>
                  </table>

              </div>
          </div>
          <?php
            $sql_trang = mysqli_query($mysqli, "SELECT DISTINCT* FROM binh_luan_danh_gia AS bldg, khach_hang AS kh, mon_an AS m
WHERE m.id_mon_an=bldg.id_mon_an AND kh.id_kh=bldg.id_kh and bldg.baocao!=2  ORDER BY bldg.id_binh_luan DESC");
            $row_count = mysqli_num_rows($sql_trang);
            $trang = ceil($row_count /10);
            ?>
          <div class="paging" id="all2">
              <p style="display: flex;align-items: center;">Tổng số trang <?php echo $trang ?> </p>
              <ul class="page_list">
                  <?php
                    for ($i = 1; $i <= $trang; $i++) {
                    ?>
                      <li <?php if ($i == $page) {
                                echo 'style="background-color: #4e73df;"';
                            } else {
                                echo '';
                            } ?>><a href="index.php?action=binhluan&query=danhsach&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                  <?php
                    }
                    ?>
              </ul>
          </div>
      </div>
  </div>
  <script>
      function getdata() {
          var idbl = id_bl;

          $.ajax({
              url: "includes/binhluan/xuly.php",
              type: "POST",
              data: {
                  idbl: idbl
              },
              success: function(data) {
                  $(".sualoai").html(data);
              }
          })
      }
  </script>
  <div style="clear:both;"></div>
  <style type="text/css">
      .paging {
          display: flex;
          justify-content: flex-end;
      }

      ul.page_list {
          /* float: right; */
          /* padding-bottom: 40px; */
          padding-left: 0;
          /* margin: 0; */
          list-style: none;
      }

      ul.page_list li {
          float: left;
          padding: 5px 13px;
          margin: 5px;
          background-color: #fff;
          display: block;
      }

      ul.page_list li a {
          color: #3f2529;
          text-align: center;
          text-decoration: none;
      }
  </style>
  <script>
      function hien() {
          document.getElementById("demo").style.display = "block";
      }

      function an() {
          document.getElementById("demo").style.display = "none";
      }
  </script>