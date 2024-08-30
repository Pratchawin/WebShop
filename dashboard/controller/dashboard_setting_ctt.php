<?php
include 'connect.php';
function get_old_cpn_data($num)
{
    $conn = connect_bestDB();
    $sql_get_old_data = "select cpn_id,title, cpn_data, account_name from tbl_cpn_data where cpn_id=$num";
    $rs_old_data = mysqli_query($conn, $sql_get_old_data);
    $old_data = mysqli_fetch_row($rs_old_data);
    echo "<p>ธนาคาร: " . $old_data[1] . "<p>";
    echo "<p>เลขบัญชี: " . $old_data[2] . "<p>";
    echo "<p>ชื่อบัญชี: " . $old_data[3] . "<p>";
    $conn->close();
    return $old_data[0];
}
function get_shipment($num)
{
    $conn = connect_bestDB();
    $sql_get_old_data = "select cpn_id,cpn_data from tbl_cpn_data where cpn_id=$num";
    $rs_old_data = mysqli_query($conn, $sql_get_old_data);
    $old_data = mysqli_fetch_row($rs_old_data);
    echo "<p>การจัดส่ง: " . $old_data[1] . "<p>";
    $conn->close();
    return $old_data[0];
}

function get_main_ctt()
{
    $conn = connect_bestDB();
    $sql_get_all_ctt_main = "select category_id, category_name from tbl_category";
    $rs_ctt_main = mysqli_query($conn, $sql_get_all_ctt_main);
    if (mysqli_num_rows($rs_ctt_main) > 0) {
        while ($ctt_data = mysqli_fetch_assoc($rs_ctt_main)) {
            echo "<option value=" . $ctt_data["category_id"] . ">" . $ctt_data["category_name"] . "</option>";
        }
    }else{
        echo mysqli_error($conn);
    }
    $conn->close();
}
//ตั้งค่าสินค้าเริ่มต้น
function set_pd_default($ctt_id)
{
    $conn = connect_bestDB();
    $es_ctt_id = mysqli_escape_string($conn, $ctt_id);
    $sql_set_default = "update tbl_pd_default set category_id='$es_ctt_id' where default_id=1";
    mysqli_query($conn, $sql_set_default);
    $conn->close();
}
function get_pd_default_name(){
    $conn = connect_bestDB();
    $sql_get_all_ctt_main = "select category_id from tbl_pd_default where default_id=1";
    $rs_ctt_main = mysqli_query($conn, $sql_get_all_ctt_main);
    if(mysqli_num_rows($rs_ctt_main)>0){
        $data=mysqli_fetch_assoc($rs_ctt_main);
        $get_ctt_main="select category_name from tbl_category where category_id=".$data["category_id"]."";
        $ckk_main_rs=mysqli_query($conn, $get_ctt_main);
        if(mysqli_num_rows($ckk_main_rs)>0){
            $ctt_main=mysqli_fetch_assoc($ckk_main_rs);
            echo $ctt_main["category_name"];
        }else{
            echo "";
        }
    }else{
        echo "ไม่ได้กำหนดสินค้าเริ่มต้น";
    }
    $conn->close();
}
//เเก้ไขข้อมูลบริษัท
function upd_cpn_data($new_data,$cpn_id){
    $conn=connect_bestDB();
    $es_cpn_data=rtrim(mysqli_real_escape_string($conn,$new_data)," ");
    $es_cpn_id=mysqli_real_escape_string($conn, $cpn_id);
    $sql_upd_cpn_data="update tbl_contact set cpn_data='$es_cpn_data' where cpn_id='$es_cpn_id'";
    $ckk_upd=mysqli_query($conn, $sql_upd_cpn_data);
    if($ckk_upd==true){
        echo "แก้ไขข้อมูลเรียบร้อย";
    }
    $conn->close();
}
//ดึงข้อมูลบริษัท
function get_cpn_data($cpn_id){
    $conn=connect_bestDB();
    $sql_get_cpn_data="select cpn_data from tbl_contact where cpn_id='$cpn_id'";
    $rs_get_cpn=mysqli_query($conn, $sql_get_cpn_data);
    $cpn_data=mysqli_fetch_assoc($rs_get_cpn);
    $conn->close();
    return $cpn_data["cpn_data"];
}
//ตั้งค่า Line notify
function set_line_notify($line_token){
    $conn=connect_bestDB();
    $es_token=mysqli_real_escape_string($conn, $line_token);
    $sql_upd_token="UPDATE tbl_cpn_data SET cpn_data = '$es_token' WHERE cpn_id = 4";
    mysqli_query($conn, $sql_upd_token);
    $conn->close();
}
function get_line_token(){
    $conn=connect_bestDB();
    $sql_upd_token="select cpn_data from tbl_cpn_data WHERE cpn_id = 4";
    $rs_data=mysqli_query($conn, $sql_upd_token);
    $line_notify=mysqli_fetch_assoc($rs_data);
    $conn->close();
    return $line_notify["cpn_data"];
}