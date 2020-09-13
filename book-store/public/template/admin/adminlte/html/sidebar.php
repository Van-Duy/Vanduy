<?php
$userId         = Session::get('user')['info']['id'];
$controller     = $this->arrParam['controller'];
$action         = $this->arrParam['action'];

$linkDashboard      = URL::createLink('backend', 'dashboard', 'index');
$linkCart           = URL::createLink('backend', 'cart', 'index');
$linkGroupList      = URL::createLink('backend', 'group', 'index');
$linkGroupForm      = URL::createLink('backend', 'group', 'form');
$linkUserList       = URL::createLink('backend', 'user', 'index');
$linkUserForm       = URL::createLink('backend', 'user', 'form');
$linkCategoryList   = URL::createLink('backend', 'category', 'index');
$linkCategoryForm   = URL::createLink('backend', 'category', 'form');
$linkBookList       = URL::createLink('backend', 'book', 'index');
$linkBookForm       = URL::createLink('backend', 'book', 'form');
$linkAccountInfo    = URL::createLink('backend', 'account', 'index');
$linkAccountPass    = URL::createLink('backend', 'account', 'changePass');
$linkBack           = URL::createLink('frontend', 'index', 'index','','index.html');

//dashboard
$arrDashboard       = ['parent' => ['name' => 'Dashboard', 'icon'   => 'tachometer-alt', 'link' => $linkDashboard]];
$dashboard          = Html::createSidebar($controller, $action, $arrDashboard);

//Group
$arrGroup           = ['parent' => ['name' => 'Group', 'icon' => 'users', 'link' => '#'], 'child' => [['name' => 'List', 'icon' => 'list-ul', 'link' => $linkGroupList, 'nameShow' => 'index'], ['name' => 'Form', 'icon' => 'edit', 'link' => $linkGroupForm, 'nameShow' => 'form']]];
$group              = Html::createSidebar($controller, $action, $arrGroup);

//user
$arrUser            = ['parent' => ['name' => 'User', 'icon' => 'user', 'link' => '#'], 'child' => [['name' => 'List', 'icon' => 'list-ul', 'link' => $linkUserList, 'nameShow' => 'index'], ['name' => 'Form', 'icon' => 'edit', 'link' => $linkUserForm, 'nameShow' => 'form']]];
$user               = Html::createSidebar($controller, $action, $arrUser);

//Category
$arrCategory        = ['parent' => ['name' => 'Category', 'icon' => 'thumbtack', 'link' => '#'], 'child' => [['name' => 'List', 'icon' => 'list-ul', 'link' => $linkCategoryList, 'nameShow' => 'index'], ['name' => 'Form', 'icon' => 'edit', 'link' => $linkCategoryForm, 'nameShow' => 'form']]];
$category           = Html::createSidebar($controller, $action, $arrCategory);

//Book
$arrBook            = ['parent' => ['name' => 'Book', 'icon' => 'book-open', 'link' => '#'], 'child' => [['name' => 'List', 'icon' => 'list-ul', 'link' => $linkBookList, 'nameShow' => 'index'], ['name' => 'Form', 'icon' => 'edit', 'link' => $linkBookForm, 'nameShow' => 'form']]];
$book               = Html::createSidebar($controller, $action, $arrBook);

//cart
$arrCart            = ['parent' => ['name' => 'Cart', 'icon'   => 'shopping-cart', 'link' => $linkCart]];
$cart               = Html::createSidebar($controller, $action, $arrCart);

//Account
$arrAccount         = ['parent' => ['name' => 'Account', 'icon' => 'user-circle', 'link' => '#'], 'child' => [['name' => 'Info', 'icon' => 'file-invoice', 'link' => $linkAccountInfo, 'nameShow' => 'index'], ['name' => 'ChangePass', 'icon' => 'key', 'link' => $linkAccountPass, 'nameShow' => 'changePass']]];
$account            = Html::createSidebar($controller, $action, $arrAccount);

//Back Home
$arrBack            = ['parent' => ['name' => 'Back Home', 'icon'   => 'undo', 'link' => $linkBack]];
$back               = Html::createSidebar($controller, $action, $arrBack);

?>

<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo $this->_dirImg ?>/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ZendVN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $this->_dirImg ?>/default-user.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin ZendVN</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php echo $dashboard; ?>
                <?php echo $group . $user . $category . $book . $cart . $account . $back ; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>