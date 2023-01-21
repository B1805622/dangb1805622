<?php
include('../../includes/config.php');
session_start();
require('../../../carbon/autoload.php');

use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDatetimeString();
if (isset($_GET['code'])) {
	$ma = $_GET['code'];
	$sql_update = "UPDATE binh_luan_danh_gia SET baocao=2 WHERE id_binh_luan='" . $ma . "'";
	$qurey = mysqli_query($mysqli, $sql_update);
	$_SESSION['message_xoa'] = 'Bình luận đã được xóa thành công';
	header('Location:../../index.php?action=binhluan&query=danhsach');
} elseif (isset($_POST['id_report'])) {
	$key = $_POST['id_report'];
	$sql_lietke_bl = "SELECT DISTINCT* FROM binh_luan_danh_gia AS bldg, khach_hang AS kh, mon_an AS m
WHERE m.id_mon_an=bldg.id_mon_an AND kh.id_kh=bldg.id_kh and bldg.baocao='" . $key . "'  ORDER BY bldg.id_binh_luan";
	$query_id_km = mysqli_query($mysqli, $sql_lietke_bl);
	$num = mysqli_num_rows($query_id_km);
	if ($num > 0) {
?>
		<form action="includes/binhluan/xoa.php" method="POST">
			<button type="submit" name="reportall" class="btn btn-danger" style="position: relative;top: 10px;left: 21px;">Xóa tất cả</button>
		</form>
		<div class="card-body">
			<div class="table-responsive">


				<table id="datatableid" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên khách hàng</th>
							<th>Món ăn</th>
							<th>Nội dung bình luận</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						while ($row = mysqli_fetch_array($query_id_km)) {
							$i++;
						?>
							<tr>
								<td> <?php echo $i ?></td>
								<td><?php echo $row['ten_kh'] ?></td>
								<td><?php echo $row['ten_mon_an'] ?></td>
								<td><?php echo $row['noi_dung'] ?></td>

								<td> <a href="../../Fast_food/index.php?quanly=monan&IdMon=<?php echo $row['id_mon_an'] ?>"><button type="button" class="btn btn-outline-primary btn-sm">Xem</button></a>
									<a href="includes/binhluan/xoa.php?code=<?php echo $row['id_binh_luan'] ?>"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></a>
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
		<div class="card-body">
			<div class="table-responsive">
				<table id="datatableid" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>STT</th>
							<th>Mã bình luận</th>
							<th>Tên khách hàng</th>
							<th>Món ăn</th>
							<th>Nội dung bình luận</th>
							<th>Báo cáo</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tbody>
				</table>
			</div>
		</div>
<?php
	}
} elseif (isset($_POST['reportall'])) {
	$sql_lietke_bl1 = "SELECT DISTINCT* FROM binh_luan_danh_gia AS bldg, khach_hang AS kh, mon_an AS m
WHERE m.id_mon_an=bldg.id_mon_an AND kh.id_kh=bldg.id_kh and bldg.baocao=1";
	$query_id_km1 = mysqli_query($mysqli, $sql_lietke_bl1);
	while ($row1 = mysqli_fetch_array($query_id_km1)) {
		$data[] = $row1;
	}
	for ($i = 0; $i <  count($data); $i++) {
		$id_bl = $data[$i]['id_binh_luan'];
		$sql_update = "UPDATE binh_luan_danh_gia SET baocao=2 WHERE id_binh_luan='" . $id_bl . "'";
		$query = mysqli_query($mysqli, $sql_update);
	}
	$_SESSION['message_xoa'] = 'Bình luận đã được xóa thành công';
	header('Location:../../index.php?action=binhluan&query=danhsach');
}
