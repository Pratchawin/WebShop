<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=คำสั่งซื้อวันที่".date("d/m/y").".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <table border="1" class="table table-hover">
        <thead>
            <tr class="info">
                <th>รหัสคำสั่งซื้อ</th>
                <th>วันที่เเละเวลาที่สั่งซื้อ</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาต่อหน่วย</th>
                <th>จำนวน</th>
                <th>vat 7%</th>
                <th>ค่าจัดส่ง</th>
                <th>ยอดรวมทั้งสิ้น</th>
                <th>สถานะการสั่งซื้อ</th>
                <th>การชำระเงิน</th>
                <th>ชื่อลูกค้า</th>
                <th>เบอร์โทรศัพท์</th>
                <th>อีเมล</th>
                <th>ประเทศ</th>
                <th>จังหวัด</th>
                <th>อำเภอ</th>
                <th>ตำบล</th>
                <th>ที่อยู่</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../controller/connect.php';
            include '../controller/format.php';
            $conn = connect_bestDB();
            $sql_get_order_data = "select order_code,date_order,pd_id,amount,pd_status,ctm_id,ctm_name,ctm_email,ctm_phone,ctm_address,statement_file,payment_status,zip_code,tambon,amphoe,province,country,pd_price,shipment_ex,total_price,pd_name,pd_slc1 from tbl_orders";
            $result = mysqli_query($conn, $sql_get_order_data);
            $num_row = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $status = '';
                if ($row["payment_status"] == 0) {
                    $status = "สั่งจองสินค้า";
                } else {
                    $status = "สั่งซื้อสินค้า";
                }
                $payment = "";
                if ($row["payment_status"] == 0) {
                    $payment = "ยังไม่ชำระเงิน";
                } else {
                    $payment = "ชำระเงินเเล้ว";
                }
                $country = '';
                if ($row["country"] == "TH") {
                    $country = "ประเทศไทย";
                } else {
                    $country = $row["country"];
                }
                $total = $row["pd_price"] * $row["amount"];
                $vat = $total * 0.07;
                $total_price = $total + $vat + $row["shipment_ex"];
                echo '
                    <tr>
                        <td>' . $row["order_code"] . '</td>
                        <td>' . $row["date_order"] . '</td>
                        <td>' . $row["pd_name"] .'</td>
                        <td>' . formatMoney($row["pd_price"], true) . '</td>
                        <td>' . $row["amount"] . '</td>
                        <td>' . formatMoney($vat, true) . '</td>
                        <td>' . $row["shipment_ex"] . '</td>
                        <td>' . formatMoney($total_price, true) . '</td>
                        <td>' . $status . '</td>
                        <td>' . $payment . '</td>
                        <td>' . $row["ctm_name"] . '</td>
                        <td>' . phone_number_format($row["ctm_phone"]) . '</td>
                        <td>' . $row["ctm_email"] . '</td>
                        <td>' . $country . '</td>
                        <td>' . $row["province"] . '</td>
                        <td>' . $row["amphoe"] . '</td>
                        <td>' . $row["tambon"] . '</td>
                        <td>' . $row["ctm_address"] . '</td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>