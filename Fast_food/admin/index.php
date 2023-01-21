<?php
session_start();
if (!isset($_SESSION['dangnhap'])) {
  header("Location:login.php");
}
?>
<?php

if (isset($_SESSION['message1'])) {
?>
  <div id="toast1" onclick="myFunction()">
    <div class="toast1 toast1--success">
      <div class="toast1__icon">
        <i class="fas fa-check-circle"></i>
      </div>
      <div class="toast1__body1">
        <strong class="toast1__title"><?= $_SESSION['message1']; ?>!</strong>
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
  </script>
<?php
  unset($_SESSION['message1']);
}
?>
<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  body {
    padding-right: 0px !important;
  }

  #toast1 {
    position: fixed;
    top: 32px;
    right: 32px;
    z-index: 999999;

  }

  .toast1 {
    display: flex;
    align-items: center;
    background-color: #fff;
    border-radius: 2px;
    padding: 11px 0;
    min-width: 400px;
    max-width: 450px;
    border-left: 4px solid;
    box-shadow: 0 5px 8px rgba(0, 0, 0, 0.08);
    animation: slideInLeft ease .3s;
  }

  @keyframes slideInLeft {
    from {
      opacity: 0;
      transform: translateX(calc(100% + 32px));
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes fadeOut {
    to {
      opacity: 0;
    }
  }

  .toast1--success {
    border-color: #47d864;
  }

  .toast1--success .toast1__icon {
    color: #47d864;
  }

  .toast1+.toast1 {
    margin-top: 24px;
  }

  .toast1__icon {
    font-size: 24px;
  }

  .toast1__icon,
  .toast1__close {
    padding: 0 16px;
  }

  .toast1__body1 {
    flex-grow: 1;
    padding-top: 16px;
  }

  .toast1__title {
    font-size: 16px;
    font-weight: 600;
    color: #333;
  }

  .toast1__msg {
    font-size: 14px;
    color: #888;
    margin-top: 6px;
    line-height: 1.5;
  }

  .toast1__close {
    font-size: 20px;
    color: rgba(0, 0, 0, 0.3);
    cursor: pointer;
  }
</style>
<?php
include('includes/header.php');
// include('includes/navbar.php');
include('includes/config.php');
// include('includes/menu.php');
include('includes/main.php');
// include('includes/scripts.php');
// include('includes/footer.php');
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>