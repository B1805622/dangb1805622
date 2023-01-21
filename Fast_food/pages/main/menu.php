<!-- <?php
$sql_mon_an = "SELECT * FROM mon_an where trang_thai='Sẳn sàng' ORDER BY RAND() LIMIT 2 ";
$query_mon_an = mysqli_query($mysqli, $sql_mon_an);
?> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<style>
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
        padding-left: 0px;

    }

    .crossbar_item {
        text-decoration: none;
        text-align: center;
        color: #17252a;
    }

    .crossbar {
        padding-top: 53px;

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

    hr {
        margin-top: 5px;
        margin-bottom: 5px;
        border-width: 3px;
        /* padding-left: 87px; */
        margin-left: 205px;
        margin-right: 205px;
    }
</style>

<!-- <section class="offer_section layout_padding-bottom" id="wrapper">
    <div class="offer_container">
        <div class="container">
            <div class="row">
                <?php
                while ($row_mon_an = mysqli_fetch_array($query_mon_an)) {
                ?>
                    <div class="col-md-6  ">
                        <div class="box ">
                            <div class="img-box">
                                <img src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" />
                            </div>
                            <div class="detail-box">
                                <h5>
                                    <?php echo $row_mon_an['ten_mon_an'] ?>
                                </h5>
                                <h6>
                                    <span>20%</span> Off
                                </h6>
                                <a href="oder.php">
                                    Order Now <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
</section> -->
<!-- end offer section -->

<!-- food section -->
<?php
$sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an ASC";
$query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);
?>

<section style="padding-top:20px ;" class="food_sections">
    <div class="container">
        <div class="crossbar">
            <div class="crossbar_grid">
                <ul class="crossbar_list">
                    <!-- <li> <a href="pages/main/categogy.php?idLoai=0" class="crossbar_item nav-link">Tất cả</a> </li> -->
                    <?php
                    while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                    ?>
                        <li><a href="index.php?quanly=loai&idLoai=<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>" class="crossbar_item nav-link"><?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<hr>
<!-- <script>
    $(document).ready(function() {
        $(".nav-link").click(function() {
            // alert(this.href);
            var url = this.href;
            $("div#dang").load(url);
            return false;
        });
    });
</script> -->

<div id="dang">

</section>
    <?php
    $sql_lietke_sp = "SELECT *FROM mon_an, gia where mon_an.id_mon_an=gia.id_mon_an and trang_thai='Sẳn sàng' ORDER BY RAND() LIMIT 6";
    $query_pro1 = mysqli_query($mysqli, $sql_lietke_sp);
    ?>
    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="filters-content">
                <div class="row grid">
                    <?php
                    while ($row_mon_an = mysqli_fetch_array($query_pro1)) {
                    ?>
                        <div class="col-sm-6 col-lg-4 ">
                            <div class="box" id="dang">

                                <div class="img-box">
                                    <a href="index.php?quanly=monan&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>" class="product_thumb">
                                        <img style="max-width: auto; max-height: auto; " src="admin/includes/quanlymonan/uploads/<?php echo $row_mon_an['anh_mon_an'] ?>" />
                                    </a>
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        <?php echo $row_mon_an['ten_mon_an'] ?>
                                    </h5>
                                    <p style="text-overflow: ellipsis; word-wrap: break-word; overflow: hidden;max-height: 2em; line-height: 2em;">
                                        <?php echo $row_mon_an['mo_ta'] ?>
                                    </p>
                                    <div class="options">
                                        <h6>
                                            <?php echo number_format($row_mon_an['gia'], 0, ',', '.') . 'đ'; ?>
                                        </h6>
                                        <!-- <h6>
                                            <input type="number" name="so_luong" min="1" max="100" value="1">
                                            <?php echo number_format($row_mon_an['gia'], 0, ',', '.') . 'đ'; ?>
                                        </h6> -->

                                        <a href="index.php?quanly=giohang&IdMon=<?php echo $row_mon_an['id_mon_an'] ?>">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                         c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                         C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                         c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                         C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                         c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                                    </g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                            </svg>
                                        </a>

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
</div>