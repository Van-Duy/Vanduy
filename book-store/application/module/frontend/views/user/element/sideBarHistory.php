<?php 
$action             = $this->arrParam['action'];


//link
$linkLogout         = URL::createLink('frontend', 'index', 'logout',);
$linkInfo           = URL::createLink('frontend', 'user', 'info','','info.html');
$linkPass           = URL::createLink('frontend', 'user', 'changePass','','changePass.html');
$linkHistory        = URL::createLink('frontend', 'user', 'history','','history.html');

//create SideBar
$htmlSideBar        = HtmlFront::createLiCart($action, array(
    'Thông tin tài khoản'   => array('link'     => $linkInfo    , 'nameShow'     => 'info'),
    'Thay đổi mật khẩu'     => array('link'     => $linkPass    , 'nameShow'     => 'changePass'),
    'Lịch sử mua hàng'      => array('link'     => $linkHistory , 'nameShow'     => 'history'),
    'Đăng xuất'             => array('link'     => $linkLogout  , 'nameShow'     => 'logout')
));

?>