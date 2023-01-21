<div id="backtop1">
    <a href="index.php?quanly=giohang" class="fa fa-shopping-basket" style="font-size: 24px;color: white;"><span class="numbercart">
            <?php
            if (isset($_SESSION['cart'])) {
                $soluong = (count($_SESSION['cart']));
                echo $soluong;
            } else {
                echo 0;
            }
            ?>
        </span></a>

</div>
<style>
    .numbercart {
        border-radius: 50%;
        background-color: #5F8D4E;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        position: fixed;
        justify-content: center;
        bottom: 106px;
        right: 23px;
        font-size: 16px;
    }

    #backtop1 {
        width: 50px;
        height: 50px;
        background: #222831;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        position: fixed;
        bottom: 70px;
        right: 20px;
    }
</style>
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop()) {
                $('#backtop').fadeIn();
            } else {
                $('#backtop').fadeOut();
            }
        });
        $("#backtop").click(function() {
            $('html,body').animate({
                scrollTop: 0
            }, 600)
        })
    })
</script>
<script src="https://kit.fontawesome.com/72a902116d.js" crossorigin="anonymous"></script>