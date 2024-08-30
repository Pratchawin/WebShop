<?php
    include 'connect.php';
    include 'format.php';
    //ดึงคำสั่งซื้อทั้งหมด
    function getOrderHistory(){
        $conn=connect_bestDB();
        $sql_get_order_history="select ctm_address,total_price,order_id,date_order, order_code, pd_name, pd_price, amount, total_price, ctm_name, ctm_phone, cancel_status from tbl_order_history";
        $rs_order_his=mysqli_query($conn,$sql_get_order_history);
        $i=0;
        if(mysqli_num_rows($rs_order_his)>0){
            while($his_data=mysqli_fetch_assoc($rs_order_his)){
                $i+=1;
                $ckk_cancel_status='';
                $ckk_shp_status='';
                $ckk_cll=$his_data["cancel_status"];
                if($ckk_cll==0){
                    $ckk_cancel_status="<p style='color:red;'>ยกเลิก</p>";
                    $ckk_shp_status="<p style='color:red;'>ยกเลิก</p>";
                }else{
                    $ckk_cancel_status="<p style='color:green;'>ชำระเงินเเล้ว</p>";
                    $ckk_shp_status="<p style='color:green;'>จัดส่งเเล้ว</p>";
                }
                echo "
                    <tr>
                        <td class='ar-ds-th-orhis-no1'>$i</td>
                        <td class='ar-ds-th-orhis-no'>".$his_data["order_code"]."</td>
                        <td class='ar-ds-th-orhis-no'>".$his_data["date_order"]."</td>
                        <td class='ar-ds-th-orhis-uname'>".$his_data["ctm_name"]."</td>
                        <td class='ar-ds-th-orhis-phone'>".phone_number_format($his_data["ctm_phone"])."</td>
                        <td class='ar-ds-th-orhis-uname'>".$his_data["ctm_address"]."</td>
                        <td class='ar-ds-td-orhis' id='his-pd-name'><div class='show-pdname' id='ShowpdName'>".$his_data["pd_name"]."</div></td>
                        <td class='ar-ds-td-orhis-price'>".formatMoney($his_data["pd_price"],true)." บาท</td>
                        <td class='ar-ds-td-orhis-quantity'>".$his_data["amount"]." ชิ้น</td>
                        <td class='ar-ds-td-orhis-quantity'>".formatMoney($his_data["total_price"],true)." บาท</td>
                        <td class='ar-ds-td-orhis-pm-status'>
                        $ckk_cancel_status
                        </td>
                        <td class='ar-ds-td-orhis-pm-status'>
                        $ckk_shp_status
                        </td>
                    </tr>
                ";
            }
        }else{
            echo "";
        }
        $conn->close();
    }
    //ค้นหาด้วยชื่อ
    function find_user_his_name($inp_data){
        $conn=connect_bestDB();
        $sql_escap_inp_data=mysqli_real_escape_string($conn,$inp_data);
        $sql_user_his="select ctm_address,total_price,order_id,date_order, order_code, pd_name, pd_price, amount, total_price, ctm_name, ctm_phone,cancel_status from tbl_order_history where ctm_name like '%$sql_escap_inp_data%'";
        $rs_order_his=mysqli_query($conn,$sql_user_his);
        $i=0;
        if(mysqli_num_rows($rs_order_his)>0){
            while($his_data=mysqli_fetch_assoc($rs_order_his)){
                $i+=1;
                $ckk_cancel_status='';
                $ckk_shp_status='';
                $ckk_cll=$his_data["cancel_status"];
                if($ckk_cll==0){
                    $ckk_cancel_status="<p style='color:red;'>ยกเลิกคำสั่งซื้อ</p>";
                    $ckk_shp_status="<p style='color:red;'>-</p>";
                }else{
                    $ckk_cancel_status="<p style='color:green;'>ชำระเงินเเล้ว</p>";
                    $ckk_shp_status="<p style='color:green;'>จัดส่งเเล้ว</p>";
                }
                echo "
                    <tr>
                        <td class='ar-ds-th-orhis-no1'>$i</td>
                        <td class='ar-ds-th-orhis-no'>".$his_data["order_code"]."</td>
                        <td class='ar-ds-th-orhis-no'>".$his_data["date_order"]."</td>
                        <td class='ar-ds-th-orhis-uname'>".$his_data["ctm_name"]."</td>
                        <td class='ar-ds-th-orhis-phone'>".phone_number_format($his_data["ctm_phone"])."</td>
                        <td class='ar-ds-th-orhis-uname'>".$his_data["ctm_address"]."</td>
                        <td class='ar-ds-td-orhis' id='fmt_pd_name'><div class='show-pdname'>".$his_data["pd_name"]."</div></td>
                        <td class='ar-ds-td-orhis-price'>".formatMoney($his_data["pd_price"],true)." บาท</td>
                        <td class='ar-ds-td-orhis-quantity'>".$his_data["amount"]." ชิ้น</td>
                        <td class='ar-ds-td-orhis-quantity'>".formatMoney($his_data["total_price"],true)." บาท</td>
                        <td class='ar-ds-td-orhis-pm-status'>
                        $ckk_cancel_status
                        </td>
                        <td class='ar-ds-td-orhis-pm-status'>
                        $ckk_shp_status
                        </td>
                    </tr>
                ";
            }
        }else{
            echo mysqli_error($conn);
        }
        $conn->close();
    }
    //ค้นหาด้วยรหัสสินค้า
    function find_pd_by_code($inp_or_code){
        $conn=connect_bestDB();
        $sql_escap_inp_data=mysqli_real_escape_string($conn,$inp_or_code);
        $sql_user_his="select ctm_address,total_price,order_id,date_order, order_code, pd_name, pd_price, amount, total_price, ctm_name, ctm_phone,cancel_status from tbl_order_history where order_code like '%$sql_escap_inp_data%'";
        $rs_order_his=mysqli_query($conn,$sql_user_his);
        $i=0;
        if(mysqli_num_rows($rs_order_his)>0){
            while($his_data=mysqli_fetch_assoc($rs_order_his)){
                $i+=1;
                $ckk_cancel_status='';
                $ckk_shp_status='';
                $ckk_cll=$his_data["cancel_status"];
                if($ckk_cll==0){
                    $ckk_cancel_status="<p style='color:red;'>ยกเลิกคำสั่งซื้อ</p>";
                    $ckk_shp_status="<p style='color:red;'>-</p>";
                }else{
                    $ckk_cancel_status="<p style='color:green;'>ชำระเงินเเล้ว</p>";
                    $ckk_shp_status="<p style='color:green;'>จัดส่งเเล้ว</p>";
                }
                echo "
                    <tr>
                        <td class='ar-ds-th-orhis-no1'>$i</td>
                        <td class='ar-ds-th-orhis-no'>".$his_data["order_code"]."</td>
                        <td class='ar-ds-th-orhis-no'>".$his_data["date_order"]."</td>
                        <td class='ar-ds-th-orhis-uname'>".$his_data["ctm_name"]."</td>
                        <td class='ar-ds-th-orhis-phone'>".phone_number_format($his_data["ctm_phone"])."</td>
                        <td class='ar-ds-th-orhis-uname'>".$his_data["ctm_address"]."</td>
                        <td class='ar-ds-td-orhis' id='fmt_pd_name'><div class='show-pdname'>".$his_data["pd_name"]."</div></td>
                        <td class='ar-ds-td-orhis-price'>".formatMoney($his_data["pd_price"],true)." บาท</td>
                        <td class='ar-ds-td-orhis-quantity'>".$his_data["amount"]." ชิ้น</td>
                        <td class='ar-ds-td-orhis-quantity'>".formatMoney($his_data["total_price"],true)." บาท</td>
                        <td class='ar-ds-td-orhis-pm-status'>
                        $ckk_cancel_status
                        </td>
                        <td class='ar-ds-td-orhis-pm-status'>
                        $ckk_shp_status
                        </td>
                    </tr>
                ";
            }
        }else{
            echo mysqli_error($conn);
        }
        $conn->close();
    }
    //forresponse
    function getOrderHistoryResponse(){
        $conn=connect_bestDB();
        $sql_get_order_history="select ctm_address,total_price,order_id,date_order, order_code, pd_name, pd_price, amount, total_price, ctm_name, ctm_phone, cancel_status from tbl_order_history";
        $rs_order_his=mysqli_query($conn,$sql_get_order_history);
        $i=0;
        if(mysqli_num_rows($rs_order_his)>0){
            while($his_data=mysqli_fetch_assoc($rs_order_his)){
                $i+=1;
                $ckk_cancel_status='';
                $ckk_shp_status='';
                $ckk_cll=$his_data["cancel_status"];
                if($ckk_cll==0){
                    $ckk_cancel_status="<p style='color:red;'>ยกเลิก</p>";
                    $ckk_shp_status="<p style='color:red;'>ยกเลิก</p>";
                }else{
                    $ckk_cancel_status="<p style='color:green;'>ชำระเงินเเล้ว</p>";
                    $ckk_shp_status="<p style='color:green;'>จัดส่งเเล้ว</p>";
                }
                echo "
                    <div class='res-his-bx'>
                        <tr>
                            <td class='td-hid-title-pdd'>รหัส:</td>
                            <td class='td-his-set-pdd'>".$his_data["order_code"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>วันที่สั่งซื้อ:</td>
                            <td class='td-his-set-pdd'>".$his_data["date_order"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ชื่อลูกค้า</td>
                            <td class='td-his-set-pdd'>".$his_data["ctm_name"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>เบอร์โทรศัพท์</td>
                            <td class='td-his-set-pdd'>".phone_number_format($his_data["ctm_phone"])."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ที่อยู่</td>
                            <td class='td-his-set-pdd'>".$his_data["ctm_address"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ชื่อสินค้า</td>
                            <td class='td-his-set-pdd'>".$his_data["pd_name"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ราคาสินค้า</td>
                            <td class='td-his-set-pdd'>".formatMoney($his_data["pd_price"],true)."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>จำนวน:</td>
                            <td class='td-his-set-pdd'>".$his_data["amount"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ราคารวม vat <br> เเละค่าจัดส่ง:</td>
                            <td class='td-his-set-pdd'>".formatMoney($his_data["total_price"],true)."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>การชำระงิน:</td>
                            <td class='td-his-set-pdd'>$ckk_cancel_status</td>
                        </tr>
                        <tr>
                            <td class='td-his-end-border td-hid-title-pdd'>การจัดส่ง:</td>
                            <td class='td-his-end-border td-his-set-pdd'>$ckk_shp_status</td>
                        </tr>
                    </div> 
                ";
            }
        }else{
            echo "";
        }
        $conn->close();
    }
    function getOrderHistoryResponse2($inp_data){
        $conn=connect_bestDB();
        $sql_escap_inp_data=mysqli_real_escape_string($conn,$inp_data);
        $sql_get_order_history="select ctm_address,total_price,order_id,date_order, order_code, pd_name, pd_price, amount, total_price, ctm_name, ctm_phone,cancel_status from tbl_order_history where ctm_name like '%$sql_escap_inp_data%'";
        $rs_order_his=mysqli_query($conn,$sql_get_order_history);
        $i=0;
        if(mysqli_num_rows($rs_order_his)>0){
            while($his_data=mysqli_fetch_assoc($rs_order_his)){
                $i+=1;
                $ckk_cancel_status='';
                $ckk_shp_status='';
                $ckk_cll=$his_data["cancel_status"];
                if($ckk_cll==0){
                    $ckk_cancel_status="<p style='color:red;'>ยกเลิก</p>";
                    $ckk_shp_status="<p style='color:red;'>ยกเลิก</p>";
                }else{
                    $ckk_cancel_status="<p style='color:green;'>ชำระเงินเเล้ว</p>";
                    $ckk_shp_status="<p style='color:green;'>จัดส่งเเล้ว</p>";
                }
                echo "
                    <div class='res-his-bx'>
                        <tr>
                            <td class='td-hid-title-pdd'>รหัส:</td>
                            <td class='td-his-set-pdd'>".$his_data["order_code"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>วันที่สั่งซื้อ:</td>
                            <td class='td-his-set-pdd'>".$his_data["date_order"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ชื่อลูกค้า</td>
                            <td class='td-his-set-pdd'>".$his_data["ctm_name"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>เบอร์โทรศัพท์</td>
                            <td class='td-his-set-pdd'>".phone_number_format($his_data["ctm_phone"])."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ที่อยู่</td>
                            <td class='td-his-set-pdd'>".$his_data["ctm_address"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ชื่อสินค้า</td>
                            <td class='td-his-set-pdd'>".$his_data["pd_name"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ราคาสินค้า</td>
                            <td class='td-his-set-pdd'>".formatMoney($his_data["pd_price"],true)."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>จำนวน:</td>
                            <td class='td-his-set-pdd'>".$his_data["amount"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ราคารวม vat <br> เเละค่าจัดส่ง:</td>
                            <td class='td-his-set-pdd'>".formatMoney($his_data["total_price"],true)."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>การชำระงิน:</td>
                            <td class='td-his-set-pdd'>$ckk_cancel_status</td>
                        </tr>
                        <tr>
                            <td class='td-his-end-border td-hid-title-pdd'>การจัดส่ง:</td>
                            <td class='td-his-end-border td-his-set-pdd'>$ckk_shp_status</td>
                        </tr>
                    </div> 
                ";
            }
        }else{
            echo "";
        }
        $conn->close();
    }
    function getOrderHistoryResponse3($inp_or_code){
        $conn=connect_bestDB();
        $sql_escap_inp_data=mysqli_real_escape_string($conn,$inp_or_code);
        $sql_user_his="select ctm_address,total_price,order_id,date_order, order_code, pd_name, pd_price, amount, total_price, ctm_name, ctm_phone,cancel_status from tbl_order_history where order_code like '%$sql_escap_inp_data%'";
        $rs_order_his=mysqli_query($conn,$sql_user_his);
        $i=0;
        if(mysqli_num_rows($rs_order_his)>0){
            while($his_data=mysqli_fetch_assoc($rs_order_his)){
                $i+=1;
                $ckk_cancel_status='';
                $ckk_shp_status='';
                $ckk_cll=$his_data["cancel_status"];
                if($ckk_cll==0){
                    $ckk_cancel_status="<p style='color:red;'>ยกเลิก</p>";
                    $ckk_shp_status="<p style='color:red;'>ยกเลิก</p>";
                }else{
                    $ckk_cancel_status="<p style='color:green;'>ชำระเงินเเล้ว</p>";
                    $ckk_shp_status="<p style='color:green;'>จัดส่งเเล้ว</p>";
                }
                echo "
                    <div class='res-his-bx'>
                        <tr>
                            <td class='td-hid-title-pdd'>รหัส:</td>
                            <td class='td-his-set-pdd'>".$his_data["order_code"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>วันที่สั่งซื้อ:</td>
                            <td class='td-his-set-pdd'>".$his_data["date_order"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ชื่อลูกค้า</td>
                            <td class='td-his-set-pdd'>".$his_data["ctm_name"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>เบอร์โทรศัพท์</td>
                            <td class='td-his-set-pdd'>".phone_number_format($his_data["ctm_phone"])."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ที่อยู่</td>
                            <td class='td-his-set-pdd'>".$his_data["ctm_address"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ชื่อสินค้า</td>
                            <td class='td-his-set-pdd'>".$his_data["pd_name"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ราคาสินค้า</td>
                            <td class='td-his-set-pdd'>".formatMoney($his_data["pd_price"],true)."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>จำนวน:</td>
                            <td class='td-his-set-pdd'>".$his_data["amount"]."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>ราคารวม vat <br> เเละค่าจัดส่ง:</td>
                            <td class='td-his-set-pdd'>".formatMoney($his_data["total_price"],true)."</td>
                        </tr>
                        <tr>
                            <td class='td-hid-title-pdd'>การชำระงิน:</td>
                            <td class='td-his-set-pdd'>$ckk_cancel_status</td>
                        </tr>
                        <tr>
                            <td class='td-his-end-border td-hid-title-pdd'>การจัดส่ง:</td>
                            <td class='td-his-end-border td-his-set-pdd'>$ckk_shp_status</td>
                        </tr>
                    </div> 
                ";
            }
        }else{
            echo "";
        }
        $conn->close();
    }