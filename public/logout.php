<?php
session_start();
session_destroy();
echo "Вы вышли!</br>";
echo "<a href='index.php'>На главную</a>";
?>
