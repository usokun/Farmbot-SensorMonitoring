<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>

<?php
    NavBar::begin(['brandLabel' => 'NavBar Test']);
    echo Nav::widget([
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
        ],
        'options' => ['class' => 'navbar-nav'],
    ]);
    NavBar::end();

?>