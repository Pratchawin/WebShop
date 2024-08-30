<!DOCTYPE html>
<html lang="en">
<?php
session_start();
@$pd_id = $_GET["pd_id"];
@$category = $_GET["category_id"];
setcookie('pd_id', $pd_id, time() + (86400 * 30), "/");
setcookie('category', $category, time() + (86400 * 30), "/");
@$quantity = $_GET["pd_quantity"];
setcookie('pd_quantity', $quantity, time() + (86400 * 30), "/");
$pd_quantity = '';
if ($quantity == null) {
    @$pd_quantity = $_COOKIE["pd_quantity"];
} else {
    $pd_quantity = $_GET["pd_quantity"];
}
?>

<head>
    <?php
    include 'set_meta.php';
    ?>
    <link rel="stylesheet" href="shop_style/index.css">
    <link rel="stylesheet" href="shop_style/formbuypd.css">
    <link rel="stylesheet" href="shop_style/navtop.css">
    <link rel="stylesheet" href="shop_style/web_responsive.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
    <script src="https://api.longdo.com/map/?key=34ba4d1e8828a9599c084e0123188b14"></script>
    <script src="https://api.longdo.com/address-form/js/addressform.js"></script>
    <script>
        var myform;

        function init() {
            myform = new longdo.AddressForm('form_div', {
                showLabels: false,
                debugDiv: 'debugoutput'
            });
        }
    </script>
</head>
<body onload="init()">
    <div class="ar-web-ecom-ind-container">
        <div class="ar-web-ecom-ind-container">
            <?php
            include 'indnavtop.php';
            include 'shop_controller/session_controller.php';
            include 'shop_controller/format.php';
            include '../dashboard/controller/connect.php';
            include 'shop_controller/form_buy_pd_ctt.php';
            include 'shop_controller/cpn_data.php';
            $username = get_user_name();
            showIndNavTop(1, $username);
            ?>
        </div>
        <div class="ar-form-inp-buy-pd">
            <div class="ar-form-od-pd-detail">
                <div class="ar-bx-form-inp">
                    <div class="ar-bx-form-inp-title">
                        <i class="fa-solid fa-file-lines form-ord-set-inline"></i>
                        <p class="form-ord-set-inline"><b>ที่อยู่ในการจัดส่ง</b></p>
                    </div>
                    <?php
                    $show_status = '';
                    $file_status = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST["confirm_buy"])) {
                            if (!isset($_POST["pd_id"])) {
                                echo "เกิดข้อผิดพลาด";
                                echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/index.php'>";
                            }
                            $conn = connect_bestDB();
                            $es_fname = mysqli_real_escape_string($conn, $_POST["fname"]);  
                            $es_lname = mysqli_real_escape_string($conn, $_POST["lname"]);
                            $full_name = $es_fname . " " . $es_lname;
                            $email = mysqli_real_escape_string($conn, $_POST["email"]);
                            $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
                            $country = mysqli_real_escape_string($conn, $_POST["country"]);
                            $zip_code = mysqli_real_escape_string($conn, $_POST["zip_code"]);
                            $tambon = mysqli_real_escape_string($conn, $_POST["tambon"]);
                            $amphoe = mysqli_real_escape_string($conn, $_POST["amphoe"]);
                            $province = mysqli_real_escape_string($conn, $_POST["province"]);
                            $address = mysqli_real_escape_string($conn, $_POST["address"]);
                            $pd_id = mysqli_real_escape_string($conn, $_POST["pd_id"]);
                            $pd_quantity = mysqli_real_escape_string($conn, $_POST["pd_quantity"]);
                            $ckk_pd_status = mysqli_real_escape_string($conn, $_POST["ckk_pd_status"]);
                            $pd_code = mysqli_real_escape_string($conn, $_POST["pd_code"]);
                            @$pd_price = mysqli_real_escape_string($conn, $_POST["get_pd_price"]);
                            $pd_prop=mysqli_real_escape_string($conn,$_POST["pd_prop"]);
                            $cmt_id = "0";

                            $pd_name = mysqli_real_escape_string($conn, $_POST["pd_name"]);
                            $shipment_ex = mysqli_real_escape_string($conn, $_POST["shipment_ex"]);
                            $total_price = mysqli_real_escape_string($conn, $_POST["total_price"]);
                            $name_status = "";
                            $email_status = "";
                            $phone_status = "";
                            $address_status = "";

                            if ($full_name == " ") {
                                $name_status = "<p class='alert-status'>**กรุณากรอกชื่อ-นามสกุลให้ครบ</p>";
                            }
                            if ($email == "") {
                                $email_status = "<p class='alert-status'>**กรุณากรอกอีเมลที่ใช้ในการติดต่อ</p>";
                            }
                            if ($phone == "") {
                                $phone_status = "<p class='alert-status'>**กรุณากรอกเบอร์โทรศัพท์ที่ใช้ในการติดต่อ</p>";
                            }
                            if ($address == "") {
                                $address_status = "<p class='alert-status'>**กรุณากรอกที่อยู่ในการจัดส่งให้ครบถ้วน</p>";
                            }
                            $ckk_file_type = '';
                            //file upload
                            $success_status = '';
                            $file_name = @$_FILES["fileToUpload"]["name"];
                            if ($ckk_pd_status == 0) { //ถ้าสั่งจองไม่ต้องรับชื่อไฟล์
                                $file_name = "reserve";
                                $success_status = "สั่งจองสินค้าเรียบร้อย";
                            } else {
                                if ($file_name == null) {
                                    $file_status = "<p class='alert-status'>**กรุณาโปรดอัปโหลดสสลีปการโอนเงิน</p>";
                                } else {
                                    //เช็คไฟล์ type
                                    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
                                    $detectedType = exif_imagetype($_FILES['fileToUpload']['tmp_name']);
                                    $error = !in_array($detectedType, $allowedTypes);
                                    if ($error == true) {
                                        $ckk_file_type = 0;
                                        $file_status = "<p class='alert-status'>**กรุณาโปรดอัปโหลดไฟล์ .PNG หรือ .JPG</p>";
                                    } else {
                                        $ckk_file_type = 1;
                                        $success_status = "สั่งซื้อสินค้าเรียบร้อย";
                                    }
                                }
                            }
                            if ($full_name !== " " && $email !== "" && $phone !== "" && $address !== "" && $file_name != "" && $ckk_file_type !== 0) {
                                $pay_st = "0";
                                $payment_status = "ยังไม่ชำระเงิน";
                                if (!$ckk_pd_status == 0) { //ถ้าสั่งจองไม่ต้องตั้งชื่อไฟล์
                                    $new_file_name = time() . time() . $file_name;
                                    $check_file_statement = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "../access/statement_file/" . $new_file_name);
                                    if ($check_file_statement == true) {
                                        $payment_status = "ชำระเงินเเล้ว";
                                        $pay_st = "1";
                                    } else {
                                        $payment_status = "ยังไม่ชำระเงิน";
                                        $pay_st = "0";
                                    }
                                } else {
                                    $new_file_name = "";
                                }
                                $order_code = $pd_code . "" . random_int(0, 10);
                                $order_code = strtoupper($order_code);
                                if (isset($_SESSION["uid"])) {
                                    $uid = $_SESSION["uid"];
                                }
                                $stmt = $conn->prepare("insert into tbl_orders(order_code,pd_id,amount,pd_status,ctm_id,ctm_name,ctm_email,ctm_phone,ctm_address,statement_file,payment_status,zip_code,tambon,amphoe,province,country,pd_price,shipment_ex,total_price,pd_name,pd_slc1) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); //21 field                               
                                $stmt->bind_param("sssssssssssssssssssss", $order_code, $pd_id, $pd_quantity, $payment_status, $cmt_id, $full_name, $email, $phone, $address, $new_file_name, $pay_st, $zip_code, $tambon, $amphoe, $province, $country, $pd_price, $shipment_ex, $total_price, $pd_name,$pd_prop);
                                $stmt->execute();
                                $conn->close();
                                //send mail
                                $date_time = date("d/m/y");
                                sendEmailToAdmin($order_code, $date_time, $full_name, $phone, $email, $pd_id, $pd_quantity,$pd_prop,$shipment_ex);
                                $show_status = "<div class='ar-show-pd-order-success'>
                                    <div class='show-status'>
                                        <div class='ar-show-buy-success'>
                                            <i class='fa-solid fa-circle-check set-font-size fa-2x'></i>
                                        </div>
                                        <div class='ar-show-buy-txt'>
                                            <h2>$success_status</h2>
                                        </div>
                                    </div>
                                </div>";
                                echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/index.php'>";
                            }
                        } else {
                            echo "<meta http-equiv='refresh' content='3;url=http://localhost/bestbuy/index.php'>";
                        }
                    }
                    ?>
                    <div class="form-inp-bx-ls">
                        <div class="ar-bx-user-inp-name">
                            <label for="">ชื่อ-นามสกุล: </label>
                            <div class="bx-inp-name">
                                <input type="text" id="fname" class="or-inp-fname" value='' placeholder="ชื่อ..">
                                <input type="text" id="lname" class="or-inp-lname" value='' placeholder="นามสกุล..">
                            </div>
                            <?php echo @$name_status; ?>
                        </div>
                        <div class="ar-user-inp-email">
                            <div class="bx-inp-email">
                                <div class="bx-inp-email1">
                                    <label for="">อีเมล: </label>
                                    <div class="ar-inp-bx-email">
                                        <input type="email" name="useraddress" id="email" class="inp-buy-pd" placeholder="อีเมล..">
                                    </div>
                                    <?php echo @$email_status; ?>
                                </div>
                                <div class="bx-inp-phone2">
                                    <label for="">เบอร์โทรศัพท์: </label>
                                    <div class="ar-inp-bx-email">
                                        <input type="text" name="useraddress" id="phone" class="inp-buy-pd" placeholder="เบอร์โทรศัพท์..">
                                    </div>
                                    <?php echo @$phone_status; ?>
                                </div>
                            </div>
                        </div>
                        <div class="ar-user-inp-address">
                            <?php
                            echo $show_status;
                            ?>
                            <div class="bx-inp-ads">
                                <label for="">กรอกที่อยู่ในการจัดส่ง:</label>
                                <div style="max-width: 700px;">
                                    <div style="font-size:1.2em; width: 328px; margin: 0 auto 1rem; display: inline-block;">
                                        <!-- div สำหรับโชว์แบบฟอร์ม -->
                                        <div id="form_div"></div>
                                    </div>
                                </div>
                            </div>
                            <?php echo @$address_status; ?>
                        </div>
                    </div>
                </div>
                <div class='ar-bx-form-inp'>
                    <div class='ar-bx-form-inp-title'>
                        <i class='fa-solid fa-box form-ord-set-inline'></i>
                        <p class='form-ord-set-inline'><b>ข้อมูลสินค้า</b></p>
                    </div>
                    <?php
                    $status = '';
                    $ckk = 0;
                    if (isset($pd_id)) {
                        $conn = connect_bestDB();
                        $status = '';
                        $sql_get_pd_detail = "select image_file1, discount, pd_name,pd_status, pd_price, pd_code, pd_brand, pd_detail, pd_model  from tbl_products where pd_id=$pd_id";
                        $rs_pd_detail = mysqli_query($conn, $sql_get_pd_detail);
                        $pd_prop = '';
                        if (@$_GET["pd_prop"] == null) {
                            $pd_prop = 'ไม่ระบุลักษณะของสินค้า';
                        } else {
                            $pd_prop = $_GET["pd_prop"];
                        }
                        if (mysqli_num_rows($rs_pd_detail) > 0) {
                            $row = mysqli_fetch_assoc($rs_pd_detail);
                            if ($row["pd_status"] == 0) {
                                $status = "<p style='color:red'>สั่งจองล่วงหน้า</p>";
                                $ckk = 0;
                            } else {
                                $status = "<p style='color:green'>มีสินค้าในสต๊อก</p>";
                                $ckk = 1;
                            }
                            $pd_discount = ($row["pd_price"] * $row["discount"]) / 100;
                            $pd_tt_price = ($row["pd_price"] - $pd_discount);
                            echo "
                                <div class='ar-or-pd-img-detail'>
                                    <div class='ar-or-pd-img'>
                                            <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' class='ar-or-form-pd-img'>
                                        </div>
                                        <div class='ar-or-pd-detial'>
                                            <div class='ar-or-pd-desc'>
                                                <table>
                                                    <tr>
                                                        <td style='width:15%;'><b>ชื่อสินค้า:</b></td>
                                                        <td>" . $row["pd_name"] . "</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width:15%;'><b>ราคา:</b></td>
                                                        <td>" . formatMoney($pd_tt_price, true) . " บาท</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width:15%;'><b>รหัส:</b></td>
                                                        <td>" . $row["pd_code"] . "</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width:15%;'><b>สถานะสินค้า:</b></td>
                                                        <td>" . $status . "</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width:15%;'><b>ยี่ห้อ:</b></td>
                                                        <td>" . $row["pd_brand"] . "</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width:15%;'><b>รุ่น:</b></td>
                                                        <td>" . $row["pd_model"] . "</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width:15%;'><b>รายละเอียด:</b></td>
                                                        <td>" . $row["pd_detail"] . "</td>
                                                    </tr>
                                                    <tr>
                                                        <td style='width:15%;'><b>ลักษณะสินค้า:</b></td>
                                                        <td id='show_pd_prop'>" . $pd_prop . "</td>
                                                    </tr>
                                                </table>
                                            </div>
                                    </div>
                                </div>";
                        }
                        $conn->close();
                    } else {
                        if (!isset($_GET["pd_id"])) {
                            echo "ข้อมูลสินค้าไม่ถูกต้อง";
                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/index.php'>";
                        }
                    }
                    ?>
                </div>
                <div class="ar-bx-form-inp">
                    <div class="ar-bx-form-inp-title">
                        <i class="fa-solid fa-baht-sign form-ord-set-inline"></i>
                        <p class="form-ord-set-inline"><b>ราคาสินค้าเเละค่าจัดส่ง</b></p>
                    </div>
                    <div class="ar-form-for-resp">
                        <div class="ar-show-order-detail">
                            <?php
                            //resp
                            $conn = connect_bestDB();
                            $sql_get_pd_order = "select discount, pd_price, shipment_expenses, pd_name from tbl_products where pd_id=$pd_id";
                            $rs_pd_tbl_detial = mysqli_query($conn, $sql_get_pd_order);
                            $order_resp = mysqli_fetch_assoc($rs_pd_tbl_detial);
                            $pd_name_rsp = $order_resp["pd_name"];
                            $pd_price_rsp = $order_resp["pd_price"];
                            $shipment_ex_rsp = $order_resp["shipment_expenses"];
                            $total_rsp = ($order_resp["pd_price"] * $_GET["pd_quantity"]);
                            $vat_rsp = ($total_rsp * 0.07);
                            $tt_pd_price = ($total_rsp + $vat_rsp);
                            $rsp_tt_price = ($tt_pd_price + $shipment_ex_rsp);
                            //การจัดส่ง
                            $sql_cpn = "select title, cpn_data from tbl_cpn_data where cpn_id=3";
                            $rs_sql_cpn = mysqli_query($conn, $sql_cpn);
                            $rsp_cpn = mysqli_fetch_assoc($rs_sql_cpn);
                            $shp_title = $rsp_cpn["title"];
                            $shp_name = $rsp_cpn["cpn_data"];
                            $conn->close();
                            ?>
                            <table class="tbl-fm-show-order-dt">
                                <tr>
                                    <td class="td-fm-show-or-dt">ชื่อสินค้า:</td>
                                    <td><?php echo $pd_name_rsp; ?></td>
                                </tr>
                                <tr>
                                    <td class="td-fm-show-or-dt">ราคา:</td>
                                    <td><?php echo formatMoney($pd_price_rsp, true); ?> บาท</td>
                                </tr>
                                <tr>
                                    <td class="td-fm-show-or-dt">จำนวน:</td>
                                    <td><?php echo $_GET["pd_quantity"] ?> ชิ้น</td>
                                </tr>
                                <tr>
                                    <td class="td-fm-show-or-dt">vat 7%:</td>
                                    <td><?php echo formatMoney($vat_rsp, true); ?> บาท</td>
                                </tr>
                                <tr>
                                    <td class="td-fm-show-or-dt">ราคารวม vat:</td>
                                    <td><?php echo formatMoney($tt_pd_price, true) ?> บาท</td>
                                </tr>
                                <tr>
                                    <td class="td-fm-show-or-dt"><?php echo $shp_title; ?>:</td>
                                    <td><?php echo $shp_name; ?></td>
                                </tr>
                                <tr>
                                    <td class="td-fm-show-or-dt">ค่าจัดส่ง:</td>
                                    <td><?php echo formatMoney($shipment_ex_rsp, true) ?> บาท</td>
                                </tr>
                                <tr>
                                    <td class="td-fm-show-or-dt">ยอดรวมทั้งสิ้น:</td>
                                    <td><?php echo formatMoney($rsp_tt_price, true) ?> บาท</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="ar-bx-shipping-pd">
                        <table class="ar-tbl-pd-detail">
                            <tr>
                                <th class="tbl-form-th-title" width="5%">#</th>
                                <th class="tbl-form-th-title">รูปสินค้า</th>
                                <th class="tbl-form-th-title">ชื่อสินค้า</th>
                                <th class="tbl-form-th-title">ราคาสินค้า</th>
                                <th class="tbl-form-th-title">จำนวนสินค้า</th>
                                <th class="tbl-form-th-title set-align">VAT 7%</th>
                                <th class="tbl-form-th-title set-align">ราคาสินค้ารวม VAT</th>
                            </tr>
                            <?php
                            function pd_discount($discount, $pd_price)
                            {
                                $pd_discount = ($pd_price * $discount) / 100;
                                $pd_price = $pd_price - $pd_discount;
                                return $pd_price;
                            }
                            $conn = connect_bestDB();
                            $sql_get_pd_order = "select image_file1, pd_name, discount, pd_price, pd_code, pd_brand, pd_detail, pd_model, shipment_expenses, pd_code from tbl_products where pd_id=$pd_id";
                            $rs_pd_tbl_detial = mysqli_query($conn, $sql_get_pd_order);
                            $total_price_array = array(); //เก็บราคาสินค้าที่มากกว่า 1 รายการ
                            $get_pd_price = 0;
                            if (mysqli_num_rows($rs_pd_detail) > 0) {
                                $pd_code = '';
                                while ($row = mysqli_fetch_assoc($rs_pd_tbl_detial)) {
                                    $get_pd_price =  pd_discount($row["discount"], $row["pd_price"]);
                                    $pd_code = $row["pd_code"];
                                    $shipment_expenses = $row["shipment_expenses"]; //ค่าจัดส่ง
                                    $pd_price_qt = $get_pd_price * $pd_quantity; //ราคาสินค้า*จำนวนสินค้า
                                    $vat = ($pd_price_qt * 0.07); //ค่า vat
                                    $total_price = (float)$vat + $pd_price_qt; //ราคารวม vat
                                    array_push($total_price_array, $total_price);
                                    echo "
                                            <tr>
                                                <td class='tbl-form-td-pd-detail td-no' style='text-align:center;'>1</td>
                                                <td class='tbl-form-td-pd-detail td-pd-image'>
                                                    <img src='../access/uploads_image_file/" . $row["image_file1"] . "' width='80px'>
                                                </td>
                                                <td class='tbl-form-td-pd-detail td-pd-name' id='smr_get_pd_name'>" . $row["pd_name"]." ". @$_GET["pd_prop"] . "</td>
                                                <td class='tbl-form-td-pd-detail td-pd-price'>" . formatMoney($get_pd_price, true) . " บาท</td>
                                                <td class='tbl-form-td-pd-detail td-pd-quantity' id='pd_quantity'>$pd_quantity ชิ้น</td>
                                                <td class='tbl-form-td-pd-detail td-pd-price'>" . formatMoney($vat, true) . " บาท</td>
                                                <td class='tbl-form-td-pd-detail td-pd-total' id='total_price'>" . formatMoney($total_price, true) . " บาท</td>
                                            </tr>
                                    ";
                                }
                                $conn->close();
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tbl-form-td-pd-shipment"><b>ยอดรวม:</b></td>
                                <td class="tbl-form-td-pd-shipment-padding td-pd-price"><?php echo  formatMoney($total_price, true), " บาท"; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tbl-form-td-pd-shipment"><b>การจัดส่ง:</b></td>
                                <td class="tbl-form-td-pd-shipment-padding td-pd-price">
                                    <?php
                                        $conn=connect_bestDB();
                                        $sql_get_shipment="select cpn_data from tbl_cpn_data where cpn_id=3";
                                        $rs_shipment=mysqli_query($conn, $sql_get_shipment);
                                        $ship=mysqli_fetch_assoc($rs_shipment);
                                        echo $ship["cpn_data"]
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tbl-form-td-pd-shipment-p"><b>ค่าจัดส่ง</b></td>
                                <td class="td-pd-price"><?php echo formatMoney($shipment_expenses, true); ?> บาท</td>
                                <p style='display:none;' id="smr_shipment_ex"><?php echo $shipment_expenses; ?></p>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="tbl-form-td-pd-shipment-p"><b>ยอดรวมทั้งสิ้น</b></td>
                                <?php
                                $total_rs = 0;
                                for ($price = 0; $price < count($total_price_array); $price++) {
                                    $total_rs += $total_price_array[$price];
                                }
                                $total_rs += (float)$shipment_expenses;
                                echo "<td class='td-pd-price'>" . formatMoney($total_rs, true) . " บาท</td>";
                                ?>
                                <p style='display:none;' id="s_total_price"><?php echo $total_rs; ?></p>
                            </tr>
                        </table>
                    </div>
                </div>
                <form action="formbuypd.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if (!$ckk == 0) { //0 สั่งจอง
                        $conn = connect_bestDB();
                        $sql_get_cpn_data = "select title, cpn_data, account_name from tbl_cpn_data limit 2";
                        $bank_rs = mysqli_query($conn, $sql_get_cpn_data);
                        $bank_tt = array();
                        $bank_acc = array();
                        $bank_acc_name = array();
                        $i = 0;
                        while ($bank_dt = mysqli_fetch_assoc($bank_rs)) {
                            $i += 1;
                            $bank_tt[$i] = $bank_dt["title"];
                            $bank_acc[$i] = $bank_dt["cpn_data"];
                            $bank_acc_name[$i] = $bank_dt["account_name"];
                        }
                        echo "<div class='ar-bx-form-inp'>
                            <div class='ar-bx-form-inp-title'>
                                <i class='fa-solid fa-cash-register form-ord-set-inline'></i>
                                <p class='form-ord-set-inline'><b>ช่องทางการชำระเงิน</b></p>
                            </div>
                            <div class='ar-bx-payment-pd'>
                                <p class='ar-form-set-txt-padding'><b>" . $bank_tt[1] . "</b></p>
                                <p class='tt-set-padding'>ชื่อบัญชี: <b>" . $bank_acc_name[1] . "</b></p>
                                <p class='tt-set-padding'>เลขที่บัญชี: <b>" . $bank_acc[1] . "</b></p>
                                <div class='ar-show-bank-account'>
                                    <p class='ar-form-set-txt-padding set-mr-top'><b>" . $bank_tt[2] . "</b></p>
                                    <p class='tt-set-padding'>ชื่อบัญชี: <b>" . $bank_acc_name[2] . "</b></p>
                                    <p class='tt-set-padding'>เลขที่บัญชี: <b>" . $bank_acc[2] . "</b></p>
                                </div>
                                <p class='ar-form-set-txt-padding set-mr-top' ><b>เมื่อชำระเงินเเล้วโปรดส่งสลีปการชำระเงินมาที่</b></p>
                                <div class='ar-form-upload-receipt'>
                                    <label for=''>1.อัปโหลดสลีปเงิน:</label>
                                    <input type='file' name='fileToUpload' id='' />
                                    <span>$file_status</span>
                                </div>
                                <div class='ar-send-pm-data-to-facebook'>
                                    <p class='ar-form-set-txt-padding'><b>หรือส่งมาที่ไลน์</b></p>
                                    <p class='ar-form-upload-receipt'>2.ไลน์ไอดี: ".get_cpn_contact(6)."</p>
                                </div>
                                <div class='ar-send-pm-data-to-facebook'>
                                    <p class='ar-form-set-txt-padding'><b>หรือส่งมาที่เฟสบุ๊ก</b></p>
                                    <p class='ar-form-upload-receipt'>3.เฟสบุ๊ก: ".get_cpn_contact(7)."</p>
                                </div>
                            </div>
                        </div>";
                    } else {
                        echo "";
                    }
                    ?>
                    <div class="ar-bx-form-inp">
                        <div class="ar-bx-form-inp-title">
                            <i class="fa-solid fa-message form-ord-set-inline"></i>
                            <p class="form-ord-set-inline"><b>หมายเหตุ</b></p>
                        </div>
                        <div class="ar-nt-dt-ls">
                            <p>1. ราคาสินค้าทุกรายการ รวมภาษีมูลค่าเพิ่ม 7% แล้ว</p>
                            <p>2. โปรดเช็คสถานะสินค้าเเละจำนวนสินค้าที่จะสั่งซื้อ</p>
                            <p>3. สินค้าขนาดเล็ก รวมค่าจัดส่งทางไปรษณีย์ (EMS) ทั่วประเทศแล้ว</p>
                            <p>4. โปรดเช็คข้อมูลชื่อ อีเมล เบอร์โทรศัพท์ ให้ครบถ้วน</p>
                            <p>5. โปรดตรวจสอบที่อยู่ในการจัดส่งให้ถูกต้อง หากเกิดข้อผิดพลาดขึ้นทางบริษัทจะไม่รับผิดชอบค่าเสียหาย</p>
                            <p>6. ก่อนโอนเงินชำระค่าสินค้าโปรดเช็คข้อมูลชื่อบัญชีว่าตรงกับทางบริษัท</p>
                            <p>7. หากทางบริษัทได้ทำการจัดส่งสินค้าเเล้วจะไม่สามารถยกเลิกคำสั่งซื้อได้</p>
                            <p>8. กรณีสั่งซื้อสินค้าเเล้วมีสถานะสินค้าขึ้นว่าสั่งจองให้กดยืนยันเพื่อส่งข้อมูลไปยังบริษัทจากนั้นรอทางบริษัทติดต่อกลับมาในภายหลัง</p>
                            <p>9. เมื่อทำการสั่งซื้อสินค้าเเล้วรออีเมลตอบกลับจากทางบริษัท</p>
                        </div>
                        <div class="ar-or-inp-tybtn-conf-cc">
                            <div class="ar-or-btn-conf-cc">
                                <input type="text" name="fname" id="inp_fname" class="frm-inp-dis-none">
                                <input type="text" name="lname" id="inp_lname" class="frm-inp-dis-none">
                                <input type="text" name="email" id="inp_email" class="frm-inp-dis-none">
                                <input type="text" name="phone" id="inp_phone" class="frm-inp-dis-none">
                                <input type="text" name="country" id="inp_country" class="frm-inp-dis-none">
                                <input type="text" name="zip_code" id="inp_zip_code" class="frm-inp-dis-none">
                                <input type="text" name="tambon" id="inp_tambon" class="frm-inp-dis-none">
                                <input type="text" name="amphoe" id="inp_amphoe" class="frm-inp-dis-none">
                                <input type="text" name="pd_prop" id="inp_pd_prop" class="frm-inp-dis-none">
                                <input type="text" name="province" id="inp_province" class="frm-inp-dis-none">
                                <input type="text" name="address" id="inp_address" class="frm-inp-dis-none">
                                <input type="text" name="ckk_pd_status" value="<?php echo $ckk; ?>" class="frm-inp-dis-none">
                                <input type="text" name="pd_code" id="inp_address" class="frm-inp-dis-none" value=<?php echo $pd_code; ?>>
                                <input type="text" name="pd_id" id="inp_pd_id" value="<?php echo $pd_id; ?>" class="frm-inp-dis-none">
                                <input type="text" name="pd_quantity" id="inp_quantity" class="frm-inp-dis-none">
                                <input type="text" name="get_pd_price" id="inp_pd_price" value="<?php echo $get_pd_price; ?>" class="frm-inp-dis-none">

                                <input type="text" name="pd_name" id="pd_name" class="frm-inp-dis-none">
                                <input type="text" name="shipment_ex" id="shipment_ex" class="frm-inp-dis-none">
                                <input type="text" name="total_price" id="smr_total_price" class="frm-inp-dis-none">

                                <input type="submit" name="confirm_buy" value="ยืนยัน" class="or-btn-conf" onclick="getInpData()">
                                <input type="submit" name="cancel" value="ยกเลิก" class="or-btn-cc">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="store_js/formbuypd.js"></script>

</html>