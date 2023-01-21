<?php
session_start();
include('../../admin/includes/config.php');
if (isset($_POST['xoa_donhang'])) {
    $idgh = $_GET['idgh'];
    echo  $idgh;
   		$sql_update = "UPDATE gio_hang SET trang_thai= 5 WHERE id_gio_hang='" . $idgh . "'";
    //5 là trạng thái yêu cầu hủy
    $query = mysqli_query($mysqli, $sql_update);
    $_SESSION['message_duyet'] = 'Yêu cầu hủy đơn hàng '. $idgh .' đã được gửi đi.';

    header('Location:../../index.php?quanly=lichsu');
}
elseif (isset($_POST['danhanhang'])) {
    $idgh = $_GET['idgh'];
    echo  $idgh;
    $sql_update = "UPDATE gio_hang SET trang_thai= 6 WHERE id_gio_hang='" . $idgh . "'";
    //5 là trạng thái yêu cầu hủy
    $query = mysqli_query($mysqli, $sql_update);
    $_SESSION['message_duyet'] = 'Xác nhận đã thanh toán đơn hàng ' . $idgh . ' thành công.';
    header('Location:../../index.php?quanly=lichsu');
}
