<?php if ($isMoscowRegion) {
    $imageUrl = '';
} else {
    $imageUrl = Yii::getAlias('@webroot') . '/img/sert.jpg';
}
?>
<div style="margin: 0 auto;
        color:#000;
        width: 100%;
        height: 100%;
        background-image: url(<?php echo $imageUrl;?>);
        background-size:contain;
        background-repeat:no-repeat;
        ">
    <div style="
    padding-left: 80px;
    padding-right: 80px;
    width: 80%;
    padding-top:560px;
    display: inline-block;
">
        <p style="
                text-align: center;
                display: block;
                clear:both;
                font-weight: bold;
                font-size: 26px;
                font-family: 'Times New Roman', sans-serif;
"> <?= $model->name_l . ' '; ?><?= $model->name_f . ' '; ?><?= $model->name_m . ' '; ?></p>
        <p style="
                text-align: center;
                display: block;
                font-size: 1.3em;
">ученик (-ца) <span style="font-weight: bold;"><?php echo $model->class_id; ?>
                класса</span> <?php echo $model->school->name; ?>,</p>
        <p style="
                text-align: center;
                display: block;
                font-size: 1.3em;
"> участник(-ца) тестирования на тему</p>
        <p style="
                text-align: center;
                display: block;
                font-size: 1.3em;
                font-weight: bold;
"> «Предпринимательство».</p>
        <p style="
                padding-top: 170px;
                display: block;
                font-size: .9em;
                padding-left: 50px;
">Ректор университета «Синергия»</p>
        <p style="
                padding-top: -10px;
                padding-left: 50px;
                display: block;
                font-size: .9em;
">Ю. Б. Рубин</p>
        <p style="
                padding-left: 50px;
                padding-top: 50px;
                display: block;
                font-size: .9em;
">Дата выдачи <?php echo date('d.m.Y', $model->result->created_at); ?></p>
    </div>

</div>
