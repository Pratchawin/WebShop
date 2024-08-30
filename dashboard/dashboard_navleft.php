<?php
echo "
    <div class='dh-manue-set-position'>
        <div class='ar-dashboard-navleft-manue'>
            <div class='ar-dashboard-navleft-logo'>
                <p class='ds-logo-txt'>Admin</p>
            </div>
            <a href='dashboard.php' class='ar-navleft-link-list' id='ds_change_color1'
                onclick='BtnChangeBgColor(1)'>
                <i class='fa-solid fa-house fa-2x'></i>
                <p class='ds-navleft-txt'>หน้าเเรก</p>
            </a>
            <a href='dashboard_add_pd.php' class='ar-navleft-link-list' id='ds_change_color3'
                onclick='BtnChangeBgColor(3)'>
                <i class='fa-solid fa-boxes-packing fa-2x'></i>
                <p class='ds-navleft-txt'>เพิ่มสินค้า</p>
            </a>
            <a href='dashboard_pd_instoc.php' class='ar-navleft-link-list' id='ds_change_color2'
                onclick='BtnChangeBgColor(2)'>
                <i class='icon fa-solid fa-store fa-2x'></i>
                <p class='ds-navleft-txt'>สินค้าในสต๊อก</p>
            </a>
            <a href='dashboard_edit_category.php' class='ar-navleft-link-list' id='ds_change_color8'
                onclick='BtnChangeBgColor(8)'>
                <i class='fa-solid fa-folder fa-2x'></i>
                <p class='ds-navleft-txt'>ตั้งค่าประเภทสินค้า</p>
            </a>
            <a href='dashboard_mange_page.php' class='ar-navleft-link-list' id='ds_change_color4'
                onclick='BtnChangeBgColor(4)'>
                <i class='fa-solid fa-wrench fa-2x'></i>
                <p class='ds-navleft-txt'>ปรับเเต่งเว็บไซต์</p>
            </a>
            <a href='dashboard_pd_history.php' class='ar-navleft-link-list' id='ds_change_color5'
                onclick='BtnChangeBgColor(5)'>
                <i class='fa-solid fa-clipboard fa-2x'></i>
                <p class='ds-navleft-txt'>ประวัติการสั่งซื้อ</p>
            </a>
            <a href='dashboard_user_account.php' class='ar-navleft-link-list' id='ds_change_color6'
                onclick='BtnChangeBgColor(6)'>
                <i class='fa-solid fa-user-tag fa-2x'></i>
                <p class='ds-navleft-txt'>รายชื่อลูกค้า</p>
            </a>
            <a href='dashboard_setting.php' class='ar-navleft-link-list' id='ds_change_color7'
                onclick='BtnChangeBgColor(7)'>
                <i class='fa-solid fa-gears fa-2x'></i>
                <p class='ds-navleft-txt'>การตั้งค่า</p>
            </a>
        </div>
    </div>    
";
echo "
<div class='ar-manue-res' onclick='show_manue(1);'>
    <div class='show-manue-ls'>
        <a href='dashboard.php'><i class='fa-solid fa-house res-set-font'></i></a>
    </div>
    <div class='show-manue-ls'>
        <a href='dashboard_add_pd.php'><i class='fa-solid fa-boxes-packing res-set-font'></i></a>
    </div>
    <div class='show-manue-ls'>
        <a href='dashboard_pd_instoc.php'><i class='fa-solid fa-store res-set-font'></i></a>
    </div>
    <div class='show-manue-ls'>
        <a href='dashboard_edit_category.php'><i class='fa-solid fa-folder res-set-font'></i></a>
    </div>
    <div class='show-manue-ls'>
        <a href='dashboard_mange_page.php'><i class='fa-solid fa-wrench res-set-font'></i></a>
    </div>
    <div class='show-manue-ls'>
        <a href='dashboard_pd_history.php'><i class='fa-solid fa-clipboard res-set-font'></i></a>
    </div>
    <div class='show-manue-ls'>
        <a href='dashboard_user_account.php'><i class='fa-solid fa-user-tag res-set-font'></i></a>
    </div>
    <div class='show-manue-ls'>
        <a href='dashboard_setting.php'><i class='fa-solid fa-gears res-set-font'></i></a>
    </div>
</div>
";