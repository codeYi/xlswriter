<?php
/**
 * @fileName : test.php
 * @project  : xlswriter
 * @desc     : test
 * @date     : 2022-11-16 17
 * @author   : Yi hui <yolo_me@163.com>
 */
require_once("vendor/autoload.php");
$example = new xlswriter\example();
$col     = [
    [
        'username' => '姓名|string|20',
        'age'      => '年龄|number|20',
        'add_time' => '日期|datetime|30',
    ]
];
$data    = [
    [
        'username' => '张三',
        'age'      => '18',
        'add_time' => '2022-11-11 20:00:00',
    ]
];
$title   = ['第一栏'];

$example->exportExcelMulti($data, $col, $title, 'example');
