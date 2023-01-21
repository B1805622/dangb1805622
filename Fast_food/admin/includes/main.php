<div class="main">
	<?php
	if (isset($_GET['action']) && $_GET['query']) {
		$tam = $_GET['action'];
		$query = $_GET['query'];
	} else {
		$tam = '';
		$query = '';
	}

	if ($tam == 'quanlymonan' && $query == 'danhsach') {
		include("includes/quanlymonan/danhsach.php");
		// include("includes/quanlyloaisp/them.php");
	} elseif ($tam == 'quanlymonan' && $query == 'sua') {
		include("includes/quanlymonan/sua.php");
	} elseif ($tam == 'quanlymonan' && $query == 'timkiem') {
		include("includes/quanlymonan/timkiem.php");
	} elseif ($tam == 'quanlymonan' && $query == 'timkiem2') {
		include("includes/quanlymonan/timkiem2.php");
	} elseif ($tam == 'quanlyloai' && $query == 'danhsach') {
		include("includes/quanlyloai/danhsach.php");
	} elseif ($tam == 'quanlyloai' && $query == 'sua') {
		include("includes/quanlyloai/sua.php");
		// include("includes/quanlyloaisp/them.php");
	} elseif ($tam == 'quanlyloai' && $query == 'timkiem') {
		include("includes/quanlyloai/timkiem.php");
	} elseif ($tam == 'donhang' && $query == 'danhsach') {
		include("includes/donhang/danhsach.php");
	} elseif ($tam == 'donhang' && $query == 'xem') {
		include("includes/donhang/xemdonhang.php");
	} elseif ($tam == 'khuyenmai' && $query == 'danhsach') {
		include("includes/khuyenmai/danhsach.php");
	} elseif ($tam == 'khuyenmai' && $query == 'xem') {
		include("includes/khuyenmai/ctkm.php");
	}  elseif ($tam == 'hoadon' && $query == 'danhsach') {
		include("includes/hoadon/danhsach.php");
	} elseif ($tam == 'hoadon' && $query == 'in') {
		include("includes/hoadon/inhoadon.php");
	} elseif ($tam == 'binhluan' && $query == 'danhsach') {
		include("includes/binhluan/danhsach.php");
	} elseif ($tam == 'khachhang' && $query == 'danhsach') {
		include("includes/khachhang/danhsach.php");
	} elseif ($tam == 'taikhoan' && $query == 'thongtin') {
		include("includes/taikhoan/thongtin.php");
	} elseif ($tam == 'taikhoan' && $query == 'matkhau') {
		include("includes/taikhoan/matkhau.php");
	} elseif ($tam == 'taikhoan' && $query == 'update') {
		include("includes/taikhoan/update.php");
	} elseif ($tam == 'thanhphan' && $query == 'danhsach') {
		include("includes/thanhphan/danhsach.php");
	} elseif ($tam == 'thongke' && $query == 'danhsach') {
		include("includes/thongke/danhsach.php");
	}  else {
		include("includes/dashboard.php");
	}

	?>
</div>
<?php
include('includes/scripts.php');
?>