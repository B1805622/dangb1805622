<?php
session_start();
include('../config.php');
if (isset($_POST['IdMon'])) {
    $id_mon = $_POST['IdMon'];
    $sql_sua_mon_an = "SELECT * FROM mon_an, gia WHERE mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an= $id_mon LIMIT 1";
    $query_sua_mon_an = mysqli_query($mysqli, $sql_sua_mon_an);
    $num = mysqli_num_rows($query_sua_mon_an);
    if ($num > 0) {
        while ($row = mysqli_fetch_array($query_sua_mon_an)) {
?>
            <form method="POST" action="includes/quanlymonan/xuly.php?idMon=<?php echo $row['id_mon_an'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Loại món ăn</label>
                        <!-- <input type="text" name="username" class="form-control" placeholder="Enter Username"> -->

                        <select name="loai_mon_an" style="width: 100%;" class="form-control">
                            <?php
                            $sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an ASC";
                            $query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);
                            while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                                if ($row_loai_mon_an['id_loai_mon_an'] == $row['id_loai_mon_an']) {
                            ?>
                                    <option selected value="<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>">
                                        <?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>">
                                        <?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên món ăn</label>
                        <input type="text" name="ten_mon_an" value="<?php echo $row['ten_mon_an'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Ảnh món ăn</label>
                        <input type="file" name="anhmon">
                        <img src="includes/quanlymonan/uploads/<?php echo $row['anh_mon_an'] ?>" width="150px">
                    </div>
                    <div class="form-group">
                        <label>Giá món ăn</label>
                        <input type="number" value="<?php echo $row['gia'] ?>" name="gia" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Số lượng món ăn</label>
                        <input type="number" value="<?php echo $row['soluong'] ?>" min="1" max="100" name="soluong" class="form-control">
                    </div>
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
                        <textarea class="form-control" name="themsp-thongso" id="thongsochitiet" aria-label="With textarea"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <input type="text" value="<?php echo $row['mo_ta_mon'] ?>" name="mo_ta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <table>
                            <td style="border: none;">
                                <input type="radio" id="ss" name="trang_thai" value="1" checked>
                                <label for="ss">Sẳn sàng</label>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="hh" name="trang_thai" value="2">
                                <label for="css">Hết hàng</label>
                            </td>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="sua_mon_an" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
        <?php
        }
        ?>
    <?php }
    ?>
    <?php
} elseif (isset($_POST['catnhatkm'])) {
    $idmon = $_GET['idmon'];
    // echo $idmon;
    echo "<br>";
    $idkm = $_POST['ten_km'];
    // echo $idkm;
    // echo "<br>";
    // $trigia = $_POST['trigia'];
    // echo $trigia;
    $sql_them_km = "INSERT INTO chi_tiet_khuyen_mai(id_km,id_mon_an,trang_thai_ct_km) 
		VALUE('" . $idkm . "','" . $idmon . "',1)";
    $add_km = mysqli_query($mysqli, $sql_them_km);
    if ($add_km) {
        $_SESSION['message_add_mon'] = 'Món ăn đã được cập nhật khuyến mãi';
        header('Location:../../index.php?action=quanlymonan&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['id_mon_xoa_km'])) {
    $idmonan_xoa_km = $_POST['id_mon_xoa_km'];
    $sql_xoa_km = "SELECT * FROM chi_tiet_khuyen_mai, khuyen_mai WHERE chi_tiet_khuyen_mai.id_km= khuyen_mai.id_km and chi_tiet_khuyen_mai.trang_thai_ct_km =1 and id_mon_an = '$idmonan_xoa_km' LIMIT 1";
    $query_mon_xoa_km = mysqli_query($mysqli, $sql_xoa_km);
    $numxoa_km = mysqli_num_rows($query_mon_xoa_km);
    if ($numxoa_km > 0) {
        while ($row_monan_xoa = mysqli_fetch_array($query_mon_xoa_km)) {
    ?>
            <div class="form-group">
                <p>Chọn "Xóa" để xóa khuyến mãi: <span style="color: red ;"><?php echo $row_monan_xoa['ten_km'] ?></span></p>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                    <form action="" method="POST">
                        <a href="includes/quanlymonan/sua.php?idMonKM=<?php echo $row_monan_xoa['id_mon_an'] ?>" class="btn btn-primary">Xóa</a>
                    </form>
                </div>
            </div>
        <?php
        }
    }
} elseif (isset($_POST['id_monan_km'])) {
    $idmonan_xoa_km = $_POST['id_monan_km'];
    $sql_xoa_km = "SELECT * FROM chi_tiet_khuyen_mai,khuyen_mai,mon_an WHERE  chi_tiet_khuyen_mai.id_mon_an=mon_an.id_mon_an and chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an = '$idmonan_xoa_km' LIMIT 1";
    $query_mon_xoa_km = mysqli_query($mysqli, $sql_xoa_km);
    $numxoa_km = mysqli_num_rows($query_mon_xoa_km);
    if ($numxoa_km > 0) {
        while ($row_monan_xoa = mysqli_fetch_array($query_mon_xoa_km)) {
        ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa khuyến mãi của: <span style="color: red;"><?php echo $row_monan_xoa['ten_mon_an'] ?></span> </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p style=" margin-bottom: 5px !important;">Chọn "Xóa" để xóa khuyến mãi:</p>
                    <p style="padding-left: 16px; margin-bottom: 5px !important;"> Tên khuyến mãi: <?php echo $row_monan_xoa['ten_km'] ?></p>
                    <p style="padding-left: 16px; margin-bottom: 5px !important;"> Giá trị khuyến mãi: <?php echo number_format($row_monan_xoa['gia_tri_khuyen_mai'], 0, ',', '.') . 'đ'; ?></span></p>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                <form action="" method="POST">
                    <a href="includes/quanlymonan/sua.php?idMonKM=<?php echo $row_monan_xoa['id_mon_an'] ?>" class="btn btn-primary">Xóa</a>
                </form>
            </div>

        <?php
        }
    }
} elseif (isset($_POST['id_mon_an_add_km'])) {
    $id_mon_km = $_POST['id_mon_an_add_km'];
    $sql_monan = "SELECT * FROM mon_an WHERE id_mon_an = '$id_mon_km' LIMIT 1";
    $querymonan = mysqli_query($mysqli, $sql_monan);
    $nummonan = mysqli_num_rows($querymonan);
    if ($nummonan > 0) {
        while ($rowmonan = mysqli_fetch_array($querymonan)) {
        ?>
            <form method="POST" action="includes/quanlymonan/xuly.php?idmonankm=<?php echo $rowmonan['id_mon_an'] ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm khuyến mãi món ăn: <span style="color: red;font-size: 16px;"><?php echo $rowmonan['ten_mon_an'] ?></span> </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p style=" margin-bottom: 5px !important;">Chọn khuyến mãi:</p>
                        <select name="km" style="width: 100%;" class="form-control">
                            <option value="">Vui lòng chọn khuyến mãi</option>
                            <?php
                            $sql_km = "SELECT * FROM khuyen_mai where trang_thai_km=1 ORDER BY id_km DESC";
                            $query_km = mysqli_query($mysqli, $sql_km);

                            while ($row_km = mysqli_fetch_array($query_km)) {
                            ?>
                                <option value="<?php echo $row_km['id_km'] ?>"><?php echo $row_km['ten_km'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Giá trị khuyến mãi</label>
                        <input type="text" name="gia_tri" class="form-control" placeholder="Nhập giá món ăn">
                    </div>
                    <div class="form-group">
                        <label>Số lượng khuyến mãi</label>
                        <input type="number" min="1" max="100" name="soluong_km" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="addkmmonan" class="btn btn-primary">Thêm</button>
                </div>
            </form>

<?php
        }
    }
} else {
    $id = $_GET['idMonKM'];
    $sql_update_trang_thai_ctkm = "DELETE FROM chi_tiet_khuyen_mai  WHERE id_mon_an='" . $id . "' ";
    $query_xoa_km = mysqli_query($mysqli, $sql_update_trang_thai_ctkm);
    if ($query_xoa_km) {
        $_SESSION['message_delete'] = 'Xóa thành công';
        header('Location:../../index.php?action=quanlymonan&query=danhsach');
        exit(0);
    }
}
