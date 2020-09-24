<?php
class Html
{
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
    //                      backend 
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//


    // creat ALL
    public static function showFillterButton($module, $controller, $arr, $status)
    {
        $html = "";
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                $link = $key;
                switch ($key) {
                    case 'all':
                        $name = "All";
                        break;
                    case 'active':
                        $name = "Active";
                        break;
                    case 'inactive':
                        $name = "Inactive";
                        break;
                }
                $class = ($status == $key) ? "info" : "secondary";
                $html .= '<a href="#" data="'.$link.'" class="fillStatus mr-1 btn btn-sm btn-' . $class . '">' . $name . '<span class="badge badge-pill badge-light">' . $value . '</span></a>';
            }
        }
        return $html;
    }

    // creat ALL
    public static function createSidebar($controller, $action, $arr)
    {
        $action     = $action;
        $controller = ucfirst($controller);
        $parent     = $arr['parent'];
        $child      = $arr['child'];

        if (isset($child)) {
            if ($controller == $parent['name']) {
                $openMenu = 'has-treeview menu-open';
                $activeP = 'active';
            }
            $html = '   <li class="nav-item ' . $openMenu . '"> 
                            <a href="' . $parent['link'] . '" class="nav-link ' . $activeP . '">
                                <i class="nav-icon fas fa-' . $parent['icon'] . '"></i>
                                <p>' . $parent['name'] . '<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">';
            $action = ($action == 'Index') ? 'List' : $action;

            foreach ($child as $key => $value) {
                $active = "";
                if ($controller == $parent['name'] && $action == $value['nameShow']) $active = 'active';
                $html .=    '<li class="nav-item">
                                <a href="' . $value['link'] . '" class="nav-link ' . $active . '" >
                                    <i class="nav-icon fas fa-' . $value['icon'] . '"></i>
                                    <p>' . $value['name'] . '</p>
                                </a>
                            </li>';
            }
            $html .= '</ul></li>';
        } else {
            if ($controller == $parent['name']) {
                $activeP = 'active';
            }
            $html = '   <li class="nav-item "> 
                            <a href="' . $parent['link'] . '" class="nav-link ' . $activeP . '">
                                <i class="nav-icon fas fa-' . $parent['icon'] . '"></i>
                                <p>' . $parent['name'] . '</p>
                            </a>
                        </li>';
        }
        return $html;
    }


    //create a ( save - close)
    public static function cmsButtonSave($name, $class, $link, $submit = "new")
    {
        if ($submit == 'new') {
            $html = '<a href="' . $link . '" class="btn btn-sm ' . $class . ' mr-1">' . $name . '</a>';
        } else if ($submit == 'submit') {
            $html = '<a href="javascript:submitForm(\'' . $link . '\');" class="btn btn-sm ' . $class . ' mr-1">' . $name . '</a>';
        }

        return $html;
    }

    //create input (form)
    public static function cmsInput($name, $type, $class, $value = null, $id = "")
    {
        $html = '<input type="' . $type . '" id="' . $name . '-' . $id . '" name="' . $name . '" value="' . $value . '" class="form-control form-control-sm" ' . $class . '>';
        return $html;
    }

    //create (div in form)
    public static function cmsDiv($name, $input, $flag = false)
    {
        $required = "";
        if ($flag == true) $required = 'required';
        $html = '<div class="form-group row">';
        $html .= '<label for="' . $name . '" class="col-sm-2 col-form-label text-sm-right ' . $required . '">' . ucfirst($name) . '</label>';
        $html .= '<div class="col-xs-12 col-sm-8">';
        $html .= $input;
        $html .= '</div></div>';
        return $html;
    }

    // creat number
    public static function creatStatusNumber($name, $class, $arrParam, $keySelect = 2, $with = null, $id = null, $data = null)
    {
        $html = '<select style="' . $with . '" name="' . $name . '" class="' . $class . '" id="' . $id . '" data="' . $data . '">';
        if (isset($arrParam) && $arrParam != 'default') {
            foreach ($arrParam as $key => $value) {
                if ($key == $keySelect && is_numeric($keySelect)) {
                    $html .= '<option selected="selected" value="' . $key . '">' . $value . '</option>';
                } else {
                    $html .= '<option value="' . $key . '">' . $value . '</option>';
                }
            }
        } else {
            $html .= '<option value="">- Select Status -</option>';
        }
        $html .= '</select>';
        return $html;
    }

    //create (div in form)
    public static function inputHidden($name, $value)
    {
        $html = '<input type="hidden" class="form-control form-control-sm" name="' . $name . '" value="' . $value . '">';
        return $html;
    }

    // creat fill group
    public static function creatFill($name, $colum, $columPost, $oderPost)
    {
        $img    = "";
        $order  = ($oderPost == 'desc') ? 'asc' : 'desc';
        if ($colum == $columPost) {
            $img = '<img src="' . TEMPLATE_URL . 'admin/adminlte/images/sort_' . $oderPost . '.png" alt="image">';
        }
        $html = '<th class="text-center"><a href="javascript:sortList(\'' . $colum . '\',\'' . $order . '\')">' . $name . ' ' . $img . ' </a></th>';
        return $html;
    }

    // creat li - default
    public static function creatLiDefault($name, $class, $link, $controller)
    {
        $nameA = ($name == 'Home') ? 'Index' : $name;
        $nameA = ($name == 'History') ? 'User' : $nameA;
        $active = (ucfirst($controller) == $nameA) ? 'active grid' : '';
        $html   = '<li class="' . $active . '"><a class="' . $class . '" href="' . $link . '">' . $name . '</a></li>';
        return $html;
    }

    // creat input - register - default
    public static function creatInputResDefault($name, $type, $value)
    {
        $html   = '<input type="' . $type . '" name="' . $name . '" value="' . $value . '" >';
        return $html;
    }

    // creat div - register - default
    public static function creatInputDivDefault($name, $input)
    {
        $html   = '<div><span>' . $name . '</span>' . $input . '</div>';
        return $html;
    }

    // creat input - dashboar
    public static function creatInputDas($name, $link, $icon, $member)
    {
        $html    = ' <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner">';
        $html   .= '<h3>' . $member . '</h3>';
        $html   .= '<p>' . $name . '</p></div>';
        $html   .= '<div class="icon text-white"><i class="ion ion-' . $icon . '"></i></div>';
        $html   .= '<a href="' . $link . '" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>';
        $html   .= '</div></div>';
        return $html;
    }

    //show action
    public static function showActionButton($moduleName, $controllerName, $id)
    {
        $templateButton = [
            'view'              => ['class' => 'btn-primary',   'icon' => 'eye',        'text' => 'View',           'link' => URL::createLink($moduleName, $controllerName, 'detail', ['id' => $id])],
            'edit'              => ['class' => 'btn-info',      'icon' => 'pencil-alt', 'text' => 'Edit',           'link' => URL::createLink($moduleName, $controllerName, 'form', ['id' => $id])],
            'delete'            => ['class' => 'btn-danger btn-delete-item',    'icon' => 'trash-alt',  'text' => 'Delete',         'link' => URL::createLink($moduleName, $controllerName, 'delete', ['id' => $id])],
            'reset-password'    => ['class' => 'btn-secondary', 'icon' => 'key',        'text' => 'Reset Password', 'link' => URL::createLink($moduleName, $controllerName, 'resetPassword', ['id' => $id])]
        ];

        $buttonInArea = [
            'default' => ['edit', 'delete'],
            'group' => ['edit', 'delete'],
            'user' => ['reset-password', 'edit', 'delete'],
            'cart' => ['view'],
        ];

        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : 'default';
        $listButton = $buttonInArea[$controllerName];

        $xhtml = '';

        foreach ($listButton as $btn) {
            $currentButton = $templateButton[$btn];
            $xhtml .= sprintf('
            <a href="%s" class="rounded-circle btn btn-sm %s" title="%s" data-toggle="tooltip">
                <i class="fas fa-%s"></i>
            </a>
            ', $currentButton['link'], $currentButton['class'], $currentButton['text'], $currentButton['icon']);
        }

        return $xhtml;
    }


    // createImage
    public static function createImage($value, $namePicture, $file, $moreName = "", $arr = null)
    {
        if (!empty($arr)) {
            $str = '';
            foreach ($arr as $key => $value) {
                $str .= $key . ':' . $value . 'px;';
            }
        }
        if ($namePicture != null) {
            $srcP                       = UPLOAD_URL . $file . DS . $moreName . $namePicture;
            $pictureSingle              = '<img class="img-responsive" src="' . $srcP . '" alt="' . $namePicture . '" style="' . $str . '0">';
        } else {
            $srcP                       = UPLOAD_URL . $file . DS . "" . 'default.jpg';
            $pictureSingle              = '<img  class="img-responsive" src="' . $srcP . '" alt="' . $namePicture . '" style="max-width: 60px;max-height: 60px;">';
        }
        return $pictureSingle;
    }

    // createImage - src
    public static function createImageSrc($value, $namePicture, $file, $moreName = "", $arr = null)
    {
        if ($namePicture != null) {
            $srcP                       = UPLOAD_URL . $file . DS . $moreName . $namePicture;
        } else {
            $srcP                       = UPLOAD_URL . $file . DS . "" . 'default.jpg';
        }
        return $srcP;
    }

    // create - button -action
    public static function createButtonAction($arr)
    {
        $html = "";
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                switch ($key) {
                    case 'changePass':
                        $color = "default";
                        $icon = "key";
                        break;
                    case 'edit':
                        $color = "info";
                        $icon = "pencil-alt";
                        break;
                    case 'delete':
                        $color = "danger";
                        $icon = "trash-alt";
                        break;
                    case 'view':
                        $color = "primary";
                        $icon = "eye";
                        break;
                    default:
                        $color = "";
                        $icon = "";
                        break;
                }
                $html .= '<a href="' . $value . '" class="rounded-circle btn btn-sm btn-' . $color . '" title="' . $key . '">
                        <i class="fas fa-' . $icon . '"></i>
                    </a> ';
            }
        }
        return $html;
    }

    

   














}
