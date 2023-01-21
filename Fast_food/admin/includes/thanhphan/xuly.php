<?php
include('../config.php');
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");
if (isset($_POST['themthanhphan'])) {
    $tenloai = $_POST['ten_tp'];
    $sql_them = "INSERT INTO thanh_phan(ten_tp) VALUE('" . $tenloai . "')";
    $add = mysqli_query($mysqli, $sql_them);
    if ($add) {
        $_SESSION['message'] = 'Thêm thành công';
        header('Location:../../index.php?action=thanhphan&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message'] = 'Thêm thất bại';
        header('Location:../../index.php?action=thanhphan&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['id_tp'])) {
    $id_tp = $_POST['id_tp'];
    $sql_sua_loai_monan = "SELECT * FROM thanh_phan WHERE id_tp= $id_tp LIMIT 1";
    $query_sua_loai_mon_an = mysqli_query($mysqli, $sql_sua_loai_monan);
    $num = mysqli_num_rows($query_sua_loai_mon_an);
    if ($num > 0) {
        while ($row_tp = mysqli_fetch_array($query_sua_loai_mon_an)) {
?>
            <form method="POST" action="includes/thanhphan/xuly.php?idtp=<?php echo $row_tp['id_tp'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên thành phần</label>
                        <input type="text" name="ten_tp" class="form-control" value="<?php echo $row_tp['ten_tp'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="sua_tp" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
        <?php
        }
    }
} elseif (isset($_POST['sua_tp'])) {
    $ten_tp = $_POST['ten_tp'];
    $sql_update = "UPDATE thanh_phan SET ten_tp='" . $ten_tp . "' WHERE id_tp='$_GET[idtp]'";
    $edit = mysqli_query($mysqli, $sql_update);
    if ($edit) {
        $_SESSION['message_edit'] = 'Sửa thành công';
        header('Location:../../index.php?action=thanhphan&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message_edit'] = 'Sửa thất bại ';
        header('Location:../../index.php?action=thanhphan&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['id_thanhphan'])) {
    $id_tp = $_POST['id_thanhphan'];
    $sql_xoa = "SELECT * FROM thanh_phan WHERE id_tp = '$id_tp' LIMIT 1";
    $query_mon_xoa = mysqli_query($mysqli, $sql_xoa);
    $numxoa = mysqli_num_rows($query_mon_xoa);
    if ($numxoa > 0) {

        while ($rowtp = mysqli_fetch_array($query_mon_xoa)) {
        ?>
            <form method="POST" action="includes/thanhphan/xuly.php?idthanhphan=<?php echo $rowtp['id_tp'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <p>Chọn "Xóa" để xóa món ăn: <span style="color: red ;"><?php echo $rowtp['ten_tp'] ?></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="xoatp" class="btn btn-primary"> Lưu </button>
                </div>
                <!-- <a href="includes/quanlymonan/xuly.php?idMon=<?php echo $rowtp['id_tp'] ?>" class="btn btn-primary">Xóa</a> -->
            </form>
            <!-- </div> -->

        <?php
        }
    }
} elseif (isset($_POST['xoatp'])) {
    $sql_xoa = "DELETE FROM `thanh_phan` WHERE  id_tp='$_GET[idthanhphan]'";
    $edit1 = mysqli_query($mysqli, $sql_xoa);
    if ($edit1) {
        $_SESSION['message_edit'] = 'Xóa thành công';
        header('Location:../../index.php?action=thanhphan&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message_edit'] = 'Xóa thất bại ';
        header('Location:../../index.php?action=thanhphan&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql_searchloai = "SELECT * FROM thanh_phan WHERE ten_tp LIKE '{$input}%' ";
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
                            <th>Tên thành phần</th>
                            <th colspan="2" style=" width: 10%;">Thao tác</th>

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
                                <td><?php echo $row['ten_tp'] ?></td>
                                <td>
                                    <a class="btn" style="font-size: 23px;color: #4e73df;padding:0px" data-toggle="modal" data-target="#onmodalupdate" onclick="getdata(idtp=<?php echo $row['id_tp'] ?>)"><button type="button" class="btn btn-outline-warning btn-sm">Sửa</button></a>
                                    <div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Sửa thành phần dinh dưỡng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="sualoai">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="btn" data-target="#logoutModal1" data-toggle="modal" style="color: #ff3333;font-size: 23px;padding:0px" onclick="getdataxoa(id_tphan=<?php echo $row['id_tp'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></i></a>
                                    <div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa món ăn?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-bodyxoamonan"></div>
                                            </div>
                                        </div>
                                    </div>
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
                            <th>Tên thành phần</th>
                            <th colspan="2" style=" width: 14%;">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
}
