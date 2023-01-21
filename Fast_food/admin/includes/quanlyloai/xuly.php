<?php
include('../config.php');
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");
if (isset($_POST['themloai'])) {
    $tenloai = $_POST['ten_loai'];
    $anhloai = $_FILES['anh_loai']['name'];
    $anhloai_tmp = $_FILES['anh_loai']['tmp_name'];
    $anhloai = time() . '_' . $anhloai;
    // echo"$anhloai";

    $sql_them = "INSERT INTO loai_mon_an(ten_loai_mon_an,anh_loai) VALUE('" . $tenloai . "','" . $anhloai . "')";
    $add = mysqli_query($mysqli, $sql_them);
    move_uploaded_file($anhloai_tmp, 'uploads/' . $anhloai);
    if ($add) {
        $_SESSION['message'] = 'Thêm thành công';
        header('Location:../../index.php?action=quanlyloai&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message'] = 'Thêm thất bại';
        header('Location:../../index.php?action=quanlyloai&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['IdLoaiMonan'])) {
    $idloaimonan = $_POST['IdLoaiMonan'];
    $sql_sua_loai_monan = "SELECT * FROM loai_mon_an WHERE  loai_mon_an.id_loai_mon_an= $idloaimonan LIMIT 1";
    $query_sua_loai_mon_an = mysqli_query($mysqli, $sql_sua_loai_monan);
    $num = mysqli_num_rows($query_sua_loai_mon_an);
    if ($num > 0) {
        while ($rowloaimonan = mysqli_fetch_array($query_sua_loai_mon_an)) {
?>
            <form method="POST" action="includes/quanlyloai/xuly.php?idLoai=<?php echo $rowloaimonan['id_loai_mon_an'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Tên loại món ăn </label>
                        <input type="text" name="ten_loai_mon_an" value="<?php echo $rowloaimonan['ten_loai_mon_an'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ảnh loại món ăn</label>
                        <div class="custom-file">
                            <label>Ảnh loại món ăn</label>
                            <input type="file" class="custom-file-input" id="customFile" name="anh_loai" value="<?php echo $rowloaimonan['anh_loai'] ?>">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="sua_loai" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
        <?php
        }
    }
} elseif (isset($_POST['sua_loai'])) {
    $tenloaimon = $_POST['ten_loai_mon_an'];
    $anhloai = $_FILES['anh_loai']['name'];
    $anhloai_tmp = $_FILES['anh_loai']['tmp_name'];
    $anhloai = time() . '_' . $anhloai;
    if ($anhloai != '') {
        move_uploaded_file($anhloai_tmp, 'uploads/' . $anhloai);
        $sql_update = "UPDATE loai_mon_an SET ten_loai_mon_an='" . $tenloaimon . "',anh_loai='" . $anhloai . "' WHERE id_loai_mon_an='$_GET[idLoai]'";
        $sql = "SELECT * FROM loai_mon_an WHERE id_loai_mon_an= '$_GET[idLoai]' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['anh_loai']);
        }
    } else {
        $sql_update = "UPDATE loai_mon_an SET ten_loai_mon_an='" . $tenloaimon . "',anh_loai='" . $anhloai . "' WHERE id_loai_mon_an='$_GET[idLoai]'";
    }
    $edit = mysqli_query($mysqli, $sql_update);
    if ($edit) {
        $_SESSION['message_edit'] = 'Sửa thành công';
        header('Location:../../index.php?action=quanlyloai&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message_edit'] = 'Sửa thất bại ';
        header('Location:../../index.php?action=quanlyloai&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql_searchloai = "SELECT * FROM loai_mon_an WHERE loai_mon_an.ten_loai_mon_an LIKE '{$input}%' ";
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
                            <th> Loại món ăn</th>
                            <th> Ảnh loại món ăn</th>
                            <th style="width: 4%;">Thao tác</th>
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
                                <td><?php echo $row['ten_loai_mon_an'] ?></td>
                                <td> <img src="includes/quanlyloai/uploads/<?php echo $row['anh_loai'] ?>" width="200px" height="150px"> </td>
                                <td>
                                    <a class="btn" style="font-size: 23px;color: #4e73df;" data-toggle="modal" data-target="#onmodalupdate" onclick="getdata(idloai=<?php echo $row['id_loai_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Sửa</button></a>
                                    <div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Sửa loại món ăn</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="sualoai">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!-- <td><button name="delete_btn" style="color: #ff3333;font-size: 23px;" class="btn" onclick="hien()"><i class=" fas fa-solid fa-trash"></i></button>
                                    </td> -->
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
                            <th> Loại món ăn</th>
                            <th> Ảnh loại món ăn</th>
                            <th>Sửa</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
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
}
