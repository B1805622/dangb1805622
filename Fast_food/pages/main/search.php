<?php
session_start();
include('../../admin/includes/config.php');
if (isset($_POST['km'])) {
    $km = $_POST['km'];

    $sql_km = "SELECT * FROM `chi_tiet_khuyen_mai`,gia,mon_an WHERE chi_tiet_khuyen_mai.id_mon_an=mon_an.id_mon_an AND mon_an.id_mon_an=gia.id_mon_an";
    $query_km = mysqli_query($mysqli, $sql_km);
    $num = mysqli_num_rows($query_km);
    if ($num > 0) {
?>
        <div class="filters-content" style="padding-top: 142px;">
            <div class="name_loai">
                <?php echo "ƯU ĐÃI" ?>
            </div>
            <div class="row grid">
                <?php
                while ($row_km = mysqli_fetch_array($query_km)) {
                ?>
                    <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                        <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">

                            <div style="background-color: #f1f2f3;">
                                <a href="index.php?quanly=monan&IdMon=<?php echo $row_km['id_mon_an'] ?>">
                                    <img class="card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_km['anh_mon_an'] ?>" /></a>
                            </div>
                            <div class="card-body ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                        <?php echo $row_km['ten_mon_an'] ?></h5>
                                    <!-- Product price-->

                                    <h6>
                                        <?php
                                        $sql_khuyenmai = "SELECT * FROM mon_an,chi_tiet_khuyen_mai,gia,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an='" . $row_km['id_mon_an'] . "'";
                                        $query_km1 = mysqli_query($mysqli, $sql_khuyenmai);
                                        $row_km1 = mysqli_fetch_array($query_km1);
                                        if (isset($row_km1['id_km'])) {
                                            if ($row_km1['trang_thai_km'] = 1) {

                                        ?>
                                                <p>
                                                    <?php
                                                    $gia = $row_km['gia'];
                                                    $giakm = $row_km1['gia_tri_khuyen_mai'];
                                                    $tong = $gia - $giakm;
                                                    ?>&ensp;
                                                    <span style="font-weight: 700;font-size: 19px;;">&#160;<?php echo number_format($tong, 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>&ensp;&ensp;<br>
                                                    <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_km['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>
                                                </p>
                                            <?php

                                            } else {
                                            ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_km['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <p style="padding-bottom: 20px;">
                                                <span style="font-weight: 700;font-size: 19px"><?php echo number_format($row_km['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                </span>
                                            </p>
                                        <?php
                                        }
                                        ?>
                                    </h6>
                                </div>
                                <div class="pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <h4 style="color:#222831;font-size: 1px;"><?php echo $row_km['id_mon_an'] ?></h4>
                                        <?php
                                        if (isset($row_km['id_km'])) {
                                        ?>
                                            <?php
                                            if ($row_km['soluong'] > 0) {
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
                                                <button type="submit" id="button_insert" style="width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
            </div>
        </div>
    <?php } else {
    ?>
        <div class="filters-content" style="padding-top: 142px;">
            <div class="name_loai">
                <?php echo "ƯU ĐÃI" ?>
            </div>
            <div class="row grid">
                <div style="padding-top: 10px;">Món ăn trống</div>
            </div>
        </div>
    <?php }
} elseif (isset($_POST['id_loai'])) {
    $key = $_POST['id_loai'];
    $sqlloai = "SELECT * FROM loai_mon_an where id_loai_mon_an=$key";
    $query_loai = mysqli_query($mysqli, $sqlloai);
    $rowloai = mysqli_fetch_array($query_loai);
    $sql_id_loai = "SELECT * FROM mon_an, gia, loai_mon_an where  mon_an.id_mon_an=gia.id_mon_an and mon_an.trang_thai=1  and mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an and loai_mon_an.id_loai_mon_an='" . $key . "'";
    $query_pro1 = mysqli_query($mysqli, $sql_id_loai);
    $num = mysqli_num_rows($query_pro1);
    if ($num > 0) {
    ?>
        <div class="filters-content" style="padding-top: 142px;">
            <div class="name_loai">
                <?php echo $rowloai['ten_loai_mon_an'] ?>
            </div>
            <div class="row grid">
                <?php
                while ($row_mon_an = mysqli_fetch_array($query_pro1)) {
                ?>
                    <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                        <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                            <!-- Product image-->
                            <div style="background-color: #f1f2f3;">
                                <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                    <img class="card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                <!-- Product details-->
                            </div>
                            <div class="card-body ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                        <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                                    <?php
                                    $sql_khuyenmai = "SELECT * FROM mon_an,chi_tiet_khuyen_mai,gia,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an='" . $row_mon_an['id_mon_an'] . "'";
                                    $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                    $row_km = mysqli_fetch_array($query_km);
                                    ?>
                                    <h6>
                                        <?php
                                        if (isset($row_km['id_km'])) {
                                            if ($row_km['trang_thai_km'] = 1) {
                                                if ($row_km['trang_thai_ctkm'] = 1) {
                                        ?>
                                                    <p>
                                                        <?php
                                                        $gia = $row_mon_an['gia'];
                                                        $giakm = $row_km['gia_tri_khuyen_mai'];
                                                        $tong = $gia - $giakm;
                                                        ?>&ensp;
                                                        <span style="font-weight: 700;font-size: 19px;">&#160;<?php echo number_format($tong, 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>&ensp;&ensp;<br>
                                                        <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>
                                                    </p>
                                                <?php
                                                } else {
                                                    //trang thai ctkm =2
                                                ?>
                                                    <p style="padding-bottom: 20px;">
                                                        <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                        </span>
                                                    </p>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <p style="padding-bottom: 20px;">
                                                <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                </span>
                                            </p>
                                        <?php
                                        }
                                        ?>
                                    </h6>
                                </div>
                                <div class=" pt-0 border-top-0 bg-transparent">
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
                                                <button type="submit" id="button_insert" style="width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
            </div>

        <?php } else {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div class="name_loai">
                    <?php echo $rowloai['ten_loai_mon_an'] ?>
                </div>
                <div class="row grid">
                    <div style="padding-top: 10px;">Món ăn trống</div>
                </div>
            </div>
        </div>
    <?php }
} elseif (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql_searchloai = "SELECT * FROM gia,mon_an WHERE  mon_an.id_mon_an=gia.id_mon_an and mon_an.ten_mon_an LIKE '{$input}%' ";
    $result_search_loai = mysqli_query($mysqli, $sql_searchloai);
    $num1 = mysqli_num_rows($result_search_loai);
    if ($num1 > 0) {
    ?>

        <div class="filters-content" style="padding-top: 142px;">
            <div class="row grid">
                <?php
                while ($row_mon_an = mysqli_fetch_array($result_search_loai)) {
                ?>
                    <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                        <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                            <!-- Product image-->
                            <div style="background-color: #f1f2f3;">
                                <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                    <img class="card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                <!-- Product details-->
                            </div>
                            <div class="card-body ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                        <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                                    <?php
                                    $sql_khuyenmai = "SELECT * FROM chi_tiet_khuyen_mai,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row_mon_an['id_mon_an'] . "'";
                                    $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                    $row_km = mysqli_fetch_array($query_km);
                                    ?>
                                    <h6>
                                        <?php
                                        if (isset($row_km['id_km'])) {
                                            if ($row_km['trang_thai_km'] = 1) {
                                                if ($row_km['trang_thai_ctkm'] = 1) {
                                        ?>
                                                    <p>
                                                        <?php
                                                        $gia = $row_mon_an['gia'];
                                                        $giakm = $row_km['gia_tri_khuyen_mai'];
                                                        $tong = $gia - $giakm;
                                                        ?>&ensp;
                                                        <span style="font-weight: 700;font-size: 19px;">&#160;<?php echo number_format($tong, 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>&ensp;&ensp;<br>
                                                        <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>
                                                    </p>
                                                <?php
                                                } else {
                                                    //trang thai ctkm =2
                                                ?>
                                                    <p style="padding-bottom: 20px;">
                                                        <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                        </span>
                                                    </p>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <p style="padding-bottom: 20px;">
                                                <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                </span>
                                            </p>
                                        <?php
                                        }
                                        ?>
                                    </h6>
                                </div>
                                <div class="pt-0 border-top-0 bg-transparent">
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
                                                <button type="submit" id="button_insert" style="width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
            </div>
        </div>

    <?php } else {
    ?>
        <div class="filters-content" style="padding-top: 142px;">
            <div style="height: 500px;">
                <div class="name_loai">
                    Món ăn không tồn tại
                </div>
            </div>
        </div>
        <?php }
} elseif (isset($_POST['id_gia'])) {
    $gia = $_POST['id_gia'];
    if ($gia == 1) {
        $sql_lietke_sp1 = "SELECT * FROM mon_an, gia, loai_mon_an where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an and mon_an.trang_thai=1 and gia.gia<20000  ORDER BY mon_an.id_mon_an ";
        $query_pro = mysqli_query($mysqli, $sql_lietke_sp1);

        $num = mysqli_num_rows($query_pro);
        if ($num > 0) {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div class="row grid">
                    <?php
                    while ($row_mon_an = mysqli_fetch_array($query_pro)) {
                    ?>
                        <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                            <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                                <!-- Product image-->
                                <div style="background-color: #f1f2f3;">
                                    <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                        <img class="card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                    <!-- Product details-->
                                </div>
                                <div class="card-body ">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">
                                            <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                                        <?php
                                        $sql_khuyenmai = "SELECT * FROM chi_tiet_khuyen_mai,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row_mon_an['id_mon_an'] . "'";
                                        $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                        $row_km = mysqli_fetch_array($query_km);
                                        ?>
                                        <h6>
                                            <?php
                                            if (isset($row_km['id_km'])) {
                                                if ($row_km['trang_thai_km'] = 1) {
                                                    if ($row_km['trang_thai_ctkm'] = 1) {
                                            ?>
                                                        <p>
                                                            <?php
                                                            $gia = $row_mon_an['gia'];
                                                            $giakm = $row_km['gia_tri_khuyen_mai'];
                                                            $tong = $gia - $giakm;
                                                            ?>&ensp;
                                                            <span style="font-weight: 700;font-size: 19px;">&#160;<?php echo number_format($tong, 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>&ensp;&ensp;<br>
                                                            <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>
                                                        </p>
                                                    <?php
                                                    } else {
                                                        //trang thai ctkm =2
                                                    ?>
                                                        <p style="padding-bottom: 20px;">
                                                            <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                            </span>
                                                        </p>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <p style="padding-bottom: 20px;">
                                                        <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                        </span>
                                                    </p>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                    <div class=" pt-0 border-top-0 bg-transparent">
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
                                                    <button type="submit" id="button_insert" style="width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
                </div>
            </div>
        <?php } else {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div style="height: 500px;">
                    <div class="name_loai">
                        Món ăn không tồn tại
                    </div>
                </div>
            </div>
        <?php }
    } elseif ($gia == 2) {
        $sql_lietke_sp1 = "SELECT * FROM mon_an, gia, loai_mon_an where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an and mon_an.trang_thai=1 and gia.gia>=20000  and gia.gia<=100000 ORDER BY mon_an.id_mon_an ";
        $query_pro = mysqli_query($mysqli, $sql_lietke_sp1);

        $num = mysqli_num_rows($query_pro);
        if ($num > 0) {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div class="row grid">
                    <?php
                    while ($row_mon_an = mysqli_fetch_array($query_pro)) {
                    ?>
                        <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                            <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                                <!-- Product image-->
                                <div style="background-color: #f1f2f3;">
                                    <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                        <img class="card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                    <!-- Product details-->
                                </div>
                                <div class="card-body ">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">
                                            <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                                        <?php
                                        $sql_khuyenmai = "SELECT * FROM chi_tiet_khuyen_mai,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row_mon_an['id_mon_an'] . "'";
                                        $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                        $row_km = mysqli_fetch_array($query_km);
                                        ?>
                                        <h6>
                                            <?php
                                            if (isset($row_km['id_km'])) {
                                                if ($row_km['trang_thai_km'] = 1) {
                                                    if ($row_km['trang_thai_ctkm'] = 1) {
                                            ?>
                                                        <p>
                                                            <?php
                                                            $gia = $row_mon_an['gia'];
                                                            $giakm = $row_km['gia_tri_khuyen_mai'];
                                                            $tong = $gia - $giakm;
                                                            ?>&ensp;
                                                            <span style="font-weight: 700;font-size: 19px;">&#160;<?php echo number_format($tong, 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>&ensp;&ensp;<br>
                                                            <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>
                                                        </p>
                                                    <?php
                                                    } else {
                                                        //trang thai ctkm =2
                                                    ?>
                                                        <p style="padding-bottom: 20px;">
                                                            <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                            </span>
                                                        </p>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <p style="padding-bottom: 20px;">
                                                        <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                        </span>
                                                    </p>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                    <div class="pt-0 border-top-0 bg-transparent">
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
                                                    <button type="submit" id="button_insert" style="width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
                </div>
            </div>
        <?php } else {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div style="height: 500px;">
                    <div class="name_loai">
                        Món ăn không tồn tại
                    </div>
                </div>
            </div>
        <?php }
    } elseif ($gia == 3) {
        $sql_lietke_sp1 = "SELECT * FROM mon_an, gia, loai_mon_an where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an and mon_an.trang_thai=1 and gia.gia>100000 ORDER BY mon_an.id_mon_an ";
        $query_pro = mysqli_query($mysqli, $sql_lietke_sp1);

        $num = mysqli_num_rows($query_pro);
        if ($num > 0) {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div class="row grid">
                    <?php
                    while ($row_mon_an = mysqli_fetch_array($query_pro)) {
                    ?>
                        <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                            <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                                <!-- Product image-->
                                <div style="background-color: #f1f2f3;">
                                    <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                        <img class="card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                    <!-- Product details-->
                                </div>
                                <div class="card-body ">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">
                                            <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                                        <?php
                                        $sql_khuyenmai = "SELECT * FROM chi_tiet_khuyen_mai,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row_mon_an['id_mon_an'] . "'";
                                        $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                        $row_km = mysqli_fetch_array($query_km);
                                        ?>
                                        <h6>
                                            <?php
                                            if (isset($row_km['id_km'])) {
                                                if ($row_km['trang_thai_km'] = 1) {
                                                    if ($row_km['trang_thai_ctkm'] = 1) {
                                            ?>
                                                        <p>
                                                            <?php
                                                            $gia = $row_mon_an['gia'];
                                                            $giakm = $row_km['gia_tri_khuyen_mai'];
                                                            $tong = $gia - $giakm;
                                                            ?>&ensp;
                                                            <span style="font-weight: 700;font-size: 19px;">&#160;<?php echo number_format($tong, 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>&ensp;&ensp;<br>
                                                            <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>
                                                        </p>
                                                    <?php
                                                    } else {
                                                        //trang thai ctkm =2
                                                    ?>
                                                        <p style="padding-bottom: 20px;">
                                                            <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                            </span>
                                                        </p>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <p style="padding-bottom: 20px;">
                                                        <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                        </span>
                                                    </p>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                    <div class="pt-0 border-top-0 bg-transparent">
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
                                                    <button type="submit" id="button_insert" style="width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
                </div>
            </div>
        <?php } else {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div style="height: 500px;">
                    <div class="name_loai">
                        Món ăn không tồn tại
                    </div>
                </div>
            </div>
        <?php }
    } elseif ($gia == 0) {
        $sql_lietke_sp1 = "SELECT * FROM mon_an, gia, loai_mon_an where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an and mon_an.trang_thai=1  ORDER BY mon_an.id_mon_an ";
        $query_pro = mysqli_query($mysqli, $sql_lietke_sp1);

        $num = mysqli_num_rows($query_pro);
        if ($num > 0) {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div class="row grid">
                    <?php
                    while ($row_mon_an = mysqli_fetch_array($query_pro)) {
                    ?>
                        <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                            <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                                <!-- Product image-->
                                <div style="background-color: #f1f2f3;">
                                    <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                        <img class="card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                    <!-- Product details-->
                                </div>
                                <div class="card-body ">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">
                                            <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                                        <?php
                                        $sql_khuyenmai = "SELECT * FROM chi_tiet_khuyen_mai,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row_mon_an['id_mon_an'] . "'";
                                        $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                        $row_km = mysqli_fetch_array($query_km);
                                        ?>
                                        <h6>
                                            <?php
                                            if (isset($row_km['id_km'])) {
                                                if ($row_km['trang_thai_km'] = 1) {
                                                    if ($row_km['trang_thai_ctkm'] = 1) {
                                            ?>
                                                        <p>
                                                            <?php
                                                            $gia = $row_mon_an['gia'];
                                                            $giakm = $row_km['gia_tri_khuyen_mai'];
                                                            $tong = $gia - $giakm;
                                                            ?>&ensp;
                                                            <span style="font-weight: 700;font-size: 19px;">&#160;<?php echo number_format($tong, 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>&ensp;&ensp;<br>
                                                            <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span></span>
                                                        </p>
                                                    <?php
                                                    } else {
                                                        //trang thai ctkm =2
                                                    ?>
                                                        <p style="padding-bottom: 20px;">
                                                            <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                            </span>
                                                        </p>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <p style="padding-bottom: 20px;">
                                                        <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                        </span>
                                                    </p>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;text-transform: lowercase;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                    <div class="pt-0 border-top-0 bg-transparent">
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
                                                    <button type="submit" id="button_insert" style="width: 100%;" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
                </div>
            </div>

        <?php } else {
        ?>
            <div class="filters-content" style="padding-top: 142px;">
                <div style="height: 500px;">
                    <div class="name_loai">
                        Món ăn không tồn tại
                    </div>
                </div>
            </div>
<?php }
    }
}
?>

<script>
    $(document).ready(function() {
        const btn = document.querySelectorAll("#button_insert")
        // console.log(btn);
        btn.forEach(function(btn, index) {
            // console.log(btn,index);
            btn.addEventListener("click", function(event) {
                var btnItem = event.target
                var product = btnItem.parentElement
                var id_sp = product.querySelector("H4").innerText
                // console.log(id_sp)
                // alert(id_sp);
                $.ajax({
                    url: "pages/main/addcart.php",
                    type: "POST",
                    data: {
                        id_sp: id_sp
                    },
                    success: function(data) {
                        // onload(url);
                        // window.location = "index.php?quanly=loai";
                        $(".thongbao").html(data);
                    }

                })
            })
        })
    });
    $(document).ready(function() {
        const btn = document.querySelectorAll("#button_insert1")
        // console.log(btn);
        btn.forEach(function(btn, index) {
            // console.log(btn,index);
            btn.addEventListener("click", function(event) {
                var btnItem = event.target
                var product = btnItem.parentElement
                var id_sp = product.querySelector("H4").innerText
                // console.log(id_sp)
                // alert(id_sp);
                $.ajax({
                    url: "pages/main/addcart.php",
                    type: "POST",
                    data: {
                        id_sp1: id_sp
                    },
                    success: function(data) {
                        // onload(url);
                        //  window.location = "index.php?quanly=loai";
                        // alert('thành công');
                        // $_SESSION['message_gh'] = 'Thêm vào giỏ hàng thành công';
                        $(".thongbao").html(data);
                    }

                })
            })
        })
    });
</script>