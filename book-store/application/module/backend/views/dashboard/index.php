<?php 
$moduleName = $this->arrParam['module'];
$linkGroup          = URL::createLink($moduleName,'group','index');
$linkUser           = URL::createLink($moduleName,'user','index');
$linkCategory       = URL::createLink($moduleName,'category','index');
$linkBook           = URL::createLink($moduleName,'book','index');
$linkCart           = URL::createLink($moduleName,'cart','index');

$listSmallBox = [
    Html::creatInputDas('Group',$linkGroup,'ios-people',$this->countGroup),
    Html::creatInputDas('User',$linkUser,'ios-person',$this->countUser),
    Html::creatInputDas('Category',$linkCategory,'clipboard',$this->countCategory),
    Html::creatInputDas('Book',$linkBook,'ios-book',$this->countBook),
    Html::creatInputDas('Cart',$linkCart,'ios-cart',$this->countCart)
];

$xhtmlSmallBox = '';

foreach ($listSmallBox as $box) {
    $xhtmlSmallBox .=  $box ;
}

?>
<div class="row justify-content-center">
   <?php echo $xhtmlSmallBox; ?>
</div>


