<?php
$id_kh = $_SESSION['id_kh'];
// echo $id_kh;
$sql_lietke_donhang = "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh where kh.id_kh=gh.id_kh and kh.id_kh=$id_kh ORDER BY gh.thoi_gian_add DESC";
$query_lietke_don_hang = mysqli_query($mysqli, $sql_lietke_donhang);
// $row1 = mysqli_fetch_array($query_lietke_don_hang);
?>
<style>
    .dropdown-item1 {
        font-size: 17px;
        font-weight: 550;
    }
</style>
<link href="css/css-message.css" rel="stylesheet" />
<?php
if (isset($_SESSION['message_duyet'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['message_duyet']; ?></strong>
                <p class="toast1__msg"></p>
            </div>

            <div class="toast1__close " class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            let toRemove = document.querySelector("#toast1");
            toRemove.remove();
        }
    </script>
<?php
    unset($_SESSION['message_duyet']);
}
?>
<section class="h-100 " style="padding-top: 34px;">
    <div class="py-5 h-100" style="padding-bottom:0.7rem !important;padding: 0px 130px">
        <div class="card">
            <div class="row" style="padding: 5px;">
                <div class="col-sm-3">
                    <div class="card" style="padding: 17px;">
                        <div class="">
                            <div class="dropdown-menu1">
                                <a class="dropdown-item1" href="index.php?quanly=lichsu">Danh sách đơn hàng đã mua</a><br>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding: 17px;">
                        <div class="">
                            <div class="dropdown-menu1">
                                <a class="dropdown-item1" href="index.php?quanly=thongtin">Thông tin cá nhân</a><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ĐƠN HÀNG ĐÃ MUA</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th scope="col">Mã đơn hàng</th>
                                        <!-- <th scope="col">Món ăn</th> -->
                                        <th scope="col">Ngày đặt mua</th>
                                        <th scope="col">Trạng thái</th>

                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;

                                    while ($row = mysqli_fetch_array($query_lietke_don_hang)) {
                                        $i++;
                                    ?>

                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row['id_gio_hang'] ?> <a style="font-size: 11px;" href="index.php?quanly=chitiet&IdGH=<?php echo $row['id_gio_hang'] ?>"> Xem chi tiết</a></td>
                                            <td><?php
                                                $ngaylap = date_create($row['thoi_gian_add']);
                                                echo date_format($ngaylap, "d-m-Y H:i:s");
                                                ?></td>
                                            <td>
                                                <?php if ($row['trang_thai'] == 1) {
                                                    echo '<span style="color:red">Đang chờ duyệt</span>';
                                                } elseif ($row['trang_thai'] == 2) {
                                                    echo '<span style="color:Blue">Chuẩn bị giao hàng</span>';
                                                } elseif ($row['trang_thai'] == 3) {
                                                    echo '<span style="color:#33cc33">Đang giao hàng</span>';
                                                } elseif ($row['trang_thai'] == 4) {
                                                    echo '<span style="color:#cc0000">Đã hủy</span>';
                                                } elseif ($row['trang_thai'] == 5) {
                                                    echo '<span style="color:#cc0000">Yêu cầu hủy</span>';
                                                } elseif ($row['trang_thai'] == 6) {
                                                    echo '<span style="color:#cc0000">Đã thanh toán</span>';
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['trang_thai'] == 1) {
                                                ?>
                                                    <form method="POST" action="pages/main/xoa.php?idgh=<?php echo $row['id_gio_hang'] ?>" enctype="multipart/form-data">
                                                        <button type="submit" name="xoa_donhang" style=" border: none;background: none;"><i class=" fas fa-solid fa-trash"></i></button>
                                                    </form>
                                                <?php
                                                    // echo '<span style="color:red">Xóa</span>';
                                                } elseif ($row['trang_thai'] == 2) {
                                                    echo '<span style="color:Blue"></span>';
                                                } elseif ($row['trang_thai'] == 3) {
                                                ?>
                                                    <form method="POST" action="pages/main/xoa.php?idgh=<?php echo $row['id_gio_hang'] ?>" enctype="multipart/form-data">
                                                        <button type="submit" name="danhanhang" style=" background: #B9E0FF;padding: 2px;border: 2px solid #B9E0FF;border-radius: 4px;">Đã nhận hàng</button>
                                                    </form>
                                                <?php
                                                } elseif ($row['trang_thai'] == 4) {
                                                    echo '<span style="color:#cc0000"></span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>