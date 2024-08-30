<?php
include '../dashboard/controller/connect.php';
include './shop_controller/format.php';

function productInBasketBySetCookie()
{
    if (isset($_COOKIE['pd_inbasket'])) {
        $no = 0;
        $sum = 0;
        foreach ($_COOKIE['pd_inbasket'] as $name => $value) {
            $no += 1;
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);
            $lang = pd_detaitl($value, $no);
            /* print_r($lang); */
            $sum = $lang[0] * $no;
            $shipment = $lang[1] * $no;
            $quantity = $no;
        }
        return array($sum, $shipment, $quantity);
    }
}


function pd_detaitl($pd_id, $no)
{
    $conn = connect_bestDB();
    $sql_pd_detail = "select pd_id, pd_name, image_file1, pd_price, shipment_expenses from tbl_products where pd_id=$pd_id";
    $rs_pd_list = mysqli_query($conn, $sql_pd_detail);
    if (mysqli_num_rows($rs_pd_list) > 0) {
        $row = mysqli_fetch_row($rs_pd_list);
        $pd_price = $row[3];
        $shipment = $row[4];
        $pd_id = $row[0];
        echo "
            <tr>
                <td class='tr-shipping-ls shp-pd-no'>$no</td>
                <td class='tr-shipping-ls shp-pd-img'><img src='../access/uploads_image_file/" . $row[2] . "' alt='" . $row[2] . "' class='shp-img'>
                </td>
                <td class='tr-shipping-ls shp-pd-name'>" . $row[1] . "</td>
                <td class='tr-shipping-ls shp-pd-quantity'>
                    <p><input type='number' name='bs_quantity' id='inp_quantity$no' value='1' class='bs-inp-quantity' onchange='checkValue($no)'></p>
                </td>
                <td class='tr-shipping-ls shp-pd-price'>" . formatMoney($row[3]) . " บาท</td>
                <td class='tr-shipping-ls shp-pd-price'>" . $row[4] . " บาท</td>
                <td class='tr-shipping-ls shp-btn-del'>
                    <div class='shp-show-btn-buy'>
                        <div class='shp-btn-buy-pd'>
                        <form action='formbuypd.php' method='GET'>
                            <input type='text' name='pd_id' value='" . $row[0] . "' class='inp-bs-bx-none'>
                            <input type='text' name='pd_quantity' id='quantity_val$no' value='' class='inp-bs-bx-none'>
                            <input type='text' name='del_pd_id' value='" . $row[0] . "' class='inp-bs-bx-none'>
                            <input type='submit' onclick='getPdQuantity($no)' class='shp-link-buy-pd btn-buy-pd-in-bs-cart' value='สั่งซื้อ'>
                        </form>
                        </div>
                        <div class='shp-btn-del-pd'>
                            <a href='basket.php?basket_st=del_pd&del_pd_id=" . $row[0] . "' class='btn-del-pd'>&#10006;</a>
                        </div>
                    </div>
                </td>
            </tr>
            ";
        $conn->close();
        return array($pd_price, $shipment);
    } else {
        $pd_price=0; $shipment=0;
        return array($pd_price,$shipment);
    }
}
