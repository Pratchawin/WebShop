<?php
//เเสดงชื่อหมวดหมู่สินค้าย่อยในหน้า index
function indShowNavLeftAndGetCategoryList($category_id)
{
    $conn = connect_bestDB();
    $sql_select_nav_left = "select category_name from tbl_category where category_id=$category_id";
    $nav_left_title_rs = mysqli_query($conn, $sql_select_nav_left);
    $nav_left_title = mysqli_fetch_row($nav_left_title_rs);
    if ($nav_left_title == null) {
        echo "";
    } else {
        echo "<div class='ar-ind2-navleft-title'>
        <p>" . $nav_left_title[0] . "</p>
    </div>";
    }
    /* $category_id=$nav_left_title[0]; */
    $sql_get_category = "select category_id, category_list_id, category_list_name from tbl_category_ls  where category_id=$category_id";
    $result = mysqli_query($conn, $sql_get_category);
    @$category_title = $nav_left_title[0];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo  "
            <div class='ar-ind2-navleft-ctn'>
                <i class='fa-solid fa-arrow-right'></i>
                <a href='shop/show_pd_category.php?category_id=" . $row["category_id"] . "&category_list_id=" . $row["category_list_id"] . "&category_title=$category_title&category_list=" . $row["category_list_name"] . "' class='ind2-nav-left-link'>"
                . $row["category_list_name"] . "
                 </a>
            </div>";
        }
    } else {
        echo "";
    }
}
//เเสดงสินค้าตามเเบรนด์
function findProductBrand()
{
    $conn = connect_bestDB();
    $sql_find_brand = "select brand_id, brand_name from tbl_pd_brand";
    $rs_brand = mysqli_query($conn, $sql_find_brand);
    //ดึงสินค้าที่เเบรนด์เหมือนกัน
    //$sql_find_pd_width_brand="select from tbl_products where pd_brand=''";
    if (mysqli_num_rows($rs_brand) > 0) {
        while ($row = mysqli_fetch_assoc($rs_brand)) {
            echo "
                <div class='ar-ind2-navleft-ctn'>
                    <i class='fa-solid fa-star star-color'></i><a href='shop/show_pd_brand.php?brand_name=" . $row["brand_name"] . "' class='ind2-nav-left-link'>" . $row["brand_name"] . "</a>
                </div>
            ";
        }
    } else {
        echo "";
    }
}
//เเสดงจำนวนสินค้าทั้งหมด
function get_num_of_pd()
{
    $conn = connect_bestDB();
    $sql_get_pd = "select pd_id from tbl_products";
    $rs_num_of_pd = mysqli_query($conn, $sql_get_pd);
    $pd_total = mysqli_num_rows($rs_num_of_pd);
    $conn->close();
    return $pd_total;
}
//เเสดงจำนวนผู้เข้าชมเว็บไซต์
function get_user_visit()
{
    $conn = connect_bestDB();
    $sess_id = session_id();
    $ckk_visit = "select ip_visit from counter where ip_visit='$sess_id'";
    $ckk_rs = mysqli_query($conn, $ckk_visit);
    if (!mysqli_num_rows($ckk_rs) > 0) {
        echo "new user";
        $sql_ins_new_user = "insert into counter(ip_visit, visit) values('$sess_id','1')";
        mysqli_query($conn, $sql_ins_new_user);
        $conn->close();
    }
    $sql_get_user_visit = "select id_visit from counter";
    $rs_user = mysqli_query($conn, $sql_get_user_visit);
    $n_visit = mysqli_num_rows($rs_user);
    $conn->close();
    return $n_visit;
}
function formatMoney($number, $fractional = false)
{
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

function pd_discount($discount, $pd_price)
{
    $pd_discount = ($pd_price * $discount) / 100;
    $pd_price = $pd_price - $pd_discount;
    return $pd_price;
}
