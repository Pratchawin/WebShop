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
    <link rel="stylesheet" href="dashboard_style/dashboard_setting.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php
                include 'dashboard_navleft.php';
                include './controller/dashboard_setting_ctt.php';
                ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php
                    include 'dashboard_navtop.php';
                    set_navtop(1);
                    ?>
                </div>
                <div class="ar-dashboard-setting">
                    <div class="ar-ds-setting-title">
                        <h3>การตั้งค่า</h3>
                    </div>
                    <div class="ar-form-inp-set-data2">
                        <div class="ar-form-inp-list">
                            <div class="ar-form-stt-account-cpn-data">
                                <p><b>ตั้งค่าสินค้าเริ่มต้น</b></p>
                                <div class="stt-show-data">
                                    <form action="dashboard_setting.php" method="GET">
                                        <table>
                                            <tr>
                                                <td>สินค้าเริ่มต้น:<?php get_pd_default_name() ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="set_default_ctt" id="" class="sh-inp-pd-dt">
                                                        <?php get_main_ctt(); ?>
                                                    </select>
                                                </td>
                                                <td><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_set_default"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    <?php
                                    //เเก้ช่องทางการจัดส่ง
                                    @$btn_set_default = $_GET["btn_set_default"];
                                    if (isset($btn_set_default) == true) {
                                        $pd_default = $_GET["set_default_ctt"];
                                        set_pd_default($pd_default);
                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="ar-form-stt-account-cpn-data">
                                <p><b>ตั้งค่า Line notify token</b></p>
                                <div class="stt-show-data">
                                    <form action="dashboard_setting.php" method="GET">
                                        <table>
                                            <tr>
                                                <td>Line notify token:<?php echo get_line_token() ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name="inp_line_notify" class="set-inp-bank" placeholder="หมายเลขบัญชี">
                                                    <input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_line_notify">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <?php
                                    //เเก้ช่องทางการจัดส่ง
                                    @$btn_set_default = $_GET["btn_line_notify"];
                                    if (isset($btn_set_default) == true) {
                                        $pd_default = $_GET["inp_line_notify"];
                                        set_line_notify($pd_default);
                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="ar-form-stt-account-cpn-data">
                                <div class="ar-bx-bank-otp-account-1">
                                    <div>
                                        <p><b>ตั้งค่าหมายเลขบัญชีธนาคาร</b></p>
                                        <div class="stt-show-data">
                                            <?php $cpn_id = get_old_cpn_data(1); ?>
                                            <form action="dashboard_setting.php" method="GET">
                                                <table>
                                                    <tr>
                                                        <td>เเก้ไขชื่อธนาคาร:</td>
                                                        <td><input type="text" name="bank_name1" class="set-inp-bank" placeholder="ธนาคาร"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เเก้ไขชื่อบัญชี:</td>
                                                        <td><input type="text" name="acc_name1" class="set-inp-bank" placeholder="ชื่อบัญชี"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เเก้ไขหมายเลขบัญชีธนาคาร:</td>
                                                        <td><input type="text" name="bank_account1" class="set-inp-bank" placeholder="หมายเลขบัญชี"></td>
                                                        <td style="display: none;"><input type="text" value=<?php echo $cpn_id; ?> name="bank_id" class="set-inp-bank"></td>
                                                        <td><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_update_bank1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </form>
                                            <?php
                                            @$ckk_btn_bank1 = $_GET["btn_update_bank1"];
                                            if (isset($ckk_btn_bank1) == true) {
                                                $bank_name = $_GET["bank_name1"];
                                                $bank_account = $_GET["bank_account1"];
                                                $bank_id = $_GET["bank_id"];
                                                $acc_name = $_GET["acc_name1"];
                                                $conn = connect_bestDB();
                                                $sql_update_bank1 = "update tbl_cpn_data set title='$bank_name', cpn_data='$bank_account', account_name='$acc_name' where cpn_id='$cpn_id'";
                                                $rs = mysqli_query($conn, $sql_update_bank1);
                                                if ($rs == false) {
                                                    echo mysqli_error($conn);
                                                } else {
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                                }
                                                $conn->close();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="ar-bx-bank-otp-account-2">
                                    <div>
                                        <div class="stt-show-data">
                                            <?php $cpn_id1 = get_old_cpn_data(2); ?>
                                            <form action="dashboard_setting.php" method="GET">
                                                <table>
                                                    <tr>
                                                        <td>เเก้ไขชื่อธนาคาร:</td>
                                                        <td><input type="text" name="bank_name2" class="set-inp-bank" placeholder="ชื่อธนาคาร"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เเก้ไขชื่อบัญชี:</td>
                                                        <td><input type="text" name="acc_name2" class="set-inp-bank" placeholder="ชื่อบัญชี"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เเก้ไขหมายเลขบัญชีธนาคาร:</td>
                                                        <td><input type="text" name="bank_account2" class="set-inp-bank" placeholder="หมายเลขบัญชี"></td>
                                                        <td style="display: none;"><input type="text" value=<?php echo $cpn_id1; ?> name="bank_id2" class="set-inp-bank"></td>
                                                        <td><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_update_bank2"></td>
                                                    </tr>
                                                </table>
                                            </form>
                                            <?php
                                            //เเก้ไขเลขบัญชีธนาคาร
                                            @$ckk_btn_bank2 = $_GET["btn_update_bank2"];
                                            if (isset($ckk_btn_bank2) == true) {
                                                $bank_name = $_GET["bank_name2"];
                                                $bank_account = $_GET["bank_account2"];
                                                $acc_name2 = $_GET["acc_name2"];
                                                $bank_id = $_GET["bank_id2"];
                                                echo $bank_id;
                                                echo $bank_name;
                                                echo $bank_account;
                                                $conn = connect_bestDB();
                                                $sql_update_bank1 = "update tbl_cpn_data set title='$bank_name', cpn_data='$bank_account', account_name='$acc_name2' where cpn_id='$bank_id'";
                                                $rs = mysqli_query($conn, $sql_update_bank1);
                                                if ($rs == false) {
                                                    echo mysqli_error($conn);
                                                } else {
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                                }
                                                $conn->close();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ar-form-stt-account-cpn-data">
                                <p><b>ตั้งค่าการจัดส่ง</b></p>
                                <div class="stt-show-data">
                                    <form action="dashboard_setting.php" method="GET">
                                        <table>
                                            <tr>
                                                <td><?php $cpn_id3 = get_shipment(3); ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="display: none;"><input type="text" value=<?php echo $cpn_id3; ?> name="shipment_id" class="set-inp-bank"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="shipment" class="set-inp-bank" placeholder="การจัดส่ง"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_update_shipment"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    <?php
                                    //เเก้ช่องทางการจัดส่ง
                                    @$btn_update_shipment = $_GET["btn_update_shipment"];
                                    if (isset($btn_update_shipment) == true) {
                                        $conn = connect_bestDB();
                                        $shipment_id = $_GET["shipment_id"];
                                        $shipment = $_GET["shipment"];
                                        $sql_update_shipment = "update tbl_cpn_data set cpn_data='$shipment' where cpn_id='$shipment_id'";
                                        $rs = mysqli_query($conn, $sql_update_shipment);
                                        if ($rs == true) {
                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                        }
                                        $conn->close();
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="ar-form-stt-account-cpn-data">
                                <p><b>ข้อมูลบริษัทในปัจจุบัน</b></p>
                                <div class="stt-show-data">
                                    <table>
                                        <tr>
                                            <td>เบอร์โทรศัพท์:</td>
                                            <td><?php echo get_cpn_data(1) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="ar-tr-set-title">แฟลกซ์:</td>
                                            <td class="ar-tr-set-title"><?php echo get_cpn_data(2) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="ar-tr-set-title">เว็บไซต์:</td>
                                            <td class="ar-tr-set-title"><?php echo get_cpn_data(3) ?></td>
                                        </tr>
                                        <tr>
                                            <td class='ar-tr-set-title'>อีเมล:</td>
                                            <td class="ar-tr-set-title"><?php echo get_cpn_data(4) ?></td>
                                        </tr>
                                        <tr>
                                            <td class='ar-tr-set-title'>ไลน์:</td>
                                            <td class='ar-tr-set-title'><?php echo get_cpn_data(6) ?></td>
                                        </tr>
                                        <tr>
                                            <td class='ar-tr-set-title'>เฟสบุ๊ค:</td>
                                            <td class="ar-tr-set-title"><?php echo get_cpn_data(7) ?></td>
                                        </tr>
                                        <tr>
                                            <td class='ar-tr-set-title'>ที่อยู่บริษัท:</td>
                                            <td class="ar-tr-set-title">
                                                <div class="show-stt-cpn-data">
                                                    <?php echo get_cpn_data(5) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="ar-form-stt-account-cpn-data2">
                                <p><b>ตั้งค่าข้อมูลการติดต่อ</b></p>
                                <div class="stt-show-data">
                                    <table>
                                        <tr>
                                            <form action="dashboard_setting.php" method="get">
                                                <td>เเก้ไขเบอร์โทรศัพท์: </td>
                                                <td>
                                                    <input type="text" name="upd_phone" class="set-inp-bank" placeholder="เบอร์โทรศัพท์"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_upd_phone">
                                                </td>
                                                <?php
                                                @$btn_upd_phone = $_GET["btn_upd_phone"];
                                                if (isset($btn_upd_phone)) {
                                                    @$new_data = $_GET["upd_phone"];
                                                    upd_cpn_data($new_data, 1);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr>
                                            <form action="dashboard_setting.php" method="get">
                                                <td>เเก้ไขเเฟลกซ์: </td>
                                                <td><input type="text" name="upd_fl" class="set-inp-bank" placeholder="แฟกซ์"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_upd_fl"></td>
                                                <?php
                                                @$btn_upd_phone = $_GET["btn_upd_fl"];
                                                if (isset($btn_upd_phone)) {
                                                    @$new_data = $_GET["upd_fl"];
                                                    upd_cpn_data($new_data, 2);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr>
                                            <form action="dashboard_setting.php" method="get">
                                                <td>เเก้ไขเว็บไซต์: </td>
                                                <td><input type="text" name="upd_web" class="set-inp-bank" placeholder="เว็บไซต์"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_upd_web"></td>
                                            </form>
                                            <?php
                                            @$btn_upd_phone = $_GET["btn_upd_web"];
                                            if (isset($btn_upd_phone)) {
                                                @$new_data = $_GET["upd_web"];
                                                upd_cpn_data($new_data, 3);
                                                echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <form action="dashboard_setting.php" method="get">
                                                <td>เเก้ไขอีเมล: </td>
                                                <td><input type="text" name="upd_email" class="set-inp-bank" placeholder="อีเมล"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_upd_email"></td>
                                            </form>
                                            <?php
                                            @$btn_upd_phone = $_GET["btn_upd_email"];
                                            if (isset($btn_upd_phone)) {
                                                @$new_data = $_GET["upd_email"];
                                                upd_cpn_data($new_data, 4);
                                                echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <form action="dashboard_setting.php" method="get">
                                                <td>เเก้ไขไลน์: </td>
                                                <td><input type="text" name="upd_line" class="set-inp-bank" placeholder="ไลน์"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_upd_line"></td>
                                            </form>
                                            <?php
                                            @$btn_upd_phone = $_GET["btn_upd_line"];
                                            if (isset($btn_upd_phone)) {
                                                @$new_data = $_GET["upd_line"];
                                                upd_cpn_data($new_data, 6);
                                                echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <form action="dashboard_setting.php" method="get">
                                                <td>เฟสบุ๊ค: </td>
                                                <td><input type="text" name="upd_facebook" class="set-inp-bank" placeholder="เฟสบุ๊ค"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_upd_facebook"></td>
                                            </form>
                                            <?php
                                            @$btn_upd_phone = $_GET["btn_upd_facebook"];
                                            if (isset($btn_upd_phone)) {
                                                @$new_data = $_GET["upd_facebook"];
                                                upd_cpn_data($new_data, 7);
                                                echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <form action="dashboard_setting.php" method="get">
                                                <td>ที่ตั้งบริษัท: </td>
                                                <td><input type="text" name="upd_address" class="set-inp-bank" placeholder="ที่ตั้งบริษัท"><input type="submit" value="บันทึก" class="inp-submit-setting" name="btn_upd_address"></td>
                                            </form>
                                            <?php
                                            @$btn_upd_phone = $_GET["btn_upd_address"];
                                            if (isset($btn_upd_phone)) {
                                                @$new_data = $_GET["upd_address"];
                                                upd_cpn_data($new_data, 5);
                                                echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_setting.php'>";
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>

</html>