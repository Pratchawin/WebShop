<!DOCTYPE html>
<html lang="en">

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
        include 'shop_controller/session_controller.php';
        include '../dashboard/controller/connect.php';
        include 'shop_controller/cpn_data.php';
        $username = get_user_name();
        echo "
        <div class='ar-web-ecom-top-content'>
        <div class='web-ecom-top-content'>
            <div class='bx-web-ecom-top-content'>
                <div class='web-logo-top'>
                    <img src='../access/logo_img/cl_logo.png' alt='' class='icon-response'>
                    <div class='ar-manue-slice-bar'>
                        <i class='fa-solid fa-bars fa-1x' onclick='showNavLeft()'></i>
                    </div>
                    <div class='ar-show-manue-resp-navtop-list' id='showManueRespTop'>
                        <div class='ar-show-manue-resp'>
                            <div class='ar-nav-top-res-btn-close'>
                                <span onclick='CloseManueNavTop()'>x</span>
                            </div>
                            <p><b>หมวดหมู่สินค้า</b></p>
                            <div class='ar-show-pdcate-link-title'>
                            ";
        $conn = connect_bestDB();
        $sql_sel = "select category_id, category_name from tbl_category";
        $rs_data = mysqli_query($conn, $sql_sel);
        if (mysqli_num_rows($rs_data) > 0) {
            while ($data = mysqli_fetch_assoc($rs_data)) {
                echo "
                                            <div>
                                                <div>
                                                    <a class='res-link' href='./shop/show_pd_category.php?category_id=" . $data["category_id"] . "&category_list=" . $data["category_name"] . "'>" . $data["category_name"] . "</a>
                                                </div>
                                            </div>
                                        ";
            }
        }
        echo "
                            </div>
                        </div>
                    </div>
                </div>
                <div class='web-inp-search-pd-name'>
                    <form action='./shop/search_pd_by_inp.php' method='get'>
                        <input type='text' name='search_pd' id='' class='inp-search-top' placeholder='Search'>
                        <input type='submit' name='btn_search_pd' value='ค้นหา' class='btn-search-pd-name'>
                    </form>
                </div>
                <div class='web-login-logout-status'>
                    <div class='ar-navtop-show-uname-txt'>
                        " . $show_username_tag . "
                        <div class='ar-top-btn-lg-lo-bs'>
                            <a href='shop/basket.php' class='top-btn-st-for-user'><i class='fa-solid fa-cart-shopping fa-1x'></i></a>
                        </div>
                        <div class='ar-top-btn-lg-lo-bs'>
                            <a href='./login.php' class='top-btn-st-for-user'><i class='fa-solid fa-arrow-right-to-bracket'></i></a>
                        </div>
                    </div>
                    <div class='ar-show-user-and-cart-logo'>
                        <div class='logo-user-icon-list'>
                            <a href='shop/basket.php'><i class='fa-solid fa-basket-shopping navtop-icon-list'></i></a>
                        </div>
                        <div class='logo-user-icon-list'>
                            <a href='shop/login.php' class='link-res-top-login-txt'><i class='fa-solid fa-right-to-bracket navtop-icon-list'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='ar-manue-list-top'>
            <div class='ar-manue-top-link'>
                <div class='ar-link-list-top'>
                    <a href='../index.php' class='hd-top-link-txt'>หน้าเเรก</a>
                </div>
                <div class='ar-link-list-top'>
                    <a href='howtopay.php' class='hd-top-link-txt'>วิธีการชำระเงิน</a>
                </div>
                <div class='ar-link-list-top'>
                    <a href='about_me.php' class='hd-top-link-txt'>เกี่ยวกับเรา</a>
                </div>
                <div class='ar-link-list-top'>
                    <a href='contact.php' class='hd-top-link-txt'>ติดต่อเรา</a>
                </div>
            </div>
        </div>
    </div>
        ";
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
                                <div class="ar-tbl-show-cmp-dt">
                                    <h3 class="log-in-cnt">ติดต่อสอบถาม</h3>
                                    <table>
                                        <tr>
                                            <td><img src="./logo/phone_icon.png" alt="" class="login-contact-icon"></td>
                                            <td><?php echo get_cpn_contact(1) ?></td>
                                        </tr>
                                        <tr>
                                            <td><img src="./logo/fax_icon.png" alt="" class="login-contact-icon"></td>
                                            <td><?php echo get_cpn_contact(2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><img src="./logo/fb_icon.png" alt="" class="login-contact-icon"></td>
                                            <td><?php echo get_cpn_contact(7) ?></td>
                                        </tr>
                                        <tr>
                                            <td><img src="./logo/line_icon.png" alt="" class="login-contact-icon"></td>
                                            <td><?php echo get_cpn_contact(6) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ar-cmp-login">
                        <div class="ar-form-login-title">
                            <center>
                                <h3>สมัครสมาชิก</h3>
                            </center>
                        </div>
                        <form action="register.php" method="POST" class="register-form-pd">
                            <div class="ar-inp-login-bx-ls">
                                <label for="">ชื่อ-นามสกุล</label><br>
                                <input type="text" name="fullname" id="fullname" class="ar-inp-login" placeholder="ชื่อ-นามสกุล..">
                            </div>
                            <div class="ar-inp-login-bx-ls">
                                <label for="">อีเมล:</label><br>
                                <input type="email" name="u_email" id="email" class="ar-inp-login" placeholder="อีเมล..">
                            </div>
                            <div class="ar-inp-login-bx-ls">
                                <label for="">รหัสผ่าน:</label><br>
                                <input type="password" name="u_pass" id="pass1" class="ar-inp-login" placeholder="รหัสผ่าน..">
                            </div>
                            <div class="ar-inp-login-bx-ls">
                                <label for="">กรอกรหัสผ่านอีกครั้ง:</label><br>
                                <input type="password" name="u_pass2" id="pass2" class="ar-inp-login" placeholder="รหัสผ่าน..">
                            </div>

                            <?php
                            $conn = connect_bestDB();
                            @$status = '';
                            @$fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
                            @$email = mysqli_real_escape_string($conn, $_POST["u_email"]);
                            @$pass = mysqli_real_escape_string($conn, $_POST["u_pass"]);
                            @$pass_again = mysqli_real_escape_string($conn, $_POST["u_pass2"]);
                            if (isset($_POST["register"])) {
                                if (empty($fullname) || empty($email) || empty($pass) || empty($pass_again)) {
                                    $status = "โปรดกรอกข้อมูลให้ครบถ้วน";
                                } else if ($pass != $pass_again) {
                                    $status = "รหัสผ่านไม่ตรงกัน";
                                } else if (strlen($pass) <= 6) {
                                    $status = "รหัสผ่านควรมีความยาวตั้งเเต่ 6-8 ตัวอักษร";
                                } else {
                                    $email_code = base64_encode($email);
                                    $check_user_name = "select email from account where email='$email_code'";
                                    $result = mysqli_query($conn, $check_user_name);
                                    @$row = mysqli_fetch_row($result);
                                    if (@$row[0] == false) {
                                        $encode_name = base64_encode($fullname);
                                        $encode_email = base64_encode($email);
                                        $encode_pass = base64_encode($pass);
                                        $stmt = $conn->prepare("insert into account(username, email, user_password) values(?,?,?)");
                                        $stmt->bind_param("sss", $encode_name, $encode_email, $encode_pass);
                                        $stmt->execute();
                                        $stmt->close();
                                        $conn->close();
                                        $status = "<p id='check_register_status' style='color:green; text-align:right; margin-top:20px;'>สมัครสมาชิกเรียบร้อย</p>";
                                        echo "<meta http-equiv='refresh' content='2;url=http://localhost/bestbuy/shop/login.php'>";
                                    } else {
                                        $status = "มีชื่อผู้ใช้งานนี้เเล้ว";
                                        $conn->close();
                                    }
                                }
                            }
                            ?>
                            <?php
                            echo "<p id='check_register_status' style='color:red; text-align:right; margin-top:20px;'>$status</p>";
                            ?>
                            <div class="ar-inp-login-bx-ls">
                                <input type="submit" value="สมัครสมาชิก" class="btn-login-form" name="register">
                                <div class="text">
                                    <button class="btn-login-form"><a href="login.php" class="btn-register">เข้าสู่ระบบ</a></button>
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

</html>