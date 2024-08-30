<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <?php
    include './shop/set_meta.php';
    ?>
    <link rel='icon' type='image/x-icon' sizes='16x16' href='./access/logo_img//cl_logo.png'>
    <link rel="stylesheet" href="shop/shop_style/index.css">
    <link rel="stylesheet" href="shop/shop_style/web_responsive.css">
    <link rel="stylesheet" href="shop/shop_style/navtop.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-web-ecom-ind-container">
        <?php
        include './shop/shop_controller/session_controller.php';
        include './shop/shop_controller/index_controller.php';
        include './shop/indnavtop.php';
        include './shop/ind_nav_left.php';
        $username = get_user_name();
        showIndNavTop(0, $username);
        ?>
    </div>

    <div class="ar-web-ads-content">
        <div class="ar-ind-ads-pd">
            <div class="ar-ind-ads-left">
                <div class="ar-ind-ads-left-title">
                    <p>ประเภทสินค้า</p>
                </div>
                <ul>
                    <?php
                    IndGetPdcategory();
                    ?>
                </ul>
            </div>
            <div class="ar-ind-ads-right">
                <?php
                showAdvertTopContent(1);
                ?>
            </div>
        </div>
    </div>
    <div class="ar-web-ecom-content">
        <div class="ar-web-content-2">
            <div class='ar-web-content-left'>
                <div class="ar-show-pd-brand-link2">
                    <div class="ar-ind2-navleft-title3">
                        <p>ภาพรวมทั้งหมด</p>
                    </div>
                    <div class="ar-show-web-overview">
                        <table class="show-shop-overview">
                            <tr>
                                <td class="td-cls-ovv"><i class="fa-solid fa-note-sticky overview-txt"></i></td>
                                <td>
                                    <p class="overview-txt">สินค้าทั้งหมด</p>
                                </td>
                                <td>
                                    <p class="overview-txt"><?php echo get_num_of_pd() ?> ชิ้น</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-cls-ovv"><i class="fa-solid fa-eye overview-txt"></i></i></td>
                                <td>
                                    <p class="overview-txt">จำนวนผู้เข้าชม</p>
                                </td>
                                <td>
                                    <p class="overview-txt"><?php echo get_user_visit() ?> คน</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
                @$category_id = $_GET["category_id"];
                if (isset($category_id)) {
                    indShowNavLeftAndGetCategoryList($category_id);
                } else {
                    $conn = connect_bestDB();
                    $sql_get_pd_default = "select category_id from tbl_pd_default where default_id=1";
                    $rs_default = mysqli_query($conn, $sql_get_pd_default);
                    if (mysqli_num_rows($rs_default) > 0) {
                        $ctt_default = mysqli_fetch_assoc($rs_default);
                        indShowNavLeftAndGetCategoryList($ctt_default["category_id"]); //สินค้าเริ่มต้น
                        $conn->close();
                    } else {
                        echo "";
                    }
                }
                ?>
                <div class="ar-show-pd-brand-link">
                    <div class="ar-ind2-navleft-title">
                        <p>ยี่ห้อสินค้า</p>
                    </div>
                    <?php
                    findProductBrand();
                    ?>
                </div>
            </div>
            <div class="ar-ind2web-content-right">
                <?php
                @$ckk_btn_search = $_GET["btn_search_pd"];
                @$category_list_id = $_GET["category_id"];
                if (isset($category_list_id)) {
                    indShowProducts($category_list_id);
                } else {
                    $conn = connect_bestDB();
                    $sql_get_pd_default = "select category_id from tbl_pd_default where default_id=1";
                    $rs_default = mysqli_query($conn, $sql_get_pd_default);
                    if (mysqli_num_rows($rs_default) > 0) {
                        $ctt_default = mysqli_fetch_assoc($rs_default);
                        indShowProducts($ctt_default["category_id"]); //สินค้าเริ่มต้น
                        $conn->close();
                    } else {
                        echo "";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="ar-web-ecom-footer-content">
        <div class="ar-web-footer">
            <div class="ar-ft-bx-ls">
                <div class="ar-ft-cmp-logo-about-ct">
                    <div class="ar-ft-show-best-buy-logo">
                        <img class="ft-best-buy-logo-png" src="access/logo_img/cl_logo.png" alt="">
                    </div>
                </div>
                <div class="ar-ft-cmp-logo-about-ct">
                    <div class="ar-ins-ft-cmp-dt">
                        <p class="footer-text">ข้อมูลการติดต่อ</p>
                        <?php
                        function footer_get_cpn_contact($cpn_id)
                        {
                            $conn = connect_bestDB();
                            $es_cpn_id = mysqli_escape_string($conn, $cpn_id);
                            $sql_get_ctt = "select cpn_data from tbl_contact where cpn_id='$es_cpn_id'";
                            $rs_cpn_data = mysqli_query($conn, $sql_get_ctt);
                            $cpn_data = mysqli_fetch_assoc($rs_cpn_data);
                            return $cpn_data["cpn_data"];
                        }
                        ?>
                        <table>
                            <tr>
                                <td><img src='./shop/logo/phone_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td>
                                    <p class='ft-txt-set'><?php echo footer_get_cpn_contact(1)?></p>
                                </td>
                            </tr>
                            <tr>
                                <td><img src='./shop/logo/fax_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td>
                                    <p class='ft-txt-set'><?php echo footer_get_cpn_contact(2)?> (แฟกซ์)</p>
                                </td>
                            </tr>
                            <tr>
                                <td><img src='./shop/logo/fb_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><a href='' class='ft-contact-link'><?php echo footer_get_cpn_contact(7)?></a></td>
                            </tr>
                            <tr>
                                <td><img src='./shop/logo/line_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td>
                                    <p class='ft-txt-set'><?php echo footer_get_cpn_contact(6)?></p>
                                </td>
                            </tr>
                            <tr>
                                <td><img src='./shop/logo/email_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'><?php echo footer_get_cpn_contact(4)?></p></td>
                            </tr>
                            <tr>
                                <td><img src='./shop/logo/web_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'><?php echo footer_get_cpn_contact(3)?></p></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="ar-ft-cmp-logo-about-ct">
                    <div class="ar-ins-ft-cmp-dt">
                        <p class="footer-text">เกี่ยวกับเรา</p>
                        <div class="ar-ft-about-cmp">
                            <p class="p-ft-about-cmp">
                                บริษัทประกอบธุรกิจ โดยเป็นผู้เเทนจัดจำหน่าย เเละนำเข้าเครื่องชั่งนำ้หนักดิจิตอลทุกประเภท
                                รวมถึงเครื่องมือวัดในอุตสาหกรรม เเละอุปกรณ์ห้องเเลปในการควบคุมคุณภาพสินค้า โดยเรามีทีม
                                ติดตั้ง ซ่อมบำรุง ที่มากประสบการณ์พร้อมบริการลูกค้าทั้งใน เเละนอกสถานที่
                                เพื่อความสะดวกเเละรวดเร็วของลูกค้า พร้อมทั้งให้คำปรึกษาเกี่ยวกับระบบเครื่องชั่ง
                                เพื่อตอบสนองความต้องการของลูกค้า เเละประโยชน์สูงสุด
                            </p>
                        </div>
                    </div>
                </div>
                <div class="ar-ft-cmp-logo-about-ct">
                    <div class="ar-ins-ft-cmp-dt">
                        <p class="footer-text">สถานที่ตั้ง</p>
                        <div class="ar-ft-about-cmp">
                            <p class="p-ft-about-cmp">
                                <?php echo footer_get_cpn_contact(5)?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ar-support-logo">
                <div class="ar-support-title">
                    <h3 class="ar-show-logo-support">ผู้สนับสนุน</h3>
                </div>
                <div class="ar-show-support-logo">
                    <div class="support-logo-bx">
                        <img src="access/new_support/allamerican01.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/and02.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/atago-logo03.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/binder-logo04.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/brookfield-logo05.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/commandor-logo06.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/Eutech07.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/logo webo08.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/lovibond-logo09.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/memmert-logo10.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/mettler-logo11.png" alt="" class="image-logo-support-png">
                    </div>
                    <div class="support-logo-bx">
                        <img src="access/new_support/tanita-logo12.png" alt="" class="image-logo-support-png">
                    </div>
                </div>
            </div>
            <div class="ar-ft-bx-ls1">
                <p class="ft-ctn-cmp-dt">บริษัท เบส บาย ซัพพลาย หาดใหญ่</p>
                <p class="ft-ctn-cmp-dt"><?php echo footer_get_cpn_contact(5)?></p>
                <p class="ft-ctn-cmp-dt">โทร: <?php echo footer_get_cpn_contact(1)?></p>
                <p class="ft-ctn-cmp-dt">แฟกซ์: <?php echo footer_get_cpn_contact(2)?></p>
                <p class="ft-ctn-cmp-dt">เว็บไซต์: <?php echo footer_get_cpn_contact(3)?></p>
                <p class="ft-ctn-cmp-dt">อีเมล: <?php echo footer_get_cpn_contact(4)?></p>
                <p class="ft-ctn-cmp-dt">ไลน์: <?php echo footer_get_cpn_contact(6)?></p>
                <p class='ft-ctn-cmp-dt cpp-right'>© bestbuyhatyai <?php $cpp_year = date("Y");
                                                                    echo $cpp_year; ?></p>
            </div>
        </div>
    </div>
</body>
<script src="shop/store_js/index.js"></script>
<script src="shop/store_js/navtop.js"></script>

</html>