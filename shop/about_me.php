<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<head>
    <?php
        include 'set_meta.php';
        include '../dashboard/controller/connect.php';
    ?>
    <link rel="stylesheet" href="shop_style/index.css">
    <link rel="stylesheet" href="shop_style/web_responsive.css">
    <link rel="stylesheet" href="shop_style/navtop.css">
    <link rel="stylesheet" href="shop_style/pdreview.css">
    <link rel="stylesheet" href="shop_style/about_me.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-web-ecom-ind-container">
        <?php
            include 'indnavtop.php';
            include 'shop_controller/session_controller.php';
            $username=get_user_name();
            showIndNavTop(1,$username);
        ?>
    </div>
    <div class="ar-web-ecom-content">
        <div class="ar-about-me-ctn">
            <div class="ar-store-top-image-ctn">
                <img src="../access/company_img/store2.png" alt="" class="abt-cmp-navtop-ctn">
            </div>
            <div class="ar-abt-show-ctn-bx-ls">
                <div class="ar-abt-bx-link-manue-ls">
                    <a href="#abt_ctn01" class="abt-link-to-cnt">
                        <div class="ar-abt-manue-ls-icon">
                            <i class="fa-solid fa-building fa-2x"></i>
                        </div>
                        <div class="ar-abt-manue-ls-detail ">
                            <p class="abt-set-font">ลักษณะการประกอบธุรกิจ</p>
                        </div>
                    </a>
                </div>
                <div class="ar-abt-bx-link-manue-ls">
                    <a href="#abt_ctn02" class="abt-link-to-cnt">
                        <div class="ar-abt-manue-ls-icon">
                            <i class="fa-solid fa-hammer fa-2x"></i>
                        </div>
                        <div class="ar-abt-manue-ls-detail">
                            <p class="abt-set-font">รูปแบบการให้บริการ</p>
                        </div>
                    </a>
                </div>
                <div class="ar-abt-bx-link-manue-ls">
                    <a href="#abt_ctn03" class="abt-link-to-cnt">
                        <div class="ar-abt-manue-ls-icon">
                            <i class="fa-solid fa-clipboard-check fa-2x"></i>
                        </div>
                        <div class="ar-abt-manue-ls-detail">
                            <p class="abt-set-font">ผลงานของเรา</p>
                        </div>
                    </a>
                </div>
                <div class="ar-abt-bx-link-manue-ls">
                    <a href="#abt_ctn04" class="abt-link-to-cnt">
                        <div class="ar-abt-manue-ls-icon">
                            <i class="fa-solid fa-location-dot fa-2x"></i>
                        </div>
                        <div class="ar-abt-manue-ls-detail">
                            <p class="abt-set-font">สถานที่ตั้ง</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="ar-abt-show-ctn-bx-ls">
                <div class="ar-abt-image">
                    <img src="../access/company_img/cmp-1.png" alt="" class="about-set-cmp-img">
                </div>
                <div class="ar-abt-txt">
                    <div class="ar-abt-title">
                        <h2 class="abt-h2-res-txt">บริษัท เบส บาส ซัพพลาย หาดใหญ่ จำกัด</h2>
                    </div>
                    <div class="ar-abt-desc">
                        <p>
                            บริษัท เบส บาส ซัพพลาย หาดใหญ่ จำกัด ได้ก่อตั้งขึ้นเมื่อวันที่ 31 มีนาคม 2551
                            ด้วยทุนจดทะเบียน 1,000,000 บาท ตั้งอยู่เลขที่ 46/45-46 ซ.1 ถ.กาญจนวานิชย์ ต.คอหงส์ อ.หาดใหญ่
                            จ.สงขลา โดยเป็นบริษัทที่พัฒนาต่อเนื่องมาจากการบริหารงานของบริษัท เบส บาย ซัพพลาย จำกัด
                            ซึ่งเป็นบริษัทที่มีประสบการณ์ในการทำงานเกี่ยวกับระบบเครื่องชั่งน้ำหนัก
                            เเละเครื่องมือวัดในโรงงานอุตสาหกรรมทุกประเภท ทุกขนาดในหลายภาคธุรกิจ
                            เเละธุรกิจด้านการพาณิชย์ทั่วไป
                        </p>
                    </div>
                </div>
            </div>
            <div class="ar-abt-show-ctn-bx-ls3" id="abt_ctn01">
                <div class="ar-show-business-desc-img">
                    <img src="../access/company_img/bus-desc1.png" alt="" class="business-desc-img1">
                    <img src="../access/company_img/bus-desc.png" alt="" class="business-desc-img">
                </div>
                <div class="ar-abt-txt">
                    <div class="ar-abt-title">
                        <h2 class="abt-h2-res-txt">ลักษณะการประกอบธุรกิจ</h2>
                    </div>
                    <div class="ar-abt-desc">
                        <p>
                            บริษัทประกอบธุรกิจ โดยเป็นผู้เเทนจัดจำหน่าย เเละนำเข้า เครื่องชั่งนำ้หนักดิจิตอล ทุกประเภท
                            รวมถึงเครื่องมือวัดในอุตสาหกรรม เเละอุปกรณ์ห้องเเลปทุกชนิด
                            ห้องแลปในด้านการควบคุมคุณภาพสินค้าของลูกค้า โดยเรามีทีมติดตั้ง ซ่อมบำรุง
                            ที่มากประสบการณ์พร้อมบริการลูกค้าทั้งใน เเละนอกสถานที่เพื่อความสะดวกเเละรวดเร็ว
                            ของลูกค้า พร้อมทั้งให้คำปรึกษาเกี่ยวกับระบบเครื่องชั่ง เพื่อตอบสนองความต้องการของลูกค้า
                            เเละประโยชน์สูงสุด
                        </p>
                    </div>
                    <p id="abt_ctn02"></p>
                </div>
                <div class="ar-abt-image2">
                    <img src="../access/company_img/bus-desc2.png" alt="" class="about-set-cmp-img">
                </div>
            </div>
            <div class="ar-abt-show-ctn-bx-ls2">
                <div class="ar-abt-image-ls2">
                    <img src="../access/company_img/service_img.png" alt="" class="about-set-cmp-img2">
                </div>
                <div class="ar-abt-txt2">
                    <div class="ar-abt-title">
                        <h2 class="abt-h2-res-txt">รูปแบบการให้บริการ</h2>
                    </div>
                    <div class="ar-abt-desc">
                        <ul>
                            <li>-จำหน่าย เครื่องชั่งน้ำหนักทุกประเภท เครื่องมือวัดในอุตสาหกรรม
                                เเละอุปกรณ์ห้องเเลปทุกชนิด
                            </li>
                            <li>-บริการซ่อม เครื่องชั่งนำ้หนักทุกประเภท เครื่องมือวัดในอุตสาหกรรม
                                เเละอุปกรณ์ห้องเเลปทุกชนิด</li>
                            <li>-บริการสอบเทียบ เครื่องชั่งนำ้หนักทุกประเภท เครื่องมือวัดในอุตสาหกรรม
                                เเละอุปกรณ์ห้องเเลปทุกชนิด</li>
                        </ul>
                        <p id="abt_ctn03"></p>
                    </div>
                </div>
            </div>
            <div class="ar-abt-show-ctn-bx-ls4">
                <div class="ar-abt-txt3">
                    <div class="ar-abt-title">
                        <h2 class="abt-h2-res-txt">ผลงานของเรา</h2>
                    </div>
                    <div class="ar-abt-desc ar-abt-desc-res">
                        <div class="ar-success-icon-and-txt">
                            <i class="fa-solid fa-weight-scale fa-2x"></i>
                            <h3 class="abt-set-inline-txt set-font-res">จำหน่ายอุปกรณ์เครื่องชั่งนำ้หนัก</h3>
                        </div>
                        <div class="ar-success-icon-and-txt">
                            <i class="fa-solid fa-pen-ruler fa-2x"></i>
                            <h3 class="abt-set-inline-txt set-font-res">ออกแบบ</h3>
                        </div>
                        <div class="ar-success-icon-and-txt">
                            <i class="fa-solid fa-circle-down  fa-2x"></i>
                            <h3 class="abt-set-inline-txt set-font-res">ติดตั้ง</h3>
                        </div>
                        <div class="ar-success-icon-and-txt">
                            <i class="fa-solid fa-screwdriver-wrench  fa-2x"></i>
                            <h3 class="abt-set-inline-txt set-font-res">งานซ่อม</h3>
                        </div>
                        <div class="ar-success-icon-and-txt">
                            <i class="fa-solid fa-microscope  fa-2x"></i>
                            <h3 class="abt-set-inline-txt set-font-res">รับสอบเทียบ เครื่องชั่งนำ้หนัก เเละเฟอร์นิเจอร์</h3>
                        </div>
                    </div>
                </div>
                <div class="ar-show-success-image-list">
                    <img src="../access/company_img/cmp-result.png" alt="" class="cmp-success-img">
                    <img src="../access/company_img/cmp-result1.png" alt="" class="cmp-success-img">
                    <img src="../access/company_img/cmp-result2.png" alt="" class="cmp-success-img">
                </div>
            </div>
            <p id="abt_ctn04"></p>
            <div class="ar-abt-show-ctn-bx-ls4">
                <div class="ar-abt-image4">
                    <img src="../access/company_img/location.PNG" alt="" class="about-set-location-img">
                </div>
                <div class="ar-abt-txt3">
                    <div class="ar-abt-title">
                        <h2 class="abt-h2-res-txt">ตำเเหน่งที่ตั้งบริษัท</h2>
                    </div>
                    <div class="ar-abt-desc">
                        <p>เลขที่ 46/45-48 หมู่ 4 ซ.1 ถนน กาญจนวนิชย์ ต.คอหงส์ อ.หาดใหญ่ จ.สงขลา 90110</p>
                        <label for="">เส้นทาง GPS:</label><a href="https://goo.gl/maps/kn8X84hCdgSGfBwZ6">Google map</a>
                    </div>
                </div>
            </div>
            <div class="ar-abt-show-ctn-bx-ls4">
                <div class="ar-abt-txt3">
                    <div class="ar-abt-title">
                        <h2 class="abt-h2-res-txt">รายชื่อลูกค้าอ้างอิง</h2>
                    </div>
                    <div class="abt-tbl-show-ctm-ls" id="hidCtmHis">
                        <table class="abr-tbl-ctm-txt">
                            <tr>
                                <td class='tbl-about-me-ctm-ls1'>บริษัท ศรีตรังโกลฟส์ (ประเทศไทย) จำกัด (มหาชน)</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท แมนเอโฟรสเซนฟูดส์ จำกัด</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท ท้อปโกลฟ เมดิคอล (ไทยเเลนด์) จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท แปซิฟิคเเปรรูปสัตว์น้ำจำกัด</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท โชติวัฒน์อุตสาหกรรมการผลิต จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท เบทาโกรเกษตรอุตสาหกรรม จำกัด สำนักงานใหญ่</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท สงขลาเเคนนิง จำกัด (มหาชน)</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท บี.เจ.พรีคาสท์ จำกัด (สำนักงานใหญ่)</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท ทรอปิคอลเเคนนิง (ประเทศไทย) จำกัด (มหาชน)</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท ชัยเจริญมารีน(2002) จำกัด (สำนักงานใหญ่)</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท ห้องเย็นโชติวัฒน์หาดใหญ่ จำกัด (มหาชน)</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท ซีพีเอฟ (ประเทศไทย) </td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท เซฟสกิน เมดดิคอล แอนด์ ไซเอนทิฟิก (ประเทศไทย) จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท กว๋างเขินรับเบอร์ (ตรัง) จำกัด</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท บริดจสโตน เนเซอรัล รับเบอร์ (ประเทศไทย) จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท อินโนลาเท็กซ์ (ประเทศไทย) จำกัด</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท หลีเฮงซีฟู้ด จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท KINGFISHER HOLDINGS CO.LTD.</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท สยามอินเตอร์เนชันเนลฟู๊ด จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท โรงพยาบาล กรุงเทพหาดใหญ่</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท บี เทค อินดัสตรี จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท ไบรท์วีล (ไทยเเลนด์) จำกัด (สำนักงานใหญ่)</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท เซาท์เเลนด์รีซอร์ซ</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท กัลฟ์ ยะลากรีน จำกัด (สำนักงานใหญ่)</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท เอส.เอส.เเอล.พาราวู้ด จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท มาสเตอร์ วอเตอร์ จำกัด</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท ไทยกู๊ดเเลนด์รับเบอร์จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท พรีม่าเเฮม (ไทยเเลนด์) จำกัด</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท อินโนลาเท็กซ์ (ประเทศไทย) จำกัด</td>
                                <td class='tbl-about-me-ctm-ls'>บริษัท เอสเคฟู้ดส์ (ประเทศไทย) จำกัด (มหาชน)</td>
                            </tr>
                            <tr>
                                <td class='tbl-about-me-ctm-ls'>บริษัท สมิหลาโคลด์ สโตเรจ จำกัด (สำนักงานใหญ่)</td>
                                <td class='tbl-about-me-ctm-ls'>คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์</td>
                            </tr>
                        </table>
                    </div>
                    <div class="ar-abt-show-oth-ctm-his" onclick="abtShowCtm()">
                        <center>
                            <p id="show_txt_oth">เเสดงเพิ่มเติม</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
<script src="../shop/store_js/about.js"></script>
<script src="../shop/store_js/navtop.js"></script>
</html>