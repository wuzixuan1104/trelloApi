<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "CREATE TABLE `boards` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `key_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'trello看板ID',
        `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名字',
        `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '看板代碼',
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
        PRIMARY KEY (`id`),
        KEY `key_id_index` (`key_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",
    'down' => "DROP TABLE `boards`;",
    'at' => "2018-07-10 10:30:43",
  );
