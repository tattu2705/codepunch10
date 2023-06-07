<?php

        $servername = "dbaas-db-4768168-do-user-14205969-0.b.db.ondigitalocean.com";
        $username = "doadmin";
        $password = "AVNS_OL_u8TrGI3MbcS-7vJJ";
        $dbname = "quanly"; 

        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "quanly"; 
        
        
        $conn = mysqli_connect($servername, $username, $password, $dbname, 25060);

        // $conn = mysqli_connect($servername, $username, $password, $dbname);

    
        if (!$conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }

?>