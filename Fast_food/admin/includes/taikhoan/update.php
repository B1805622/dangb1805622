<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="js/sb-admin-2.min.js"></script> -->
<?php
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = '1';
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 5) - 5;
}
$id_ql = $_SESSION['id_ql'];
$sql_lietke_kh = "SELECT * FROM quan_ly where id_ql='" . $id_ql . "'";
$query_lietke_kh = mysqli_query($mysqli, $sql_lietke_kh);
$row = mysqli_fetch_array($query_lietke_kh);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_edit'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_edit']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message_edit']);
    }
    ?>
    <div id="demo" style="display:none;" class="alert alert-danger">
        <a href="#" class="close" onclick="an()" aria-label="close">&times;</a>
        <strong>Không thể xóa</strong>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thay đổi thông tin cá nhân
            </h6>
        </div>
        <div class="searchresult">
            <div class="card-body">
                <form method="POST" action="includes/taikhoan/xuly.php?idql=<?php echo $id_ql ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputAddress">Tên đăng nhập</label>
                        <input type="text" name="tdn" value="<?php echo $row['username_ql'] ?>" class="form-control" id="inputAddress">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Tên quản lý</label>
                            <input type="text" name="ten_ql" value="<?php echo $row['ten_ql'] ?>" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Số điện thoại</label>
                            <input type="text" name="sdt" value="<?php echo $row['sdt_ql'] ?>" class="form-control" id="inputPassword4">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Email</label>
                        <input type="email" name="email" value="<?php echo $row['email_ql'] ?>" class="form-control" id="inputAddress">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Địa chỉ</label>
                        <input type="text" class="form-control" name="dia_chi" id="inputAddress" value="<?php echo $row['dia_chi'] ?>">
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
                    <button type="submit" name="update_tk_ql" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".city").change(function() {
            var id_tinh = $(".city").val();
            // alert(id_tinh);
            $.ajax({
                url: "includes/taikhoan/xuly.php",
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
                url: "includes/taikhoan/xuly.php",
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