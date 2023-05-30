<?php
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
            </form>
            <?php
            if (isset($_GET['msg']) && $_GET['msg'] == 'st_failed') {
                echo '<p style="color:red">Tên đăng nhập hoặc mật khẩu không chính xác.</p>';
            }
            ?>
        </div>
    </div>
    
    <script>
    </script>
</body>
    
</html>