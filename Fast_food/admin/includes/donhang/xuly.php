<?php
include('../../includes/config.php');
session_start();
require('../../../carbon/autoload.php');
require('../../../mail/sendmail.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
if (isset($_GET['code'])) {
	$code_cart = $_GET['code'];
	$tinhtrang = $_GET['tinh_trang'];
	// echo $tinhtrang;
	if ($tinhtrang == 1) {
		$sql_update = "UPDATE gio_hang SET trang_thai= 2 WHERE id_gio_hang='" . $code_cart . "'";
		$query = mysqli_query($mysqli, $sql_update);
		$_SESSION['message_duyet'] = 'Duyệt đơn hàng thành công';
		header('Location:../../index.php?action=donhang&query=danhsach');
	} elseif ($tinhtrang == 2) {
		$today = date('Y-m-d');
		echo $today;
		$sql_thongke = "SELECT * FROM thongke WHERE ngay_dat= '$today'";
		$query_thongke = mysqli_query($mysqli, $sql_thongke);
		// echo "id gio hang: $code_cart";
		$id_ql = $_SESSION['id_ql'];
		echo "<br>";
		// echo "id quan ly: $id_ql";
		$sql_lietke_giohang = "SELECT *FROM mon_an AS m, gio_hang AS gh, chi_tiet_gio_hang AS ctgh,khach_hang AS kh
WHERE(kh.id_kh=gh.id_kh) AND (m.id_mon_an = ctgh.id_mon_an) AND (gh.id_gio_hang = ctgh.id_gio_hang)AND m.id_mon_an=ctgh.id_mon_an AND gh.id_gio_hang='" . $code_cart . "' ";
		$query_lietkegiohang = mysqli_query($mysqli, $sql_lietke_giohang);
		$tongthanhtoan = 0;
		while ($row = mysqli_fetch_array($query_lietkegiohang)) {
			$data[] = $row;
			$thanhtien = $row['gia_mon_an'] * $row['so_luong'];
			$tongthanhtoan += $thanhtien;
			$id_kh = $row['id_kh'];
			$dia_chi = $row['dia_chi_kh'];
		}
		for ($i = 0; $i <  count($data); $i++) {
			$tenmon = $data[$i]['ten_mon_an'];
			$soluongdat = $data[$i]['so_luong'];
			$id_mon_an = $data[$i]['id_mon_an'];
			$soluongkho = $data[$i]['soluong'];
			$ton = $soluongkho - $soluongdat;
			$sql_update_sl_mon = "UPDATE mon_an SET soluong= $ton WHERE id_mon_an= $id_mon_an";
			$query = mysqli_query($mysqli, $sql_update_sl_mon);
			echo '<script language="javascript">';
			echo 'alert(message successfully sent)';
			echo '</script>';
		}
		$sql_lietkedonhang = "SELECT * FROM gio_hang, chi_tiet_gio_hang WHERE gio_hang.id_gio_hang= chi_tiet_gio_hang.id_gio_hang and gio_hang.id_gio_hang= '$code_cart'";
		$query_lietkedonhang = mysqli_query($mysqli, $sql_lietkedonhang);

		// $num= mysqli_num_rows($query_thongke);
		$soluong = 0;
		$doanhthu = 0;
		while ($row1 = mysqli_fetch_array($query_lietkedonhang)) {
			$soluong += $row1['so_luong'];
			$doanhthu += $row1['gia_mon_an'] * $row1['so_luong'];
		}
		echo "$soluong";
		echo "$doanhthu";
		if (mysqli_num_rows($query_thongke) == 0) {
			// echo "không có ngày";
			$soluongban = $soluong;
			$doanhthu = $doanhthu;
			$donhang = 1;
			$sql_update_thongke = "INSERT INTO thongke(ngay_dat,donhang,doanhthu,soluongban) 
			VALUE('" . $now . "','" . $donhang . "','" . $doanhthu . "','" . $soluongban . "')";
			mysqli_query($mysqli, $sql_update_thongke);
		} elseif (mysqli_num_rows($query_thongke) != 0) {
			while ($row_tk = mysqli_fetch_array($query_thongke)) {
				$soluongban = $row_tk['soluongban'] + $soluong;
				$doanhthu = $row_tk['doanhthu'] + $doanhthu;
				$donhang = $row_tk['donhang'] + 1;
				$sql_update_thongke = "UPDATE thongke SET donhang='" . $donhang . "',doanhthu='" . $doanhthu . "',soluongban='" . $soluongban . "' WHERE ngay_dat=' $today'";
				mysqli_query($mysqli, $sql_update_thongke);
			}
		}
		$sql_insert = "INSERT INTO hoa_don(id_ql,id_gio_hang,tong_thanh_toan,ngay_lap_hd,dia_chi_giao_hang)  
			VALUE('" . $id_ql . "','" . $code_cart . "','" . $tongthanhtoan . "','" . $now . "','" . $dia_chi . "')";
		$query = mysqli_query($mysqli, $sql_insert);

		if ($sql_insert) {
			$sql_update = "UPDATE gio_hang SET trang_thai= 3 WHERE id_gio_hang='" . $code_cart . "'";
			$query = mysqli_query($mysqli, $sql_update);

			if ($sql_update) {
				$sql = "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh WHERE  kh.id_kh=gh.id_kh and gh.id_gio_hang='" . $code_cart . "'";
				$query_laymail = mysqli_query($mysqli, $sql);
				$row_laymail = mysqli_fetch_array($query_laymail);
				$ten_kh = $row_laymail['ten_kh'];
				$mail = $row_laymail['email_kh'];
				$httt = $row_laymail['ht_thanh_toan'];
				$id_gh = $row_laymail['id_gio_hang'];
				$tieude = "Xác nhận đơn hàng";
				$noidung = "<p>Kính chào quý khách <span style='color:blue'>" . $ten_kh . "</span>,</p>";
				$noidung .= "<p>Cảm ơn quý khách đã tín nhiệm dịch vụ của <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a></p>";
				$noidung .= "<p>Đơn hàng có mã: <span style='color:blue'> " . $id_gh . " </span>đang được giao đến bạn.</p>";
				$noidung .= "<p>Quý khách vui lòng <a href='http://localhost:8080/Fast_food/index.php'> Xác nhận đã nhận được hàng</a> khi đơn hàng được giao tới quý khách</p>";
				$noidung .= "<p>Hình thức thanh toán <span style='color:blue'>" . $httt . "</span>,</p>";
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
WHERE(kh.id_kh=gh.id_kh) AND (m.id_mon_an = ctgh.id_mon_an) AND (gh.id_gio_hang = ctgh.id_gio_hang) AND gh.id_gio_hang='" . $code_cart . "' ";
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


			$_SESSION['message_gh'] = 'Đơn hàng đang được giao';
		}
		// header('Location:../../index.php?action=quanlydonhang&query=danhsach');

		header('Location:../../index.php?action=donhang&query=danhsach');
	} elseif ($tinhtrang == 5) {
		$sql_update = "UPDATE gio_hang SET trang_thai= 4 WHERE id_gio_hang='" . $code_cart . "'";
		$query = mysqli_query($mysqli, $sql_update);
		$sql_lietke_dh = "SELECT DISTINCT *FROM mon_an AS m, gio_hang AS gh, chi_tiet_gio_hang AS ctgh,khach_hang AS kh
WHERE(kh.id_kh=gh.id_kh) AND (m.id_mon_an = ctgh.id_mon_an) AND (gh.id_gio_hang = ctgh.id_gio_hang) AND gh.id_gio_hang='" . $code_cart . "' ";
		$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
		while ($row1 = mysqli_fetch_array($query_lietke_dh)) {
			$sl = $row1['so_luong'];
			$idmonan = $row1['id_mon_an'];
			//lay id món ăn
			$tim = "SELECT DISTINCT* FROM mon_an WHERE  id_mon_an='" . $idmonan . "'";
			$query_timon = mysqli_query($mysqli, $tim);
			$rowtimmon = mysqli_fetch_array($query_timon);
			$congsl = $sl + $rowtimmon['soluong'];
			//update soluong
			$sql_updatemon =  "UPDATE mon_an SET soluong='" . $congsl . "' WHERE id_mon_an='" . $idmonan . "'";
			$querytru = mysqli_query($mysqli, $sql_updatemon);
			//update sl km
			$sql_km = "SELECT * FROM chi_tiet_khuyen_mai WHERE id_mon_an='" . $idmonan . "'";
			$result_km =  mysqli_query($mysqli, $sql_km);
			$rowkm = $result_km->fetch_assoc();
			if ($rowkm['id_mon_an'] == $row1['id_mon_an']) {
				$congsoluongkm = $rowkm['soluong_km'] +  $row1['so_luong'];
				$sql_updatekm =  "UPDATE chi_tiet_khuyen_mai SET soluong_km='" . $congsoluongkm . "' WHERE id_mon_an='" . $rowkm['id_mon_an'] . "'";
				$querytrukm = mysqli_query($mysqli, $sql_updatekm);
			}
		}
		if ($sql_update) {
			$sql = "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh WHERE  kh.id_kh=gh.id_kh and gh.id_gio_hang='" . $code_cart . "'";
			$query_laymail = mysqli_query($mysqli, $sql);
			$row_laymail = mysqli_fetch_array($query_laymail);
			$ten_kh = $row_laymail['ten_kh'];
			$httt = $row_laymail['ht_thanh_toan'];
			$mail = $row_laymail['email_kh'];
			$id_gh = $row_laymail['id_gio_hang'];
			$tieude = "Xác nhận hủy đơn hàng";
			$noidung = "<p>Kính chào quý khách <span style='color:blue'>" . $ten_kh . "</span>,</p>";
			$noidung .= "<p>Cảm ơn quý khách đã tín nhiệm dịch vụ của <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a></p>";
			$noidung .= "<p>Đơn hàng có mã: <span style='color:blue'> " . $id_gh . " </span>đã được hủy.</p>";
			$noidung .= "<h4>Chi tiết đơn hàng:</h4>";
			$noidung .= "<p>Hình thức thanh toán <span style='color:blue'>" . $httt . "</span>,</p>";
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
WHERE(kh.id_kh=gh.id_kh) AND (m.id_mon_an = ctgh.id_mon_an) AND (gh.id_gio_hang = ctgh.id_gio_hang) AND gh.id_gio_hang='" . $code_cart . "' ";
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

		$_SESSION['message_duyet'] = 'Yêu cầu hủy đơn đã được xác nhận';

		header('Location:../../index.php?action=donhang&query=danhsach');
	} elseif ($tinhtrang == 3) {
		$sql_update = "UPDATE gio_hang SET trang_thai= 6 WHERE id_gio_hang='" . $code_cart . "'";
		$query = mysqli_query($mysqli, $sql_update);
		$_SESSION['message_duyet'] = 'Đơn hàng đã thanh toán thành công';
		header('Location:../../index.php?action=donhang&query=danhsach');
	}
} else {
	$ma = $_GET['code'];
	$sql_xoa = "DELETE FROM gio_hang WHERE id_gio_hang ='" . $ma . "'";
	mysqli_query($mysqli, $sql_xoa);
	header('Location:../../index.php?action=donhang&query=danhsach');
}
// if (isset($_POST['duyetdonhang'])) {

// 	$id_gh = $_GET['code'];

// 	$id_ql = $_SESSION['id_ql'];

// 	$tongthanhtoan = $_POST['tongthanhtoan'];

// 	$sql_lietke_giohang = "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh 
// 	WHERE  kh.id_kh=gh.id_kh ORDER BY gh.id_gio_hang='$id_gh'";
// 	$query_lietkegiohang = mysqli_query($mysqli, $sql_lietke_giohang);
// 	$row = mysqli_fetch_array($query_lietkegiohang);
// 	$id_kh = $row['id_kh'];
// 	$dia_chi = $row['dia_chi_kh'];
// 	$sql_insert = "INSERT INTO hoa_don(id_ql,id_kh,id_gio_hang,tong_thanh_toan,ngay_lap_hd,dia_chi_giao_hang)  
// 	VALUE('" . $id_ql . "','" . $id_kh . "','" . $id_gh . "','" . $tongthanhtoan . "','" . $now . "','" . $dia_chi . "')";
// 	$query = mysqli_query($mysqli, $sql_insert);
// 	echo "<script>
// location.href = 'http://localhost:8080/Fast_food/admin/index.php?action=hoadon&query=danhsach';
// </script>";
// }
