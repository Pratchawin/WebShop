<?php
include 'format.php';
@$main_category_id = $_GET["pd_id"]; //id สินค้า
//เเก้ไขข้อมูลประเภทสินค้าหลัก

//เเสดงประเภทสินค้าหลักทั้งหมด
function get_all_main_category()
{
    $conn = connect_bestDB();
    $sql_all_main_category = "select category_id,category_name from tbl_category";
    $rs_current_data = mysqli_query($conn, $sql_all_main_category);
    while ($current_category_main = mysqli_fetch_assoc($rs_current_data)) {
        echo "<option value='" . $current_category_main["category_id"] . "'>" . $current_category_main["category_name"] . "</option>";
    }
}
//อัพเดทประเภทสินค้าหลัก
function update_main_category($ctt_main_id, $pd_id)
{
    $conn = connect_bestDB();
    $sql_update_main_category = "update tbl_products set category_name='$ctt_main_id' where pd_id='$pd_id'";
    mysqli_query($conn, $sql_update_main_category);
    $conn->close();
}
//เเสดงประเภทสินค้าย่อย
function get_all_category_list()
{
    $conn = connect_bestDB();
    $sql_all_main_category = "select category_list_id,category_list_name from tbl_category_ls";
    $rs_current_data = mysqli_query($conn, $sql_all_main_category);
    while ($current_category_main = mysqli_fetch_assoc($rs_current_data)) {
        echo "<option value='" . $current_category_main["category_list_id"] . "'>" . $current_category_main["category_list_name"] . "</option>";
    }
}
//เเก้ไขประเภทสินค้าย่อย
function update_category_list($ctt_list, $pd_id)
{
    $conn = connect_bestDB();
    $sql_update_main_category = "update tbl_products set category_list_name='$ctt_list' where pd_id='$pd_id'";
    mysqli_query($conn, $sql_update_main_category);
    $conn->close();
}
//ดึงข้อมูลสินค้าก่อนอัพเดทมาเเสดง
function get_old_pd_image($pd_id)
{
    $conn = connect_bestDB();
    $sql_get_old_image = "select image_file1,image_file2,image_file3,image_file4,image_file5 from tbl_products where pd_id=$pd_id";
    $rs_pd_data = mysqli_query($conn, $sql_get_old_image);
    $upd_data = mysqli_fetch_row($rs_pd_data);
    echo "
    <div class='ar-upd-main-image'>
        <img src='../access/uploads_image_file/" . $upd_data[0] . "' alt='' class='upd-main-image'>
    </div>
    <div class='ar-upd-img-list'>
        <div class='ar-upd-list-bx'>
            <img src='../access/uploads_image_file/" . $upd_data[1] . "' alt='' class='upd-list-image'>
        </div>
        <div class='ar-upd-list-bx' class='upd-list-image'>
            <img src='../access/uploads_image_file/" . $upd_data[2] . "' alt='' class='upd-list-image'>
        </div>
        <div class='ar-upd-list-bx' class='upd-list-image'>
            <img src='../access/uploads_image_file/" . $upd_data[3] . "' alt='' class='upd-list-image'>
        </div>
        <div class='ar-upd-list-bx' class='upd-list-image'>
            <img src='../access/uploads_image_file/" . $upd_data[4] . "' alt='' class='upd-list-image'>
        </div>
    </div>
    ";
    $conn->close();
}
function get_old_pd_data($pd_id)
{
    //ดึงข้อมูลสินค้า
    $conn = connect_bestDB();
    $sql_get_old_data = "select pd_name,category_name,category_list_name,pd_code,pd_model,pd_brand,pd_detail,pd_price,pd_quantity,pd_status,shipment_expenses,discount,pd_slc1,pd_slc2,pd_slc3,pd_slc4,pd_slc5 from tbl_products where pd_id=$pd_id";
    $rs_pd = mysqli_query($conn, $sql_get_old_data);
    $old_pd_data = mysqli_fetch_assoc($rs_pd);
    //ดึงข้อมูลประเภทสินค้าหลัก
    $sql_all_main_category = "select category_name from tbl_category where category_id=" . $old_pd_data["category_name"] . "";
    $rs_current_data = mysqli_query($conn, $sql_all_main_category);
    $main_category = mysqli_fetch_assoc($rs_current_data);
    //ดึงข้อมูลประเภทสินค้าย่อย
    $sql_all_main_category = "select category_list_name from tbl_category_ls where category_list_id=" . $old_pd_data["category_list_name"] . "";
    $rs_current_data = mysqli_query($conn, $sql_all_main_category);
    $ctt_list_data = mysqli_fetch_assoc($rs_current_data);
    $ckk_status = '';
    if ($old_pd_data["pd_status"] == "1") {
        $ckk_status = "<p style='color:green;'>มีสินค้า</p>";
    } else if ($old_pd_data["pd_status"] == "0") {
        $ckk_status = "<p style='color:red;'>สั่งจองล่วงหน้า</p>";
    }
    $pd_discount = pd_discount($old_pd_data["discount"], $old_pd_data["pd_price"]);
    echo "
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ชื่อสินค้า:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $old_pd_data["pd_name"] . "</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ประเภทสินค้าหลัก:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $main_category["category_name"] . "</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ประเภทสินค้าย่อย:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $ctt_list_data["category_list_name"] . "</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>จำนวนสินค้า:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $old_pd_data["pd_quantity"] . " ชิ้น</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>รหัสสินค้า:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $old_pd_data["pd_code"] . "</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ยี่ห้อ:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $old_pd_data["pd_brand"] . "</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>รุ่น:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $old_pd_data["pd_model"] . "</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>สถานะสินค้า:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $ckk_status . "</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ราคาปกติ:</b></td>
        <td class='upd-td-show-pd-dtt'>" . formatMoney($old_pd_data["pd_price"], true) . " บาท</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ส่วนลด:</b></td>
        <td class='upd-td-show-pd-dtt'>" . $old_pd_data["discount"] . "%</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ราคาส่วนลด:</b></td>
        <td class='upd-td-show-pd-dtt'>" . formatMoney($pd_discount, true) . " บาท</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ค่าจัดส่ง:</b></td>
        <td class='upd-td-show-pd-dtt'>" . formatMoney($old_pd_data["shipment_expenses"], true) . " บาท</td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>รายละเอียดย่อ:</b></td>
        <td class='td-upd-pd-detail-ls upd-td-show-pd-dtt'>
            " . $old_pd_data["pd_detail"] . "
        </td>
    </tr>
    <tr>
        <td class='upd-td-show-pd-dtt'><b>ลักษณะสินค้า:</b></td>
        <td class='td-upd-pd-detail-ls upd-td-show-pd-dtt'>
            " . $old_pd_data["pd_slc1"].",".$old_pd_data["pd_slc2"]."," .$old_pd_data["pd_slc3"]."," .$old_pd_data["pd_slc4"]."," .$old_pd_data["pd_slc5"] . "
        </td>
    </tr>
    ";
    $conn->close();
}
//เเก้ไขข้อมูลสินค้า
function pd_discount($discount, $pd_price)
{
    $pd_discount = ($pd_price * $discount) / 100;
    $pd_price = $pd_price - $pd_discount;
    return $pd_price;
}

//ดึงข้อมูลสินค้าภาษา TH, ENG
function get_pd_detial_th_eng($pd_id)
{
    $conn = connect_bestDB();
    $sql_get_old_data = "select pd_more_dt_th,pd_more_dt_eng from tbl_products where pd_id=" . $pd_id . "";
    $rs_pd = mysqli_query($conn, $sql_get_old_data);
    $old_pd_data_th = mysqli_fetch_assoc($rs_pd);
    echo "
    <div class='ar-upd-detail-th'>
        <p><b>รายละเอียดภาษาไทย</b></p>
        <p>" . $old_pd_data_th["pd_more_dt_th"] . "</p>
    </div>
    <div class='ar-upd-detail-eng'>
        <p><b>รายละเอียดภาษาอังกฤษ</b></p>
        <p>" . $old_pd_data_th["pd_more_dt_eng"] . "</p>
    </div>
    ";
    $conn->close();
}

//ฟังก์ชั่นเเก้ไขข้อมูลสินค้า
function fn_update_pd_data($pd_id, $field_name, $new_data)
{
    $conn = connect_bestDB();
    $escape_pd_id = mysqli_real_escape_string($conn, $pd_id);
    $escape_field_name = mysqli_real_escape_string($conn, $field_name);
    $escape_new_data = mysqli_real_escape_string($conn, $new_data);
    $sql_update_pd_data = "update tbl_products set $escape_field_name='$escape_new_data' where pd_id=" . $escape_pd_id . "";
    $rs_update = mysqli_query($conn, $sql_update_pd_data);
    if ($rs_update == true) {
        echo "เเก้ไขสินค้าเรียบร้อย";
    } else {
        echo mysqli_error($conn);
    }
    $conn->close();
}
//เเก้ไขราคาส่วนลด
function fn_update_pd_discount($pd_id, $field_name, $new_data)
{
    $conn = connect_bestDB();
    $sql_get_old_price="select pd_price from tbl_products where pd_id='$pd_id'";
    $rs_old_price=mysqli_query($conn, $sql_get_old_price);
    $old_price=mysqli_fetch_assoc($rs_old_price);
    $pd_discount=($old_price["pd_price"]*$new_data)/100;
    $new_price=$old_price["pd_price"]-$pd_discount;
    //อัปเดท fororder price
    $escape_pd_id = mysqli_real_escape_string($conn, $pd_id);
    $escape_field_name = mysqli_real_escape_string($conn, $field_name);
    $escape_new_data = mysqli_real_escape_string($conn, $new_data);
    $sql_update_pd_data = "update tbl_products set $escape_field_name='$escape_new_data', for_order_price='$new_price' where pd_id=" . $escape_pd_id . "";
    $rs_update = mysqli_query($conn, $sql_update_pd_data);
    if ($rs_update == true) {
        echo "เเก้ไขสินค้าเรียบร้อย";
    } else {
        echo mysqli_error($conn);
    }
    $conn->close();
}
//แก้ไขราคาสินค้า
function fn_update_pd_price($pd_id, $field_name, $new_data)
{
    $conn = connect_bestDB();
    $sql_get_old_price="select discount from tbl_products where pd_id='$pd_id'";
    $rs_old_price=mysqli_query($conn, $sql_get_old_price);
    $old_price=mysqli_fetch_assoc($rs_old_price);
    $new_price=0;
    if($old_price["discount"]==0){
        $new_price=$new_data;
    }else{
        $pd_discount=($new_data*$old_price["discount"])/100;
        $new_price=$new_data-$pd_discount;
    }
    //อัปเดท fororder price
    $escape_pd_id = mysqli_real_escape_string($conn, $pd_id);
    $escape_field_name = mysqli_real_escape_string($conn, $field_name);
    $escape_new_data = mysqli_real_escape_string($conn, $new_data);
    $sql_update_pd_data = "update tbl_products set $escape_field_name='$escape_new_data', for_order_price='$new_price' where pd_id=" . $escape_pd_id . "";
    $rs_update = mysqli_query($conn, $sql_update_pd_data);
    if ($rs_update == true) {
        echo "เเก้ไขสินค้าเรียบร้อย";
    } else {
        echo mysqli_error($conn);
    }
    $conn->close();
}
//ดึงไฟล์สินค้า
function get_pdf_file_name($pd_id)
{
    $conn = connect_bestDB();
    $escape_pd_id = mysqli_real_escape_string($conn, $pd_id);
    $sql_get_pdf_file = "select pdf_file_name from tbl_products where pd_id=$escape_pd_id";
    $rs_pdf_file = mysqli_query($conn, $sql_get_pdf_file);
    $old_pdf_file = mysqli_fetch_row($rs_pdf_file);
    echo $old_pdf_file[0];
    $conn->close();
}

//ดึงรูปภาพสินค้า
function get_pd_image_file($pd_id)
{
    $conn = connect_bestDB();
    $sql_pd_image = "select image_file1,image_file2,image_file3,image_file4,image_file5 from tbl_products where pd_id=$pd_id";
    $rs_pd_img = mysqli_query($conn, $sql_pd_image);
    $pd_img = mysqli_fetch_assoc($rs_pd_img);
    //echo "Product image:",$pd_img["image_file1"];
    return array($pd_img["image_file1"], $pd_img["image_file2"], $pd_img["image_file3"], $pd_img["image_file4"], $pd_img["image_file5"]);
}
//ลบรูปภาพ
function del_pd_image($pd_id, $img_field)
{
    $conn = connect_bestDB();
    $sql_img_file = "select  $img_field from tbl_products where pd_id=$pd_id";
    $rs_img_file = mysqli_query($conn, $sql_img_file);
    $old_img_file = mysqli_fetch_row($rs_img_file);
    @unlink("C:/xampp/htdocs/bestbuy/access/uploads_image_file/" .$old_img_file[0]);//ลบไฟล์เก่าออก
    $escape_pd_id = mysqli_real_escape_string($conn, $pd_id);
    $escape_field = mysqli_real_escape_string($conn, $img_field);
    $sql_del_pd_img = "update tbl_products set $escape_field='' where pd_id=" . $escape_pd_id . "";
    $rs_sql_exe = mysqli_query($conn, $sql_del_pd_img);
    if ($rs_sql_exe != true) {
        echo mysqli_error($conn);
    } 
    //return $rs_sql_exe;
}
//อัปโหลดไฟล์ใหม่
function upload_new_pd_image($pd_id, $img_field,$image_file_1,$image_file_tmp1)
{
    $conn = connect_bestDB();
    $escape_pd_id = mysqli_real_escape_string($conn, $pd_id);
    $file_name1 = date("dmy") . time() . $image_file_1;
    $sql_img_file = "update tbl_products set $img_field='$file_name1' where pd_id=" . $escape_pd_id . "";
    $rs_img_file = mysqli_query($conn, $sql_img_file);
    if ($rs_img_file != true) {
        echo mysqli_error($conn);
        echo "<p>ไม่สามารถอัปโหลดไฟล์รูปภาพได้</p>";
    }else{
        UploadImageFile($file_name1, $image_file_tmp1);
    }
    $conn->close();
}

function UploadImageFile($file_name, $file_tmp)
{
    $target_dir = "C:/xampp/htdocs/bestbuy/access/uploads_image_file/";
    $target_file = $target_dir . $file_name;
    move_uploaded_file($file_tmp, $target_file);
}
