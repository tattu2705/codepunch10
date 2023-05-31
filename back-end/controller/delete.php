<?php 
    include("../dal/DAO.php");
    session_start();
    require_once("checklogin.php");
    if($_POST["delete"] && $_POST["id"]){
        deleteStudentByID($_POST["id"]);
    }

?>