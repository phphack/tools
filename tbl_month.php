<?php

$start = strtotime('20170901');
$stop = strtotime('20200801');
$format = 'Ym';
$sql = "CREATE TABLE `gugu_bottle_%s` LIKE `gugu_bottle`;";

while ($start <= $stop) {
    echo sprintf($sql, date($format, $start)) . PHP_EOL;
    $start = strtotime('+1 month', $start);
}