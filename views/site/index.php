<?php
use yii\widgets\Pjax;

$this->title = 'Каталог';
?>

<div class="side-bar">
  <div class="side-bar__search-form">
    <input type="text" name="search" value="" placeholder="search">
  </div>
  <div class="side-bar__counter">
    <p>Количество решённых задач: </p>
    <?php Pjax::begin([
    'timeout' => 5000,
    'enablePushState' => false,
]);?>
      <?= $this->render('_counter', ['counter' => $counter]); ?>
    <?php Pjax::end(); ?>
  </div>
</div>
<div class="main__content">
<div class="banner">
  <div class="banner__info">
    <div class="banner__text">
      <h3><b>ВСЯКИЕ ЗАПРОСЫ</b></h3>
    </div>
    <div class="banner__content">
      <a href="/web/site/create">Добавить</a>
    </div>
  </div>
  <div class="banner__image">
    <img src="/web/images/banner-pic.png" alt="">
  </div>
</div>
<div class="board">
  <input type="radio" id="all" name="color" />
  <label for="all">Все заявки</label>
  <input type="radio" id="category-2" name="color" />
  <label for="category-2">решённые</label>
  <input type="radio" id="category-3" name="color" />
  <label for="category-3">отклонённые</label>
  <input type="radio" id="category-1" name="color" />
  <label for="category-1">новые</label>
  <!-- товары -->
  <?php foreach ($requests as $request){
        if ($request->category_id == 2){
          echo '<div class="board__item category-'.$request->category_id.'">
                <img src="/web/'.$request->img_after.'" />
                <h4>'.$request->name.'</h4>
                <h4><b> Вопрос решён </b></h4>
                <p class="board__info">
                  '.$request->description.'
                </p>
              </div>';
        } elseif ($request->category_id == 3) {
          echo '<div class="board__item category-'.$request->category_id.'">
                <img src="/web/'.$request->img_before.'" />
                <h4>'.$request->name.'</h4>
                <h4><b> Причина отклонения: </b></h4>
                <p class="board__info">
                  '.$request->reason.'
                </p>
              </div>';
        } else {
          echo '<div class="board__item category-'.$request->category_id.'">
                <img src="/web/'.$request->img_before.'" />
                <h4>'.$request->name.'</h4>
                <p class="board__info">
                  '.$request->description.'
                </p>
              </div>';
        }

      } ?>
</div>
</div>
<?php $this->registerJs(<<<JS
function updateList() {
  $.pjax.reload({container: '#counter'});
}
setInterval(updateList, 4000);
JS
) ?>
