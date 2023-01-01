<?php require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');

$moduleId = '#MODULE_ID#';
\Bitrix\Main\Loader::includeModule($moduleId);

$module = new boilerplate_module_menupage();
$filename = $module::ADMIN_PAGE_NAME;
require($module::getRoot() . '/modules/' . $moduleId . '/admin/' . $filename);
