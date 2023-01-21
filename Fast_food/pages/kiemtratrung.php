<?php
$con = new mysqli("localhost", "root", "", "fastfood");
$con->set_charset("utf8");
$email = $_GET['d1'];
$sql = "select * from khach_hang where email_kh='$email'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
  echo "Email hợp lệ.";
}else{
  echo "Email Không tồn tại.";
}
$con->close();
