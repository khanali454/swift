<?php
$a = $stars;
?>
<div style="display: flex; flex-wrap: nowrap; flex-direction: row">
    <?php
    for ($i = 1; $i <= 10; $i++) {
        if ($i % 2 !== 0) :
            ?>
            <img src="<?php url('INDEX') ?>/storage/stars/star-left<?php echo $i > $stars * 2 ? '-gray' :'' ?>.svg" alt="" width="10" height="20">
        <?php
        else:
            ?>
            <img src="<?php url('INDEX') ?>/storage/stars/star-right<?php echo $i > $stars * 2 ? '-gray' :'' ?>.svg" alt="" width="10" height="20">
        <?php
        endif;
    }
    ?>
</div>