<?php 

$nameLogin        = HtmlFront::createNameLogin('Đăng nhập');

//link
$linkRegister     = URL::createLink('frontend', 'index', 'register');

// input
$inputEmail       = HtmlFront::creatInputRes('form[email]', 'text', $source['email']);
$inputPassword    = HtmlFront::creatInputRes('form[password]', 'password', $source['password']);

// div - input

$divEmail         =  HtmlFront::creatInputDivLogin('Email', $inputEmail);
$divPassword      =  HtmlFront::creatInputDivLogin('Mật khẩu', $inputPassword);

// creat  right-login
$rightLogin       = HtmlFront::createRightLogin($linkRegister);

if ($this->errors != null) Session::set('message',array('class' => 'error','content' => $this->errors));
?>


<?php echo $nameLogin ; ?>
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Đăng nhập</h3>
                    <div class="theme-card">
                        <form action="" method="post"
                            id="admin-form" class="theme-form">
                            <?php echo $divEmail . $divPassword; ?>
                            <button type="submit" id="submit" name="submit" value="Đăng nhập" class="btn btn-solid">Đăng nhập</button>
                        </form>
                    </div>
                </div>
                <?php echo $rightLogin  ; ?>
            </div>
        </div>
    </section>
