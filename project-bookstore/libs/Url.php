<?php 
class URL{
    public static function creatLink($module,$controller,$action,$arr = null){
        if(!empty($arr)){
            foreach($arr AS $key => $value){
               $html .= "&$key=$value";
            }
        }

        $url = 'index.php?module='.$module.'&controller='.$controller.'&action='.$action.''.$html.'';
        return $url;
    }

    public static function redirect($module,$controller,$action,$arr = null){
        $link = self::creatLink($module,$controller,$action,$arr);
        header('location: ' . $link);
        exit();
    }
}


?>