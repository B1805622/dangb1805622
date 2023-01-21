<?php
session_start();
include('../../admin/includes/config.php');
require('../../carbon/autoload.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
if (isset($_POST['addbinhluan'])) {
    $id = $_GET['IdMon'];

    // $soluong = 1;
    if (!isset($_SESSION['id_kh'])) {
        $_SESSION['login-cart'] = "Đăng nhập để bình luận bạn nhé";
        header("Location:../../index.php?quanly=monan&IdMon=$id");
    } else {
        $id_kh = $_SESSION['id_kh'];
        $noidung = $_POST['subject'];
        $star = $_POST['star'];
        // echo $noidung;
        $insert_bl = "INSERT INTO binh_luan_danh_gia(id_kh,id_mon_an,noi_dung,diem_dg,thoi_gian,trang_thai_bl) VALUE ('" . $id_kh . "','" . $id . "','" . $noidung . "','" . $star . "','" . $now . "',1)";
        $cart_query =  mysqli_query($mysqli, $insert_bl);
        $_SESSION['ss_bl'] = "Bình luận của bạn đã được ghi nhận";
    }
    header("Location:../../index.php?quanly=monan&IdMon=$id");
} elseif (isset($_POST['rep'])) {
    $reply = $_POST['reply'];
    // echo " $reply";
    $id_bl = $_GET['IdBL'];
    $id = $_GET['IdMon'];
    // echo "$id_bl";
    $id_ql = $_SESSION['id_ql'];
    // echo "$id_ql";
    $sql_update_rep = "INSERT INTO tra_loi_binh_luan(id_binh_luan,id_ql,tra_loi) VALUE ('" . $id_bl . "','" . $id_ql . "','" . $reply . "')";
    $query = mysqli_query($mysqli, $sql_update_rep);
    $sql_update_trangthai = "UPDATE binh_luan_danh_gia SET trang_thai_bl=2 WHERE id_binh_luan='$id_bl'";
    $query_trangthai = mysqli_query($mysqli, $sql_update_trangthai);
    $_SESSION['ss_reply'] = "Trả lời của bạn đã được ghi nhận";
    header("Location:../../index.php?quanly=monan&IdMon=$id");
} elseif (isset($_POST['rep_edit'])) {
    $reply = $_POST['reply'];
    // echo " $reply";
    $id_bl = $_GET['IdBL'];
    $id = $_GET['IdMon'];
    // echo "$id_bl";
    $id_ql = $_SESSION['id_ql'];
    // echo "$id_ql";
    //xoa bl
    $delete_bl = "DELETE FROM `tra_loi_binh_luan` WHERE id_binh_luan='$id_bl'";
    $query_bl = mysqli_query($mysqli, $delete_bl);
    if ($delete_bl) {
        $sql_update_rep = "INSERT INTO tra_loi_binh_luan(id_binh_luan,id_ql,tra_loi) VALUE ('" . $id_bl . "','" . $id_ql . "','" . $reply . "')";
        $query = mysqli_query($mysqli, $sql_update_rep);
        $_SESSION['ss_reply'] = "Thay đổi bình luận thành công";
        header("Location:../../index.php?quanly=monan&IdMon=$id");
    }
} elseif (isset($_POST['report'])) {
    $id_bl = $_GET['IdBL'];
    $id = $_GET['IdMon'];
    $sql_update_rep = "UPDATE binh_luan_danh_gia SET baocao=1 WHERE id_binh_luan='$id_bl'";
    $query = mysqli_query($mysqli, $sql_update_rep);
    $_SESSION['ss_reply'] = "Báo cáo bình luận thành công";
    header("Location:../../index.php?quanly=monan&IdMon=$id");
}
