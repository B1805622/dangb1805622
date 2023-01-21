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
    $begin = ($page * 5) - 5;
}
$sql_lietke_loai_mon = "SELECT * FROM thanh_phan ORDER BY id_tp DESC LIMIT $begin,5";
$query_lietke_loai_mon = mysqli_query($mysqli, $sql_lietke_loai_mon);
?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm thành phần dinh dưỡng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/thanhphan/xuly.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên thành phần</label>
                        <input type="text" name="ten_tp" class="form-control" placeholder="Nhập tên thành phần">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" name="themthanhphan" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- DataTales Example -->
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message']);
    }
    ?>
    <?php
    if (isset($_SESSION['message_edit'])) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?= $_SESSION['message_edit']; ?>!</strong>
        </div>
    <?php
        unset($_SESSION['message_edit']);
    }
    ?>
    <div id="demo" style="display:none;" class="alert alert-danger">
        <a href="#" class="close" onclick="an()" aria-label="close">&times;</a>
        <strong>Không thể xóa</strong>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thành phần dinh dưỡng
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Thêm thành phần mới
                </button>
            </h6>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                </ul>
                <form method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light small" id="searchinput" placeholder="Tên thành phần..." aria-label="Search" name="keyword" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="search">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
        <script>
            $(document).ready(function() {
                $("#searchinput").keyup(function() {
                    var input = $(this).val();
                    // alert(input);
                    if (input != "") {
                        $.ajax({
                            url: "includes/thanhphan/xuly.php",
                            type: "POST",
                            data: {
                                input: input
                            },
                            success: function(data) {
                                // document.getElementById
                                $(".searchresult").html(data);
                                $(".searchresult").css("display", "block");
                                $(".paging").css("display", "none");
                            }
                        })
                    } else {
                        // $(".searchresult").css("display", "none");
                        location.reload(true);
                    }
                })
            })
        </script>
        <div class="searchresult">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatableid" class="table table-bordered">
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th>Tên thành phần</th>
                                <th colspan="2" style=" width: 10%;">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($query_lietke_loai_mon)) {
                                $i++;
                            ?>
                                <tr>
                                    <td> <?php echo $i ?></td>
                                    <td><?php echo $row['ten_tp'] ?></td>
                                    <td>
                                        <a class="btn" style="font-size: 23px;color: #4e73df;padding:0px" data-toggle="modal" data-target="#onmodalupdate" onclick="getdata(idtp=<?php echo $row['id_tp'] ?>)"><button type="button" class="btn btn-outline-warning btn-sm">Sửa</button></a>
                                        <div class="modal fade" id="onmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sửa thành phần dinh dưỡng</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="sualoai">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a class="btn" data-target="#logoutModal1" data-toggle="modal" style="color: #ff3333;font-size: 23px;padding:0px" onclick="getdataxoa(id_tphan=<?php echo $row['id_tp'] ?>)"><button type="button" class="btn btn-outline-danger btn-sm">Xóa</button></i></a>
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
            function getdataxoa() {
                var id_thanhphan = id_tphan;

                $.ajax({
                    url: "includes/thanhphan/xuly.php",
                    type: "POST",
                    data: {
                        id_thanhphan: id_thanhphan
                    },
                    success: function(data) {
                        $(".modal-bodyxoamonan").html(data);
                    }
                })
            }

            function getdata() {
                var id_tp = idtp;
                // alert(IdLoai);
                $.ajax({
                    url: "includes/thanhphan/xuly.php",
                    type: "POST",
                    data: {
                        id_tp: id_tp
                    },
                    success: function(data) {
                        $(".sualoai").html(data);
                    }
                })
            }
        </script>
        <?php
        $sql_trang = mysqli_query($mysqli, "SELECT *FROM thanh_phan");
        $row_count = mysqli_num_rows($sql_trang);
        $trang = ceil($row_count / 5);
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
                        } ?>><a href="index.php?action=thanhphan&query=danhsach&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                }
                ?>
            </ul>
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