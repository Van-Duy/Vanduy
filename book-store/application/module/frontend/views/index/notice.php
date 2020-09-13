<?php 
//link
$linkHome       = URL::createLink('frontend','index','index');
$linkLogin      = URL::createLink('frontend','index','login');


$nameNotice     = HtmlFront::createNameLogin('Không tìm thấy trang yêu cầu');
$titleNotice    = HtmlFront::createNotice('404','Đường dẫn không hợp lệ',$linkHome,'Quay lại trang chủ');


if($this->arrParam['type'] == 'register'){
    $nameNotice     = HtmlFront::createNameLogin('Đăng ký tài khoản thành công');
    $titleNotice    = HtmlFront::createNotice('Chúc mừng','Bạn đã đăng kí thành công',$linkLogin,'Tiếp tục đăng nhập');
}else if($this->arrParam['type'] == 'not-permission'){
    $nameNotice     = HtmlFront::createNameLogin('Không tìm thấy trang yêu cầu');
    $titleNotice    = HtmlFront::createNotice('Error','Bạn không phải là quản trị viên',$linkHome,'Quay lại trang chủ');
}


?>
<?php echo  $nameNotice . $titleNotice;?>
    