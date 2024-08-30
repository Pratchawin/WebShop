<?php
include 'connect.php';
include 'format.php';
function getOrderFromDB()
{
    $conn = connect_bestDB();
    $sql_get_order = "select payment_status,order_id,pd_price,order_code,date_order,pd_id,amount,pd_status,ctm_name,ctm_email,statement_file,pd_slc1 from tbl_orders";
    $result = mysqli_query($conn, $sql_get_order);
    $i = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image_file = getProductData($row["pd_id"]);
            $order_id = $row["order_id"];
            $bn_status = '';
            $payment_status=null;
            if ($row["statement_file"] == null) {
                $bn_status = "สั่งจอง";
            } else {
                $bn_status = "<p class='ds-pd-payment-status'>สั่งซื้อสินค้า</p>";
            }
            if($row["payment_status"]==1){
                $payment_status="<p class='ds-pd-payment-status'>ชำระเงินเเล้ว</p>";
            }else{
                $payment_status="<p style='color:red;' >ยังไม่ชำระเงิน</p>";
            }
            $i++;
            echo "
                <tr class='ds-tr-or-list-line'>
                            <td class='td-ds-pd-or-detail-no'>$i</td>
                            <td class='td-ds-pd-or-detail-date'>" . $row["date_order"] . "</td>
                            <td class='td-ds-pd-or-detail-img'>
                                <img src='../access/uploads_image_file/" . $image_file[1] . "' alt='" . $image_file[1] . "' width='50px'>
                            </td>
                            <td class='td-ds-pd-or-detail-ind'>" . $image_file[0]." ".$row["pd_slc1"]. "</td>
                            <td class='td-ds-pd-or-detail-price'>" . formatMoney($row["pd_price"]) . " บาท</td>
                            <td class='td-ds-pd-or-detail-quantity'>" . $row["amount"] . " ชิ้น</td>
                            <td class='td-ds-pd-or-detail-uname'>" . $row["ctm_name"] . "</td>
                            <td class='td-ds-pd-or-detail-or-status'>
                                <p class='ds-pd-status'>$bn_status</p>
                            </td>
                            <td class='td-ds-pd-or-pm-status'>
                                $payment_status
                            </td>
                            <td class='td-ds-pd-or-detail-oth-btn'>
                                <a href='dashboard_order_detail.php?order_id=$order_id' class='ar-btn-show-pd-dsc'>ดำเนินการ</a>
                                <a href='dashboard_order_detail.php?order_id=$order_id' class='ar-btn-show-pd-dsc-res'>เปิด</a>
                            </td>
                        </tr>
                ";
        }
    }
    $conn->close();
}

//เเสดงข้อมูลสินค้าแบบย่อ
function getProductData($pd_id)
{
    $conn = connect_bestDB();
    $sql_getImageFile = "select pd_name, image_file1, shipment_expenses from tbl_products where pd_id=$pd_id";
    $result = mysqli_query($conn, $sql_getImageFile);
    $image_file = mysqli_fetch_row($result);
    $image_file[0];//pd_detail
    $image_file[1];//image_file
    $image_file[2];//shipment_expemses
    $pd_detail = array($image_file[0], $image_file[1], $image_file[2]);
    $conn->close();
    return $pd_detail;
}
//เเสดงจำนวนคำสั่งซื้อ
function dashboardShowOrder(){
    $conn=connect_bestDB();
    $sql_get_order="select amount from tbl_orders";
    $result = mysqli_query($conn,$sql_get_order);
    $num_rows = mysqli_num_rows($result);
    echo $num_rows;
    $conn->close();
}
//เเสดงรายการสินค้าที่ชำระเงินเเล้ว
function productPaymentSuccess(){
    $conn=connect_bestDB();
    $sql_get_pd_payment="select payment_status from tbl_orders where payment_status=1";
    $rs_pd_payment=mysqli_query($conn,$sql_get_pd_payment);
    $tt_pd_payment=mysqli_num_rows($rs_pd_payment);
    echo $tt_pd_payment;
    $conn->close();
}
//เเสดงรายการสินค้าที่ยังไม่ชำระเงิน
function productPaymentNt(){
    $conn=connect_bestDB();
    $sql_get_pd_payment="select payment_status from tbl_orders where payment_status=0";
    $rs_pd_payment=mysqli_query($conn,$sql_get_pd_payment);
    $test=mysqli_num_rows($rs_pd_payment);
    if($test>=0){
        echo $test;
    }else{
        echo 0;
    }
    $conn->close();
}
//เเสดงจำนวนสินค้าในสต๊อกสินค้า
function getProductInStoc(){
    $conn=connect_bestDB();
    $sql_get_pd_in_stock="select pd_id from tbl_products";
    $pd_rs=mysqli_query($conn,$sql_get_pd_in_stock);
    $pd_in_stoc=mysqli_num_rows($pd_rs);
    echo $pd_in_stoc;
    $conn->close();
}
//เเสดงมูลค่ารวมทั้งหมด
function getTotalValue(){
    $conn=connect_bestDB();
    $sql_get_total_value="select pd_price, amount from tbl_orders";
    $rs_tt_value=mysqli_query($conn,$sql_get_total_value);
    $total_value=0;
    $total_price=0;
    $total=0;
    if(mysqli_num_rows($rs_tt_value)>0){
        while($row=mysqli_fetch_assoc($rs_tt_value)){
            $total_value+=$row["amount"];
            $total_price+=$row["pd_price"];
            $total+=$row["amount"]*$row["pd_price"];
        }
    }
    $conn->close();
    return formatMoney($total,true);
}
//เเสดงจำนวนสินค้าที่จัดส่งเเล้ว
function getPdShipment(){
    $conn=connect_bestDB();
    $sql_or_scc="select order_id from tbl_order_history where cancel_status=''";
    $rs_ship_scc=mysqli_query($conn, $sql_or_scc);
    $num_of_ship_scc=mysqli_num_rows($rs_ship_scc);
    return $num_of_ship_scc;
}
//เเสดงยอดขยารวม
function getTotalSales(){
    $amount=0;
    $conn=connect_bestDB();
    $sql_or_scc="select pd_price, amount from tbl_order_history";
    $rs_ship_scc=mysqli_query($conn, $sql_or_scc);
    if(mysqli_num_rows($rs_ship_scc)>0){
        while($total_salse=mysqli_fetch_assoc($rs_ship_scc)){
            $amount+=$total_salse["amount"]*$total_salse["pd_price"];
        }
    }
    //echo "จำนวนสินค้าทั้งหมด=>",$amount."<br>";
    return formatMoney($amount,true);
}
//เเสดงจำนวนผู้เข้าชม
function countUserAccount(){
    $conn=connect_bestDB();
    $sql_num="select * from counter";
    $rs_count_account=mysqli_query($conn, $sql_num);
    $count=mysqli_num_rows($rs_count_account);
    echo $count;
}