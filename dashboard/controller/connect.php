<?php
    function connect_bestDB(){
        $conn=mysqli_connect(
            "localhost",
            "root",
            "123456",
            "bestbuydb"
        );
        if(!$conn){
            die("connect database error");
        }
        return $conn;
    }
?>