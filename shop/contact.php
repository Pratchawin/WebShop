<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <?php
    include 'set_meta.php';
    include '../dashboard/controller/connect.php';
    ?>
    <link rel="stylesheet" href="shop_style/index.css">
    <link rel="stylesheet" href="shop_style/web_responsive.css">
    <link rel="stylesheet" href="shop_style/navtop.css">
    <link rel="stylesheet" href="shop_style/contact.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-web-ecom-ind-container">
        <?php
        include 'indnavtop.php';
        include 'shop_controller/session_controller.php';
        $username = get_user_name();
        showIndNavTop(1, $username);
        ?>
    </div>
    <div class="ar-web-ecom-content">
        <div class="ar-contact-to-cmp">
            <div class="ar-form-inp-contact-width-email">
                <div class="ar-contact-title">
                    <p><b>หากมีข้อสงสัยสามารถพิมพ์ข้อมูลลงในฟอร์มเเละรอการตอบกลับ</b></p>
                </div>
                <div class="ar-form-contact-to-admin">
                    <form action="contact.php" class="ar-set-pd-form-contact" method="POST">
                        <div class="contact-form-bx-ls">
                            <label for="" class="contact-lbl">ชื่อ-นามสกุล:</label>
                            <div class="ar-contact-inp-fname">
                                <input type="text" placeholder="ชื่อ.." name="fname" class="contact-form-inp-uname-and-lname">
                                <input type="text" placeholder="นามสกุล.." name="lname" class="contact-form-inp-uname-and-lname">
                            </div>
                        </div>
                        <div class="contact-form-bx-ls">
                            <div class="ar-contact-bx-email">
                                <label for="" class="contact-lbl">อีเมล:</label>
                                <div class="ar-contact-inp-email">
                                    <input type="text" name="email" class="contact-form-inp" placeholder="อีเมล..">
                                </div>
                            </div>
                            <div class="ar-contact-bx-phone">
                                <label for="" class="contact-lbl">เบอรโทรศัพท์:</label>
                                <div class="ar-contact-inp-email">
                                    <input type="text" name="phone" class="contact-form-inp" placeholder="เบอร์โทร..">
                                </div>
                            </div>
                        </div>
                        <div class="contact-form-bx-ls-txt">
                            <label for="" class="contact-lbl">ข้อความ:</label>
                            <div class="ar-contact-inp-email">
                                <textarea name="message" id="" cols="66" rows="10" class="inp-message-bx"></textarea>
                            </div>
                        </div>
                        <div class="contact-form-bx-ls">
                            <div class="ar-contact-inp-email2">
                                <input type="submit" name="btn_send_contact" value="ส่งข้อความ" class="btn-send-message-data">
                            </div>
                        </div>
                    </form>
                    <?php
                    $send_mail_status = '';
                    @$btn_send_contact = $_POST["btn_send_contact"];
                    if (isset($btn_send_contact)) {
                        $ckk_send_mail_to_admin = send_mail_to_admin();
                        if ($ckk_send_mail_to_admin == true) {
                            $send_mail_status = "<p style='color:green;'>ส่งอีเมลเรียบร้อย</p>";
                            echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/shop/contact.php'>";
                        }
                    }
                    function send_mail_to_admin()
                    {
                        $fname = $_POST["fname"];
                        $lname = $_POST["lname"];
                        $email = $_POST["email"];
                        $phone = $_POST["phone"];
                        $message = $_POST["message"];

                        $to = "64309010005@htc.ac.th";
                        $subject = "คำถามจากผู้ใช้งาน";
                        $message = "
                            <p>ชื่อผู้ใช้: " . $fname . " " . $lname . "</p>
                            <p>อีเมล: " . $email . "</p>
                            <p>เบอร์โทรศัพท์:" . $phone . "</p>
                            <p>ข้อความ:" . $message . "</p>
                        ";
                        $header = 'From: 64309010005@htc.ac.th' . "\r\n";
                        $header .= "MIME-Version: 1.0\r\n";
                        $header .= "Content-type: text/html\r\n";
                        $ckk_send_mail = mail($to, $subject, $message, $header);
                        return $ckk_send_mail;
                    }
                    echo $send_mail_status;
                    ?>
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