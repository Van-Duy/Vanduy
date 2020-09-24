<?php 
    $html = "";
    if(!empty($this->slider)){
        foreach($this->slider AS $value){
            $id                 = $value['id'];
            $name               = HtmlFront::formatTitle($value['name'],40);
            $img                = Html::createImageSrc($value['thumb'], $value['thumb'], 'slider', '');
            $html .= sprintf('<div>
                                    <a href="" class="home text-center">
                                        <img src="%s" alt="" class="bg-img blur-up lazyload">
                                    </a>
                                </div>', $img);
        }
    }
  ?>
  <!-- Home slider -->
  <section class="p-0 my-home-slider">
      <div class="slide-1 home-slider">
         <?php echo $html; ?>
      </div>
  </section>
  <!-- Home slider end -->