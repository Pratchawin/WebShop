<!DOCTYPE html>
<?php
include 'shop_controller/basket_controller.php';
@$pd_id = $_GET["pd_id"];
function getPdDetailAndQuantity($pd_id)
{
    //ตั้งค่า cookie
    setcookie("pd_inbasket[$pd_id]", $pd_id, time() + (86400 * 90), "/");
    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/shop/basket.php'>";
}
if (isset($pd_id)) {
    getPdDetailAndQuantity($pd_id);
}
//ลบสินค้าในตะกร้าสินค้า
if (isset($_GET["del_pd_id"])) {
    $del_pd_id = $_GET["del_pd_id"];
    setcookie("pd_inbasket[$del_pd_id]", "pd_inbasket[54]", time() - 3600, "/");
    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/shop/basket.php'>";
    /* del_pd_in_basket($del_pd_id); */
}
?>
<html lang="en">
<?php session_start(); ?>

<head>
    <?php
    include 'set_meta.php';
    ?>
    <link rel="stylesheet" href="shop_style/index.css">
    <link rel="stylesheet" href="shop_style/web_responsive.css">
    <link rel="stylesheet" href="shop_style/navtop.css">
    <link rel="stylesheet" href="shop_style/pdreview.css">
    <link rel="stylesheet" href="shop_style/basket.css">
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
    <div class="ar-shipping-cart-content">
        <div class="ar-shipping-cart-ls">
            <div class="ar-tbl-shipping-pd-ls">
                <div class="tbl-shipping">
                    <div class="ar-shipping-title">
                        <h3 class="shipping-title set-inline">ตะกร้าสินค้า</h3>
                    </div>
                    <div class="ar-tbl-bs-ctn">
                        <table class="tbl-show-pd-in-shipping-cart">
                            <tr>
                                <th class="th-shp-cart">#</th>
                                <th class="th-shp-cart">รูปสินค้า</th>
                                <th class="th-shp-cart">ชื่อสินค้า</th>
                                <th class="th-shp-cart">จำนวน</th>
                                <th class="th-shp-cart">ราคา</th>
                                <th class="th-shp-cart">ค่าจัดส่ง</th>
                                <th class="th-shp-cart">-</th>
                            </tr>
                            <?php
                            $sum = productInBasketBySetCookie();
                            if ($sum == null) {
                                $sum[0] = 0;
                                $sum[1] = 0;
                                $sum[2] = 0;
                            }
                            /* print_r($sum); */
                            ?>
                        </table>
                    </div>
                </div>
                <div class="ar-total-price">
                    <div class="ar-shipping-title">
                        <h3 class="shp-total-title set-inline">มูลค่ารวม</h3>
                    </div>
                    <div class="ar-tbl-total-pd-and-shp">
                        <table class="tbl-showpd-total-left-cnt">
                            <tr>
                                <td class="td-txt-title">จำนวนสินค้า:</td>
                                <td><span id='pd_quantity'><?php echo $sum[2]; ?></span> ชิ้น</td>
                            </tr>
                            <tr>
                                <td class="td-txt-title">ราคารวม VAT 7%:</td>
                                <td>
                                    <?php
                                    $vat = ($sum[0] * 7) / 100;
                                    $total_price = $sum[0] + $vat;
                                    echo formatMoney($total_price);
                                    ?> บาท
                                </td>
                            </tr>
                            <tr>
                                <td class="td-txt-title">ค่าจัดส่ง:</td>
                                <td><?php echo formatMoney($sum[1]); ?> บาท</td>
                            </tr>
                            <tr>
                                <td class="td-txt-title">ราคารวมทั้งสิ้น:</td>
                                <td><span id="ckk_pd_price"><?php echo formatMoney($total_price + $sum[1]); ?></span> บาท</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="../shop/store_js/navtop.js"></script>
<script src="../shop/store_js/basket.js"></script>

</html>