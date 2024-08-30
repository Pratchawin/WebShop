<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <?php
    include 'set_meta.php';
    ?>
    <link rel="stylesheet" href="shop_style/index.css">
    <link rel="stylesheet" href="shop_style/formbuypd.css">
    <link rel="stylesheet" href="shop_style/navtop.css">
    <link rel="stylesheet" href="shop_style/web_responsive.css">
    <link rel="stylesheet" href="shop_style/login.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-web-ecom-ind-container">
        <?php
        include '../dashboard/controller/connect.php';
        include 'indnavtop.php';
        include 'shop_controller/session_controller.php';
        include 'shop_controller/cpn_data.php';
        $username = get_user_name();
        showIndNavTop(1, $username);
        ?>
    </div>
    <div class="ar-web-ecom-content">
        <div class="ar-show-form-login">
            <div class="ar-form-login-ctn">
                <div class="ar-cmp-detail-and-cmp-form-login">
                    <div class="ar-cmp-detail">
                        <div class="ar-cpm-detail-txt">
                            <h3>บริษัท เบส บาย ซัพพลาย จำกัด</h3>
                            <p class="cmp-detail-p-txt">บริษัทประกอบธุรกิจ โดยเป็นผู้เเทนจัดจำหน่าย เเละนำเข้าเครื่องชั่งนำ้หนักดิจิตอลทุกประเภท
                                รวมถึงเครื่องมือวัดในอุตสาหกรรม เเละอุปกรณ์ห้องเเลปในการควบคุมคุณภาพสินค้า โดยเรามีทีม
                                ติดตั้ง ซ่อมบำรุง ที่มากประสบการณ์พร้อมบริการลูกค้าทั้งใน เเละนอกสถานที่
                                เพื่อความสะดวกเเละรวดเร็วของลูกค้า พร้อมทั้งให้คำปรึกษาเกี่ยวกับระบบเครื่องชั่ง
                                เพื่อตอบสนองความต้องการของลูกค้า เเละประโยชน์สูงสุด
                            </p>
                            <div class="ar-tbl-show-cmp-dt">
                                <h3 class="log-in-cnt">ติดต่อสอบถาม</h3>
                                <table>
                                    <tr>
                                        <td><img src="./logo/phone_icon.png" alt="" class="login-contact-icon"></td>
                                        <td><?php echo get_cpn_contact(1)?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="./logo/fax_icon.png" alt="" class="login-contact-icon"></td>
                                        <td><?php echo get_cpn_contact(2)?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="./logo/fb_icon.png" alt="" class="login-contact-icon"></td>
                                        <td><?php echo get_cpn_contact(7)?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="./logo/line_icon.png" alt="" class="login-contact-icon"></td>
                                        <td><?php echo get_cpn_contact(6)?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="ar-cmp-login">
                        <div class="ar-form-login-title">
                            <center>
                                <h3>เข้าสู่ระบบ</h3>
                            </center>
                        </div>
                        <form action="login.php" method="POST" class="login-form-pd">
                            <div class="ar-inp-login-bx-ls">
                                <label for="">อีเมล:</label><br>
                                <input type="text" name="email" id="" class="ar-inp-login" placeholder="อีเมล..">
                            </div>
                            <div class="ar-inp-login-bx-ls">
                                <label for="">รหัสผ่าน:</label><br>
                                <input type="password" name="password" id="" class="ar-inp-login" placeholder="รหัสผ่าน..">
                            </div>
                            <?php

                            $status = '';
                            @$email = $_POST["email"];
                            @$password = $_POST["password"];
                            if (isset($_POST["btn_login"])) {
                                if (empty($email) || empty($password)) {
                                    $status = "โปรดกรอกอีเมลเเละรหัสผ่าน";
                                } else {
                                    $conn = connect_bestDB();
                                    $encode_email = mysqli_real_escape_string($conn, base64_encode($email));
                                    $encode_pass = mysqli_real_escape_string($conn, base64_encode($password));
                                    $sql_check_email = "select email from account where email='$encode_email'";
                                    $result = mysqli_query($conn, $sql_check_email);
                                    $check_email = mysqli_fetch_row($result);
                                    if ($check_email == null) {
                                        $status = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
                                    } else {
                                        $sql_check_email = "select user_id, username from account where email='$check_email[0]' and user_password='$encode_pass'";
                                        $user_account = mysqli_query($conn, $sql_check_email);
                                        if ($user_account == false) {
                                            $status = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
                                        } else {
                                            $rs_account = mysqli_fetch_row($user_account);
                                            set_session_login($rs_account[0], $rs_account[1]);
                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/index.php'>";
                                        }
                                    }
                                }
                            }
                            ?>
                            <p id='check_register_status' style='color:red; text-align:right; margin-top:20px;'><?php echo $status; ?></p>
                            <div class="ar-inp-login-bx-ls">
                                <input type="submit" value="เข้าสู่ระบบ" class="btn-login-form" name="btn_login">
                                <div class="text">
                                    <button class="btn-login-form"><a href="register.php" class="btn-register">สมัครสมาชิก</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="../shop/store_js/navtop.js"></script>

</html>