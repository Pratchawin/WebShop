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
    <link rel="stylesheet" href="dashboard_style/dashboard_update.css">
    <link rel="stylesheet" href="dashboard_style/dashboard_add_pd.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php include 'dashboard_navleft.php' ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php
                    include 'dashboard_navtop.php';
                    set_navtop(0);
                    $update_pd_id = $_GET["edit_pd_id"];
                    ?>
                </div>
                <div class="ar-nav-top-title">
                    <h3>แก้ไขข้อมูลสินค้า</h3>
                </div>
                <?php
                include 'controller/dashboard_update_pd_ctt.php';
                ?>
                <div class="ar-add-pd-form-and-inp">
                    <div class="ar-form-inp-pd-dt">
                        <div class="ar-bx-form-ad-pd-dt1">
                            <div class="ar-upd-show-old-pd">
                                <p><b>ข้อมูลสินค้า</b></p>
                            </div>
                            <div class="ar-upd-old-data">
                                <div class="ar-upd-img">
                                    <?php
                                    get_old_pd_image($update_pd_id);
                                    ?>
                                </div>
                                <div class="ar-upd-detail">
                                    <table>
                                        <?php
                                        get_old_pd_data($update_pd_id);
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <?php
                            get_pd_detial_th_eng($update_pd_id);
                            ?>
                        </div>
                        <div class="ar-bx-form-ad-pd-dt1">
                            <form action="dashboard_edit_pd.php" method="GET">
                                <div class="ar-bx-ad-form-title">
                                    <p><b>เเก้ไขประเภทสินค้าหลัก</b></p>
                                </div>
                                <div class="ar-form-add-pd-category-name">
                                    <select name="main_category" id="" class="sh-inp-pd-dt">
                                        <?php
                                        get_all_main_category();
                                        ?>
                                    </select>
                                    <input style="display: none;" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>">
                                    <input class="btn-add-pd-category" name="update_category_main" type="submit" value="บันทึก">
                                    <?php
                                    @$btn_main_category_submit = $_GET["update_category_main"];
                                    if (isset($btn_main_category_submit)) {
                                        $ctt_main_id = $_GET["main_category"];
                                        update_main_category($ctt_main_id, $update_pd_id);
                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                        <div class="ar-bx-form-ad-pd-dt1">
                            <div class="ar-bx-ad-form-title">
                                <p><b>เเก้ไขประเภทสินค้าย่อย</b></p>
                            </div>
                            <div class="ar-form-add-pd-category-name">
                                <form action="dashboard_edit_pd.php" method="GET">
                                    <div class="ds-bx1-tem">
                                        <select name="category_list_id" id="" class="sh-inp-pd-dt">
                                            <?php get_all_category_list(); ?>
                                        </select>
                                        <input style="display: none;" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>">
                                        <input class="btn-add-pd-category" name="btn_update_category_list" type="submit" value="บันทึก">
                                    </div>
                                    <?php
                                    @$ckk_btn_ctt_list = $_GET["btn_update_category_list"];
                                    if (isset($ckk_btn_ctt_list)) {
                                        $ctt_list = $_GET["category_list_id"];
                                        update_category_list($ctt_list, $update_pd_id);
                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                        <div class="ar-bx-form-ad-pd-dt1">
                            <div class="ar-bx-ad-form-title">
                                <p><b>เเก้ไขยี่ห้อสินค้า</b></p>
                            </div>
                            <div class="ar-form-add-pd-category-name">
                                <form action="dashboard_edit_pd.php" method="get">
                                    <div class="ds-bx1-tem">
                                        <select name="pd_brand" class="sh-inp-pd-dt" id="">
                                            <?php 
                                            function get_pd_brand(){
                                                $conn=connect_bestDB();
                                                $sql_add_prand="select brand_id, brand_name from tbl_pd_brand";
                                                $ckk_rs=mysqli_query($conn, $sql_add_prand);
                                                if(mysqli_num_rows($ckk_rs)>0){
                                                    while($pd_brand=mysqli_fetch_assoc($ckk_rs)){
                                                        echo "<option value='".$pd_brand["brand_name"]."'>".$pd_brand["brand_name"]."</option>";
                                                    }
                                                }
                                                $conn->close();
                                            }
                                            get_pd_brand();
                                            ?>
                                        </select>
                                        <input style="display: none;" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>">
                                        <input class="btn-add-pd-category-2" name="btn_upd_pd_brand" type="submit" value="บันทึก">
                                    </div>
                                    <?php
                                    @$new_pd_brand = $_GET["pd_brand"];
                                    @$btn_pd_code = $_GET["btn_upd_pd_brand"];
                                    if (isset($btn_pd_code)) {
                                        fn_update_pd_data($update_pd_id, "pd_brand", $new_pd_brand);
                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                        <div class="ar-bx-form-ad-pd-dt1">
                            <div class="ar-bx-ad-form-title">
                                <p><b>แก้ไขข้อมูลสินค้า</b></p>
                            </div>
                            <div class="ar-form-add-pd-category-name">
                                <div class="ar-inp-pd-inf-bx">
                                    <table>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>รหัสสินค้า:</td>
                                                <td><input class="sh-inp-pd-dt" type="text" name="pd_code"></td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_update_pd_code" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_pd_code = $_GET["pd_code"];
                                                @$btn_pd_code = $_GET["btn_update_pd_code"];
                                                if (isset($btn_pd_code)) {
                                                    fn_update_pd_data($update_pd_id, "pd_code", $new_pd_code);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>ชื่อสินค้า:</td>
                                                <td>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_name">
                                                </td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_pd_name" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_pd_name = $_GET["pd_name"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_name"];
                                                if (isset($btn_pd_code)) {
                                                    fn_update_pd_data($update_pd_id, "pd_name", $new_pd_name);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>รุ่น:</td>
                                                <td>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_model">
                                                </td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_pd_model" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_pd_model = $_GET["pd_model"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_model"];
                                                if (isset($btn_pd_code)) {
                                                    fn_update_pd_data($update_pd_id, "pd_model", $new_pd_model);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>สถานะสินค้า:</td>
                                                <td>
                                                    <select class="sh-inp-pd-dt" name="pd_status">
                                                        <option value=1>มีสินค้าในสต๊อก</option>
                                                        <option value=0>สั่งจองล่วงหน้า</option>
                                                    </select>
                                                </td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_pd_status" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_pd_status = $_GET["pd_status"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_status"];
                                                if (isset($btn_pd_code)) {
                                                    echo "Pd status ", $new_pd_status;
                                                    fn_update_pd_data($update_pd_id, "pd_status", $new_pd_status);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>จำนวนสินค้า:</td>
                                                <td>
                                                    <input class="sh-inp-pd-dt" type="number" name="pd_quantity">
                                                </td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_pd_qt" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_pd_quantity = $_GET["pd_quantity"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_qt"];
                                                if (isset($btn_pd_code)) {
                                                    if ($new_pd_quantity <= 0) {
                                                        echo "<td style='color:red;padding:10px 0 0 10px;'>**จำนวนสินค้าไม่ถูกต้อง</td>";
                                                    } else {
                                                        fn_update_pd_data($update_pd_id, "pd_quantity", $new_pd_quantity);
                                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                    }
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>ราคาสินค้า:</td>
                                                <td>
                                                    <input class="sh-inp-pd-dt" type="number" name="pd_price">
                                                </td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_pd_price" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_pd_price = $_GET["pd_price"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_price"];
                                                if (isset($btn_pd_code)) {
                                                    if ($new_pd_price <= 0) {
                                                        echo "<td style='color:red;padding:10px 0 0 10px;'>**ราคาสินค้าไม่ถูกต้อง</td>";
                                                    } else {
                                                        fn_update_pd_price($update_pd_id, "pd_price", $new_pd_price);
                                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                    }
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>ส่วนลด:</td>
                                                <td>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_discount">
                                                </td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_pd_discount" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_pd_discount = $_GET["pd_discount"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_discount"];
                                                if (isset($btn_pd_code)) {
                                                    fn_update_pd_discount($update_pd_id, "discount", $new_pd_discount);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                        <tr class="ar-td-ds-pd-inp">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <td>ค่าจัดส่ง:</td>
                                                <td>
                                                    <input class="sh-inp-pd-dt" type="number" name="shipment_expenses">
                                                </td>
                                                <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_shipment_expenses" type="submit" value="บันทึก">
                                                </td>
                                                <?php
                                                @$new_shipment_expenses = $_GET["shipment_expenses"];
                                                @$btn_pd_code = $_GET["btn_upd_shipment_expenses"];
                                                if (isset($btn_pd_code)) {
                                                    if ($new_shipment_expenses <= 0) {
                                                        echo "<td style='color:red;padding:10px 0 0 10px;'>**ค่าจัดส่งไม่ถูกต้อง</td>";
                                                    } else {
                                                        fn_update_pd_data($update_pd_id, "shipment_expenses", $new_shipment_expenses);
                                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                    }
                                                }
                                                ?>
                                            </form>
                                        </tr>
                                    </table>
                                    <div class="ar-bx-upload-pd-image">
                                        <p><b>รายละเอียดย่อ:</b></p>
                                        <p>ใช้ <code>
                                                < br>
                                            </code> เพื่อขึ้นบรรทัดใหม่</p>
                                        <div class="form-txt-area">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <textarea class="ar-inp-pd-detail-txtarea-2" name="pd_detail" id="" cols="100" rows="10"></textarea>
                                                <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <input class="btn-add-pd-category-2" name="btn_upd_pd_detail" type="submit" value="บันทึก">
                                                <?php
                                                @$new_pd_detail = $_GET["pd_detail"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_detail"];
                                                if (isset($btn_pd_code)) {
                                                    fn_update_pd_data($update_pd_id, "pd_detail", $new_pd_detail);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="ar-bx-upload-pd-image">
                                        <p><b>รายละเอียดทั้งหมดภาษาไทย:</b></p>
                                        <p>ใช้ <code>
                                                < br>
                                            </code> เพื่อขึ้นบรรทัดใหม่</p>
                                        <div class="form-txt-area">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <textarea class="ar-inp-pd-detail-txtarea-2" name="pd_detail_th" id="" cols="100" rows="10"></textarea>
                                                <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <input class="btn-add-pd-category-2" name="btn_upd_pd_detail_th" type="submit" value="บันทึก">
                                                <?php
                                                @$new_pd_detail = $_GET["pd_detail_th"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_detail_th"];
                                                if (isset($btn_pd_code)) {
                                                    fn_update_pd_data($update_pd_id, "pd_more_dt_th", $new_pd_detail);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="ar-bx-upload-pd-image">
                                        <p><b>รายละเอียดทั้งหมดภาษาอังกฤษ:</b></p>
                                        <p>ใช้ <code>
                                                < br>
                                            </code> เพื่อขึ้นบรรทัดใหม่</p>
                                        <div class="form-txt-area">
                                            <form action="dashboard_edit_pd.php" method="get">
                                                <textarea class="ar-inp-pd-detail-txtarea-2" name="pd_detail_eng" id="" cols="100" rows="10"></textarea>
                                                <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                <input class="btn-add-pd-category-2" name="btn_upd_pd_detail_eng" type="submit" value="บันทึก">
                                                <?php
                                                @$new_pd_detail_eng = $_GET["pd_detail_eng"];
                                                @$btn_pd_code = $_GET["btn_upd_pd_detail_eng"];
                                                if (isset($btn_pd_code)) {
                                                    fn_update_pd_data($update_pd_id, "pd_more_dt_eng", $new_pd_detail_eng);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px;margin-bottom:5px;">
                                        <p><b>แก้ไขเอกสารไฟล์สินค้า:</b><a href="../access/uploads_pdf_file/<?php get_pdf_file_name($update_pd_id); ?>" download=""> ดาวน์โหลดไฟล์เอกสาร</a></p>
                                    </div>
                                    <div class="ar-bx-pd-pdf-file">
                                        <form action="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>" method="post" enctype="multipart/form-data">
                                            <label for="">เลือกไฟล์เอกสารสินค้า PDF:</label>
                                            <input type="file" name="pdf_file">
                                            <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                            <input class="btn-add-pd-category-2" name="btn_upd_pdf_file" type="submit" value="บันทึก">
                                            <?php
                                            @$btn_pd_code = $_POST["btn_upd_pdf_file"];
                                            if (isset($btn_pd_code)) {
                                                @$new_pd_pdf_file = $_FILES["pdf_file"]["name"];
                                                //echo "PDF FILE", $new_pd_pdf_file เเก้ไขไฟล์ PDF;
                                                fn_update_pdf_file($update_pd_id, $new_pd_pdf_file);
                                                echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                            }
                                            function fn_update_pdf_file($pd_id, $new_pd_pdf_file)
                                            {

                                                @$pdf_file_tmp = $_FILES["pdf_file"]["tmp_name"];
                                                $conn = connect_bestDB();
                                                //ลบไฟล์สินค้า
                                                $sql_get_pdf_file = "select pdf_file_name from tbl_products where pd_id=$pd_id";
                                                $rs_pdf_file = mysqli_query($conn, $sql_get_pdf_file);
                                                $old_pdf_file = mysqli_fetch_row($rs_pdf_file);
                                                @unlink("C:/xampp/htdocs/bestbuy/access/uploads_pdf_file/" . $old_pdf_file[0]); //ลบไฟล์เก่าออก
                                                $escape_pd_id = mysqli_real_escape_string($conn, $pd_id);
                                                $pdf_file_name = date("dmy") . time() . $new_pd_pdf_file;
                                                $sql_update_pd_data = "update tbl_products set pdf_file_name='$pdf_file_name' where pd_id=" . $escape_pd_id . "";
                                                $rs_update = mysqli_query($conn, $sql_update_pd_data);
                                                if ($rs_update == true) {
                                                    @UploadPDFFile($pdf_file_name, $pdf_file_tmp);
                                                } else {
                                                    echo mysqli_error($conn);
                                                }
                                                $conn->close();
                                            }

                                            function UploadPDFFile($file_name, $file_tmp)
                                            {
                                                $target_dir = "C:/xampp/htdocs/bestbuy/access/uploads_pdf_file/";
                                                $target_file = $target_dir . $file_name;
                                                move_uploaded_file($file_tmp, $target_file);
                                            }
                                            ?>
                                        </form>
                                    </div>
                                    <div style="margin-top:30px;margin-bottom:5px;">
                                        <p><b>แก้ไขรูปภาพสินค้า:</b></p>
                                    </div>
                                    <div class="ar-show-update-pd-image">
                                        <?php
                                        $pd_image_file = get_pd_image_file($update_pd_id);
                                        ?>
                                        <div class="ar-update-pd-img-bx" id="ckk_image_file_list1">
                                            <div class="ar-show-pd-img">
                                                <img src="../access//uploads_image_file/<?php echo $pd_image_file[0] ?>" alt="" width="80px">
                                            </div>
                                            <div class="btn-del-pd-img">
                                                <a class="btn-del-pd-img-file" href="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>&btn_del1=btn_del1">ลบ</a>
                                                <?php
                                                @$btn_del = $_GET["btn_del1"];
                                                if (isset($btn_del)) {
                                                    del_pd_image($update_pd_id, "image_file1");
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                            <div class="ar-form-upload-file">
                                                <form action="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="pd_img_1">
                                                    <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_img_file" type="submit" value="บันทึก">
                                                </form>
                                                <?php
                                                @$btn_ckk_upd_img_file = $_POST["btn_upd_img_file"];
                                                if (isset($btn_ckk_upd_img_file)) {
                                                    @$image_file_1 = $_FILES["pd_img_1"]["name"];
                                                    @$image_file_tmp1 = $_FILES["pd_img_1"]["tmp_name"];
                                                    upload_new_pd_image($update_pd_id, "image_file1", $image_file_1, $image_file_tmp1);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ar-update-pd-img-bx" id="ckk_image_file_list2">
                                            <div class="ar-show-pd-img">
                                                <img src="../access//uploads_image_file/<?php echo $pd_image_file[1] ?>" alt="" width="80px">
                                            </div>
                                            <div class="btn-del-pd-img">
                                                <a class="btn-del-pd-img-file" href="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>&btn_del2=btn_del2">ลบ</a>
                                                <?php
                                                @$btn_del = $_GET["btn_del2"];
                                                if (isset($btn_del)) {
                                                    del_pd_image($update_pd_id, "image_file2");
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                            <div class="ar-form-upload-file">
                                                <form action="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="pd_img_2">
                                                    <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_img_file2" type="submit" value="บันทึก">
                                                </form>
                                                <?php
                                                @$btn_ckk_upd_img_file = $_POST["btn_upd_img_file2"];
                                                if (isset($btn_ckk_upd_img_file)) {
                                                    @$image_file_1 = $_FILES["pd_img_2"]["name"];
                                                    @$image_file_tmp1 = $_FILES["pd_img_2"]["tmp_name"];
                                                    upload_new_pd_image($update_pd_id, "image_file2", $image_file_1, $image_file_tmp1);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ar-update-pd-img-bx" id="ckk_image_file_list3">
                                            <div class="ar-show-pd-img">
                                                <img src="../access//uploads_image_file/<?php echo $pd_image_file[2] ?>" alt="" width="80px">
                                            </div>
                                            <div class="btn-del-pd-img">
                                                <a class="btn-del-pd-img-file" href="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>&btn_del3=btn_del3">ลบ</a>
                                                <?php
                                                @$btn_del = $_GET["btn_del3"];
                                                if (isset($btn_del)) {
                                                    del_pd_image($update_pd_id, "image_file3");
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                            <div class="ar-form-upload-file">
                                                <form action="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="pd_img_3">
                                                    <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_img_file3" type="submit" value="บันทึก">
                                                </form>
                                                <?php
                                                @$btn_ckk_upd_img_file = $_POST["btn_upd_img_file3"];
                                                if (isset($btn_ckk_upd_img_file)) {
                                                    @$image_file_1 = $_FILES["pd_img_3"]["name"];
                                                    @$image_file_tmp1 = $_FILES["pd_img_3"]["tmp_name"];
                                                    upload_new_pd_image($update_pd_id, "image_file3", $image_file_1, $image_file_tmp1);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ar-update-pd-img-bx" id="ckk_image_file_list4">
                                            <div class="ar-show-pd-img">
                                                <img src="../access//uploads_image_file/<?php echo $pd_image_file[3] ?>" alt="" width="80px">
                                            </div>
                                            <div class="btn-del-pd-img">
                                                <a class="btn-del-pd-img-file" href="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>&btn_del4=btn_del4">ลบ</a>
                                                <?php
                                                @$btn_del = $_GET["btn_del4"];
                                                if (isset($btn_del)) {
                                                    del_pd_image($update_pd_id, "image_file4");
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                            <div class="ar-form-upload-file">
                                                <form action="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="pd_img_4">
                                                    <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_img_file4" type="submit" value="บันทึก">
                                                </form>
                                                <?php
                                                @$btn_ckk_upd_img_file = $_POST["btn_upd_img_file4"];
                                                if (isset($btn_ckk_upd_img_file)) {
                                                    @$image_file_1 = $_FILES["pd_img_4"]["name"];
                                                    @$image_file_tmp1 = $_FILES["pd_img_4"]["tmp_name"];
                                                    upload_new_pd_image($update_pd_id, "image_file4", $image_file_1, $image_file_tmp1);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ar-update-pd-img-bx" id="ckk_image_file_list5">
                                            <div class="ar-show-pd-img">
                                                <img src="../access//uploads_image_file/<?php echo $pd_image_file[4] ?>" alt="" width="80px">
                                            </div>
                                            <div class="btn-del-pd-img">
                                                <a class="btn-del-pd-img-file" href="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>&btn_del5=btn_del5">ลบ</a>
                                                <?php
                                                @$btn_del = $_GET["btn_del5"];
                                                if (isset($btn_del)) {
                                                    del_pd_image($update_pd_id, "image_file5");
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                            <div class="ar-form-upload-file">
                                                <form action="dashboard_edit_pd.php?edit_pd_id=<?php echo $update_pd_id; ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="file" name="pd_img_5">
                                                    <input style='display:none;' type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                    <input class="btn-add-pd-category-2" name="btn_upd_img_file5" type="submit" value="บันทึก">
                                                </form>
                                                <?php
                                                @$btn_ckk_upd_img_file = $_POST["btn_upd_img_file5"];
                                                if (isset($btn_ckk_upd_img_file)) {
                                                    @$image_file_1 = $_FILES["pd_img_5"]["name"];
                                                    @$image_file_tmp1 = $_FILES["pd_img_5"]["tmp_name"];
                                                    upload_new_pd_image($update_pd_id, "image_file5", $image_file_1, $image_file_tmp1);
                                                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ar-bx-ad-form-title2">
                                        <p><b>แก้ไขลักษณะสินค้า</b></p>
                                    </div>
                                    <div class="ar-form-add-pd-category-name">
                                        <div class="ar-inp-pd-inf-bx">
                                            <table>
                                                <tr class="ar-td-ds-pd-inp">
                                                    <form action="dashboard_edit_pd.php" method="get">
                                                        <td>1:</td>
                                                        <td><input class="sh-inp-pd-dt" type="text" name="pd_slc1"></td>
                                                        <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                        <td>
                                                            <input class="btn-add-pd-category-2" name="btn_pd_slc1" type="submit" value="บันทึก">
                                                        </td>
                                                        <?php
                                                        @$new_pd_code = $_GET["pd_slc1"];
                                                        @$btn_pd_code = $_GET["btn_pd_slc1"];
                                                        if (isset($btn_pd_code)) {
                                                            fn_update_pd_data($update_pd_id, "pd_slc1", $new_pd_code);
                                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                        }
                                                        ?>
                                                    </form>
                                                </tr>
                                                <tr class="ar-td-ds-pd-inp">
                                                    <form action="dashboard_edit_pd.php" method="get">
                                                        <td>2:</td>
                                                        <td><input class="sh-inp-pd-dt" type="text" name="pd_slc2"></td>
                                                        <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                        <td>
                                                            <input class="btn-add-pd-category-2" name="btn_pd_slc2" type="submit" value="บันทึก">
                                                        </td>
                                                        <?php
                                                        @$new_pd_code = $_GET["pd_slc2"];
                                                        @$btn_pd_code = $_GET["btn_pd_slc2"];
                                                        if (isset($btn_pd_code)) {
                                                            fn_update_pd_data($update_pd_id, "pd_slc2", $new_pd_code);
                                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                        }
                                                        ?>
                                                    </form>
                                                </tr>
                                                <tr class="ar-td-ds-pd-inp">
                                                    <form action="dashboard_edit_pd.php" method="get">
                                                        <td>3:</td>
                                                        <td><input class="sh-inp-pd-dt" type="text" name="pd_slc3"></td>
                                                        <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                        <td>
                                                            <input class="btn-add-pd-category-2" name="btn_pd_slc3" type="submit" value="บันทึก">
                                                        </td>
                                                        <?php
                                                        @$new_pd_code = $_GET["pd_slc3"];
                                                        @$btn_pd_code = $_GET["btn_pd_slc3"];
                                                        if (isset($btn_pd_code)) {
                                                            fn_update_pd_data($update_pd_id, "pd_slc3", $new_pd_code);
                                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                        }
                                                        ?>
                                                    </form>
                                                </tr>
                                                <tr class="ar-td-ds-pd-inp">
                                                    <form action="dashboard_edit_pd.php" method="get">
                                                        <td>4:</td>
                                                        <td><input class="sh-inp-pd-dt" type="text" name="pd_slc4"></td>
                                                        <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                        <td>
                                                            <input class="btn-add-pd-category-2" name="btn_pd_slc4" type="submit" value="บันทึก">
                                                        </td>
                                                        <?php
                                                        @$new_pd_code = $_GET["pd_slc4"];
                                                        @$btn_pd_code = $_GET["btn_pd_slc4"];
                                                        if (isset($btn_pd_code)) {
                                                            fn_update_pd_data($update_pd_id, "pd_slc4", $new_pd_code);
                                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                        }
                                                        ?>
                                                    </form>
                                                </tr>
                                                <tr class="ar-td-ds-pd-inp">
                                                    <form action="dashboard_edit_pd.php" method="get">
                                                        <td>5:</td>
                                                        <td><input class="sh-inp-pd-dt" type="text" name="pd_slc5"></td>
                                                        <td style="display: none;"><input class="sh-inp-pd-dt" type="text" name="edit_pd_id" value="<?php echo $update_pd_id; ?>"></td>
                                                        <td>
                                                            <input class="btn-add-pd-category-2" name="btn_pd_slc5" type="submit" value="บันทึก">
                                                        </td>
                                                        <?php
                                                        @$new_pd_code = $_GET["pd_slc5"];
                                                        @$btn_pd_code = $_GET["btn_pd_slc5"];
                                                        if (isset($btn_pd_code)) {
                                                            fn_update_pd_data($update_pd_id, "pd_slc5", $new_pd_code);
                                                            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_edit_pd.php?edit_pd_id=$update_pd_id'>";
                                                        }
                                                        ?>
                                                    </form>
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
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>

</html>