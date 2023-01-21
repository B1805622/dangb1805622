<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="js/sb-admin-2.min.js"></script> -->
<?php
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = '1';
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 10) - 10;
}
$sql_thongke = "SELECT * FROM thongke ORDER BY ngay_dat DESC LIMIT $begin,10";
$query_thongke = mysqli_query($mysqli, $sql_thongke);
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thống kê doanh thu
            </h6>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <form method="POST" action="includes/thongke/xuly.php" enctype="multipart/form-data"> -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <table>
                        <tr>
                            <td style=" width: 150px;">Thời gian thống kê: </td>
                            <td style=" width: 30px;">Từ</td>
                            <td><input type="date" id="idbd" name="datebd" class="form-control"></td>
                            <td style=" width: 62px;padding-left: 20px;">Đến</td>
                            <td> <input type="date" name="datekt" id="idkt" class="form-control"></td>
                            <!-- <td style=" padding-left: 40px; "><button onclick="add()" name="timdoanhthu" class="btn btn-primary">Thống kê</button></td> -->
                        </tr>
                    </table>
                </ul>
                <button onclick="add()" name="timdoanhthu" class="btn btn-primary">Thống kê</button>
            </div>
            <!-- </form> -->
            <script>
                function add() {
                    var xid = document.getElementById('idbd').value;
                    var yid = document.getElementById('idkt').value;

                    $.ajax({
                        url: "includes/thongke/xuly.php",
                        type: "POST",
                        data: {
                            xid: xid,
                            yid: yid
                        },
                        success: function(data) {
                            $(".searchresult").html(data);
                            document.getElementById('all1').style.display = "none";

                        }
                    })
                }
            </script>
        </nav>
        <div class="searchresult">
            <div class="card-body" id="all1">
                <div class="table-responsive">
                    <table id="datatableid" class="table table-bordered">
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th>Thời gian</th>
                                <th>Tổng đơn hàng</th>
                                <th>Số lượng bán</th>
                                <th>Doanh thu</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($query_thongke)) {
                                $i++;
                            ?>
                                <tr>
                                    <td> <?php echo $i ?></td>
                                    <td><?php
                                        $datebd = date_create($row['ngay_dat']);
                                        echo date_format($datebd, "d-m-Y");
                                        ?></td>
                                    <td> <?php echo $row['donhang'] ?></td>
                                    <td> <?php echo $row['soluongban'] ?></td>
                                    <td> <?php echo number_format($row['doanhthu'], 0, ',', '.') . 'đ'; ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                $sql_trang = mysqli_query($mysqli, "SELECT *FROM thongke");
                $row_count = mysqli_num_rows($sql_trang);
                $trang = ceil($row_count / 10);
                ?>
                <div class="paging">
                    <p style="display: flex;align-items: center;">Tổng số trang <?php echo $trang ?> </p>
                    <ul class="page_list">
                        <?php
                        for ($i = 1; $i <= $trang; $i++) {
                        ?>
                            <li <?php if ($i == $page) {
                                    echo 'style="background-color: #4e73df;"';
                                } else {
                                    echo '';
                                } ?>><a href="index.php?action=thongke&query=danhsach&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    function hien() {
        document.getElementById("demo").style.display = "block";
    }

    function an() {
        document.getElementById("demo").style.display = "none";
    }
</script>
<?php
include('includes/scripts.php');
?>
<div style="clear:both;"></div>
<style type="text/css">
    .paging {
        display: flex;
        justify-content: flex-end;
    }

    ul.page_list {
        padding-left: 0;
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