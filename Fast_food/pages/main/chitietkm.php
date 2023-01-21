<style>
    .content {
        padding-top: 58px;
        padding-bottom: 15px;
        max-width: 80%;
        text-align: -webkit-match-parent;
    }

</style>

<?php
$id_km = $_GET['idkm'];
$sql_lietke_km = "SELECT * FROM  khuyen_mai WHERE id_km='" . $id_km . "'";
$query_lietke_km = mysqli_query($mysqli, $sql_lietke_km);
$row = mysqli_fetch_array($query_lietke_km);
?>

<div class="container mt-4" style="height: 500px;max-width: 80%;">
    <div>
        <h4 style="font-size: 22px;line-height: 2rem;text-transform: uppercase;color: #e4002b;font-family: Oswald,sans-serif;font-weight: 700;">
            <?php echo $row['noi_dung_km'] ?>
        </h4>
        <a href="index.php?quanly=loai"><button type="button" class="btn btn-danger" style="height: 35px;padding: 5px;font-family: Oswald,sans-serif;position: relative;top: 7px;">Đặt món ngay</button></a>
    </div>
    <br>
    <div style="padding-bottom: 10px;">
        <?php
        $sql_lietke_gia = "SELECT * FROM  chi_tiet_khuyen_mai,mon_an,gia WHERE gia.id_mon_an=mon_an.id_mon_an and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and chi_tiet_khuyen_mai.id_km='" . $id_km . "' ORDER BY gia.gia ASC Limit 1";
        $query_lietke_gia = mysqli_query($mysqli, $sql_lietke_gia);
        $rowgia = mysqli_fetch_array($query_lietke_gia);
        if (!isset($rowgia['id_km'])) {
            echo "Rất tiết khuyến mãi đã hết hạn.";
        } else {
        ?>

            <strong>
                <span style="font-size:17px;line-height:150%;font-family:'Arial',sans-serif;">
                    Thực đơn trưa cho giao hàng tận nơi với giá chỉ từ <?php echo number_format($rowgia['gia'], 0, ',', '.') ?> đồng/phần.
                </span></strong>
        <?php
        }
        ?>
    </div>
    <?php
    if (!isset($rowgia['id_km'])) {
    } else {
    ?>
        <div>
            <?php
            $sql_lietke_ctkm = "SELECT * FROM  chi_tiet_khuyen_mai, khuyen_mai,mon_an,gia WHERE gia.id_mon_an=mon_an.id_mon_an and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and chi_tiet_khuyen_mai.id_km='" . $id_km . "'";
            $query_lietke_ctkm = mysqli_query($mysqli, $sql_lietke_ctkm);
            while ($row_mon = mysqli_fetch_array($query_lietke_ctkm)) {

            ?>
                <p><?php echo $row_mon['ten_mon_an'] ?>: <?php echo $row_mon['mo_ta_mon'] ?> - <?php echo number_format($row_mon['gia'], 0, ',', '.') ?> đồng/phần.</p>

            <?php
            }
            ?>
            <p>Áp dụng tại tất cả cửa hàng Dang Food cho cả giao hàng tận nơi từ 10h đến 14h, Thứ 2 đến Thứ 6 hàng tuần đến hết ngày 18/01/2023.
            </p>
            <br>
            <p>Không áp dụng cho Thứ 7, Chủ Nhật, ngày 02/01/2023, đơn hàng trên 2 triệu đồng và các chương trình khuyến mãi khác.</p>
        </div>
    <?php
    }

    ?>
</div>