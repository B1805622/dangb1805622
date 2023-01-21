<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<?php
session_start();
$sql_thanhpho = "SELECT * FROM devvn_tinhthanhpho ORDER BY Ten_tp ASC";
$query_thanhpho = mysqli_query($mysqli, $sql_thanhpho);
?>
<div style="padding-top: 88px;">
    <div class="form-group">
        <label>Tỉnh thành phố</label>
        <select name="id_tp" style="width: 100%" class="form-control city" id="select">
            <option selected>Tỉnh thành phố</option>
            <?php
            while ($row_tp = mysqli_fetch_array($query_thanhpho)) {
            ?>
                <option value="<?php echo $row_tp['idtp'] ?>"><?php echo $row_tp['Ten_tp'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Quận/huyện</label>
        <select name="id_qh" style="width: 100%" class="form-control quan" id="select">
            <option>Quận/huyện</option>

        </select>
    </div>
    <div class="form-group">
        <label>Phường xã</label>
        <select name="id_px" style="width: 100%" class="form-control xa" id="select">
            <option selected>Phường xã</option>
            
        </select>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".city").change(function() {
            var id_tinh = $(".city").val();
            // alert(id_tinh);
            $.ajax({
                url: "pages/main/addcart.php",
                type: "POST",
                data: {
                    id_tinh: id_tinh
                },
                success: function(data) {

                    $(".quan").html(data);

                }
            })
        })
        $(".quan").change(function() {
            var id_quan = $(".quan").val();
            // alert(id_tinh);
            $.ajax({
                url: "pages/main/addcart.php",
                type: "POST",
                data: {
                    id_quan: id_quan
                },
                success: function(data) {

                    $(".xa").html(data);

                }
            })
        })
    })
</script>