<?php
include './dashboard/controller/connect.php';
function IndGetPdcategory()
{
    $conn = connect_bestDB();
    $sql_get_pd_category = 'select category_id, category_name from tbl_category';
    $result = mysqli_query($conn, $sql_get_pd_category);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li class='ar-pd-name-list'>
                <a href='index.php?category_id=" . $row["category_id"] ."' class='nav-top-pd-name'>" . $row['category_name'] . "</a>
            </li>";
        }
    }
    $conn->close();
}

//เเสดงโฆษณาหน้า index
function showAdvertTopContent($check_slice)
{
    $conn = connect_bestDB();
    $sql_get_image_advert_file = "select advert_image_file from tbl_advert";
    $result = mysqli_query($conn, $sql_get_image_advert_file);
    $path_image_advert = "access/uploads_advert/";
    if ($check_slice == 1) {
        $path_image_advert = "access/uploads_advert/";
    } else {
        $path_image_advert = "../access/uploads_advert/";
    }
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='mySlides'>
            <img src='$path_image_advert" . $row["advert_image_file"] . "' alt='" . $row["advert_image_file"] . "' class='ind-ads-right-img'>
        </div>";
        }
    }
}

//เเสดงสินค้าในหน้า index
function indShowProducts($category_id)
{
    $conn = connect_bestDB();
    $sql_select_categiry_title="select category_name from tbl_category where category_id=$category_id";
    $cate_title_rs=mysqli_query($conn, $sql_select_categiry_title);
    if(mysqli_num_rows($cate_title_rs)>0){
        $cate_title_txt=mysqli_fetch_row($cate_title_rs);
        echo "<div class='ar-ind2web-ctn-pd-title'>
        <p><b>".$cate_title_txt[0]."</b></p>
        </div>";
        $sql_select_pd = "select pd_id, pd_price, category_name,pd_name,pd_quantity,discount,image_file1 from tbl_products where category_name=$category_id";
        $result = mysqli_query($conn, $sql_select_pd);
        $i=0;
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='ind2-pd-bx-img-detail'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $i+=1;
                $pd_price='';
                if($row["discount"]==0){
                    $pd_price=$row["pd_price"];
                }else{
                    $pd_price=pd_discount($row["discount"],$row["pd_price"]);
                }
                echo "
                <div class='ind2-pd-img-pddt'>
                    <a href='shop/pdreview.php?pd_id=" . $row["pd_id"] . "&category_id=" . $row["category_name"] . "' class='ind2-pd-link'>
                        <div class='ind2-ar-pd-img'>
                            <img src='access/uploads_image_file/" . $row["image_file1"] . "' alt='".$row["image_file1"]."' class='ind-set-pd-img'>
                        </div>
                        <div class='ind2-ar-pd-dt'>
                            <div class='ind2-pd-desc'>
                                <p class='ind2-pd-desc-txt'>
                                    " . $row["pd_name"] . "
                                </p>
                            </div>
                            <div class='ind2-pd-price'>
                                <p><span class='pd_dis'>". formatMoney($row["pd_price"], true) . " </span></p>
                                <p class='nrm-pd-price'>" . formatMoney($pd_price, true) . " บาท</p>
                            </div>
                            <div class='ind2-pd-quantity'>
                                <p>จำนวนสินค้า " . $row["pd_quantity"] . " ชิ้น</p>
                            </div>
                        </div>
                    </a>
                </div>";
            }
            echo "</div>";
        } else {
            echo "<div class='ind-status-pd-null'>
                <div class='ind-status-pd-null-txt'>
                    <h2>ยังไม่มีสินค้าในหมวดหมู่ ".$cate_title_txt[0]."</h2>
                </div>
            </div>";
        }
    }else{
        echo "";
    }
}