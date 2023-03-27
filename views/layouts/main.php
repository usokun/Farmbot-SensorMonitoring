<?php

use yii\helpers\Html;
use deyraka\materialdashboard\web\MaterialDashboardAsset;
use yii\web\View;
use app\assets\AppAsset;
use yii\bootstrap4\BootstrapPluginAsset;


/* @var $this View */
/* @var $content string */

AppAsset::register($this);
BootstrapPluginAsset::register($this);

if (class_exists('deyraka\materialdashboard\web\MaterialDashboardAsset')) {
    deyraka\materialdashboard\web\MaterialDashboardAsset::register($this);
};

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/deyraka/yii2-material-dashboard/assets/');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700&display=swap"/> -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <!-- FOR CHART -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>



    <?php $this->registerCsrfMetaTags() ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
    <script src="js/cardchart.js"></script>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <div class="main-panel">
            <?= $this->render('header', ['directoryAsset' => $directoryAsset, 'title' => $this->title]) ?>
            <?= $this->render('content', ['directoryAsset' => $directoryAsset, 'content' => $content]) ?>
            <?= $this->render('footer') ?>
            <?= $this->render('data-list-menu') ?>

        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>