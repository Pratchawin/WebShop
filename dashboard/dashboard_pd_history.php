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
    <link rel="stylesheet" href="dashboard_style/dashboard_pd_instoc.css">
    <link rel="stylesheet" href="dashboard_style/dashboard_history.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php
                include 'dashboard_navleft.php';
                include 'controller/dashboard_pd_history_ctt.php';
                ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php
                    include 'dashboard_navtop.php';
                    set_navtop(1);
                    ?>
                </div>
                <div class="ar-ds-bx-show-title-and-search">
                    <div class="ar-ds-bx-show-title">
                        <h3>ประวัติการซื้อขาย</h3>
                    </div>
                    <div class="ar-ds-bx-show-search-pd-name">
                        <table>
                            <tr>
                                <td>
                                    <p>ค้นหา: </p>
                                </td>
                                <td>
                                    <form action="dashboard_pd_history.php" method="get">
                                        <input type="text" name="inp_uname" id="" placeholder="ค้นหาชื่อลูกค้า" class="inp-search-pd-name">
                                        <input type="submit" name="find_pd_his_uname" value="ค้นหา" class="ds-btn-his-edit-pd">
                                    </form>
                                </td>
                                <td>
                                    <form action="dashboard_pd_history.php" method="get" style="padding-left: 10px;">
                                        <input type="text" name="inp_or_code" id="" placeholder="รหัสคำสั่งซื้อ" class="inp-search-pd-name">
                                        <input type="submit" name="btn_find_pd_his_code" value="ค้นหา" class="ds-btn-his-edit-pd">
                                    </form>
                                </td>
                                <td>
                                    <a href="./controller/report_his.php" class="btn-dow-his-file">ดาวน์โหลดไฟล์ Excel</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="ar-pd-in-stoc-list">
                    <div class="ar-tbl-pd-instoc-img-and-txt">
                        <div class="ar-his-res-data">
                            <div class="res-bx">
                                <table class="tbl-res-his">
                                    <?php
                                    @$uname = $_GET["inp_uname"];
                                    @$ckk_btn_his = $_GET["find_pd_his_uname"];
                                    if (isset($ckk_btn_his) || isset($uname)) {
                                        getOrderHistoryResponse2($uname);
                                    } elseif (isset($_GET["btn_find_pd_his_code"])) {
                                        $inp_or_code = $_GET["inp_or_code"];
                                        getOrderHistoryResponse3($inp_or_code);
                                    } else {
                                        getOrderHistoryResponse();
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <table class="ar-tbl-ds-his-or-his">
                            <tr>
                                <th class="ar-ds-th2-orhis-no">#</th>
                                <th class="ar-ds-th2-orhis-order-code">รหัสคำสั่งซื้อ</th>
                                <th class="ar-ds-th2-orhis-name">วันที่สั่งซื้อ</th>
                                <th class="ar-ds-th2-orhis-name">ชื่อลูกค้า</th>
                                <th class="ar-ds-th2-orhis-phone">เบอร์โทรศัพท์</th>
                                <th class="ar-ds-th2-orhis-ctm-address">ที่อยู่</th>
                                <th class="ar-ds-th2-orhis-pd-name">ชื่อสินค้า</th>
                                <th class="ar-ds-th2-orhis-price">ราคาสินค้า</th>
                                <th class="ar-ds-th2-orhis-quantity">จำนวน</th>
                                <th class="ar-ds-th2-orhis-price">ราคารวม vat เเละค่าจัดส่ง</th>
                                <th class="ar-ds-th2-orhis-pm-status">การชำระเงิน</th>
                                <th class="ar-ds-th2-orhis-pm-shipment">การจัดส่ง</th>
                            </tr>
                            <?php
                            @$uname = $_GET["inp_uname"];
                            @$ckk_btn_his = $_GET["find_pd_his_uname"];
                            if (isset($ckk_btn_his) || isset($uname)) {
                                find_user_his_name($uname);
                            } elseif (isset($_GET["btn_find_pd_his_code"])) {
                                $inp_or_code = $_GET["inp_or_code"];
                                find_pd_by_code($inp_or_code);
                            } else {
                                getOrderHistory();
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>
<script src="dashbpard_js/dashboard_pd_history.js"></script>
</html>