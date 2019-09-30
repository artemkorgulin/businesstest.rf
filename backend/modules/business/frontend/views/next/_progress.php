<?php

$beginTest = date("H:i",$progress['timeStart']);
$lostTimeMinute = (time() - $progress['timeStart'])/60;
$lostTimeMinute = round($lostTimeMinute, 0);

if(isset($lostTimeMinute) && $lostTimeMinute<2){
    $lostTimeMinute = 'Меньше 2';
}
$classStyle = ($lostTimeMinute >= 45) ? 'timeOver' : 'timeCurrent';
?>

<p>Прогресс тестирования, прошло времени: <span
        class="<?php echo $classStyle; ?>"><?php echo $lostTimeMinute; ?> мин.</span>
    (началось в <?php echo $beginTest; ?>)
</p>

<progress style="width: 100%;" value="<?= $progress['done'] ?>"
          max="<?= $progress['all'] ?>"></progress>
<hr/>

<style>
    .timeOver {
        color: #ed1c24;
        font-size: 1.3em;
    }

    .timeCurrent {
        color: #242338;
        font-size: 1.4em;
    }
</style>