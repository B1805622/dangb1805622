<?php
session_start();
include("../../admin/includes/config.php");
require('../../carbon/autoload.php');
require('../../mail/sendmail.php');
require_once('config_vnpay.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
if (isset($_POST['redirect'])) {
    $id_kh =  $_SESSION['id_kh'];
    $ten_kh = $_POST['kh_ten'];
    $sdt = $_POST['kh_dienthoai'];
    // $email = $_POST['kh_email'];
    $diachi = $_POST['kh_diachi'];
    $sql_thaydoi =  "UPDATE khach_hang SET ten_kh='" . $ten_kh . "', dia_chi_kh='" . $diachi . "', sdt_kh='" . $sdt . "' WHERE id_kh=$id_kh";
    mysqli_query($mysqli, $sql_thaydoi);
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $thanhtien = $value['soluong'] * $value['gia'];
        $total += $thanhtien;
    }
    $id_gh = rand(0, 99999999);
    $httt =  $_POST['httt_ma'];
    if ($httt == 'Tiền mặt') {
        $insert_cart = "INSERT INTO gio_hang(id_gio_hang,id_kh,trang_thai,thoi_gian_add,ht_thanh_toan) VALUE ('" . $id_gh . "','" . $id_kh . "',1,'" . $now . "','" . $httt . "')";
        $cart_query = mysqli_query($mysqli, $insert_cart);
        foreach ($_SESSION['cart'] as $key => $value) {
            $id_mon_an = $value['id'];
            $soluong = $value['soluong'];
            $gia_mon_an  = $value['gia'];
            $km =  $value['khuyenmai'];

            $insert_order_details = "INSERT INTO chi_tiet_gio_hang(id_gio_hang,id_mon_an,so_luong,gia_mon_an,khuyen_mai_ctgh) VALUE ('" . $id_gh . "','" . $id_mon_an . "','" . $soluong . "','" . $gia_mon_an . "','" . $km . "')";
            $cart_query1 =  mysqli_query($mysqli, $insert_order_details);
            $sql = "SELECT * FROM mon_an WHERE id_mon_an='" . $id_mon_an . "'";
            $result =  mysqli_query($mysqli, $sql);
            $row = $result->fetch_assoc();
            $tru = $row['soluong'] - $soluong;
            $sql_updatemon =  "UPDATE mon_an SET soluong='" . $tru . "' WHERE id_mon_an='" . $id_mon_an . "'";
            $querytru = mysqli_query($mysqli, $sql_updatemon);
            $sql_km = "SELECT * FROM chi_tiet_khuyen_mai WHERE id_mon_an='" . $id_mon_an . "'";
            $result_km =  mysqli_query($mysqli, $sql_km);
            $rowkm = $result_km->fetch_assoc();
            if ($rowkm['id_mon_an'] == $id_mon_an) {
                $trusoluongkm = $rowkm['soluong_km'] - $soluong;
                $sql_updatekm =  "UPDATE chi_tiet_khuyen_mai SET soluong_km='" . $trusoluongkm . "' WHERE id_mon_an='" . $id_mon_an . "'";
                $querytrukm = mysqli_query($mysqli, $sql_updatekm);
            }
        }
        if ($cart_query1) {
            $sql_selecttenkh = "SELECT * FROM `khach_hang` WHERE id_kh=$id_kh";
            $sql_query_tenkh   = mysqli_query($mysqli, $sql_selecttenkh);
            $row_ten_kh = mysqli_fetch_array($sql_query_tenkh);
            $ten_kh = $row_ten_kh['ten_kh'];
            $email_kh =  $row_ten_kh['email_kh'];
            $diachi_kh = $row_ten_kh['dia_chi_kh'];
            $sdt_kh = $row_ten_kh['sdt_kh'];
            $tieude = "Đặt hàng thành công";
            $noidung = "<p>Xin chào <span style='color:blue'>" . $ten_kh . "</span></p>";
            $noidung .= "<p>Cảm ơn bạn đã đặt hàng tại <a href='http://localhost:8080/Fast_food/index.php' style='text-decoration: none;'>Dang Food</a> với thông tin như sau:</p>";

            $noidung .= "<h4>THÔNG TIN NGƯỜI NHẬN:</h4>";
            $noidung .= "<p>Số điện thoại:" .  $sdt_kh . "</p>";
            $noidung .= "<p>Email:<a href='' style='text-decoration: none;'>" .  $email_kh . "</a></p>";
            $noidung .= "<p>Địa chỉ:" .  $diachi_kh . "</p>";
            $noidung .= "<h4>THÔNG TIN ĐƠN HÀNG:</h4>";
            $noidung .= "<p>Mã đơn hàng: <span style='color:blue'>" . $id_gh . "</span></p>";
            // $noidung .= "<p>Cảm ơn quý khách đã đặt hàng với mã đơn hàng: <span style='color:blue'>" . $id_gh . "</span></p>";
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
            $i = 0;
            $tongtien = 0;
            $tongsomon = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['khuyenmai'] != "") {
                    $giagoc = $value['khuyenmai'] + $value['gia'];
                } else {
                    $giagoc =  $value['gia'];
                }
                $thanhtien = $value['soluong'] * $value['gia'];
                $tongtien += $thanhtien;
                $somonan = $value['soluong'] * 1;
                $tongsomon += $somonan;
                $i++;
                $noidung .= "
                <tr>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . $i . "</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . $value['ten_mon_an'] . "</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($giagoc, 0, ',', '.') . "đ</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($value['khuyenmai'], 0, ',', '.') . "đ</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . $value['soluong'] . "</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($value['gia'] * $value['soluong'], 0, ',', '.') . "đ</td>
                </tr>";
            }
            $noidung .= "
          <tr>
            <td style='border:none;background-color: white;' colspan='3'></td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tổng</td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;' >" . $tongsomon . "</td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($tongtien, 0, ',', '.') . "đ</td>
        </tr>
           <tr>
            <td style='border:none;background-color: white;' colspan='3'></td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tổng thanh toán</td>
            <td  colspan='2' style='text-align:center;border: 1px solid #dddddd;padding: 8px; border: 2px solid;'>" . number_format($tongtien, 0, ',', '.') . "đ</td>
        </tr>


        </table>";
            $noidung .= "<p>Mọi thắc mắc xin liên hệ website tại <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a>, Hoặc liên hệ SĐT: 0973751311. Xin cảm ơn quý khách.</p>";
            $maildathang = $_SESSION['email'];
            $mail = new Mailer();
            $mail->dathangmail($tieude, $noidung, $maildathang);

            unset($_SESSION['cart']);
        }
        header('Location:../../index.php?quanly=thanks');
    } elseif ($httt == 'VNPay') {
        //thanh toan bang vnpay
        $vnp_TxnRef = $id_gh; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng đặt tại website Đăng Foods';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $vnp_ExpireDate = $expire;
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate
        );

        if (
            isset($vnp_BankCode) && $vnp_BankCode != ""
        ) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac(
                'sha512',
                $hashdata,
                $vnp_HashSecret
            ); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            $_SESSION['code_cart'] = $id_gh;
            $insert_cart = "INSERT INTO gio_hang(id_gio_hang,id_kh,trang_thai,thoi_gian_add,ht_thanh_toan) VALUE ('" . $id_gh . "','" . $id_kh . "',1,'" . $now . "','" . $httt . "')";
            $cart_query = mysqli_query($mysqli, $insert_cart);
            foreach ($_SESSION['cart'] as $key => $value) {
                $id_mon_an = $value['id'];
                $soluong = $value['soluong'];
                $gia_mon_an  = $value['gia'];
                $km =  $value['khuyenmai'];
                // Echo $km;
                $insert_order_details = "INSERT INTO chi_tiet_gio_hang(id_gio_hang,id_mon_an,so_luong,gia_mon_an,khuyen_mai_ctgh) VALUE ('" . $id_gh . "','" . $id_mon_an . "','" . $soluong . "','" . $gia_mon_an . "','" . $km . "')";
                $cart_query1 =  mysqli_query($mysqli, $insert_order_details);
                $sql = "SELECT * FROM mon_an WHERE id_mon_an='" . $id_mon_an . "'";
                $result =  mysqli_query($mysqli, $sql);
                $row = $result->fetch_assoc();
                $tru = $row['soluong'] - $soluong;
                $sql_updatemon =  "UPDATE mon_an SET soluong='" . $tru . "' WHERE id_mon_an='" . $id_mon_an . "'";
                $querytru = mysqli_query($mysqli, $sql_updatemon);
                $sql_km = "SELECT * FROM chi_tiet_khuyen_mai WHERE id_mon_an='" . $id_mon_an . "'";
                $result_km =  mysqli_query($mysqli, $sql_km);
                $rowkm = $result_km->fetch_assoc();
                if ($rowkm['id_mon_an'] == $id_mon_an) {
                    $trusoluongkm = $rowkm['soluong_km'] - $soluong;
                    $sql_updatekm =  "UPDATE chi_tiet_khuyen_mai SET soluong_km='" . $trusoluongkm . "' WHERE id_mon_an='" . $id_mon_an . "'";
                    $querytrukm = mysqli_query($mysqli, $sql_updatekm);
                }
            }
            if ($cart_query1) {
                $sql_selecttenkh = "SELECT * FROM `khach_hang` WHERE id_kh=$id_kh";
                $sql_query_tenkh   = mysqli_query($mysqli, $sql_selecttenkh);
                $row_ten_kh = mysqli_fetch_array($sql_query_tenkh);
                $ten_kh = $row_ten_kh['ten_kh'];
                $email_kh =  $row_ten_kh['email_kh'];
                $diachi_kh = $row_ten_kh['dia_chi_kh'];
                $sdt_kh = $row_ten_kh['sdt_kh'];
                $tieude = "Đặt hàng thành công";
                $noidung = "<p>Xin chào <span style='color:blue'>" . $ten_kh . "</span></p>";
                $noidung .= "<p>Cảm ơn bạn đã đặt hàng tại <a href='http://localhost:8080/Fast_food/index.php' style='text-decoration: none;'>Dang Food</a> với thông tin như sau:</p>";

                $noidung .= "<h4>THÔNG TIN NGƯỜI NHẬN:</h4>";
                $noidung .= "<p>Số điện thoại:" .  $sdt_kh . "</p>";
                $noidung .= "<p>Email:<a href='' style='text-decoration: none;'>" .  $email_kh . "</a></p>";
                $noidung .= "<p>Địa chỉ:" .  $diachi_kh . "</p>";
                $noidung .= "<h4>THÔNG TIN ĐƠN HÀNG:</h4>";
                $noidung .= "<p>Mã đơn hàng: <span style='color:blue'>" . $id_gh . "</span></p>";
                // $noidung .= "<p>Cảm ơn quý khách đã đặt hàng với mã đơn hàng: <span style='color:blue'>" . $id_gh . "</span></p>";
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
                $i = 0;
                $tongtien = 0;
                $tongsomon = 0;
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($value['khuyenmai'] != "") {
                        $giagoc = $value['khuyenmai'] + $value['gia'];
                    } else {
                        $giagoc =  $value['gia'];
                    }
                    $thanhtien = $value['soluong'] * $value['gia'];
                    $tongtien += $thanhtien;
                    $somonan = $value['soluong'] * 1;
                    $tongsomon += $somonan;
                    $i++;
                    $noidung .= "
                <tr>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . $i . "</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . $value['ten_mon_an'] . "</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($giagoc, 0, ',', '.') . "đ</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($value['khuyenmai'], 0, ',', '.') . "đ</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . $value['soluong'] . "</td>
                    <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($value['gia'] * $value['soluong'], 0, ',', '.') . "đ</td>
                </tr>";
                }
                $noidung .= "
          <tr>
            <td style='border:none;background-color: white;' colspan='3'></td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tổng</td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;' >" . $tongsomon . "</td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>" . number_format($tongtien, 0, ',', '.') . "đ</td>
        </tr>
           <tr>
            <td style='border:none;background-color: white;' colspan='3'></td>
            <td style=' border: 1px solid #dddddd; text-align: left;padding: 8px; border: 2px solid;'>Tổng thanh toán</td>
            <td  colspan='2' style='text-align:center;border: 1px solid #dddddd;padding: 8px; border: 2px solid;'>" . number_format($tongtien, 0, ',', '.') . "đ</td>
        </tr>


        </table>";
                $noidung .= "<p>Mọi thắc mắc xin liên hệ website tại <a href='http://localhost:8080/Fast_food/index.php'>Dang Food</a>, Hoặc liên hệ SĐT: 0973751311. Xin cảm ơn quý khách.</p>";
                $maildathang = $_SESSION['email'];
                $mail = new Mailer();
                $mail->dathangmail($tieude, $noidung, $maildathang);

                unset($_SESSION['cart']);
            }
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
