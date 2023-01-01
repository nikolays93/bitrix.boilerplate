<?php

use Bitrix\Main;

if (class_exists('boilerplate_module_event')) {
    return;
}

class boilerplate_module_event extends CModule
{

    public function __construct()
    {
        IncludeModuleLangFile(__FILE__);

        $arModuleVersion = ['VERSION' => '', 'VERSION_DATE' => ''];
        include __DIR__ . '/version.php';
        $this->MODULE_ID = GetModuleID(__DIR__);
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = 'Пример модуля';
        $this->MODULE_DESCRIPTION = 'Тестовый модуль для разработчиков, можно использовать как основу для разработки новых модулей для 1С:Битрикс';
        $this->PARTNER_NAME = '';
        $this->PARTNER_URI = '';
    }

    function InstallDB()
    {
    }

    function InstallEvents()
    {
        $eventManager = Main\EventManager::getInstance();
        $eventManager->registerEventHandlerCompatible('main', 'OnPageStart', $this->MODULE_ID, EventHandler::class, 'OnPageStart');
    }

    function InstallFiles()
    {
    }

    function DoInstall()
    {
        if (!CheckVersion(Main\ModuleManager::getVersion('main'), '14.00.00')) {
            Main\Context::getApplication()->ThrowException('Версия главного модуля ниже 14. Не поддерживается технология D7, необходимая модулю. Пожалуйста обновите систему.');
        }

        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallFiles();

        Main\ModuleManager::RegisterModule($this->MODULE_ID);
    }

    function UnInstallDB()
    {
    }

    function UnInstallEvents()
    {
        $eventManager = Main\EventManager::getInstance();
        $eventManager->unRegisterEventHandler('main', 'OnPageStart', $this->MODULE_ID);
    }

    function UnInstallFiles()
    {
    }

    function DoUninstall()
    {
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallFiles();

        Main\ModuleManager::UnRegisterModule($this->MODULE_ID);
    }

    /**
     * Get module holder folder name.
     * @return string /document/local (when exists) or /document/bitrix
     */
    public static function getRoot()
    {
        $local = $_SERVER['DOCUMENT_ROOT'] . '/local';
        if (false !== strpos(__DIR__, 'local' . DIRECTORY_SEPARATOR . 'modules') && is_dir($local)) {
            return $local;
        }
    }
}