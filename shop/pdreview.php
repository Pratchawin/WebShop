<!DOCTYPE html>
<html lang="en">
<?php
session_start();
@$pd_id = $_GET["pd_id"];
@$category = $_GET["category_id"];
@$ckk_pd_id = $_COOKIE["pd_id"];
@$ckk_category = $_COOKIE["category"];
@$pd_id = $_GET["pd_id"];
@$category_id = $_GET["category_id"];
if (!isset($pd_id) && !isset($category_id)) {
    $pd_id = $ckk_pd_id;
    $category_id = $ckk_category;
}
?>

<head>
    <?php
    include 'set_meta.php';
    ?>
    <link rel="stylesheet" href="shop_style/index.css">
    <link rel="stylesheet" href="shop_style/web_responsive.css">
    <link rel="stylesheet" href="shop_style/navtop.css">
    <link rel="stylesheet" href="shop_style/pdreview.css">
    <meta property="og:url" content="https://www.your-domain.com/your-page.html" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Your Website Title" />
    <meta property="og:description" content="Your description" />
    <meta property="og:image" content="https://www.your-domain.com/path/image.jpg" />
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-web-ecom-ind-container">
        <?php
        include 'indnavtop.php';
        include 'shop_controller/session_controller.php';
        include './shop_controller/pd_preview_controller.php';
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
                    $conn = connect_bestDB();
                    $sql_get_main_category = "select category_id, category_name from tbl_category";
                    $rs_navleft = mysqli_query($conn, $sql_get_main_category);
                    if (mysqli_num_rows($rs_navleft) > 0) {
                        while ($ctt_data = mysqli_fetch_assoc($rs_navleft)) {
                            echo "
                                <div class='ar-ind2-navleft-ctn'>
                                    <a href='./show_pd_category.php?category_id=" . $ctt_data["category_id"] . "&category_list=" . $ctt_data["category_name"] . "' class='ind2-nav-left-link'>" . $ctt_data["category_name"] . "</a>
                                </div>
                            ";
                        }
                    }
                    $conn->close();
                    ?>
                </div>
                <?php
                $prw_category_id = $_GET["category_id"];
                getNavLeftCategoryList($prw_category_id);
                ?>
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
            <div class="ar-pdrw-content-right">
                <div class="ar-pdreview-img-details">
                    <div class="pd-img-and-pd-detail">
                        <div class="pd-img-ind-ls">
                            <?php
                            if (isset($pd_id)) {
                                showProductImage($pd_id);
                            }
                            ?>
                        </div>
                        <div class="ar-pd-detail-and-form-buy-pd">
                            <div class="ar-form-buy-pd-data">
                                <?php
                                if ($_GET["pd_id"]) {
                                    showProductPreview($pd_id);
                                }
                                ?>
                                <div class="pdrw-sh-btn-inc-red" id='ckk_btn_qt_is_null'>
                                    <button type="submit" class="pdrw-btn-inc" onclick="BtnPdReviewIncAndRed('-')">-</button>
                                    <p class="pdrw-show-tt-qt" id="pdrwquantitty"></p>
                                    <button type="submit" class="pdrw-btn-red" onclick="BtnPdReviewIncAndRed('+')">+</button>
                                </div>
                                <div class="pdrw-sh-pd-total-price pew-res-show-pd" id='ckk_btn_qt_is_null2'>
                                    <div class="pdrw-btn-buy-bd">
                                        <form action="formbuypd.php" id="form_set_action" method="GET">
                                            <input type="text" name="pd_quantity" id="inppdquan" class="pd-quan-dis-none">
                                            <input type="text" name="pd_prop" id="inp_pd_prop" class="pd-quan-dis-none">
                                            <input type="text" id="pd_id" name="pd_id" value="<?php echo $pd_id; ?>" class="pd-quan-dis-none">
                                            <input type="text" id="ctt_id" name="category_id" value="<?php echo $prw_category_id; ?>" class="pd-quan-dis-none">
                                            <input type="submit" onclick="check_pd_quantity()" value="ซื้อสินค้า" class="ar-btn-buy-pd">
                                        </form>
                                    </div>
                                    <div class="pdrw-btn-buy-bd">
                                        <form action="basket.php" method="GET">
                                            <input type="text" name="pd_quantity" id="inppdquan2" class="pd-quan-dis-none">
                                            <input type="text" name="pd_id" value="<?php echo $pd_id; ?>" class="pd-quan-dis-none">
                                            <input type="submit" name="pd_id_bs" value="เพิ่มไปยังตะกร้าสินค้า" class="ar-btn-add-to-shipping">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ar-pdreview-show-pd-desc-oth" id="show-product-detail-oth">
                    <div class="ar-pdrw-desc-title">
                        <p><b>รายละเอียดสินค้าเพิ่มเติม</b></p>
                    </div>
                    <div class="ar-pd-desc-details" id='show_oth_content'>
                        <div class="ar-pd-desc-detail-th" id="show_pd_desc_oth">
                            <div class="ar-dis-play-none" id="ShowOthTitle" onclick="BtnShowPdrwOth()">
                                <div class="ar-show-read-more">
                                    <p>เพิ่มเติม</p>
                                </div>
                            </div>
                            <div class='ar-pd-detail-th'>
                                <?php
                                showProductDetailTh($pd_id, "TH");
                                ?>
                            </div>
                        </div>
                        <div class="ar-pd-desc-detail-eng">
                            <div>
                                <?php
                                showProductDetailTh($pd_id, "ENG");
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="ar-dis-play-none" id="DelOthTitle" onclick="BtnDelPdrwOth(1)">
                        <div class="ar-btn-read-more">
                            <p class="set-txt-margin" id='title_btn_oth'>เพิ่มเติม</p>
                        </div>
                    </div>
                </div>
                <div class="ar-pdreview-other-list">
                    <div class="ar-pd-oth-title">
                        <p><b>ประเภทสินค้าที่เหมือนกัน</b></p>
                    </div>
                    <div class="ar-pd-oth-ls-bx">
                        <div class="ar-pd-oth-ls-bx">
                            <?php
                            getProductOther($pd_id);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="ar-link-other-pd">
                    <?php
                    @$get_ctt_id = $_GET["category_id"];
                    $conn = connect_bestDB();
                    $sql_get_ctt_name = "select category_name from tbl_category where category_id='$get_ctt_id'";
                    $rs_ctt_name = mysqli_query($conn, $sql_get_ctt_name);
                    $ctt_name = mysqli_fetch_assoc($rs_ctt_name);
                    ?>
                    <a href="show_pd_category.php?category_id=<?php echo $get_ctt_id; ?>&category_list=<?php echo $ctt_name["category_name"]; ?>" class="pd-rw-link-see-more">ดูเพิ่มเติม</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="./store_js/pdreview.js"></script>
<script src="./store_js/navtop.js"></script>

</html>