<?php
include('../config.php');
session_start();

if (isset($_POST['Idkh'])) {
    $id = $_POST['Idkh'];
    $sql_KH = "SELECT * FROM khach_hang WHERE  id_kh= $id LIMIT 1";
    $query_KH = mysqli_query($mysqli, $sql_KH);
    $num = mysqli_num_rows($query_KH);
    if ($num > 0) {
        while ($row = mysqli_fetch_array($query_KH)) {
?>
            <form method="POST" action="includes/khach_hang/xuly.php?Idkh=<?php echo $row['id_kh'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Tên Khách hàng </label>
                        <input type="text" value="<?php echo $row['ten_kh'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Giới tính </label>
                        <input type="text" value="<?php echo $row['gioi_tinh'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Số điện thoại </label>
                        <input type="text" value="<?php echo $row['sdt_kh'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Email </label>
                        <input type="text" value="<?php echo $row['email_kh'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Địa chỉ </label>
                        <input type="text" value="<?php echo $row['dia_chi_kh'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                </div>
            </form>
        <?php
        }
    }
} elseif (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql_searchloai = "SELECT * FROM khach_hang WHERE ten_kh LIKE '{$input}%' ";
    $result_search_loai = mysqli_query($mysqli, $sql_searchloai);
    $num1 = mysqli_num_rows($result_search_loai);
    if ($num1 > 0) {
        ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th> STT </th>
                            <th> Tên khách hàng</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result_search_loai)) {
                            $i++;
                        ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td><?php echo $row['ten_kh'] ?></td>
                                <td><?php echo $row['email_kh'] ?></td>
                                <td><?php
                                    if ($row['trang_thai_tk'] == 1) {
                                        echo "Đang kích hoạt";
                                    } else {
                                        echo "Ngừng hoạt động";
                                    }
                                    ?></td>
                                <td>
                                    <a class="btn" style="padding:0px" data-toggle="modal" data-target="#onmodalupdate" onclick="getdata(id_kh=<?php echo $row['id_kh'] ?>)"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                    <div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width: 600px;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thông tin khách hàng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="sualoai">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn" style="padding:0px" data-toggle="modal" data-target="#onmodalupdate1" onclick="getdata_xoa(idkh1=<?php echo $row['id_kh'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></a>
                                    <div class="modal fade" id="onmodalupdate1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width: 600px;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thông tin khách hàng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="sualoai1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($row['trang_thai_tk'] == 2) {
                                    ?>
                                        <a class="btn" style="padding:0px" data-toggle="modal" data-target="#onmodalupdate2" onclick="getdata_xoa(idkh1=<?php echo $row['id_kh'] ?>)"><button type="button" class="btn btn-outline-success btn-sm">Kích hoạt</button></a>
                                        <div class="modal fade" id="onmodalupdate2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" style="width: 600px;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thông tin khách hàng</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="sualoai1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
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
    <?php
    } else {
    ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th> STT </th>
                            <th> Tên khách hàng</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
} elseif (isset($_POST['ID_KH'])) {
    $id_kh = $_POST['ID_KH'];
    $sql_xoa = "SELECT * FROM khach_hang WHERE id_kh = '$id_kh' LIMIT 1";
    $query_mon_xoa = mysqli_query($mysqli, $sql_xoa);
    $numxoa = mysqli_num_rows($query_mon_xoa);
    if ($numxoa > 0) {

        while ($row_kh = mysqli_fetch_array($query_mon_xoa)) {
        ?>
            <div class="form-group">
                <div class="modal-body">
                    <p>Chọn "Xóa" để xóa khách hàng: <span style="color: red ;"><?php echo $row_kh['ten_kh'] ?></span></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                    <form action="" method="POST">
                        <a href="includes/khachhang/xuly.php?id_kh_3=<?php echo $row_kh['id_kh'] ?>" class="btn btn-primary">Xóa</a>
                    </form>
                </div>
            </div>
        <?php
        }
    }
} elseif (isset($_POST['ID_KH_KH'])) {
    $id_kh = $_POST['ID_KH_KH'];
    $sql_xoa = "SELECT * FROM khach_hang WHERE id_kh = '$id_kh' LIMIT 1";
    $query_mon_xoa = mysqli_query($mysqli, $sql_xoa);
    $numxoa = mysqli_num_rows($query_mon_xoa);
    if ($numxoa > 0) {

        while ($row_kh = mysqli_fetch_array($query_mon_xoa)) {
        ?>
            <form method="POST" action="includes/khachhang/xuly.php?id_kh=<?php echo $row_kh['id_kh'] ?>" enctype="multipart/form-data">

                <div class="form-group">
                    <div class="modal-body">
                        <p>Chọn "Kích hoạt" để kích hoạt tài khoản khách hàng: <span style="color: red ;"><?php echo $row_kh['ten_kh'] ?></span></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                        <button type="submit" name="kich_hoat" class="btn btn-primary">Kích hoạt </button>

                        <!-- <form action="" method="POST">
                            <a href="includes/khachhang/xuly.php?id_kh_3=<?php echo $row_kh['id_kh'] ?>" class="btn btn-primary">Kích hoạt</a>
                        </form> -->
                    </div>
                </div>
            </form>
<?php
        }
    }
} elseif (isset($_POST['kich_hoat'])) {
    $id_kh = $_GET['id_kh'];

    $sql_update = "UPDATE khach_hang SET trang_thai_tk=1  WHERE id_kh='$_GET[id_kh]'";
    $query = mysqli_query($mysqli, $sql_update);
    if ($query) {
        $_SESSION['message_delete'] = 'Kích hoạt thành công';
        header('Location:../../index.php?action=khachhang&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message_delete'] = 'Kích hoạt thất bại ';
        header('Location:../../index.php?action=khachhang&query=danhsach');
        exit(0);
    }
} else {
    $id = $_GET['id_kh_3'];
    $sql_update_trang_thai_kh = "UPDATE khach_hang SET trang_thai_tk= 2  WHERE id_kh=$id";
    $query_an = mysqli_query($mysqli, $sql_update_trang_thai_kh);
    if ($query_an) {
        $_SESSION['message_delete'] = 'Xóa thành công';
        header('Location:../../index.php?action=khachhang&query=danhsach');
        exit(0);
    }
}
