<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Boilerplate\Module\ORM\DataTable;
use Bitrix\Main\Loader;

Loader::includeModule(GetModuleID(__DIR__));

$globalMenu = [
    'Контент' => 'global_menu_content',
    'Маркетинг' => 'global_menu_marketing',
    'Магазин' => 'global_menu_store',
    'Сервисы' => 'global_menu_services',
    'Аналитика' => 'global_menu_statistics',
    'Marketplace' => 'global_menu_marketplace',
    'Настройки' => 'global_menu_settings'
];

return [
    [
        'parent_menu' => $globalMenu['Контент'],
        'sort' => 400,
        'text' => "Результаты таблицы тестового модуля",
        'title' => "",
        'url' => 'perfmon_table.php?lang=ru&table_name=' . DataTable::getTableName(),
    ]
];
