<?php
if (isset($_SESSION['login-cart'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1" style="border-color: #17a2b8!important">
            <div class="toast1__icon">
                <i class="fa fa-info-circle" style="color:#17a2b8!important"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['login-cart']; ?> !</strong>
                <p class="toast1__msg"></p>
            </div>

            <div class="toast1__close" class="alert alert-success alert-dismissible">
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
    unset($_SESSION['login-cart']);
}
?>
<?php
if (isset($_SESSION['message_kh'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['message_kh']; ?>!</strong>
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
    unset($_SESSION['message_kh']);
}
?>
<?php
if (isset($_SESSION['message_edit_kh'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['message_edit_kh']; ?>!</strong>
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
    unset($_SESSION['message_edit_kh']);
}
?>
<?php
if (isset($_SESSION['message_edit_mk'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['message_edit_mk']; ?>!</strong>
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
    unset($_SESSION['message_edit_mk']);
}
?>
<?php
if (isset($_SESSION['message_gh'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['message_gh']; ?>!</strong>
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
    unset($_SESSION['message_gh']);
}
?>
<?php
if (isset($_SESSION['ss_bl'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['ss_bl']; ?>!</strong>
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
    unset($_SESSION['ss_bl']);
}
?>
<?php
if (isset($_SESSION['ss_reply'])) {
?>
    <div id="toast1" onclick="myFunction()">
        <div class="toast1 toast1--success">
            <div class="toast1__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast1__body1">
                <strong class="toast1__title"><?= $_SESSION['ss_reply']; ?>!</strong>
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
    unset($_SESSION['ss_reply']);
}
?>