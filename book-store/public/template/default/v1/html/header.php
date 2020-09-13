<?php
$user           = Session::get('user');
$product        = Session::get('cart');
$sumQuantify    = 0;
if (isset($product)) {
    $sumQuantify     = array_sum($product['quantify']);
    $sumprice         = '$' . number_format(array_sum($product['price']));
}


// link
$linkHome       = URL::createLink('fontend', 'index', 'index',null,'index.html');
$linkCategory   = URL::createLink('fontend', 'category', 'index',null,'category.html');
$linkLogin      = URL::createLink('fontend', 'index', 'login',null,'login.html');
$linkRegister   = URL::createLink('fontend', 'index', 'register',null,'register.html');
$linkLogout     = URL::createLink('fontend', 'index', 'logout');
$linkDatabase   = URL::createLink('backend', 'dashboard', 'index');
$linkCart       = URL::createLink('fontend', 'user', 'cart',null,'cart.html');
$linkHistory      = URL::createLink('fontend', 'user', 'history',null,'history.html');
$destroyCart    = URL::createLink('fontend', 'user', 'destroy');


// li
$login          = Html::creatLiDefault('Login', '', $linkLogin, $this->arrParam['controller']);
$Logout         = Html::creatLiDefault('Logout', 'color1', $linkLogout, $this->arrParam['controller']);
$Register       = Html::creatLiDefault('Register', '', $linkRegister, $this->arrParam['controller']);
$Home           = Html::creatLiDefault('Home', 'color3', $linkHome, $this->arrParam['controller']);
$Category       = Html::creatLiDefault('Category', 'color4', $linkCategory, $this->arrParam['controller']);
$Database       = Html::creatLiDefault('Database', 'color2', $linkDatabase, $this->arrParam['controller']);
$History        = Html::creatLiDefault('History', 'color3', $linkHistory, $this->arrParam['controller']);
$Contract       = Html::creatLiDefault('Contract', 'color4', '', $this->arrParam['controller']);

$list   = $Home . $Category . $Blog . $Contract;
$acount = $login . $Register;

if ($user['login']) {
    $info       = $user['info'];
    $username   = $info['username'];
    $email      = $info['email'];

    $acount     = "";
    $list       = $Home . $Category . $History . $Contract . $Database . $Logout;
}

?>
<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="search">
                <form>
                    <input type="text" value="Search" >
                    <input type="submit" value="Go" id="SearchHeader">
                </form>
            </div>
            <div class="header-left">
                <ul>
                    <?php echo $acount; ?>
                    <li><a href="javascript:changeProfile('<?php echo $linkLogout ?>')"><?php echo $username; ?> <img src="<?php echo $this->_dirImg ?>/avatar.png" alt="" style="width: 40px;" /></a></li>
                </ul>
                <div class="cart box_1">
                    <a href="<?php echo $linkCart; ?>">
                        <h3>
                            <div class="total">
                                <span class="simpleCartTotal"><?php echo  $sumprice; ?></span> (<span id="simpleCart_quantity"><?php echo  $sumQuantify; ?></span> items)</div>
                            <img src="<?php echo $this->_dirImg ?>/cart.png" alt="" />
                        </h3>
                    </a>
                    <p><a href="#" onclick="destroyCart('<?php echo $destroyCart; ?>');">Empty Cart</a></p>

                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="container">
        <div class="head-top">
            <div class="logo"><a href="<?php echo $linkHome; ?>"><img src="<?php echo $this->_dirImg ?>/avatar.jpg" alt=""> </a>BOOK SHOP</div>
            <div class=" h_menu4">
                <ul class="memenu skyblue">
                    <?php echo $list; ?>

                </ul>
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>