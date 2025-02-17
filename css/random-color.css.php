<?php
    header("Content-type: text/css");

    function getRandomColor(){
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
?>

.avatar {
    background-color: <?php echo getRandomColor(); ?>
}