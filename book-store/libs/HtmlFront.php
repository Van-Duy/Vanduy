<?php
class HtmlFront
{
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
    //                      frontned 
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

    // creat createLiUser
    public static function createLiUser($srcImg, $arr)
    {
        if (!empty($arr)) {
            $html = '<div class="top-header"><ul class="header-dropdown"><li class="onhover-dropdown mobile-account">';
            $html .= '<img src="' . $srcImg . '" alt="avatar"><ul class="onhover-show-div">';
            foreach ($arr as $key => $value) {
                $html .= '<li><a href="' . $value . '">' . $key . '</a></li>';
            }
            $html .= '</ul></li></ul></div>';
        }
        return  $html;
    }

    // creat productBox
    public static function createproductBox($arr,$module,$controller)
    {
        $html  = "";
        foreach ($arr as $value) {
            $category_nameURL   = URL::filterURL($value['category_name']);
            $id                 = $value['id'];
            $list               = $value['category_id'];
            $name               = self::formatTitle($value['name'],40);
            $title              = $value['name'];
            $nameURL            = URL::filterURL($name);
            $price              = $value['price'];
            $description        = self::formatTitle($value['description'],1000);
            $sale_off           = $value['sale_off'];
            $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
            $link               = URL::createLink($module, $controller, 'list', ['list' => $list, 'id' => $id], "$category_nameURL/$nameURL-$list-$id.html");
            $star               = 4;
            
            $priceAffSale   = self::formatPrice(($price - ($price * $sale_off / 100)));
            $price          = self::formatPrice($price);

            $html .= ' <div class="product-box"><div class="img-wrapper">';
            $html .= '<div class="lable-block"><span class="lable4 badge badge-danger"> -' . $sale_off . '%</span></div>';
            $html .= '<div class="front"><a href="' . $link . '"><img src="' . $img . '" class="img-fluid blur-up lazyload bg-img" alt="product"></a></div>';
            $html .= ' <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" onclick="buyProduct(\'' . ROOT_URL . '\',' . $id . ')" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="javascript:void(0)" onclick="viewModal(\'' . ROOT_URL . '\',' . $id . ')" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div></div><div class="product-detail"><div class="rating">';
            $x = 0;
            for ($x = 0; $x <= $star; $x++) {
                $html .=  '<i class="fa fa-star"></i>';
            }
            $html .= '</div>';
            $html .= '<a href="' . $link . '"
                            title="' . $title . '">
                            <h6>' . $name . '...</h6>
                        </a>';
            $html .= '<h4 class="text-lowercase">' . $priceAffSale .' <del>' . $price .'</del></h4></div></div>';
        }
        return $html;
    }

    // creat productBox --- forList
    public static function createproductForList($arr,$module,$controller)
    {
        $html  = "";
        foreach ($arr as $value) {
                $category_nameURL   = URL::filterURL($value['category_name']);
                $id                 = $value['id'];
                $list               = $value['category_id'];
                $name               = self::formatTitle($value['name'],40);
                $nameURL            = URL::filterURL($name);
                $price              = $value['price'];
                $description        = self::formatTitle($value['description'],1000);
                $sale_off           = $value['sale_off'];
                $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
                $link               = URL::createLink($module, $controller, 'list', ['list' => $list, 'id' => $id], "$category_nameURL/$nameURL-$list-$id.html");
                $star               = 4;
                
                $priceAffSale   = self::formatPrice(($price - ($price * $sale_off / 100)));
                $price          = self::formatPrice($price);


            $html .= ' <div class="col-xl-3 col-6 col-grid-box"><div class="product-box"><div class="img-wrapper">';
            $html .= '<div class="lable-block"><span class="lable4 badge badge-danger"> -' . $sale_off . '%</span></div>';
            $html .= '<div class="front"><a href="' . $link . '"><img src="' . $img . '" class="img-fluid blur-up lazyload bg-img" alt="product"></a></div>';
            $html .= ' <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" onclick="buyProduct(\'' . ROOT_URL . '\',' . $id . ')" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="javascript:void(0)" onclick="viewModal(\'' . ROOT_URL . '\',' . $id . ')" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div></div><div class="product-detail"><div class="rating">';
            $x = 0;
            for ($x = 0; $x <= $star; $x++) {
                $html .=  '<i class="fa fa-star"></i>';
            }
            $html .= '</div>';
            $html .= '<a href="' . $link . '"
                            title="' . $name . '">
                            <h6>' . $name . '...</h6>
                        </a>';
            $html .= '<p>' . $description . '</p>';
            $html .= '<h4 class="text-lowercase">' . $priceAffSale .' <del>' . $price .'</del></h4></div></div></div>';
        }
        return $html;
    }

    // creat productTop
    public static function createproductTop($arr,$module,$controller)
    {
        $html           = "<div>";
        $count          = 0;
        foreach ($arr as $value) {
            $category_nameURL   = URL::filterURL($value['category_name']);
            $id                 = $value['id'];
            $list               = $value['category_id'];
            $name               = self::formatTitle($value['name'],40);
            $nameURL            = URL::filterURL($name);
            $price              = $value['price'];
            $sale_off           = $value['sale_off'];
            $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
            $link               = URL::createLink($module, $controller, 'list', ['list' => $list, 'id' => $id], "$category_nameURL/$nameURL-$list-$id.html");
            $star               = 4;
            $count++;
            $priceAffSale   = self::formatPrice(($price - ($price * $sale_off / 100)));
            $price          = self::formatPrice($price);

            $html .= ' <div class="media"><a href="' . $link . '"><div class="img-wrapper"><div class="lable-block"><span class="lable4 badge badge-danger"> -' . $sale_off . '%</span></div>';
            $html .= '<img class="img-fluid blur-up lazyload" src="' . $img . '" alt="' . $name . '"></a></div>';
            $html .= '<div class="media-body align-self-center"><div class="rating">';
            $x = 0;
            for ($x = 0; $x <= $star; $x++) {
                $html .=  '<i class="fa fa-star"></i>';
            }
            $html .= '</div>';
            $html .= '<a href="' . $link . '"
                            title="' . $name . '">
                            <h6>' . $name . '...</h6>
                        </a>';
            $html .= '<h4 class="text-lowercase">' . $priceAffSale .' <del>' . $price .'</del></h4></div></div>';
            if ($count == 3) $html .= '</div><div>';
        }
        $html .= '</div>';
        return $html;
    }

    // creat menu-Header -Left
    public static function createMenuLeft($name, $link)
    {
        $html = '<div class="menu-left">
                    <div class="brand-logo">
                        <a href="' . $link . '">
                            <h2 class="mb-0" style="color: #5fcbc4">' . $name . '</h2>
                        </a>
                    </div>
                </div>';
        return  $html;
    }

    // creat menu-Header - Right (Text)
    public static function createMenuRight($arr, $controller)
    {
        $active = ' class="my-menu-link active"';
        switch ($controller) {
            case 'index':
                $name = 'Trang chủ';
                break;
            case 'category':
                $name = 'Sách';
                break;
            case 'user':
                $name = 'Người dùng';
                break;
            default:
                $name = 'Trang chủ';
                break;
        }


        $html = '<div><nav id="main-nav"><div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div><ul id="main-menu" class="sm pixelstrap sm-horizontal">';
        $html .=  '<li><div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div> </li>';
        foreach ($arr as $key => $value) {
            if (isset($value['child'])) {
                $html .= '<li><a href="' . $key . '">' . $value['name'] . '</a><ul>';
                foreach ($value['child'] as $keyB => $valueB) {
                    $html .=  '<li><a href="' . $keyB . '">' . $valueB . '</a></li>';
                }
                $html .= '</ul></li>';
            } else {
                if ($value == $name) {
                    $html .= '<li><a href="' . $key . '" ' . $active . '>' . $value . '</a>';
                } else {
                    $html .= '<li><a href="' . $key . '">' . $value . '</a>';
                }
            }
        }
        $html .= '</ul></nav></div>';

        return  $html;
    }

    // creat Login-Name
    public static function createNameLogin($name)
    {
        $html = ' <div class="breadcrumb-section" style="margin-top: 106.215px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title">
                                        <h2 class="py-2">' . $name . '</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        return  $html;
    }

    // creat input - register - default
    public static function creatInputRes($name, $type, $value)
    {
        $html   = '<input type="' . $type . '" name="' . $name . '" value="' . $value . '" class="form-control">';
        return $html;
    }

    // creat div - register - default
    public static function creatInputDiv($name, $input)
    {
        $html   = '<div class="col-md-6">
                        <label for="" class="required">' . $name . '</label>
                        ' . $input . '
                    </div>';
        return $html;
    }

    // creat div - Login - default
    public static function creatInputDivLogin($name, $input)
    {
        $html   = '<div class="form-group">
                        <label for="" class="required">' . $name . '</label>
                        ' . $input . '
                    </div>';
        return $html;
    }

    // creat  right-login
    public static function createRightLogin($link)
    {
        $html   = '<div class="col-lg-6 right-login">
                        <h3>Khách hàng mới</h3>
                        <div class="theme-card authentication-right">
                            <h6 class="title-font">Đăng ký tài khoản</h6>
                            <p>Nếu bạn chưa có tài khoản , xin mời bạn nhấn vào nút đăng ký bên dưới để tham gia mua hàng tại trang web.</p>
                            <a href="' . $link . '" class="btn btn-solid">Đăng ký</a>
                        </div>
                    </div>';
        return $html;
    }

    // creat Login-Name
    public static function createNotice($error, $text, $link, $linkText)
    {
        $html = '  <section class="p-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="error-section">
                                        <h1>' . $error . '</h1>
                                        <h2>' . $text . '</h2>
                                        <a href="' . $link . '" class="btn btn-solid">' . $linkText . '</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>';
        return  $html;
    }

    // creat Collection
    public static function createCollection($img)
    {
        $html = ' <div class="collection-view">
                            <ul>
                                <li><i class="fa fa-th grid-layout-view"></i></li>
                                <li><i class="fa fa-list-ul list-layout-view"></i></li>
                            </ul>
                        </div>
                        <div class="collection-grid-view">
                            <ul>
                                <li class="my-layout-view" data-number="2">
                                    <img src="' . $img . '/icon/2.png" alt="" class="product-2-layout-view">
                                </li>
                                <li class="my-layout-view" data-number="3">
                                    <img src="' . $img . '/icon/3.png" alt="" class="product-3-layout-view">
                                </li>
                                <li class="my-layout-view active" data-number="4">
                                    <img src="' . $img . '/icon/4.png" alt="" class="product-4-layout-view">
                                </li>
                                <li class="my-layout-view" data-number="6">
                                    <img src="' . $img . '/icon/6.png" alt="" class="product-6-layout-view">
                                </li>
                            </ul>
                        </div>';
        return  $html;
    }

    // creat category
    public static function createCategory($name, $link, $id, $list = null)
    {
        $active  = 'text-dark';
        if ($list == $id) $active  = 'my-text-primary';
        $html = ' <div class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
                        <a class="' . $active . '" href="' . $link . '">' . $name . '</a>
                    </div>';
        return  $html;
    }

    // creat pagination-count
    public static function createPaginationCount($totalItemsPerPage, $totalItems, $currentPage)
    {
        $start  = $totalItemsPerPage * ($currentPage - 1) + 1;
        $end    = $totalItemsPerPage * $currentPage;
        if ($end > $totalItems) $end =  $totalItems;
        $html  = '<div class="product-search-count-bottom">
                        <h5>Showing Items ' . $start . '-' . $end . ' of ' . $totalItems . ' Result</h5>
                    </div>';
        return  $html;
    }

    // creat pagination-count
    public static function createListItem($arr,$module,$controller)
    {
        $value = $arr;
        $category_nameURL   = URL::filterURL($value['category_name']);
        $id                 = $value['id'];
        $list               = $value['category_id'];
        $name               = $value['name'];
        $nameURL            = URL::filterURL($name);
        $price              = $value['price'];
        $title              = self::formatTitle($value['description'],1000);
        $description        = $value['description_main'];
        $sale_off           = $value['sale_off'];
        $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
        $link               = URL::createLink($module, $controller, 'list', ['list' => $list, 'id' => $id], "$category_nameURL/$nameURL-$list-$id.html");
        
        $priceAffSale   = self::formatPrice(($price - ($price * $sale_off / 100)));
        $price          = self::formatPrice($price);


        $html = '<div class="col-lg-9 col-sm-12 col-xs-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> filter</span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xl-4">
                                    <div class="product-slick">
                                        <div><img src="' . $img . '" alt="" class="img-fluid w-100 blur-up lazyload image_zoom_cls-0"></div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-xl-8 rtl-text">
                                    <div class="product-right">
                                        <h2 class="mb-2">' . $name . '</h2>
                                        <h4><del>' . $price .'</del><span> -' . $sale_off . '%</span></h4>
                                        <h3>' . $priceAffSale .'</h3>
                                        <div class="product-description border-product">
                                            <h6 class="product-title">Số lượng</h6>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                                            <i class="ti-angle-left"></i>
                                                        </button>
                                                    </span>
                                                    <input type="text" name="quantity" class="form-control input-number" value="1">
                                                    <span class="input-group-prepend">
                                                        <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                                                            <i class="ti-angle-right"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-buttons">
                                            <a href="javascript:void(0)" onclick="buyProduct(\'' . ROOT_URL . '\',' . $id . ')" class="btn btn-solid ml-0"><i class="fa fa-cart-plus"></i> Chọn mua</a>
                                        </div>
                                        <div class="border-product">
                                            ' . $title . '. </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="tab-product m-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true">Mô tả sản phẩm</a>
                                                <div class="material-border"></div>
                                            </li>
                                        </ul>
                                        <div class="tab-content nav-material" id="top-tabContent">
                                            <div class="tab-pane fade show active ckeditor-content" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                                ' . $description . '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>';
        
        return $html;
    }

    // creat productBox --- relate
    public static function createproductRelate($arr,$module,$controller)
    {
        $html  = "";
        foreach ($arr as $value) {
            $category_nameURL   = URL::filterURL($value['category_name']);
            $id                 = $value['id'];
            $list               = $value['category_id'];
            $name               = self::formatTitle($value['name'],40);
            $nameURL            = URL::filterURL($name);
            $price              = $value['price'];
            $description        = self::formatTitle($value['description'],1000);
            $sale_off           = $value['sale_off'];
            $img                = Html::createImageSrc($value['picture'], $value['picture'], 'book', '252x323-');
            $link               = URL::createLink($module, $controller, 'list', ['list' => $list, 'id' => $id], "$category_nameURL/$nameURL-$list-$id.html");
            $star               = 4;
            
            $priceAffSale   = self::formatPrice(($price - ($price * $sale_off / 100)));
            $price          = self::formatPrice($price);


            $html .= ' <div class="col-xl-2 col-md-4 col-sm-6"><div class="product-box"><div class="img-wrapper">';
            $html .= '<div class="lable-block"><span class="lable4 badge badge-danger"> -' . $sale_off . '%</span></div>';
            $html .= '<div class="front"><a href="' . $link . '"><img src="' . $img . '" class="img-fluid blur-up lazyload bg-img" alt="product"></a></div>';
            $html .= ' <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" onclick="buyProduct(\'' . ROOT_URL . '\',' . $id . ')" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                            <a href="javascript:void(0)" onclick="viewModal(\'' . ROOT_URL . '\',' . $id . ')" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
                        </div></div><div class="product-detail"><div class="rating">';
            $x = 0;
            for ($x = 0; $x <= $star; $x++) {
                $html .=  '<i class="fa fa-star"></i>';
            }
            $html .= '</div>';
            $html .= '<a href="' . $link . '"
                            title="' . $name . '">
                            <h6>' . $name . '...</h6>
                        </a>';
            $html .= '<h4 class="text-lowercase">' . $priceAffSale .' <del>' . $price .'</del></h4></div></div></div>';
        }
        return $html;
    }

    // creat danh mục nổi bật
    public static function createCategoryTitle($id, $name, $x)
    {
        if ($x == 0) {
            $html = '<li class="current"><a href="tab-category-' . $id . '" class="my-product-tab" data-category="' . $id . '">' . $name . '</a></li>';
        } else {
            $html = '<li><a href="tab-category-' . $id . '" class="my-product-tab" data-category="' . $id . '">' . $name . '</a></li>';
        }

        return $html;
    }
    // cart - header
    public static function createCart($link, $src, $quantify)
    {
        $html = '<li class="onhover-div mobile-cart">
                        <div>
                            <a href="' . $link . '" id="cart" class="position-relative">
                                <img src="' . $src . '/cart.png" class="img-fluid blur-up lazyload" alt="cart">
                                <i class="ti-shopping-cart"></i>
                                <span class="badge badge-warning">' . $quantify . '</span>
                            </a>
                        </div>
                    </li>';

        return $html;
    }

    // creat productBox --- forcart
    public static function createproductCart($name, $sale, $link, $src, $price, $id, $quantify)
    {
        $priceAffSalel      =   ($price - ($price * $sale / 100));
        $priceAffSale       =   number_format($price - ($price * $sale / 100));
        $totalPrice         =   number_format($priceAffSalel * $quantify);
        $totalPriceN        =  ($priceAffSalel * $quantify);
        $price              =   number_format($price);


        $html = '<tr id="' . $id . '">
                        <td>
                            <a href="' . $link . '"><img src="' . $src . '" alt="' . $name . '"></a>
                        </td>
                        <td><a href="' . $link . '">' . $name . '</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" name="quantify" value="' . $quantify . '" class="form-control input-number" id="quantity-' . $id . '" min="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color text-lowercase">' . $priceAffSale .'</h2>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color text-lowercase">
                                        <a href="javascript:deleteProduct(' . $id . ');" class="icon"><i class="ti-close"></i></a>
                                    </h2>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h2 class="text-lowercase price-single" value="' . $priceAffSalel . '">' . $priceAffSale . '</h2>
                        </td>
                        <td>
                            <div class="qty-box">
                                <div class="input-group">
                                    <input type="number" name="quantify" value="' . $quantify . '" class="form-control input-number" id="' . $id . '" min="1">
                                </div>
                            </div>
                        </td>
                        <td><a href="javascript:deleteProduct(' . $id . ');" class="icon"><i class="ti-close"></i></a></td>
                        <td>
                            <h2 class="td-color text-lowercase sumPrice">' . $totalPrice . '</h2>
                        </td>
                    </tr>';

        return $html;
    }

    public static function sumCart($name, $price, $value)
    {
        $html = '<table class="table cart-table table-responsive-md">
                        <tfoot>
                            <tr>
                                <td>' . $name . ' :</td>
                                <td>
                                    <h2 class="text-lowercase sumcart" value="' . $value . '">' . $price .'</h2>
                                </td>
                            </tr>
                        </tfoot>
                    </table>';
        return $html;
    }

    // sort - fillter
    public static function sort($name, $id, $arr, $keySlect = 'default')
    {

        $html = '<div class="product-page-filter">
                        <form action="" id="sort-form" method="GET">
                            <select id="' . $id . '" name="' . $name . '">';
        foreach ($arr as $key => $value) {
            if ($key == $keySlect) {
                $html .= '<option value="' . $key . '" selected>' . $value . '</option>';
            } else {
                $html .= '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $html .=            '</select>
                        </form>
                    </div>';
        return $html;
    }

    // creat createLiCart
    public static function createLiCart($action, $arr)
    {
        if (!empty($arr)) {
            $html = '<div class="dashboard-left"><div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> Ẩn</span></div>';
            $html .= '<div class="block-content"><ul>';
            foreach ($arr as $key => $value) {
                $class = '';
                if ($action == $value['nameShow']) $class = "active";
                $html .= '<li class="' . $class . '"><a href="' . $value['link'] . '">' . $key . '</a></li>';
            }
            $html .= '</ul></div></div>';
        }
        return  $html;
    }

    // creat form-group
    public static function createFormGroup($lableName, $name, $value, $id = null)
    {
        $readonly = "";
        if ($name == 'email') $readonly = 'readonly="1"';
        $html = '<div class="form-group">
                    <label for="' . $name . '">' . $lableName . '</label>
                    <input type="text" name="form[' . $name . ']" value="' . $value . '" class="form-control"
                        id="' . $id . '" ' . $readonly . '>
                </div>';
        return $html;
    }

    // creat for footer
    public static function createTitleForFooter($name,$title)
    {
       $html = '<div class="col-lg-4 col-md-6">
                    <div class="footer-title footer-mobile-title">
                        <h4>Giới thiệu</h4>
                    </div>
                    <div class="footer-contant">
                        <div class="footer-logo">
                            <h2 style="color: #5fcbc4">'.$name.'</h2>
                        </div>
                        <p>'.$title.'</p>
                    </div>
                </div>';
        return $html;
    }

    // creat for footer
    public static function createlistForFooter($name,$arr,$class = null)
    {
       $html = '<div class="sub-title"><div class="footer-title"><h4>'.$name.'</h4></div><div class="footer-contant"><ul>';
        foreach($arr AS $key => $value){ $html .= '<li><a href="'.$key.'">'.$value.'</a></li>';}
        $html .= '</ul></div></div>';
        return $html;
    }

    // creat phonering
    public static function createPhonering($number)
    {
        $html = '<div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon">
                        <div class="phonering-alo-ph-circle"></div>
                        <div class="phonering-alo-ph-circle-fill"></div>
                        <a href="tel:'.$number.'" class="pps-btn-img" title="Liên hệ">
                            <div class="phonering-alo-ph-img-circle"></div>
                        </a>
                    </div>';

        return $html;
    }

    public static function formatPrice($price,$prefix = "đ"){
        return number_format($price,0,'.',',') . " " . $prefix;
    }

    public static function formatTitle($title,$legth,$prefix = "..."){
        $prefix = ($legth == 0) ? '' : $prefix;
        $title  = str_replace(['<p>','</p>'],'',$title);
        return preg_replace('/\s+?(\S+)?$/','',substr($title,0,$legth)) . $prefix;
    }

}
