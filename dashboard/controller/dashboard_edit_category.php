<?php

//ดึงข้อมูลประเภทสินค้า
function get_pd_category()
{
    $conn = connect_bestDB();
    $sql_ctt = "select category_id, category_name from tbl_category";
    $ctt_exe = mysqli_query($conn, $sql_ctt);
    $i = 0;
    if (mysqli_num_rows($ctt_exe) > 0) {
        while ($ctt_data = mysqli_fetch_assoc($ctt_exe)) {
            $i += 1;
            echo "
                <tr>
                    <td class='td-edit-ctt-name'>" . $ctt_data["category_name"] . "</td>
                    <td class='td-edit-ctt-btn-edit'><button id='btn_edit_ctt' class='btn-edit-ctt' onclick='show_form_edit_pd($i)'>เเก้ไข</button></td>
                    <td class='td-edit-ctt-btn-del'><a href='dashboard_edit_category.php?btn_del_ctt=btn_del_ctt&ctt_id=" . $ctt_data["category_id"] . "' class='btn-del-ctt'>ลบ</a></td>
                </tr>
                <tr id='show_form_inp_new_ctt$i' class='tr-inp-form-edit-ctt'>
                    <form action='dashboard_edit_category.php' method='post'>
                        <td class='td-edit-ctt-name'>
                            <input type='text' name='upd_ctt_data' class='inp-new-ctt-name'>
                        </td>
                        <td class='td-edit-ctt-btn-edit'>
                            <input type='text' name='ctt_id' style='display:none;' value='" . $ctt_data["category_id"] . "'>
                            <input name='btn_save_upd_category' type='submit' class='btn-save-new-ctt-name' value='บันทึก'>
                        </td>
                     </form>
                </tr>
                ";
        }
    }
}
@$btn_save_upd_category = $_POST["btn_save_upd_category"];
if (isset($btn_save_upd_category)) {
    $inp_ctt = $_POST["upd_ctt_data"];
    $ctt_id = $_POST["ctt_id"];
    update_category($inp_ctt, $ctt_id);
}
//เเก้ไขประเภทสินค้าหลัก
function update_category($inp_ctt, $ctt_id)
{
    $conn = connect_bestDB();
    $ctt_es = mysqli_real_escape_string($conn, $inp_ctt);
    $ctt_id = mysqli_real_escape_string($conn, $ctt_id);
    $sql_upd_new_ctt_name = "update tbl_category set category_name='$ctt_es' where category_id='$ctt_id'";
    mysqli_query($conn, $sql_upd_new_ctt_name);
    $conn->close();
}
//ลบประเภทสินค้าหลัก
function delete_category($ctt_id)
{
    $conn = connect_bestDB();
    //ดึง id สินค้าเเละลบสินค้าใน orders 
    $sql_get_pd_id = "select pd_id from tbl_products where category_name='$ctt_id'";
    $rs_pd_id = mysqli_query($conn, $sql_get_pd_id);
    while ($pd_id = mysqli_fetch_assoc($rs_pd_id)) {
        $sql_delete_order = "delete from tbl_orders where pd_id=" . $pd_id["pd_id"] . "";
        mysqli_query($conn, $sql_delete_order);
    }
    //ลบประเภทสินค้า
    $sql_del_category = "delete from tbl_category where category_id='$ctt_id'";
    $rs_ckk_del = mysqli_query($conn, $sql_del_category);
    if ($rs_ckk_del != true) {
        echo mysqli_error($conn);
    }
    //ลบประเภทสินค้าย่อย
    $sql_del_category_list = "delete from tbl_category_ls where category_id='$ctt_id'";
    $rs_ckk_dels = mysqli_query($conn, $sql_del_category_list);
    if ($rs_ckk_dels != true) {
        echo mysqli_error($conn);
    }
    //ลบรูปสินค้าเเละไฟล์สินค้า
    get_file($ctt_id);
    //ลบสินค้าที่อยู่ในหมวดหมู่เดียวกัน
    $sql_del_category_list = "delete from tbl_products where category_name='$ctt_id'";
    $rs_ckk_dels = mysqli_query($conn, $sql_del_category_list);
    if ($rs_ckk_dels != true) {
        echo mysqli_error($conn);
    }
    $conn->close();
}
//ลบไฟล์ pdf, image สินค้าทั้งหมด
function get_file($ctt_id)
{
    $conn = connect_bestDB();
    $sql_select_pd_file = "select image_file1,image_file2,image_file3,image_file4,image_file5,pdf_file_name from tbl_products where category_name='$ctt_id'";
    $rs_pd_file = mysqli_query($conn, $sql_select_pd_file);
    if (mysqli_num_rows($rs_pd_file) > 0) {
        while ($pd_img_file = mysqli_fetch_assoc($rs_pd_file)) {
            unlink("C:/xampp/htdocs/bestbuy/access/uploads_pdf_file/" . $pd_img_file["pdf_file_name"]);
            for ($i = 1; $i <= 5; $i++) {
                if ($pd_img_file["image_file$i"] != null) {
                    unlink("C:/xampp/htdocs/bestbuy/access/uploads_image_file/" . $pd_img_file["image_file$i"]);
                }
            }
        }
    }
}

//เเสดงแบรนด์สินค้า
function get_pd_brand()
{
    $conn = connect_bestDB();
    $sql_ctt = "select brand_id, brand_name from tbl_pd_brand";
    $ctt_exe = mysqli_query($conn, $sql_ctt);
    $i = 0;
    if (mysqli_num_rows($ctt_exe) > 0) {
        while ($ctt_data = mysqli_fetch_assoc($ctt_exe)) {
            $i += 1;
            echo "
            <tr>
                <td class='td-edit-ctt-name'>" . $ctt_data["brand_name"] . "</td>
                <td class='td-edit-ctt-btn-edit'><button id='btn_edit_ctt_list' class='btn-edit-ctt' onclick='show_form_edit_pd_brand($i)'>เเก้ไข</button></td>
                <td class='td-edit-ctt-btn-del'><a href='dashboard_edit_category.php?btn_del_brand=btn_del_ctt_list&del_brand_id=" . $ctt_data["brand_id"] . "' class='btn-del-ctt'>ลบ</a></td>
            </tr>
            <tr id='show_form_inp_pd_brand$i' class='tr-inp-form-edit-ctt-2'>
                    <form action='dashboard_edit_category.php' method='get'>
                        <td class='td-edit-ctt-name'>
                            <input type='text' name='upd_brand_name' class='inp-new-ctt-name'>
                        </td>
                        <td class='td-edit-ctt-btn-edit'>
                            <input type='text' name='brand_id' style='display:none;' value='" . $ctt_data["brand_id"] . "'>
                            <input name='btn_save_pd_brand' type='submit' class='btn-save-new-ctt-name' value='บันทึก'>
                        </td>
                    </form>
            </tr>
            ";
        }
    }
    $conn->close();
}
@$btn_upd_ctt_list = $_GET["btn_save_pd_brand"];
if (isset($btn_upd_ctt_list)) {
    @$inp_ctt_list = $_GET["upd_brand_name"];
    @$ctt_list_id = $_GET["brand_id"];
    update_pd_brand($inp_ctt_list, $ctt_list_id);
}
//เเก้ไขแบรนด์สินค้า
function update_pd_brand($inp_ctt, $ctt_id)
{
    $conn = connect_bestDB();
    $ctt_es = mysqli_real_escape_string($conn, $inp_ctt);
    $ctt_id = mysqli_real_escape_string($conn, $ctt_id);
    $sql_upd_new_ctt_name = "update tbl_pd_brand set brand_name='$ctt_es' where brand_id='$ctt_id'";
    mysqli_query($conn, $sql_upd_new_ctt_name);
    $conn->close();
}
@$btn_del_brand = $_GET["btn_del_brand"];
if (isset($btn_del_brand)) {
    @$brand_id = $_GET["del_brand_id"];
    del_pd_brand($brand_id);
}
//ลบเเบรนด์สินค้า
function del_pd_brand($brand_id)
{
    $conn = connect_bestDB();
    $sql_del_brand = "delete from tbl_pd_brand where brand_id='$brand_id'";
    mysqli_query($conn, $sql_del_brand);
    $conn->close();
}
//ดึงประเภทสินค้าหลัก
function select_pd_category()
{
    $conn = connect_bestDB();
    $sql_ctt = "select category_id, category_name from tbl_category";
    $ctt_exe = mysqli_query($conn, $sql_ctt);
    $i = 0;
    if (mysqli_num_rows($ctt_exe) > 0) {
        while ($ctt_data = mysqli_fetch_assoc($ctt_exe)) {
            $i += 1;
            echo "
                <option value=" . $ctt_data["category_id"] . ">" . $ctt_data["category_name"] . "</option>
            ";
        }
    }
    $conn->close();
}
//เเสดงประเภทสินค้าย่อย
function get_category_list($ctt_id)
{
    $j = 0;
    $conn = connect_bestDB();
    $sql_get_ctt_list = "select category_list_id, category_id, category_list_name from tbl_category_ls where category_id='$ctt_id'";
    $rs_exe_ctt_ls = mysqli_query($conn, $sql_get_ctt_list);
    if (mysqli_num_rows($rs_exe_ctt_ls) > 0) {
        while ($ctt_list_data = mysqli_fetch_assoc($rs_exe_ctt_ls)) {
            $j += 1;
            echo "
            <tr>
                <td class='td-edit-ctt-name'>" . $ctt_list_data["category_list_name"] . "</td>
                <td class='td-edit-ctt-btn-edit'><button id='btn_edit_ctt_list' class='btn-edit-ctt' onclick='show_form_edit_pd_list($j)'>เเก้ไข</button></td>
                <td class='td-edit-ctt-btn-del'><a href='dashboard_edit_category.php?btn_del_ctt_list=btn_del_ctt_list&scl_ctt_list_name=" . $ctt_list_data["category_id"] . "&ctt_list_id=" . $ctt_list_data["category_list_id"] . "' class='btn-del-ctt'>ลบ</a></td>
            </tr>
            <tr id='show_form_inp_new_ctt_list$j' class='tr-inp-form-edit-ctt-2'>
                    <form action='dashboard_edit_category.php' method='get'>
                        <td class='td-edit-ctt-name'>
                            <input type='text' name='upd_ctt_data_list' class='inp-new-ctt-name'>
                        </td>
                        <td class='td-edit-ctt-btn-edit'>
                            <input type='text' name='ctt_list_id' style='display:none;' value='" . $ctt_list_data["category_list_id"] . "'>
                            <input type='text' name='scl_ctt_list_name' style='display:none;' value='" . $ctt_list_data["category_id"] . "'>
                            <input name='btn_save_upd_category_list' type='submit' class='btn-save-new-ctt-name' value='บันทึก'>
                        </td>
                     </form>
                </tr>
            ";
        }
    }
}
function get_category_list2()
{
    $j = 0;
    $conn = connect_bestDB();
    $sql_get_ctt_list = "select category_list_id, category_id, category_list_name from tbl_category_ls";
    $rs_exe_ctt_ls = mysqli_query($conn, $sql_get_ctt_list);
    if (mysqli_num_rows($rs_exe_ctt_ls) > 0) {
        while ($ctt_list_data = mysqli_fetch_assoc($rs_exe_ctt_ls)) {
            $j += 1;
            echo "
            <tr>
                <td class='td-edit-ctt-name'>" . $ctt_list_data["category_list_name"] . "</td>
                <td class='td-edit-ctt-btn-edit'><button id='btn_edit_ctt_list' class='btn-edit-ctt' onclick='show_form_edit_pd_list($j)'>เเก้ไข</button></td>
                <td class='td-edit-ctt-btn-del'><a href='dashboard_edit_category.php?btn_del_ctt_list=btn_del_ctt_list&scl_ctt_list_name=" . $ctt_list_data["category_id"] . "&ctt_list_id=" . $ctt_list_data["category_list_id"] . "' class='btn-del-ctt'>ลบ</a></td>
            </tr>
            <tr id='show_form_inp_new_ctt_list$j' class='tr-inp-form-edit-ctt-2'>
                    <form action='dashboard_edit_category.php' method='get'>
                        <td class='td-edit-ctt-name'>
                            <input type='text' name='upd_ctt_data_list' class='inp-new-ctt-name'>
                        </td>
                        <td class='td-edit-ctt-btn-edit'>
                            <input type='text' name='ctt_list_id' style='display:none;' value='" . $ctt_list_data["category_list_id"] . "'>
                            <input type='text' name='scl_ctt_list_name' style='display:none;' value='" . $ctt_list_data["category_id"] . "'>
                            <input name='btn_save_upd_category_list' type='submit' class='btn-save-new-ctt-name' value='บันทึก'>
                        </td>
                     </form>
                </tr>
            ";
        }
    }
}
@$btn_upd_ctt_list = $_GET["btn_save_upd_category_list"];
if (isset($btn_upd_ctt_list)) {
    @$inp_ctt_list = $_GET["upd_ctt_data_list"];
    @$ctt_list_id = $_GET["ctt_list_id"];
    update_category_list($inp_ctt_list, $ctt_list_id);
}
//เเก้ไขประเภทสินค้าย่อย
function update_category_list($inp_ctt, $ctt_id)
{
    $conn = connect_bestDB();
    $ctt_es = mysqli_real_escape_string($conn, $inp_ctt);
    $ctt_id = mysqli_real_escape_string($conn, $ctt_id);
    $sql_upd_new_ctt_name = "update tbl_category_ls set category_list_name='$ctt_es' where category_list_id='$ctt_id'";
    mysqli_query($conn, $sql_upd_new_ctt_name);
    $conn->close();
}
//ลบประเภทสินค้าย่อย
function del_ctt_list($ctt_list_id)
{
    $conn = connect_bestDB();
    //ดึง id สินค้าเเละลบสินค้าใน orders 
    $sql_get_pd_id = "select pd_id from tbl_products where category_list_name='$ctt_list_id'";
    $rs_pd_id = mysqli_query($conn, $sql_get_pd_id);
    while ($pd_id = mysqli_fetch_assoc($rs_pd_id)) {
        $sql_delete_order = "delete from tbl_orders where pd_id=" . $pd_id["pd_id"] . "";
        mysqli_query($conn, $sql_delete_order);
    }
    //ลบประเภทสินค้าย่อย
    $sql_del_ctt_list = "delete from tbl_category_ls where category_list_id='$ctt_list_id'";
    mysqli_query($conn, $sql_del_ctt_list);
    //ลบรูปสินค้าเเละไฟล์สินค้า
    get_file_ls($ctt_list_id);
    //ลบสินค้า
    $sql_del_category_list = "delete from tbl_products where category_list_name='$ctt_list_id'";
    $rs_ckk_dels = mysqli_query($conn, $sql_del_category_list);
    if ($rs_ckk_dels != true) {
        echo mysqli_error($conn);
    }
    $conn->close();
}
//ลบไฟล์สินค้า
function get_file_ls($ctt_list_id)
{
    $conn = connect_bestDB();
    $sql_select_pd_file = "select image_file1,image_file2,image_file3,image_file4,image_file5,pdf_file_name from tbl_products where category_list_name='$ctt_list_id'";
    $rs_pd_file = mysqli_query($conn, $sql_select_pd_file);
    if (mysqli_num_rows($rs_pd_file) > 0) {
        while ($pd_img_file = mysqli_fetch_assoc($rs_pd_file)) {
            unlink("C:/xampp/htdocs/bestbuy/access/uploads_pdf_file/" . $pd_img_file["pdf_file_name"]);
            for ($i = 1; $i <= 5; $i++) {
                if ($pd_img_file["image_file$i"] != null) {
                    unlink("C:/xampp/htdocs/bestbuy/access/uploads_image_file/" . $pd_img_file["image_file$i"]);
                }
            }
        }
    }
}
@$btn_del_ctt_list = $_GET["btn_del_ctt_list"];
if (isset($btn_del_ctt_list)) {
    $ctt_list_id = $_GET["ctt_list_id"];
    del_ctt_list($ctt_list_id);
}
