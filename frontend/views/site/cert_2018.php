<?php $imageUrl = Yii::getAlias('@webroot') . '/img/bg-sert.png'; ?>
<div style="font-family: 'ProximaNova', sans-serif;
        margin: 0 auto;
        color:#000;
        width: 100%;
        height: 100%;
        background-image: url(<?php echo $imageUrl; ?>);
        background-size:contain;
        background-repeat:no-repeat;">
    <div style="padding-left: 80px;
    padding-right: 80px;
    width: 90%;
    padding-top:110px;
    display: inline-block;
    font-size: 10px;
    line-height: 0.8;
    font-style: normal;
    font-weight: normal;
    visibility: visible;
    color: #5a5959">
        <div style="text-align: left;">
            <p>Негосударственное образовательное учреждение высшего </p>
            <p>профессионального образования Московский финансово- </p>
            <p>промышленный университет «Синергия» (Университет </p>
            <p>«Синергия») </p>
        </div>
        <div style="
        margin-top: -70px;
        margin-left: 630px;">
            <p>Лицензия на осуществление образовательной деятельности</p>
            <p>серия 90Л01 №0008924 выдана 28 января 2016 года, рег. №1900</p>
            <p>Свидетельство о государственной аккредитации </p>
            <p>серия 90А01 №0002733, от 31 мая 2017 года, рег. №2605</p>
        </div>
        <div style="padding-top:200px;
        clear:both;
        font-size: 20px;
        color: rgb(33, 49, 125);">
            <p>№ <?= $model->user_id ?></p>
            <?php
            $result_date = (is_object($model->result)) ? $model->result->created_at: $model->user->created_at;
            ?>
            <p style="text-align: right; padding-top: -40px;">от <?= date('d.m.Y', $result_date); ?>
                г.</p>
        </div>
        <p style="text-align: center;
                display: block;
                clear:both;
                font-size: 20px;
                color: rgb(33, 49, 125);">Удостоверяет, что</p>
        <p style="
                text-align: center;
                display: block;
                clear:both;
                font-weight: bold;
                font-size: 24px;
                color: rgb(33, 49, 125);
"> <?= $model->name_l . ' '; ?><?= $model->name_f . ' '; ?><?= $model->name_m . ' '; ?></p>
        <div style="text-align: center;
                display: block;
                font-size: 1.3em;
                font-weight: bold;
                color: rgb(33, 49, 125);">
            <p>ученик (-ца) <span style="font-weight: bold;"><?php echo $model->class_id; ?>
                    класса</span> <?php echo $model->school->name; ?>,</p>
            <p> прошел (ла) тестирование по программе</p>
            <p> «ПРЕДПРИНИМАТЕЛЬСТВО»</p>
        </div>
    </div>

</div>
