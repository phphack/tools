<?php

$mod = 64;
$sql = "ALTER TABLE `malle_video`.`gugu_short_video_like_%s` ADD INDEX `idx_gmt_create`(`gmt_create`);";
/*
$sql = "
CREATE TABLE `gugu_short_video_like_%s` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `video_id` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '短视频ID(@gugu_short_video)',
  `gmt_create` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_video` (`user_id`,`video_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='短视频|短视频点赞表';
";*/

for ($i = 0; $i < $mod; $i++) {
    $suffix = str_pad($i, 2, '0', STR_PAD_LEFT);
    $new = sprintf($sql, $suffix);
    echo $new . PHP_EOL;
}
