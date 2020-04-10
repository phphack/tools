<?php

$start = strtotime('20170901');
$stop = strtotime('20200801');
$format = 'ym';
$sql = "create table `gugu_bottle%s` like `gugu_bottle`;";

while ($start <= $stop) {
    $new = sprintf($sql, date($format, $start)); 
    echo $new . '<br>';
    $start = strtotime('+1 month', $start);
}