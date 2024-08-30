<?php
include 'contact_ctt.php';
//เเสดงข้อมูลคำสั่งซื้อ
function ShowOrderDetailAndCtmData($order_id)
{
    $conn = connect_bestDB();
    $sql_get_order_detail = "select ctm_name, order_code, date_order, country, province, amphoe, tambon, zip_code, ctm_email,payment_status, pd_status, pd_id, statement_file,amount,ctm_phone from tbl_orders where order_id='$order_id'";
    $rs_order = mysqli_query($conn, $sql_get_order_detail);
    $order_data = mysqli_fetch_assoc($rs_order);
    $country = '';
    $txt_alert='';
    @$pd_id = $order_data["pd_id"];
    if ($order_data["country"] = "TH") {
        $country = "ประเทศไทย";
    } else {
        $country = $order_data["country"];
    }
    $payment_status = '';
    $status = "";
    if (@$order_data["payment_status"] == 0) {
        $payment_status = "<p style='color:red;'>ยังไม่ชำระเงิน<p>";
        $status = "<p style='color:red;'>สั่งจองสินค้า<p>";
    } else {
        $payment_status = "<p style='color:green;'>ชำระเงินเเล้ว</p>";
        $status = "<p style='color:green;'>สั่งซื้อสินค้า<p>";
        $txt_alert="
            <tr>
                <td class='res-data-img'></td>
                <td class='res-data-img'></td>
                <td><p style='color:red;'>**โปรดตรวจสอบหลักฐานการชำระเงินให้รอบคอบ</p></td>
            </tr>
        ";
    }
    echo "
        <tr>
            <td class='res-data-img'></td>
            <td class='res-data-img'></td>
            <td><img class='data-img-ls' src='../access/statement_file/" . @$order_data["statement_file"] . "' alt=''></td>
        </tr>
        $txt_alert
        <tr>
            <td><b>รหัสคำสั่งซื้อ:</b></td>
            <td>" . @$order_data["order_code"] . "</td>
        </tr>
        <tr>
            <td><b>วันที่สั่งซื้อ:</b></td>
            <td>" . @$order_data["date_order"] . "</td>
        </tr>
        <tr>
            <td><b>ชื่อลูกค้า:</b></td>
            <td>" . @$order_data["ctm_name"] . "</td>
        </tr>
        <tr>
            <td><b>อีเมล:</b></td>
            <td>" . @$order_data["ctm_email"] . "</td>
        </tr>
        <tr>
            <td><b>เบอร์โทรศัพท์:</b></td>
            <td>" . @phone_number_format($order_data["ctm_phone"]) . "</td>
        </tr>
        <tr>
            <td><b>ประเทศ:</b></td>
            <td>" . $country . "</td>
        </tr>
        <tr>
            <td><b>จังหวัด:</b></td>
            <td id='show_province'>" . @$order_data["province"] . "</td>
        </tr>
        <tr>
            <td><b>อำเภอ:</b></td>
            <td id='show_amphoe'>" . @$order_data["amphoe"] . "</td>
        </tr>
        <tr>
            <td><b>ตำบล:</b></td>
            <td id='show_tambon'>" . @$order_data["tambon"] . "</td>
        </tr>
        <tr>
            <td><b>รหัสไปรษณีย์:</b></td>
            <td id='show_tambon'>" . @$order_data["zip_code"] . "</td>
        </tr>
        <tr>
            <td><b>สถานะการสั่งซื้อ:</b></td>
            <td>$status</td>
        </tr>
        <tr>
            <td><b>การชำระเงิน:</b></td>
            <td>" . $payment_status . "</td>
        </tr>
        ";
    return $pd_id;
}

//เเสดงคำสั่งซื้อเพิ่มเติม
function getOrderDetail($order_id)
{
    $conn = connect_bestDB();
    $sql_get_order = "select order_id,order_code,date_order,pd_id,amount,pd_status,ctm_name,ctm_email,statement_file, pd_price, pd_slc1 from tbl_orders where order_id=$order_id";
    $result = mysqli_query($conn, $sql_get_order);
    $tbl_order_data = mysqli_fetch_row($result);
    @$pd_id = $tbl_order_data[3];
    $sql_get_pd_detail = "select pd_name, pd_price, pd_status, pd_name, image_file1, shipment_expenses from tbl_products where pd_id=$pd_id";
    $rs_pd_detail = mysqli_query($conn, $sql_get_pd_detail);
    $rd_pd_detail = mysqli_fetch_row($rs_pd_detail);
    $sum = ($tbl_order_data[9] * $tbl_order_data[4]);
    $vat = ($sum * 0.07);
    $total_price = ($sum + $vat);
    $pd_price_vat_and_shipment = ($total_price + $rd_pd_detail[5]);
    echo "
    <tr>
        <td class='td-pd-or-no res-data-img'>1</td>
        <td class='td-pd-or-no'>
            <img src='../access/uploads_image_file/" . $rd_pd_detail[4] . "' alt='' width='50px'>
        </td>
        <td class='td-pd-or-pd-name'><p class='ar-show-pd-or-detail'>" . $rd_pd_detail[0]." ". $tbl_order_data[10] . "</p></td>
        <td class='td-pd-or-quantity'>" . $tbl_order_data[4] . " ชิ้น</td>
        <td class='td-pd-or-dt-price'>" . formatMoney($tbl_order_data[9], true) . " บาท</td>
        <td class='td-pd-or-dt-total'>" . formatMoney($vat, true) . " บาท</td>
        <td class='td-pd-or-dt-total'>" . formatMoney($total_price, true) . " บาท</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class='res-data-img'></td>
        <td class='td-pd-or-price-tt'>ยอดรวม</td>
        <td class='td-pd-or-price'>" . formatMoney($total_price, true) . " บาท</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class='res-data-img'></td>
        <td class='td-pd-or-price-tt'>ค่าจัดส่ง</td>
        <td class='td-pd-or-price'>" . formatMoney($rd_pd_detail[5], true) . " บาท</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class='res-data-img'></td>
        <td class='td-pd-or-price-tt'>จำนวนเงินรวมทั้งสิ้น</td>
        <td class='td-pd-or-price'>" . formatMoney($pd_price_vat_and_shipment, true) . " บาท</td>
    </tr>
    ";
    $conn->close();
    $order_data_arr = array($tbl_order_data[0], $tbl_order_data[3], $tbl_order_data[4]);
    return $order_data_arr;
}
//เมื่อยกเลิกคำสั่งซื้อ
function cancel_order($order_id)
{
    $conn = connect_bestDB();
    $sql_order_data = "select pd_price, amount,order_id, shipment_ex, total_price,statement_file,date_order, ctm_address, ctm_email, ctm_phone, order_code, pd_name, ctm_name, payment_status, pd_id from tbl_orders where order_id='$order_id'";
    $rs_order = mysqli_query($conn, $sql_order_data);
    if (mysqli_num_rows($rs_order) > 0) {
        $user_data = mysqli_fetch_assoc($rs_order);
        $ckk_status = $user_data["payment_status"];
        $status = "";
        if ($ckk_status == 1) { //ชำระเงินเเล้ว
            $status = "<p>หากลูกค้าได้ชำระเงินค่าสินค้าเเล้วทางบริษัทจะคืนจำนวนเงินในเร็วๆนี้</p>";
        }
        $to = $user_data["ctm_email"];
        $subject = 'bestbuyhatyai.com Cancel order';
        $vat=
        $message = "
            <p>เรียนคุณ: " . $user_data["ctm_name"] . "</p>
            <p><b>เนื่องจากคำสั่งซื้อสินค้าถูกยกเลิกด้วยเหตุผลบางอย่าง ทางบริษัทต้องขออภัยมา ณ ที่นี้</b></p>
            <p><b>ยกเลิกรหัสคำสั่งซื้อ:</b>" . $user_data["order_code"] . "</p>
            <p><b>ชื่อสินค้า:</b>" . $user_data["pd_name"] . "</p>
            <p><b>ราคาสินค้า:</b>" . formatMoney($user_data["pd_price"],true) . " บาท</p>
            <p><b>จำนวน:</b>" . $user_data["amount"] . " ชิ้น</p>
            <p><b>ค่าจัดส่ง:</b>" . formatMoney($user_data["shipment_ex"],true) . " บาท</p>
            <p><b>ราคารวมทั้งสิ้น:</b>" . formatMoney($user_data["total_price"],true) . " บาท</p>
            $status
            <p><b>หากมีข้อสงสัยสามารถติดต่อมาที่</b></p>
            <table>
                <tr>
                    <td>เบอร์โทรศัพท์: </td>
                    <td>".get_cpn_contact(1)."</td>
                </tr>
                <tr>
                    <td>ไลน์: </td>
                    <td>".get_cpn_contact(6)."</td>
                </tr>
                <tr>
                    <td>อีเมล: </td>
                    <td>".get_cpn_contact(4)."</td>
                </tr>
                <tr>
                    <td>แฟกซ์: </td>
                    <td>".get_cpn_contact(2)."</td>
                </tr>
            </table>
        ";
        $header = 'From: 64309010005@htc.ac.th' . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        mail($to, $subject, $message, $header);
        //เพิ่มไปยังประวัติการสั่งซื้อ
        $order_id = $user_data["order_id"];
        $date_order = $user_data["date_order"];
        $statement_file = $user_data["statement_file"];
        $ctm_name = $user_data["ctm_name"];
        $ctm_email = $user_data["ctm_email"];
        $ctm_phone = $user_data["ctm_phone"];
        $ctm_address = $user_data["ctm_address"];
        $pd_id = $user_data["pd_id"];
        $pd_name = $user_data["pd_name"];
        $amount = 0;
        $pd_price = 0;
        $total_price = 0;
        $order_code = $user_data["order_code"];
        $cancel_status = '0';
        $sql_order_his = "insert into tbl_order_history(order_id, date_order,statement_file,ctm_name, ctm_email, ctm_phone, ctm_address, pd_id, pd_name, amount, pd_price, total_price, order_code,cancel_status) values('$order_id','$date_order','$statement_file','$ctm_name','$ctm_email','$ctm_phone','$ctm_address','$pd_id','$pd_name','$amount','$pd_price','$total_price','$order_code','$cancel_status')";
        $ckk_his = mysqli_query($conn, $sql_order_his);
        if ($ckk_his == true) {
            //ลบ order 
            $sql_del_order = "delete from tbl_orders where order_id='$order_id'";
            mysqli_query($conn, $sql_del_order);
        }
    }
    $conn->close();
}
