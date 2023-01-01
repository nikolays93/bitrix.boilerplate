<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

$this->getComponent()->SetResultCacheKeys(['ERRORS', 'CAPTCHA_HTML', 'USE_EMAIL_CONFIRMATION']);

// Sort fields by params.
$arResult["SHOW_FIELDS"] = array_unique(array_merge($arParams['SHOW_FIELDS'], $arResult["SHOW_FIELDS"] ?: [],
    array_keys($arResult["USER_PROPERTIES"]["DATA"] ?: [])));

$MESS['REGISTER_CAPTCHA_PROMT'] = GetMessage('REGISTER_CAPTCHA_PROMT');

if ('Y' == $arResult["USE_CAPTCHA"]) {
    $arResult['CAPTCHA_HTML'] = <<<HTML
        <label class="captcha-field-label">
            {$MESS['REGISTER_CAPTCHA_PROMT']}
            <img src="/bitrix/tools/captcha.php?captcha_sid={$arResult["CAPTCHA_CODE"]}"
                 width="180" height="40" alt="CAPTCHA" />
        </label>
        <input type="hidden" name="captcha_sid" value="{$arResult["CAPTCHA_CODE"]}"/>
        <input type="text" name="captcha_word" maxlength="50" value="" class="form-control form-group-input"
               autocomplete="off"/>
    HTML;
}
