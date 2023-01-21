<link href="css/css-message.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(".jumper").on("click", function(e) {

        e.preventDefault();

        $("body, html").animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 600);
        // window.location = "index.php?quanly=loai";
    });
</script>

<style>
    #dang {
        margin-top: -15px;
    }

    hr {
        margin-bottom: 5px;
        border-width: 1px;
        margin-left: 205px;
        margin-right: 205px;
        padding-bottom: 4px;
        margin-top: 0rem;
    }

    .name_loai {
        font-weight: bold;

        text-transform: uppercase;
        font-size: 21px;
        padding-top: 10px;
    }

    .layout_padding-bottom {
        padding-bottom: 30px;
    }

    .menucon {
        position: fixed;
        top: 0;
        width: 100%;
        padding: 73 px;
        box-sizing: border-box;

        z-index: 1;
    }

    #button_insert1 {
        width: 100%;
        font-size: 18px;
    }

    .food_sections {
        padding-top: 145px;
    }



    .card-img-top2 {
        /* width: 362.1px; */
        height: 230px;
        /* margin-left: -1px; */
        margin-top: -1px;
        width: 100%;

    }

    .fw-bolder {
        font-weight: bold;
        font-size: 19px;
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
    }

    .card-body {
        padding: 11px 0 1px 0;
    }
</style>
<?php
// include("message.php");
include("pages/backtop.php");
?>
<div class="thongbao"></div>

<script>
    function Show() {
        document.getElementById('all1').style.display = "none";
        document.getElementById('changecolor').style.color = "#000000";
    }
</script>
<?php
$sql_lietke_sp = "SELECT * FROM `khuyen_mai`  ORDER BY `khuyen_mai`.`trang_thai_km` ASC";
$query_pro1 = mysqli_query($mysqli, $sql_lietke_sp);
?>
<section class="food_section layout_padding-bottom" id="all1">
    <div class="container" style="max-width: 80%;">
        <div class="filters-content">
            <div class="row grid" style="padding-top: 88px;">
                <?php
                while ($rowkm = mysqli_fetch_array($query_pro1)) {
                    $sqlctkm = "SELECT * FROM `chi_tiet_khuyen_mai`, khuyen_mai WHERE chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km and  chi_tiet_khuyen_mai.id_km='" . $rowkm['id_km'] . "'";
                    $query_ctkm = mysqli_query($mysqli, $sqlctkm);
                    $row_ctkm = mysqli_fetch_array($query_ctkm);
                ?>
                    <div class="col-sm-6 col-lg-3" style="padding:5px 10px 5px 10px ;">
                        <div class="card h-100" style="background-color: #222831; margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                            <!-- Product image-->
                            <div style="background-color: #f1f2f3;">
                                <a href="index.php?quanly=ctkm&idkm=<?php echo $rowkm['id_km'] ?>">

                                    <img class=" card-img-top2" src="admin/includes/khuyenmai/uploads/<?php echo $rowkm['anh_km'] ?>" /></a>
                                <!-- Product details-->
                            </div>

                            <div class="card-body">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                        <?php echo $rowkm['noi_dung_km'] ?></h5>
                                </div>
                                <div class=" pt-0 border-top-0 bg-transparent" style="padding: 10px;">

                                    <div class="text-center" style="padding: 0px 0px 8px 4px;">
                                        <span style="font-size: 17px;">
                                            <i class="fas fa-calendar" style="color: white;font-size:17px;"></i>
                                            <span style="color: white;margin-left: 5px; padding-top: 1px;">
                                                <?php
                                                $datebd = date_create($rowkm['ngay_bd']);
                                                echo date_format($datebd, "d/m/Y");
                                                ?> - <?php
                                                        $datekt = date_create($rowkm['ngay_kt']);
                                                        echo date_format($datekt, "d/m/Y"); ?>
                                            </span>
                                        </span>
                                    </div>
                                    <?php
                                    if ($rowkm['trang_thai_km'] == 2) {
                                    ?>
                                        <a href="index.php?quanly=ctkm&idkm=<?php echo $rowkm['id_km'] ?>"><button id="button_insert1" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto">
                                                Đã hết hạn</button></a>
                                    <?php
                                    } elseif ($rowkm['trang_thai_km'] == 1) {
                                    ?>
                                        <a href="index.php?quanly=ctkm&idkm=<?php echo $rowkm['id_km'] ?>"><button id="button_insert1" name="themgiohang" target="_self" class=" btn_add btn btn-outline-dark mt-auto">
                                                Xem thêm</button></a>
                                    <?php
                                    }
                                    ?>

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