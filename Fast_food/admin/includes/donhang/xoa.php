<?php
include('../../includes/config.php');
session_start();
require('../../../carbon/autoload.php');
require('../../../mail/sendmail.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
if (isset($_GET['code'])) {
	$ma = $_GET['code'];
	$sql_update = "UPDATE gio_hang SET trang_thai= 4 WHERE id_gio_hang='" . $ma . "'";
	$query = mysqli_query($mysqli, $sql_update);
	if ($sql_update) {
		$sql = "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh WHERE  kh.id_kh=gh.id_kh and gh.id_gio_hang='" . $ma . "'";
		$query_laymail = mysqli_query($mysqli, $sql);
		$row_laymail = mysqli_fetch_array($query_laymail);
		$ten_kh = $row_laymail['ten_kh'];
		$mail = $row_laymail['email_kh'];
		$id_gh = $row_laymail['id_gio_hang'];
		$tieude = "Xác nhận hủy đơn hàng";
		$noidung = "<p>Kính chào quý khách <span style='color:blue'>" . $ten_kh . "</span>,</p>";
		$noidung .= "<p>Cảm ơn quý khách đã tín nhiệm dịch vụ của <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a></p>";
		$noidung .= "<p>Đơn hàng có mã: <span style='color:blue'> " . $id_gh . " </span>đã được hủy.</p>";
		$noidung .= "<h4>Chi tiết đơn hàng:</h4>";
		$noidung .= "
            <table style='font-family: arial, sans-serif; border-collapse: collapse;width: 100%; border: 2px solid;'>
                    <tr>
                        <th style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>STT</th>
                        <th style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tên món ăn</th>
                        <th style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Giá</th>
                        <th style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Khuyến mãi</th>
                        <th style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Số lượng</th>
                        <th style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tổng</th>
                    </tr>
            <tbody>";
		$sql_lietke_dh = "SELECT DISTINCT *FROM mon_an AS m, gio_hang AS gh, chi_tiet_gio_hang AS ctgh,khach_hang AS kh
WHERE(kh.id_kh=gh.id_kh) AND (m.id_mon_an = ctgh.id_mon_an) AND (gh.id_gio_hang = ctgh.id_gio_hang) AND gh.id_gio_hang='" . $ma . "' ";
		$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
		$i = 0;
		$tongtien = 0;
		$soluongmon = 0;
		while ($row1 = mysqli_fetch_array($query_lietke_dh)) {
			$ten_mon_an = $row1['ten_mon_an'];
			if ($row1['khuyen_mai_ctgh'] != "") {
				$giagoc = $row1['khuyen_mai_ctgh'] + $row1['gia_mon_an'];
				// echo number_format($giagoc,  0, ',', '.') . 'đ';
			} else {
				$giagoc = $row1['gia_mon_an'];
				// echo number_format($row1['gia_mon_an'],  0, ',', '.') . 'đ';
			}
			if ($row1['khuyen_mai_ctgh'] != "") {
				$giakm = $row1['khuyen_mai_ctgh'];
				// echo number_format($row1['khuyen_mai_ctgh'],  0, ',', '.') . 'đ';
			} else {
				$giakm = 0;
			}
			$soluong = $row1['so_luong'];
			$sl = $row1['so_luong'];
			$gia = $row1['gia_mon_an'];
			$nt = ($gia * $sl);
			// echo number_format($nt, 0, ',', '.') . 'đ';
			$sl = $row1['so_luong'];
			$gia = $row1['gia_mon_an'];
			$thanhtien = ($sl * $gia);
			$tongtien += $thanhtien;
			$soluongmonan = $row1['so_luong'] * 1;
			$soluongmon += $soluongmonan;
			$i++;
			$data[] = $row1;
			$noidung .= "
				<tr>
					<td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'> " . $i . "</td>
					<td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'> " . $ten_mon_an . "</td>
					<td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>  " . number_format($giagoc, 0, ',', '.') . "đ</td>
					<td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'> " . number_format($giakm, 0, ',', '.') . "đ</td>
					<td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'> " . $soluong . "</td>
					<td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'> " . number_format($nt, 0, ',', '.') . "đ</td>
				</tr>";
		}
		$noidung .= "
			 <tr>
            <td style='border:none;background-color: white;' colspan='3'></td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tổng</td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;' >" . $soluongmon . "</td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($tongtien, 0, ',', '.') . "đ</td>
        </tr>
           <tr>
            <td style='border:none;background-color: white;' colspan='3'></td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tổng thanh toán</td>
            <td  colspan='2' style='text-align:center;border: 1px solid #dddddd;padding: 8px; border: 2px solid;'>" . number_format($tongtien, 0, ',', '.') . "đ</td>
        </tr>
        </table>";
		$noidung .= "<p>Mọi thắc mắc xin liên hệ website tại <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a>, Hoặc liên hệ SĐT: 0973751311. Xin cảm ơn quý khách.</p>";
		$maildathang = $mail;
		$mail = new Mailerxacnhan();
		$mail->xacnhandon($tieude, $noidung, $maildathang);
	}
	$_SESSION['message_xoa'] = 'Đã hủy đơn hàng thàng công';
	header('Location:../../index.php?action=donhang&query=danhsach');
}
