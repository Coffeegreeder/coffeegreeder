<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>

<body>
  <?php $this->beginBody() ?>
  <nav class="header">
    <a href="/site/index">
      <img src="/web/images/logo.svg" alt="Coffeegreeder" width="64px">
    </a>
    <div class="header__navigation">
      <a href="/site/index" class="btn btn-link logout">
        главная
      </a>
      <?php if(Yii::$app->user->isGuest){
        echo '<a href="/site/login">
          авторизация
        </a>';
      } else {
        echo Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Выход',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm();
      } ?>

    </div>
  </nav>
  <div class="container">
    <div class="row">
      <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
      <div class="main">
        <div class="main__content">
          <?= $content ?>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="logo">
      <a href="index">
        <img src="/web/images/logo.svg" alt="Coffeegreeder" width="64px">
      </a>
    </div>
    <div class="social-links">
      <h4>СОЦИАЛЬНЫЕ СЕТИ</h4>
      <ul>
        <a href="#">
          <li>VK</li>
        </a>
        <a href="#">
          <li>instagram</li>
        </a>
        <a href="#">
          <li>twitter</li>
        </a>
      </ul>
    </div>
    <div class="navigation">
      <h4>ИНФОРМАЦИЯ О КОМПАНИИ</h4>
      <ul>
        <a href="#">
          <li>партнёрство</li>
        </a>
        <a href="#">
          <li>информация</li>
        </a>
        <a href="#">
          <li>о нас</li>
        </a>
        <a href="#">
          <li>политика конфиденциальности</li>
        </a>
      </ul>
    </div>
    <div class="navigation">
      <h4>ПОМОЩЬ И ПОДДЕРЖКА</h4>
      <ul>
        <a href="#">
          <li>Правила заполнения заявки</li>
        </a>
        <a href="#">
          <li>О запросах</li>
        </a>
        <a href="#">
          <li>справка</li>
        </a>
      </ul>
    </div>
  </footer>

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
