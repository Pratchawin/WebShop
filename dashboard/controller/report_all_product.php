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
            <tr>
                <th>วันที่เพิ่มสินค้า</th>
                <th>ประเภทสินค้าหลัก</th>
                <th>ประเภทสินค้าย่อย</th>
                <th>ชื่อสินค้า</th>
                <th>รหัสสินค้า</th>
                <th>รุ่นสินค้า</th>
                <th>ยี่ห้อสินค้า</th>
                <th>ประกันสินค้า</th>
                <th>รายละเอียดสินค้า</th>
                <th>รายละเอียดภาษาไทย</th>
                <th>รายละเอียดภาษาอังกฤษ</th>
                <th>คุณสมบัติสินค้า 1</th>
                <th>คุณสมบัติสินค้า 2</th>
                <th>คุณสมบัติสินค้า 3</th>
                <th>คุณสมบัติสินค้า 4</th>
                <th>คุณสมบัติสินค้า 5</th>
                <th>ราคาสินค้าปกติ</th>
                <th>จำนวนสินค้า</th>
                <th>สถานะสินค้า</th>
                <th>ค่าจัดส่ง</th>
                <th>% ส่วนลด</th>
                <th>ราคาสินค้ารวมส่วนลด</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../controller/connect.php';
            include '../controller/format.php';
            $conn=connect_bestDB();
            $sql_get_all_products="select 
            tbl_products.date_add,
			tbl_category.category_name,
			tbl_category_ls.category_list_name,
            tbl_products.pd_name,
            tbl_products.pd_code,
            tbl_products.pd_model,
            tbl_products.pd_brand,
            tbl_products.pd_detail,
            tbl_products.pd_slc1,
            tbl_products.pd_slc2,
            tbl_products.pd_slc3,
            tbl_products.pd_slc4,
            tbl_products.pd_slc5,
            tbl_products.pd_price,
            tbl_products.pd_quantity,
            tbl_products.pd_status,
            tbl_products.pd_more_dt_th,
            tbl_products.pd_more_dt_eng,
            tbl_products.shipment_expenses,
            tbl_products.discount,
            tbl_products.pd_insurance,
            tbl_products.for_order_price
            from tbl_products,tbl_category, tbl_category_ls where tbl_category.category_id=tbl_products.category_name and tbl_category_ls.category_list_id=tbl_products.category_list_name order by tbl_products.pd_price desc";
            $sql_pd_rs=mysqli_query($conn, $sql_get_all_products);
            if(mysqli_num_rows($sql_pd_rs)>0){
                while($pd_data=mysqli_fetch_assoc($sql_pd_rs)){
                    $discount=$pd_data["pd_price"]*$pd_data["discount"]/100;
                    $pd_dis=$pd_data["pd_price"]-$discount;//ส่วนลด

                    $pd_vat=$pd_dis*0.07;//ภาษี
                    $pd_price=$pd_dis+$pd_vat;
                    $total_price=$pd_price+$pd_data["shipment_expenses"];
                    $pd_status='';
                    if($pd_data["pd_status"]==0){
                        $pd_status="<td style='color:red;'>สั่งจอง</td>";
                    }else{
                        $pd_status="<td style='color:green;'>มีสินค้าในสต๊อก</td>";
                    }
                    echo "
                        <tr>
                            <td>".$pd_data["date_add"]."</td>
                            <td>".$pd_data["category_name"]."</td>
                            <td>".$pd_data["category_list_name"]."</td>
                            <td>".$pd_data["pd_name"]."</td>
                            <td>".$pd_data["pd_code"]."</td>
                            <td>".$pd_data["pd_model"]."</td>
                            <td>".$pd_data["pd_brand"]."</td>
                            <td>".$pd_data["pd_insurance"]."</td>
                            <td>".$pd_data["pd_detail"]."</td>
                            <td>".$pd_data["pd_more_dt_th"]."</td>
                            <td>".$pd_data["pd_more_dt_eng"]."</td>
                            <td>".$pd_data["pd_slc1"]."</td>
                            <td>".$pd_data["pd_slc2"]."</td>
                            <td>".$pd_data["pd_slc3"]."</td>
                            <td>".$pd_data["pd_slc4"]."</td>
                            <td>".$pd_data["pd_slc5"]."</td>
                            <td>".formatMoney(floatval($pd_data["pd_price"]),true)."</td>
                            <td>".$pd_data["pd_quantity"]."</td>
                            $pd_status
                            <td>".formatMoney(floatval($pd_data["shipment_expenses"]))."</td>
                            <td>".$pd_data["discount"]."</td>
                            <td>".formatMoney(floatval($pd_dis),true)."</td>
                        </tr>
                    ";
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>




<!-- tbl_products.pd_id,	
tbl_products.category_name,	
tbl_products.category_list_name,	
select 
tbl_products.pd_name,
tbl_products.pd_code,
tbl_products.pd_model,
tbl_products.pd_brand,
tbl_products.pd_detail,
tbl_products.pd_slc1,
tbl_products.pd_slc2,
tbl_products.pd_slc3,
tbl_products.pd_slc4,
tbl_products.pd_slc5,
tbl_products.pd_price,
tbl_products.pd_quantity,
tbl_products.pd_status,
tbl_products.pd_more_dt_th,
tbl_products.pd_more_dt_eng,
tbl_products.shipment_expenses,
tbl_products.date_add,
tbl_products.discount,
tbl_products.pd_insurance,
tbl_products.for_order_price,
from tbl_products,tbl_category, tbl_category_ls where tbl_category.category_id=tbl_products.category_name and tbl_category_ls.category_list_id=tbl_products.category_list_name; -->