<?php 

    class Helper{


        // creat button
        public static function cmsButtonHeader($name,$value,$number = null){
            $class = ($name == 'All') ? 'info' : 'secondary';
            $html = '<a href="javascript:changeFillHeader(\''.$value.'\')" data="data-'.$value.'" name="statusAll" class="mr-1 btn btn-sm btn-'. $class.'">'.$name.' <span class="badge badge-pill badge-light">'.$number.'</span></a>';
            return $html;
        }


        // creat status
        public static function creatStatus($name,$class,$arrParam,$keySelect = 2,$with = null,$id = null,$data= null){
            $html = '<select style="'.$with.'" name="'.$name.'" class="'.$class.'" id="'.$id.'" data="'.$data.'">';
                if(isset($arrParam) && $arrParam != 'default'){
                    foreach($arrParam AS $key => $value){
                        if($key == $keySelect && is_numeric($keySelect)){
                             $html .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
                        }else{
                            $html .= '<option value="'.$key.'">'.$value.'</option>';
                        }
                    }
                }else{
                    $html .= '<option value="">- Select Status -</option>';
                }
            $html .= '</select>';
            return $html;
        }

        //create a ( save - close)
        public static function cmsButtonSave($name,$class,$link,$submit = "new"){
            if($submit == 'new'){
                 $html = '<a href="'.$link.'" class="btn btn-sm '.$class.' mr-1">'.$name.'</a>';
            }else if($submit == 'submit'){
                $html = '<a href="javascript:submitForm(\''.$link.'\');" class="btn btn-sm '.$class.' mr-1">'.$name.'</a>';
            }
           
            return $html;
        }

        //create input (form)
        public static function cmsInput($name,$type,$class,$value = null){
            $html = '<input type="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$value.'" class="form-control form-control-sm" '.$class.'>';
            return $html;
        }


        //create (div in form)
        public static function cmsDiv($name,$input,$flag = false){
            $required = "";
            if($flag == true) $required = 'required';
            $html = '<div class="form-group row">';
            $html .= '<label for="'.$name.'" class="col-sm-2 col-form-label text-sm-right '.$required.'">'.ucfirst($name).'</label>';
            $html .= '<div class="col-xs-12 col-sm-8">';
            $html .= $input;
            $html .= '</div></div>';
            return $html;
        }

        // creat fill group
        public static function creatFill($name,$colum,$columPost,$oderPost){
            $img    = "";
            $order  = ($oderPost == 'desc') ? 'asc' : 'desc';
            if($colum == $columPost){
                $img = '<img src="'.TEMPLATE_URL.'admin/main/images/sort_'.$oderPost.'.png" alt="image">';
            }
            $html = '<th class="text-center"><a href="javascript:sortList(\''.$colum.'\',\''.$order.'\')">'.$name.' '.$img.' </a></th>';
            return $html;
        }

       






    }

 




?>