<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @global $APPLICATION */

use Bitrix\Main;

$obContext = Main\Context::getCurrent();
$obServer = $obContext->getServer();
$obRequest = $obContext->getRequest();

if ('POST' === strtoupper($obServer->getRequestMethod()) && 'Y' === $obRequest->get('AUTH_FORM')) {
    @header('Content-Type: application/json');
    $APPLICATION->RestartBuffer();

    if (empty($arResult['ERROR_MESSAGE'])) {
        $arResponse = [
            'SUCCESS' => 'Y',
            'BACKURL' => $obRequest->get('backurl'),
        ];
    } else {
        $arResponse = [
            'SUCCESS' => 'N',
            'ERRORS' => [$arResult['ERROR_MESSAGE']['ERROR_TYPE'] => $arResult['ERROR_MESSAGE']['MESSAGE']],
        ];
    }

    echo Main\Web\Json::encode($arResponse);
    die();
}
