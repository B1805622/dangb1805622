<?php
include('../config.php');
session_start();
if (isset($_POST['update_ql'])) {
    $mk = $_POST['pass1'];
    $idql = $_GET['idql'];
    $sql_thaydoi =  "UPDATE quan_ly SET password_ql='" . $mk . "' WHERE id_ql=$idql";
    mysqli_query($mysqli, $sql_thaydoi);
    if ($sql_thaydoi) {
        $_SESSION['message'] = 'Cập nhật mật khẩu thành công';
        header('Location:../../index.php?action=taikhoan&query=thongtin');
        exit(0);
    }
} elseif (isset($_POST['update_tk_ql'])) {
    $tdn = $_POST['tdn'];
    $idql = $_GET['idql'];
    $ten_ql = $_POST['ten_ql'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $diachi = $_POST['dia_chi'];
    $tp = $_POST['id_tp'];
    $qh = $_POST['id_qh'];
    $px = $_POST['id_px'];
    $sql_diachixa = "SELECT * FROM `devvn_xaphuongthitran` WHERE idxa=$px";
    $query_diachixa = mysqli_query($mysqli, $sql_diachixa);
    $row_dcxa = mysqli_fetch_array($query_diachixa);
    $xa = $row_dcxa['Ten_xp'];
    $sql_diachiquan = "SELECT * FROM `devvn_quanhuyen` WHERE idqh=$qh";
    $query_diachiquan = mysqli_query($mysqli, $sql_diachiquan);
    $row_dcquan = mysqli_fetch_array($query_diachiquan);
    $quan = $row_dcquan['Ten_qh'];
    $sql_diachitinh = "SELECT * FROM `devvn_tinhthanhpho` WHERE idtp=$tp";
    $query_diachitinh = mysqli_query($mysqli, $sql_diachitinh);
    $row_dctinh = mysqli_fetch_array($query_diachitinh);
    $tinh = $row_dctinh['Ten_tp'];
    $diachigoc = $diachi . ',' . $xa . ',' . $quan . ',' . $tinh;
    $sql_thaydoi =  "UPDATE quan_ly SET ten_ql='" . $ten_ql . "', dia_chi='" . $diachigoc . "', email_ql='" . $email . "',
                    sdt_ql='" . $sdt . "',username_ql='" . $tdn . "'WHERE id_ql=$idql";
    mysqli_query($mysqli, $sql_thaydoi);
    if ($sql_thaydoi) {
        $_SESSION['message'] = 'Cập nhật thông tin thành công';
        header('Location:../../index.php?action=taikhoan&query=thongtin');
        exit(0);
    }
} elseif (isset($_POST['id_tinh'])) {
    $id_tinh = $_POST['id_tinh'];
    // echo  $id_quan;
    $sql_quan = "SELECT *FROM devvn_quanhuyen where idtp=$id_tinh and idqh=916";
    $query_quan = mysqli_query($mysqli, $sql_quan);
    $numquan = mysqli_num_rows($query_quan);
    if ($numquan > 0) {
?>
        <option>Chọn Quận/huyện</option>
        <?php
        while ($row_quan = mysqli_fetch_array($query_quan)) {
        ?>
            <option value="<?php echo $row_quan['idqh'] ?>"><?php echo $row_quan['Ten_qh'] ?></option>
        <?php
        }
    } else {
        echo 0;
    }
} elseif (isset($_POST['id_quan'])) {
    $id_quan = $_POST['id_quan'];
    // echo  $id_quan;
    $sql_xa = "SELECT *FROM devvn_xaphuongthitran where idqh=$id_quan";
    $query_xa = mysqli_query($mysqli, $sql_xa);
    $numxa = mysqli_num_rows($query_xa);
    if ($numxa > 0) {
        ?>
        <option selected>Chọn Phường xã</option>
        <?php
        while ($row_xa = mysqli_fetch_array($query_xa)) {
        ?>
            <option value="<?php echo $row_xa['idxa'] ?>"><?php echo $row_xa['Ten_xp'] ?></option>
<?php
        }
    } else {
        echo 0;
    }
}
