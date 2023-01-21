<?php


if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = '1';
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 8) - 8;
}

$sql_mon_an1 = "SELECT * FROM loai_mon_an";
$query_mon_an1 = mysqli_query($mysqli, $sql_mon_an1);
?>

<?php
include("message.php");
include("pages/backtop.php");
?>
<link href="css/css-message.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="assets/css/docs.theme.min.css"> -->
<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">
<script src="assets/vendors/jquery.min.js"></script>
<script src="assets/owlcarousel/owl.carousel.js"></script>

<style>
    .id_danhmuc {
        padding-top: 10px;
        font-size: 22px;
        font-weight: bold;
    }

    hr {
        margin-top: 5px;
        margin-bottom: 5px;
        border-width: 3px;
    }

    .card-img-top1 {
        /* width: 271.2px; */
        /* height: 220px; */
        margin-left: -1px;
        margin-top: -1px;
        margin-right: -1px;
        border-radius: 28px 0 0 45px;
        height: 100%;
    }

    .card-img-top2 {
        width: 273.1px;
        height: 220px;

        margin-top: -1px;
        border-radius: 31px 0 0 29.4px;
    }

    .fw-bolder {
        font-weight: bold;
        font-size: 20px;
        color: white;

    }

    .text-center {
        color: #f1f2f3;
    }

    .btn_add {
        border: 1px solid;
        border-radius: 6px;
        background: white;
        color: #222831;
        font-weight: 600;
        font-size: 18px;
    }

    .card-img-top21 {
        /* width: 267.1px; */
        /* height: 220px; */
        margin-top: -1px;
        height: 100% !important;

    }

    #button_insert1 {
        width: 100%;
    }

    .card-body {
        padding-bottom: 1rem;
    }
</style>
<div class="thongbao"></div>
<section class="food_section layout_padding-bottom" style="padding-bottom: 20px">
    <div class="container" style="max-width: 80%;">
        <div class="filters-content">
            <div class="id_danhmuc">
                <p style="font-size: 23px;">DANH MỤC MÓN ĂN
                </p>
                <hr style="margin-top: 5px;margin-bottom: 5px;border-width: 3px;">
            </div>

            <div class="row grid">
                <?php
                while ($row_mon_an1 = mysqli_fetch_array($query_mon_an1)) {
                ?>
                    <div class="col-sm-6 col-lg-3" style="padding:7px ;">
                        <div class="card h-100" style="background-color: #222831;border-radius: 30px 0px;">
                            <img class="card-img-top1" src="admin/includes/quanlyloai/uploads/<?php echo $row_mon_an1['anh_loai'] ?>" alt="..." />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder" style="font-size: 17px"> <?php echo $row_mon_an1['ten_loai_mon_an'] ?></h5>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
</section>
<?php
$sql_lietke_sp = "SELECT * FROM mon_an, gia, chi_tiet_khuyen_mai where chi_tiet_khuyen_mai.id_mon_an= mon_an.id_mon_an and mon_an.id_mon_an=gia.id_mon_an  and mon_an.soluong >0  ORDER BY mon_an.id_mon_an  limit 4";
$query_pro1 = mysqli_query($mysqli, $sql_lietke_sp);
$num = mysqli_num_rows($query_pro1);
if ($num > 0) {
?>

    <section class="food_section layout_padding-bottom" style="padding-bottom: 20px">
        <div class="container" style="max-width: 80%;">
            <div class="filters-content">
                <div class="id_danhmuc">
                    <p style="font-size: 23px">ƯU ĐÃI ĐẶC BIỆT
                    </p>
                    <hr style="margin-top: 5px;margin-bottom: 5px;border-width: 3px;">
                </div>
                <div class="owl-carousel">
                    <div class="row grid">
                        <?php
                        while ($row_mon_an = mysqli_fetch_array($query_pro1)) {
                        ?>
                            <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                                <div class="card h-100" style="background-color: #222831; margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                                    <!-- Product image-->
                                    <div style="background-color: #f1f2f3;">
                                        <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                            <img class="card-img-top21" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
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
                                                    if ($row_km['trang_thai_km'] = 1) {

                                                ?>
                                                        <p>
                                                            <?php
                                                            $gia = $row_mon_an['gia'];
                                                            $giakm = $row_km['gia_tri_khuyen_mai'];
                                                            $tong = $gia - $giakm;
                                                            ?>&ensp;
                                                            <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($tong, 0, ',', '.') . 'đ'; ?></span>&ensp;&ensp;<br>
                                                            <span style="text-decoration: line-through;font-size: 18px"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') . 'đ'; ?></span>
                                                        </p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p style="padding-bottom: 20px;">
                                                            <span style="font-weight: 700;font-size: 19px%;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') . 'đ'; ?>
                                                            </span>
                                                        </p>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <p style="padding-bottom: 20px;">
                                                        <span style="font-weight: 700;font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') . 'đ'; ?>
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
                                                        <button type="submit" id="button_insert" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
            </div>
        </div>
    </section>
<?php
} else {
} ?>
<?php
$sql_mon_an = "SELECT DISTINCT mon_an.id_mon_an,mon_an.ten_mon_an,mon_an.anh_mon_an, mon_an.soluong,mon_an.trang_thai,mon_an.mo_ta_mon,gia.gia,binh_luan_danh_gia.id_mon_an FROM mon_an, gia,binh_luan_danh_gia where binh_luan_danh_gia.id_mon_an=mon_an.id_mon_an and mon_an.id_mon_an=gia.id_mon_an and binh_luan_danh_gia.diem_dg>=4 and mon_an.soluong>0 ORDER BY RAND() LIMIT 4";;
$query_mon_an = mysqli_query($mysqli, $sql_mon_an);
?>
<section class="food_section layout_padding-bottom" style="padding-bottom: 40px">
    <div class="container" style="max-width: 80%;">
        <div class=" filters-content">
            <div class="id_danhmuc">
                <p style="font-size: 23px">MÓN ĂN NỔI BẬT
                </p>
                <hr style="margin-top: 5px;margin-bottom: 5px;border-width: 3px;">
            </div>
            <div class="owl-carousel">
                <div class="row grid">
                    <?php
                    while ($row_mon_an = mysqli_fetch_array($query_mon_an)) {
                    ?>
                        <div class="col-sm-6 col-lg-3" style="padding:7px ;">
                            <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;">
                                <!-- Product image-->

                                <div style="background-color: #f1f2f3;">
                                    <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                        <img class=" card-img-top21" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                    <!-- Product details-->
                                </div>
                                <div class="card-body ">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">
                                            <?php echo $row_mon_an['ten_mon_an'] ?></h5>
                                        <!-- Product price-->
                                        <span style="font-size: 19px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.') . 'đ'; ?></span>
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
                                                    <button type="submit" id="button_insert" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto" title="Thêm vào giỏ hàng">
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
        </div>
    </div>
</section>


<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        margin: 30,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
        }
    })
</script>
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
                        // window.location = "index.php?quanly=loai";
                        $(".thongbao").html(data);

                    }

                })
            })
        })
    });
</script>