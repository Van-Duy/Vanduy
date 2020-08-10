<?php require_once 'header-footer/header.php' ?>
<?php require_once 'menu/menu.php'?>

  <div class="content-wrapper">
   
    
    <?php 
    require_once APPLICATION_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
    echo '<pre>';
    print_r($this);
    echo '</pre>';
    ?>
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once 'header-footer/footer.php' ?>