<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <?php
    include 'dashboard_meta.php';
    ?>
    <link rel="stylesheet" href="dashboard_style/dashboard.css">
    <link rel="stylesheet" href="dashboard_style/dashboard_add_pd.css">
    <script src="https://kit.fontawesome.com/9d0fdde958.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="ar-admin-dashboard-ctn-order-list">
        <div class="ar-admin-content-left-right">
            <div class="ar-admin-dash-left-ctn">
                <?php include 'dashboard_navleft.php' ?>
            </div>
            <div class="ar-admin-dash-right-ctn">
                <div class="ar-admin-dash-right-nav-top">
                    <?php
                    include 'dashboard_navtop.php';
                    set_navtop(0);
                    ?>
                </div>
                <div class="ar-nav-top-title">
                    <h3>เพิ่มสินค้า</h3>
                </div>
                <div class="ar-add-pd-form-and-inp">
                    <div class="ar-form-inp-pd-dt">
                        <div class="ar-bx-form-ad-pd-dt1">
                            <form action="controller/add_pd.php" method="post">
                                <div class="ar-bx-ad-form-title">
                                    <h3>เพิ่มประเภทสินค้าหลัก</h3>
                                </div>
                                <div class="ar-form-add-pd-category-name">
                                    <p>ประเภทสินค้าหลัก:</p>
                                    <input class="sh-inp-pd-dt" type="text" name="main_category" id="">
                                    <input class="btn-add-pd-category" name="main_category_submit" type="submit" value="เพิ่มประเภทสินค้า">
                                </div>
                            </form>
                            <?php
                            include 'controller/add_pd.php';
                            echo $main_cate_status;
                            ?>
                        </div>
                        <div class="ar-bx-form-ad-pd-dt1">
                            <div class="ar-bx-ad-form-title">
                                <h3>เพิ่มประเภทสินค้าย่อย</h3>
                            </div>
                            <div class="ar-form-add-pd-category-name">
                                <form action="controller/add_pd.php" method="post">
                                    <div class="ds-bx1-tem">
                                        <p>ประเภทสินค้าหลัก:</p>
                                        <select class="sh-inp-pd-dt" name="select_category_id" id="">
                                            <?php
                                            getCategory();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="ds-bx1-tem">
                                        <p>ชื่อสินค้าย่อย:</p>
                                        <input class="sh-inp-pd-dt" type="text" name="product_list_name" id="">
                                        <input class="btn-add-pd-category" name="btn_add_product_list" type="submit" value="เพิ่มสินค้าย่อย">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="ar-bx-form-ad-pd-dt1">
                            <div class="ar-bx-ad-form-title">
                                <h3>เพิ่มยี่ห้อสินค้า</h3>
                            </div>
                            <div class="ar-form-add-pd-category-name">
                                <form action="dashboard_add_pd.php" method="post">
                                    <div class="ds-bx1-tem">
                                        <p>ชื่อยี่ห้อสินค้า:</p>
                                        <input class="sh-inp-pd-dt" type="text" name="pd_brand" id="">
                                        <input class="btn-add-pd-category" name="btn_pd_brand" type="submit" value="เพิ่มยี่ห้อสินค้า">
                                    </div>
                                </form>
                                <?php 
                                    @$btn_pd_brand=$_POST["btn_pd_brand"];
                                    if(isset($btn_pd_brand)){
                                        @$pd_brand_name=$_POST["pd_brand"];
                                        add_pd_brand($pd_brand_name);
                                        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/dashboard_add_pd.php'>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="ar-bx-form-ad-pd-dt1">
                            <div class="ar-bx-ad-form-title">
                                <h3>เพิ่มสินค้า</h3>
                            </div>
                            <div class="ar-form-add-pd-category-name">
                                <form action="controller/add_pd.php" method="post" enctype="multipart/form-data"><?php //controller/add_pd.php?>
                                    <div class="ar-inp-pd-inf-bx">
                                        <table>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td class="td-test">เลือกประเภทสินค้าหลัก:</td>
                                                <td class="td-test">
                                                    <select class="sh-inp-pd-dt" name="find_main_ctt" id="">
                                                        <?php
                                                        getCategory();
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr class="ar-td-ds-pd-inp">
                                                <td>เลือกประเภทสินค้าย่อย:</td>
                                                <td>
                                                    <select class="sh-inp-pd-dt" name="category_list_name" id="">
                                                        <?php
                                                        getCategoryList();
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>ยี่ห้อ:</td>
                                                <td>
                                                    <select class="sh-inp-pd-dt" name="pd_brand" id="">
                                                        <?php get_pd_brand();?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>รุ่น:</td>
                                                <td><input class="sh-inp-pd-dt" type="text" name="pd_model" id=""></td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>รหัสสินค้า:</td>
                                                <td><input class="sh-inp-pd-dt" type="text" name="pd_code" id=""></td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td style="padding-top: 8px; position:absolute;">ชื่อสินค้า:</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><textarea class="sh-inp-pd-dt" name="pd_name" id="" cols="30" rows="10"></textarea></td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>สถานะสินค้า:</td>
                                                <td>
                                                    <select class="sh-inp-pd-dt" name="sel_pd_status" id="">
                                                        <option value="1">มีสินค้าในสต๊อก</option>
                                                        <option value="0">สั่งจองล่วงหน้า</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>ประกันสินค้า(ถ้ามี):</td>
                                                <td>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_insurance" id="">
                                                </td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>จำนวนสินค้า:</td>
                                                <td><input class="sh-inp-pd-dt" type="text" name="pd_quantity" id=""></td>
                                                <td> ชิ้น</td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>ราคาสินค้า(ไม่รวมภาษี):</td>
                                                <td><input class="sh-inp-pd-dt" type="text" name="pd_price" id=""></td>
                                                <td> บาท</td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>เปอร์เซ็นส่วนลด:</td>
                                                <td><input class="sh-inp-pd-dt" type="text" name="discount" id=""></td>
                                            </tr>
                                            <tr class="ar-td-ds-pd-inp">
                                                <td>ค่าจัดส่ง:</td>
                                                <td><input class="sh-inp-pd-dt" type="text" name="shipment_expenses" id=""></td>
                                                <td> บาท</td>
                                            </tr>
                                        </table>
                                        <div class="ar-bx-upload-pd-image">
                                            <p>รายละเอียดย่อ: ใช้ < br> เพื่อขึ้นบรรทัดใหม่</p>
                                            <div class="">
                                                <textarea class="ar-inp-pd-detail-txtarea" name="pd_detail" id="" cols="100" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="ar-bx-upload-pd-image">
                                            <p>รายละเอียดทั้งหมดภาษาไทย: ใช้ < br> เพื่อขึ้นบรรทัดใหม่</p>
                                            <div class="">
                                                <textarea class="ar-inp-pd-detail-txtarea" name="pd_more_dt_th" id="" cols="100" rows="20"></textarea>
                                            </div>
                                        </div>
                                        <div class="ar-bx-upload-pd-image">
                                            <p>รายละเอียดทั้งหมดภาษาอังกฤษ: ใช้ < br> เพื่อขึ้นบรรทัดใหม่</p>
                                            <div class="">
                                                <textarea class="ar-inp-pd-detail-txtarea" name="pd_more_dt_eng" id="" cols="100" rows="20"></textarea>
                                            </div>
                                        </div>
                                        <div style="margin-top:30px;margin-bottom:5px;">
                                            <h3>เอกสารไฟล์สินค้า</h3>
                                        </div>
                                        <div class="ar-bx-pd-pdf-file">
                                            <label for="">เลือกไฟล์ PDF:</label>
                                            <input type="file" class="inp-pdf-file" name="pdf_file" id="">
                                        </div>
                                        <div class="ar-show-image-file">
                                            <img src="" alt="" id="showImg1" width="100px" onclick="deleteImg('1')">
                                            <img src="" alt="" id="showImg2" width="100px" onclick="deleteImg('2')">
                                            <img src="" alt="" id="showImg3" width="100px" onclick="deleteImg('3')">
                                            <img src="" alt="" id="showImg4" width="100px" onclick="deleteImg('4')">
                                            <img src="" alt="" id="showImg5" width="100px" onclick="deleteImg('5')">
                                        </div>
                                        <div class="ar-bx-upload-pd-image">
                                            <p>อัปโหลดรูปภาพสินค้าสูงสุด 5 ไฟล์ ขนาด 200 x 300px</p>
                                            <div class="ar-upload-pd-img-bx">
                                                <input type="file" class="inp-upload-pd-img" name="pd_img_1" id="image_file1" onchange="getImageFile('1')">
                                            </div>
                                            <div class="ar-upload-pd-img-bx">
                                                <input type="file" class="inp-upload-pd-img" name="pd_img_2" id="image_file2" onchange="getImageFile('2')">
                                            </div>
                                            <div class="ar-upload-pd-img-bx">
                                                <input type="file" class="inp-upload-pd-img" name="pd_img_3" id="image_file3" onchange="getImageFile('3')">
                                            </div>
                                            <div class="ar-upload-pd-img-bx">
                                                <input type="file" class="inp-upload-pd-img" name="pd_img_4" id="image_file4" onchange="getImageFile('4')">
                                            </div>
                                            <div class="ar-upload-pd-img-bx">
                                                <input type="file" class="inp-upload-pd-img" name="pd_img_5" id="image_file5" onchange="getImageFile('5')">
                                            </div>
                                        </div>
                                        <div class="ar-bx-upload-pd-image">
                                            <p>ลักษณะสินค้า</p>
                                            <div class="">
                                                <div class="ar-inp-pd-prop">
                                                    <label for="num-ber">1.</label>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_prop1" id="" placeholder="ลักษณะสินค้า เช่น สี, รูปแบบสินค้า">
                                                </div>
                                                <div class="ar-inp-pd-prop">
                                                    <label for="num-ber">2.</label>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_prop2" id="" placeholder="ลักษณะสินค้า เช่น สี, รูปแบบสินค้า">
                                                </div>
                                                <div class="ar-inp-pd-prop">
                                                    <label for="num-ber">3.</label>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_prop3" id="" placeholder="ลักษณะสินค้า เช่น สี, รูปแบบสินค้า">
                                                </div>
                                                <div class="ar-inp-pd-prop">
                                                    <label for="num-ber">4.</label>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_prop4" id="" placeholder="ลักษณะสินค้า เช่น สี, รูปแบบสินค้า">
                                                </div>
                                                <div class="ar-inp-pd-prop">
                                                    <label for="num-ber">5.</label>
                                                    <input class="sh-inp-pd-dt" type="text" name="pd_prop5" id="" placeholder="ลักษณะสินค้า เช่น สี, รูปแบบสินค้า">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ar-btn-add-pd">
                                            <input class="btn-add-pd-category" name="addProducts" onclick="send_add_pd()" type="submit" value="เพิ่มสินค้า">
                                            <a href="dashboard_add_pd.php" class="btn-cancel-pd-category">ยกเลิก</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>

</html>