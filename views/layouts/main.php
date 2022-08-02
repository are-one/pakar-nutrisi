<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$route = Yii::$app->requestedRoute;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

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

    <?= $this->render('top-nav') ?>

    <?php if (!in_array($route, ['site/index', ''])) :    ?>
        <main id="main">
            <!-- ======= Breadcrumbs Section ======= -->
            <section class="breadcrumbs">
                <div class="container">

                    <div class="d-flex justify-content-between align-items-center">
                        <h2><?= $this->title ?></h2>
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => [
                                'class' => false,
                            ],
                            'tag' => 'ol'
                        ]) ?>
                    </div>

                </div>
            </section>
            <!-- End Breadcrumbs Section -->
        <?php endif; ?>

        <?= Alert::widget() ?>
        <?= $content ?>

        <?php if (!in_array($route, ['site/index', ''])) :    ?>
        </main>
    <?php endif; ?>

    <?= $this->render('footer') ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>