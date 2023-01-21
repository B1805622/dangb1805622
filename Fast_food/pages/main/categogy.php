<link href="css/css-message.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
    #load_more {
        background-color: #e9ecef;
        border: #e9ecef;
        color: black;
        font-weight: 500;
    }

    #dang {
        margin-top: 0px;
    }

    hr {
        margin-bottom: 0px;
        border-width: 1px;

        margin-top: 0rem;
        background-color: #e9ecef;
    }

    .name_loai {
        font-weight: bold;

        /* text-transform: uppercase; */
        font-size: 21px;
        /* padding-top: 10px; */
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
        background-color: #fff;
        z-index: 1;
    }

    #button_insert {
        width: 100%;
        font-size: 18px;
    }


    #button_insert1 {
        width: 100%;
        font-size: 18px;
    }

    .food_sections {
        padding-top: 145px;
    }



    .card-img-top2 {
        width: 100%;
    }

    .fw-bolder {
        font-weight: bold;
        font-size: 20 px;
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
        padding: 10px;
    }
</style>
<?php
// include("message.php");
// include("pages/backtop.php");
include("pages/cart.php");
?>
<div class="thongbao"></div>
<?php
$sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an ASC";
$query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);
?>
<div class="menucon">
    <section style="padding-top:72px ;" class="food_sections">
    </section>
    <hr>
    <section style="  max-width: 100%;">
        <div class="container" style="padding-top: 5px;padding-bottom: 5px;max-width: 80%;">
            <nav class="navbar navbar-expand-lg navbar-light ">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group" style="width: 367px;padding-right: 5px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01" style=" font-size: 19px;font-weight: 600;">Loại món ăn</label>
                            </div>
                            <select class="custom-select" id="idloai" style=" font-size: 19px;">
                                <option value="0">Tất cả</option>
                                <option value="2501">Ưu đãi</option>
                                <?php
                                $sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an";
                                $query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);
                                while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                                ?>
                                    <option class="timtenloai" value="<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>"><?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group" style="width: 256px;padding-right: 5px;font-size: 19px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01" style="  font-size: 19px;font-weight: 600;">GIÁ</label>
                            </div>
                            <select class="custom-select" id="idgia" style=" font-size: 19px;">
                                <option value="0" class="timtengia gia1" multiple>
                                </option>
                                <option value="1" class="timtengia gia1">Dưới 20.000đ</option>
                                <option value="2" class="timtengia gia1">20.000đ - 100.000đ</option>
                                <option value="3" class="timtengia gia1">Trên 100.000đ</option>
                            </select>
                        </div>
                        <input class="form-control mr-sm-2 rounded" id="searchinput" type="search" style=" font-size: 19px;" placeholder="Tìm kiếm món ăn.." aria-label="Search">
                        <span class="input-group-text border-0" id="search-addon" style=" padding: 13px;">
                          <i class="fas fa-search"></i>
                        </span>
                    </form>
                </div>
            </nav>

    </section>
</div>
<script>
    $(document).ready(function() {
        const btn = document.querySelectorAll(".timtenloai")
        document.getElementById('idloai').addEventListener('change', function() {
            id_loai = $("#idloai").val();
            // alert(id_loai);
            if (id_loai == 0) {
                window.location = "index.php?quanly=loai";
            }
            if (id_loai == 2501) {
                km = id_loai;
                km = 2501;
                $.ajax({
                    url: "pages/main/search.php",
                    type: "POST",
                    data: {
                        km: km
                    },
                    success: function(data) {
                        $(".hienloai").html(data);
                        $("#all1").css("display", "none");
                    }

                })
            }
            if (id_loai != 0 & id_loai != 2501) {
                $.ajax({
                    url: "pages/main/search.php",
                    type: "POST",
                    data: {
                        id_loai: id_loai
                    },
                    success: function(data) {
                        $(".hienloai").html(data);
                        $("#all1").css("display", "none");
                    }

                })

            }

            // }
        });
    });
</script>
<script>
    $(document).ready(function() {
        const btn = document.querySelectorAll(".timtengia")
        document.getElementById('idgia').addEventListener('change', function() {
            id_gia = $("#idgia").val();

            // alert(input);
            $.ajax({
                url: "pages/main/search.php",
                type: "POST",
                data: {
                    id_gia: id_gia
                },
                success: function(data) {
                    $(".hienloai").html(data);
                    $("#all1").css("display", "none");
                }
            })
        })
    });
</script>
<script>
    $(document).ready(function() {
        $("#searchinput").keyup(function() {
            var input = $(this).val();
            // alert(input);
            if (input != "") {
                $.ajax({
                    url: "pages/main/search.php",
                    type: "POST",
                    data: {
                        input: input
                    },
                    success: function(data) {
                        $(".hienloai").html(data);
                        $("#all1").css("display", "none");
                    }
                })
            } else {
                location.reload(true);
            }
        })
    })
</script>
<script>
    $(document).ready(function() {
        const btn_ud = document.querySelectorAll(".timuudai")
        btn_ud.forEach(function(btn_ud, index) {
            console.log(btn_ud, index);
            btn_ud.addEventListener("click", function(event) {
                var btnItem = event.target;
                var product = btnItem.parentElement
                var km = product.querySelector("a").innerText
                km = 1;
                $.ajax({
                    url: "pages/main/search.php",
                    type: "POST",
                    data: {
                        km: km
                    },
                    success: function(data) {
                        $(".hienloai").html(data);
                    }

                })

            })
        })
    });
</script>

<script>
    function Show() {
        document.getElementById('all1').style.display = "none";
        document.getElementById('changecolor').style.color = "#000000";
    }
</script>
<?php

$sql_lietke_sp = "SELECT * FROM mon_an, gia, loai_mon_an where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_loai_mon_an=loai_mon_an.id_loai_mon_an and mon_an.trang_thai=1   ORDER BY mon_an.id_mon_an asc limit 12";
$query_pro1 = mysqli_query($mysqli, $sql_lietke_sp);
?>
<section class="food_section layout_padding-bottom" style="padding-bottom: 40px;">
    <div class="container" style="max-width: 80%;">
        <div class="hienloai">
        </div>
        <div class="filters-content" id="all1" style="padding-top: 142px;">
            <div class="row grid" id="more">
                <?php
                while ($row_mon_an = mysqli_fetch_assoc($query_pro1)) {
                    $id = $row_mon_an['id_mon_an'];
                ?>
                    <div class="col-sm-6 col-lg-3 post" style="padding:5px 10px 5px 10px ;" id="post_<?php echo $row_mon_an['id_mon_an']; ?>">
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
                                            $sqlctkm = "SELECT * FROM `chi_tiet_khuyen_mai` WHERE id_km='" . $row_km['id_km'] . "'";
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
                                                    <span style="font-weight: 700;font-size: 19px;">&#160;&#160;<?php echo number_format($tong, 0, ',', '.'); ?>&#160;<span style="text-decoration:underline;">đ</span>
                                                    </span>&ensp;&ensp;<br>
                                                    <span style="text-decoration: line-through;font-size:18px;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.'); ?>&#160;<span style="text-decoration:underline;">đ</span></span>
                                                </p>
                                            <?php

                                            } else {
                                            ?>
                                                <p style="padding-bottom: 20px;">
                                                    <span style="font-weight: 700;font-size: 19px;;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;">đ</span>
                                                    </span>
                                                </p>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <p style="padding-bottom: 20px;">
                                                <span style="font-weight: 700;font-size: 19px;;"><?php echo number_format($row_mon_an['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;">đ</span>
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
                        <span style="padding: 30px;font-weight: 600;">Xem thêm</span>
                    </button>
                </div>
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
                        // window.location = "index.php?quanly=loai";

                        $(".thongbao").html(data);
                        $(".loadcount").load;
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

                        // window.location = "index.php?quanly=loai";
                        $(".thongbao").html(data);
                        $(".loadcount").load;
                    }

                })
            })
        })
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#load_more', function(event) {
            event.preventDefault();
            var id = $('#load_more').data('id');
            $.ajax({
                url: 'pages/main/getData.php',
                type: 'post',
                data: {
                    id: id
                },
                // beforeSend: function() {
                //     $(".load-more").text("Loading...");
                // },
                success: function(response) {
                    $('#remove-row').remove();
                    $('#more').append(response);
                    // setTimeout(function() {
                    //     $(".post:last").after(response).show().fadeIn("slow");
                    //     var rowno = row + 3;
                    //     if (rowno > allcount) {
                    //         $('.load-more').text("Hide");
                    //         $('.load-more').css("background", "darkorchid");
                    //     } else {
                    //         $(".load-more").text("Load more");
                    //     }
                    // }, 2000);
                }
            });

        });
    });
</script>