<?php
    //เเสดงข้อมูลบริษัท
    function get_cpn_contact($cpn_id){
        $conn=connect_bestDB();
        $es_cpn_id=mysqli_escape_string($conn, $cpn_id);
        $sql_get_ctt="select cpn_data from tbl_contact where cpn_id='$es_cpn_id'";
        $rs_cpn_data=mysqli_query($conn, $sql_get_ctt);
        $cpn_data=mysqli_fetch_assoc($rs_cpn_data);
        return $cpn_data["cpn_data"];
    }
?>