<?php
    require_once("../dal/DAO.php");
    session_start();
    if(isset($_POST["profileSave"])){
        if(isset($_FILES["imgProfile"]) && is_uploaded_file($_FILES["imgProfile"]["tmp_name"])){
            uploadImg($_FILES["imgProfile"], $_SESSION["account"]->id, $_SESSION["account"]->type);
        }

        if(isset($_POST["email"]) || isset($_POST["phone"])){
            updateInfo($_POST["email"], $_POST["phone"], $_SESSION["account"]->id, $_SESSION["account"]->type,  "Profile.php");
        }
    }

    if(isset($_POST["studentSave"])){
        if(isset($_FILES["imgProfile"]) && is_uploaded_file($_FILES["imgProfile"]["tmp_name"])){
            uploadImg($_FILES["imgProfile"], $_POST["student"]->id, "student");
        }

        if(isset($_POST["email"]) || isset($_POST["phone"])){
            updateInfo($_POST["email"], $_POST["phone"], $_POST["student"]->id, "student", "list.php");
        }
    }

    

    if(isset($_POST["changepass"])){
        if(!empty($_POST["old_password"]) && !empty($_POST["new_password"]) && !empty($_POST["confirm_password"])){
            updatePassword($_POST["old_password"], $_POST["new_password"], $_POST["confirm_password"]);
        }
        else{
            header("Location: changepass.php?error=0");
        }
    }
?>