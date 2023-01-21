<?php
include('../config.php');
session_start();

if (isset($_POST['idbl'])) {
    $idbl = $_POST['idbl'];
    $sql_bl = "SELECT * FROM binh_luan_danh_gia WHERE  id_binh_luan= $idbl LIMIT 1";
    $querybl = mysqli_query($mysqli, $sql_bl);
    $num = mysqli_num_rows($querybl);
    if ($num > 0) {
        while ($row = mysqli_fetch_array($querybl)) {
?>
            <form method="POST" action="includes/binhluan/xuly.php?idbinhluan=<?php echo $row['id_binh_luan'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Nội dung bình luận </label>
                        <input type="text" name="nd" value="<?php echo $row['noi_dung'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Phản hồi</label>
                        <textarea name="phanhoi" class="form-control" placeholder="Trả lời bình luận"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="phan_hoi" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
<?php
        }
    }
} elseif (isset($_POST['phan_hoi'])) {
    $id_bl = $_GET['idbinhluan'];
    $id_ql=$_SESSION['id_ql'];
    $tra_loi= $_POST['phanhoi'];
    $sql_update = "INSERT INTO tra_loi_binh_luan(id_binh_luan,id_ql,tra_loi) VALUE('" . $id_bl . "','" . $id_ql . "','" . $tra_loi . "')";
    $query = mysqli_query($mysqli, $sql_update);
    if ($query) {
        $_SESSION['message_duyet'] = 'Sửa thành công';
        header('Location:../../index.php?action=binhluan&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message_duyet'] = 'Sửa thất bại ';
        header('Location:../../index.php?action=binhluan&query=danhsach');
        exit(0);
    }
}
