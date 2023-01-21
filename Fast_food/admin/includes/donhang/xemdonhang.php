
<style>
    .name_xma {
        color: blue;
    }

    .tbl_xem {
        font-weight: bold;
        color: blue;
        text-align: center;
    }

    .thanhtoan {
        border: none;
        width: 116px;
        color: red;
        font-weight: 900;
        font-size: 19px;
    }

    td,
    tr {
        text-align: center;
    }
</style>
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
$code = $_GET['code'];
$idkh = $_GET['idkh'];
$sql_lietke_donhang = "SELECT DISTINCT* FROM khach_hang WHERE  id_kh='" . $idkh . "'";
$query_lietke_don_hang = mysqli_query($mysqli, $sql_lietke_donhang);
$row = mysqli_fetch_array($query_lietke_don_hang);

$sql_lietke_dh = "SELECT DISTINCT *FROM mon_an AS m, gio_hang AS gh, chi_tiet_gio_hang AS ctgh,khach_hang AS kh
WHERE(kh.id_kh=gh.id_kh) AND (m.id_mon_an = ctgh.id_mon_an) AND (gh.id_gio_hang = ctgh.id_gio_hang) AND gh.id_gio_hang='" . $code . "' ";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<div class="container-fluid">
    <form method="POST" action="includes/donhang/xuly.php?code=<?php echo $code ?>" enctype="multipart/form-data">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin chi tiết đơn hàng <?php echo $code; ?>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <label> Tên khách hàng ăn: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <span class="name_xma"><?php echo $row['ten_kh'] ?></span>
                    </div>
                    <div class="form-group">
                        <label> Số điện thoại: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <span class="name_xma"><?php echo $row['sdt_kh'] ?></span>

                    </div>
                    <div class="form-group">
                        <label> Địa chỉ:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <span class="name_xma"><?php echo $row['dia_chi_kh'] ?></span>
                    </div>
                    <div class="form-group">
                        <label> Hình thức thanh toán:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <span class="name_xma">
                            <?php
                            $sqldon = "SELECT DISTINCT* FROM gio_hang WHERE  id_gio_hang='" . $code . "'";
                            $query_lietke_don = mysqli_query($mysqli, $sqldon);
                            $rowdon = mysqli_fetch_array($query_lietke_don);

                            echo $rowdon['ht_thanh_toan'] ?></span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label style="color:black"> Chi tiết đơn hàng </label>
                    </div>
                    <table id="datatableid" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên món ăn</th>
                                <th>Hình</th>
                                <th>Giá bán </th>
                                <th>Khuyến mãi</th>
                                <!-- <th>Tổng khuyến mãi</th> -->
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $tongtien = 0;
                            $tong_km = 0;
                            $soluongmon = 0;

                            while ($row1 = mysqli_fetch_array($query_lietke_dh)) {
                            ?>
                                <?php
                                $sl = $row1['so_luong'];
                                $gia = $row1['gia_mon_an'];
                                $thanhtien = ($sl * $gia);
                                $tongtien += $thanhtien;
                                $soluongmonan = $row1['so_luong'] * 1;
                                $soluongmon += $soluongmonan;
                                $i++;

                                $data[] = $row1;
                                // echo  $tongkm;
                                ?>


                                <tr>
                                    <td> <?php echo $i ?></td>
                                    <td><?php echo $row1['ten_mon_an'] ?></td>
                                    <td> <img src="includes/quanlymonan/uploads/<?php echo $row1['anh_mon_an'] ?>" width="200px" height="150px" /></td>
                                    <td> <?php
                                            if ($row1['khuyen_mai_ctgh'] != "") {
                                                $giagoc = $row1['khuyen_mai_ctgh'] + $row1['gia_mon_an'];
                                                echo number_format($giagoc,  0, ',', '.') . 'đ';
                                            } else {
                                                echo number_format($row1['gia_mon_an'],  0, ',', '.') . 'đ';
                                            } ?></td>

                                    <td>
                                        <?php
                                        if ($row1['khuyen_mai_ctgh'] != "") {
                                            echo number_format($row1['khuyen_mai_ctgh'],  0, ',', '.') . 'đ';
                                        } else {
                                        }
                                        ?>
                                    </td>
                                    <!-- <td> <?php
                                                // if ($row1['khuyen_mai_ctgh'] != "") {
                                                //     $tong = $row1['khuyen_mai_ctgh'] * $row1['so_luong'];
                                                //     echo number_format($tong,  0, ',', '.') . 'đ';
                                                // } else {
                                                //     echo "0đ";
                                                // } 
                                                ?>
                                    </td> -->
                                    <td><?php echo $row1['so_luong'] ?></td>

                                    <td>
                                        <?php
                                        $sl = $row1['so_luong'];
                                        $gia = $row1['gia_mon_an'];
                                        $nt = ($gia * $sl);
                                        echo number_format($nt, 0, ',', '.') . 'đ';

                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tbody>

                            <tr>
                                <td colspan="5" style="border:none"></td>
                                <td class="tbl_xem">Số lượng:</td>
                                <td>
                                    <?php echo $soluongmon; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="border:none"></td>
                                <td class="tbl_xem">Tổng tiền:</td>
                                <td>
                                    <input type="hidden" class="thanhtoan" value="<?php echo $tongkm ?>" name="tongthanhtoan" readonly>
                                    <input type="text" class="thanhtoan" value="<?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?>" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </form>
</div>


<script>
    function hien() {
        document.getElementById("demo").style.display = "block";
    }

    function an() {
        document.getElementById("demo").style.display = "none";
    }
</script>
<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>