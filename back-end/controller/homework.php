<?php
include("../dal/DAO.php");
session_start();
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
    <link rel="stylesheet" href="../../font-end/css/homework.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Student Website</title>
</head>

<body>
    <?php include('header.php') ?>
    <?php 
    if($_SESSION["account"]->type === "teacher"){
        echo '<h1 style="text-align: center;">Homework</h1>
        <form style="text-align: center" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Title" name="title">
            <br>
            <input type="text" placeholder="Description" name="description"><br>
            <input type="file" name="fileUpload" id="file-upload"><br>
            <input type="submit" name="upload" value="upload">
            <a href="../upload/"></a>';
        
    if(isset($_GET["error"])){
        echo "<span style='color: red'>{$_GET['error']}</span>";
    }
    echo '</form>';
    }
    ?>
    
    <div class="homework-list">
        <?php
        $homeworks = getAllQuestion();
        foreach ($homeworks as $homework) {
            echo "<div class='homework-item'>
              <div class='homework-title'>$homework->title</div>
              <div class='homework-description'>$homework->description</div>
              <a href='../upload/$homework->fileUpload' download>Material</a>
              <form><input type='file' name='uploadFile'> <input type='submit' value='submit'></form>
            </div>";
        }
        
        ?>
    </div>
    <script src="../../font-end/js/studentWeb.js"></script>
    <script src="../../font-end/js/script.js"></script>
</body>

</html>