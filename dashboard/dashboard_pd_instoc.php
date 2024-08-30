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
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php
                include 'dashboard_navleft.php';
                include './controller/dashboard_pd_instoc_ctt.php';
                ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php
                    include 'dashboard_navtop.php';
                    set_navtop(0);
                    ?>
                </div>
                <div class="ar-ds-bx-show-title-and-search">
                    <div class="ar-ds-bx-show-title">
                        <h3>สินค้าในสต็อก</h3>
                        <div class="ar-pd-instoc-title-ds">
                            <p>จำนวนสินค้าทั้งหมด: <?php getProductInStoc(); ?> ชิ้น</p>
                            <p>จำนวนประเภทสินค้าหลัก: <?php get_ctt_main(); ?> รายการ</p>
                            <p>จำนวนประเภทสินค้าย่อย: <?php get_ctt_list(); ?> รายการ</p>
                            <p>มูลค่ารวมทั้งสิ้น: <?php get_total_price(); ?> บาท</p>
                        </div>
                    </div>
                    <div class="ar-ds-bx-show-search-pd-name">
                        <table class="tbl-pd-instoc-data">
                            <tr>
                                <td class="pd-ctt-instoc-title">หมวดหมู่สินค้า:</td>
                                <form action="dashboard_pd_instoc.php" method="get">
                                    <td class="hid-form-find-pd">
                                        <div class="ar-input-pd-name-pd-code">
                                            <input type="text" name="ins_pd_name" placeholder="ค้นหาชื่อสินค้า" class="inp-search-pd-name">
                                        </div>
                                    </td>
                                    <td class="hid-form-find-pd">
                                        <input type="submit" name="btn_ins_pd_name" value="ค้นหา" class="btn-ds-search-pd">
                                    </td>
                                </form>
                                <form action="dashboard_pd_instoc.php" method="get">
                                    <td>
                                        <select name="ins_main_category" class="slc-pd-category">
                                            <?php show_fn_category(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" name="btn_instoc1" value="ค้นหา" class="btn-ds-search-pd">
                                    </td>
                                </form>
                                <form action="dashboard_pd_instoc.php" method="get">
                                    <td>
                                        <input type="text" name="ins_main_category" style="display: none;" value="<?php echo @$_GET["ins_main_category"] ?>">
                                        <select name="ins_ctt_list" class="slc-pd-category">
                                            <?php
                                            $main_category_id = $_GET["ins_main_category"];
                                            find_pd_by_ctt_list($main_category_id);
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" name="btn_instoc2" value="ค้นหา" class="btn-ds-search-pd">
                                    </td>
                                </form>
                                <td><a href="./controller/report_all_product.php" class="btn-export-to-excel-instoc">ดาวน์โหลดไฟล์ Excel</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="ar-show-pd-instoc-res">
                    <div class="pd-res-data-list">
                        <?php
                        @$ckk_btn1 = $_GET["btn_instoc1"];
                        @$btn_instoc3 = $_GET["btn_instoc2"];
                        if (isset($ckk_btn1)) {
                            $main_category_id = $_GET["ins_main_category"];
                            getAllProductInStocResponseCttMain($main_category_id);
                        } else if (isset($btn_instoc3)) {
                            @$ctt_list_id = $_GET["ins_ctt_list"];
                            getAllProductInStocResponseCttList($ctt_list_id);
                        } else {
                            getAllProductInStocResponse();
                        }
                        ?>
                    </div>
                </div>
                <div class="ar-pd-in-stoc-list">
                    <div class="ar-tbl-pd-instoc-img-and-txt">
                        <table class="ar-tbl-pd-in-stoc">
                            <tr class="ar-tr-pd-tbl">
                                <th class="ar-th-pd-ord-title">#</th>
                                <th class="ar-th-pd-num-title">รหัส</th>
                                <th class="ar-th-pd-img-title">รูปภาพ</th>
                                <th class="ar-th-pd-name-title">ชื่อสินค้า</th>
                                <th class="ar-th-pd-price-title">ราคา</th>
                                <th class="ar-th-pd-qt-title">จำนวน</th>
                                <th class="ar-th-pd-st-title">สถานะสินค้า</th>
                                <th class="ar-th-pd-oth-title">ดำเนินการ</th>
                            </tr>
                            <?php
                            include 'controller/add_pd.php';
                            @$ckk_btn1 = $_GET["btn_instoc1"];
                            @$btn_instoc2 = $_GET["btn_ins_pd_name"];
                            @$btn_instoc3 = $_GET["btn_instoc2"];
                            if (isset($ckk_btn1)) {
                                $main_category_id = $_GET["ins_main_category"];
                                find_pd_by_category($main_category_id);
                            } else if (isset($btn_instoc2)) {
                                $pd_name = $_GET["ins_pd_name"];
                                find_pd_by_name($pd_name);
                            } else if (isset($btn_instoc3)) {
                                @$ctt_list_id = $_GET["ins_ctt_list"];
                                get_pd_by_ctt_list($ctt_list_id);
                            } else {
                                getAllProductInStoc();
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