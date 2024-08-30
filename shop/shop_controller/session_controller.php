<?php
    function set_session_login($user_id, $user_name){
        $_SESSION["uid"]=$user_id;
        $_SESSION["uname"]=$user_name;
    }
    function get_user_name(){
        if(isset($_SESSION["uid"])){
            $decode_username=base64_decode($_SESSION["uname"]);
            return $decode_username;
        } 
    }
    if(isset($_GET["status"])){
        del_session_logout();
    }
    function del_session_logout(){
        @session_start();
        session_unset();
        session_destroy();
        @$ckk_session_name=$_SESSION["uname"];
        if($ckk_session_name==null){
            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/shop/login.php'>";
        }else{
            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/index.php'>";
        }
    }
?>