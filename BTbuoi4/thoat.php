<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php
        session_unset();
        session_destroy();
        ?>
        <p><a href="login.php">Trang chủ</a></p>
</body>
</html>