<?php
    function footer_get_cpn_contact($cpn_id){
        $conn=connect_bestDB();
        $es_cpn_id=mysqli_escape_string($conn, $cpn_id);
        $sql_get_ctt="select cpn_data from tbl_contact where cpn_id='$es_cpn_id'";
        $rs_cpn_data=mysqli_query($conn, $sql_get_ctt);
        $cpn_data=mysqli_fetch_assoc($rs_cpn_data);
        $conn->close();
        return $cpn_data["cpn_data"];
    }
    $cpp_year=date("Y");
    echo "
    <div class='ar-web-ecom-footer-content'>
        <div class='ar-web-footer'>
            <div class='ar-ft-bx-ls'>
                <div class='ar-ft-cmp-logo-about-ct'>
                    <div class='ar-ft-show-best-buy-logo'>
                        <img class='ft-best-buy-logo-png' src='../access/logo_img/cl_logo.png' alt=''>
                    </div>
                </div>
                <div class='ar-ft-cmp-logo-about-ct'>
                    <div class='ar-ins-ft-cmp-dt'>
                        <p class='footer-text'>ข้อมูลการติดต่อ</p>
                        <table>
                            <tr>
                                <td><img src='./logo/fb_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'>".footer_get_cpn_contact(7)."</p></td>
                            </tr>
                            <tr>
                                <td><img src='./logo/line_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'>".footer_get_cpn_contact(6)."</p></td>
                            </tr>
                            <tr>
                                <td><img src='./logo/phone_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'>".footer_get_cpn_contact(1)."</p></td>
                            </tr>
                            <tr>
                                <td><img src='./logo/fax_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'>".footer_get_cpn_contact(2)." (แฟกซ์)</p></td>
                            </tr>
                            <tr>
                                <td><img src='./logo/email_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'>".footer_get_cpn_contact(4)."</p></td>
                            </tr>
                            <tr>
                                <td><img src='./logo/web_icon.png' alt='' width='25px' class='ft-contact-logo'></td>
                                <td><p class='ft-txt-set'>".footer_get_cpn_contact(3)."</p></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class='ar-ft-cmp-logo-about-ct'>
                    <div class='ar-ins-ft-cmp-dt'>
                        <p class='footer-text'>เกี่ยวกับเรา</p>
                        <div class='ar-ft-about-cmp'>
                            <p class='p-ft-about-cmp'>
                                บริษัทประกอบธุรกิจ โดยเป็นผู้เเทนจัดจำหน่าย เเละนำเข้าเครื่องชั่งนำ้หนักดิจิตอลทุกประเภท
                                รวมถึงเครื่องมือวัดในอุตสาหกรรม เเละอุปกรณ์ห้องเเลปในการควบคุมคุณภาพสินค้า โดยเรามีทีม
                                ติดตั้ง ซ่อมบำรุง ที่มากประสบการณ์พร้อมบริการลูกค้าทั้งใน เเละนอกสถานที่
                                เพื่อความสะดวกเเละรวดเร็วของลูกค้า พร้อมทั้งให้คำปรึกษาเกี่ยวกับระบบเครื่องชั่ง
                                เพื่อตอบสนองความต้องการของลูกค้า เเละประโยชน์สูงสุด
                            </p>
                        </div>
                    </div>
                </div>
                <div class='ar-ft-cmp-logo-about-ct'>
                    <div class='ar-ins-ft-cmp-dt'>
                        <p class='footer-text'>สถานที่ตั้ง</p>
                        <div class='ar-ft-about-cmp'>
                            <p class='p-ft-about-cmp2'>
                            ".footer_get_cpn_contact(5)."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class='ar-support-logo'>
                <div class='ar-support-title'>
                    <h3 class='ar-show-logo-support'>ผู้สนับสนุน</h3>
                </div>
                <div class='ar-show-support-logo'>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/allamerican01.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/and02.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/atago-logo03.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/binder-logo04.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/brookfield-logo05.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/commandor-logo06.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/Eutech07.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/logo webo08.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/lovibond-logo09.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/memmert-logo10.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/mettler-logo11.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/sartorius-logo.png' alt='' class='image-logo-support-png'>
                    </div>
                    <div class='support-logo-bx'>
                        <img src='../access/new_support/tanita-logo12.png' alt='' class='image-logo-support-png'>
                    </div>
                </div>
            </div>
            <div class='ar-ft-bx-ls1'>
                <p class='ft-ctn-cmp-dt'>บริษัท เบส บาย ซัพพลาย หาดใหญ่</p>
                <p class='ft-ctn-cmp-dt'>".footer_get_cpn_contact(5)."</p>
                <p class='ft-ctn-cmp-dt'>โทร: ".footer_get_cpn_contact(1)."</p>
                <p class='ft-ctn-cmp-dt'>แฟกซ์:  ".footer_get_cpn_contact(2)."</p>
                <p class='ft-ctn-cmp-dt'>เว็บไซต์: ".footer_get_cpn_contact(3)."</p>
                <p class='ft-ctn-cmp-dt'>อีเมล: ".footer_get_cpn_contact(4)."</p>
                <p class='ft-ctn-cmp-dt'>ไลน์: ".footer_get_cpn_contact(6)."</p>
                <p class='ft-ctn-cmp-dt cpp-right'>© bestbuyhatyai $cpp_year</p>
            </div>
        </div>
    </div>
    ";
