<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @global $APPLICATION */
/** @global $USER */

use Bitrix\Main;

$obRequest = Main\Context::getCurrent()->getRequest();

if ($obRequest->get('ajax')) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $obRequest->get('register_submit_button')) {
        @header('Content-Type: application/json');
        $APPLICATION->RestartBuffer();

        $_arResponse = [
            'SUCCESS' => 'Y',
            'CAPTCHA_HTML' => $arResult['CAPTCHA_HTML'],
            'AUTH' => $USER->IsAuthorized(),
        ];

        if ($_arResponse['AUTH']) {
            $arResponse = [
                'SUCCESS_MESSAGE' => GetMessage("MAIN_REGISTER_AUTH"),
                'BACKURL' => $obRequest->get('backurl') ?: $arParams['SUCCESS_PAGE'],
            ];
        }
        elseif (empty($arResult['ERRORS'])) {
            $successMessage = GetMessage('MAIN_REGISTER_PASSED');
            if ('Y' === $arResult["USE_EMAIL_CONFIRMATION"]) {
                $successMessage.= '<br><br>' . GetMessage("REGISTER_EMAIL_WILL_BE_SENT");
            }

            $arResponse = [
                'SUCCESS_MESSAGE' => $successMessage,
                'BACKURL' => $obRequest->get('backurl') ?: $arParams['SUCCESS_PAGE'],
            ];
        } else {
            $arResponse = [
                'SUCCESS' => 'N',
                'ERRORS' => $arResult['ERRORS'],
            ];
        }

        exit(Main\Web\Json::encode(array_merge($_arResponse, $arResponse)));
    }

    if ('GET' === $_SERVER["REQUEST_METHOD"] && 'getCaptcha' === $obRequest->get('action')) {
        @header('Content-Type: application/json');
        $APPLICATION->RestartBuffer();

        exit(Main\Web\Json::encode([
            'CAPTCHA_HTML' => $arResult['CAPTCHA_HTML'],
        ]));
    }
}
