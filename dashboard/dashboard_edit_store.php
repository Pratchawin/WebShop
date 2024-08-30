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
                <?php include 'dashboard_navleft.php' ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php include 'dashboard_navtop.php' ?>
                </div>
                <div class="ar-admin-bx-show-st-list">
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                    <div class="ar-status-bx">
                        <p>status</p>
                    </div>
                </div>
                <div class="ar-admin-ds-or-list">
                    <table>
                        <tr>
                            <th>เลขที่</th>
                            <th>วันที่สั่งซื้อ</th>
                            <th>รูปสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>รวม</th>
                            <th>ชื่อลูกค้า</th>
                            <th>สถานะ</th>
                            <th>การชำระเงิน</th>
                            <th>เพิ่มเติม</th>
                        </tr>
                        <tr class="tr-pd-or-ls">
                            <td>123456</td>
                            <td>6/23/2022</td>
                            <td>
                                <img src="../access/pd_image/01.png" alt="" width="100px">
                            </td>
                            <td>ABC</td>
                            <td>4500 บาท</td>
                            <td>1 ชิ้น</td>
                            <td>4500 บาท</td>
                            <td>นาย ก</td>
                            <td>
                                <p class="ds-pd-status">สั่งซื้อ</p>
                            </td>
                            <td>
                                <p class="ds-pd-payment-status">ชำระเงินเเล้ว</p>
                            </td>
                            <td>
                                <button class="ar-btn-show-pd-dsc">เปิดดู</button>
                            </td>
                        </tr>
                        <tr class="tr-pd-or-ls">
                            <td>123456</td>
                            <td>6/23/2022</td>
                            <td>
                                <img src="../access/pd_image/01.png" alt="" width="100px">
                            </td>
                            <td>ABC</td>
                            <td>4500 บาท</td>
                            <td>1 ชิ้น</td>
                            <td>4500 บาท</td>
                            <td>นาย ก</td>
                            <td>
                                <p class="ds-pd-status">สั่งซื้อ</p>
                            </td>
                            <td>
                                <p class="ds-pd-payment-status">ชำระเงินเเล้ว</p>
                            </td>
                            <td>
                                <button class="ar-btn-show-pd-dsc">เปิดดู</button>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>

</html>