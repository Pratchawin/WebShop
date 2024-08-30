<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <?php
        include 'dashboard_meta.php';
    ?>
    <link rel="stylesheet" href="dashboard_style/dashboard.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php
                include 'dashboard_navleft.php';
                include './controller/dashboard_ctt.php';
                ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php
                    include 'dashboard_navtop.php';
                    set_navtop(1);
                    ?>
                </div>
                <div class="ar-nav-top-title">
                    <h3>คำสั่งซื้อ</h3>
                </div>
                <div class="ar-admin-bx-show-st-list">
                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-note-sticky fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>คำสั่งซื้อ</p>
                            <p><?php dashboardShowOrder(); ?> รายการ</p>
                        </div>
                    </div>

                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-hand-holding-dollar fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>มูลค่ารวมทั้งสิ้น</p>
                            <p><?php echo getTotalValue(); ?> บาท</p>
                        </div>
                    </div>
                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-money-bill-wave fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>ชำระเงินเเล้ว</p>
                            <p><?php productPaymentSuccess(); ?> รายการ</p>
                        </div>
                    </div>
                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-hourglass fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>ยังไม่ชำระเงิน</p>
                            <p><?php productPaymentNt(); ?> รายการ</p>
                        </div>
                    </div>
                </div>
                <div class="ar-admin-bx-show-st-list">
                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-box fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>สินค้าในสต๊อก</p>
                            <p><?php echo getProductInStoc(); ?> รายการ</p>
                        </div>
                    </div>
                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-truck-fast fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>จัดส่งเเล้ว</p>
                            <p><?php echo getPdShipment()?> รายการ</p>
                        </div>
                    </div>
                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-chart-line fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>ยอดขายรวม</p>
                            <p><?php echo getTotalSales();?> บาท</p>
                        </div>
                    </div>
                    <div class="ar-status-bx">
                        <div class="ds-ind-show-icon">
                            <i class="fa-solid fa-user fa-3x icon-size"></i>
                        </div>
                        <div class="ar-ds-txt-ls">
                            <p>จำนวนผู้เข้าชม</p>
                            <p><?php echo countUserAccount();?> คน</p>
                        </div>
                    </div>
                </div>
                <div class="ar-admin-ds-or-list">
                    <div class="ar-btn-export-file">
                        <a href="./controller/report.php" class="btn-export-to-excel">ดาวน์โหลดไฟล์ Excel</a>
                    </div>
                    <table class="ar-ds-tbl-show-pdord" id='refresh_order_page'>
                        <tr>
                            <th class="th-ds-pd-or-title-no">#</th>
                            <th class="th-ds-pd-or-title-date">วันที่สั่งซื้อ</th>
                            <th class="th-ds-pd-or-title-pd-img">รูปสินค้า</th>
                            <th class="th-ds-pd-or-title-pd-name">ชื่อสินค้า</th>
                            <th class="th-ds-pd-or-title-pd-price">ราคา</th>
                            <th class="th-ds-pd-or-title-quantity">จำนวน</th>
                            <th class="th-ds-pd-or-title-uname">ชื่อลูกค้า</th>
                            <th class="th-ds-pd-or-title-status">สถานะคำสั่งซื้อ</th>
                            <th class="th-ds-pd-or-title-pm-status">การชำระเงิน</th>
                            <th class="th-ds-pd-or-title-oth">เพิ่มเติม</th>
                        </tr>
                        <?php
                        getOrderFromDB();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>

</html>