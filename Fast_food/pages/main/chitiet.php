<style>
    .dropdown-item1 {
        font-size: 17px;
        font-weight: 550;
    }

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
$code = $_GET['IdGH'];
$sql_lietke_dh = "SELECT DISTINCT *FROM mon_an AS m, gio_hang AS gh, chi_tiet_gio_hang AS ctgh,khach_hang AS kh
WHERE(kh.id_kh=gh.id_kh) AND (m.id_mon_an = ctgh.id_mon_an) AND (gh.id_gio_hang = ctgh.id_gio_hang) AND gh.id_gio_hang='" . $code . "' ";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
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
                                <a class="dropdown-item1" href="#">Thông tin cá nhân</a><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class=" py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Thông tin chi tiết đơn hàng: <?php echo $code; ?>
                                    </h6>
                                </div>
                                <table id="datatableid" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên món ăn</th>
                                            <th>Hình</th>
                                            <th>Giá bán</th>

                                            <th>Khuyến mãi</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $tongtien = 0;

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
                                                <td> <img src="admin/includes/quanlymonan/uploads/<?php echo $row1['anh_mon_an'] ?>" width="200px" height="150px" /></td>
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
                                            <td colspan="4" style="border:none"></td>
                                            <td class="tbl_xem">Tổng</td>
                                            <td class="thanhtoan">
                                                <?php echo $soluongmon ?>
                                            </td>
                                            <td>
                                                <input type="hidden" class="thanhtoan" value="<?php echo $tongkm ?>" name="tongthanhtoan" readonly>
                                                <input type="text" class="thanhtoan" value="<?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="border:none"></td>
                                            <td class="tbl_xem">Tổng tiền:</td>
                                            <td colspan="2">
                                                <input type="hidden" class="thanhtoan" value="<?php echo $tongkm ?>" name="tongthanhtoan" readonly>
                                                <input type="text" class="thanhtoan" value="<?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?>" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>