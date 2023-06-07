<?php
    include("../dal/DAO.php");
    session_start();

    if(isset($_POST["add"]) && isset($_POST["header"]))
    {
        $ten_dang_nhap = $_POST['ten_dang_nhap'];

        // echo checkUsernameDuplicate($_POST['ten_dang_nhap']);
        if(checkUsernameDuplicate($_POST['ten_dang_nhap']) === true)
        {
            header("Location: {$_POST['header']}?error=Username has been exist");
            exit();
        }
        $mat_khau = md5($_POST['mat_khau']);
        $Ho_va_ten = $_POST['Ho_va_ten'];
        $Email = $_POST['Email'];
        $So_dien_thoai = $_POST['So_dien_thoai'];
        if (!preg_match("/^[a-zA-Z0-9_\-]{4,20}$/", $ten_dang_nhap))
        {
            $em = "Something is wrong with username input";
            header("Location: {$_POST['header']}?error=$em");
            exit();
        }
        if(!preg_match("/^[a-f0-9]{8,32}$/", $mat_khau)){
            $em = "Password must have more than 7 letter";
            header("Location: {$_POST['header']}?error=$em");
            exit();
        }
        if(!preg_match("/^[a-zA-ZÀ-ỹ\s]{4,50}$/u", $Ho_va_ten)){
            $em = "Name format not right, try again!";
            header("Location: {$_POST['header']}?error=$em");
            exit();
        }
        if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/ ", $Email))
        {
            $em = "Email format not right, try again!";
            header("Location: {$_POST['header']}?error=$em");
            exit();
        }
        if(!preg_match("/^[0-9]{10}$/", $So_dien_thoai))
        {
            $em = "Phone number must have exactly 10 digit!";
            header("Location: {$_POST['header']}?error=$em");
            exit();
        }
        

        addStudent($ten_dang_nhap, $mat_khau, $Ho_va_ten, $Email, $So_dien_thoai);
        $su = "Sign up successfully";
        header("Location: {$_POST['header']}?success=$su");
        exit();
    }
?>