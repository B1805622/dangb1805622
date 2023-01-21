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

    $sql_lietke_hoa_don = "SELECT * FROM hoa_don, khach_hang, gio_hang WHERE gio_hang.id_gio_hang=hoa_don.id_gio_hang and gio_hang.id_kh=khach_hang.id_kh  ORDER BY hoa_don.id_hd DESC LIMIT $begin,5";
    $query_lietke_hoa_don = mysqli_query($mysqli, $sql_lietke_hoa_don);

    ?>

 <div class="container-fluid">

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
         <strong>Không thể xóa</strong>
     </div>
     <div class="card shadow mb-4" id="dshd">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn
             </h6>
         </div>

         <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                 <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                 </ul>
                 <form action="?action=quanlyloai&query=timkiem" method="POST">
                     <div class="input-group">
                         <input type="text" class="form-control bg-light small" id="searchinput" style="width: 276px;" placeholder="Tên khách hàng..." aria-label="Search" aria-describedby="basic-addon2">
                         <div class="input-group-append">
                             <button class="btn btn-primary" type="submit" name="search">
                                 <i class="fas fa-search fa-sm"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </nav>
         <script>
             $(document).ready(function() {
                 $("#searchinput").keyup(function() {
                     var input = $(this).val();
                     // alert(input);
                     if (input != "") {
                         $.ajax({
                             url: "includes/hoadon/xuly.php",
                             type: "POST",
                             data: {
                                 input: input
                             },
                             success: function(data) {
                                 $(".searchresult").html(data);
                                 // $(".hienloai").css("display", "none");
                                 $(".searchresult").css("display", "block");
                             }
                         })
                     } else {
                         location.reload(true);
                     }
                 })
             })
         </script>
         <div class="searchresult">
             <div class="card-body">
                 <div class="table-responsive">
                     <table id="datatableid" class="table table-bordered table-hover">
                         <thead>
                             <tr>
                                 <th>STT</th>
                                 <!-- <th>Số hóa đơn</th> -->
                                 <th>Khách hàng</th>
                                 <th>Ngày lập</th>
                                 <th>Địa chỉ giao hàng</th>
                                 <th>Thao tác</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $i = 0;
                                while ($row = mysqli_fetch_array($query_lietke_hoa_don)) {
                                    $i++;
                                ?>
                                 <tr>
                                     <td> <?php echo $i ?></td>
                                      <!-- <td>HD00<?php echo $row['id_hd'] ?></td> -->
                                     <td><?php echo $row['ten_kh'] ?></td>
                                     <td><?php
                                            $ngaylap = date_create($row['ngay_lap_hd']);
                                            echo date_format($ngaylap, "d-m-Y H:i:s");
                                            ?></td>

                                     <td><?php echo $row['dia_chi_giao_hang'] ?></td>
                                     <td>
                                         <button type="button" data-toggle="modal" data-target="#onmodal" class="btn btn-primary" onclick="getdata(id_hd=<?php echo $row['id_hd'] ?>)"><i class="fas fa-solid fa-print"></i></button>
                                         <!-- </div> -->
                                         <!-- <a class="fas fa-solid fa-print" style="font-size:20px" href="index.php?action=hoadon&query=in&HD=<?php echo $row['id_hd'] ?>" style="color:#1961ad;"></a> -->
                                     </td>
                                 </tr>
                             <?php
                                }
                                ?>
                         </tbody>
                     </table>

                 </div>
                 <?php
                    $sql_trang = mysqli_query($mysqli, "SELECT * FROM hoa_don, khach_hang, gio_hang WHERE gio_hang.id_gio_hang=hoa_don.id_gio_hang and gio_hang.id_kh=khach_hang.id_kh ORDER BY hoa_don.id_hd DESC");
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count / 5);
                    ?>
                 <div class="paging">
                     <p style="display: flex;align-items: center;">Tổng số trang <?php echo $trang ?> </p>
                     <ul class="page_list">
                         <?php
                            for ($i = 1; $i <= $trang; $i++) {
                            ?>
                             <li <?php
                                    if ($i == $page) {
                                        echo 'style="background-color: #4e73df;"';
                                    } else {
                                        echo '';
                                    }
                                    ?>> <a href="index.php?action=hoadon&query=danhsach&trang=<?php echo $i ?>"><?php echo $i ?></a>
                             </li>
                         <?php
                            }
                            ?>
                     </ul>
                 </div>
             </div>

         </div>

     </div>
 </div>
 <div class="modal-content1" id="onin">
     <script>
         function getdata() {

             var idhd = id_hd;
             // alert(idhd);

             $.ajax({
                 url: "includes/hoadon/inhoadon.php",
                 type: "POST",
                 data: {
                     idhd: idhd
                 },
                 success: function(data) {
                     // $(".modal-content1").html(data);
                     document.getElementById(`onin`).style.display = "block";
                     document.getElementById('accordionSidebar').style.display = "none";
                     document.getElementById('dshd').style.display = "none";
                     window.print($(".modal-content1").html(data));
                 }
             })
         }
     </script>
     <script>
         function back() {
             document.getElementById(`accordionSidebar`).style.display = "block";
             document.getElementById(`dshd`).style.display = "block";
             document.getElementById(`onin`).style.display = "none";
         }
     </script>

     <script>
         function hien() {
             document.getElementById("demo").style.display = "block";
         }

         function an() {
             document.getElementById("demo").style.display = "none";
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