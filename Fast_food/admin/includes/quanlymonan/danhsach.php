<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="js/sb-admin-2.min.js"></script> -->
<!-- thu nhỏ cửa sổ-->
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
$sql_lietke_sp = "SELECT DISTINCT *FROM mon_an AS m, loai_mon_an AS lm, gia AS g
WHERE (m.id_loai_mon_an = lm.id_loai_mon_an) AND (m.id_mon_an = g.id_mon_an) ORDER BY m.id_mon_an DESC LIMIT $begin,5";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:650px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm món ăn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/quanlymonan/xuly.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Loại món ăn</label>
                        <table style="width: 100%;">
                            <td>
                                <select name="loai_mon_an" style="width: 100%;" class="form-control">
                                    <option value="">Vui lòng chọn loại món ăn</option>
                                    <?php
                                    $sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an ASC";
                                    $query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);

                                    while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                                    ?>
                                        <option value="<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>"><?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </table>
                    </div>
                    <div class="form-group">
                        <label>Tên món ăn</label>
                        <input type="text" name="ten_mon_an" class="form-control" placeholder="Nhập tên món ăn">
                    </div>
                    <div class="form-group">
                        <label>Ảnh món ăn</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="anhmon">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Giá món ăn</label>
                        <input type="text" name="gia" class="form-control" placeholder="Nhập giá món ăn">
                    </div>
                    <!-- <div class="form-group">
                        <label>Số lượng món ăn</label>
                        <input type="number" min="1" max="100" name="soluong" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label>Thành phần dinh dưỡng</label>
                        <table style="width: 100%;">
                            <tr>
                                <td style="padding-left: 3px;">
                                    <select name="thanh_phan" id="thongso" style="width: 100%;" class="form-control">
                                        <option value="">Vui lòng chọn thành phần</option>
                                        <?php
                                        $query_tp = "SELECT * FROM `thanh_phan`ORDER BY id_tp ASC";
                                        $datasql = mysqli_query($mysqli, $query_tp);
                                        unset($data);
                                        while ($rowtp = mysqli_fetch_array($datasql, 1)) {
                                            $data[] = $rowtp;
                                        }
                                        if (!empty($data)) {
                                            for ($tmp = 0; $tmp < count($data); $tmp++) {
                                        ?>
                                                <option value="<?php echo $data[$tmp]['ten_tp'] ?>"><?php echo $data[$tmp]['ten_tp'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </td>

                                <td style="padding-left: 3px;">
                                    <div class="giatrithongso">
                                        <input type="text" class="form-control" id="giatrithongso" placeholder="Giá trị thông số" />
                                    </div>
                                </td>

                                <td style="padding-left: 3px;">
                                    <input type="button" class="btn btn-secondary" value="Thêm" onclick="thongsochitiet.value = thongsochitiet.value+thongso.value+': '+giatrithongso.value+'\n'">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group thongsochitiet">
                        <textarea class="form-control" name="themsp-thongso" id="thongsochitiet" aria-label="With textarea" placeholder="Vui lòng chọn thông số sản phẩm ở bên trên" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <input type="textarea" name="mota" class="form-control" placeholder="Mô tả món ăn">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" name="themmonan" class="btn btn-primary">Lưu</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="container-fluid">
    <?php
    if (isset($_SESSION['message_add_mon'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_add_mon']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message_add_mon']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_edit_mon'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_edit_mon']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message_edit_mon']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_delete'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_delete']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message_delete']);
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php
            if (isset($_SESSION['add'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey !</strong> <?= $_SESSION['add']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['add']);
            }
            ?>
            <h6 class="m-0 font-weight-bold text-primary">Danh sách món ăn
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Thêm món ăn
                </button>
            </h6>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <div class="input-group">
                        <select class="custom-select" id="idloai">
                            <option hidden>Tìm kiếm món ăn theo Loại</option>
                            <option value="0">Tất cả</option>
                            <?php
                            $sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an";
                            $query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);
                            while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                            ?>
                                <option class="timtenloai" value="<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>"><?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                </ul>
                <script>
                    $(document).ready(function() {
                        const btn = document.querySelectorAll(".timtenloai")
                        document.getElementById('idloai').addEventListener('change', function() {
                            id_loai = $("#idloai").val();

                            if (id_loai == 0) {
                                window.location = "index.php?action=quanlymonan&query=danhsach";
                            }
                            $.ajax({
                                url: "includes/quanlymonan/xuly.php",
                                type: "POST",
                                data: {
                                    id_loai: id_loai
                                },
                                success: function(data) {
                                    $(".hientenloai").html(data);
                                    document.getElementById('all1').style.display = "none";
                                    document.getElementById('all2').style.display = "none";
                                }
                            })
                            // }
                        });
                    });
                </script>
                <form method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light small" id="searchinput" placeholder="Tên món ăn..." aria-label="Search" name="keyword" aria-describedby="basic-addon2">
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
                            url: "includes/quanlymonan/xuly.php",
                            type: "POST",
                            data: {
                                input: input
                            },
                            success: function(data) {
                                $(".searchresult").html(data);
                                $(".hientenloai").css("display", "none");
                                document.getElementById('all2').style.display = "none";
                                $(".searchresult").css("display", "block");
                            }
                        })
                    } else {
                        location.reload(true);
                    }
                })
            })
        </script>
        <div class="hientenloai"></div>
        <div class="searchresult">
            <div class="card-body" id="all1">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th>Tên món ăn</th>
                                <th>Ảnh món ăn</th>
                                <th>Giá</th>
                                <th>Mô tả</th>
                                <th style="width: 114px;">Khuyến mãi</th>
                                <th style=" width: 101px;">Trạng thái</th>
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($query_lietke_sp)) {
                                $i++;
                            ?>
                                <tr>
                                    <td> <?php echo $i ?></td>
                                    <!-- <td><?php echo $row['ten_loai_mon_an'] ?></td> -->
                                    <td> <?php echo $row['ten_mon_an'] ?></td>
                                    <td> <img src="includes/quanlymonan/uploads/<?php echo $row['anh_mon_an'] ?>" width="200px" height="150px"> </td>
                                    <td><?php echo number_format($row['gia'], 0, ',', '.') . 'đ'; ?></td>
                                    <!-- <td>
                                        <?php
                                        if ($row['soluong'] > 0) {
                                            echo $row['soluong'];
                                        } else {
                                            echo 0;
                                        }
                                        ?>
                                    </td> -->
                                    <td><?php echo $row['mo_ta_mon'] ?></td>


                                    <script>
                                        function getdataidkm() {
                                            var id_monan_km = id_monan_km_xoa;
                                            $.ajax({
                                                url: "includes/quanlymonan/sua.php",
                                                type: "POST",
                                                data: {
                                                    id_monan_km: id_monan_km
                                                },
                                                success: function(data) {
                                                    $(".hienbanxoa").html(data);
                                                }
                                            })
                                        }
                                    </script>
                                    <td>
                                        <?php
                                        $sql_khuyenmai = "SELECT DISTINCT* FROM mon_an,chi_tiet_khuyen_mai,khuyen_mai where 
                                         khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and  mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and chi_tiet_khuyen_mai.id_mon_an='" . $row['id_mon_an'] . "'";
                                        $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                        $row_km = mysqli_fetch_array($query_km);
                                        $today = date('Y-m-d 00:00:00');
                                        if (isset($row_km['id_km'])) {
                                            if ($row_km['ngay_kt'] > $today) {
                                                ?>
                                                    <p style="text-align: center;">
                                                        <?php
                                                        $ten = $row_km['ten_km'];
                                                        $giakm = $row_km['gia_tri_khuyen_mai'];
                                                        ?>
                                                        <?php echo $ten ?><br>
                                                        <span><?php echo number_format($giakm, 0, ',', '.') . 'đ'; ?></span><br>
                                                    </p>
                                            <?php
                                                
                                            }
                                        } else {
                                            ?>

                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($row['soluong'] > 0) {
                                            echo 'Sẳn hàng';
                                        } elseif ($row['soluong'] <= 0) {
                                            echo 'Hết hàng';
                                            $sqlupdate2 = "UPDATE mon_an SET trang_thai= 2 WHERE id_mon_an= '" . $row['id_mon_an'] . "'";
                                            $queryupdatekhuyenmai2 = mysqli_query($mysqli, $sqlupdate2);
                                        } ?>

                                    </td>
                                    <td style="width: 128px; padding: 5px;">
                                        <a class="btn" data-toggle="modal" data-target="#onmodalupdate" style="font-size: 23px;color: #4e73df;padding:0px;padding-left:10px" onclick="getdata(id_mon=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-info btn-sm">Sửa</button></a>
                                        <div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="max-width:650px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sửa món ăn</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn" data-target="#logoutModal1" data-toggle="modal" style="color: #ff3333;font-size: 23px;padding:0px" onclick="getdataxoa(id_monan=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></a>
                                        <div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa món ăn?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-bodyxoamonan"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style=" margin: 6px;">
                                        <?php
                                        if (isset($row_km['id_km'])) {
                                        ?>
                                            <div>
                                                <a class=" btn" data-target="#logoutModal1_XOA" data-toggle="modal" style="color: #4e73df;font-size: 13px;display: block;padding:8px;" onclick="getdataidkm(id_monan_km_xoa=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-warning btn-sm">Xóa KM</button></a>
                                                <div class="modal fade" id="logoutModal1_XOA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="hienbanxoa">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div>
                                                <a class=" btn" data-target="#logoutModal1_them" data-toggle="modal" style="color: #4e73df;font-size: 13px;display: block;padding: 5px 0px;" onclick="getdataaddkm(id_monan=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Thêm KM</button></a>
                                                <div class="modal fade" id="logoutModal1_them" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="add_km">
                                                            </div>

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
            </div>
        </div>
        <script>
            function getdataaddkm() {
                var id_mon_an_add_km = id_monan;
                // alert(id_mon_xoa_km);

                $.ajax({
                    url: "includes/quanlymonan/sua.php",
                    type: "POST",
                    data: {
                        id_mon_an_add_km: id_mon_an_add_km
                    },
                    success: function(data) {
                        $(".add_km").html(data);
                    }
                })
            }

            function getdataxoakm() {
                var id_mon_xoa_km = id_monanxoa;
                // alert(id_mon_xoa_km);

                $.ajax({
                    url: "includes/quanlymonan/sua.php",
                    type: "POST",
                    data: {
                        id_mon_xoa_km: id_mon_xoa_km
                    },
                    success: function(data) {
                        $(".modal-body_KM_XOA").html(data);
                    }
                })
            }

            function getdata() {
                var IdMon = id_mon;
                // alert(IdMon);

                $.ajax({
                    url: "includes/quanlymonan/sua.php",
                    type: "POST",
                    data: {
                        IdMon: IdMon
                    },
                    success: function(data) {
                        $(".modal-body2").html(data);
                    }
                })
            }

            function getdataxoa() {
                var Id_Mon_an = id_monan;

                $.ajax({
                    url: "includes/quanlymonan/xuly.php",
                    type: "POST",
                    data: {
                        Id_Mon_an: Id_Mon_an
                    },
                    success: function(data) {
                        $(".modal-bodyxoamonan").html(data);
                    }
                })
            }
        </script>
        <?php
        $sql_trang = mysqli_query($mysqli, "SELECT DISTINCT *FROM mon_an AS m, loai_mon_an AS lm, gia AS g
WHERE (m.id_loai_mon_an = lm.id_loai_mon_an) AND (m.id_mon_an = g.id_mon_an) AND m.trang_thai='1' ORDER BY m.id_mon_an DESC");
        $row_count = mysqli_num_rows($sql_trang);
        $trang = ceil($row_count / 5);
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
                        } ?>><a href="index.php?action=quanlymonan&query=danhsach&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>

</div>

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