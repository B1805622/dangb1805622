<div id="backtop">
    <i class="fas fa-chevron-up"></i>
</div>

</div>
<style>
    #backtop {
        width: 50px;
        height: 50px;
        background: #222831;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        position: fixed;
        bottom: 10%;
        right: 3%;
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