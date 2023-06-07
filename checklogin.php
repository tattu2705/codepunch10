<?php
    if(!isset($_SESSION["account"])){
        header("Location: login.php");
    }
?>