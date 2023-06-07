<?php
// Khởi động session
session_start();

// Xóa tất cả các session đã lưu
session_unset();
session_destroy();

// Chuyển hướng đến trang đăng nhập
header("Location: login.php");
exit();
?>