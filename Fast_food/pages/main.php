<div class="content" <!-- <?php

            ?> -->
    <?php
    if (isset($_GET['quanly'])) {
        $tam = $_GET['quanly'];
    } else {
        $tam = '';
    }
    if ($tam == 'giohang') {
        include("main/cart.php");
    }  elseif ($tam == 'login') {
        include("main/login.php");
    } elseif ($tam == 'server') {
        include("main/server.php");
    } elseif ($tam == 'register') {
        include("main/register.php");
    } elseif ($tam == 'monan') {
        include("main/monan.php");
    }  elseif ($tam == 'loai') {
        include("main/categogy.php");
    } elseif ($tam == 'khuyenmai') {
        include("main/khuyenmai.php");
    }  elseif ($tam == 'donhang') {
        include("main/donhang.php");
    } elseif ($tam == 'thanhtoan') {
        include("main/thanhtoan.php");
    } elseif ($tam == 'thanks') {
        include("main/thanks.php");
    }elseif ($tam == 'lichsu') {
        include("main/lichsu.php");
    } elseif ($tam == 'chitiet') {
        include("main/chitiet.php");
    } elseif ($tam == 'thongtin') {
        include("main/thongtin.php");
    } elseif ($tam == 'matkhau') {
        include("main/matkhau.php");
    } elseif ($tam == 'diachi') {
        include("main/diachi.php");
    } elseif ($tam == 'rs') {
        include("main/rs.php");
    } elseif ($tam == 'ctkm') {
        include("main/chitietkm.php");
    }else {
        include("sidebar/banner.php");
        include("main/index.php");
    }

    ?>
</div>