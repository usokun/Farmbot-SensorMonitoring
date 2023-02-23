<?php
use yii\helpers\Html;
?>
<nav class="navbar navbar-transparent navbar-expand-lg navbar-absolute fixed-top" role="navigation-demo">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#"><?=$this->title;?></a>
        </div>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            Account
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="#">Profile</a>
                        <div class="dropdown-divider"></div>
                        <?=
                            Yii::$app->user->isGuest ? 
                                Html::a(
                                    'Log in',
                                    ['/site/login'],
                                    ['class'=>'dropdown-item']
                                ) : 
                                Html::a(
                                    'Log out ('.Yii::$app->user->identity->username.')',
                                    ['/site/logout'],
                                    ['class'=>'dropdown-item','data-method'=>'post']
                                );
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.container-->
</nav>