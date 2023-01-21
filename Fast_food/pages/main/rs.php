<style>
    .headermain {
        display: none;
    }

    .footer_section {
        display: none;
    }

    table tr td {
        border: none;
        padding-right: 10px;
    }

    table {
        width: 100%;
        /* text-align: center; */


    }

    .content {
        padding: 30px;
    }

    .th1 {
        padding-bottom: 20px;
        text-align: center;
    }

    .vien1 {
        border: 1px solid black;
        border-radius: 4px;
        position: absolute;
        top: 126px;
        width: 25%;
        left: 20px;

    }

    .vien2 {
        border: 1px solid black;
        border-radius: 4px;
        position: absolute;
        top: 126px;
        width: 25%;

    }

    .vien3 {
        border: 1px solid black;
        border-radius: 4px;
        position: absolute;
        top: 126px;
        width: 25%;
     
    }

    th {
        text-align: center;
    }

    .giua {
        padding-left: 25px;
    }

    .giua1 {
        text-align: center;
    }
</style>
<?php

include("recommend.php");

$sql = "SELECT *FROM binh_luan_danh_gia,mon_an where binh_luan_danh_gia.id_mon_an=mon_an.id_mon_an";
$reusult = mysqli_query($mysqli, $sql);
$matrix = array();

while ($movie = mysqli_fetch_array($reusult)) {
    $sql_user = "SELECT ten_kh FROM khach_hang where id_kh='" . $movie['id_kh'] . "'";
    $reusult_user = mysqli_query($mysqli, $sql_user);
    $username = mysqli_fetch_array($reusult_user);
    $matrix[$username['ten_kh']][$movie['ten_mon_an']] = $movie['diem_dg'];
}
// print_r("<pre>");
// print_r($matrix);
// print_r("/<pre>");
$sql_user = "SELECT * FROM khach_hang where id_kh='" . $_SESSION['id_kh'] . "'";
$reusult_user = mysqli_query($mysqli, $sql_user);
$username = mysqli_fetch_array($reusult_user);
$recommendation = array();
$recommendation = getRecommendation($matrix, $username['ten_kh']);

if (isset($_SESSION['id_kh'])) {
?>
    <table>
        <tr>
            <th colspan="3" class="th1">
                <h3> Hệ thống gợi ý sản phẩm</h3>
            </th>
        </tr>
        <tr>
            <?php
            $sqlkh = "SELECT * FROM `khach_hang` Where id_kh='" . $_SESSION['id_kh'] . "'";
            $query_kh = mysqli_query($mysqli, $sqlkh);
            $row_kh = mysqli_fetch_array($query_kh);
            ?>
            <td style="width: 456px;font-weight: 600; text-align: center;">Danh sách món ăn <span style="color:red"><?php echo $row_kh['ten_kh'] ?> </span> đã đánh giá</td>
            <td style="width: 433px;font-weight: 600;text-align: center;">Danh sách người dùng tương tự</td>
            <td style="width: 433px;font-weight: 600;text-align: center;">Danh sách sản phẩm gợi ý</td>
        </tr>
        <tr>
            <td>
                <div class="vien1">
                    <table>
                        <tr>
                            <th>Tên món ăn</th>
                            <th>Điểm đánh giá</th>
                        </tr>
                        <?php
                        $sql_bldg = "SELECT * FROM `binh_luan_danh_gia`,mon_an,khach_hang WHERE khach_hang.id_kh=binh_luan_danh_gia.id_kh and mon_an.id_mon_an=binh_luan_danh_gia.id_mon_an and khach_hang.ten_kh='" . $row_kh['ten_kh'] . "' ";
                        $query_bldg = mysqli_query($mysqli, $sql_bldg);

                        while ($row = mysqli_fetch_array($query_bldg)) {
                        ?>
                            <tr>
                                <td class="giua"><?php echo $row['ten_mon_an'] ?></td>
                                <td class="giua1"><?php echo $row['diem_dg'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </td>
            <td>
                <div class="vien3">
                    <table>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Độ tương tự</th>
                        </tr>
                        <?php
                        $recommendation1 = array();
                        $recommendation1 = getRecommendation1($matrix, $username['ten_kh']);
                        $array = array_diff($recommendation1, ["0", "-1"]);
                        foreach ($array as $users => $do) {

                        ?>
                            <tr>
                                <td class="giua"><?php echo $users; ?></td>
                                <td class="giua1"><?php echo $do; ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                </div>

            </td>
            <td>
                <?php
                if (!isset($_SESSION['id_kh'])) {
                } else {

                ?>
                    <div class="vien2">
                        <table>
                            <tr>
                                <th>Tên món ăn</th>
                                <th>Điểm đánh giá dự đoán</th>
                            </tr>
                            <?php
                            if ($recommendation == 0) {
                            } else {
                                foreach ($recommendation as $movie => $rating) {
                            ?>
                                    <tr>
                                        <td class="giua"><?php echo $movie; ?></td>
                                        <td class="giua1"><?php echo $rating; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                <?php
                }
                ?>
            </td>
        </tr>

    </table>
<?php
} else {
    echo 0;
}
?>