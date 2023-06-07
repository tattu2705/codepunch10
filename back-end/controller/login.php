<?php
header("Loction: logout.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../font-end/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>
    <nav class="nav-bar">
        <div class="logo">
            <h3>FPT University Portal</h3>
        </div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="nav-icons">
            <i class="fa-regular fa-bell" style="color: #000000;"></i>
            <i class="fa-solid fa-bars"></i>
        </div>
    </nav>
    <div class="login">
        <div class="teacher-login">
            <h2>Giáo Viên</h2>
            <form action="teacherWebsite.php" class="dangnhap" method="post">
                Tên Đăng Nhập:<br> <input type="text" name="username" placeholder="Username"><br>
                Mật Khẩu <br> <input type="password" name="password" placeholder="Password"> <br>
                <input type="submit" class="sbm-btn" name="tc_dangnhap" value="Login">
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 'tc_failed') {
                    echo '<p style="color:red">Tên đăng nhập hoặc mật khẩu không chính xác.</p>';
                }
                ?>
            </form>
        </div>

        <div class="student-login">
            <h2>Học Sinh</h2>
            <form action="studentWebsite.php" class="dangnhap" method="post">
                Tên Đăng Nhập:<br> <input type="text" name="username" placeholder="Username"><br>
                Mật Khẩu <br> <input type="password" name="password" placeholder="Password"> <br>
                <input type="submit" class="sbm-btn" name="st_dangnhap" value="Login">
                <button type="button" class="sbm-btn" data-toggle="modal" data-target="#myModal">
                    Sign Up
                </button>
                <?php
                if (isset($_GET['error'])) {
                    echo "<div style='color:red'>{$_GET['error']}</div>";
                }
                
                if (isset($_GET['msg']) && $_GET['msg'] == 'st_failed') {
                    echo '<p style="color:red">Tên đăng nhập hoặc mật khẩu không chính xác.</p>';
                }
                if(isset($_GET['success']))
                {
                    echo "<p style='color:green'>{$_GET['success']}</p>";
                }
                ?>
            </form>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 style="text-align: center;" class="modal-title">Sign Up</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="add.php" method="post">
                            <input type="hidden" name="header" value="login.php">
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
        </div>
        
    </div>
    </div>

    <script>
    </script>
</body>

</html>