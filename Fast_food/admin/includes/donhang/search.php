<?php
session_start();
include('../config.php');
if (isset($_POST['id_trang_thai'])) {
    $key = $_POST['id_trang_thai'];
    $sql_lietke_donhang = "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh 
WHERE  kh.id_kh=gh.id_kh and gh.trang_thai='" . $key . "'ORDER BY gh.`thoi_gian_add` DESC";
    $query_id_km = mysqli_query($mysqli, $sql_lietke_donhang);
    $num = mysqli_num_rows($query_id_km);
    if ($num > 0) {
?>
        <div class="searchresult">
            <div class="card-body" id="all1">
                <div class="table-responsive">
                    <table id="datatableid" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Tình trạng </th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($query_id_km)) {
                                $i++;
                            ?>
                                <tr>
                                    <td> <?php echo $i ?></td>
                                    <td><?php echo $row['id_gio_hang'] ?></td>
                                    <td><?php echo $row['ten_kh'] ?></td>
                                    <td><?php echo $row['dia_chi_kh'] ?></td>

                                    <td>
                                        <?php if ($row['trang_thai'] == 1) {
                                            echo '<span style="color:red">Đơn hàng mới</span>';
                                        } elseif ($row['trang_thai'] == 2) {
                                            echo 'Giao hàng';
                                        } elseif ($row['trang_thai'] == 3) {
                                            echo 'Đang giao hàng';
                                        } elseif ($row['trang_thai'] == 6) {
                                            echo 'Đã thanh toán';
                                        } elseif ($row['trang_thai'] == 4) {
                                            echo 'Đã hủy';
                                        } elseif ($row['trang_thai'] == 5) {
                                            echo 'Yêu cầu hủy';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($row['trang_thai'] == 1) {
                                        ?>
                                            <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                            <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-success btn-sm">Duyệt</button></a>
                                            <a onclick="return Del('<?php echo $row['id_gio_hang'] ?>')" href="includes/donhang/xoa.php?code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-danger btn-sm">Hủy</button></a>
                                        <?php
                                        } elseif ($row['trang_thai'] == 2) {
                                        ?>
                                            <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                            <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?> "><button type="button" class="btn btn-outline-success btn-sm">Giao hàng</button></a>
                                            <a onclick="return Del('<?php echo $row['id_gio_hang'] ?>')" href="includes/donhang/xoa.php?code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-danger btn-sm">Hủy</button></a>
                                        <?php

                                        } elseif ($row['trang_thai'] == 3) {
                                        ?>
                                            <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                            <a onclick="getdata(id_hd=<?php echo $row['id_gio_hang'] ?>)"><button type="button" class="btn btn-outline-warning btn-sm">In</button></button>

                                                <!-- <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-info btn-sm">In</button></a> -->
                                                <!-- <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-secondary btn-sm">Đã thanh toán</button></a> -->

                                            <?php
                                        } elseif ($row['trang_thai'] == 4) {
                                            ?>
                                                <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                            <?php
                                        } elseif ($row['trang_thai'] == 5) {
                                            ?>
                                                <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                                <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xác nhận</button></a>

                                            <?php
                                        } elseif ($row['trang_thai'] == 6) {
                                            ?>
                                                <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>

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
        </div>
    <?php
    } else {
    ?>
        <div class="searchresult">
            <div class="card-body" id="all1">
                <div class="table-responsive">
                    <table id="datatableid" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Tình trạng </th>
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
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php
    }
} elseif (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql_search_id_gh = "SELECT * FROM  gio_hang AS gh, khach_hang AS kh WHERE kh.id_kh=gh.id_kh and gh.id_gio_hang LIKE '{$input}%' ";
    $result_search_id_gh = mysqli_query($mysqli, $sql_search_id_gh);
    $num = mysqli_num_rows($result_search_id_gh);
    if ($num > 0) {
    ?>
        <div class="card-body" id="all1">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Tình trạng </th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result_search_id_gh)) {
                            $i++;
                        ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td><?php echo $row['id_gio_hang'] ?></td>
                                <td><?php echo $row['ten_kh'] ?></td>
                                <td><?php echo $row['dia_chi_kh'] ?></td>

                                <td>
                                    <?php if ($row['trang_thai'] == 1) {
                                        echo '<span style="color:red">Đơn hàng mới</span>';
                                    } elseif ($row['trang_thai'] == 2) {
                                        echo 'Giao hàng';
                                    } elseif ($row['trang_thai'] == 3) {
                                        echo 'Đang giao hàng';
                                    } elseif ($row['trang_thai'] == 6) {
                                        echo 'Đã thanh toán';
                                    } elseif ($row['trang_thai'] == 4) {
                                        echo 'Đã hủy';
                                    } elseif ($row['trang_thai'] == 5) {
                                        echo 'Yêu cầu hủy';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($row['trang_thai'] == 1) {
                                    ?>
                                        <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                        <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-success btn-sm">Duyệt</button></a>
                                        <a onclick="return Del('<?php echo $row['id_gio_hang'] ?>')" href="includes/donhang/xoa.php?code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-danger btn-sm">Hủy</button></a>
                                    <?php
                                    } elseif ($row['trang_thai'] == 2) {
                                    ?>
                                        <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                        <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?> "><button type="button" class="btn btn-outline-success btn-sm">Giao hàng</button></a>
                                        <a onclick="return Del('<?php echo $row['id_gio_hang'] ?>')" href="includes/donhang/xoa.php?code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-danger btn-sm">Hủy</button></a>
                                    <?php

                                    } elseif ($row['trang_thai'] == 3) {
                                    ?>
                                        <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                        <a onclick="getdata(id_hd=<?php echo $row['id_gio_hang'] ?>)"><button type="button" class="btn btn-outline-warning btn-sm">In</button></button>

                                            <!-- <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-info btn-sm">In</button></a> -->
                                            <!-- <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-secondary btn-sm">Đã thanh toán</button></a> -->

                                        <?php
                                    } elseif ($row['trang_thai'] == 4) {
                                        ?>
                                            <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                        <?php
                                    } elseif ($row['trang_thai'] == 5) {
                                        ?>
                                            <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
                                            <a href="includes/donhang/xuly.php?tinh_trang=<?php echo $row['trang_thai'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xác nhận</button></a>

                                        <?php
                                    } elseif ($row['trang_thai'] == 6) {
                                        ?>
                                            <a href="index.php?action=donhang&query=xem&idkh=<?php echo $row['id_kh'] ?>&code=<?php echo $row['id_gio_hang'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>

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
        <div class="card-body" id="all1">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Tình trạng </th>
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