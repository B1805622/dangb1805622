<style type="text/css">
    .paging {
        display: flex;
        justify-content: flex-end;
    }

    ul.page_list {
        /* float: right; */
        /* padding-bottom: 40px; */
        padding-left: 0;
        /* margin: 0; */
        list-style: none;
    }

    ul.page_list li {
        float: left;
        padding: 5px 13px;
        margin: 5px;
        background-color: #fff;
        display: block;
    }

    ul.page_list li a {
        color: #3f2529;
        text-align: center;
        text-decoration: none;
    }
</style>
<?php

session_start();
include('../config.php');
if (isset($_POST['idhd'])) {
    $key = $_POST['idhd'];
    $sql_phieu = "SELECT * FROM khach_hang,mon_an,chi_tiet_gio_hang ,gio_hang,hoa_don
where gio_hang.id_kh=khach_hang.id_kh and hoa_don.id_gio_hang= gio_hang.id_gio_hang and gio_hang.id_gio_hang=chi_tiet_gio_hang.id_gio_hang 
and chi_tiet_gio_hang.id_mon_an=mon_an.id_mon_an  and hoa_don.id_hd='" . $key . "'";
    $phieu = mysqli_query($mysqli, $sql_phieu);

    $sql_hd = "SELECT * FROM hoa_don,khach_hang,gio_hang
where gio_hang.id_kh=khach_hang.id_kh and hoa_don.id_gio_hang= gio_hang.id_gio_hang  AND hoa_don.id_hd='" . $key . "'";
    $hd = mysqli_query($mysqli, $sql_hd);
    $row = mysqli_fetch_array($hd);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $num = mysqli_num_rows($phieu);
    echo
    '<style>
    .img1 {
        width: 70px;
        height: 70px;
    }

    .thanhtoan {
        border: none;
        width: 102px;
        color: red;
        font-weight: 900;
        font-size: 19px;
    }


    @page {
        size: A0;
        margin-top: 60px;
        padding-left: 0px;
      
    }

    /* .hoadobn {
        padding: 0 150px 150px 150px;
    } */
    </style>

';
    if ($num > 0) {
        echo ' <div class="container-fluid hoadobn" onclick="back()"';
        echo '">
            <div class="card">
                <div class="card-header">
                  
                    <div class="float-right">
                        <h3 class="mb-0">HÓA ĐƠN</h3>
                        <p style="font-size:13px ;">Mẫu số:01GTKT0/00';
        echo $row['id_hd'];
        echo '<br>';
        echo $d = date('d');
        echo '/';
        echo $m = date('m');
        echo '/';
        echo $m = date('Y');
        echo '
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3ne">Cửa hàng:</h5>
                            <h3 class="text-dark mb-1">Dang Food</h3>
                            <div>61/65, 30/4</div>
                            <div>Hưng Lợi, Ninh Kiều, Cần Thơ</div>
                            <div>Email: dangb1805622@sutdent.edu.vn</div>
                            <div>Phone: 0973751311</div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-3ne">Khách hàng:</h5>
                            <h3 class="text-dark mb-1">';
        echo $row['ten_kh'];
        echo '
                            </h3>
                            <div>';
        echo $row['dia_chi_kh'];
        echo '
                            </div>
                            <div>Email: ';
        echo $row['email_kh'];
        echo '
                            </div>
                            <div>Phone:';
        echo $row['sdt_kh'];
        echo '
                            </div>
                        </div>
                    </div>
                <div class="table-responsive-sm">
                    <!-- <table class="table table-striped"> -->
                    <table id="datatableid" class="table ">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên món ăn</th>
                                <th>Giá bán</th>
                                <th>Khuyến mãi</th>
                                <!-- <th>tổng km</th> -->
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>';
        $i = 0;
        $tongtien = 0;
        $soluongmon = 0;
        while ($row1 = mysqli_fetch_array($phieu)) {
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
            ?>
            <tr>

                <td> <?php echo $i ?></td>
                <td><?php echo $row1['ten_mon_an'] ?></td>

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
        <tr>
            <td colspan="4" style="border:none"></td>
            <td class="tbl_xem">Số lượng:</td>
            <td>
                <?php echo $soluongmon; ?>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="border:none"></td>

            <td class="tbl_xem">Tổng thanh toán:</td>
            <td>
                <input type="hidden" class="thanhtoan" value="<?php $tongtien ?> " name="tongthanhtoan" readonly>
                <input type="text" class="thanhtoan" value="<?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?>" readonly>
            </td>
        </tr>
        </table>
        </div>
        </div>
        </div>
<?php
    }
}
