<?php

        $servername = "dbaas-db-4768168-do-user-14205969-0.b.db.ondigitalocean.com";
        $username = "doadmin";
        $password = "AVNS_OL_u8TrGI3MbcS-7vJJ";
        $dbname = "quanly"; 
        
        
        $conn = mysqli_connect($servername, $username, $password, $dbname, 25060);
    
        if (!$conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }

?>