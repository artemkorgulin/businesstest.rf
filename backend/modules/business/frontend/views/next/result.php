<?php
use yii\helpers\Html;
    $printButton = false;
    $this->title = 'Тестирование "Склонности к предпринимательской деятельности" - результаты теста | Университет СИНЕРГИЯ';
?>
<div class="container">
    <div class="resultPage-success">


    <?php if ($region): ?>
        <h1 class="result-h1">Результаты тестирования &laquo;Склонности к предпринимательской деятельности&raquo;</h1>

        <p>Спасибо за прохождение тестирования!</p>
        <p>Как участнику проекта Вам будет предоставлен годовой доступ к нашей Базе знаний – золотой коллекции вебинаров и выступлений мировых спикеров. Ссылка на активацию доступа к Базе знаний поступит Вам на электронную почту.</p>
        <p>Ваша работа будет обработана в Центре профессионального тестирования Университета Синергия.</p>
        <p>В течение недели с вами свяжется специалист и пригласит на вручение именного сертификата и результатов тестирования по предпринимательству.</p>
        <p>Уверены, что будущее страны в ваших руках, а будущие предприниматели станут одним из главных драйверов развития российской экономики.</p></div>

    <?php else: echo $this->render('@common/modules/business/backend/views/result/_pupil', [
        'model' => $model
    ]);
    $printButton = true;
    ?>

    <?php endif ?>

    <hr/>
    <?php

    if ($printButton) echo Html::a('Распечатать результат', ['/site/result', 'id' => Yii::$app->user->id, 'token' => Yii::$app->user->identity->token_btest], ['class' => 'btn btn-success btn-lg pull-left', 'style' => 'margin-right: 20px;']);

    echo Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton(
        'Завершить тестирование и выйти',
        ['class' => 'btn btn-danger btn-lg']
    )
    . Html::endForm();


?>
    <div style="height: 50px;">&nbsp;</div>
    </div>
</div>




