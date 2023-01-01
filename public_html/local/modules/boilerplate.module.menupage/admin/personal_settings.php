<?php

use Bitrix\Main\Config\Option;

$APPLICATION->SetTitle('Настройки сайта');

$moduleId = GetModuleID(__DIR__);

$arMessages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["save"] !== '' && check_bitrix_sessid())
{
    // Do action
    Option::set($moduleId, 'SITE_NAME', $_POST['SITE_NAME']);

    $arMessages[] = ['MESSAGE' => 'Настройки обновлены', 'TYPE' => 'OK'];
}

$tabControl = new CAdminTabControl("tabControl", [[
    "DIV" => "main",
    "TAB" => 'Настройки',
    "ICON" => "main_user_edit",
    "TITLE" => 'Настройки',
]], true, true);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php');

?>
<form method="POST" action="?action=save&lang=<? echo LANGUAGE_ID ?>&<?= $tabControl->ActiveTabParam() ?>"
      enctype="multipart/form-data" name="editform">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="lang" value="<?= LANG ?>">
    <?
    $tabControl->Begin();
    $tabControl->BeginNextTab();
    ?>
    <tr>
        <td class="adm-detail-content-cell-l">Название веб-сайта:</td>
        <td class="adm-detail-content-cell-r"><input type="text" name="SITE_NAME" size="30" value="<?= Option::get($moduleId, 'SITE_NAME') ?>"></td>
    </tr>
    <?php
    $tabControl->EndTab();
    $tabControl->Buttons();
    // @todo fixit
    ?>
    <input class="adm-btn-save"
       type="submit" name="save"
       value="Сохранить"
       title="Сохранить" />
    <?php
    $tabControl->End();
    ?>
</form>
<?php
require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/epilog_admin.php');
