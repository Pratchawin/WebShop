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
    <link rel="stylesheet" href="dashboard_style/dashboard_setting.css">
    <link rel="stylesheet" href="dashboard_style/dashboard_edit_category.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php
                include 'dashboard_navleft.php';
                include './controller/dashboard_setting_ctt.php';
                ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php
                    include 'dashboard_navtop.php';
                    include './controller/dashboard_edit_category.php';
                    set_navtop(1);
                    ?>
                </div>
                <div class="ar-ds-setting-title">
                    <h3>การตั้งค่าประเภทสินค้า</h3>
                </div>
                <div class="ar-set-bx-content">
                    <div class="set-bx-ctn-etl-ctt">
                        <div class="ar-dashboard-setting">
                            <div class="ar-form-inp-set-data">
                                <div class="ar-form-stt-account-cpn-data">
                                    <div class="ar-bx-bank-otp-account-1">
                                        <div>
                                            <p><b>แก้ไขประเภทสินค้าหลัก</b></p>
                                            <div class="stt-show-data2">
                                                <table>
                                                    <tr>
                                                        <th class="th-edit-ctt-title">ชื่อประเภทสินค้า</th>
                                                        <th class="th-edit-ctt-title-edit">#</th>
                                                        <th class="th-edit-ctt-title-del">#</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            get_pd_category();
                                                            if (isset($_GET["btn_del_ctt"])) {
                                                                $ctt_id = $_GET["ctt_id"];
                                                                delete_category($ctt_id);
                                                                echo "<meta http-equiv='refresh' content='0;url=https://bestbuyhatyai.com/dashboard/dashboard_edit_category.php'>";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ar-dashboard-setting">
                            <div class="ar-form-inp-set-data">
                                <div class="ar-form-stt-account-cpn-data">
                                    <div class="ar-bx-bank-otp-account-1">
                                        <div>
                                            <div>
                                                <p><b>แก้ไขประเภทสินค้าย่อย</b></p>
                                                <div class="ar-form-scl-ctt-list">
                                                    <form action="dashboard_edit_category.php">
                                                        <label for="">ประเภทสินค้า:</label>
                                                        <select name="scl_ctt_list_name" id="" class="scl-ctt-list">
                                                            <?php
                                                            select_pd_category();
                                                            ?>
                                                        </select>
                                                        <input type="submit" class="btn-save-new-ctt-name" name='btn_find_category_list' value="ค้นหา">
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="stt-show-data2">
                                                <table>
                                                    <tr>
                                                        <th class="th-edit-ctt-title">ชื่อประเภทสินค้าย่อย</th>
                                                        <th class="th-edit-ctt-title-edit">#</th>
                                                        <th class="th-edit-ctt-title-del">#</th>
                                                    </tr>
                                                    <?php
                                                    @$ctt_id = $_GET["scl_ctt_list_name"];
                                                    if (isset($ctt_id)) {
                                                        @$ctt_id = $_GET["scl_ctt_list_name"];
                                                        get_category_list($ctt_id);
                                                    } else {
                                                        get_category_list2();
                                                    }
                                                    ?>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ar-dashboard-setting">
                            <div class="ar-form-inp-set-data">
                                <div class="ar-form-stt-account-cpn-data">
                                    <div class="ar-bx-bank-otp-account-1">
                                        <div>
                                            <div>
                                                <p><b>แก้ไขยี่ห้อสินค้า</b></p>
                                            </div>
                                            <div class="stt-show-data2">
                                                <table>
                                                    <tr>
                                                        <th class="th-edit-ctt-title">ชื่อยี่ห้อสินค้า</th>
                                                        <th class="th-edit-ctt-title-edit">#</th>
                                                        <th class="th-edit-ctt-title-del">#</th>
                                                    </tr>
                                                    <?php
                                                    get_pd_brand();
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>
<script src="dashbpard_js/dashboard_edit_ctt.js"></script>

</html>