<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=ประวัติการสั่งซื้อ.xls");
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
                <th>วันที่ส่ังซื้อ</th>
                <th>ชื่อลูกค้า</th>
                <th>อีเมล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>ที่อยู่</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาสินค้า</th>
                <th>จำนวนสินค้า</th>
                <th>ค่าจัดส่ง</th>
                <th>ราคาสินค้ารวม vat</th>
                <th>ราคารวมทั้งสิ้น</th>
                <th>การชำระเงิน</th>
                <th>การจัดส่ง</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../controller/connect.php';
            include '../controller/format.php';
            $conn = connect_bestDB();
            $sql_get_order_data = "select statement_file,date_order, ctm_name, ctm_email, ctm_phone, ctm_address, pd_name, amount, pd_price, total_price, order_code, shipment_ex, cancel_status from tbl_order_history";
            $result = mysqli_query($conn, $sql_get_order_data);
            while ($row = mysqli_fetch_assoc($result)) {
                $vat=$row["pd_price"]*0.07;
                $pd_vat=$row["pd_price"]+$vat;
                $pd_price=$row["pd_price"];
                $pd_total_price=$row["total_price"];
                $color="";
                $ckk_payment="";
                $ckk_shipment="";
                if($row["statement_file"]==""){
                    $ckk_payment="ยังไม่ชำระเงิน";
                    $ckk_shipment="ยกเลิก";
                    $color="red";
                }else{
                    $ckk_payment="ชำระเงินเเล้ว";
                    $ckk_shipment="จัดส่งเเล้ว";
                    $color="green";
                }
                if($row["cancel_status"]==0){
                    $ckk_payment="ยกเลิก";
                    $ckk_shipment="ยกเลิก";
                    $color="red";
                }
                echo "
                    <tr>
                        <td>".$row["order_code"]."</td>
                        <td>".$row["date_order"]."</td>
                        <td>".$row["ctm_name"]."</td>
                        <td>".$row["ctm_email"]."</td>
                        <td>".phone_number_format($row["ctm_phone"])."</td>
                        <td>".$row["ctm_address"]."</td>
                        <td>".$row["pd_name"]."</td>
                        <td>".formatMoney(floatval($pd_price),true)."</td>
                        <td>".$row["amount"]." ชิ้น</td>
                        <td>".formatMoney(floatval($row["shipment_ex"]),true)."</td>
                        <td>".formatMoney(floatval($pd_vat),true)."</td>
                        <td>".formatMoney(floatval($pd_total_price),true)."</td>
                        <td style='color:$color;'>".$ckk_payment."</td>
                        <td style='color:$color;'>".$ckk_shipment."</td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</body>
</html>