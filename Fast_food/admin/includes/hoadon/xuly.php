<?php
session_start();
include('../config.php');
if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql_search_id_hd = "SELECT * FROM hoa_don, khach_hang, gio_hang WHERE gio_hang.id_gio_hang=hoa_don.id_gio_hang and gio_hang.id_kh=khach_hang.id_kh and  khach_hang.ten_kh LIKE '{$input}%' ";
    $result_search_id_hd = mysqli_query($mysqli, $sql_search_id_hd);
    $num = mysqli_num_rows($result_search_id_hd);
    if ($num > 0) {
?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <!-- <th>Số hóa đơn</th> -->
                            <th>Khách hàng</th>
                            <th>Ngày lập</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result_search_id_hd)) {
                            $i++;
                        ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <!-- <td>HD00<?php echo $row['id_hd'] ?></td> -->
                                <td><?php echo $row['ten_kh'] ?></td>
                                <td><?php
                                    $ngaylap = date_create($row['ngay_lap_hd']);
                                    echo date_format($ngaylap, "d-m-Y H:i:s");
                                    ?></td>

                                <td><?php echo $row['dia_chi_giao_hang'] ?></td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#onmodal" class="btn btn-primary" onclick="getdata(id_hd=<?php echo $row['id_hd'] ?>)"><i class="fas fa-solid fa-print"></i></button>
                                    <!-- </div> -->
                                    <!-- <a class="fas fa-solid fa-print" style="font-size:20px" href="index.php?action=hoadon&query=in&HD=<?php echo $row['id_hd'] ?>" style="color:#1961ad;"></a> -->
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
                <table id="datatableid" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <!-- <th>Số hóa đơn</th> -->
                            <th>Khách hàng</th>
                            <th>Ngày lập</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- <td></td> -->
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