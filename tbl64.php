<?php

$mod = 64;
$sql = "ALTER TABLE `gugu_visitor_contribution_new_%s` ADD COLUMN `is_show`  tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否在排行榜显示 @1:是 @0:否' AFTER `mtime`;";

for ($i = 0; $i < $mod; $i++) {
    $suffix = str_pad($i, 2, '0', STR_PAD_LEFT);
    $new = sprintf($sql, $suffix);
    echo $new . PHP_EOL;
}