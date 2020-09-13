<!DOCTYPE html>
<html>

<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <?php echo $this->_title; ?>
    <?php echo $this->_cssFiles; ?>

</head>
<body>
    <!--header-->
    <?php require_once 'html/header.php' ?>
    <!--content-->
    <?php
    require_once  APPLICATION_PATH . 'module' . DS . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
    ?>
    <?php require_once 'html/footer.php' ?>
    <?php echo $this->_jsFiles; ?>
    <script>
        <?php 
              $message  = Session::get('message');
              if(isset($message)){
                 echo "toastr.".$message['class']."('".$message['content']."', 'Thực hiện!')";
              }
              Session::delete('message');
        ?>
    </script>
</body>

</html>