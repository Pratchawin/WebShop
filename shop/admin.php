<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <?php
    include 'set_meta.php';
    ?>
    <link rel="stylesheet" href="admin.css">
</head>
<style>
    * {
        padding: 0;
        margin: 0;
    }

    body {
        background-color: rgb(241, 241, 241);
    }

    .div-ar-admin-login {
        display: grid;
        justify-content: center;
    }

    .ar-admin-login {
        width: 400px;
        padding-left: 150px;
        padding-right: 150px;
        padding-top: 50px;
        padding-bottom: 50px;
        background-color: rgb(255, 255, 255);
        margin-top: 200px;
    }

    .inp-adname,
    .inp-adpwd {
        padding: 5px;
        border: 1px solid lightgray;
        border-radius: 5px;
        width: 97%;
        margin-top: 5px;
    }

    .ar-ad-inp {
        margin-top: 20px;
    }

    .btn-ad-submit {
        width: 100%;
        padding: 8px;
        font-size: 15px;
        background-color: #0788D9;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .ar-btn-inp {
        margin-top: 20px;
    }

    .btn-ad-submit:hover {
        cursor: pointer;
    }

    .ad-status {
        color: red;
        text-align: right;
    }

    @media only screen and (max-width:360px) {
        * {
            padding: 0;
            margin: 0;
        }

        body {
            background-color: white;
        }

        .div-ar-admin-login {
            display: grid;
            justify-content: center;
        }

        .ar-admin-login {
            width: 255px;
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 0px;
            padding-bottom: 0px;
            background-color: rgb(255, 255, 255);
            margin-top: 200px;
        }

        .inp-adname,
        .inp-adpwd {
            padding: 5px;
            border: 1px solid lightgray;
            border-radius: 5px;
            width: 97%;
            margin-top: 5px;
        }

        .ar-ad-inp {
            margin-top: 20px;
        }

        .btn-ad-submit {
            width: 100%;
            padding: 8px;
            font-size: 15px;
            background-color: #0788D9;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .ar-btn-inp {
            margin-top: 20px;
        }

        .btn-ad-submit:hover {
            cursor: pointer;
        }

        .ad-status {
            color: red;
            text-align: right;
        }
    }
</style>

<body>
    <div class="div-ar-admin-login">
        <div class="ar-admin-login">
            <div class="ar-gorm-login">
                <div class="ar-admin-title">
                    <center>
                        <h3>Admin</h3>
                    </center>
                </div>
                <form action="admin.php" method="POST">
                    <div class="ar-ad-inp">
                        <label for="">Username:</label>
                        <input type="text" name="ad_uname" class="inp-adname" placeholder="username..">
                    </div>
                    <div class="ar-ad-inp">
                        <label for="">Password:</label>
                        <input type="text" name="ad_pass" class="inp-adpwd" placeholder="password..">
                    </div>
                    <div class="ar-btn-inp">
                        <input type="submit" class="btn-ad-submit" name="ad_confirm" value="เข้าสู่ระบบ">
                    </div>
                    <?php
                    include '../dashboard/controller/connect.php';
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $conn = connect_bestDB();
                        if (isset($_POST["ad_confirm"])) {
                            $ad_uname = mysqli_real_escape_string($conn, $_POST["ad_uname"]); //เข้ารหัส 
                            $ad_pass = mysqli_real_escape_string($conn, $_POST["ad_pass"]);; //เข้ารหัส
                            $sql_admin02 = "select status, admin_id from tbl_admin where ad_uname='$ad_uname' and ad_pwd='$ad_pass'";
                            $ckk_rs = mysqli_query($conn, $sql_admin02);
                            $status = '';
                            if ($ckk_rs == true) {
                                $mysqli_fetch_data = mysqli_fetch_assoc($ckk_rs);
                                if ($mysqli_fetch_data == true) {
                                    $_SESSION["status"] = base64_encode($mysqli_fetch_data["status"]);
                                    $_SESSION["admin_id"] = base64_encode($mysqli_fetch_data["admin_id"]);
                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard.php'>";
                                } else {
                                    $status = "<p class='ad-status'>ไม่สามารถเข้าสู่ระบบได้</p>";
                                    echo $status;
                                    echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/shop/admin.php'>";
                                }
                            } else {
                                $status = "<p class='ad-status'>ไม่สามารถเข้าสู่ระบบได้</p>";
                                echo $status;
                                echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/shop/admin.php'>";
                            }
                        } else {
                            $status = "<p class='ad-status'>ไม่สามารถเข้าสู่ระบบได้</p>";
                            echo $status;
                            echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/shop/admin.php'>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>