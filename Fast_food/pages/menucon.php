<?php
$sql_loai_mon_an = "SELECT * FROM loai_mon_an ORDER BY id_loai_mon_an ASC";
$query_loai_mon_an = mysqli_query($mysqli, $sql_loai_mon_an);
?>

<section class="food_sections">
    <div class="menucon">
        <section class="food_sections">
            <div class="container" style="padding-bottom: 22px;">
                <div class="crossbar">
                    <div class="crossbar_grid">
                        <ul class="crossbar_list">
                            <?php
                            while ($row_loai_mon_an = mysqli_fetch_array($query_loai_mon_an)) {
                            ?>
                                <li><a href="#<?php echo $row_loai_mon_an['id_loai_mon_an'] ?>" class="jumper" class="crossbar_item nav-link"><?php echo $row_loai_mon_an['ten_loai_mon_an'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <hr>
    </div>