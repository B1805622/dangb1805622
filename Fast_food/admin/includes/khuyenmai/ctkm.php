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
$code = $_GET['idkm'];
$sql_ten_km = "SELECT * FROM khuyen_mai WHERE  id_km='" . $code . "'";
$query_lietke_ten = mysqli_query($mysqli, $sql_ten_km);
$row = mysqli_fetch_array($query_lietke_ten);
$sql_lietke_km = "SELECT  *FROM khuyen_mai AS km, chi_tiet_khuyen_mai AS ctkm, mon_an AS ma, gia AS g
WHERE(km.id_km=ctkm.id_km) AND (ctkm.id_mon_an = ma.id_mon_an) and ma.id_mon_an= g.id_mon_an AND km.id_km='" . $code . "' ";
$query_lietke_km = mysqli_query($mysqli, $sql_lietke_km);
?>

<div class="container-fluid">
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_edit'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_edit']; ?>!</strong>
        </div>

    <?php
        unset($_SESSION['message_edit']);
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin chi tiết khuyến mãi: <?php echo $row['ten_km']; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <!-- <th>Tên KM</th> -->
                            <th>Tên món ăn</th>
                            <th>Thời gian áp dụng</th>
                            <th>Giá </th>
                            <th>Khuyến mãi</th>
                            <th>Số lượng KM</th>
                            <th style="width: 200px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row1 = mysqli_fetch_array($query_lietke_km)) {
                            $i++;
                        ?>


                            <tr>
                                <td> <?php echo $i ?></td>
                                <td><?php echo $row1['ten_mon_an'] ?></td>
                                <td>
                                    <?php
                                    $datebd = date_create($row1['ngay_bd']);
                                    echo date_format($datebd, "d/m/Y");
                                    echo " - ";
                                    $datekt = date_create($row1['ngay_kt']);
                                    echo date_format($datekt, "d/m/Y");
                                    ?>

                                </td>
                                <td> <?php
                                        echo number_format($row1['gia'],  0, ',', '.') . 'đ';
                                        ?></td>

                                <td>
                                    <?php
                                    echo number_format($row1['gia_tri_khuyen_mai'],  0, ',', '.') . 'đ';
                                    ?>
                                </td>
                                <td><?php echo $row1['soluong_km'] ?></td>

                                <td>
                                    <a class="btn" data-toggle="modal" data-target="#onmodalupdatekm" style="padding:0px" onclick="getdatasuakmmonan(id_km=<?php echo $row1['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-secondary btn-sm">Sửa</button></a>
                                    <div class="modal fade" id="onmodalupdatekm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="suakhuyenmai">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn" data-target="#logoutModal1" data-toggle="modal" style="padding:0px" onclick="getdataxoakm(Idmon=<?php echo $row1['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Ngưng áp dụng</button></a>
                                    <div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa khuyến mãi ?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"></div>

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
    </div>
</div>


<script>
    function getdatasuakmmonan() {
        var IDMONAN = id_km;
        $.ajax({
            url: "includes/khuyenmai/xuly2.php",
            type: "POST",
            data: {
                IDMONAN: IDMONAN
            },
            success: function(data) {
                $(".suakhuyenmai").html(data);
            }
        })
    }

    function getdatasuakmmonan2() {
        var IDKM2 = id_km;
        // var tgbd = tg_bd;
        // alert(id_mon_an_km);

        $.ajax({
            url: "includes/khuyenmai/xuly2.php",
            type: "POST",
            data: {
                IDKM2: IDKM2
            },
            success: function(data) {
                $(".suakhuyenmai2").html(data);
            }
        })
    }

    function getdataxoakm() {
        var id_mon = Idmon;
        // alert(id_mon);

        $.ajax({
            url: "includes/khuyenmai/xuly2.php",
            type: "POST",
            data: {
                id_mon: id_mon
            },
            success: function(data) {
                $(".modal-body").html(data);
            }
        })
    }
</script>

<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>