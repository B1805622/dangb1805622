<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Font-Awesomecss/css/font-awesome.min.css">
    <title>Thông tin cá nhân</title>
    <style>
        .container {
            width: 70%;
            height:700px ;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
            max-width: 380px;
            margin: auto;
            text-align: center;
            font-family: arial;
            padding: 20px;
        }

        .main {
            padding: 0 16px;
        }
        p{
            font-size: 18px;
        }
        .main::after {
            color: #000;
            content: "";
            clear: both;
            display: table;
        }

        a {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 10px;
            color: white;
            background-color:	#00CC66;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
           text-decoration:none;
        }

        a:hover,
        a:hover {
            opacity: 0.4;
        }
    </style>
    <?php
    session_start();
    $id_kh = $_SESSION['ma_kh'];
    $con = new mysqli("localhost", "root", "", "car");
    $con->set_charset("utf8");
    $sql = "SELECT * FROM khachhang WHERE ma_kh='" . $id_kh . "'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    echo "<div class='container'>
        <h2>THÔNG TIN CÁ NHÂN </h2>";
    ?>
    <div class='card'>
        <img src="https://www.pngkey.com/png/full/115-1150152_default-profile-picture-avatar-png-green.png" alt="John" style="width:70%">
        <div class="main">
            <?php
            echo "<h2>Họ tên:" . $row['ten_kh'] ."</h2>
                    <p>Số CMND: " . $row['cmnd_kh'] . "<br>
                    Địa chỉ: " . $row['dia_chi_kh'] . "<br>
                    Số điện thoại: " . $row['sdt_kh'] . "<br>
                    Email: " . $row['email_kh'] . "</p>
                   <a href='./up_info.php'>Cập nhật thông </a>
                   <hr>
                   <a href='../index.php'>Quay Lại </a>
                   
            </div>";
            echo "</div>";
            $con->close();
            ?>
</head>

<body>

</body>

</html>