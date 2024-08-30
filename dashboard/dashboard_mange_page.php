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
    <link rel="stylesheet" href="dashboard_style/dashboard_mange_page.css">
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
                    include 'controller/manage_page.php';
                    set_navtop(0);
                    ?>
                </div>
                <div class="ar-manage-store-page-area">
                    <div class="manage-page-title">
                        <h3>ตั้งค่าโฆษณาเว็บไซต์</h3>
                    </div>
                    <div class="ar-bx-inp-img-file">
                        <div class="ar-form-upload-file-ads-img-top">

                            <div class="preview-ads-top-ctn-ind-top">
                                <h1 class="ads-pd-upload-txt">อัปโหลดรูปภาพขนาด 1050 x 300px</h1>
                            </div>
                            <div class="ar-show-ad-vert-image">
                                <div class='preview-ad-vert-image'>
                                    <img src='' id='showImg1' class='ser-advert-w-h' onclick="deleteImg('1')">
                                </div>
                                <div class='preview-ad-vert-image'>
                                    <img src='' id='showImg2' class='ser-advert-w-h' onclick="deleteImg('2')">
                                </div>
                                <div class='preview-ad-vert-image'>
                                    <img src='' id='showImg3' class='ser-advert-w-h' onclick="deleteImg('3')">
                                </div>
                                <?php
                                getImageAdvert();
                                ?>
                            </div>
                            <form action="controller/manage_page.php" method="POST" enctype="multipart/form-data">
                                <div class="ar-input-pd-image-advert-file">
                                    <div class="ar-upload-file-image">
                                        <input type="file" name="advert_file_image1" id="image_file1" onchange="getImageFile('1')" class="inp-ads-file-img">
                                    </div>
                                    <div class="ar-upload-file-image">
                                        <input type="file" name="advert_file_image2" id="image_file2" onchange="getImageFile('2')" class="inp-ads-file-img">
                                    </div>
                                    <div class="ar-upload-file-image">
                                        <input type="file" name="advert_file_image3" id="image_file3" onchange="getImageFile('3')" class="inp-ads-file-img">
                                    </div>
                                </div>
                                <div class="ar-btn-upload-advert-image-file">
                                    <input type="submit" name="upload_advert" value="อัปโหลดโฆษณา" id="" class="btn-upload-advert-file">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="dashbpard_js/dashboard.js"></script>

</html>