<?php
    session_start();
    echo "LOGOUT";
    $ses_adid=$_SESSION["admin_id"];
    $ses_status=$_SESSION["status"];
    if(isset($ses_adid)==true&&isset($ses_status)==true){
        session_unset();
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/shop/admin.php'>";
    }
?>