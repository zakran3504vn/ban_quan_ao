<!-- Phần đăng xuất trang admin 
Yêu cầu khi ấn vào file sẽ chuyển sang trang admin_login
Người làm :Lê Minh Phương
Fixbug,testing:Lê Minh Phương
-->
<?php
session_start();
session_destroy();
echo "<script>window.open('admin_login.php','_self')</script>";
?>