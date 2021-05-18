<?php


$this->title = 'Каталог';
?>

<div class="banner">
  <div class="banner__info">
  <div class="banner__text">
    <h3>НОВЫЕ ПОСТУПЛЕНИЯ ТОВАРА!</h3>
  </div>
  <div class="banner__content">
    <a href="#">Посмотреть</a>
  </div>
  </div>
  <div class="banner__image">
    <img src="/web/images/banner-pic.png" alt="">
  </div>
</div>

<div class="catalog">
  <input type="radio" id="all" name="color" />
      <label for="all">Все товары</label>
      <input type="radio" id="status-2" name="color" />
      <label for="status-2">Акции</label>
      <input type="radio" id="status-3" name="color" />
      <label for="status-3">Популярное</label>
      <input type="radio" id="status-1" name="color" />
      <label for="status-1">Новое</label>
      <!-- товары -->
      <?php foreach ($stuff as $item){
        echo '<div class="catalog__item status-'.$item->status_id.'">
              <img src="/web/'.$item->img_before.'" />
              <h4>'.$item->name.'</h4>
              <p class="catalog__info">
                '.$item->description.'
              </p>
            </div>';
      } ?>

        <!-- <img src="/web/images/pic1.png" />
        <h4>Brawl stars</h4>
        <p class="catalog__info">
          Модная детская футболка. 100% хлопок.
        </p>
      </div> -->

</div>


<!-- Футболка для беременных "Папа, спаси

Оригинальная футболка для беременных с тонким юмором. Высокое качество материала – 100% хлопок – обеспечивает сохранение формы и насыщенности цвета ...
 -->
