<?php
?>
<header>
    <nav class="nav-bar">
        <div class="logo">
            <a class="home" href="studentWebsite.php">FPT University Portal</a>
        </div>
        <ul class="nav-links">
            <li><a href="list.php">List</a></li>
            <li><a href="homework.php">Homework</a></li>
            <li><a href="#">Challenge</a></li>
        </ul>
        <div class="nav-icons">
            <i class="fa-regular fa-bell" style="color: #000000;"></i>
            <i onclick="open_modal()" class="fa-solid fa-gear" style="color:#000000"></i>
        </div>

        <div class="overlay">
            <div class="overlay-model">
                <h4 class="title" style="text-align: center;">Setting</h4>
                <button onclick="close_modal()">
                    Close
                </button>
            </div>
        </div>

        <?php

        if (isset($_SESSION['account'])) {
            echo '<div class="profile-icon">
                <img src="../image/' . $_SESSION['account']->imgProfile . '" alt="Profile Image">
                <div class="dropdown">
                    <ul>
                    <li><a href="search.php">Search User</a></li>
                    <li><a href="Profile.php">Profile</a></li>
                    <li><a href="changepass.php">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>';
        }
        ?>
    </nav>
</header>