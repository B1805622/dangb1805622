<?php
$id_kh = $_SESSION['id_kh'];
$sql_lietke_donhang = "SELECT DISTINCT* FROM  khach_hang AS kh  WHERE kh.id_kh=$id_kh";
$query_lietke_don_hang = mysqli_query($mysqli, $sql_lietke_donhang);
$row = mysqli_fetch_array($query_lietke_don_hang);
?>
<div class="container mt-4" style=" padding-top: 60px;padding-bottom:15px;max-width: 80%;">

    <input type="hidden" name="kh_tendangnhap" value="dnpcuong">

    <div class="text-center">
        <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
        <h2 style=" font-family: none;"> THÔNG TIN ĐẶT HÀNG</h2>
        <p class=" lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Đơn hàng trước khi Đặt hàng</p>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Tóm tắt đơn hàng</span>
                <span class="badge badge-secondary badge-pill">
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $soluong = (count($_SESSION['cart']));
                        echo $soluong;
                    } else {
                        echo 0;
                    }
                    ?>
                </span>
            </h4>
            <ul class="list-group mb-3">
                <?php
                if (isset($_SESSION['cart'])) {
                ?>
                    <?php
                    $i = 0;
                    $tongtien = 0;
                    $tongkm = 0;
                    foreach ($_SESSION['cart'] as $cart_item) {
                        $thanhtien = $cart_item['soluong'] * $cart_item['gia'];
                        $tongtien += $thanhtien;
                        $tongtienkm = $cart_item['soluong'] * $cart_item['khuyenmai'];
                        $tongkm += $tongtienkm;
                        $i++;
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $cart_item['ten_mon_an']; ?></h6>
                                <small class="text-muted"> <?php echo number_format($cart_item['gia'], 0, ',', '.') . 'đ'; ?> x <?php echo $cart_item['soluong']; ?></small>
                            </div>
                            <span class="text-muted">
                                <?php
                                $gia = $cart_item['gia'];
                                $sl = $cart_item['soluong'];
                                $tongmon = $gia * $sl;
                                echo number_format($tongmon, 0, ',', '.') . 'đ'; ?></span>
                        </li>
                    <?php
                    }
                    ?>
                    <!-- <li class="list-group-item d-flex justify-content-between">
                        <span>Tổng khuyến mãi</span>
                        <strong><?php echo number_format($tongkm, 0, ',', '.') . 'đ'; ?></strong>
                    </li> -->
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Tổng thành tiền</span>
                        <strong><?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?></strong>
                    </li>

                <?php
                } ?>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Thông tin khách hàng</h4>
            <form action="pages/main/donhang.php" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <label for="kh_ten">Họ tên</label>
                        <input type="text" class="form-control" name="kh_ten" id="kh_ten" value="<?php echo $row['ten_kh'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="kh_dienthoai">Điện thoại</label>
                        <input type="text" class="form-control" name="kh_dienthoai" id="kh_dienthoai" value="<?php echo $row['sdt_kh'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="kh_email">Email</label>
                        <input type="text" class="form-control" name="kh_email" id="kh_email" value="<?php echo $row['email_kh'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="kh_diachi">Địa chỉ</label>
                        <input type="text" class="form-control" name="kh_diachi" id="kh_diachi" value="<?php echo $row['dia_chi_kh'] ?>">
                    </div>
                </div>
                <br>
                <h4 class="mb-3">Hình thức thanh toán</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="httt-1" name="httt_ma" type="radio" class="custom-control-input" required="" value="Tiền mặt">
                        <label class="custom-control-label" for="httt-1">Tiền mặt</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required="" value="VNPay">
                        <label class="custom-control-label" for="httt-2">VNPay</label>
                    </div>
                </div>
                <hr class="mb-4">
                <input class="btn btn-primary btn-lg btn-block" style="background-color: #0c0c0c;border-color: #0c0c0c;" type="submit" name="redirect" value="Thanh toán">
            </form>
        </div>
    </div>
</div>


</div>