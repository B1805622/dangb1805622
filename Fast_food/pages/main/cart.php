<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".khuyenmai").change(function() {
            var id = $(".khuyenmai").val();
            // alert (id);
            $.ajax({
                url: "pages/main/addcart.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".idkhuyenmai").html(data);
                }

            })


        })
    })
</script>
<?php
require('carbon/autoload.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
if (isset($_SESSION['cart'])) {
}
?>
<section class="h-100 h-custom">

    <div class="container py-5 h-100" style="max-width: 80%;padding-bottom:0.7rem !important">

        <div class="row d-flex justify-content-center align-items-center h-100" style="padding-top: 41px">
            <?php
            if (isset($_SESSION['cart'])) {
            ?>
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius:3px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Giỏ hàng</h1>
                                            <h6 class="mb-0 text-muted"><a href="pages/main/addcart.php?xoatatca=1" style=" color:red"> Xóa
                                                    tất cả</a></h6>
                                        
                                        </div>
                                        <hr class="my-4">
                                        <?php
                                        $i = 0;
                                        $tongtien = 0;
                                        $tongsomon = 0;
                                        foreach ($_SESSION['cart'] as $cart_item) {
                                            $thanhtien = $cart_item['soluong'] * $cart_item['gia'];
                                            $tongtien += $thanhtien;
                                            $somonan = $cart_item['soluong'] * 1;
                                            $tongsomon += $somonan;
                                            $i++;
                                        ?>
                                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img src="admin/includes/quanlymonan/uploads/<?php echo $cart_item['anh_mon_an']; ?>" class="img-fluid rounded-3">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                    <h6 class="text-black mb-0"><?php echo $cart_item['ten_mon_an']; ?></h6>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                    <a class="btn btn-link px-2" href="pages/main/addcart.php?tru=<?php echo $cart_item['id'] ?>"><i class="icon_quantity fas fa-minus"></i></a>
                                                    <span class="form-control form-control-sm">
                                                        <?php echo $cart_item['soluong']; ?></span>
                                                    <a class="btn btn-link px-2" href="pages/main/addcart.php?cong=<?php echo $cart_item['id'] ?>"><i class="icon_quantity fas fa-plus"></i></a>

                                                </div>
                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                    <h6 class="mb-0">
                                                        <?php echo number_format($cart_item['gia'], 0, ',', '.') . 'đ'; ?></h6>
                                                </div>
                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <a href="pages/main/addcart.php?xoa=<?php echo $cart_item['id'] ?>" class="text-muted"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                            <hr class="my-4">
                                        <?php
                                        }
                                        ?>
                                        <div class="pt-5">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <h6 class="mb-0"><a href="index.php?quanly=loai" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i> Đặt thêm món</a>
                                                        </h6>
                                                    </th>
                                                    <th>
                                                        <span style="width: 50%;">&nbsp;</span>
                                                    </th>
                                                    <th>

                                                    </th>
                                                </tr>

                                            </table>


                                        </div>
                                        <!-- <div >
											<h6 ><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i> Xóa tất cả</a></h6>
										</div> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h1 class="fw-bold mb-0 text-black">Tóm tắt</h1>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <h5 class="text-uppercase">TỔNG SỐ MÓN</h5>

                                                    </td>
                                                    <td>
                                                        <h5 style=" padding-left: 88px;"><?php echo $tongsomon; ?></h5>
                                                    </td>
                                                </tr>
                                            </table>


                                        </div>

                                        <hr class="my-4">
                                        <div class="d-flex justify-content-between mb-5">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <h5 class="text-uppercase">Thành tiền</h5>
                                                    </td>
                                                    <td>
                                                        <h5 style=" padding-left: 50px;"><?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?></h5>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                        <a href="index.php?quanly=thanhtoan"><button type="button" name="datmon" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Đặt hàng</button></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<?php
            } else {
?>
    <div class="hero_area" style="min-height: 0;height:600px;width: 1111px;">
        <div class="bg-box">
            <img src="images/banner-cart.jpg" alt="">
        </div>
        <div style="-webkit-box-flex: 1;flex: 1;text-align: center;position: relative;padding: 140px 0px 0px 0px;    color: white;">
            <h1>
                Giỏ hàng của bạn còn trống !
            </h1>
            <p>
                Trở về trang chủ để đặt hàng ngay bạn nhé.
            </p>
            <br>
            <div class="btn btn-light" style="padding: 8px;font-weight:600">
                <a href="index.php?quanly=loai" style="color:#3C4048">
                    Đặt hàng ngay thôi
                </a>
            </div>
        </div>
    </div>
<?php
            }
?>
</div>
</div>
</section>
<?php
include("message.php");
?>
<link href="css/css-message.css" rel="stylesheet" />