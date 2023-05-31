<?php
include("../dal/DAO.php");
session_start();
if (isset($_POST["st_dangnhap"])) {
    $student = getStudentByLogin($_POST["username"], md5($_POST["password"]));
    if ($student == null) {
        header("Location: login.php?msg=st_failed");
        exit();
    }
    $_SESSION["account"] = $student;
}
require_once("checklogin.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../font-end/css/style.css">
    <link rel="stylesheet" href="../../font-end/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Student Website</title>
</head>

<body>
    <?php include('header.php') ?>
    <h1>Hello <?php echo $_SESSION["account"]->fullName; ?></h1>
    
    <script src="../../font-end/js/studentWeb.js"></script>
    <script src="../../font-end/js/script.js"></script>
</body>
</html>