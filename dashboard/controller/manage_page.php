<?php
function addAdvertImage()
{
    include 'connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_FILES["advert_file_image1"]["name"] == null && $_FILES["advert_file_image2"]["name"] == null && $_FILES["advert_file_image3"]["name"] == null) {
            echo "not found";
            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_mange_page.php'>";
        } else {
            $target_dir = "C:/xampp/htdocs/bestbuy/access/uploads_advert/";
            if ($_FILES["advert_file_image1"]["name"] != null || $_FILES["advert_file_image2"]["name"] != null && $_FILES["advert_file_image3"]["name"] != null) {
                $advert_image_file_tmp1 = $_FILES["advert_file_image1"]["tmp_name"];
                $advert_image_file1 = $_FILES["advert_file_image1"]["name"];
                $advert_image_file_tmp2 = $_FILES["advert_file_image2"]["tmp_name"];
                $advert_image_file2 = $_FILES["advert_file_image2"]["name"];
                $advert_image_file_tmp3 = $_FILES["advert_file_image3"]["tmp_name"];
                $advert_image_file3 = $_FILES["advert_file_image3"]["name"];
                $file_name1 = '';
                $file_name2 = '';
                $file_name3 = '';
                if ($advert_image_file1 == null) {
                    $file_name1 = '';
                } else {
                    $file_name1 = date("dmy") . time() . $advert_image_file1;
                    $target_file1 = $target_dir . $file_name1;
                    move_uploaded_file($advert_image_file_tmp1, $target_file1);
                    insertAdvertData($file_name1);
                }
                if ($advert_image_file2 == null) {
                    $file_name2 = '';
                } else {
                    $file_name2 = date("dmy") . time() . $advert_image_file2;
                    $target_file2 = $target_dir . $file_name2;
                    move_uploaded_file($advert_image_file_tmp2, $target_file2);
                    insertAdvertData($file_name2);
                }
                if ($advert_image_file3 == null) {
                    $file_name3 = '';
                } else {
                    $file_name3 = date("dmy") . time() . $advert_image_file3;
                    $target_file3 = $target_dir . $file_name3;
                    move_uploaded_file($advert_image_file_tmp3, $target_file3);
                    insertAdvertData($file_name3);
                }
                echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_mange_page.php'>";
            } else {
                if ($_FILES["advert_file_image1"]["name"] != null) {
                    $advert_image_file_tmp1 = $_FILES["advert_file_image1"]["tmp_name"];
                    $advert_image_file1 = $_FILES["advert_file_image1"]["name"];
                    $file_name1 = date("dmy") . time() . $advert_image_file1;
                    $target_file1 = $target_dir . $file_name1;
                    move_uploaded_file($advert_image_file_tmp1, $target_file1);
                    insertAdvertData($file_name1);
                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_mange_page.php'>";
                }
                if ($_FILES["advert_file_image2"]["name"] != null) {
                    $advert_image_file_tmp2 = $_FILES["advert_file_image2"]["tmp_name"];
                    $advert_image_file2 = $_FILES["advert_file_image2"]["name"];
                    $file_name2 = date("dmy") . time() . $advert_image_file2;
                    $target_file2 = $target_dir . $file_name2;
                    move_uploaded_file($advert_image_file_tmp2, $target_file2);
                    insertAdvertData($file_name2);
                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_mange_page.php'>";
                }
                if ($_FILES["advert_file_image3"]["name"] != null) {
                    $advert_image_file_tmp3 = $_FILES["advert_file_image3"]["tmp_name"];
                    $advert_image_file3 = $_FILES["advert_file_image3"]["name"];
                    $file_name3 = date("dmy") . time() . $advert_image_file3;
                    $target_file3 = $target_dir . $file_name3;
                    move_uploaded_file($advert_image_file_tmp3, $target_file3);
                    insertAdvertData($file_name3);
                    echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_mange_page.php'>";
                }
            }
        }
    } else {
        echo "HTTP method not allowed";
    }
}

if (isset($_POST["upload_advert"])) {
    addAdvertImage();
}
function insertAdvertData($file_name)
{
    $conn = connect_bestDB();
    $stmt = $conn->prepare("insert into tbl_advert(advert_image_file) values(?)");
    $stmt->bind_param("s", $file_name);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
function getImageAdvert()
{
    $conn = connect_bestDB();
    $sql_select_advert_file = "select advert_id, advert_image_file from tbl_advert order by advert_id asc limit 3";
    $result = mysqli_query($conn, $sql_select_advert_file);
    $i = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            echo "<div class='preview-ad-vert-image'>
                <img src='../access/uploads_advert/" . $row["advert_image_file"] . "' id='showImg" . $i . "' class='ser-advert-w-h' '>
                <div class='ar-set-btn-del-advert'>
                    <a href='controller/manage_page.php?btn_del_advert&advert_id=" . $row["advert_id"] . "&file_name=" . $row["advert_image_file"] . "' id='showBtnDel" . $i . "' class='set-btn-del-advert'>ลบ</a>
                </div>
            </div>";
        }
    }
    $conn->close();
}
@$btn_del_advert=$_GET["btn_del_advert"];
if(isset($btn_del_advert)){
    @$adid = $_GET["advert_id"];
    @$adfile = $_GET["file_name"];
    if (isset($adid) && isset($adfile)) {
        include 'connect.php';
        echo $adfile;
        $conn = connect_bestDB();
        $sql_del_advert_image = "delete from tbl_advert where advert_id='$adid'";
        mysqli_query($conn, $sql_del_advert_image);
        $conn->close();
        unlink("C:/xampp/htdocs/bestbuy/access/uploads_advert/" . $adfile);
        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_mange_page.php'>";
    }
}
