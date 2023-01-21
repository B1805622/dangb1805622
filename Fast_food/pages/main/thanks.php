<?php

require('carbon/autoload.php');
// session_start();

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
if (isset($_GET['vnp_Amount'])) {
    $vnp_Amount = $_GET['vnp_Amount'];
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $vnp_CardType = $_GET['vnp_CardType'];
    $code_cart = $_SESSION['code_cart'];
    $insert_vnpay = "INSERT INTO vnpay(vnp_amount, vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderinfo,vnp_paydate,vnp_tmncode,vnp_transactionno,id_gio_hang) 
VALUES ('" . $vnp_Amount . "','" . $vnp_BankCode . "','" . $vnp_BankTranNo . "','" . $vnp_OrderInfo . "','" . $vnp_PayDate . "','" . $vnp_TmnCode . "','" . $vnp_TransactionNo . "','" . $vnp_CardType . "','" . $code_cart . "')";
    $cart_query = mysqli_query($mysqli, $insert_vnpay);
    if ($cart_query) {
        $id_kh = $_SESSION['id_kh'];
        $sql = "SELECT * FROM khach_hang WHERE id_kh='" . $id_kh . "'";
        $result =  mysqli_query($mysqli, $sql);
        $row = $result->fetch_assoc();
?>
        <section class="h-100 h-custom">
            <div class="container py-5 h-100" style="padding-bottom:0.7rem !important">
                <div class="row d-flex justify-content-center align-items-center h-100" style="padding-top: 34px">
                    <div class="hero_area" style="min-height: 0;height:600px;width: 1111px;">
                        <div class="bg-box">
                            <img src="images/thanks.jpg" alt="">
                        </div>
                        <div style="-webkit-box-flex: 1;flex: 1;text-align: center;position: relative;padding: 140px 0px 0px 0px;color: blue;">
                            <h1>
                                Cảm ơn <?php echo $row['ten_kh'] ?> đã đặt hàng
                            </h1>
                            <div class="btn btn-light" style="padding: 8px;font-weight:600">
                                <a href="index.php?quanly=lichsu">
                                    Xem lịch sử mua hàng
                                </a>
                            </div>
                            <br>

                            <p>
                                Chúng tôi sẽ giải quyết đơn hàng của bạn ngay bây giờ! <br>
                                Bạn vui lòng kiểm tra lại thông tin đơn hàng đã được gửi qua Email của bạn nhé !
                            </p>
                            <br>

                            <br>
                            <div class="btn btn-light" style="padding: 8px;font-weight:600">
                                <a href="index.php?quanly=loai">
                                    Quay lại trang đặt hàng
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    <?php
    }
} else {
    $id_kh = $_SESSION['id_kh'];
    $sql = "SELECT * FROM khach_hang WHERE id_kh='" . $id_kh . "'";
    $result =  mysqli_query($mysqli, $sql);
    $row = $result->fetch_assoc();
    ?>
    <section class="h-100 h-custom">
        <div class="container py-5 h-100" style="padding-bottom:0.7rem !important">
            <div class="row d-flex justify-content-center align-items-center h-100" style="padding-top: 34px">
                <div class="hero_area" style="min-height: 0;height:600px;width: 1111px;">
                    <div class="bg-box">
                        <img src="images/thanks.jpg" alt="">
                    </div>
                    <div style="-webkit-box-flex: 1;flex: 1;text-align: center;position: relative;padding: 140px 0px 0px 0px;color: blue;">
                        <h1>
                            Cảm ơn <?php echo $row['ten_kh'] ?> đã đặt hàng
                        </h1>
                        <div class="btn btn-light" style="padding: 8px;font-weight:600">
                            <a href="index.php?quanly=lichsu">
                                Xem lịch sử mua hàng
                            </a>
                        </div>
                        <br>

                        <p>
                            Chúng tôi sẽ giải quyết đơn hàng của bạn ngay bây giờ! <br>
                            Bạn vui lòng kiểm tra lại thông tin đơn hàng đã được gửi qua Email của bạn nhé !
                        </p>
                        <br>

                        <br>
                        <div class="btn btn-light" style="padding: 8px;font-weight:600">
                            <a href="index.php?quanly=loai">
                                Quay lại trang đặt hàng
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
<?php
}
