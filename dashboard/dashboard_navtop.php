<?php
function set_navtop($ckk_db)
{
    $admin_id = $_SESSION["admin_id"];
    include './controller/dashboard_authen.php';
    if ($ckk_db == 1) {
        if (isset($admin_id)) {
            $data = dashboardAuthen($admin_id,1);
            echo "
                <div class='ar-ds-bx-btn-login-logout'>
                    <a href='controller/dashboard_logout.php' class='ds-btn-logout'>Logout</a>
                </div>
                <div class='ar-ds-bx-btn-login-logout'>
                    <p class='ds-nav-top-show-store-name'>" . $data . "</p>
                </div>
            ";
        } else {
            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/error'>";
        }
    } else if($ckk_db == 0){
        if (isset($admin_id)) {
            $data = dashboardAuthen($admin_id,0);
            echo "
                <div class='ar-ds-bx-btn-login-logout'>
                    <a href='controller/dashboard_logout.php' class='ds-btn-logout'>Logout</a>
                </div>
                <div class='ar-ds-bx-btn-login-logout'>
                    <p class='ds-nav-top-show-store-name'>" . $data . "</p>
                </div>
            ";
        } else {
            echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/error'>";
        }
    }else{
        echo "<meta http-equiv='refresh' content='0;url=http://localhost/bestbuy/dashboard/error'>";
    }
}
