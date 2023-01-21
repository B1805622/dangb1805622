<?php
include('../config.php');
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");

if (isset($_POST['IDMONAN'])) {
    $id_mon_an = $_POST['IDMONAN'];
    $sql_sua_km = "SELECT * FROM khuyen_mai,chi_tiet_khuyen_mai,mon_an WHERE khuyen_mai.id_km=chi_tiet_khuyen_mai.id_km and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and chi_tiet_khuyen_mai.id_mon_an= $id_mon_an LIMIT 1";
    $query_sua_km = mysqli_query($mysqli, $sql_sua_km);
    $num = mysqli_num_rows($query_sua_km);
    if ($num > 0) {

        while ($row1 = mysqli_fetch_array($query_sua_km)) {
?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa Khuyến mãi : <span><?php echo $row1['ten_mon_an'] ?></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/khuyenmai/xuly2.php?IDKM=<?php echo $row1['id_km'] ?>&id_mon_an=<?php echo $row1['id_mon_an'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Trị giá</label>
                        <input type="number" name="trigia" class="form-control" value="<?php echo $row1['gia_tri_khuyen_mai'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Số lượng khuyến mãi</label>
                        <input type="number" min="1" max="100" name="soluong" class="form-control" value="<?php echo $row1['soluong_km'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="sua_km" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
        <?php
        }
    } else {
    }
} elseif (isset($_POST['IDKM2'])) {
    $id_km2 = $_POST['IDKM2'];
    $sql_sua_km = "SELECT * FROM khuyen_mai WHERE id_km= $id_km2 LIMIT 1";
    $query_sua_km = mysqli_query($mysqli, $sql_sua_km);
    $num = mysqli_num_rows($query_sua_km);
    if ($num > 0) {

        while ($row1 = mysqli_fetch_array($query_sua_km)) {
        ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa Khuyến mãi : <span><?php echo $row1['ten_km'] ?></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/khuyenmai/xuly2.php?IDKM=<?php echo $row1['id_km'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên khuyến mãi</label>
                        <input type="text" name="ten_km" class="form-control" value="<?php echo $row1['ten_km'] ?>">
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
                                <textarea class="form-control" name="tenmon" id="thongsochitiet" aria-label="With textarea" placeholder="Vui lòng chọn món ăn ở bên trên" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trị giá</label>
                        <input type="number" name="trigia" class="form-control">
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
                        <input type="text" name="noidungkm" class="form-control" value="<?php echo $row1['noi_dung_km'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <table>
                            <td style="border: none;">
                                <input type="radio" id="ss" name="trang_thai" value="1" checked>
                                <label for="ss">Kích hoạt</label>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="hh" name="trang_thai" value="2">
                                <label for="css">Ngừng áp dụng</label>
                            </td>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="sua_km2" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
        <?php
        }
    } else {
    }
} elseif (isset($_POST['sua_km2'])) {
    $idkm = $_GET['IDKM'];
    $ten_km = $_POST['ten_km'];
    $noidung = $_POST['noidungkm'];
    $ngaybd = $_POST['dateon'];
    $trigia = $_POST['trigia'];
    $ngaykt = $_POST['dateoff'];
    $trangthai = $_POST['trang_thai'];
    $soluong = $_POST['soluong'];
    $sql_update_km2 = "UPDATE khuyen_mai SET  ten_km= '" . $ten_km . "',ngay_bd='" . $ngaybd . "',ngay_kt='" . $ngaykt . "',noi_dung_km='" . $noidung . "',trang_thai_km='" . $trangthai . "' WHERE id_km=$idkm  ";
    $add1 = mysqli_query($mysqli, $sql_update_km2);
    if ($sql_update_km2) {
        $ten_mon_an1 = $_POST['tenmon'];
        $ts = explode(',', $ten_mon_an1);
        foreach ($ts as $tso) {
            unset($thso);
            unset($data);
            $thso = explode(': ', $tso);

            $thso[0] = trim($thso[0]);

            $query = "SELECT `id_mon_an` FROM `mon_an` WHERE `ten_mon_an`='" . $thso[0] . "'";
            $datasql = mysqli_query($mysqli, $query);
            while ($row = mysqli_fetch_array($datasql, 1)) {
                $data[] = $row;
            }
            if (isset($data)) {
                for ($i = 0; $i < count($data); $i++) {
                    $id_mon_an = $data[$i]['id_mon_an'];
                    $sql_them_ctkm1 = "INSERT INTO chi_tiet_khuyen_mai(id_km,id_mon_an,gia_tri_khuyen_mai,soluong_km) 
			     VALUE('" . $idkm . "','" . $id_mon_an . "','" . $trigia . "','" . $soluong . "')";
                    $query1 = mysqli_query($mysqli, $sql_them_ctkm1);
                }
            } else {
                break;
            }
        }
    }
    if ($add1) {
        $_SESSION['message'] = 'Sửa khuyến mãi thành công';
        header('Location:../../index.php?action=khuyenmai&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message'] = 'Sửa thất bại';
        header('Location:../../index.php?action=khuyenmai&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['sua_km'])) {
    $id_mon_an_km = $_GET['id_mon_an'];
    $idkm = $_GET['IDKM'];
    $trigia = $_POST['trigia'];
    $soluong = $_POST['soluong'];
    $sql_update_ctkm = "UPDATE chi_tiet_khuyen_mai SET  gia_tri_khuyen_mai= '" . $trigia . "',soluong_km='" . $soluong . "' WHERE id_km=$idkm and id_mon_an=$id_mon_an_km";
    $add2 = mysqli_query($mysqli, $sql_update_ctkm);
    if ($add1 & $add2) {
        $_SESSION['message'] = 'Sửa khuyến mãi thành công';
        header("Location:../../index.php?action=khuyenmai&query=xem&idkm=$idkm");

        exit(0);
    } else {
        $_SESSION['message'] = 'Sửa thất bại';
        header("Location:../../index.php?action=khuyenmai&query=xem&idkm=$idkm");
        exit(0);
    }
} elseif (isset($_POST['id_mon'])) {
    $idkmxoa = $_POST['id_mon'];
    $sql_xoa_km = "SELECT * FROM mon_an, khuyen_mai, chi_tiet_khuyen_mai WHERE mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an AND khuyen_mai.id_km=chi_tiet_khuyen_mai.id_km and  chi_tiet_khuyen_mai.id_mon_an = '$idkmxoa' LIMIT 1";
    $query_mon_xoa = mysqli_query($mysqli, $sql_xoa_km);
    $numxoa = mysqli_num_rows($query_mon_xoa);
    if ($numxoa > 0) {

        while ($row_xoa = mysqli_fetch_array($query_mon_xoa)) {
        ?>
            <p>Chọn "Xóa" để xóa khuyến mãi của món ăn: <span style="color: red ;"><?php echo $row_xoa['ten_mon_an'] ?></span></p>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                <form action="" method="POST">
                    <a href="includes/khuyenmai/xuly2.php?IDKM=<?php echo $row_xoa['id_km'] ?>&idmon=<?php echo $idkmxoa  ?>" class="btn btn-primary">Xóa</a>
                </form>
            </div>
<?php
        }
    }
} else {
    $id = $_GET['IDKM'];
    $id_mon = $_GET['idmon'];

    // $sql_xoa = "DELETE FROM khuyen_mai WHERE id_km ='" . $id . "'";
    $sql_update_trang_thai_km = "DELETE FROM `chi_tiet_khuyen_mai` WHERE id_km= '" . $id . "' and id_mon_an='" . $id_mon . "'";
    $query_xoa = mysqli_query($mysqli, $sql_update_trang_thai_km);
    if ($query_xoa) {
        $_SESSION['message'] = 'Khuyến mãi đã được xóa';
        header("Location:../../index.php?action=khuyenmai&query=xem&idkm=$id");
        exit(0);
    }
}
?>