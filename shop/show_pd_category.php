<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <?php
    include 'set_meta.php';
    ?>
    <link rel="stylesheet" href="shop_style/index.css">
    <link rel="stylesheet" href="shop_style/web_responsive.css">
    <link rel="stylesheet" href="shop_style/navtop.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-web-ecom-ind-container">
        <?php
        include 'indnavtop.php';
        include 'ind_nav_left.php';
        include 'shop_controller/session_controller.php';
        include 'shop_controller/category_controller.php';
        $username = get_user_name();
        showIndNavTop(1, $username);
        ?>
    </div>
    <div class="ar-web-ecom-content">
        <div class="ar-web-content-2">
            <div class="ar-web-content-left">
                <div class="ar-show-category-main">
                    <div class="ar-ind2-navleft-title">
                        <p>ประเภทสินค้าหลัก</p>
                    </div>
                    <?php
                    get_main_category();
                    ?>
                </div>
                <div class="ar-show-category-list-nav-left">
                    <div class="ar-ind2-navleft-title1">
                        <p><?php echo @$_GET["category_list"]; ?></p>
                    </div>
                    <?php
                    @$category_id = $_GET["category_id"];
                    get_ctt_list($category_id);
                    ?>
                </div>
                <div class="ar-show-category-list-nav-left">
                    <div class="ar-ind2-navleft-title2">
                        <p>ยี่ห้อสินค้า</p>
                    </div>
                    <?php
                    findProductBrand2();
                    function findProductBrand2()
                    {
                        $conn = connect_bestDB();
                        $sql_find_brand = "select brand_id, brand_name from tbl_pd_brand";
                        $rs_brand = mysqli_query($conn, $sql_find_brand);
                        //ดึงสินค้าที่เเบรนด์เหมือนกัน
                        if (mysqli_num_rows($rs_brand) > 0) {
                            while ($row = mysqli_fetch_assoc($rs_brand)) {
                                echo "
                                    <div class='ar-ind2-navleft-ctn'>
                                        <i class='fa-solid fa-star star-color'></i><a href='show_pd_brand.php?brand_name=" . $row["brand_name"] . "' class='ind2-nav-left-link'>" . $row["brand_name"] . "</a>
                                    </div>
                                ";
                            }
                        } else {
                            echo "";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="ar-ind2web-content-right-cate">
                <div class="ar-ind2web-ctn-pd-title">
                    <p><b> ประเภทสินค้า:</b> <?php echo @$_GET["category_list"]; ?></p>
                </div>
                <div class="ar-ind2web-ctn-pd-title">
                    <?php
                    if (isset($_GET["category_list_id"])) {
                        echo "
                                <a class='btn-order-pd-price' href='show_pd_category.php?category_id=" . $_GET['category_id'] . "&category_list=" . $_GET['category_list'] . "&category_list_id=" . $_GET['category_list_id'] . "&btn_pd_order=asc'>สินค้าราคาถูก</a>
                            ";
                        echo "
                                <a class='btn-order-pd-price' href='show_pd_category.php?category_id=" . $_GET['category_id'] . "&category_list=" . $_GET['category_list'] . "&category_list_id=" . $_GET['category_list_id'] . "&btn_pd_order=desc'>สินค้าราคาเเพง</a>
                            ";
                    } else {
                        echo "
                                <a class='btn-order-pd-price' href='show_pd_category.php?category_id=" . $_GET['category_id'] . "&category_list=" . $_GET['category_list'] . "&btn_pd_order1=asc'>สินค้าราคาถูก</a>
                            ";
                        echo "
                                <a class='btn-order-pd-price' href='show_pd_category.php?category_id=" . $_GET['category_id'] . "&category_list=" . $_GET['category_list'] . "&btn_pd_order1=desc'>สินค้าราคาเเพง</a>
                            ";
                    }
                    ?>
                </div>
                <div class="ind2-pd-bx-img-detail">
                    <?php
                    @$main_category_id = $_GET["category_id"];
                    @$list_category_id = $_GET["category_list_id"];
                    @$find_pd_name = $_GET["btn_search_pd"];
                    @$btn_pd_order = $_GET["btn_pd_order"];
                    @$btn_pd_order2 = $_GET["btn_pd_order1"];
                    if (isset($list_category_id)) {
                        if (isset($btn_pd_order)) {
                            $keyword = $_GET["btn_pd_order"];
                            get_pd_by_ctt_list($list_category_id, $keyword);
                        } else {
                            get_pd_by_ctt_list($list_category_id, "");
                        }
                    } else {
                        if (isset($btn_pd_order2)) {
                            $keyword2 = $_GET["btn_pd_order1"];
                            get_pd_buy_ctt_main2($main_category_id, $keyword2);
                        } else {
                            get_pd_buy_ctt_main($main_category_id, "");
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="store_js/index.js"></script>
<script src="store_js/navtop.js"></script>

</html>