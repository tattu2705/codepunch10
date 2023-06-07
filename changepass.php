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
    <link rel="stylesheet" href="font-end/css/changepass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Student Website</title>
</head>

<body>
    <?php include('header.php') ?>

    <div class="container">
        <div class="pass-container">
            <div>
                <h4>Change password</h4>
                <form method="post" action="update.php">
                    <label>Old password</label><br>
                    <input id="op" type="password" name="old_password" placeholder="Password"><br><br>

                    <label>New password</label><br>
                    <input id="np" type="password" name="new_password" placeholder="Password"><br><br>

                    <label>Confirm password</label><br>
                    <input id="cp" type="password" name="confirm_password" placeholder="Confirm"><br><br>

                    <input id="sbm" type="submit" name="changepass" value="Save">
                    <?php
                    if (isset($_GET["error"])) {
                        switch ($_GET["error"]) {
                            case 0:
                                echo "<span style='color:red'>Fill the input</span>";
                                break;
                            case 2:
                                echo "<span style='color:red'>Wrong old password</span>";
                                break;
                            case 3:
                                echo "<span style='color:red'>New password must have above 8 words</span>";
                                break;
                            case 4:
                                echo "<span style='color:red'>New password does not match Confirm Password </span>";
                                break;
                        }
                    }
                    if(isset($_GET["success"])){
                        echo "<span style='color:green'>Save success</span>";
                    }
                    ?>
                </form>
            </div>
        </div>

    </div>



    <script src="font-end/js/studentWeb.js"></script>
    <script src="font-end/js/script.js"></script>
</body>

</html>