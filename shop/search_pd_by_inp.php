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
                <div class="ar-show-category-main">
                    <div class="ar-ind2-navleft-title1">
                        <p>ประเภทสินค้าย่อย</p>
                    </div>
                    <?php
                    get_ctt_list2();
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
                    <p id='ckk_search_title'>ประเภทสินค้า
                        <?php
                        echo @$_GET["category_list"];
                        if (!isset($_GET["category_list"])) {
                            echo @$_GET["search_pd"];
                        }
                        ?></p>
                </div>
                <div class="ind2-pd-bx-img-detail">
                    <?php
                    $btn_find_pd = $_POST["btn_search_pd"];
                    //valid_input
                    if (isset($btn_find_pd)) {
                        $find_pd_name = $_POST["search_pd"];
                        find_pd_name($find_pd_name);
                    }
                    function find_pd_name($find_pd_name)
                    {
                        $conn = connect_bestDB();
                            $ckk_inp = mysqli_real_escape_string($conn, $find_pd_name);
                            $sql_get_pd_by_name = "select pd_id, discount, pd_name, category_name, image_file1, pd_price, pd_quantity from tbl_products where pd_name LIKE '%" . $ckk_inp . "%'";
                            $rs_find_pd = mysqli_query($conn, $sql_get_pd_by_name);
                            if (mysqli_num_rows($rs_find_pd) > 0) {
                                echo "<div class='ind2-pd-bx-img-detail'>";
                                while ($row = mysqli_fetch_assoc($rs_find_pd)) {
                                    $pd_price = '';
                                    if ($row["discount"] == 0) {
                                        $pd_price = $row["pd_price"];
                                    } else {
                                        $pd_price = pd_discount($row["discount"], $row["pd_price"]);
                                    }
                                    echo "
                                        <div class='ind2-pd-img-pddt'>
                                            <a href='pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "' class='ind2-pd-link'>
                                                <div class='ind2-ar-pd-img'>
                                                    <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='" . $row["image_file1"] . "' width='100%'>
                                                </div>
                                                <div class='ind2-ar-pd-dt'>
                                                    <div class='ind2-pd-desc'>
                                                        <p class='ind2-pd-desc-txt'>
                                                            " . $row["pd_name"] . "
                                                        </p>
                                                    </div>
                                                    <div class='ind2-pd-price'>
                                                        <p><span class='pd_dis'>" . formatMoney($row["pd_price"], true) . " บาท</span></p>
                                                        <p class='nrm-pd-price'>" . formatMoney($pd_price, true) . " บาท</p>
                                                    </div>
                                                    <div class='ind2-pd-quantity'>
                                                        <p>จำนวนสินค้า " . $row["pd_quantity"] . " เครื่อง</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>";
                                }
                                echo "</div>";
                            } else {
                                echo "<div class='se-not-found'>
                                    <p id='d_pd'>ไม่พบสินค้าที่ค้นหา</p>
                                </div>";
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
<script>
    var h_pd = document.getElementById("ckk_search_title");
    var d_pd = document.getElementById("d_pd");
    if (d_pd) {
        h_pd.style.display = 'none';
    }
</script>

</html>