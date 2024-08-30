<?php
function dashboardAuthen($ad_id, $ckk)
{
    if ($ckk == 0) {
        include 'connect.php';
        $conn = connect_bestDB();
        $bsd_ad_id = base64_decode($ad_id);
        $check_data = "select status from tbl_admin where admin_id='$bsd_ad_id'";
        $rs_ckk = mysqli_query($conn, $check_data);
        $data = mysqli_fetch_row($rs_ckk);
        if ($data == true) {
            return $data[0];
        } else {
            return false;
            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/error'>";
        }
    } else {
        $conn = connect_bestDB();
        $bsd_ad_id = base64_decode($ad_id);
        $check_data = "select status from tbl_admin where admin_id='$bsd_ad_id'";
        $rs_ckk = mysqli_query($conn, $check_data);
        $data = mysqli_fetch_row($rs_ckk);
        if ($data == true) {
            return $data[0];
        } else {
            return false;
            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/error'>";
        }
        $conn->close();
    }
}
