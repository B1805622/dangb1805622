<link href="css/css-message.css" rel="stylesheet" />
<?php
include("message.php");
$id_kh = $_SESSION['id_kh'];
// echo $id_kh;
$sql_lietke_donhang = "SELECT DISTINCT* FROM  khach_hang AS kh 
WHERE kh.id_kh=$id_kh";
$query_lietke_don_hang = mysqli_query($mysqli, $sql_lietke_donhang);
$row = mysqli_fetch_array($query_lietke_don_hang);
?>
<style>
    .dropdown-item1 {
        font-size: 17px;
        font-weight: 550;
    }
</style>

<section class="h-100 " style="padding-top: 34px;">
    <div class="py-5 h-100" style="padding-bottom:0.7rem !important;padding: 0px 130px">
        <div class="card">
            <div class="row" style="padding: 5px;">
                <div class="col-sm-3">
                    <div class="card" style="padding: 17px;">
                        <div class="">
                            <div class="dropdown-menu1">
                                <a class="dropdown-item1" href="index.php?quanly=thongtin">Thông tin cá nhân</a><br>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding: 17px;">
                        <div class="">
                            <div class="dropdown-menu1">
                                <a class="dropdown-item1" href="index.php?quanly=matkhau">Đổi mật khẩu</a><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">THÔNG TIN CÁ NHÂN</h5>
                            <form method="POST" action="pages/main/addcart.php?idkh=<?php echo $row['id_kh'] ?>" enctype="multipart/form-data">
                                <?php
                                if ($row['gioi_tinh'] == 'Nam') {
                                ?>
                                    <div class="form-row" style="padding-left: 7px; padding-bottom: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="gioitinh" class="custom-control-input" value="Nam" checked>
                                            <label class="custom-control-label" for="customRadioInline1">Anh</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="gioitinh" class="custom-control-input" value="Nữ">
                                            <label class="custom-control-label" for="customRadioInline2">Chị</label>
                                        </div>
                                    </div>
                                <?php
                                } elseif ($row['gioi_tinh'] == 'Nữ') {
                                ?>
                                    <div class="form-row" style="padding-left: 7px; padding-bottom: 5px;">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="gioitinh" class="custom-control-input" value="Nam">
                                            <label class="custom-control-label" for="customRadioInline1">Anh</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="gioitinh" class="custom-control-input" value="Nữ" checked>
                                            <label class="custom-control-label" for="customRadioInline2">Chị</label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Tên khách hàng</label>
                                        <input type="text" name="ten_kh" value="<?php echo $row['ten_kh'] ?>" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Số điện thoại</label>
                                        <input type="text" name="sdt" value="<?php echo $row['sdt_kh'] ?>" class="form-control" id="inputPassword4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Email</label>
                                    <input type="email" name="email" value="<?php echo $row['email_kh'] ?>" class="form-control" id="inputAddress">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Địa chỉ</label>
                                    <input type="text" class="form-control" name="dia_chi" id="inputAddress" value="<?php echo $row['dia_chi_kh'] ?>">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Tỉnh/Thành phố</label>
                                        <select name="id_tp" class="form-control city" id="select">
                                            <option selected>Chọn Tỉnh thành phố</option>
                                            <?php
                                            $sql_thanhpho = "SELECT * FROM devvn_tinhthanhpho where idtp=92 ORDER BY Ten_tp ASC";
                                            $query_thanhpho = mysqli_query($mysqli, $sql_thanhpho);
                                            while ($row_tp = mysqli_fetch_array($query_thanhpho)) {
                                            ?>
                                                <option value="<?php echo $row_tp['idtp'] ?>"><?php echo $row_tp['Ten_tp'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Quận/Huyện</label>
                                        <select name="id_qh" style="width: 100%" class="form-control quan" id="select">
                                            <option>Chọn Quận/huyện</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Phường xã</label>
                                        <select name="id_px" style="width: 100%" class="form-control xa" id="select">
                                            <option selected>Chọn Phường xã</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="update_kh" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
<script>
    $(document).ready(function() {
        $(".city").change(function() {
            var id_tinh = $(".city").val();
            // alert(id_tinh);
            $.ajax({
                url: "pages/main/addcart.php",
                type: "POST",
                data: {
                    id_tinh: id_tinh
                },
                success: function(data) {

                    $(".quan").html(data);

                }
            })
        })
        $(".quan").change(function() {
            var id_quan = $(".quan").val();
            // alert(id_tinh);
            $.ajax({
                url: "pages/main/addcart.php",
                type: "POST",
                data: {
                    id_quan: id_quan
                },
                success: function(data) {

                    $(".xa").html(data);

                }
            })
        })
    })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>