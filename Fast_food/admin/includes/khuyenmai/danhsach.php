<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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

$sql_lietke_km = "SELECT DISTINCT* FROM khuyen_mai  ORDER BY khuyen_mai.trang_thai_km ASC LIMIT $begin,5";
$query_lietke_km = mysqli_query($mysqli, $sql_lietke_km);
?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm khuyến mãi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/khuyenmai/xuly.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên khuyến mãi (CODE)</label>
                        <input type="text" name="ten_km" class="form-control" placeholder="Nhập tên khuyến mãi">
                    </div>
                    <div class="form-group">
                        <label>Danh mục áp dụng</label>
                        <div class="form-group" id="thanhsearch">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 394px;">
                                        <select name="thanh_phan" id="thongso" style="width: 100%;" class="form-control">
                                            <option value="">Vui lòng chọn món ăn</option>
                                            <?php
                                            $query_tp = "SELECT mon_an.id_mon_an, mon_an.ten_mon_an FROM mon_an LEFT JOIN chi_tiet_khuyen_mai ON mon_an.id_mon_an = chi_tiet_khuyen_mai.id_mon_an WHERE chi_tiet_khuyen_mai.id_mon_an IS NULL ORDER BY mon_an.id_mon_an;";
                                            $datasql = mysqli_query($mysqli, $query_tp);
                                            unset($data);
                                            while ($rowtp = mysqli_fetch_array($datasql, 1)) {
                                                $data[] = $rowtp;
                                            }

                                            if (!empty($data)) {
                                                for ($tmp = 0; $tmp < count($data); $tmp++) {
                                            ?>
                                                    <option value="<?php echo $data[$tmp]['ten_mon_an'] ?>"><?php echo $data[$tmp]['ten_mon_an'] ?></option>
                                            <?php
                                                }
                                            }

                                            ?>

                                        </select>
                                    </td>
                                    <td style="padding-left: 3px;">
                                        <input type="button" class="btn btn-secondary" value="Thêm" onclick="thongsochitiet.value = thongsochitiet.value+thongso.value+',\n'">
                                    </td>
                                </tr>
                            </table>
                            <div class="form-group thongsochitiet">
                                <textarea class="form-control" name="themsp-thongso" id="thongsochitiet" aria-label="With textarea" placeholder="Vui lòng chọn món ăn ở bên trên" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trị giá</label>
                        <input type="number" name="trigia" class="form-control" step="1000">
                    </div>
                    <div class="form-group">
                        <label>Ảnh Khuyến mãi</label>
                        <div class="custom-file">
                            <label>Ảnh khuyến mãi</label>
                            <input type="file" class="custom-file-input" id="customFile" name="anh_loai">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu </label>
                        <input type="datetime-local" name="dateon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="datetime-local" name="dateoff" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Số lượng khuyến mãi</label>
                        <input type="number" min="1" max="100" name="soluong" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nội dung khuyến mãi</label>
                        <input type="textarea" name="noidung" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" name="themkhuyenmai" class="btn btn-primary">Lưu</button>
                </div>
            </form>

        </div>
    </div>
</div>
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
        <strong>Không thể xóa</strong>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách khuyến mãi
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Thêm khuyến mãi
                </button>
            </h6>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                </ul>
                <form action="?action=quanlyloai&query=timkiem" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light small" id="searchinput" placeholder="Tên khuyến mãi..." aria-label="Search" name="keyword" aria-describedby="basic-addon2">
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
                            url: "includes/khuyenmai/xuly.php",
                            type: "POST",
                            data: {
                                input: input
                            },
                            success: function(data) {
                                // document.getElementById
                                $(".searchresult").html(data);
                                $(".searchresult").css("display", "block");
                            }
                        })
                    } else {
                        // $(".searchresult").css("display", "none");
                        location.reload(true);
                    }
                })
            })
        </script>
        <div class="searchresult">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatableid" class="table table-bordered">
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th>Tên khuyến mãi</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th colspan="2">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($query_lietke_km)) {
                                $i++;
                            ?>
                                <tr>
                                    <td> <?php echo $i ?></td>
                                    <td><?php echo $row['ten_km'] ?></td>


                                    <td><?php
                                        $datebd = date_create($row['ngay_bd']);
                                        echo date_format($datebd, "d-m-Y");
                                        ?></td>
                                    <td><?php
                                        $datekt = date_create($row['ngay_kt']);
                                        echo date_format($datekt, "d-m-Y");
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sql_lietke_ctkm = "SELECT DISTINCT* FROM khuyen_mai, chi_tiet_khuyen_mai,mon_an where mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and  khuyen_mai.id_km=chi_tiet_khuyen_mai.id_km and chi_tiet_khuyen_mai.id_km='" . $row['id_km'] . "'";
                                        $query_lietke_ctkm = mysqli_query($mysqli, $sql_lietke_ctkm);
                                        $rowctkm = mysqli_fetch_array($query_lietke_ctkm);
                                        $today = date('Y-m-d 00:00:00');
                                        if ($row['trang_thai_km'] == 1) {
                                            if ($row['ngay_kt'] > $today) {
                                                echo "<span style='color: #0099ff;'>Đang áp dụng</span>";
                                            } elseif ($row['ngay_kt'] < $today) {
                                                echo "Ngừng áp dụng";
                                                $sqlupdate2 = "UPDATE khuyen_mai SET trang_thai_km= 2 WHERE id_km= '" . $row['id_km'] . "'";
                                                $queryupdatekhuyenmai2 = mysqli_query($mysqli, $sqlupdate2);
                                                $sqlupdate3 = "DELETE FROM `chi_tiet_khuyen_mai` WHERE id_km= '" . $row['id_km'] . "'";
                                                $queryupdatekhuyenmai3 = mysqli_query($mysqli, $sqlupdate3);
                                            }
                                        } else {
                                            echo "Ngừng áp dụng";
                                            $sqlupdate2 = "UPDATE khuyen_mai SET trang_thai_km= 2 WHERE id_km= '" . $row['id_km'] . "'";
                                            $queryupdatekhuyenmai2 = mysqli_query($mysqli, $sqlupdate2);
                                            $sqlupdate3 = "DELETE FROM `chi_tiet_khuyen_mai` WHERE id_km= '" . $row['id_km'] . "'";
                                            $queryupdatekhuyenmai3 = mysqli_query($mysqli, $sqlupdate3);
                                        }
                                        if (isset($rowctkm['id_km'])) {
                                            if ($rowctkm['soluong_km'] == 0) {
                                                $sqlupdate3 = "DELETE FROM `chi_tiet_khuyen_mai` WHERE id_km= '" . $rowctkm['id_km'] . "' AND  id_mon_an=  '" . $rowctkm['id_mon_an'] . "'";
                                                $queryupdatekhuyenmai3 = mysqli_query($mysqli, $sqlupdate3);
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="index.php?action=khuyenmai&query=xem&idkm=<?php echo $row['id_km'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>

                                        <?php
                                        if ($row['trang_thai_km'] == 1) {
                                        ?>
                                            <a class="btn" data-toggle="modal" data-target="#onmodalupdatekm" style="padding:0px" onclick="getdatasuakmmonan(id_km=<?php echo $row['id_km'] ?>)"><button type="button" class="btn btn-outline-secondary btn-sm">Sửa</button></a>
                                            <div class="modal fade" id="onmodalupdatekm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="suakhuyenmai">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn" data-target="#logoutModal1" data-toggle="modal" style="padding:0px" onclick="getdataxoakm(Idmon=<?php echo $row['id_km'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Ngưng áp dụng</button></a>
                                            <div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa khuyến mãi ?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"></div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } elseif ($row['trang_thai_km'] == 2) {
                                        ?>
                                            <a class="btn" data-toggle="modal" data-target="#onmodalupdatekm2" style="padding:0px" onclick="getdatasuakmmonan2(id_km=<?php echo $row['id_km'] ?>)"><button type="button" class="btn btn-outline-secondary btn-sm">Sửa</button></a>
                                            <div class="modal fade" id="onmodalupdatekm2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="suakhuyenmai2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                $sql_trang = mysqli_query($mysqli, "SELECT DISTINCT* FROM khuyen_mai,chi_tiet_khuyen_mai,mon_an where mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and khuyen_mai.id_km=chi_tiet_khuyen_mai.id_km  ORDER BY khuyen_mai.trang_thai_km ASC");
                $row_count = mysqli_num_rows($sql_trang);
                $trang = ceil($row_count / 5);
                ?>
                <div class="paging">
                    <p style="display: flex;align-items: center;">Tổng số trang <?php echo $trang ?> </p>
                    <ul class="page_list">
                        <?php
                        for ($i = 1; $i <= $trang; $i++) {
                        ?>
                            <li <?php if ($i == $page) {
                                    echo 'style="background-color: #4e73df;"';
                                } else {
                                    echo '';
                                } ?>><a href="index.php?action=khuyenmai&query=danhsach&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
        <script>
            function getdatasuakmmonan() {
                var IDKM = id_km;
                // var tgbd = tg_bd;
                // alert(id_mon_an_km);

                $.ajax({
                    url: "includes/khuyenmai/xuly.php",
                    type: "POST",
                    data: {
                        IDKM: IDKM
                    },
                    success: function(data) {
                        $(".suakhuyenmai").html(data);
                    }
                })
            }

            function getdatasuakmmonan2() {
                var IDKM2 = id_km;
                // var tgbd = tg_bd;
                // alert(id_mon_an_km);

                $.ajax({
                    url: "includes/khuyenmai/xuly.php",
                    type: "POST",
                    data: {
                        IDKM2: IDKM2
                    },
                    success: function(data) {
                        $(".suakhuyenmai2").html(data);
                    }
                })
            }

            function getdataxoakm() {
                var id_mon = Idmon;
                // alert(id_mon);

                $.ajax({
                    url: "includes/khuyenmai/xuly.php",
                    type: "POST",
                    data: {
                        id_mon: id_mon
                    },
                    success: function(data) {
                        $(".modal-body").html(data);
                    }
                })
            }
        </script>

    </div>
</div>

<script>
    function hien() {
        document.getElementById("demo").style.display = "block";
    }

    function an() {
        document.getElementById("demo").style.display = "none";
    }
</script>
<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>
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