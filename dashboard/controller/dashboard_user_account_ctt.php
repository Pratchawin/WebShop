<?php
    function get_customer_list(){
        $conn=connect_bestDB();
        $sql_get_ctm="select username, email, date_register from account";
        $rs_ctm_data=mysqli_query($conn, $sql_get_ctm);
        $i=0;
        if(mysqli_num_rows($rs_ctm_data)>0){
            while($ctm_data=mysqli_fetch_assoc($rs_ctm_data)){
                $i+=1;
                echo "<tr class='ar-tr-pd-tbl-member'>
                    <td class='ar-td-member-no set-tbl-border'>$i</td>
                    <td class='ar-td-member-name set-tbl-border'>".decodeCtmData($ctm_data["username"])."</td>
                    <td class='ar-td-member-email set-tbl-border'>".decodeCtmData($ctm_data["email"])."</td>
                    <td class='ar-td-member-date set-tbl-border'>".$ctm_data["date_register"]."</td>
                </tr>";
            }
        }
        $conn->close();
    }
    function decodeCtmData($ctm_data){
        $decode_data=base64_decode($ctm_data);
        return $decode_data;
    }
    //นับจำนวนสมาชิกที่มาสมัคร
    function count_ctm(){
        $conn=connect_bestDB();
        $sql_get_ctm="select user_id from account";
        $rs_ctm_data=mysqli_query($conn, $sql_get_ctm);
        $count=mysqli_num_rows($rs_ctm_data);
        if($count>0){   
            return $count;
        }else{
            return "";
        }
        $conn->close();
    }
    //ค้นหารายชื่อสมาชิก
    function find_username_account($inp_username){
        $conn=connect_bestDB();
        $ckk_whitespace=ltrim($inp_username,"");
        $sql_escap_inp=mysqli_escape_string($conn,$ckk_whitespace);
        $end_code_uname=base64_encode($sql_escap_inp);
        $sql_get_ctm="select username, email, date_register from account where username like '%$end_code_uname%'";
        $rs_ctm_data=mysqli_query($conn, $sql_get_ctm);
        $i=0;
        if(mysqli_num_rows($rs_ctm_data)>0){
            while($ctm_data=mysqli_fetch_assoc($rs_ctm_data)){
                $i+=1;
                echo "<tr class='ar-tr-pd-tbl-member'>
                    <td class='ar-td-member-no'>$i</td>
                    <td class='ar-td-member-name'>".decodeCtmData($ctm_data["username"])."</td>
                    <td class='ar-td-member-email'>".decodeCtmData($ctm_data["email"])."</td>
                    <td class='ar-td-member-date'>".$ctm_data["date_register"]."</td>
                </tr>";
            }
        }else{
            echo "
            <td style='padding-top:20px;'></td>
            <td style='padding-top:20px;'>ไม่พบรายชื่อลูกค้า</td>
            ";
        }
        $conn->close();
    }

