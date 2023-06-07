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
    <link rel="stylesheet" href="../../font-end/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Student Website</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <div class="profile-container">
            <h3>Avatar</h3>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <img src="../image/<?php echo $_SESSION["account"]->imgProfile ?>" alt="Profile Image" width="100" height="100">
                <input type="file" name="imgProfile" id="img" style="display:none">
                <label class="choose-file" for="img">Choose file</label>
                <div class="flexb">
                    <div>
                        <label for="fullName">Full Name:</label><br>
                        <input type="text" id="fullName" name="fullName" value="<?php echo $_SESSION["account"]->fullName ?>" readonly>
                    </div>
                    <div>
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email" value="<?php echo $_SESSION["account"]->email ?>" required><br>
                    </div>
                </div>

                <div class="flexb">
                    <div>
                        <label for="phone">Phone:</label><br>
                        <input type="tel" id="phone" name="phone" value="<?php echo $_SESSION["account"]->phoneNumber ?>"> <br>
                    </div>
                    <div>
                        <label for="username">Username:</label><br>
                        <input type="text" id="username" name="username" value="<?php echo $_SESSION["account"]->username ?>" readonly><br><br>
                    </div>
                </div>
                <input id="save-btn" type="submit" name="profileSave" value="Save">
                <?php
                if (isset($_GET["error"]) && $_GET["error"] == 'invalidemail') {
                    echo "<span style='color: red'>Invalid email</span>";
                }
                if (isset($_GET["error"]) && $_GET["error"] == 'invalidphone') {

                    echo "<span style='color: red'>Invalid phone</span>";
                }
                if (isset($_GET["success"])) {
                    echo "<span style='color: green'>Save Success</span>";
                }
                ?>
            </form>
            
        </div>
            
    </div>



    <script src="../../font-end/js/studentWeb.js"></script>
    <script src="../../font-end/js/script.js"></script>
</body>

</html>