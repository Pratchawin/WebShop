<?php
include '../dashboard/controller/connect.php';
include '../dashboard/controller/format.php';
//เเสดงรายละเอีดยสินค้าทั้งหมด
function getNavLeftCategoryList($prw_category_id_naf_left)
{
    $conn = connect_bestDB();
    $sql_get_category_list_name = "select category_list_id, category_id, category_list_name from tbl_category_ls where category_id=$prw_category_id_naf_left";
    $category_list_result = mysqli_query($conn, $sql_get_category_list_name);
    echo    "<div class='ar-ind2-navleft-title1'>
                <p>ประเภทสินค้าย่อย</p>
            </div>";
    if (mysqli_num_rows($category_list_result) > 0) {
        while ($category_list = mysqli_fetch_assoc($category_list_result)) {
            echo    "<div class='ar-ind2-navleft-ctn'>
                <i class='fa-solid fa-arrow-right'></i><a href='../shop/show_pd_category.php?category_id=" . $category_list["category_id"] . "&category_list_id=" . $category_list["category_list_id"] . "&category_list=" . $category_list["category_list_name"] . "' class='ind2-nav-left-link'>" . $category_list["category_list_name"] . "</a>
            </div>";
        }
    }
    $conn->close();
}
//เเสดงข้อมูลสินค้า
function showProductPreview($pd_id)
{
    $conn = connect_bestDB();
    $sql_get_product_detail = "select pd_id, discount,category_name, pd_name, pd_code, pd_brand, pd_model, pdf_file_name, pd_detail, pd_price, pd_quantity, pd_status,pd_insurance, pd_slc1,pd_slc2,pd_slc3,pd_slc4,pd_slc5 from tbl_products where pd_id=" . $pd_id . "";
    $result = mysqli_query($conn, $sql_get_product_detail);
    $ckk_pd_quantity = '';
    if (mysqli_num_rows($result) > 0) {
        $pd_status = '';
        $color = '';
        $id = '';
        $row = mysqli_fetch_assoc($result);
        $discount = $row["discount"];
        $pd_price_fmt = $row["pd_price"];
        if ($row["pd_status"] == 0) {
            $pd_status = "<span style='color:red;'>สั่งจองล่วงหน้า</span>";
        } else {
            $pd_status = "<span style='color:green;'>มีสินค้า</span>";
        }
        if ($row["pd_quantity"] == 0) {
            $ckk_pd_quantity = "สินค้าหมด";
            $pd_status = "-";
            $id = '0';
            $color = 'red';
        } else {
            $ckk_pd_quantity = $row["pd_quantity"] . " ชิ้น";
            $color = 'black';
        }
        $pd_insurance = '';
        if ($row["pd_insurance"] == "") {
            $pd_insurance = "-";
        } else {
            $pd_insurance = $row["pd_insurance"];
        }
        $option1 = "";
        $option2 = "";
        $option3 = "";
        $option4 = "";
        $option5 = "";
        if ($row["pd_slc1"] == "") {
            $option1 = "";
        } else {
            $option1 = "<option value='" . $row["pd_slc1"] . "'>" . $row["pd_slc1"] . "</option>";
        }
        if ($row["pd_slc2"] == "") {
            $option2 = "";
        } else {
            $option2 = "<option value='" . $row["pd_slc2"] . "'>" . $row["pd_slc2"] . "</option>";
        }
        if ($row["pd_slc3"] == "") {
            $option3 = "";
        } else {
            $option3 = "<option value='" . $row["pd_slc3"] . "'>" . $row["pd_slc3"] . "</option>";
        }
        if ($row["pd_slc4"] == "") {
            $option4 = "";
        } else {
            $option4 = "<option value='" . $row["pd_slc4"] . "'>" . $row["pd_slc4"] . "</option>";
        }
        if ($row["pd_slc5"] == "") {
            $option5 = "";
        } else {
            $option5 = "<option value='" . $row["pd_slc5"] . "'>" . $row["pd_slc5"] . "</option>";
        }
        echo "
                <div class='pdrw-sh-pdname'>
                    <p class='txt-set-pd-name'><b>" . $row["pd_name"] . "</b></p>
                </div>
                <div class='pdrw-sh-pdcode'>
                    <p><b>รหัส: </b><span>" . $row["pd_code"] . "</span></p>
                </div>
                <div class='pdrw-sh-pdbrand'>
                    <p><b>ยี่ห้อ: </b><span>" . $row["pd_brand"] . "</span></p>
                </div>
                <div class='pdrw-sh-pdls'>
                    <p><b>รุ่น: </b><span>" . $row["pd_model"] . "</span></p>
                </div>
                <div class='pdrw-sh-pdf-file'>
                    <p><b>ไฟล์เอกสาร: </b><a href='../access/uploads_pdf_file/" . $row["pdf_file_name"] . "' download>" . $row["pdf_file_name"] . "</a></p>
                </div>
                <div class='pdrw-sh-pddesc'>
                    <p><b>รายละเอียด: </b></p>
                    <div class='ar-pd-detait-ls'>
                        <p>" . $row["pd_detail"] . "</p>
                    </div>
                </div>
                <div class='pdrw-sh-pd-price'>
                    <p><b>ราคาสินค้า: </b><span class='pd-pv-price'>" . formatMoney(pd_discount($discount, $pd_price_fmt), true) . " </span>บาท</p>
                </div>
                <div class='pdrw-sh-pd-price'>
                    <p><b>ประกันสินค้า: </b><span>" . $pd_insurance . " </span></p>
                </div>
                <div class='pdrw-sh-pd-price'>
                    <p><b>สถานะสินค้า: </b>" . $pd_status . "</p>
                </div>
                <div class='pdrw-sh-pd-price'>
                    <label><b>ลักษณะสินค้า: </b></label>
                    <select id='scl_pd_prop' name='scl_pd_prop' class='scl-pd-prop' onchange='select_pd_prop()'>
                        <option value='null'>เลือกลักษณะสินค้า</option>
                        $option1
                        $option2
                        $option3
                        $option4
                        $option5
                    </select>
                </div>
                <div class='pdrw-sh-pd-quantity'>
                    <p><b>จำนวนสินค้า: </b><span style='color:$color;' id='$id'>" . $ckk_pd_quantity . "</span></p>
                </div>
            ";
    }
    $conn->close();
}
//เเสดงรูปภาพสินค้า
function showProductImage($pd_id)
{
    $conn = connect_bestDB();
    $sql_get_product_detail = "select image_file1, image_file2, image_file3,image_file4,image_file5 from tbl_products where pd_id=" . $pd_id . "";
    $result = mysqli_query($conn, $sql_get_product_detail);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_row($result);
        echo "
            <div class='pd-img-ind'>
                <div class='ar-set-pdrw-img-padding'>
                    <img id='main_preview' onclick='previewImage(0)' src='../access/uploads_image_file/" . $row[0] . "' alt='' class='pdrw-img-ind'>
                </div>
            </div>
            <div class='pd-img-ls'>
                <div class='bx-pd-img-ls'>
                    <div class='ar-set-pdrw-img-ls-padding'>
                        <img id='preview_image1' onclick='previewImage(1);'  src='../access/uploads_image_file/" . $row[1] . "' alt='' class='pdrw-img-ind'>
                    </div>
                </div>
                <div class='bx-pd-img-ls'>
                    <div class='ar-set-pdrw-img-ls-padding'>
                        <img id='preview_image2' onclick='previewImage(2);'  src='../access/uploads_image_file/" . $row[2] . "' alt='' class='pdrw-img-ind'>
                    </div>
                </div>
                <div class='bx-pd-img-ls'>
                    <div class='ar-set-pdrw-img-ls-padding'>
                        <img id='preview_image3' onclick='previewImage(3);'  src='../access/uploads_image_file/" . $row[3] . "' alt='' class='pdrw-img-ind'>
                    </div>
                </div>
                <div class='bx-pd-img-ls'>
                    <div class='ar-set-pdrw-img-ls-padding'>
                        <img id='preview_image4' onclick='previewImage(4);'  src='../access/uploads_image_file/" . $row[4] . "' alt='' class='pdrw-img-ind'>
                    </div>
                </div>
            </div>
            <div class='ar-btn-share'>
                <div id='fb-root'></div>
                    <script>
                        (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0';
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                    </script>
                    <div class='fb-share-button'data-href='https://www.youtube.com/watch?v=HZQyJHpo-ag' data-layout='button_count'>
                    </div>
            </div>
            <div class='ar-btn-share'>
                <div class='line-it-button' data-lang='en' data-type='share-a' data-env='REAL' data-url='' data-color='default' data-size='small' data-count='true' data-ver='3' style='display: none;'>
                </div>
                <script src='https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js' async='async' defer='defer'></script>
            </div>
        ";
    }
    $conn->close();
}
//เเสดงสินค้าภาษาไทยเเละอังกฤษ
function showProductDetailTh($pd_id, $lang)
{
    $conn = connect_bestDB();
    $sql_get_product_detail = "select pd_more_dt_th,pd_more_dt_eng from tbl_products where pd_id=" . $pd_id . "";
    $result = mysqli_query($conn, $sql_get_product_detail);
    $row = mysqli_fetch_row($result);
    if ($lang == "TH") {
        echo $row[0];
    } else {
        echo $row[1];
    }
    $conn->close();
}
//เเสดงสินค้าที่เหมือนกัน
function getProductOther($pd_id)
{
    $conn = connect_bestDB();
    $sql_get_pd_price = "select pd_price from tbl_products where category_name='$pd_id'";
    $exe_sql_get_pd_price = mysqli_query($conn, $sql_get_pd_price);
    $price_key = mysqli_fetch_assoc($exe_sql_get_pd_price);
    @$find_by_price = $price_key["pd_price"];
    if ($find_by_price == null) {
        $find_by_price = 3000;
    }
    $sql_get_product_detail = "select category_name, discount, pd_id, pd_name, pd_price, pd_quantity, image_file1 from tbl_products";
    $result = mysqli_query($conn, $sql_get_product_detail);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pd_price = pd_discount($row["discount"], $row["pd_price"]);
            $random[] = $row["pd_id"];
            $data[$row["pd_id"]] = array(
                'id' => $row['pd_id'],
                'category_id' => $row["category_name"],
                'img_file' => $row["image_file1"],
                'pd_name' => $row["pd_name"],
                'pd_price' => $row["pd_price"],
                'discount' => $pd_price,
                'quantity' => $row["pd_quantity"]
            );
        }
    } else {
        echo "";
    }
    $number = 10;
    $random_keys = array_rand($random, $number);
    for ($i = 0; $i < $number; $i++) {
        $id = $random[$random_keys[$i]];
        echo "<div class='ar-pd-oth-img-and-txt'>
            <a href='pdreview.php?pd_id=" . $data[$id]['id'] . "&category_id=" . $data[$id]['category_id'] . "' class='pdrw-a-link-bx'>
                <div class='ar-pd-oth-image'>
                    <img src='../access/uploads_image_file/" . $data[$id]['img_file'] . "' alt='' class='ind-set-pd-img-oth'>
                </div>
                <div class='ar-pd-oth-desc'>
                    <div class='ar-pd-name-bxoth'>
                        <p id='oth_pdname'>" . $data[$id]['pd_name'] . "</p>
                    </div>
                    <div class='ind2-pd-price'>
                        <p><span class='pd_dis'>" . formatMoney($data[$id]['pd_price'], true) . "</span></p>
                        <p class='nrm-pd-price'>" . formatMoney($data[$id]['discount'], true) . " บาท</p>
                    </div>
                    <div class='ar-pd-quantity-bxoth'>
                        <p class='pd-quantity-title'>จำนวนสินค้า</p>
                        <p class='pd-quantity-num'>" . $data[$id]['quantity'] . " ชิ้น</p>
                    </div>
                </div>
            </a>
        </div>";
    }
    $conn->close();
}
function pd_discount($discount, $pd_price)
{
    $pd_discount = ($pd_price * $discount) / 100;
    $pd_price = $pd_price - $pd_discount;
    return $pd_price;
}
