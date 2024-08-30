<?php
include '../dashboard/controller/connect.php';

//เมนูด้านข้าง หน้าเเสดงสินค้าตามประเภทสินค้า
function get_main_category()
{
    $conn = connect_bestDB();
    $sql_get_main_category = "select category_id, category_name from tbl_category";
    $rs_navleft = mysqli_query($conn, $sql_get_main_category);
    if (mysqli_num_rows($rs_navleft) > 0) {
        while ($ctt_data = mysqli_fetch_assoc($rs_navleft)) {
            echo "
                <div class='ar-ind2-navleft-ctn'>
                    <a href='./show_pd_category.php?category_id=" . $ctt_data["category_id"] . "&category_list=" . $ctt_data["category_name"] . "' class='ind2-nav-left-link'>" . $ctt_data["category_name"] . "</a>
                </div>
            ";
        }
    }
    $conn->close();
}
//เเสดงลิงค์ประเภทสินค้าย่อย
function get_ctt_list($category_id)
{
    $conn = connect_bestDB();
    $sql_get_ctt_list = "select category_id, category_list_name, category_list_id from tbl_category_ls where category_id=" . $category_id . "";
    $rs_ctt_list = mysqli_query($conn, $sql_get_ctt_list);
    if (mysqli_num_rows($rs_ctt_list) > 0) {
        while ($ctt_list = mysqli_fetch_assoc($rs_ctt_list)) {
            echo "
                <div class='ar-ind2-navleft-ctn'>
                    <i class='fa-solid fa-arrow-right'></i><a href='./show_pd_category.php?category_id=" . $ctt_list["category_id"] . "&category_list=" . $ctt_list["category_list_name"] . "&category_list_id=" . $ctt_list["category_list_id"] . "' class='ind2-nav-left-link'>" . $ctt_list["category_list_name"] . "</a>
                </div>
            ";
        }
    } else {
        echo mysqli_error($conn);
    }
    $conn->close();
}
function get_ctt_list2()
{
    $conn = connect_bestDB();
    $sql_get_ctt_list = "select category_id, category_list_name, category_list_id from tbl_category_ls";
    $rs_ctt_list = mysqli_query($conn, $sql_get_ctt_list);
    if (mysqli_num_rows($rs_ctt_list) > 0) {
        while ($ctt_list = mysqli_fetch_assoc($rs_ctt_list)) {
            echo "
                <div class='ar-ind2-navleft-ctn'>
                    <i class='fa-solid fa-arrow-right'></i><a href='./show_pd_category.php?category_id=" . $ctt_list["category_id"] . "&category_list=" . $ctt_list["category_list_name"] . "&category_list_id=" . $ctt_list["category_list_id"] . "' class='ind2-nav-left-link'>" . $ctt_list["category_list_name"] . "</a>
                </div>
            ";
        }
    } else {
        echo mysqli_error($conn);
    }
    $conn->close();
}
//เเสดงสินค้าที่ค้นหา
function get_pd_buy_ctt_main($category_id)
{
    $conn = connect_bestDB();
    $sql_select_pd = "select pd_id, pd_price,discount, category_name,pd_name,pd_quantity, image_file1 from tbl_products where category_name=$category_id";
    $result = mysqli_query($conn, $sql_select_pd);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='ind2-pd-bx-img-detail'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $pd_price = '';
            if ($row["discount"] == 0) {
                $pd_price = $row["pd_price"];
            } else {
                $pd_price = pd_discount($row["discount"], $row["pd_price"]);
            }
            echo "
            <div class='ind2-pd-img-pddt'>
                <a href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "' class='ind2-pd-link'>
                    <div class='ind2-ar-pd-img'>
                        <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='" . $row["image_file1"] . "' class='ind-set-pd-img'>
                    </div>
                    <div class='ind2-ar-pd-dt'>
                        <div class='ind2-pd-desc'>
                            <p class='ind2-pd-desc-txt'>
                                " . $row["pd_name"] . "
                            </p>
                        </div>
                        <div class='ind2-pd-price'>
                            <p><span class='pd_dis'>" . formatMoney($row["pd_price"], true) . " บาท</span></p>
                            <p class='nrm-pd-price'>" . formatMoney($pd_price, true) . " บาท</p>
                        </div>
                        <div class='ind2-pd-quantity'>
                            <p>จำนวนสินค้า " . $row["pd_quantity"] . " เครื่อง</p>
                        </div>
                    </div>
                </a>
            </div>";
        }
        echo "</div>";
    }
    $conn->close();
}
//เเสดงสินค้าที่ค้นหาเเบบเรียงลำดับ
function get_pd_buy_ctt_main2($category_id, $keyword2)
{
    $conn = connect_bestDB();
    $sql_select_pd = "";
    if (isset($keyword2)) {
        $sql_select_pd = "select pd_id, discount, pd_price, category_name,pd_name,pd_quantity, image_file1 from tbl_products where category_name=$category_id order by for_order_price $keyword2";
    } else {
        $sql_select_pd = "select pd_id, discount, pd_price, category_name,pd_name,pd_quantity, image_file1 from tbl_products where category_name=$category_id";
    }
    $result = mysqli_query($conn, $sql_select_pd);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='ind2-pd-bx-img-detail'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $pd_price = '';
            if ($row["discount"] == 0) {
                $pd_price = $row["pd_price"];
            } else {
                $pd_price = pd_discount($row["discount"], $row["pd_price"]);
            }
            echo "
            <div class='ind2-pd-img-pddt'>
                <a href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "' class='ind2-pd-link'>
                    <div class='ind2-ar-pd-img'>
                        <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='" . $row["image_file1"] . "' class='ind-set-pd-img'>
                    </div>
                    <div class='ind2-ar-pd-dt'>
                        <div class='ind2-pd-desc'>
                            <p class='ind2-pd-desc-txt'>
                                " . $row["pd_name"] . "
                            </p>
                        </div>
                        <div class='ind2-pd-price'>
                            <p><span class='pd_dis'>" . formatMoney($row["pd_price"], true) . " บาท</span></p>
                            <p class='nrm-pd-price'>" . formatMoney($pd_price, true) . " บาท</p>
                        </div>
                        <div class='ind2-pd-quantity'>
                            <p>จำนวนสินค้า " . $row["pd_quantity"] . " เครื่อง</p>
                        </div>
                    </div>
                </a>
            </div>";
        }
        echo "</div>";
    }
    $conn->close();
}
//เเสดงสินค้าตามประเภทสินค้าย่อย
function get_pd_by_ctt_list($category_list_id, $keyword)
{
    $conn = connect_bestDB();
    $sql_select_pd = "";
    if (isset($keyword)) {
        $sql_select_pd = "select pd_id, discount, pd_price, category_name,pd_name,pd_quantity, image_file1 from tbl_products where category_list_name=$category_list_id order by for_order_price $keyword";
    } else {
        $sql_select_pd = "select pd_id, discount, pd_price, category_name,pd_name,pd_quantity, image_file1 from tbl_products where category_list_name=$category_list_id";
    }
    $result = mysqli_query($conn, $sql_select_pd);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='ind2-pd-bx-img-detail'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $pd_price = '';
            if ($row["discount"] == 0) {
                $pd_price = $row["pd_price"];
            } else {
                $pd_price = pd_discount($row["discount"], $row["pd_price"]);
            }
            echo "
            <div class='ind2-pd-img-pddt'>
                <a href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "' class='ind2-pd-link'>
                    <div class='ind2-ar-pd-img'>
                        <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='" . $row["image_file1"] . "' class='ind-set-pd-img'>
                    </div>
                    <div class='ind2-ar-pd-dt'>
                        <div class='ind2-pd-desc'>
                            <p class='ind2-pd-desc-txt'>
                                " . $row["pd_name"] . "
                            </p>
                        </div>
                        <div class='ind2-pd-price'>
                            <p><span class='pd_dis'>" . formatMoney($row["pd_price"], true) . "</span></p>
                            <p class='nrm-pd-price'>" . formatMoney($pd_price, true) . " บาท</p>
                        </div>
                        <div class='ind2-pd-quantity'>
                            <p>จำนวนสินค้า " . $row["pd_quantity"] . "ชิ้น</p>
                        </div>
                    </div>
                </a>
            </div>";
        }
        echo "</div>";
    } else {
        echo "";
    }
    $conn->close();
}
//ค้นหาสินค้าตามเเบรนด์สินค้า
function find_pd_widht_brand()
{
    $conn = connect_bestDB();
    @$pd_brand = mysqli_escape_string($conn, $_GET["brand_name"]);
    $sql_select_pd = "select pd_id, pd_price,discount, category_name,pd_name,pd_quantity, image_file1 from tbl_products where pd_brand like '%$pd_brand%'";
    $result = mysqli_query($conn, $sql_select_pd);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='ind2-pd-bx-img-detail'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $pd_price = '';
            if ($row["discount"] == 0) {
                $pd_price = $row["pd_price"];
            } else {
                $pd_price = pd_discount($row["discount"], $row["pd_price"]);
            }
            echo "
                <div class='ind2-pd-img-pddt'>
                    <a href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "' class='ind2-pd-link'>
                        <div class='ind2-ar-pd-img'>
                            <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='" . $row["image_file1"] . "' class='ind-set-pd-img'>
                        </div>
                        <div class='ind2-ar-pd-dt'>
                            <div class='ind2-pd-desc'>
                                <p class='ind2-pd-desc-txt'>
                                    " . $row["pd_name"] . "
                                </p>
                            </div>
                            <div class='ind2-pd-price'>
                                <p><span class='pd_dis'>" . formatMoney($row["pd_price"], true) . " บาท</span></p>
                                <p class='nrm-pd-price'>" . formatMoney($pd_price, true) . " บาท</p>
                            </div>
                            <div class='ind2-pd-quantity'>
                                <p>จำนวนสินค้า " . $row["pd_quantity"] . " เครื่อง</p>
                            </div>
                        </div>
                    </a>
                </div>";
        }
        echo "</div>";
    }
    $conn->close();
}
function find_pd_widht_brand_order($keyword)
{
    $conn = connect_bestDB();
    @$pd_brand = mysqli_escape_string($conn, $_GET["brand_name"]);
    $sql_select_pd = "select pd_id, pd_price,discount, category_name,pd_name,pd_quantity, image_file1 from tbl_products where pd_brand like '%$pd_brand%' order by for_order_price $keyword";
    $result = mysqli_query($conn, $sql_select_pd);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='ind2-pd-bx-img-detail'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $pd_price = '';
            if ($row["discount"] == 0) {
                $pd_price = $row["pd_price"];
            } else {
                $pd_price = pd_discount($row["discount"], $row["pd_price"]);
            }
            echo "
                                <div class='ind2-pd-img-pddt'>
                                    <a href='../shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "' class='ind2-pd-link'>
                                        <div class='ind2-ar-pd-img'>
                                            <img src='../access/uploads_image_file/" . $row["image_file1"] . "' alt='" . $row["image_file1"] . "' class='ind-set-pd-img'>
                                        </div>
                                        <div class='ind2-ar-pd-dt'>
                                            <div class='ind2-pd-desc'>
                                                <p class='ind2-pd-desc-txt'>
                                                    " . $row["pd_name"] . "
                                                </p>
                                            </div>
                                            <div class='ind2-pd-price'>
                                                <p><span class='pd_dis'>" . formatMoney($row["pd_price"], true) . " บาท</span></p>
                                                <p class='nrm-pd-price'>" . formatMoney($pd_price, true) . " บาท</p>
                                            </div>
                                            <div class='ind2-pd-quantity'>
                                                <p>จำนวนสินค้า " . $row["pd_quantity"] . " เครื่อง</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>";
        }
        echo "</div>";
    }
    $conn->close();
}