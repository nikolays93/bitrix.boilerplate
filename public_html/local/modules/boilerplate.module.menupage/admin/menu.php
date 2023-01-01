<?php

\Bitrix\Main\Loader::includeModule(GetModuleID(__DIR__));

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
    "parent_menu" => $globalMenu['Настройки'],
    "sort" => 100,
    "text" => 'Настройки сайта',
    "title" => 'Настройки сайта',
    "url" => boilerplate_module_menupage::ADMIN_PAGE_NAME,
    "items_id" => "personal_settings",
];
