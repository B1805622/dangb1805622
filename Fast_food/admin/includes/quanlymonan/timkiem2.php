<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
}
$sql_lietke_sp = "SELECT DISTINCT *FROM mon_an AS m, loai_mon_an AS lm, gia AS g
WHERE (m.id_loai_mon_an = lm.id_loai_mon_an) AND (m.id_mon_an = g.id_mon_an) and m.ten_mon_an LIKE '%" . $keyword . "%'";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Thêm món ăn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form method="POST" action="includes/quanlymonan/xuly.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Loại món ăn</label>
                        <!-- <input type="text" name="username" class="form-control" placeholder="Enter Username"> -->
                        <table style="width: 100%;">
                            <td>
                                <select name="loai_mon_an" style="width: 100%;" class="form-control">
                                    <option value="">Vui lòng chọn loại món ăn</option>
                                    <?php
                                    $sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an ASC";
                                    $query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);

                                    while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                                    ?>

                                        <option value="<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>"><?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </table>
                    </div>
                    <div class="form-group">
                        <label>Tên món ăn</label>
                        <input type="text" name="ten_mon_an" class="form-control" placeholder="Nhập tên món ăn">
                    </div>
                    <div class="form-group">
                        <label>Ảnh món ăn</label>
                        <input type="file" name="anhmon">
                    </div>
                    <div class="form-group">
                        <label>Giá món ăn</label>
                        <input type="text" name="gia" class="form-control" placeholder="Nhập giá món ăn">
                    </div>
                    <div class="form-group">
                        <label>Số lượng món ăn</label>
                        <input type="number" min="1" max="100" name="soluong" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <table>
                            <td>
                                <input type="radio" id="ss" name="trang_thai" value="Sẳn sàng">
                                <label for="ss">Sẳn sàng</label>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="hh" name="trang_thai" value="Hết hàng">
                                <label for="css">Hết hàng</label>
                            </td>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" name="themmonan" class="btn btn-primary">Lưu</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- DataTales Example -->
    <?php
    if (isset($_SESSION['message_add_mon'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_add_mon']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message_add_mon']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_edit_mon'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_edit_mon']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message_edit_mon']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_delete'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_delete']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message_delete']);
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php
            if (isset($_SESSION['add'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey !</strong> <?= $_SESSION['add']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['add']);
            }
            ?>
            <h6 class="m-0 font-weight-bold text-primary">Danh sách món ăn
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Thêm món ăn
                </button>
            </h6>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <div class="dropdown show nav-link">
                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tìm kiếm theo loại món ăn
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="?action=quanlymonan&query=danhsach" class="dropdown-item">Tất cả</a>

                            <?php
                            $sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an ASC";
                            $query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);

                            while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                            ?>
                                <a class="dropdown-item" href="?action=quanlymonan&query=timkiem&idLoai=<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>"><?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </ul>

                <form action="?action=quanlymonan&query=timkiem2" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light small" placeholder="Tên món ăn..." aria-label="Search" name="keyword" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> STT </th>
                            <th> Loại món ăn</th>
                            <th>Tên món ăn</th>
                            <th>Ảnh món ăn</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <!-- <th>Mô tả</th> -->
                            <th>Trạng thái</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($query_lietke_sp)) {
                            $i++;
                        ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td><?php echo $row['ten_loai_mon_an'] ?></td>
                                <td> <?php echo $row['ten_mon_an'] ?></td>
                                <td> <img src="includes/quanlymonan/uploads/<?php echo $row['anh_mon_an'] ?>" width="200px" height="150px"> </td>
                                <td><?php echo number_format($row['gia'], 0, ',', '.') . 'đ'; ?></td>
                                <td><?php echo $row['soluong'] ?></td>
                                <!-- <td><?php echo $row['mo_ta'] ?></td> -->
                                <td><?php if ($row['soluong'] == 0) {
                                        echo 'Hết hàng';
                                    } else {
                                        echo 'Sẳn hàng';
                                    } ?></td>

                                <td>
                                    <form action="includes/quanlymonan/sua.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id_mon_an']; ?>">


                                        <a class="btn btn-success" style=" color:White;text-decoration: none" href="?action=quanlymonan&query=sua&idMon=<?php echo $row['id_mon_an'] ?>"> EDIT</a>
                                    </form>
                                </td>
                                <td>
                                    <a name="delete_btn" class="btn btn-danger" onclick="return Del('<?php echo $row['ten_mon_an'] ?>')" href="includes/quanlymonan/xuly.php?idMon=<?php echo $row['id_mon_an'] ?>">XÓA</a>
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
<script>
    function Del(name) {
        return confirm("Bạn chắc chắn muốn xoá đơn hàng: " + name + "?");
    }
</script>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>