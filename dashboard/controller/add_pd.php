<?php
$main_cate;
$main_cate_status = '';
//เพิ่มประเภทสินค้าหลัก
function Add_pd_category()
{
    include 'connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $main_cate = $_POST["main_category"];
        $test = utf8_decode($main_cate);
        $check_len = strlen($test);
        if ($check_len > 250 || $check_len == null) {
            return "<p style='color:red'>ข้อความไม่ควรยาวเกิน 250 ตัวอักษร เเละไม่ว่างเปล่า</p>";
        } else {
            $conn = connect_bestDB();
            $sql_insert_category_ind = "insert into tbl_category(category_name) values('$main_cate')";
            $result = mysqli_query($conn, $sql_insert_category_ind);
            if ($result == true) {
                $conn->close();
                return  "<p style='color:green'>เพิ่มประเภทสินค้าเรียบร้อย</p>";
            } else {
                echo mysqli_error($conn);
                $conn->close();
                return  "<p style='color:red'>ไม่สามารถเพิ่มประเภทสินค้าได้</p>";
            }
        }
    } else {
        echo "HTTP is not valid";
    }
}

if (isset($_POST["main_category_submit"])) {
    $main_cate_status = Add_pd_category();
    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_add_pd.php'>";
}
//เพิ่มเเบรนด์สินค้า
function add_pd_brand($brand_name){
    $conn=connect_bestDB();
    $es_brand_name=mysqli_escape_string($conn, $brand_name);
    $sql_add_prand="insert into tbl_pd_brand(brand_name) values('$es_brand_name')";
    $ckk_rs=mysqli_query($conn, $sql_add_prand);
    if($ckk_rs!=true){
        echo mysqli_error($conn);
    }
    $conn->close();
}
//ดึงยี่ห้อสินค้า
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
//ดึงประเภทสินค้าหลัก
$test = '';
function getCategory()
{
    $conn = connect_bestDB();
    $sql_get_category_list = "select category_id, category_name from tbl_category";
    $category_list = mysqli_query($conn, $sql_get_category_list);
    while ($row = mysqli_fetch_assoc($category_list)) {
        echo "<option value='" . $row["category_id"] . "'>" . $row['category_name'] . "</option>";
    }
    $conn->close();
}

//ดึงประเภทสินค้าย่อย
function getCategoryList()
{
    $conn = connect_bestDB();
    $sql_select_category_list = "select category_list_id, category_list_name from tbl_category_ls";
    $category_list = mysqli_query($conn, $sql_select_category_list);
    if (mysqli_num_rows($category_list) > 0) {
        while ($row = mysqli_fetch_assoc($category_list)) {
            echo "<option value='" . $row["category_list_id"] . "'>" . $row["category_list_name"] . "</option>";
        }
    }
    $conn->close();
}
//เพิ่มประเภทสินค้าย่อย
function addProductList()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'connect.php';
        $select_category_id = $_POST["select_category_id"];
        $pd_name_list = $_POST["product_list_name"];
        $conn = connect_bestDB();
        $sql_insert_pd_name_list = "insert into tbl_category_ls(category_id,category_list_name) values('$select_category_id','$pd_name_list')";
        mysqli_query($conn, $sql_insert_pd_name_list);
        $conn->close();
        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_add_pd.php'>";
    } else {
        echo "HTTP is not valid";
    }
}
if (isset($_POST["btn_add_product_list"])) {
    addProductList();
}

//file upload
function UploadImageFile($file_name, $file_tmp)
{
    $target_dir = "../../access/uploads_image_file/";
    $target_file = $target_dir . $file_name;
    move_uploaded_file($file_tmp, $target_file);
}
function UploadPDFFile($file_name, $file_tmp)
{
    $target_dir = "../../access/uploads_image_file/";
    $target_file = $target_dir . $file_name;
    move_uploaded_file($file_tmp, $target_file);
}
//add product
function addProduct()
{
    include 'connect.php';
    $conn = connect_bestDB();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        @$category_name = mysqli_escape_string($conn,$_POST["find_main_ctt"]);
        @$category_list_name = $_POST["category_list_name"];
        @$pd_name = mysqli_escape_string($conn,$_POST["pd_name"]);
        @$pd_code = mysqli_escape_string($conn,$_POST["pd_code"]);
        @$pd_model = mysqli_escape_string($conn,$_POST["pd_model"]);
        @$pd_brand = mysqli_escape_string($conn, $_POST["pd_brand"]);
        @$pd_detail = mysqli_escape_string($conn,$_POST["pd_detail"]);
        @$pd_more_dt_th = mysqli_escape_string($conn,$_POST["pd_more_dt_th"]);
        @$pd_more_dt_eng = mysqli_escape_string($conn,$_POST["pd_more_dt_eng"]);
        @$shipment_expenses = mysqli_escape_string($conn,$_POST["shipment_expenses"]);
        @$pd_status = mysqli_escape_string($conn,$_POST["sel_pd_status"]);
        @$pd_quantity = mysqli_escape_string($conn,$_POST["pd_quantity"]);
        @$pd_price = mysqli_escape_string($conn,$_POST["pd_price"]);
        @$discount = mysqli_escape_string($conn,$_POST["discount"]);
        @$pd_insurance = mysqli_escape_string($conn,$_POST["pd_insurance"]);
        //pd prop
        @$pd_prop1=$_POST["pd_prop1"];
        @$pd_prop2=$_POST["pd_prop2"];
        @$pd_prop3=$_POST["pd_prop3"];
        @$pd_prop4=$_POST["pd_prop4"];
        @$pd_prop5=$_POST["pd_prop5"];
        //file upload
        @$pdf_file = $_FILES["pdf_file"]["name"];
        @$pdf_file_tmp = $_FILES["pdf_file"]["tmp_name"];

        @$image_file_1 = $_FILES["pd_img_1"]["name"];
        @$image_file_tmp1 = $_FILES["pd_img_1"]["tmp_name"];

        @$image_file_2 = $_FILES["pd_img_2"]["name"];
        @$image_file_tmp2 = $_FILES["pd_img_2"]["tmp_name"];

        @$image_file_3 = $_FILES["pd_img_3"]["name"];
        @$image_file_tmp3 = $_FILES["pd_img_3"]["tmp_name"];

        @$image_file_4 = $_FILES["pd_img_4"]["name"];
        @$image_file_tmp4 = $_FILES["pd_img_4"]["tmp_name"];

        @$image_file_5 = $_FILES["pd_img_5"]["name"];
        @$image_file_tmp5 = $_FILES["pd_img_5"]["tmp_name"];

        if (!$pdf_file == null) {
            @$pdf_file_name = date("dmy") . time() . $pdf_file;
        }
        if (!$image_file_1 == null) {
            $file_name1 = date("dmy") . time() . $image_file_1;
        }
        if (!$image_file_2 == null) {
            $file_name2 = date("dmy") . time() . $image_file_2;
        }

        if (!$image_file_3 == null) {
            $file_name3 = date("dmy") . time() . $image_file_3;
        }

        if (!$image_file_4 == null) {
            $file_name4 = date("dmy") . time() . $image_file_4;
        }
        if (!$image_file_5 == null) {
            $file_name5 = date("dmy") . time() . $image_file_5;
        }
        if ($discount == "") {
            $discount = 0;
        }
        $for_order_price='';
        if($discount==null || $discount==0){
            $for_order_price=$pd_price;
        }else{
            $for_order_price = ($pd_price - $discount);
        }
        @$sql_create_pd = "insert into tbl_products(category_name, category_list_name, pd_name, pd_code, pd_model, pd_brand, pd_detail, pd_price, pd_quantity, pd_status, pd_more_dt_th, pd_more_dt_eng, shipment_expenses, image_file1,image_file2,image_file3,image_file4,image_file5,pdf_file_name,discount,pd_insurance,for_order_price,pd_slc1,pd_slc2,pd_slc3,pd_slc4,pd_slc5) values('$category_name', '$category_list_name', '$pd_name', '$pd_code', '$pd_model', '$pd_brand', '$pd_detail', $pd_price, $pd_quantity, '$pd_status', '$pd_more_dt_th', '$pd_more_dt_eng', $shipment_expenses,'$file_name1','$file_name2','$file_name3','$file_name4','$file_name5','$pdf_file_name','$discount','$pd_insurance','$for_order_price','$pd_prop1','$pd_prop2','$pd_prop3','$pd_prop4','$pd_prop5')";
        mysqli_query($conn, $sql_create_pd);
        @UploadImageFile($file_name1, $image_file_tmp1);
        @UploadImageFile($file_name2, $image_file_tmp2);
        @UploadImageFile($file_name3, $image_file_tmp3);
        @UploadImageFile($file_name4, $image_file_tmp4);
        @UploadImageFile($file_name5, $image_file_tmp5);
        @UploadPDFFile($pdf_file_name, $pdf_file_tmp);
        $conn->close();
        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_add_pd.php'>";
    }
}

if (isset($_POST["addProducts"])) {
    addProduct();
}

//delete product
function delProduct($pd_id, $img_file, $pdf_file)
{
    include 'connect.php';
    $conn = connect_bestDB();
    $sql_del_pd = "delete from tbl_products where pd_id=$pd_id";
    mysqli_query($conn, $sql_del_pd);
    @unlink("../access/uploads_pdf_file/" . $pdf_file);
    for ($i = 0; $i < count($img_file); $i++) {
        @unlink("../access/uploads_image_file/" . $img_file[$i]);
    }
    $sql_del_order = "delete from tbl_orders where pd_id=$pd_id";
    mysqli_query($conn, $sql_del_order);
    $conn->close();
    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_pd_instoc.php'>";
}
if (isset($_GET["pd_id"])) {
    @$pd_id = $_GET["pd_id"];
    @$image_file = array($_GET["pd_img1"], $_GET["pd_img2"], $_GET["pd_img3"], $_GET["pd_img4"], $_GET["pd_img5"]);
    @$pdf_file = $_GET["pdf_file"];
    delProduct($pd_id, $image_file, $pdf_file);
}
