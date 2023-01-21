<?php
include('../config.php');
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");

if (isset($_POST['themkhuyenmai'])) {
    $ten_km = $_POST['ten_km'];
    $trigia = $_POST['trigia'];
    $noidung = $_POST['noidung'];
    $ngaybd = $_POST['dateon'];
    $ngaykt = $_POST['dateoff'];
    $anhloai = $_FILES['anh_loai']['name'];
    $anhloai_tmp = $_FILES['anh_loai']['tmp_name'];
    $anhloai = time() . '_' . $anhloai;
    $trigia = $_POST['trigia'];
    $soluong = $_POST['soluong'];

    // print_r($ts);
    $sql_them = "INSERT INTO khuyen_mai(ten_km,ngay_bd,ngay_kt,noi_dung_km,trang_thai_km,anh_km) VALUE('" . $ten_km . "','" . $ngaybd . "','" . $ngaykt . "','" . $noidung . "',1,'" . $anhloai . "')";
    $add = mysqli_query($mysqli, $sql_them);
    move_uploaded_file($anhloai_tmp, 'uploads/' . $anhloai);
    if ($sql_them) {
        $id_km = mysqli_insert_id($mysqli);
        if (isset($_POST['themsp-thongso'])) {
            $ten_mon_an = $_POST['themsp-thongso'];
            $ts = explode(',', $ten_mon_an);
            foreach ($ts as $tso) {
                unset($thso);
                unset($data);
                $thso = explode(': ', $tso);
                // echo  $thso[0];
                $thso[0] = trim($thso[0]);
                //   echo  $thso[0];
                $query = "SELECT `id_mon_an` FROM `mon_an` WHERE `ten_mon_an`='" . $thso[0] . "'";
                $datasql = mysqli_query($mysqli, $query);
                while ($row = mysqli_fetch_array($datasql, 1)) {
                    $data[] = $row;
                    // echo $row['id_mon_an'];
                }
                if (isset($data)) {
                    for ($i = 0; $i < count($data); $i++) {
                        $id_mon_an = $data[$i]['id_mon_an'];

                        $sql_them_ctkm = "INSERT INTO chi_tiet_khuyen_mai(id_km,id_mon_an,gia_tri_khuyen_mai,soluong_km) 
			     VALUE('" . $id_km . "','" . $id_mon_an . "','" . $trigia . "','" . $soluong . "')";
                        $query = mysqli_query($mysqli, $sql_them_ctkm);
                        print_r($data);
                    }
                } else {
                    break;
                }
            }
        } elseif (isset($_POST['id_loai_mon_an'])) {
            $id_mon = $_POST['id_loai_mon_an'];
            $sql_select_mon_thuoc_loai = "SELECT id_mon_an FROM `mon_an`  WHERE mon_an.id_loai_mon_an= $id_mon";
            $query_select = mysqli_query($mysqli, $sql_select_mon_thuoc_loai);
            while ($rowmonan = mysqli_fetch_array($query_select)) {
                $data[] = $rowmonan;
            }
            for ($i = 0; $i <  count($data); $i++) {
                $id_mon_an = $data[$i]['id_mon_an'];

                $sql_them_ctkm = "INSERT INTO chi_tiet_khuyen_mai(id_km,id_mon_an,gia_tri_khuyen_mai,soluong_km) 
                 VALUE('" . $id_km . "','" . $id_mon_an . "','" . $trigia . "','" . $soluong . "')";
                $query = mysqli_query($mysqli, $sql_them_ctkm);
            }
        }
        if ($add) {
            $_SESSION['message'] = 'Thêm khuyến mãi thành công';
            header('Location:../../index.php?action=khuyenmai&query=danhsach');
            exit(0);
        } else {
            $_SESSION['message'] = 'Thêm thất bại';
            header('Location:../../index.php?action=khuyenmai&query=danhsach');
            exit(0);
        }
    }
    // echo  $id_km;
    //   
    // }
    // 


    // if ($sql_them) {
    //     $id_km = mysqli_insert_id($mysqli);
    //     // echo  $id_km;
    //     $sql_select_mon_thuoc_loai = "SELECT id_mon_an FROM `mon_an`  WHERE mon_an.id_loai_mon_an= $id_mon";
    //     $query_select = mysqli_query($mysqli, $sql_select_mon_thuoc_loai);
    //     $trigia = $_POST['trigia'];
    //     $soluong = $_POST['soluong'];
    //     while ($rowmonan = mysqli_fetch_array($query_select)) {
    //         $data[] = $rowmonan;
    //     }
    //     for ($i = 0; $i <  count($data); $i++) {
    //         $id_mon_an = $data[$i]['id_mon_an'];

    //         $sql_them_ctkm = "INSERT INTO chi_tiet_khuyen_mai(id_km,id_mon_an,gia_tri_khuyen_mai,soluong_km) 
    //              VALUE('" . $id_km . "','" . $id_mon_an . "','" . $trigia . "','" . $soluong . "')";
    //         $query = mysqli_query($mysqli, $sql_them_ctkm);
    //     }
    // }
} elseif (isset($_POST['IDKM'])) {
    $id_km = $_POST['IDKM'];
    $sql_sua_km = "SELECT * FROM khuyen_mai,chi_tiet_khuyen_mai WHERE khuyen_mai.id_km=chi_tiet_khuyen_mai.id_km and chi_tiet_khuyen_mai.id_km= $id_km LIMIT 1";
    $query_sua_km = mysqli_query($mysqli, $sql_sua_km);
    $num = mysqli_num_rows($query_sua_km);
    if ($num > 0) {

        while ($row1 = mysqli_fetch_array($query_sua_km)) {
?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa Khuyến mãi : <span><?php echo $row1['ten_km'] ?></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/khuyenmai/xuly.php?IDKM=<?php echo $row1['id_km'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên khuyến mãi</label>
                        <input type="text" name="ten_km" class="form-control" value="<?php echo $row1['ten_km'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Trị giá</label>
                        <input type="number" name="trigia" class="form-control" value="<?php echo $row1['gia_tri_khuyen_mai'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu </label>
                        <input type="datetime-local" name="dateon" class="form-control" value="<?php echo $row1['ngay_bd'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="datetime-local" name="dateoff" class="form-control" value="<?php echo $row1['ngay_kt'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Số lượng khuyến mãi</label>
                        <input type="number" min="1" max="100" name="soluong" class="form-control" value="<?php echo $row1['soluong_km'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Nội dung khuyến mãi</label>
                        <input type="text" name="noidungkm" class="form-control" value="<?php echo $row1['noi_dung_km'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <table>
                            <td style="border: none;">
                                <input type="radio" id="ss" name="trang_thai" value="1" checked>
                                <label for="ss">Kích hoạt</label>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="hh" name="trang_thai" value="2">
                                <label for="css">Ngừng áp dụng</label>
                            </td>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="sua_km" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
        <?php
        }
    } else {
    }
} elseif (isset($_POST['IDKM2'])) {
    $id_km2 = $_POST['IDKM2'];
    $sql_sua_km = "SELECT * FROM khuyen_mai WHERE id_km= $id_km2 LIMIT 1";
    $query_sua_km = mysqli_query($mysqli, $sql_sua_km);
    $num = mysqli_num_rows($query_sua_km);
    if ($num > 0) {

        while ($row1 = mysqli_fetch_array($query_sua_km)) {
        ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa Khuyến mãi : <span><?php echo $row1['ten_km'] ?></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/khuyenmai/xuly.php?IDKM=<?php echo $row1['id_km'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên khuyến mãi</label>
                        <input type="text" name="ten_km" class="form-control" value="<?php echo $row1['ten_km'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Danh mục áp dụng</label>
                        <div class="form-group" id="thanhsearch">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 394px;">
                                        <select name="thanh_phan" id="thongso" style="width: 100%;" class="form-control">
                                            <option value="">Vui lòng chọn món ăn</option>
                                            <?php
                                            $query_tp = "SELECT mon_an.id_mon_an, mon_an.ten_mon_an FROM mon_an LEFT JOIN chi_tiet_khuyen_mai ON mon_an.id_mon_an = chi_tiet_khuyen_mai.id_mon_an WHERE chi_tiet_khuyen_mai.id_mon_an IS NULL ORDER BY mon_an.id_mon_an;";
                                            $datasql = mysqli_query($mysqli, $query_tp);
                                            unset($data);
                                            while ($rowtp = mysqli_fetch_array($datasql, 1)) {
                                                $data[] = $rowtp;
                                            }

                                            if (!empty($data)) {
                                                for ($tmp = 0; $tmp < count($data); $tmp++) {
                                            ?>
                                                    <option value="<?php echo $data[$tmp]['ten_mon_an'] ?>"><?php echo $data[$tmp]['ten_mon_an'] ?></option>
                                            <?php
                                                }
                                            }

                                            ?>

                                        </select>
                                    </td>
                                    <td style="padding-left: 3px;">
                                        <input type="button" class="btn btn-secondary" value="Thêm" onclick="thongsochitiet.value = thongsochitiet.value+thongso.value+',\n'">
                                    </td>
                                </tr>
                            </table>
                            <div class="form-group thongsochitiet">
                                <textarea class="form-control" name="tenmon" id="thongsochitiet" aria-label="With textarea" placeholder="Vui lòng chọn món ăn ở bên trên" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trị giá</label>
                        <input type="number" name="trigia" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu </label>
                        <input type="datetime-local" name="dateon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="datetime-local" name="dateoff" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Số lượng khuyến mãi</label>
                        <input type="number" min="1" max="100" name="soluong" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nội dung khuyến mãi</label>
                        <input type="text" name="noidungkm" class="form-control" value="<?php echo $row1['noi_dung_km'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <table>
                            <td style="border: none;">
                                <input type="radio" id="ss" name="trang_thai" value="1" checked>
                                <label for="ss">Kích hoạt</label>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="hh" name="trang_thai" value="2">
                                <label for="css">Ngừng áp dụng</label>
                            </td>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về </button>
                    <button type="submit" name="sua_km2" class="btn btn-primary"> Lưu </button>
                </div>
            </form>
        <?php
        }
    } else {
    }
} elseif (isset($_POST['sua_km2'])) {
    $idkm = $_GET['IDKM'];
    $ten_km = $_POST['ten_km'];
    $noidung = $_POST['noidungkm'];
    $ngaybd = $_POST['dateon'];
    $trigia = $_POST['trigia'];
    $ngaykt = $_POST['dateoff'];
    $trangthai = $_POST['trang_thai'];
    $soluong = $_POST['soluong'];
    $sql_update_km2 = "UPDATE khuyen_mai SET  ten_km= '" . $ten_km . "',ngay_bd='" . $ngaybd . "',ngay_kt='" . $ngaykt . "',noi_dung_km='" . $noidung . "',trang_thai_km='" . $trangthai . "' WHERE id_km=$idkm  ";
    $add1 = mysqli_query($mysqli, $sql_update_km2);
    if ($sql_update_km2) {
        $ten_mon_an1 = $_POST['tenmon'];
        $ts = explode(',', $ten_mon_an1);
        foreach ($ts as $tso) {
            unset($thso);
            unset($data);
            $thso = explode(': ', $tso);

            $thso[0] = trim($thso[0]);

            $query = "SELECT `id_mon_an` FROM `mon_an` WHERE `ten_mon_an`='" . $thso[0] . "'";
            $datasql = mysqli_query($mysqli, $query);
            while ($row = mysqli_fetch_array($datasql, 1)) {
                $data[] = $row;
            }
            if (isset($data)) {
                for ($i = 0; $i < count($data); $i++) {
                    $id_mon_an = $data[$i]['id_mon_an'];
                    $sql_them_ctkm1 = "INSERT INTO chi_tiet_khuyen_mai(id_km,id_mon_an,gia_tri_khuyen_mai,soluong_km) 
			     VALUE('" . $idkm . "','" . $id_mon_an . "','" . $trigia . "','" . $soluong . "')";
                    $query1 = mysqli_query($mysqli, $sql_them_ctkm1);
                }
            } else {
                break;
            }
        }
    }
    if ($add1) {
        $_SESSION['message'] = 'Sửa khuyến mãi thành công';
        header('Location:../../index.php?action=khuyenmai&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message'] = 'Sửa thất bại';
        header('Location:../../index.php?action=khuyenmai&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['sua_km'])) {
    $id_mon_an_km = $_GET['IdMon'];
    $idkm = $_GET['IDKM'];
    $ten_km = $_POST['ten_km'];
    $noidung = $_POST['noidungkm'];
    $ngaybd = $_POST['dateon'];
    $trigia = $_POST['trigia'];
    $ngaykt = $_POST['dateoff'];
    $trangthai = $_POST['trang_thai'];
    $soluong = $_POST['soluong'];
    $sql_update_km = "UPDATE khuyen_mai SET  ten_km= '" . $ten_km . "',ngay_bd='" . $ngaybd . "',ngay_kt='" . $ngaykt . "',noi_dung_km='" . $noidung . "',trang_thai_km='" . $trangthai . "' WHERE id_km=$idkm  ";
    $add1 = mysqli_query($mysqli, $sql_update_km);
    $sql_update_ctkm = "UPDATE chi_tiet_khuyen_mai SET  gia_tri_khuyen_mai= '" . $trigia . "',soluong_km='" . $soluong . "' WHERE id_km=$idkm";
    $add2 = mysqli_query($mysqli, $sql_update_ctkm);
    if ($add1 & $add2) {
        $_SESSION['message'] = 'Sửa khuyến mãi thành công';
        header('Location:../../index.php?action=khuyenmai&query=danhsach');
        exit(0);
    } else {
        $_SESSION['message'] = 'Sửa thất bại';
        header('Location:../../index.php?action=khuyenmai&query=danhsach');
        exit(0);
    }
} elseif (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql = "SELECT DISTINCT* FROM khuyen_mai WHERE khuyen_mai.ten_km  LIKE '{$input}%' ";
    $result = mysqli_query($mysqli, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        ?>
        <div class="card-body searchresult">
            <table id="datatableid" class="table table-bordered">
                <thead>
                    <tr>
                        <th> STT </th>
                        <th>Tên khuyến mãi</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Trạng thái</th>
                        <th colspan="2">Thao tác</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $i++;
                    ?>
                        <tr>
                            <td> <?php echo $i ?></td>
                            <td><?php echo $row['ten_km'] ?></td>


                            <td><?php
                                $datebd = date_create($row['ngay_bd']);
                                echo date_format($datebd, "d-m-Y");
                                ?></td>
                            <td><?php
                                $datekt = date_create($row['ngay_kt']);
                                echo date_format($datekt, "d-m-Y");
                                ?>
                            </td>
                            <td>
                                <?php
                                $sql_lietke_ctkm = "SELECT DISTINCT* FROM khuyen_mai, chi_tiet_khuyen_mai,mon_an where mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and  khuyen_mai.id_km=chi_tiet_khuyen_mai.id_km and chi_tiet_khuyen_mai.id_km='" . $row['id_km'] . "'";
                                $query_lietke_ctkm = mysqli_query($mysqli, $sql_lietke_ctkm);
                                $rowctkm = mysqli_fetch_array($query_lietke_ctkm);
                                $today = date('Y-m-d 00:00:00');
                                if ($row['trang_thai_km'] == 1) {
                                    if ($row['ngay_kt'] > $today) {
                                        echo "<span style='color: #0099ff;'>Đang áp dụng</span>";
                                    } elseif ($row['ngay_kt'] < $today) {
                                        echo "Ngừng áp dụng";
                                        $sqlupdate2 = "UPDATE khuyen_mai SET trang_thai_km= 2 WHERE id_km= '" . $row['id_km'] . "'";
                                        $queryupdatekhuyenmai2 = mysqli_query($mysqli, $sqlupdate2);
                                        $sqlupdate3 = "DELETE FROM `chi_tiet_khuyen_mai` WHERE id_km= '" . $row['id_km'] . "'";
                                        $queryupdatekhuyenmai3 = mysqli_query($mysqli, $sqlupdate3);
                                    }
                                } else {
                                    echo "Ngừng áp dụng";
                                    $sqlupdate2 = "UPDATE khuyen_mai SET trang_thai_km= 2 WHERE id_km= '" . $row['id_km'] . "'";
                                    $queryupdatekhuyenmai2 = mysqli_query($mysqli, $sqlupdate2);
                                    $sqlupdate3 = "DELETE FROM `chi_tiet_khuyen_mai` WHERE id_km= '" . $row['id_km'] . "'";
                                    $queryupdatekhuyenmai3 = mysqli_query($mysqli, $sqlupdate3);
                                }
                                if (isset($rowctkm['id_km'])) {
                                    if ($rowctkm['soluong_km'] == 0) {
                                        $sqlupdate3 = "DELETE FROM `chi_tiet_khuyen_mai` WHERE id_km= '" . $rowctkm['id_km'] . "' AND  id_mon_an=  '" . $rowctkm['id_mon_an'] . "'";
                                        $queryupdatekhuyenmai3 = mysqli_query($mysqli, $sqlupdate3);
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row['trang_thai_km'] == 1) {
                                ?>
                                    <a class="btn" data-toggle="modal" data-target="#onmodalupdatekm" style="padding:0px" onclick="getdatasuakmmonan(id_km=<?php echo $row['id_km'] ?>)"><button type="button" class="btn btn-outline-secondary btn-sm">Sửa</button></a>
                                    <div class="modal fade" id="onmodalupdatekm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="suakhuyenmai">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn" data-target="#logoutModal1" data-toggle="modal" style="padding:0px" onclick="getdataxoakm(Idmon=<?php echo $row['id_km'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Ngưng áp dụng</button></a>
                                    <div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa khuyến mãi ?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"></div>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } elseif ($row['trang_thai_km'] == 2) {
                                ?>
                                    <a class="btn" data-toggle="modal" data-target="#onmodalupdatekm2" style="padding:0px" onclick="getdatasuakmmonan2(id_km=<?php echo $row['id_km'] ?>)"><button type="button" class="btn btn-outline-secondary btn-sm">Sửa</button></a>
                                    <div class="modal fade" id="onmodalupdatekm2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="suakhuyenmai2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <?php } else {
    ?>
        <div class="card-body searchresult">
            <div class="table-responsive">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th> STT </th>
                            <th>Tên khuyến mãi</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th colspan="2">Thao tác</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    } ?>
    <?php
} elseif (isset($_POST['id_mon'])) {
    $idkmxoa = $_POST['id_mon'];
    $sql_xoa_km = "SELECT * FROM khuyen_mai WHERE id_km = '$idkmxoa' LIMIT 1";
    $query_mon_xoa = mysqli_query($mysqli, $sql_xoa_km);
    $numxoa = mysqli_num_rows($query_mon_xoa);
    if ($numxoa > 0) {

        while ($row_xoa = mysqli_fetch_array($query_mon_xoa)) {
    ?>
            <p>Chọn "Xóa" để xóa khuyến mãi: <span style="color: red ;"><?php echo $row_xoa['ten_km'] ?></span></p>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                <form action="" method="POST">
                    <a href="includes/khuyenmai/xuly.php?IDKM=<?php echo $row_xoa['id_km'] ?>&idmon=<?php echo $idkmxoa  ?>" class="btn btn-primary">Xóa</a>
                </form>
            </div>
<?php
        }
    }
} else {
    $id = $_GET['IDKM'];
    $id_mon = $_GET['idmon'];

    // $sql_xoa = "DELETE FROM khuyen_mai WHERE id_km ='" . $id . "'";
    $sql_update_trang_thai_km = "UPDATE khuyen_mai SET trang_thai_km= 2  WHERE id_km=$id";
    $query_xoa = mysqli_query($mysqli, $sql_update_trang_thai_km);
    if ($query_xoa) {
        $_SESSION['message'] = 'Khuyến mãi đã được xóa';
        header('Location:../../index.php?action=khuyenmai&query=danhsach');
        exit(0);
    }
}
?>