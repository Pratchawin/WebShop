<?php
function sendEmailToAdmin($order_code, $order_date, $uname, $phone, $email, $pd_id, $quantity, $pd_prop, $ship_ex)
{
    $conn = connect_bestDB();
    $sql_get_pd_data = "select pd_name, image_file1, for_order_price from tbl_products where pd_id=$pd_id";
    $rs_pd_data = mysqli_query($conn, $sql_get_pd_data);
    $pd_data = mysqli_fetch_row($rs_pd_data);
    if ($rs_pd_data == false) {
        echo mysqli_error($conn);
    }
    $price = ($quantity * $pd_data[2]);
    $vat = ($price * 0.07);
    $pd_vat = ($price + $vat);
    $total_price = ($pd_vat + $ship_ex);
    $to = "64309010005@htc.ac.th";
    $subject = 'bestbuyhatyai.com Orders from customer';
    $message = "
                <div style='width: 100%;background-color:#fff;'>
                <div>
                    <center><p><b>คุณมีคำสั่งซื้อใหม่</b></p></center>
                </div>
                <table>
                    <tr>
                        <td>รหัสคำสั่งซื้อ:</td>
                        <td>$order_code</td>
                    </tr>
                    <tr>
                        <td>วันที่สั่งซื้อ:</td>
                        <td>$order_date</td>
                    </tr>
                    <tr>
                        <td>ชื่อลูกค้า:</td>
                        <td>$uname</td>
                    </tr>
                    <tr>
                        <td>เบอร์โทรศัพท์:</td>
                        <td>$phone</td>
                    </tr>
                    <tr>
                        <td>อีเมล:</td>
                        <td>$email</td>
                    </tr>
                    <tr>
                        <td>ชื่อสินค้า:</td>
                        <td>" . $pd_data[0] . "</td>
                    </tr>
                    <tr>
                        <td>ลักษณะสินค้า:</td>
                        <td>" . $pd_prop . "</td>
                    </tr>
                    <tr>
                        <td>ราคา:</td>
                        <td>" . formatMoney($pd_data[2]) . " บาท</td>
                    </tr>
                    <tr>
                        <td>จำนวน:</td>
                        <td>$quantity ชิ้น</td>
                    </tr>
                    <tr>
                        <td>ราคาสินค้ารวมภาษี 7%:</td>
                        <td>" . formatMoney($pd_vat, true) . " บาท</td>
                    </tr>
                    <tr>
                        <td>ค่าจัดส่ง:</td>
                        <td>" . formatMoney($ship_ex, true) . " บาท</td>
                    </tr>
                    <tr>
                        <td>ราคารวมทั้งสิ้น:</td>
                        <td>" . formatMoney($total_price, true) . " บาท</td>
                    </tr>
                </table>
            </div>
        ";
    $conn->close();
    $header = 'From: 64309010005@htc.ac.th' . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    mail($to, $subject, $message, $header);
    line_notify($order_code, $order_date, $uname, $phone, $email, $pd_data[0], $pd_prop, $pd_data[2], $quantity, $pd_vat, $ship_ex, $total_price);
}
function line_notify($order_id, $order_date, $uname, $phone, $email, $pd_name, $pd_prop, $pd_price, $quantity, $vat, $ship_ex, $total_price)
{
    $conn = connect_bestDB();
    $sql_upd_token = "select cpn_data from tbl_cpn_data WHERE cpn_id = 4";
    $rs_data = mysqli_query($conn, $sql_upd_token);
    $line_notify = mysqli_fetch_assoc($rs_data);
    $conn->close();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
    $pd_price = formatMoney($pd_price, true);
    $vat = formatMoney($vat, true);
    $ship_ex = formatMoney($ship_ex, true);
    $total_price = formatMoney($total_price, true);
    $sToken = $line_notify["cpn_data"];
    $sMessage = "
        คุณมีคำสั่งซื้อใหม่
        ------------------------------------------
        รหัสคำสั่งซื้อ: $order_id 
        วันที่สั่งซื้อ: $order_date 
        ------------------------------------------
        ชื่อลูกค้า: $uname 
        เบอร์โทรศัพท์: $phone 
        อีเมล: $email 
        ------------------------------------------
        ชื่อสินค้า: $pd_name 
        ลักษณะสินค้า: $pd_prop 
        ราคา: $pd_price บาท
        จำนวน: $quantity ชิ้น
        ------------------------------------------
        ราคาสินค้ารวมภาษี: $vat บาท
        ค่าจัดส่ง: $ship_ex บาท
        ราคารวมทั้งสิ้น: $total_price บาท
    ";

    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);

    //Result error 
    if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
    } else {
        $result_ = json_decode($result, true);
        $result_['message'];
    }
    curl_close($chOne);
}
