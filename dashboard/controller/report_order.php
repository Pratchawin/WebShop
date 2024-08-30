<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=ข้อมูลการสั่งซื้อ.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <?php
    include '../controller/connect.php';
    include '../controller/format.php';
    include 'contact_ctt.php';
    $order_id = $_GET["order_id"];
    $conn = connect_bestDB();
    $sql_get_order = "select order_id,order_code,date_order,pd_id,amount,pd_status,ctm_name,ctm_email,
    statement_file, pd_price,ctm_phone, country, province, amphoe, tambon, zip_code, payment_status, statement_file,pd_slc1 from tbl_orders where order_id=$order_id";
    $result = mysqli_query($conn, $sql_get_order);
    $tbl_order_data = mysqli_fetch_row($result);
    $pd_id = $tbl_order_data[3];
    $sql_get_pd_detail = "select pd_name, pd_price, pd_status, pd_name, image_file1, shipment_expenses from tbl_products where pd_id=$pd_id";
    $rs_pd_detail = mysqli_query($conn, $sql_get_pd_detail);
    $rd_pd_detail = mysqli_fetch_row($rs_pd_detail);
    $sum = ($tbl_order_data[9] * $tbl_order_data[4]);
    $vat = ($sum * 0.07);
    $total_price = ($sum + $vat);
    $pd_price_vat_and_shipment = ($total_price + $rd_pd_detail[5]);
    $ckk_payment = '';
    $ckk_file = '';
    $ckk_country = '';
    if ($tbl_order_data[11] == "TH") {
        $ckk_country = "ประเทศไทย";
    } else {
        $ckk_country = $tbl_order_data[11];
    }
    if ($tbl_order_data[16] == 1) {
        $ckk_payment = "ชำระเงินเเล้ว";
    } else {
        $ckk_payment = "ยังไม่ชำระเงิน";
    }
    if ($tbl_order_data[17] != null) {
        $ckk_file = "สั่งซื้อสินค้า";
    } else {
        $ckk_file = "สั่งจองสินค้า";
    }
    ?>

    <table border="none">
        <tbody>
            <?php
            echo "
                    <tr>
                        <td style='border:none;'></td>
                        <td style='border:none;'></td>
                        <td style='border:none;'><br><b>ใบสั่งซื้อ</b><br><br></td>
                        <td style='border:none;'></td>
                        <td style='border:none;'></td>
                        <td style='border:none;'></td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>รหัสคำสั่งซื้อ</b></td>
                        <td style='border:none; text-align:left;'>" . $tbl_order_data[1] . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>วันที่สั่งซื้อ</b></td>
                        <td style='border:none;text-align:left;'>" . strval($tbl_order_data[2]) . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>ชื่อลูกค้า</b></td>
                        <td style='border:none;text-align:left;'>" . $tbl_order_data[6] . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>อีเมล</b></td>
                        <td style='border:none;text-align:left;'>" . $tbl_order_data[7] . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>เบอร์โทรศัพท์</b></td>
                        <td style='border:none;text-align:left;'>" . phone_number_format($tbl_order_data[10]) . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>ประเทศ</b></td>
                        <td style='border:none;text-align:left;'>" . $ckk_country . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>จังหวัด</b></td>
                        <td style='border:none;text-align:left;'>" . $tbl_order_data[12] . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>อำเภอ</b></td>
                        <td style='border:none;text-align:left;'>" . $tbl_order_data[13] . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>ตำบล</b></td>
                        <td style='border:none;text-align:left;'>" . $tbl_order_data[14] . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>รหัสไปรษณีย์</b></td>
                        <td style='border:none;text-align:left;'>" . strval($tbl_order_data[15]) . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>สถานะคำสั่งซื้อ</b></td>
                        <td style='border:none;text-align:left;'>" .  $ckk_file . "</td>
                    </tr>
                    <tr>
                        <td style='border:none;'><b>การชำระเงิน</b></td>
                        <td style='border:none;text-align:left;'>" . $ckk_payment . "</td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td style='border:none;'><b>ผู้จำหน่าย</b></td>
                    </tr>
                    <tr>
                        <td style='border:none;'></td>
                        <td style='border:none;text-align:left;'>
                            บริษัท เบส บาย ซัพพลาย หาดใหญ่<br>
                            ที่อยู่:".get_cpn_contact(5)."<br>
                            เบอร์โทรศัพท์: ".get_cpn_contact(1)."<br>
                            แฟกซ์: ".get_cpn_contact(2)."<br>
                            อีเมล: ".get_cpn_contact(4)."<br>
                            ไลน์: ".get_cpn_contact(6)."<br>
                        </td>
                    </tr>
                ";
            ?>
        </tbody>
        <thead>
            <br>
            <br>
            <tr class="info">
                <th>ลำดับ</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>ราคาสินค้า</th>
                <th>vat 7%</th>
                <th>ราคาสินค้ารวม vat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo "
                <tr>
                    <td class='td-pd-or-no'>1</td>
                    <td class='td-pd-or-pd-name'><p class='ar-show-pd-or-detail'>" . $rd_pd_detail[0] ." ".$tbl_order_data[18]. "</p></td>
                    <td class='td-pd-or-quantity'>" . $tbl_order_data[4] . " ชิ้น</td>
                    <td class='td-pd-or-dt-price'>" . formatMoney($tbl_order_data[9],true) . " บาท</td>
                    <td class='td-pd-or-dt-total'>" . formatMoney($vat,true) . " บาท</td>
                    <td class='td-pd-or-dt-total'>" . formatMoney($total_price,true) . " บาท</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='td-pd-or-price-tt'><b>ยอดรวม</b></td>
                    <td class='td-pd-or-price'>" . formatMoney($total_price,true) . " บาท</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='td-pd-or-price-tt'><b>ค่าจัดส่ง</b></td>
                    <td class='td-pd-or-price'>" . formatMoney($rd_pd_detail[5],true) . " บาท</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='td-pd-or-price-tt'><b>จำนวนเงินรวมทั้งสิ้น</b></td>
                    <td class='td-pd-or-price'>" . formatMoney($pd_price_vat_and_shipment,true) . " บาท</td>
                </tr>
                ";
            ?>
        </tbody>
    </table>
</body>

</html>