<?php
include('../config.php');
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");
if (isset($_POST['xid']) & isset($_POST['yid'])) {
    $ngay_bd = $_POST['xid'];
    $ngay_kt = $_POST['yid'];

    $sql_thongke1 = "SELECT *FROM thongke WHERE ngay_dat BETWEEN '$ngay_bd' AND '$ngay_kt' ORDER BY ngay_dat DESC";
    $query_thongke1 = mysqli_query($mysqli, $sql_thongke1);
    $num = mysqli_num_rows($query_thongke1);

    if ($num > 0) {
?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th> STT </th>
                            <th>Thời gian</th>
                            <th>Tổng đơn hàng</th>
                            <th>Số lượng bán</th>
                            <th>Doanh thu</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row1 = mysqli_fetch_array($query_thongke1)) {
                            $i++;
                        ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td><?php
                                    $datebd = date_create($row1['ngay_dat']);
                                    echo date_format($datebd, "d-m-Y");
                                    ?></td>
                                <td> <?php echo $row1['donhang'] ?></td>
                                <td> <?php echo $row1['soluongban'] ?></td>
                                <td> <?php echo number_format($row1['doanhthu'], 0, ',', '.') . 'đ'; ?>
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
                            <th>Thời gian</th>
                            <th>Tổng đơn hàng</th>
                            <th>Số lượng bán</th>
                            <th>Doanh thu</th>

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
?>