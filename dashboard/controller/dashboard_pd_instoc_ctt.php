<?php
include 'format.php';
//ต้นหาสินค้าตามประเภทสินค้าหลัก
function find_pd_by_category($main_category)
{
    $conn = connect_bestDB();
    $sql_select_all_pd = "select pd_id, category_name, pd_code,image_file1,image_file2,image_file3,image_file4,image_file5, pd_name, pd_model, pd_brand,pd_price,pd_quantity,pdf_file_name, pd_status from tbl_products where category_name=$main_category";
    $all_product_list = mysqli_query($conn, $sql_select_all_pd);
    $i = 0;
    if (mysqli_num_rows($all_product_list) > 0) {
        $status = '';
        while ($row = mysqli_fetch_assoc($all_product_list)) {
            $i++;
            if ($row["pd_status"] == 0) {
                $status = "<p style='color:red;'>สั่งจองล่วงหน้า</p>";
            } else if ($row["pd_status"] == 1) {
                $status = "<p style='color:green;'>มีสินค้า</p>";
            }
            echo "<tr class='ar-tr-pd-tbl'>
            <td class='td-pd-dt-no'>$i</td>
            <td class='td-pd-dt'>" . $row["pd_code"] . "</td>
            <td class='td-pd-dt-img'>
                <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' width='100px'>
            </td>
            <td class='td-pd-dt'>
                <div class='ar-pd-detail'>
                    <a class='link-preview-pd-instoc' href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "'>" . $row["pd_name"] . "</a>
                </div>
            </td>
            <td class='td-pd-dt-price'>" . formatMoney($row["pd_price"], true) . " บาท</td>
            <td class='td-pd-dt-quantity'>" . $row["pd_quantity"] . " ชิ้น</td>
            <td class='td-pd-st'>" . $status . "</td>
            <td class='td-pd-dt-btn-exe'>
                <a href='dashboard_edit_pd.php?edit_pd_id=" . $row["pd_id"] . "' class='ds-btn-his-edit-pd'>เเก้ไข</a>
                <a href='controller/add_pd.php?pd_id=" . $row["pd_id"] . "&pd_img1=" . $row["image_file1"] . "&pd_img2=" . $row["image_file2"] . "&pd_img3=" . $row["image_file3"] . "&pd_img4=" . $row["image_file4"] . "&pd_img5=" . $row["image_file5"] . "&pdf_file=" . $row["pdf_file_name"] . "' class='ds-btn-his-del-pd'>ลบ</a>
            </td>
        </tr>";
        }
    }
}
//ค้นหาสินค้าตามชื่อสินค้า
function find_pd_by_name($pd_name)
{
    $conn = connect_bestDB();
    $fmt_pd_name = mysqli_real_escape_string($conn, $pd_name);
    $sql_select_all_pd = "select pd_id, category_name, pd_code,image_file1,image_file2,image_file3,image_file4,image_file5, pd_name, pd_model, pd_brand,pd_price,pd_quantity,pdf_file_name, pd_status from tbl_products where pd_name like '%$fmt_pd_name%'";
    $all_product_list = mysqli_query($conn, $sql_select_all_pd);
    $i = 0;
    if (mysqli_num_rows($all_product_list) > 0) {
        $status = '';
        while ($row = mysqli_fetch_assoc($all_product_list)) {
            $i++;
            if ($row["pd_status"] == 0) {
                $status = "<p style='color:red;'>สั่งจองล่วงหน้า</p>";
            } else if ($row["pd_status"] == 1) {
                $status = "<p style='color:green;'>มีสินค้า</p>";
            }
            echo "<tr class='ar-tr-pd-tbl'>
            <td class='td-pd-dt-no'>$i</td>
            <td class='td-pd-dt'>" . $row["pd_code"] . "</td>
            <td class='td-pd-dt-img'>
                <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' width='100px'>
            </td>
            <td class='td-pd-dt'>
                <div class='ar-pd-detail'>
                    <a class='link-preview-pd-instoc' href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "'>" . $row["pd_name"] . "</a>
                </div>
            </td>
            <td class='td-pd-dt-price'>" . formatMoney($row["pd_price"], true) . " บาท</td>
            <td class='td-pd-dt-quantity'>" . $row["pd_quantity"] . " ชิ้น</td>
            <td class='td-pd-st'>" . $status . "</td>
            <td class='td-pd-dt-btn-exe'>
                <a href='dashboard_edit_pd.php?edit_pd_id=" . $row["pd_id"] . "' class='ds-btn-his-edit-pd'>เเก้ไข</a>
                <a href='controller/add_pd.php?pd_id=" . $row["pd_id"] . "&pd_img1=" . $row["image_file1"] . "&pd_img2=" . $row["image_file2"] . "&pd_img3=" . $row["image_file3"] . "&pd_img4=" . $row["image_file4"] . "&pd_img5=" . $row["image_file5"] . "&pdf_file=" . $row["pdf_file_name"] . "' class='ds-btn-his-del-pd'>ลบ</a>
            </td>
        </tr>";
        }
    }
}
function show_fn_category()
{
    $conn = connect_bestDB();
    $sql_get_category_list = "select category_id, category_name from tbl_category";
    $category_list = mysqli_query($conn, $sql_get_category_list);
    while ($row = mysqli_fetch_assoc($category_list)) {
        echo "<option value='" . $row["category_id"] . "'>" . $row['category_name'] . "</option>";
    }
    $conn->close();
}
//รายการสินค้าในสต๊อกสินค้า
function getAllProductInStoc()
{
    $conn = connect_bestDB();
    $sql_select_all_pd = "select pd_id, category_name, pd_code,image_file1,image_file2,image_file3,image_file4,image_file5, pd_name, pd_model, pd_brand,pd_price,pd_quantity,pdf_file_name, pd_status from tbl_products";
    $all_product_list = mysqli_query($conn, $sql_select_all_pd);
    $i = 0;
    if (mysqli_num_rows($all_product_list) > 0) {
        $status = '';
        while ($row = mysqli_fetch_assoc($all_product_list)) {
            $i++;
            if ($row["pd_status"] == 0) {
                $status = "<p style='color:red;'>สั่งจองล่วงหน้า</p>";
            } else if ($row["pd_status"] == 1) {
                $status = "<p style='color:green;'>มีสินค้า</p>";
            }
            echo "<tr class='ar-tr-pd-tbl'>
            <td class='td-pd-dt-no'>$i</td>
            <td class='td-pd-dt'>" . $row["pd_code"] . "</td>
            <td class='td-pd-dt-img'>
                <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' width='100px'>
            </td>
            <td class='td-pd-dt'>
                <div class='ar-pd-detail'>
                    <a class='link-preview-pd-instoc' href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "'>" . $row["pd_name"] . "</a>
                </div>
            </td>
            <td class='td-pd-dt-price'>" . formatMoney($row["pd_price"], true) . " บาท</td>
            <td class='td-pd-dt-quantity'>" . $row["pd_quantity"] . " ชิ้น</td>
            <td class='td-pd-st'>" . $status . "</td>
            <td class='td-pd-dt-btn-exe'>
                <a href='dashboard_edit_pd.php?edit_pd_id=" . $row["pd_id"] . "' class='ds-btn-his-edit-pd'>เเก้ไข</a>
                <a href='controller/add_pd.php?pd_id=" . $row["pd_id"] . "&pd_img1=" . $row["image_file1"] . "&pd_img2=" . $row["image_file2"] . "&pd_img3=" . $row["image_file3"] . "&pd_img4=" . $row["image_file4"] . "&pd_img5=" . $row["image_file5"] . "&pdf_file=" . $row["pdf_file_name"] . "' class='ds-btn-his-del-pd'>ลบ</a>
            </td>
        </tr>";
        }
    }
}
//ค้นหาสินค้าตามประเภทสินค้าย่อย
function find_pd_by_ctt_list($ctt_main_id)
{
    $conn = connect_bestDB();
    $es_cap = mysqli_escape_string($conn, $ctt_main_id);
    $sql_ctt_list = "select category_list_id,category_id,category_list_name from tbl_category_ls where category_id='$es_cap'";
    $rs_ctt_list = mysqli_query($conn, $sql_ctt_list);
    if (mysqli_num_rows($rs_ctt_list) > 0) {
        while ($ctt_dt = mysqli_fetch_assoc($rs_ctt_list)) {
            echo "<option value='" . $ctt_dt["category_list_id"] . "'>" . $ctt_dt['category_list_name'] . "</option>";
        }
    } else {
        echo mysqli_error($conn);
    }
}
//ดึงสินค้าตามประเภทิสนค้าย่อย
function get_pd_by_ctt_list($ctt_list_id)
{
    $conn = connect_bestDB();
    $sql_select_all_pd = "select pd_id, category_name, pd_code,image_file1,image_file2,image_file3,image_file4,image_file5, pd_name, pd_model, pd_brand,pd_price,pd_quantity,pdf_file_name, pd_status from tbl_products where category_list_name='$ctt_list_id'";
    $all_product_list = mysqli_query($conn, $sql_select_all_pd);
    $i = 0;
    if (mysqli_num_rows($all_product_list) > 0) {
        $status = '';
        while ($row = mysqli_fetch_assoc($all_product_list)) {
            $i++;
            if ($row["pd_status"] == 0) {
                $status = "<p style='color:red;'>สั่งจองล่วงหน้า</p>";
            } else if ($row["pd_status"] == 1) {
                $status = "<p style='color:green;'>มีสินค้า</p>";
            }
            echo "<tr class='ar-tr-pd-tbl'>
            <td class='td-pd-dt-no'>$i</td>
            <td class='td-pd-dt'>" . $row["pd_code"] . "</td>
            <td class='td-pd-dt-img'>
                <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' width='100px'>
            </td>
            <td class='td-pd-dt'>
                <div class='ar-pd-detail'>
                    <a class='link-preview-pd-instoc' href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "'>" . $row["pd_name"] . "</a>
                </div>
            </td>
            <td class='td-pd-dt-price'>" . formatMoney($row["pd_price"], true) . " บาท</td>
            <td class='td-pd-dt-quantity'>" . $row["pd_quantity"] . " ชิ้น</td>
            <td class='td-pd-st'>" . $status . "</td>
            <td class='td-pd-dt-btn-exe'>
                <a href='dashboard_edit_pd.php?edit_pd_id=" . $row["pd_id"] . "' class='ds-btn-his-edit-pd'>เเก้ไข</a>
                <a href='controller/add_pd.php?pd_id=" . $row["pd_id"] . "&pd_img1=" . $row["image_file1"] . "&pd_img2=" . $row["image_file2"] . "&pd_img3=" . $row["image_file3"] . "&pd_img4=" . $row["image_file4"] . "&pd_img5=" . $row["image_file5"] . "&pdf_file=" . $row["pdf_file_name"] . "' class='ds-btn-his-del-pd'>ลบ</a>
            </td>
        </tr>";
        }
    }
}
//เเสดงจำนวนสินค้าในสต๊อกสินค้า
function getProductInStoc()
{
    $conn = connect_bestDB();
    $sql_get_pd_in_stock = "select pd_id from tbl_products";
    $pd_rs = mysqli_query($conn, $sql_get_pd_in_stock);
    $pd_in_stoc = mysqli_num_rows($pd_rs);
    echo $pd_in_stoc;
    $conn->close();
}
//เเสดงจำนวนสินค้าหลัก
function get_ctt_main()
{
    $conn = connect_bestDB();
    $sql_get_pd_in_stock = "select category_id from tbl_category";
    $pd_rs = mysqli_query($conn, $sql_get_pd_in_stock);
    $pd_in_stoc = mysqli_num_rows($pd_rs);
    echo $pd_in_stoc;
    $conn->close();
}
//เเสดงจำนวนสินค้าย่อย
function get_ctt_list()
{
    $conn = connect_bestDB();
    $sql_get_pd_in_stock = "select category_list_id from tbl_category_ls";
    $pd_rs = mysqli_query($conn, $sql_get_pd_in_stock);
    $pd_in_stoc = mysqli_num_rows($pd_rs);
    echo $pd_in_stoc;
    $conn->close();
}
//เเสดงราคารวมทั้งหมด
function get_total_price()
{
    $conn = connect_bestDB();
    $sql_get_price_and_quan = "select pd_price, pd_quantity from tbl_products";
    $rs_price_quan = mysqli_query($conn, $sql_get_price_and_quan);
    $total_price = 0;
    if (mysqli_num_rows($rs_price_quan) > 0) {
        while ($pd_data = mysqli_fetch_assoc($rs_price_quan)) {
            $total_price += $pd_data["pd_price"] * $pd_data["pd_quantity"];
        }
    } else {
        echo 0;
    }
    echo formatMoney($total_price, true);
}
//response
function getAllProductInStocResponse()
{
    $conn = connect_bestDB();
    $sql_select_all_pd = "select pd_id, category_name, pd_code,image_file1,image_file2,image_file3,image_file4,image_file5, pd_name, pd_model, pd_brand,pd_price,pd_quantity,pdf_file_name, pd_status from tbl_products";
    $all_product_list = mysqli_query($conn, $sql_select_all_pd);
    if (mysqli_num_rows($all_product_list) > 0) {
        while ($row = mysqli_fetch_assoc($all_product_list)) {
           
            echo "
                <div class='ar-pd-ins-bx'>
                    <div class='pd-ins-img-res'>
                        <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' class='pd-img-res'>
                    </div>
                    <div class='pd-ins-txt-res'>
                        <div class='pd-name'>
                            <p>" . $row["pd_name"] . "</p>
                        </div>
                        <p>" . formatMoney($row["pd_price"], true) . " บาท</p>
                        <p>" . $row["pd_quantity"] . " ชิ้น</p>
                        <div class='btn-del-and-upd'>
                            <a href='controller/add_pd.php?pd_id=" . $row["pd_id"] . "&pd_img1=" . $row["image_file1"] . "&pd_img2=" . $row["image_file2"] . "&pd_img3=" . $row["image_file3"] . "&pd_img4=" . $row["image_file4"] . "&pd_img5=" . $row["image_file5"] . "&pdf_file=" . $row["pdf_file_name"] . "' class='ds-btn-his-del-pd'>ลบ</a>
                            <a href='dashboard_edit_pd.php?edit_pd_id=" . $row["pd_id"] . "' class='ds-btn-his-edit-pd'>เเก้ไข</a>
                        </div>
                    </div>
                </div>
            ";
        }
    }
}

function getAllProductInStocResponseCttMain($ctt_main)
{
    $conn = connect_bestDB();
    $sql_select_all_pd = "select pd_id, category_name, pd_code,image_file1,image_file2,image_file3,image_file4,image_file5, pd_name, pd_model, pd_brand,pd_price,pd_quantity,pdf_file_name, pd_status from tbl_products where category_name='$ctt_main'";
    $all_product_list = mysqli_query($conn, $sql_select_all_pd);
    if (mysqli_num_rows($all_product_list) > 0) {
        while ($row = mysqli_fetch_assoc($all_product_list)) {
           
            echo "
                <div class='ar-pd-ins-bx'>
                    <div class='pd-ins-img-res'>
                        <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' class='pd-img-res'>
                    </div>
                    <div class='pd-ins-txt-res'>
                        <div class='pd-name'>
                            <p>" . $row["pd_name"] . "</p>
                        </div>
                        <p>" . formatMoney($row["pd_price"], true) . " บาท</p>
                        <p>" . $row["pd_quantity"] . " ชิ้น</p>
                        <div class='btn-del-and-upd'>
                            <a href='controller/add_pd.php?pd_id=" . $row["pd_id"] . "&pd_img1=" . $row["image_file1"] . "&pd_img2=" . $row["image_file2"] . "&pd_img3=" . $row["image_file3"] . "&pd_img4=" . $row["image_file4"] . "&pd_img5=" . $row["image_file5"] . "&pdf_file=" . $row["pdf_file_name"] . "' class='ds-btn-his-del-pd'>ลบ</a>
                            <a href='dashboard_edit_pd.php?edit_pd_id=" . $row["pd_id"] . "' class='ds-btn-his-edit-pd'>เเก้ไข</a>
                        </div>
                    </div>
                </div>
            ";
        }
    }
}
function getAllProductInStocResponseCttList($ctt_list)
{
    $conn = connect_bestDB();
    $sql_select_all_pd = "select pd_id, category_name, pd_code,image_file1,image_file2,image_file3,image_file4,image_file5, pd_name, pd_model, pd_brand,pd_price,pd_quantity,pdf_file_name, pd_status from tbl_products where category_list_name='$ctt_list'";
    $all_product_list = mysqli_query($conn, $sql_select_all_pd);
    if (mysqli_num_rows($all_product_list) > 0) {
        while ($row = mysqli_fetch_assoc($all_product_list)) {
           
            echo "
                <div class='ar-pd-ins-bx'>
                    <div class='pd-ins-img-res'>
                        <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='' class='pd-img-res'>
                    </div>
                    <div class='pd-ins-txt-res'>
                        <div class='pd-name'>
                            <p>" . $row["pd_name"] . "</p>
                        </div>
                        <p>" . formatMoney($row["pd_price"], true) . " บาท</p>
                        <p>" . $row["pd_quantity"] . " ชิ้น</p>
                        <div class='btn-del-and-upd'>
                            <a href='controller/add_pd.php?pd_id=" . $row["pd_id"] . "&pd_img1=" . $row["image_file1"] . "&pd_img2=" . $row["image_file2"] . "&pd_img3=" . $row["image_file3"] . "&pd_img4=" . $row["image_file4"] . "&pd_img5=" . $row["image_file5"] . "&pdf_file=" . $row["pdf_file_name"] . "' class='ds-btn-his-del-pd'>ลบ</a>
                            <a href='dashboard_edit_pd.php?edit_pd_id=" . $row["pd_id"] . "' class='ds-btn-his-edit-pd'>เเก้ไข</a>
                        </div>
                    </div>
                </div>
            ";
        }
    }
}