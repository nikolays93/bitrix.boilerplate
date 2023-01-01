<?php

use Bitrix\Main;

if (class_exists('boilerplate_module_menupage')) {
    return;
}

class boilerplate_module_menupage extends CModule
{
    const ADMIN_PAGE_NAME = 'personal_settings.php';

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
    }

    function InstallFiles()
    {
        $fileDestination = $_SERVER["DOCUMENT_ROOT"] . '/bitrix/admin/' . self::ADMIN_PAGE_NAME;

        if (!file_exists($fileDestination)) {
            $content = file_get_contents(__DIR__ . '/admin/' . self::ADMIN_PAGE_NAME);
            file_put_contents($fileDestination, str_replace('#MODULE_ID#', $this->MODULE_ID, $content));
        }
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
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx('/bitrix/admin/' . self::ADMIN_PAGE_NAME);
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