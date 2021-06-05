<?php
$all_polls = $item->count_1 + $item->count_2;
$all_polls = ($all_polls) ? round(100 / $all_polls, 1) : '0';
?>

<div class="progress-polls">
    <span><?=lang('polls_yes')?></span>
    <div class="progress-bar-polls count_1" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="width: <?=$all_polls * $item->count_1;?>%;background-color: green;">
        <?=$item->count_1?><?//=$all_polls * $item->count_1;?>
    </div>
</div>

<div class="progress-polls">
    <span><?=lang('polls_no')?></span>
    <div class="progress-bar-polls count_2" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="width: <?=$all_polls * $item->count_2;?>%;background-color: red;">
       <?=$item->count_2?> <?//=$all_polls * $item->count_2;?>
    </div>
</div>