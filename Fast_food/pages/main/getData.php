<?php
include('../../admin/includes/config.php');
$row = $_POST['id'];

$query = "SELECT * FROM mon_an, gia, loai_mon_an where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an and mon_an.trang_thai=1 and mon_an.id_mon_an >'" . $row . "' limit 16";
$result = mysqli_query($mysqli, $query);
while ($row_mon_an = mysqli_fetch_assoc($result)) {
    $id = $row_mon_an['id_mon_an'];
?>
    <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px;">
        <div class=" card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
            <!-- Product image-->
            <div style="background-color: #f1f2f3;">
                <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                    <img class=" card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                <!-- Product details-->
            </div>
            <div class="card-body ">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">
                        <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                    <!-- Product price-->
                    <?php
                    $sql_khuyenmai = "SELECT * FROM mon_an,chi_tiet_khuyen_mai,gia,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an='" . $row_mon_an['id_mon_an'] . "'";
                    $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                    $row_km = mysqli_fetch_array($query_km);
                    ?>
                    <h6>
                        <?php
                        if (isset($row_km['id_km'])) {
                            $sqlctkm = "SELECT * FROM `chi_tiet_khuyen_mai` WHERE  id_km='" . $row_km['id_km'] . "'";
                            $query_ctkm = mysqli_query($mysqli, $sqlctkm);
                            $row_ctkm = mysqli_fetch_array($query_ctkm);
                            if ($row_km['trang_thai_km'] == 1) {
                        ?>
                                <p>
                                    <?php
                                    $gia = $row_mon_an['gia'];
                                    $giakm = $row_km['gia_tri_khuyen_mai'];
                                    $tong = $gia - $giakm;
                                    ?>&ensp;
                                    <span style="font-weight: 700;font-size: 18px;">&#160;&#160;<?php echo number_format($tong, 0, ',', '.'); ?>&#160;<span style="text-decoration:underline;">đ</span>
                                    </span>&ensp;&ensp;<br>
                                    <span style="text-decoration: line-through;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.'); ?>&#160;<span style="text-decoration:underline;">đ</span></span>
                                </p>
                            <?php

                            } else {
                            ?>
                                <p style="padding-bottom: 20px;">
                                    <span style="font-weight: 700;font-size: 18px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;">đ</span>
                                    </span>
                                </p>
                            <?php
                            }
                        } else {
                            ?>
                            <p style="padding-bottom: 20px;">
                                <span style="font-weight: 700;font-size: 18px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;">đ</span>
                                </span>
                            </p>
                        <?php
                        }
                        ?>
                    </h6>
                </div>
                <div class="card-footer pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <h4 style="color:#222831;font-size: 1px;"><?php echo $row_mon_an['id_mon_an'] ?></h4>
                        <?php
                        if (isset($row_km['id_km'])) {
                        ?>
                            <?php
                            if ($row_mon_an['soluong'] > 0) {
                            ?>
                                <button type="submit" id="button_insert1" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
                                    Thêm giỏ hàng</button>
                                <!-- <button type="submit" id="button_insert1" name="themgiohang1" class="fa fa-shopping-cart" target="_self" title="Thêm vào giỏ hàng"></button> -->
                            <?php
                            } else {
                            ?>
                                <input type="text" style="width: 100%;" target="_self" class=" btn_add btn " value="Hết món" readonly>

                            <?php
                            }
                            ?>
                        <?php
                        } elseif (!isset($row_km['id_km'])) {
                        ?>
                            <?php
                            if ($row_mon_an['soluong'] > 0) {
                            ?>
                                <button type="submit" id="button_insert" style=" width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
                                    Thêm
                                    giỏ hàng</button>
                                <!-- <button type="submit" id="button_insert" name="themgiohang" class="fa fa-shopping-cart" target="_self" title="Thêm vào giỏ hàng"></button> -->
                            <?php
                            } else {
                            ?>
                                <input type="text" style="width: 100%;" target="_self" class=" btn_add btn " value="Hết món" readonly>

                                <!-- <button type="submit" style="height: 37px;border: none;color: white;background-color:#ffbe33;width: 79px;border-radius: 17px;font-size: 16px;">Hết hàng</button> -->
                            <?php
                            }
                            ?>
                        <?php
                        } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
}
?>
<div id="remove-row" style="position: relative;left:  45%;top: 13px;">
    <button type=" button" id="load_more" class="btn btn-primary" data-id="<?php echo $id ?>" data-toggle="button" aria-pressed="false" autocomplete="off">
        <span style="padding: 51px;">Xem thêm</span>
    </button>
</div>
<?
