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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Student Website</title>
</head>

<body>
    <?php include('header.php') ?>
    <?php

    $students = getAll();
    if ($students !== null) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>";

        if ($_SESSION["account"]->type === "teacher") {
            echo "<th>Username</th>
            <th>Password</th>
            <th>Action</th>";
        }

        echo "</tr>";

        foreach ($students as $student) {
            echo "<tr>
                    <td>{$student->id}</td>
                    <td>{$student->fullName}</td>
                    <td>{$student->email}</td>
                    <td>{$student->phoneNumber}</td>";

            if ($_SESSION["account"]->type === "teacher") {
                echo "
                <td>{$student->username}</td>
                <td>{$student->password}</td>
                <td>
                        <form method='post' action='updateStudent.php' >
                            <input type='hidden' name='id' value='{$student->id}'>
                            <input type='submit' value='update' name='update'>
                        </form>
                        <form method='post' action='delete.php' onsubmit='return confirmDelete()'>
                            <input type='hidden' name='id' value='{$student->id}'>
                            <input type='submit' value='delete' name='delete'>
                        </form>
                        
                    </td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
    <!-- Button to Open the Modal -->
    <?php
    if ($_SESSION["account"]->type === "teacher") {
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Add Student
    </button>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Student</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="add.php" method="post">
                            <div class="form-group">
                                <label for="ten_dang_nhap">Username</label>
                                <input type="text" id="ten_dang_nhap" class="form-control" name="ten_dang_nhap">
                            </div>
                            <div class="form-group">
                                <label for="mat_khau">Password</label>
                                <input type="password" id="mat_khau" class="form-control" name="mat_khau">
                            </div>
                            <div class="form-group">
                                <label for="Ho_va_ten">Name</label>
                                <input type="text" id="Ho_va_ten" class="form-control" name="Ho_va_ten">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="text" id="Email" class="form-control" name="Email">
                            </div>
                            <div class="form-group">
                                <label for="So_dien_thoai">Phone Number</label>
                                <input type="text" id="So_dien_thoai" class="form-control" name="So_dien_thoai">
                            </div>
                            <button type="submit" name="add" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>';
        }
    ?>



    <script src="../../font-end/js/studentWeb.js">
        
    </script>
    <script src="../../font-end/js/script.js"></script>
</body>

</html>