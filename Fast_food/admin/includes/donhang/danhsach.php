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
$sql_lietke_donhang = "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh WHERE  kh.id_kh=gh.id_kh ORDER BY gh.thoi_gian_add DESC LIMIT $begin,5";
$query_lietke_don_hang = mysqli_query($mysqli, $sql_lietke_donhang);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <?php
    if (isset($_SESSION['message_duyet'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_duyet']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message_duyet']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_gh'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_gh']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message_gh']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_xoa'])) {
    ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_xoa']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message_xoa']);
    }
    ?>
    <div id="demo" style="display:none;" class="alert alert-danger">
        <a href="#" class="close" onclick="an()" aria-label="close">&times;</a>
        <strong>Không thể xóa</strong>
    </div>
    <div class="card shadow mb-4" id="dshd">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Thêm loại món ăn
                </button> -->
            </h6>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="">Tất cả </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link timloai" onclick="Show()">Đơn hàng mới </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link timloai" onclick="Show()">Giao hàng </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link timloai" onclick="Show()">Đang giao hàng </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link timloai" onclick="Show()">Đã thanh toán </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link timloai" onclick="Show()">Yêu cầu hủy </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link timloai" onclick="Show()">Đã hủy </a>
                    </li>
                </ul>
                <form class="">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light small" id="searchinput" placeholder="ID đơn hàng..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
        <div class="hienloai">

        </div>
        <script>
            function Show() {
                document.getElementById('all1').style.display = "none";
                document.getElementById('changecolor').style.color = "#000000";
            }
            $(document).ready(function() {
                $("#searchinput").keyup(function() {
                    var input = $(this).val();
                    // alert(input);
                    if (input != "") {
                        $.ajax({
                            url: "includes/donhang/search.php",
                            type: "POST",
                            data: {
                                input: input
                            },
                            success: function(data) {
                                $(".searchresult").html(data);
                                $(".hienloai").css("display", "none");
                                $("#all2").css("display", "none");
                                $(".searchresult").css("display", "block");
                            }
                        })
                    } else {
                        location.reload(true);
                    }
                })
            })
        </script>
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
                            while ($row = mysqli_fetch_array($query_lietke_don_hang)) {
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
        <script>
            function getdata() {
                var idhd = id_hd;
                $.ajax({
                    url: "includes/donhang/inhoadon.php",
                    type: "POST",
                    data: {
                        idhd: idhd
                    },
                    success: function(data) {
                        // $(".modal-content1").html(data);
                        document.getElementById(`onin`).style.display = "block";
                        document.getElementById('accordionSidebar').style.display = "none";
                        document.getElementById('dshd').style.display = "none";
                        window.print($(".modal-content1").html(data));
                    }
                })
            }
        </script>
        <script>
            function back() {
                document.getElementById(`accordionSidebar`).style.display = "block";
                document.getElementById(`dshd`).style.display = "block";
                document.getElementById(`onin`).style.display = "none";
            }
        </script>
        <?php
        $sql_trang = mysqli_query($mysqli, "SELECT DISTINCT* FROM gio_hang AS gh, khach_hang AS kh WHERE  kh.id_kh=gh.id_kh ORDER BY gh.thoi_gian_add DESC");
        $row_count = mysqli_num_rows($sql_trang);
        $trang = ceil($row_count / 5);
        ?>
        <div class="paging" id="all2">
            <p style="display: flex;align-items: center;">Tổng số trang <?php echo $trang ?> </p>
            <ul class="page_list">
                <?php
                for ($i = 1; $i <= $trang; $i++) {
                ?>
                    <li <?php if ($i == $page) {
                            echo 'style="background-color: #4e73df;"';
                        } else {
                            echo '';
                        } ?>><a href="index.php?action=donhang&query=danhsach&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="modal-content1" id="onin"></div>
</div>


<div style="clear:both;"></div>
<style type="text/css">
    .paging {
        display: flex;
        justify-content: flex-end;
    }

    ul.page_list {
        /* float: right; */
        /* padding-bottom: 40px; */
        padding-left: 0;
        /* margin: 0; */
        list-style: none;
    }

    ul.page_list li {
        float: left;
        padding: 5px 13px;
        margin: 5px;
        background-color: #fff;
        display: block;
    }

    ul.page_list li a {
        color: #3f2529;
        text-align: center;
        text-decoration: none;
    }
</style>
</div>
<script>
    function hien() {
        document.getElementById("demo").style.display = "block";
    }

    function an() {
        document.getElementById("demo").style.display = "none";
    }
</script>
<script>
    $(document).ready(function() {
        const btn = document.querySelectorAll(".timloai")
        // console.log(btn);
        btn.forEach(function(btn, index) {
            // console.log(btn, index);
            btn.addEventListener("click", function(event) {
                var btnItem = event.target;
                // btnItem.onclick =function(){

                // console.log(btnItem)
                var product = btnItem.parentElement
                var id_trang_thai = product.querySelector("a").innerText
                // console.log(id_trang_thai)
                if (id_trang_thai == "Đơn hàng mới") {
                    id_trang_thai = 1;
                }
                if (id_trang_thai == "Giao hàng") {
                    id_trang_thai = 2;
                }
                if (id_trang_thai == "Đang giao hàng") {
                    id_trang_thai = 3;
                }
                if (id_trang_thai == "Đã thanh toán") {
                    id_trang_thai = 6;
                }
                if (id_trang_thai == "Đã hủy") {
                    id_trang_thai = 4;
                }
                if (id_trang_thai == "Yêu cầu hủy") {
                    id_trang_thai = 5;
                }
                // alert(id_trang_thai);
                $.ajax({
                    url: "includes/donhang/search.php",
                    type: "POST",
                    data: {
                        id_trang_thai: id_trang_thai
                    },
                    success: function(data) {
                        $(".hienloai").html(data);
                        $("#all2").css("display", "none");
                    }

                })

            })
        })
    });
</script>