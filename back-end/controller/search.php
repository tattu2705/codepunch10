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
    <link rel="stylesheet" href="../../font-end/css/search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Student Website</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <form>
            <div class="bar">
                <input class="searchbar" type="text" title="search" name="searchWord" placeholder="Student ID">
            </div>
            <button class="button" type="submit">Search</button>
        </form>
        <?php
        if (isset($_GET["searchWord"])) {
            $student = search($_GET["searchWord"], "student");
            if ($student !== null) {
                echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>    
                    <tr>
                        <td>$student->id</td>
                        <td>$student->fullName</td>
                        <td>$student->email</td>
                        <td>$student->phoneNumber</td>
                    </tr>
                </table>";
            }
        }
        ?>
    </div>



    <script src="../../font-end/js/studentWeb.js"></script>
    <script src="../../font-end/js/script.js"></script>
</body>

</html>