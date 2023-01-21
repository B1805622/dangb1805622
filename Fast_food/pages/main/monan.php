<?php

namespace Algenza\Cosinesimilarity;

require('Carbon/autoload.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();


?>
<!-- <link href="css/css-message.css" rel="stylesheet" /> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    /* body {
height: 100vh;
display: flex;
flex-direction: column;
font-family: "Helvetica Neue";
background-color: #f4f4f5;
} */

    /* body>div {
margin: auto;
} */

    /* ======= Toast message ======== */
    #toast1 {
        position: fixed;
        top: 32px;
        right: 32px;
        z-index: 999999;

    }

    .toast1 {
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 2px;
        padding: 11px 0;
        min-width: 410px;
        max-width: 454px;
        border-left: 4px solid;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.08);
        /* transition: slideInLeft ease .3s; */
        animation: slideInLeft ease .3s;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(calc(100% + 32px));
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
        }
    }

    .toast1--success {
        border-color: #47d864;
    }

    .toast1--success .toast1__icon {
        color: #47d864;
    }

    .toast1+.toast1 {
        margin-top: 24px;
    }

    .toast1__icon {
        font-size: 24px;
    }

    .toast1__icon,
    close .toast1__close {
        padding: 0 16px;
    }

    .toast1__body1 {
        flex-grow: 1;
        padding-top: 16px;
    }

    .toast1__title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .toast1__msg {
        font-size: 14px;
        color: #888;
        margin-top: 6px;
        line-height: 1.5;
    }

    .toast1__close {
        font-size: 20px;
        color: rgba(0, 0, 0, 0.3);
        cursor: pointer;
        padding-right: 5px;
    }

    .crossbar_grid {
        width: 1200px;
        display: flex;
        max-width: 100%;
        margin: 0 auto;
        justify-content: space-between;

    }

    .crossbar_list {
        width: 100%;
        display: flex;

        margin: 0;
        padding-left: 5px;

    }

    .crossbar_item {
        text-decoration: none;
        text-align: center;
        color: #17252a;
    }

    .crossbar {
        padding-top: 20px;

    }

    .crossbar_list li {
        list-style: none;
        width: calc(100% / 5);
        height: 100%;
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
        font-weight: bold;
    }


    .food_section .crossbar_list li.active {
        background-color: #222831;
        color: #ffffff;
        padding: 7px 25px;
        cursor: pointer;
        border-radius: 25px;

    }

    .services {
        margin-top: 74px;
    }

    .detail_product {
        /* width: 1100px; */
        margin: 0 auto;
        padding-top: 30px;
    }

    .detail_title h5 {
        margin: 0;
        padding: 10px 0 13px 0px;
        color: #3f2529;
    }

    .detail_content {
        display: flex;
        justify-content: space-between;
        padding-top: 5px;
    }

    .detail_image {
        margin: 0px 30px 0px 0px;
        width: 70%;
    }

    .detail_image img {
        width: 100%;
    }

    .detail_description {
        margin: 16px 0px 20px 10px;
        width: 100%;
    }


    .detail_name {
        padding: 3px 22px;
        font-size: 2rem;

    }

    .fade-in {
        animation: fadeIn 0.3s;
        opacity: 1;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }


    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 3;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close1 {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close1:hover,
    .close1:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

    .rig {
        width: 60%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 5px;
        height: 210px;
    }

    .btn-addcart {
        padding-left: 35px;
        padding-top: 24px;

    }

    .btn-theme {
        background: #222831;
        color: white;
        width: 400px;
        height: 45px;
        border-radius: 30px;
        border: none;
    }

    .thea {
        color: #78838c;
    }

    .thea:hover {
        text-decoration: underline;
    }

    .cat_title {
        color: #78838c;
    }

    .titletieude {
        font-weight: bold;
        text-transform: uppercase;
        font-size: 21px;

    }

    /* .btngui {
        width: 100px;
        position: relative;
        left: 1020px;
        top: -49px;
    } */

    #test-scroll {
        border: 2px solid #3aafa9;
        width: 90%;
        height: 90px;
        padding: 10px;
        position: relative;
        left: 22px;
    }

    .btn-theme {
        width: 90%;
    }

    .btn_gui_cauhoi {
        padding: 5px;
        border-radius: 3px;
        color: white;
        background-color: #222831;
        border: none;
        font-weight: 600;
    }

    #subject-gui-box {
        padding: 5px 6px 5px 6px;
        width: 100%;
        border-radius: 5px;
    }

    .flex-shrink-1 {
        padding-left: 10px;
    }

    .cmtne {
        padding-top: 8px;
    }

    .repne {
        width: 1110px;
        padding-left: 75px;
    }

    .formreply {
        border-radius: 6px;
        height: 40px;
        padding-left: 5px;
    }

    .butnrep {
        background-color: #222831;
        padding: 8px;
        border-radius: 7px;
        border: 1px;
        color: white;
    }

    .tablerep {
        padding-left: 75px;
    }

    .nameqtr {
        color: white;
        background-color: #3399ff;
        padding: 4px;
        border-radius: 5px
    }

    .detail_image {
        width: 800px;

    }

    .btn-addcart {
        padding-top: 12px;
    }

    #services {
        padding-bottom: 15px;
    }
</style>
<?php
include("message.php");
?>

<section id="services" class="services section-bg">
    <div class="container-fluid">
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
        $idmon = $_GET['IdMon'];
        $sql_detail = "SELECT DISTINCT *FROM mon_an AS m, loai_mon_an AS lma, gia AS g
              WHERE (m.id_loai_mon_an = lma.id_loai_mon_an) AND (m.id_mon_an = g.id_mon_an)  AND m.id_mon_an ='$_GET[IdMon]' LIMIT 1";
        $query_detail = mysqli_query($mysqli, $sql_detail);
        $sql_ca = "SELECT * FROM mon_an,loai_mon_an WHERE mon_an.id_loai_mon_an = loai_mon_an.id_loai_mon_an AND mon_an.id_mon_an ='$_GET[IdMon]' LIMIT 1 ";
        $query_ca = mysqli_query($mysqli, $sql_ca);
        $row_title = mysqli_fetch_array($query_ca);
        while ($row_detail = mysqli_fetch_array($query_detail)) {
        ?>
            <div class="detail_product" style="max-width: 80%;">
                <p class="cat_title"><a class="thea" href="index.php?quanly=loai">Thực đơn</a> > <?php echo $row_detail['ten_mon_an'] ?></p>
                <div class="detail_content">
                    <div class="detail_image" style="width: 62%;">
                        <img src="admin/includes/quanlymonan/uploads/<?php echo $row_detail['anh_mon_an'] ?>" style="margin-left: 5px;height: 350px;" id="myImg" />
                        <div id="myModal" class="modal">
                            <span class="close1">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                        <script>
                            // Get the modal
                            var modal = document.getElementById("myModal");

                            // Get the image and insert it inside the modal - use its "alt" text as a caption
                            var img = document.getElementById("myImg");
                            var modalImg = document.getElementById("img01");
                            var captionText = document.getElementById("caption");
                            img.onclick = function() {
                                modal.style.display = "block";
                                modalImg.src = this.src;
                                captionText.innerHTML = this.alt;
                            }

                            // Get the <span> element that closes the modal
                            var span = document.getElementsByClassName("close1")[0];

                            // When the user clicks on <span> (x), close the modal
                            span.onclick = function() {
                                modal.style.display = "none";
                            }
                        </script>

                    </div>

                    <div class="rig" method="POST" style="height:350px ;">
                        <div class="detail_description">
                            <h3 class="detail_name"><?php echo $row_detail['ten_mon_an'] ?></h3>
                            <span style="color:#78838c;padding-left:22px;">Thành phần dinh dưỡng:</span>
                            <div id="test-scroll" style=" overflow:auto;">
                                <?php
                                $sql_thanhphan = "SELECT * FROM mon_an,thanh_phan,thanh_phan_mon_an WHERE mon_an.id_mon_an=thanh_phan_mon_an.id_mon_an and thanh_phan_mon_an.id_tp=thanh_phan.id_tp and mon_an.id_mon_an ='" . $row_detail['id_mon_an'] . "'";
                                $querytp = mysqli_query($mysqli, $sql_thanhphan);
                                while ($rowtp = mysqli_fetch_array($querytp)) {
                                ?>
                                    <span style="color:#78838c;"><?php echo $rowtp['ten_tp'] ?>:<?php echo $rowtp['gia_tri'] ?><br></span>
                                <?php
                                }
                                ?>
                            </div>

                            <span style="color:#78838c;padding-left: 22px;padding-top: 10px;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php echo $row_detail['mo_ta_mon'] ?></span>


                            <?php

                            $sql_gia_km = "SELECT *FROM mon_an, gia,khuyen_mai, chi_tiet_khuyen_mai WHERE khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an=gia.id_mon_an AND mon_an.id_mon_an ='$_GET[IdMon]' LIMIT 1 ";
                            $query_gia_km = mysqli_query($mysqli, $sql_gia_km);
                            // $num = mysqli_num_rows($query_gia_km);
                            $row_gia_km = mysqli_fetch_array($query_gia_km);
                            if (isset($row_gia_km['id_km'])) {
                                if ($row_gia_km['trang_thai_km'] = 1) {
                                    if ($row_gia_km['trang_thai_ctkm'] = 1) {
                            ?>
                                        <div style="padding: 3px 22px;font-size: 20px;font-weight: 600;">
                                            <p style="margin-bottom: 0rem !important;"><?php
                                                                                        $gia = $row_gia_km['gia'];
                                                                                        $km = $row_gia_km['gia_tri_khuyen_mai'];
                                                                                        $tong = $gia - $km;
                                                                                        echo number_format($tong, 0, ',', '.') . 'đ'; ?>&ensp;
                                                <span style=" text-decoration: line-through;"><?php echo number_format($row_detail['gia'], 0, ',', '.') . 'đ'; ?></span>
                                            </p>
                                        </div>
                                        <?php
                                        if ($row_detail['soluong'] > 0) {
                                        ?>
                                            <form class="btn-addcart" action="pages/main/addcart.php?IdMon=<?php echo $row_detail['id_mon_an'] ?>" method="POST">
                                                <input class="btn-theme" type="submit" name="themgiohang1" value="Thêm vào giỏ hàng">
                                            </form>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="btn-addcart">
                                                <input class="btn-theme" type="submit" value="Món ăn đã hết">
                                            </div>
                                        <?php
                                        }

                                        ?>
                                    <?php

                                    } else {
                                    ?> <div style="padding: 3px 22px;font-size: 20px;font-weight: 600;">
                                            <p style="margin-bottom: 0rem !important;"><?php echo number_format($row_detail['gia'], 0, ',', '.') . 'đ'; ?></p>
                                        </div>
                                        <?php
                                        if ($row_detail['soluong'] > 0) {
                                        ?>
                                            <form class="btn-addcart" action="pages/main/addcart.php?IdMon=<?php echo $row_detail['id_mon_an'] ?>" method="POST">
                                                <input class="btn-theme" type="submit" name="themgiohang1" value="Thêm vào giỏ hàng">
                                            </form>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="btn-addcart">
                                                <input class="btn-theme" type="submit" value="Món ăn đã hết">
                                            </div>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <p style="padding: 3px 22px;font-size: 20px;font-weight: 600;"><?php echo number_format($row_detail['gia'], 0, ',', '.') . 'đ'; ?></p>
                                    <?php
                                    if ($row_detail['soluong'] > 0) {
                                    ?>
                                        <form class=" btn-addcart" action="pages/main/addcart.php?IdMon=<?php echo $row_detail['id_mon_an'] ?>" method="POST">
                                            <input class="btn-theme" type="submit" name="themgiohang1" value="Thêm vào giỏ hàng">
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="btn-addcart">
                                            <input class="btn-theme" type="submit" value="Món ăn đã hết">
                                        </div>
                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <p style="padding: 3px 22px;font-size: 20px;font-weight: 600;"><?php echo number_format($row_detail['gia'], 0, ',', '.') . 'đ'; ?></p>
                                <?php
                                if ($row_detail['soluong'] > 0) {
                                ?>
                                    <form class=" btn-addcart" action="pages/main/addcart.php?IdMon=<?php echo $row_detail['id_mon_an'] ?>" method="POST">
                                        <input class="btn-theme" type="submit" name="themgiohang1" value="Thêm vào giỏ hàng">
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <div class="btn-addcart">
                                        <input class="btn-theme" type="submit" value="Món ăn đã hết">
                                    </div>
                            <?php
                                }
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
</section>
<br>
<div class="thongbao"></div>
<div>
    <?php
    include("recommend.php");
    $sql = "SELECT *FROM binh_luan_danh_gia,mon_an where binh_luan_danh_gia.id_mon_an=mon_an.id_mon_an";
    $reusult = mysqli_query($mysqli, $sql);
    $matrix = array();

    while ($movie = mysqli_fetch_array($reusult)) {
        $sql_user = "SELECT ten_kh FROM khach_hang where id_kh='" . $movie['id_kh'] . "'";
        $reusult_user = mysqli_query($mysqli, $sql_user);
        $username = mysqli_fetch_array($reusult_user);
        $matrix[$username['ten_kh']][$movie['ten_mon_an']] = $movie['diem_dg'];
    }

    if (!isset($_SESSION['id_kh'])) {
    } else {
        $sql_user = "SELECT * FROM khach_hang where id_kh='" . $_SESSION['id_kh'] . "'";
        $reusult_user = mysqli_query($mysqli, $sql_user);
        $username = mysqli_fetch_array($reusult_user);
        $recommendation = array();
        $recommendation = getRecommendation($matrix, $username['ten_kh']);

        //  print_r($recommendation);

        if ($recommendation == 0) {
    ?>
            <div class="container" style="max-width: 80%;">
                <div class="row">
                    <div class="col-sm-12 title_bx">
                        <h3 class="titletieude"> Món ăn có thể bạn thích </h3>
                    </div>
                </div>
            </div>
            <section class="food_section" id="all1">
                <div class="container" style="max-width: 80%;">
                    <div class=" filters-content">
                        <div class="row grid image-slider">
                            <?php
                            $sql_mon_an = "SELECT DISTINCT mon_an.id_mon_an,mon_an.ten_mon_an,mon_an.anh_mon_an, mon_an.soluong,mon_an.trang_thai,mon_an.mo_ta_mon,gia.gia,binh_luan_danh_gia.id_mon_an FROM mon_an, gia,binh_luan_danh_gia where binh_luan_danh_gia.id_mon_an=mon_an.id_mon_an and mon_an.id_mon_an=gia.id_mon_an and binh_luan_danh_gia.diem_dg>=4 and mon_an.soluong>0 and mon_an.id_mon_an !='$_GET[IdMon]' ORDER BY RAND() LIMIT 5";;
                            $query_mon_an = mysqli_query($mysqli, $sql_mon_an);
                            while ($row_mon_an = mysqli_fetch_array($query_mon_an)) {
                            ?>
                                <div class="col-sm-6 col-lg-3 " style="padding: 8px 0px 0px 0px;">
                                    <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                                        <div style="background-color: #f1f2f3;">
                                            <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                                <img class=" card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" /></a>
                                        </div>
                                        <div class="card-body ">
                                            <div class="text-center">
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
                        </div>
                    </div>
                </div>
            </section>
        <?php
        } else {
        ?>
            <div class="container" style="max-width: 80%;">
                <div class="row">
                    <div class="col-sm-12 title_bx">
                        <h3 class="titletieude">Gợi ý dành cho bạn </h3>
                    </div>
                </div>
            </div>
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
            <section class="food_section" id="all1">
                <div class="container" style="max-width: 80%;">
                    <div class="filters-content">
                        <div class="row grid image-slider">
                            <?php


                            $SQL_TEN = "SELECT ten_mon_an FROM mon_an where id_mon_an='" . $_GET['IdMon'] . "'";
                            $sql_queryrten = mysqli_query($mysqli, $SQL_TEN);
                            $TEN = mysqli_fetch_array($sql_queryrten);
                            $ten = $TEN['ten_mon_an'];
                            if (isset($recommendation)) {
                                foreach ($recommendation as $movie => $rating) {
                            ?>
                                    <?php
                                    $sql_detail = "SELECT DISTINCT *FROM mon_an AS m, loai_mon_an AS lma, gia AS g
              WHERE (m.id_loai_mon_an = lma.id_loai_mon_an) AND (m.id_mon_an = g.id_mon_an) AND m.ten_mon_an ='" . $movie . "' ORDER BY RAND() LIMIT 4";
                                    $query_detail = mysqli_query($mysqli, $sql_detail);
                                    while ($row1 = mysqli_fetch_array($query_detail)) {
                                        if ($_GET['IdMon'] == $row1['id_mon_an']) {
                                            unset($ten);
                                        } else {
                                    ?>
                                            <div class="col-sm-6 col-lg-3 " style="padding: 8px 0px 0px 0px;">
                                                <div class="card h-100" style="background-color: #222831;margin:-1px;border: none;box-shadow: 1px 2px 7px #888888;">
                                                    <!-- Product image-->
                                                    <div style="background-color: #f1f2f3;">
                                                        <a href="index.php?quanly=monan&IdMon=<?php echo $row1['id_mon_an'] ?>">
                                                            <img class=" card-img-top2" src="admin/includes/quanlymonan/uploads/<?php echo $row1['anh_mon_an'] ?>" /></a>
                                                        <!-- Product details-->
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center">
                                                            <!-- Product name-->
                                                            <h5 class="fw-bolder">
                                                                <?php echo $row1['ten_mon_an'] ?></h5>
                                                            <!-- Product price-->

                                                            <?php
                                                            $sql_khuyenmai = "SELECT * FROM mon_an,chi_tiet_khuyen_mai,gia,khuyen_mai where khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an='" . $row1['id_mon_an'] . "'";
                                                            $query_km = mysqli_query($mysqli, $sql_khuyenmai);
                                                            $row_km = mysqli_fetch_array($query_km);
                                                            ?>
                                                            <h6>
                                                                <?php
                                                                if (isset($row_km['id_km'])) {
                                                                    if ($row_km['trang_thai_km'] == 1) {

                                                                ?>
                                                                        <p>
                                                                            <?php
                                                                            $gia = $row1['gia'];
                                                                            $giakm = $row_km['gia_tri_khuyen_mai'];
                                                                            $tong = $gia - $giakm;
                                                                            ?>&ensp;
                                                                            <span style="font-weight: 700;font-size: 18px;">&#160;&#160;<?php echo number_format($tong, 0, ',', '.'); ?>&#160;<span style="text-decoration:underline;">đ</span>
                                                                            </span>&ensp;&ensp;<br>
                                                                            <span style="text-decoration: line-through;"><?php echo number_format($row1['gia'], 0, ',', '.'); ?>&#160;<span style="text-decoration:underline;">đ</span></span>
                                                                        </p>
                                                                    <?php

                                                                    } else {
                                                                    ?>
                                                                        <p style="padding-bottom: 20px;">
                                                                            <span style="font-weight: 700;font-size: 18px;"><?php echo number_format($row1['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;">đ</span>
                                                                            </span>
                                                                        </p>
                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <p style="padding-bottom: 20px;">
                                                                        <span style="font-weight: 700;font-size: 18px;"><?php echo number_format($row1['gia'], 0, ',', '.')  ?>&#160;<span style="text-decoration:underline;">đ</span>
                                                                        </span>
                                                                    </p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </h6>
                                                        </div>
                                                        <div class="card-footer pt-0 border-top-0 bg-transparent">
                                                            <div class="text-center">
                                                                <h4 style="color:#222831;font-size: 1px;"><?php echo $row1['id_mon_an'] ?></h4>
                                                                <?php
                                                                if (isset($row_km['id_km'])) {
                                                                ?>
                                                                    <?php
                                                                    if ($row1['soluong'] > 0) {
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
                                                                    if ($row1['soluong'] > 0) {
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
                                    }
                                }
                            } else {
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <?php
                            // }
                            ?>
                        </div>
                    </div>
                </div>
            </section>

    <?php }
    } ?>


</div>
<br>
<div class="container" style="max-width: 80%;">
    <div class="row">
        <div class="col-sm-12 title_bx">
            <h3 class="titletieude"> Đánh giá </h3>
        </div>
    </div>

</div>

<div class="container" style="max-width: 80%;" style="padding-bottom: 20px;">

    <form action="pages/main/add_bl.php?IdMon=<?php echo $_GET['IdMon'] ?>" method="POST">
        <div>
            <input class="star star-5" id="star-5" type="radio" name="star" value="5" required />
            <label class="star star-5" for="star-5"></label>
            <input class="star star-4" id="star-4" type="radio" name="star" value="4" required />
            <label class="star star-4" for="star-4"></label>
            <input class="star star-3" id="star-3" type="radio" name="star" value="3" required />
            <label class="star star-3" for="star-3"></label>
            <input class="star star-2" id="star-2" type="radio" name="star" value="2" required />
            <label class="star star-2" for="star-2"></label>
            <input class="star star-1" id="star-1" type="radio" name="star" value="1" required />
            <label class="star star-1" for="star-1"></label>
        </div>
        <textarea id="subject-gui-box" name="subject" placeholder="Mời bạn bình luận về món ăn..." rows="5" spellcheck="false"></textarea>
        <div class="btngui">
            <button type="submit" id="button_insert" class="btn_gui_cauhoi" name="addbinhluan">Đánh giá</button>
        </div>
    </form>

    <?php
    $sql_bl = "SELECT * FROM binh_luan_danh_gia AS bldg, mon_an AS m, khach_hang AS kh where bldg.id_mon_an=m.id_mon_an AND kh.id_kh=bldg.id_kh and bldg.baocao!=2 AND m.id_mon_an ='$_GET[IdMon]' ORDER BY `bldg`.`thoi_gian` DESC limit 4";
    $query_bl = mysqli_query($mysqli, $sql_bl);
    ?>
    <div style="display:inline-block !important ">
        <?php
        while ($row_bl = mysqli_fetch_array($query_bl)) {
            $sql_timbl = "SELECT * FROM binh_luan_danh_gia AS bldg, tra_loi_binh_luan AS rep
                  WHERE rep.id_binh_luan=bldg.id_binh_luan and bldg.id_binh_luan= '" . $row_bl['id_binh_luan'] . "'  ";
            $query_timbl = mysqli_query($mysqli, $sql_timbl);
            $rowtim = mysqli_fetch_array($query_timbl);
        ?>
            <table>
                <tr>
                    <th rowspan="3" style="padding: 5px;">
                        <img class="rounded-circle" src="https://www.daykemtainha.vn/public/files/avatar_crop/default-avatar.png" alt="avatar" width="65" height="65" />
                    </th>
                    <th style="padding-top: 15px;"> <?php echo $row_bl['ten_kh'] ?> <span style="font-size: 13px;font-weight: 100;">
                            <?php
                            $first_date = strtotime($now);
                            $second_date = strtotime($row_bl['thoi_gian']);
                            $datediff = abs($first_date - $second_date);
                            $dt = floor($datediff / (60 * 60));
                            if ($dt >= 60) {
                                $dt1 = floor($dt / (24));
                                echo $dt1;
                                echo " ngày trước";
                            } elseif ($dt < 60) {
                                echo  $dt;
                                echo " giờ trước";
                            }

                            ?>
                            <?php

                            // $ngayadd = date_create($row_bl['thoi_gian']);
                            // echo date_format($ngayadd, "H:i:s d-m-Y");
                            ?></span></th>
                </tr>
                <tr>
                    <td> <?php echo $row_bl['diem_dg'] ?>/5<i class="fa fa-star" style="color:#ffbe33"></i>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $row_bl['noi_dung'] ?></td>
                    <td>
                        <?php
                        if (isset($_SESSION['id_kh'])) {
                        ?>
                            <form action="pages/main/add_bl.php?IdMon=<?php echo $_GET['IdMon'] ?>&IdBL=<?php echo $row_bl['id_binh_luan'] ?>" method="POST">

                                <button type="submit" id="button_insert" style="color: red;border: none; background-color: snow;" name="report">Report</button>
                            </form>
                        <?php
                        } else {
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if (isset($_SESSION['id_ql'])) {
                ?>
                    <tr>
                        <td rowspan="2"></td>
                        <td><span style="font-size: 19px;color: blue;">&#10551;</span>
                            <span onclick="myshow()" style="color: blue;font-size: 15px;font-weight: 500;">Trả lời</span>
                        </td>
                    </tr>
                    <div class="tablerep">
                        <table style="margin-left: 70px;">
                            <tr>
                                <th rowspan="2" style="padding: 5px;">
                                    <img class="rounded-circle" src="https://www.daykemtainha.vn/public/files/avatar_crop/default-avatar.png" alt="avatar" width="65" height="65" />
                                </th>
                                <th style="padding-top: 15px; "><span class="nameqtr">Quản trị viên</span></th>
                            </tr>
                            <tr>
                                <td><?php
                                    // if (isset($rowtim['tra_loi'])) {
                                    //     echo $rowtim['tra_loi'];
                                    // } else {
                                    // }
                                    ?></td>
                            </tr>
                        </table>
                        <?php
                        if (isset($rowtim['tra_loi'])) {

                        ?>
                            <div class="repne" id="an">
                                <form action="pages/main/add_bl.php?IdMon=<?php echo $_GET['IdMon'] ?>&IdBL=<?php echo $row_bl['id_binh_luan'] ?>" method="POST">
                                    <input type="text" name="reply" size="112" class="formreply" id="enterinput" value="<?php echo $rowtim['tra_loi'] ?>">
                                    <button type="submit" id="button_insert" class="butnrep" name="rep_edit">Sửa</button>
                                </form>
                            </div>
                        <?php } else {
                        ?>
                            <div class="repne" id="an">
                                <form action="pages/main/add_bl.php?IdMon=<?php echo $_GET['IdMon'] ?>&IdBL=<?php echo $row_bl['id_binh_luan'] ?>" method="POST">
                                    <input type="text" name="reply" size="112" class="formreply" id="enterinput">
                                    <button type="submit" id="button_insert" class="butnrep" name="rep">Trả lời</button>
                                </form>
                            </div>
                        <?php
                        } ?>
                    <?php } elseif (isset($rowtim['tra_loi'])) {
                    ?>
                        <div class="tablerep">
                            <table style="margin-left: 70px;">
                                <tr>
                                    <th rowspan="2" style="padding: 5px;">
                                        <img class="rounded-circle" src="https://www.daykemtainha.vn/public/files/avatar_crop/default-avatar.png" alt="avatar" width="65" height="65" />
                                    </th>
                                    <th style="padding-top: 15px; "><span class="nameqtr">Quản trị viên</span></th>
                                </tr>
                                <tr>
                                    <td><?php
                                        if (isset($rowtim['tra_loi'])) {
                                            echo $rowtim['tra_loi'];
                                        } else {
                                        }
                                        ?></td>
                                </tr>
                            </table>
                        <?php
                    } ?>
            </table>
            <?php
            // if (isset($_SESSION['id_ql']) & $rowtim['tra_loi'] == "") {
            ?>

            <?php
            // }
            ?>
        <?php }
        ?>

    </div>

</div>
<script>
    $(document).ready(function() {
        $(".image-slider").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            draggable: false,
            prevArrow: `<button type='button' class='slick-prev slick-arrow'><ion-icon name="arrow-back-outline"></ion-icon></button>`,
            nextArrow: `<button type='button' class='slick-next slick-arrow'><ion-icon name="arrow-forward-outline"></ion-icon></button>`,
            dots: true,
            responsive: [{
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        arrows: false,
                        infinite: false,
                    },
                },
            ],
            // autoplay: true,
            // autoplaySpeed: 1000,
        });
    });
</script>
<style>
    .item-danhgia>b {
        margin: auto 0;
        height: fit-content;
        padding: 20px;
    }

    .item-danhgia>a>button {
        text-decoration: none;
        margin: 0 !important;
        height: auto !important;
    }

    .item-danhgia>a {
        margin: auto 0;
        height: fit-content;
        text-decoration: none;
    }

    .stars {
        width: 270px;
        display: inline-block;
    }


    .stars {
        width: 270px;
        display: inline-block;
    }

    input.star {
        display: none;
    }

    label.star {
        float: right;
        padding: 10px;
        padding-top: 0px;
        font-size: 24px;
        color: #444;
        transition: all 0.2s;
    }

    input.star:checked~label.star:before {
        content: "\f005";
        color: #fd4;
        transition: all 0.25s;
    }

    input.star-5:checked~label.star:before {
        color: rgb(251, 255, 0);
        text-shadow: 0 0 10px rgb(226, 82, 149);
    }

    input.star-1:checked~label.star:before {
        color: #f62;
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3);
    }

    label.star:before {
        content: "\f006";
        font-family: FontAwesome;
    }
</style>
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

    /* 
    #button_insert {
        background: #ffbe33;
        width: 40px;
        height: 40px;
        color: white;
        border-radius: 100%;
        border: none;
        justify-content: center;
        /* margin-left: 163px; */
    /* } */


    #button_insert1 {
        width: 100%;
    }

    .food_sections {
        padding-top: 145px;
    }



    .card-img-top2 {
        width: 100%;
        /* width: 267.1px;
        height: 220px; */
        /* margin-left: -1px; */
        margin-top: -1px;

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
    }

    .card-body {
        padding: 11px 0 1px 0;
    }
</style>
<style>
    img {
        display: block;
        max-width: 100%;
    }

    button {
        cursor: pointer;
    }

    .image-slider {
        padding-bottom: 50px;
    }

    .image {
        height: 500px;
        margin-bottom: 20px;
    }

    .image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .slick-initialized .slick-slide {
        margin: 0 10px;
    }

    .slick-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        line-height: 1;
        z-index: 1;
        transition: all 0.2s linear;
    }

    .slick-arrow:hover {
        background-color: #2cccff;
        color: white;
    }

    .slick-prev {
        left: 0;
    }

    .slick-next {
        right: 0;
    }

    .slick-dots {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translate(-50%, 0);
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 0 20px;
    }

    .slick-dots button {
        font-size: 0;
        width: 15px;
        height: 15px;
        border-radius: 100rem;
        background-color: #eee;
        border: none;
        outline: none;
        transition: all 0.2s linear;
    }

    .slick-dots .slick-active button {
        background-color: #2cccff;
    }

    .slick-dots {
        list-style-type: none;
    }
</style>
<script>
    $(document).ready(function() {
        const btn = document.querySelectorAll("#button_insert")
        btn.forEach(function(btn, index) {
            btn.addEventListener("click", function(event) {
                var btnItem = event.target
                var product = btnItem.parentElement
                var id_sp = product.querySelector("H4").innerText
                $.ajax({
                    url: "pages/main/addcart.php",
                    type: "POST",
                    data: {
                        id_sp: id_sp
                    },
                    success: function(data) {
                        $(".thongbao").html(data);
                        $(".loadcount").load;
                    }

                })
            })
        })
    });
    $(document).ready(function() {
        const btn = document.querySelectorAll("#button_insert1")
        btn.forEach(function(btn, index) {
            btn.addEventListener("click", function(event) {
                var btnItem = event.target
                var product = btnItem.parentElement
                var id_sp = product.querySelector("H4").innerText
                $.ajax({
                    url: "pages/main/addcart.php",
                    type: "POST",
                    data: {
                        id_sp1: id_sp
                    },
                    success: function(data) {
                        $(".thongbao").html(data);
                        $(".loadcount").load;
                    }
                })
            })
        })
    });
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>