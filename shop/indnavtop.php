<?php
function showIndNavTop($check_page, $username)
{
    if ($check_page == 0) {
        $show_btn_logout = "<a href='./shop/login.php?status=mobile' class='top-btn-st-for-user'><i class='fa-solid fa-arrow-right-to-bracket'></i></a>";
        $show_username_tag = '';
        if ($username != null) {
            $show_username_tag = " <div class='ar-top-btn-lg-lo-bs-name'><p class='p-nv-top-uname'>$username</p></div>";
            $show_btn_logout = "<a href='shop/shop_controller/session_controller.php?status=logout' class='top-btn-st-for-user'><i class='fa-solid fa-arrow-right-from-bracket'></i></a>";
        }
        echo "<div class='ar-web-ecom-top-content'>
            <div class='web-ecom-top-content'>
                <div class='bx-web-ecom-top-content'>
                    <div class='web-logo-top'>
                        <img src='access/logo_img/cl_logo.png' alt='' class='icon-response'>
                        <div class='ar-manue-slice-bar'>
                            <i class='fa-solid fa-bars fa-1x' onclick='showNavLeft()'></i>
                        </div>
                        <div class='ar-show-manue-resp-navtop-list' id='showManueRespTop'>
                            <div class='ar-show-manue-resp'>
                                <div class='ar-nav-top-res-btn-close'>
                                    <span class='btn-close-manue' onclick='CloseManueNavTop()'>&times;</span>
                                </div>
                                <p><b>หมวดหมู่สินค้า</b></p>
                                <div class='ar-show-pdcate-link-title'>
                                ";
                                    $conn = connect_bestDB();
                                    $sql_sel = "select category_id, category_name from tbl_category";
                                    $rs_data = mysqli_query($conn, $sql_sel);
                                    if (mysqli_num_rows($rs_data) > 0) {
                                        while ($data = mysqli_fetch_assoc($rs_data)) {
                                            echo "
                                                <div class='set-link-marr'>
                                                    <div>
                                                        <a class='res-link' href='./shop/show_pd_category.php?category_id=".$data["category_id"]."&category_list=".$data["category_name"]."'>".$data["category_name"]."</a>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                    }
        echo "
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='web-inp-search-pd-name'>
                        <form action='./shop/search_pd_by_inp.php' method='POST'>
                            <input type='text' name='search_pd' id='' class='inp-search-top' placeholder='ค้นหาสินค้า'>
                            <input type='text' style='display:none;' name='btn_search_pd' id=''  placeholder='ค้นหาสินค้า'>
                            <button class='btn-search-pd-name'><i class='fa-solid fa-magnifying-glass'></i></button>
                        </form>
                    </div>
                    <div class='web-login-logout-status'>
                        <div class='ar-navtop-show-uname-txt'>
                            " . $show_username_tag . "
                            <div class='ar-top-btn-lg-lo-bs'>
                                <a href='shop/basket.php' class='top-btn-st-for-user'><i class='fa-solid fa-cart-shopping fa-1x'></i></a>
                            </div>
                            <div class='ar-top-btn-lg-lo-bs'>
                                " . $show_btn_logout . "
                            </div>
                        </div>
                        <div class='ar-show-user-and-cart-logo'>
                            <div class='logo-user-icon-list'>
                                <a href='shop/basket.php'><i class='fa-solid fa-basket-shopping navtop-icon-list'></i></a>
                            </div>
                            <div class='logo-user-icon-list'>
                                <a href='shop/login.php' class='link-res-top-login-txt'><i class='fa-solid fa-right-to-bracket navtop-icon-list'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='ar-manue-list-top'>
                <div class='ar-manue-top-link'>
                    <div class='ar-link-list-top'>
                        <a href='index.php' class='hd-top-link-txt'>หน้าเเรก</a>
                    </div>
                    <div class='ar-link-list-top'>
                        <a href='shop/howtopay.php' class='hd-top-link-txt'>วิธีการชำระเงิน</a>
                    </div>
                    <div class='ar-link-list-top'>
                        <a href='shop/about_me.php' class='hd-top-link-txt'>เกี่ยวกับเรา</a>
                    </div>
                    <div class='ar-link-list-top'>
                        <a href='shop/contact.php' class='hd-top-link-txt'>ติดต่อเรา</a>
                    </div>
                </div>
            </div>
        </div>";
    } else {
        $show_btn_logout = "<a href='../shop/login.php?status=2' class='top-btn-st-for-user'><i class='fa-solid fa-arrow-right-to-bracket'></i></a>";
        $show_username_tag = '';
        if ($username != null) {
            $show_username_tag = " <div class='ar-top-btn-lg-lo-bs-name'><p class='p-nv-top-uname'>$username</p></div>";
            $show_btn_logout = "<a href='shop_controller/session_controller.php?status=logout' class='top-btn-st-for-user'><i class='fa-solid fa-arrow-right-from-bracket'></i></a>";
        }
        echo "<div class='ar-web-ecom-top-content'>
            <div class='web-ecom-top-content'>
                <div class='bx-web-ecom-top-content'>
                    <div class='web-logo-top'>
                        <img src='../access/logo_img/cl_logo.png' alt='' class='icon-response'>
                        <div class='ar-manue-slice-bar'>
                            <i class='fa-solid fa-bars fa-1x' onclick='showNavLeft()'></i>
                        </div>
                        <div class='ar-show-manue-resp-navtop-list' id='showManueRespTop'>
                            <div class='ar-show-manue-resp'>
                                <div class='ar-nav-top-res-btn-close'>
                                    <span class='btn-close-manue' onclick='CloseManueNavTop()'>&times;</span>
                                </div>
                                <p><b>หมวดหมู่สินค้า</b></p>
                                <div class='ar-show-pdcate-link-title'>
                                ";
                                $conn = connect_bestDB();
                                $sql_sel = "select category_id, category_name from tbl_category";
                                $rs_data = mysqli_query($conn, $sql_sel);
                                if (mysqli_num_rows($rs_data) > 0) {
                                    while ($data = mysqli_fetch_assoc($rs_data)) {
                                        echo "
                                            <div class='set-link-marr'>
                                                <div>
                                                    <a class='res-link' href='show_pd_category.php?category_list=".$data["category_name"]."&category_id=".$data["category_id"]."'>".$data["category_name"]."</a>
                                                </div>
                                            </div>
                                        ";
                                    }
                                }
        echo "
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='web-inp-search-pd-name'>
                        <form action='search_pd_by_inp.php' method='POST'>
                            <input type='text' name='search_pd' class='inp-search-top' placeholder='ค้นหาสินค้า'>
                            <input type='text' style='display:none;' name='btn_search_pd' id=''  placeholder='ค้นหาสินค้า'>
                            <button class='btn-search-pd-name'><i class='fa-solid fa-magnifying-glass'></i></button>
                        </form>
                    </div>
                    <div class='web-login-logout-status'>
                        <div class='ar-navtop-show-uname-txt'>
                            " . $show_username_tag . "
                            <div class='ar-top-btn-lg-lo-bs'>
                                <a href='basket.php' class='top-btn-st-for-user'><i class='fa-solid fa-cart-shopping icon-set-font fa-1x'></i></a>
                            </div>
                            <div class='ar-top-btn-lg-lo-bs'>
                                " . $show_btn_logout . "
                            </div>
                        </div>
                        <div class='ar-show-user-and-cart-logo'>
                            <div class='logo-user-icon-list'>
                                <a href='basket.php'><i class='fa-solid fa-basket-shopping navtop-icon-list'></i></a>
                            </div>
                            <div class='logo-user-icon-list'>
                                <a href='login.php' class='link-res-top-login-txt'><i class='fa-solid fa-right-to-bracket navtop-icon-list'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='ar-manue-list-top'>
                <div class='ar-manue-top-link'>
                    <div class='ar-link-list-top'>
                        <a href='../index.php' class='hd-top-link-txt'>หน้าเเรก</a>
                    </div>
                    <div class='ar-link-list-top'>
                        <a href='howtopay.php' class='hd-top-link-txt'>วิธีการชำระเงิน</a>
                    </div>
                    <div class='ar-link-list-top'>
                        <a href='about_me.php' class='hd-top-link-txt'>เกี่ยวกับเรา</a>
                    </div>
                    <div class='ar-link-list-top'>
                        <a href='contact.php' class='hd-top-link-txt'>ติดต่อเรา</a>
                    </div>
                </div>
            </div>
        </div>";
    }
}
