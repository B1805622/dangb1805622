<?php
include('../config.php');
session_start();
// error_reporting(0);
date_default_timezone_set("Asia/Ho_Chi_Minh");
if (isset($_POST['themmonan'])) {
	// $idMon=$_POST['id_mon_an'];
	$loaimon = $_POST['loai_mon_an'];
	$tenmon = $_POST['ten_mon_an'];
	$gia = $_POST['gia'];
	// $date = mktime(15,50,30,4,30,2017);
	//xulyhinhanh
	$anhmon = $_FILES['anhmon']['name'];
	$anhmon_tmp = $_FILES['anhmon']['tmp_name'];
	$anhmon = time() . '_' . $anhmon;
	$mota = $_POST['mota'];
	$trangthai = 1;
	$thanh_phan = $_POST['themsp-thongso'];
	$soluong = $_POST['soluong'];
	$thanh_phan = nl2br($thanh_phan);
	$ts = explode('<br />', $thanh_phan);
	// $sql_them = "INSERT INTO mon_an(id_loai_mon_an,ten_mon_an,anh_mon_an,soluong,trang_thai,mo_ta_mon) 
	// 	VALUE('" . $loaimon . "','" . $tenmon . "','" . $anhmon . "'," . $soluong . ",'" . $trangthai . "','" . $mota . "')";
	// $add_mon = mysqli_query($mysqli, $sql_them);
	$sql_them = "INSERT INTO mon_an(id_loai_mon_an,ten_mon_an,anh_mon_an,soluong,trang_thai,mo_ta_mon) 
		VALUE('" . $loaimon . "','" . $tenmon . "','" . $anhmon . "'," . $soluong . ",'" . $trangthai . "','" . $mota . "')";
	$add_mon = mysqli_query($mysqli, $sql_them);
	move_uploaded_file($anhmon_tmp, 'uploads/' . $anhmon);
	if ($sql_them) {
		$d = date('Y-m-d');
		$id_mon_an = mysqli_insert_id($mysqli);
		$sql_them1 = "INSERT INTO gia(ngay,id_mon_an,gia) 
			VALUE('" . $d . "','" . $id_mon_an . "','" . $gia . "')";
		$add_gia = mysqli_query($mysqli, $sql_them1);
		foreach ($ts as $tso) {
			unset($thso);
			unset($data);
			$thso = explode(': ', $tso);
			$thso[0] = trim($thso[0]);
			$query = "SELECT `id_tp` FROM `thanh_phan` WHERE `ten_tp`='" . $thso[0] . "'";
			$datasql = mysqli_query($mysqli, $query);
			while ($row = mysqli_fetch_array($datasql, 1)) {
				$data[] = $row;
			}
			if (isset($data)) {
				for ($i = 0; $i < count($data); $i++) {
					$id_tp = $data[$i]['id_tp'];

					$sql_them_ctkm = "INSERT INTO thanh_phan_mon_an(id_tp,id_mon_an,gia_tri) 
			     VALUE('" . $id_tp . "','" . $id_mon_an . "','" . $thso[1] . "')";
					$query = mysqli_query($mysqli, $sql_them_ctkm);
					print_r($data);
				}
			} else {
				break;
			}
		}
		$mysqli->close();
		$_SESSION['message_add_mon'] = 'Thêm thành công';
		header('Location:../../index.php?action=quanlymonan&query=danhsach');
	}
} elseif (isset($_POST['sua_mon_an'])) {
	$loaimonan = $_POST['loai_mon_an'];
	$tenmonan = $_POST['ten_mon_an'];
	//xulyhinhanh
	$anhmon = $_FILES['anhmon']['name'];
	$anhmon_tmp = $_FILES['anhmon']['tmp_name'];
	$anhmon = time() . '_' . $anhmon;
	$d = date('Y-m-d');
	$gia = $_POST['gia'];
	$mota = $_POST['mo_ta'];
	$soluong = $_POST['soluong'];
	$trangthai = $_POST['trang_thai'];
	$thanh_phan = $_POST['themsp-thongso'];
	$thanh_phan = nl2br($thanh_phan);
	$ts = explode('<br />', $thanh_phan);
	if ($anhmon != '') {
		move_uploaded_file($anhmon_tmp, 'uploads/' . $anhmon);
		$sql_update = "UPDATE mon_an SET id_loai_mon_an='" . $loaimonan . "', ten_mon_an='" . $tenmonan . "', 
			anh_mon_an='" . $anhmon . "',soluong='" . $soluong . "',trang_thai='" . $trangthai . "',mo_ta_mon='" . $mota . "' WHERE id_mon_an='$_GET[idMon]'";

		$sql_update1 = "UPDATE gia SET gia='" . $gia . "',ngay='" . $d . "' WHERE id_mon_an='$_GET[idMon]'";
		$edit1 = mysqli_query($mysqli, $sql_update1);
		$sql = "SELECT * FROM mon_an WHERE id_mon_an= '$_GET[idMon]' LIMIT 1";
		$query = mysqli_query($mysqli, $sql);
		while ($row = mysqli_fetch_array($query)) {
			unlink('uploads/' . $row['anh_mon_an']);
		}
		foreach ($ts as $tso) {
			unset($thso);
			unset($data);
			$thso = explode(': ', $tso);
			$thso[0] = trim($thso[0]);
			$query = "SELECT `id_tp` FROM `thanh_phan` WHERE `ten_tp`='" . $thso[0] . "'";
			$datasql = mysqli_query($mysqli, $query);
			while ($row = mysqli_fetch_array($datasql, 1)) {
				$data[] = $row;
			}
			if (isset($data)) {
				for ($i = 0; $i < count($data); $i++) {
					$id_tp = $data[$i]['id_tp'];

					$sql_them_ctkm = "INSERT INTO thanh_phan_mon_an(id_tp,id_mon_an,gia_tri) 
			     VALUE('" . $id_tp . "','" . $_GET['idMon'] . "','" . $thso[1] . "')";
					$query = mysqli_query($mysqli, $sql_them_ctkm);
					print_r($data);
				}
			} else {
				break;
			}
		}
	} else {
		$sql_update = "UPDATE mon_an SET id_loai_mon_an='" . $loaimonan . "', ten_mon_an='" . $tenmonan . "' ,soluong='" . $soluong . "', trang_thai='" . $trangthai . "',mo_ta_mon='" . $mota . "' WHERE id_mon_an='$_GET[idMon]'";
		$sql_update1 = "UPDATE gia SET gia='" . $gia . "',ngay='" . $d . "' WHERE id_mon_an='$_GET[idMon]'";
		foreach ($ts as $tso) {
			unset($thso);
			unset($data);
			$thso = explode(': ', $tso);
			$thso[0] = trim($thso[0]);
			$query = "SELECT `id_tp` FROM `thanh_phan` WHERE `ten_tp`='" . $thso[0] . "'";
			$datasql = mysqli_query($mysqli, $query);
			while ($row = mysqli_fetch_array($datasql, 1)) {
				$data[] = $row;
			}
			if (isset($data)) {
				for ($i = 0; $i < count($data); $i++) {
					$id_tp = $data[$i]['id_tp'];

					$sql_them_ctkm = "INSERT INTO thanh_phan_mon_an(id_tp,id_mon_an,gia_tri) 
			     VALUE('" . $id_tp . "','" . $_GET['idMon'] . "','" . $thso[1] . "')";
					$query = mysqli_query($mysqli, $sql_them_ctkm);
					print_r($data);
				}
			} else {
				break;
			}
		}
	}

	$edit = mysqli_query($mysqli, $sql_update);
	if ($edit && $edit1) {
		$_SESSION['message_edit_mon'] = 'Sửa thành công';
		header('Location:../../index.php?action=quanlymonan&query=danhsach');
		exit(0);
	} else {
		$_SESSION['message_edit_mon'] = 'Sửa thất bại';
		header('Location:../../index.php?action=quanlymonan&query=danhsach');
		exit(0);
	}
}

if (isset($_POST['id_loai'])) {
	$idloai = $_POST['id_loai'];
	$sql_lietke_sp = "SELECT DISTINCT *FROM mon_an AS m, loai_mon_an AS lm, gia AS g
WHERE (m.id_loai_mon_an = lm.id_loai_mon_an) AND (m.id_mon_an = g.id_mon_an) AND m.id_loai_mon_an= $idloai ORDER BY m.id_mon_an DESC";
	$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
	$num = mysqli_num_rows($query_lietke_sp);
	if ($num > 0) {
?>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th> STT </th>
							<th>Tên món ăn</th>
							<th>Ảnh món ăn</th>
							<th>Giá</th>
							<th>Mô tả</th>
							<th style="width: 114px;">Khuyến mãi</th>
							<th style=" width: 101px;">Trạng thái</th>
							<th colspan="2">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						while ($row = mysqli_fetch_array($query_lietke_sp)) {
							$i++;
						?>
							<tr>
								<td> <?php echo $i ?></td>
								<!-- <td><?php echo $row['ten_loai_mon_an'] ?></td> -->
								<td> <?php echo $row['ten_mon_an'] ?></td>
								<td> <img src="includes/quanlymonan/uploads/<?php echo $row['anh_mon_an'] ?>" width="200px" height="150px"> </td>
								<td><?php echo number_format($row['gia'], 0, ',', '.') . 'đ'; ?></td>
								<!-- <td>
                                        <?php
										if ($row['soluong'] > 0) {
											echo $row['soluong'];
										} else {
											echo 0;
										}
										?>
                                    </td> -->
								<td><?php echo $row['mo_ta_mon'] ?></td>


								<script>
									function getdataidkm() {
										var id_monan_km = id_monan_km_xoa;
										$.ajax({
											url: "includes/quanlymonan/sua.php",
											type: "POST",
											data: {
												id_monan_km: id_monan_km
											},
											success: function(data) {
												$(".hienbanxoa").html(data);
											}
										})
									}
								</script>
								<td>
									<?php
									$sql_khuyenmai = "SELECT DISTINCT* FROM mon_an,chi_tiet_khuyen_mai,khuyen_mai where 
                                         khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and  mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and chi_tiet_khuyen_mai.id_mon_an='" . $row['id_mon_an'] . "'";
									$query_km = mysqli_query($mysqli, $sql_khuyenmai);
									$row_km = mysqli_fetch_array($query_km);
									$today = date('Y-m-d 00:00:00');
									if (isset($row_km['id_km'])) {
										if ($row_km['ngay_kt'] > $today) {
									?>
											<p style="text-align: center;">
												<?php
												$ten = $row_km['ten_km'];
												$giakm = $row_km['gia_tri_khuyen_mai'];
												?>
												<?php echo $ten ?><br>
												<span><?php echo number_format($giakm, 0, ',', '.') . 'đ'; ?></span><br>
											</p>
										<?php

										}
									} else {
										?>

									<?php
									}
									?>
								</td>
								<td>
									<?php if ($row['soluong'] > 0) {
										echo 'Sẳn hàng';
									} elseif ($row['soluong'] <= 0) {
										echo 'Hết hàng';
										$sqlupdate2 = "UPDATE mon_an SET trang_thai= 2 WHERE id_mon_an= '" . $row['id_mon_an'] . "'";
										$queryupdatekhuyenmai2 = mysqli_query($mysqli, $sqlupdate2);
									} ?>

								</td>
								<td style="width: 128px; padding: 5px;">
									<a class="btn" data-toggle="modal" data-target="#onmodalupdate" style="font-size: 23px;color: #4e73df;padding:0px;padding-left:10px" onclick="getdata(id_mon=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-info btn-sm">Sửa</button></a>
									<div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document" style="max-width:650px">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Sửa món ăn</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body2">
												</div>
											</div>
										</div>
									</div>
									<a class="btn" data-target="#logoutModal1" data-toggle="modal" style="color: #ff3333;font-size: 23px;padding:0px" onclick="getdataxoa(id_monan=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></a>
									<div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa món ăn?</h5>
													<button class="close" type="button" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-bodyxoamonan"></div>
											</div>
										</div>
									</div>
									<hr style=" margin: 6px;">
									<?php
									if (isset($row_km['id_km'])) {
									?>
										<div>
											<a class=" btn" data-target="#logoutModal1_XOA" data-toggle="modal" style="color: #4e73df;font-size: 13px;display: block;padding:8px;" onclick="getdataidkm(id_monan_km_xoa=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-warning btn-sm">Xóa KM</button></a>
											<div class="modal fade" id="logoutModal1_XOA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="hienbanxoa">
														</div>

													</div>
												</div>
											</div>
										</div>
									<?php
									} else {
									?>
										<div>
											<a class=" btn" data-target="#logoutModal1_them" data-toggle="modal" style="color: #4e73df;font-size: 13px;display: block;padding: 5px 0px;" onclick="getdataaddkm(id_monan=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Thêm KM</button></a>
											<div class="modal fade" id="logoutModal1_them" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="add_km">
														</div>

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
		</div>
	<?php
	}
} elseif (isset($_POST['input'])) {
	$input = $_POST['input'];
	$sql_search_tenmon = "SELECT DISTINCT *FROM mon_an AS m, loai_mon_an AS lm, gia AS g
WHERE (m.id_loai_mon_an = lm.id_loai_mon_an) AND (m.id_mon_an = g.id_mon_an) AND m.ten_mon_an LIKE '{$input}%' ";
	$result_search_tenmon = mysqli_query($mysqli, $sql_search_tenmon);
	$num1 = mysqli_num_rows($result_search_tenmon);
	if ($num1 > 0) {
	?>
		<div class="card-body" id="all1">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th> STT </th>
							<th>Tên món ăn</th>
							<th>Ảnh món ăn</th>
							<th>Giá</th>
							<th>Mô tả</th>
							<th style="width: 114px;">Khuyến mãi</th>
							<th style=" width: 101px;">Trạng thái</th>
							<th colspan="2">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						while ($row = mysqli_fetch_array($result_search_tenmon)) {
							$i++;
						?>
							<tr>
								<td> <?php echo $i ?></td>
								<!-- <td><?php echo $row['ten_loai_mon_an'] ?></td> -->
								<td> <?php echo $row['ten_mon_an'] ?></td>
								<td> <img src="includes/quanlymonan/uploads/<?php echo $row['anh_mon_an'] ?>" width="200px" height="150px"> </td>
								<td><?php echo number_format($row['gia'], 0, ',', '.') . 'đ'; ?></td>
								<!-- <td>
                                        <?php
										if ($row['soluong'] > 0) {
											echo $row['soluong'];
										} else {
											echo 0;
										}
										?>
                                    </td> -->
								<td><?php echo $row['mo_ta_mon'] ?></td>
								<script>
									function getdataidkm() {
										var id_monan_km = id_monan_km_xoa;
										$.ajax({
											url: "includes/quanlymonan/sua.php",
											type: "POST",
											data: {
												id_monan_km: id_monan_km
											},
											success: function(data) {
												$(".hienbanxoa").html(data);
											}
										})
									}
								</script>
								<td>
									<?php
									$sql_khuyenmai = "SELECT DISTINCT* FROM mon_an,chi_tiet_khuyen_mai,khuyen_mai where 
                                         khuyen_mai.id_km= chi_tiet_khuyen_mai.id_km and  mon_an.id_mon_an=chi_tiet_khuyen_mai.id_mon_an and chi_tiet_khuyen_mai.id_mon_an='" . $row['id_mon_an'] . "'";
									$query_km = mysqli_query($mysqli, $sql_khuyenmai);
									$row_km = mysqli_fetch_array($query_km);
									$today = date('Y-m-d 00:00:00');
									if (isset($row_km['id_km'])) {
										if ($row_km['ngay_kt'] > $today) {

									?>
											<p style="text-align: center;">
												<?php
												$ten = $row_km['ten_km'];
												$giakm = $row_km['gia_tri_khuyen_mai'];
												?>
												<?php echo $ten ?><br>
												<span><?php echo number_format($giakm, 0, ',', '.') . 'đ'; ?></span><br>
											</p>
										<?php

										}
									} else {
										?>

									<?php
									}
									?>
								</td>
								<td>
									<?php if ($row['soluong'] > 0) {
										echo 'Sẳn hàng';
									} elseif ($row['soluong'] <= 0) {
										echo 'Hết hàng';
										$sqlupdate2 = "UPDATE mon_an SET trang_thai= 2 WHERE id_mon_an= '" . $row['id_mon_an'] . "'";
										$queryupdatekhuyenmai2 = mysqli_query($mysqli, $sqlupdate2);
									} ?>

								</td>
								<td style="width: 128px; padding: 5px;">
									<a class="btn" data-toggle="modal" data-target="#onmodalupdate" style="font-size: 23px;color: #4e73df;padding:0px;padding-left:10px" onclick="getdata(id_mon=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-info btn-sm">Sửa</button></a>
									<div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document" style="max-width:650px">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Sửa món ăn</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body2">
												</div>
											</div>
										</div>
									</div>
									<a class="btn" data-target="#logoutModal1" data-toggle="modal" style="color: #ff3333;font-size: 23px;padding:0px" onclick="getdataxoa(id_monan=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></a>
									<div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa món ăn?</h5>
													<button class="close" type="button" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-bodyxoamonan"></div>
											</div>
										</div>
									</div>
									<hr style=" margin: 6px;">
									<?php
									if (isset($row_km['id_km'])) {
									?>
										<div>
											<a class=" btn" data-target="#logoutModal1_XOA" data-toggle="modal" style="color: #4e73df;font-size: 13px;display: block;padding:8px;" onclick="getdataidkm(id_monan_km_xoa=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-warning btn-sm">Xóa KM</button></a>
											<div class="modal fade" id="logoutModal1_XOA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="hienbanxoa">
														</div>

													</div>
												</div>
											</div>
										</div>
									<?php
									} else {
									?>
										<div>
											<a class=" btn" data-target="#logoutModal1_them" data-toggle="modal" style="color: #4e73df;font-size: 13px;display: block;padding: 5px 0px;" onclick="getdataaddkm(id_monan=<?php echo $row['id_mon_an'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Thêm KM</button></a>
											<div class="modal fade" id="logoutModal1_them" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="add_km">
														</div>

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
		</div>

	<?php
	} else {
	?>
		<div class="card-body" id="all1">
			<div class="table-responsive">
				<table id="datatableid" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th> STT </th>
							<!-- <th> Loại món ăn</th> -->
							<th>Tên món ăn</th>
							<th>Ảnh món ăn</th>
							<th>Giá</th>
							<!-- <th>Số lượng</th> -->
							<th>Mô tả</th>
							<th style="width: 114px;">Khuyến mãi</th>
							<th colspan="2">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<!-- <td></td> -->
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
	}
} elseif (isset($_POST['Id_Mon_an'])) {
	$idmonanxoa = $_POST['Id_Mon_an'];
	$sql_xoa = "SELECT * FROM mon_an WHERE id_mon_an = '$idmonanxoa' LIMIT 1";
	$query_mon_xoa = mysqli_query($mysqli, $sql_xoa);
	$numxoa = mysqli_num_rows($query_mon_xoa);
	if ($numxoa > 0) {

		while ($row_monan_xoa = mysqli_fetch_array($query_mon_xoa)) {
		?>
			<div class="form-group">
				<div class="modal-body">
					<p>Chọn "Xóa" để xóa món ăn: <span style="color: red ;"><?php echo $row_monan_xoa['ten_mon_an'] ?></span></p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
					<form action="" method="POST">
						<a href="includes/quanlymonan/xuly.php?idMon=<?php echo $row_monan_xoa['id_mon_an'] ?>" class="btn btn-primary">Xóa</a>
					</form>
				</div>
			</div>
<?php
		}
	}
} elseif (isset($_POST['addkmmonan'])) {
	$sl_km= $_POST['soluong_km'];
	$id_monan_km = $_GET['idmonankm'];
	$km = $_POST['km'];
	$gtkm = $_POST['gia_tri'];
	$sql_addkm = "INSERT INTO chi_tiet_khuyen_mai(id_km,id_mon_an,gia_tri_khuyen_mai,soluong_km) 
		VALUE('" . $km . "','" . $id_monan_km . "','" . $gtkm . "','" . $sl_km . "')";
	$query_addkm = mysqli_query($mysqli, $sql_addkm);
	if ($query_addkm) {
		$_SESSION['message_add_mon'] = 'Thêm khuyến mãi thành công';
		header('Location:../../index.php?action=quanlymonan&query=danhsach');
		exit(0);
	}
} else {
	$id = $_GET['idMon'];
	// $trangthai = 3;
	$sql_update_trang_thai_mon = "UPDATE mon_an SET trang_thai= 3  WHERE id_mon_an=$id";
	// $sql = "SELECT * FROM mon_an WHERE id_mon_an = '$id' LIMIT 1";
	$query_an = mysqli_query($mysqli, $sql_update_trang_thai_mon);

	if ($query_an) {
		$_SESSION['message_delete'] = 'Xóa thành công';
		header('Location:../../index.php?action=quanlymonan&query=danhsach');
		exit(0);
	}
}
