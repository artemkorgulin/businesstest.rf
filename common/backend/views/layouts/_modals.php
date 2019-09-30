<div id="modal-box" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Заголовок модального окна</h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                Содержимое модального окна...
            </div>
            <!-- Футер модального окна -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove">&nbsp;</span><?=Yii::t('app/default', 'Cancel')?></button>
                <?php \kartik\form\ActiveForm::begin()?>
                <input type="hidden" name="id">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok">&nbsp;</span><?=Yii::t('app/default', 'Confirm')?></button>
                <?php \kartik\form\ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>