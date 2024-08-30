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
    <link rel="stylesheet" href="dashboard_style/dashboard_user_account.css">
    <link rel="stylesheet" href="dashboard_style/dashboard_pd_instoc.css">
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
                    <?php
                    include 'dashboard_navtop.php';
                    include './controller/dashboard_user_account_ctt.php';
                    set_navtop(0);
                    ?>
                </div>
                <div class="ar-ds-bx-show-title-and-search">
                    <div class="ar-ds-bx-show-title">
                        <h3>รายชื่อสมาชิก</h3>
                    </div>
                    <div class="ar-ds-bx-show-search-pd-name">
                        <div class="ar-show-user-account">
                            <p>จำนวนลูกค้า: <?php echo count_ctm(); ?> คน</p>
                        </div>
                        <table>
                            <tr>
                                <td>
                                    <form action="dashboard_user_account.php" method="get">
                                        <input type="text" name="find_username" id="" placeholder="ค้นหารายชื่อ" class="inp-search-pd-name">
                                        <input type="submit" name="btn_find_username" value="ค้นหา" class="ds-btn-his-edit-pd">
                                    </form>
                                </td>
                                <td><a href="./controller/report_user.php" class="btn-dow-his-file">ดาวน์โหลดไฟล์ Excel</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="ar-pd-in-stoc-list">
                    <div class="ar-tbl-pd-instoc-img-and-txt">
                        <table class="tbl-user-show-member">
                            <tr class="ar-tr-pd-tbl-member">
                                <th class="ar-th-pd-on-title-member">#</th>
                                <th class="ar-th-pd-uname-title-member">ชื่อ-นามสกุล</th>
                                <th class="ar-th-pd-email-title-member">อีเมล</th>
                                <th class="ar-th-pd-date-title-member">วันที่สมัคร</th>
                            </tr>
                            <?php
                            @$btn_ckk_find = $_GET["btn_find_username"];
                            @$inp_find_uname = $_GET["find_username"];
                            if (isset($btn_ckk_find) || isset($inp_find_uname)) {
                                find_username_account($inp_find_uname);
                            } else {
                                get_customer_list();
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

</html>