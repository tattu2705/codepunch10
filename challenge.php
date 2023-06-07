<?php
include("back-end/dal/DAO.php");
session_start();
require_once("checklogin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-end/css/style.css">
    <link rel="stylesheet" href="font-end/css/header.css">
    <link rel="stylesheet" href="font-end/css/challenge.css">
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
    if ($_SESSION["account"]->type === "teacher") {
        echo '
        <div class="flexbox">
            <div class="upload-form">
                <h2>Upload challenge</h2>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="challenge_name">Challenge name</label>
                        <input type="text" name="title" id="challenge_name" required>
                    </div>
            
                    <div class="form-group">
                        <label for="challenge_hint">Hint:</label>
                        <input type="text" name="challenge_hint" id="challenge_hint" required>
                    </div>
            
                    <div class="form-group">
                        <label for="answer_or_message">Answer</label>
                        <input type="text" name="answer" id="answer_or_message" required>
                    </div>

                    <div class="form-group">
                        <label for="Message">Message</label>
                        <input type="text" name="Message" id="Message" required>
                    </div>
            
                    <div class="form-group">
                        <label for="fileToUpload">File challenge</label>
                        <input type="file" name="fileUpload" id="fileToUpload" required>
                    </div>
            
                    <div class="form-group">
                        <input type="submit" value="Upload Challenge" name="uploadChallenge">
                    </div>
                </form>
            </div>
                <div>
                    <h2>Danh sách sinh viên đã submit Challenge Đúng</h2>';
                    
            $objects = getAllStudentPass();
            if($objects !== null){
                echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Challenge Name</th>
                </tr>";
                foreach($objects as $object){
                    echo "<tr>
                    <td>{$object[0]}</td>
                    <td>{$object[1]}</td>
                    <td>{$object[2]}</td>
                    </tr>";
                }
            }
            echo "</table>";
            echo'
                </div>
            </div>
            ';
    }

    $challenges = getAllChallenge();
    foreach ($challenges as $challenge) {
        echo "<div class='challenge-item'>
            <h3 class='challenge-title'>Content: $challenge->title</h3>
            <h4 class='challenge-description'>Hint: $challenge->hint</h4>
            Material: <a href='../challenge/$challenge->challenge_file' download >this file</a>
            <form method='POST' action='upload.php'>
                <input type='hidden' name='canswer' value='$challenge->answer'>
                <input type='hidden' name='id' value='$challenge->id'>
                <input style='border: 1px solid black;' type='text' name='answer' placeholder='answer'> 
                <input type='submit' name='submit' value='submit'>
            </form>";
        if(isset($_GET["success"]))
        {
            echo "<h3 style='color:green'>{$_GET['success']}<h3>";
        }
        if(isset($_GET["fail"]))
        {
            echo "<h3 style='color:red'>{$_GET['fail']}<h3>";
        }
        echo "</div>";
    }
    ?>

    <script src="font-end/js/studentWeb.js"></script>
    <script src="font-end/js/script.js"></script>
</body>

</html>