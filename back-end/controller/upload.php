<?php
    include("../dal/DAO.php");
    session_start();
    require_once("checklogin.php");
    if(isset($_POST["upload"]) && isset($_FILES["fileUpload"]) && is_uploaded_file($_FILES["fileUpload"]["tmp_name"]) && isset($_POST["title"]) && isset($_POST["description"])){
        uploadFile($_FILES["fileUpload"],$_POST["title"], $_POST["description"]);
    }
    else{
        $error = "fill the field";
        header("Location: homework.php?error=$error");
    }
    
?>