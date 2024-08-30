<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <?php
    include 'dashboard_meta.php';
    ?>
    <link rel="stylesheet" href="dashboard_style/dashboard.css">
    <link rel="stylesheet" href="dashboard_style/dashboard_open_order.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>
<?php
include './controller/dashboard_ctt.php';
include './controller/dashboard_order_ctt.php';

$conn = connect_bestDB();
@$conf_order = $_GET["conf"];
@$conf_order_id = $_GET["order_id"];
@$conf_pd_id = $_GET["pd_id"];
$ckk_del = '';
if (isset($conf_order)) {
    $ckk_del = del_pd_quantity($conf_pd_id, $conn);
    if (!$ckk_del == false) {
        add_order_to_history($conn, $conf_order_id);
    }
}
//ลดจำนวนสินค้าลงเมื่อมีการยืนยันคำสังซื้อ
function del_pd_quantity($conf_pd_id, $conn)
{
    @$get_pd_quantity = $_GET["pd_quantity"];
    //update_pd_quantity
    $sql_get_pd_quantity = "select pd_quantity from tbl_products where pd_id=$conf_pd_id";
    $rs_get_pd_quantity = mysqli_query($conn, $sql_get_pd_quantity);
    $pd_quantity = mysqli_fetch_row($rs_get_pd_quantity);
    if ($pd_quantity[0] <= 0) {
        $conn = connect_bestDB();
        $update_pd_status = "update tbl_products set pd_status='0', pd_quantity='0' where pd_id=$conf_pd_id";
        mysqli_query($conn, $update_pd_status);
        $ckk_pd_quantity_status = "<p style='color:red;'>**จำนวนสินค้าไม่เพียงพอ</p>";
        $conn->close();
        return $ckk_pd_quantity_status;
    } else {
        $ckk_pd_quantity_status = "<p style='color:green;'>ส่งข้อมูลไปยังลูกค้าเรียบร้อย</p>";
        $new_update_quantity = ($pd_quantity[0] - $get_pd_quantity);
        $update_pd_quantity = "update tbl_products set pd_quantity=$new_update_quantity where pd_id = '$conf_pd_id'";
        $ckk_del = mysqli_query($conn, $update_pd_quantity);
        if ($ckk_del == 1) {
            return "$ckk_pd_quantity_status";
        } else {
            return $ckk_del;
        }
    }
}
//ส่งอีเมลไปยังลูกค้า
function send_mail_to_user($order_id)
{
    $conn = connect_bestDB();
    $sql_order = "select date_order,order_code,ctm_email, ctm_name, ctm_address,tambon,amphoe, province,zip_code, order_code, pd_name, pd_price, amount, total_price, shipment_ex, pd_status, pd_slc1  from tbl_orders where order_id='$order_id'";
    $rs_order_data = mysqli_query($conn, $sql_order);
    $user_data = mysqli_fetch_assoc($rs_order_data);
    @$total_price = ($user_data["pd_price"] * $user_data["amount"]);
    $vat = $total_price * 0.07;
    $pd_tt_vat = $total_price + $vat;
    @$sum = $pd_tt_vat + $user_data["shipment_ex"];
    if ($user_data == false) {
        echo "";
    } else {
        $to = $user_data["ctm_email"];
        $subject = 'bestbuyhatyai.com Confirm order';
        $message = "
            <div style='blackground-color:white;'>
                <div class='order-ctm-data'>
                    <p><b>ทางบริษัทได้ทำการบรรจุสินค้าเเละจัดส่งเเล้ว</b></p>
                    <p>ชื่อลูกค้า:" . $user_data["ctm_name"] . "</p>
                    <p><b>ที่อยู่ในการจัดส่ง</b></p>
                    <p>" . $user_data["ctm_address"] . "<br>" . $user_data["province"] . "<br>" . $user_data["amphoe"] . "<br>" . $user_data["tambon"] . "<br> " . $user_data["zip_code"] . "</p>
                </div>
                <div class='order-pd-data'>
                    <p><b>หมายเลขคำสั่งซื้อ:" . $user_data["order_code"] . "</b></p>
                    <p><b>ชื่อสินค้า: </b>" . $user_data["pd_name"] ." ".$user_data["pd_slc1"]. "</p>
                    <p><b>ราคา: </b>" . formatMoney($user_data["pd_price"], true) . " บาท</p>
                    <p><b>จำนวน: </b>" . $user_data["amount"] . " ชิ้น</p>
                </div>
                <div>
                    <p><b>ยอดรวม: </b>" . formatMoney($total_price, true) . " บาท</p>
                    <p><b>vat 7%: </b>" . formatMoney($vat, true) . " บาท</p>
                    <p><b>ราคารวม vat: </b>" . formatMoney($pd_tt_vat, true) . " บาท</p>
                    <p><b>ค่าจัดส่ง: </b>" . formatMoney($user_data["shipment_ex"]) . " บาท</p>
                    <p><b>ราคารวมทั้งสิ้น: </b>" . formatMoney($sum, true) . " บาท</p>
                </div>
                <div>
                    <p><b>หากมีข้อสงสัยสามารถติดต่อได้ที่</b></p>
                        <p>โทรศัพท์: ".get_cpn_contact(1)."</p>
                        <p>แฟกซ์: ".get_cpn_contact(2)."</p>
                        <p>อีเมล: ".get_cpn_contact(4)."</p>
                        <p>ไลน์: ".get_cpn_contact(6)."</p>
                </div>
            </div>
        ";
        $header = 'From: 64309010005@htc.ac.th' . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        mail($to, $subject, $message, $header);
    }
}

//เพิ่มข้อมูลไปยังประวัติการสั่งซื้อ
function add_order_to_history($conn, $conf_order_id)
{
    $sql_get_old_order_and_insert_into_tbl_hisstory = "INSERT INTO tbl_order_history(order_id,order_code,date_order,statement_file,ctm_name,ctm_email,ctm_phone,ctm_address,ctm_id,pd_id,pd_name,amount,pd_price,total_price,shipment_ex) SELECT order_id,order_code,date_order,statement_file,ctm_name,ctm_email,ctm_phone,ctm_address,ctm_id,pd_id,pd_name,amount,pd_price,total_price,shipment_ex FROM tbl_orders WHERE order_id=$conf_order_id";
    $ckk_ins = mysqli_query($conn, $sql_get_old_order_and_insert_into_tbl_hisstory);
    if ($ckk_ins != true) {
        echo mysqli_error($conn);
    }
    send_mail_to_user($conf_order_id); //เปลี่ยนตรงนี้
    del_old_order($conn, $conf_order_id);
    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard.php'>";
}
//ลบคำสั่งซื้อสินค้าเมื่อสั่งซื้อเรียบร้อย
function del_old_order($conn, $conf_order_id)
{
    $sql_del_order = "delete from tbl_orders where order_id=$conf_order_id";
    mysqli_query($conn, $sql_del_order);
    $conn->close();
}
?>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php
                include 'dashboard_navleft.php';
                ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php include 'dashboard_navtop.php' ?>
                </div>
                <div class="ar-show-order-detail-other">
                    <div class="show-order-detail-other">
                        <div class="ar-show-pd-or-dt">
                            <div class="linke-dow-or-dt">
                                <a class="a-link-dowload-excel-file" href="./controller/report_order.php?order_id=<?php echo $conf_order_id; ?>">ดาวน์โหลดไฟล์ Excel</a>
                            </div>
                            <div class="ar-pd-order-detail-title">
                                <h3>ใบสั่งซื้อ</h3>
                                <center><?php echo $ckk_del; ?></center>
                                <div class="ar-best-by-logo">
                                    <img src="../access/logo_img/bestby.jpg" alt="" width="250px">
                                </div>
                            </div>
                            <div class="ar-ds-open-order-detail">
                                <div class="ds-opn-img-pd-dt">
                                    <div class="ds-opn-pd-detail">
                                        <?php
                                        $status = '';
                                        if (isset($_GET["btn_cancel"])) {
                                            $order_id = $_GET["order_id"];
                                            $status = "
                                            <div class='show-order-status'>
                                                <p>กำลังส่งข้อมูลไปยังลูกค้าโปรดรอสักครู่...</p>
                                            </div>
                                            ";
                                            cancel_order($order_id);
                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard.php'>";
                                        }
                                        ?>
                                        <div class="ar-show-order-detail-status">
                                            <?php
                                            echo $status;
                                            ?>
                                        </div>
                                        <table class="ar-tbl-opn-user-dt">
                                            <?php
                                            $check_order_id = $_GET["order_id"];
                                            if (isset($check_order_id)) {
                                                ShowOrderDetailAndCtmData($check_order_id);
                                            } else {
                                                echo "<h1>ไม่พบข้อมูลรายการคำสั่งซื้อ</h1>";
                                                echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/dashboard/dashboard.php'>";
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="ar-company-detail">
                                    <p class="dealer-title-tx"><b>ผู้จำหน่าย</b></p>
                                    <p class="p-comp-dt">บริษัท เบส บาย ซัพพลาย หาดใหญ่</p>
                                    <p class="p-comp-dt">ที่อยู่: <?php echo get_cpn_contact(5); ?></p>
                                    <p class="p-comp-dt">เบอร์โทรศัพท์: <?php echo get_cpn_contact(1); ?></p>
                                    <p class="p-comp-dt">แฟกซ์: <?php echo get_cpn_contact(2); ?></p>
                                    <p class="p-comp-dt">อีเมล: <?php echo get_cpn_contact(4); ?></p>
                                    <p class="p-comp-dt">ไลน์: <?php echo get_cpn_contact(6); ?></p>
                                </div>
                                <div class="ar-show-pd-dt2">
                                    <div class="ar-show-user-data-bx">
                                        <table class="tbl-show-order-detail">
                                            <tr>
                                                <th class="tr-th-bd-btt-line res-data-img">#</th>
                                                <th class="tr-th-bd-btt-line">รูปสินค้า</th>
                                                <th class="tr-th-bd-btt-line">รายละเอียด</th>
                                                <th class="tr-th-bd-btt-line">จำนวน</th>
                                                <th class="tr-th-bd-btt-line">ราคาต่อหน่วย</th>
                                                <th class="tr-th-bd-btt-line">vat 7%</th>
                                                <th class="tr-th-bd-btt-line">ยอดรวม</th>
                                            </tr>
                                            <?php
                                            if (isset($check_order_id)) {
                                                $order_history = getOrderDetail($check_order_id);
                                            } else {
                                                echo "<h1>ไม่พบข้อมูลรายการคำสั่งซื้อ</h1>";
                                                echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/dashboard/dashboard.php'>";
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="ar-btn-exe-pd">
                                    <a href="dashboard_order_detail.php?pd_quantity=<?php echo $order_history[2] ?>&conf=confirm&order_id=<?php echo $order_history[0]; ?>&pd_id=<?php echo $order_history[1] ?>" class="btn-confirm-order">ยืนยันคำสั่งซื้อ</a>
                                    <a href="dashboard_order_detail.php?btn_cancel=btn_cancel&order_id=<?php echo $order_history[0]; ?>" class="btn-cancel-order">ยกเลิกคำสั่งซื้อ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    var rs_province = document.getElementById("show_province").innerHTML;
    var rs_amphoe = document.getElementById("show_amphoe").innerHTML;
    var rs_tambon = document.getElementById("show_tambon").innerHTML;

    function slice_ctm_address_txt(ctm_data) {
        var new_set_ctm_address = ctm_data.slice(2, ctm_data.length)
        console.log(new_set_ctm_address);
        return new_set_ctm_address;
    }
    document.getElementById("show_province").innerHTML = slice_ctm_address_txt(rs_province);
    document.getElementById("show_amphoe").innerHTML = slice_ctm_address_txt(rs_amphoe);
    document.getElementById("show_tambon").innerHTML = slice_ctm_address_txt(rs_tambon);
</script>
<script src="dashbpard_js/dashboard.js"></script>