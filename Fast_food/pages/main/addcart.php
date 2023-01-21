<?php
session_start();
include('../../admin/includes/config.php');

if (isset($_POST['id'])) {
    $key = $_POST['id'];
    $sql_id_km = "SELECT *FROM chi_tiet_khuyen_mai,khuyen_mai WHERE chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km and  khuyen_mai.ten_km='" . $key . "' LIMIT 1";
    $query_id_km = mysqli_query($mysqli, $sql_id_km);
    $num = mysqli_num_rows($query_id_km);
    if ($num > 0) {

        while ($row = mysqli_fetch_array($query_id_km)) {
?>
            <h5><?php echo  number_format($row['gia_tri_khuyen_mai'], 0, ',', '.') . 'đ'; ?></h5>
        <?php }
    } else {
        ?>
        <p>Không tồn tại</p>
    <?php }
}

if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    $sql_select_soluong = "SELECT soluong FROM mon_an where id_mon_an= $id";
    $query_select_soluong = mysqli_query($mysqli, $sql_select_soluong);
    $row_sluong = mysqli_fetch_array($query_select_soluong);
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
            $_SESSION['cart'] = $product;
        } else {
            $tangsoluong = $cart_item['soluong'] + 1;
            if ($cart_item['soluong'] < $row_sluong['soluong']) {

                $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $tangsoluong, 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
            } else {
                $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                $_SESSION['login-cart'] = "Tiết quá! Không đủ món ăn.";
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location:../../index.php?quanly=giohang');
}

if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
            $_SESSION['cart'] = $product;
        } else {
            $giamsoluong = $cart_item['soluong'] - 1;
            if ($cart_item['soluong'] > 1) {
                $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $giamsoluong, 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
            } else {
                $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('Location:../../index.php?quanly=giohang');
}

if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach ($_SESSION['cart'] as $cart_item) {

        if ($cart_item['id'] != $id) {
            $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
        }
        $_SESSION['cart'] = $product;
        header('Location:../../index.php?quanly=giohang');
    }
}

if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
    header('Location:../../index.php?quanly=giohang');
}



if (isset($_POST['themgiohang'])) {
    // session_destroy();
    $id = $_GET['IdMon'];
    $soluong = 1;
    if (!isset($_SESSION['id_kh'])) {
        $_SESSION['login-cart'] = "Bạn chưa đăng nhập. Vui lòng đăng nhập";
        header("Location:../../index.php?quanly=monan&IdMon=$id");
    } else {
        $sql = "SELECT *FROM mon_an, gia where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        // $sql = "SELECT *FROM mon_an, gia,chi_tiet_khuyen_mai,khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km and  mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        // echo $row["id_mon_an"];
        $sql1 = "SELECT *FROM khuyen_mai, chi_tiet_khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row["id_mon_an"] . "' LIMIT 1";
        $query1 = mysqli_query($mysqli, $sql1);
        $row1 = mysqli_fetch_array($query1);

        if (isset($row1['id_km'])) {
            if ($row1['trang_thai_ctkm'] == 1) {
                $gia = $row['gia'];
                $km = $row1['gia_tri_khuyen_mai'];
                $tong = $gia - $km;
                //  $khuyenmai=1; có áp dụng km
            } else {
                $tong  = $row['gia'];
                $km = 0;
                //  $khuyenmai=2; không áp dụng km
            }
        } elseif (!isset($row1['id_km'])) {
            $tong  = $row['gia'];
            $km = 0;
        }
        if ($row) {
            $new_product = array(array('ten_mon_an' => $row['ten_mon_an'], 'id' => $id, 'soluong' => $soluong, 'gia' => $row['gia'], 'anh_mon_an' => $row['anh_mon_an'], 'khuyenmai' => $km));
            // var_dump($_SESSION['cart']);
            if (isset($_SESSION['cart'])) {
                $found = false;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if ($cart_item['id'] == $id) {
                        $soluong1 = $cart_item['soluong'] + $soluong;
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $soluong1, 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                        $found = true;
                    } else {
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                    }
                }
                if ($found == false) {
                    $_SESSION['cart'] = array_merge($product, $new_product);
                } else {
                    $_SESSION['cart'] = $product;
                }
            } else {
                $_SESSION['cart'] = $new_product;
            }
        }

        // }
        // header('Location:../../index.php?quanly=giohang');
        // print_r($_SESSION['cart']);
    }
}
if (isset($_POST['themgiohang1'])) {
    // session_destroy();
    $id = $_GET['IdMon'];
    $soluong = 1;
    if (!isset($_SESSION['id_kh'])) {
        $_SESSION['login-cart'] = "Bạn chưa đăng nhập. Vui lòng đăng nhập";
        header("Location:../../index.php?quanly=monan&IdMon=$id");
    } else {

        $sql = "SELECT *FROM mon_an, gia where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        // $sql = "SELECT *FROM mon_an, gia,chi_tiet_khuyen_mai,khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km and  mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        // echo $row["id_mon_an"];
        $sql1 = "SELECT *FROM khuyen_mai, chi_tiet_khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row["id_mon_an"] . "' LIMIT 1";
        $query1 = mysqli_query($mysqli, $sql1);
        $row1 = mysqli_fetch_array($query1);

        if (isset($row1['id_km'])) {
            if ($row1['trang_thai_ctkm'] = 1) {
                $gia = $row['gia'];
                $km = $row1['gia_tri_khuyen_mai'];
                $tong = $gia - $km;
            } else {
                $tong  = $row['gia'];
                $km = 0;
            }
        } elseif (!isset($row1['id_km'])) {
            $tong  = $row['gia'];
            $km = 0;
        }
        // echo "$tong";
        if ($row) {
            $new_product = array(array('ten_mon_an' => $row['ten_mon_an'], 'id' => $id, 'soluong' => $soluong, 'gia' => $tong, 'anh_mon_an' => $row['anh_mon_an'], 'khuyenmai' => $km));
            // var_dump($_SESSION['cart']);
            if (isset($_SESSION['cart'])) {
                $found = false;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if ($cart_item['id'] == $id) {
                        $soluong1 = $cart_item['soluong'] + $soluong;
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $soluong1, 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                        $found = true;
                    } else {
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                    }
                }

                if ($found == false) {
                    $_SESSION['cart'] = array_merge($product, $new_product);
                } else {
                    $_SESSION['cart'] = $product;
                }
            } else {
                $_SESSION['cart'] = $new_product;
            }
        }

        header('Location:../../index.php?quanly=giohang');
        // print_r($_SESSION['cart']);  

    }
}

if (isset($_POST['id_sp1'])) {
    $id = $_POST['id_sp1'];
    // echo "$id";  
    $soluong = 1;


    if (!isset($_SESSION['id_kh'])) {
        // $_SESSION['login-cart'] = "Bạn chưa đăng nhập. Vui lòng đăng nhập";
        // header("Location:index.php");
        echo '  <div id="toast1" onclick="myFunction()">
                    <div class="toast1" style="border-color: #17a2b8!important">
                        <div class="toast1__icon">
                              <i class="fa fa-info-circle" style="color:#17a2b8!important"></i>
                        </div>
                        <div class="toast1__body1">
                            <strong class="toast1__title">Bạn chưa đăng nhập. Vui lòng đăng nhập!</strong>
                                <p class="toast1__msg"></p>
                        </div>

                        <div class="toast1__close" class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    </div>
             </div>
            <script>
                function myFunction() {
                    let toRemove = document.querySelector("#toast1");
                    toRemove.remove();
                }          
            </script>';
    } else {
        $sql = "SELECT *FROM mon_an, gia where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        // $sql = "SELECT *FROM mon_an, gia,chi_tiet_khuyen_mai,khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km and  mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        // echo $row["id_mon_an"];
        $sql1 = "SELECT *FROM khuyen_mai, chi_tiet_khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row["id_mon_an"] . "' LIMIT 1";
        $query1 = mysqli_query($mysqli, $sql1);
        $row1 = mysqli_fetch_array($query1);

        if (isset($row1['id_km'])) {
            if ($row1['trang_thai_ctkm'] = 1) {
                $gia = $row['gia'];
                $km = $row1['gia_tri_khuyen_mai'];
                $tong = $gia - $km;
            } else {
                $tong  = $row['gia'];
                $km = 0;
            }
        } elseif (!isset($row1['id_km'])) {
            $tong  = $row['gia'];
            $km = 0;
        }


        if ($row) {
            $new_product = array(array('ten_mon_an' => $row['ten_mon_an'], 'id' => $id, 'soluong' => $soluong, 'gia' => $tong, 'anh_mon_an' => $row['anh_mon_an'], 'khuyenmai' => $km));
            if (isset($_SESSION['cart'])) {
                $found = false;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if ($cart_item['id'] == $id) {
                        $soluong1 = $cart_item['soluong'] + $soluong;
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $soluong1, 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                        $found = true;
                    } else {
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                    }
                }
                if ($found == false) {
                    $_SESSION['cart'] = array_merge($product, $new_product);
                } else {
                    $_SESSION['cart'] = $product;
                }
            } else {
                $_SESSION['cart'] = $new_product;
            }
        }
        // $_SESSION['message_gh'] = 'Thêm vào giỏ hàng thành công';
        // header('Location:index.php');
        // print_r($_SESSION['cart']);

        echo '  <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
            <strong class="toast1__title">Đã thêm <span style="color:red;">';
        echo $row['ten_mon_an'];
        echo '</span> vào giỏ hàng!</strong>
                <p class="toast1__msg"></p>
            </div>

            <div class="toast1__close " class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            let toRemove = document.querySelector("#toast1");
            toRemove.remove();
        }
    </script>';
    }
}
if (isset($_POST['id_sp'])) {
    $id = $_POST['id_sp'];
    // echo "$id";
    $soluong = 1;
    if (!isset($_SESSION['id_kh'])) {
        // $_SESSION['login-cart'] = "Bạn chưa đăng nhập. Vui lòng đăng nhập";
        // header("Location:index.php");
        echo '  <div id="toast1" onclick="myFunction()">
                    <div class="toast1" style="border-color: #17a2b8!important">
                        <div class="toast1__icon">
                              <i class="fa fa-info-circle" style="color:#17a2b8!important"></i>
                        </div>
                        <div class="toast1__body1">
                            <strong class="toast1__title">Bạn chưa đăng nhập. Vui lòng đăng nhập!</strong>
                                <p class="toast1__msg"></p>
                        </div>

                        <div class="toast1__close" class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    </div>
             </div>
            <script>
                function myFunction() {
                    let toRemove = document.querySelector("#toast1");
                    toRemove.remove();
                }          
            </script>';
    } else {

        $sql = "SELECT *FROM mon_an, gia where mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        // $sql = "SELECT *FROM mon_an, gia,chi_tiet_khuyen_mai,khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km and  mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and mon_an.id_mon_an=gia.id_mon_an and mon_an.id_mon_an='" . $id . "' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        // echo $row["id_mon_an"];
        $sql1 = "SELECT *FROM khuyen_mai, chi_tiet_khuyen_mai where chi_tiet_khuyen_mai.id_km=khuyen_mai.id_km  and chi_tiet_khuyen_mai.id_mon_an='" . $row["id_mon_an"] . "' LIMIT 1";
        $query1 = mysqli_query($mysqli, $sql1);
        $row1 = mysqli_fetch_array($query1);

        if (isset($row1['id_km'])) {
            if ($row1['trang_thai_ctkm'] = 1) {
                $gia = $row['gia'];
                $km = $row1['gia_tri_khuyen_mai'];
                $tong = $gia - $km;
            } else {
                $tong  = $row['gia'];
                $km = 0;
            }
        } elseif (!isset($row1['id_km'])) {
            $tong  = $row['gia'];
            $km = 0;
        }
        if ($row) {
            $new_product = array(array('ten_mon_an' => $row['ten_mon_an'], 'id' => $id, 'soluong' => $soluong, 'gia' => $tong, 'anh_mon_an' => $row['anh_mon_an'], 'khuyenmai' => $km));
            if (isset($_SESSION['cart'])) {
                $found = false;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if ($cart_item['id'] == $id) {
                        $soluong1 = $cart_item['soluong'] + $soluong;
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $soluong1, 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                        $found = true;
                    } else {
                        $product[] = array('ten_mon_an' => $cart_item['ten_mon_an'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'gia' => $cart_item['gia'], 'anh_mon_an' => $cart_item['anh_mon_an'], 'khuyenmai' => $cart_item['khuyenmai']);
                    }
                }
                if ($found == false) {
                    $_SESSION['cart'] = array_merge($product, $new_product);
                } else {
                    $_SESSION['cart'] = $product;
                }
            } else {
                $_SESSION['cart'] = $new_product;
            }
        }
        // $_SESSION['message_gh'] = 'Thêm vào giỏ hàng thành công';
        // header('Location:index.php');
        // print_r($_SESSION['cart']);
        echo '  <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
            <strong class="toast1__title">Đã thêm <span style="color:red;">';
        echo $row['ten_mon_an'];
        echo '</span> vào giỏ hàng!</strong>

                <p class="toast1__msg"></p>
            </div>

            <div class="toast1__close " class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            let toRemove = document.querySelector("#toast1");
            toRemove.remove();
        }
    </script>';
    }
}
if (isset($_POST['update_kh'])) {
    $idkh = $_GET['idkh'];
    $ten_kh = $_POST['ten_kh'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $diachi = $_POST['dia_chi'];
    $tp = $_POST['id_tp'];
    $qh = $_POST['id_qh'];
    $px = $_POST['id_px'];
    $sql_diachixa = "SELECT * FROM `devvn_xaphuongthitran` WHERE idxa=$px";
    $query_diachixa = mysqli_query($mysqli, $sql_diachixa);
    $row_dcxa = mysqli_fetch_array($query_diachixa);
    $xa = $row_dcxa['Ten_xp'];
    $sql_diachiquan = "SELECT * FROM `devvn_quanhuyen` WHERE idqh=$qh";
    $query_diachiquan = mysqli_query($mysqli, $sql_diachiquan);
    $row_dcquan = mysqli_fetch_array($query_diachiquan);
    $quan = $row_dcquan['Ten_qh'];
    $sql_diachitinh = "SELECT * FROM `devvn_tinhthanhpho` WHERE idtp=$tp";
    $query_diachitinh = mysqli_query($mysqli, $sql_diachitinh);
    $row_dctinh = mysqli_fetch_array($query_diachitinh);
    $tinh = $row_dctinh['Ten_tp'];
    $diachigoc = $diachi . ',' . $xa . ',' . $quan . ',' . $tinh;
    $giotinh = $_POST['gioitinh'];
    // echo $giotinh;
    $sql_thaydoi =  "UPDATE khach_hang SET ten_kh='" . $ten_kh . "',gioi_tinh='" . $giotinh . "', dia_chi_kh='" . $diachigoc . "', sdt_kh='" . $sdt . "',
                    email_kh='" . $email . "'WHERE id_kh=$idkh";
    mysqli_query($mysqli, $sql_thaydoi);
    if ($sql_thaydoi) {
        $_SESSION['message_edit_kh'] = 'Cập nhật thông tin thành công';
        header('Location:../../index.php?quanly=thongtin');
        exit(0);
    }
}
if (isset($_POST['update_kh_pass'])) {
    $idkh = $_GET['idkh'];
    $pass = $_POST['pass1'];

    $password = md5($pass, false);
    echo $password;
    $sql_thaydoi =  "UPDATE khach_hang SET   password_kh='" . $password . "'WHERE id_kh=$idkh";
    mysqli_query($mysqli, $sql_thaydoi);
    if ($sql_thaydoi) {
        $_SESSION['message_edit_mk'] = 'Cập nhật mật khẩu thành công';
        header('Location:../../index.php?quanly=matkhau');
        exit(0);
    }
} elseif (isset($_POST['id_tinh'])) {
    $id_tinh = $_POST['id_tinh'];
    // echo  $id_quan;
    $sql_quan = "SELECT *FROM devvn_quanhuyen where idtp=$id_tinh and idqh=916";
    $query_quan = mysqli_query($mysqli, $sql_quan);
    $numquan = mysqli_num_rows($query_quan);
    if ($numquan > 0) {
    ?>
        <option>Chọn Quận/huyện</option>
        <?php
        while ($row_quan = mysqli_fetch_array($query_quan)) {
        ?>
            <option value="<?php echo $row_quan['idqh'] ?>"><?php echo $row_quan['Ten_qh'] ?></option>
        <?php
        }
    } else {
        echo 0;
    }
} elseif (isset($_POST['id_quan'])) {
    $id_quan = $_POST['id_quan'];
    // echo  $id_quan;
    $sql_xa = "SELECT *FROM devvn_xaphuongthitran where idqh=$id_quan";
    $query_xa = mysqli_query($mysqli, $sql_xa);
    $numxa = mysqli_num_rows($query_xa);
    if ($numxa > 0) {
        ?>
        <option selected>Chọn Phường xã</option>
        <?php
        while ($row_xa = mysqli_fetch_array($query_xa)) {
        ?>
            <option value="<?php echo $row_xa['idxa'] ?>"><?php echo $row_xa['Ten_xp'] ?></option>
<?php
        }
    } else {
        echo 0;
    }
}
