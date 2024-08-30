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
    <link rel="stylesheet" href="shop_style/pdreview.css">
    <link rel="stylesheet" href="shop_style/howtobuypd.css">
    <link rel="stylesheet" href="shop_style/about_me.css">
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
    <div class="ar-howto-buy-pd-container">
        <div class="ar-hwt-buy-pd-in-web">
            <div class="hwt-buy-pd-title">
                <h2 class="hwt-pay-title">วิธีการซื้อสินค้าเเละชำระเงิน</h2>
            </div>
            <div class="howto-img-top">
                <img src="../access/company_img/howto.jpg" alt="" class="img-how-to-pay">
            </div>
            <div class="hwt-buy-pd-content">
                <ul>
                    <li style="padding-top:10px;">เลือกดูสินค้าที่ต้องการ</li>
                    <li style="padding-top:10px;">ก่อนสั่งซื้อสินค้ากดเลือกจำนวนสินค้า</li>
                    <li style="padding-top:10px;">กดปุ๋มสั่งซื้อสินค้าหรือเพิ่มไปยังตะกร้าสินค้า</li>
                    <li style="padding-top:10px;">กรอกข้อมูลการจัดส่งลงในฟอร์มสั่งซื้อสินค้า</li>
                    <li style="padding-top:10px;">โปรดเช็คข้อมูลที่อยู่ในการจัดส่งให้ถูกต้อง</li>
                    <li style="padding-top:10px;">ทำการโอนเงินไปยังเลขบัญชีของบริษัท เบส บาย ซัพพลาย หาดใหญ่</li>
                    <li style="padding-top:10px;">เมื่อโอนเงินเสร็จเรียบร้อยให้ส่งหลักฐานการโอนเงิน</li>
                    <li style="padding-top:10px;">รออีเมลตอบกลับ</li>
                    <li style="padding-top:10px;">รอรับสินค้า</li>
                    <li style="padding-top:10px;">หมายเหตุ สินค้าบางชิ้นต้องสั่งซื้อล้วงหน้า จากนั้นกด ยืนยัน เพื่อส่งข้อมูลสินค้าที่ต้องการเเล้วรอทางร้านติดต่อกลับ</li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="../shop/store_js/navtop.js"></script>

</html>