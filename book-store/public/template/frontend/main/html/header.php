<?php
require_once LIBRARY_EXT_PATH . 'XML.php';
$user           = Session::get('user');
$product        = Session::get('cart');
$sumQuantify    = 0;
if (isset($product)) {
    $sumQuantify     = array_sum($product['quantify']);
}

// link 
$linkLogin      = URL::createLink('frontend', 'index', 'login','','login.html');
$linkLogout     = URL::createLink('frontend', 'index', 'logout');
$linkRegister   = URL::createLink('frontend', 'index', 'register','','register.html');
$linkHome       = URL::createLink('frontend', 'index', 'index','','index.html');
$linkCategory   = URL::createLink('frontend', 'category', 'index','','category.html');
$linkCart       = URL::createLink('frontend', 'user', 'cart','','cart.html');
$linkDatabase   = URL::createLink('backend', 'dashboard', 'index');
$linkHistory    = URL::createLink('frontend', 'user', 'history','','history.html');
$linkInfo       = URL::createLink('frontend', 'user', 'info','','info.html');
$linkPass       = URL::createLink('frontend', 'user', 'changePass','','changePass.html');
$linkCategoryList = URL::createLink('frontend', 'category', 'category','','category-list.html');

//show danh sách Header
$categories = XML::getContentXML('categories.xml');
if (isset($categories)) {
    $listCategory = [];
    foreach ($categories as $value) {
        $id                 =  $value->id;
        $name               =  $value->name;
        $nameURL            = URL::filterURL($name);
        $link               = URL::createLink('frontend', 'category', 'index', array('list' => $id),"$nameURL-$id.html");
        $listCategory[$link] .=  $name;
    }
}

//create My-account
$My_account = HtmlFront::createLiUser($this->_dirImg . '/avatar.png', array('Đăng nhập' => $linkLogin, 'Đăng kí' => $linkRegister));
if ($user['login']) {
    $info       = $user['info'];
    $username   = $info['username'];

    $My_account = HtmlFront::createLiUser($this->_dirImg . '/avatar.png', array('Thông tin tài khoản' => $linkInfo,'Thay đổi mật khẩu' => $linkPass,'Lịch sử mua hàng' => $linkHistory,'Database' => $linkDatabase,'Đăng xuất' => $linkLogout));
}


//create MenuLeft-Header
$menuLeft   = HtmlFront::createMenuLeft('BookStore', $linkHome);

//create MenuRight-Header(TEXT)
$menuRight   = HtmlFront::createMenuRight(array($linkHome => 'Trang chủ', $linkCategory => 'Sách', $linkCategoryList => array('name' => 'Danh mục', 'child' => $listCategory)), $this->arrParam['controller']);

// creatr Cart
$cart       = HtmlFront::createCart($linkCart, $this->_dirImg, $sumQuantify);

?>
<div class="loader_skeleton">
    <div class="typography_section">
        <div class="typography-box">
            <div class="typo-content loader-typo">
                <div class="pre-loader"></div>
            </div>
        </div>
    </div>
</div>
<!-- header start -->
<header class="my-header sticky">
    <div class="mobile-fix-option"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <?php echo  $menuLeft; ?>
                    <div class="menu-right pull-right">
                        <?php echo $menuRight; ?>
                        <?php echo $My_account; ?>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div>
                                            <img src="<?php echo $this->_dirImg ?>/search.png" onclick="openSearch()" class="img-fluid blur-up lazyload" alt="">
                                            <i class="ti-search" onclick="openSearch()"></i>
                                        </div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div>
                                                <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form action="" method="GET">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="search" id="search-input" placeholder="Tìm kiếm sách...">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php echo $cart; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->