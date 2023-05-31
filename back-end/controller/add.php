<?php
    include("../dal/DAO.php");
    session_start();
    require_once("checklogin.php");

    
    if(isset($_POST["add"]))
    {
        $ten_dang_nhap = $_POST['ten_dang_nhap'];
        $mat_khau = md5($_POST['mat_khau']);
        $Ho_va_ten = $_POST['Ho_va_ten'];
        $Email = $_POST['Email'];
        $So_dien_thoai = $_POST['So_dien_thoai'];
        if (!preg_match("/^[a-zA-Z0-9_\-]{4,20}$/", $ten_dang_nhap) || !preg_match("/^[a-f0-9]{32}$/", $mat_khau) || !preg_match("/^[a-zA-ZÀ-ỹ\s]{4,50}$/u", $Ho_va_ten) || !preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/ ", $Email) || !preg_match("/^[0-9]{10}$/", $So_dien_thoai))
        {
            $em = "Something is wrong with your input data";
            header("location: list.php?error=$em");
            exit();
        }

        addStudent($ten_dang_nhap, $mat_khau, $Ho_va_ten, $Email, $So_dien_thoai);
    }
?>