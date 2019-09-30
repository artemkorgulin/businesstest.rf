


<div style="max-width: 990px; margin: 0 auto">

<h1 style="font-size: 2.4em!important;">Результаты тестирования<br/>&laquo;Склонности к предпринимательской деятельности&raquo;</h1>

<p style="padding-top: 1.3em;">Каждый человек обладает своеобразной комбинацией личностных качеств, которые подходят для той или иной деятельности.
   Правда, не все люди об этом догадываются, а тем более в молодом возрасте. Иногда приходится прожить большую часть
   жизни, чтобы понять, что человек занимался не тем делом, к которому у него имеются способности.</p>

<p>Сейчас Вы выполнили тест, который был разработан для экспресс-диагностики склонностей к предпринимательской
   деятельности. Например, при удачной комбинации личностных черт, интеллектуальных способностей и общей эрудиции Вам,
   скорее всего, будет легче в сложных условиях экономической и финансовой «борьбы» превзойти конкурентов. А значит,
   у Вас в будущем есть шанс, получив соответствующее образование, стать успешным предпринимателем.</p>

<table style="width: 100%; border-collapse: collapse" border="1">
        <tr>
            <th style="padding: 4px;" colspan="3">ЛИЧНОСТНЫЕ ЧЕРТЫ</th>
        </tr>
        <tr>
            <th style="padding: 4px;">Шкала</th>
            <th style="padding: 4px;">Баллов</th>
            <th style="padding: 4px;">Результат</th>
        </tr>
    <?php
    /**
     * @var $model \common\modules\business\common\components\result\BusinessResultComposer
     */
    foreach ($model->result_scale_text as $key=>$scale) {
        // Результат по каждой шкале
        ?>
        <tr>
            <td style="padding: 4px; vertical-align: top; width: 45%;"><?=$scale['scale']?></td>
            <td style="padding: 4px; vertical-align: top; text-align: center;"><?=$model->result_scales[$key]?></td>
            <td style="padding: 4px; vertical-align: top;">
                <p><?=$scale['content2']?></p>
                <p style="font-weight: bold; padding-bottom: 0; margin-bottom: 0;">Условия для реализации способностей:</p>
                <p style="padding-top: 0; margin-top: 0;"><?=$scale['content1']?></p>
            </td>
        </tr>
        <?php
    }
    ?>


    <tr>
        <th style="padding: 4px;" colspan="3">ИНТЕЛЛЕКТУАЛЬНЫЕ ПОКАЗАТЕЛИ</th>
    </tr>

    <tr>
        <td style="padding: 4px; vertical-align: top; width: 45%;">Интеллект+внимание</td>
        <td style="padding: 4px; vertical-align: top; text-align: center;"><?=$model->intellect_correct?></td>
        <td style="padding: 4px; vertical-align: top;">
            <?php if (5 <= $model->intellect_correct): ?>

                <?php if (2 == $model->picdif): ?>
                    <p>У Вас отличная эрудиция, аналитический склад ума, хорошо развитый вербальный интеллект и
                       словесно-логическое мышление. Вы легко оперируете понятиями; умеете анализировать,
                       систематизировать и воспроизводить полученную информацию; адекватно интерпретируете сложные
                       логические высказывания и уместно их используете в речи; хорошо понимаете и воспроизводите
                       содержание текстов. У Вас хорошая обучаемость; Вы быстро и точно действуете в режиме ограничения
                       времени; умеете переключать внимание с решения одной задачи на другую; очень внимательны и
                       сосредоточенны в процессе интеллектуальной работы.</p>
                <?php elseif (1 == $model->picdif): ?>
                    <p>У Вас хорошо развитый вербальный интеллект и словесно-логическое мышление. Вы хорошо оперируете
                       понятиями; умеете анализировать, систематизировать и воспроизводить полученную информацию;
                       адекватно интерпретируете сложные логические высказывания и уместно их используете в речи;
                       хорошо понимаете и воспроизводите содержание текстов.
                       У Вас неплохая обучаемость; Вы довольно быстро действуете в режиме ограничения времени; умеете
                       переключать внимание с решения одной задачи на другую; достаточно внимательны и сосредоточенны.</p>
                <?php else: ?>
                    <p>У Вас развитый вербальный интеллект и словесно-логическое мышление. Вы неплохо оперируете
                       понятиями; умеете анализировать, систематизировать и воспроизводить полученную информацию;
                       адекватно интерпретируете сложные логические высказывания и уместно их используете в речи; хорошо
                       понимаете и воспроизводите содержание текстов. У Вас неплохая обучаемость; вы довольно быстро
                       действуете в режиме ограничения времени; достаточно внимательны и сосредоточенны.</p>
                <?php endif; ?>
            <?php elseif (3 <= $model->intellect_correct): ?>
                    <p>У Вас есть способности к анализу и интерпретации сложных логических высказываний. Неплохая обучаемость;
                       Вы умеете переключать внимание с решения одной задачи на другую, однако не всегда умеете
                       сосредоточиться на задаче, чтобы правильно её решить. Чтобы стать успешным, займитесь
                       систематической работой над развитием интеллекта: больше читайте; участвуйте в дискуссиях и рассуждайте;
                       ведите ежедневные записи (дневник); запоминайте новые слова и выражения; увеличивайте свой
                       словарный запас; включайте в свою деятельность публичные выступления.
                       Все эти качества очень важны в деятельности предпринимателя или руководителя бизнеса.</p>
            <?php else: ?>
                    <p>Вероятно, Вы несколько рассеяны; не очень хорошо понимаете смысл некоторых понятий и высказываний;
                       плохо запоминаете новые слова и термины. Может быть Вы не очень любите читать, поэтому
                       испытываете трудности в интерпретации сложных логических высказываний. Чтобы стать успешным в
                       любой деятельности, а особенно – в предпринимательской, развивайте свою наблюдательность,
                       побольше читайте и развивайте речь. Это поможет Вам улучшить навыки понимания;
                       точнее различать прямой и переносный смысл высказываний; полноценно общаться с окружающими Вас
                       людьми и быть успешным.
            <?php endif ?>
        </td>
    </tr>

    <tr>
        <th style="padding: 4px;" colspan="3">ТЕСТ &laquo;ИСТОРИЯ ПРЕДПРИНИМАТЕЛЬСТВА В РОССИИ&raquo;</th>
    </tr>

    <tr>
        <td style="padding: 4px; vertical-align: top; width: 45%;">Эрудиция</td>
        <td style="padding: 4px; vertical-align: top; text-align: center;"><?=$model->history_correct?></td>
        <td style="padding: 4px; vertical-align: top;">
            <?php if (9 <= $model->history_correct): ?>
                <p>Вы открыты новому опыту в познании и в своем развитии; интересуетесь историей; эрудированы.
                   У Вас хорошая поисковая активность; можете работать с незнакомым материалом и быстро находить
                   нужную информацию.</p>
            <?php elseif (5 <= $model->history_correct): ?>
                <p>У Вас неплохая поисковая активность; можете работать с незнакомым материалом и быстро находить
                   нужную информацию; неплохо ориентируетесь в истории своей страны и родного города.
            <?php else: ?>
                <p>Больше читайте и интересуйтесь новым; узнавайте историю своей страны на разных этапах её развития;
                   человеку с хорошей эрудицией всегда легче устанавливать контакты и строить деловые отношения.
            <?php endif; ?>
        </td>
    </tr>

    <tr>
        <th style="padding: 4px;" colspan="3">ПРОЕКТИВНЫЙ ТЕСТ &laquo;ПРЕДПРИНИМАТЕЛЬ&raquo;</th>
    </tr>

    <?php foreach ($model->picturedByQuestion as $k=>$q): ?>
    <tr>
        <td style="padding: 4px; vertical-align: top; "><?=$q['question']?></td>
        <td style="padding: 4px; vertical-align: top; text-align: center;"><?=$q['variant']?></td>
        <td style="padding: 4px; vertical-align: top;">
            <?=implode('; ', array_keys($q['chars']))?>
        </td>
    </tr>

    <?php endforeach; ?>
</table>

</div>

<?php /* foreach ($model->result_chars as $k=>$v){
    if ($v) echo '<li>' . $k;
    else echo '<li style="text-decoration:line-through;">' . $k;
} */
?>

