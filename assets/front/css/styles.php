<?php
header("Content-type: text/css; charset: UTF-8");
if(isset($_GET['color']))
{
  $color = '#'.$_GET['color'];
}
else {
  $color = '#FF9900';
}
?>

.dark-theme,:root{
    --base-clr: <?php echo $color?>;
}