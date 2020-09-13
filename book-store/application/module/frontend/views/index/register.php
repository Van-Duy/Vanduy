<?php 
$nameRegister = HtmlFront::createNameLogin('Đăng ký tài khoản');
$source           = $this->arrParam['form'];

// input
$inputName        = HtmlFront::creatInputRes('form[username]', 'text', $source['username']);
$inputFullName    = HtmlFront::creatInputRes('form[fullname]', 'text', $source['fullname']);
$inputEmail       = HtmlFront::creatInputRes('form[email]', 'text', $source['email']);
$inputPassword    = HtmlFront::creatInputRes('form[password]', 'password', $source['password']);
$inputToken       = HtmlFront::creatInputRes('form[token]', 'hidden', time());


// div - input
$divName          =  HtmlFront::creatInputDiv('Tên tài khoản', $inputName);
$divFullname      =  HtmlFront::creatInputDiv('Họ và tên', $inputFullName);
$divEmail         =  HtmlFront::creatInputDiv('Email', $inputEmail);
$divPassword      =  HtmlFront::creatInputDiv('Mật khẩu', $inputPassword);

$showDiv = $divName . $divFullname . $divEmail . $divPassword ;


if ($this->errors != null) Session::set('message',array('class' => 'error','content' => $this->errors));

?>
?>
<?php echo $nameRegister; ?>
<section class="register-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Đăng ký tài khoản</h3>
                <div class="theme-card">
                    <form action="" method="post" id="admin-form" class="theme-form">
                        <div class="form-row">
                            <?php echo $showDiv; ?>
                        </div>
                        <?php echo $inputToken?>
                        <button type="submit" id="submit" name="submit" value="Tạo tài khoản" class="btn btn-solid">Tạo tài khoản</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
