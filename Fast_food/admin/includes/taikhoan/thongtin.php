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
$sql_lietke_kh = "SELECT * FROM quan_ly where id_ql='" . $_SESSION['id_ql'] . "'";
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
            <h6 class="m-0 font-weight-bold text-primary">Thông tin cá nhân
            </h6>
        </div>
        <div class="searchresult">
            <div class="card-body">
                <div class="form-group">
                    <label> Tên nhân viên: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <span class="name_xma"><?php echo $row['ten_ql'] ?></span>
                </div>
                <div class="form-group">
                    <label> Số điện thoại: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <span class="name_xma"><?php echo $row['sdt_ql'] ?></span>

                </div>
                <div class="form-group">
                    <label> Địa chỉ:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <span class="name_xma"><?php echo $row['dia_chi'] ?></span>
                </div>
                <div class="form-group">
                    <label> Tên đăng nhập:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <span class="name_xma"><?php echo $row['username_ql'] ?></span>
                </div>
                <a href="index.php?action=taikhoan&query=update"> <button type="button" class="btn btn-info">Chỉnh sửa</button></a>
                    <a href="index.php?action=taikhoan&query=matkhau"><button type="button" class="btn btn-danger">Đổi mật khẩu</button></a>
            </div>
        </div>
    </div>
</div>