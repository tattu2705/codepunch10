<?php
    include("back-end/dal/DAO.php");
    session_start();
    require_once("checklogin.php");
    if(isset($_POST["upload"]) && isset($_FILES["fileUpload"]) && is_uploaded_file($_FILES["fileUpload"]["tmp_name"]) && isset($_POST["title"]) && isset($_POST["description"])){
        uploadHomework($_FILES["fileUpload"],$_POST["title"], $_POST["description"]);
    }
    else if(isset($_POST["upload"])){
        $error = "fill the field";
        header("Location: homework.php?error=$error");
        exit();
    }

    if(isset($_POST["uploadChallenge"]) && isset($_FILES["fileUpload"]) && is_uploaded_file($_FILES["fileUpload"]["tmp_name"]) && isset($_POST["title"]) && isset($_POST["challenge_hint"]) && isset($_POST["answer"]) && $_POST["Message"])
    {
        uploadChallenge($_POST["title"], $_POST["challenge_hint"], $_FILES["fileUpload"], $_POST["answer"], $_POST["Message"]);
    }
    else if(isset($_POST["uploadChallenge"])){
        $error = "fill the field";
        header("Location: challenge.php?error=?$error");
        exit();
    }

    if(isset($_POST["submit"]) && isset($_POST["answer"]))
    {
        if($_POST["canswer"] === $_POST["answer"]){
            upStudentPass($_SESSION["account"]->id, $_POST["id"]);
        }
    }
    else if(isset($_POST["submit"])){
        header("Location: challenge.php?error");
    }
    
?>